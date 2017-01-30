<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ctest extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','pagination','encrypt'));
        $this->load->database();
        $this->load->model(array('mtest','mbiaya','mpendaftar','mkonfig','mrekomendasi','mcbt','mlogin'));
        $this->cek_sess();
        //menghilangkan cache ketika menekan tombol back sesudah logout
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
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

    private function cek_sess() {
        $login = $this->session->userdata('login');
        if ($login){
            return true;
        } else {
            redirect('admin/login');
        }
    }

	public function index(){
		$v['content'] = "admin/";
		$this->load->view($v['content']);
	}

    public function jenis_test($aksi=null){
        if ($aksi==null) {
            $v['judul'] = "Jenis Test";
            $v['content'] = "admin/test/jenis_test";
            $v['data1'] = $this->mtest->getjenis_test();
            $this->global_view($v);
        } elseif($aksi=="edit") {
            $id = $this->input->post("id_lama");
            $this->mtest->upjenis_test($id); 
            redirect("admin/test/jenis_test");
        } elseif ($aksi=="tambah") {
            $this->mtest->injenis_test();
            redirect("admin/test/jenis_test");
        } elseif ($aksi=="hapus") {
            $id = $this->input->post("id");
            $this->mtest->deljenis_test($id); 
            redirect("admin/test/jenis_test");
        } else {
            redirect("admin/test/jenis_test");
        }
    }
	
	public function kategori($aksi=null){
        if ($aksi==null) {
            $v['judul'] = "Jenis Test";
            $v['content'] = "admin/test/kategori";
            $v['data1'] = $this->mtest->getkategori();
			$v['data2'] = $this->mtest->getjenis_test();
            $this->global_view($v);
        } elseif($aksi=="edit") {
            $id = $this->input->post("id");
            $this->mtest->upkategori($id); 
            redirect("admin/test/kategori");
        } elseif ($aksi=="tambah") {
            $this->mtest->inkategori();
            redirect("admin/test/kategori");
        } elseif ($aksi=="hapus") {
            $id = $this->input->post("id");
            $this->mtest->delkategori($id); 
            redirect("admin/test/kategori");
        } else {
            redirect("admin/test/kategori");
        }
    }
	
	public function soal_tpa($aksi=null,$id=null){
        $v['judul'] = "Soal Tes Potensi Akademik";
        if ($aksi=="simpan") {
            if ($_POST) {
                $kat_id = $this->input->post("kat");
                $id = $this->input->post('id')+1;
                $cek = $this->mtest->getsoal_tpaby_id($id);
              
                $this->mtest->insoal_tpa($id);
				redirect("admin/test/soal_tpa");
               
            }  
        } else if($aksi=="edit" && $id!=null) {
			if ($_POST) {
                    $this->mtest->upsoal_tpa($id);
					redirect("admin/test/soal_tpa");
                }
		} elseif ($aksi=="hapus") {
			 $id = $this->input->post('id');
			 $this->mtest->delsoal_tpa($id);
			 redirect("admin/test/soal_tpa");
		}
			$v['data1'] = $this->mtest->getjwb_tpaby_id($id);
            $v['data2'] = $this->mtest->getsoal_tpamaxid();
			$v['data3'] = $this->mtest->getkategori();
			$v['data4'] = $this->mtest->getcbsoal_tpa();
			$v['data5'] = $this->mtest->getcbsoal_tpa();
            $v['content'] = "admin/test/soal_tpa";
            $this->global_view($v);
    }
	
	public function resetjwbtpamhs($aksi=null){
		$v['content'] = "admin/test/hapustpamhs";
		if($aksi=='hapus'){
			$id = $this->input->post('id');
			 $this->mtest->deljwb_tpa($id);
			 redirect("admin/test/resetjwbtpamhs");
		}
        $this->global_view($v);
	}


    public function wawancara($id=null,$aksi=null){
		if($id!=null){
			$v['data1'] = $this->mpendaftar->getdaftarwawancara_byid($id);
			$v['data2'] = $this->mkonfig->getsrc_info_set_byid($id);
			//$maxid = $this->input->post('id')+1;
			$maxid = $this->mtest->getwawancaramaxid()+1;
			$v['data4']=$this->mrekomendasi->cekrekomendasi_byid($id);
			$v['data5']=$this->mcbt->gethasiltestby_id($id);
			if($this->session->userdata("konfirmasi")==true){
				$v['data7']='
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Hasil wawancara berhasil disimpan</strong>
				</div>';
			}
			else if(count($v['data4'])>0){
				$v['data7']='
				<div class="alert alert-warning">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Pendaftar dengan nama '.$v['data1']->nama.' pernah melakukan wawancara pada '.$this->tanggal($v['data4'][0]->tgl_rekomendasi,'dd').'</strong>
				</div>';
			}
			$this->session->unset_userdata("konfirmasi");
			
			if($_POST && count($v['data4'])>0 && $aksi=="edit"){
				$this->mpendaftar->updaftarwawancara($id);
				$this->mpendaftar->inkeluarga($id,"ayah");
				$this->mpendaftar->inkeluarga($id,"ibu");
				$this->mtest->upwawancara($id,$this->session->userdata('user'));
				$this->mbiaya->inBayarHer($id,$this->input->post('prodi',TRUE),$this->session->userdata('user'));
				$this->mkonfig->upsrc_info_set($id);
				$this->session->set_userdata("konfirmasi",true);
				redirect("admin/test/wawancara/".$id);
			}else if($_POST && count($v['data4'])==0){
				$this->mpendaftar->updaftarwawancara($id);
				$this->mpendaftar->inkeluarga($id,"ayah");
				$this->mpendaftar->inkeluarga($id,"ibu");
				$this->mtest->inwawancara($maxid,$id,$this->session->userdata('user'));
				$this->mbiaya->inBayarHer($id,$this->input->post('prodi',TRUE),$this->session->userdata('user'));
				$this->mkonfig->upsrc_info_set($id);
				$this->session->set_userdata("konfirmasi",true);
				redirect("admin/test/wawancara/".$id);
			}
		}
		$v['data6']=$this->mkonfig->qgetprogramprodi();
		$v['data3'] = $this->mtest->getwawancaramaxid();
        $v['judul'] = "Test Wawancara";
        $v['content'] = "admin/test/wawancara";
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
		isset($v['data6']) 	 ? $v['data6'] 	: $v['data6'] 	= null;
		isset($v['data7']) 	 ? $v['data7'] 	: $v['data7'] 	= null;
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
            "idpage"    => $v['idpage'],
			"csrf"		=> ("'".$this->security->get_csrf_token_name()."':'".$this->security->get_csrf_hash()."'"),
        );
        $this->load->view('admin/index', $data);
    }
}
