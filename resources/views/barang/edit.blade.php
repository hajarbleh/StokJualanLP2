@extends('layout.base')
@section('title', 'Ubah barang')
@section('content')
<form action="" method="POST">
    {{ csrf_field() }} 
  <div class="form-group">
    <label for="namaBarang">Nama barang</label>
    <input type="text" class="form-control" name="namaBarang" value="{{$JenisBarang->nama_barang}}" required>
  </div>
  <div class="form-group">
    <label for="hargaJual">Harga jual</label>
    <input type="text" class="form-control" name="hargaJual" value="{{$JenisBarang->harga_jual}}" required>
  </div>
  <div class="form-group">
    <label for="isiPerDus">Isi per dus</label>
    <input type="text" class="form-control" name="isiPerDus" value="{{$JenisBarang->isi_per_dus}}" required>
  </div>
  <button type="submit" class="btn btn-default">Ubah!</button>
</form>
@endsection