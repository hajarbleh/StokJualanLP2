<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailLogStok extends Model
{
    protected $table = 'detail_log_stok';
    public $timestamps = true;
    public $softDeletes = true;
    
    protected $fillable = [
    	'sisa_dus',
    	'sisa_satuan',
    	'pemasukan_kotor'
    ];

    public function logStok(){
    	return $this->belongsTo('App\LogStok');
    }

    public function jenisBarang(){
    	return $this->belongsTo('App\JenisBarang');
    }
}
