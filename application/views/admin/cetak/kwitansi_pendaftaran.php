<!DOCTYPE html>
<html>
<head>
	<title>Kwitansi Pendaftaran</title>

	<style type="text/css">
		@page {
	        margin: 15mm 15mm 15mm 15mm;
	        width: 210mm;
	        height: 350mm;
	    }
	    body { font-size: 10pt }

	    .border{
	    	border: 1px solid #000;
	    	padding: 1.5mm;
	    }
	  	
	  	td{padding-bottom: 1mm;}
		.label {font-family: Arial, Helvetica, sans-serif; font-size: 11pt; }
		.contener{padding-left: 7mm; padding-right: 7mm;}
		.page{width: 210mm;height: 350mm;margin: auto;padding: 15mm 15mm 15mm 15mm;border: 1px solid #000;}
		hr{border:none;border-top: 1px solid #000;margin-top: 0;}
		.cetak{height: 90mm;}
		p{font-family: Arial, Helvetica, sans-serif; font-size: 10pt;margin:0; margin-bottom: 7mm;}
		@media print {
	    	html {
				width: 210mm;
				height: 350mm;        
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
		<?php for ($i=0; $i < 4; $i++) { ?>
		<div class="cetak">
			<p align="right"><?php echo date("d/m/Y h:i:s A"); ?></p>
			<div class="contener">
				<hr>
				<table style="border-collapse: collapse;">
					<tr>
					<td style="width:3.5mm"><span class="label"></span></td>
					<td style="width:6mm"><span class="label"></span></td>
					<td style="width:34mm"><span class="label"></span></td>
					<td style="width:6mm"><span class="label"></span></td>
					<td style="width:10mm"><span class="label"></span></td>
					<td style="width:5mm"><span class="label"></span></td>
					<td style="width:34mm"><span class="label"></span></td>
					<td style="width:38mm"><span class="label"></span></td>
					<td style="width:15mm"><span class="label"></span></td>
					<td style="width:6mm"><span class="label"></span></td>
					<td style="width:32mm"><span class="label"></span></td>
					</tr>
					<tr>
						<td><span class="label"></span></td>
						<td colspan="4"><span class="label">Telah diterima uang sebanyak</span></td>
						<td><span class="label">:</span></td>
						<td><span class="label">Rp. <?php echo number_format($data1->bayar_pendaftaran,2,'.',','); ?></span></td>
						<td colspan="4"><span class="label">guna membayar biaya pendaftaran PMB</span></td>
					</tr>
					<tr>
						<td colspan="2"><span class="label"></span></td>
						<td><span class="label">Atas nama</span></td>
						<td><span class="label">:</span></td>
						<td colspan="4"><span class="label" style="font-size: 13pt"><strong><i><?php echo $data1->nama ?></i></strong></span></td>
						<td><span class="label">PIN</span></td>
						<td><span class="label">:</span></td>
						<td><span class="label"><?php echo $data1->pin ?></span></td>
					</tr>
					<tr>
						<td colspan="2"><span class="label"></span></td>
						<td><span class="label">No. Pendaftaran</span></td>
						<td><span class="label">:</span></td>
						<td colspan="4"><span class="label"><strong><?php echo $data1->id_daftar ?></strong></span></td>
						<td colspan="3"><span class="label">Yogyakarta, <?php echo date("d F Y") ?></span></td>
					</tr>
					<tr>
						<td><span class="label"></span></td>
						<td colspan="7"><span class="label">Pendaftar,</span></td>
						<td colspan="3"><span class="label">Petugas,</span></td>
					</tr>
					<tr>
						<td colspan="11"><span class="label">&nbsp;<br>&nbsp;</span></td>
					</tr>
					<tr>
						<td ><span class="label"></span></td>
						<td colspan="5"><span class="label"><?php echo $data1->nama ?></span></td>
						<td colspan="2"><span class="label"></span></td>
						<td colspan="3"><span class="label"><?php echo $data2->aut_display_name ?></span></td>
					</tr>
					<tr>
						<td ><span class="label"></span></td>
						<td colspan="5" class="border">
							<span class="label">
								Pendaftar telah menerima:<br>
								- Brosur<br>
								- Panduan Masuk<br>
							</span>
						</td>
						<td colspan="5"><span class="label"></span></td>
					</tr>
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