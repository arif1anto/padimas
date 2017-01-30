<html>
<head>
<link href="<?php echo base_url()?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
	body{ 
		margin:0 auto;
		width: 210mm;
		height: 270mm;    
	}
	.btn {
		  display: inline-block;
		  margin-bottom: 0;
		  font-weight: normal;
		  text-align: center;
		  vertical-align: middle;
		  -ms-touch-action: manipulation;
			  touch-action: manipulation;
		  cursor: pointer;
		  background-image: none;
		  border: 1px solid transparent;
		  white-space: nowrap;
		  padding: 5px 10px;
		  font-size: 15px;
		  line-height: 1.42857143;
		  border-radius: 0;
		  -webkit-user-select: none;
		  -moz-user-select: none;
		  -ms-user-select: none;
		  user-select: none;
		  text-decoration: none;
		}
		.btn:focus,
		.btn:active:focus,
		.btn.active:focus,
		.btn.focus,
		.btn:active.focus,
		.btn.active.focus {
		  outline: thin dotted;
		  outline: 5px auto -webkit-focus-ring-color;
		  outline-offset: -2px;
		}
		.btn:hover,
		.btn:focus,
		.btn.focus {
		  color: #ffffff;
		  text-decoration: none;
		}
		.btn:active,
		.btn.active {
		  outline: 0;
		  background-image: none;
		  -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
		  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
		}
		.btn.disabled,
		.btn[disabled],
		fieldset[disabled] .btn {
		  cursor: not-allowed;
		  pointer-events: none;
		  opacity: 0.65;
		  filter: alpha(opacity=65);
		  -webkit-box-shadow: none;
		  box-shadow: none;
		}
		.btn-primary {
		  color: #ffffff;
		  background-color: #2780e3;
		  border-color: #2780e3;
		}
		.btn-primary:hover,
		.btn-primary:focus,
		.btn-primary.focus,
		.btn-primary:active,
		.btn-primary.active,
		.open > .dropdown-toggle.btn-primary {
		  color: #ffffff;
		  background-color: #1967be;
		  border-color: #1862b5;
		}
		.btn-primary:active,
		.btn-primary.active,
		.open > .dropdown-toggle.btn-primary {
		  background-image: none;
		}
		.btn-primary.disabled,
		.btn-primary[disabled],
		fieldset[disabled] .btn-primary,
		.btn-primary.disabled:hover,
		.btn-primary[disabled]:hover,
		fieldset[disabled] .btn-primary:hover,
		.btn-primary.disabled:focus,
		.btn-primary[disabled]:focus,
		fieldset[disabled] .btn-primary:focus,
		.btn-primary.disabled.focus,
		.btn-primary[disabled].focus,
		fieldset[disabled] .btn-primary.focus,
		.btn-primary.disabled:active,
		.btn-primary[disabled]:active,
		fieldset[disabled] .btn-primary:active,
		.btn-primary.disabled.active,
		.btn-primary[disabled].active,
		fieldset[disabled] .btn-primary.active {
		  background-color: #2780e3;
		  border-color: #2780e3;
		}
		.btn-primary .badge {
		  color: #2780e3;
		  background-color: #ffffff;
		}
		.btn-danger {
		  color: #ffffff;
		  background-color: #ff4136;
		  border-color: #ff0039;
		}
		.btn-danger:hover,
		.btn-danger:focus,
		.btn-danger.focus,
		.btn-danger:active,
		.btn-danger.active,
		.open > .dropdown-toggle.btn-danger {
		  color: #ffffff;
		  background-color: #cc002e;
		  border-color: #c2002b;
		}
		.btn-danger:active,
		.btn-danger.active,
		.open > .dropdown-toggle.btn-danger {
		  background-image: none;
		}
		.btn-danger.disabled,
		.btn-danger[disabled],
		fieldset[disabled] .btn-danger,
		.btn-danger.disabled:hover,
		.btn-danger[disabled]:hover,
		fieldset[disabled] .btn-danger:hover,
		.btn-danger.disabled:focus,
		.btn-danger[disabled]:focus,
		fieldset[disabled] .btn-danger:focus,
		.btn-danger.disabled.focus,
		.btn-danger[disabled].focus,
		fieldset[disabled] .btn-danger.focus,
		.btn-danger.disabled:active,
		.btn-danger[disabled]:active,
		fieldset[disabled] .btn-danger:active,
		.btn-danger.disabled.active,
		.btn-danger[disabled].active,
		fieldset[disabled] .btn-danger.active {
		  background-color: #ff0039;
		  border-color: #ff0039;
		}
		.btn-danger .badge {
		  color: #ff0039;
		  background-color: #ffffff;
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
	@page {
		margin: 10mm 10mm 10mm 10mm;	
		width: 210mm;
		height: 290mm;    
    }
	@media print {
       body {
		margin:0 auto;
		width: 210mm;
		height: 270mm;        
      }
	  .btn {
		  display:none;
	  }
    }
</style>
</head>

<body>
<?php
$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url .= "://".$_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']); 
echo $base_url;
?>
<div class="row">
    <div style="margin-bottom:30px">
        <table width="100%" style="border-collapse: collapse;" >
			<tr>
			<td align="center" style="border-bottom:1px solid #000000;">
			<img src="<?php echo base_url().index_page().'/img/logo.png';?>" width="70" height="70"></td>
			<td colspan="2" style="border-bottom:1px solid #000000;">
			<p><span class="univ">UNIVERSITAS TEKNOLOGI YOGYAKARTA</span><br>  
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
			<td align="center" colspan="3"><a class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Cetak </a>&nbsp;&nbsp; <a class="btn btn-danger" href="<?php echo isset($link) ? base_url().index_page()."program/".$link."/cetakpdf" : "" ?>"><i class="fa fa-file-pdf-o"></i>  PDF</a> </td>
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

    <div style="font-size:12px !important;">
        <?php echo $data1[0]->prg_deskripsi; ?>
    </div>
</div>	
</body>
</html>