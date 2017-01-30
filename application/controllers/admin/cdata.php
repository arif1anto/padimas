<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cdata extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','pagination','encrypt'));
        $this->load->database();
        $this->load->model(array('mdata','mlogin'));
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
		$v['content'] = "admin/data/pendaftar_harian";
		$this->global_view($v);
	}
	
	public function sebaran_daerah($aksi=null){
		 $v['judul'] = "Sebaran Daerah";
         $v['content'] = "admin/data/sebaran_daerah";
         $v['data1'] = $this->mdata->getSebaranDaerah();         
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
	private function bulan($date=null,$param=null){
		if($date!=null) :
			
			$bln='';
			switch($date){
				case '1' : $bln="Januari" ;break;
				case '2' : $bln="Februari" ;break;
				case '3' : $bln="Maret" ;break;
				case '4' : $bln="April" ;break;
				case '5' : $bln="Mei" ;break;
				case '6' : $bln="Juni" ;break;
				case '7' : $bln="Juli" ;break;
				case '8' : $bln="Agustus" ;break;
				case '9' : $bln="September" ;break;
				case '10' : $bln="Oktober" ;break;
				case '11' : $bln="November" ;break;
				case '12' : $bln="Desember" ;break;
			}
			
			 return $bln;		
		endif;
	}
	public function pendaftar_harian($aksi=null){
		 $v['judul'] = "Laporan Pendaftar Harian";
		 $v['data1'] = $this->mdata->getDaftarHarian();
         $v['content'] = "admin/data/pendaftar_harian"; 
		 $graph= $this->mdata->getGrafikHarian();
		 $data='';
		if($graph!=null){
			foreach($graph as $dt){		
				$data.="{ Tgl: '".$dt->tgl1."', Pil1: ".($dt->jum1!=null ? $dt->jum1 : 0).", Pil2 : ".($dt->jum2!=null ? $dt->jum2 : 0)."},";
			}
			
		}
         $v['chart'] = "
			new Morris.Line({
			  // ID of the element in which to draw the chart.
			  element: 'chartHarian',
			  // Chart data records -- each entry in this array corresponds to a point on
			  // the chart.
			  data: [
				".$data."				
			  ],
			  xkey: 'Tgl',
			  ykeys: ['Pil1','Pil2'],			  
			  axes: 'y',
			  labels: ['Pendaftar','Her-registrasi'],
			  xLabels: 'Hari',
			  lineColors: ['blue','red']
			});
		 ";
         $this->global_view($v);
	}
	
	public function pendaftar_bulanan($aksi=null){
		
		 $v['judul'] = "Laporan Pendaftar Bulanan";
         $v['data1'] = $this->mdata->getDaftarBulanan();
		 $v['content'] = "admin/data/pendaftar_bulanan";
		 $graph= $this->mdata->getGrafikBulanan();
		 $data='';$a=0;
		if($graph!=null){
			foreach($graph as $dt){		
				//$data.="{ Bln: '".$this->bulan($dt->tgl1)." ".$dt->th1."', Pil1: ".($dt->jum1!=null ? $dt->jum1 : 0).", Pil2 : ".($dt->jum2!=null ? $dt->jum2 : 0)."},";
				$data.="{ Bln: '".$dt->tgl1."', Pil1: ".($dt->jum1!=null ? $dt->jum1 : 0).", Pil2 : ".($dt->jum2!=null ? $dt->jum2 : 0)."},";
			$a++;
			}
			
		}
		 $v['chart'] = "
			new Morris.Line({
			  // ID of the element in which to draw the chart.
			  element: 'chartBulanan',
			  // Chart data records -- each entry in this array corresponds to a point on
			  // the chart.
			  data: [
				".$data."				
			  ],
			  xkey: 'Bln',
			  ykeys: ['Pil1','Pil2'],			  
			  axes: 'y',
			  labels: ['Pendaftar','Her-registrasi'],
			  xLabels: 'Bln',
			  lineColors: ['blue','red']
			});
		 ";
         $this->global_view($v);
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
        isset($v['idpage'])  ? $v['idpage'] : $v['idpage'] 	= null;

        // $ses_user = $this->session->userdata('user');
        // $this->load->model('mlogin');
        // $ses=$this->mlogin->masuk_peg($ses_user);
        // $a = 1;
        // foreach ($ses as $s) {
        //     $v['menu'][$a] =$s->hak_akses;
        //     $a++;
        // }

        // if ($ses_user==true) {
        //     $profil=$this->master->qgetprofil($ses_user);
        // }
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
            "chart" 	=> $v['chart'],
            "idpage"    => $v['idpage'],
			"csrf"		=> ("'".$this->security->get_csrf_token_name()."':'".$this->security->get_csrf_hash()."'"),
        );
        $this->load->view('admin/index', $data);
    }
}
