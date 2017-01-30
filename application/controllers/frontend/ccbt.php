<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ccbt extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('form_validation','session','pagination','encrypt'));
        $this->load->database();
        $this->load->model(array('mcbt'));
        //menghilangkan cache ketika menekan tombol back sesudah logout
        // $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        // $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        // $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        // $this->output->set_header('Pragma: no-cache');
    }

    private function cek_sess() {
        $login = $this->session->userdata('cbt_login');
        if ($login){
            return true;
        } else {
            redirect('tpa/login');
        }
    }

    private function isAjax() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest")
            return true;
        else
            redirect('tpa/login');
    } 

	public function index(){
        $this->cek_sess();
        $id = $this->session->userdata("cbt_login");
        $v['data1'] = $this->mcbt->getpendaftarby_id($id);
        $v['data2'] = $this->mcbt->gethasiltestby_id($id);
        $v['content'] = "frontend/cbt/preload";
        $this->global_view($v);
	}

    public function login($aksi=null){
        if($_POST){
            $uname = $this->input->post("nodaftar");
            if($this->mcbt->login()){
                $this->session->set_userdata("cbt_login",$uname);
                redirect("tpa/index");
            } else {
                $v['data1'] = "Username atau password yang anda masukkan salah";
                $v['data2'] = $uname;
            }
        } else {
            if($aksi!=null) {
                redirect("tpa/login");
            }
        }
        $v['content'] = "frontend/cbt/login";
        $this->global_view($v);
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect("tpa");
    }

    public function test($aksi=null){
        $this->cek_sess();
        $this->session->set_userdata("cbt_time",0);
        $id = $this->session->userdata("cbt_login");
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
                redirect("tpa");
            }
        } elseif($aksi==null) {
            $v['data2'] = $this->mcbt->getsoaltpa();
            $v['content'] = "frontend/cbt/test";
        } else {
            redirect("tpa/test");
        }
        $v['data3'] = $this->mcbt->getjumlahsoal();
        $this->global_view($v);
    }

    // ajax update session waktu tes
    public function uptime(){
        //$this->isAjax();
        //$this->cek_sess();
        $time = $this->input->post("tm");
        $this->session->set_userdata("cbt_time",$time);
        echo $time;
    }

    // ajax get session waktu tes
    public function gettime(){
        //$this->isAjax();
        //$this->cek_sess();
        echo $this->session->userdata("cbt_time");
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
        	$v['judul'] = "Test Potensi Akademi Online | PADIMAS";
        } else {
        	$v['judul'] = $v['judul']==''?"Test Potendi Akademi Online | PADIMAS":$v['judul']." |  PADIMAS";
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
        $this->load->view('frontend/cbt/index', $data);
    }
}
