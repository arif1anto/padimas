<?php
     class Chain extends CI_Controller {
    function Chain()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','Ajax_Pagination','encrypt'));
        $this->load->database();
        $this->load->model(array('mpendaftar','mbiaya','mmaster','mrekomendasi','mkonfig','mdata','mtest','mpengumuman','mprogram'));
		$this->cek_sess();
		//$this->isAjax();
    }
	
	
	private function cek_sess() {
        $login = $this->session->userdata('login');
        if ($login){
            return true;
        } else {
            redirect('admin/login');
        }
    }
	private function isAjax() {
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest")
			return true;
		else
			 redirect('admin');
	} 
	
	function genNopendaftar(){
		$iddaftar=$this->mpendaftar->genNoPendaftaran($this->input->post('id'));
		echo $iddaftar;
	}
	
	function getTarifDaftar(){
		$tarif=$this->mbiaya->gettarifby_id($this->input->post('id'));
		echo $tarif[0]->tarif;
	}
	
	function getKota(){
		$getKota=$this->mmaster->getcbkota_byid($this->input->post('id'));
		echo "<option value='0'>- Pilih Kota-</option>";
		foreach($getKota as $r){
			echo '<option value="'.$r->kd_kota.'">'.$r->nama_kota.'</option>';
		}
	}
	
	function getKecamatan(){
			$getKec=$this->mmaster->getcbkec_byid($this->input->post('id'));
			echo "<option value='0'>- Pilih Kecamatan-</option>";
			foreach($getKec as $r){
				echo '<option value="'.$r->kd_kecamatan.'">'.$r->nama_kecamatan.'</option>';
			}
	}
	
	function getSekolah(){
		$getSekolah=$this->mmaster->getcbsekolah_byid($this->input->post('id'));
		echo "<option value='0'>- Pilih Sekolah-</option>";
		foreach($getSekolah as $r){
			echo '<option value="'.$r->kd_sekolah.'">'.$r->nama_sekolah.'</option>';
		}
		echo "<option value='00000000'>- Sekolah Belum Terdaftar -</option>";
	}
	function inSekolah(){
		$q=$this->mmaster->qInSekolah($this->session->userdata("user"));
        if($q!=false)
			echo $q;
		else
			echo "gagal";
    }
	function ganti(array $replace, $subject) { 
	   return str_replace(array_keys($replace), array_values($replace), $subject);    
	}
	function getCariSekolah(){
		$kata=strtolower($this->input->post('key'));
		$rep1=array(
			'sma n'=>'sman',
			'smk n'=>'smkn',
			'sma s'=>'smas',
			'smk s'=>'smks',
			'ma n'=>'man',
			'ma s'=>'mas',
			'sma'=>'sekolah menengah atas',
			'smk'=>'sekolah menengah kejuruan',
			'ma'=>'madrasah aliyah'
		);
		$rep2=array(
			'sman'=>'sma n',
			'smkn'=>'smk n',
			'smas'=>'sma s',
			'smks'=>'smk s',
			'man'=>'ma n',
			'mas'=>'ma s',
			'sekolah menengah atas'=>'sma',
			'sekolah menengah kejuruan'=>'smk',
			'madrasah aliyah'=>'ma'
		);
		$rep3=array(
			'sma n'=>'sman',
			'smk n'=>'smkn',
			'sma s'=>'smas',
			'smk s'=>'smks',
			'ma n'=>'man',
			'ma s'=>'mas',
		);
		$rep4=array(
			'sman'=>'sma n',
			'smkn'=>'smk n',
			'smas'=>'sma s',
			'smks'=>'smk s',
			'man'=>'ma n',
			'mas'=>'ma s',
			'sekolah menengah atas'=>'sma',
			'sekolah menengah kejuruan'=>'smk',
			'madrasah aliyah'=>'ma'
		);
		for($a=1;$a<9;$a++){
			$rep3[$a]="0".$a;
			$rep4[$a]="0".$a;
		}
		$l1=$this->ganti($rep1,$kata);
		$l2=$this->ganti($rep2,$kata);
		$l3=$this->ganti($rep3,$kata);
		$l4=$this->ganti($rep4,$kata);
		$cari=$this->mmaster->getsekolah_bysearch($l1,$l2,$l3,$l4);
		if($cari!=null):
			echo '<table>';
			foreach($cari as $r){
				echo'<tr class="display_box" onclick="lompati(&#34;'.$r->kd_sekolah.'&#34;)">
						<td id="nm_sek'.$r->kd_sekolah.'">'.$r->nama_sekolah.'</td>
						<td>'.$r->nama_kota.'</td>
				</tr>';
			}
			echo '</table><script>function lompati(id){ $("#kd_sekolah").val(id);$("#nm_sekolah").val($("#nm_sek"+id).html());$("#showcarisekolah").hide(); }</script>';
		endif;
	}
	function getCariDaftar(){
		$id=$this->input->post('key');
		$cari=$this->mpendaftar->getpendaftar_bysearch($id);
		if (count($cari)==1 && $id==$cari[0]->id_daftar):
			echo $cari[0]->id_daftar ;
		elseif(count($cari)>0):
			echo '<table>';
			foreach($cari as $r){
				echo'<tr class="display_box" onclick="lompati('.$r->id_daftar.')">
						<td>'.$r->id_daftar.'</td>
						<td>'.$r->nama.'</td>
						<td>'.$r->nama_sekolah.'</td>
						<td>'.$r->nama_kota.'</td>
				</tr>';
			}
			echo '</table><script>function lompati(id){ window.location.href="'.base_url().index_page().'admin/pendaftaran/validasi/edit/"+id; }</script>';
		endif;
	}
	
	function getCariByrDaftar(){
		$id=$this->input->post('key');
		$cari=$this->mpendaftar->getpendaftar_bysearch($id);
		if (count($cari)==1 && $id==$cari[0]->id_daftar):
			echo $cari[0]->id_daftar ;
		elseif(count($cari)>0):
			echo '<table>';
			foreach($cari as $r){
				echo'<tr class="display_box" onclick="lompati('.$r->id_daftar.')">
						<td>'.$r->id_daftar.'</td>
						<td>'.$r->nama.'</td>
						<td>'.$r->nama_sekolah.'</td>
						<td>'.$r->nama_kota.'</td>
				</tr>';
			}
			echo '</table><script>function lompati(id){ window.location.href="'.base_url().index_page().'admin/pendaftaran/edit/"+id; }</script>';
		endif;
	}
	
	function getCariHer($aksi=null){
		$id=$this->input->post('key');
		if($aksi==null) :
			$cari=$this->mpendaftar->getpendaftar_bysearch($id);
			if (count($cari)==1 && $id==$cari[0]->id_daftar):
				echo $cari[0]->id_daftar ;
			elseif(count($cari)>0):
				echo '<table>';
				foreach($cari as $r){
					echo'<tr class="display_box" onclick="lompati('.$r->id_daftar.')">
							<td>'.$r->id_daftar.'</td>
							<td>'.$r->nama.'</td>
							<td>'.$r->nama_sekolah.'</td>
							<td>'.$r->nama_kota.'</td>
					</tr>';
				}
				echo '</table><script>function lompati(id){ window.location.href="'.base_url().index_page().'admin/pendaftaran/her_registrasi/"+id; }</script>';
			endif;
		elseif($aksi=='ubahnim'):
			$cari=$this->mpendaftar->gether_bysearch($id);
			if (count($cari)==1 && $id==$cari[0]->id_daftar):
				echo $cari[0]->nama ;
			elseif(count($cari)>0):
				echo '<table>';
				foreach($cari as $r){
					echo'<tr class="display_box" onclick="lompati(&#34;'.$r->id_daftar.'&#34;,&#34;'.$r->nama.'&#34;)">
							<td>'.$r->id_daftar.'</td>
							<td>'.$r->nim.'</td>
							<td>'.$r->nama.'</td>
					</tr>';
				}
				echo '</table><script>function lompati(id,nama){$("#searchbox").val(id);$("#nama").text(nama);$("#display").hide(); }</script>';
			endif;
		elseif($aksi=='hapusher'):
			$cari=$this->mpendaftar->gether_bysearch($id,'nim');
			if (count($cari)==1 && $id==$cari[0]->nim):
				echo $cari[0]->nama ;
			elseif(count($cari)>0):
				echo '<table>';
				foreach($cari as $r){
					echo'<tr class="display_box" onclick="lompati(&#34;'.$r->nim.'&#34;,&#34;'.$r->nama.'&#34;)">
							<td>'.$r->nim.'</td>
							<td>'.$r->id_daftar.'</td>
							<td>'.$r->nama.'</td>
					</tr>';
				}
				echo '</table><script>function lompati(id,nama){$("#searchbox").val(id);$("#nama").text(nama);$("#display").hide(); }</script>';
			endif;
		elseif($aksi=='bayarher'):
			$cari=$this->mpendaftar->getbayarher_bysearch($id);
			if (count($cari)==1 && $id==$cari[0]->id_daftar):
				echo $cari[0]->nama ;
			elseif(count($cari)>0):
				echo '<table>';
				foreach($cari as $r){
					echo'<tr class="display_box" onclick="lompati(&#34;'.$r->id_daftar.'&#34;,&#34;'.$r->nama.'&#34;)">
							<td>'.$r->id_daftar.'</td>
							<td>'.$r->nama.'</td>
							<td>'.$r->nama_sekolah.'</td>
							<td>'.$r->nama_kota.'</td>
					</tr>';
				}
				echo '</table><script>function lompati(id,nama){$("#searchbox").val(id);$("#nama").text(nama);$("#display").hide(); }</script>';
			endif;
		elseif($aksi=='bea'):
			$cari=$this->mpendaftar->getbea_bysearch($id);
			if (count($cari)==1 && $id==$cari[0]->id_daftar):
				echo '<script>lompati("'.$cari[0]->id_daftar.'","'.$cari[0]->nama.'","'.$cari[0]->kd_proditawar.'","'.$cari[0]->rekomendasi.'");pilih_surat("radio","'.$cari[0]->jalur_pendaftaran.'","'.$cari[0]->kd_jenis_beasiswa.'");$("#display").hide();</script>';
			elseif(count($cari)>0):
				echo '<table>';
				foreach($cari as $r){
					echo'<tr class="display_box" onclick="lompati(&#34;'.$r->id_daftar.'&#34;,&#34;'.$r->nama.'&#34;,&#34;'.$r->kd_proditawar.'&#34;,&#34;'.$r->rekomendasi.'&#34;);pilih_surat(&#34;radio&#34;,&#34;'.$r->jalur_pendaftaran.'&#34;,&#34;'.$r->kd_jenis_beasiswa.'&#34;);">
							<td>'.$r->id_daftar.'</td>
							<td>'.$r->nama.'</td>
							<td>'.$r->nama_sekolah.'</td>
							<td>'.$r->nama_kota.'</td>
					</tr>';
				}
				echo '</table><script>function lompati(id,nama,prodi,rekomen){$("input[name=no_pendaftaran]").val(id);$("#iddaftarbea").text(id);$("#namabea").text(nama);$("select[name=prodi]").val(prodi);$("select[name=rekomendasibea]").val(rekomen); $("#display").hide(); }</script>';
			endif;
		endif;
	}
     
	function getCariByrHer(){
		$id=$this->input->post('key');
		$cari=$this->mpendaftar->getpendaftar_bysearch($id);
		if (count($cari)==1 && $id==$cari[0]->id_daftar):
			echo $cari[0]->id_daftar ;
		elseif(count($cari)>0):
			echo '<table>';
			foreach($cari as $r){
				echo'<tr class="display_box" onclick="lompati('.$r->id_daftar.')">
						<td>'.$r->id_daftar.'</td>
						<td>'.$r->nama.'</td>
						<td>'.$r->nama_sekolah.'</td>
						<td>'.$r->nama_kota.'</td>
				</tr>';
			}
			echo '</table><script>function lompati(id){ window.location.href="'.base_url().index_page().'admin/pendaftaran/bayar_her/cari/"+id; }</script>';
		endif;
	}	
	
	function getCariWawancara(){
		$id=$this->input->post('key');
		$cari=$this->mpendaftar->getpendaftar_bysearch($id);
		if (count($cari)==1 && $id==$cari[0]->id_daftar):
			echo $cari[0]->id_daftar ;
		elseif(count($cari)>0):
			echo '<table>';
			foreach($cari as $r){
				echo'<tr class="display_box" onclick="lompati('.$r->id_daftar.')">
						<td>'.$r->id_daftar.'</td>
						<td>'.$r->nama.'</td>
						<td>'.$r->nama_sekolah.'</td>
						<td>'.$r->nama_kota.'</td>
				</tr>';
			}
			echo '</table><script>function lompati(id){ window.location.href="'.base_url().index_page().'admin/test/wawancara/"+id; }</script>';
		endif;
	}
	
	function getCariTesTPA(){
		$id=$this->input->post('key');
		$cari=$this->mtest->getjwbtpa_bysearch($id);
		if (count($cari)==1 && $id==$cari[0]->id_daftar):
			echo $cari[0]->nama ;
		elseif(count($cari)>0):
			echo '<table>';
			foreach($cari as $r){
				echo'<tr class="display_box" onclick="lompati(&#34;'.$r->id_daftar.'&#34;,&#34;'.$r->nama.'&#34;)">
						<td>'.$r->id_daftar.'</td>
						<td>'.$r->nama.'</td>
						<td>'.$r->nama_sekolah.'</td>
						<td>'.$r->nama_kota.'</td>
				</tr>';
			}
			echo '</table><script>function lompati(id,nama){$("#searchbox").val(id);$("#nama").text(nama);$("#display").hide(); }</script>';
		endif;
	}
	
	function cekNim(){
		$cari=$this->mrekomendasi->getnim($this->input->post('id'));
		echo $cari->nim;
			
	}
	
	function inNim(){
		$nim=$this->input->post('nim');
		$id=$this->input->post('iddaftar');
		$q=$this->mrekomendasi->qInNim($id,$nim);
		if($q==true){
			echo "sukses";
		}
		else{
			echo "gagal";
		}
			
	}
	
	function uprekomendasi(){
		$id=$this->input->post('id');
		$this->mrekomendasi->uprekomendasi($id,$this->session->userdata('user'));			
	}
	
	function getAkses(){
		$id=$this->input->post('id');
		$data=$this->mkonfig->getuser_byakses($id);
		if($data!=null):
		echo '<table class="table table-hover">
                <thead>
                  <tr>
					<th>Hak Akses</th>
					<th class="text-right"><a class="btn btn-primary btn-xs" onclick="tambahakses()"><i class="fa fa-plus"></i></a></th>
                  </tr>
                </thead>
                <tbody>
				  <tr id="fieldtbhakses" style="display:none;">
					<td colspan="2">
						<div class="input-group" style="width:100%">
							<select type="text" class="form-control input-sm" name="uhak" id="formtbhakses">
							</select>
							<a class="btn btn-primary btn-xs input-group-btn" onclick="tambahakses(true)"><i class="fa fa-save"></i></a>
						</div>
					</td>
				  </tr>';
		foreach($data as $r){
			echo'<tr id="trakses'.$r->id_hakakses.'">
					<td>'.$r->group.'</td>
					<td class="text-right">
						<a class="btn btn-danger btn-xs" onclick="hapusakses('.$r->id_hakakses.')"><i class="fa fa-times"></i></a>
					</td>
                  </tr>
				 </tbody>';
		}
		echo '</table>';
		endif;
	}
	
	function inAkses(){
		$id=$this->input->post('id');
		$akses=$this->input->post('akses');
		$stat=$this->mkonfig->inhakakses($id,$akses);
		if($stat==true):
			echo "sukses";
		endif;
	}
	
	function delAkses(){
		$id=$this->input->post('id');
		$akses=$this->input->post('akses');
		$stat=$this->mkonfig->delhakakses($id,$akses);
		if($stat==true):
			echo "sukses";
		endif;
	}
	
	function getLaporan($jns=null){
		$cari=null;$jenis='';
		if($jns=="hr"){
			$cari=$this->mdata->getDaftarHarian($this->input->post('key'));
			$jenis="Tanggal";
		}
		else if($jns=="bl"){
			$cari=$this->mdata->getDaftarBulanan($this->input->post('key'));
			$jenis="Bulan";
		}
			echo '
			<thead>
			  <tr>
				<th class="text-center">No</th>
				<th class="text-center">Fakultas</th>
				<th class="text-right">Pendaftar</th>
				<th class="text-right">Her-registrasi</th>
			  </tr>
			</thead>
			<tbody>';
			if(isset($cari) && count($cari)>0) {
				$no=1;$jml1=0;$jml2=0;
				foreach($cari as $r) :
					echo '
					<tr>
						<td>'.$no.'</td>
						<td>'.$r->fakultas.'</td>
						<td class="text-right text-success word-space-20"> '.($r->jml_pendaftar!=null ? $r->jml_pendaftar : 0).'</td>
						<td class="text-right text-danger word-space-20"> '.($r->jml_her!=null ? $r->jml_her : 0).'</td>					
					</tr>
					';
					$no++;
					$jml1+=$r->jml_pendaftar;
					$jml2+=$r->jml_her;
				endforeach;
				echo'</tbody>
                <tfoot>
                  <tr>
                    <th class="text-center" colspan="2">TOTAL</th>
                    <th class="text-right text-success"><abbr title="Jumlah Pendaftar.">'.$jml1.'</abbr></th>
                    <th class="text-right text-danger"><abbr title="Jumlah Her-registrasi.">'.$jml2.'</abbr></th>
                  </tr>
                </tfoot>';
			}else {
				echo '
					<tr>
						<td class="text-center" colspan="4">Tidak Ada Pendaftar Pada '.$jenis.' Ini</td>			
					</tr>
				</tbody>
				';
			}
	}
	function getnimbyprodi(){
		$dt=$this->mrekomendasi->gennim($this->input->post('id'));
		if($dt!=null):
			echo $dt->next_nim;
		endif;
	}
	function inNonReg(){
		$user=$this->session->userdata("user");
		$nim=$this->input->post('nim');
		$jalur=$this->input->post('jalur');
		$spapot=$this->input->post('spapot');
		$id=$this->mpendaftar->inpendaftar_nonreg($jalur,$user);
		$nim=$this->mrekomendasi->qInNim($id,$nim,$user);
		$this->mbiaya->inBayarHer($id,$this->input->post('prodi',TRUE),$user,$spapot);
		if($id!=null){
			echo $id;
		}
		else{
			echo "gagal";
		}
			
	}

	private function tanggal($date=null){
		if($date!=null) :
			$yr=date('Y',strtotime($date));
			$mo=date('m',strtotime($date));
			$d=date('d',strtotime($date));
			$day=date('N',strtotime($date));
			
			$bln='';$hr='';
			switch($mo){
				case '01' : $bln="Januari" ;break;
				case '02' : $bln="Februari" ;break;
				case '03' : $bln="Maret" ;break;
				case '04' : $bln="April" ;break;
				case '05' : $bln="Mei" ;break;
				case '06' : $bln="Juni" ;break;
				case '07' : $bln="Juli" ;break;
				case '08' : $bln="Agustus" ;break;
				case '09' : $bln="September" ;break;
				case '10' : $bln="Oktober" ;break;
				case '11' : $bln="November" ;break;
				case '12' : $bln="Desember" ;break;
			}
			
			switch($day){
				case 1 : $hr="Senin" ;break;
				case 2 : $hr="Selasa" ;break;
				case 3 : $hr="Rabu" ;break;
				case 4 : $hr="Kamis" ;break;
				case 5 ; $hr="Jum'at" ;break;
				case 6 ; $hr="Sabtu" ;break;
				case 7 ; $hr="Minggu" ;break;
			}
			return $hr.', '.$d.' '.$bln.' '.$yr;
		endif;
	}

	function getrekomendasi(){
		$tgl1 = $this->input->post('tgl1',TRUE);
		$tgl2 = $this->input->post('tgl2',TRUE);
		$cari = $this->input->post('cari',TRUE);
		$page = $this->input->post('page',TRUE);
		$prog = $this->input->post('prog',TRUE);
		$jnsbea = $this->input->post('jnsbea',TRUE);
		$jml=$this->mrekomendasi->getrekomendasi_allbydate($prog,$tgl1,$tgl2,$cari,null,null,$jnsbea);
		$set = $this->paging($page,$jml->num_rows(),'carirekomendasi');
		$data=$this->mrekomendasi->getrekomendasi_allbydate($prog,$tgl1,$tgl2,$cari,$set['idpage'],$set['confpage'],$jnsbea);
		echo '
		<div class="table-responsive">
              <table class="table table-hover"  >
                <thead>
                  <tr>
					<th class="text-center" width="100">Aksi</th>
					<th class="text-center" width="50">No</th>
                    <th>ID Daftar</th>
                    <th>Nama</th>
                    <th>Prodi</th>
					<th>Fakultas</th>
					<th class="text-right">SPA Normal</th>
					<th class="text-right">SPA Bayar</th>
                    <th class="text-right">SPA Potongan</th>
					<th class="text-center">Rekomendasi</th>
					<th class="text-right">Tgl Tes (yyyy-mm--dd)</th>
					<th class="text-right">Tgl Her (yyyy-mm--dd)</th>
					<th class="text-right">Jalur Pendaftaran</th>
					<th class="text-right">Jenis Beasiswa</th>
                  </tr>
                </thead>
                <tbody>
		';
        if (count($data)>0) {
			empty($set['idpage']) ? $i=0 : $i=$set['idpage'] ;
            foreach ($data as $row) {
            	$i++;
		        echo '
		        <tr>
				<td class="text-center">
		        	<div id="aksi'.$row->id_rekomendasi.'" class="btn-group btn-group-sm" role="group">
					  <button type="button" class="btn btn-warning" title="Edit" value="0" onclick="edit('.$row->id_rekomendasi.',$(this))"><i class="fa fa-pencil"></i></button>
					  <button type="button" id="cetak'.$row->id_rekomendasi.'" class="btn '.($row->stat_cetak=='Y' ? "btn-default" : "btn-primary").'" title="Cetak" value="0" onclick="cetak('.$row->id_rekomendasi.')"><i class="fa fa-print"></i></button>
					</div>
					<div id="simpan'.($row->id_rekomendasi).'" style="display:none">
					  <button type="button" class="btn btn-primary btn-sm" title="Edit" value="0" onclick="uprekomendasi('.$row->id_rekomendasi.')"><i class="fa fa-save"></i> Simpan</button>
					</div>
					
		        </td>
				<td class="text-center">'.$i.'</td>
		        <td id="iddaftar'.$row->id_rekomendasi.'">'.$row->iddaftar.'</td>
		        <td>'.$row->nama.'</td>
		        <td>'.$row->prodi.'( '.$row->kelas.' )'.'</td>
				<td>'.$row->fakultas.'</td>
				<td class="text-right" id="spa'.$row->id_rekomendasi.'">'.number_format($row->spa,0,',','.').'</td>
				<td class="text-right" id="spabyr'.$row->id_rekomendasi.'">'.number_format($row->spa_byr,0,',','.').'</td>
		        <td class="text-right" id="spapot'.$row->id_rekomendasi.'">'.number_format($row->spa_pot,0,',','.').'</td>
				<td class="text-center" id="rekomendasi'.$row->id_rekomendasi.'">'.$row->rekomendasi.'</td>
				<td class="text-right">'.$this->tanggal($row->tgl_tes).'</td>
				<td class="text-right">'.$this->tanggal($row->tgl_her).'</td>
				<td class="text-right">'.$row->prg_nama.'</td>
				<td class="text-right">'.($row->jenis_beasiswa!=null ? $row->jenis_beasiswa : "-").'</td>
		        </tr>';
		     }
	    } else {
	        echo '
	        <tr>
	            <td colspan="14" class="danger text-center"><strong>Tidak ditemukan Data Pendaftar</strong></td>
	        </tr>';
	    }
		echo '
			</tbody>
			<tfoot>
				<tr>
				<th class="text-center">Aksi</th>
				<th class="text-center">No</th>
				<th>ID Daftar</th>
				<th>Nama</th>
				<th>Prodi</th>
				<th>Fakultas</th>
				<th class="text-right">SPA Normal</th>
				<th class="text-right">SPA Bayar</th>
				<th class="text-right">SPA Potongan</th>
				<th class="text-center">Rekomendasi</th>
				<th class="text-right">Tgl Tes (yyyy-mm--dd)</th>
				<th class="text-right">Tgl Her (yyyy-mm--dd)</th>
				<th class="text-right">Jalur Pendaftaran</th>
				<th class="text-right">Jenis Beasiswa </th>
				</tr>
			</tfoot>
		  </table>
	</div>
	<ul class="pagination pagination-md">
	  '.$this->ajax_pagination->create_links().'
	</ul>
		';
	} 
	function getrekomendasiOP(){
		$tgl1 = $this->input->post('tgl1');
		$tgl2 = $this->input->post('tgl2');
		$cari = $this->input->post('cari');
		$page = $this->input->post('page');
		$prog = $this->input->post('prog');
		$jml=$this->mrekomendasi->getrekomendasi_allbydate($prog,$tgl1,$tgl2,$cari);
		$set = $this->paging($page,$jml->num_rows(),'carirekomendasi');
		$data=$this->mrekomendasi->getrekomendasi_allbydate($prog,$tgl1,$tgl2,$cari,$set['idpage'],$set['confpage']);
		echo '
		<div class="table-responsive">
              <table class="table table-hover"  >
                <thead>
                  <tr>
					<th class="text-center" width="250">Aksi</th>
					<th class="text-center" width="50">No</th>
                    <th>ID Daftar</th>
                    <th>Nama</th>
                    <th>Prodi</th>
					<th>Fakultas</th>
					<th class="text-right">SPA Normal</th>
					<th class="text-right">SPA Bayar</th>
                    <th class="text-right">SPA Potongan</th>
					<th class="text-center">Rekomendasi</th>
					<th class="text-right">Tgl Tes (yyyy-mm--dd)</th>
					<th class="text-right">Tgl Her (yyyy-mm--dd)</th>
					<th class="text-right">Jalur Pendaftaran</th>
                  </tr>
                </thead>
                <tbody>
		';
        if (count($data)>0) {
			empty($set['idpage']) ? $i=0 : $i=$set['idpage'] ;
            foreach ($data as $row) {
            	$i++;
		        echo '
		        <tr>
				<td class="text-center">
		        	<div id="aksi'.$row->id_rekomendasi.'" class="btn-group btn-group-sm" role="group">
					  <button type="button" id="cetak_amplop'.$row->id_rekomendasi.'" class="btn '.($row->stat_cetak_amplop=='Y' ? "btn-default" : "btn-primary").'" title="Cetak" value="0" onclick="cetak('.$row->id_rekomendasi.',&#34;amplop&#34;)"><i class="fa fa-print"></i> Cetak Amplop</button>
					  <button type="button" id="cetak'.$row->id_rekomendasi.'" class="btn '.($row->stat_cetak=='Y' ? "btn-default" : "btn-primary").'" title="Cetak" value="0" onclick="cetak('.$row->id_rekomendasi.',&#34;surat&#34;)"><i class="fa fa-print"></i> Cetak Surat</button>
					</div>
					<div id="simpan'.($row->id_rekomendasi).'" style="display:none">
					  <button type="button" class="btn btn-primary btn-sm" title="Edit" value="0" onclick="uprekomendasi('.$row->id_rekomendasi.')"><i class="fa fa-save"></i> Simpan</button>
					</div>
					
		        </td>
				<td class="text-center">'.$i.'</td>
		        <td id="iddaftar'.$row->id_rekomendasi.'">'.$row->iddaftar.'</td>
		        <td>'.$row->nama.'</td>
		        <td>'.$row->prodi.'( '.$row->kelas.' )'.'</td>
				<td>'.$row->fakultas.'</td>
				<td class="text-right">'.number_format($row->spa,0,',','.').'</td>
				<td class="text-right">'.number_format($row->spa_byr,0,',','.').'</td>
		        <td class="text-right">'.number_format($row->spa_pot,0,',','.').'</td>
				<td class="text-center">'.$row->rekomendasi.'</td>
				<td class="text-right">'.$this->tanggal($row->tgl_tes).'</td>
				<td class="text-right">'.$this->tanggal($row->tgl_her).'</td>
				<td class="text-right">'.$row->prg_nama.'</td>
		        </tr>';
		     }
	    } else {
	        echo '
	        <tr>
	            <td colspan="13" class="danger text-center"><strong>Tidak ditemukan Data Pendaftar</strong></td>
	        </tr>';
	    }
		echo '
			</tbody>
			<tfoot>
				<tr>
				<th class="text-center">Aksi</th>
				<th class="text-center">No</th>
				<th>ID Daftar</th>
				<th>Nama</th>
				<th>Prodi</th>
				<th>Fakultas</th>
				<th class="text-right">SPA Normal</th>
				<th class="text-right">SPA Bayar</th>
				<th class="text-right">SPA Potongan</th>
				<th class="text-center">Rekomendasi</th>
				<th class="text-right">Tgl Tes (yyyy-mm--dd)</th>
				<th class="text-right">Tgl Her (yyyy-mm--dd)</th>
				<th class="text-right">Jalur Pendaftaran</th>
				</tr>
			</tfoot>
		  </table>
	</div>
	<ul class="pagination pagination-md">
	  '.$this->ajax_pagination->create_links().'
	</ul>
		';
	} 
	function upbea(){
		$dt["id"]=$this->input->post('id');
		$dt["prodi"]=$this->input->post('prodi');
		$dt["rekomendasi"]=$this->input->post('rekomendasi');
		$dt["kdbea"]=$this->input->post('kdbea');
		if($dt["id"]!=null && $dt["id"]!=""&& $dt["kdbea"]!=null && $dt["kdbea"]!="" && $dt["prodi"]!=null && $dt["rekomendasi"]!=null)
			$cek=$this->mrekomendasi->upbea($dt,$this->session->userdata('user'));
			if(!$cek) echo "gagal";
		else
			echo "gagal";
	}
	public function jnsbea($j=null,$p=null){
        $prg_id= $p==null ? $this->input->post("prog",TRUE) : $p;
		$jns= $j==null ? $this->input->post("jns",TRUE) : $j;
		if ($prg_id!=null || $prg_id!="") {
			$prg=$this->mprogram->getprogramby_id($prg_id);
			$str= isset($prg[0]->prg_bea) ?$prg[0]->prg_bea:0;
			$data = $this->mpengumuman->getpengumuman_surat($prg_id);
			if (($str!=null || $str!='')) {
				
				if ($jns=="tab") {
					echo '<a href="#" class="dropdown-toggle" id="jnssurat_" data-toggle="dropdown" aria-controls="jnssurat-contents" aria-expanded="false">Surat Beasiswa <span class="caret"></span></a> 
									<ul class="dropdown-menu" aria-labelledby="jnssurat_" id="jnssurat-contents" >     
							  ';
					if (count($data)>0) {
						$i=0;
						foreach ($data as $row) {
							if(substr($str,$i,1)==$row->kd_jenis_beasiswa)
								echo '<li><a href="#bea'.$row->kd_jenis_beasiswa.'" role="tab" id="bea'.$row->kd_jenis_beasiswa.'-tab" data-toggle="tab" aria-controls="bea'.$row->kd_jenis_beasiswa.'" aria-expanded="true"> Surat Pengumuman '.$row->jenis_beasiswa.'</a></li> ';
							$i++;
						}
					}	
					echo '</ul>';
				} elseif ($jns=="content") {
					if (count($data)>0) {
						$i=0;
						foreach ($data as $row) {
							if(substr($str,$i,1)==$row->kd_jenis_beasiswa)
								echo '<div role="tabpanel" class="tab-pane fade content_baru" id="bea'.$row->kd_jenis_beasiswa.'">
									<input type="hidden" name="kd_beasiswa['.$i.']" value="'.$row->kd_jenis_beasiswa.'">
									<div class="form-group">
										<textarea class="summernote" name="png_srt['.$i.']">'.$row->png_surat.'</textarea>
									</div>
								</div>';
							$i++;
						}
					}   
				}elseif ($jns=="combo") {
					if (count($data)>0) {
						$i=0;
						echo '<label class="control-label">Jenis Beasiswa </label>
								<select id="jenisbea" class="form-control" name="jnsbea">
								 <option value="">- Pilih Beasiswa -</option>';
						foreach ($data as $row) {
							if(substr($str,$i,1)==$row->kd_jenis_beasiswa)
								echo '<option value="'.$row->kd_jenis_beasiswa.'">'.$row->jenis_beasiswa.'</option>';
							$i++;
						}
						echo '</select>';
					}   
				}elseif ($jns=="radio") {
					if (count($data)>0) {
						$i=0;
						echo '<label class="control-label">Jenis Beasiswa </label>';
						foreach ($data as $row) {
							if(substr($str,$i,1)==$row->kd_jenis_beasiswa)
								echo '<div class="radio">
											<label class="radio" style="font-size:12px;"><input type="radio" id="radbea'.$row->kd_jenis_beasiswa.'" name="radbea"value="'.$row->kd_jenis_beasiswa.'">'.$row->jenis_beasiswa.'</label>
										</div>';
							$i++;
						}
					}   
				}
			}
		}
	}
	
	function dashboard($param=null){
		$dt1 = $this->mdata->getSebaranDaerah();
		$skr = new DateTime('now');
		$tgSkr = $skr->format('Y-m-d');
		$kmrn = new DateTime('yesterday');
		$kmr = $kmrn->modify('-1');
		$tgKmr = $kmr->format('Y-m-d');
		$dt2 = $this->mdata->getJmlPendaftar($tgSkr);
		$dt3 = $this->mdata->getJmlPendaftar($tgKmr);
		$dt4 = $this->mdata->getJmlHerReg($tgKmr);
		$dt5 = $this->mdata->getJmlHerReg($tgSkr);
		$dt8 = $this->mdata->getAvgProp();
		$dt9 = $this->mdata->getPendaftarSekarang();
		$dt10 = $this->mdata->getRankSekolah();
		$dt11 = $this->mdata->getRankKota();
		$dt12 = $this->mdata->getJmlBlmWawancara();
		$dt13 = $this->mdata->getJmlBlmTestpa();
		$dt14 = $this->mdata->getJmlHerReg();
		$dt15 = $this->mdata->getJmlHerProdi();
		$dt16 = $this->mdata->getRatatahunan();
		
		$a = isset($dt3[0]->jml) ? $dt3[0]->jml : 0; //kmrn
		$b = isset($dt2[0]->jml) ? $dt2[0]->jml : 0; //skrg
		$x=$b-$a;
		$d = isset($dt4[0]->jml) ? $dt4[0]->jml : 0; //kmrn
		$e = isset($dt5[0]->jml) ? $dt5[0]->jml : 0; //skrg
		$y = abs($d-$e);
		
		if($param==1){
			if($a<$b) 
				echo 'Hari ini lebih baik dari kemarin...';
			else if($a>$b) 
				echo 'Hari ini tidak lebih baik dari kemarin...';
			else if($a==$b)
				echo 'Hari ini sama baiknya dengan kemarin...';
		}
		elseif($param==2){
			if($a>$b){
				echo '<div class="guede word-space-20">'.$b.' <small class="cuilik text-danger word-space-5"><i class="fa fa-caret-down"></i> '.$x.'</small></div>';
			}else if($a==$b){
				echo '<div class="guede word-space-20">'.$b.' <small class="cuilik text-warning word-space-5"><i class="fa fa-caret-right"></i> '.$x.'</small></div>';
			}else if($a<$b){
				echo '<div class="guede word-space-20">'.$b.' <small class="cuilik text-success word-space-5"><i class="fa fa-caret-up"></i> '.$x.'</small></div>';
			}else{
				echo 'PARSING ERROR';
			}
		}
		elseif($param==3){					
			if($d>$e){
				echo '<div class="guede word-space-20">'.$e.' <small class="cuilik text-danger word-space-5"><i class="fa fa-caret-down"></i> '.$y.'</small></div>';
			}else if($d==$e){
				echo '<div class="guede word-space-20">'.$e.' <small class="cuilik text-warning word-space-5"><i class="fa fa-caret-right"></i> '.$y.'</small></div>';
			}else if($d<$e){
				echo '<div class="guede word-space-20">'.$e.' <small class="cuilik text-success word-space-5"><i class="fa fa-caret-up"></i> '.$y.'</small></div>';
			}else{
				echo 'PARSING ERROR';
			}	
		}elseif($param==4){
			$max=0;$min=$dt15[0]->jml;$jum=0;$prodmax='';$prodmin='';
			echo '<script type="text/javascript">
				var dt = [';
			foreach($dt15 as $key){
				echo '{"y": "'.preg_replace("/[A-Za-z]*\.\s([A-Za-z].*)/", "$2 $1", $key->jurusan).'", "a": "'.$key->jml.'"},';
				if ( $max < $key->jml )
				{
					$max = $key->jml;
					$prodmax=$key->jurusan;
				}
				else if ( $key->jml < $min )
				{
					$min = $key->jml;
					$prodmin=$key->jurusan;
				}
				else if ( $key->jml == $min )
				{
					$max = $key->jml;
					$prodmax=$key->jurusan;
					$min = $key->jml;
					$prodmin=$key->jurusan;
				}
				$jum+=$key->jml;
			}
			echo"
				];
					
				Morris.Bar({
				  element: 'chartProdi',
				  data: dt,
				  xkey: 'y',
				  ykeys: ['a'],
				  axes: 'y',
				  labels: ['Pendaftar'],
				  xLabelAngle: 75,
				  hideHover: 'auto',
				  resize: 'true',
				  barColors: function(row, series, type) {
					if(series.key == 'a')
					{
					  if(row.y < 250)
						return 'red';
					  else if(row.y >= 250 && row.y <500)
						return 'orange';
					  else if(row.y >= 500 && row.y <750)
						return 'blue';
					  else if(row.y >= 750 && row.y <1000)
						return 'green';  
					  else
						return 'grey';
					}
				  }
				});
				</script>";
			echo '
				<div class="col-lg-3 col-xs-6 text-right">
					<span>TERTINGGI</span>
					
					<div class="guede">'.$max.'</div>
					<span>'.$prodmax.'</span>
				</div>
				<div class="col-lg-3 col-xs-6 text-right">
					<span>TERENDAH</span>
					<div class="guede">'.$min.'</div>
					<span>'.$prodmin.'</span>
				</div>
				<div class="col-lg-3 col-xs-6 text-right">
					<span>TOTAL HER_REGISTRASI</span>
					<div class="guede">'.$jum.'</div>
					<span>Pendaftar</span>
				</div>
				<div class="col-lg-3 col-xs-6 text-right">
					<span>UNDUH DATA</span>
					<div class="guede"><a href="'.site_url("admin/pendaftaran/excel/dataher").' "class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Excel</a></div>
					
				</div>';
		}elseif($param==5){
			if($dt11!=null):
				foreach($dt11 as $key){
					if($key->kota == ''){
						echo '<li class="list-group-item">N/A</li>';
					}else{
						echo '<li class="list-group-item">'.$key->kota.', '.$key->propinsi.' <span class="badge">'.$key->jml.'</span></li>';
					}
				}
			endif;
		}elseif($param==6){
			if($dt10!=null):
				foreach($dt10 as $key){
					if($key->sekolah == ''){
						echo '<li class="list-group-item">N/A</li>';
					}else{
						echo '<li class="list-group-item">'.$key->sekolah.', '.$key->kota.', '.$key->propinsi.' <span class="badge">'.$key->jml.'</span></li>';
					}
				}
			endif;
		}elseif($param==7){
			echo '<script type="text/javascript">
				var prop = [';
			$b=$dt9[0]->jml;$max=0;$min=$dt1[0]->jml;$provmax='';$provmin='';
			foreach($dt1 as $key){
				echo '{"y": "'.preg_replace("/[A-Za-z]*\.\s([A-Za-z].*)/", "$2 $1", $key->prop).'", "a": "'.$key->jml.'"},';
				if ( $max < $key->jml && $key->prop!='Luar Negeri' )
					{
						$max = $key->jml;
						$provmax=$key->prop;
					}
					else if ( $key->jml < $min && $key->kd!='350000' )
					{
						$min = $key->jml;
						$provmin=$key->prop;
					}
					else if ( $key->jml == $min && $key->kd!='350000' )
					{
						$max = $key->jml;
						$provmax=$key->prop;
						$min = $key->jml;
						$provmin=$key->prop;
					}
			}
			echo"
				];
					
				Morris.Bar({
				  element: 'chartProp',
				  data: prop,
				  xkey: 'y',
				  ykeys: ['a'],
				  axes: 'y',
				  labels: ['Pendaftar'],
				  xLabelAngle: 75,
				  hideHover: 'auto',
				  resize: 'true',
				  barColors: function(row, series, type) {
					if(series.key == 'a')
					{
					  if(row.y < 250)
						return 'red';
					  else if(row.y >= 250 && row.y <500)
						return 'orange';
					  else if(row.y >= 500 && row.y <750)
						return 'blue';
					  else if(row.y >= 750 && row.y <1000)
						return 'green';  
					  else
						return 'grey';
					}
				  }
				});
				</script>";
			$a=ceil($dt16[0]->rata2); //temporary 2011-2015
			$c = number_format(((($b-$a)/$a*100)),2,',','');
			if($c < 0)
				$str='<span class="text-danger word-space-5">'.$c.'%</span>';
			else
				$str='<span class="text-success word-space-5"><i class="fa fa-caret-up"></i> '.$c.'%</span>';
			
			echo'
			<div class="col-lg-3 col-xs-6 text-right">
				<span>TERTINGGI</span>
				
				<div class="guede">'.$max.'</div>
				<span>'.$provmax.'</span>
			</div>
			<div class="col-lg-3 col-xs-6 text-right">
				<span>TERENDAH</span>
				<div class="guede">'.$min.'</div>
				<span>'.$provmin.'</span>
			</div>
			<div class="col-lg-3 col-xs-6 text-right">
				<span>RERATA TAHUNAN</span>
				<div class="guede">'.$a.'</div>
				<span>Data Tahun '.(date('Y')-5).' - '.date('Y').'</span>
			</div>
			<div class="col-lg-3 col-xs-6 text-right">
				<span>INDEX PERTUMBUHAN</span>
				<div class="guede">'.$str.'</div>
				<span>Pendaftar thn. '.date('Y').' ='.$b.' orang</span>
			</div>';
		}elseif($param==8){
			echo isset($dt12[0]->jml) ? $dt12[0]->jml : 0; 
		}elseif($param==9){
			echo isset($dt13[0]->jml) ? $dt13[0]->jml : 0;
		}elseif($param==10){
			echo isset($dt14[0]->jml) ? $dt14[0]->jml : 0;
		}
		elseif($param==11){
			echo isset($dt9[0]->jml) ? $dt9[0]->jml : 0;
		}elseif($param==12){
			
				
		}
	}
	
	private function paging($id=1,$totrows=null,$method=null){ 
		$config['method'] = $method;
        $config['current_position'] = $id;
        $config['num_links']= 2;
        $config['per_page'] = 30; 
        $config['total_rows'] = $totrows;
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '<i class="fa fa-chevron-right"></i>';
        $config['next_tag_open'] = '<li data-toggle="tooltip" data-placement="top" title="Halaman Selanjutnya">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<i class="fa fa-chevron-left" title="Halaman Sebelumnya"></i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['use_page_numbers'] = true;
        $page = $config['per_page']*($id-1);
        $jml = ceil($totrows/$config['per_page']);
        $config['full_tag_open'] = '<li class="active"><a>Page '.$id.'/'.$jml;
        $config['full_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        $rkey=array('confpage' => $config['per_page'],'idpage' => $page );
        return $rkey;
    }
	
}
