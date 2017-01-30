<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cprogram extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('form_validation','session','pagination','encrypt'));
        $this->load->database();
        $this->load->model(array('martikel','mpage'));
        //$this->cek_sess();
        //menghilangkan cache ketika menekan tombol back sesudah logout
        // $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        // $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        // $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        // $this->output->set_header('Pragma: no-cache');
    }

	public function index(){
        $v['content'] = "frontend/program";
        $this->global_view($v);
	}

    public function pmdk($aksi=null){
        if ($aksi=="daftar") {
            $v['content'] = "frontend/pmdk_form";
        } else {
            $v['content'] = "frontend/pmdk";
        }
        $this->global_view($v);
    }

	private function global_view($v) {
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
        	$v['judul'] = "Penerimaan Mahasiswa Baru";
        } else {
        	$v['judul'] = $v['judul']==''?"Penerimaan Mahasiswa Baru UTY":$v['judul']." | PADIMAS";
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
        $this->load->view('index', $data);
    }
}
