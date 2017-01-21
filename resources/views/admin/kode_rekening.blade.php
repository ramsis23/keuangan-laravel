@extends('layouts.app')

@section('title','Kode Rekening')

@section('content')
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Kode Rekening</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Kode Rekening</h1>
		</div>
	</div><!--/.row-->
		
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
				Daftar Kode Rekening
				<p class="navbar-text navbar-right" style="color:#fff;">Tambah Rekening <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalRekening"><i class="glyphicon glyphicon-plus"></i></a></p>
				</div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Rekening</th>
								<th>Nama Rekening</th>
								<th>Biaya</th>
								<th>Balance</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							?>
							@foreach($data as $r)
							<tr>
								<td>{{ $no }}</td>
								<td>{{ $r->id_rekening }}</td>
								<td>{{ $r->nama_rekening }}</td>
								<td>@if($r->biaya){{ rupiah($r->biaya) }}@endif</td>
								<td>{{ $r->balance }}</td>
								<td>
									<a href="#!" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalRekeningEdit{{ $no }}">Edit</a> 
									<a href="{{ url('admin/rekening/remove/'.$r->id_rekening) }}" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin Ingin Menghapus Rekening Ini?');">Hapus</a> 
								</td>
							</tr>
							
							<!-- Modal -->
							<div id="modalRekeningEdit{{ $no }}" class="modal fade" role="dialog">
							  <div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Edit Rekening</h4>
								  </div>
								  <div class="modal-body">
									
									<form action="{{ url('admin/rekening/edit') }}" method="post">
										{{ csrf_field() }}
										<input type="hidden" value="{{ $r->id_rekening }}" name="id_rekening">
										<div class="form-group">
											<label>No Rekening</label>
											<input type="text" name="no_rekening" value="{{ $r->id_rekening }}" class="form-control">
										</div>
										<div class="form-group">
											<label>Nama Rekening</label>
											<input type="text" name="nama_rekening" value="{{ $r->nama_rekening }}" class="form-control">
										</div>
										<div class="form-group">
											<label>Biaya</label>
											<input type="number" name="biaya" value="{{ $r->biaya }}" class="form-control">
										</div>
										<div class="form-group">
											<label>Balance</label>
											<select name="balance" class="form-control" style="width:100px;">
												<option value="">-</option>
												<option @if($r->balance == 'K') selected @endif>K</option>
												<option @if($r->balance == 'D') selected @endif>D</option>
											</select>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-primary">Simpan</button>
										</div>
									</form>
									
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								  </div>
								</div>

							  </div>
							</div>
	
							<?php $no++; ?>
							@endforeach
						</tbody>
					</table>
					{{ $data->links() }}
				</div>
			</div>
		</div>
	</div><!--/.row-->
	
	<!-- Modal -->
	<div id="modalRekening" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Tambah Rekening</h4>
		  </div>
		  <div class="modal-body">
			
			<form action="{{ url('admin/rekening/add') }}" method="post">
				{{ csrf_field() }}
				<div class="form-group">
					<label>No Rekening</label>
					<input type="text" name="id_rekening" class="form-control">
				</div>
				<div class="form-group">
					<label>Nama Rekening</label>
					<input type="text" name="nama_rekening" class="form-control">
				</div>
				<div class="form-group">
					<label>Biaya</label>
					<input type="number" name="biaya" class="form-control">
				</div>
				<div class="form-group">
					<label>Balance</label>
					<select name="balance" class="form-control" style="width:100px;">
						<option value="">-</option>
						<option>K</option>
						<option>D</option>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Simpan</button>
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
