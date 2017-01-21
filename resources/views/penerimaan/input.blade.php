@extends('layouts.app')

@section('title','Input Data')

@section('head')
	<link href="{{ asset('template/plugins/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet">
	<link href="{{ asset('template/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet">
@endsection

@section('content')
<?php
use App\KodeRekening;
use App\ItemPembayaran;
?>
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{ url(Auth::user()->roleData->prefix.'/home') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Penerimaan</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Input Data</h1>
		</div>
	</div><!--/.row-->
		
	<div class="row">
		<div class="col-lg-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Form Input Penerimaan</div>
				<div class="panel-body">
					<form action="{{ url('penerimaan/input') }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" value="1" name="jenis_jurnal">
						
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label>Tanggal</label>
								</div>
								<div class="input-group date" data-provide="datepicker" style="width:150px;margin-top:-15px;" data-date-format="yyyy/mm/dd">
									<input type="text" class="form-control" name="tanggal" required>
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</div>
								</div>
								@if ($errors->has('tanggal'))
									<span class="help-block">
										<strong>{{ $errors->first('tanggal') }}</strong>
									</span>
								@endif
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Semester</label>
									<select name="semester" class="form-control" style="width:150px;">
										@for($i=1;$i<=8;$i++)
										<option>{{ $i }}</option>
										@endfor
									</select>
								</div>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
								<label>NIM</label>
								<input type="text" class="form-control" name="nim_mhs" maxlength="10" required>
								@if ($errors->has('nim_mhs'))
									<span class="help-block">
										<strong>{{ $errors->first('nim_mhs') }}</strong>
									</span>
								@endif
							</div>
							
							<div class="form-group">
								<label>Nama Mahasiswa</label>
								<input type="text" class="form-control" name="nama_mhs" required>
								@if ($errors->has('nama_mhs'))
									<span class="help-block">
										<strong>{{ $errors->first('nama_mhs') }}</strong>
									</span>
								@endif
							</div>
							
							<div class="form-group">
								<label>Program Studi</label>
								<?php
								use App\Prodi;
								$prodi = Prodi::all();
								?>
								<select name="prodi" id="prodi" class="form-control" style="width:250px;">
									@foreach($prodi as $r)
										<option value="{{ $r->id_prodi }}">{{ $r->nama_prodi }}</option>
									@endforeach
								</select>
							</div>
							
						</div>
						
						<input type="hidden" name="total_data" value="0" id="total_data">
						
						<div class="row">
							<div class="col-md-6">
								<?php
								$kode_rek = ItemPembayaran::where('paket',1)->get();
								?>
								<select class="selectpicker" data-live-search="true" id="kode_rekening" name="kode_rek" required>
									@foreach($kode_rek as $r)
									<option value="{{ $r->rekening }}">{{ $r->dataRekening->nama_rekening }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-4">
								<input type="number" class="form-control" id="setoran" name="setor" placeholder="0" style="width:150px;" required>
							</div>
							<div class="col-md-2">
								<a href="#!" class="btn btn-warning" id="btn_add">+</a>
							</div>
							
						</div>
						
						<div class="row">
							<br>
							<div class="col-md-12">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Kode Rekening</th>
											<th>Nama Rekening</th>
											<th>Jumlah Setoran</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody id="load_data">
										<tr>
											<td colspan="4"><i>Belum Ada Data</i></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						
						<div class="form-group">
							<br>
							<button type="submit" class="btn btn-success">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.row-->
	
	<div class="row">
		
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">10 Riwayat Terakhir</div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th style="width:50px;">No</th>
								<th>NIM</th>
								<th>Nama Mahasiswa</th>
								<th>SMT</th>
								<th>Pembayaran</th>
								<th style="text-align:right;">Jumlah</th>
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
								<td>{{ $r->semester }}</td>
								<td>{{ $r->nama_rekening }}</td>
								<td align="right">{{ rupiah($r->setoran) }}</td>
							</tr>
							<?php $no++; ?>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	
	</div><!--/.row-->
@endsection

@section('js')
	<script src="{{ asset('template/plugins/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
	<script src="{{ asset('template/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
	
	<script>
		var total_data = 0;
		$("#btn_add").click(function(){
			if(total_data == 0){
				$("#load_data").empty();
			}
			var kode_rekening = $('select[name=kode_rek]').val();
			var nama_rekening = $("#kode_rekening option:selected").text();
			var setoran = $("#setoran").val();
			
			total_data++;
			$("#total_data").val(total_data);
			
			$("#load_data").append("<tr> <td><input type='hidden' name='kode_rek_"+total_data+"' value='"+kode_rekening+"'>"+kode_rekening+"</td> <td>"+nama_rekening+"</td> <td><input type='hidden' name='setoran_"+total_data+"' value='"+setoran+"'>"+setoran+"</td><td><a href='#!' onclick='deleteRow(this)'><i class='glyphicon glyphicon-trash'></i></a></td></tr>");
		});
		
		function deleteRow(btn) {
		  var row = btn.parentNode.parentNode;
		  row.parentNode.removeChild(row);
		}
	</script>
@endsection
