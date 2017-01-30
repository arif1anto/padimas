<!DOCTYPE html>
<?php
function tanggal($date=null,$param=null){
	if($date!=null) :
		$yr=date('Y',strtotime($date));
		$mo=date('m',strtotime($date));
		$d=date('d',strtotime($date));
		$day=date('N',strtotime($date));
		
		$bln='';$hr='';$blr='';
		switch($mo){
			case '01' : $bln="Januari" ;	$blr="I";		break;
			case '02' : $bln="Februari" ;	$blr="II";		break;
			case '03' : $bln="Maret" ;		$blr="III";		break;
			case '04' : $bln="April" ;		$blr="IV";		break;
			case '05' : $bln="Mei" ;		$blr="V";		break;
			case '06' : $bln="Juni" ;		$blr="VI";		break;
			case '07' : $bln="Juli" ;		$blr="VII";		break;
			case '08' : $bln="Agustus" ;	$blr="VIII";	break;
			case '09' : $bln="September";	$blr="IX";		break;
			case '10' : $bln="Oktober" ;	$blr="X";		break;
			case '11' : $bln="November" ;	$blr="XI";		break;
			case '12' : $bln="Desember" ;	$blr="XII";		break;
		}
		
		switch($day){
			case 1 : $hr="Senin" ;break;
			case 2 : $hr="Selasa" ;break;
			case 3 : $hr="Rabu" ;break;
			case 4 : $hr="Kamis" ;break;
			case 5 ; $hr="Jum'at" ;break;
			case 6 ; $hr="Sabtu" ;break;
			case 7 ; $hr="Minggu" ;break;
			
		}
		switch($param){
			case "hr" 	: return $hr.', '.$d.' '.$bln.' '.$yr;break;
			case "dd" 	: return $d.' '.$bln.' '.$yr;break;
			case "bl" 	: return $bln.' '.$yr;break;
			case "blrmw": return $blr;break;
			default	: break;
			
		}
	endif;
}
?>
<html>
<head>
	<title>Kartu Tanda Peserta Ujian</title>

	<style type="text/css">
		@page {
	        margin: 0mm 10mm 0mm 10mm;
	        width: 210mm;
	        height: 290mm;
	    }
	    body { font-size: 10pt }

	    .border{
	    	border: 1px solid #000;
	    	padding: 1.5mm;
	    }
	  	
	  	td{padding-bottom: 3mm;}
	  	#tbl2 td{padding-bottom: 1mm;}
		.label {font-family: Arial, Helvetica, sans-serif; font-size: 12pt; }
		.contener{padding:0;padding-top: 25mm;}
		.page{width: 210mm;height: 315mm;margin: auto;padding: 0mm 10mm 10mm 10mm;border: 1px solid #000;}
		hr{border:none;border-top: 1px solid #000;margin-top: 0;}
		.cetak{height: 160mm;}
		p{font-family: Arial, Helvetica, sans-serif; font-size: 12pt;margin:0;}
		.cetak1>td{padding-bottom: 1mm;}
		.label1 {font-family: Arial, Helvetica, sans-serif; font-size: 11pt; }
		.contener1{padding-left: 7mm; padding-right: 7mm;}
		.page1{width: 210mm;height: 350mm;margin: auto;padding: 15mm 15mm 15mm 15mm;border: 1px solid #000;}
		.cetak1>hr{border:none;border-top: 1px solid #000;margin-top: 0;}
		.cetak1{height: 90mm;}
		.cetak1>p{font-family: Arial, Helvetica, sans-serif; font-size: 10pt;margin:0; margin-bottom: 7mm;}
		@media print {
	    	html {
				width: 210mm;
				height: 290mm;        
	      	}
	      	.page{
				width: 100%;
		        height: auto;
		        margin: 0;
		        padding: 0 ;
		        border: none ;
			}
	    }
	</style>
</head>
<body>
	<div class="page">
		<?php for ($i=0; $i < 2; $i++) { ?>
		<div class="cetak">
			<div class="contener">
				<p align="right">Tahun Akademik : <?php echo date("Y")."/".(date("Y")+1); ?></p>
				<hr>
				<table style="border-collapse: collapse;">
					<tr>
					<td style="width:35mm"><span class="label"></span></td>
					<td style="width:4mm"><span class="label"></span></td>
					<td style="width:10mm"><span class="label"></span></td>
					<td style="width:88mm"><span class="label"></span></td>
					<td style="width:20mm"><span class="label"></span></td>
					<td style="width:6mm"><span class="label"></span></td>
					<td style="width:30mm"><span class="label"></span></td>
					<td style="width:18mm"><span class="label"></span></td>
					</tr>
					<tr>
						<td colspan="8" align="center"><span class="label" style="font-size: 14pt;">KARTU TANDA PESERTA UJIAN SELEKSI PMB</span></td>
					</tr>
					<tr>
						<td colspan="4"></td>
						<td colspan="4" align="center"><span class="label" style="font-size: 13pt;">GELOMBANG : <?php echo isset($data2->gel) ? $data2->gel :'' ?></span></td>
					</tr>
					<tr>
						<td><span class="label">No. Pendaftaran</span></td>
						<td><span class="label">:</span></td>
						<td colspan="2"><span class="label"><strong><?php echo isset($data1->id_daftar) ? $data1->id_daftar : ''?></strong></span></td>
						<td colspan="4" rowspan="6" style="vertical-align: top;">
							<table id="tbl2">
								<tr>
								<td style="width:20mm"><span class="label"></span></td>
								<td style="width:4mm"><span class="label"></span></td>
								<td style="width:32mm"><span class="label"></span></td>
								<td style="width:30mm"><span class="label"></span></td>
								</tr>
								<tr>
									<td colspan="4"><span class="label">UJIAN TULIS</span></td>
								</tr>
								<tr>
									<td><span class="label">Tempat</span></td>
									<td><span class="label">:</span></td>
									<td colspan="2"><span class="label">Fak. Teknik</span></td>
								</tr>
								<tr>
									<td><span class="label">Ruang</span></td>
									<td><span class="label">:</span></td>
									<td colspan="2"><span class="label">R1</span></td>
								</tr>
								<tr>
									<td><span class="label">Tanggal</span></td>
									<td><span class="label">:</span></td>
									<td colspan="2"><span class="label"><?php echo isset($data1->tgl_tes) ? tanggal($data1->tgl_tes,"dd") : ''?></span></td>
								</tr>
								<tr><td colspan="4">&nbsp;</td></tr>
								<tr>
									<td colspan="4"><span class="label">WAWANCARA</span></td>
								</tr>
								<tr>
									<td><span class="label">Ruang</span></td>
									<td><span class="label">:</span></td>
									<td colspan="2"><span class="label">R1</span></td>
								</tr>
								<tr>
									<td><span class="label">Tanggal</span></td>
									<td><span class="label">:</span></td>
									<td colspan="2"><span class="label"><?php echo isset($data1->tgl_tes) ? tanggal($data1->tgl_tes,"dd") : ''?></span></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><span class="label">PIN</span></td>
						<td><span class="label">:</span></td>
						<td colspan="2"><span class="label"><strong><?php echo isset($data1->pin) ? $data1->pin : ''?></strong></span></td>
					</tr>
					<tr>
						<td><span class="label">Nama</span></td>
						<td><span class="label">:</span></td>
						<td colspan="2"><span class="label"><?php echo isset($data1->nama) ? $data1->nama : ''?></span></td>
					</tr>
					<tr>
						<td><span class="label">Pilihan 1</span></td>
						<td><span class="label">:</span></td>
						<td colspan="2"><span class="label"><?php echo isset($data1->nama) ? $data1->prodi1 : ''?></span></td>
					</tr>
					<?php $jml = (isset($data1->jml_pilihan) ? $data1->jml_pilihan : 1); if($jml>=2){?>
					<tr>
						<td><span class="label">Pilihan 2</span></td>
						<td><span class="label">:</span></td>
						<td colspan="2"><span class="label"><?php echo isset($data1->nama) ? $data1->prodi2 : ''?></span></td>
					</tr>
					<?php } ?>
					<tr>
						<td><span class="label">Alamat</span></td>
						<td><span class="label">:</span></td>
						<td colspan="2"><span class="label"><?php echo isset($data1->alamat_asal) ? $data1->alamat_asal : ''?></span></td>
					</tr>
					<tr>
						<td><span class="label">No HP</span></td>
						<td><span class="label">:</span></td>
						<td colspan="2"><span class="label"><?php echo isset($data1->telp) ? $data1->telp : ''?></span></td>
					</tr>
					<tr>
						<td></td>
						<td colspan="7"></td>
					</tr>
					<tr>
						<td>
							<table>
								<tr>
									<td style="border:1px solid #000; padding: 1mm 5mm;" align="center"><span class="label">&nbsp;<br>Photo<br>3x4<br><br></span></td>
								</tr>
							</table>
						</td>
						<td colspan="2"></td>
						<td><span class="label">YOGYAKARTA, <?php echo tanggal(date("d-m-Y"),"dd") ?><br>Petugas,<br><br><br><br><?php echo $data3->aut_display_name ?></span></td>
						<td colspan="3" >
							<table width="100%" style="border:1px solid #000;">
								<tr>
									<td align="center" style="border:1px solid #000;padding: 2mm; width: 50%;"><span class="label">U. Tulis</span></td>
									<td align="center" style="border:1px solid #000;padding: 2mm; width: 50%;"><span class="label">Wawancara</span></td>
								</tr>
								<tr>
									<td style="border:1px solid #000;"><br><br><br></td>
									<td style="border:1px solid #000;"><br><br><br></td>
								</tr>
							</table>
						</td>
						<td></td>
					</tr>
				</table>
				<hr>
				<p><i>Pengumuman hasil ujian tanggal : </i><strong><?php echo date("Y")."/".(date("Y")+1); ?></strong></p>
			</div>
		</div>
		<?php } ?>
	</div>
	<script type="text/javascript"> 
		window.onload=function(){window.print();} 
	</script> 

</body>
</html>