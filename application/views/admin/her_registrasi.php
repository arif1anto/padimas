<?php 
function tanggal($date=null){
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
		return $d.' '.$bln.' '.$yr;
	endif;
}
$st=isset($data2['st']) && $data2['st']!=0 ? $data2['st'] : "";
$end=isset($data2['end']) && $data2['end']!=0 ? $data2['end'] : "";
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Her Registrasi</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Her Registrasi</h3>
                </div>
                <div class="panel-body">
                    
                    <div class="row">
						<div class="col-sm-4">
							<div class="form-group input-sm">
								<label class="control-label col-sm-4 text-left">No. Pendaftaran</label>
								<div class="col-sm-8">
									<div class="input-group input-group-sm">
										<input type="text" class="form-control" name="no_pendaftaran" id="searchbox" onkeyup="cari()" onkeydown="lompat(event)" placeholder="Ketikkan Nomor Pendaftaran atau Nama Pendaftar untuk mencari data."  value="<?php echo isset($data6->iddaftar) ? $data6->iddaftar : ''?>" autocomplete="off">
										<span class="input-group-btn">
											<button class="btn btn-default btn-sm">Cari</button>
										</span>
									</div>
									<div id="display"></div>
									<p class="help-block"></p>
								</div>
							</div>
							<div class="form-group input-sm">
								<a class="col-sm-12" href="#" onclick="mod_nonreg()"> » Pendaftar Non Reguler</a>
							</div>
						</div>
							<?php echo form_open('',array('class'=>'form-horizontal')) ?>
                            <div class="col-sm-4">
                                <div class="form-group input-sm">
                                    <label class="control-label col-sm-4 text-left">NIM</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static"><?php echo isset($data6->nim) ? $data6->nim : ''?></p>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group input-sm">
                                    <label class="control-label col-sm-4 text-left">Fakultas</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static"><?php echo isset($data6->nama_fakultas) ? $data6->nama_fakultas : ''?></p>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group input-sm">
                                    <label class="control-label col-sm-4 text-left">Tanggal Her</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static"><?php echo isset($data6->tgl_herregistrasi) ? tanggal($data6->tgl_herregistrasi) : ''?></p>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group input-sm">
                                    <label class="control-label col-sm-4 text-left">Prodi</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static"><?php echo isset($data6->prodi) ? $data6->prodi : ''?></p>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-sm-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Kelengkapan Her Registrasi</h3>
                                    </div>
                                    <div class="panel-body">
										<table>
											<tr>
											<td colspan="2">
												<div class="checkbox">
													<span class="pull-left" style="font-size:12px;" ><a id="all_check" style="cursor:pointer">Tandai Semua</a> / <a id="all_uncheck" style="cursor:pointer">Hapus Tanda</a></span> 
													<span class="pull-right" style="font-size:12px;" >Jumlah Terkumpul</span>
												</div>
											</td>
											
											</tr>
											<?php 
											if (count($data14)>0) {
													$i=0;
													foreach ($data14 as $row) {	
														echo '<tr>
																<td width="80%">
																	<div class="checkbox">
																		<label class="checkbox" style="font-size:12px;"><input type="checkbox" class="set_syarat" name="set_syarat['.$i.']" onchange="syarat('.$i.','.$row->jum_syarat.',false)" id="set_syarat'.$i.'" value="'.$row->id.'"'.($row->kd!=null  ? "checked": "").'>'.$row->syarat.' (<span id="jsyarat'.$i.'" class="mnt_syarat">'.$row->jum_syarat.'</span> lembar)</label>
																	</div>
																</td>
																<td>
																	<div class="checkbox">
																		<label class="checkbox" style="font-size:12px;">
																			<input class="form-control text-right input-sm jml"type="number" min="0" max="'.$row->jum_syarat.'" name="jum_syarat['.$i.']" id="jum_syarat'.$i.'" value="'.$row->jum.'" onkeyup="syarat('.$i.','.$row->jum_syarat.',true)" onchange="syarat('.$i.','.$row->jum_syarat.',true)"/>
																		</label>
																	</div>
																</td>
															</tr>';
															  $i++;
													}
												}
											?>
										</table>
                                        <p class="text-right" style="margin-top: 15px;">
                                            <a href="javascript:void(0)" onclick="cetak_k('<?php echo isset($data6->iddaftar) ? $data6->iddaftar : ''?>')" class="btn btn-sm btn-primary">Cetak Kelengkapan</a>
                                        </p>
                                    </div>
                                </div>
                                <!-- end of panel -->
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Ukuran Jaz Almamater</h3>
                                    </div>
                                    <div class="panel-body">
                                        <hr>
                                        <div class="form-group form-group-sm">
                                            <label class="control-label col-sm-6 text-left">Ukuran Jas</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="jaz">
                                                    <option value="">- Pilih -</option>
													<option value="S"   <?php echo isset($data6->ukuran_jaz) && $data6->ukuran_jaz=="S" ? 'selected' : ''?>>S</option>
                                                    <option value="M"   <?php echo isset($data6->ukuran_jaz) && $data6->ukuran_jaz=="M" ? 'selected' : ''?>>M</option>
                                                    <option value="L"   <?php echo isset($data6->ukuran_jaz) && $data6->ukuran_jaz=="L" ? 'selected' : ''?>>L</option>
													<option value="LL"  <?php echo isset($data6->ukuran_jaz) && $data6->ukuran_jaz=="LL" ? 'selected' : ''?>>LL</option>
													<option value="LLL" <?php echo isset($data6->ukuran_jaz) && $data6->ukuran_jaz=="LLL" ? 'selected' : ''?>>LLL</option>
													<option value="LLLLL"<?php echo isset($data6->ukuran_jaz) && $data6->ukuran_jaz=="LLLLL" ? 'selected' : ''?>>LLLLL</option>
                                                    <option value="XL"  <?php echo isset($data6->ukuran_jaz) && $data6->ukuran_jaz=="XL" ? 'selected' : ''?>>XL</option>
													<option value="XXL" <?php echo isset($data6->ukuran_jaz) && $data6->ukuran_jaz=="XXL" ? 'selected' : ''?>>XXL</option>
                                                </select>
                                                <p class="help-block"></p>
                                            </div>
                                        </div>
                                        <p class="text-right" style="margin-top: 15px;">
                                            <a href="javascript:void(0)" onclick="cetak_jas('<?php echo isset($data6->iddaftar) ? $data6->iddaftar : ''?>')" class="btn btn-sm btn-primary">Cetak Bukti Pengambilan Jas</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <ul id="myTabs" class="nav nav-tabs" role="tablist"> 
                                    <li role="presentation" class="active">
                                        <a href="#pribadi" id="pribadi-tab" role="tab" data-toggle="tab" aria-controls="pribadi" aria-expanded="true">Data Pribadi</a>
                                    </li> 
                                    <li role="presentation" class="">
                                        <a href="#pendidikan" id="pendidikan-tab" role="tab" data-toggle="tab" aria-controls="pendidikan" aria-expanded="false">Data Pendidikan</a>
                                    </li> 
                                    <li role="presentation" class="">
                                        <a href="#ayah" id="ayah-tab" role="tab" data-toggle="tab" aria-controls="ayah" aria-expanded="false">Data Ayah</a>
                                    </li> 
                                    <li role="presentation" class="">
                                        <a href="#ibu" id="ibu-tab" role="tab" data-toggle="tab" aria-controls="ibu" aria-expanded="false">Data Ibu</a>
                                    </li> 
                                    <li role="presentation" class="">
                                        <a href="#wali" id="wali-tab" role="tab" data-toggle="tab" aria-controls="wali" aria-expanded="false">Data Wali</a>
                                    </li> 
                                    <li role="presentation" class="">
                                        <a href="#sutri" id="sutri-tab" role="tab" data-toggle="tab" aria-controls="sutri" aria-expanded="false">Data Suami/Istri</a>
                                    </li> 
                                </ul>
                                <div id="myTabContent" class="tab-content"> 
                                    <div role="tabpanel" class="tab-pane fade active in" id="pribadi" aria-labelledby="pribadi-tab"> 
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <div class="panel">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="panel panel-primary">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Data Diri Mahasiswa</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Nama Mahasiswa</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control input-sm" name="nama" id="nama" value="<?php echo isset($data6->nama) ? $data6->nama : ''?>">
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Tempat Lahir</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control input-sm" name="tmp_lahir" id="tmp_lahir" value="<?php echo isset($data6->tmp_lahir) ? $data6->tmp_lahir : ''?>">
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Tanggal Lahir (dd/mm/yyyy)</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <select class="form-control" name="dd_tgllahir">
                                                                            <option value="">DD</option>
                                                                            <?php 
																			$i2=0;
																			for ($i=1; $i <= 31; $i++) { 
																				if($i<10)
																					$i2='0'.$i;
																				else 
																					$i2=$i;
																			?>
                                                                            <option value="<?php echo $i2 ?>" <?php echo isset($data6->tgl_lahir) && date('d',strtotime($data6->tgl_lahir))==$i2 ? 'selected' : ''?>><?php echo $i2 ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <span class="input-group-addon" style="padding:0;">/</span>
                                                                        <select class="form-control" name="mm_tgllahir">
                                                                            <option value="">MM</option>
                                                                            <?php 
																			for ($i=1; $i <= 12; $i++) { 
																				if($i<10)
																					$i2='0'.$i;
																				else 
																					$i2=$i;		
																			?>
                                                                            <option value="<?php echo $i2 ?>" <?php echo isset($data6->tgl_lahir) && date('m',strtotime($data6->tgl_lahir))==$i2 ? 'selected' : ''?>><?php echo $i2 ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <span class="input-group-addon" style="padding:0;">/</span>
                                                                        <select class="form-control" name="yy_tgllahir">
                                                                            <option value="">YYYY</option>
                                                                            <?php for ($i=date('Y')-10; $i > date('Y')-80; $i--) { ?>
                                                                            <option value="<?php echo $i ?>" <?php echo isset($data6->tgl_lahir) && date('Y',strtotime($data6->tgl_lahir))==$i ? 'selected' : ''?>><?php echo $i ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        </div>
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Golongan Darah</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control" name="goldar">
                                                                        <option value="">- Pilih -</option>
                                                                        <option value="A" <?php echo isset($data6->goldar) && $data6->goldar=="A" ? 'selected' : ''?>>A</option>
                                                                        <option value="B" <?php echo isset($data6->goldar) && $data6->goldar=="B" ? 'selected' : ''?>>B</option>
                                                                        <option value="AB"<?php echo isset($data6->goldar) && $data6->goldar=="AB" ? 'selected' : ''?>>AB</option>
                                                                        <option value="O" <?php echo isset($data6->goldar) && $data6->goldar=="O" ? 'selected' : ''?>>O</option>
                                                                    </select>
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Jenis Kelamin</label>
                                                                <div class="col-sm-8">
                                                                    <select id="sex" class="form-control" name="sex">
																		<option value="">- Pilih -</option>
																		<option value="P" <?php echo isset($data6->sex) && $data6->sex=="P" ? 'selected' : ''?>>Laki-Laki</option>
																		<option value="W" <?php echo isset($data6->sex) && $data6->sex=="W" ? 'selected' : ''?>>Perempuan</option>
																	</select>
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Warga Negara</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control" name="warga_negara">
                                                                        <option value="">- Pilih -</option>
																		<option value="WNI" <?php echo isset($data6->wn) && $data6->wn=="WNI" ? 'selected' : ''?>>- WNI -</option>
																		<option value="WNA" <?php echo isset($data6->wn) && $data6->wn=="WNA" ? 'selected' : ''?>>- WNA -</option>
                                                                    </select>
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Status Mahasiswa</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control" name="status_mhs">
                                                                        <option value="">- Pilih -</option>
																		<option value="1" <?php echo isset($data6->stt_mhs) && $data6->stt_mhs=="1" ? 'selected' : ''?>>Biasa</option>
																		<option value="2" <?php echo isset($data6->stt_mhs) && $data6->stt_mhs=="2" ? 'selected' : ''?>>Beasiswa</option>
																		<option value="3" <?php echo isset($data6->stt_mhs) && $data6->stt_mhs=="3" ? 'selected' : ''?>>Tugas Belajar</option>
                                                                    </select>
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Biaya Pembiayaan</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control" name="pembiayaan">
                                                                        <option value="">- Pilih -</option>
																		<option value="1" <?php echo isset($data6->pembiayaan) && $data6->pembiayaan=="1" ? 'selected' : ''?>>Orang Tua/Wali</option>
																		<option value="2" <?php echo isset($data6->pembiayaan) && $data6->pembiayaan=="2" ? 'selected' : ''?>>Sendiri</option>
																		<option value="3" <?php echo isset($data6->pembiayaan) && $data6->pembiayaan=="3" ? 'selected' : ''?>>Instansi/Kantor</option>																		
                                                                    </select>
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Agama</label>
                                                                <div class="col-sm-8">
                                                                    <select id="agama" class="form-control" name="agama">
																		<option value="P">- Pilih Agama -</option>
																		<?php 
																			if (count($data10)>0) {
																				$i=0;
																				foreach ($data10 as $row) {
																						echo '<option value="'.$row->kd_agama.'" '.(isset($data6->agama) && $data6->agama==$row->kd_agama ? 'selected' : '').'>'.$row->nama.'</option>';
																				}
																			}
																		?>
																	</select>
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Jumlah Saudara</label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="jml_saudara" value="<?php echo isset($data6->jml_saudara) ? $data6->jml_saudara : ''?>">
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Kelas</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control" name="kelas">
                                                                        <option value="">- Pilih -</option>
																		<option value="A" <?php echo isset($data6->kelas) && $data6->kelas=="A" ? 'selected' : ''?>>A</option>
																		<option value="B" <?php echo isset($data6->kelas) && $data6->kelas=="B" ? 'selected' : ''?>>B</option>
																		<option value="C" <?php echo isset($data6->kelas) && $data6->kelas=="C" ? 'selected' : ''?>>C</option>
																		<option value="D" <?php echo isset($data6->kelas) && $data6->kelas=="D" ? 'selected' : ''?>>D</option>
																		<option value="E" <?php echo isset($data6->kelas) && $data6->kelas=="E" ? 'selected' : ''?>>E</option>
																		<option value="F" <?php echo isset($data6->kelas) && $data6->kelas=="F" ? 'selected' : ''?>>F</option>
																		<option value="G" <?php echo isset($data6->kelas) && $data6->kelas=="G" ? 'selected' : ''?>>G</option>
																		<option value="H" <?php echo isset($data6->kelas) && $data6->kelas=="H" ? 'selected' : ''?>>H</option>
																		<option value="I" <?php echo isset($data6->kelas) && $data6->kelas=="I" ? 'selected' : ''?>>I</option>
																		<option value="J" <?php echo isset($data6->kelas) && $data6->kelas=="J" ? 'selected' : ''?>>J</option>
																		<option value="K" <?php echo isset($data6->kelas) && $data6->kelas=="K" ? 'selected' : ''?>>K</option>
																		<option value="L" <?php echo isset($data6->kelas) && $data6->kelas=="L" ? 'selected' : ''?>>L</option>
																		<option value="M" <?php echo isset($data6->kelas) && $data6->kelas=="M" ? 'selected' : ''?>>M</option>
																		<option value="N" <?php echo isset($data6->kelas) && $data6->kelas=="N" ? 'selected' : ''?>>N</option>
																		<option value="O" <?php echo isset($data6->kelas) && $data6->kelas=="O" ? 'selected' : ''?>>O</option>
																		<option value="P" <?php echo isset($data6->kelas) && $data6->kelas=="P" ? 'selected' : ''?>>P</option>
																		<option value="Q" <?php echo isset($data6->kelas) && $data6->kelas=="Q" ? 'selected' : ''?>>Q</option>
																		<option value="R" <?php echo isset($data6->kelas) && $data6->kelas=="R" ? 'selected' : ''?>>R</option>
																		<option value="S" <?php echo isset($data6->kelas) && $data6->kelas=="S" ? 'selected' : ''?>>S</option>
																		<option value="T" <?php echo isset($data6->kelas) && $data6->kelas=="T" ? 'selected' : ''?>>T</option>
																		
                                                                    </select>
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Angkatan</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="angkatan" value="<?php echo isset($data6->angkatan) ? $data6->angkatan : (isset($data24) ? $data24 : '' )?>">
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <!-- end of col-6 -->
                                                    <div class="col-sm-6">
                                                        <div class="panel panel-primary">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Alamat Asal</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Provinsi</label>
                                                                <div class="col-sm-8">
                                                                    <select id="prop_asal" class="form-control" name="prop_asal" onchange="getlokasi('prop_asal','kota_asal','getKota','kec_asal')">
																		<option value=''>- Pilih Propinsi-</option>
																		<?php 
																			if (count($data4)>0) {
																				$i=0;
																				foreach ($data4 as $row) {
																						echo '<option value="'.$row->kd_propinsi.'"'.(isset($data6->prop_asal) && $data6->prop_asal==$row->kd_propinsi ? 'selected' : '').'>'.$row->nama_propinsi.'</option>';
																				}
																			}
																		?>
																	</select>
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Kabupaten</label>
                                                                <div class="col-sm-8">
                                                                   <select id="kota_asal" class="form-control" name="kab_asal" onchange="getlokasi('kota_asal','kec_asal','getKecamatan')">
																		<option value=''>- Pilih Kota-</option>
																		<?php 
																			if (count($data11)>0) {
																				$i=0;
																				foreach ($data11 as $row) {
																						echo '<option value="'.$row->kd_kota.'"'.(isset($data6->kab_asal) && $data6->kab_asal==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
																				}
																			}
																		?>
																	</select>
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Kecamatan</label>
                                                                <div class="col-sm-8">
                                                                    <select id="kec_asal" class="form-control" name="kec_asal">
																		<option value=''>- Pilih Kecamatan-</option>
																		<?php 
																			if (count($data12)>0) {
																				$i=0;
																				foreach ($data12 as $row) {
																						echo '<option value="'.$row->kd_kecamatan.'"'.(isset($data6->kec_asal) && $data6->kec_asal==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
																				}
																			}
																		?>
																	</select>
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Alamat</label>
                                                                <div class="col-sm-8">
                                                                    <textarea rows=3 type="text" class="form-control input-sm" name="alamat" id="alamat_asal" ><?php echo isset($data6->alamat_asal) ? $data6->alamat_asal : ''?></textarea>
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Telp.</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="telp" value="<?php echo isset($data6->telp) ? $data6->telp : ''?>">
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <!-- end of alamat asal -->
                                                        <div class="panel panel-primary">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Alamat Sekarang</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Kabupaten</label>
                                                                <div class="col-sm-8">
																	<select id="kota_sekarang" class="form-control" name="kab_skrg" onchange="getlokasi('kota_sekarang','kec_sekarang','getKecamatan')">
																		<option value=''>- Pilih Kota-</option>
																		<?php 
																			if (count($data5)>0) {
																				$i=0;
																				foreach ($data5 as $row) {
																						echo '<option value="'.$row->kd_kota.'" '.(isset($data6->kab_skrg) && $data6->kab_skrg==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
																				}
																			}
																		?>
																	</select>
																<p class="help-block"></p>
															</div>	
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Kecamatan</label>
                                                                <div class="col-sm-8">
                                                                   <select id="kec_sekarang" class="form-control" name="kec_skrg">
																		<option value=''>- Pilih Kecamatan-</option>
																		<?php 
																			if (count($data13)>0) {
																				$i=0;
																				foreach ($data13 as $row) {
																						echo '<option value="'.$row->kd_kecamatan.'" '.(isset($data6->kec_skrg) && $data6->kec_skrg==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
																				}
																			}
																		?>
																	</select>
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm">
                                                                <label class="control-label col-sm-4 text-left">Alamat</label>
                                                                <div class="col-sm-8">
                                                                    <textarea rows=3 type="text" class="form-control input-sm" name="alamat_skrg" id="alamat_skrg" ><?php echo isset($data6->alamat_skrg) ? $data6->alamat_skrg : ''?></textarea>
                                                                    <p class="help-block"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div role="tabpanel" class="tab-pane fade" id="pendidikan" aria-labelledby="pendidikan-tab"> 
                                        <div class="panel panel-primary">
                                        <div class="panel-body">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Pendidikan</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Prov. Sekolah</label>
                                                    <div class="col-sm-5">
                                                        <select id="prop_sekolah" class="form-control" name="prop_sekolah" onchange="getlokasi('prop_sekolah','kota_sekolah','getKota','kec_sekolah','kd_sekolah')">
															<option value=''>- Pilih Propinsi-</option>
															<?php 
																if (count($data4)>0) {
																	$i=0;
																	foreach ($data4 as $row) {
																			echo '<option value="'.$row->kd_propinsi.'" '.(isset($data6->prop_sekolah) && $data6->prop_sekolah==$row->kd_propinsi ? 'selected' : '').'>'.$row->nama_propinsi.'</option>';
																	}
																}
															?>
														</select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Kota Sekolah</label>
                                                    <div class="col-sm-5">
														<select id="kota_sekolah" class="form-control" name="kota_sekolah" onchange="getlokasi('kota_sekolah','kec_sekolah','getKecamatan','kd_sekolah')">
															<option value=''>- Pilih Kota-</option>
															<?php 
																if (count($data7)>0) {
																	$i=0;
																	foreach ($data7 as $row) {
																			echo '<option value="'.$row->kd_kota.'" '.(isset($data6->kota_sekolah) && $data6->kota_sekolah==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
																	}
																}
															?>
														</select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
												<div class="form-group form-group-sm">
													<label class="control-label col-sm-3 text-left">Kecamatan</label>
													<div class="col-sm-5">
														<select id="kec_sekolah" class="form-control" name="kec_sekolah" onchange="getlokasi('kec_sekolah','kd_sekolah','getSekolah')">
															<option value=''>- Pilih Kecamatan-</option>
															<?php 
																if (count($data8)>0) {
																	$i=0;
																	foreach ($data8 as $row) {
																			echo '<option value="'.$row->kd_kecamatan.'" '.(isset($data6->kec_sekolah) && $data6->kec_sekolah==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
																	}
																}
															?>
														</select>
														<p class="help-block"></p>
													</div> 
												</div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Sekolah</label>
                                                    <div class="col-sm-6">
														<div class="input-group">
															<div id="car_sekolah">
																<select id="kd_sekolah" class="form-control" name="kd_sekolah" onchange="mod_tbh_sklh(this.value)">
																	<option value=''>- Pilih Sekolah-</option>
																	<?php 
																		if (count($data9)>0) {
																			$i=0;
																			foreach ($data9 as $row) {
																					echo '<option value="'.$row->kd_sekolah.'" '.(isset($data6->kd_sekolah) && $data6->kd_sekolah==$row->kd_sekolah ? 'selected' : '').'>'.$row->nama_sekolah.'</option>';
																			}
																		}
																	?>
																</select>
															</div>
															<a id="btn_carisekolah" class="input-group-btn btn btn-success btn-sm" onclick="btn_carisekolah()" value="0"> <i class="fa fa-search"></i> </a>
															<a style="display:none;" id="btn_tbhsekolah" class="input-group-btn btn btn-primary btn-sm" onclick="mod_tbh_sklh('00000000')" value="0"> <i class="fa fa-plus"></i> </a>
														</div>
														<div id="showcarisekolah" style="width:400px !important;"class="display"></div>
														<p class="help-block"></p>
													</div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Jurusan</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control input-sm" name="jurusan" id="jurusan" value="<?php echo isset($data6->jurusan) ? $data6->jurusan : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Danem/IPK</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control input-sm" name="rerata_uan" id="rerata_uan" value="<?php echo isset($data6->rerata_uan) ? $data6->rerata_uan : ''?> " >
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Tahun Kelulusan</label>
                                                    <div class="col-sm-3">
                                                        <select id="lulus" class="form-control" name="thn_lulus">
															<option value="0">- pilih -</option>
															<?php 
																for($a=2009;$a<=date('Y');$a++){
																	echo '<option value="'.$a.'" '.(isset($data6->thn_lulus) && $data6->thn_lulus==$a ? 'selected' : '').'>'.$a.'</option>';
																}
															?>
														</select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">No Ijazah</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control input-sm" name="no_sttb" id="no_sttb" value="<?php echo isset($data6->no_sttb) ? $data6->no_sttb : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Pekerjaan</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Nama Instansi</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="instansi" class="form-control" value="<?php echo isset($data6->instansi) ? $data6->instansi : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Pangkat/Golongan</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="gol" class="form-control" value="<?php echo isset($data6->gol) ? $data6->gol : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Jabatan</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="jabatan" class="form-control" value="<?php echo isset($data6->jabatan) ? $data6->jabatan : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        </div>
                                    </div> 
                                    <div role="tabpanel" class="tab-pane fade" id="ayah" aria-labelledby="ayah-tab"> 
                                        <div class="panel panel-primary">
                                            <div class="panel-body">
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Nama</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="nama_ayah" class="form-control" value="<?php echo isset($data6->nama_ayah) ? $data6->nama_ayah : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Provinsi</label>
                                                    <div class="col-sm-5">
                                                        <select id="prop_ayah" class="form-control" name="prop_ayah" onchange="getlokasi('prop_ayah','kab_ayah','getKota','kec_ayah')">
                                                            <option value="">- Pilih -</option>
														<?php 
															if (count($data4)>0) {
																$i=0;
																foreach ($data4 as $row) {
																		echo '<option value="'.$row->kd_propinsi.'"'.(isset($data6->prop_ayah) && $data6->prop_ayah==$row->kd_propinsi ? 'selected' : '').'>'.$row->nama_propinsi.'</option>';
																}
															}
														?>																
                                                        </select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Kabupaten</label>
                                                    <div class="col-sm-5">
                                                        <select id="kab_ayah" class="form-control" name="kab_ayah" onchange="getlokasi('kab_ayah','kec_ayah','getKecamatan')">
                                                            <option value="">- Pilih -</option>
														<?php 
															if (count($data16)>0) {
																$i=0;
																foreach ($data16 as $row) {
																		echo '<option value="'.$row->kd_kota.'" '.(isset($data6->kab_ayah) && $data6->kab_ayah==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
																}
															}
														?>																	
                                                        </select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Kecamatan</label>
                                                    <div class="col-sm-5">
                                                        <select id="kec_ayah" class="form-control" name="kec_ayah" >														
														<?php 
															if (count($data17)>0) {
																$i=0;
																foreach ($data17 as $row) {
																		echo '<option value="'.$row->kd_kecamatan.'" '.(isset($data6->kec_ayah) && $data6->kec_ayah==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
																}
															}
														?>														
														</select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Alamat</label>
                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" name="alamat_ayah" rows="3"><?php echo isset($data6->alamat_ayah) ? $data6->alamat_ayah : ''?></textarea>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Pendidikan</label>
                                                    <div class="col-sm-5">
                                                        <select class="form-control" name="pendidikan_ayah">
                                                            <option value="">- Pilih -</option>
															<option value="SD"  <?php echo isset($data6->pendidikan_ayah) && $data6->pendidikan_ayah=="SD" ? 'selected' : ''?>>SD</option>
															<option value="SMP" <?php echo isset($data6->pendidikan_ayah) && $data6->pendidikan_ayah=="SMP" ? 'selected' : ''?>>SMP</option>
															<option value="SMA" <?php echo isset($data6->pendidikan_ayah) && $data6->pendidikan_ayah=="SMA" ? 'selected' : ''?>>SMA</option>
															<option value="PT"  <?php echo isset($data6->pendidikan_ayah) && $data6->pendidikan_ayah=="PT" ? 'selected' : ''?>>P.Tinggi</option>
                                                        </select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Pangkat/Golongan</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="pekerjaan_ayah" class="form-control" value="<?php echo isset($data6->pekerjaan_ayah) ? $data6->pekerjaan_ayah : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Instansi</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="instansi_ayah" class="form-control" value="<?php echo isset($data6->instansi_ayah) ? $data6->instansi_ayah : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Jabatan</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="jabatan_ayah" class="form-control">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>												
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Status</label>
                                                    <div class="col-sm-7">
                                                        <div class="radio-inline">
                                                            <label class="radio input-sm">
                                                                <input type="radio" name="hidup_ayah" value="Y" <?php echo isset($data6->hidup_ayah) && $data6->hidup_ayah=='Y' ? 'checked' : ''?>>Masih Hidup
                                                            </label>
                                                        </div>
                                                        <div class="radio-inline">
                                                            <label class="radio input-sm">
                                                                <input type="radio" name="hidup_ayah" value="T" <?php echo isset($data6->hidup_ayah) && $data6->hidup_ayah=='T' ? 'checked' : ''?>>Sudah Meninggal
                                                            </label>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div role="tabpanel" class="tab-pane fade" id="ibu" aria-labelledby="ibu-tab"> 
                                        <div class="panel panel-primary">
                                            <div class="panel-body">
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Nama</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="nama_ibu" class="form-control" value="<?php echo isset($data6->nama_ibu) ? $data6->nama_ibu : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Provinsi</label>
                                                    <div class="col-sm-5">
                                                        <select id="prop_ibu" class="form-control" name="prop_ibu" onchange="getlokasi('prop_ibu','kab_ibu','getKota')">
                                                            <option value="">- Pilih -</option>
														<?php 
															if (count($data4)>0) {
																$i=0;
																foreach ($data4 as $row) {
																		echo '<option value="'.$row->kd_propinsi.'"'.(isset($data6->prop_ibu) && $data6->prop_ibu==$row->kd_propinsi ? 'selected' : '').'>'.$row->nama_propinsi.'</option>';
																}
															}
														?>															
                                                        </select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Kabupaten</label>
                                                    <div class="col-sm-5">
                                                        <select id="kab_ibu" class="form-control" name="kab_ibu" onchange="getlokasi('kab_ibu','kec_ibu','getKecamatan')">
                                                            <option value="">- Pilih -</option>
														<?php 
															if (count($data18)>0) {
																$i=0;
																foreach ($data18 as $row) {
																		echo '<option value="'.$row->kd_kota.'" '.(isset($data6->kab_ibu) && $data6->kab_ibu==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
																}
															}
														?>																
                                                        </select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Kecamatan</label>
                                                    <div class="col-sm-5">
                                                        <select id="kec_ibu" class="form-control" name="kec_ibu" >														
														<?php 
															if (count($data19)>0) {
																$i=0;
																foreach ($data19 as $row) {
																		echo '<option value="'.$row->kd_kecamatan.'" '.(isset($data6->kec_ibu) && $data6->kec_ibu==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
																}
															}
														?>														
														</select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Alamat</label>
                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" name="alamat_ibu" rows="3"><?php echo isset($data6->alamat_ibu) ? $data6->alamat_ibu : ''?></textarea>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Pendidikan</label>
                                                    <div class="col-sm-5">
                                                        <select class="form-control" name="pendidikan_ibu">
                                                            <option value="">- Pilih -</option>
															<option value="SD"  <?php echo isset($data6->pendidikan_ibu) && $data6->pendidikan_ibu=="SD" ? 'selected' : ''?>>SD</option>
															<option value="SMP" <?php echo isset($data6->pendidikan_ibu) && $data6->pendidikan_ibu=="SMP" ? 'selected' : ''?>>SMP</option>
															<option value="SMA" <?php echo isset($data6->pendidikan_ibu) && $data6->pendidikan_ibu=="SMA" ? 'selected' : ''?>>SMA</option>
															<option value="PT"  <?php echo isset($data6->pendidikan_ibu) && $data6->pendidikan_ibu=="PT" ? 'selected' : ''?>>P.Tinggi</option>															
                                                        </select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Pangkat/Golongan</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="pekerjaan_ibu" class="form-control" value="<?php echo isset($data6->pekerjaan_ibu) ? $data6->pekerjaan_ibu : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Instansi</label>
                                                    <div class="col-sm-5">
													<input type="text" name="instansi_ibu" class="form-control" value="<?php echo isset($data6->instansi_ibu) ? $data6->instansi_ibu : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Jabatan</label>
                                                    <div class="col-sm-5">
													<input type="text" name="jabatan_ibu" class="form-control" >
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>												
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Status</label>
                                                    <div class="col-sm-7">
                                                        <div class="radio-inline">
                                                            <label class="radio input-sm">
                                                                <input type="radio" name="hidup_ibu" value="Y" <?php echo isset($data6->hidup_ibu) && $data6->hidup_ibu=='Y' ? 'checked' : ''?>>Masih Hidup
                                                            </label>
                                                        </div>
                                                        <div class="radio-inline">
                                                            <label class="radio input-sm">
                                                                <input type="radio" name="hidup_ibu" value="T" <?php echo isset($data6->hidup_ibu) && $data6->hidup_ibu=='T' ? 'checked' : ''?>>Sudah Meninggal
                                                            </label>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div role="tabpanel" class="tab-pane fade" id="wali" aria-labelledby="wali-tab"> 
                                        <div class="panel panel-primary">
                                            <div class="panel-body">
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Nama</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="nama_wali" class="form-control" value="<?php echo isset($data6->nama_wali) ? $data6->nama_wali : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Provinsi</label>
                                                    <div class="col-sm-5">
                                                        <select id="prop_wali" class="form-control" name="prop_wali" onchange="getlokasi('prop_wali','kab_wali','getKota')">
                                                            <option value="">- Pilih -</option>
														<?php 
															if (count($data4)>0) {
																$i=0;
																foreach ($data4 as $row) {
																		echo '<option value="'.$row->kd_propinsi.'"'.(isset($data6->prop_wali) && $data6->prop_wali==$row->kd_propinsi ? 'selected' : '').'>'.$row->nama_propinsi.'</option>';
																}
															}
														?>																	
                                                        </select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Kabupaten</label>
                                                    <div class="col-sm-5">
                                                        <select id="kab_wali" class="form-control" name="kab_wali" onchange="getlokasi('kab_wali','kec_wali','getKecamatan')">
                                                            <option value="">- Pilih -</option>
														<?php 
															if (count($data20)>0) {
																$i=0;
																foreach ($data20 as $row) {
																		echo '<option value="'.$row->kd_kota.'" '.(isset($data6->kab_wali) && $data6->kab_wali==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
																}
															}
														?>																
                                                        </select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Kecamatan</label>
                                                    <div class="col-sm-5">
													<select id="kec_wali" class="form-control" name="kec_wali">                                                        
													<option value="">- Pilih -</option>
														<?php 
															if (count($data21)>0) {
																$i=0;
																foreach ($data21 as $row) {
																		echo '<option value="'.$row->kd_kecamatan.'" '.(isset($data6->kec_wali) && $data6->kec_wali==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
																}
															}
														?>															
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Alamat</label>
                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" name="alamat_wali" rows="3"><?php echo isset($data6->alamat_wali) ? $data6->alamat_wali : ''?></textarea>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Pendidikan</label>
                                                    <div class="col-sm-5">
                                                        <select class="form-control" name="pendidikan_wali">
                                                            <option value="">- Pilih -</option>
															<option value="SD"  <?php echo isset($data6->pendidikan_wali) && $data6->pendidikan_wali=="SD" ? 'selected' : ''?>>SD</option>
															<option value="SMP" <?php echo isset($data6->pendidikan_wali) && $data6->pendidikan_wali=="SMP" ? 'selected' : ''?>>SMP</option>
															<option value="SMA" <?php echo isset($data6->pendidikan_wali) && $data6->pendidikan_wali=="SMA" ? 'selected' : ''?>>SMA</option>
															<option value="PT"  <?php echo isset($data6->pendidikan_wali) && $data6->pendidikan_wali=="PT" ? 'selected' : ''?>>P.Tinggi</option>																
                                                        </select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Pangkat/Golongan</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="pekerjaan_wali" class="form-control" value="<?php echo isset($data6->pekerjaan_wali) ? $data6->pekerjaan_wali : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Instansi</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="instansi_wali" class="form-control" value="<?php echo isset($data6->instansi_wali) ? $data6->instansi_wali : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Jabatan</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="jabatan_wali" class="form-control" >
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>												
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Status</label>
                                                    <div class="col-sm-7">
                                                        <div class="radio-inline">
                                                            <label class="radio input-sm">
                                                                <input type="radio" name="hidup_wali" value="Y" <?php echo isset($data6->hidup_wali) && $data6->hidup_wali=='Y' ? 'checked' : ''?>>Masih Hidup
                                                            </label>
                                                        </div>
                                                        <div class="radio-inline">
                                                            <label class="radio input-sm">
                                                                <input type="radio" name="hidup_wali" value="T" <?php echo isset($data6->hidup_wali) && $data6->hidup_wali=='T' ? 'checked' : ''?>>Sudah Meninggal
                                                            </label>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div role="tabpanel" class="tab-pane fade" id="sutri" aria-labelledby="sutri-tab"> 
                                        <div class="panel panel-primary">
                                            <div class="panel-body">
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Nama</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="nama_sutri" class="form-control" value="<?php echo isset($data6->nama_sutri) ? $data6->nama_sutri : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Provinsi</label>
                                                    <div class="col-sm-5">
                                                        <select id="prop_sutri" class="form-control" name="prop_sutri" onchange="getlokasi('prop_sutri','kab_sutri','getKota')">
                                                            <option value="">- Pilih -</option>
														<?php 
															if (count($data4)>0) {
																$i=0;
																foreach ($data4 as $row) {
																		echo '<option value="'.$row->kd_propinsi.'"'.(isset($data6->prop_sutri) && $data6->prop_sutri==$row->kd_propinsi ? 'selected' : '').'>'.$row->nama_propinsi.'</option>';
																}
															}
														?>																	
                                                        </select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Kabupaten</label>
                                                    <div class="col-sm-5">
                                                        <select id="kab_sutri" class="form-control" name="kab_sutri" onchange="getlokasi('kab_sutri','kec_sutri','getKecamatan')">
                                                            <option value="">- Pilih -</option>
														<?php 
															if (count($data22)>0) {
																$i=0;
																foreach ($data22 as $row) {
																		echo '<option value="'.$row->kd_kota.'" '.(isset($data6->kab_sutri) && $data6->kab_sutri==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
																}
															}
														?>																
                                                        </select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Kecamatan</label>
                                                    <div class="col-sm-5">
                                                        <select id="kec_sutri" class="form-control" name="kec_sutri">
                                                            <option value="">- Pilih -</option>
														<?php 
															if (count($data23)>0) {
																$i=0;
																foreach ($data23 as $row) {
																		echo '<option value="'.$row->kd_kecamatan.'" '.(isset($data6->kec_sutri) && $data6->kec_sutri==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
																}
															}
														?>																
                                                        </select>                                                        
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Alamat</label>
                                                    <div class="col-sm-6">
                                                        <textarea class="form-control" name="alamat_sutri" rows="3"><?php echo isset($data6->alamat_sutri) ? $data6->alamat_sutri : ''?></textarea>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Pendidikan</label>
                                                    <div class="col-sm-5">
                                                        <select class="form-control" name="pendidikan_sutri">
                                                            <option value="">- Pilih -</option>                                                            
															<option value="SD"  <?php echo isset($data6->pendidikan_sutri) && $data6->pendidikan_sutri=="SD" ? 'selected' : ''?>>SD</option>
															<option value="SMP" <?php echo isset($data6->pendidikan_sutri) && $data6->pendidikan_sutri=="SMP" ? 'selected' : ''?>>SMP</option>
															<option value="SMA" <?php echo isset($data6->pendidikan_sutri) && $data6->pendidikan_sutri=="SMA" ? 'selected' : ''?>>SMA</option>
															<option value="PT"  <?php echo isset($data6->pendidikan_sutri) && $data6->pendidikan_sutri=="PT" ? 'selected' : ''?>>P.Tinggi</option>																
                                                        </select>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Pangkat/Golongan</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="pekerjaan_sutri" class="form-control" value="<?php echo isset($data6->pekerjaan_sutri) ? $data6->pekerjaan_sutri : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Instansi</label>
                                                    <div class="col-sm-5">
															<input type="text" name="instansi_sutri" class="form-control" value="<?php echo isset($data6->instansi_sutri) ? $data6->instansi_sutri : ''?>">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Jabatan</label>
                                                    <div class="col-sm-5">
															<input type="text" name="jabatan_sutri" class="form-control" >
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>												
                                                <div class="form-group form-group-sm">
                                                    <label class="control-label col-sm-3 text-left">Status</label>
                                                    <div class="col-sm-7">
                                                        <div class="radio-inline">
                                                            <label class="radio input-sm">
                                                                <input type="radio" name="hidup_sutri" value="Y" <?php echo isset($data6->hidup_sutri) && $data6->hidup_sutri=='Y' ? 'checked' : ''?>>Masih Hidup
                                                            </label>
                                                        </div>
                                                        <div class="radio-inline">
                                                            <label class="radio input-sm">
                                                                <input type="radio" name="hidup_sutri" value="T" <?php echo isset($data6->hidup_sutri) && $data6->hidup_sutri=='T' ? 'checked' : ''?>>Sudah Meninggal
                                                            </label>
                                                        </div>
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
								<p class="text-right">
									<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
								</p>
                            </div>
						</form>
                    </div>
						
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="nonreg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
	  <?php echo form_open('',array('class'=>'form-horizontal')) ?>
        <div class="modal-header" style="background-color:#d2322d; border-radius: 6px 6px 0 0; color: #fff;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" style="color:#fff">Pendaftaran Non Reguler</h4>
        </div>
        <div class="modal-body">
			<div class="form-group form-group-sm valid required">
				<label class="control-label col-sm-3">Jenis pendaftaran</label>
				<div class="col-sm-9">
					<select class="form-control input-sm" id="jalur1" name="stat_daftar1">
					<?php 
					if (count($data1)>0) {
						$i=0;
						foreach ($data1 as $row) {
								echo '<option value="'.$row->prg_id.'">'.$row->prg_nama.'</option>';
						}
					}
					?>
					</select>
					<p class="help-block"></p>
				</div>
			</div>
			<div class="form-group form-group-sm valid required">
				<label class="control-label col-sm-3">Nama</label>
				<div class="col-sm-9">
					<input type="text" class="form-control input-sm" name="nama1" id="nama1" >
					<p class="help-block"></p>
				</div>
			</div>
			<div class="form-group form-group-sm valid required">
				<label class="control-label col-sm-3">Tanggal Pengumuman</label>
				<div class="col-sm-9 ">
					<div class="input-group">
						<input id="tgl_pengumuman"type="text" class="form-control input-sm date" data-date-format="DD-MM-YYYY" name="tgl_peng" value="<?php echo (isset($data6->tgl_lahir) && $data6->tgl_lahir!="0000-00-00") ? date("d-m-Y",strtotime($data6->tgl_lahir)) : ''?>">
						 <span class="input-group-addon input-sm">
							<span class="fa fa-calendar"></span>
						</span>
					</div>
					<p class="help-block-2">DD-MM-YYYY</p>
					<p class="help-block"></p>
				</div>
			</div>
			<div class="form-group form-group-sm valid required">
				<label class="control-label col-sm-3">Diterima di Prodi</label>
				<div class="col-sm-5">
					<select id="prodi1"class="form-control" name="prodi1" onchange="getnimbyprodi(this.value)">
					<option value=''>- Pilih Program Studi -</option>
					<?php 
					if (isset($data2)) {
						$i=0;
						foreach ($data2 as $row) { ?>
						<option value="<?php echo $row->kd_proditawar ?>"><?php echo $row->prodi ?></option>
					<?php }} ?>
					</select>
					<p class="help-block"></p>
				</div>
			</div>
            <div class="form-group form-group-sm">
				<label class="control-label col-sm-3">NIM :</label>
				<div class="col-sm-5">
					<input id="getnim1"type="text" class="form-control" name="nim1" value="" onkeyup="ceknim(1)" autocomplete="off">
					<p id="responnim1" class="help-block2" ></p>
			   </div>
            </div>
			<hr>
			<div class="form-group form-group-sm valid required">
				<label class="control-label col-sm-3">Potongan SPA :</label>
				<div class="col-sm-6">
					<input id="potspa" type="text" class="form-control currency" value="" placeholder="masukkan angka " autocomplete="off">
					<p class="help-block"></p>
					<p class="help-block2" >Catatan :Jika tidak ada potongan tuliskan 0</p>					
			   </div>
            </div>
        </div>
        <div class="modal-footer" style="background-color:#d2322d; border-radius: 0 0 6px 6px; color: #fff;margin-top:0;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" onclick="simpan(1)">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="gennim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <?php echo form_open('') ?>
        <div class="modal-header" style="background-color:#d2322d; border-radius: 6px 6px 0 0; color: #fff;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Generate NIM</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label class="control-label">NIM :</label>
              <input id="getnim2"type="text" class="form-control" name="nim" value="<?php echo isset($data15->next_nim) ? $data15->next_nim : ''  ?>" onkeyup="ceknim(2)" autocomplete="off">
			   <input id="getiddaftar" type="hidden" class="form-control" name="id_daftar" value="<?php echo isset($data6->iddaftar) ? $data6->iddaftar : ''  ?>">
            </div>
			<div id="responnim2" class="form-group text-center" ></div>
        </div>
        <div class="modal-footer" style="background-color:#d2322d; border-radius: 0 0 6px 6px; color: #fff;margin-top:0;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" onclick="simpan(2)">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="tbh_sklh" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
	<?php echo form_open('') ?>
        <div class="modal-header" style="background-color:#d2322d; border-radius: 6px 6px 0 0; color: #fff;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" style="color:#fff">Tambah Sekolah</h4>
        </div>
        <div class="modal-body">
            <div class="form-group valid required">
              <label class="control-label">Nama Sekolah :</label>
              <input id="nm_sklh" type="text" class="form-control" name="nm_sklh" value="" autocomplete="off">
            </div>
			<div class="form-group valid required">
              <label class="control-label">Status Sekolah :</label>
              <select id="stt_sklh" type="text" class="form-control" name="stt_sklh" >
				<option value="">-Pilih-</option>
				<option value="Negeri">Negeri</option>
				<option value="Swasta">Swasta</option>
			  </select>
            </div>
			<div class="form-group form-group-sm valid required">
				<label class="control-label ">Propinsi</label>
				<div class="">
					<select id="" class="form-control prop_sekolah" name="prop_sekolah" onchange="getlokasi2('.prop_sekolah','.kota_sekolah','getKota','.kec_sekolah','.kd_sekolah')">
						<option value=''>- Pilih Propinsi-</option>
						<?php 
							if (count($data4)>0) {
								$i=0;
								foreach ($data4 as $row) {
										echo '<option value="'.$row->kd_propinsi.'">'.$row->nama_propinsi.'</option>';
								}
							}
						?>
					</select>
					<p class="help-block"></p>
				</div>
			</div>
			<div class="form-group form-group-sm valid required">
				<label class="control-label ">Kabupaten</label>
				<div class="">
					<select id="" class="form-control kota_sekolah" name="kota_sekolah" onchange="getlokasi2('.kota_sekolah','.kec_sekolah','getKecamatan','.kd_sekolah')">
						<option value=''>- Pilih Kota-</option>
						<?php 
							if (count($data7)>0) {
								$i=0;
								foreach ($data7 as $row) {
										echo '<option value="'.$row->kd_kota.'">'.$row->nama_kota.'</option>';
								}
							}
						?>
					</select>
					<p class="help-block"></p>
				</div>
			</div>
			<div class="form-group form-group-sm valid required">
				<label class="control-label ">Kecamatan</label>
				<div class="">
					<select id="" class="form-control kec_sekolah" name="kec_sekolah" onchange="getlokasi2('.kec_sekolah','.kd_sekolah','getSekolah')">
						<option value=''>- Pilih Kecamatan-</option>
						<?php 
							if (count($data8)>0) {
								$i=0;
								foreach ($data8 as $row) {
										echo '<option value="'.$row->kd_kecamatan.'">'.$row->nama_kecamatan.'</option>';
								}
							}
						?>
					</select>
					<p class="help-block"></p>
				</div>
			</div>
			<div class="form-group valid required">
              <label class="control-label">Alamat Sekolah :</label>
              <input id="almt_sklh" type="text" class="form-control" name="almt_sklh" value="" autocomplete="off">
            </div>
        </div>
        <div class="modal-footer" style="background-color:#d2322d; border-radius: 0 0 6px 6px; color: #fff;margin-top:0;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" onclick="simpansek()">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
	var sep = '.';
	$(document).ready(function() {
		$('.currency').on('keyup', formatCurrency);
	});
	function formatCurrency()
	{
		var f = this.value.replace(/\D/g, '');
		var l = f.length;
		var g = l % 3;
		if(isInt(f) && f>999){
			if (g == 0 )
				this.value = thousands(f);
			else
			{
				var lead = f.substring(0, g);
					f = f.substring(g, l);
				this.value = lead + sep + thousands(f);
			}
		}else if(isInt(f) && f<1000) 
			this.value = f;
		else
			this.value= '';
	}

	// Function that commatizes the thousands
	function thousands(s)
	{
		// Match groups of 3 decimals
		var t = s.match(/(\d{3})/g);
		return t.join(sep) ;		
	}
	function isInt(n) {	
	   return n>=0 ? n % 1 === 0 : false;
	}
</script>
<script type="text/javascript">
	<?php  
	$showmodal=(isset($data6->nim) && $data6->nim!=null) ? false : ((isset($data6) && $data6!=null)  ? true :false);
	if($showmodal==true)  : ?>
	$('#gennim').modal();
	<?php endif; ?>
	window.onload = function() {
		ceknim(2);
		jumlah_syarat();
	};
	
	function mod_nonreg(){
		$("#nonreg").modal();
	}
	function getnimbyprodi(nil){
		if(nil!='' || nil!=null || nil>0){
			$.ajax({
				  type: "POST",
				  url: "<?php echo base_url().index_page();?>admin/ajax/getnimbyprodi",
				  data:{<?php echo $csrf ?>,'id':nil },
				  dataType:"text",
				  success: function(data){
						$("#getnim1").val(data);
						ceknim(1);
						
			  },
			  error:function(XMLHttpRequest){
				  alert(XMLHttpRequest.responseText);
			  }
			});
		}
		
	}
	function ceknim(id){
		var nim=$("#getnim"+id).val();
		if (nim!="") {
		  $.ajax({
				  type: "POST",
				  url: "<?php echo base_url().index_page();?>admin/ajax/cekNim",
				  data:{<?php echo $csrf ?>,'id':nim },
				  dataType:"text",
				  success: function(data){
					if(data==nim)
						$("#responnim"+id).html('<span style="color:red;">nim <b>'+data+'</b> sudah digunakan. Silahkan mencoba nim <b>'+(Number(data)+1)+'</b></span>');
					else
						$("#responnim"+id).html('<span style="color:green;">nim ini bisa digunakan</span>');
			  },
			  error:function(XMLHttpRequest){
				  alert(XMLHttpRequest.responseText);
			  }
		  })
		};
	}
	function mod_tbh_sklh(nil) {
		if(nil=="00000000")
			$("#tbh_sklh").modal();
	};
	function simpansek(){
		var nm_sklh=$("#nm_sklh").val();
		var stt_sklh=$("#stt_sklh").val();
		var almt_sklh=$("#almt_sklh").val();
		var kec_sklh=$(".kec_sekolah").val();
		if (nm_sklh!="" && kec_sklh!="") {
		  $.ajax({
				  type: "POST",
				  url: "<?php echo base_url().index_page();?>admin/ajax/inSekolah",
				  data:{<?php echo $csrf ?>,'nm_sklh' : nm_sklh,'stt_sklh' : stt_sklh,'almt_sklh':almt_sklh,'kec_sklh':kec_sklh },
				  dataType:"text",
				  success: function(data){
					if(data!="gagal"){
						$("#kd_sekolah").append('<option value="'+data+'">'+nm_sklh+'</option>');
						$("#tbh_sklh").modal("hide");
					}			
			  },
			  error:function(XMLHttpRequest){
				  alert(XMLHttpRequest.responseText);
			  }
		  })
		};
	};
	function simpan(id){
		var jalur=$("#jalur"+id).val();
		var nama=$("#nama"+id).val();
		var prodi=$("#prodi"+id).val();
		var nim=$("#getnim"+id).val();
		if (valid('#nonreg') && id==1 && nama!="" && jalur!="" && prodi!="") {
			var pot=$("#potspa").val();
			var tgl=$("#tgl_pengumuman").val();
			if(pot==null)
				pot=0;
			$.ajax({
				  type: "POST",
				  url: "<?php echo base_url().index_page();?>admin/ajax/inNonReg",
				  data:{<?php echo $csrf ?>,'nama':nama,'jalur':jalur,'prodi':prodi,'nim':nim,'spapot':pot,'tgl_pengumuman':tgl },
				  dataType:"text",
				  success: function(data){
					if(data!="gagal")
						window.location.href="<?php echo base_url().index_page().'admin/pendaftaran/her_registrasi/' ;?>"+data;
			  },
			  error:function(XMLHttpRequest){
				  alert(XMLHttpRequest.responseText);
			  }
		  })
		}
		else if(id==2){
			var nim=$("#getnim"+id).val();
			var iddaftar=$("#getiddaftar").val();
			if (nim!="") {
			  $.ajax({
					  type: "POST",
					  url: "<?php echo base_url().index_page();?>admin/ajax/inNim",
					  data:{<?php echo $csrf ?>,'nim':nim,'iddaftar':iddaftar},
					  dataType:"text",
					  success: function(data){
						if(data=="gagal")
							$("#responnim"+id).html('<span style="color:red;">nim <b>'+nim+'</b> sudah digunakan. Silahkan mencoba nim <b>'+(Number(nim)+1)+'</b></span>');
						else
							window.location.href="<?php echo base_url().index_page().'admin/pendaftaran/her_registrasi/' ;?>"+iddaftar;
				  },
				  error:function(XMLHttpRequest){
					  alert(XMLHttpRequest.responseText);
				  }
			  })
			}
		}
	};
    $(function () {
        $('.date').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },pickTime: false

        });
    });

	$('#all_check').click(function(){
		$(".set_syarat").prop('checked',true);
		jml1 = $(".mnt_syarat");
		jml2 = $(".jml");
		jum = 0;
		for(i=0; i<jml1.length; i++){
			$("#jum_syarat"+i).val($("#jsyarat"+i).html());
		}
	});
	$('#all_uncheck').click(function(){
			$(".set_syarat").prop('checked',false);
			$(".jml").val('');
	});
	function syarat(id,jum,aksi){
		if(aksi==true && id!=null && jum!=null){
			$("#set_syarat"+id).prop('checked',true);
		}
		else if(aksi==false && id!=null && jum!=null){
			if($("#set_syarat"+id).is(':checked'))
				$("#jum_syarat"+id).val(jum);
			else
				$("#jum_syarat"+id).val(null);
		}
	}
	function jumlah_syarat(){
		jml = $(".jml");
		jum = 0;
		for(i=0; i<jml.length; i++){
			jum += ($(jml[i]).val() !='') ? parseInt($(jml[i]).val()) : 0 ;
		}
		$("input[name=jml_kelengkapan]").val(jum);
	}
	function lompat(e){
		if(e.keyCode==13){
			window.location.href="<?php echo base_url().index_page().'admin/pendaftaran/her_registrasi/';?>"+$("#searchbox").val();
			return false;
		}
	}
	function cari(){
		var nilai=$('#searchbox').val();
		if(nilai!=''){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/ajax/getCariHer",
				data: {<?php echo $csrf ?>,'key':nilai},
				cache: false,
				success: function(data)
				{
					if(data==nilai)
						window.location.href="<?php echo base_url().index_page().'admin/pendaftaran/her_registrasi/'?>"+nilai;
					else
						$("#display").html(data).show();	
					
				}
			});
		}
		$("#display").hide();		
	};
	function btn_carisekolah(){
		btn=$("#btn_carisekolah").val();
		if(btn==0){
			$("#car_sekolah").html('<input type="text" id="nm_sekolah" class="form-control input-sm searchbox" name="nm_sekolah" onkeyup="carisekolah()" autocomplete="off"><input type="hidden" id="kd_sekolah" class="form-control input-sm" name="kd_sekolah">');
			$("#btn_carisekolah").val(1);
			$("#btn_tbhsekolah").show();
			$("#prop_sekolah").prop("disabled",true);
			$("#kota_sekolah").prop("disabled",true);
			$("#kec_sekolah").prop("disabled",true);
		}
		else{
			sel ='<select id="kd_sekolah" class="form-control" name="kd_sekolah" onchange="mod_tbh_sklh()">';
			sel+='<option value="">- Pilih Sekolah-</option>';
			sel+=getlokasi('kec_sekolah','kd_sekolah','getSekolah',null,null,'<?php echo isset($data6->kd_sekolah) ? $data6->kd_sekolah : ""?>');
			sel+='</select>';
			$("#car_sekolah").html(sel);
			$("#btn_carisekolah").val(0);
			$("#btn_tbhsekolah").hide();
			$("#prop_sekolah").prop("disabled",false);
			$("#kota_sekolah").prop("disabled",false);
			$("#kec_sekolah").prop("disabled",false);
		}
		$("#showcarisekolah").html(null);
				
	}
	function carisekolah(){
		var nilai=$('#nm_sekolah').val();
		if(nilai!=''){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/ajax/getCariSekolah",
				data: {<?php echo $csrf ?>,'key':nilai},
				cache: false,
				success: function(data)
				{
					$("#showcarisekolah").html(data).show();
				}
			});
		}
		$("#display").hide();
		$("#showcarisekolah").html(null);		
	}
	function getlokasi(nil1,nil2,nil3,nil4,nil5,nil6){
	   var nilai=$('#'+nil1).val();
	   
		   $.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/ajax/"+nil3,
				data:{<?php echo $csrf ?>,'id':nilai},
				dataType:'html',
				success: function(data){	
					$('#'+nil2).html(data);
					if(nil6!=null)
						$('#'+nil2+' option[value='+nil6+']').prop("selected",true);
				},
				error:function(XMLHttpRequest){

					alert(XMLHttpRequest.responseText);
				}
			});
			if(nil4!=null)
				$('#'+nil4).html("<option value=''>- Pilih Salah Satu -</option>");
			if(nil5!=null)
				$('#'+nil5).html("<option value=''>- Pilih Salah Satu -</option>");
	};	
	function getlokasi2(nil1,nil2,nil3,nil4,nil5,nil6){
	   var nilai=$(nil1).val();
	   
		   $.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/ajax/"+nil3,
				data:{<?php echo $csrf ?>,'id':nilai},
				dataType:'html',
				success: function(data){	
					$(nil2).html(data);
					if(nil6!=null)
						$(nil2+' option[value='+nil6+']').prop("selected",true);
						
				},
				error:function(XMLHttpRequest){

					alert(XMLHttpRequest.responseText);
				}
			});
			if(nil4!=null)
				$(nil4).html("<option value=''>- Pilih Salah Satu -</option>");
			if(nil5!=null)
				$(nil5).html("<option value=''>- Pilih Salah Satu -</option>");
	};
	function cetak_k(id){
        $("<iframe>")                             
            .hide()                               
            .attr("src", "<?php echo base_url().index_page() ?>admin/pendaftaran/cetak_kelengkapan/"+id) 
            .appendTo("body"); 
    }; 
    function cetak_jas(id){
        $("<iframe>")                             
            .hide()                               
            .attr("src", "<?php echo base_url().index_page() ?>admin/pendaftaran/bukti_pengambilan_jas/"+id) 
            .appendTo("body"); 
    };   
</script>
<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>
