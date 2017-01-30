<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ckonfig extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','pagination','encrypt'));
        $this->load->database();
        $this->load->model(array('mkonfig','mprogram','mbiaya','mlogin'));
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
        $v['judul'] = "Kanal Konfigurasi";
		$v['content'] = "admin/konfig/index";
		$this->global_view($v);
	}
	
	public function setup_gelombang($aksi=null){
		if($aksi=="edit") {
            $id = $this->input->post("id");
            $this->mkonfig->upsetup_gelombang($id); 
            redirect("admin/konfigurasi/setup_gelombang");
        } elseif ($aksi=="tambah") {
            $this->mkonfig->insetup_gelombang();
            redirect("admin/konfigurasi/setup_gelombang");
        } elseif ($aksi=="hapus") {
            $id = $this->input->post("id");
            $this->mkonfig->delsetup_gelombang($id); 
            redirect("admin/konfigurasi/setup_gelombang");
        }
		 $v['judul'] = "Jenis Beasiswa";
         $v['content'] = "admin/konfig/setup_gelombang";
         $v['data1'] = $this->mkonfig->getsetup_gelombang();
         $this->global_view($v);
	}	

    public function jenis_beasiswa($aksi=null){
        if ($aksi==null) {
            $v['judul'] = "Jenis Beasiswa";
            $v['content'] = "admin/konfig/jenis_beasiswa";
            $v['data1'] = $this->mkonfig->getjenis_beasiswa();
            $this->global_view($v);
        } elseif($aksi=="edit") {
            $id = $this->input->post("id");
            $this->mkonfig->upjenis_beasiswa($id); 
            redirect("admin/konfigurasi/jenis_beasiswa");
        } elseif ($aksi=="tambah") {
            $this->mkonfig->injenis_beasiswa();
            redirect("admin/konfigurasi/jenis_beasiswa");
        } elseif ($aksi=="hapus") {
            $id = $this->input->post("id");
            $this->mkonfig->deljenis_beasiswa($id); 
            redirect("admin/konfigurasi/jenis_beasiswa");
        } else {
            redirect("admin/konfigurasi/jenis_beasiswa");
        }
    }
	
	public function format_nomor($aksi=null){
        if ($aksi==null) {
            $v['judul'] = "Format Nomor Pendaftaran";
            $v['content'] = "admin/konfig/format_nopendaftaran";
			$v['data1'] = $this->mprogram->getprogramby();
            $v['data2'] = $this->mkonfig->getformat_nodaftar();
            $this->global_view($v);
        } elseif($aksi=="edit") {
            $id = $this->input->post("id");
            $this->mkonfig->upformat_nodaftar($id); 
            redirect("admin/konfigurasi/format_nomor");
        } elseif ($aksi=="tambah") {
            $this->mkonfig->informat_nodaftar();
            redirect("admin/konfigurasi/format_nomor");
        } elseif ($aksi=="hapus") {
            $id = $this->input->post("id");
            $this->mkonfig->delformat_nodaftar($id); 
            redirect("admin/konfigurasi/format_nomor");
        } else {
            redirect("admin/konfigurasi/format_nomor");
        }
    }
	
	public function program_studi($aksi=null){
        if ($aksi==null) {
            $v['judul'] = "Setup Program Studi";
            $v['content'] = "admin/konfig/program_studi";
			$v['data1'] = $this->mkonfig->qgetprodi();
			$v['data2'] = $this->mkonfig->qgetprogramprodi();
            $this->global_view($v);
        } elseif($aksi=="edit") {
            $id = $this->input->post("id");
            $this->mkonfig->upprogramprodi($id); 
            redirect("admin/konfigurasi/program_studi");
        } elseif ($aksi=="tambah") {
            $this->mkonfig->inprogramprodi();
            redirect("admin/konfigurasi/program_studi");
        } elseif ($aksi=="hapus") {
            $id = $this->input->post("id");
            $this->mkonfig->delprogramprodi($id); 
            redirect("admin/konfigurasi/program_studi");
        } else {
            redirect("admin/konfigurasi/program_studi");
        }
    }	
	
	public function biaya($aksi=null){
        $th=$this->mkonfig->getkonfig('active_year');
		if ($aksi==null) {
            $v['judul'] = "Setup Biaya";
            $v['content'] = "admin/konfig/biaya";
			$v['data1'] = $this->mkonfig->qgetprogramprodi();
			$v['data2'] = $this->mkonfig->qgetprogrambiaya();
			$v['data3'] = $this->mbiaya->getangsuran();
            $this->global_view($v);
        } elseif($aksi=="edit") {
            $id = $this->input->post("id");
            $this->mbiaya->upbiaya($id); 
            redirect("admin/konfigurasi/biaya");
        } elseif ($aksi=="tambah") {
			$this->mbiaya->inbiaya($th->active_year);
            redirect("admin/konfigurasi/biaya");
        } elseif ($aksi=="hapus") {
            $id = $this->input->post("id");
            $this->mbiaya->delbiaya($id); 
            redirect("admin/konfigurasi/biaya");
        } elseif($aksi=="angsuran") {
            $this->mbiaya->upangsuran(); 
            redirect("admin/konfigurasi/biaya");
		} elseif($aksi=="upthnberlaku") {
            $this->mbiaya->upthnberlaku($th->active_year); 
            redirect("admin/konfigurasi/biaya");
        }
		else {
            redirect("admin/konfigurasi/biaya");
        }
    }
	
	public function user($aksi=null){
        if ($aksi==null) {
            $v['judul'] = "Konfigurasi User";
            $v['content'] = "admin/konfig/users";
            $v['data1'] = $this->mkonfig->getuser();
			$v['data2'] = $this->mkonfig->getgroupuser();
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
	
	public function src_info($aksi=null){
        if ($aksi==null) {
            $v['judul'] = "Jenis Beasiswa";
            $v['content'] = "admin/konfig/infosumber";
            $v['data1'] = $this->mkonfig->getsrc_info();
            $this->global_view($v);
        } elseif($aksi=="edit") {
            $id = $this->input->post("id");
            $this->mkonfig->upsrc_info($id); 
            redirect("admin/konfigurasi/src_info");
        } elseif ($aksi=="tambah") {
            $this->mkonfig->insrc_info();
            redirect("admin/konfigurasi/src_info");
        } elseif ($aksi=="hapus") {
            $id = $this->input->post("id");
            $this->mkonfig->delsrc_info($id); 
            redirect("admin/konfigurasi/src_info");
        } else {
            redirect("admin/konfigurasi/src_info");
        }
    }
	
	public function syarat_her($aksi=null){
        if ($aksi==null) {
            $v['judul'] = "Syarat Her-Registrasi";
            $v['content'] = "admin/konfig/syarat_her";
            $v['data1'] = $this->mkonfig->getsyarat_her();
            $this->global_view($v);
        } elseif($aksi=="edit") {
            $id = $this->input->post("id");
            $this->mkonfig->upsyarat_her($id); 
            redirect("admin/konfigurasi/syarat_her");
        } elseif ($aksi=="tambah") {
            $this->mkonfig->insyarat_her();
            redirect("admin/konfigurasi/syarat_her");
        } elseif ($aksi=="hapus") {
            $id = $this->input->post("id");
            $this->mkonfig->delsyarat_her($id); 
            redirect("admin/konfigurasi/syarat_her");
        } else {
            redirect("admin/konfigurasi/syarat_her");
        }
    }
	
	public function umum($aksi=null){
        if ($aksi==null) {
            $v['judul'] = "Konfigurasi Umum";
            $v['content'] = "admin/konfig/konfig";
            $v['data1'] = $this->mkonfig->qGetKonfigUmum();
            $this->global_view($v);
        } elseif($aksi=="edit") {
            $id = $this->input->post("id");
            $this->mkonfig->qUpKonfigUmum($id); 
            redirect("admin/konfigurasi/umum");
        } else {
            redirect("admin/konfigurasi/umum");
        }
    }

    // Hak Akses
    public function hakakses($aksi=null){
        if ($aksi=="simpan") {
            $menu = $this->input->post('menu');
            $id = $this->input->post("hakakses");
            $this->mlogin->delete_hakakses($id);
            foreach ($menu as $row) {
                $this->mlogin->add_hakakses($id,$row);
            }
            $this->session->set_userdata('pesan','sukses');
            redirect('admin/konfigurasi/hakakses');
        } else {
            $pesan = $this->session->userdata('pesan');
            $this->session->unset_userdata('pesan');
            $v['content'] = "admin/konfig/hakakses";
            $v['data1']   = $this->mlogin->getmenu_checkbox($this->session->userdata("user"));
            $v['data2']   = $this->mlogin->getgroup_akses();
            $v['data3']   = $pesan;
            $this->global_view($v);
        }
    }


    // end of hak akses

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
