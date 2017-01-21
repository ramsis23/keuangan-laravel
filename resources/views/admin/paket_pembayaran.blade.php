@extends('layouts.app')

@section('title','Paket Pembayaran')

@section('content')
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Paket Pembayaran</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Paket Pembayaran</h1>
		</div>
	</div><!--/.row-->
		
	<div class="row">
		<div class="col-lg-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">Daftar Paket Pembayaran</div>
				<div class="panel-body">
					<button class="btn btn-success" data-toggle="modal" data-target="#myModalPaketBaru"><i class="glyphicon glyphicon-plus"></i> Buat Paket Baru</button>
					<table class="table table-stripped">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama Paket</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php $no=1; ?>
						@foreach($data as $r)
							<tr>
								<td width="50">{{ $no }}</td>
								<td><a href="{{ url('/admin/paket/item'.'/'.$r->id) }}">{{ $r->nama }}</a></td>
								<td width="110">
									<a href="#!" class="btn btn-warning btn-xs" title="Edit Paket Ini"><i class="glyphicon glyphicon-pencil"></i></a> 
									@if($r->id != 1)<a href="#!" class="btn btn-danger btn-xs" title="Hapus Paket Ini" onClick="return confirm('Anda yakin ingin menghapus paket ini?');"><i class="glyphicon glyphicon-trash"></i></a>@endif
									<a href="{{ url('/admin/paket/item'.'/'.$r->id) }}" class="btn btn-info btn-xs" title="Tampilkan Detail Paket"><i class="glyphicon glyphicon-zoom-in"></i></a>
								</td>
							</tr>
							<?php $no++; ?>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!--/.row-->
	
	
	<!-- Modal -->
	<div id="myModalPaketBaru" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Buat Paket Baru</h4>
		  </div>
		  <div class="modal-body">
			<form action="{{ url('/admin/paket') }}" method="post">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Nama Paket</label>
					<input type="text" name="nama" class="form-control">
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Simpan</button>
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>

	  </div>
	</div>
@endsection
