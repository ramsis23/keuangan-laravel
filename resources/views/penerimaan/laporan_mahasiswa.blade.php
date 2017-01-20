@extends('layouts.app')

@section('title','Laporan Detail Pembayaran Mahasiswa')

@section('head')
	<link href="{{ asset('template/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="row no_print">
		<ol class="breadcrumb">
			<li><a href="{{ url(Auth::user()->roleData->prefix.'/home') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Laporan Mahasiswa</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row no_print">
		<div class="col-lg-12">
			<h1 class="page-header">Laporan Detail Pembayaran Mahasiswa</h1>
		</div>
	</div><!--/.row-->
		
	<div class="row no_print">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Detail Mahasiswa</div>
				<div class="panel-body">
					
					<form action="{{ url('penerimaan/laporan/mahasiswa/load') }}" method="post">
						{{ csrf_field() }}
						<div class="form-group">
							<label>NIM</label>
							<input type="text" maxlength="12" name="nim" class="form-control" style="width:350px;">
						</div>
									
						<div class="form-group">	
							<br>
						  <button class="btn btn-primary" id="btn_laporan">Submit</button>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div><!--/.row-->
	
@endsection

@section('js')
	<script src="{{ asset('template/plugins/bootstrap-daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('template/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
	
	<script>
		$('#tanggal').datepicker({
			format:"yyyy-mm",
			viewMode:"months",
			minViewMode:"months"
		});
	</script>
@endsection
