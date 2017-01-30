<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cimage extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('form_validation','session','pagination','encrypt'));
        $this->load->database();
        $this->load->model(array('martikel','mpage','mpengumuman','mmenu','mprogram','mpendaftar','mrekomendasi','mlogin'));
        //$this->cek_sess();
        //menghilangkan cache ketika menekan tombol back sesudah logout
        // $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        // $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        // $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        // $this->output->set_header('Pragma: no-cache');
    }

	public function index(){

	}

    public function thumbnail(){
        $t = $this->uri->total_segments();
        $size = $this->uri->segment($t);
        $ex = explode('x', $size);
        $imgsrc = "";
        for ($i=2; $i < $t; $i++) {
            $imgsrc .= $this->uri->segment($i);
            if ($i<$t-1) {
                $imgsrc .= "/";
            }
        }
        if (is_numeric($ex[0])) {
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'img/'.$imgsrc;
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['master_dim'] = 'width';
            $config['width']    = $ex[0];
            $config['height']   = isset($ex[1])?$ex[1]:$ex[0];
            $config['thumb_marker'] = '_thumb';

            $this->load->library('image_lib', $config); 
            if (!$this->image_lib->resize()) { 
                return false;
            } else{
                $ex = explode('.', $imgsrc);
                $path = 'img/'.$ex[0].$config['thumb_marker'].".".$ex[1];
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                //$base64 = base64_encode($data);
                //$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                header("Content-type: ".$type);
                echo ($data);
                //echo "<image src='".$base64."'>";
            }
        } else{
            $imgsrc = "";
            for ($i=2; $i <= $t; $i++) {
                $imgsrc .= $this->uri->segment($i);
                if ($i<$t) {
                    $imgsrc .= "/";
                }
            }
            $path = 'img/'.$imgsrc;
            if (file_exists($path)) {
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                header("Content-type: ".$type);
                echo ($data);
            } 
        }

    }
}
