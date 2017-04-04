<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;

use App\JenisBarang;
use Illuminate\Support\Facades\Input;
use Validator;

class BarangController extends Controller
{
    public function add() {
    	if(Request::isMethod('get')) {
    		return view('Barang.add');
    	}
		else {
    		$JenisBarang = new JenisBarang;
    		$JenisBarang->nama_barang = Input::get('namaBarang');
			$JenisBarang->harga_jual = Input::get('hargaJual');
    		$JenisBarang->isi_per_dus = Input::get('isiPerDus');
    		$JenisBarang->save();
			return redirect(route('barang.showAll'));
    	}
    }

    public function show() {
    	$JenisBarang = JenisBarang::get();
		$this->data['JenisBarang'] = $JenisBarang;
    	return view('Barang.show', $this->data);
    }

    public function edit($id) {
		if(Request::isMethod('get')) {
			$JenisBarang = JenisBarang::find($id);
			if(!$JenisBarang) {
				return redirect(route('barang.showAll'));
			}
			$this->data['JenisBarang'] = $JenisBarang;
			return view('barang.edit', $this->data);
		}
		else {
			$JenisBarang = JenisBarang::find($id);
			$JenisBarang->nama_barang = Input::get('namaBarang');
			$JenisBarang->harga_jual = Input::get('hargaJual');
			$JenisBarang->isi_per_dus = Input::get('isiPerDus');
			$JenisBarang->save();
			return redirect(route('barang.showAll'));
		}
    }
}
