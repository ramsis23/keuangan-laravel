<table style="width:100%;margin-top:20px;">
		<tr>
			<td colspan="2" align="right">Palopo, {{ format_indo(date("Y-m-d")) }}</td>
		</tr>
		<tr>
			<td colspan="2" align="center">Mengetahui,</td>
		</tr>
		<?php
		$ketua_adm = DB::table('tanda_tangan')->where('id_ttd',2)->get();
		$bend_peng = DB::table('tanda_tangan')->where('id_ttd',1)->get();
		$ketua = DB::table('tanda_tangan')->where('id_ttd',3)->get();
		?>
		<tr>
			<td style="height:60px" align="center" valign="top">
				@foreach($ketua_adm as $r)
				{{ $r->jabatan }}
				@endforeach
			</td>
			<td align="center" valign="top">
				@foreach($bend_peng as $r)
				{{ $r->jabatan }}
				@endforeach
			</td>
		</tr>
		<tr>
			<td align="center" valign="top">
				@foreach($ketua_adm as $r)
				{{ $r->nama }}
				@endforeach
			</td>
			<td align="center" valign="top">
				@foreach($bend_peng as $r)
				{{ $r->nama }}
				@endforeach
			</td>
		</tr>
		<tr>
			<td align="center" valign="top" colspan="2">
				@foreach($ketua as $r)
				{{ $r->jabatan }}
				<br>
				<br>
				<br>
				<br>
				<br>
				{{ $r->nama }}
				@endforeach
			</td>
		</tr>
	
	</table>