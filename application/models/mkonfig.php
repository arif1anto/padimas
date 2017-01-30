<?php

class Mkonfig extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	function getkonfig($field=null){
		if($field!=null) {
			$q=$this->db->select("set_value as ".$field)
						->from("pmb_setting")
						->where("set_name",$field)
						->get();
			if($q->num_rows()==1)
				return $q->row();
		
		} else {
			$q=$this->db->select("*")
						->from("pmb_setting")
						->get();
				return $q->result();
		}
	}
	
	//Setup Gelombang
	function insetup_gelombang(){
		$data = array(
				'gel'=> $this->input->post('gel'),
				'tgl_mulai'=> $this->input->post('tgl_mulai'),
				'tgl_akhir'=> $this->input->post('tgl_akhir'),
				'tbh_spa'=> $this->input->post('tbh_spa'),
				'tbh_spa_transfer'=> $this->input->post('tbh_spa_trans'),
				'tbh_spa_alum'=> $this->input->post('tbh_spa_alum'),
				);
		$this->db->insert('pmb_gelombang', $data);
		return true;
	}

	function upsetup_gelombang($id = null){
		if ($id!=null) {
			$data = array(
				'tgl_mulai'=> $this->input->post('tgl_mulai'),
				'tgl_akhir'=> $this->input->post('tgl_akhir'),
				'tbh_spa'=> $this->input->post('tbh_spa'),
				'tbh_spa_transfer'=> $this->input->post('tbh_spa_trans'),
				'tbh_spa_alum'=> $this->input->post('tbh_spa_alum'),
				);
			$this->db->where('gel',$id);
			$this->db->update('pmb_gelombang',$data);
			return true;
		} else {
			return false;
		}
	}

	function delsetup_gelombang($id = null) {
		if ($id!=null) {
			$this->db->where('gel', $id);
	        $this->db->delete('pmb_gelombang'); 
	        return true;
		} else {
			return false;
		}
	}

	private function qsetup_gelombang(){
		$q = $this->db->select('*')
		      ->from('pmb_gelombang a')
		      ->order_by("a.gel");
		return $q;
	}

	function getsetup_gelombang(){
		$q = $this->qsetup_gelombang()->get();
		return $q->result();
	}

	function getsetup_gelombang_byid($id = null){
		if ($id!=null) {
			$q = $this->qsetup_gelombang()
				->where('gel',$id)
				->get();
			return $q->result();
		} else {
			return null;
		}
	}
	//Jenis Beasiswa
	function injenis_beasiswa(){
		$data = array(
				'jenis_beasiswa'=> $this->input->post('jenis')
				);
		$this->db->insert('pmb_jenis_beasiswa', $data);
		return true;
	}

	function upjenis_beasiswa($id = null){
		if ($id!=null) {
			$data = array(
					'jenis_beasiswa'=> $this->input->post('jenis')
					);
			$this->db->where('kd_jenis_beasiswa',$id);
			$this->db->update('pmb_jenis_beasiswa',$data);
			return true;
		} else {
			return false;
		}
	}

	function deljenis_beasiswa($id = null) {
		if ($id!=null) {
			$this->db->where('kd_jenis_beasiswa', $id);
	        $this->db->delete('pmb_jenis_beasiswa'); 
	        return true;
		} else {
			return false;
		}
	}

	private function qjenis_beasiswa(){
		$q = $this->db->select('*')
		      ->from('pmb_jenis_beasiswa a')
		      ->order_by("a.kd_jenis_beasiswa");
		return $q;
	}

	function getjenis_beasiswa(){
		$q = $this->qjenis_beasiswa()->get();
		return $q->result();
	}

	function getjenis_beasiswa_byid($id = null){
		if ($id!=null) {
			$q = $this->qjenis_beasiswa()
				->where('kd_jenis_beasiswa',$id)
				->get();
			return $q->result();
		} else {
			return null;
		}
	}
	
	function informat_nodaftar(){
		$data = array(
					'prg_id'=> $this->input->post('jenisprogram'),
					'noawal'=> $this->input->post('formatno'),
					);
		$this->db->insert('pmb_setting_nopendaftar', $data);
		return true;
	}

	function upformat_nodaftar($id = null){
		if ($id!=null) {
			$data = array(
					'noawal'=> $this->input->post('formatno'),
					);
			$this->db->where('prg_id',$id);
			$this->db->update('pmb_setting_nopendaftar',$data);
			return true;
		} else {
			return false;
		}
	}

	function delformat_nodaftar($id = null) {
		if ($id!=null) {
			$this->db->where('prg_id', $id);
	        $this->db->delete('pmb_setting_nopendaftar'); 
	        return true;
		} else {
			return false;
		}
	}
	
	private function qformat_nodaftar(){
		$q = $this->db->select('a.*,b.prg_nama as program')
		      ->from('pmb_setting_nopendaftar a')
			  ->join('pmb_program b','a.prg_id=b.prg_id','left')
		      ->order_by("a.prg_id");
		return $q;
	}

	function getformat_nodaftar(){
		$q = $this->qformat_nodaftar()->get();
		return $q->result();
	}

	function getformat_nodaftar_byid($id = null){
		if ($id!=null) {
			$q = $this->qformat_nodaftar()
				->where('prg_id',$id)
				->get();
			return $q->result();
		} else {
			return null;
		}
	}
	
	function inuser(){
		$data = array(
					'aut_username'=> $this->input->post('uname'),
					'aut_pass'=> $this->input->post('upass'),
					'aut_display_name'=> $this->input->post('disname'),
					'aut_email'=> $this->input->post('uemail'),
					);		
		$data2 = array(					
					'aut_username'=> $this->input->post('uname'),
					'id_hakakses'=> $this->input->post('uhak'),					
		);
		$this->db->insert('pmb_author', $data);		
		$this->db->insert('pmb_hakakses', $data2);
		return true;
	}		
	function inhakakses($id,$akses){		
		$data2 = array(					
				'aut_username'=> $id,					
				'id_hakakses'=> $akses,					
		);		
	$this->db->insert('pmb_hakakses', $data2);		
	return true;	
	}
	function delhakakses($id,$akses) {
		$w= array(					
				'aut_username'=> $id,					
				'id_hakakses'=> $akses,					
		);
		$this->db->where($w);
		$this->db->delete('pmb_hakakses'); 
		return true;
	}
	function upuser($id = null){
		if ($id!=null) {
			$data = array(
					'aut_pass'=> $this->input->post('upass'),
					'aut_display_name'=> $this->input->post('disname'),
					'aut_email'=> $this->input->post('uemail'),
					);
			$this->db->where('aut_username',$id);
			$this->db->update('pmb_author', $data);			
			//$this->db->where('aut_username',$id)->update('pmb_hakakses', array('id_hakakses'=> $this->input->post('uhak')));
			return true;
		} else {
			return false;
		}
	}

	function deluser($id = null) {
		if ($id!=null) {
			$this->db->where('aut_username', $id);
	        $this->db->delete('pmb_author'); 
			$this->db->where('aut_username', $id);
			$this->db->delete('pmb_hakakses'); 
	        return true;
		} else {
			return false;
		}
	}
	
	private function quser(){
		$q = $this->db->select('a.*')
		      ->from('pmb_author a')
		      ->order_by("a.aut_username");
		return $q;
	}

	function getuser(){
		$q = $this->quser()->get();
		return $q->result();
	}		function getgroupuser(){		$q = $this->db->get("pmb_group");		return $q->result();	}

	function getuser_byid($id = null){
		if ($id!=null) {
			$q = $this->quser()
				->where('aut_username',$id)
				->get();
			return $q->result();
		} else {
			return null;
		}
	}		function getuser_byakses($user=null){		$w=array(			"b.aut_username" => $user,		);		$q = $this->db				  ->select("b.aut_username,c.*")				  ->from("pmb_hakakses b")				  ->join("pmb_group c","b.id_hakakses=c.id_hakakses","inner")				  ->where($w)				  ->get();		return $q->result();	}
	
	function qprodi(){
		$q = $this->db->select("a.kd_proditawar,CONCAT(f.nama_jenjang,' ',c.nama_jurusan,' ',e.nama_status,' ',d.nama_program )AS prodi,c.nama_jurusan,f.nama_jenjang,e.nama_status,d.nama_program",false)
		      ->from('mst_proditawar a') 
			  ->join('mst_fakultas b','b.kd_fakultas=a.kd_fakultas','inner')
			  ->join('mst_jurusan c','c.kd_jurusan=a.kd_jurusan AND c.kd_fakultas=a.kd_fakultas','inner')
			  ->join('mst_program d','d.kd_program=a.kd_program','inner')
			  ->join('mst_status e','e.kd_status=a.kd_status','inner')
			  ->join('mst_jenjang f','f.kd_jenjang=a.kd_jenjang','inner');
		return $q;	  
	}
	
	function qprogramprodi(){
		$q=$this->qprodi()
			->join("pmb_programprodi g","g.kd_proditawar=a.kd_proditawar","inner")
			->select("g.*");
		return $q;	
	}
	
	function qprogrambiaya(){
		$q=$this->qprogramprodi()
			->join("pmb_programbiayaprodi h","h.id_programprodi=g.id_programprodi","inner")
			->select("h.*");
		return $q;	
	}
	
	function qgetprodi(){
			$q=$this->qprodi()
		      ->order_by("c.nama_jurusan,f.nama_jenjang,e.nama_status,d.nama_program","asc")
			  ->get();
		return $q->result();
	}	
	
	
	function qgetprogramprodi(){
		$q=$this->qprogramprodi()
			->order_by("c.nama_jurusan,f.nama_jenjang,e.nama_status,d.nama_program","asc")
			->get()->result();
		return $q;	
	}
	
	function qgetprogramprodi_byid($id){
		$q=$this->qprogramprodi()
			->where("g.id_programprodi",$id)
			->get()->result();
		return $q;	
	}
	
	function qgetprogrambiaya(){
		$q=$this->qprogrambiaya()
			->order_by("c.nama_jurusan,f.nama_jenjang,e.nama_status,d.nama_program","asc")
			->get()->result();
		return $q;	
	}
	
	function inprogramprodi(){
		$data = array(
					'kd_proditawar'=> $this->input->post('prodi'),
					'dgt1'=> $this->input->post('dig1'),
					'dgt4'=> $this->input->post('dig4'),
					'dgt5'=> $this->input->post('dig5'),
					'dgt6'=> $this->input->post('dig6'),
					'dgt7'=> $this->input->post('dig7'),
					);
		$this->db->insert('pmb_programprodi', $data);
		return true;
	}

	function upprogramprodi($id = null){
		if ($id!=null) {
			$data = array(
					'dgt1'=> $this->input->post('dig1'),
					'dgt4'=> $this->input->post('dig4'),
					'dgt5'=> $this->input->post('dig5'),
					'dgt6'=> $this->input->post('dig6'),
					'dgt7'=> $this->input->post('dig7'),
					);
			$this->db->where('id_programprodi',$id);
			$this->db->update('pmb_programprodi', $data);
			return true;
		} else {
			return false;
		}
	}

	function delprogramprodi($id = null) {
		if ($id!=null) {
			$this->db->where('id_programprodi', $id);
	        $this->db->delete('pmb_programprodi'); 
	        return true;
		} else {
			return false;
		}
	}
	
	function insrc_info(){
		$data = array(
					'info'=> $this->input->post('info'),
					);
		$this->db->insert('pmb_src_info', $data);
		return true;
	}

	function upsrc_info($id = null){
		if ($id!=null) {
			$data = array(
					'info'=> $this->input->post('info'),
					);
			$this->db->where('kd_info',$id);
			$this->db->update('pmb_src_info', $data);
			return true;
		} else {
			return false;
		}
	}

	function delsrc_info($id = null) {
		if ($id!=null) {
			$this->db->where('kd_info', $id);
	        $this->db->delete('pmb_src_info'); 
	        return true;
		} else {
			return false;
		}
	}
	
	private function qsrc_info(){
		$q = $this->db->select('a.*')
		      ->from('pmb_src_info a')
		      ->order_by("a.kd_info");
		return $q;
	}

	function getsrc_info(){
		$q = $this->qsrc_info()->get();
		return $q->result();
	}

	function getsrc_info_byid($id = null){
		if ($id!=null) {
			$q = $this->qsrc_info()
				->where('kd_info',$id)
				->get();
			return $q->result();
		} else {
			return null;
		}
	}
	
	function upsrc_info_set($id){
		$this->db->where('id_daftar', $id);
		$this->db->delete('pmb_src_info_set'); 
		$set=$this->input->post('set_info');
		if($set!=null) :
			foreach($set as $dt){
				$data = array(
							'id_daftar'=> $id,
							'kd_info'=> $dt,
							);
				$this->db->insert('pmb_src_info_set', $data);
			}
			endif;
	}
	
	function getsrc_info_set_byid($id){
		$q = $this->db->select('a.*,b.kd_info as id_info,b.info')
		      ->from('pmb_src_info_set a')
			  ->join('pmb_src_info b','a.kd_info=b.kd_info and a.id_daftar ='.$id,'right')
			  ->order_by('b.kd_info','asc')
			  ->get();
		if($q->num_rows()>0)
			return $q->result();
		else 
			return 0;
	}
	
	function insyarat_her(){
		$data = array(
					'syarat'=> $this->input->post('syarat'),
					'jum_syarat'=> $this->input->post('jum_syarat'),
					);
		$this->db->insert('pmb_syarat_her', $data);
		return true;
	}

	function upsyarat_her($id = null){
		if ($id!=null) {
			$data = array(
					'syarat'=> $this->input->post('syarat'),
					'jum_syarat'=> $this->input->post('jum_syarat'),
					);
			$this->db->where('kd',$id);
			$this->db->update('pmb_syarat_her', $data);
			return true;
		} else {
			return false;
		}
	}

	function delsyarat_her($id = null) {
		if ($id!=null) {
			$this->db->where('kd', $id);
	        $this->db->delete('pmb_syarat_her'); 
	        return true;
		} else {
			return false;
		}
	}
	
	private function qsyarat_her(){
		$q = $this->db->select('a.*')
		      ->from('pmb_syarat_her a')
		      ->order_by("a.kd");
		return $q;
	}

	function getsyarat_her(){
		$q = $this->qsyarat_her()->get();
		return $q->result();
	}

	function getsyarat_her_byid($id = null){
		if ($id!=null) {
			$q = $this->qsyarat_her()
				->where('kd',$id)
				->get();
			return $q->result();
		} else {
			return null;
		}
	}
	
	function upsyarat_her_set($id){
		$this->db->where('id_daftar', $id);
		$this->db->delete('pmb_syarat_her_set'); 
		
		$set=$this->input->post('set_syarat');
		$jum=$this->input->post('jum_syarat');
		if($set!=null && $jum!=null) :
			for($a=0;$a<=count($jum);$a++){
				if(isset($set[$a]) && isset($jum[$a]) && $set[$a]!=null && $jum[$a]!=null ) :
					$data = array(
								'id_daftar'=> $id,
								'kd'=> $set[$a],
								'jum'=> $jum[$a],
								);
					$this->db->insert('pmb_syarat_her_set', $data);
				endif;	
			}
		endif;
	}
	
	function getsyarat_her_set_byid($id){
		$q = $this->db->select('a.*,b.kd as id,b.syarat,b.jum_syarat')
		      ->from('pmb_syarat_her_set a')
			  ->join('pmb_syarat_her b','a.kd=b.kd and a.id_daftar ='.$id,'right')
			  ->order_by('b.kd','asc')
			  ->get();
		if($q->num_rows()>0)
			return $q->result();
		else 
			return 0;
	}
	
	function getThnAktif(){
		$q=$this->db->select("a.set_value as th_aktif")
					->from("pmb_setting a")
					->where("a.set_name","active_year")
					->get()->row();
		if(count($q)>0)
			return $q->th_aktif;
		else 
			return 0;
	}
	
	function qGetKonfigUmum(){
			$q=$this->db->get('pmb_setting');
		return $q->result();
	}	
	function qUpKonfigUmum($id=null){
		if($id!=null){
			$this->db->where('set_name',$id)->update('pmb_setting',array('set_value'=> $this->input->post('setkonfig')));
			return true;
		}
		else
			return false;
	}
	
	function qGetSetting($param=null){
		$q = $this->db->where("set_name",$param);
		return $q->get('pmb_setting')->result();
	}

}