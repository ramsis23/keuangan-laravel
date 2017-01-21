@extends('layouts.app')

@section('title','Setting')

@section('content')
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Setting</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Setting</h1>
		</div>
	</div><!--/.row-->
		
	<div class="row">
		<div class="col-lg-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">Update Data Aplikasi</div>
				<div class="panel-body">
					<form action="{{ url('/admin/setting') }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Nama Aplikasi</label>
							<input type="text" name="name_app" value="{{ $conf->name_app }}" class="form-control">
						</div>
						<!--<div class="form-group">
							<label>Logo (200x200 px)</label>
							<input type="file" name="file_logo">
						</div>-->
						<div class="form-group">
							<label>Gambar Selamat Datang (750x308 px)</label>
							<input type="file" name="file_welcome">
						</div>
						<hr>
						<h4 align="center">Data Untuk Tanda Tangan</h4>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Nama Ketua</label>
									<input type="text" name="ketua" value="{{ $ttd3->nama }}" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Nama Jabatan Ketua</label>
									<input type="text" name="ketua_jabatan" value="{{ $ttd3->jabatan }}" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Nama Ketua Adm & Keuangan</label>
									<input type="text" name="ketua_keuangan" value="{{ $ttd2->nama }}" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Nama Jabatan Adm & Keuangan</label>
									<input type="text" name="jabatan_ketua" value="{{ $ttd2->jabatan }}" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Nama Bendahara Penerimaan</label>
									<input type="text" name="bendahara_penerimaan" value="{{ $ttd1->nama }}" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Nama Jabatan Penerimaan</label>
									<input type="text" name="jabatan_penerimaan" value="{{ $ttd1->jabatan }}" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group" align="center">
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.row-->
@endsection
