<?php
use App\SiteConfig;
$conf = SiteConfig::find(1);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>

<link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('template/css/styles.css') }}" rel="stylesheet">

<!--Icons-->
<script src="{{ asset('template/js/lumino.glyphs.js') }}"></script>


<!--[if lt IE 9]>
<script src="{{ asset('template/js/html5shiv.js') }}"></script>
<script src="{{ asset('template/js/respond.min.js') }}"></script>
<![endif]-->

@yield('head')

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<a class="navbar-brand" href="{{ url('/') }}">{{ $conf->name_app }} @if(Auth::check()) - {{ Auth::user()->roleData->role }} @endif</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<!-- Authentication Links -->
						@if (Auth::guest())
						<a href="{{ url('/login') }}">Login</a>
						@else
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> {{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/profile') }}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="{{ url('/logout') }}" onclick="return confirm('Anda Yakin Ingin Logout?');"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
	
						@endif
					</li>
				</ul>
				
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
	
	@if (Auth::check())
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<!--<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>-->
		<ul class="nav menu">
			<li @if(Route::getCurrentRoute()->getPath() == Auth::user()->roleData->prefix.'/home' || Route::getCurrentRoute()->getPath() == '/home') class="active" @endif><a href="{{ url(Auth::user()->roleData->prefix.'/home') }}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			@if(Auth::user()->role == 3)<li @if(Route::getCurrentRoute()->getPath() == Auth::user()->roleData->prefix.'/input') class="active" @endif><a href="{{ url('/penerimaan/input') }}"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Penerimaan</a></li>@endif
			@if(Auth::user()->role == 3)<li @if(Route::getCurrentRoute()->getPath() == Auth::user()->roleData->prefix.'/riwayat') class="active" @endif><a href="{{ url('/penerimaan/riwayat') }}"><svg class="glyph stroked pencil"><use xlink:href="#stroked-notepad"></use></svg> Riwayat</a></li>@endif
			@if(Auth::user()->role == 1)<li @if(Route::getCurrentRoute()->getPath() == Auth::user()->roleData->prefix.'/kode-rekening') class="active" @endif><a href="{{ url('/admin/kode-rekening') }}"><svg class="glyph stroked pencil"><use xlink:href="#stroked-notepad"></use></svg> Kode Rekening</a></li> @endif
			@if(Auth::user()->role == 1)<li @if(Route::getCurrentRoute()->getPath() == Auth::user()->roleData->prefix.'/setting') class="active" @endif><a href="{{ url('/admin/setting') }}"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"/></svg> Setting</a></li> @endif
			@if(Auth::user()->role == 3)<li class="parent
				@if(Route::getCurrentRoute()->getPath() == Auth::user()->roleData->prefix.'/laporan/harian') active @endif
				@if(Route::getCurrentRoute()->getPath() == Auth::user()->roleData->prefix.'/laporan/bulanan') active @endif
				@if(Route::getCurrentRoute()->getPath() == Auth::user()->roleData->prefix.'/laporan/bulanan/load') active @endif
				"
			>
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Laporan 
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="{{ url(Auth::user()->roleData->prefix.'/laporan/harian') }}">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Lap. Harian
						</a>
					</li>
					<li>
						<a class="" href="{{ url(Auth::user()->roleData->prefix.'/laporan/bulanan') }}">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Lap. Bulanan
						</a>
					</li>
					<li>
						<a class="" href="{{ url(Auth::user()->roleData->prefix.'/laporan/mahasiswa') }}">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Lap. Per Mahasiswa
						</a>
					</li>
				</ul>
			</li>@endif
		</ul>

	</div><!--/.sidebar-->
	@endif
	
	<div @if (Auth::guest()) class="col-sm-12 main" @else class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" @endif>
		<!-- FOR Success Message -->
		@if(Session::has('success'))
			<div class="alert alert-success fade in" style="margin-top:10px;" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Success!</strong> {{ Session::get('success') }}
			</div>
		@endif	
		
		<!-- FOR Error Message -->
		@if(Session::has('error'))
			<div class="alert alert-danger fade in" style="margin-top:10px;" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> {{ Session::get('error') }}
			</div>
		@endif
			
		@yield('content')
	</div>	<!--/.main-->

	<script src="{{ asset('template/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
	
	
	
	
	<script>
		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>
	
	@yield('js')
	
	
</body>

</html>
