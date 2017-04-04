@extends('layout.base')
@section('title', 'Tambah barang')
@section('content')
<form action="" method="POST">
    {{ csrf_field() }} 
  <div class="form-group">
    <label for="namaBarang">Nama barang</label>
    <input type="text" class="form-control" name="namaBarang" placeholder="Nama barang" required>
  </div>
  <div class="form-group">
    <label for="hargaJual">Harga jual</label>
    <input type="text" class="form-control" name="hargaJual" placeholder="Harga jual" required>
  </div>
  <div class="form-group">
    <label for="isiPerDus">Isi per dus</label>
    <input type="text" class="form-control" name="isiPerDus" placeholder="Isi per dus" required>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
@endsection