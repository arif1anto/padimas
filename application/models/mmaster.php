<?php

class Mmaster extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}

	function getProdi(){
		$q = $this->db->select('a.kd_proditawar,c.kd_jurusan, c.nama_jurusan, d.kd_jenjang, d.nama_jenjang, b.kd_fakultas, b.nama_fakultas,f.nama_program, g.nama_status,e.id_programprodi')
				      ->from('mst_proditawar a')
				      ->join("mst_fakultas b","a.kd_fakultas=b.kd_fakultas","inner")
				      ->join("mst_jurusan c","a.kd_jurusan=c.kd_jurusan and a.kd_fakultas=c.kd_fakultas","inner")
				      ->join("mst_jenjang d","a.kd_jenjang=d.kd_jenjang","inner")
				      ->join("mst_program f","a.kd_program=f.kd_program","inner")
				      ->join("mst_status g","a.kd_status=g.kd_status","inner")
					  ->join("pmb_programprodi e","e.kd_proditawar=a.kd_proditawar","inner")
				      ->order_by("a.kd_proditawar");
		return $q;
	}

	function getcbprodi(){
		//$sia_db = $this->load->database('sia', true);
		$q = $this->getProdi()->get();
		return $q->result();
	}

	function getcbstatus_prodi(){
		$q = $this->db->select("a.*")
					->from("mst_status a")
					->get();
		return $q->result();
	}

	function getcbprodi_bystatus($kd_status = null){
		$q = $this->getProdi()
					->where('g.kd_status',$kd_status)
					->get();
		return $q->result();
	}
	
	function getcbpropinsi(){
		//$sia_db = $this->load->database('sia', true);
		$q = $this->db->select('a.*')
				      ->from('mst_propinsi a')
				      ->order_by("a.nama_propinsi")
				      ->get();
		return $q->result();
	}
	
	function getcbkota_byid($id=null){
		//$sia_db = $this->load->database('sia', true);
		$q = $this->db->select('a.*,b.nama_propinsi as propinsi')
				      ->from('mst_kota a')
					  ->join('mst_propinsi b','a.kd_propinsi=b.kd_propinsi','inner')
					  ->where('a.kd_propinsi',$id)
				      ->order_by("a.nama_kota")
				      ->get();
		return $q->result();
	}
	
	function getcbkec_byid($id=null){
		//$sia_db = $this->load->database('sia', true);
		$q = $this->db->select('a.*')
				      ->from('mst_kecamatan a')
					  ->join('mst_kota b','a.kd_kota=b.kd_kota','inner')
					  ->where('a.kd_kota',$id)
				      ->order_by("a.nama_kecamatan")
				      ->get();
		return $q->result();
	}
	
	function getcbsekolah_byid($id=null){
		//$sia_db = $this->load->database('sia', true);
		$q = $this->db->select('a.*')
				      ->from('mst_sekolah a')
					  ->join('mst_kecamatan b','a.kec_sekolah=b.kd_kecamatan','inner')
					  ->where('a.kec_sekolah',$id)
				      ->order_by("a.nama_sekolah")
				      ->get();
		return $q->result();
	}
	
	function getsekolah_bysearch($l1=null,$l2=null,$l3=null,$l4=null){
		$q = $this->db->select('a.*,c.nama_kota')
				      ->from('mst_sekolah a')
					  ->join('mst_kecamatan b','a.kec_sekolah=b.kd_kecamatan','left')
					  ->join('mst_kota c','c.kd_kota=b.kd_kota','left')
					  ->like('a.nama_sekolah',$l1,'both')
					  ->or_like('a.nama_sekolah',$l2,'both')					  ->or_like('a.nama_sekolah',$l3,'both')					  ->or_like('a.nama_sekolah',$l4,'both')
				      ->order_by("a.nama_sekolah")
					  ->limit(10)
				      ->get();
		return $q->result();
	}
	
	function getcbagama(){
		//$sia_db = $this->load->database('sia', true);
		$q = $this->db->select('a.*')
				      ->from('mst_agama a')
				      ->order_by("a.kd_agama")
				      ->get();
		return $q->result();
	}

	function getcbpendidikan(){
		//$sia_db = $this->load->database('sia', true);
		$q = $this->db->select('a.*')
				      ->from('pmb_pendidikan a')
				      ->order_by("a.id")
				      ->get();
		return $q->result();
	}
	function genKdSekolah(){
		$q=$this->db->select("IF(max(cast(a.kd_sekolah as SIGNED))<10000,RIGHT(CONCAT('00000000',max(cast(a.kd_sekolah as SIGNED))+1),8),'00000001') as kd_sklh",false)
					->from("mst_sekolah a")->where("a.kd_sekolah < 10000",null,false)->get()->row();
		return $q->kd_sklh;
	}
	function qInSekolah($user=null){
		$kd_sklh=$this->genKdSekolah();
		$data=array(
			"kd_sekolah" =>$kd_sklh,
			"nama_sekolah"=>$this->input->post('nm_sklh'),
			"stts_sekolah"=>$this->input->post('stt_sklh'),
			"alamat_sekolah"=>$this->input->post('almt_sklh'),
			"kec_sekolah"=>$this->input->post('kec_sklh'),
		);
		$data2=array(
			"kd_sekolah" =>$kd_sklh,
			"user"		 =>$user,
		);
		$this->db->insert("mst_sekolah_tmp",$data2);
		$this->db->insert("mst_sekolah",$data);
		if($this->db->affected_rows()>0)
			return $kd_sklh;
		else
			return false;
	}

}