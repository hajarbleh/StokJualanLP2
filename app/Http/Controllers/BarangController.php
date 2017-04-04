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
    		return redirect(route('showBarang'));
    	}
    }

    public function show() {
    	$JenisBarang = JenisBarang::get();
    	$this->data['JenisBarang'] = $JenisBarang;
    	return view('Barang.show', $this->data);
    }
}
