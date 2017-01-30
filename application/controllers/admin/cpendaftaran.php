<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cpendaftaran extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','pagination','encrypt','excel'));
        $this->load->database();
        $this->load->model(array('mprogram','mbiaya','mpendaftar','mmaster','mkonfig','mrekomendasi','mlogin','mdata'));
        $this->cek_sess();
        //menghilangkan cache ketika menekan tombol back sesudah logout
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
    }

    private function cek_sess() {
        $login = $this->session->userdata('login');
        if ($login){
            return true;
        } else {
            redirect('admin/login');
        }
    }

	public function index(){
		$v['judul'] = "Pembayaran Pendaftaran";
		$v['content'] = "admin/pendaftaran";
		$v['data1'] = $this->mprogram->getprogram_reg();
		$v['data2'] = $this->mbiaya->gettarifby();
		if($_POST){
			$id=$this->mpendaftar->inpendaftar($this->input->post('stat_daftar'),$this->session->userdata('user'));
			redirect('admin/pendaftaran/validasi/edit/'.$id);
			 //echo '<meta http-equiv="refresh" content="1;'.base_url().index_page().'admin/pendaftaran/validasi/edit/'.$id.'">';			
		}
		$this->global_view($v);
       
	}
	
	public function edit($id=null){
		$v['judul'] = "Pembayaran Pendaftaran";
		$v['content'] = "admin/pendaftaran_edit";
		$v['data2'] = $this->mbiaya->gettarifby();
		if($id!=null){
			$v['data1'] = $this->mpendaftar->getpendaftar_byid($id);
			$v['data3'] = $this->mbiaya->gettarifby_id($v['data1']->jml_pilihan);
			if($_POST && $id!=null){
				
				$this->mpendaftar->updaftar($id,$this->session->userdata('user'));
				redirect('admin/pendaftaran/validasi/edit/'.$id);
				//echo '<meta http-equiv="refresh" content="1;'.base_url().index_page().'admin/pendaftaran/validasi/edit/'.$id.'">';
			}
		}
		$this->global_view($v);
       
	}
	
	public function validasi($aksi=null,$param=null){
		if($aksi='edit' && $param!=null && is_numeric($param)){
			$v['data6']= $this->mpendaftar->getpendaftar_byid($param);
			$v['data7']= $this->mmaster->getcbkota_byid($v['data6']->prop_sekolah);
			$v['data8']= $this->mmaster->getcbkec_byid($v['data6']->kota_sekolah);
			$v['data9']= $this->mmaster->getcbsekolah_byid($v['data6']->kec_sekolah);
			$v['data11']= $this->mmaster->getcbkota_byid($v['data6']->prop_asal);
			$v['data12']= $this->mmaster->getcbkec_byid($v['data6']->kab_asal);
			$v['data13']= $this->mmaster->getcbkec_byid($v['data6']->kab_skrg);
			$v['data14']= $this->mkonfig->getsrc_info_set_byid($param);
			
			if($_POST){
				$this->mpendaftar->updatapendaftar($param,$this->session->userdata('user'));
				$this->mkonfig->upsrc_info_set($param);
				$v['data15']='cetak('.$param.');';	
			 //echo '<meta http-equiv="refresh" content="1;'.base_url().index_page().'admin/pendaftaran/validasi/edit/'.$param.'">';
			}
			
		}
		else	
			$v['data14']= $this->mkonfig->getsrc_info_set_byid(0);
		
		
		$v['judul'] = "Data Pendaftar";
		$v['content'] = "admin/pendaftaran_validasi";
		$v['data1'] = $this->mprogram->getprogram_reg();
		$v['data2'] = $this->mkonfig->qgetprogramprodi();
		$v['data3'] = $this->mkonfig->qgetprogramprodi();
		$v['data4']	= $this->mmaster->getcbpropinsi();
		$v['data5']	= $this->mmaster->getcbkota_byid('040000');
		$v['data10']= $this->mmaster->getcbagama();
		$this->global_view($v);
       
	}
	
	public function cetak_surat($aksi=null,$id=null){
		$v['data1'] = $this->mprogram->getprogramby();
		$v['judul'] = "Data Pendaftar";
		$v['content'] = "admin/lap_pendaftar_op";
		$this->global_view($v);
	}

	public function cetak($link=null,$id=null){
		switch ($link) {
			case 'slip':
				if($id!=null){
					$v['data1'] = $this->mpendaftar->getpendaftar_byid($id);
					$v['data2']= $this->mlogin->getauthorby_uname($this->session->userdata("user"));
					$this->load->view("admin/cetak/kwitansi_pendaftaran",$v);
				}
				break;
			case 'kartu_tes':
				if($id!=null){
					$v['data1'] = $this->mpendaftar->getpendaftar_byid2($id);
					$v['data2'] = $this->mpendaftar->qgetgelombang($id);
					$v['data3']= $this->mlogin->getauthorby_uname($this->session->userdata("user"));
					$this->load->view("admin/cetak/kartu_ujian",$v);
				}else{echo "null";}
				break;
			// case 'surat':
			// 	$this->load->view("admin/cetak/kartu_ujian");
			// 	break;
			default:
				echo "default";
				break;
		}
	}

	public function cetak_kelengkapan($param=null)	{
		if ($param!=null) {
			$v['data1']= $this->mpendaftar->getherregistrasi_maba_byid($param);
			$v['data2']= $this->mkonfig->getsyarat_her_set_byid($param);
			$v['data3']= $this->mlogin->getauthorby_uname($this->session->userdata("user"));
			$this->load->view("admin/cetak/kelengkapan_berkas_her",$v);
		}
	}

	public function bukti_pengambilan_jas($param=null){
		if ($param!=null) {
			$v['data1'] = $this->mpendaftar->getherregistrasi_maba_byid($param);
			$v['data2'] = $this->mkonfig->getkonfig('nb_buktijaz');
			$this->load->view("admin/cetak/bukti_jaz",$v);
		}
	}
	
	public function excel($link=null){
		switch ($link) {
			case 'rekomendasi':
				if($_POST){
					$tgl1 = $this->input->post('tgl1',TRUE);
					$tgl2 = $this->input->post('tgl2',TRUE);
					$cari = $this->input->post('caridata',TRUE);
					$prog = $this->input->post('stat_daftar',TRUE);
					$jnsbea = $this->input->post('jnsbea',TRUE);
					$data=$this->mrekomendasi->getrekomendasi_allbydate($prog,$tgl1,$tgl2,$cari,null,null,$jnsbea);
					$this->rekomendasi_to_excel($data->result(),$tgl1,$tgl2);
				}
				break;
			case 'rekappmb':
				if($_POST){
					$st=$this->input->post('tgl_awal');
					$end=$this->input->post('tgl_akhir');
					$prg=$this->input->post('prg');
					$jns=$this->input->post('jns_data');
					$data=$this->mrekomendasi->getrekap_pendaftar(($prg==0 ? null : $prg),$st,$end,$jns);
					$this->rekappmb_to_excel($data->result(),$st,$end,$jns);
				}
				$v['data1'] = $this->mprogram->getprogramby();
				$v['content'] = "admin/lap_pendaftar_rekap.php";
				$this->global_view($v);
				break;
			case 'dataher':
				$data=$this->mdata->getJmlHerProdi();
				$this->her_to_excel($data);
				break;
			default:
				# code...
				break;
		}
	}
	
	private function gantinumeric($subject) { 
		$replace=array('.'=>'',','=>'',' '=>'');
	   return str_replace(array_keys($replace), array_values($replace), $subject);    
	}
	
	public function bayar_her($aksi=null,$id=null){
		$v['data1']=$this->mrekomendasi->getrekomendasi_byid($id,"diterima");
		$v['data2']=$this->mbiaya->getbayar_byid($id);	
		isset($v['data1'][0]->spa_byr) ? 	$spa_byr=$v['data1'][0]->spa_byr : $spa_byr=0;
		isset($v['data1'][0]->dpa) ?  		$dpa=$v['data1'][0]->dpa : $dpa=0;
		isset($v['data1'][0]->spp_tetap) ?  $spp_tetap=$v['data1'][0]->spp_tetap : $spp_tetap=0;
		isset($v['data2'][0]->spa_byr) ? 	$spa_sisa=$spa_byr-$v['data2'][0]->spa_byr : $spa_sisa=$spa_byr-0;
		isset($v['data2'][0]->dpa_byr) ?  	$dpa_sisa=$dpa-$v['data2'][0]->dpa_byr : $dpa_sisa=$dpa-0;
		isset($v['data2'][0]->sppttp_byr) ? $spp_sisa=$spp_tetap-$v['data2'][0]->sppttp_byr : $spp_sisa=$spp_tetap-0;
		if($_POST && $aksi=="tambah" && $id!=null){
			
			$spa_in=$this->gantinumeric($this->input->post('spa_byr'));
			$dpa_in=$this->gantinumeric($this->input->post('dpa_byr'));
			$spp_in=$this->gantinumeric($this->input->post('sppttp_byr'));
			if($spa_sisa>0 && $spa_in<=$spa_sisa)
				$this->mbiaya->inbayar('spa',$spa_in);
			if($dpa_sisa>0 && $dpa_in<=$dpa_sisa)
				$this->mbiaya->inbayar('dpa',$dpa_in);
			if($spp_sisa>0 && $spp_in<=$spp_sisa)
				$this->mbiaya->inbayar('sppttp',$spp_in);
			redirect("admin/pendaftaran/bayar_her/cari/".$id);
		}
		$v['judul'] = "Bayar Her Registrasi";
		$v['content'] = "admin/byr_her";
		$this->global_view($v);
	}
	public function export(){
		$v['data1'] = $this->mprogram->getprogramby();
        $v['content'] = "admin/export.php";
        $this->global_view($v);
		if($_POST){
			$st=$this->input->post('tgl_awal');
			$end=$this->input->post('tgl_akhir');
			$prg=$this->input->post('prg');
			$data=$this->mpendaftar->getpendaftar_bydate($st,$end,$prg);
			$this->pendaftar_to_excel($data,$st,$end);
		}
	}
	public function laporan($aksi=null,$id=null){
		// if($aksi=="cari" && $id!=null){
		// 	$dt=explode("dn",$id);
		// 	$st=$dt[0]!=null ? $dt[0]:0;
		// 	$end=$dt[1]!=null ? $dt[1]:0;
		// 	$v['data1']=$this->mrekomendasi->getrekomendasi_allbydate($st,$end,10,1);
		// 	$v['data2']=array( 
		// 		"st" =>$st,
		// 		"end"=>$end
		// 	);
		// 	$v['data3']=$this->mrekomendasi->getrekomendasi_allbydate($st,$end)->num_rows();
		// }
		$v['data1'] = $this->mprogram->getprogramby();
		$v['data2'] = $this->mkonfig->qgetprogramprodi();
		$v['judul'] = "Data Pendaftar";
		$v['content'] = "admin/lap_pendaftar";
		$this->global_view($v);
	}
	
    public function her_registrasi($param=null){
		if($param!=null){
			$v['data6']= $this->mpendaftar->getherregistrasi_maba_byid($param);
			if($v['data6']!=null) :
				$v['data7']= $this->mmaster->getcbkota_byid($v['data6']->prop_sekolah);
				$v['data8']= $this->mmaster->getcbkec_byid($v['data6']->kota_sekolah);
				$v['data9']= $this->mmaster->getcbsekolah_byid($v['data6']->kec_sekolah);
				$v['data11']= $this->mmaster->getcbkota_byid($v['data6']->prop_asal);
				$v['data12']= $this->mmaster->getcbkec_byid($v['data6']->kab_asal);
				$v['data13']= $this->mmaster->getcbkec_byid($v['data6']->kab_skrg);
				$v['data15']= $this->mrekomendasi->gennim($v['data6']->kd_proditawar);
				$v['data14']= $this->mkonfig->getsyarat_her_set_byid($param);
				$v['data16']= $this->mmaster->getcbkota_byid($v['data6']->prop_ayah);
				$v['data17']= $this->mmaster->getcbkec_byid($v['data6']->kab_ayah);
				$v['data18']= $this->mmaster->getcbkota_byid($v['data6']->prop_ibu);
				$v['data19']= $this->mmaster->getcbkec_byid($v['data6']->kab_ibu);
				$v['data20']= $this->mmaster->getcbkota_byid($v['data6']->prop_wali);
				$v['data21']= $this->mmaster->getcbkec_byid($v['data6']->kab_wali);
				$v['data22']= $this->mmaster->getcbkota_byid($v['data6']->prop_sutri);
				$v['data23']= $this->mmaster->getcbkec_byid($v['data6']->kab_sutri);			
			endif;
			if($_POST){
				$this->mpendaftar->upherregistrasi_byop($param,$this->session->userdata('user'));
				$this->mkonfig->upsyarat_her_set($param);
				redirect("admin/pendaftaran/her_registrasi/".$param);
			}
		}
		else	
			$v['data14']= $this->mkonfig->getsyarat_her_set_byid(0);
		
        
		$v['judul'] = "Data Her-Registrasi";
		$v['content'] = "admin/her_registrasi";
		$v['data1'] = $this->mprogram->getprogram_nonreg();
		$v['data2'] = $this->mkonfig->qgetprogramprodi();
		$v['data3'] = $this->mkonfig->qgetprogramprodi();
		$v['data4']	= $this->mmaster->getcbpropinsi();
		$v['data5']	= $this->mmaster->getcbkota_byid('040000');
		$v['data10']= $this->mmaster->getcbagama();	
		$v['data24']= $this->mkonfig->getThnAktif();	
        $this->global_view($v);
    }
	
	public function hapusher($aksi=null){
		$v['content'] = "admin/her_hapus";
		if($aksi=='hapus'){
			$id = $this->input->post('id');
			 $this->mpendaftar->delher($id);
			 redirect("admin/pendaftaran/hapusher");
		}
        $this->global_view($v);
	}
	
	public function ubahnim($aksi=null){
		if($aksi=='ok'){
			 $this->mpendaftar->ubahnim();
			 redirect("admin/pendaftaran/ubahnim");
		}
		$v['content'] = "admin/ubah_nim";
        $this->global_view($v);
	}
	
	public function ubahspa($aksi=null){
		if($aksi=='ok'){
			 $spa=$this->input->post('spa',TRUE);
			 $potspa=$this->input->post('potspa',TRUE);
			 $this->mbiaya->ubahSpaBayar($spa,$potspa);
			 redirect("admin/pendaftaran/ubahspa");
		}
		$v['content'] = "admin/ubah_spa";
        $this->global_view($v);
	}
	
	private function tanggal($date=null,$param=null){
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
			switch($param){
				case "hr" : return $hr.', '.$d.' '.$bln.' '.$yr;break;
				case "dd" : return $d.' '.$bln.' '.$yr;break;
				case "bl" : return $bln.' '.$yr;break;
				default	: break;
				
			}
				
		endif;
	}
	private function her_to_excel($data=null){
		if($data!=null){
			$this->excel->getProperties()->setCreator("PADIMAS");
			$this->excel->getProperties()->setTitle("DATA JUMLAH PENDAFTAR HER-REGISTRASI PER PRODI");
			$this->excel->createSheet();
			$this->excel->setActiveSheetIndex(0); 

			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				)
			);

			$style2 = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				)
			);
			
			$style3 = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
				)
			);

			$border = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(7);
								
			//header
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->setCellValue('A1',"DATA JUMLAH PENDAFTAR HER-REGISTRASI PER PRODI" );

			//tabel header	
			$this->excel->getActiveSheet()->setCellValue('A2','NO');
			$this->excel->getActiveSheet()->setCellValue('B2','PRODI');
			$this->excel->getActiveSheet()->setCellValue('C2','Jumlah');
			$this->excel->getActiveSheet()->getStyle("A2:C2")->getFont()->setBold(true);

			$this->excel->getActiveSheet()->getStyle("A2:C2")->applyFromArray($border);
			$i = 2; $no=0;
			for ($j=0; $j < count($data); $j++) {
				$no++; $i++;
				$this->excel->getActiveSheet()->getStyle("C".$i)->applyFromArray($style3);
				$this->excel->getActiveSheet()->getStyle("A".$i.":C".$i)->applyFromArray($border);
				$this->excel->getActiveSheet()->setCellValue('A'.$i,$no);
				$this->excel->getActiveSheet()->setCellValue('B'.$i,$data[$j]->jurusan);
				$this->excel->getActiveSheet()->setCellValue('C'.$i,$data[$j]->jml);	
			}
			$filename='DATA JUMLAH PENDAFTAR HER-REGISTRASI PER PRODI.xls';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			header('Cache-Control: max-age=0');                  
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			$objWriter->save('php://output');
		}
    }
	private function rekomendasi_to_excel($data=null,$st=null,$end=null){
		if($data!=null){
			$this->excel->getProperties()->setCreator("PADIMAS");
			$this->excel->getProperties()->setTitle("DATA PENDAFTAR");
			$this->excel->createSheet();
			$this->excel->setActiveSheetIndex(0); 

			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				)
			);

			$style2 = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				)
			);
			
			$style3 = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
				)
			);

			$border = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(50);	
			$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);						
			$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);						
			$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);						
			$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);						
			$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(15);						
			$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(15);						
			$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);						
			$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(15);						
			$this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(30);						
			$this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(30);						
			$this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(30);						
			//header
			$this->excel->getActiveSheet()->getStyle("A1")->applyFromArray($style2);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->setCellValue('A1',"DATA PENDAFTAR TANGGAL ".$this->tanggal($st,"dd")." S/D ".$this->tanggal($end,"dd") );
			$this->excel->getActiveSheet()->mergeCells('A1:T1');

			//tabel header	
			$this->excel->getActiveSheet()->setCellValue('A2','NO');
			$this->excel->getActiveSheet()->setCellValue('B2','ID DAFTAR');
			$this->excel->getActiveSheet()->setCellValue('C2','FAKULTAS');
			$this->excel->getActiveSheet()->setCellValue('D2','PRODI');
			$this->excel->getActiveSheet()->setCellValue('E2','KELAS');
			$this->excel->getActiveSheet()->setCellValue('F2','NAMA');
			$this->excel->getActiveSheet()->setCellValue('G2','NIS');
			$this->excel->getActiveSheet()->setCellValue('H2','ASAL SEKOLAH');
			$this->excel->getActiveSheet()->setCellValue('I2','ALAMAT RUMAH');
			$this->excel->getActiveSheet()->setCellValue('J2','REKOMENDASI');
			$this->excel->getActiveSheet()->setCellValue('K2','SPA NORMAL');
			$this->excel->getActiveSheet()->setCellValue('L2','SPA POTONGAN');
			$this->excel->getActiveSheet()->setCellValue('M2','SPA BAYAR');
			$this->excel->getActiveSheet()->setCellValue('N2','DPA');		
			$this->excel->getActiveSheet()->setCellValue('O2',$data[0]->persen1.'% SPA 1');
			$this->excel->getActiveSheet()->setCellValue('P2',$data[0]->persen2.'% SPA 2');
			$this->excel->getActiveSheet()->setCellValue('Q2',$data[0]->persen3.'% SPA 3');
			$this->excel->getActiveSheet()->setCellValue('R2',$data[0]->persen4.'% SPA 4');
			$this->excel->getActiveSheet()->setCellValue('S2','TGL TES');
			$this->excel->getActiveSheet()->setCellValue('T2','TGL HERIGISTRASI');
			$this->excel->getActiveSheet()->getStyle("A2:T2")->applyFromArray($style2);
			$this->excel->getActiveSheet()->getStyle("A2:T2")->getFont()->setBold(true);

			$this->excel->getActiveSheet()->getStyle("A2:T2")->applyFromArray($border);
			$i = 2; $no=0;
			for ($j=0; $j < count($data); $j++) {
				$no++; $i++;
				$this->excel->getActiveSheet()->getStyle("A".$i.":E".$i)->applyFromArray($style2);
				$this->excel->getActiveSheet()->getStyle("G".$i)->applyFromArray($style2);
				$this->excel->getActiveSheet()->getStyle("J".$i)->applyFromArray($style2);
				$this->excel->getActiveSheet()->getStyle("U".$i)->applyFromArray($style2);
				$this->excel->getActiveSheet()->getStyle("S".$i.":T".$i)->applyFromArray($style2);
				$this->excel->getActiveSheet()->getStyle("K".$i.":R".$i)->applyFromArray($style3);
				$this->excel->getActiveSheet()->getStyle("A".$i.":T".$i)->applyFromArray($border);
				$this->excel->getActiveSheet()->setCellValue('A'.$i,$no);
				$this->excel->getActiveSheet()->setCellValue('B'.$i,$data[$j]->iddaftar);
				$this->excel->getActiveSheet()->setCellValue('C'.$i,$data[$j]->fakultas);
				$this->excel->getActiveSheet()->setCellValue('D'.$i,$data[$j]->prodi);
				$this->excel->getActiveSheet()->setCellValue('E'.$i,$data[$j]->kelas);
				$this->excel->getActiveSheet()->setCellValue('F'.$i,$data[$j]->nama);
				$this->excel->getActiveSheet()->setCellValue('G'.$i,$data[$j]->no_induk);
				$this->excel->getActiveSheet()->setCellValue('H'.$i,$data[$j]->asal_sklh);
				$this->excel->getActiveSheet()->setCellValue('I'.$i,$data[$j]->alamat_asal);
				$this->excel->getActiveSheet()->setCellValue('J'.$i,$data[$j]->rekomendasi);
				$this->excel->getActiveSheet()->setCellValue('K'.$i,$data[$j]->spa);
				$this->excel->getActiveSheet()->setCellValue('L'.$i,$data[$j]->spa_pot);   
				$this->excel->getActiveSheet()->setCellValue('M'.$i,$data[$j]->spa_byr);
				$this->excel->getActiveSheet()->setCellValue('N'.$i,$data[$j]->dpa); 	
				$this->excel->getActiveSheet()->setCellValue('O'.$i,$data[$j]->spa1); 	
				$this->excel->getActiveSheet()->setCellValue('P'.$i,$data[$j]->spa2); 	
				$this->excel->getActiveSheet()->setCellValue('Q'.$i,$data[$j]->spa3); 	
				$this->excel->getActiveSheet()->setCellValue('R'.$i,$data[$j]->spa4); 	
				$this->excel->getActiveSheet()->setCellValue('S'.$i,$this->tanggal($data[$j]->tgl_tes,"hr")); 	
				$this->excel->getActiveSheet()->setCellValue('T'.$i,$this->tanggal($data[$j]->tgl_her,"hr"));		
				
			}
			$filename='DATA REKOMENDASI TANGGAL '.$st." SD ".$end.'.xls';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			header('Cache-Control: max-age=0');                  
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			$objWriter->save('php://output');
		}
		else 
			redirect("admin/pendaftaran/laporan");
    }
	private function pendaftar_to_excel($data=null,$st=null,$end=null){
		if($data!=null && $st!=null && $end!=null){
			$this->excel->getProperties()->setCreator("PADIMAS");
			$this->excel->getProperties()->setTitle("DATA PENDAFTAR");
			$this->excel->createSheet();
			$this->excel->setActiveSheetIndex(0); 

			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				)
			);

			$style2 = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				)
			);
			
			$style3 = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
				)
			);

			$border = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(45);
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(45);
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(50);
			$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(60);
			$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);	
			$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);						
			$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(10);						
			$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(10);						
		
			$this->excel->getActiveSheet()->getStyle("A1")->applyFromArray($style2);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->setCellValue('A1',"DATA PENDAFTAR TANGGAL ".$this->tanggal($st,"dd")." S/D ".$this->tanggal($end,"dd"));
			$this->excel->getActiveSheet()->mergeCells('A1:R1');

			//tabel header
			for($a="A";$a<="L";$a++){
				$this->excel->getActiveSheet()->mergeCells($a.'2:'.$a.'3');
			}
			$this->excel->getActiveSheet()->setCellValue('A2','NO');
			$this->excel->getActiveSheet()->setCellValue('B2','ID DAFTAR');
			$this->excel->getActiveSheet()->setCellValue('C2','PRODI PIL 1');
			$this->excel->getActiveSheet()->setCellValue('D2','PRODI PIL 2');
			$this->excel->getActiveSheet()->setCellValue('E2','NAMA');
			$this->excel->getActiveSheet()->setCellValue('F2','NIS');
			$this->excel->getActiveSheet()->setCellValue('G2','PIN');
			$this->excel->getActiveSheet()->setCellValue('H2','ASAL SEKOLAH');
			$this->excel->getActiveSheet()->setCellValue('I2','ALAMAT RUMAH');
			$this->excel->getActiveSheet()->setCellValue('J2','JALUR DAFTAR');
			$this->excel->getActiveSheet()->setCellValue('K2','TGL TES');
			$this->excel->getActiveSheet()->setCellValue('L2','TGL DAFTAR');
			$this->excel->getActiveSheet()->mergeCells('M2:R2');
			$this->excel->getActiveSheet()->setCellValue('M2','NILAI');
			$this->excel->getActiveSheet()->setCellValue('M3','SMT 1');
			$this->excel->getActiveSheet()->setCellValue('N3','SMT 2');
			$this->excel->getActiveSheet()->setCellValue('O3','SMT 3');
			$this->excel->getActiveSheet()->setCellValue('P3','SMT 4');
			$this->excel->getActiveSheet()->setCellValue('Q3','UAN');
			$this->excel->getActiveSheet()->setCellValue('R3','TOTAL');
			$this->excel->getActiveSheet()->getStyle("A2:R3")->applyFromArray($style2);
			$this->excel->getActiveSheet()->getStyle("A2:R3")->getFont()->setBold(true);

			$this->excel->getActiveSheet()->getStyle("A2:R3")->applyFromArray($border);
			$i = 3; $no=0;
			for ($j=0; $j < count($data); $j++) {
				$no++; $i++;
				$this->excel->getActiveSheet()->getStyle("A".$i.":B".$i)->applyFromArray($style2);
				$this->excel->getActiveSheet()->getStyle("F".$i.":G".$i)->applyFromArray($style2);
				$this->excel->getActiveSheet()->getStyle("I".$i.":R".$i)->applyFromArray($style2);
				$this->excel->getActiveSheet()->getStyle("A".$i.":R".$i)->applyFromArray($border);
				$this->excel->getActiveSheet()->setCellValue('A'.$i,$no);
				$this->excel->getActiveSheet()->setCellValue('B'.$i,$data[$j]->id_daftar);
				$this->excel->getActiveSheet()->setCellValue('C'.$i,$data[$j]->prodi1);
				$this->excel->getActiveSheet()->setCellValue('D'.$i,$data[$j]->prodi2);
				$this->excel->getActiveSheet()->setCellValue('E'.$i,$data[$j]->nama);
				$this->excel->getActiveSheet()->setCellValue('F'.$i,$data[$j]->no_induk);
				$this->excel->getActiveSheet()->setCellValue('G'.$i,$data[$j]->pin);
				$this->excel->getActiveSheet()->setCellValue('H'.$i,$data[$j]->nama_sekolah);
				$this->excel->getActiveSheet()->setCellValue('I'.$i,$data[$j]->alamat_asal);
				$this->excel->getActiveSheet()->setCellValue('J'.$i,$data[$j]->prg_nama);
				$this->excel->getActiveSheet()->setCellValue('K'.$i,$this->tanggal($data[$j]->tgl_tes,"hr"));   
				$this->excel->getActiveSheet()->setCellValue('L'.$i,$this->tanggal($data[$j]->tgl_daftar,"hr")); 
				$this->excel->getActiveSheet()->setCellValue('M'.$i,$data[$j]->rapor_sm1); 
				$this->excel->getActiveSheet()->setCellValue('N'.$i,$data[$j]->rapor_sm2); 
				$this->excel->getActiveSheet()->setCellValue('O'.$i,$data[$j]->rapor_sm3); 
				$this->excel->getActiveSheet()->setCellValue('P'.$i,$data[$j]->rapor_sm4); 
				$this->excel->getActiveSheet()->setCellValue('Q'.$i,$data[$j]->rerata_uan); 	
				$this->excel->getActiveSheet()->setCellValue('R'.$i,$data[$j]->nilai_total); 				
				
			}
			$filename='DATA PENDAFTAR TANGGAL '.date("d-m-Y",strtotime($st))." SD ".date("d-m-Y",strtotime($end)).'.xls';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			header('Cache-Control: max-age=0');                  
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			$objWriter->save('php://output');
		}
    }
	private function rekappmb_to_excel($data=null,$st=null,$end=null,$jns=0){
		if($data!=null && $st!=null && $end!=null){
			$this->excel->getProperties()->setCreator("PADIMAS");
			$this->excel->getProperties()->setTitle("REKAP PMB");
			$this->excel->createSheet();
			$this->excel->setActiveSheetIndex(0); 

			$style = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				)
			);

			$style2 = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				)
			);
			
			$style3 = array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
				)
			);

			$border = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);
			if($jns==0)
				$namafile='PENDAFTAR';
			else
				$namafile='HERREGISTRASI';
			//header
			$this->excel->getActiveSheet()->getStyle("A1")->applyFromArray($style2);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->setCellValue('A1',"REKAP PMB ".$namafile." TANGGAL ".$this->tanggal($st,"dd")." S/D ".$this->tanggal($end,"dd") );
			$this->excel->getActiveSheet()->mergeCells('A1:BP1');

			//merge cells
			$this->excel->getActiveSheet()->mergeCells('A2:A3');
			$this->excel->getActiveSheet()->mergeCells('B2:B3');
			$this->excel->getActiveSheet()->mergeCells('C2:C3');
			$this->excel->getActiveSheet()->mergeCells('D2:D3');
			$this->excel->getActiveSheet()->mergeCells('E2:E3');
			$this->excel->getActiveSheet()->mergeCells('F2:F3');
			$this->excel->getActiveSheet()->mergeCells('G2:G3');
			$this->excel->getActiveSheet()->mergeCells('U2:U3');
			$this->excel->getActiveSheet()->mergeCells('V2:V3');
			$this->excel->getActiveSheet()->mergeCells('W2:W3');
			$this->excel->getActiveSheet()->mergeCells('X2:X3');
			$this->excel->getActiveSheet()->mergeCells('Y2:Y3');
			$this->excel->getActiveSheet()->mergeCells('Z2:Z3');
			$this->excel->getActiveSheet()->mergeCells('AA2:AA3');
			$this->excel->getActiveSheet()->mergeCells('AB2:AB3');
			$this->excel->getActiveSheet()->mergeCells('AC2:AC3');
			$this->excel->getActiveSheet()->mergeCells('AD2:AD3');
			$this->excel->getActiveSheet()->mergeCells('AE2:AE3');
			$this->excel->getActiveSheet()->mergeCells('AF2:AF3');
			$this->excel->getActiveSheet()->mergeCells('AG2:AG3');
			$this->excel->getActiveSheet()->mergeCells('AH2:AH3');
			$this->excel->getActiveSheet()->mergeCells('AI2:AI3');
			$this->excel->getActiveSheet()->mergeCells('AJ2:AJ3');
			$this->excel->getActiveSheet()->mergeCells('AK2:AK3');
			$this->excel->getActiveSheet()->mergeCells('AL2:AL3');
			$this->excel->getActiveSheet()->mergeCells('AM2:AM3');
			$this->excel->getActiveSheet()->mergeCells('AN2:AN3');
			$this->excel->getActiveSheet()->mergeCells('AT2:AT3');
			$this->excel->getActiveSheet()->mergeCells('AU2:AU3');
			$this->excel->getActiveSheet()->mergeCells('AV2:AV3');
			$this->excel->getActiveSheet()->mergeCells('AW2:AW3');
			$this->excel->getActiveSheet()->mergeCells('AX2:AX3');
			$this->excel->getActiveSheet()->mergeCells('AY2:AY3');
			$this->excel->getActiveSheet()->mergeCells('AZ2:AZ3');
			$this->excel->getActiveSheet()->mergeCells('BA2:BA3');
			$this->excel->getActiveSheet()->mergeCells('BB2:BB3');
			$this->excel->getActiveSheet()->mergeCells('BC2:BC3');
			$this->excel->getActiveSheet()->mergeCells('BD2:BD3');
			$this->excel->getActiveSheet()->mergeCells('BE2:BE3');
			$this->excel->getActiveSheet()->mergeCells('BF2:BF3');
			$this->excel->getActiveSheet()->mergeCells('BG2:BG3');
			$this->excel->getActiveSheet()->mergeCells('BH2:BH3');
			$this->excel->getActiveSheet()->mergeCells('BI2:BI3');
			$this->excel->getActiveSheet()->mergeCells('BJ2:BJ3');		
			$this->excel->getActiveSheet()->mergeCells('BK2:BK3');
			$this->excel->getActiveSheet()->mergeCells('BL2:BL3');
			$this->excel->getActiveSheet()->mergeCells('BM2:BM3');
			$this->excel->getActiveSheet()->mergeCells('BN2:BN3');
			$this->excel->getActiveSheet()->mergeCells('BO2:BO3');
			$this->excel->getActiveSheet()->mergeCells('BP2:BP3');
			//tabel header	
			$this->excel->getActiveSheet()->setCellValue('A2','NO');
			$this->excel->getActiveSheet()->setCellValue('B2','ID DAFTAR');
			$this->excel->getActiveSheet()->setCellValue('C2','PRODI PIL 1');
			$this->excel->getActiveSheet()->setCellValue('D2','PRODI PIL 2');
			$this->excel->getActiveSheet()->setCellValue('E2','NAMA');
			$this->excel->getActiveSheet()->setCellValue('F2','NIS');
			$this->excel->getActiveSheet()->setCellValue('G2','PIN');
			$this->excel->getActiveSheet()->mergeCells('H2:L2');
			$this->excel->getActiveSheet()->setCellValue('H2','ASAL SEKOLAH');
			$this->excel->getActiveSheet()->setCellValue('H3','NAMA SEKOLAH');
			$this->excel->getActiveSheet()->setCellValue('I3','JENIS SEKOLAH');
			$this->excel->getActiveSheet()->setCellValue('J3','KEC SEKOLAH');
			$this->excel->getActiveSheet()->setCellValue('K3','KOTA SEKOLAH');
			$this->excel->getActiveSheet()->setCellValue('L3','PROP SEKOLAH');
			$this->excel->getActiveSheet()->mergeCells('M2:P2');
			$this->excel->getActiveSheet()->setCellValue('M2','ALAMAT ASAL');
			$this->excel->getActiveSheet()->setCellValue('M3','ALAMAT');
			$this->excel->getActiveSheet()->setCellValue('N3','KECAMATAN');
			$this->excel->getActiveSheet()->setCellValue('O3','KABUPATEN');
			$this->excel->getActiveSheet()->setCellValue('P3','PROPINSI');
			$this->excel->getActiveSheet()->mergeCells('Q2:T2');
			$this->excel->getActiveSheet()->setCellValue('Q2','ALAMAT SKRG');
			$this->excel->getActiveSheet()->setCellValue('Q3','ALAMAT');
			$this->excel->getActiveSheet()->setCellValue('R3','KECAMATAN');
			$this->excel->getActiveSheet()->setCellValue('S3','KABUPATEN');
			$this->excel->getActiveSheet()->setCellValue('T3','PROPINSI');
			$this->excel->getActiveSheet()->setCellValue('U2','JALUR DAFTAR');
			$this->excel->getActiveSheet()->setCellValue('V2','GELOMBANG');
			$this->excel->getActiveSheet()->setCellValue('W2','TGL TES');
			$this->excel->getActiveSheet()->setCellValue('X2','TGL DAFTAR');
			$this->excel->getActiveSheet()->setCellValue('Y2','OP PENDAFTARAN');
			$this->excel->getActiveSheet()->setCellValue('Z2','BAYAR DAFTAR');
			$this->excel->getActiveSheet()->setCellValue('AA2','BAYAR DAFTAR');
			$this->excel->getActiveSheet()->setCellValue('AB2','JUMLAH PRODI PIL');
			$this->excel->getActiveSheet()->setCellValue('AC2','JK');
			$this->excel->getActiveSheet()->setCellValue('AD2','TELP');
			$this->excel->getActiveSheet()->setCellValue('AE2','AGAMA');
			$this->excel->getActiveSheet()->setCellValue('AF2','TEMPAT LAHIR');
			$this->excel->getActiveSheet()->setCellValue('AG2','TGL LAHIR');
			$this->excel->getActiveSheet()->setCellValue('AH2','JURUSAN SMA');
			$this->excel->getActiveSheet()->setCellValue('AI2','LULUS SMA');
			$this->excel->getActiveSheet()->setCellValue('AJ2','NO STTB');
			$this->excel->getActiveSheet()->setCellValue('AK2','DANEM/IPK');
			$this->excel->getActiveSheet()->setCellValue('AL2','STATUS TRANSFER');
			$this->excel->getActiveSheet()->setCellValue('AM2','ALUMNI');
			$this->excel->getActiveSheet()->setCellValue('AN2','HUB KELUARGA');
			$this->excel->getActiveSheet()->mergeCells('AO2:AS2');
			$this->excel->getActiveSheet()->setCellValue('AO2','NILAI');
			$this->excel->getActiveSheet()->setCellValue('AO3','SMT 1');
			$this->excel->getActiveSheet()->setCellValue('AP3','SMT 2');
			$this->excel->getActiveSheet()->setCellValue('AQ3','SMT 3');
			$this->excel->getActiveSheet()->setCellValue('AR3','SMT 4');
			$this->excel->getActiveSheet()->setCellValue('AS3','UAN');
			$this->excel->getActiveSheet()->setCellValue('AT2','PEWAWANCARA');
			$this->excel->getActiveSheet()->setCellValue('AU2','NILAI TPA');
			$this->excel->getActiveSheet()->setCellValue('AV2','FAKULTAS DITERIMA');
			$this->excel->getActiveSheet()->setCellValue('AW2','PRODI DITERIMA');
			$this->excel->getActiveSheet()->setCellValue('AX2','PENDAPATAN ORTU');
			$this->excel->getActiveSheet()->setCellValue('AY2','REKOMENDASI');
			$this->excel->getActiveSheet()->setCellValue('AZ2','TGL REKOMENDASI');
			$this->excel->getActiveSheet()->setCellValue('BA2','NILAI IDENTITAS');
			$this->excel->getActiveSheet()->setCellValue('BB2','NILAI KEUANGAN');
			$this->excel->getActiveSheet()->setCellValue('BC2','NILAI MOTIVASI');
			$this->excel->getActiveSheet()->setCellValue('BD2','NILAI PERILAKU');
			$this->excel->getActiveSheet()->setCellValue('BE2','TGL HERREGISTRASI');
			$this->excel->getActiveSheet()->setCellValue('BF2','NIM');
			$this->excel->getActiveSheet()->setCellValue('BG2','SPA NORMAL');
			$this->excel->getActiveSheet()->setCellValue('BH2','SPA POTONGAN');
			$this->excel->getActiveSheet()->setCellValue('BI2','SPA BAYAR');
			$this->excel->getActiveSheet()->setCellValue('BJ2','DPA');		
			$this->excel->getActiveSheet()->setCellValue('BK2',$data[0]->persen1.'% SPA 1');
			$this->excel->getActiveSheet()->setCellValue('BL2',$data[0]->persen2.'% SPA 2');
			$this->excel->getActiveSheet()->setCellValue('BM2',$data[0]->persen3.'% SPA 3');
			$this->excel->getActiveSheet()->setCellValue('BN2',$data[0]->persen4.'% SPA 4');
			$this->excel->getActiveSheet()->setCellValue('BO2','PENDAPATAN PEMBIAYA');	
			$this->excel->getActiveSheet()->setCellValue('BP2','UKURAN JAS');	
			
			$this->excel->getActiveSheet()->getStyle("A2:BP3")->applyFromArray($style2);
			$this->excel->getActiveSheet()->getStyle("A2:BP3")->getFont()->setBold(true);

			$this->excel->getActiveSheet()->getStyle("A2:BP3")->applyFromArray($border);
			$i = 3; $no=0;
			for ($j=0; $j < count($data); $j++) {
				$no++; $i++;
				//$this->excel->getActiveSheet()->getStyle("S".$i.":BN".$i)->applyFromArray($style2);
				$this->excel->getActiveSheet()->getStyle("A".$i.":BP".$i)->applyFromArray($border);
				$this->excel->getActiveSheet()->setCellValue('A'.$i,$no);
				$this->excel->getActiveSheet()->setCellValue('B'.$i,$data[$j]->iddaftar);
				$this->excel->getActiveSheet()->setCellValue('C'.$i,$data[$j]->prodi_pil1);
				$this->excel->getActiveSheet()->setCellValue('D'.$i,$data[$j]->prodi_pil2);
				$this->excel->getActiveSheet()->setCellValue('E'.$i,$data[$j]->nama);
				$this->excel->getActiveSheet()->setCellValue('F'.$i,$data[$j]->nis);
				$this->excel->getActiveSheet()->setCellValue('G'.$i,$data[$j]->pin);
				$this->excel->getActiveSheet()->setCellValue('H'.$i,$data[$j]->sklh);
				$this->excel->getActiveSheet()->setCellValue('I'.$i,$data[$j]->jns_sklh);
				$this->excel->getActiveSheet()->setCellValue('J'.$i,$data[$j]->kec_sklh);
				$this->excel->getActiveSheet()->setCellValue('K'.$i,$data[$j]->kota_sklh);
				$this->excel->getActiveSheet()->setCellValue('L'.$i,$data[$j]->prop_sklh);   
				$this->excel->getActiveSheet()->setCellValue('M'.$i,$data[$j]->alamat_asal);
				$this->excel->getActiveSheet()->setCellValue('N'.$i,$data[$j]->kec_asal); 	
				$this->excel->getActiveSheet()->setCellValue('O'.$i,$data[$j]->kota_asal); 	
				$this->excel->getActiveSheet()->setCellValue('P'.$i,$data[$j]->prop_asal); 	
				$this->excel->getActiveSheet()->setCellValue('Q'.$i,$data[$j]->alamat_skrg); 	
				$this->excel->getActiveSheet()->setCellValue('R'.$i,$data[$j]->kec_skrg); 	
				$this->excel->getActiveSheet()->setCellValue('S'.$i,$data[$j]->kota_skrg); 	
				$this->excel->getActiveSheet()->setCellValue('T'.$i,$data[$j]->prop_skrg);	
				$this->excel->getActiveSheet()->setCellValue('U'.$i,$data[$j]->prg_nama);
				$this->excel->getActiveSheet()->setCellValue('V'.$i,$data[$j]->gel);
				$this->excel->getActiveSheet()->setCellValue('W'.$i,$this->tanggal($data[$j]->tgl_tes,"dd"));
				$this->excel->getActiveSheet()->setCellValue('X'.$i,$this->tanggal($data[$j]->tgl_daftar,"dd"));
				$this->excel->getActiveSheet()->setCellValue('Y'.$i,$data[$j]->op_daftar);
				$this->excel->getActiveSheet()->setCellValue('Z'.$i,$data[$j]->byr_daftar);
				$this->excel->getActiveSheet()->setCellValue('AA'.$i,$data[$j]->model_bayar);
				$this->excel->getActiveSheet()->setCellValue('AB'.$i,$data[$j]->jml_pilihan);
				$this->excel->getActiveSheet()->setCellValue('AC'.$i,$data[$j]->jk);
				$this->excel->getActiveSheet()->setCellValue('AD'.$i,$data[$j]->telp);
				$this->excel->getActiveSheet()->setCellValue('AE'.$i,$data[$j]->agama);
				$this->excel->getActiveSheet()->setCellValue('AF'.$i,$data[$j]->tmp_lahir);   
				$this->excel->getActiveSheet()->setCellValue('AG'.$i,$this->tanggal($data[$j]->tgl_lahir,"dd"));
				$this->excel->getActiveSheet()->setCellValue('AH'.$i,$data[$j]->jur_sma); 	
				$this->excel->getActiveSheet()->setCellValue('AI'.$i,$data[$j]->thn_lulus); 	
				$this->excel->getActiveSheet()->setCellValue('AJ'.$i,$data[$j]->sttb); 	
				$this->excel->getActiveSheet()->setCellValue('AK'.$i,$data[$j]->danem); 	
				$this->excel->getActiveSheet()->setCellValue('AL'.$i,$data[$j]->status_transfer); 	
				$this->excel->getActiveSheet()->setCellValue('AM'.$i,$data[$j]->alumni); 	
				$this->excel->getActiveSheet()->setCellValue('AN'.$i,$data[$j]->hub_keluarga);	
				$this->excel->getActiveSheet()->setCellValue('AO'.$i,$data[$j]->rapor_sm1);	
				$this->excel->getActiveSheet()->setCellValue('AP'.$i,$data[$j]->rapor_sm2);	
				$this->excel->getActiveSheet()->setCellValue('AQ'.$i,$data[$j]->rapor_sm3);	
				$this->excel->getActiveSheet()->setCellValue('AR'.$i,$data[$j]->rapor_sm4);	
				$this->excel->getActiveSheet()->setCellValue('AS'.$i,$data[$j]->rerata_uan);	
				$this->excel->getActiveSheet()->setCellValue('AT'.$i,$data[$j]->pewawancara);	
				$this->excel->getActiveSheet()->setCellValue('AU'.$i,$data[$j]->nilai_tpa);	
				$this->excel->getActiveSheet()->setCellValue('AV'.$i,$data[$j]->fakultas);	
				$this->excel->getActiveSheet()->setCellValue('AW'.$i,$data[$j]->prodi);	
				$this->excel->getActiveSheet()->setCellValue('AX'.$i,$data[$j]->pdpt_ortu);	
				$this->excel->getActiveSheet()->setCellValue('AY'.$i,$data[$j]->rekomendasi);	
				$this->excel->getActiveSheet()->setCellValue('AZ'.$i,$this->tanggal($data[$j]->tgl_rekomendasi,"dd"));	
				$this->excel->getActiveSheet()->setCellValue('BA'.$i,$data[$j]->nilai_identitas);	
				$this->excel->getActiveSheet()->setCellValue('BB'.$i,$data[$j]->nilai_keuangan);	
				$this->excel->getActiveSheet()->setCellValue('BC'.$i,$data[$j]->nilai_motivasi);	
				$this->excel->getActiveSheet()->setCellValue('BD'.$i,$data[$j]->nilai_akademik);	
				$this->excel->getActiveSheet()->setCellValue('BE'.$i,$this->tanggal($data[$j]->tgl_herregistrasi,"dd"));	
				$this->excel->getActiveSheet()->setCellValue('BF'.$i,$data[$j]->nim);	
				$this->excel->getActiveSheet()->setCellValue('BG'.$i,$data[$j]->spa);	
				$this->excel->getActiveSheet()->setCellValue('BH'.$i,$data[$j]->spa_pot);	
				$this->excel->getActiveSheet()->setCellValue('BI'.$i,$data[$j]->spa_byr);	
				$this->excel->getActiveSheet()->setCellValue('BJ'.$i,$data[$j]->dpa);	
				$this->excel->getActiveSheet()->setCellValue('BK'.$i,$data[$j]->spa1);	
				$this->excel->getActiveSheet()->setCellValue('BL'.$i,$data[$j]->spa2);	
				$this->excel->getActiveSheet()->setCellValue('BM'.$i,$data[$j]->spa3);	
				$this->excel->getActiveSheet()->setCellValue('BN'.$i,$data[$j]->spa4);
				$this->excel->getActiveSheet()->setCellValue('BO'.$i,$data[$j]->pdpt_pembiaya);	
				$this->excel->getActiveSheet()->setCellValue('BP'.$i,$data[$j]->ukuran_jaz);								
			}
			$filename='REKAP PMB '.$namafile.' TANGGAL '.$st." SD ".$end.'.xls';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			header('Cache-Control: max-age=0');                  
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			$objWriter->save('php://output');
		}
		else 
			redirect("admin/pendaftaran/excel/rekappmb");
    }
    private function global_view($v) {
    	$v['menu'] = $this->mlogin->getmenu_backend($this->session->userdata("user"));
        isset($v['active'])  ? $v['active'] : $v['active'] 	= null;
        isset($v['judul'])   ? $v['judul']  : $v['judul'] 	= null;
        isset($v['menu'])    ? $v['menu'] 	: $v['menu'] 	= null;
        isset($v['content']) ? $v['content']: $v['content'] = null;
        isset($v['data1'])   ? $v['data1'] 	: $v['data1'] 	= null;
        isset($v['data2']) 	 ? $v['data2'] 	: $v['data2'] 	= null;
        isset($v['data3']) 	 ? $v['data3'] 	: $v['data3'] 	= null;
        isset($v['data4']) 	 ? $v['data4'] 	: $v['data4'] 	= null;
        isset($v['data5']) 	 ? $v['data5'] 	: $v['data5'] 	= null;
		isset($v['data6']) 	 ? $v['data6'] 	: $v['data6'] 	= null;
		isset($v['data7']) 	 ? $v['data7'] 	: $v['data7'] 	= null;
		isset($v['data8']) 	 ? $v['data8'] 	: $v['data8'] 	= null;
		isset($v['data9']) 	 ? $v['data9'] 	: $v['data9'] 	= null;
		isset($v['data10']) 	 ? $v['data10'] 	: $v['data10'] 	= null;
		isset($v['data11']) 	 ? $v['data11'] 	: $v['data11'] 	= null;
		isset($v['data12']) 	 ? $v['data12'] 	: $v['data12'] 	= null;
		isset($v['data13']) 	 ? $v['data13'] 	: $v['data13'] 	= null;
		isset($v['data14']) 	 ? $v['data14'] 	: $v['data14'] 	= null;
		isset($v['data15']) 	 ? $v['data15'] 	: $v['data15'] 	= null;
		isset($v['data16']) 	 ? $v['data16'] 	: $v['data16'] 	= null;
		isset($v['data17']) 	 ? $v['data17'] 	: $v['data17'] 	= null;
		isset($v['data18']) 	 ? $v['data18'] 	: $v['data18'] 	= null;
		isset($v['data19']) 	 ? $v['data19'] 	: $v['data19'] 	= null;
		isset($v['data20']) 	 ? $v['data20'] 	: $v['data20'] 	= null;
		isset($v['data21']) 	 ? $v['data21'] 	: $v['data21'] 	= null;
		isset($v['data22']) 	 ? $v['data22'] 	: $v['data22'] 	= null;
		isset($v['data23']) 	 ? $v['data23'] 	: $v['data23'] 	= null;
		isset($v['data24']) 	 ? $v['data24'] 	: $v['data24'] 	= null;
        isset($v['idpage'])  ? $v['idpage'] : $v['idpage'] 	= null;

        if (!isset($v['judul'])) {
        	$v['judul'] = "Admin PADIMAS";
        } else {
        	$v['judul'] = $v['judul']==''?"Admin PADIMAS":$v['judul']." | Admin PADIMAS";
        }

        $data = array(
            "active" 	=> $v['active'],
            "judul" 	=> $v['judul'],
            "view" 		=> $v['content'],
            "menu" 		=> $v['menu'],
            "data1" 	=> $v['data1'],
            "data2" 	=> $v['data2'],
            "data3" 	=> $v['data3'],
            "data4" 	=> $v['data4'],
            "data5" 	=> $v['data5'],
			"data6" 	=> $v['data6'],
			"data7" 	=> $v['data7'],
            "data8" 	=> $v['data8'],
            "data9" 	=> $v['data9'],
            "data10" 	=> $v['data10'],
            "data11" 	=> $v['data11'],
            "data12" 	=> $v['data12'],
            "data13" 	=> $v['data13'],
            "data14" 	=> $v['data14'],
            "data15" 	=> $v['data15'],
			"data16" 	=> $v['data16'],
            "data17" 	=> $v['data17'],
            "data18" 	=> $v['data18'],
            "data19" 	=> $v['data19'],			
			"data20" 	=> $v['data20'],
			"data21" 	=> $v['data21'],
			"data22" 	=> $v['data22'],
			"data23" 	=> $v['data23'],
			"data24" 	=> $v['data24'],
            "idpage"    => $v['idpage'],
			"csrf"		=> ("'".$this->security->get_csrf_token_name()."':'".$this->security->get_csrf_hash()."'"),
        );
        $this->load->view('admin/index', $data);
    }
}
