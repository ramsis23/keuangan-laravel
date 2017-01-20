@extends('layouts.app')

@section('title','Riwayat')

@section('head')
	<link href="{{ asset('template/plugins/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{ url(Auth::user()->roleData->prefix.'/home') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Riwayat</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Riwayat</h1>
		</div>
	</div><!--/.row-->
		
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Riwayat Inputan Data</div>
				<div class="panel-body">
					
					<table class="table table-striped">
						<thead>
							<tr>
								<th style="width:50px;">No</th>
								<th>NIM</th>
								<th>Nama Mahasiswa</th>
								<th>Prodi</th>
								<th>Pembayaran</th>
								<th>Nominal</th>
								<th style="width:50px;">Smt</th>
								<th>Tanggal</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							?>
							@foreach($data as $r)
							<tr>
								<td>{{ $no }}.</td>
								<td>{{ $r->nim_mhs }}</td>
								<td>{{ $r->nama_mhs }}</td>
								<td>{{ $r->dataProdi->nama_prodi }}</td>
								<td>{{ $r->nama_rekening }}</td>
								<td>{{ rupiah($r->setoran) }}</td>
								<td>{{ $r->semester }}</td>
								<td>{{ format_indo($r->tanggal) }}</td>
							</tr>
							<?php $no++; ?>
							@endforeach
						</tbody>
					</table>
					
					{{ $data->links() }}
					
				</div>
			</div>
		</div>
	</div><!--/.row-->
@endsection

@section('js')
@endsection
