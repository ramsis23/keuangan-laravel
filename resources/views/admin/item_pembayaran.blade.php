@extends('layouts.app')

@section('title','Item Paket Pembayaran')

@section('head')
	<link href="{{ asset('template/plugins/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li><a href="{{ url('/admin/paket') }}">Paket Pembayaran</a></li>
			<li class="active">Item Paket Pembayaran</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Item Paket Pembayaran</h1>
		</div>
	</div><!--/.row-->
		
	<div class="row">
		<div class="col-lg-8 col-md-offset-2">
			<div class="panel panel-danger">
				<div class="panel-heading">Daftar Item Paket: <i>{{ $paket->nama }}</i></div>
				<div class="panel-body">
					<button class="btn btn-success" data-toggle="modal" data-target="#myModalItemBaru"><i class="glyphicon glyphicon-plus"></i> Tambah Rekening</button>
					<table class="table table-stripped">
						<thead>
							<tr>
								<th>No.</th>
								<th>Kode Rekening</th>
								<th>Nama Rekening</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php $no=1; ?>
						@if(count($data) == 0)
							<tr>
								<td colspan="4" align="center"><i>Belum ada rekening</i></td>
							</tr>
						@else
							@foreach($data as $r)
								<tr>
									<td width="50">{{ $no }}</td>
									<td>{{ $r->rekening }}</td>
									<td>{{ $r->dataRekening->nama_rekening }}</td>
									<td width="110">
										<a href="#!" class="btn btn-warning btn-xs" title="Edit Rekening Ini"><i class="glyphicon glyphicon-pencil"></i></a> 
										<a href="#!" class="btn btn-danger btn-xs" title="Hapus Rekening Ini" onClick="return confirm('Anda yakin ingin menghapus paket ini?');"><i class="glyphicon glyphicon-trash"></i></a>
									</td>
								</tr>
								<?php $no++; ?>
							@endforeach
						@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!--/.row-->
	
	
	<!-- Modal -->
	<div id="myModalItemBaru" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Buat Paket Baru</h4>
		  </div>
		  <div class="modal-body">
			<form action="{{ url('/admin/paket/item') }}" method="post">
				{{ csrf_field() }}
				<input type="hidden" value="{{ $paket->id }}" name="paket">
				<input type="hidden" name="total_data" value="0" id="total_data">
				<div class="col-md-8">
					<?php
					use App\KodeRekening;
					$kode_rek = KodeRekening::all();
					?>
					<select class="selectpicker" data-live-search="true" id="kode_rekening" name="kode_rek" required>
						@foreach($kode_rek as $r)
						<option value="{{ $r->id_rekening }}">{{ $r->id_rekening }} - {{ $r->nama_rekening }}</option>
						@endforeach
					</select>
					<a href="#!" title="Tambah kode rekening" class="btn btn-warning" id="btn_add">+</a>
				</div>
						
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Kode Rekening</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody id="load_data">
						<tr>
							<td colspan="2"><i>Belum Ada Data</i></td>
						</tr>
					</tbody>
				</table>
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

@section('js')
	<script src="{{ asset('template/plugins/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
	<script>
		var total_data = 0;
		$("#btn_add").click(function(){
			if(total_data == 0){
				$("#load_data").empty();
			}
			var kode_rekening = $('select[name=kode_rek]').val();
			var nama_rekening = $("#kode_rekening option:selected").text();
			
			total_data++;
			$("#total_data").val(total_data);
			
			$("#load_data").append("<tr> <td><input type='hidden' name='kode_rek_"+total_data+"' value='"+kode_rekening+"'> "+nama_rekening+"</td> <td><a href='#!' onclick='deleteRow(this)'><i class='glyphicon glyphicon-trash'></i></a></td></tr>");
		});
		
		function deleteRow(btn) {
		  var row = btn.parentNode.parentNode;
		  row.parentNode.removeChild(row);
		}
	</script>
@endsection
