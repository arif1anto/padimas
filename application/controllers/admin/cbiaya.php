<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cbiaya extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','pagination','encrypt'));
        $this->load->database();
        $this->load->model(array('mprogram','mlogin'));
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
		$v['content'] = "admin/byr_pendaftaran";
		$this->global_view($v);
	}
	
	public function byr_daftar($aksi=null){
		if ($aksi==null) {
            $v['judul'] = "Pembayaran Pendaftaran";
            $v['content'] = "admin/byr_pendaftaran";
            $v['data1'] = $this->mprogram->getprogramby();
            $this->global_view($v);
        } elseif($aksi=="edit") {
            $id = $this->input->post("id");
            $this->mkonfig->upuser($id); 
            redirect("admin/konfigurasi/user");
        } elseif ($aksi=="tambah") {
            $this->mkonfig->inuser();
            redirect("admin/konfigurasi/user");
        } elseif ($aksi=="hapus") {
            $id = $this->input->post("id");
            $this->mkonfig->deluser($id); 
            redirect("admin/konfigurasi/user");
        } else {
            redirect("admin/konfigurasi/user");
        }
		
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
            "idpage"    => $v['idpage'],
			"csrf"		=> ("'".$this->security->get_csrf_token_name()."':'".$this->security->get_csrf_hash()."'"),
        );
        $this->load->view('admin/index', $data);
    }
}
