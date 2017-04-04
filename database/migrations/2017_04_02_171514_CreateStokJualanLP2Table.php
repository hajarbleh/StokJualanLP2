<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStokJualanLP2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_barang', function (Blueprint $table){
            $table->increments('id');
            $table->string('nama_barang');
            $table->integer('harga_jual');
            $table->integer('isi_per_dus');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('log_stok', function (Blueprint $table){
            $table->increments('id');
            $table->dateTime('tanggal');
            $table->string('signature');
            $table->string('tag');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('detail_log_stok', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nomor_update')->unsigned();
            $table->foreign('nomor_update')->references('id')->on('log_stok')->onDelete('cascade');
            $table->integer('jenis_barang_id')->unsigned();
            $table->foreign('jenis_barang_id')->references('id')->on('jenis_barang')->onDelete('cascade');
            $table->integer('sisa_dus');
            $table->integer('sisa_satuan');
            $table->integer('pemasukan_kotor');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jenis_barang');
        Schema::drop('detail_log_stok');
        Schema::drop('log_stok');
    }
}
