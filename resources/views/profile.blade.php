@extends('layouts.app')

@section('title','Profile')

@section('head')

@endsection

@section('content')
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{ url(Auth::user()->roleData->prefix.'/home') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Profile</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Profile</h1>
		</div>
	</div><!--/.row-->
		
	<div class="row">
		<div class="col-lg-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">Form Update Profile</div>
				<div class="panel-body">
					<form action="{{ url('profile/update') }}" method="post">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Email</label>
							<input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control">
						</div>
						<div class="form-group">
							<label>Nama User</label>
							<input type="text" name="name" value="{{Auth::user()->name }}" class="form-control">
						</div>
						<div class="form-group">
							<label>Password Baru</label>
							<input type="password" name="password_baru" class="form-control">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-warning">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.row-->

@endsection

@section('js')

@endsection
