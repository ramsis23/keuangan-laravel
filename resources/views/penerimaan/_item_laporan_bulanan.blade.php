<?php

use App\Prodi;
use App\JurnalPenerimaan;
use App\KodeRekening;

$no = 1;

$total_saldo = 0;

$saldo_tgl = array();

?>


	<table class="table">
		<thead>
			<tr>
				<th style="text-align:center" colspan="{{ $maxDay+3 }}">REKAPITULASI PENERIMAAN KAS BULAN {{ strtoupper(bulanTahun($tanggal)) }}</th>
			</tr>
			<tr>
				<th rowspan="2" style="width:20px;text-align:center">NO</th>
				<th rowspan="2" style="text-align:center">JENIS PEMBAYARAN</th>
				<th style="text-align:center" colspan="{{ $maxDay }}">{{ $tanggal }}</th>
				<th rowspan="2">TOTAL</th>
			</tr>
			<tr>
				@for($i = 1; $i <= $maxDay; $i++)
				<th>{{ $i }}</th>
				@endfor
			</tr>
		</thead>
		<tbody>
		@foreach($data as $r)
			<?php
			$nama_rek = KodeRekening::find($r->kode_rekening);
			$total_setoran_row = 0;
			?>
			<tr>
				<td>{{ $no }}</td>
				<td>{{ $nama_rek->nama_rekening }}</td>
				@for($i = 1; $i <= $maxDay; $i++)
				<?php
				$hari = date("d",strtotime($tanggal.'-'.$i));
				$month = date("m",strtotime($tanggal));
				$year = date("Y",strtotime($tanggal));
				$items = DB::table('penerimaan')
								->where('kode_rekening','=',$r->kode_rekening)
								->whereRaw('extract(day from tanggal) = ?', [$hari])
								->whereRaw('extract(month from tanggal) = ?', [$month])
								->whereRaw('extract(year from tanggal) = ?', [$year])
								->get();
				$total_setoran_day = 0;
				?>
				<td align="right">
					@foreach($items as $item)
					 <?php $total_setoran_day += $item->setoran; $saldo_tgl[] = array("hari" => $i,"kode_rekening" => $r->kode_rekening, "setoran" => $item->setoran);?>
					@endforeach
					@if($total_setoran_day != 0){{ rupiah($total_setoran_day) }}@endif
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
				<td><b>JUMLAH</b></td>
				@for($i = 1; $i <= $maxDay; $i++)
					<?php
					$saldo_col = 0;
					?>
					<td align="right">
						<?php
						$setoran_col = 0;
						foreach($saldo_tgl as $s){
							if($s['hari'] == $i){
								$setoran_col += $s['setoran'];
							}
						}
						?>
						@if($setoran_col != 0) <b>{{ rupiah($setoran_col) }}</b> @endif
					</td>
				@endfor
				<td align="right"><b>{{ rupiah($total_saldo) }}</b></td>
			</tr>
			
		</tbody>
	</table>
	
	@include('_ttd')