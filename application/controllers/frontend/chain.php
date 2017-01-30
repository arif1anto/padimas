<?php
     class Chain extends CI_Controller {
    function Chain()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','pagination','encrypt'));
        $this->load->database();
        $this->load->model(array('mmaster'));
		//$this->cek_sess();
		$this->isAjax();
    }

    private function cek_sess() {
        $login = $this->session->userdata('lokal_login');
        if ($login){
            return true;
        } else {
            redirect('maba/login');
        }
    }

    private function isAjax() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest")
            return true;
        else
             redirect('admin');
    } 

    function getKota(){
        $getKota=$this->mmaster->getcbkota_byid($this->input->post('id'));
        echo "<option value=''>- Pilih Kota -</option>";
        foreach($getKota as $r){
            echo '<option value="'.$r->kd_kota.'">'.$r->nama_kota.'</option>';
        }
    }
    
    function getKecamatan(){
            $getKec=$this->mmaster->getcbkec_byid($this->input->post('id'));
            echo "<option value=''>- Pilih Kecamatan -</option>";
            foreach($getKec as $r){
                echo '<option value="'.$r->kd_kecamatan.'">'.$r->nama_kecamatan.'</option>';
            }
    }
    
    function getSekolah(){
        $getSekolah=$this->mmaster->getcbsekolah_byid($this->input->post('id'));
        echo "<option value=''>- Pilih Sekolah -</option>";
        foreach($getSekolah as $r){
            echo '<option value="'.$r->kd_sekolah.'">'.$r->nama_sekolah.'</option>';
        }
		echo "<option value='00000000'>- Lain Lain -</option>";
    }

    function getProdiByJalur(){
        $prodi = $this->mmaster->getcbprodi_bystatus($this->input->post("id"));
        echo "<option value=''>- Pilih -</option>";
        foreach ($prodi as $r) {
            $sel = ($r->kd_proditawar==$this->input->post("p")?"selected":"");
            echo '<option value="'.$r->kd_proditawar.'" '.$sel.'>'.$r->nama_jenjang.' '.$r->nama_jurusan.' ('.$r->nama_program.') - '.$r->nama_status.'</option>';
        }
    }

}