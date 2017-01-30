<?php

class Mtest extends CI_Model {
	
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

	//Jenis Beasiswa
	function injenis_test(){
		$data = array(
				'id_jenistes'=> $this->input->post('id',TRUE),
				'jenis_tes'=> $this->input->post('jenis',TRUE),
				'ket'=> $this->input->post('ket',TRUE),
				);
		$this->db->insert('pmb_jenistes', $data);
		return true;
	}

	function upjenis_test($id = null){
		if ($id!=null) {
			$data = array(
				'id_jenistes'=> $this->input->post('id',TRUE),
				'jenis_tes'=> $this->input->post('jenis',TRUE),
				'ket'=> $this->input->post('ket',TRUE),
				);
			$this->db->where('id_jenistes',$id);
			$this->db->update('pmb_jenistes',$data);
			return true;
		} else {
			return false;
		}
	}

	function deljenis_test($id = null) {
		if ($id!=null) {
			$this->db->where('id_jenistes', $id);
	        $this->db->delete('pmb_jenistes'); 
	        return true;
		} else {
			return false;
		}
	}

	private function qjenis_test(){
		$q = $this->db->select('a.*')
		      ->from('pmb_jenistes a');
		      
		return $q;
	}

	function getjenis_test(){
		$q = $this->qjenis_test()
			->order_by("a.id_jenistes")
			->get()->result();
		return $q;
	}

	function getjenis_test_byid($id = null){
		if ($id!=null) {
			$q = $this->qjenis_test()
				->where('id_jenistes',$id)
				->get();
			return $q->result();
		} else {
			return null;
		}
	}
	
	function inkategori(){
		$data = array(
				'nama_kategori'	=> $this->input->post('kat',TRUE),
				'jum_soal'		=> $this->input->post('jumsoal',TRUE),
				'tot_nilai'		=> $this->input->post('totnilai',TRUE),
				'ta'			=> $this->input->post('ta',TRUE),
				'id_jenistes'	=> $this->input->post('jnstes',TRUE),
				'id_prioritas'	=> $this->input->post('prioritas',TRUE),
				);
		$this->db->insert('pmb_kategorisoaltes', $data);
		return true;
	}

	function upkategori($id = null){
		if ($id!=null) {
			$data = array(
				'nama_kategori'	=> $this->input->post('kat',TRUE),
				'jum_soal'		=> $this->input->post('jumsoal',TRUE),
				'tot_nilai'		=> $this->input->post('totnilai',TRUE),
				'ta'			=> $this->input->post('ta',TRUE),
				'id_jenistes'	=> $this->input->post('jnstes',TRUE),
				'id_prioritas'	=> $this->input->post('prioritas',TRUE),
				);
			$this->db->where('id_kategori',$id);
			$this->db->update('pmb_kategorisoaltes',$data);
			return true;
		} else {
			return false;
		}
	}

	function delkategori($id = null) {
		if ($id!=null) {
			$this->db->where('id_kategori', $id);
	        $this->db->delete('pmb_kategorisoaltes'); 
	        return true;
		} else {
			return false;
		}
	}

	private function qkategori(){
		$q = $this->qjenis_test()
			  ->select('b.*')
		      ->join('pmb_kategorisoaltes b','b.id_jenistes=a.id_jenistes','inner');
		return $q;
	}

	function getkategori(){
		$q = $this->qkategori()
			->order_by('b.nama_kategori')->get()->result();
		return $q;
	}

	function getkategori_byid($id = null){
		if ($id!=null) {
			$q = $this->qkategori()
				->where('id_kategori',$id)
				->get();
			return $q->result();
		} else {
			return null;
		}
	}
	
	function insoal_tpa($id=null){
		$data = array(
				'id_soal' 		=> $id,
				'soal' 			=> $this->input->post('soal',FALSE),
				'id_kategori' 	=> $this->input->post('kat',TRUE),
				'id_related'	=> $this->input->post('relasi',TRUE),
				'ta'			=> $this->input->post('ta',TRUE),
				'aktif' 		=> $this->input->post('aktif',TRUE),
				);
		$this->db->insert('pmb_soaltestpa', $data);
		$jwb=$this->input->post('jawab',TRUE);
		$key=$this->input->post('kunci',TRUE);
		$k='A';
		$no=$this->getjwb_tpamaxid()+1;
		foreach($jwb as $j){
			$dt=array(
				'id_jawaban'	=> $no++,
				'id_soal'		=> $id,
				'jawaban'		=> $j,
				'kunci_jawaban'	=> ($key==$k ? 1 : 0),
				'nilai'			=> (($key==$k ? 1 : 0)*10),
				);
			$k++;	
			$this->db->insert('pmb_jawabantestpa', $dt);	
		}
		return true;
	}
	
	function upsoal_tpa($id=null) {
		if ($id!=null) {
			$data = array(
					'soal' 			=> $this->input->post('soal',FALSE),
					'id_kategori' 	=> $this->input->post('kat',TRUE),
					'id_related'	=> $this->input->post('relasi',TRUE),
					'ta'			=> $this->input->post('ta',TRUE),
					'aktif' 		=> $this->input->post('aktif',TRUE),
					);
			$this->db->where('id_soal',$id);
			$this->db->update('pmb_soaltestpa',$data);
			$idjwb=$this->input->post('idjawab',TRUE);
			$jwb=$this->input->post('jawab',TRUE);
			$key=$this->input->post('kunci',TRUE);
			$k='A';
			$i=0;
			$no=$this->getjwb_tpamaxid()+1;
			foreach($jwb as $j){
				$dt=array(
					'jawaban'		=> $j,
					'kunci_jawaban'	=> ($key==$k ? 1 : 0),
					'nilai'			=> (($key==$k ? 1 : 0)*10),
					);
				$k++;	
				$this->db->where('id_jawaban',$idjwb[$i++]);
				$this->db->update('pmb_jawabantestpa', $dt);	
			}
			return true;
		} else {
			return false;
		}
	}
	
	function delsoal_tpa($id) {
		$this->db->where('id_soal', $id);
        $this->db->delete('pmb_soaltestpa'); 
		$this->db->where('id_soal', $id);
		$this->db->delete('pmb_jawabantestpa'); 
	} 

	function qsoal_tpa(){
		$q=$this->qkategori()
				->select('c.*,c.ta as ta_soal')
				->join('pmb_soaltestpa c','c.id_kategori=b.id_kategori','right');
		return $q;
	}
	
	function qjwb_tpa(){
		$q=$this->qsoal_tpa()
				->select('d.*')
				->join('pmb_jawabantestpa d','d.id_soal=c.id_soal','inner');
		return $q;
	}
	function getsoal_tpa(){
		$q=$this->qsoal_tpa()
				->order_by("c.id_soal","asc");
		return $q;
	}
	
	function getjwb_tpa(){
		$q=$this->qjwb_tpa()
				->order_by("d.id_jawaban","asc");
		return $q;
	}
	
	function getsoal_tpamaxid(){
		$q = $this->db
				  ->select("max(id_soal) as id",false)
				  ->from("pmb_soaltestpa")
				  ->get()
				  ->result();
		return $q[0]->id;
	}
	
	function getwawancaramaxid(){
		$q = $this->db
				  ->select("max(id_rekomendasi) as id",false)
				  ->from("pmb_rekomendasi")
				  ->get()
				  ->result();
		return $q[0]->id;
	}
	
	function inwawancara($id=null,$iddaftar=null,$op=null){
		if($id!=null && $iddaftar!=null){
			$ingin=$this->input->post('ingin',TRUE)=="lain" ? $this->input->post('ingin_lain',TRUE) : $this->input->post('ingin',TRUE);
			$data=array(
				'id_rekomendasi' => $id,
				'id_daftar' => $iddaftar,								
				'id_user'	=> $op,
				'dft_ptlain' 	=> $this->input->post('dft_ptlain',TRUE),
				'nama_ptn' 	=> $this->input->post('nama_ptn',TRUE),
				'jur_ptn' 	=> $this->input->post('jur_ptn',TRUE),
				'nama_pts' 	=> $this->input->post('nama_pts',TRUE),
				'jur_pts' 	=> $this->input->post('jur_pts',TRUE),
				'rekomendasi' 	=> $this->input->post('rekomendasi',TRUE),
				'kd_proditawar' => $this->input->post('prodi',TRUE),
				'ket_alasan' => $this->input->post('alasan_prodi',TRUE),
				'catatan' => $this->input->post('catatan',TRUE),
				'tgl_rekomendasi' => date("Y-m-d"),
				'ingin_kuliah' => $ingin,
				'penampilan' => $this->input->post('penampilan',TRUE),
				'ket_penampilan' => $this->input->post('penampilan_ket',TRUE),
				'etika' => $this->input->post('etika',TRUE),
				'ket_etika' => $this->input->post('etika_ket',TRUE),
				'komunikasi' => $this->input->post('komunikasi',TRUE),
				'ket_komunikasi' => $this->input->post('komunikasi_ket',TRUE),
				'kepribadian' => $this->input->post('kepribadian',TRUE),
				'ket_kepribadian' => $this->input->post('kepribadian_ket',TRUE),
				'emosional' => $this->input->post('emosional',TRUE),
				'ket_emosional' => $this->input->post('emosional_ket',TRUE),
				'paham_prodi' => $this->input->post('pengetahuan_prodi',TRUE),
				'prospek_lulus' => $this->input->post('prospek_lulus',TRUE),
				'jur_sekolah' => $this->input->post('jur_sekolah',TRUE),
				'nil_1' => $this->input->post('nilai_1',TRUE),
				'nil_2' => $this->input->post('nilai_2',TRUE),
				'nil_3' => $this->input->post('nilai_3',TRUE),
				'nil_4' => $this->input->post('nilai_4',TRUE),
				'nil_5' => $this->input->post('nilai_5',TRUE),
				'nil_6' => $this->input->post('nilai_6',TRUE),
				'nil_7' => $this->input->post('nilai_7',TRUE),
				'nil_8' => $this->input->post('nilai_8',TRUE),
				'nil_9' => $this->input->post('nilai_9',TRUE),
				'pend_nonformal' => $this->input->post('pend_nonformal',TRUE),
				'pelajaran_disukai' => $this->input->post('pelajaran_suka',TRUE),
				'alasan_disukai' => $this->input->post('pelajaran_alasan',TRUE),
				'pelajaran_nonsuka' => $this->input->post('pelajaran_tdk_suka',TRUE),
				'alasan_nonsuka' => $this->input->post('pelajaran_tdk_alasan',TRUE),
				'hobi' => $this->input->post('hobi',TRUE),
				'org_intrasekolah' => $this->input->post('intra',TRUE),
				'org_ekstrasekolah' => $this->input->post('extra',TRUE),
				'hal_lain' => $this->input->post('hal_lain',TRUE),
				'sdr_sekolah' => $this->input->post('jmlsdr_sekolah',TRUE),
				'sdr_kuliah' => $this->input->post('jmlsdr_kuliah',TRUE),
				'sdr_bekerja' => $this->input->post('jmlsdr_bekerja',TRUE),
				'sdr_berkeluarga' => $this->input->post('jmlsdr_keluarga',TRUE),
				'stt_kawinortu' => $this->input->post('stt_kawinortu',TRUE),
				'biaya_tahu' => $this->input->post('biaya_tahu',TRUE),
				'biaya_mampu' => $this->input->post('biaya_mampu',TRUE),
				'sumber_biaya' => $this->input->post('sumber_biaya',TRUE),
				'sumber_biaya_lain' => $this->input->post('sumber_biaya_lain',TRUE),
				'pddk_src_biaya' => $this->input->post('pend_sumber_biaya',TRUE),
				'pekerjaan_src_biaya' => $this->input->post('pekerjaan_sumber_biaya',TRUE),
				'penghasilan_src_biaya' => $this->input->post('penghasilan_sumber_biaya',TRUE),
				'stt_rumah' => $this->input->post('stt_rumah',TRUE),
				'listrik' => $this->input->post('listrik',TRUE),
				'aset_mobil' => $this->input->post('aset_mobil',TRUE),
				'aset_motor' => $this->input->post('aset_motor',TRUE),
				'aset_lain' => $this->input->post('aset_lain_txt',TRUE),
				'motivasi_p1' => $this->input->post('motivasi_p1',TRUE),
				'motivasi_p2' => $this->input->post('motivasi_p2',TRUE),
				'motivasi_p3' => $this->input->post('motivasi_p3',TRUE),
				'motivasi_p4' => $this->input->post('motivasi_p4',TRUE),
				'motivasi_p5' => $this->input->post('motivasi_p5',TRUE),
				'motivasi_p6' => $this->input->post('motivasi_p6',TRUE),
				'nilai_identitas' => $this->input->post('nilai_A',TRUE),
				'nilai_kemampuan_keuangan' => $this->input->post('nilai_B',TRUE),
				'nilai_motivasi' => $this->input->post('nilai_C',TRUE),
				'nilai_akademik' => $this->input->post('nilai_D',TRUE),
				'nilai_tpa' => $this->input->post('nilai_tpa',TRUE),
			);
			$this->db->insert("pmb_rekomendasi",$data);
			return true;
		}
	}
	
	function upwawancara($id=null,$op=null){
		if($id!=null){
			$ingin=$this->input->post('ingin',TRUE)=="lain" ? $this->input->post('ingin_lain',TRUE) : $this->input->post('ingin',TRUE);
			$data=array(				'id_user'	=> $op,
				'dft_ptlain' 	=> $this->input->post('dft_ptlain',TRUE),
				'nama_ptn' 	=> $this->input->post('nama_ptn',TRUE),
				'jur_ptn' 	=> $this->input->post('jur_ptn',TRUE),
				'nama_pts' 	=> $this->input->post('nama_pts',TRUE),
				'jur_pts' 	=> $this->input->post('jur_pts',TRUE),
				'rekomendasi' 	=> $this->input->post('rekomendasi',TRUE),
				'kd_proditawar' => $this->input->post('prodi',TRUE),
				'ket_alasan' => $this->input->post('alasan_prodi',TRUE),
				'catatan' => $this->input->post('catatan',TRUE),
				'tgl_rekomendasi' => date("Y-m-d"),
				'ingin_kuliah' => $ingin,
				'penampilan' => $this->input->post('penampilan',TRUE),
				'ket_penampilan' => $this->input->post('penampilan_ket',TRUE),
				'etika' => $this->input->post('etika',TRUE),
				'ket_etika' => $this->input->post('etika_ket',TRUE),
				'komunikasi' => $this->input->post('komunikasi',TRUE),
				'ket_komunikasi' => $this->input->post('komunikasi_ket',TRUE),
				'kepribadian' => $this->input->post('kepribadian',TRUE),
				'ket_kepribadian' => $this->input->post('kepribadian_ket',TRUE),
				'emosional' => $this->input->post('emosional',TRUE),
				'ket_emosional' => $this->input->post('emosional_ket',TRUE),
				'paham_prodi' => $this->input->post('pengetahuan_prodi',TRUE),
				'prospek_lulus' => $this->input->post('prospek_lulus',TRUE),
				'jur_sekolah' => $this->input->post('jur_sekolah',TRUE),
				'nil_1' => $this->input->post('nilai_1',TRUE),
				'nil_2' => $this->input->post('nilai_2',TRUE),
				'nil_3' => $this->input->post('nilai_3',TRUE),
				'nil_4' => $this->input->post('nilai_4',TRUE),
				'nil_5' => $this->input->post('nilai_5',TRUE),
				'nil_6' => $this->input->post('nilai_6',TRUE),
				'nil_7' => $this->input->post('nilai_7',TRUE),
				'nil_8' => $this->input->post('nilai_8',TRUE),
				'nil_9' => $this->input->post('nilai_9',TRUE),
				'pend_nonformal' => $this->input->post('pend_nonformal',TRUE),
				'pelajaran_disukai' => $this->input->post('pelajaran_suka',TRUE),
				'alasan_disukai' => $this->input->post('pelajaran_alasan',TRUE),
				'pelajaran_nonsuka' => $this->input->post('pelajaran_tdk_suka',TRUE),
				'alasan_nonsuka' => $this->input->post('pelajaran_tdk_alasan',TRUE),
				'hobi' => $this->input->post('hobi',TRUE),
				'org_intrasekolah' => $this->input->post('intra',TRUE),
				'org_ekstrasekolah' => $this->input->post('extra',TRUE),
				'hal_lain' => $this->input->post('hal_lain',TRUE),
				'sdr_sekolah' => $this->input->post('jmlsdr_sekolah',TRUE),
				'sdr_kuliah' => $this->input->post('jmlsdr_kuliah',TRUE),
				'sdr_bekerja' => $this->input->post('jmlsdr_bekerja',TRUE),
				'sdr_berkeluarga' => $this->input->post('jmlsdr_keluarga',TRUE),
				'stt_kawinortu' => $this->input->post('stt_kawinortu',TRUE),
				'biaya_tahu' => $this->input->post('biaya_tahu',TRUE),
				'biaya_mampu' => $this->input->post('biaya_mampu',TRUE),
				'sumber_biaya' => $this->input->post('sumber_biaya',TRUE),
				'sumber_biaya_lain' => $this->input->post('sumber_biaya_lain',TRUE),
				'pddk_src_biaya' => $this->input->post('pend_sumber_biaya',TRUE),
				'pekerjaan_src_biaya' => $this->input->post('pekerjaan_sumber_biaya',TRUE),
				'penghasilan_src_biaya' => $this->input->post('penghasilan_sumber_biaya',TRUE),
				'stt_rumah' => $this->input->post('stt_rumah',TRUE),
				'listrik' => $this->input->post('listrik',TRUE),
				'aset_mobil' => $this->input->post('aset_mobil',TRUE),
				'aset_motor' => $this->input->post('aset_motor',TRUE),
				'aset_lain' => $this->input->post('aset_lain_txt',TRUE),
				'motivasi_p1' => $this->input->post('motivasi_p1',TRUE),
				'motivasi_p2' => $this->input->post('motivasi_p2',TRUE),
				'motivasi_p3' => $this->input->post('motivasi_p3',TRUE),
				'motivasi_p4' => $this->input->post('motivasi_p4',TRUE),
				'motivasi_p5' => $this->input->post('motivasi_p5',TRUE),
				'motivasi_p6' => $this->input->post('motivasi_p6',TRUE),
				'nilai_identitas' => $this->input->post('nilai_A',TRUE),
				'nilai_kemampuan_keuangan' => $this->input->post('nilai_B',TRUE),
				'nilai_motivasi' => $this->input->post('nilai_C',TRUE),
				'nilai_akademik' => $this->input->post('nilai_D',TRUE),
				'nilai_tpa' => $this->input->post('nilai_tpa',TRUE),
			);
			$this->db->where("id_daftar",$id)->update("pmb_rekomendasi",$data);
			return true;
		}
	}
	
	function getjwb_tpamaxid(){
		$q = $this->db
				  ->select("max(id_jawaban) as id",false)
				  ->from("pmb_jawabantestpa")
				  ->get()
				  ->result();
		return $q[0]->id;
	}
	
	function getcbsoal_tpa(){
		$q = $this->getsoal_tpa()
					  ->get();
		return $q->result();
	}
	
	function getcbjwb_tpa(){
		$q = $this->getjwb_tpa()
					  ->get();
		return $q->result();
	}
	
	function getsoal_tpaby_link($art_link=null){
		$q = $this->getsoal_tpa();
		$q = $q->where('a.page_link',$art_link)
			   ->order_by("a.page_tgl","desc");
		return $q->get()->result();
	}

	function getsoal_tpaby_page($jml_page,$id_page,$key=null){
		if ($key==null) {
			$q = $this->getsoal_tpa()
			   ->order_by("a.page_tgl","desc");
		} else {
			$q = $this->getqby_flter($key)
			   ->order_by("a.page_tgl","desc");
		}
		$q = $q->get('',$jml_page,$id_page);
		return $q->result();
	}
	
	function getsoal_tpaby(){
		$q = $this->getsoal_tpa()
			   ->order_by("a.page_tgl","desc");
		return $q->get()->result();
	}

	function getsoal_tpaby_id($id=null){
		$q = $this->getsoal_tpa();
		$q = $q->where('c.id_soal',$id);
		return $q->get()->result();
	}
	
	function getjwb_tpaby_id($id=null){
		$q = $this->getjwb_tpa();
		$q = $q->where('c.id_soal',$id);
		return $q->get()->result();
	}

	function getsoal_tpaby_filter($filter=null){
		$q = $this->getqby_flter($filter)
			   ->order_by("a.page_tgl","desc");
		return $q->get()->result();
	}
	
	function deljwb_tpa($id) {
		$this->db->where('id_daftar', $id);
        $this->db->delete('pmb_testpa');
	}
	function getjwbtpa_bysearch($word){
		$key=array(
			'a.id_daftar' => $word,
			'a.nama'	  => $word,
		);
		$q=$this->db->select('a.*,b.nama_sekolah,d.nama_kota')
					 ->from('pmb_pendaftar a')
					 ->join("mst_sekolah b","b.kd_sekolah=a.kd_sekolah","left")
					 ->join("mst_kecamatan c","c.kd_kecamatan=b.kec_sekolah","left")
					 ->join("mst_kota d","d.kd_kota=c.kd_kota","left")
					 ->join("pmb_testpa e","e.id_daftar=a.id_daftar","inner")
					 ->where("year(a.tgl_daftar)",$this->active_year)
					 ->where("(a.id_daftar like '%".$word."%' or a.nama like '%".$word."%')",null,false)
					 ->group_by('a.id_daftar')
					 ->limit(10)
					 ->get();
		return $q->result();
	}

}