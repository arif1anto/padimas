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
	<title>Surat Pengumuman</title>

	<style type="text/css">
		@page {
	        margin: 0mm 10mm 0mm 10mm;
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
		.page{width: 210mm;margin: auto;padding: 0mm 10mm 10mm 10mm;border: 1px solid #000;word-wrap: break-word;overflow-wrap: break-word;}
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
		@media print {
	      	.page{
				width: 100%;
		        height: auto;
		        
				margin-top:50mm;
		        padding: 0 ;
		        border: none ;
				
			}
			
	    }
	</style>
</head>
<body>
	<div class="page">
<?php if($surat==null || $dt==null) : 
		else :
			$dpa = strpos($surat, '[DPA_HER]')=== false ? 0 : $dt[0]->dpa ;
			$spa1 = strpos($surat, '[SPA_HER]')=== false ? 0 : $dt[0]->spa1 ;
			$spp = strpos($surat, '[SPP_TETAP]')=== false ? 0 : $dt[0]->spp_tetap ;
			$jum = $dpa+$spp+$spa1;
			$replace=array(
				'[NOSURAT]' 		=> $no_surat,
				'[BL_SURAT]'		=> tanggal(date("Y-m-d"),'blrmw'),
				'[TGL_SKRG]' 		=> tanggal(date("Y-m-d"),'dd'),
				'[ID]' 				=> strtoupper($dt[0]->id_daftar),
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
				'[TGL_HER]' 		=> tanggal($dt[0]->tgl_her,'dd'),
				'[SPA_BAYAR]' 		=> number_format($dt[0]->spa_byr,0,',','.'),
				'[POT_SPA]' 		=> number_format($dt[0]->spa_pot,0,',','.'),
				'[SPA1]' 			=> number_format($dt[0]->spa1,0,',','.'),
				'[SPA2]' 			=> number_format($dt[0]->spa2,0,',','.'),
				'[SPA3]' 			=> number_format($dt[0]->spa3,0,',','.'),
				'[SPA4]' 			=> number_format($dt[0]->spa4,0,',','.'),
				'[DPA_HER]' 		=> number_format($dt[0]->dpa,0,',','.'),
				'[SPA_HER]' 		=> number_format($dt[0]->spa1,0,',','.'),
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
	<script type="text/javascript"> 	
		window.onload=function(){
			self.print();} 
	</script> 

</body>
</html>