<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class clogin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','encrypt','mathcaptcha'));
        $this->load->database();
        $this->load->model(array('mlogin'));
        // menghilangkan cache ketika menekan tombol back sesudah logout
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
    }
	public function index(){
		$config['question_format']='numeric';
		$config['answer_format']='numeric';
		$this->mathcaptcha->init($config);
		$capca=$this->security->xss_clean(trim($this->input->post('mumet')));
		$cekcapca=$this->mathcaptcha->check_answer($capca);
		if ($_POST) {	
            if ($this->mlogin->login() && $cekcapca==TRUE) {
                $this->session->set_userdata('login',true);
                $this->session->set_userdata('user',$this->input->post('uname'));
                $user = $this->mlogin->getauthorby_uname($this->input->post('uname'));
                $this->session->set_userdata('role',$user->group);
                redirect('admin');
            } else if(!$this->mlogin->login() && $cekcapca==TRUE){
				$pesan = '<div class="bs-callout bs-callout-danger">
                        <h4>Login gagal</h4>
                        <p>Username atau Password salah</p>
                      </div>';
                $data['pesan'] = $pesan;
			} else {
                $pesan = '<div class="bs-callout bs-callout-danger">
                        <h4>Login gagal</h4>
                        <p>Captcha Salah</p>
                      </div>';
                $data['pesan'] = $pesan;
            }
        } elseif ($this->session->userdata('login')) {
            redirect('admin');
        }
		$data['captcha'] = $this->mathcaptcha->get_question();
		$this->load->view('admin/login',$data);
   
	}

    public function logout(){
        $this->session->sess_destroy();
        redirect('admin/login');
    }
}
