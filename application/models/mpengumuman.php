<?php

class Mpengumuman extends CI_Model {
	
	var $tb = "pmb_pengumuman";
	function __construct() {
		parent::__construct();
	}

	function inpengumuman($id=null){
		$data = array(
				'png_judul' 	=> $this->input->post('judul'),
				'prg_id' 		=> $this->input->post('prg'),
				'png_deskripsi' => $this->input->post('content',FALSE),
				'png_terima' 	=> $this->input->post('surat_terima',FALSE),
				'png_tolak' 	=> $this->input->post('surat_tolak',FALSE),
				'png_tabel'		=> $this->input->post('png_tabel',FALSE),
				'png_tgl'		=> $this->input->post('tgl'),
				'png_link' 	=> $this->input->post('link'),
				);
		$this->db->insert($this->tb, $data);
		return true;
	}
	
	function uppengumuman($id=null) {
		if ($id!=null) {
			$data = array(
					'png_judul' 	=> $this->input->post('judul'),
					'prg_id' 		=> $this->input->post('prg'),
					'png_deskripsi' => $this->input->post('content',FALSE),
					'png_terima' 	=> $this->input->post('surat_terima',FALSE),
					'png_tolak' 	=> $this->input->post('surat_tolak',FALSE),
					'png_tabel'		=> $this->input->post('png_tabel',FALSE),
					'png_tgl'		=> $this->input->post('tgl'),
					'png_link' 	=> $this->input->post('link'),
					);
			$this->db->where('png_id',$id);
			$this->db->update($this->tb,$data);
			return true;
		} else {
			return false;
		}
	}
	
	function delpengumuman($id) {
		if ($id!=null) {
			$this->db->where('png_id', $id);
	        $this->db->delete($this->tb); 
	        $this->db->where('png_id',$id);
			$this->db->delete('pmb_pengumuman_srt');
	        return true;
    	} else {
    		return false;
    	}
	}

	function getpengumuman(){
		$q=$this->db
				->select('a.*,a.prg_id as prg_id,date(now())>=date(a.png_tgl) as status,(date(now()) between date(a.png_tgl) and date_add(date(a.png_tgl), Interval 5 Day)) as new',false)
				->from('pmb_pengumuman a')
				->group_by('a.png_id');
		return $q;
	}
	function getsurat(){
		$q = $this->getpengumuman()
		          ->select('if (b.kd_jenis_beasiswa=c.kd_jenis_beasiswa,b.png_surat,a.png_terima) as png_terima',FALSE)
				  ->join('pmb_pengumuman_srt b','b.png_id=a.png_id','left')
				  ->join('pmb_rekomendasi c','b.png_id=a.png_id and c.kd_jenis_beasiswa=b.kd_jenis_beasiswa ','left');
		return $q;
	}

	function getmaxid(){
		$q = $this->db
				  ->select("max(png_id) as id",false)
				  ->from("pmb_pengumuman")
				  ->get()
				  ->result();
		return $q[0]->id;
	}

	function getcbpengumuman(){
		$q = $this->db->select('a.png_id, a.png_judul, a.png_link')
					  ->from("pmb_pengumuman a")
					  ->get();
		return $q->result();
	}

	function getqby_flter($filter=null){
		$q = $this->getpengumuman();
		if ($filter!=null) {
			$ex = explode('&', $filter);
			$tgl = $ex[0];
			$key = $ex[1];
			$ket = $ex[2];
			$q = $q->where("a.png_judul like '%".$key."%'");
			if ($tgl!='0') {
				$q = $q->where("DATE_FORMAT(a.png_tgl,'%m-%Y')",$tgl);
			}
			if ($ket=="pub") {
				$q=$q->where("date(now())>=date(a.png_tgl)");
			}
		}
		return $q;
	}

	function setpublish($id=null,$ket='true'){
		$data = array('png_tgl' => ($ket=='true'?date_format(new datetime(),'Y-m-d H:i:s'):null));
		$this->db->where('png_id',$id);
		$this->db->update($this->tb,$data);
	}

	function getcbbulan(){
		$q = $this->db
				  ->query("SELECT DATE_FORMAT(png_tgl,'%m-%Y') AS bulan, DATE_FORMAT(png_tgl,'%M %Y') AS nama_bulan 
				  	FROM pmb_pengumuman WHERE DATE_FORMAT(png_tgl,'%m-%Y') IS NOT NULL GROUP BY DATE_FORMAT(png_tgl,'%m-%Y')");
		return $q->result();
	}

	function getpengumumanby_link($art_link=null){
		$q = $this->getpengumuman();
		$q = $q->where('a.png_link',$art_link)
			   ->order_by("a.png_tgl","desc");
		return $q->get()->result();
	}

	function getpengumumanby_page($jml_page,$id_page,$key=null){
		if ($key==null) {
			$q = $this->getpengumuman()
			   ->order_by("a.png_tgl","desc");
		} else {
			$q = $this->getqby_flter($key)
			   ->order_by("a.png_tgl","desc");
		}
		$q = $q->get('',$jml_page,$id_page);
		return $q->result();
	}

	function getpengumumanby_pub(){
		$q = $this->getpengumuman();
		$q=$q->where("date(now())>=date(a.png_tgl)")
			   ->order_by("a.png_tgl","desc");
		return $q->get()->result();
	}

	function getpengumumanby(){
		$q = $this->getpengumuman()
			   ->order_by("a.png_tgl","desc");
		return $q->get()->result();
	}

	function getpengumumanby_id($id=null,$jnsbea=null){
		$q = $this->getsurat();
		if($id!=null)
			$q = $q->where('a.png_id',$id);
		if($jnsbea!=null)
			$q = $q->where('c.kd_jenis_beasiswa',$jnsbea);
		else
			$q = $q->where('c.kd_jenis_beasiswa is null',null,false);
		return $q->get()->result();
	}

	function getpengumumanby_filter($filter=null){
		$q = $this->getqby_flter($filter)
			   ->order_by("a.png_tgl","desc");
		return $q->get()->result();
	}

	function getpengumumanby_pub_filter($filter=null){
		$q = $this->getqby_flter($filter);
		$q = $q->where("date(now())>=date(a.png_tgl)")
			   ->order_by("a.png_tgl","desc");
		return $q->get()->result();
	}
	
	function getpengumuman_surat($prg_id=null){
		$q = $this->db->select('a.prg_id, a.png_id,b.png_surat as png_surat,c.* ')
					->from('pmb_pengumuman a')
					->join('pmb_pengumuman_srt b','a.png_id=b.png_id AND a.prg_id='.$prg_id,'left')
					->join('pmb_jenis_beasiswa c','c.kd_jenis_beasiswa=b.kd_jenis_beasiswa','right');
		return $q->get()->result();
	}
	
}