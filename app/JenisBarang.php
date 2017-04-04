<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    protected $table = 'jenis_barang';
    public $timestamps = true;
    public $softDeletes = true;
    
    protected $fillable = [
    	'nama_barang',
    	'harga_jual',
    	'isi_per_dus'
    ];

    public function detailLogStok(){
    	return $this->hasMany('App\DetailLogStok');
    }
}
