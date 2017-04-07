@extends('layout.base')
@section('title', 'Tambah history')
@section('content')
<form action="" method="POST">
    {{ csrf_field() }} 

  @foreach($JenisBarang as $Barang)
  <div class="form-group">
    <label for="namaBarang">Nama barang</label>
    <input type="text" class="form-control" placeholder="{{$Barang->nama_barang}}" disabled>
  </div>
  <div class="form-group">
    <label for="namaBarang">Tambah stok (dus)</label>
    <input type="text" class="form-control" name="namaBarang{{$Barang->id}}" value="0">
  </div>

  @endforeach
  <button type="submit" class="btn btn-default">Submit</button>
</form>
@endsection