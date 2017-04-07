@extends('layout.base')
@section('title', 'Hitung harian')
@section('content')
<form action="" method="POST">
    {{ csrf_field() }} 
  @foreach($LastHistory as $LastHistoryItem)
  <div class="form-group">
    <label for="namaBarang">Nama barang</label>
    <input type="text" class="form-control" value="{{$LastHistoryItem->nama_barang}}" disabled>
  </div>
  <div class="form-group">
    <label for="namaBarang">Sisa stok kemarin (dus)</label>
    <input type="text" class="form-control" value="{{$LastHistoryItem->sisa_dus}}" disabled>
  </div>
  <div class="form-group">
    <label for="namaBarang">Sisa stok kemarin (satuan)</label>
    <input type="text" class="form-control" value="{{$LastHistoryItem->sisa_satuan}}" disabled>
  </div>
  <div class="form-group">
    <label for="namaBarang">Sisa stok hari ini (dus)</label>
    <input type="text" class="form-control" name="dus{{$LastHistoryItem->id}}"value="0">
  </div>
  <div class="form-group">
    <label for="namaBarang">Sisa stok hari ini (satuan)</label>
    <input type="text" class="form-control" name="satuan{{$LastHistoryItem->id}}" value="0">
  </div>
  @endforeach
  <button type="submit" class="btn btn-default">Submit</button>
</form>
@endsection