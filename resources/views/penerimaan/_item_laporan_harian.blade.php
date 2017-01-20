<?php

use App\Prodi;
use App\JurnalPenerimaan;
use App\KodeRekening;

$no = 1;

$total_saldo = 0;
?>


	<table class="table">
		<thead>
			<tr>
				<th colspan="6" style="text-align:center">Laporan Harian Penerimaan Kas STKIP Muhammadiyah Palopo</th>
			</tr>
			<tr>
				<th colspan="6" style="text-align:center">{{ format_indo($tanggal) }}</th>
			</tr>
			<tr>
				<th style="width:50px;text-align:center">No</th>
				<th style="text-align:center">No Bukti</th>
				<th style="text-align:center">Nama Mahasiswa</th>
				<th style="text-align:center">Jenis Pembayaran</th>
				<th style="text-align:center">Debet</th>
				<th style="text-align:center">Saldo</th>
			</tr>
		</thead>
		<tbody>
		@foreach($data as $r)
			<?php
			$count_j2 = JurnalPenerimaan::where('tanggal',$r->tanggal)->where('nim_mhs',$r->nim_mhs)->count();
			$total_bayar = 0;
			?>
			<tr>
				<td rowspan="<?= $count_j2+2; ?>">{{ $no }}.</td>
				<td rowspan="<?= $count_j2+2; ?>"></td>
				<td rowspan="<?= $count_j2+2; ?>">
					{{ $r->nama_mhs }}<br><br>
					{{ $r->nim_mhs }}<br><br>
					<?php
					$prodi = Prodi::find($r->prodi);
					?>
					{{ $prodi->nama_prodi }}
				</td>
				<td>
					<?php
					$jurnal1 = JurnalPenerimaan::where('tanggal',$r->tanggal)->where('nim_mhs',$r->nim_mhs)->take(1)->get();
					?>
					@foreach($jurnal1 as $j1)
					{{ $j1->jenisPembayaran->nama_rekening }}
					@endforeach
				</td>
				<td align="right">
					@foreach($jurnal1 as $j1)
					{{ rupiah($j1->setoran) }}
					<?php
					$total_bayar += $j1->setoran;
					?>
					@endforeach
				</td>
				<td align="right"></td>
			</tr>
			
			<?php
			$jurnal2 = JurnalPenerimaan::where('tanggal',$r->tanggal)->where('nim_mhs',$r->nim_mhs)->skip(1)->take($count_j2 - 1)->get();
			?>
			@foreach($jurnal2 as $j2)	
			<tr>
				<td>{{ $j2->jenisPembayaran->nama_rekening }}</td>
				<td align="right">{{ rupiah($j2->setoran) }}</td>
				<td align="right"></td>
			</tr>
			<?php
			$total_bayar += $j2->setoran;
			?>
			@endforeach
			
			<tr>
				<td></td>
				<td align="right"><b>{{ rupiah($total_bayar) }}</b></td>
				<td align="right"></td>
			</tr>
			
			<tr>
				<td></td>
				<td align="right"></td>
				<td align="right"><b>{{ rupiah($total_bayar) }}</b></td>
			</tr>
				
			<?php
			$total_saldo += $total_bayar;
			$no++;
			?>
		@endforeach
			
			<tr>
				<td colspan="5" align="center"><b>Jumlah</b></td>
				<td align="right"><b>{{ rupiah($total_saldo) }}</b></td>
			</tr>
			
		</tbody>
	</table>
	
	@include('_ttd')