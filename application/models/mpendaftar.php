<?php

class Mpendaftar extends CI_Model {
	
	var $tb = "pmb_pendaftar";
	var $active_year;

	function __construct() {
		parent::__construct();
	 	$this->active_year = $this->getActiveYear();
	}

	function getActiveYear()
	{
		$q = $this->db->query("select set_value from pmb_setting where set_name='active_year'")->result();
		return $q[0]->set_value;
	}

	function genNoPendaftaran($prg_id){
		$cekdata=$this->db->select('*')
						  ->from('pmb_pendaftar')
						  ->where('jalur_pendaftaran',$prg_id)
						  ->where('year(tgl_daftar)='.$this->active_year,null,false)
						  ->get();
		if($cekdata->num_rows()>0){
			$q=$this->db->select('max(cast(id_daftar as SIGNED)) as nopendaftar')
						 ->from('pmb_pendaftar')
						 ->where('jalur_pendaftaran',$prg_id)
						 ->where('year(tgl_daftar)='.$this->active_year,null,false)
						 ->get();
			 $row=$q->row();
			 return $row->nopendaftar;
		}
		else{
			$q=$this->db->select('a.noawal as nopendaftar')
						 ->from('pmb_setting_nopendaftar a')
						 ->where('a.prg_id',$prg_id)
						 ->get();
			$row=$q->row();
			return $row->nopendaftar;
		}
	}
	function genPinDaftar(){
		$q=$this->db->query('select FLOOR( 1000000 + ( RAND( ) *8999999 ) ) as pin;');
		$row=$q->row();
		return $row->pin;
	}
	function cekpendaftar($dt){
		$s = array('a.nama','a.email','a.telp','b.nama_sekolah as nm_sklh','a.id_daftar','a.tgl_daftar','a.ip');
		$w = array(
			'a.email'=>strtolower($dt['email']),
			'a.telp'=>strtolower($dt['telp']),
			);
		$wn = array (
			'a.no_induk' => strtolower($dt['nis'])
			);
		$this->db->select($s)->from("pmb_pendaftar a")->join("mst_sekolah b","a.kd_sekolah=b.kd_sekolah","left")
		->where($wn)->or_where($w)->limit(1);

		$r = $this->db->get();
		if($r->num_rows()>0)
			return $r->row();
		else 
			return false;
	}
	function qgetgelombang($id=null,$jenis='id'){
		if($id!=null && $jenis=='id'){
			$q=$this->db->query("
				SELECT a.gel
				FROM (pmb_gelombang a, pmb_pendaftar b)
				WHERE DATE (b.tgl_tes) >= a.tgl_mulai AND DATE(b.tgl_tes) <= a.tgl_akhir AND b.id_daftar='".$id."'
			");
			return $q->row();
		}
		else if($id!=null && $jenis=='tgl') {
			$q=$this->db->query("
				SELECT a.gel
				FROM (pmb_gelombang a)
				WHERE DATE('".$id."') >= a.tgl_mulai AND DATE('".$id."') <= a.tgl_akhir
			");
			return $q->row();
		}
	}
	function inpendaftar($prg_id=null,$op=null){
		$iddaftar=$this->genNoPendaftaran($prg_id)+1;
		$pin=$this->genPinDaftar();
		$p1=$this->input->post('prodi1');
		$p2=$this->input->post('prodi2');
		$prodi1=!empty($p1)?$p1:0;
		$prodi2=!empty($p2)? $p2:0;
		$j = 1;
		if ($prodi1!=0 && $prodi2!=0 || $p1!=$p2) {
			$j = 2;
		} else {
			$j = 1;
		}
		$jp=$this->input->post('jml_pilihan');
		$jml=!empty($jp)? $jp: $j;
		$data = array(
				'id_daftar' 		=> $iddaftar,
				'nama' 				=> strtoupper($this->input->post('nama',TRUE)),
				'jalur_pendaftaran'	=> $prg_id,
				'prodi_pil1'		=> $this->input->post('prodi1',TRUE),
				'prodi_pil2'		=> $this->input->post('prodi2',TRUE),
				'tgl_daftar' 		=> date('Y-m-d H:i:s'),
				'pin'				=> $pin,
				'id_user'			=> $op,
				'bayar_pendaftaran'	=> $this->input->post('niltarif',TRUE),
				'model_bayar'		=> $this->input->post('modbayar',TRUE),
				'jml_pilihan'		=> $jml,
				'ip'				=> $_SERVER['REMOTE_ADDR'],
				);
		$this->db->insert($this->tb, $data);
		$this->inkeluarga($iddaftar,"ayah");
		$this->inkeluarga($iddaftar,"ibu");
		return $iddaftar;
	}
	function inpendaftar_bymaba($prg_id=null,$op=null){
		$iddaftar=$this->genNoPendaftaran($prg_id)+1;
		$pin=$this->genPinDaftar();
		$p1=$this->input->post('prodi1');
		$p2=$this->input->post('prodi2');
		$prodi1=!empty($p1)?$p1:0;
		$prodi2=!empty($p2)? $p2:0;
		$j = 1;
		if ($prodi1!=0 && $prodi2!=0 || $p1!=$p2) {
			$j = 2;
		} else {
			$j = 1;
		}
		$jp=$this->input->post('jml_pilihan');
		$jml=!empty($jp)? $jp: $j;
		$gel=$this->qgetgelombang(date('Y-m-d'),'tgl');
		$data = array(
				'id_daftar' 		=> $iddaftar,
				'nama' 				=> strtoupper($this->input->post('nama',TRUE)),
				'no_induk' 			=> $this->input->post('no_induk',TRUE),
				'sex' 				=> $this->input->post('sex',TRUE),
				'agama' 			=> $this->input->post('agama',TRUE),
				'tmp_lahir' 		=> strtoupper($this->input->post('tmp_lahir',TRUE)),
				'tgl_lahir'			=> date("Y-m-d",strtotime($this->input->post('tgl_lahir',TRUE))),
				'alamat_asal' 		=> strtoupper($this->input->post('alamat',TRUE)),
				'kec_asal' 			=> $this->input->post('kec_asal',TRUE),
				'kab_asal' 			=> $this->input->post('kab_asal',TRUE),
				'alamat_skrg' 		=> strtoupper($this->input->post('alamat_skrg',TRUE)),	
				'kec_skrg' 			=> $this->input->post('kec_skrg',TRUE),
				'kab_skrg' 			=> $this->input->post('kab_skrg',TRUE),
				'kd_sekolah' 		=> $this->input->post('kd_sekolah',TRUE),
				'jurusan'			=> strtoupper($this->input->post('jurusan',TRUE)),
				'thn_lulus'			=> $this->input->post('thn_lulus',TRUE),
				'no_sttb'			=> $this->input->post('no_sttb',TRUE),
				'jml_saudara'		=> $this->input->post('jml_saudara',TRUE),
				'anak_ke'			=> $this->input->post('anak_ke',TRUE),
				'nm_gurubk'			=> $this->input->post('nm_gurubk',TRUE),
				'telp_gurubk'		=> $this->input->post('telp_gurubk',TRUE),
				'rapor_sm1'			=> $this->input->post('rapor_sm1',TRUE),
				'rapor_sm2'			=> $this->input->post('rapor_sm2',TRUE),
				'rapor_sm3'			=> $this->input->post('rapor_sm3',TRUE),
				'rapor_sm4'			=> $this->input->post('rapor_sm4',TRUE),
				'rerata_uan'		=> $this->input->post('rerata_uan',TRUE),
				'prestasi'			=> $this->input->post('prestasi',TRUE),
				'jalur_pendaftaran'	=> $prg_id,
				'alumni'			=> $this->input->post('alumni',TRUE),
				'sdh_lulus'			=> $this->input->post('sdh_lulus',TRUE),
				'telp' 				=> $this->input->post('telp',TRUE),
				'email'				=> $this->input->post('email',TRUE),
				'prodi_pil1'		=> $this->input->post('prodi1',TRUE),
				'prodi_pil2'		=> $this->input->post('prodi2',TRUE),
				'tgl_daftar' 		=> date('Y-m-d H:i:s'),
				'id_gel'			=> $gel->gel,
				'pin'				=> $pin,
				'id_user'			=> $op,
				'tgl_tes'			=> date('Y-m-d'),
				'bayar_pendaftaran'	=> $this->input->post('niltarif',TRUE),
				'model_bayar'		=> $this->input->post('modbayar',TRUE),
				'jml_pilihan'		=> $jml,
				'pdpt_ortu'			=> $this->input->post('pdpt_ortu',TRUE),		
				'hub_keluarga'		=> $this->input->post('hub_keluarga',TRUE),
				'ip'				=> $_SERVER['REMOTE_ADDR'],
				);
		$this->db->insert($this->tb, $data);
		$this->inkeluarga($iddaftar,"ayah");
		$this->inkeluarga($iddaftar,"ibu");
		return $iddaftar;
	}
	function getrekomendasimaxid(){
		$q = $this->db
				  ->select("max(id_rekomendasi) as id",false)
				  ->from("pmb_rekomendasi")
				  ->get()
				  ->result();
		return $q[0]->id;
	}
	function inpendaftar_nonreg($prg_id=null,$op=null){
		$iddaftar=$this->genNoPendaftaran($prg_id)+1;
		$idrekomendasi=$this->getrekomendasimaxid()+1;
		$pin=$this->genPinDaftar();
		$gel=$this->qgetgelombang(date("Y-m-d",strtotime($this->input->post('tgl_pengumuman',TRUE))),'tgl');
		$data = array(
				'id_daftar' 		=> $iddaftar,
				'nama' 				=> strtoupper($this->input->post('nama',TRUE)),
				'jalur_pendaftaran'	=> $prg_id,
				'prodi_pil1'		=> $this->input->post('prodi',TRUE),
				'tgl_daftar' 		=> date("Y-m-d H:i:s"),
				'id_gel'			=> $gel->gel,
				'pin'				=> $pin,
				'id_user'			=> $op,
				'tgl_tes'			=> date("Y-m-d",strtotime($this->input->post('tgl_pengumuman',TRUE))),
				'jml_pilihan'		=> 1,
				'ip'				=> $_SERVER['REMOTE_ADDR'],
				);
		$data2 = array(
				'id_rekomendasi'	=> $idrekomendasi,
				'id_daftar' 		=> $iddaftar,							
				'id_user'			=> $op,
				'rekomendasi' 		=> 'diterima',
				'kd_proditawar' 	=> $this->input->post('prodi',TRUE),
				'tgl_rekomendasi'	=> date('Y-m-d'),
				);
		$this->db->insert($this->tb, $data);
		$this->db->insert("pmb_rekomendasi",$data2);
		return $iddaftar;
	}
	
	function upherregistrasi_byop($id,$user=null){  //update heregistrasi by operator
		if ($id!=null && $user!=null) {			
			$ddlhr= $this->input->post("dd_tgllahir",TRUE);
			$mmlhr= $this->input->post("mm_tgllahir",TRUE);
			$yylhr= $this->input->post("yy_tgllahir",TRUE);
			$tgllhr=$yylhr."-".$mmlhr."-".$ddlhr;
			$data = array(
				'nama' 				=> strtoupper($this->input->post('nama',TRUE)),					
				'sex' 				=> $this->input->post('sex',TRUE),
				'agama' 			=> $this->input->post('agama',TRUE),
				'tmp_lahir' 		=> strtoupper($this->input->post('tmp_lahir',TRUE)),
				'tgl_lahir'			=> $tgllhr,
				'alamat_asal' 		=> strtoupper($this->input->post('alamat',TRUE)),					
				'kec_asal' 			=> $this->input->post('kec_asal',TRUE),
				'kab_asal' 			=> $this->input->post('kab_asal',TRUE),
				'alamat_skrg' 		=> strtoupper($this->input->post('alamat_skrg',TRUE)),	
				'kec_skrg' 			=> $this->input->post('kec_skrg',TRUE),
				'kab_skrg' 			=> $this->input->post('kab_skrg',TRUE),
				'kd_sekolah' 		=> $this->input->post('kd_sekolah',TRUE),
				'jurusan'			=> strtoupper($this->input->post('jurusan',TRUE)),
				'thn_lulus'			=> $this->input->post('thn_lulus',TRUE),
				'no_sttb'			=> $this->input->post('no_sttb',TRUE),
				'jml_saudara'		=> $this->input->post('jml_saudara',TRUE),
				'anak_ke'			=> $this->input->post('anak_ke',TRUE),
				'rerata_uan'		=> $this->input->post('rerata_uan',TRUE),															
				'telp' 				=> $this->input->post('telp',TRUE),										
				'goldar'			=> $this->input->post('goldar',TRUE),
				'wn'				=> $this->input->post('warga_negara',TRUE),
				'stt_mhs'   		=> $this->input->post('status_mhs',TRUE),
				'pembiayaan'   		=> $this->input->post('pembiayaan',TRUE),
				);
			$data2=array(
				'tgl_herregistrasi' => date("Y-m-d H:i:s"),
			);
			$data3=array(
				'ukuran_jaz'		=> $this->input->post('jaz',TRUE),
				'kelas'				=> $this->input->post('kelas',TRUE),
				'angkatan'			=> $this->input->post('angkatan',TRUE),
				'id_user'			=> $user
			);
			$w2=array(
				'id_daftar'			=> $id,
				'tgl_herregistrasi' => NULL,
			);
			$w3=array(
				'id_daftar'			=> $id,
			);
			$this->db->where('id_daftar',$id);
			$this->db->update($this->tb,$data);
			$this->db->where($w2)->update("pmb_herregistrasi",$data2);
			$this->db->where($w3)->update("pmb_herregistrasi",$data3);
			$this->inbekerja($id);
			$this->inkeluarga($id,"ayah");
			$this->inkeluarga($id,"ibu");
			$this->inkeluarga($id,"wali");
			$this->inkeluarga($id,"sutri");			
			return true;
		}
		else
			return false;
	}
	
	function updaftar($id=null,$op=null){
		if ($id!=null) {
			$data = array(
					'nama' 				=> strtoupper($this->input->post('nama',TRUE)),
					'bayar_pendaftaran'	=> $this->input->post('niltarif',TRUE),
					'model_bayar'		=> $this->input->post('modbayar',TRUE),
					'jml_pilihan'		=> $this->input->post('jml_pilihan',TRUE),
					'id_user'			=> $op,
					);
			$this->db->where('id_daftar',$id);
			$this->db->update($this->tb,$data);
			return true;
		}
		else
			return false;
	}
	
	function updatapendaftar($id=null,$op=null){
		if ($id!=null) {
			$tgltes = $this->input->post("tgltes");
			if($tgltes!="1"){
				$ex = explode("-", $this->input->post("tgl_test"));
				if (count($ex)<3) {
					$ex = explode("-", date("d-m-Y"));
				}
			}
			$tgl_tes = ($tgltes=="1"?date("Y/m/d"):$ex[2].'/'.$ex[1].'/'.$ex[0]);
			$gel=$this->qgetgelombang($tgl_tes,'tgl');
			$data = array(
					'nama' 				=> strtoupper($this->input->post('nama',TRUE)),
					'jalur_pendaftaran'	=> $this->input->post('stat_daftar',TRUE),
					'no_induk' 			=> $this->input->post('no_induk',TRUE),
					'sex' 				=> $this->input->post('sex',TRUE),
					'agama' 			=> $this->input->post('agama',TRUE),
					'tmp_lahir' 		=> strtoupper($this->input->post('tmp_lahir',TRUE)),
					'tgl_lahir'			=> date("Y-m-d",strtotime($this->input->post('tgl_lahir',TRUE))),
					'alamat_asal' 		=> strtoupper($this->input->post('alamat',TRUE)),
					'kec_asal' 			=> $this->input->post('kec_asal',TRUE),
					'kab_asal' 			=> $this->input->post('kab_asal',TRUE),
					'alamat_skrg' 		=> strtoupper($this->input->post('alamat_skrg',TRUE)),	
					'kec_skrg' 			=> $this->input->post('kec_skrg',TRUE),
					'kab_skrg' 			=> $this->input->post('kab_skrg',TRUE),
					'kd_sekolah' 		=> $this->input->post('kd_sekolah',TRUE),
					'jurusan'			=> strtoupper($this->input->post('jurusan',TRUE)),
					'thn_lulus'			=> $this->input->post('thn_lulus',TRUE),
					'no_sttb'			=> $this->input->post('no_sttb',TRUE),
					'jml_saudara'		=> $this->input->post('jml_saudara',TRUE),
					'anak_ke'			=> $this->input->post('anak_ke',TRUE),
					'nm_ayah'			=> strtoupper($this->input->post('nm_ayah',TRUE)),
					'nm_ibu'			=> strtoupper($this->input->post('nm_ibu',TRUE)),
					'ket_ayah'			=> $this->input->post('ket_ayah',TRUE),
					'ket_ibu'			=> $this->input->post('ket_ibu',TRUE),
					'kerja_ayah'		=> $this->input->post('kerja_ayah',TRUE),
					'kerja_ibu'			=> $this->input->post('kerja_ibu',TRUE),
					'nm_gurubk'			=> $this->input->post('nm_gurubk',TRUE),
					'telp_gurubk'		=> $this->input->post('telp_gurubk',TRUE),
					'rapor_sm1'			=> $this->input->post('rapor_sm1',TRUE),
					'rapor_sm2'			=> $this->input->post('rapor_sm2',TRUE),
					'rapor_sm3'			=> $this->input->post('rapor_sm3',TRUE),
					'rapor_sm4'			=> $this->input->post('rapor_sm4',TRUE),
					'rerata_uan'		=> $this->input->post('rerata_uan',TRUE),
					'prestasi'			=> $this->input->post('prestasi',TRUE),
					'alumni'			=> $this->input->post('alumni',TRUE),
					'sdh_lulus'			=> $this->input->post('sdh_lulus',TRUE),
					'telp' 				=> $this->input->post('telp',TRUE),
					'email'				=> $this->input->post('email',TRUE),
					'prodi_pil1'		=> $this->input->post('prodi1',TRUE),
					'prodi_pil2'		=> $this->input->post('prodi2',TRUE),
					'id_gel'			=> $gel->gel,
					'id_user'			=> $op,
					'tgl_tes'			=> $tgl_tes,
					'pdpt_ortu'			=> $this->input->post('pdpt_ortu',TRUE),						
					'hub_keluarga'		=> $this->input->post('hub_keluarga',TRUE),					
					);
			$this->db->where('id_daftar',$id);
			$this->db->update($this->tb,$data);
			return true;
		}
		else
			return false;
	}
	
	function updaftarwawancara($id){
		if ($id!=null) {
			$data = array(
					'anak_ke'			=> $this->input->post('anak_ke',TRUE),
					'rapor_sm1'			=> $this->input->post('rapor_sm1',TRUE),
					'rapor_sm2'			=> $this->input->post('rapor_sm2',TRUE),
					'rapor_sm3'			=> $this->input->post('rapor_sm3',TRUE),
					'rapor_sm4'			=> $this->input->post('rapor_sm4',TRUE),
					'prestasi'			=> $this->input->post('prestasi',TRUE),	
					);
			$this->db->where('id_daftar',$id);
			$this->db->update($this->tb,$data);
			return true;
		}
		else
			return false;
	}


	function uppendaftar_bymhs($id){ //edit pendaftaran oleh mahasiswa itu sendiri
		if ($id!=null) {
			$tgltes = $this->input->post("tgltes");
			if($tgltes!="1"){
				$ex = explode("-", $this->input->post("tgl_test"));
			}
			$tgl_tes = ($tgltes=="1"?date("Y/m/d"):$ex[2].'/'.$ex[1].'/'.$ex[0]);
			$ex = explode("-", $this->input->post("tgl_lahir"));
			$tgl_lahir = $ex[2].'/'.$ex[1].'/'.$ex[0];
			$gel=$this->qgetgelombang($tgl_tes,'tgl');
			$data = array(
					'nama' 				=> strtoupper($this->input->post('nama',TRUE)),				
					'tgl_tes' 			=> $tgl_tes,	
					'id_gel'			=> $gel->gel,
					'jalur_pendaftaran'	=> $this->input->post('jalur_pendaftaran',TRUE),	
					'prodi_pil1'		=> $this->input->post('prodi_pil1',TRUE),
					'prodi_pil2'		=> $this->input->post('prodi_pil2',TRUE),	
					'sex'				=> $this->input->post('sex',TRUE),	
					'agama'				=> $this->input->post('agama',TRUE),
					'tmp_lahir'			=> strtoupper($this->input->post('tmp_lahir',TRUE)),
					'tgl_lahir'			=> $tgl_lahir,
					'id_user'			=> $id,
					'alamat_asal'		=> $this->input->post('alamat_asal',TRUE),
					'kab_asal'			=> $this->input->post('kab_asal',TRUE),
					'kec_asal'			=> $this->input->post('kec_asal',TRUE),
					'telp'				=> $this->input->post('telp',TRUE),
					'kd_sekolah'		=> $this->input->post('kd_sekolah',TRUE),
					'jurusan'			=> strtoupper($this->input->post('jurusan',TRUE)),
					'sdh_lulus'			=> $this->input->post('sdh_lulus',TRUE),
					'thn_lulus'			=> $this->input->post('thn_lulus',TRUE),
					'no_sttb'			=> $this->input->post('no_sttb',TRUE),
					'nilai_total'		=> $this->input->post('nilai_total',TRUE),
					'rerata_uan'		=> $this->input->post('rerata_uan',TRUE),
					);
			$this->db->where('id_daftar',$id);
			$this->db->update($this->tb,$data);
			return true;
		}
		else
			return false;
	}

	function upherregistrasi_bymhs($id){ //edit herregistrasi oleh mahasiswa itu sendiri
		if ($id!=null) {
			$ex = explode("-", $this->input->post("tgl_lahir",TRUE));
			$tgl_lahir = $ex[2].'/'.$ex[1].'/'.$ex[0];
			$data = array(
					'nama' 				=> strtoupper($this->input->post('nama',TRUE)),			
					'sex'				=> $this->input->post('sex',TRUE),	
					'agama'				=> $this->input->post('agama',TRUE),
					'tmp_lahir'			=> strtoupper($this->input->post('tmp_lahir',TRUE)),
					'tgl_lahir'			=> $tgl_lahir,
					'alamat_asal'		=> $this->input->post('alamat_asal',TRUE),
					'kab_asal'			=> $this->input->post('kab_asal',TRUE),
					'kec_asal'			=> $this->input->post('kec_asal',TRUE),
					'telp'				=> $this->input->post('telp',TRUE),
					'alamat_skrg'		=> strtoupper($this->input->post('alamat_skrg',TRUE)),
					'kab_skrg'			=> $this->input->post('kab_skrg',TRUE),
					'kec_skrg'			=> $this->input->post('kec_skrg',TRUE),
					'kd_sekolah'		=> $this->input->post('kd_sekolah',TRUE),
					'jurusan'			=> strtoupper($this->input->post('jurusan',TRUE)),
					'thn_lulus'			=> $this->input->post('thn_lulus',TRUE),
					'no_sttb'			=> $this->input->post('no_sttb',TRUE),
					'rerata_uan'		=> $this->input->post('rerata_uan',TRUE),
					'goldar'			=> $this->input->post('goldar',TRUE),
					'wn'				=> $this->input->post('warga_negara',TRUE),
					'stt_mhs'			=> $this->input->post('status_mhs',TRUE),
					'pembiayaan'		=> $this->input->post('pembiayaan',TRUE),
					'jml_saudara'		=> $this->input->post('jml_saudara',TRUE),
					'kawin'				=> $this->input->post('kawin',TRUE),
					'id_user'			=> $id,
					);
			$this->db->where('id_daftar',$id);
			$this->db->update($this->tb,$data);
			$this->inbekerja($id);
			$this->inkeluarga($id,"ayah");
			$this->inkeluarga($id,"ibu");
			$this->inkeluarga($id,"wali");
			$this->inkeluarga($id,"sutri");
			return true;
		}
		else
			return false;
	}

	function inbekerja($id=null){
		if ($id!=null) {
			$this->db->where("id_daftar",$id);
			$this->db->delete("pmb_bekerja");
			$data = array(
					'id_daftar'		=> $id,
					'instansi'		=> strtoupper($this->input->post('instansi',TRUE)),
					'gol'			=> strtoupper($this->input->post('gol',TRUE)),
					'jabatan'		=> strtoupper($this->input->post('jabatan',TRUE)),
				);
			$this->db->insert('pmb_bekerja',$data);
			return true;
		} else
			return false;
	}
	

	function inkeluarga($id=null,$sts=null){
		if ($id!=null && $sts!=null) {
			if ($sts!="sutri") {
				$hub = strtoupper($sts);
				$this->db->where("hub",$hub);
			} else {
				$hub = $this->input->post('sex')=="P"?"ISTRI":"SUAMI";
				$this->db->where("(hub='SUAMI' or hub='ISTRI')",'',false);
			}
			$this->db->where("id_daftar",$id);
			$this->db->delete("pmb_keluarga");
			if($this->input->post('kawin')=="Y" || $sts!="sutri"){ 
				$data = array(
						'id_daftar'		=> $id,
						'nama'			=> strtoupper($this->input->post('nama_'.$sts,TRUE)),
						'hidup'			=> $this->input->post('hidup_'.$sts,TRUE),
						'alamat'		=> strtoupper($this->input->post('alamat_'.$sts,TRUE)),
						'kec'			=> $this->input->post('kec_'.$sts,TRUE),
						'kab'			=> $this->input->post('kab_'.$sts,TRUE),
						'telpon'		=> $this->input->post('telpon_'.$sts,TRUE),
						'pendidikan'	=> $this->input->post('pendidikan_'.$sts,TRUE),
						'pekerjaan'		=> strtoupper($this->input->post('pekerjaan_'.$sts,TRUE)),
						'instansi'		=> strtoupper($this->input->post('instansi_'.$sts,TRUE)),
						'gol'			=> strtoupper($this->input->post('gol_'.$sts,TRUE)),
						'hub'			=> $hub
					);
				$this->db->insert('pmb_keluarga',$data);
			}
			return true;
		} else
			return false;
	}
	
	function qpendaftar(){
		$q= $this->db->select("a.*,a.id_daftar as iddaftar,b.nama_sekolah,b.kd_sekolah,b.kec_sekolah,c.kd_kota as kota_sekolah,d.kd_propinsi as prop_sekolah,f.kd_propinsi as prop_asal")
					->from('pmb_pendaftar a')
					->join("mst_sekolah b","b.kd_sekolah=a.kd_sekolah","left")
					->join("mst_kecamatan c","c.kd_kecamatan=b.kec_sekolah","left")
					->join("mst_kota d","d.kd_kota=c.kd_kota","left")
					->join("mst_kota f","f.kd_kota=a.kab_asal","left");
		return $q;			 
	}
	function qpendaftar2(){
		$q=$this->qpendaftar()
				->select("concat(m.nama_jenjang,'-',j.nama_jurusan,' (',l.nama_status,'-',k.nama_program,')') as prodi1,
						  concat(mm.nama_jenjang,'-',jj.nama_jurusan,' (',ll.nama_status,'-',kk.nama_program,')') as prodi2
				",false)
				->join("mst_proditawar h","h.kd_proditawar=a.prodi_pil1","left") 
				->join("mst_proditawar hh","hh.kd_proditawar=a.prodi_pil2","left") 
				->join("mst_fakultas i","i.kd_fakultas=h.kd_fakultas","left")
				->join("mst_fakultas ii","ii.kd_fakultas=hh.kd_fakultas","left")
				->join("mst_jurusan j","j.kd_jurusan=h.kd_jurusan AND j.kd_fakultas=h.kd_fakultas","left")
				->join("mst_jurusan jj","jj.kd_jurusan=hh.kd_jurusan AND jj.kd_fakultas=hh.kd_fakultas","left")
				->join("mst_program k","k.kd_program=h.kd_program","left")
				->join("mst_program kk","kk.kd_program=hh.kd_program","left")
				->join("mst_status l","l.kd_status=h.kd_status","left")
				->join("mst_status ll","ll.kd_status=hh.kd_status","left")
				->join("mst_jenjang m","m.kd_jenjang=h.kd_jenjang","left")
				->join("mst_jenjang mm","mm.kd_jenjang=hh.kd_jenjang","left");
		return $q;		
	}
	function getpendaftar_byid($id){
		$q=$this->qpendaftar()
				 ->select('(DATE(a.tgl_tes)=DATE(NOW())) as stttgltes, DATE_FORMAT(a.tgl_tes,"%d-%m-%Y") as tgl_test_id, DATE_FORMAT(a.tgl_lahir,"%d-%m-%Y") as tgl_lahir_id, b.alamat_sekolah',false)
				 ->where('a.id_daftar',$id)
				 ->get();
		return $q->row();
	}
	function getpendaftar_byid2($id){
		$q=$this->qpendaftar2()
				 ->where('a.id_daftar',$id)
				 ->get();
		return $q->row();
	}
	function getpendaftar_bydate($awal=null,$akhir=null,$prg_id=0){
		if($awal!=null && $akhir!=null && $awal<=$akhir && $prg_id!=0) {
			$q=$this->qpendaftar2()
			        ->select("n.prg_nama")
					->join("pmb_program n","n.prg_id=a.jalur_pendaftaran","inner")
					->where("DATE(a.tgl_daftar) between STR_TO_DATE('".$awal."','%d-%m-%Y') and STR_TO_DATE('".$akhir."','%d-%m-%Y')" )
					->where("n.prg_id",$prg_id)
					->order_by("a.id_daftar","asc")
					->get()->result();
			return $q;
		}
		else if($awal!=null && $akhir!=null && $awal<=$akhir) {
			$q=$this->qpendaftar2()
			        ->select("n.prg_nama")
					->join("pmb_program n","n.prg_id=a.jalur_pendaftaran","inner")
					->where("DATE(a.tgl_daftar) between STR_TO_DATE('".$awal."','%d-%m-%Y') and STR_TO_DATE('".$akhir."','%d-%m-%Y')")
					->order_by("a.id_daftar","asc")
					->get()->result();
			return $q;
		}
	}
	function getpendaftar_bysearch($word){
		$q=$this->db->select('a.*,b.nama_sekolah,d.nama_kota')
					 ->from('pmb_pendaftar a')
					 ->join("mst_sekolah b","b.kd_sekolah=a.kd_sekolah","left")
					 ->join("mst_kecamatan c","c.kd_kecamatan=b.kec_sekolah","left")
					 ->join("mst_kota d","d.kd_kota=c.kd_kota","left")
					 ->where('year(a.tgl_daftar)='.$this->active_year,null,false)
					 ->where("(a.id_daftar like '%".$word."%' or a.nama like '%".$word."%')",null,false)
					 ->limit(10)
					 ->get();
		return $q->result();
	}
	function getpendaftar_maba_byid($id){ //untuk halaman maba/lokal
		$q=$this->qpendaftar()
				 ->select('(DATE(a.tgl_tes)=DATE(NOW())) as stttgltes, DATE_FORMAT(a.tgl_tes,"%d-%m-%Y") as tgl_test_id, DATE_FORMAT(a.tgl_lahir,"%d-%m-%Y") as tgl_lahir_id, b.alamat_sekolah, h.kd_status',false)
				 //->join("pmb_programprodi g","g.id_programprodi=a.prodi_pil1","left")
				 ->join("mst_proditawar h","h.kd_proditawar=a.prodi_pil1","left")
				 ->where('a.id_daftar',$id)
				 ->get();
		return $q->row();
	}
	function getdaftarwawancara_byid($id){ //untuk halaman maba/lokal
		$q=$this->qpendaftar2()
				->select('(DATE(a.tgl_tes)=DATE(NOW())) as stttgltes, DATE_FORMAT(a.tgl_tes,"%d-%m-%Y") as tgl_test_id, DATE_FORMAT(a.tgl_lahir,"%d-%m-%Y") as tgl_lahir_id, b.alamat_sekolah',false)
				->select('oa.nama as nama_ayah,
						  oa.hidup as hidup_ayah,
						  oa.alamat as alamat_ayah,
						  oa.kec as kec_ayah,
						  oa.kab as kab_ayah,
						  oa.telpon as telpon_ayah,
						  oa.pendidikan as pendidikan_ayah,
						  oa.pekerjaan as pekerjaan_ayah,
						  oa.instansi as instansi_ayah,
						  oa.hub as hub_ayah,
						  oaa.kd_propinsi as prop_ayah'
						  )
				->select('oi.nama as nama_ibu,
						  oi.hidup as hidup_ibu,
						  oi.alamat as alamat_ibu,
						  oi.kec as kec_ibu,
						  oi.kab as kab_ibu,
						  oi.telpon as telpon_ibu,
						  oi.pendidikan as pendidikan_ibu,
						  oi.pekerjaan as pekerjaan_ibu,
						  oi.instansi as instansi_ibu,
						  oi.hub as hub_ibu,
						  oia.kd_propinsi as prop_ibu'
						  )
				->select('ow.nama as nama_wali,
						  ow.hidup as hidup_wali,
						  ow.alamat as alamat_wali,
						  ow.kec as kec_wali,
						  ow.kab as kab_wali,
						  ow.telpon as telpon_wali,
						  ow.pendidikan as pendidikan_wali,
						  ow.pekerjaan as pekerjaan_wali,
						  ow.instansi as instansi_wali,
						  ow.hub as hub_wali,
						  owa.kd_propinsi as prop_wali'
						  )
				->select('os.nama as nama_sutri,
						  os.hidup as hidup_sutri,
						  os.alamat as alamat_sutri,
						  os.kec as kec_sutri,
						  os.kab as kab_sutri,
						  os.telpon as telpon_sutri,
						  os.pendidikan as pendidikan_sutri,
						  os.pekerjaan as pekerjaan_sutri,
						  os.instansi as instansi_sutri,
						  os.hub as hub_sutri,
						  osa.kd_propinsi as prop_sutri'
						  )
				->join("pmb_bekerja n","n.id_daftar=a.id_daftar","left")
				->join("pmb_keluarga oa","oa.id_daftar=a.id_daftar and oa.hub='AYAH'","left")
				->join("mst_kota oaa","oaa.kd_kota=oa.kab","left")
				->join("pmb_keluarga oi","oi.id_daftar=a.id_daftar and oi.hub='IBU'","left")
				->join("mst_kota oia","oia.kd_kota=oi.kab","left")
				->join("pmb_keluarga ow","ow.id_daftar=a.id_daftar and ow.hub='WALI'","left")
				->join("mst_kota owa","owa.kd_kota=ow.kab","left")
				->join("pmb_keluarga os","os.id_daftar=a.id_daftar and (os.hub='SUAMI' or os.hub='ISTRI')","left")
				->join("mst_kota osa","osa.kd_kota=os.kab","left")
				->where('a.id_daftar',$id)
				->get();
		return $q->row();
	}
	function getherregistrasi_maba_byid($id){ //untuk halaman maba/lokal
		$q=$this->qpendaftar()
				->select('(DATE(a.tgl_tes)=DATE(NOW())) as stttgltes, DATE_FORMAT(a.tgl_tes,"%d-%m-%Y") as tgl_test_id, DATE_FORMAT(a.tgl_lahir,"%d-%m-%Y") as tgl_lahir_id, b.alamat_sekolah, g.kd_status,n.*, 
					j.nama_fakultas,k.nama_jurusan,l.nama_jenjang,m.nama_program,h.kd_proditawar',false)
				->select('oa.nama as nama_ayah,
						  oa.hidup as hidup_ayah,
						  oa.alamat as alamat_ayah,
						  oa.kec as kec_ayah,
						  oa.kab as kab_ayah,
						  oa.telpon as telpon_ayah,
						  oa.pendidikan as pendidikan_ayah,
						  oa.pekerjaan as pekerjaan_ayah,
						  oa.instansi as instansi_ayah,
						  oa.gol as gol_ayah,
						  oa.hub as hub_ayah,
						  oaa.kd_propinsi as prop_ayah'
						  )
				->select('oi.nama as nama_ibu,
						  oi.hidup as hidup_ibu,
						  oi.alamat as alamat_ibu,
						  oi.kec as kec_ibu,
						  oi.kab as kab_ibu,
						  oi.telpon as telpon_ibu,
						  oi.pendidikan as pendidikan_ibu,
						  oi.pekerjaan as pekerjaan_ibu,
						  oi.instansi as instansi_ibu,
						  oi.gol as gol_ibu,
						  oi.hub as hub_ibu,
						  oia.kd_propinsi as prop_ibu'
						  )
				->select('ow.nama as nama_wali,
						  ow.hidup as hidup_wali,
						  ow.alamat as alamat_wali,
						  ow.kec as kec_wali,
						  ow.kab as kab_wali,
						  ow.telpon as telpon_wali,
						  ow.pendidikan as pendidikan_wali,
						  ow.pekerjaan as pekerjaan_wali,
						  ow.instansi as instansi_wali,
						  ow.gol as gol_wali,
						  ow.hub as hub_wali,
						  owa.kd_propinsi as prop_wali'
						  )
				->select('os.nama as nama_sutri,
						  os.hidup as hidup_sutri,
						  os.alamat as alamat_sutri,
						  os.kec as kec_sutri,
						  os.kab as kab_sutri,
						  os.telpon as telpon_sutri,
						  os.pendidikan as pendidikan_sutri,
						  os.pekerjaan as pekerjaan_sutri,
						  os.instansi as instansi_sutri,
						  os.gol as gol_sutri,
						  os.hub as hub_sutri,
						  osa.kd_propinsi as prop_sutri'
						  )
				->select('hr.nim as nim,
						  hr.tgl_herregistrasi as tgl_herregistrasi,
						  hr.ukuran_jaz as ukuran_jaz,
						  hr.kelas as kelas,
						  hr.angkatan as angkatan,
						  hr.id_user as id_user,
						  j.nama_fakultas as nama_fakultas,
						  concat(k.nama_jurusan," ",l.nama_jenjang," ",s.nama_status," ",m.nama_program) as prodi',false)						  
				->join("pmb_rekomendasi h","a.id_daftar=h.id_daftar","inner")
				->join("mst_proditawar g","h.kd_proditawar=g.kd_proditawar","inner")
				//->join("pmb_programprodi i","i.kd_proditawar=a.kd_proditawar","left")
				->join("mst_fakultas j","g.kd_fakultas=j.kd_fakultas","inner")
				->join("mst_jurusan k","g.kd_jurusan=k.kd_jurusan and g.kd_fakultas=k.kd_fakultas","inner")
				->join("mst_jenjang l","g.kd_jenjang=l.kd_jenjang","inner")			
				->join("mst_program m","g.kd_program=m.kd_program","inner")
				->join("mst_status s","s.kd_status=g.kd_status","inner")
				->join("pmb_bekerja n","n.id_daftar=a.id_daftar","left")
				->join("pmb_keluarga oa","oa.id_daftar=a.id_daftar and oa.hub='AYAH'","left")
				->join("mst_kota oaa","oaa.kd_kota=oa.kab","left")
				->join("pmb_keluarga oi","oi.id_daftar=a.id_daftar and oi.hub='IBU'","left")
				->join("mst_kota oia","oia.kd_kota=oi.kab","left")
				->join("pmb_keluarga ow","ow.id_daftar=a.id_daftar and ow.hub='WALI'","left")
				->join("mst_kota owa","owa.kd_kota=ow.kab","left")
				->join("pmb_keluarga os","os.id_daftar=a.id_daftar and (os.hub='SUAMI' or os.hub='ISTRI')","left")
				->join("mst_kota osa","osa.kd_kota=os.kab","left")
				->join("pmb_herregistrasi hr","hr.id_daftar=a.id_daftar","left")
				->where('a.id_daftar',$id)
				->where('h.rekomendasi','diterima')
				->get();
		return $q->row();
	}
	function getstatusterima($id){ //status rekomendasi terima mhs untuk halaman maba
		$q = $this->db->select("rekomendasi")
				  	  ->from("pmb_rekomendasi")
				  	  ->where('rekomendasi','diterima')
					  ->where('id_daftar',$id)
				  	  ->get();
		if ($q->num_rows()<=0) {
			return false;
		} else {
			return true;
		}
	}
	
	function gether_bysearch($word,$aksi=null){
		if($aksi==null){
			$q=$this->db->select('a.*,b.nama_sekolah,d.nama_kota,e.nim')
						 ->from('pmb_pendaftar a')
						 ->join("mst_sekolah b","b.kd_sekolah=a.kd_sekolah","left")
						 ->join("mst_kecamatan c","c.kd_kecamatan=b.kec_sekolah","left")
						 ->join("mst_kota d","d.kd_kota=c.kd_kota","left")
						 ->join("pmb_herregistrasi e","e.id_daftar=a.id_daftar","inner")
						 ->where('year(a.tgl_daftar)='.$this->active_year,null,false)
					 	 ->where("(a.id_daftar like '%".$word."%' or a.nama like '%".$word."%')",null,false)
						 ->group_by('a.id_daftar')
						 ->limit(10)
						 ->get();
			return $q->result();
		}else if($aksi=='nim'){
			$q=$this->db->select('a.*,b.nama_sekolah,d.nama_kota,e.nim')
						 ->from('pmb_pendaftar a')
						 ->join("mst_sekolah b","b.kd_sekolah=a.kd_sekolah","left")
						 ->join("mst_kecamatan c","c.kd_kecamatan=b.kec_sekolah","left")
						 ->join("mst_kota d","d.kd_kota=c.kd_kota","left")
						 ->join("pmb_herregistrasi e","e.id_daftar=a.id_daftar","inner")
						 ->where('year(a.tgl_daftar)='.$this->active_year,null,false)
					 	 ->where("(e.nim like '%".$word."%' or a.nama like '%".$word."%')",null,false)
						 ->order_by('e.nim','asc')
						 ->group_by('a.id_daftar')
						 ->limit(10)
						 ->get();
			return $q->result();
		}
	}
	function getbayarher_bysearch($word){
		$q=$this->db->select('a.*,b.nama_sekolah,d.nama_kota')
					 ->from('pmb_pendaftar a')
					 ->join("mst_sekolah b","b.kd_sekolah=a.kd_sekolah","left")
					 ->join("mst_kecamatan c","c.kd_kecamatan=b.kec_sekolah","left")
					 ->join("mst_kota d","d.kd_kota=c.kd_kota","left")
					 ->join("pmb_herbayar e","e.id_daftar=a.id_daftar","inner")
					 ->where('year(a.tgl_daftar)='.$this->active_year,null,false)
				 	 ->where("(a.id_daftar like '%".$word."%' or a.nama like '%".$word."%')",null,false)
					 ->group_by('a.id_daftar')
					 ->limit(10)
					 ->get();
		return $q->result();
	}
	function getbea_bysearch($word){
		$q=$this->db->select('a.*,b.nama_sekolah,d.nama_kota,f.kd_proditawar,f.rekomendasi,f.kd_jenis_beasiswa')
					 ->from('pmb_pendaftar a')
					 ->join("mst_sekolah b","b.kd_sekolah=a.kd_sekolah","left")
					 ->join("mst_kecamatan c","c.kd_kecamatan=b.kec_sekolah","left")
					 ->join("mst_kota d","d.kd_kota=c.kd_kota","left")
					 ->join("pmb_program e","e.prg_id=a.jalur_pendaftaran and e.prg_bea is not null and e.prg_bea!=''","inner")
					 ->join("pmb_rekomendasi f","f.id_daftar=a.id_daftar","left")
					 ->where('year(a.tgl_daftar)='.$this->active_year,null,false)
				 	 ->where("(a.id_daftar like '%".$word."%' or a.nama like '%".$word."%')",null,false)
					 ->group_by('a.id_daftar')
					 ->limit(10)
					 ->get();
		return $q->result();
	}
	
	function delher($id) {
		$this->db->where('nim', $id);
        $this->db->delete('pmb_herregistrasi');
	}
	function ubahnim() {
		$this->db->where('id_daftar',$this->input->post('id_daftar',TRUE))->update("pmb_herregistrasi",array('nim'=> $this->input->post('nim',TRUE)));
	}
}