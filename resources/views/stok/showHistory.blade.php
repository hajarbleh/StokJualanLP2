@extends('layout.base')
@section('title', 'List barang')
@section('content')
<table class="table table-hover">
  <tr>
    <th style="text-align:center">Nomor</th>
    @foreach($JenisBarang as $Barang)
    <th colspan="2" style="text-align:center">{{$Barang->nama_barang}}</th>
    @endforeach
    <th style="text-align:center">Tag</th>
    <th style="text-align:center">Pemasukan Kotor</th>
    <th style="text-align:center">Tanggal</th>
    <th style="text-align:center">Signature</th>
    
  </tr>
  <tr>
    <th></th>
    @foreach($JenisBarang as $Barang)
    <th style="text-align:center">Sisa dus</th>
    <th style="text-align:center">Sisa satuan</th>
    @endforeach 
  </tr>
  <?php 
    $counter = 1;
  ?>
  @foreach($DataHistory as $DataHistoryRow)
    <tr>
      <td style="text-align:center"><?php echo $counter++;?></td>
      @foreach($DataHistoryRow as $DataHistoryCell)
        <td style="text-align:center">{{$DataHistoryCell['sisa_dus']}}</td>
        <td style="text-align:center">{{$DataHistoryCell['sisa_satuan']}}</td>        
      @endforeach
      <td style="text-align:center">{{$Signs[$counter-1]['tag']}}</td>
      <td style="text-align:center">{{$Signs[$counter-1]['pemasukan_kotor']}}</td>
      <td style="text-align:center">{{$Signs[$counter-1]['tanggal']}}</td>
      <td style="text-align:center">{{$Signs[$counter-1]['signature']}}</td>
    </tr>
  @endforeach
</table>
@endsection