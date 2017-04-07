<?php

use Illuminate\Database\Seeder;
use App\JenisBarang;
class JenisBarangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brg1 = new JenisBarang;
        $brg1->nama_barang = 'Floridina 300ml';
        $brg1->harga_jual = 3500;
		$brg1->isi_per_dus = 12;
		$brg1->save();

        $brg2 = new JenisBarang;
        $brg2->nama_barang = 'Club 600ml';
        $brg2->harga_jual = 2500;
		$brg2->isi_per_dus = 24;
        $brg2->save();

        $brg3 = new JenisBarang;
        $brg3->nama_barang = 'Ultramilk 200ml';
        $brg3->harga_jual = 4500;
		$brg3->isi_per_dus = 30;
        $brg3->save();

    }
}
