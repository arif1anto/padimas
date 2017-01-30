<!DOCTYPE html>
<html>
<head>
	<?php 
	echo $this->load->view('admin/header'); 
	function ganti(array $replace, $subject) { 
	   return str_replace(array_keys($replace), array_values($replace), $subject);    
	}
	function map($id){
		switch($id){
			case 1 : $warna='Hijau';break;
			case 2 : $warna='Merah';break;
			case 3 : $warna='Biru';break;
			case 4 : $warna='Cokelat';break;
			case 5 : $warna='Oranye';break;
			default : $warna='';break;
			
		}
		return $warna;
	}
	function tanggal($date=null){
		if($date!=null) :
			$yr=date('Y',strtotime($date));
			$mo=date('m',strtotime($date));
			$d=date('d',strtotime($date));
			$day=date('N',strtotime($date));
			
			$bln='';$hr='';
			switch($mo){
				case '01' : $bln="Januari" ;break;
				case '02' : $bln="Februari" ;break;
				case '03' : $bln="Maret" ;break;
				case '04' : $bln="April" ;break;
				case '05' : $bln="Mei" ;break;
				case '06' : $bln="Juni" ;break;
				case '07' : $bln="Juli" ;break;
				case '08' : $bln="Agustus" ;break;
				case '09' : $bln="September" ;break;
				case '10' : $bln="Oktober" ;break;
				case '11' : $bln="November" ;break;
				case '12' : $bln="Desember" ;break;
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
			return $d.' '.$bln.' '.$yr;
		endif;
	}
	
	?>
	<title>Surat Pengumuman</title>

	<style type="text/css">
		@page {
	        margin: 5mm 10mm 0mm 10mm;
	        width: 210mm;
	        height: 290mm;
	    }
	    body { font-size: 10px !important; }

	    .border{
	    	border: 1px solid #000;
	    	padding: 1.5mm;
	    }
	  	td{padding-bottom: 3mm;}
	  	#tbl2 td{padding-bottom: 1mm;}
		.label {font-family: Arial, Helvetica, sans-serif; font-size: 12pt; }
		.contener{padding:0;padding-top: 25mm;}
		.page{width: 210mm;margin:auto;padding: 5mm 10mm 10mm 10mm;word-wrap: break-word;overflow-wrap: break-word;background-color:#fff;}
		hr{border:none;border-top: 1px solid #000;margin-top: 0;}
		.cetak{height: 160mm;}
		p{font-family: Arial, Helvetica, sans-serif; font-size: 10pt;margin:0;}
		.table2{
			font-size:10pt;
			line-height:0.4;
			font-family: 'Times New Roman';
		}
		ul li span{
			font-size:10pt ;line-height:1.5;
		}
		.kop{
			font-size:10pt;
			line-height:1;
			font-family: 'Times New Roman';
			margin-bottom:20px;
		}
		.alamat {
		  font-family: Arial, Helvetica, sans-serif;
		  font-size: 10px;
		  line-height:0.4;
		}
		.univ {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 16px; }
		@media print {
	      	.page{
				width: 100%;
		        height: auto;
		        
				margin-top:0mm;
		        padding: 0 ;
		        border: none ;
			}
			.tombol{
				display:none;
			}
			
	    }
	</style>
</head>
<body>
	<div class="page">
		<table class="kop"width="100%" style="border-collapse: collapse;" >
			<tr>
				<td align="center" style="border-bottom:1px solid #000000;">
				<img src="<?php echo base_url().'img/logo.png';?>" width="70" height="70"></td>
				<td colspan="2" style="border-bottom:1px solid #000000;">
				<p><span class="univ">UNIVERSITAS KULIAH JOGJA</span><br>  
				   <span class="alamat">Kampus 1 : Jl. Kampus 1. Kode POS, Telp., </span><br/>
				   <span class="alamat">Kampus 2 : Jl. Kampus 2. Kode POS, Telp.,,</span><br/>
				   <span class="alamat">Kampus 3 : Jl. Kampus 3. Kode POS, Telp.,</span><br/>
				   <span class="alamat">Email: kuliahjogja@gmail.com Hompage : kuliahjogja.com</span><br/>
				   </p>
				</td>
			</tr>
			<tr class="tombol">
				<td class="text-right" style="padding-top:10px;"colspan="2">
					<a class="btn btn-primary btn-sm" onclick="window.print()"><i class="fa fa-print"></i> Cetak</a> <a class="btn btn-danger btn-sm" href="<?php echo isset($link) ? base_url().index_page()."pengumuman/".$link."/cetakpdf" : "" ?>"><i class="fa fa-file-pdf-o"></i> PDF</a>
				</td>
			</tr>
		</table>
<?php if($surat==null || $dt==null) : 
		else :
			$dpa = strpos($surat, '[DPA_HER]')=== false ? 0 : $dt[0]->dpa ;
			$spa1 = strpos($surat, '[SPA_HER]')=== false ? 0 : $dt[0]->spa1 ;
			$spp = strpos($surat, '[SPP_TETAP]')=== false ? 0 : $dt[0]->spp_tetap ;
			$jum = $dpa+$spp+$spa1;
			$replace=array(
				'[NOSURAT]' 		=> $no_surat,
				'[NAMA]' 			=> strtoupper($dt[0]->nama),
				'[ASAL_SEKOLAH]' 	=> strtoupper($dt[0]->sklh),
				'[ALAMAT_ASAL]' 	=> strtoupper($dt[0]->alamat_asal),
				'[FAKULTAS]' 		=> $dt[0]->fakultas,
				'[JURUSAN]' 		=> $dt[0]->prodi,
				'[KELAS]' 			=> $dt[0]->kelas,
				'[DPA]' 			=> number_format($dt[0]->dpa,0,',','.'),
				'[SPP_TETAP]' 		=> number_format($dt[0]->spp_tetap,0,',','.'),
				'[SPP_VAR]' 		=> number_format($dt[0]->sppv_teori,0,',','.'),
				'[SPA]' 			=> number_format($dt[0]->spa,0,',','.'),
				'[TGL_HER]' 		=> tanggal($dt[0]->tgl_her),
				'[SPA_BAYAR]' 		=> number_format($dt[0]->spa_byr,0,',','.'),
				'[POT_SPA]' 		=> number_format($dt[0]->spa_pot,0,',','.'),
				'[SPA1]' 			=> number_format($dt[0]->spa1,0,',','.'),
				'[SPA2]' 			=> number_format($dt[0]->spa2,0,',','.'),
				'[SPA3]' 			=> number_format($dt[0]->spa3,0,',','.'),
				'[SPA4]' 			=> number_format($dt[0]->spa4,0,',','.'),
				'[DPA_HER]' 		=> number_format($dt[0]->dpa,0,',','.'),
				'[SPA_HER]' 			=> number_format($dt[0]->spa1,0,',','.'),
				'[HER_AWAL]' 		=> number_format($jum,0,',','.'),
				'[PERSEN1]' 		=> $dt[0]->persen1,
				'[PERSEN2]' 		=> $dt[0]->persen2,
				'[PERSEN3]' 		=> $dt[0]->persen3,
				'[PERSEN4]' 		=> $dt[0]->persen4,
				'[MAP]' 			=> map($dt[0]->kd_fakultas),
				
			);
			$ch=ganti($replace,$surat);
			echo $ch;
		endif;
		?>
	</div>

	<script language='VBScript'>
		Sub Print()
		       OLECMDID_PRINT = 6
		       OLECMDEXECOPT_DONTPROMPTUSER = 2
		       OLECMDEXECOPT_PROMPTUSER = 1
		       call WB.ExecWB(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER,1)
		End Sub
		document.write "<object ID='WB' WIDTH=0 HEIGHT=0 CLASSID='CLSID:8856F961-340A-11D0-A96B-00C04FD705A2'></object>"
	</script>

</body>
</html>