<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Print Laporan Detail Pembayaran Mahasiswa</title>

<!--[if lt IE 9]>
<script src="{{ asset('template/js/html5shiv.js') }}"></script>
<script src="{{ asset('template/js/respond.min.js') }}"></script>
<![endif]-->

	<style>
		.table{
			width:100%;
			border:1px solid #999;
			 border-collapse: collapse;
		}
		
		.table tbody tr td{
			border:1px solid #999;
		}
		
		.table thead tr th{
			background-color:#f3f3f3;
			border:1px solid #999;
		}
		
		table{
			font-size:10px;
		}
		
		@media print {
		 .no_print, .no_print *
			{
				display: none !important;
			}
		}
	</style>

</head>
	
	<div id="load_data">
		
	</div>
	
	
	<script src="{{ asset('template/js/jquery-1.11.1.min.js') }}"></script>
	<script>
		$.ajax({
				url:"<?= url('penerimaan/laporan/mahasiswa') ?>",
				type:"POST",
				data:{
					"nim":"<?= $nim ?>",
					"_token":"<?= csrf_token() ?>"
				},
				dataType:"html",
				beforeSend:function(){
					
				},
				success:function(res){
					$("#load_data").html(res);
				}
			});
	</script>
</body>

</html>