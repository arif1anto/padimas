<?php

class Mdata extends CI_Model {
	
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
	
	public function getDaftarharian($date=null){
		if($date==null){			
			$q=$this->db->query(				
			"Select a1.fakultas as fakultas,a1.jml_pendaftar,IF(a2.jml_her is NULL,0,a2.jml_her)as jml_her from
			(SELECT bb.nama_fakultas as fakultas,COUNT(a.id_daftar) as jml_pendaftar
			FROM mst_fakultas bb 				
			left JOIN mst_proditawar b ON bb.kd_fakultas=b.kd_fakultas 				
			left JOIN pmb_pendaftar a on a.prodi_pil1=b.kd_proditawar and DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y')=DATE_FORMAT(NOW(),'%d/%m/%Y') 	
			where YEAR(a.tgl_daftar) = ".$this->active_year." 						
			group by bb.kd_fakultas) a1
			LEFT JOIN 			
			(SELECT bb.nama_fakultas as fakultas,count(bb.kd_fakultas) as jml_her		
			FROM pmb_rekomendasi a				
			INNER JOIN mst_proditawar b ON a.kd_proditawar =b.kd_proditawar					
			LEFT JOIN mst_fakultas bb on bb.kd_fakultas=b.kd_fakultas 
			INNER JOIN pmb_herregistrasi d on d.id_daftar=a.id_daftar 				
			where DATE_FORMAT(d.tgl_herregistrasi,'%d/%m/%Y')=DATE_FORMAT(NOW(),'%d/%m/%Y') 
			and YEAR(d.tgl_herregistrasi) = ".$this->active_year."				
			group by b.kd_fakultas) a2 
			ON a1.fakultas=a2.fakultas
			"			);			
			return $q->result();		
		}else{			
			$q=$this->db->query(				
			"Select a1.fakultas as fakultas,a1.jml_pendaftar,IF(a2.jml_her is NULL,0,a2.jml_her)as jml_her from
			(SELECT bb.nama_fakultas as fakultas,COUNT(a.id_daftar) as jml_pendaftar
			FROM mst_fakultas bb 				
			left JOIN mst_proditawar b ON bb.kd_fakultas=b.kd_fakultas 				
			left JOIN pmb_pendaftar a on a.prodi_pil1=b.kd_proditawar and DATE_FORMAT(a.tgl_daftar,'%d/%m/%Y')='".$date."' 	 				
			where YEAR(a.tgl_daftar) = ".$this->active_year."
			group by bb.kd_fakultas) a1
			LEFT JOIN 			
			(SELECT bb.nama_fakultas as fakultas,count(bb.kd_fakultas) as jml_her		
			FROM pmb_rekomendasi a				
			INNER JOIN mst_proditawar b ON a.kd_proditawar =b.kd_proditawar					
			LEFT JOIN mst_fakultas bb on bb.kd_fakultas=b.kd_fakultas 
			INNER JOIN pmb_herregistrasi d on d.id_daftar=a.id_daftar 				
			where DATE_FORMAT(d.tgl_herregistrasi,'%d/%m/%Y')='".$date."'	
			and YEAR(d.tgl_herregistrasi) = ".$this->active_year."		
			group by b.kd_fakultas) a2 
			ON a1.fakultas=a2.fakultas"			
			);			
			return $q->result();		
		}	
	}
	
	public function getGrafikHarian(){
		$q=$this->db->query("
		SELECT * FROM
		(SELECT DATE(a.tgl_daftar) AS tgl1, COUNT(a.prodi_pil1) AS jum1
		FROM pmb_pendaftar a
		WHERE DATE(a.tgl_daftar)<= DATE(NOW()) AND (a.prodi_pil1!=0 OR a.prodi_pil1!= NULL)
		and YEAR(a.tgl_daftar) = ".$this->active_year."
		GROUP BY DATE(a.tgl_daftar)
		ORDER BY DATE(a.tgl_daftar) DESC LIMIT 7) a1
		LEFT JOIN 
		(SELECT DATE(a.tgl_herregistrasi) AS tgl2, COUNT(a.nim) AS jum2
		FROM pmb_herregistrasi a
		WHERE DATE(a.tgl_herregistrasi)<= DATE(NOW())
		and YEAR(a.tgl_herregistrasi) = ".$this->active_year."
		GROUP BY DATE(a.tgl_herregistrasi)
		ORDER BY DATE(a.tgl_herregistrasi) DESC LIMIT 7) a2 ON a1.tgl1=a2.tgl2");
		return $q->result();
	}
	
	public function getDaftarBulanan($date=null){
		if($date==null){			
			$q=$this->db->query(				
			"
			Select a1.fakultas as fakultas,a1.jml_pendaftar,a2.jml_her from
			(SELECT bb.nama_fakultas as fakultas,count(bb.kd_fakultas) as jml_pendaftar		
			FROM pmb_pendaftar a				
			INNER JOIN mst_proditawar b ON a.prodi_pil1=b.kd_proditawar				
			LEFT JOIN mst_fakultas bb on bb.kd_fakultas=b.kd_fakultas 			
			where DATE_FORMAT(a.tgl_daftar,'%m/%Y')=DATE_FORMAT(NOW(),'%m/%Y') 		
			and YEAR(a.tgl_daftar) = ".$this->active_year."		
			group by b.kd_fakultas) a1
			LEFT JOIN 			
			(SELECT bb.nama_fakultas as fakultas,count(bb.kd_fakultas) as jml_her		
			FROM pmb_rekomendasi a				
			INNER JOIN mst_proditawar b ON a.kd_proditawar =b.kd_proditawar					
			LEFT JOIN mst_fakultas bb on bb.kd_fakultas=b.kd_fakultas 
			INNER JOIN pmb_herregistrasi d on d.id_daftar=a.id_daftar 				
			where DATE_FORMAT(d.tgl_herregistrasi,'%m/%Y')=DATE_FORMAT(NOW(),'%m/%Y') 	
			and YEAR(d.tgl_herregistrasi) = ".$this->active_year."			
			group by b.kd_fakultas) a2 
			ON a1.fakultas=a2.fakultas
			");			
			return $q->result();		
		}else{			
			$q=$this->db->query(				
			"Select a1.fakultas as fakultas,a1.jml_pendaftar,a2.jml_her from
			(SELECT bb.nama_fakultas as fakultas,count(bb.kd_fakultas) as jml_pendaftar		
			FROM pmb_pendaftar a				
			INNER JOIN mst_proditawar b ON a.prodi_pil1=b.kd_proditawar				
			LEFT JOIN mst_fakultas bb on bb.kd_fakultas=b.kd_fakultas 			
			where DATE_FORMAT(a.tgl_daftar,'%m')=".$date." 
			and YEAR(a.tgl_daftar) = ".$this->active_year."
			group by b.kd_fakultas) a1
			LEFT JOIN 			
			(SELECT bb.nama_fakultas as fakultas,count(bb.kd_fakultas) as jml_her		
			FROM pmb_rekomendasi a				
			INNER JOIN mst_proditawar b ON a.kd_proditawar =b.kd_proditawar					
			LEFT JOIN mst_fakultas bb on bb.kd_fakultas=b.kd_fakultas 
			INNER JOIN pmb_herregistrasi d on d.id_daftar=a.id_daftar 				
			where DATE_FORMAT(d.tgl_herregistrasi,'%m')=".$date." 	
			and YEAR(d.tgl_herregistrasi) = ".$this->active_year."			
			group by b.kd_fakultas) a2 
			ON a1.fakultas=a2.fakultas"			
			);			
			return $q->result();		
		}
	}
	
	public function getGrafikBulanan(){
		$q=$this->db->query("
		SELECT * FROM
		(SELECT MONTH(a.tgl_daftar) AS tgl1, YEAR(a.tgl_daftar) AS th1, COUNT(a.prodi_pil1) AS jum1
		FROM pmb_pendaftar a
		WHERE MONTH(a.tgl_daftar)<= MONTH(NOW()) AND YEAR(a.tgl_daftar)= ".$this->active_year." AND (a.prodi_pil1!=0 OR a.prodi_pil1!= NULL)
		GROUP BY MONTH(a.tgl_daftar) ORDER BY MONTH(a.tgl_daftar) DESC LIMIT 6) a1
		LEFT JOIN 			
		(SELECT MONTH(a.tgl_herregistrasi) AS tgl2, YEAR(a.tgl_herregistrasi) AS th2, COUNT(a.id_daftar) AS jum2
		FROM pmb_herregistrasi a
		WHERE MONTH(a.tgl_herregistrasi)<= MONTH(NOW()) AND YEAR(a.tgl_herregistrasi)= ".$this->active_year."
		GROUP BY MONTH(a.tgl_herregistrasi) ORDER BY MONTH(a.tgl_herregistrasi) DESC LIMIT 6) a2 ON a1.tgl1=a2.tgl2");
		return $q->result();
	}

	public function getSebaranDaerah(){
		$t = "SELECT
				  c.kd_propinsi   AS kd,
				  c.nama_propinsi AS prop,
				  COUNT(a.id_daftar) AS jml
				FROM ((mst_kota b
				    LEFT JOIN pmb_pendaftar a
				      ON a.kab_asal = b.kd_kota AND YEAR(a.tgl_daftar) = ".$this->active_year.")
				   JOIN mst_propinsi c
				     ON ((b.kd_propinsi = c.kd_propinsi)))  
				GROUP BY b.kd_propinsi";
		$q = $this->db->query($t);
		return $q->result();
	}
	
	public function getMaxProp(){
		$t = "SELECT * FROM (SELECT
								  c.kd_propinsi   AS kd,
								  c.nama_propinsi AS prop,
								  COUNT(a.id_daftar) AS jml
								FROM ((mst_kota b
								    LEFT JOIN pmb_pendaftar a
								      ON a.kab_asal = b.kd_kota AND YEAR(a.tgl_daftar) = ".$this->active_year.")
								   JOIN mst_propinsi c
								     ON ((b.kd_propinsi = c.kd_propinsi)))
								GROUP BY b.kd_propinsi) a
							where a.kd!=350000 order by a.jml desc limit 1";
		$q = $this->db->query($t);
		return $q->result();
	}
	
	public function getRankSekolah(){
		$t = "select * from (SELECT
							  a.kd_sekolah     AS kd_sekolah,
							  d.kd_kota        AS kd_kota,
							  b.nama_sekolah   AS sekolah,
							  c.nama_kecamatan AS kecamatan,
							  d.nama_kota      AS kota,
							  e.nama_propinsi  AS propinsi,
							  COUNT(a.kd_sekolah) AS jml
							FROM ((((pmb_pendaftar a
							      LEFT JOIN mst_sekolah b
							        ON ((a.kd_sekolah = b.kd_sekolah)))
							     LEFT JOIN mst_kecamatan c
							       ON ((b.kec_sekolah = c.kd_kecamatan)))
							    LEFT JOIN mst_kota d
							      ON ((c.kd_kota = d.kd_kota)))
							   LEFT JOIN mst_propinsi e
							     ON ((d.kd_propinsi = e.kd_propinsi)))
							where YEAR(a.tgl_daftar) = ".$this->active_year."
							GROUP BY a.kd_sekolah) a
				WHERE (a.kd_sekolah IS NOT NULL AND a.kd_sekolah<>'' AND a.kd_sekolah<>'00000000')
				order by a.jml desc, a.kd_sekolah asc
				limit 5";
		$q = $this->db->query($t);
		return $q->result();
	}
	
	public function getRankKota(){
		$t = "select *
				from (SELECT
						  d.kd_kota        AS kd_kota,
						  c.nama_kecamatan AS kecamatan,
						  d.nama_kota      AS kota,
						  e.nama_propinsi  AS propinsi,
						  COUNT(a.kd_sekolah) AS jml
						FROM ((((pmb_pendaftar a
						      LEFT JOIN mst_sekolah b
						        ON ((a.kd_sekolah = b.kd_sekolah)))
						     LEFT JOIN mst_kecamatan c
						       ON ((b.kec_sekolah = c.kd_kecamatan)))
						    LEFT JOIN mst_kota d
						      ON ((c.kd_kota = d.kd_kota)))
						   LEFT JOIN mst_propinsi e
						     ON ((d.kd_propinsi = e.kd_propinsi)))
						where YEAR(a.tgl_daftar) = ".$this->active_year."
						GROUP BY c.kd_kota) a
					WHERE a.kd_kota IS NOT NULL AND a.kd_kota<>''
				order by a.jml desc
				limit 5";
		$q = $this->db->query($t);
		return $q->result();
	}
	
	public function getMinProp(){
		$t = "SELECT * FROM (SELECT
							  c.kd_propinsi   AS kd,
							  c.nama_propinsi AS prop,
							  COUNT(a.id_daftar) AS jml
							FROM ((mst_kota b
							    LEFT JOIN pmb_pendaftar a
							       ON a.kab_asal = b.kd_kota AND YEAR(a.tgl_daftar) = ".$this->active_year.")
							   JOIN mst_propinsi c
							     ON ((b.kd_propinsi = c.kd_propinsi)))
							GROUP BY b.kd_propinsi) a
						where a.kd!=350000 order by a.jml asc limit 1";
		$q = $this->db->query($t);
		return $q->result();
	}
	
	public function getAvgProp(){
		$t = "SELECT '-' as prop, AVG(a.jml) as jml FROM (SELECT
														  c.kd_propinsi   AS kd,
														  c.nama_propinsi AS prop,
														  COUNT(a.id_daftar) AS jml
														FROM ((mst_kota b
														    LEFT JOIN pmb_pendaftar a
														       ON a.kab_asal = b.kd_kota AND YEAR(a.tgl_daftar) = ".$this->active_year.")
														   JOIN mst_propinsi c
														     ON ((b.kd_propinsi = c.kd_propinsi))) 
														GROUP BY b.kd_propinsi) a";
		$q = $this->db->query($t);
		return $q->result();
	}
	
	public function getPendaftarSekarang(){
		$skr = new DateTime('now');
		$tgSkr = $skr->format('Y-m-d');
		#$kmrn = new DateTime('yesterday');
		#$kmr = $kmrn->modify('-1');
		#$tgKmr = date('01-01-2016','d-m-Y');
		$t = "select date(tgl_daftar) as tgl, count(id_daftar) as jml from pmb_pendaftar where  YEAR(tgl_daftar)=".$this->active_year." AND DATE(tgl_daftar)<='".$tgSkr."' and prodi_pil1 is not null";
		$q = $this->db->query($t);
		return $q->result();
		//return $q;
	}

	public function getRatatahunan()
	{
		$q = $this->db->query("SELECT AVG(a.jml) AS rata2 FROM 
								(SELECT
								  YEAR(tgl_daftar) thn,
								  COUNT(id_daftar) AS jml 
								FROM
								  pmb_pendaftar 
								WHERE 
								   prodi_pil1 IS NOT NULL 
								  GROUP BY YEAR(tgl_daftar)) a")->result();
		return $q;
	}
	
	public function getJmlPendaftar($a=null){
		if($a==null){
			$t = "select count(id_daftar) as jml from pmb_pendaftar where jalur_pendaftaran='2' and YEAR(tgl_daftar) = ".$this->active_year;
		}else{
			$t = "select count(id_daftar) as jml from pmb_pendaftar where jalur_pendaftaran='2' and DATE(tgl_daftar) between '".$a."' and '".$a."' and prodi_pil1 is not null and YEAR(tgl_daftar) = ".$this->active_year."
				group by date(tgl_daftar)";
		}
		$q = $this->db->query($t);
		return $q->result();		
	}
	
	public function getJmlHerReg($a=null){
		if($a==null){
			$t = "select count(id_daftar) as jml from pmb_herregistrasi where tgl_herregistrasi is not null and YEAR(tgl_herregistrasi) = ".$this->active_year;
		}else{
			$t = "select count(id_daftar) as jml from pmb_herregistrasi where YEAR(tgl_herregistrasi) = ".$this->active_year." and DATE(tgl_herregistrasi) between '".$a."' and '".$a."'
			group by date(tgl_herregistrasi);	";
		}
		$q = $this->db->query($t);
		return $q->result();
	}
	
	public function getJmlBlmWawancara(){
		$t="SELECT count(*) as jml
			FROM pmb_pendaftar a
			LEFT JOIN pmb_rekomendasi b ON a.id_daftar=b.id_daftar
			WHERE DATE(a.tgl_tes)= DATE(NOW()) AND a.jalur_pendaftaran=2 AND b.id_daftar is null
			AND YEAR(a.tgl_daftar)=".$this->active_year;
		$q = $this->db->query($t);
		return $q->result();
	}
	
	public function getJmlBlmTestpa(){
		$t="SELECT count(*) as jml
			FROM pmb_pendaftar a
			LEFT JOIN pmb_testpa b ON a.id_daftar=b.id_daftar
			WHERE DATE(a.tgl_tes)= DATE(NOW()) AND a.jalur_pendaftaran=2 AND b.id_daftar is null
			AND YEAR(a.tgl_daftar)=".$this->active_year;
		$q = $this->db->query($t);
		return $q->result();
	}
	
	public function getJmlHerProdi(){
		$t='SELECT jurusan,count(nim) as jml FROM 
			(SELECT a.id_daftar as id_daftar, CONCAT(e.nama_jurusan," ",f.nama_jenjang) AS jurusan, b.nim AS nim
			FROM pmb_rekomendasi a
			LEFT JOIN pmb_herregistrasi b ON a.id_daftar=b.id_daftar AND b.tgl_herregistrasi IS NOT NULL AND YEAR(b.tgl_herregistrasi)='.$this->active_year.'
			INNER JOIN mst_proditawar c ON c.kd_proditawar=a.kd_proditawar
			INNER JOIN mst_fakultas d ON d.kd_fakultas=c.kd_fakultas
			INNER JOIN mst_jurusan e ON e.kd_jurusan=c.kd_jurusan AND e.kd_fakultas=c.kd_fakultas
			INNER JOIN mst_jenjang f ON f.kd_jenjang=c.kd_jenjang
			INNER JOIN mst_status g ON g.kd_status=c.kd_status
			GROUP BY a.id_daftar) her
			GROUP BY jurusan
			ORDER BY jurusan';
		$q = $this->db->query($t);
		return $q->result();
	}
}
