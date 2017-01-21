<?php

use App\Prodi;
use App\JurnalPenerimaan;
use App\KodeRekening;

$no = 1;

$total_saldo = 0;

$total_biaya_seharusnya = 0;
$saldo_smt = array();
$jumlah_utang = array();

$mhs = JurnalPenerimaan::where('nim_mhs',$nim)->first();

?>

	<table>
		<tr>
			<td>Nama</td>
			<td>: {{ $mhs->nama_mhs }}</td>
		</tr>
		<tr>
			<td>NIM</td>
			<td>: {{ $nim }}</td>
		</tr>
		<tr>
			<td>Prodi</td>
			<td>: {{ $mhs->dataProdi->nama_prodi }}</td>
		</tr>
	</table>


	<table class="table">
		<thead>
			<tr>
				<th style="width:20px;text-align:center">NO</th>
				<th style="text-align:center">JENIS PEMBAYARAN</th>
				<th style="text-align:center">JUMLAH</th>
				@for($i = 1; $i <= 8; $i++)
				<th colspan="2">SEMESTER {{ $i }}</th>
				@endfor
				<th>TOTAL</th>
			</tr>
		</thead>
		<tbody>
		
		@foreach($data as $r)
			<?php
			$nama_rek = KodeRekening::find($r->rekening);
			$total_setoran_row = 0;
			?>
			<tr>
				<td>{{ $no }}</td>
				<td>{{ $nama_rek->nama_rekening }}</td>
				<td align="right">{{ rupiah($nama_rek->biaya) }} <?php $total_biaya_seharusnya += $nama_rek->biaya; ?></td>
				@for($i = 1; $i <= 8; $i++)
				<?php
				$items = DB::table('penerimaan')
								->where('kode_rekening','=',$r->rekening)
								->where('semester',$i)
								->where('nim_mhs',$nim)
								->get();
				$total_setoran_day = 0;
				$total_utang_day = 0;
				?>
				<td align="right" style="background-color:#00aa00;color:#fff;">
					@foreach($items as $item)
					 <?php $total_setoran_day += $item->setoran; $saldo_smt[] = array("semester" => $i,"kode_rekening" => $r->rekening, "setoran" => $item->setoran);?>
					@endforeach
					@if($total_setoran_day != 0){{ rupiah($total_setoran_day) }}@endif
				</td>
				<td align="right" style="background-color:#ff0000;color:#fff;">
				{{ rupiah($nama_rek->biaya -  $total_setoran_day)}}
				<?php
					$total_utang_day += ($nama_rek->biaya -  $total_setoran_day);
					$jumlah_utang[] = array("semester" => $i,"kode_rekening" => $r->rekening, "utang" => $total_utang_day);
				?>
				</td>
				<?php $total_setoran_row += $total_setoran_day; ?>
				@endfor
				<td align="right">
				{{ rupiah($total_setoran_row) }}
				</td>
			</tr>
			<?php $total_saldo += $total_setoran_row; $no++; ?>
		@endforeach
		
			<tr>
				<td></td>
				<td>JUMLAH</td>
				<td align="right"><b>{{ rupiah($total_biaya_seharusnya) }}</b></td>
				@for($i = 1; $i <= 8; $i++)
					<?php
					$saldo_col = 0;
					?>
					<td align="right" style="background-color:#007700;color:#fff;">
						<?php
						$setoran_col = 0;
						foreach($saldo_smt as $s){
							if($s['semester'] == $i){
								$setoran_col += $s['setoran'];
							}
						}
						?>
						@if($setoran_col != 0) <b>{{ rupiah($setoran_col) }}</b> @endif
					</td>
					<td align="right" style="background-color:#aa0000;color:#fff;">
						<?php
						$utang_col = 0;
						foreach($jumlah_utang as $s){
							if($s['semester'] == $i){
								$utang_col += $s['utang'];
							}
						}
						?>
						@if($utang_col != 0) <b>{{ rupiah($utang_col) }}</b> @endif
					</td>
				@endfor
				<td align="right"><b>{{ rupiah($total_saldo) }}</b></td>
			</tr>
			
		</tbody>
	</table>
	
	@include('_ttd')
	
	