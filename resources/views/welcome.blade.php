<?php
use App\SiteConfig;
$conf = SiteConfig::find(1);
?>

@extends('layouts.app')

@section('title', $conf->name_app.' By Maballo Net')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading" align="center">Selamat Datang</div>

					<div class="panel-body">
						<img src="{{ asset('/upload/img/'.$conf->image_welcome) }}" style="width:100%;">
					</div>
				</div>
			</div>
		</div>
	</div>
		
@endsection
