@extends('layout.base')
@section('title', 'List barang')
@section('content')
<table class="table table-hover">
  <tr>
  	<th>Nomor</th>
  	<th>Nama barang</th>
  	<th>Harga jual</th>
  	<th>Isi per dus</th>
	<th>Aksi</th>
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
		<td>
			<a href="edit/{{$Barang->id}}">Ubah</a>|<a href="delete/{{$Barang->id}}">Hapus</a>
		</td>
  	</tr>
  @endforeach
</table>
@endsection