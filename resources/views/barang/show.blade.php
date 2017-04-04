@extends('layout.base')
@section('title', 'List barang')
@section('content')
<table class="table table-hover">
  <tr>
  	<th>Nomor</th>
  	<th>Nama barang</th>
  	<th>Harga jual</th>
  	<th>Isi per dus</th>
  </tr>
  <?php
  	$counter = 1;
  ?>
  @foreach($JenisBarang as $Barang)
  	<tr>
  		<td>
  			  <?php
  				echo $counter++;
			  ?>

  		</td>
  		<td>
  			{{$Barang->nama_barang}}
  		</td>
  		<td>
  			{{$Barang->harga_jual}}
  		</td>
  		<td>
  			{{$Barang->isi_per_dus}}
  		</td>
  		
  	</tr>
  @endforeach
</table>
@endsection