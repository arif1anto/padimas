<?php

class Mcbt extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}

	function login(){
		$q = $this->db->select('*')
				      ->from("pmb_pendaftar a")
				      ->where('id_daftar',$this->security->xss_clean(trim($this->input->post('nodaftar'))))
				      ->where("pin = '".$this->security->xss_clean(trim($this->input->post('pass')))."'")
				      ->get();
		if ($q->num_rows()>0) {
			return true;
		} else {
			return false;
		}
	}

	function getsoaltpa(){
		$q = $this->db->select('*')
					  ->from("pmb_soaltestpa a")
					  ->join("pmb_kategorisoaltes b","a.id_kategori=b.id_kategori")
					  ->join("pmb_jawabantestpa c","a.id_soal=c.id_soal")
					  ->where("a.aktif","Y")
					  ->order_by("b.id_kategori","ASC")
					  ->order_by("a.id_soal","ASC")
					  //->order_by("rand()","")
					  ->get();
		return $q->result();
	}

	function getpendaftarby_id($id = null){
		if ($id!=null) {
			$q = $this->db->select("*")
					  ->from("pmb_pendaftar a")
					  ->where("a.id_daftar",$id)
					  ->get();
			return $q->result();
		} else {
			return false;
		}
	}

	function getjumlahsoal(){
		$q = $this->db->query("SELECT COUNT(*) AS jml_soal FROM pmb_soaltestpa WHERE aktif='Y'");
		return $q->result();
	}

	function getdetail_hasiltestby_id($id_daftar=null){
		if ($id_daftar!=null) {
			$q = $this->db->select("*")
					  ->from("pmb_testpa a")
					  ->join("pmb_pendaftar b","a.id_daftar=b.id_daftar","inner")
					  ->join("pmb_soaltestpa c","a.id_soal=c.id_soal","inner")
					  ->join("pmb_jawabantestpa d","a.id_soal=d.id_soal and a.id_jawaban=d.id_jawaban","left")
					  ->get();
			return $q->result();
		} else {
			return false;
		}
	}

	function gethasiltestby_id($id_daftar=null){
		if ($id_daftar!=null) {
			$q = $this->db->select("COUNT(a.id_soal) jml_soal, COUNT(b.id_jawaban) dijawab")
					  ->select("COUNT(CASE b.kunci_jawaban WHEN 1 THEN 1 ELSE NULL END) benar, SUM(b.nilai) skor")
					  ->from("pmb_testpa a")
					  ->join("pmb_jawabantestpa b","a.id_soal=b.id_soal and a.id_jawaban=b.id_jawaban","left")
					  ->where("a.id_daftar",$id_daftar)
					  ->get();
			return $q->result();
		} else {
			return false;
		}
	}

	private function cekexist($id_daftar=null,$id_soal=null){
		if ($id_daftar!=null && $id_soal!=null) {
			$q=$this->db->select("*")
						->from("pmb_testpa a")
						->where("a.id_daftar",$id_daftar)
						->where("a.id_soal",$id_soal)
						->get();
			return ($q->num_rows()>0);
		} else {
			return false;
		}
	}

	function intesttpa($id_daftar=null, $id_soal=null, $id_jawaban=null){
		if ($this->cekexist($id_daftar,$id_soal)) {
			//update
			$data = array(
				'id_daftar'=>$id_daftar,
				'id_soal'=> $id_soal,
				'id_jawaban'=> $id_jawaban,
				'tgl_tes'=> date("Y/m/d")
				);
			$this->db->where(array('id_daftar' => $id_daftar, 'id_soal' => $id_soal));
			$this->db->update('pmb_testpa',$data);
		} else {
			//insert
			$data = array(
				'id_daftar'=>$id_daftar,
				'id_soal'=> $id_soal,
				'id_jawaban'=> $id_jawaban,
				'tgl_tes'=> date("Y/m/d")
				);
			$this->db->insert('pmb_testpa', $data);
			return true;
		}
	}

}