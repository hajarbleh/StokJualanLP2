<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogStok extends Model
{
    protected $table = 'log_stok';
    public $timestamps = true;
    public $softDeletes = true;
    
    protected $fillable = [
    	'tanggal',
    	'signature',
    	'tag'
    ];

    public function detailLogStok(){
    	return $this->hasMany('App\DetailLogStok');
    }

}
