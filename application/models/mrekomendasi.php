<?php

class Mrekomendasi extends CI_Model {
	
	var $tb = "pmb_rekomendasi";
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


	function gennosurat($prg_id=null,$rekomendasi=null){
		if($prg_id!=null && $rekomendasi!=null){
			$q=$this->db->select("
						if(a.no_surat is not null OR a.no_surat!='',
						if(max(cast(a.no_surat AS SIGNED))+1 < 10,concat('00',max(cast(a.no_surat AS SIGNED))+1),
						if(max(cast(a.no_surat AS SIGNED))+1 < 100,concat('0',max(cast(a.no_surat AS SIGNED))+1), 
						IF(MAX(CAST(a.no_surat AS SIGNED))+1 > 999, MAX(CAST(a.no_surat AS SIGNED))+1, 
						max(cast(a.no_surat AS SIGNED))+1))),'001') as next_nosurat
						",false)
						->from("pmb_rekomendasi a")
						->join("pmb_pendaftar b","b.id_daftar=a.id_daftar")
						->where("b.jalur_pendaftaran",$prg_id)
						->where("a.rekomendasi",$rekomendasi)
						->where("YEAR(b.tgl_daftar)",$this->active_year)
						->get()->row();
			return $q;			
		}
	}
	
	function gennim($id=null){
		if($id!=null){
			$q=$this->db->select("
						if(max(cast(bb.nim AS SIGNED)) is not null,max(cast(bb.nim AS SIGNED))+1, concat(c.dgt1,substring(aa.set_value,3,4),c.dgt4,c.dgt5,c.dgt6,c.dgt7,'001')) as next_nim
						",false)
						->from("pmb_programprodi c,pmb_setting aa")
						->join("pmb_rekomendasi a","c.kd_proditawar=a.kd_proditawar","left")
						->join("pmb_herregistrasi bb","bb.id_daftar=a.id_daftar AND substring(bb.nim,1,7)=CONCAT(c.dgt1, SUBSTRING(aa.set_value,3,4),c.dgt4,c.dgt5,c.dgt6,c.dgt7)","left")
						->where("aa.set_name","active_year")
						->where("c.kd_proditawar",$id)
						->get()->row();
			return $q;			
		}
	}
	
	function getnim($id=null,$nim=null){
		if($id!=null && $nim!=null){
			$q=$this->db->select("nim,id_daftar",false)
						->from("pmb_herregistrasi")
						->where("id_daftar",$id)
						->or_where("nim",$nim)
						->get()->row();
			return $q;
		}else if($id!=null){
			$q=$this->db->select("nim,id_daftar",false)
						->from("pmb_herregistrasi")
						->where("nim",$id)
						->get()->row();
			return $q;
		}
	}
	function qInNim($id=null,$nim=null,$user=null){
		$cek=$this->getnim($id,$nim);
		if($id!=null && $nim!=null && $cek==null){
			$data=array(
				'id_daftar' => $id,
				'nim' => $nim,
				'tgl_herregistrasi' => date("Y-m-d H:i:s"),
				'id_user' => $user,
			);
			$this->db->insert("pmb_herregistrasi",$data);
			
			return true;
		}
		else	
			return false;
	}
	
	function upnosurat($id=null,$prg_id=null,$rekomendasi=null,$no_surat=null,$png_id=null){
		if($id!=null && $prg_id!=null && $rekomendasi!=null && ($no_surat==null || $no_surat=="") && $png_id!=null){
			$no=$this->gennosurat($prg_id,$rekomendasi);
			$w=array(
				"id_rekomendasi"=>$id,
				"rekomendasi"	=>$rekomendasi
			);
			$data=array(
				'no_surat' 	=> $no->next_nosurat,
				'png_id' 	=> $png_id,
				'stat_cetak'=> 'Y'
			);
			$this->db->where($w);
			$this->db->update("pmb_rekomendasi",$data);
			return $no->next_nosurat;
			
		} else if($id!=null && $prg_id!=null && $rekomendasi!=null && $png_id!=null && $no_surat!=null && $no_surat!=""){
			$w=array(
				"id_rekomendasi"=>$id,
				"rekomendasi"	=>$rekomendasi
			);
			$data=array(
				'stat_cetak'=> 'Y'
			);
			$this->db->where($w);
			$this->db->update("pmb_rekomendasi",$data);
			return $no_surat;
		}
		
	}
	function upcetakamplop($id=null){
		$w=array(
			"id_rekomendasi"=>$id,
		);
		$data=array(
			'stat_cetak_amplop'=> 'Y'
		);
		$this->db->where($w);
		$this->db->update("pmb_rekomendasi",$data);
		return true;
	}
	function qrekomendasi(){
		$q= $this->db->select("a.*,a.id_daftar as iddaftar,b.kd_sekolah,b.nama_sekolah as sklh, concat ( b.nama_sekolah,', ',c.nama_kecamatan,', ',d.nama_kota,', ',e.nama_propinsi) as asal_sklh,
					b.nama_sekolah,b.kd_sekolah,b.kec_sekolah,c.kd_kota as kota_sekolah,d.kd_propinsi as prop_sekolah,ee.kd_propinsi as prop_asal,
					concat( a.alamat_asal,', ',f.nama_kecamatan,', ',dd.nama_kota,', ',ee.nama_propinsi) as alamat_asal,g.*,g.kd_proditawar as prodi_terima,
					j.prg_nama , CONCAT( q.nama_jenjang , ' - ' , n.nama_jurusan ) AS prodi, m.kd_fakultas,
					concat( p.nama_status , ' - ' , o.nama_program) as kelas ,m.nama_fakultas as fakultas,
					if(WEEKDAY(a.tgl_tes)=6-(r.set_value) % 7,date_add(a.tgl_tes,INTERVAL r.set_value +1 DAY),date_add(a.tgl_tes,INTERVAL r.set_value DAY)) as tgl_her,
					k.jenis_beasiswa,
					",false)
					->from('pmb_pendaftar a,pmb_setting r')
					->join("mst_sekolah b","b.kd_sekolah=a.kd_sekolah","left")
					->join("mst_kecamatan c","c.kd_kecamatan=b.kec_sekolah","left")
					->join("mst_kota d","d.kd_kota=c.kd_kota","left")
					->join("mst_propinsi e","e.kd_propinsi=d.kd_propinsi","left")
					->join("mst_kecamatan f","f.kd_kecamatan=a.kec_asal","left")
					->join("mst_kota dd","dd.kd_kota=a.kab_asal","left")
					->join("mst_propinsi ee","ee.kd_propinsi=dd.kd_propinsi","left")
					->join("pmb_rekomendasi g","g.id_daftar=a.id_daftar","inner")
					->join("pmb_program j","j.prg_id=a.jalur_pendaftaran")
					->join("pmb_jenis_beasiswa k","k.kd_jenis_beasiswa=g.kd_jenis_beasiswa","left")
					->join("mst_proditawar l","l.kd_proditawar=g.kd_proditawar") 
					->join("mst_fakultas m","m.kd_fakultas=l.kd_fakultas","inner")
					->join("mst_jurusan n","n.kd_jurusan=l.kd_jurusan AND n.kd_fakultas=l.kd_fakultas","inner")
					->join("mst_program o","o.kd_program=l.kd_program","inner")
					->join("mst_status p","p.kd_status=l.kd_status","inner")
					->join("mst_jenjang q","q.kd_jenjang=l.kd_jenjang","inner")
					->where("r.set_name","interval");
		return $q;			 
	}	

	function qrekomendasibiaya_backup(){
		$q=$this->qrekomendasi()
				->select("
					jj.gel,(select set_value from pmb_setting where set_name='dpa') as dpa,g.spa as spa_pot,h.spp_tetap,h.sppv_teori,
					IF(h.stat_biaya=1,IF(l.kd_status=2,h.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum + jj.tbh_spa_alum,h.spa + jj.tbh_spa)), IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum,h.spa)) as spa,
					IF(h.stat_biaya=1,IF(l.kd_status=2,h.spa + jj.tbh_spa_transfer - g.spa  ,IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum + jj.tbh_spa_alum - g.spa,h.spa + jj.tbh_spa - g.spa)),IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum - g.spa,h.spa - g.spa)) as spa_byr,
					IF(h.stat_biaya=1,IF(l.kd_status=2,h.spa + jj.tbh_spa_transfer - g.spa  ,IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum + jj.tbh_spa_alum - g.spa,h.spa + jj.tbh_spa - g.spa)),IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum - g.spa,h.spa - g.spa)) * i.spa1 / 100 as spa1,
					IF(h.stat_biaya=1,IF(l.kd_status=2,h.spa + jj.tbh_spa_transfer - g.spa  ,IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum + jj.tbh_spa_alum - g.spa,h.spa + jj.tbh_spa - g.spa)),IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum - g.spa,h.spa - g.spa)) * i.spa2 / 100 as spa2,
					IF(h.stat_biaya=1,IF(l.kd_status=2,h.spa + jj.tbh_spa_transfer - g.spa  ,IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum + jj.tbh_spa_alum - g.spa,h.spa + jj.tbh_spa - g.spa)),IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum - g.spa,h.spa - g.spa)) * i.spa3 / 100 as spa3,
					IF(h.stat_biaya=1,IF(l.kd_status=2,h.spa + jj.tbh_spa_transfer - g.spa  ,IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum + jj.tbh_spa_alum - g.spa,h.spa + jj.tbh_spa - g.spa)),IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum - g.spa,h.spa - g.spa)) * i.spa4 / 100 as spa4,
					i.spa1 as persen1,i.spa2 as persen2,i.spa3 as persen3,i.spa4 as persen4	
				",false)
				//->join("pmb_gelombang jj","DATE( a.tgl_tes ) >= jj.tgl_mulai AND date( a.tgl_tes ) <= jj.tgl_akhir",'inner')
				->join("pmb_programprodi hh","hh.kd_proditawar=g.kd_proditawar","inner")
				->join("pmb_programbiayaprodi h","h.id_programprodi=hh.id_programprodi","inner")
				->from("pmb_setting_angsuran i,pmb_gelombang jj")
				->where("date ( a.tgl_tes ) >= jj.tgl_mulai AND date( a.tgl_tes ) <= jj.tgl_akhir and YEAR(a.tgl_daftar)=h.thn_berlaku",null,false)
				->group_by("a.id_daftar");
				
		return $q;
	}
	
	function qrekomendasibiaya_backup2(){
		$q=$this->qrekomendasi()
				->select("
					h.dpa AS dpa, h.spa_pot AS spa_pot, 
					h.spp_tetap as spp_tetap,h.spp_var,h.spp_var as sppv_teori, 
					(h.spa+h.spa_pot) AS spa,
					h.spa AS spa_byr, 
					h.spa * i.spa1 / 100 AS spa1, 
					h.spa * i.spa2 / 100 AS spa2, 
					h.spa * i.spa3 / 100 AS spa3, 
					h.spa * i.spa4 / 100 AS spa4,
					i.spa1 as persen1,i.spa2 as persen2,i.spa3 as persen3,i.spa4 as persen4	
				",false)
				->from("pmb_setting_angsuran i")
				->join("pmb_herbayar h","h.id_daftar=g.id_daftar","left");
		return $q;
	}
	
	function qrekomendasibiaya(){
		$q=$this->qrekomendasi()
				->select("
					jj.gel,
					IF(h.dpa is not null,h.dpa,(SELECT set_value FROM pmb_setting WHERE set_name='dpa')) AS dpa, 
					IF(h.spa_pot is not null,h.spa_pot,0) AS spa_pot, 
					IF(h.spp_tetap is not null,h.spp_tetap,h3.spp_tetap) as spp_tetap,
					IF(h.spp_var is not null,h.spp_var,h3.sppv_teori) as sppv_teori  , 
					IF(h.spa is not null,h.spa+h.spa_pot,IF(h3.stat_biaya=1,IF(l.kd_status=2,h3.spa + jj.tbh_spa_transfer,IF(a.alumni=1 AND h3.spa_alum>0,h3.spa_alum + jj.tbh_spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h3.spa + jj.tbh_spa),h3.spa + jj.tbh_spa))),IF(a.alumni=1 AND h3.spa_alum>0,h3.spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h3.spa),h3.spa)))) as spa,
					IF(h.spa is not null,h.spa,IF(h3.stat_biaya=1,IF(l.kd_status=2,h3.spa + jj.tbh_spa_transfer,IF(a.alumni=1 AND h3.spa_alum>0,h3.spa_alum + jj.tbh_spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h3.spa + jj.tbh_spa),h3.spa + jj.tbh_spa))),IF(a.alumni=1 AND h3.spa_alum>0,h3.spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h3.spa),h3.spa)))) as spa_byr,
					IF(h.spa is not null,h.spa,IF(h3.stat_biaya=1,IF(l.kd_status=2,h3.spa + jj.tbh_spa_transfer,IF(a.alumni=1 AND h3.spa_alum>0,h3.spa_alum + jj.tbh_spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h3.spa + jj.tbh_spa),h3.spa + jj.tbh_spa))),IF(a.alumni=1 AND h3.spa_alum>0,h3.spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h3.spa),h3.spa)))) * i.spa1 / 100 as spa1,
					IF(h.spa is not null,h.spa,IF(h3.stat_biaya=1,IF(l.kd_status=2,h3.spa + jj.tbh_spa_transfer,IF(a.alumni=1 AND h3.spa_alum>0,h3.spa_alum + jj.tbh_spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h3.spa + jj.tbh_spa),h3.spa + jj.tbh_spa))),IF(a.alumni=1 AND h3.spa_alum>0,h3.spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h3.spa),h3.spa)))) * i.spa2 / 100 as spa2,
					IF(h.spa is not null,h.spa,IF(h3.stat_biaya=1,IF(l.kd_status=2,h3.spa + jj.tbh_spa_transfer,IF(a.alumni=1 AND h3.spa_alum>0,h3.spa_alum + jj.tbh_spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h3.spa + jj.tbh_spa),h3.spa + jj.tbh_spa))),IF(a.alumni=1 AND h3.spa_alum>0,h3.spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h3.spa),h3.spa)))) * i.spa3 / 100 as spa3,
					IF(h.spa is not null,h.spa,IF(h3.stat_biaya=1,IF(l.kd_status=2,h3.spa + jj.tbh_spa_transfer,IF(a.alumni=1 AND h3.spa_alum>0,h3.spa_alum + jj.tbh_spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h3.spa + jj.tbh_spa),h3.spa + jj.tbh_spa))),IF(a.alumni=1 AND h3.spa_alum>0,h3.spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h3.spa),h3.spa)))) * i.spa4 / 100 as spa4,
					i.spa1 as persen1,i.spa2 as persen2,i.spa3 as persen3,i.spa4 as persen4	
				",false)
				->join("pmb_herbayar h","h.id_daftar=g.id_daftar","left")
				->join("pmb_programprodi h2","h2.kd_proditawar=g.kd_proditawar","inner")
				->join("pmb_programbiayaprodi h3","h3.id_programprodi=h2.id_programprodi","inner")
				->from("pmb_setting_angsuran i,pmb_gelombang jj")
				->where("date ( a.tgl_tes ) >= jj.tgl_mulai AND date( a.tgl_tes ) <= jj.tgl_akhir and YEAR(a.tgl_daftar)=h3.thn_berlaku",null,false)
				//->where("a.jalur_pendaftaran",2)
				->group_by("a.id_daftar");
				
		return $q;
	}
	
	function getrekomendasi_all(){
		$q=$this->qrekomendasibiaya()
				 ->get()->result();
		return $q;
	}
	
	function getrekomendasi_allbydate($prog=null,$awal=null,$akhir=null,$cari=null,$dari=null,$jum_page=null,$jnsbea=null){
		$q=$this->qrekomendasibiaya()
				->order_by("g.stat_cetak,g.stat_cetak_amplop,g.id_daftar","asc");
		if($cari!=null){
			$like=array(
				"a.id_daftar"	=>$cari,
				"a.nama"	 	=>$cari,
			);
			$q=$q->where("( a.id_daftar like '%".$cari."%' OR a.nama like '%".$cari."%')",null,FALSE);		
		}
		if($prog!=null)
			$q=$q->where("a.jalur_pendaftaran",$prog);
		if($awal!=null && $akhir!=null) {
			$q=$q->where("a.tgl_tes between STR_TO_DATE('".$awal."','%d-%m-%Y') and STR_TO_DATE('".$akhir."','%d-%m-%Y')" );
		} 
		if($jnsbea!=null ) {
			$q=$q->where("g.kd_jenis_beasiswa",$jnsbea);	
		} 
		if ($jum_page!=null) {
				$q=$q->get(null,$jum_page,$dari)->result();
			} else {
				$q=$q->get();
			}
			return $q;
	}
	function getrekap_pendaftar($prog=null,$awal=null,$akhir=null,$jenis=0){
		if($jenis==0) {
			if($prog!=null && $awal!=null && $akhir!=null) {
				$q=$this->db->query("
				SELECT a.id_daftar AS iddaftar,concat(q2.nama_jenjang,'-',n2.nama_jurusan,' (',p2.nama_status,'-',o2.nama_program,')') as prodi_pil1,concat(q3.nama_jenjang,'-',n3.nama_jurusan,' (',p3.nama_status,'-',o3.nama_program,')') as prodi_pil2,
				a.nama,a.no_induk as nis,a.pin,b.nama_sekolah AS sklh,b.stts_sekolah as jns_sklh, c.nama_kecamatan AS kec_sklh, d.nama_kota AS kota_sklh,e.nama_propinsi AS prop_sklh, 
				a.alamat_asal, f.nama_kecamatan AS kec_asal, dd.nama_kota as kota_asal, ee.nama_propinsi AS prop_asal,
				a.alamat_skrg, f2.nama_kecamatan AS kec_skrg, d2.nama_kota as kota_skrg, e2.nama_propinsi AS prop_skrg, 
				j.prg_nama,jj.gel,a.tgl_tes,a.tgl_daftar,a1.aut_display_name as op_daftar,a.bayar_pendaftaran as byr_daftar,IF(a.model_bayar=1,'Di tempat Pendaftaran',IF(a.model_bayar=2,'Di Bank',IF(a.model_bayar=3,'Bebas Biaya Pendaftaran', '-')))as model_bayar,a.jml_pilihan,
				IF(a.sex='P','Pria',IF(a.sex='W','Wanita',null)) as jk,a.telp,a2.nama as agama,a.tmp_lahir,a.tgl_lahir,a.jurusan as jur_sma,a.thn_lulus,a.no_sttb as sttb,a.nilai_total as danem ,p.nama_status as status_transfer,IF(a.alumni=1,'Alumni',null) as alumni,IF(a.hub_keluarga=1,'Ada Hubungan Keluarga','Tidak Ada Hubungan Keluarga') as hub_keluarga,
				a.rapor_sm1,a.rapor_sm2,a.rapor_sm3,a.rapor_sm4,a.rerata_uan,
				g2.aut_display_name as pewawancara,g.nilai_tpa, m.nama_fakultas AS fakultas, CONCAT(q.nama_jenjang, ' - ', n.nama_jurusan,'(',p.nama_status, ' - ', o.nama_program,')') AS prodi,
				g.rekomendasi,g.tgl_rekomendasi,g.nilai_identitas,g.nilai_kemampuan_keuangan as nilai_keuangan,g.nilai_motivasi,g.nilai_akademik,
				 g3.tgl_herregistrasi,g3.nim,g3.ukuran_jaz, IF(h.dpa IS NOT NULL,
				h.dpa, (SELECT set_value FROM pmb_setting WHERE set_name='dpa')) AS dpa, IF(h.spa_pot IS NOT NULL, h.spa_pot, 0) AS spa_pot, IF(h.spp_tetap IS NOT NULL, h.spp_tetap, h3.spp_tetap) AS spp_tetap, IF(h.spp_var IS NOT NULL, h.spp_var, h3.sppv_teori) AS sppv_teori, IF(h.spa IS NOT NULL, h.spa+h.spa_pot, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) AS spa, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) AS spa_byr, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa1 / 100 AS spa1, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa2 / 100 AS spa2, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa3 / 100 AS spa3, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa4 / 100 AS spa4, i.spa1 AS persen1, i.spa2 AS persen2, i.spa3 AS persen3, i.spa4 AS persen4
				,IF(g.penghasilan_src_biaya is not null or g.penghasilan_src_biaya!='',g.penghasilan_src_biaya,null) as pdpt_pembiaya,
				(CASE a.pdpt_ortu 
				WHEN '1sd3' THEN '1 juta s/d 3 juta'
				WHEN '3sd5' THEN '3 juta s/d 5 juta'
				WHEN '5sd10' THEN '5 juta s/d 10 juta'
				WHEN '>10' THEN 'lebih dari 10 juta' else null END
				) as pdpt_ortu
				FROM (`pmb_pendaftar` a, `pmb_setting_angsuran` i, `pmb_gelombang` jj)
				LEFT JOIN pmb_author a1 on a1.aut_username=a.id_user
				LEFT JOIN mst_agama a2 on a2.kd_agama=a.agama
				LEFT JOIN `mst_sekolah` b ON `b`.`kd_sekolah`=`a`.`kd_sekolah`
				LEFT JOIN `mst_kecamatan` c ON `c`.`kd_kecamatan`=`b`.`kec_sekolah`
				LEFT JOIN `mst_kota` d ON `d`.`kd_kota`=`c`.`kd_kota`
				LEFT JOIN `mst_propinsi` e ON `e`.`kd_propinsi`=`d`.`kd_propinsi`
				LEFT JOIN `mst_kecamatan` f ON `f`.`kd_kecamatan`=`a`.`kec_asal`
				LEFT JOIN `mst_kota` dd ON `dd`.`kd_kota`=`a`.`kab_asal`
				LEFT JOIN `mst_propinsi` ee ON `ee`.`kd_propinsi`=`dd`.`kd_propinsi`
				LEFT JOIN `mst_kecamatan` f2 ON `f2`.`kd_kecamatan`=`a`.`kec_skrg`
				LEFT JOIN `mst_kota` d2 ON `dd`.`kd_kota`=`a`.`kab_skrg`
				LEFT JOIN `mst_propinsi` e2 ON `e2`.`kd_propinsi`=`d2`.`kd_propinsi`
				left JOIN `pmb_rekomendasi` g ON `g`.`id_daftar`=`a`.`id_daftar`
				LEFT JOIN pmb_author g2 on g2.aut_username=g.id_user
				LEFT JOIN `pmb_herregistrasi` g3 ON `g3`.`id_daftar`=`g`.`id_daftar`
				left JOIN `pmb_program` j ON `j`.`prg_id`=`a`.`jalur_pendaftaran`
				left JOIN `mst_proditawar` l ON `l`.`kd_proditawar`=g.kd_proditawar
				left JOIN `mst_fakultas` m ON `m`.`kd_fakultas`=`l`.`kd_fakultas`
				left JOIN `mst_jurusan` n ON `n`.`kd_jurusan`=`l`.`kd_jurusan` AND n.kd_fakultas=l.kd_fakultas
				left JOIN `mst_program` o ON `o`.`kd_program`=`l`.`kd_program`
				left JOIN `mst_status` p ON `p`.`kd_status`=`l`.`kd_status`
				left JOIN `mst_jenjang` q ON `q`.`kd_jenjang`=`l`.`kd_jenjang`
				left JOIN `mst_proditawar` l2 ON `l2`.`kd_proditawar`=a.prodi_pil1 
				left JOIN `mst_fakultas` m2 ON `m2`.`kd_fakultas`=`l2`.`kd_fakultas`
				left JOIN `mst_jurusan` n2 ON `n2`.`kd_jurusan`=`l2`.`kd_jurusan` AND n2.kd_fakultas=l2.kd_fakultas
				left JOIN `mst_program` o2 ON `o2`.`kd_program`=`l2`.`kd_program`
				left JOIN `mst_status` p2 ON `p2`.`kd_status`=`l2`.`kd_status`
				left JOIN `mst_jenjang` q2 ON `q2`.`kd_jenjang`=`l2`.`kd_jenjang`
				left JOIN `mst_proditawar` l3 ON `l3`.`kd_proditawar`=a.prodi_pil2
				left JOIN `mst_fakultas` m3 ON `m3`.`kd_fakultas`=`l3`.`kd_fakultas`
				left JOIN `mst_jurusan` n3 ON `n3`.`kd_jurusan`=`l3`.`kd_jurusan` AND n3.kd_fakultas=l3.kd_fakultas
				left JOIN `mst_program` o3 ON `o3`.`kd_program`=`l3`.`kd_program`
				left JOIN `mst_status` p3 ON `p3`.`kd_status`=`l3`.`kd_status`
				left JOIN `mst_jenjang` q3 ON `q3`.`kd_jenjang`=`l3`.`kd_jenjang`
				LEFT JOIN `pmb_herbayar` h ON `h`.`id_daftar`=`g`.`id_daftar`
				left JOIN `pmb_programprodi` h2 ON `h2`.`kd_proditawar`=`g`.`kd_proditawar`
				left JOIN `pmb_programbiayaprodi` h3 ON `h3`.`id_programprodi`=`h2`.`id_programprodi`
				WHERE a.jalur_pendaftaran='".$prog."' AND DATE (a.tgl_tes) >= jj.tgl_mulai AND DATE(a.tgl_tes) <= jj.tgl_akhir AND YEAR(a.tgl_daftar)='".$this->active_year."'
				AND DATE(`a`.`tgl_daftar`) BETWEEN STR_TO_DATE('".$awal."','%d-%m-%Y') AND STR_TO_DATE('".$akhir."','%d-%m-%Y')
				GROUP BY `a`.`id_daftar`
				ORDER BY a.`id_daftar` ASC
				");
				return $q;
			}else if($prog==null && $awal!=null && $akhir!=null) {
				$q=$this->db->query("
				SELECT a.id_daftar AS iddaftar,concat(q2.nama_jenjang,'-',n2.nama_jurusan,' (',p2.nama_status,'-',o2.nama_program,')') as prodi_pil1,concat(q3.nama_jenjang,'-',n3.nama_jurusan,' (',p3.nama_status,'-',o3.nama_program,')') as prodi_pil2,
				a.nama,a.no_induk as nis,a.pin,b.nama_sekolah AS sklh,b.stts_sekolah as jns_sklh, c.nama_kecamatan AS kec_sklh, d.nama_kota AS kota_sklh,e.nama_propinsi AS prop_sklh, 
				a.alamat_asal, f.nama_kecamatan AS kec_asal, dd.nama_kota as kota_asal, ee.nama_propinsi AS prop_asal,
				a.alamat_skrg, f2.nama_kecamatan AS kec_skrg, d2.nama_kota as kota_skrg, e2.nama_propinsi AS prop_skrg, 
				j.prg_nama,jj.gel,a.tgl_tes,a.tgl_daftar,a1.aut_display_name as op_daftar,a.bayar_pendaftaran as byr_daftar,IF(a.model_bayar=1,'Di tempat Pendaftaran',IF(a.model_bayar=2,'Di Bank',IF(a.model_bayar=3,'Bebas Biaya Pendaftaran', '-')))as model_bayar,a.jml_pilihan,
				IF(a.sex='P','Pria',IF(a.sex='W','Wanita',null)) as jk,a.telp,a2.nama as agama,a.tmp_lahir,a.tgl_lahir,a.jurusan as jur_sma,a.thn_lulus,a.no_sttb as sttb,a.nilai_total as danem ,p.nama_status as status_transfer,IF(a.alumni=1,'Alumni',null) as alumni,IF(a.hub_keluarga=1,'Ada Hubungan Keluarga','Tidak Ada Hubungan Keluarga') as hub_keluarga,
				a.rapor_sm1,a.rapor_sm2,a.rapor_sm3,a.rapor_sm4,a.rerata_uan,
				g2.aut_display_name as pewawancara,g.nilai_tpa, m.nama_fakultas AS fakultas, CONCAT(q.nama_jenjang, ' - ', n.nama_jurusan,'(',p.nama_status, ' - ', o.nama_program,')') AS prodi,
				g.rekomendasi,g.tgl_rekomendasi,g.nilai_identitas,g.nilai_kemampuan_keuangan as nilai_keuangan,g.nilai_motivasi,g.nilai_akademik,
				 g3.tgl_herregistrasi,g3.nim,g3.ukuran_jaz, IF(h.dpa IS NOT NULL,
				h.dpa, (SELECT set_value FROM pmb_setting WHERE set_name='dpa')) AS dpa, IF(h.spa_pot IS NOT NULL, h.spa_pot, 0) AS spa_pot, IF(h.spp_tetap IS NOT NULL, h.spp_tetap, h3.spp_tetap) AS spp_tetap, IF(h.spp_var IS NOT NULL, h.spp_var, h3.sppv_teori) AS sppv_teori, IF(h.spa IS NOT NULL, h.spa+h.spa_pot, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) AS spa, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) AS spa_byr, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa1 / 100 AS spa1, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa2 / 100 AS spa2, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa3 / 100 AS spa3, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa4 / 100 AS spa4, i.spa1 AS persen1, i.spa2 AS persen2, i.spa3 AS persen3, i.spa4 AS persen4
				,IF(g.penghasilan_src_biaya is not null or g.penghasilan_src_biaya!='',g.penghasilan_src_biaya,null) as pdpt_pembiaya,
				(CASE a.pdpt_ortu 
				WHEN '1sd3' THEN '1 juta s/d 3 juta'
				WHEN '3sd5' THEN '3 juta s/d 5 juta'
				WHEN '5sd10' THEN '5 juta s/d 10 juta'
				WHEN '>10' THEN 'lebih dari 10 juta' else null END
				) as pdpt_ortu
				FROM (`pmb_pendaftar` a, `pmb_setting_angsuran` i, `pmb_gelombang` jj)
				LEFT JOIN pmb_author a1 on a1.aut_username=a.id_user
				LEFT JOIN mst_agama a2 on a2.kd_agama=a.agama
				LEFT JOIN `mst_sekolah` b ON `b`.`kd_sekolah`=`a`.`kd_sekolah`
				LEFT JOIN `mst_kecamatan` c ON `c`.`kd_kecamatan`=`b`.`kec_sekolah`
				LEFT JOIN `mst_kota` d ON `d`.`kd_kota`=`c`.`kd_kota`
				LEFT JOIN `mst_propinsi` e ON `e`.`kd_propinsi`=`d`.`kd_propinsi`
				LEFT JOIN `mst_kecamatan` f ON `f`.`kd_kecamatan`=`a`.`kec_asal`
				LEFT JOIN `mst_kota` dd ON `dd`.`kd_kota`=`a`.`kab_asal`
				LEFT JOIN `mst_propinsi` ee ON `ee`.`kd_propinsi`=`dd`.`kd_propinsi`
				LEFT JOIN `mst_kecamatan` f2 ON `f2`.`kd_kecamatan`=`a`.`kec_skrg`
				LEFT JOIN `mst_kota` d2 ON `dd`.`kd_kota`=`a`.`kab_skrg`
				LEFT JOIN `mst_propinsi` e2 ON `e2`.`kd_propinsi`=`d2`.`kd_propinsi`
				left JOIN `pmb_rekomendasi` g ON `g`.`id_daftar`=`a`.`id_daftar`
				LEFT JOIN pmb_author g2 on g2.aut_username=g.id_user
				LEFT JOIN `pmb_herregistrasi` g3 ON `g3`.`id_daftar`=`g`.`id_daftar`
				left JOIN `pmb_program` j ON `j`.`prg_id`=`a`.`jalur_pendaftaran`
				left JOIN `mst_proditawar` l ON `l`.`kd_proditawar`=g.kd_proditawar
				left JOIN `mst_fakultas` m ON `m`.`kd_fakultas`=`l`.`kd_fakultas`
				left JOIN `mst_jurusan` n ON `n`.`kd_jurusan`=`l`.`kd_jurusan` AND n.kd_fakultas=l.kd_fakultas
				left JOIN `mst_program` o ON `o`.`kd_program`=`l`.`kd_program`
				left JOIN `mst_status` p ON `p`.`kd_status`=`l`.`kd_status`
				left JOIN `mst_jenjang` q ON `q`.`kd_jenjang`=`l`.`kd_jenjang`
				left JOIN `mst_proditawar` l2 ON `l2`.`kd_proditawar`=a.prodi_pil1 
				left JOIN `mst_fakultas` m2 ON `m2`.`kd_fakultas`=`l2`.`kd_fakultas`
				left JOIN `mst_jurusan` n2 ON `n2`.`kd_jurusan`=`l2`.`kd_jurusan` AND n2.kd_fakultas=l2.kd_fakultas
				left JOIN `mst_program` o2 ON `o2`.`kd_program`=`l2`.`kd_program`
				left JOIN `mst_status` p2 ON `p2`.`kd_status`=`l2`.`kd_status`
				left JOIN `mst_jenjang` q2 ON `q2`.`kd_jenjang`=`l2`.`kd_jenjang`
				left JOIN `mst_proditawar` l3 ON `l3`.`kd_proditawar`=a.prodi_pil2
				left JOIN `mst_fakultas` m3 ON `m3`.`kd_fakultas`=`l3`.`kd_fakultas`
				left JOIN `mst_jurusan` n3 ON `n3`.`kd_jurusan`=`l3`.`kd_jurusan` AND n3.kd_fakultas=l3.kd_fakultas
				left JOIN `mst_program` o3 ON `o3`.`kd_program`=`l3`.`kd_program`
				left JOIN `mst_status` p3 ON `p3`.`kd_status`=`l3`.`kd_status`
				left JOIN `mst_jenjang` q3 ON `q3`.`kd_jenjang`=`l3`.`kd_jenjang`
				LEFT JOIN `pmb_herbayar` h ON `h`.`id_daftar`=`g`.`id_daftar`
				left JOIN `pmb_programprodi` h2 ON `h2`.`kd_proditawar`=`g`.`kd_proditawar`
				left JOIN `pmb_programbiayaprodi` h3 ON `h3`.`id_programprodi`=`h2`.`id_programprodi`
				WHERE DATE (a.tgl_tes) >= jj.tgl_mulai AND DATE(a.tgl_tes) <= jj.tgl_akhir AND YEAR(a.tgl_daftar)='".$this->active_year."'
				AND DATE(`a`.`tgl_daftar`) BETWEEN STR_TO_DATE('".$awal."','%d-%m-%Y') AND STR_TO_DATE('".$akhir."','%d-%m-%Y')
				GROUP BY `a`.`id_daftar`
				ORDER BY a.`id_daftar` ASC
				");
				return $q;
			}
		}else{
			if($prog!=null && $awal!=null && $akhir!=null) {
				$q=$this->db->query("
				SELECT a.id_daftar AS iddaftar,concat(q2.nama_jenjang,'-',n2.nama_jurusan,' (',p2.nama_status,'-',o2.nama_program,')') as prodi_pil1,concat(q3.nama_jenjang,'-',n3.nama_jurusan,' (',p3.nama_status,'-',o3.nama_program,')') as prodi_pil2,
				a.nama,a.no_induk as nis,a.pin,b.nama_sekolah AS sklh,b.stts_sekolah as jns_sklh, c.nama_kecamatan AS kec_sklh, d.nama_kota AS kota_sklh,e.nama_propinsi AS prop_sklh, 
				a.alamat_asal, f.nama_kecamatan AS kec_asal, dd.nama_kota as kota_asal, ee.nama_propinsi AS prop_asal,
				a.alamat_skrg, f2.nama_kecamatan AS kec_skrg, d2.nama_kota as kota_skrg, e2.nama_propinsi AS prop_skrg, 
				j.prg_nama,jj.gel,a.tgl_tes,a.tgl_daftar,a1.aut_display_name as op_daftar,a.bayar_pendaftaran as byr_daftar,IF(a.model_bayar=1,'Di tempat Pendaftaran',IF(a.model_bayar=2,'Di Bank',IF(a.model_bayar=3,'Bebas Biaya Pendaftaran', '-')))as model_bayar,a.jml_pilihan,
				IF(a.sex='P','Pria',IF(a.sex='W','Wanita',null)) as jk,a.telp,a2.nama as agama,a.tmp_lahir,a.tgl_lahir,a.jurusan as jur_sma,a.thn_lulus,a.no_sttb as sttb,a.nilai_total as danem ,p.nama_status as status_transfer,IF(a.alumni=1,'Alumni',null) as alumni,IF(a.hub_keluarga=1,'Ada Hubungan Keluarga','Tidak Ada Hubungan Keluarga') as hub_keluarga,
				a.rapor_sm1,a.rapor_sm2,a.rapor_sm3,a.rapor_sm4,a.rerata_uan,
				g2.aut_display_name as pewawancara,g.nilai_tpa, m.nama_fakultas AS fakultas, CONCAT(q.nama_jenjang, ' - ', n.nama_jurusan,'(',p.nama_status, ' - ', o.nama_program,')') AS prodi,
				g.rekomendasi,g.tgl_rekomendasi,g.nilai_identitas,g.nilai_kemampuan_keuangan as nilai_keuangan,g.nilai_motivasi,g.nilai_akademik,
				 g3.tgl_herregistrasi,g3.nim,g3.ukuran_jaz, IF(h.dpa IS NOT NULL,
				h.dpa, (SELECT set_value FROM pmb_setting WHERE set_name='dpa')) AS dpa, IF(h.spa_pot IS NOT NULL, h.spa_pot, 0) AS spa_pot, IF(h.spp_tetap IS NOT NULL, h.spp_tetap, h3.spp_tetap) AS spp_tetap, IF(h.spp_var IS NOT NULL, h.spp_var, h3.sppv_teori) AS sppv_teori, IF(h.spa IS NOT NULL, h.spa+h.spa_pot, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) AS spa, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) AS spa_byr, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa1 / 100 AS spa1, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa2 / 100 AS spa2, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa3 / 100 AS spa3, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa4 / 100 AS spa4, i.spa1 AS persen1, i.spa2 AS persen2, i.spa3 AS persen3, i.spa4 AS persen4
				,IF(g.penghasilan_src_biaya is not null or g.penghasilan_src_biaya!='',g.penghasilan_src_biaya,null) as pdpt_pembiaya,
				(CASE a.pdpt_ortu 
				WHEN '1sd3' THEN '1 juta s/d 3 juta'
				WHEN '3sd5' THEN '3 juta s/d 5 juta'
				WHEN '5sd10' THEN '5 juta s/d 10 juta'
				WHEN '>10' THEN 'lebih dari 10 juta' else null END
				) as pdpt_ortu
				FROM (`pmb_pendaftar` a, `pmb_setting_angsuran` i, `pmb_gelombang` jj)
				LEFT JOIN pmb_author a1 on a1.aut_username=a.id_user
				LEFT JOIN mst_agama a2 on a2.kd_agama=a.agama
				LEFT JOIN `mst_sekolah` b ON `b`.`kd_sekolah`=`a`.`kd_sekolah`
				LEFT JOIN `mst_kecamatan` c ON `c`.`kd_kecamatan`=`b`.`kec_sekolah`
				LEFT JOIN `mst_kota` d ON `d`.`kd_kota`=`c`.`kd_kota`
				LEFT JOIN `mst_propinsi` e ON `e`.`kd_propinsi`=`d`.`kd_propinsi`
				LEFT JOIN `mst_kecamatan` f ON `f`.`kd_kecamatan`=`a`.`kec_asal`
				LEFT JOIN `mst_kota` dd ON `dd`.`kd_kota`=`a`.`kab_asal`
				LEFT JOIN `mst_propinsi` ee ON `ee`.`kd_propinsi`=`dd`.`kd_propinsi`
				LEFT JOIN `mst_kecamatan` f2 ON `f2`.`kd_kecamatan`=`a`.`kec_skrg`
				LEFT JOIN `mst_kota` d2 ON `dd`.`kd_kota`=`a`.`kab_skrg`
				LEFT JOIN `mst_propinsi` e2 ON `e2`.`kd_propinsi`=`d2`.`kd_propinsi`
				left JOIN `pmb_rekomendasi` g ON `g`.`id_daftar`=`a`.`id_daftar`
				LEFT JOIN pmb_author g2 on g2.aut_username=g.id_user
				LEFT JOIN `pmb_herregistrasi` g3 ON `g3`.`id_daftar`=`g`.`id_daftar`
				left JOIN `pmb_program` j ON `j`.`prg_id`=`a`.`jalur_pendaftaran`
				left JOIN `mst_proditawar` l ON `l`.`kd_proditawar`=g.kd_proditawar
				left JOIN `mst_fakultas` m ON `m`.`kd_fakultas`=`l`.`kd_fakultas`
				left JOIN `mst_jurusan` n ON `n`.`kd_jurusan`=`l`.`kd_jurusan` AND n.kd_fakultas=l.kd_fakultas
				left JOIN `mst_program` o ON `o`.`kd_program`=`l`.`kd_program`
				left JOIN `mst_status` p ON `p`.`kd_status`=`l`.`kd_status`
				left JOIN `mst_jenjang` q ON `q`.`kd_jenjang`=`l`.`kd_jenjang`
				left JOIN `mst_proditawar` l2 ON `l2`.`kd_proditawar`=a.prodi_pil1 
				left JOIN `mst_fakultas` m2 ON `m2`.`kd_fakultas`=`l2`.`kd_fakultas`
				left JOIN `mst_jurusan` n2 ON `n2`.`kd_jurusan`=`l2`.`kd_jurusan` AND n2.kd_fakultas=l2.kd_fakultas
				left JOIN `mst_program` o2 ON `o2`.`kd_program`=`l2`.`kd_program`
				left JOIN `mst_status` p2 ON `p2`.`kd_status`=`l2`.`kd_status`
				left JOIN `mst_jenjang` q2 ON `q2`.`kd_jenjang`=`l2`.`kd_jenjang`
				left JOIN `mst_proditawar` l3 ON `l3`.`kd_proditawar`=a.prodi_pil2
				left JOIN `mst_fakultas` m3 ON `m3`.`kd_fakultas`=`l3`.`kd_fakultas`
				left JOIN `mst_jurusan` n3 ON `n3`.`kd_jurusan`=`l3`.`kd_jurusan` AND n3.kd_fakultas=l3.kd_fakultas
				left JOIN `mst_program` o3 ON `o3`.`kd_program`=`l3`.`kd_program`
				left JOIN `mst_status` p3 ON `p3`.`kd_status`=`l3`.`kd_status`
				left JOIN `mst_jenjang` q3 ON `q3`.`kd_jenjang`=`l3`.`kd_jenjang`
				LEFT JOIN `pmb_herbayar` h ON `h`.`id_daftar`=`g`.`id_daftar`
				left JOIN `pmb_programprodi` h2 ON `h2`.`kd_proditawar`=`g`.`kd_proditawar`
				left JOIN `pmb_programbiayaprodi` h3 ON `h3`.`id_programprodi`=`h2`.`id_programprodi`
				WHERE a.jalur_pendaftaran='".$prog."' AND DATE (a.tgl_tes) >= jj.tgl_mulai AND DATE(a.tgl_tes) <= jj.tgl_akhir AND YEAR(a.tgl_daftar)='".$this->active_year."'
				AND DATE(`g3`.`tgl_herregistrasi`) BETWEEN STR_TO_DATE('".$awal."','%d-%m-%Y') AND STR_TO_DATE('".$akhir."','%d-%m-%Y')
				GROUP BY `a`.`id_daftar`
				ORDER BY a.`id_daftar` ASC
				");
				return $q;
			}else if($prog==null && $awal!=null && $akhir!=null) {
				$q=$this->db->query("
				SELECT a.id_daftar AS iddaftar,concat(q2.nama_jenjang,'-',n2.nama_jurusan,' (',p2.nama_status,'-',o2.nama_program,')') as prodi_pil1,concat(q3.nama_jenjang,'-',n3.nama_jurusan,' (',p3.nama_status,'-',o3.nama_program,')') as prodi_pil2,
				a.nama,a.no_induk as nis,a.pin,b.nama_sekolah AS sklh,b.stts_sekolah as jns_sklh, c.nama_kecamatan AS kec_sklh, d.nama_kota AS kota_sklh,e.nama_propinsi AS prop_sklh, 
				a.alamat_asal, f.nama_kecamatan AS kec_asal, dd.nama_kota as kota_asal, ee.nama_propinsi AS prop_asal,
				a.alamat_skrg, f2.nama_kecamatan AS kec_skrg, d2.nama_kota as kota_skrg, e2.nama_propinsi AS prop_skrg, 
				j.prg_nama,jj.gel,a.tgl_tes,a.tgl_daftar,a1.aut_display_name as op_daftar,a.bayar_pendaftaran as byr_daftar,IF(a.model_bayar=1,'Di tempat Pendaftaran',IF(a.model_bayar=2,'Di Bank',IF(a.model_bayar=3,'Bebas Biaya Pendaftaran', '-')))as model_bayar,a.jml_pilihan,
				IF(a.sex='P','Pria',IF(a.sex='W','Wanita',null)) as jk,a.telp,a2.nama as agama,a.tmp_lahir,a.tgl_lahir,a.jurusan as jur_sma,a.thn_lulus,a.no_sttb as sttb,a.nilai_total as danem ,p.nama_status as status_transfer,IF(a.alumni=1,'Alumni',null) as alumni,IF(a.hub_keluarga=1,'Ada Hubungan Keluarga','Tidak Ada Hubungan Keluarga') as hub_keluarga,
				a.rapor_sm1,a.rapor_sm2,a.rapor_sm3,a.rapor_sm4,a.rerata_uan,
				g2.aut_display_name as pewawancara,g.nilai_tpa, m.nama_fakultas AS fakultas, CONCAT(q.nama_jenjang, ' - ', n.nama_jurusan,'(',p.nama_status, ' - ', o.nama_program,')') AS prodi,
				g.rekomendasi,g.tgl_rekomendasi,g.nilai_identitas,g.nilai_kemampuan_keuangan as nilai_keuangan,g.nilai_motivasi,g.nilai_akademik,
				 g3.tgl_herregistrasi,g3.nim,g3.ukuran_jaz, IF(h.dpa IS NOT NULL,
				h.dpa, (SELECT set_value FROM pmb_setting WHERE set_name='dpa')) AS dpa, IF(h.spa_pot IS NOT NULL, h.spa_pot, 0) AS spa_pot, IF(h.spp_tetap IS NOT NULL, h.spp_tetap, h3.spp_tetap) AS spp_tetap, IF(h.spp_var IS NOT NULL, h.spp_var, h3.sppv_teori) AS sppv_teori, IF(h.spa IS NOT NULL, h.spa+h.spa_pot, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) AS spa, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) AS spa_byr, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa1 / 100 AS spa1, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa2 / 100 AS spa2, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa3 / 100 AS spa3, IF(h.spa IS NOT NULL, h.spa, IF(h3.stat_biaya=1, IF(l.kd_status=2, h3.spa + jj.tbh_spa_transfer, IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum + jj.tbh_spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa + jj.tbh_spa), h3.spa + jj.tbh_spa))), IF(a.alumni=1 AND h3.spa_alum>0, h3.spa_alum, IF(a.hub_keluarga=1, 1*(h3.spa), h3.spa)))) * i.spa4 / 100 AS spa4, i.spa1 AS persen1, i.spa2 AS persen2, i.spa3 AS persen3, i.spa4 AS persen4
				,IF(g.penghasilan_src_biaya is not null or g.penghasilan_src_biaya!='',g.penghasilan_src_biaya,null) as pdpt_pembiaya,
				(CASE a.pdpt_ortu 
				WHEN '1sd3' THEN '1 juta s/d 3 juta'
				WHEN '3sd5' THEN '3 juta s/d 5 juta'
				WHEN '5sd10' THEN '5 juta s/d 10 juta'
				WHEN '>10' THEN 'lebih dari 10 juta' else null END
				) as pdpt_ortu
				FROM (`pmb_pendaftar` a, `pmb_setting_angsuran` i, `pmb_gelombang` jj)
				LEFT JOIN pmb_author a1 on a1.aut_username=a.id_user
				LEFT JOIN mst_agama a2 on a2.kd_agama=a.agama
				LEFT JOIN `mst_sekolah` b ON `b`.`kd_sekolah`=`a`.`kd_sekolah`
				LEFT JOIN `mst_kecamatan` c ON `c`.`kd_kecamatan`=`b`.`kec_sekolah`
				LEFT JOIN `mst_kota` d ON `d`.`kd_kota`=`c`.`kd_kota`
				LEFT JOIN `mst_propinsi` e ON `e`.`kd_propinsi`=`d`.`kd_propinsi`
				LEFT JOIN `mst_kecamatan` f ON `f`.`kd_kecamatan`=`a`.`kec_asal`
				LEFT JOIN `mst_kota` dd ON `dd`.`kd_kota`=`a`.`kab_asal`
				LEFT JOIN `mst_propinsi` ee ON `ee`.`kd_propinsi`=`dd`.`kd_propinsi`
				LEFT JOIN `mst_kecamatan` f2 ON `f2`.`kd_kecamatan`=`a`.`kec_skrg`
				LEFT JOIN `mst_kota` d2 ON `dd`.`kd_kota`=`a`.`kab_skrg`
				LEFT JOIN `mst_propinsi` e2 ON `e2`.`kd_propinsi`=`d2`.`kd_propinsi`
				left JOIN `pmb_rekomendasi` g ON `g`.`id_daftar`=`a`.`id_daftar`
				LEFT JOIN pmb_author g2 on g2.aut_username=g.id_user
				LEFT JOIN `pmb_herregistrasi` g3 ON `g3`.`id_daftar`=`g`.`id_daftar`
				left JOIN `pmb_program` j ON `j`.`prg_id`=`a`.`jalur_pendaftaran`
				left JOIN `mst_proditawar` l ON `l`.`kd_proditawar`=g.kd_proditawar
				left JOIN `mst_fakultas` m ON `m`.`kd_fakultas`=`l`.`kd_fakultas`
				left JOIN `mst_jurusan` n ON `n`.`kd_jurusan`=`l`.`kd_jurusan` AND n.kd_fakultas=l.kd_fakultas
				left JOIN `mst_program` o ON `o`.`kd_program`=`l`.`kd_program`
				left JOIN `mst_status` p ON `p`.`kd_status`=`l`.`kd_status`
				left JOIN `mst_jenjang` q ON `q`.`kd_jenjang`=`l`.`kd_jenjang`
				left JOIN `mst_proditawar` l2 ON `l2`.`kd_proditawar`=a.prodi_pil1 
				left JOIN `mst_fakultas` m2 ON `m2`.`kd_fakultas`=`l2`.`kd_fakultas`
				left JOIN `mst_jurusan` n2 ON `n2`.`kd_jurusan`=`l2`.`kd_jurusan` AND n2.kd_fakultas=l2.kd_fakultas
				left JOIN `mst_program` o2 ON `o2`.`kd_program`=`l2`.`kd_program`
				left JOIN `mst_status` p2 ON `p2`.`kd_status`=`l2`.`kd_status`
				left JOIN `mst_jenjang` q2 ON `q2`.`kd_jenjang`=`l2`.`kd_jenjang`
				left JOIN `mst_proditawar` l3 ON `l3`.`kd_proditawar`=a.prodi_pil2
				left JOIN `mst_fakultas` m3 ON `m3`.`kd_fakultas`=`l3`.`kd_fakultas`
				left JOIN `mst_jurusan` n3 ON `n3`.`kd_jurusan`=`l3`.`kd_jurusan` AND n3.kd_fakultas=l3.kd_fakultas
				left JOIN `mst_program` o3 ON `o3`.`kd_program`=`l3`.`kd_program`
				left JOIN `mst_status` p3 ON `p3`.`kd_status`=`l3`.`kd_status`
				left JOIN `mst_jenjang` q3 ON `q3`.`kd_jenjang`=`l3`.`kd_jenjang`
				LEFT JOIN `pmb_herbayar` h ON `h`.`id_daftar`=`g`.`id_daftar`
				left JOIN `pmb_programprodi` h2 ON `h2`.`kd_proditawar`=`g`.`kd_proditawar`
				left JOIN `pmb_programbiayaprodi` h3 ON `h3`.`id_programprodi`=`h2`.`id_programprodi`
				WHERE DATE (a.tgl_tes) >= jj.tgl_mulai AND DATE(a.tgl_tes) <= jj.tgl_akhir AND YEAR(a.tgl_daftar)='".$this->active_year."'
				AND DATE(`g3`.`tgl_herregistrasi`) BETWEEN STR_TO_DATE('".$awal."','%d-%m-%Y') AND STR_TO_DATE('".$akhir."','%d-%m-%Y')
				GROUP BY `a`.`id_daftar`
				ORDER BY a.`id_daftar` ASC
				");
				return $q;
			}
		}
	}
	private function gantinumeric($subject) { 
		$replace=array('.'=>'',','=>'',' '=>'');
	   return str_replace(array_keys($replace), array_values($replace), $subject);    
	}
	function upbea(array $d=null,$op=null){
		$data=array(
				'kd_jenis_beasiswa' => $d["kdbea"],
				'rekomendasi'		=> $d["rekomendasi"],
				'id_user' => $op,
			);
		$data2=array(
			'id_daftar'			=> $d["id"],
			'rekomendasi'		=> $d["rekomendasi"],
			'kd_proditawar'		=> $d["prodi"],
			'kd_jenis_beasiswa' => $d["kdbea"],
			'tgl_rekomendasi'	=> date("Y-m-d"),
			'id_user' => $op,
		);
		$ada=$this->db->where("id_daftar",$d["id"])->get("pmb_rekomendasi")->num_rows();	
		if($ada>0){
			$q1=$this->db->where("id_daftar",$d["id"])->update("pmb_rekomendasi",$data);
		}
		else
			$q1=$this->db->insert("pmb_rekomendasi",$data2);
		if($d["kdbea"]==1){	
			$q2=$this->db->query("
			INSERT INTO pmb_herbayar (id_daftar,spp_tetap,spp_var,spa,spa_pot,dpa,id_user,lastupdate,ket)
			SELECT * FROM
				(SELECT  a.id_daftar AS id_daftar, 0 as spp_tetap, h.sppv_teori as spp_var,
				IF(h.stat_biaya=1,IF(l.kd_status=2,h.spa + jj.tbh_spa_transfer,IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum + jj.tbh_spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h.spa + jj.tbh_spa), h.spa + jj.tbh_spa))),IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*h.spa, h.spa))) as spa
				,0 as spa_pot,(SELECT set_value FROM pmb_setting WHERE set_name='dpa') AS dpa, '".$op."' as id_user, TIMESTAMP(NOW()) as lastupdate,NULL as ket
				FROM (`pmb_pendaftar` a, `pmb_setting_angsuran` i,pmb_programprodi g, `pmb_gelombang` jj)
				JOIN `pmb_program` j ON `j`.`prg_id`=`a`.`jalur_pendaftaran`
				JOIN `mst_proditawar` l ON `l`.`kd_proditawar`=`g`.`kd_proditawar`
				INNER JOIN `pmb_programbiayaprodi` h ON `h`.`id_programprodi`=`g`.`id_programprodi`
				WHERE DATE (a.tgl_tes) >= jj.tgl_mulai AND DATE(a.tgl_tes) <= jj.tgl_akhir
				and a.id_daftar='".$d["id"]."' and g.kd_proditawar='".$d["prodi"]."'
				group by a.id_daftar) b 
			ON DUPLICATE KEY UPDATE id_daftar=b.id_daftar,spp_tetap=0,spp_var=b.spp_var,spa=b.spa,spa_pot=0,dpa=b.dpa,id_user='admin',lastupdate= TIMESTAMP(NOW()),ket= NULL
			");
		}else if($d["kdbea"]==2){	
			$q2=$this->db->query("
			INSERT INTO pmb_herbayar (id_daftar,spp_tetap,spp_var,spa,spa_pot,dpa,id_user,lastupdate,ket)
			SELECT * FROM
				(SELECT  a.id_daftar AS id_daftar, h.spp_tetap, 0 as spp_var,
				IF(h.stat_biaya=1,IF(l.kd_status=2,h.spa + jj.tbh_spa_transfer,IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum + jj.tbh_spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h.spa + jj.tbh_spa), h.spa + jj.tbh_spa))),IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*h.spa, h.spa))) as spa
				,0 as spa_pot,(SELECT set_value FROM pmb_setting WHERE set_name='dpa') AS dpa, '".$op."' as id_user, TIMESTAMP(NOW()) as lastupdate,NULL as ket
				FROM (`pmb_pendaftar` a, `pmb_setting_angsuran` i,pmb_programprodi g, `pmb_gelombang` jj)
				JOIN `pmb_program` j ON `j`.`prg_id`=`a`.`jalur_pendaftaran`
				JOIN `mst_proditawar` l ON `l`.`kd_proditawar`=`g`.`kd_proditawar`
				INNER JOIN `pmb_programbiayaprodi` h ON `h`.`id_programprodi`=`g`.`id_programprodi`
				WHERE DATE (a.tgl_tes) >= jj.tgl_mulai AND DATE(a.tgl_tes) <= jj.tgl_akhir
				and a.id_daftar='".$d["id"]."' and g.kd_proditawar='".$d["prodi"]."'
				group by a.id_daftar) b 
			ON DUPLICATE KEY UPDATE id_daftar=b.id_daftar,spp_tetap=b.spp_tetap,spp_var=0,spa=b.spa,spa_pot=0,dpa=b.dpa,id_user='admin',lastupdate= TIMESTAMP(NOW()),ket= NULL
			");
		}else if($d["kdbea"]==3){	
			$q2=$this->db->query("
			INSERT INTO pmb_herbayar (id_daftar,spp_tetap,spp_var,spa,spa_pot,dpa,id_user,lastupdate,ket)
			SELECT * FROM
				(SELECT  a.id_daftar AS id_daftar, 0 as spp_tetap, 0 as spp_var,
				IF(h.stat_biaya=1,IF(l.kd_status=2,h.spa + jj.tbh_spa_transfer,IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum + jj.tbh_spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h.spa + jj.tbh_spa), h.spa + jj.tbh_spa))),IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*h.spa, h.spa))) as spa
				,0 as spa_pot,(SELECT set_value FROM pmb_setting WHERE set_name='dpa') AS dpa, '".$op."' as id_user, TIMESTAMP(NOW()) as lastupdate,NULL as ket
				FROM (`pmb_pendaftar` a, `pmb_setting_angsuran` i,pmb_programprodi g, `pmb_gelombang` jj)
				JOIN `pmb_program` j ON `j`.`prg_id`=`a`.`jalur_pendaftaran`
				JOIN `mst_proditawar` l ON `l`.`kd_proditawar`=`g`.`kd_proditawar`
				INNER JOIN `pmb_programbiayaprodi` h ON `h`.`id_programprodi`=`g`.`id_programprodi`
				WHERE DATE (a.tgl_tes) >= jj.tgl_mulai AND DATE(a.tgl_tes) <= jj.tgl_akhir
				and a.id_daftar='".$d["id"]."' and g.kd_proditawar='".$d["prodi"]."'
				group by a.id_daftar) b 
			ON DUPLICATE KEY UPDATE id_daftar=b.id_daftar,spp_tetap=0,spp_var=0,spa=b.spa,spa_pot=0,dpa=b.dpa,id_user='admin',lastupdate= TIMESTAMP(NOW()),ket= NULL
			");
		} else if($d["kdbea"]==4){	
			$q2=$this->db->query("
			INSERT INTO pmb_herbayar (id_daftar,spp_tetap,spp_var,spa,spa_pot,dpa,id_user,lastupdate,ket)
			SELECT * FROM
				(SELECT  a.id_daftar AS id_daftar, h.spp_tetap, h.sppv_teori as spp_var,
				0 as spa,IF(h.stat_biaya=1,IF(l.kd_status=2,h.spa + jj.tbh_spa_transfer,IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum + jj.tbh_spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h.spa + jj.tbh_spa), h.spa + jj.tbh_spa))),IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*h.spa, h.spa))) as spa_pot,
				(SELECT set_value FROM pmb_setting WHERE set_name='dpa') AS dpa, '".$op."' as id_user, TIMESTAMP(NOW()) as lastupdate,NULL as ket
				FROM (`pmb_pendaftar` a, `pmb_setting_angsuran` i,pmb_programprodi g, `pmb_gelombang` jj)
				JOIN `pmb_program` j ON `j`.`prg_id`=`a`.`jalur_pendaftaran`
				JOIN `mst_proditawar` l ON `l`.`kd_proditawar`=`g`.`kd_proditawar`
				INNER JOIN `pmb_programbiayaprodi` h ON `h`.`id_programprodi`=`g`.`id_programprodi`
				WHERE DATE (a.tgl_tes) >= jj.tgl_mulai AND DATE(a.tgl_tes) <= jj.tgl_akhir
				and a.id_daftar='".$d["id"]."' and g.kd_proditawar='".$d["prodi"]."'
				group by a.id_daftar) b 
			ON DUPLICATE KEY UPDATE id_daftar=b.id_daftar,spp_tetap=b.spp_tetap,spp_var=b.spp_var,spa=0,spa_pot=b.spa_pot,dpa=b.dpa,id_user='admin',lastupdate= TIMESTAMP(NOW()),ket= NULL
			");
		}
		if($q1->affected_rows() > 0 && $q2->affected_rows() > 0)
			return true;
		else
			return false;
	}
	function uprekomendasi($id=null,$op=null){
		if($id!=null){
			$spapot=$this->gantinumeric($this->input->post('spapot'));
			$rekomendasi=$this->input->post('rekomendasi');
			$iddaftar=$this->input->post('iddaftar');
			$data=array(
				'rekomendasi' => $rekomendasi,
				'id_user' => $op,
			);
			$this->db->where("id_rekomendasi",$id)->update("pmb_rekomendasi",$data);
			if($iddaftar!=null)
				$this->db->query("
			UPDATE pmb_herbayar a1 
			INNER JOIN (SELECT IF(h.stat_biaya=1,IF(l.kd_status=2,h.spa + jj.tbh_spa_transfer,IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum + jj.tbh_spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*(h.spa + jj.tbh_spa), h.spa + jj.tbh_spa))),IF(a.alumni=1 AND h.spa_alum>0,h.spa_alum,IF(a.hub_keluarga=1,".$this->potkeluarga."*h.spa, h.spa))) as spa_byr
			FROM (`pmb_pendaftar` a, `pmb_setting_angsuran` i,`pmb_gelombang` jj)
			JOIN `pmb_program` j ON `j`.`prg_id`=`a`.`jalur_pendaftaran`
			INNER JOIN pmb_rekomendasi g1 on g1.id_daftar=a.id_daftar
			INNER JOIN pmb_programprodi g2 on g2.kd_proditawar=g1.kd_proditawar  
			INNER JOIN `pmb_programbiayaprodi` h ON `h`.`id_programprodi`=`g2`.`id_programprodi`
			INNER JOIN `mst_proditawar` l ON `l`.`kd_proditawar`=`g1`.`kd_proditawar`
			WHERE DATE (a.tgl_tes) >= jj.tgl_mulai AND DATE(a.tgl_tes) <= jj.tgl_akhir
			and a.id_daftar='".$iddaftar."' and h.thn_berlaku=".$this->active_year."
			group by a.id_daftar) as a on id_daftar=a1.id_daftar 
			SET a1.spa_pot=".(($spapot!=null and $spapot>0) ? $spapot :0).", 
			a1.spa=(spa_byr  -".(($spapot!=null and $spapot>0) ? $spapot :0)."), 
			a1.lastupdate= TIMESTAMP(NOW()), a1.id_user='".$op."'
			WHERE id_daftar='".$iddaftar."' "
			);
			return true;
		}
	}
	

	function getrekomendasi_byid($id,$param=null){
		if($param=="diterima"){
			$q=$this->qrekomendasibiaya()
				 ->where('g.id_daftar',$id)
				 ->where('g.rekomendasi','diterima')
				 ->get()->result();
			return $q;
		} else if($param=="surat"){
			$q=$this->qrekomendasibiaya()
				 ->select("IF(g.png_id is not null or g.png_id!='' and DATE(s.png_tgl) >= DATE(g.tgl_rekomendasi), g.png_id , max(s.png_id)) as png_id",false)
				 ->where('g.id_rekomendasi',$id)
				 ->join("pmb_pengumuman s","s.prg_id=a.jalur_pendaftaran","left")
				 ->get()->result();
			return $q;
		}
		else{
			$q=$this->qrekomendasibiaya()
				 ->where('g.id_daftar',$id)
				 ->get()->result();
			return $q;
		}
	}
	
	function cekrekomendasi_byid($id){
		$q=$this->db
			 ->where('id_daftar',$id)
			 ->get('pmb_rekomendasi')->result();
		return $q;
	}
	
	function getrekomendasi_bypngid($id=null,$param=null,$prg_id=null,$jum_page=null,$dari=null,$jns=null){
		$q=$this->qrekomendasi()
				 ->select("n.nama_jurusan as jurusan,q.nama_jenjang as jenjang",false)
				 ->join("pmb_pengumuman s","s.prg_id=a.jalur_pendaftaran","inner")
				 ->group_by('g.id_rekomendasi')
				 ->order_by('a.nama');
		//if($id!=null)
			//$q=$q->where('(g.png_id='.$id,null,false)->or_where('g.png_id is null',null,false)->or_where('g.png_id ="" )',null,false);
		if($prg_id!=null)
			$q=$q->where('s.prg_id',$prg_id);
		if($param!=null)
			$q=$q->where('g.rekomendasi',$param);
		if($jns=="mhs"){
			$q=$q->where('DATE(s.png_tgl) >= DATE(g.tgl_rekomendasi)',null,false);
			if($jum_page!=null)
				$q=$q->get(null,$jum_page,$dari)->result();
			else
				$q=$q->get();
			return $q;
		}
		else	
		 return $q->result();
	}
	
	function getpendaftar_bysearch($word){
		$key=array(
			'a.id_daftar' => $word,
			'a.nama'	  => $word,
		);
		$q=$this->db->select('a.*')
					 ->from('pmb_pendaftar a')
					 ->like('a.id_daftar',$word,'both')
					 ->or_like($key,'both')
					 ->get();
		return $q->result();
	}
}