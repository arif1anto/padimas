<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clokal extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('form_validation','session','pagination','encrypt','mathcaptcha'));
        $this->load->database();
        $this->load->model(array('mcbt','mmaster','mpendaftar','mprogram','mkonfig'));
        //menghilangkan cache ketika menekan tombol back sesudah logout
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
    }

    private function cek_sess() {
        $login = $this->session->userdata('lokal_login');
        if ($login){
            return true;
        } else {
            redirect('maba/login');
        }
    }

	public function index(){
        $this->cek_sess();
        $id = $this->session->userdata("lokal_login");
        $v['data1'] = $this->mcbt->getpendaftarby_id($id);
        $v['data2'] = $this->mcbt->gethasiltestby_id($id);
        $v['content'] = "frontend/daftar/home";
        $this->global_view($v);
	}

    public function login($aksi=null){
		$config['question_format']='numeric';
		$config['answer_format']='numeric';
		$this->mathcaptcha->init($config);
		$capca=$this->security->xss_clean(trim($this->input->post('mumet')));
		$uname = $this->security->xss_clean(trim($this->input->post("nodaftar")));
        if($_POST){
            if($this->mcbt->login() && $this->mathcaptcha->check_answer($capca)==TRUE){
                $this->session->set_userdata("lokal_login",$uname);
                redirect("maba");
            } else if(!$this->mcbt->login() && $this->mathcaptcha->check_answer($capca)==TRUE){
				$v['data1'] = "Username atau password yang anda masukkan salah";
                $v['data2'] = $uname;
			}else {
                $v['data1'] = "Captcha yang anda masukkan salah";
                $v['data2'] = $uname;
            }
        } else {
            if($aksi!=null) {
                redirect("maba/login");
            }
        }
		$v['data3'] = $this->mathcaptcha->get_question();
        $v['content'] = "frontend/cbt/login";
        $this->global_view($v);
    }

    public function logout(){
        $this->session->unset_userdata('lokal_login');
        $this->session->sess_destroy();
        redirect("maba/login");
    }


    public function pendaftaran($aksi=null){
        $this->cek_sess();
        $id = $this->session->userdata("lokal_login");
        if ($aksi==null) {
            $v['data1']     = $this->mmaster->getcbprodi();
            $v['data2']     = $this->mpendaftar->getpendaftar_maba_byid($id);
            if(count($v['data1'])>0){
                $v['data3']     = $this->mprogram->getcbprogram();
                $v['data4']     = $this->mmaster->getcbagama();
                $v['data5']     = $this->mmaster->getcbpropinsi();
                $v['data6']     = $this->mmaster->getcbkota_byid($v['data2']->prop_asal);
                $v['data7']     = $this->mmaster->getcbkec_byid($v['data2']->kab_asal);
                $v['data8']     = $this->mmaster->getcbkota_byid($v['data2']->prop_sekolah);
                $v['data9']     = $this->mmaster->getcbkec_byid($v['data2']->kota_sekolah);
                $v['data10']    = $this->mmaster->getcbsekolah_byid($v['data2']->kec_sekolah);
                $v['data11']    = $this->mkonfig->getsrc_info_set_byid($id);
            }
            //$v['data13']    = $this->mmaster->getcbstatus_prodi();
            $v['content']   = "frontend/daftar/pendaftaran";
            $this->global_view($v);
        } elseif ($aksi=="simpan") {
            if ($_POST) {
                $this->mpendaftar->uppendaftar_bymhs($id);
                $this->mkonfig->upsrc_info_set($id);
            } 
            redirect("maba/pendaftaran");
        } else {
            redirect("maba/pendaftaran");
        }
    }

    public function herregistrasi($aksi=null){
        $this->cek_sess();
        $id = $this->session->userdata("lokal_login");
		$konfirm=null;
        if ($this->mpendaftar->getstatusterima($id)==false) {
            redirect("maba");
        } elseif ($aksi==null) {
            $v["content"] = "frontend/daftar/herregistrasi";
            $v['data1']     = $this->mpendaftar->getherregistrasi_maba_byid($id);
            if(count($v['data1'])>0){
                $v['data2']     = $this->mmaster->getcbagama();
                $v['data3']     = $this->mmaster->getcbpropinsi();
                $v['data4']     = $this->mmaster->getcbkota_byid($v['data1']->prop_asal);
                $v['data5']     = $this->mmaster->getcbkec_byid($v['data1']->kab_asal);
                $v['data6']     = $this->mmaster->getcbkota_byid('040000');//Yogyakarta
                $v['data7']     = $this->mmaster->getcbkec_byid($v['data1']->kab_skrg);
                $v['data8']     = $this->mmaster->getcbkota_byid($v['data1']->prop_sekolah);
                $v['data9']     = $this->mmaster->getcbkec_byid($v['data1']->kota_sekolah);
                $v['data10']    = $this->mmaster->getcbsekolah_byid($v['data1']->kec_sekolah);
                $v['data11']     = $this->mmaster->getcbkota_byid($v['data1']->prop_ayah);
                $v['data12']     = $this->mmaster->getcbkec_byid($v['data1']->kab_ayah);
                $v['data13']     = $this->mmaster->getcbkota_byid($v['data1']->prop_ibu);
                $v['data14']     = $this->mmaster->getcbkec_byid($v['data1']->kab_ibu);
                $v['data15']     = $this->mmaster->getcbkota_byid($v['data1']->prop_wali);
                $v['data16']     = $this->mmaster->getcbkec_byid($v['data1']->kab_wali);
                $v['data17']     = $this->mmaster->getcbkota_byid($v['data1']->prop_sutri);
                $v['data18']     = $this->mmaster->getcbkec_byid($v['data1']->kab_sutri);
            }
            
        } elseif($aksi=="simpan"){
            if ($_POST) {
                if($this->mpendaftar->upherregistrasi_bymhs($id))
                    $this->session->set_userdata("konfirm",1);
				else
					$this->session->set_userdata("konfirm",2);
            } 
            redirect("maba/herregistrasi");
        } else {
            redirect("maba/herregistrasi");
        }
		if($this->session->userdata("konfirm")==1)
			$v['data19']    = '
				<div class="alert alert-dismissible alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<h4 style="text-transform:uppercase">Selamat Anda berhasil Melakukan Herregistrasi</h4>
					<p>Selanjutnya silahkan menuju Loket Pendaftaran untuk proses berikutnya.</p>
				</div>';
		elseif($this->session->userdata("konfirm")==2)
			$v['data19']    = '
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>DATA GAGAL DISIMPAN</strong>
				</div>';
		$this->global_view($v);
		$this->session->unset_userdata("konfirm");
    }

    public function test($aksi=null){
        $this->cek_sess();
        $id = $this->session->userdata("lokal_login");
        $v['data1'] = $this->mcbt->getpendaftarby_id($id);
        if ($aksi=='selesai') {
            if ($_POST) {
                $soal = $this->input->post("soal");
                $jwb = $this->input->post("jawaban");
                $soaljawab = count($soal);
                for ($i=0; $i < count($soal); $i++) { 
                    $jawab = isset($jwb[$i]) ? $jwb[$i] : null;
                    $this->mcbt->intesttpa($id,$soal[$i],$jawab);
                    if ($jawab==null) {
                        $soaljawab--;
                    }
                }
                $v['data2'] = $this->mcbt->gethasiltestby_id($id);
                $v['content'] = "frontend/cbt/test_hasil";
            } else {
                redirect("maba/test");
            }
        } elseif($aksi=="mulai") {
            $hasil = $this->mcbt->gethasiltestby_id($id);
            if ($hasil[0]->jml_soal>0) {
                redirect("maba/test");
            } else {
                $v['data2'] = $this->mcbt->getsoaltpa();
                $v['content'] = "frontend/cbt/test";
            }
        } elseif ($aksi==null) {
            $v['data1'] = $this->mcbt->getpendaftarby_id($id);
            $v['data2'] = $this->mcbt->gethasiltestby_id($id);
            $v['content'] = "frontend/cbt/preload";
        } else {
            //redirect("maba/test");
        }
        $v['data3'] = $this->mcbt->getjumlahsoal();
        $this->global_view($v);
    }

	private function global_view($v) {
        isset($v['active'])  ? $v['active']     : $v['active'] 	= null;
        isset($v['judul'])   ? $v['judul']      : $v['judul'] 	= null;
        isset($v['menu'])    ? $v['menu'] 	    : $v['menu'] 	= null;
        isset($v['content']) ? $v['content']    : $v['content'] = null;
        isset($v['data1'])   ? $v['data1'] 	    : $v['data1'] 	= null;
        isset($v['data2']) 	 ? $v['data2'] 	    : $v['data2'] 	= null;
        isset($v['data3']) 	 ? $v['data3'] 	    : $v['data3'] 	= null;
        isset($v['data4']) 	 ? $v['data4'] 	    : $v['data4'] 	= null;
        isset($v['data5']) 	 ? $v['data5'] 	    : $v['data5'] 	= null;
        isset($v['data6'])   ? $v['data6']      : $v['data6']   = null;
        isset($v['data7'])   ? $v['data7']      : $v['data7']   = null;
        isset($v['data8'])   ? $v['data8']      : $v['data8']   = null;
        isset($v['data9'])   ? $v['data9']      : $v['data9']   = null;
        isset($v['data10'])  ? $v['data10']     : $v['data10']  = null;
        isset($v['data11'])  ? $v['data11']     : $v['data11']  = null;
        isset($v['data12'])  ? $v['data12']     : $v['data12']  = null;
        isset($v['data13'])  ? $v['data13']     : $v['data13']  = null;
        isset($v['data14'])  ? $v['data14']     : $v['data14']  = null;
        isset($v['data15'])  ? $v['data15']     : $v['data15']  = null;
        isset($v['data16'])  ? $v['data16']     : $v['data16']  = null;
        isset($v['data17'])  ? $v['data17']     : $v['data17']  = null;
        isset($v['data18'])  ? $v['data18']     : $v['data18']  = null;
        isset($v['data19'])  ? $v['data19']     : $v['data19']  = null;
        isset($v['data20'])  ? $v['data20']     : $v['data20']  = null;
        isset($v['idpage'])  ? $v['idpage']     : $v['idpage'] 	= null;

        if (!isset($v['judul'])) {
        	$v['judul'] = "Test Potensi Akademi Online | PADIMAS";
        } else {
        	$v['judul'] = $v['judul']==''?"Test Potendi Akademi Online | PADIMAS":$v['judul']." |  PADIMAS";
        }

        $url = $this->uri->segment(2);
        $v['menu']['home']          = '<li class="'.($url==''?'active':'').'"><a href="'.base_url().index_page().'maba" title="Pendaftaran"><i class="fa fa-home fa-fw"></i>Home</a></li>';
        //$v['menu']['pendaftaran']   = '<li class="'.($url=='pendaftaran'?'active':'').'"><a href="'.base_url().index_page().'maba/pendaftaran" title="Pendaftaran"><i class="fa fa-list-alt fa-fw"></i>Pendaftaran</a></li>';
        $v['menu']['test']          = '<li class="'.($url=='test'?'active':'').'"><a href="'.base_url().index_page().'maba/test" title="Test Tertulis"><i class="fa fa-edit fa-fw"></i>Test Tertulis</a></li>';
        $v['menu']['herregistrasi'] = '<li class="'.($url=='herregistrasi'?'active':'').'"><a href="'.base_url().index_page().'maba/herregistrasi" title="Her Registrasi"><i class="fa fa-list-alt fa-fw"></i>Her Registrasi</a></li>';
        $v['menu']['logout']        = '<li><a href="'.base_url().index_page().'maba/logout" title="Keluar"><i class="fa fa-list-alt fa-fw"></i>Keluar</a></li>';

        $id = $this->session->userdata("lokal_login");
        if ($this->mpendaftar->getstatusterima($id)==false) {
            $v['menu']['herregistrasi'] = null;
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
            "data6"     => $v['data6'],
            "data7"     => $v['data7'],
            "data8"     => $v['data8'],
            "data9"     => $v['data9'],
            "data10"    => $v['data10'],
            "data11"    => $v['data11'],
            "data12"    => $v['data12'],
            "data13"    => $v['data13'],
            "data14"    => $v['data14'],
            "data15"    => $v['data15'],
            "data16"    => $v['data16'],
            "data17"    => $v['data17'],
            "data18"    => $v['data18'],
            "data19"    => $v['data19'],
            "data20"    => $v['data20'],
            "idpage"    => $v['idpage'],
			"csrf"		=> ("'".$this->security->get_csrf_token_name()."':'".$this->security->get_csrf_hash()."'"),
        );
        $this->load->view('frontend/daftar/index', $data);
    }
}
