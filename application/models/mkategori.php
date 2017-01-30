<?php
class Mkategori extends CI_Model {
	
	var $tb = "pmb_kategori";
	function __construct() {
		parent::__construct();
	}

	function addkategori(){
		$kat =  $this->input->post('kat_nama');
		if (count($this->getkategoriby_nama($kat))<=0) {
			$link = str_replace(" ", "_", $kat);
			$link = strtolower($link);
			$data = array(
						'kat_nama' => $kat,
						'kat_parent_id' => $this->input->post('kat_parent_id'),
						'kat_link' =>  $link);
			$this->db->insert("pmb_kategori",$data);
			return true;
		} else {
			return false;
		}
	}

	private function getkategori(){
		$q = $this->db->select("*")
					  ->from($this->tb);
		return $q;
	}

	function getkategoriby_id($id = 0){
		$q = $this->getkategori();
		$q = $q->where("kat_id",$id);
		return $q->get()->result();
	}

	function getkategoriby_parent($id = null){
		$q = $this->getkategori();
		$q = $q->where("kat_parent_id",$id);
		return $q->get()->result();
	}

	function getcbkategori(){
		$q = $this->getkategori();
		return $q->get()->result();
	}

	function getkategoriby_nama($nama=null){
		$q = $this->db->where("kat_nama",$nama)
					->get("pmb_kategori");
		return $q->get()->result();
	}
}