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
	  	
	  	td{padding-bottom: 2mm;}
	  	#tbl2 td{padding-bottom: 1mm;font-size:9pt; vertical-align:top;}
		td,th {font-family: Arial, Helvetica, sans-serif; font-size: 12pt; }
		.contener{padding:0;padding-top: 12mm;width:120mm;}
		.page{width: 210mm;height: 315mm;margin: auto;padding: 0mm 10mm 10mm 10mm;border: 1px solid #000;margin-bottom:10mm;}
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
	</style>
</head>
<body>
	<div class="page">
	<?php for ($i=0; $i < 2; $i++) { ?>
		<div class="cetak">
			<div class="contener">
				<h1 align="center">BUKTI PENGAMBILAN JAS</h1>
				<br>
				<table style="border-collapse: collapse;">
					<tr>
						<td style="width: 25mm">Nama</td>
						<td style="width: 10mm" align="center">:</td>
						<td style="width: 70mm"><?php echo $data1->nama ?></td>
					</tr>
					<tr>
						<td>NIM</td>
						<td align="center">:</td>
						<td><?php echo $data1->nim ?></td>
					</tr>
					<tr>
						<td>Ukuran Jas</td>
						<td align="center">:</td>
						<td><?php echo $data1->ukuran_jaz ?></td>
					</tr>
				</table>
				<table style="border-collapse: collapse;">
					<tr>
						<td style="width: 80mm"></td>
						<td style="width: 30mm">Yogyakarta,</td>
					</tr>
					<tr>
						<td></td>
						<td>Tanda Tangan</td>
					</tr>
					<tr>
						<td colspan="2"></td>
					</tr>
					<tr style="height:100px">
						<td></td>
						<td style="width: 70mm;font-size:10pt"><?php echo $data1->nama ?></td>
					</tr>
				</table>
				<table id="tbl2">
					<tr>
						<td style="width: 20mm">NB: </td>
						<td colspan="2"></td>
					</tr>
					<?php echo $data2->nb_buktijaz; ?>
				</table>
			</div>
		</div>
	<?php } ?>
	</div>
	<script type="text/javascript"> 
		window.onload=function(){window.print();} 
	</script> 

</body>
</html>