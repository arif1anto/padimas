<?php 
	$sts = "i";//insert
	$new_id = 0;
	if (isset($data3) && $data3!=null && $sts = "i") {
		$new_id = $data3;
	}
	if (isset($data4) && $data4!=null) {
		$sts = "u";//update
		$new_id = isset($data4[0]->id_rekomendasi) ? $data4[0]->id_rekomendasi : "";
	}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Test Wawancara</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Wawancara Calon Mahasiswa Baru</h3>
                </div>
                <div class="panel-body input-sm">
					<div class="form-group">
						<label >Nomor Pendaftaran :</label>
						<input type="text" class="form-control" name="iddaftar" id="searchbox" onkeyup="cari()" onkeydown="lompat(event)" value="<?php echo isset($data1->iddaftar) ? $data1->iddaftar : ''?>" placeholder="Ketikkan Nomor Pendaftaran atau Nama Pendaftar untuk mencari data." autocomplete="off">
						<div id="display"></div>
						<p class="help-block"></p>
					</div>
                    <div class="form-group">
                        <p class="form-control-static">Nama Calon : <strong><?php echo isset($data1->nama) ? $data1->nama : ''?></strong></p>
                    </div>
                </div>
            </div>
			
			<?php echo isset($data7) ? $data7 : ''; ?>

            <div class="panel panel-primary form-wawancara" style="margin-bottom: 5px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Detail Hasil Tes TPA:</h3>
                </div>
                <div class="panel-body">
                     <?php if(isset($data4[0]->nilai_tpa) && isset($data5[0]->skor)==null && ($data4[0]->nilai_tpa!=null || $data4[0]->nilai_tpa!='')) {?>
					<ul>
						<li>Skor : <strong><?php echo $data4[0]->nilai_tpa?></strong></li>
					</ul>
					<?php } else if (isset($data5[0]->skor)) { ?>
					<ul>
						<li>Jumlah Soal Dijawab : <strong><?php echo $data5[0]->dijawab.' dari '.$data5[0]->jml_soal.' soal' ?></strong></li>
						<li>Jawaban Benar : <strong><?php echo $data5[0]->benar ?></strong></li>
						<li>Jawaban Salah : <strong><?php echo $data5[0]->dijawab-$data5[0]->benar ?></strong></li>
						<li>Tidak Dijawab : <strong><?php echo $data5[0]->jml_soal-$data5[0]->dijawab ?></strong></li>
						<li>Skor : <strong><?php echo $data5[0]->skor==null?'0':$data5[0]->skor; ?></strong></li>
						<li>Prosentase : <strong><?php echo round(($data5[0]->skor/(10*$data5[0]->jml_soal))*100,2); ?>%</strong></li>
					</ul>
					<?php } else { ?>
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Pendaftar berikut belum melakukan test TPA</strong>
                    </div>
                    <?php } ?>
                    <br>
                    <p class="text-center">
                        <button type="button" class="btn btn-lg btn-primary" onclick="next()">Mulai Test Wawancara</button>
                    </p>
                </div>
            </div> 
			<?php echo form_open(($sts=="u" ? "admin/test/wawancara/".(isset($data1->iddaftar) ? $data1->iddaftar : '')."/edit" : ""),array('class'=>'form-horizontal','novalidate'=>'novalidate')) ?>
            <div class="panel panel-danger form-wawancara">
                <div class="panel-heading">
                    <h3 class="panel-title">A. Identitas Pribadi (10)</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor">1.</span>Nama Calon</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama" value="<?php echo isset($data1->nama) ? $data1->nama : ''?>"readonly>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor">2.</span>Asal Sekolah</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="sekolah" value="<?php echo isset($data1->nama_sekolah) ? $data1->nama_sekolah : ''?>" readonly>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Jurusan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="jurusan" value="<?php echo isset($data1->jurusan) ? $data1->jurusan : ''?>" readonly>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Tahun Kelulusan</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="thn_lulus">
                                <option value="">- Pilih -</option>
                                <?php for ($i=date('Y'); $i > date('Y')-30; $i--) { ?>
                                <option value="<?php echo $i ?>" <?php echo isset($data1->thn_lulus) && $data1->thn_lulus==$i ? "selected" : ""?>><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor">3.</span>Daftar PT Lain di Jogja</label>
                        <div class="col-sm-3">
                            <label class="radio-inline"><input type="radio" onchange="hide_pt($(this).val())" id="dft_ptlain1" name="dft_ptlain" value="1" <?php echo isset($data4[0]->dft_ptlain) && $data4[0]->dft_ptlain==1 ? "checked" : ""?>>Ya</label>
                            <label class="radio-inline"><input type="radio" onchange="hide_pt($(this).val())" id="dft_ptlain0" name="dft_ptlain" value="0"<?php echo isset($data4[0]->dft_ptlain) && $data4[0]->dft_ptlain==0 ? "checked" : ""?>>Tidak</label>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm hide-pt">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Nama PTN</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nama_ptn" value="<?php echo isset($data4[0]->nama_ptn) ? $data4[0]->nama_ptn : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm hide-pt">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Jurusan</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="jur_ptn" value="<?php echo isset($data4[0]->jur_ptn) ? $data4[0]->jur_ptn : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm hide-pt">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Nama PTS</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nama_pts" value="<?php echo isset($data4[0]->nama_pts) ? $data4[0]->nama_pts : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm hide-pt">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Jurusan</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="jur_pts" value="<?php echo isset($data4[0]->jur_pts) ? $data4[0]->jur_pts : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor">4.</span>Sumber Informasi </label>
                        <div class="col-sm-8">
							<div class="row">
                            <?php 
								if (count($data2)>0) {
									$i=0;
									foreach ($data2 as $row) {	
										echo '<div class="col-sm-6">
												<div class="checkbox">
													<label class="checkbox" style="font-size:12px;"><input type="checkbox" name="set_info[]" id="set_info'.$i.'" value="'.$row->id_info.'"'.($row->kd_info!=null  ? "checked": "").'>'.$row->info.
													'</label>
												</div>
											  </div>';
											  $i++;
									}
								}
							?>
							</div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor">5.</span>Keinginan Kuliah</label>
                        <div class="col-sm-5">
                            <div class="radio">
                                <label class="radio"><input type="radio" name="ingin" onchange="lain(false)" value="sendiri" <?php echo isset($data4[0]->ingin_kuliah) && $data4[0]->ingin_kuliah=="sendiri" ? "checked" : ""?>>Sendiri</label>
                            </div>
                            <div class="radio">
                                <label class="radio"><input type="radio" name="ingin" onchange="lain(false)" value="ortu" <?php echo isset($data4[0]->ingin_kuliah) && $data4[0]->ingin_kuliah=="ortu" ? "checked" : ""?>>Orang Tua</label>
                            </div>
                            <div class="radio">
                                <label class="radio"><input type="radio" name="ingin" onchange="lain(false)" value="saudara" <?php echo isset($data4[0]->ingin_kuliah) && $data4[0]->ingin_kuliah=="saudara" ? "checked" : ""?>>Saudara</label>
                            </div>
                            <div class="radio">
                                <label class="radio"><input type="radio" name="ingin" onchange="lain(true)" value="lain" <?php echo isset($data4[0]->ingin_kuliah) && $data4[0]->ingin_kuliah!="sendiri" && $data4[0]->ingin_kuliah!="ortu" && $data4[0]->ingin_kuliah!="saudara" && $data4[0]->ingin_kuliah!="" ? "checked" : ""?>>
                                    Lainya : <input type="text" class="form-control input-sm" name="ingin_lain" value="<?php echo isset($data4[0]->ingin_kuliah) && $data4[0]->ingin_kuliah!="sendiri" && $data4[0]->ingin_kuliah!="ortu" && $data4[0]->ingin_kuliah!="saudara" && $data4[0]->ingin_kuliah!="" ? $data4[0]->ingin_kuliah : ''?>" <?php echo isset($data4[0]->ingin_kuliah) && $data4[0]->ingin_kuliah!="sendiri" && $data4[0]->ingin_kuliah!="ortu" && $data4[0]->ingin_kuliah!="saudara" && $data4[0]->ingin_kuliah!=""? "" : 'readonly'?>>
                                </label>
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
					<p class="text-sm no-margin"><span class="nomor">6.</span>Prodi yang dipilih</p>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Prodi 1</label>
                        <div class="col-sm-6">
                            <select class="form-control" disabled>
								<option value="">- Pilih Salah Satu -</option>
								<?php 
									if (isset($data6)) {
										foreach ($data6 as $row) { ?>
										<option value="<?php echo $row->kd_proditawar ?>" <?php echo (isset($data1->prodi_pil1) && $data1->prodi_pil1==$row->kd_proditawar ? 'selected' : '') ?>><?php echo $row->prodi ?></option>
									<?php }} ?>
                            </select>
                            <p class="help-block"></p>
                        </div>
                    </div>
					<div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Prodi 2</label>
                        <div class="col-sm-6">
                            <select class="form-control" disabled>
								<option value="">- Pilih Salah Satu -</option>
								<?php 
									if (isset($data6)) {
										foreach ($data6 as $row) { ?>
										<option value="<?php echo $row->kd_proditawar ?>" <?php echo (isset($data1->prodi_pil2) && $data1->prodi_pil2==$row->kd_proditawar ? 'selected' : '') ?>><?php echo $row->prodi ?></option>
									<?php }} ?>
                            </select>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Alasan</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="3" name="alasan_prodi"><?php echo isset($data4[0]->ket_alasan) ? $data4[0]->ket_alasan : ''?></textarea>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <p class="text-sm no-margin"><span class="nomor">7.</span>Sikap Wawancara</p>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Penampilan</label>
                        <div class="col-sm-8">
							<div class="row col-sm-12">
                                <label class="radio-inline"><input type="radio" name="penampilan" value="Baik" <?php echo isset($data4[0]->penampilan) && $data4[0]->penampilan=="Baik" ? "checked" : ""?>>Baik</label>
                                <label class="radio-inline"><input type="radio" name="penampilan" value="Cukup" <?php echo isset($data4[0]->penampilan) && $data4[0]->penampilan=="Cukup" ? "checked" : ""?>>Cukup</label>
                                <label class="radio-inline"><input type="radio" name="penampilan" value="Kurang" <?php echo isset($data4[0]->penampilan) && $data4[0]->penampilan=="Kurang" ? "checked" : ""?>>Kurang</label>
							</div>
							<div class="row col-sm-12">
								<input type="text" class="form-control" name="penampilan_ket" placeholder="Keterangan" value="<?php echo isset($data4[0]->ket_penampilan) ? $data4[0]->ket_penampilan : ''?>">
							</div>
					   </div>
                       <p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Etika</label>
                        <div class="col-sm-8">
                            <div class="row col-sm-12">
                                <label class="radio-inline"><input type="radio"  name="etika" value="Baik" <?php echo isset($data4[0]->etika) && $data4[0]->etika=="Baik" ? "checked" : ""?>>Baik</label>
                                <label class="radio-inline"><input type="radio"  name="etika" value="Cukup" <?php echo isset($data4[0]->etika) && $data4[0]->etika=="Cukup" ? "checked" : ""?>>Cukup</label>
                                <label class="radio-inline"><input type="radio"  name="etika" value="Kurang" <?php echo isset($data4[0]->etika) && $data4[0]->etika=="Kurang" ? "checked" : ""?>>Kurang</label>
                            </div>
							<div class="row col-sm-12">
								<input type="text" class="form-control" name="etika_ket" placeholder="Keterangan" value="<?php echo isset($data4[0]->ket_etika) ? $data4[0]->ket_etika : ''?>">
							</div>
                        </div>
						<p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Komunikasi</label>
                        <div class="col-sm-8">
							<div class="row col-sm-12">
                                <label class="radio-inline"><input type="radio" name="komunikasi" value="Baik" <?php echo isset($data4[0]->komunikasi) && $data4[0]->komunikasi=="Baik" ? "checked" : ""?>>Baik</label>
                                <label class="radio-inline"><input type="radio" name="komunikasi" value="Cukup" <?php echo isset($data4[0]->komunikasi) && $data4[0]->komunikasi=="Cukup" ? "checked" : ""?>>Cukup</label>
                                <label class="radio-inline"><input type="radio" name="komunikasi" value="Kurang" <?php echo isset($data4[0]->komunikasi) && $data4[0]->komunikasi=="Kurang" ? "checked" : ""?>>Kurang</label>
                            </div>
							<div class="row col-sm-12">
								<input type="text" class="form-control" name="komunikasi_ket" placeholder="Keterangan" value="<?php echo isset($data4[0]->ket_komunikasi) ? $data4[0]->ket_komunikasi : ''?>">
							</div>
                        </div>
                        
						<p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Kepribadian</label>
                        <div class="col-sm-8">
                            <div class="row col-sm-12">
                                <label class="radio-inline"><input type="radio" name="kepribadian" value="Baik" <?php echo isset($data4[0]->kepribadian) && $data4[0]->kepribadian=="Baik" ? "checked" : ""?>>Baik</label>
                                <label class="radio-inline"><input type="radio" name="kepribadian" value="Cukup" <?php echo isset($data4[0]->kepribadian) && $data4[0]->kepribadian=="Cukup" ? "checked" : ""?>>Cukup</label>
                                <label class="radio-inline"><input type="radio" name="kepribadian" value="Kurang" <?php echo isset($data4[0]->kepribadian) && $data4[0]->kepribadian=="Kurang" ? "checked" : ""?>>Kurang</label>
                            </div>
							<div class="row col-sm-12">
								<input type="text" class="form-control" name="kepribadian_ket" placeholder="Keterangan" value="<?php echo isset($data4[0]->ket_kepribadian) ? $data4[0]->ket_kepribadian : ''?>">
							</div>
                        </div>
						<p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Emosional</label>
                        <div class="col-sm-8">
                            <div class="row col-sm-12">
                                <label class="radio-inline"><input type="radio" name="emosional" value="Baik" <?php echo isset($data4[0]->emosional) && $data4[0]->emosional=="Baik" ? "checked" : ""?>>Baik</label>
                                <label class="radio-inline"><input type="radio" name="emosional" value="Cukup" <?php echo isset($data4[0]->emosional) && $data4[0]->emosional=="Cukup" ? "checked" : ""?>>Cukup</label>
                                <label class="radio-inline"><input type="radio" name="emosional" value="Kurang" <?php echo isset($data4[0]->emosional) && $data4[0]->emosional=="Kurang" ? "checked" : ""?>>Kurang</label>
                            </div>
							<div class="row col-sm-12">
								<input type="text" class="form-control" name="emosional_ket" placeholder="Keterangan" value="<?php echo isset($data4[0]->ket_emosional) ? $data4[0]->ket_emosional : ''?>">
							</div>
                        </div>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                        <div class="input-group">
                            <span class="input-group-addon">Penilaian Identitas : </span>
                            <input id="nilai" type="number" class="form-control" name="nilai" min="0" max="10" placeholder="Nilai Max 10" value="<?php echo isset($data4[0]->nilai_identitas) ? $data4[0]->nilai_identitas : ''?>">
                            <div class="input-group-btn">
                                <button class="btn btn-primary" type="button" onclick="next()"><i class="fa fa-angle-double-right fa-fw"></i> Selanjutnya</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-danger form-wawancara">
                <div class="panel-heading">
                    <h3 class="panel-title">B. Kemampuan Akademis Calon Mahasiswa (30)</h3>
                </div>
                <div class="panel-body">
                    <p class="text-sm no-margin"><span class="nomor">1.</span>Pengetahuan Tentang Prodi <small>(jika belum paham diberipenjelasan)</small></p>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-6 text-left"><span class="nomor"></span><span class="nomor">a.</span>Apa yang dipelajari pada prodi tersebut</label>
                        <div class="col-sm-6">
							<label class="radio-inline"><input type="radio" name="pengetahuan_prodi" value="Paham" <?php echo isset($data4[0]->paham_prodi) && $data4[0]->paham_prodi=="Paham" ? "checked" : ""?>>Paham</label>
							<label class="radio-inline"><input type="radio" name="pengetahuan_prodi" value="Belum Paham" <?php echo isset($data4[0]->paham_prodi) && $data4[0]->paham_prodi=="Belum Paham" ? "checked" : ""?>>Belum Paham</label>
						</div>
						<p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-6 text-left"><span class="nomor"></span><span class="nomor">b.</span>Prospek Lulusan</label>
                        <div class="col-sm-6">
                                <label class="radio-inline"><input type="radio" name="prospek_lulus" value="Paham" <?php echo isset($data4[0]->prospek_lulus) && $data4[0]->prospek_lulus=="Paham" ? "checked" : ""?>>Paham</label>
                                <label class="radio-inline"><input type="radio" name="prospek_lulus" value="Belum Paham" <?php echo isset($data4[0]->prospek_lulus) && $data4[0]->prospek_lulus=="Belum Paham" ? "checked" : ""?>>Belum Paham</label>
                        </div>
						<p class="help-block"></p>
                    </div>
                    <p class="text-sm no-margin"><span class="nomor">2.</span>Nilai UN Murni</p>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Jurusan</label>
                        <div class="col-sm-8">
                            <div class="row col-sm-12">
                                <label class="radio-inline"><input type="radio" name="jur_sekolah" onchange="un_hide($(this).val())" value="ipa" <?php echo isset($data4[0]->jur_sekolah) && $data4[0]->jur_sekolah=="ipa" ? "checked" : ""?>>SMA IPA</label>
                                <label class="radio-inline"><input type="radio" name="jur_sekolah" onchange="un_hide($(this).val())" value="ips" <?php echo isset($data4[0]->jur_sekolah) && $data4[0]->jur_sekolah=="ips" ? "checked" : ""?>>SMA IPS</label>
                                <label class="radio-inline"><input type="radio" name="jur_sekolah" onchange="un_hide($(this).val())" value="bhs" <?php echo isset($data4[0]->jur_sekolah) && $data4[0]->jur_sekolah=="bhs" ? "checked" : ""?>>SMA Bahasa</label>
                                <label class="radio-inline"><input type="radio" name="jur_sekolah" onchange="un_hide($(this).val())" value="smk" <?php echo isset($data4[0]->jur_sekolah) && $data4[0]->jur_sekolah=="smk" ? "checked" : ""?>>SMK</label>
                            </div>
							<div class="row col-sm-12 un smk">
								<input type="text" name="jurusan_smk" class="form-control" placeholder="Jurusan">
							</div>
                        </div>
						<p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm un ipa ips bhs smk">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Bahasa Indonesia</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="nilai_1" value="<?php echo isset($data4[0]->nil_1) ? $data4[0]->nil_1 : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm un ipa ips bhs smk">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Bahasa Inggris</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="nilai_2" value="<?php echo isset($data4[0]->nil_2) ? $data4[0]->nil_2 : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm un ipa ips bhs smk">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Matematika</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="nilai_3" value="<?php echo isset($data4[0]->nil_3) ? $data4[0]->nil_3 : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm un ipa">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Biologi</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="nilai_4" value="<?php echo isset($data4[0]->nil_4) ? $data4[0]->nil_4 : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm un ipa">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Fisika</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="nilai_5" value="<?php echo isset($data4[0]->nil_5) ? $data4[0]->nil_5 : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm un ipa">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Kimia</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="nilai_6" value="<?php echo isset($data4[0]->nil_6) ? $data4[0]->nil_6 : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm un ips">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Geografi</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="nilai_7" value="<?php echo isset($data4[0]->nil_7) ? $data4[0]->nil_7 : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm un ips">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Ekonomi</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="nilai_8" value="<?php echo isset($data4[0]->nil_8) ? $data4[0]->nil_8 : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm un smk">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Produktif</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="nilai_9" value="<?php echo isset($data4[0]->nil_9) ? $data4[0]->nil_9 : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <p class="text-sm no-margin"><span class="nomor">3.</span>Nilai rata-rata Raport</p>
                    <?php 
					$dt=array(
						1 => isset($data1->rapor_sm1) ? $data1->rapor_sm1 :"",
						2 => isset($data1->rapor_sm2) ? $data1->rapor_sm2 :"",
						3 => isset($data1->rapor_sm3) ? $data1->rapor_sm3 :"",
						4 => isset($data1->rapor_sm4) ? $data1->rapor_sm4 :"",
						);
					for ($i=1; $i <= 4; $i++) {  ?>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Semester <?php echo $i ?></label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="rapor_sm<?php echo $i ?>" value="<?php echo $dt[$i] ?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <?php } ?>
                    <p class="text-sm no-margin"><span class="nomor">4.</span>Pendidikan diluar sekolah yang pernah diikuti</p>
                    <div class="table-container" style="margin-left: 15px;">
                      <table class="table table-hover">
                        <tbody>
                            <tr>
                            <td>
                                <div class="form-group form-group-sm no-margin">
                                    <div class="col-sm-12">
                                    <textarea type="text" class="form-control" name="pend_nonformal" placeholder="format : Nama Kursus/periode/sumber biaya, dll"><?php echo isset($data4[0]->pend_nonformal) ? $data4[0]->pend_nonformal : ''?></textarea>
                                    <p class="help-block"></p>
                                    </div>
                                </div>
                            </td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor">5.</span>Pelajaran yang disukai</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="pelajaran_suka" value="<?php echo isset($data4[0]->pelajaran_disukai) ? $data4[0]->pelajaran_disukai : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Alasan disukai</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="pelajaran_alasan" value="<?php echo isset($data4[0]->alasan_disukai) ? $data4[0]->alasan_disukai : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor">6.</span>Pelajaran yang tidak disukai</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="pelajaran_tdk_suka" value="<?php echo isset($data4[0]->pelajaran_nonsuka) ? $data4[0]->pelajaran_nonsuka : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Alasan tidak disukai</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="pelajaran_tdk_alasan" value="<?php echo isset($data4[0]->alasan_nonsuka) ? $data4[0]->alasan_nonsuka : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-5 text-left"><span class="nomor">7.</span>Hobi / Kegemaran</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="hobi" value="<?php echo isset($data4[0]->hobi) ? $data4[0]->hobi : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-5 text-left"><span class="nomor">6.</span>Prestasi yang pernah didapat</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="prestasi" value="<?php echo isset($data1->prestasi) ? $data1->prestasi : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-5 text-left"><span class="nomor">9.</span>Keikutsertaan  Organisasi Intra Sekolah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="intra" value="<?php echo isset($data4[0]->org_intrasekolah) ? $data4[0]->org_intrasekolah : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-5 text-left"><span class="nomor">10.</span>Keikutsertaan  Organisasi Luar Sekolah</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="extra" value="<?php echo isset($data4[0]->org_ekstrasekolah) ? $data4[0]->org_ekstrasekolah : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-5 text-left"><span class="nomor">11.</span>Hal-hal lain yang dapat diungkap</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" rows="3" name="hal_lain"><?php echo isset($data4[0]->hal_lain) ? $data4[0]->hal_lain : ''?></textarea>
                            <p class="help-block"></p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="form-group">
                        <div class="col-sm-12">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button class="btn btn-primary" type="button" onclick="prev()"><i class="fa fa-angle-double-left fa-fw"></i> Sebelumnya</button>
                            </div>
                            <span class="input-group-addon">Penilaian Akademik : </span>
                            <select id="rencana" class="form-control">
                                <option value="">- Pilih -</option>
                                <option value="30" <?php echo isset($data4[0]->nilai_akademik) && $data4[0]->nilai_akademik==30 ? "selected" : ""?>>Akan selesai tepat waktu</option>
                                <option value="20" <?php echo isset($data4[0]->nilai_akademik) && $data4[0]->nilai_akademik==20 ? "selected" : ""?>>Selesai namun terlambat 1 tahun</option>
                                <option value="15" <?php echo isset($data4[0]->nilai_akademik) && $data4[0]->nilai_akademik==15 ? "selected" : ""?>>Selesai namun terlambat 2 tahun</option>
                                <option value="10" <?php echo isset($data4[0]->nilai_akademik) && $data4[0]->nilai_akademik==10 ? "selected" : ""?>>Selesai namun terlambat 3 tahun</option>
                                <option value="5" <?php echo isset($data4[0]->nilai_akademik) && $data4[0]->nilai_akademik==5 ? "selected" : ""?>>Selesai namun terlambat 4 tahun</option>
                                <option value="0" <?php echo isset($data4[0]->nilai_akademik) && $data4[0]->nilai_akademik==0 ? "selected" : ""?>>Tidak Selesai</option>
                            </select>
                            <div class="input-group-btn">
                                <button class="btn btn-primary" type="button" onclick="next()"><i class="fa fa-angle-double-right fa-fw"></i> Selanjutnya</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-danger form-wawancara">
                <div class="panel-heading">
                    <h3 class="panel-title">C. Kemampuan Keuangan (30)</h3>
                </div>
                <div class="panel-body">
                    <p class="text-sm no-margin"><span class="nomor">1.</span>Status Calon</p>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Anak ke</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="anak_ke" value="<?php echo isset($data1->anak_ke) ? $data1->anak_ke : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Jumlah Saudara</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="number" class="form-control" name="jmlsdr_sekolah" value="<?php echo isset($data4[0]->sdr_sekolah) ? $data4[0]->sdr_sekolah : ''?>">
                                <span class="input-group-addon">
                                    Sekolah
                                </span>
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <div class="col-sm-4 col-sm-offset-4">
                            <div class="input-group">
                                <input type="number" class="form-control" name="jmlsdr_kuliah" value="<?php echo isset($data4[0]->sdr_kuliah) ? $data4[0]->sdr_kuliah : ''?>">
                                <span class="input-group-addon">
                                    Kuliah
                                </span>
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <div class="col-sm-4 col-sm-offset-4">
                            <div class="input-group">
                                <input type="number" class="form-control" name="jmlsdr_bekerja" value="<?php echo isset($data4[0]->sdr_bekerja) ? $data4[0]->sdr_bekerja : ''?>">
                                <span class="input-group-addon">
                                    Bekerja
                                </span>
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <div class="col-sm-4 col-sm-offset-4">
                            <div class="input-group">
                                <input type="number" class="form-control" name="jmlsdr_keluarga" value="<?php echo isset($data4[0]->sdr_berkeluarga) ? $data4[0]->sdr_berkeluarga : ''?>">
                                <span class="input-group-addon">
                                    Keluarga
                                </span>
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <p class="text-sm no-margin"><span class="nomor">2.</span>Status Orang Tua</p>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Bapak</label>
                        <div class="col-sm-8">
							<label class="radio-inline"><input type="radio" name="hidup_ayah" value="Y" <?php echo isset($data1->hidup_ayah) && $data1->hidup_ayah=="Y" ? "checked" : ""?>>Hidup</label>
							<label class="radio-inline"><input type="radio" name="hidup_ayah" value="T" <?php echo isset($data1->hidup_ayah) && $data1->hidup_ayah=="T" ? "checked" : ""?>>Meninggal</label>
                        </div>
						<p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Ibu</label>
                        <div class="col-sm-8">
                            <label class="radio-inline"><input type="radio" name="hidup_ibu" value="Y" <?php echo isset($data1->hidup_ibu) && $data1->hidup_ibu=="Y" ? "checked" : ""?>>Hidup</label>
                            <label class="radio-inline"><input type="radio" name="hidup_ibu" value="T" <?php echo isset($data1->hidup_ibu) && $data1->hidup_ibu=="T" ? "checked" : ""?>>Meninggal</label>
                        </div>
						<p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Status</label>
                        <div class="col-sm-8">
                            <label class="radio-inline"><input type="radio" name="stt_kawinortu" value="Duda" <?php echo isset($data4[0]->stt_kawinortu) && $data4[0]->stt_kawinortu=="Duda" ? "checked" : ""?>>Duda</label>
                            <label class="radio-inline"><input type="radio" name="stt_kawinortu" value="Janda" <?php echo isset($data4[0]->stt_kawinortu) && $data4[0]->stt_kawinortu=="Janda" ? "checked" : ""?>>Janda</label>
                            <label class="radio-inline"><input type="radio" name="stt_kawinortu" value="Cerai" <?php echo isset($data4[0]->stt_kawinortu) && $data4[0]->stt_kawinortu=="Cerai" ? "checked" : ""?>>Cerai</label>
                        </div>
						<p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-5 text-left"><span class="nomor">3.</span>Pengetahuan tentang biaya kuliah di Prodi</label>
                        <div class="col-sm-2">
                            <div class="radio">
                                <label class="radio input-sm"><input type="radio" name="biaya_tahu" value="Tahu" <?php echo isset($data4[0]->biaya_tahu) && $data4[0]->biaya_tahu=="Tahu" ? "checked" : ""?>>Tahu</label>
                            </div>
                            <div class="radio">
                                <label class="radio input-sm"><input type="radio" name="biaya_mampu" value="Mampu" <?php echo isset($data4[0]->biaya_mampu) && $data4[0]->biaya_mampu=="Mampu" ? "checked" : ""?>>Mampu</label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="radio">
                                <label class="radio input-sm"><input type="radio" name="biaya_tahu" value="Tidak Tahu" <?php echo isset($data4[0]->biaya_tahu) && $data4[0]->biaya_tahu=="Tidak Tahu" ? "checked" : ""?>>Tidak Tahu <small>(Pewawancara memberi tahu)</small></label>
                            </div>
                            <div class="radio">
                                <label class="radio input-sm"><input type="radio" name="biaya_mampu" value="Tidak Mampu" <?php echo isset($data4[0]->biaya_mampu) && $data4[0]->biaya_mampu=="Tidak Mampu" ? "checked" : ""?>>Tidak Mampu</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor">4.</span>Rencana Sumber Biaya Kuliah</label>
                        <div class="col-sm-4">
                            <select id="sumberbiaya" class="form-control" name="sumber_biaya" onchange="src_biaya($(this).val())">
                                <option value="">- Pilih -</option>
                                <option value="Bapak" <?php echo isset($data4[0]->sumber_biaya) && $data4[0]->sumber_biaya=="Bapak" ? "selected" : ""?>>Bapak</option>
                                <option value="Ibu" <?php echo isset($data4[0]->sumber_biaya) && $data4[0]->sumber_biaya=="Ibu" ? "selected" : ""?>>Ibu</option>
                                <option value="Paman" <?php echo isset($data4[0]->sumber_biaya) && $data4[0]->sumber_biaya=="Paman" ? "selected" : ""?>>Paman</option>
                                <option value="Kakak" <?php echo isset($data4[0]->sumber_biaya) && $data4[0]->sumber_biaya=="Kakak" ? "selected" : ""?>>Kakak</option>
                                <option value="Sendiri" <?php echo isset($data4[0]->sumber_biaya) && $data4[0]->sumber_biaya=="Sendiri" ? "selected" : ""?>>Sendiri</option>
                                <option value="lain" <?php echo isset($data4[0]->sumber_biaya) && $data4[0]->sumber_biaya=="lain" ? "selected" : ""?>>Lain-lain</option>
                            </select>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm sb lain">
                        <div class="col-sm-4 col-sm-offset-4">
                            <input type="text" name="sumber_biaya_lain" class="form-control" placeholder="" value="<?php echo isset($data4[0]->sumber_biaya_lain) ? $data4[0]->sumber_biaya_lain : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <p class="text-sm no-margin"><span class="nomor">5.</span>Data yang membiayai</p>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Pendidikan</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="pend_sumber_biaya">
                                <option value="">- Pilih -</option>
                                <option value="SD" <?php echo isset($data4[0]->pddk_src_biaya) && $data4[0]->pddk_src_biaya=="SD" ? "selected" : ""?>>SD</option>
                                <option value="SLTP" <?php echo isset($data4[0]->pddk_src_biaya) && $data4[0]->pddk_src_biaya=="SLTP" ? "selected" : ""?>>SLTP</option>
                                <option value="SLTA" <?php echo isset($data4[0]->pddk_src_biaya) && $data4[0]->pddk_src_biaya=="SLTA" ? "selected" : ""?>>SLTA</option>
                                <option value="D1" <?php echo isset($data4[0]->pddk_src_biaya) && $data4[0]->pddk_src_biaya=="D1" ? "selected" : ""?>>Diploma 1</option>
                                <option value="D2" <?php echo isset($data4[0]->pddk_src_biaya) && $data4[0]->pddk_src_biaya=="D2" ? "selected" : ""?>>Diploma 2</option>
                                <option value="D3" <?php echo isset($data4[0]->pddk_src_biaya) && $data4[0]->pddk_src_biaya=="D3" ? "selected" : ""?>>Diploma 3</option>
                                <option value="D4" <?php echo isset($data4[0]->pddk_src_biaya) && $data4[0]->pddk_src_biaya=="D4" ? "selected" : ""?>>Diploma 4</option>
                                <option value="S1" <?php echo isset($data4[0]->pddk_src_biaya) && $data4[0]->pddk_src_biaya=="S1" ? "selected" : ""?>>S1</option>
                                <option value="S2" <?php echo isset($data4[0]->pddk_src_biaya) && $data4[0]->pddk_src_biaya=="S2" ? "selected" : ""?>>S2</option>
                                <option value="S3" <?php echo isset($data4[0]->pddk_src_biaya) && $data4[0]->pddk_src_biaya=="S3" ? "selected" : ""?>>S3</option>
                            </select> 
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Pekerjaan <small>(secara detail)</small></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="pekerjaan_sumber_biaya" rows="3"><?php echo isset($data4[0]->pekerjaan_src_biaya) ? $data4[0]->pekerjaan_src_biaya : ''?></textarea>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Penghasilan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="penghasilan_sumber_biaya" value="<?php echo isset($data4[0]->penghasilan_src_biaya) ? $data4[0]->penghasilan_src_biaya : ''?>">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor">6.</span>Status Rumah</label>
                        <div class="col-sm-8">
                            <label class="radio-inline"><input type="radio" name="stt_rumah" value="Sendiri" <?php echo isset($data4[0]->stt_rumah) && $data4[0]->stt_rumah=="Sendiri" ? "checked" : ""?>>Sendiri</label>
                            <label class="radio-inline"><input type="radio" name="stt_rumah" value="Kontrak" <?php echo isset($data4[0]->stt_rumah) && $data4[0]->stt_rumah=="Kontrak" ? "checked" : ""?>>Kontrak</label>
                        </div>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor"></span>Listrik</label>
                        <div class="col-sm-8">
                            <label class="radio-inline"><input type="radio" name="listrik" value="450 Watt" <?php echo isset($data4[0]->listrik) && $data4[0]->listrik=="450 Watt" ? "checked" : ""?>>450 Watt</label>
                            <label class="radio-inline"><input type="radio" name="listrik" value="900 Watt" <?php echo isset($data4[0]->listrik) && $data4[0]->listrik=="900 Watt" ? "checked" : ""?>>900 Watt</label>
                            <label class="radio-inline"><input type="radio" name="listrik" value="1300 Watt" <?php echo isset($data4[0]->listrik) && $data4[0]->listrik=="1300 Watt" ? "checked" : ""?>>1300 Watt</label>
                            <label class="radio-inline"><input type="radio" name="listrik" value="2200 Watt" <?php echo isset($data4[0]->listrik) && $data4[0]->listrik=="2200 Watt" ? "checked" : ""?>>&ge; 2200 Watt</label>
                        </div>
						<p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-4 text-left"><span class="nomor">7.</span>Aset Lainnya</label>
                        <div class="col-sm-8">
                            <div class="checkbox input-sm">
                                <label class="checkbox"><input type="checkbox" name="aset_mobil" value="1" <?php echo isset($data4[0]->aset_mobil) && $data4[0]->aset_mobil==1 ? "checked" : ""?>>Mobil</label>
                            </div>
                            <div class="checkbox input-sm">
                                <label class="checkbox"><input type="checkbox" name="aset_motor" value="1"  <?php echo isset($data4[0]->aset_motor) && $data4[0]->aset_motor==1 ? "checked" : ""?>>Sepeda Motor</label>
                            </div>
                            <div class="checkbox input-sm">
                                <label class="checkbox"><input type="checkbox" name="aset_lain"  <?php echo isset($data4[0]->aset_lain) && $data4[0]->aset_lain!=1 && $data4[0]->aset_lain!=""? "checked" : ""?>>Lainnya
                                <input type="text" class="form-control" name="aset_lain_txt" placeholder="Misal: Sawah, Pesawat" value="<?php echo isset($data4[0]->aset_lain) ? $data4[0]->aset_lain : ''?>"></label>
                            </div>
                            <p class="help-block"><small>Tidak ditanyakan secara langsung tapi pewawancara menggali informasi mengenai hal tersebut</small></p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="form-group">
                        <div class="col-sm-12">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button class="btn btn-primary" type="button" onclick="prev()"><i class="fa fa-angle-double-left fa-fw"></i> Sebelumnya</button>
                            </div>
                            <span class="input-group-addon">Penilaian Kemampuan Keuangan : </span>
                            <select id="mampu"class="form-control">
                                <option value="">- Pilih -</option>
                                <option value="30" <?php echo isset($data4[0]->nilai_kemampuan_keuangan) && $data4[0]->nilai_kemampuan_keuangan==30 ? "selected" : ""?>>Mampu</option>
                                <option value="0" <?php echo isset($data4[0]->nilai_kemampuan_keuangan) && $data4[0]->nilai_kemampuan_keuangan==0 ? "selected" : ""?>>Tidak Mampu</option>
                            </select>
                            <div class="input-group-btn">
                                <button class="btn btn-primary" type="button" onclick="next()"><i class="fa fa-angle-double-right fa-fw"></i> Selanjutnya</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-danger form-wawancara">
                <div class="panel-heading">
                    <h3 class="panel-title">D. Motivasi Kuliah Calon Mahasiswa (30)</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-12 text-left"><span class="nomor">1.</span>Apakah berita yang terkait dengan pendidikan yang menarik perhatian? Apa komentar anda?</label>
                        <div class="col-sm-12">
							<?php
							for($a=0;$a<=5;$a++)
								echo'<label class="radio-inline"><input type="radio" name="motivasi_p1" onchange="jummotivasi()" value="'.$a.'" '.(isset($data4[0]->motivasi_p1) && $data4[0]->motivasi_p1==$a ? "checked" : "").'>'.$a.'</label>';
							?>
                        </div>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-12 text-left"><span class="nomor">2.</span>Apa permasalahan paling berat yang pernah saudara alami selama sekolah di SMA? Bagaimana saudara menyelesaikan permasalahan tersebut?</label>
                        <div class="col-sm-12">
								<?php
								for($a=0;$a<=5;$a++)
									echo'<label class="radio-inline"><input id="getmot2" type="radio" name="motivasi_p2" onchange="jummotivasi()" value="'.$a.'" '.(isset($data4[0]->motivasi_p2) && $data4[0]->motivasi_p2==$a ? "checked" : "").'>'.$a.'</label>';
								?> 
                        </div>
						<p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-12 text-left"><span class="nomor">3.</span>Apakah saudara belajar dirumah setiap hari untuk mencapai prestasi?</label>
                        <div class="col-sm-12">
							<?php
							for($a=0;$a<=5;$a++)
								echo'<label class="radio-inline"><input type="radio" name="motivasi_p3" onchange="jummotivasi()" value="'.$a.'" '.(isset($data4[0]->motivasi_p3) && $data4[0]->motivasi_p3==$a ? "checked" : "").'>'.$a.'</label>';
							?>
                        </div>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-12 text-left"><span class="nomor">4.</span>Apakah saudara sering berdiskusi dengan teman, guru atau orang tua dalam menyelesaikan tugas sekolah?</label>
                        <div class="col-sm-12">
							<?php
							for($a=0;$a<=5;$a++)
								echo'<label class="radio-inline"><input type="radio" name="motivasi_p4" onchange="jummotivasi()" value="'.$a.'" '.(isset($data4[0]->motivasi_p4) && $data4[0]->motivasi_p4==$a ? "checked" : "").'>'.$a.'</label>';
							?>
                        </div>
						<p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-12 text-left"><span class="nomor">5.</span>Apa cita-cita saudara?</label>
                        <div class="col-sm-12">
							<?php
							for($a=0;$a<=5;$a++)
								echo'<label class="radio-inline"><input type="radio" name="motivasi_p5" onchange="jummotivasi()" value="'.$a.'" '.(isset($data4[0]->motivasi_p5) && $data4[0]->motivasi_p5==$a ? "checked" : "").'>'.$a.'</label>';
							?>
                        </div>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="control-label col-sm-12 text-left"><span class="nomor">6.</span>Apa yang saudara lakukan untuk mewujudkan cita-cita tersebut?</label>
                        <div class="col-sm-12">
							<?php
							for($a=0;$a<=5;$a++)
								echo'<label class="radio-inline"><input type="radio" name="motivasi_p6" onchange="jummotivasi()" value="'.$a.'" '.(isset($data4[0]->motivasi_p6) && $data4[0]->motivasi_p6==$a ? "checked" : "").'>'.$a.'</label>';
							?>
                        </div>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="form-group">
                        <div class="col-sm-12">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button class="btn btn-primary" type="button" onclick="prev()"><i class="fa fa-angle-double-left fa-fw"></i> Sebelumnya</button>
                            </div>
                            <span class="input-group-addon">Penilaian Motivasi Kuliah : </span>
                            <input id="motivasi" name="motivasi" type="number" class="form-control" value="<?php echo isset($data4[0]->nilai_motivasi) ? $data4[0]->nilai_motivasi : ''?>">
                            <div class="input-group-btn">
                                <button class="btn btn-primary" type="button" onclick="next()"><i class="fa fa-angle-double-right fa-fw"></i> Selesai</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-danger form-wawancara">
                <div class="panel-heading">
                    <h3 class="panel-title">Resume, Rekomendasi dan Kesimpulan</h3>
                </div>
                <div class="panel-body">
                    <div class="col-sm-8 no-padding">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th>Kategori Penilaian</th>
                                <th class="text-center">Nilai Max</th>
                                <th class="text-center" width="70px">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>A. Identitas</td>
                                <td class="text-center">10</td>
                                <td class="text-center">
                                    <div class="form-group form-group-sm no-margin">
                                        <div class="col-sm-12">
                                            <input id="getnilai" type="number" class="form-control" name="nilai_A" onkeyup="jumnilai()" value="<?php echo isset($data4[0]->nilai_identitas) ? $data4[0]->nilai_identitas : ''?>">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>B. Kemampuan Keuangan</td>
                                <td class="text-center">30</td>
                                <td class="text-center">
                                    <div class="form-group form-group-sm no-margin">
                                        <div class="col-sm-12">
                                            <input id="getmampu"type="number" class="form-control" name="nilai_B" onkeyup="jumnilai()" value="<?php echo isset($data4[0]->nilai_kemampuan_keuangan) ? $data4[0]->nilai_kemampuan_keuangan : ''?>">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>C. Motivasi Kuliah</td>
                                <td class="text-center">30</td>
                                <td class="text-center">
                                    <div class="form-group form-group-sm no-margin">
                                        <div class="col-sm-12">
                                            <input id="getmotivasi"type="number" class="form-control" name="nilai_C" onkeyup="jumnilai()" value="<?php echo isset($data4[0]->nilai_motivasi) ? $data4[0]->nilai_motivasi : ''?>">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>D. Kemampuan dan Perilaku</td>
                                <td class="text-center">30</td>
                                <td class="text-center">
                                    <div class="form-group form-group-sm no-margin">
                                        <div class="col-sm-12">
                                            <input id="getrencana" type="number" class="form-control" name="nilai_D" onkeyup="jumnilai()" value="<?php echo isset($data4[0]->nilai_akademik) ? $data4[0]->nilai_akademik : ''?>">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                            </tbody>
                            <tfoot> 
                                <tr>
                                <th class="text-right">Jumlah Penilaian</th>
                                <th class="text-center">100</th>
                                <th class="text-center">
                                    <div class="form-group form-group-sm no-margin">
                                        <div class="col-sm-12">
                                            <input id="jmlnilai" type="number" class="form-control" name="nilai_wwn">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                </th>
                                </tr>
                                <tr>
                                <th class="text-right">Nilai Test TPA</th>
                                <th class="text-center">600</th>
                                <th class="text-center">
                                    <div class="form-group form-group-sm no-margin">
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" name="nilai_tpa" value="<?php echo isset($data5[0]->skor) && isset($data4[0]->nilai_tpa)==null ? $data5[0]->skor : (isset($data4[0]->nilai_tpa) ? $data4[0]->nilai_tpa : '' ) ?>" readonly>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                </th>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="panel panel-primary" style="margin-bottom: 5px">
                            <div class="panel-heading">
                                <h3 class="panel-title">Detail Hasil Tes TPA:</h3>
                            </div>
                            <div class="panel-body">
                                <?php if(isset($data4[0]->nilai_tpa) && isset($data5[0]->skor)==null && ($data4[0]->nilai_tpa!=null || $data4[0]->nilai_tpa!='')) {?>
								<ul>
                                    <li>Skor : <strong><?php echo $data4[0]->nilai_tpa?></strong></li>
                                </ul>
								<?php } else if (isset($data5[0]->skor)) { ?>
                                <ul>
                                    <li>Jumlah Soal Dijawab : <strong><?php echo $data5[0]->dijawab.' dari '.$data5[0]->jml_soal.' soal' ?></strong></li>
                                    <li>Jawaban Benar : <strong><?php echo $data5[0]->benar ?></strong></li>
                                    <li>Jawaban Salah : <strong><?php echo $data5[0]->dijawab-$data5[0]->benar ?></strong></li>
                                    <li>Tidak Dijawab : <strong><?php echo $data5[0]->jml_soal-$data5[0]->dijawab ?></strong></li>
                                    <li>Skor : <strong><?php echo $data5[0]->skor==null?'0':$data5[0]->skor; ?><input type="hidden" name="nilai_tpa" value="<?php echo $data5[0]->skor==null?null:$data5[0]->skor; ?>" /></strong></li>
                                    <li>Prosentase : <strong><?php echo round(($data5[0]->skor/(10*$data5[0]->jml_soal))*100,2); ?>%</strong></li>
                                </ul>
                                <?php } else { ?>
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Pendaftar berikut belum melakukan test TPA</strong>
                                </div>
                                <?php } ?>
                            </div>
                        </div> 
                    </div>
                    <div class="col-sm-4 no-padding-right">
                        <p class=""><strong><u>KESIMPULAN</u></strong></p>
                        <div class="form-group form-group-sm valid required">
                            <div class="col-sm-12">
								<p class="help-block"></p>
                                <div class="radio">
                                    <label class="radio"><input type="radio" name="rekomendasi" value="diterima" <?php echo isset($data4[0]->rekomendasi) && $data4[0]->rekomendasi=="diterima"? "checked" : ''?>>Diterima</label>
                                </div>
                                <div class="radio">
                                    <label class="radio"><input type="radio" name="rekomendasi" value="ditolak" <?php echo isset($data4[0]->rekomendasi) && $data4[0]->rekomendasi=="ditolak" ? "checked" : ''?>>Ditolak</label>
                                </div>
                                <div class="radio">
                                    <label class="radio"><input type="radio" name="rekomendasi" value="ragu-ragu" <?php echo isset($data4[0]->rekomendasi) && $data4[0]->rekomendasi=="ragu-ragu" ? "checked" : ''?>>Ragu-ragu</label>
                                </div>
                            </div>
                        </div>
						<div class="form-group form-group-sm valid required">
                        <label class="control-label col-xs-12 text-left">Prodi yang dipilih</label>
                        <div class="col-xs-12">
								<select class="form-control" name="prodi">
									<option value="">- Pilih Salah Satu -</option>
									<?php 
										if (isset($data6)) {
											$sel="";
											foreach ($data6 as $row) { 
												if(isset($data4[0]->kd_proditawar) && $data4[0]->kd_proditawar==$row->kd_proditawar)
													$sel="selected";
												else if(isset($data1->prodi_pil1) && $data1->prodi_pil1==$row->kd_proditawar && isset($data4[0]->kd_proditawar)==null)
													$sel="selected";
												else 
													$sel="";
											?>
											<option value="<?php echo $row->kd_proditawar ?>" <?php echo $sel; ?>><?php echo $row->prodi ?></option>
										<?php }} ?>
								</select>
								<p class="help-block"></p>
							</div>
						</div>
                        <p class="no-margin">Catatan:</p>
                        <div class="form-group form-group-sm">
                            <div class="col-sm-12">
                                <textarea class="form-control" name="catatan" rows="3"><?php echo isset($data4[0]->catatan) ? $data4[0]->catatan : ''?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button class="btn btn-primary" type="button" onclick="prev()"><i class="fa fa-angle-double-left fa-fw"></i> Sebelumnya</button>
                            <button class="btn btn-primary" type="submit" name="id" value="<?php echo $new_id ?>"><i class="fa fa-save fa-fw"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>

        </div>

        <div class="col-sm-12 text-center">
        <ul class="pagination pagination-sm">
          <?php  echo $this->pagination->create_links(); ?>
        </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
    var no;
    var pnl = $(".form-wawancara");

    $(function(){
        $(".hide-pt").hide();
        $(".un").hide();
        $(".sb").hide();
        no = 0;
        $(pnl).hide();
        $(pnl[no]).show();
    });

    function hide_pt(a) {
        if (a=="1") {
            $(".hide-pt").show();
        } else {
            $(".hide-pt").hide();
        }
    }

    function lain(a){
        if (a) {
            $("input[name=ingin_lain]").prop("readonly",false);
        } else {
            $("input[name=ingin_lain]").prop("readonly",true);
        }
    }

    function un_hide(a){
        $(".un").hide();
        cls = "."+a;
        $(".un"+cls).show();
    }

    function src_biaya(a){
		if(a!=''){
			$(".sb").hide();
			cls = "."+a;
			$(".sb"+cls).show();
		} 
    }
	
    function next(){
        no++;
        $(pnl).hide();
        $(pnl[no]).show();
        $('html, body').animate({scrollTop: 0}, 500);
		
		var nilai=$("#nilai").val();
		var mampu=$("#mampu").val();
		var motivasi=$("#motivasi").val();
		var rencana=$("#rencana").val();
		a1= nilai !=null ? parseInt(nilai) : 0;
		a2= mampu !=null ? parseInt(mampu) : 0;
		a3= motivasi !=null ? parseInt(motivasi) : 0;
		a4= rencana !=null ? parseInt(rencana) : 0;
		jum =(a1+a2+a3+a4);
		$("#getnilai").val(nilai);
		$("#getmampu").val(mampu);
		$("#getmotivasi").val(motivasi);
		$("#getrencana").val(rencana);
		$("#jmlnilai").val(jum);
    }

    function prev(){
        no--;
        $(pnl).hide();
        $(pnl[no]).show();
        $('html, body').animate({scrollTop: 0}, 500);
    }
	function jumnilai(){
		var nilai=$("#getnilai").val();
		var mampu=$("#getmampu").val();
		var motivasi=$("#getmotivasi").val();
		var rencana=$("#getrencana").val();
		a1= nilai !=null ? parseInt(nilai) : 0;
		a2= mampu !=null ? parseInt(mampu) : 0;
		a3= motivasi !=null ? parseInt(motivasi) : 0;
		a4= rencana !=null ? parseInt(rencana) : 0;
		jum =(a1+a2+a3+a4);
		$("#jmlnilai").val(jum);
		$("#nilai").val(nilai);
		$("#motivasi").val(motivasi);
	}
	function jummotivasi(){
		var mot1=$('input[name=motivasi_p1]:checked').val();
		var mot2=$('input[name=motivasi_p2]:checked').val();
		var mot3=$('input[name=motivasi_p3]:checked').val();
		var mot4=$('input[name=motivasi_p4]:checked').val();
		var mot5=$('input[name=motivasi_p5]:checked').val();
		var mot6=$('input[name=motivasi_p6]:checked').val();
		a1= mot1 !=null ? parseInt(mot1) : 0;
		a2= mot2 !=null ? parseInt(mot2) : 0;
		a3= mot3 !=null ? parseInt(mot3) : 0;
		a4= mot4 !=null ? parseInt(mot4) : 0;
		a5= mot5 !=null ? parseInt(mot5) : 0;
		a6= mot6 !=null ? parseInt(mot6) : 0;
		jum =(a1+a2+a3+a4+a5+a6);
		$("#motivasi").val(jum);
	}
	window.onload = function() {
		jumnilai();
		hide_pt($('input[name=dft_ptlain]:checked').val());
		un_hide($('input[name=jur_sekolah]:checked').val());
		src_biaya($('#sumberbiaya').val());
	};
	function lompat(e){
		if(e.keyCode==13){
			window.location.href="<?php echo base_url().index_page().'admin/test/wawancara/';?>"+$("#searchbox").val();
			return false;
		}
	}
	function cari(){
		var nilai=$('#searchbox').val();
		if(nilai!=''){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url().index_page();?>admin/ajax/getCariWawancara",
				data: {<?php echo $csrf ?>,'key':nilai},
				cache: false,
				success: function(data)
				{
					if(data==nilai)
						window.location.href="<?php echo base_url().index_page().'admin/test/wawancara/'?>"+nilai;
					else
						$("#display").html(data).show();	
				}
			});
		}
		$("#display").hide();		
	}

</script>
<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>
