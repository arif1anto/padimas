<?php

class Mpage extends CI_Model {
	
	var $tb = "pmb_page";
	function __construct() {
		parent::__construct();
	}

	function inpage($author=null){
		if ($author!=null) {
			$data = array(
					'page_judul' 	=> $this->input->post('judul'),
					'page_content' 	=> $this->input->post('content',FALSE),
					'page_author' 	=> $author,
					'page_tgl'		=> $this->input->post('tgl'),
					'page_link' 	=> $this->input->post('link'),
					);
			$this->db->insert($this->tb, $data);
			return true;
		} else {
			return false;
		}
	}
	
	function uppage($id=null, $author=null) {
		if ($author!=null) {
			$data = array(
					'page_judul' 	=> $this->input->post('judul'),
					'page_content' 	=> $this->input->post('content',FALSE),
					'page_author' 	=> $author,
					'page_tgl'		=> $this->input->post('tgl'),
					'page_link' 	=> $this->input->post('link'),
					);
			$this->db->where('page_id',$id);
			$this->db->update($this->tb,$data);
			return true;
		} else {
			return false;
		}
	}
	
	function delpage($id) {
		$this->db->where('page_id', $id);
        $this->db->delete($this->tb); 
	}

	function getpage(){
		$q=$this->db
				->select('a.*,b.*,date(now())>=date(a.page_tgl) as status, b.aut_display_name, b.aut_username')
				->from('pmb_page a')
				->join('pmb_author b','a.page_author=b.aut_username','left')
				->group_by('a.page_id');
		return $q;
	}

	function getmaxid(){
		$q = $this->db
				  ->select("max(page_id) as id",false)
				  ->from("pmb_page")
				  ->get()
				  ->result();
		return $q[0]->id;
	}

	function getcbpage(){
		$q = $this->db->select('a.page_id, a.page_judul, a.page_link')
					  ->from("pmb_page a")
					  ->get();
		return $q->result();
	}

	function getqby_flter($filter=null){
		$q = $this->getpage();
		if ($filter!=null) {
			$ex = explode('&', $filter);
			$tgl = $ex[0];
			$key = $ex[1];
			$ket = $ex[2];
			$q = $q->where("a.page_judul like '%".$key."%'");
			if ($tgl!='0') {
				$q = $q->where("DATE_FORMAT(a.page_tgl,'%m-%Y')",$tgl);
			}
			if ($ket=="pub") {
				$q=$q->where("date(now())>=date(a.page_tgl)");
			}
		}
		return $q;
	}

	function setpublish($id=null,$ket='true'){
		$data = array('page_tgl' => ($ket=='true'?date_format(new datetime(),'Y-m-d H:i:s'):null));
		$this->db->where('page_id',$id);
		$this->db->update($this->tb,$data);
	}

	function getcbbulan(){
		$q = $this->db
				  ->query("SELECT DATE_FORMAT(page_tgl,'%m-%Y') AS bulan, DATE_FORMAT(page_tgl,'%M %Y') AS nama_bulan 
				  	FROM pmb_page WHERE DATE_FORMAT(page_tgl,'%m-%Y') IS NOT NULL GROUP BY DATE_FORMAT(page_tgl,'%m-%Y')");
		return $q->result();
	}

	function getpageby_link($art_link=null){
		$q = $this->getpage();
		$q = $q->where('a.page_link',$art_link)
			   ->order_by("a.page_tgl","desc");
		return $q->get()->result();
	}

	function getpageby_page($jml_page,$id_page,$key=null){
		if ($key==null) {
			$q = $this->getpage()
			   ->order_by("a.page_tgl","desc");
		} else {
			$q = $this->getqby_flter($key)
			   ->order_by("a.page_tgl","desc");
		}
		$q = $q->get('',$jml_page,$id_page);
		return $q->result();
	}

	function getpageby_pub(){
		$q = $this->getpage();
		$q=$q->where("date(now())>=date(a.page_tgl)")
			   ->order_by("a.page_tgl","desc");
		return $q->get()->result();
	}

	function getpageby(){
		$q = $this->getpage()
			   ->order_by("a.page_tgl","desc");
		return $q->get()->result();
	}

	function getpageby_id($id=null){
		$q = $this->getpage();
		$q = $q->where('a.page_id',$id);
		return $q->get()->result();
	}

	function getpageby_filter($filter=null){
		$q = $this->getqby_flter($filter)
			   ->order_by("a.page_tgl","desc");
		return $q->get()->result();
	}

	function getpageby_pub_filter($filter=null){
		$q = $this->getqby_flter($filter);
		$q = $q->where("date(now())>=date(a.page_tgl)")
			   ->order_by("a.page_tgl","desc");
		return $q->get()->result();
	}
	
}