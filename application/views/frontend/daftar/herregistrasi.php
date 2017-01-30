<div class="row">
    <div class="col-md-12">
        <div class="detail">
            <div class="detail-heading">
                <h1 class="page-header">Formulir Her Registrasi</h1>
            </div>
            <div class="detail-body">
				<?php echo isset($data19) ? $data19 : "";  ?>
                <?php if (count($data1)>0) { ?>
				<?php echo form_open('maba/herregistrasi/simpan',array('class'=>'form-horizontal')) ?>
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Pendaftaran</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group form-group-sm">
                                        <label class="control-label col-sm-4 text-left">No. Pendaftaran</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo $data1->iddaftar; ?></p>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6"> 
                                    <div class="form-group form-group-sm">
                                        <label class="control-label col-sm-4 text-left">Fakultas</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo $data1->nama_fakultas; ?></p>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-sm">
                                        <label class="control-label col-sm-4 text-left">Program Studi</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><?php echo $data1->nama_jenjang.' '.$data1->nama_jurusan.' '.$data1->nama_program; ?></p>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Diri Mahasiswa</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Nama Mahasiswa</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm" name="nama" value="<?php echo $data1->nama?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Tempat Lahir</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm" name="tmp_lahir" value="<?php echo $data1->tmp_lahir?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Tanggal Lahir</label>
                                <div class="col-sm-4">
                                    <div class='input-group date'>
                                        <input type='text' class="form-control input-sm" name="tgl_lahir" data-date-format="DD-MM-YYYY" value='<?php echo $data1->tgl_lahir_id!="00-00-0000"?$data1->tgl_lahir_id:"";?>'>
                                        <span class="input-group-addon input-sm">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <p class="help-block-2">DD-MM-YYYY</p>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Golongan Darah</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="goldar">
                                        <option value="">- Pilih -</option>
                                        <option value="A" <?php echo $data1->goldar=="A" ? 'selected' : ''?>>A</option>
                                        <option value="B" <?php echo $data1->goldar=="B" ? 'selected' : ''?>>B</option>
                                        <option value="AB"<?php echo $data1->goldar=="AB" ? 'selected' : ''?>>AB</option>
                                        <option value="O" <?php echo $data1->goldar=="O" ? 'selected' : ''?>>O</option>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Jenis Kelamin</label>
                                <div class="col-sm-2">
                                    <select id="sex" class="form-control" name="sex">
    									<option value="">- Pilih -</option>
    									<option value="P" <?php echo $data1->sex=="P" ? 'selected' : ''?>>Laki-Laki</option>
    									<option value="W" <?php echo $data1->sex=="W" ? 'selected' : ''?>>Perempuan</option>
    								</select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Warga Negara</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="warga_negara">
                                        <option value="">- Pilih -</option>
    									<option value="WNI" <?php echo $data1->wn=="WNI" ? 'selected' : ''?>>WNI</option>
    									<option value="WNA" <?php echo $data1->wn=="WNA" ? 'selected' : ''?>>WNA</option>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Status Mahasiswa</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="status_mhs">
                                        <option value="1" <?php echo $data1->stt_mhs=="1" ? 'selected' : ''?>>Biasa</option>
                                        <option value="2" <?php echo $data1->stt_mhs=="2" ? 'selected' : ''?>>Beasiswa</option>
                                        <option value="3" <?php echo $data1->stt_mhs=="3" ? 'selected' : ''?>>Tugas Belajar</option>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Biaya Pembiayaan</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="pembiayaan">
                                        <option value="">- Pilih -</option>
                                        <option value="1" <?php echo $data1->pembiayaan=="1" ? 'selected' : ''?>>Orang Tua/Wali</option>
                                        <option value="2" <?php echo $data1->pembiayaan=="2" ? 'selected' : ''?>>Sendiri</option>
                                        <option value="3" <?php echo $data1->pembiayaan=="3" ? 'selected' : ''?>>Instansi/Kantor</option>                                                                      
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Agama</label>
                                <div class="col-sm-4">
                                    <select id="agama" class="form-control" name="agama">
    									<option value="">- Pilih Agama -</option>
    									<?php 
										foreach ($data2 as $row) {
											echo '<option value="'.$row->kd_agama.'" '.(isset($data1->agama) && $data1->agama==$row->kd_agama ? 'selected' : '').'>'.$row->nama.'</option>';
										}
    									?>
    								</select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Jumlah Saudara</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" name="jml_saudara" value="<?php echo $data1->jml_saudara ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Status Pernikahan</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="kawin" onchange="sttkawin($(this).val())">
                                        <option value="">- Pilih -</option>
                                        <option value="T" <?php echo $data1->kawin=="T" ? 'selected' : ''?>>Belum Menikah</option>
                                        <option value="Y" <?php echo $data1->kawin=="Y" ? 'selected' : ''?>>Sudah Menikah</option>                                                                
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Alamat Asal</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-sm-4 text-left">Propinsi</label>
                                    <div class="col-sm-8">
                                        <select id="prop_asal" class="form-control" name="prop_asal" onchange="getlokasi('prop_asal','kota_asal','getKota','kec_asal')">
                                            <option value=''>- Pilih Propinsi -</option>
                                            <?php 
                                                foreach ($data3 as $row) {
                                                    echo '<option value="'.$row->kd_propinsi.'"'.(isset($data1->prop_asal) && $data1->prop_asal==$row->kd_propinsi ? 'selected' : '').'>'.$row->nama_propinsi.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-sm-4 text-left">Kabupaten</label>
                                    <div class="col-sm-8">
                                        <select id="kota_asal" class="form-control" name="kab_asal" onchange="getlokasi('kota_asal','kec_asal','getKecamatan')">
                                            <option value=''>- Pilih Kota -</option>
                                            <?php 
                                                foreach ($data4 as $row) {
                                                    echo '<option value="'.$row->kd_kota.'"'.(isset($data1->kab_asal) && $data1->kab_asal==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-sm-4 text-left">Kecamatan</label>
                                    <div class="col-sm-8">
                                        <select id="kec_asal" class="form-control" name="kec_asal">
                                            <option value=''>- Pilih Kecamatan -</option>
                                            <?php 
                                                foreach ($data5 as $row) {
                                                    echo '<option value="'.$row->kd_kecamatan.'"'.(isset($data1->kec_asal) && $data1->kec_asal==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-sm-4 text-left">Alamat</label>
                                    <div class="col-sm-8">
                                        <textarea rows=3 type="text" class="form-control input-sm" name="alamat_asal" id="alamat_asal" ><?php echo $data1->alamat_asal?></textarea>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-sm-4 text-left">Telp.</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="telp" value="<?php echo $data1->telp ?>">
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- end of alamat asal -->
                            <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Alamat Sekarang</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group form-group-sm">
                                    <label class="control-label col-sm-4 text-left">Propinsi</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="Prop. D.I. Yogyakarta" readonly>
                                        <p class="help-block"></p>
                                    </div>  
                                </div>
                                <div class="form-group form-group-sm">
                                    <label class="control-label col-sm-4 text-left">Kabupaten</label>
                                    <div class="col-sm-8">
										<select id="kota_sekarang" class="form-control" name="kab_skrg" onchange="getlokasi('kota_sekarang','kec_sekarang','getKecamatan')">
											<option value=''>- Pilih Kota-</option>
											<?php 
												foreach ($data6 as $row) {
													echo '<option value="'.$row->kd_kota.'" '.(isset($data1->kab_skrg) && $data1->kab_skrg==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
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
												foreach ($data7 as $row) {
													echo '<option value="'.$row->kd_kecamatan.'" '.(isset($data1->kec_skrg) && $data1->kec_skrg==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
												}
											?>
										</select>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label class="control-label col-sm-4 text-left">Alamat</label>
                                    <div class="col-sm-8">
                                        <textarea rows=3 type="text" class="form-control input-sm" name="alamat_skrg" id="alamat_skrg" ><?php echo isset($data1->alamat_skrg) ? $data1->alamat_skrg : ''?></textarea>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Pendidikan</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Prov. Sekolah</label>
                                <div class="col-sm-5">
                                    <select id="prop_sekolah" class="form-control" name="prop_sekolah" onchange="getlokasi('prop_sekolah','kota_sekolah','getKota','kec_sekolah','kd_sekolah')">
										<option value=''>- Pilih Propinsi-</option>
										<?php 
											foreach ($data3 as $row) {
												echo '<option value="'.$row->kd_propinsi.'" '.(isset($data1->prop_sekolah) && $data1->prop_sekolah==$row->kd_propinsi ? 'selected' : '').'>'.$row->nama_propinsi.'</option>';
											}
										?>
									</select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Kota Sekolah</label>
                                <div class="col-sm-5">
									<select id="kota_sekolah" class="form-control" name="kota_sekolah" onchange="getlokasi('kota_sekolah','kec_sekolah','getKecamatan','kd_sekolah')">
										<option value=''>- Pilih Kota-</option>
										<?php 
											foreach ($data8 as $row) {
												echo '<option value="'.$row->kd_kota.'" '.(isset($data1->kota_sekolah) && $data1->kota_sekolah==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
											}
										?>
									</select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
							<div class="form-group form-group-sm valid required">
								<label class="control-label col-sm-3 text-left">Kecamatan</label>
								<div class="col-sm-5">
									<select id="kec_sekolah" class="form-control" name="kec_sekolah" onchange="getlokasi('kec_sekolah','kd_sekolah','getSekolah')">
										<option value=''>- Pilih Kecamatan-</option>
										<?php 
											foreach ($data9 as $row) {
												echo '<option value="'.$row->kd_kecamatan.'" '.(isset($data1->kec_sekolah) && $data1->kec_sekolah==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
											}
										?>
									</select>
									<p class="help-block"></p>
								</div> 
							</div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Sekolah</label>
                                <div class="col-sm-6">
                                    <select id="kd_sekolah" class="form-control" name="kd_sekolah">
										<option value=''>- Pilih Sekolah-</option>
										<?php 
												foreach ($data10 as $row) {
														echo '<option value="'.$row->kd_sekolah.'" '.(isset($data1->kd_sekolah) && $data1->kd_sekolah==$row->kd_sekolah ? 'selected' : '').'>'.$row->nama_sekolah.'</option>';
												}
										?>
									</select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Jurusan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control input-sm" name="jurusan" id="jurusan" value="<?php echo isset($data1->jurusan) ? $data1->jurusan : ''?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Danem/IPK</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm" name="rerata_uan" id="rerata_uan" value="<?php echo isset($data1->rerata_uan) ? $data1->rerata_uan : ''?> " >
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Tahun Kelulusan</label>
                                <div class="col-sm-3">
                                    <select id="lulus" class="form-control" name="thn_lulus">
										<option value="0">- pilih -</option>
										<?php 
											for($a=2009;$a<=date('Y');$a++){
												echo '<option value="'.$a.'" '.(isset($data1->thn_lulus) && $data1->thn_lulus==$a ? 'selected' : '').'>'.$a.'</option>';
											}
										?>
									</select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">No Ijazah</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control input-sm" name="no_sttb" id="no_sttb" value="<?php echo $data1->no_sttb ?>">
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
                                    <input type="text" name="instansi" class="form-control" value="<?php echo $data1->instansi ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Pangkat/Golongan</label>
                                <div class="col-sm-5">
                                    <input type="text" name="gol" class="form-control" value="<?php echo $data1->gol ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Jabatan</label>
                                <div class="col-sm-5">
                                    <input type="text" name="jabatan" class="form-control" value="<?php echo $data1->jabatan ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Ayah</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Nama</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_ayah" class="form-control" value="<?php echo $data1->nama_ayah ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Provinsi</label>
                                <div class="col-sm-5">
                                    <select id="prop_ayah" class="form-control" name="prop_ayah" onchange="getlokasi('prop_ayah','kota_ayah','getKota','kec_ayah')">
                                        <option value="">- Pilih -</option>
									<?php 
										foreach ($data3 as $row) {
											echo '<option value="'.$row->kd_propinsi.'"'.(isset($data1->prop_ayah) && $data1->prop_ayah==$row->kd_propinsi ? 'selected' : '').'>'.$row->nama_propinsi.'</option>';
										}
									?>																
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Kabupaten</label>
                                <div class="col-sm-5">
                                    <select id="kota_ayah" class="form-control" name="kab_ayah" onchange="getlokasi('kota_ayah','kec_ayah','getKecamatan')">
                                        <option value="">- Pilih -</option>
									<?php 
										foreach ($data11 as $row) {
											echo '<option value="'.$row->kd_kota.'" '.(isset($data1->kab_ayah) && $data1->kab_ayah==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
										}
									?>																	
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Kecamatan</label>
                                <div class="col-sm-5">
                                    <select id="kec_ayah" class="form-control" name="kec_ayah" >														
									<?php 
										foreach ($data12 as $row) {
											echo '<option value="'.$row->kd_kecamatan.'" '.(isset($data1->kec_ayah) && $data1->kec_ayah==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
										}
									?>														
									</select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Alamat</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="alamat_ayah" rows="3"><?php echo $data1->alamat_ayah ?></textarea>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Telp.</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="telpon_ayah" value="<?php echo $data1->telpon_ayah ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Pendidikan</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="pendidikan_ayah">
                                        <option value="">- Pilih -</option>
										<option value="SD" <?php echo $data1->pendidikan_ayah=="SD" ? 'selected' : ''?>>SD</option>
										<option value="SMP" <?php echo $data1->pendidikan_ayah=="SMP" ? 'selected' : ''?>>SMP</option>
										<option value="SMA" <?php echo $data1->pendidikan_ayah=="SMA" ? 'selected' : ''?>>SMA</option>
										<option value="PT" <?php echo $data1->pendidikan_ayah=="PT" ? 'selected' : ''?>>P.Tinggi</option>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Pekerjaan</label>
                                <div class="col-sm-5">
                                    <input type="text" name="pekerjaan_ayah" class="form-control" value="<?php echo $data1->pekerjaan_ayah ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Instansi</label>
                                <div class="col-sm-5">
                                    <input type="text" name="instansi_ayah" class="form-control" value="<?php echo $data1->instansi_ayah ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Pangkat/Golongan</label>
                                <div class="col-sm-5">
                                    <input type="text" name="gol_ayah" class="form-control" value="<?php echo $data1->gol_ayah ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Status</label>
                                <div class="col-sm-7">
                                    <label class="radio-inline">
                                        <input type="radio" name="hidup_ayah" value="Y" <?php echo $data1->hidup_ayah=='Y' ? 'checked' : ''?>>Masih Hidup
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="hidup_ayah" value="T" <?php echo $data1->hidup_ayah=='T' ? 'checked' : ''?>>Sudah Meninggal
                                    </label>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Ibu</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Nama</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_ibu" class="form-control" value="<?php echo $data1->nama_ibu ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Provinsi</label>
                                <div class="col-sm-5">
                                    <select id="prop_ibu" class="form-control" name="prop_ibu" onchange="getlokasi('prop_ibu','kota_ibu','getKota')">
                                        <option value="">- Pilih -</option>
									<?php 
										foreach ($data3 as $row) {
											echo '<option value="'.$row->kd_propinsi.'"'.(isset($data1->prop_ibu) && $data1->prop_ibu==$row->kd_propinsi ? 'selected' : '').'>'.$row->nama_propinsi.'</option>';
										}
									?>															
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Kabupaten</label>
                                <div class="col-sm-5">
                                    <select id="kota_ibu" class="form-control" name="kab_ibu" onchange="getlokasi('kota_ibu','kec_ibu','getKecamatan')">
                                        <option value="">- Pilih -</option>
									<?php 
										foreach ($data13 as $row) {
											echo '<option value="'.$row->kd_kota.'" '.(isset($data1->kab_ibu) && $data1->kab_ibu==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
										}
									?>																
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Kecamatan</label>
                                <div class="col-sm-5">
                                    <select id="kec_ibu" class="form-control" name="kec_ibu" >														
									<?php 
										foreach ($data14 as $row) {
											echo '<option value="'.$row->kd_kecamatan.'" '.(isset($data1->kec_ibu) && $data1->kec_ibu==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
										}
									?>														
									</select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Alamat</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="alamat_ibu" rows="3"><?php echo $data1->alamat_ibu ?></textarea>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Telp.</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="telpon_ibu" value="<?php echo $data1->telpon_ibu ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Pendidikan</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="pendidikan_ibu">
                                        <option value="">- Pilih -</option>
                                        <option value="SD" <?php echo $data1->pendidikan_ibu=="SD" ? 'selected' : ''?>>SD</option>
                                        <option value="SMP" <?php echo $data1->pendidikan_ibu=="SMP" ? 'selected' : ''?>>SMP</option>
                                        <option value="SMA" <?php echo $data1->pendidikan_ibu=="SMA" ? 'selected' : ''?>>SMA</option>
                                        <option value="PT" <?php echo $data1->pendidikan_ibu=="PT" ? 'selected' : ''?>>P.Tinggi</option>														
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Pekerjaan</label>
                                <div class="col-sm-5">
                                    <input type="text" name="pekerjaan_ibu" class="form-control" value="<?php echo $data1->pekerjaan_ibu ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Instansi</label>
                                <div class="col-sm-5">
								<input type="text" name="instansi_ibu" class="form-control" value="<?php echo $data1->instansi_ibu ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Pangkat/Golongan</label>
                                <div class="col-sm-5">
                                    <input type="text" name="gol_ibu" class="form-control" value="<?php echo $data1->gol_ibu ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3 text-left">Status</label>
                                <div class="col-sm-7">
                                    <label class="radio-inline">
                                        <input type="radio" name="hidup_ibu" value="Y" <?php echo $data1->hidup_ibu=='Y' ? 'checked' : ''?>>Masih Hidup
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="hidup_ibu" value="T" <?php echo $data1->hidup_ibu=='T' ? 'checked' : ''?>>Sudah Meninggal
                                    </label>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Wali</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Nama</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_wali" class="form-control" value="<?php echo $data1->nama_wali ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Provinsi</label>
                                <div class="col-sm-5">
                                    <select id="prop_wali" class="form-control" name="prop_wali" onchange="getlokasi('prop_wali','kota_wali','getKota')">
                                        <option value="">- Pilih -</option>
                                    <?php 
                                        foreach ($data3 as $row) {
                                            echo '<option value="'.$row->kd_propinsi.'"'.(isset($data1->prop_wali) && $data1->prop_wali==$row->kd_propinsi ? 'selected' : '').'>'.$row->nama_propinsi.'</option>';
                                        }
                                    ?>                                                          
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Kabupaten</label>
                                <div class="col-sm-5">
                                    <select id="kota_wali" class="form-control" name="kab_wali" onchange="getlokasi('kota_wali','kec_wali','getKecamatan')">
                                        <option value="">- Pilih -</option>
                                    <?php 
                                        foreach ($data15 as $row) {
                                            echo '<option value="'.$row->kd_kota.'" '.(isset($data1->kab_wali) && $data1->kab_wali==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
                                        }
                                    ?>                                                              
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Kecamatan</label>
                                <div class="col-sm-5">
                                    <select id="kec_wali" class="form-control" name="kec_wali" >                                                      
                                    <?php 
                                        foreach ($data16 as $row) {
                                            echo '<option value="'.$row->kd_kecamatan.'" '.(isset($data1->kec_wali) && $data1->kec_wali==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
                                        }
                                    ?>                                                      
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Alamat</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="alamat_wali" rows="3"><?php echo $data1->alamat_wali ?></textarea>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Telp.</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="telpon_wali" value="<?php echo $data1->telpon_wali ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Pendidikan</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="pendidikan_wali">
                                        <option value="">- Pilih -</option>
                                        <option value="SD" <?php echo $data1->pendidikan_wali=="SD" ? 'selected' : ''?>>SD</option>
                                        <option value="SMP" <?php echo $data1->pendidikan_wali=="SMP" ? 'selected' : ''?>>SMP</option>
                                        <option value="SMA" <?php echo $data1->pendidikan_wali=="SMA" ? 'selected' : ''?>>SMA</option>
                                        <option value="PT" <?php echo $data1->pendidikan_wali=="PT" ? 'selected' : ''?>>P.Tinggi</option>                                                        
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Pekerjaan</label>
                                <div class="col-sm-5">
                                    <input type="text" name="pekerjaan_wali" class="form-control" value="<?php echo $data1->pekerjaan_wali ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Instansi</label>
                                <div class="col-sm-5">
                                <input type="text" name="instansi_wali" class="form-control" value="<?php echo $data1->instansi_wali ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Pangkat/Golongan</label>
                                <div class="col-sm-5">
                                    <input type="text" name="gol_wali" class="form-control" value="<?php echo $data1->gol_wali ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Status</label>
                                <div class="col-sm-7">
                                    <label class="radio-inline">
                                        <input type="radio" name="hidup_wali" value="Y" <?php echo $data1->hidup_wali=='Y' ? 'checked' : ''?>>Masih Hidup
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="hidup_wali" value="T" <?php echo $data1->hidup_wali=='T' ? 'checked' : ''?>>Sudah Meninggal
                                    </label>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary" id="sutri">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Suami/Istri</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Nama</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_sutri" class="form-control" value="<?php echo $data1->nama_sutri ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Provinsi</label>
                                <div class="col-sm-5">
                                    <select id="prop_sutri" class="form-control" name="prop_sutri" onchange="getlokasi('prop_sutri','kota_sutri','getKota')">
                                        <option value="">- Pilih -</option>
                                    <?php 
                                        foreach ($data3 as $row) {
                                            echo '<option value="'.$row->kd_propinsi.'"'.(isset($data1->prop_sutri) && $data1->prop_sutri==$row->kd_propinsi ? 'selected' : '').'>'.$row->nama_propinsi.'</option>';
                                        }
                                    ?>                                                          
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Kabupaten</label>
                                <div class="col-sm-5">
                                    <select id="kota_sutri" class="form-control" name="kab_sutri" onchange="getlokasi('kota_sutri','kec_sutri','getKecamatan')">
                                        <option value="">- Pilih -</option>
                                    <?php 
                                        foreach ($data17 as $row) {
                                            echo '<option value="'.$row->kd_kota.'" '.(isset($data1->kab_sutri) && $data1->kab_sutri==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
                                        }
                                    ?>                                                              
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Kecamatan</label>
                                <div class="col-sm-5">
                                    <select id="kec_sutri" class="form-control" name="kec_sutri" >                                                      
                                    <?php 
                                        foreach ($data18 as $row) {
                                            echo '<option value="'.$row->kd_kecamatan.'" '.(isset($data1->kec_sutri) && $data1->kec_sutri==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
                                        }
                                    ?>                                                      
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Alamat</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="alamat_sutri" rows="3"><?php echo $data1->alamat_sutri ?></textarea>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Telp.</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="telpon_sutri" value="<?php echo $data1->telpon_sutri ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Pendidikan</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="pendidikan_sutri">
                                        <option value="">- Pilih -</option>
                                        <option value="SD" <?php echo $data1->pendidikan_sutri=="SD" ? 'selected' : ''?>>SD</option>
                                        <option value="SMP" <?php echo $data1->pendidikan_sutri=="SMP" ? 'selected' : ''?>>SMP</option>
                                        <option value="SMA" <?php echo $data1->pendidikan_sutri=="SMA" ? 'selected' : ''?>>SMA</option>
                                        <option value="PT" <?php echo $data1->pendidikan_sutri=="PT" ? 'selected' : ''?>>P.Tinggi</option>                                                        
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Pekerjaan</label>
                                <div class="col-sm-5">
                                    <input type="text" name="pekerjaan_sutri" class="form-control" value="<?php echo $data1->pekerjaan_sutri ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Instansi</label>
                                <div class="col-sm-5">
                                <input type="text" name="instansi_sutri" class="form-control" value="<?php echo $data1->instansi_sutri ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Pangkat/Golongan</label>
                                <div class="col-sm-5">
                                    <input type="text" name="gol_sutri" class="form-control" value="<?php echo $data1->gol_sutri ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="control-label col-sm-3 text-left">Status</label>
                                <div class="col-sm-7">
                                    <label class="radio-inline">
                                        <input type="radio" name="hidup_sutri" value="Y" <?php echo $data1->hidup_sutri=='Y' ? 'checked' : ''?>>Masih Hidup
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="hidup_sutri" value="T" <?php echo $data1->hidup_sutri=='T' ? 'checked' : ''?>>Sudah Meninggal
                                    </label>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>

					<p class="text-right">
						<button type="submit" class="btn btn-primary btn-lg">Simpan</button>
						</p>
                    <?php } else { ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                      <strong style="font-size:18px;"><i class="fa fa-info-circle fa-fw"></i>Error!</strong><br>
                        Tidak ditemukan data pendaftar, silahkan <a href="<?php echo base_url().index_page() ?>/maba/logout">logout</a> kemudian login lagi.
                    </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url().index_page(); ?>assets/js/validasi.js"></script>
<script type="text/javascript">
    $(function () {
        $('.date').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },pickTime: false

        });
        sttkawin($("select[name=kawin]").val());
    });

    function sttkawin(a){
        if (a=="Y") {
            $("#sutri").show();
        } else {
            $("#sutri").hide();
        }
    }

	function getlokasi(nil1,nil2,nil3,nil4,nil5){
	   var nilai=$('#'+nil1).val();
	   
		   $.ajax({
				type: "POST",
				url: "<?php echo base_url();?>ajax/"+nil3,
				data:{<?php echo $csrf ?>,'id':nilai},
				dataType:'html',
				success: function(data){	
					$('#'+nil2).html(data);
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
	
</script>