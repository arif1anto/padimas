<html>
<head>
<link href="<?php echo base_url()?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
	body{
		margin-top:-20px;
	}
	.tinggi {
		line-height:0.9;
	}
	td img{
			padding:5px;
		}
	.alamat {
	  font-family: Arial, Helvetica, sans-serif;
	  font-size: 10px;
	}
	.hang{
		margin-left: 63px;
	}
	.univ {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 16px; }
	.fakultas {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 16px; }
	.label {font-family: Arial, Helvetica, sans-serif; font-size: 12px;line-height:1; }
	.printbreak {
	page-break-before: always;
	}
</style>
</head>

<body>
<div class="row">
    <div style="margin-bottom:30px">
        <table width="100%" style="border-collapse: collapse;" >
			<tr>
			<td align="center" style="border-bottom:1px solid #000000;">
			<img src="<?php echo base_url().'img/logo.png';?>" width="70" height="70"></td>
			<td colspan="2" style="border-bottom:1px solid #000000;">
			<p class="tinggi"><span class="univ">UNIVERSITAS TEKNOLOGI YOGYAKARTA</span><br>  
			   <span class="alamat">Kampus 1 : Jl. Ringroad Utara, Jombor, Sleman - Yogyakarta. D.I. 55285, Telp. (0274) 623310 Fax. (0274) 623306, </span><br/>
			   <span class="alamat">Kampus 2 : Jl.  Glagah Sari No. 63 Yogyakarta - Yogyakarta. D.I. 55164, Telp. (0274) 373995, Fax. (0274) 381212,</span><br/>
			   <span class="alamat">Kampus 3 : Jl. Prof. Dr. Soepomo, SH. No. 21, Janturan, Yogyakarta. D.I. 55165, Telp. (0274) 379204 Fax. (0274) 415801</span><br/>
			   <span class="alamat">Email: info@uty.ac.id Hompage : www.uty.ac.id</span><br/>
			   </p>
			</td>
			
			</tr>
		  <tr>
			<td align="center" class="univ" colspan="3" style="line-height:2">BUKTI <?php echo strtoupper($data1[0]->prg_judul) ?> </td>
		  </tr>
		  <tr>
			<td colspan="2"><span class="label">No. Pendaftaran </span></td>
			<td><span class="label">:&nbsp;<strong><?php echo isset($dt->iddaftar) ? $dt->iddaftar : ""?></strong></span></td>
		  </tr>
		  <tr>
			<td colspan="2"><span class="label">Nama</span></td>
			<td><span class="label">:&nbsp;<strong><?php echo isset($dt->nama) ? strtoupper($dt->nama) : "" ?></strong></span></td>
			
		  </tr>
		  <tr>
			<td colspan="2"><span class="label">Program Studi 1</span></td>
			<td ><span class="label">:&nbsp;<strong><?php echo isset($dt->prodi1) ? strtoupper($dt->prodi1) : "" ?></strong> </span></td>
		  </tr>
		  <tr>
			<td colspan="2"><span class="label">Program Studi 2</span></td>
			<td ><span class="label">:&nbsp;<strong><?php echo isset($dt->prodi1) ? strtoupper($dt->prodi2) : "" ?></strong> </span></td>
		  </tr>		  		  <tr>			<td colspan="2"><span class="label">PIN</span></td>			<td ><span class="label">:&nbsp;<strong><?php echo isset($dt->pin) ? strtoupper($dt->pin) : "" ?></strong> </span></td>		  </tr>
		  <tr>
			<td width="5%"></td><td width="10%"></td><td></td>
		  </tr>
		</table>
    </div>

    <div style="font-size:9pt !important;">
        <?php echo $data1[0]->prg_deskripsi; ?>
    </div>
</div>	
</body>
</html>