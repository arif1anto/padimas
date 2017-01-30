<?php

class Mprogram extends CI_Model {
	
	var $tb = "pmb_program";
	function __construct() {
		parent::__construct();
	}

	function inprogram($form=null){
		$data = array(
				'prg_nama' 		=> $this->input->post('nama_prg'),
				'prg_judul' 	=> $this->input->post('judul'),
				'prg_deskripsi' => $this->input->post('deskripsi'),
				'prg_link' 		=> $this->input->post('link'),
				'prg_tglmulai' 	=> $this->input->post('tglmulai'),
				'prg_tglakhir' 	=> $this->input->post('tglakhir'),
				'prg_form'		=> $form
				);
		$this->db->insert($this->tb, $data);
		return true;
	}
	
	function upprogram($id=null, $form=null) {
		$data = array(
				'prg_nama' 		=> $this->input->post('nama_prg'),
				'prg_judul' 	=> $this->input->post('judul'),
				'prg_deskripsi' => $this->input->post('deskripsi'),
				'prg_link' 		=> $this->input->post('link'),
				'prg_tglmulai' 	=> $this->input->post('tglmulai'),
				'prg_tglakhir' 	=> $this->input->post('tglakhir'),
				'prg_form'		=> $form
				);
		$this->db->where('prg_id',$id);
		$this->db->update($this->tb,$data);
		return true;
	}
	
	function delprogram($id) {
		$this->db->where('prg_id', $id);
        $this->db->delete($this->tb); 
	}

	function getprogram(){
		$q=$this->db
				->select('a.*, (now() between a.prg_tglmulai and a.prg_tglakhir) as status')
				->from('pmb_program a')
				->group_by('a.prg_id');
		return $q;
	}

	function getmaxid(){
		$q = $this->db
				  ->select("max(prg_id) as id",false)
				  ->from("pmb_program")
				  ->get()
				  ->result();
		return $q[0]->id;
	}

	function getcbprogram(){
		$q = $this->db->select('a.*')
					  ->from("pmb_program a")
					  ->get();
		return $q->result();
	}

	function getqby_flter($filter=null){
		$q = $this->getprogram();
		if ($filter!=null) {
			$ex = explode('&', $filter);
			$key = $ex[0];
			$q = $q->where("a.prg_nama like '%".$key."%'");
		}
		return $q;
	}

	function getprogramby_link($link=null){
		$q = $this->getprogram();
		$q = $q->where('a.prg_link',$link)
			   ->order_by("a.prg_id","asc");
		return $q->get()->result();
	}

	function getprogramby_page($jml_page,$id_page,$key=null){
		if ($key==null) {
			$q = $this->getprogram()
			   ->order_by("a.prg_id","asc");
		} else {
			$q = $this->getqby_flter($key)
			   ->order_by("a.prg_id","asc");
		}
		$q = $q->get('',$jml_page,$id_page);
		return $q->result();
	}

	function getprogramby(){
		$q = $this->getprogram()
			   ->order_by("a.prg_id","asc");
		return $q->get()->result();
	}

	function getprogramby_id($id=null){
		$q = $this->getprogram();
		$q = $q->where('a.prg_id',$id);
		return $q->get()->result();
	}

	function getprogramby_filter($filter=null){
		$q = $this->getqby_flter($filter)
			   ->order_by("a.prg_id","asc");
		return $q->get()->result();
	}
}