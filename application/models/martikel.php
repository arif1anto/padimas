<?php

class Martikel extends CI_Model {
	
	var $tb = "pmb_artikel";
	function __construct() {
		parent::__construct();
	}

	function inartikel($author=null){
		if ($author!=null) {
			$data = array(
					'art_judul' 	=> $this->input->post('judul'),
					'art_content' 	=> $this->input->post('content',FALSE),
					'art_author' 	=> $author,
					'art_tgl_terbit'=> $this->input->post('tgl'),
					'art_headline' 	=> ($this->countheadline()<5?$this->input->post('headline'):0),
					'art_link' 		=> $this->input->post('link'),
					);
			$this->db->insert($this->tb, $data);
			return true;
		} else {
			return false;
		}
	}
	
	function upartikel($id=null, $author=null) {
		if ($author!=null) {
			$data = array(
					'art_judul' 	=> $this->input->post('judul'),
					'art_content' 	=> $this->input->post('content',FALSE),
					'art_author' 	=> $author,
					'art_tgl_terbit'=> $this->input->post('tgl'),
					'art_headline' 	=> $this->input->post('headline'),
					'art_link' 		=> $this->input->post('link'),
					);
			$this->db->where('art_id',$id);
			$this->db->update($this->tb,$data);
			return true;
		} else {
			return false;
		}
	}
	
	function delartikel($id) {
		$this->db->where('art_id', $id);
        $this->db->delete($this->tb); 
	}

	function delartikel_kat($art_id=null){
		if ($art_id!=null) {
			$this->db->where('art_id', $art_id);
        	$this->db->delete("pmb_kat_artikel");
        	return true;
        }
	}

	function getartikel_kat($art_id=null){
		if ($art_id!=null) {
			$q = $this->db->where("art_id",$art_id)
					  ->get("pmb_kat_artikel");
			return $q->result();
		}
	}

	function getkategori_numart($kat_id=null){
		if ($kat_id!=null) {
			$q = $this->db->where("kat_id",$kat_id)
					  ->get("pmb_kat_artikel");
			return $q->num_rows();
		}
	}

	function inartikel_kat($art_id=null, $kat_id=null){
		if ($art_id!=null && $kat_id!=null) {
			$data = array(
					'art_id' => $art_id, 
					'kat_id' => $kat_id);
			return $this->db->insert("pmb_kat_artikel",$data);
		} else {
			return false;
		}
	}

	function getartikel(){
		$q=$this->db
				->select('a.*,d.*,e.*, date(now())>=date(a.art_tgl_terbit) as status, f.aut_display_name, f.aut_username')
				->select("DATE_FORMAT(a.art_tgl_terbit,'%m-%Y') as bulan",false)
				->select("GROUP_CONCAT(\"<a href='\",\"".base_url().index_page()."admin/artikel/kategori/"."\",d.kat_link,\"'> \",d.kat_nama,\"<a/>\") kategoris",false)
				->select("GROUP_CONCAT(\"<a href='\",\"".base_url().index_page()."admin/artikel/tag/"."\",e.tag_link,\"'> \",e.tag_nama,\"<a/>\") tags",false)
				->from('pmb_artikel a')
				->join('pmb_kat_artikel b','a.art_id=b.art_id','left')				
				->join('pmb_tag_artikel c','a.art_id=c.art_id','left')				
				->join('pmb_kategori d','b.kat_id=d.kat_id','left')				
				->join('pmb_tag e','c.tag_id=e.tag_id','left')
				->join('pmb_author f','a.art_author=f.aut_username','left')
				->group_by('a.art_id');
		return $q;
	}

	function getmaxid(){
		$q = $this->db
				  ->select("max(art_id) as id",false)
				  ->from("pmb_artikel")
				  ->get()
				  ->result();
		return $q[0]->id;
	}

	function getqby_flter($filter=null){
		$q = $this->getartikel();
		if ($filter!=null) {
			$ex = explode('&', $filter);
			$tgl = $ex[0];
			$kat = $ex[1];
			$key = $ex[2];
			$ket = $ex[3];
			$q = $q->where("a.art_judul like '%".$key."%'");
			if ($tgl!='0') {
				$q = $q->where("DATE_FORMAT(a.art_tgl_terbit,'%m-%Y')",$tgl);
			}
			if($kat!='0') {
				if ($kat=='null') {
					$q = $q->where('d.kat_id IS NULL',null,false);
				} else {
					$q = $q->where('d.kat_id',$kat);
				}
			}
			if ($ket=="pub") {
				$q=$q->where("date(now())>=date(a.art_tgl_terbit)");
			}
		}
		return $q;
	}

	function countheadline(){
		$q = $this->getartikel()->where("a.art_headline",1);
		return $q->get()->num_rows();
	}

	function setpublish($id=null,$ket='true'){
		$data = array('art_tgl_terbit' => ($ket=='true'?date_format(new datetime(),'Y-m-d H:i:s'):null));
		$this->db->where('art_id',$id);
		$this->db->update($this->tb,$data);
	}

	function getcbbulan(){
		$q = $this->db
				  ->query("SELECT DATE_FORMAT(art_tgl_terbit,'%m-%Y') AS bulan, DATE_FORMAT(art_tgl_terbit,'%M %Y') AS nama_bulan 
				  	FROM pmb_artikel WHERE DATE_FORMAT(art_tgl_terbit,'%m-%Y') IS NOT NULL GROUP BY DATE_FORMAT(art_tgl_terbit,'%m-%Y')");
		return $q->result();
	}
	function getcbtag(){
		$q = $this->db->get('pmb_tag');
		return $q->result();
	}

	function getartikelby_link($art_link=null){
		$q = $this->getartikel();
		$q = $q->where('a.art_link',$art_link)
			   ->order_by("a.art_tgl_terbit","desc");
		return $q->get()->result();
	}

	function getartikelby_page($jml_page,$id_page,$key=null){
		if ($key==null) {
			$q = $this->getartikel()
			   ->order_by("a.art_tgl_terbit","desc");
		} else {
			$q = $this->getqby_flter($key)
			   ->order_by("a.art_tgl_terbit","desc");
		}
		$q = $q->get('',$jml_page,$id_page);
		return $q->result();
	}

	function getartikelby_pub(){
		$q = $this->getartikel();
		$q=$q->where("date(now())>=date(a.art_tgl_terbit)")
			   ->order_by("a.art_tgl_terbit","desc");
		return $q->get()->result();
	}

	function getartikelby(){
		$q = $this->getartikel()
			   ->order_by("a.art_tgl_terbit","desc");
		return $q->get()->result();
	}

	function getartikelby_id($id=null){
		$q = $this->getartikel();
		$q = $q->where('a.art_id',$id);
		return $q->get()->result();
	}

	function getartikelby_filter($filter=null){
		$q = $this->getqby_flter($filter)
			   ->order_by("a.art_tgl_terbit","desc");
		return $q->get()->result();
	}

	function getartikelby_pub_filter($filter=null){
		$q = $this->getqby_flter($filter);
		$q = $q->where("date(now())>=date(a.art_tgl_terbit)")
			   ->order_by("a.art_tgl_terbit","desc");
		return $q->get()->result();
	} 
	
}