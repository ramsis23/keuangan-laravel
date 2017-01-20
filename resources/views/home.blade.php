@extends('layouts.app')

@section('title','Dashboard')

@section('head')
<?php
use App\JurnalPenerimaan;
?>
@endsection

@section('content')
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{ url(Auth::user()->roleData->prefix.'/home') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Home</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Dashboard</h1>
		</div>
	</div><!--/.row-->
		
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Statistik Total Pemasukan 6 Bulan Terakhir (Dalam Rupiah)</div>
				<div class="panel-body">
					<div class="canvas-wrapper">
						<canvas class="main-chart" id="line-chart-2" height="200" width="600"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div><!--/.row-->
		
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Statistik Total Pemasukan 3 Tahun Terakhir (Dalam Rupiah)</div>
				<div class="panel-body">
					<div class="canvas-wrapper">
						<canvas class="main-chart" id="bar-chart" height="200" width="600"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div><!--/.row-->
	
@endsection

@section('js')
	<script src="{{ asset('template/js/chart.min.js') }}"></script>
	
	<script type="text/javascript">

      var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};
	  
		var lineChartData2 = {
				
				labels : [
					<?php
					$i=5;
					while($i >= 0){
						$mo = date('M (y)', strtotime(date('Y-m-d H:i:s'). ' - '.$i.' months'));
						echo "'".$mo."',";
						$i--;
					}
					?>
				],
				datasets : [
					{
						label: "My Second dataset",
						fillColor : "rgba(48, 164, 255, 0.2)",
						strokeColor : "rgba(48, 164, 255, 1)",
						pointColor : "rgba(48, 164, 255, 1)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(48, 164, 255, 1)",
						data : [
							<?php
							$i=5;
							while($i >= 0){
								$raw_date = date('Y-m-d', strtotime(date('Y-m-d H:i:s'). ' - '.$i.' months'));
								$month = date('m', strtotime($raw_date));
								$year = date('Y', strtotime($raw_date));
								$count_month = JurnalPenerimaan::whereRaw('extract(month from tanggal) = ?', [$month])
														->whereRaw('extract(year from tanggal) = ?', [$year])
														->sum('setoran'); //dapatkan data bulan ini
								echo "'".$count_month."',";
								$i--;
							}
							?>
						]
					}
				]

			}
			
		var barChartData = {
				labels : [
					<?php
					$i=2;
					while($i >= 0){
						$month = date('Y', strtotime(date('Y-m-d H:i:s'). ' - '.$i.' years'));
						echo "'".$month."',";
						$i--;
					}
					?>
				],
				datasets : [
					{
						fillColor : "rgba(48, 164, 255, 0.2)",
						strokeColor : "rgba(48, 164, 255, 0.8)",
						highlightFill : "rgba(48, 164, 255, 0.75)",
						highlightStroke : "rgba(48, 164, 255, 1)",
						data : [
						<?php
							$i=2;
							while($i >= 0){
								$year = date('Y', strtotime(date('Y-m-d H:i:s'). ' - '.$i.' years'));
								$count_year = JurnalPenerimaan::whereRaw('extract(year from tanggal) = ?', [$year])->sum('setoran'); //dapatkan data bulan ini
								echo "'".$count_year."',";
								$i--;
							}
							?>
						]
					}
				]
		
			}

		
	window.onload = function(){
		var linechart2 = document.getElementById("line-chart-2").getContext("2d");
		window.myLine = new Chart(linechart2).Line(lineChartData2, {
			responsive: true
		});
		var chart2 = document.getElementById("bar-chart").getContext("2d");
		window.myBar = new Chart(chart2).Bar(barChartData, {
			responsive : true
		});
		
	};
	</script>
@endsection
