<!doctype html>
<html>
	<head>
		<style>
			*{
				font-size:11px;
			}
		</style>
	</head>
	<body >
	<div style="padding:8px;border-width: 0px;
    border-style: solid;border-image:url(watermark.png)">
	
		

		
		
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td width="50%" align="center">
						KEPOLISIAN NEGARA REPUBLIK INDONESIA
						DAERAH SULAWESI UTARA<br/>
						DIREKTORAT  LALU LINTAS<br/>
						Jln. Bethesda No. 62 Manado<br/>
						<hr/>
					</td>
					<td>&nbsp;</td>
			</tbody>
		</table>
		
		
		<div style="margin:0 auto;border: 1px solid black;width:140px;height:100px;"></div>
		
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td width="100%" align="center">
					
						<h3><u><strong>S U R A T  J A L A N</strong></u></h3>
						
						<p>Nomor : SJ/01/01/Dit Lantas</p>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table width="100%" border="0">	
			<tbody>	
				<tr>
					<td valign="top">Dasar	:	</td>
					<td><ol>
							<li>Undang - Undang No. 2 Tahun 2002 Pasal 13,14,dan Pasal 15 ayat (1) huruf e,f,k, Pasal  16 ayat (1) huruf I tentang Tugas dan Wewenang Polri;
</li><li>Undang – Undang No. 22 Tahun 2009 Pasal 71 ayat (1) huruf d tentang Pelaporan Ranmor yang digunakan di luar wilayah kendaraan diregistrasi;
</li><li>PP No. 44 Tahun 1993 Pasal 172 dan Pasal 183 tentang pelaporan ranmor yang beroperasi kewilayah lain di luar wilayah kendaraan didaftarkan</li></ol>
</td>

			</tbody>
		</table>
		
		<p>
		Diberikan <strong>SURAT JALAN</strong> Kendaraan Bermotor tersebut di bawah ini untuk dipakai diluar Wilayah Hukum <strong>POLDA JAKUT</strong>, adapun identitas kendaraan sebagai berikut :
		</p>
		
		<table width="100%" border="0">
			<tr>
				<td>
					<strong>1.</strong>
				</td>
				<td>
					<strong>Nomor Polisi</strong>
				</td>
				<td>
					<strong>:</strong>
				</td>
				<td>
					<strong>{{ $model->no_pol }}</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>2.</strong>
				</td>
				<td>
					<strong>Jenis Kendaraan</strong>
				</td>
				<td>
					<strong>:</strong>
				</td>
				<td>
					<strong>{{ $model->Kendaraan->kendaraan }}</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>3.</strong>
				</td>
				<td>
					<strong>Merk</strong>
				</td>
				<td>
					<strong>:</strong>
				</td>
				<td>
					<strong>{{ $model->Merk->merk }}</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>4.</strong>
				</td>
				<td>
					<strong>Tahun Pembuatan / CC</strong>
				</td>
				<td>
					<strong>:</strong>
				</td>
				<td>
					<strong>{{ $model->tahuncc }}</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>5.</strong>
				</td>
				<td>
					<strong>Nomor Chasis</strong>
				</td>
				<td>
					<strong>:</strong>
				</td>
				<td>
					<strong>{{ $model->nochasis }}</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>6.</strong>
				</td>
				<td>
					<strong>Nomor Mesin</strong>
				</td>
				<td>
					<strong>:</strong>
				</td>
				<td>
					<strong>{{ $model->nomesin }}</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>7.</strong>
				</td>
				<td>
					<strong>Warna Kendaraan</strong>
				</td>
				<td>
					<strong>:</strong>
				</td>
				<td>
					<strong>{{ $model->warna }}</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>8.</strong>
				</td>
				<td>
					<strong>Daerah Tujuan</strong>
				</td>
				<td>
					<strong>:</strong>
				</td>
				<td>
					<strong>{{ $model->daerah }}</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>9.</strong>
				</td>
				<td>
					<strong>Nama Pemilik</strong>
				</td>
				<td>
					<strong>:</strong>
				</td>
				<td>
					<strong>{{ $model->pemilik }}</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>10.</strong>
				</td>
				<td>
					<strong>Alamat Pemilik</strong>
				</td>
				<td>
					<strong>:</strong>
				</td>
				<td>
					<strong>{{ $model->alamat_pemilik }}</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>11.</strong>
				</td>
				<td>
					<strong>Keperluan</strong>
				</td>
				<td>
					<strong>:</strong>
				</td>
				<td>
					<strong>{{ $model->keperluan }}</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>12.</strong>
				</td>
				<td>
					<strong>Berlaku dari tanggal</strong>
				</td>
				<td>
					<strong>:</strong>
				</td>
				<td>
					<strong>{{ date("d-M-Y", strtotime($model->berlaku)) }}</strong>
				</td>
			</tr>
			<tr>
				<td>
					<strong>13.</strong>
				</td>
				<td>
					<strong>Sampai dengan tanggal</strong>
				</td>
				<td>
					<strong>:</strong>
				</td>
				<td>
					<strong>{{ date("d-M-Y", strtotime($model->sampai)) }}</strong>
				</td>
			</tr>
		</table>
				
		
		
		<p>Demikian <strong>SURAT JALAN</strong> ini diberikan kepada yang bersangkutan untuk dapat dipergunakan sebagaimana mestinya. </p>
		
		<table width="100%" border="0">
			<tr>
				<td width="50%">
				&nbsp;
				</td>
				<td align="center">
				Manado, {{ date("d-M-Y") }}<br/>
a.n. DIREKTUR LALU LINTAS POLDA SULUT<br/>
<strong>KASAT PJR</strong>
</td>
			</tr>
		</table>
		
		
		<table width="100%" border="0">
			<tr>
				<td width="60%">
				<br/><br/>
					<strong><u>Catatan :</u></strong>
					<ol>
						<li>Surat Jalan ini bukan sebagai pengganti STNK.</li>
						<li>Setelah sampai di tujuan, agar segera melapor ke Kepolisian setempat.</li>
					</ol>
				</td>
				<td align="center">
				<br/><br/>
				<strong><u>SYAMSURI ANANG, S.Sos.</u></strong><br/>
AKBP NRP 64060070

</td>
			</tr>
		</table>
		
		</div>
	</body>
</html>	