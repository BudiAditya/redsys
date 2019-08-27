<!doctype html>
<html>
	<head>
		<style>
			*{
				font-size:11px;
			}
			body{
				font-family: 'Arial';
				font-size: '11px';
			}
		</style>
	</head>
	<body >
	
		
	
	<div style="padding:8px;">
	
		
		
		
		
		
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td width="100%" align="center">
					
						<h3><u><strong></strong></u></h3>
						
						<p></p>
					</td>
				</tr>
			</tbody>
		</table>
		
		
		
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		@php
			setlocale(LC_ALL,'id_ID.utf8');
			$awal = date_create($model->awal);
			$ahir = date_create($model->ahir);
			$interval = date_diff($awal,$ahir);
			function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
		@endphp
		<table>
			<tr><td width="500px"></td><td >{{$interval->format('%m')}} ({{terbilang($interval->format('%m'))}})</td></tr>
			<tr><td width="500px"></td><td>{{ strftime('%e %B %Y',strtotime($model->ahir)) }}</td></tr>
		</table>
		
		<br/>
		<br/>
		
		<table width="100%" border="0">
			<tr>
				<td width="100px"></td>
				<td></td>
				<td></td>
				<td><strong style="text-transform:uppercase;">{{ $model->no_pol }}</strong></td>
			</tr>
			<tr>
				<td width="100px"></td>
				<td></td>
				<td></td>
				<td><strong style="text-transform:uppercase;">{{ $model->Kendaraan->name }}</strong></td>
			</tr>
			<tr>
				<td width="100px"></td>
				<td></td>
				<td></td>
				<td><strong style="text-transform:uppercase;">{{ $model->Merek->name }}</strong></td>
			</tr>
			<tr>
				<td width="100px"></td>
				<td></td>
				<td></td>
				<td><strong style="text-transform:uppercase;">{{ $model->tahuncc }}</strong></td>
			</tr>
			<tr>
				<td width="100px"></td>
				<td></td>
				<td></td>
				<td><strong style="text-transform:uppercase;">{{ $model->nochasis }}</strong></td>
			</tr>
			<tr>
				<td width="100px"></td>
				<td></td>
				<td></td>
				<td><strong style="text-transform:uppercase;">{{ $model->nomesin }}</strong></td>
			</tr>
			<tr>
				<td width="100px"></td>
				<td></td>
				<td></td>
				<td><strong style="text-transform:uppercase;">{{ $model->warna }}</strong></td>
			</tr>
			<tr>
				<td width="100px"></td>
				<td></td>
				<td></td>
				<td><strong style="text-transform:uppercase;">{{ $model->pemilik }}</strong></td>
			</tr>
			<tr>
				<td width="100px"></td>
				<td></td>
				<td></td>
				<td><strong style="text-transform:uppercase;">{{ $model->alamat_pemilik }}</strong></td>
			</tr>
			<tr>
				<td width="100px"></td>
				<td></td>
				<td></td>
				<td><strong style="text-transform:uppercase;">{{ $model->pemakai }}</strong></td>
			</tr>
			<tr>
				<td width="100px"></td>
				<td></td>
				<td></td>
				<td><strong style="text-transform:uppercase;">{{ $model->alamat_pemakai }}</strong></td>
			</tr>
		</table>
		
		<br/>
		<br/>
		
		<table>
			<tr><td >{{ $model->catatan }}</td><td width="500px"></td><td >MANADO</td></tr>
			<tr><td ></td><td width="500px"></td><td>{{ strftime('%e %B %Y',strtotime($model->awal)) }}</td></tr>
		</table>
				
		
		
		
		<table width="100%" border="0">
			<tr>
				<td width="50%">
				&nbsp;
				</td>
				<td align="center">
				
</td>
			</tr>
		</table>
		
		
		<table width="100%" border="0">
			<tr>
				<td width="60%">
				<br/><br/>
					<strong><u></u></strong>
					<ol>
						
					</ol>
				</td>
				<td align="center">
				<br/><br/>
				<strong><u></u></strong><br/>


</td>
			</tr>
		</table>
		
		</div>
		
		
	</body>
</html>	