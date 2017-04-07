<?php

namespace App\Http\Controllers;

use Request;

use DB;
use App\Http\Requests;
use Carbon\Carbon;
use App\JenisBarang;
use App\DetailLogStok;
use App\LogStok;

use Illuminate\Support\Facades\Input;
use Validator;

class StokController extends Controller
{
	public function add() {
		if(Request::isMethod('get')) {
			$JenisBarang = JenisBarang::get();
			$this->data['JenisBarang'] = $JenisBarang;
			return view('Stok.add', $this->data);
		}
		else {
			$JenisBarang = JenisBarang::get();
			$LastLogStok = LogStok::orderBy('id','desc')->first();
			if($LastLogStok!=null) {
				$historyID = $LastLogStok->id + 1;
			}
			else {
				$historyID = 1;
			}
			$LogStok = new LogStok;
			//date_default_timezone_set('Asia/Jakarta');
			$LogStok->tanggal = Carbon::now();
			$LogStok->signature = "John";
			$LogStok->tag = "Restock";
			$LogStok->save();
			foreach ($JenisBarang as $Barang) {
				$LastStok = DetailLogStok::select('sisa_dus', 'sisa_satuan')
							->where([
								['nomor_update', '=', $historyID-1],
								['jenis_barang_id', '=', $Barang->id],
								])
							->first();
				$InputID = 'namaBarang'.$Barang->id;
				$DetailLogStok = new DetailLogStok;
				$DetailLogStok->nomor_update = $historyID;
				$DetailLogStok->jenis_barang_id = $Barang->id;
				$DetailLogStok->sisa_dus = Input::get($InputID) + (($LastStok==null)?0:$LastStok->sisa_dus);
				$DetailLogStok->sisa_satuan = (($LastStok==null)?0:$LastStok->sisa_satuan);
				$DetailLogStok->save();
			}
			return redirect(route(('stok.showHistory')));
		}
	}

	public function showHistory() {
		$JenisBarang = JenisBarang::get();
		$LogStok = LogStok::get();
		$DetailLogStok = DetailLogStok::get();
		$arr = array();
		$tanggal = array();
		$signature = array();
		foreach($LogStok as $LogStokRow) {
			$tag[$LogStokRow->id] = $LogStokRow->tag;
			$tanggal[$LogStokRow->id] = $LogStokRow->tanggal;
			$signature[$LogStokRow->id] = $LogStokRow->signature;
		}
		foreach ($DetailLogStok as $DetailLogStokRow) {
			$arr[$DetailLogStokRow->nomor_update][$DetailLogStokRow->jenis_barang_id] = $DetailLogStokRow;
		}
		$LastLogStok = LogStok::orderBy('id','desc')->first();
		if($LastLogStok==null) $HistoryID = 0;
		else $HistoryID = $LastLogStok->id;
		$DataHistory = array();
		$counter = 1;
		for($i = 1; $i <= $HistoryID; $i++) {
			$PemasukanKotor = 0;
			if(isset($arr[$i])) {
				foreach($JenisBarang as $JenisBarangRow) {
					if(isset($arr[$i][$JenisBarangRow->id])) {
						$PemasukanKotor+=$arr[$i][$JenisBarangRow->id]->pemasukan_kotor;
						$DataHistory[$i][$JenisBarangRow->id] = ['sisa_dus' => $arr[$i][$JenisBarangRow->id]->sisa_dus,
																 'sisa_satuan' => $arr[$i][$JenisBarangRow->id]->sisa_satuan];
					}
					else {
						$DataHistory[$i][$JenisBarangRow->id] = ['sisa_dus' => 0,
																 'sisa_satuan' => 0];
					}
				}
				$Signs[$counter++] = ['pemasukan_kotor' => $PemasukanKotor, 'tag' => $tag[$i], 'tanggal' => $tanggal[$i], 'signature' => $signature[$i]];
			}
		}
		$this->data['Signs'] = $Signs;
		$this->data['DataHistory'] = $DataHistory;
		$this->data['JenisBarang'] = $JenisBarang;
		return view('stok.showHistory', $this->data);
	}

	public function hitung() {
		if(Request::isMethod('get')) {
			$JenisBarang = JenisBarang::get();
			$LastLogStok = LogStok::orderBy('id','desc')->first();
			$LastHistory = DB::select(DB::raw("SELECT jb.id,jb.nama_barang,dls.sisa_dus,dls.sisa_satuan FROM jenis_barang jb LEFT JOIN (SELECT * FROM detail_log_stok dls WHERE dls.nomor_update = $LastLogStok->id) dls ON jb.id=dls.jenis_barang_id"));
			foreach($LastHistory as $LastHistoryItem) {
				if($LastHistoryItem->sisa_dus==null) {
					$LastHistoryItem->sisa_dus = 0;
					$LastHistoryItem->sisa_satuan = 0;
				}
			}
			$this->data['LastHistory'] = $LastHistory;
			return view('Stok.hitungHarian', $this->data);
		}
		else {
			$JenisBarang = JenisBarang::get();
			$LogStok = new LogStok;
			$LogStok->tanggal = Carbon::now();
			$LogStok->signature = "John";
			$LogStok->tag = "Hitung";
			$LogStok->save();
			foreach ($JenisBarang as $Barang) {
				$LastStokItem = DB::select(DB::raw("SELECT dls.jenis_barang_id,dls.sisa_dus, dls.sisa_satuan, jb.harga_jual, jb.isi_per_dus FROM detail_log_stok dls LEFT JOIN log_stok ls ON dls.nomor_update=ls.id LEFT JOIN jenis_barang jb ON dls.jenis_barang_id=jb.id WHERE dls.nomor_update=$LogStok->id-1 AND dls.jenis_barang_id=$Barang->id"));
				$InputDus = 'dus'.$Barang->id;
				$InputSatuan = 'satuan'.$Barang->id;
				if($LastStokItem!=null) {
					$PemasukanKotor = $LastStokItem[0]->harga_jual*($LastStokItem[0]->isi_per_dus*($LastStokItem[0]->sisa_dus - Input::get($InputDus)) + $LastStokItem[0]->sisa_satuan - Input::get($InputSatuan));
				}
				else $PemasukanKotor = 0;
				$DetailLogStok = new DetailLogStok;
				$DetailLogStok->nomor_update = $LogStok->id;
				$DetailLogStok->jenis_barang_id = $Barang->id;
				$DetailLogStok->sisa_dus = Input::get($InputDus);
				$DetailLogStok->sisa_satuan = Input::get($InputSatuan);
				$DetailLogStok->pemasukan_kotor = $PemasukanKotor;
				$DetailLogStok->save();
			}
			return redirect(route('stok.showHistory'));
		}
	}
}
