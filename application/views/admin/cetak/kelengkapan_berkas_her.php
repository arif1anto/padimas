<!DOCTYPE html>
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
	  	
	  	td,th{padding: 1.5mm 0;}
	  	#tbl2 td{padding-bottom: 1mm;}
		td,th {font-family: Arial, Helvetica, sans-serif; font-size: 12pt; }
		th{padding:2mm 0; text-align:left;border-top:1px solid #000; border-bottom:1px solid #000;}
		.contener{padding:0;padding-top: 10mm;}
		.page{width: 210mm;height: 315mm;margin: auto;padding: 0mm 10mm 10mm 10mm;border: 1px solid #000;margin-bottom: 10mm;}
		hr{border:none;border-top: 1px solid #000;margin-top: 0;}
		.cetak{height: auto;}
		p{font-family: Arial, Helvetica, sans-serif; font-size: 12pt;margin:0;}
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
	    .yayasan{
	    	font-size:16pt;
	    	font-family:"Times New Roman";
	    }
	    .univ{
	    	font-size:20pt;
	    	font-family:"Times New Roman";
	    	font-weight:bold;
	    }
	    .alamat{
	    	font-size:14pt;
	    	font-family:"Times New Roman";
	    }
	</style>

	<?php 
		//from format dd/mm/yyyy
		function formatDate($date=null){
			if ($date!=null) {
				$ex = explode("/", $date);
				$blns = explode("_","_Januari_Februari_Maret_April_Mei_Juni_Juli_Agustus_September_Oktober_November_Desember");
				$mm = $blns[(int)$ex[1]];
				return $ex[0]." ".$mm." ".$ex[2];
			} else {
				return null;
			}
		}

	?>

</head>
<body>
	<?php for ($i=0; $i < 2; $i++) { ?>
	<div class="page">
		<div class="cetak">
			<div class="contener">
				<table style="border-collapse: collapse; ">
					<tr>
						<td style="padding-right: 20px;">
							<img src="<?php echo base_url().index_page() ?>image/logo1.png/75" alt="">
						</td>
						<td>
							<p class="yayasan">[KOP]</p>
							<p class="univ">[SUB KOP]</p>
							<p class="alamat">[Alamat]</p>
						</td>
					</tr>
				</table>
				<hr>
				<h2 align="center">KELENGKAPAN BERKAS HER REGISTRASI</h2>
				<br>
				<p align="right">Tanggal Her : <?php echo formatDate(date('d/m/Y',strtotime($data1->tgl_herregistrasi))); ?></p>
				<br>
				<table style="border-collapse: collapse;">
					<tr>
						<td style="width: 25mm">Nama</td>
						<td style="width: 10mm" align="center">:</td>
						<td style="width: 75mm" colspan="4"><?php echo $data1->nama ?></td>
					</tr>
					<tr>
						<td style="width: 25mm">NIM</td>
						<td style="width: 10mm" align="center">:</td>
						<td style="width: 75mm"><?php echo $data1->nim ?></td>
						<td style="width: 25mm">Prodi</td>
						<td style="width: 10mm" align="center">:</td>
						<td style="width: 40mm"><?php echo $data1->nama_jurusan ?></td>
					</tr>
					<tr>
						<td style="width: 25mm">Fakultas</td>
						<td style="width: 10mm" align="center">:</td>
						<td style="width: 75mm"><?php echo $data1->nama_fakultas ?></td>
						<td style="width: 25mm">Jenjang</td>
						<td style="width: 10mm" align="center">:</td>
						<td style="width: 40mm"><?php echo $data1->nama_jenjang ?></td>
					</tr>
				</table>
				<br>
				<table style="border-collapse: collapse; width: 100%">
					<tr>
						<th>Berkas</th>
						<th align="center">Jumlah Diminta</th>
						<th align="center">Jumlah Terkumpul</th>
						<th>Keterangan</th>
					</tr>
					<?php foreach ($data2 as $row): ?>
					<tr>
						<td style="width: 60mm"><?php echo $row->syarat ?></td>
						<td style="width: 30mm" align="center"><?php echo $row->jum_syarat ?></td>
						<td style="width: 30mm" align="center"><?php echo isset($row->jum)?$row->jum:0; ?></td>
						<td style="width: 30mm"><?php echo $row->jum>=$row->jum_syarat?"Lengkap":"Belum Lengkap"; ?></td>
					</tr>
					<?php endforeach ?>
					<tr>
						<th colspan="4">Ukuran Jas : <?php echo $data1->ukuran_jaz ?></th>
					</tr>
				</table>
				<br><br><br><br>
				<table style="border-collapse: collapse; width: 100%">
					<tr>
						<td style="width: 150mm"></td>
						<td>Yogyakarta, <?php echo formatDate(date('d/m/Y',strtotime($data1->tgl_herregistrasi))); ?></td>
					</tr>
					<tr>
						<td style="width: 150mm">
							Disetujui Oleh,
							<br><br><br><br><br>
							<?php echo $data1->nama ?>
						</td>
						<td>
							Petugas,	
							<br><br><br><br><br>
							<?php echo $data3->aut_display_name ?>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<?php if ($i==0): ?>
		<div style="page-break-after: always;"></div>
		<?php endif ?>
	</div>
		<?php } ?>
	<script type="text/javascript"> 
		window.onload=function(){window.print();} 
	</script> 

</body>
</html>