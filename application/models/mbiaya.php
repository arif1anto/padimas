<?php

class Mbiaya extends CI_Model {
	
	var $tb = "pmb_tarif_daftar_daftar";
	var $active_year;

	function __construct() {
		parent::__construct();
		$this->potkeluarga=1;
	 	$this->active_year = $this->getActiveYear();
	}

	function getActiveYear()
	{
		$q = $this->db->query("select set_value from pmb_setting where set_name='active_year'")->result();
		return $q[0]->set_value;
	}

	function intarif($form=null,$image=null){
		$data = array(
				'jns_tarif' 	=> $this->input->post('jns_tarif'),
				'tarif' 		=> $this->input->post('tarif'),
				'tahun' 		=> $this->input->post('tahun'),
				);
		$this->db->insert($this->tb, $data);
		return true;
	}
	
	function uptarif($id=null, $form=null,$image=null) {
		$data = array(
				'jns_tarif' 	=> $this->input->post('jns_tarif'),
				'tarif' 		=> $this->input->post('tarif'),
				'tahun' 		=> $this->input->post('tahun'),
				);
		$this->db->where('id_tarif',$id);
		$this->db->update($this->tb,$data);
		return true;
	}
	
	function deltarif($id) {
		$this->db->where('id_tarif', $id);
        $this->db->delete($this->tb); 
	}

	function gettarif(){
		$q=$this->db
				->select('a.*')
				->from('pmb_tarif_daftar a')
				->limit(2);
		return $q;
	}

	function getmaxid(){
		$q = $this->db
				  ->select("max(id_tarif) as id",false)
				  ->from("pmb_tarif_daftar")
				  ->get()
				  ->result();
		return $q[0]->id;
	}

	function getcbtarif(){
		$q = $this->db->select('a.*')
					  ->from("pmb_tarif_daftar a")
					  ->get();
		return $q->result();
	}

	function getqby_flter($filter=null){
		$q = $this->gettarif();
		if ($filter!=null) {
			$ex = explode('&', $filter);
			$key = $ex[0];
			$q = $q->where("a.prg_nama like '%".$key."%'");
		}
		return $q;
	}

	function gettarifby_page($jml_page,$id_page,$key=null){
		if ($key==null) {
			$q = $this->gettarif()
			   ->order_by("a.id_tarif","asc");
		} else {
			$q = $this->getqby_flter($key)
			   ->order_by("a.id_tarif","asc");
		}
		$q = $q->get('',$jml_page,$id_page);
		return $q->result();
	}

	function gettarifby(){
		$q = $this->gettarif()
			   ->order_by("a.id_tarif","asc");
		return $q->get()->result();
	}

	function gettarifby_id($id=null){
		$q = $this->gettarif();
		$q = $q->where('a.id_tarif',$id);
		return $q->get()->result();
	}

	function gettarifby_filter($filter=null){
		$q = $this->getqby_flter($filter)
			   ->order_by("a.id_tarif","asc");
		return $q->get()->result();
	}
	
	function inbiaya($th=null){
		$data = array(
				'id_programprodi'=> $this->input->post('prodi'),
				'spp_tetap' 	=> $this->input->post('spp_ttp'),
				'sppv_teori' 	=> $this->input->post('spp_teo'),
				'sppv_praktek' 	=> $this->input->post('spp_prak'),
				'spa' 			=> $this->input->post('spa'),								'stat_biaya'	=> $this->input->post('stat_biaya'),
				'spa_alum'	 	=> $this->input->post('spa_alum'),
				'thn_berlaku' 	=> $th,
				);
		$this->db->insert('pmb_programbiayaprodi', $data);
		return true;
	}
	
	function upbiaya($id=null, $form=null,$image=null) {
		$data = array(
				'spp_tetap' 	=> $this->input->post('spp_ttp'),
				'sppv_teori' 	=> $this->input->post('spp_teo'),
				'sppv_praktek' 	=> $this->input->post('spp_prak'),
				'spa' 			=> $this->input->post('spa'),
				'spa_alum' 		=> $this->input->post('spa_alum'),								'stat_biaya'	=> $this->input->post('stat_biaya'),
				'thn_berlaku' 	=> $this->input->post('th'),
				);
		$this->db->where('id_programbiaya',$id);
		$this->db->update('pmb_programbiayaprodi',$data);
		return true;
	}
	
	function upthnberlaku($th=null) {
		$data = array(
				'thn_berlaku' 	=> $th,
				);
		$this->db->update('pmb_programbiayaprodi',$data);
		return true;
	}
	
	function delbiaya($id) {
		$this->db->where('id_programbiaya', $id);
        $this->db->delete('pmb_programbiayaprodi'); 
	}

	function getbiaya(){
		$q=$this->db
				->select('a.*')
				->from('pmb_programbiayaprodi a');
		return $q;
	}

	function getmaxbiayaid(){
		$q = $this->db
				  ->select("max(id_programbiaya) as id",false)
				  ->from("pmb_programbiayaprodi")
				  ->get()
				  ->result();
		return $q[0]->id;
	}

	function getcbbiaya(){
		$q = $this->db->select('a.*')
					  ->from("pmb_programbiayaprodi a")
					  ->join("pmb_programprodi b","b.id_programprodi=a.id_programprodi","inner")
					  ->get();
		return $q->result();
	}

	function getqbiayaby_flter($filter=null){
		$q = $this->getbiaya();
		if ($filter!=null) {
			$ex = explode('&', $filter);
			$key = $ex[0];
			$q = $q->where("a.prg_nama like '%".$key."%'");
		}
		return $q;
	}

	function getbiayaby_page($jml_page,$id_page,$key=null){
		if ($key==null) {
			$q = $this->getbiaya()
			   ->order_by("a.id_programbiaya","asc");
		} else {
			$q = $this->getqby_flter($key)
			   ->order_by("a.id_programbiaya","asc");
		}
		$q = $q->get('',$jml_page,$id_page);
		return $q->result();
	}

	function getbiayaby(){
		$q = $this->getbiaya()
			   ->order_by("a.id_programbiaya","asc");
		return $q->get()->result();
	}

	function getbiayaby_id($id=null){
		$q = $this->getbiaya();
		$q = $q->where('a.id_programbiaya',$id);
		return $q->get()->result();
	}
	
	function getbiayaby_idprog($id=null){
		$q = $this->getbiaya()
			->select('b.*')
			->from('pmb_tarif_daftar b')
			->where('b.id_tarif',3)
			->where('a.id_programprodi',$id)->get()->result();
		return $q;
	}

	function getbiayaby_filter($filter=null){
		$q = $this->getqby_flter($filter)
			   ->order_by("a.id_programbiaya","asc");
		return $q->get()->result();
	}
	
	function inbayar($jns=null,$nominal=0){
		if($jns=="spa" && $nominal!=null && $nominal>0){
			$data = array(
				'id_daftar'		=> $this->input->post('id_daftar'),
				'spa_byr' 		=> $nominal,
				'tgl_byr' 		=> date('Y-m-d H:i:s'),
				);
			$this->db->insert('pmb_transbayar', $data);
			return true;
		}
		if($jns=="dpa" && $nominal!=null && $nominal>0){
			$data = array(
				'id_daftar'		=> $this->input->post('id_daftar'),
				'dpa_byr' 		=> $nominal,
				'tgl_byr' 		=> date('Y-m-d H:i:s'),
				);
			$this->db->insert('pmb_transbayar', $data);
			return true;
		}
		if($jns=="sppttp" && $nominal!=null && $nominal>0){
			$data = array(
				'id_daftar'		=> $this->input->post('id_daftar'),
				'sppttp_byr' 	=> $nominal,
				'tgl_byr' 		=> date('Y-m-d H:i:s'),
				);
			$this->db->insert('pmb_transbayar', $data);
			return true;
		}
		
	}
	
	function delbayar($id) {
		$this->db->where('id_programbiaya', $id);
        $this->db->delete('pmb_transbayar'); 
	}
	
	function qbayar() {
		$q=$this->db->select('sum(spa_byr) as spa_byr,sum(dpa_byr) as dpa_byr,sum(sppttp_byr) as sppttp_byr')->from('pmb_transbayar'); 
		return $q;
	}
	
	function getbayar_byid($id=null){
		$q=$this->qbayar()->where('id_daftar',$id)->get()->result();
		return $q;
	}
	
	function upangsuran() {
		$data = array(
				'spa1' 	=> $this->input->post('spa1'),
				'spa2' 	=> $this->input->post('spa2'),
				'spa3' 	=> $this->input->post('spa3'),
				'spa4' 	=> $this->input->post('spa4'),
				);
		$this->db->update('pmb_setting_angsuran',$data);
		return true;
	}
		
	function getangsuran() {
		$q=$this->db->get('pmb_setting_angsuran')->result(); 
		return $q;
	}
	private function gantinumeric($subject) { 
		$replace=array('.'=>'',','=>'',' '=>'');
	   return str_replace(array_keys($replace), array_values($replace), $subject);    
	}
	function inBayarHer($id=null,$prodi=null,$user=null,$spapot=0){
		if($id!=null && $prodi!=null && $user!=null && $spapot>=0){
			$this->db->query("
			INSERT INTO pmb_herbayar (id_daftar,spp_tetap,spp_var,spa,spa_pot,dpa,id_user,lastupdate,ket)
			SELECT * FROM
				(SELECT  a.id_daftar AS id_daftar, h.spp_tetap, h.sppv_teori as spp_var,
				IF(h.stat_biaya=1,IF(l.kd_status=2,h.spa + jj.tbh_spa_transfer,IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum + jj.tbh_spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h.spa + jj.tbh_spa), h.spa + jj.tbh_spa))),IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*h.spa, h.spa)))-".$this->gantinumeric($spapot)." as spa
				,".$this->gantinumeric($spapot)." as spa_pot,(SELECT set_value FROM pmb_setting WHERE set_name='dpa') AS dpa, '".$user."' as id_user, TIMESTAMP(NOW()) as lastupdate,NULL as ket
				FROM (`pmb_pendaftar` a, `pmb_setting_angsuran` i,pmb_programprodi g, `pmb_gelombang` jj)
				JOIN `pmb_program` j ON `j`.`prg_id`=`a`.`jalur_pendaftaran`
				JOIN `mst_proditawar` l ON `l`.`kd_proditawar`=`g`.`kd_proditawar`
				INNER JOIN `pmb_programbiayaprodi` h ON `h`.`id_programprodi`=`g`.`id_programprodi`
				WHERE DATE (a.tgl_tes) >= jj.tgl_mulai AND DATE(a.tgl_tes) <= jj.tgl_akhir
				and a.id_daftar='".$id."' and g.kd_proditawar='".$prodi."' and h.thn_berlaku=".$this->active_year."
				group by a.id_daftar) b 
			ON DUPLICATE KEY UPDATE id_daftar=b.id_daftar,spp_tetap=b.spp_tetap,spp_var=b.spp_var,spa=b.spa,spa_pot=".$this->gantinumeric($spapot).",dpa=b.dpa,id_user='admin',lastupdate= TIMESTAMP(NOW()),ket= NULL
			");
			if($this->db->affected_rows() > 0)
				return true;
			else
				return false;
		}
	}
	function ubahSpaBayar($nil1=null,$nil2=0) {
		$spa=$this->gantinumeric($nil1);
		$potspa=$this->gantinumeric($nil2);
		if($spa!=null && $spa>0)
			$this->db->where('id_daftar',$this->input->post('id_daftar',TRUE))->update("pmb_herbayar",array('spa'=> $spa-$potspa,'spa_pot'=> $potspa));
	}
}