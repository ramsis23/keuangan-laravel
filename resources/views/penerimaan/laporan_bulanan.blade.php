@extends('layouts.app')

@section('title','Laporan Bulanan')

@section('head')
	<link href="{{ asset('template/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="row no_print">
		<ol class="breadcrumb">
			<li><a href="{{ url(Auth::user()->roleData->prefix.'/home') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Laporan Bulanan</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row no_print">
		<div class="col-lg-12">
			<h1 class="page-header">Laporan Bulanan</h1>
		</div>
	</div><!--/.row-->
		
	<div class="row no_print">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Laporan Bulanan</div>
				<div class="panel-body">
					
					<form action="{{ url('penerimaan/laporan/bulanan/load') }}" method="post">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Bulan</label>
						</div>
						<div class="input-group date" style="width:150px;margin-top:-15px;">
							<input type="text" class="form-control" name="tanggal" id="tanggal" required>
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</div>
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
