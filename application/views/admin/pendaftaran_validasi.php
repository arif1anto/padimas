<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Isian Data Pendaftar</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Pendaftar</h3>
                </div>
                <div class="panel-body">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6">
								<div class="panel">
									<div class="panel-heading input-sm">
										<h3 class="panel-title" style="margin-bottom:5px;"><i class="fa fa-search"></i> Pencarian Data Pendaftar</h3>
										<input type="text" class="form-control input-sm" name="searchbox" id="searchbox" placeholder="Ketikan nomor pendaftaran atau nama pendaftar!" onkeyup="cari()" onkeydown="lompat(event)" autocomplete="off">
										<div id="display">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php echo form_open('',array('class'=>'form-horizontal')) ?>
						<div class="col-sm-6">		
							<div class="form-group form-group-sm valid required">
								<label class="control-label col-sm-3">No Pendaftaran</label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-sm" name="iddaftar" id="iddaftar" value="<?php echo isset($data6->id_daftar) ? $data6->id_daftar : ''?>">
									<p class="help-block"></p>
								</div>
							</div>
							<div class="form-group form-group-sm valid required">
								<label class="control-label col-sm-3">Jenis pendaftaran</label>
								<div class="col-sm-9">
									<select id="jenisprog" class="form-control" name="stat_daftar">
									<?php 
									if (count($data1)>0) {
										$i=0;
										foreach ($data1 as $row) {
												echo '<option value="'.$row->prg_id.'" '.(isset($data6->jalur_pendaftaran) && $data6->jalur_pendaftaran==$row->prg_id ? 'selected' : '').'>'.$row->prg_nama.'</option>';
										}
									}
									?>
									</select>
									<p class="help-block"></p>
								</div>
							</div>
                            <div class="form-group form-group-sm">
                                <label class="col-sm-3 control-label">Ingin Tes Tanggal</label>
                                <div class="col-sm-6">
                                    <div class="radio">
                                    <label>
                                      <input type="radio" name="tgltes" value="1" <?php echo (isset($data6->stttgltes)?$data6->stttgltes:1)==1?"checked":""; ?> onchange="settgltes($(this).val())"> Hari ini
                                    </label>
                                    </div>
                                    <div class="radio">
                                    <label>
                                      <input type="radio" name="tgltes" value="2" <?php echo (isset($data6->stttgltes)?$data6->stttgltes:1)==1?"":"checked";?> onchange="settgltes($(this).val())"> Tanggal
                                    </label>
                                    </div>
                                    <div class='input-group date' style="margin-left:20px;">
                                        <?php 
                                            $tgltes = isset($data6->tgl_test_id)==false || $data6->tgl_test_id==null || date("d-m-Y",strtotime($data6->tgl_test_id))=="00-00-0000"? date("d-m-Y"):date("d-m-Y",strtotime($data6->tgl_test_id));
                                         ?>
                                        <input type='text' class="form-control input-sm" name="tgl_test" data-date-format="DD-MM-YYYY" value='<?php echo isset($data6->stttgltes) && $data6->stttgltes==1?"":$tgltes;?>'>
                                        <span class="input-group-addon input-sm">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <p class="help-block-2" style="margin-left:20px;">DD-MM-YYYY</p>
                                    <p class="help-block"></p>
                                </div>
                            </div>
							<hr>
							<div class="form-group form-group-sm valid required">
								<label class="control-label col-sm-3">Pilihan Prodi 1</label>
								<div class="col-sm-5">
									<select class="form-control" name="prodi1">
									<option value=''>- Pilih Program Studi -</option>
									<?php 
									if (isset($data2)) {
										$i=0;
										foreach ($data2 as $row) { ?>
										<option value="<?php echo $row->kd_proditawar ?>" <?php echo isset($data6->prodi_pil1) && $data6->prodi_pil1==$row->kd_proditawar ? 'selected' : '' ?>><?php echo $row->prodi ?></option>
									<?php }} ?>
									</select>
									<p class="help-block"></p>
								</div>
							</div>
							<div class="form-group form-group-sm required">
								<label class="control-label col-sm-3">Pilihan Prodi 2</label>
								<div class="col-sm-5">
									<select class="form-control" name="prodi2" <?php echo isset($data6->jml_pilihan) && $data6->jml_pilihan==2 ? '' : 'disabled' ?>>
									<option value=''>- Pilih Program Studi -</option>
									<?php 
									if (isset($data3)) {
										$i=0;
										foreach ($data3 as $row) { ?>
										<option value="<?php echo $row->kd_proditawar ?>" <?php echo isset($data6->prodi_pil2) && $data6->prodi_pil2==$row->kd_proditawar ? 'selected' : '' ?>><?php echo $row->prodi ?></option>
									<?php }} ?>
									</select>
									<p class="help-block"></p>
								</div>
								<div class="col-sm-4 checkbox">
									<label class="checkbox  input-sm">
										<input type="checkbox" name="alumni" id="alumni" <?php echo isset($data6->alumni) && $data6->alumni==true ? 'checked' : ''?>>Alumni 
									</label>
								</div>
							</div>
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Data Sekolah</h3>
								</div>
								<div class="panel-body">
									<div class="partsekolah form-group form-group-sm valid required">
										<label class="control-label col-sm-3">Propinsi</label>
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
									<div class="partsekolah form-group form-group-sm valid required">
										<label class="control-label col-sm-3">Kabupaten</label>
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
									<div class="partsekolah form-group form-group-sm valid required">
										<label class="control-label col-sm-3">Kecamatan</label>
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
									<div class="form-group form-group-sm valid required">
										<label class="control-label col-sm-3">Asal Sekolah</label>
										<div class="col-sm-9">
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
											<div id="showcarisekolah" style="width:400px !important;" class="display"></div>
											<p class="help-block"></p>
										</div>
									</div>
									<div class="form-group form-group-sm valid required">
										<label class="control-label col-sm-3">Asal Jurusan</label>
										<div class="col-sm-9">
											<input type="text" class="form-control input-sm" name="jurusan" id="jurusan" value="<?php echo isset($data6->jurusan) ? $data6->jurusan : ''?>">
											<p class="help-block"></p>
										</div>
									</div>
									<div class="form-group form-group-sm">
										<label class="control-label col-sm-3">Kelulusan</label>
										<div class="col-sm-3">
											<select id="lulus" class="form-control" name="sdh_lulus">
												<option value="0" <?php echo isset($data6->sdh_lulus) && $data6->sdh_lulus==0 ? 'selected' : ''?>>Belum Lulus</option>
												<option value="1" <?php echo isset($data6->sdh_lulus) && $data6->sdh_lulus==1 ? 'selected' : ''?>>Lulus</option>
											</select>
											<p class="help-block"></p>
										</div>
										<label class="control-label col-sm-3">Tahun Lulus</label>
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
										<label class="control-label col-sm-3">DANEM/NUN/IPK</label>
										<div class="col-sm-4">
											<input type="text" class="form-control input-sm" name="rerata_uan" id="rerata_uan" value="<?php echo isset($data6->rerata_uan) ? $data6->rerata_uan : ''?> " >
											<p class="help-block-2">Misal : 99,99 atau  100</p>
											<p class="help-block"></p>
										</div>
									</div>
									<div class="form-group form-group-sm">
										<label class="control-label col-sm-3">No Ijazah</label>
										<div class="col-sm-5">
											<input type="text" class="form-control input-sm" name="no_sttb" id="no_sttb" value="<?php echo isset($data6->no_sttb) ? $data6->no_sttb : ''?>">
											<p class="help-block"></p>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Sumber informasi</h3>
								</div>
								<div class="panel-body">
									
							
									<?php 
										if (isset($data14)&& $data14!=null && count($data14)>0) {
											$i=0;
											foreach ($data14 as $row) {	
												echo '<div class="col-sm-4">
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
						<div class="col-sm-6">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Data Pribadi Pendaftar</h3>
								</div>
								<div class="panel-body">
									<div class="form-group form-group-sm valid required">
										<label class="control-label col-sm-3">Nama</label>
										<div class="col-sm-9">
											<input type="text" class="form-control input-sm" name="nama" id="nama" value="<?php echo isset($data6->nama) ? $data6->nama : ''?>">
											<p class="help-block"></p>
										</div>
									</div>
									<div class="form-group form-group-sm valid required">
										<label class="control-label col-sm-3">No HP</label>
										<div class="col-sm-9">
											<input type="text" class="form-control input-sm" name="telp" id="telp" value="<?php echo isset($data6->telp) ? $data6->telp : ''?>">
											<p class="help-block"></p>
										</div>
									</div>
									<div class="form-group form-group-sm valid required">
										<label class="control-label col-sm-3">Jenis Kelamin</label>
										<div class="col-sm-9">
											<select id="sex" class="form-control" name="sex">
												<option value="P" <?php echo isset($data6->sex) && $data6->sex=="P" ? 'selected' : ''?>>Laki-Laki</option>
												<option value="W" <?php echo isset($data6->sex) && $data6->sex=="W" ? 'selected' : ''?>>Perempuan</option>
											</select>
											<p class="help-block"></p>
										</div>
									</div>
									<div class="form-group form-group-sm valid required">
										<label class="control-label col-sm-3">Agama</label>
										<div class="col-sm-9">
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
									<div class="form-group form-group-sm valid required">
										<label class="control-label col-sm-3">Tempat Lahir</label>
										<div class="col-sm-9">
											<input type="text" class="form-control input-sm" name="tmp_lahir" id="tmp_lahir" value="<?php echo isset($data6->tmp_lahir) ? $data6->tmp_lahir : ''?>">
											<p class="help-block"></p>
										</div>
									</div>
									<div class="form-group form-group-sm valid required">
										<label class="control-label col-sm-3">Tanggal Lahir</label>
										<div class="col-sm-9 ">
											<div class="input-group">
												<input type="text" class="form-control input-sm date" data-date-format="DD-MM-YYYY" name="tgl_lahir" value="<?php echo (isset($data6->tgl_lahir) && $data6->tgl_lahir!="0000-00-00") ? date("d-m-Y",strtotime($data6->tgl_lahir)) : ''?>">
												 <span class="input-group-addon input-sm">
													<span class="fa fa-calendar"></span>
												</span>
											</div>
											<p class="help-block-2">DD-MM-YYYY</p>
											<p class="help-block"></p>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h3 class="panel-title">Alamat Asal</h3>
										</div>
										<div class="panel-body">
											<div class="form-group form-group-sm valid required">
												<label class="control-label col-sm-3">Propinsi</label>
												<div class="col-sm-9">
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
											<div class="form-group form-group-sm valid required">
												<label class="control-label col-sm-3">Kabupaten</label>
												<div class="col-sm-9">
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
											<div class="form-group form-group-sm valid required">
												<label class="control-label col-sm-3">Kecamatan</label>
												<div class="col-sm-9">
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
											<div class="form-group form-group-sm valid required">
											<label class="control-label col-sm-3">Alamat Asal</label>
												<div class="col-sm-9">
													<textarea type="text" class="form-control input-sm" name="alamat" id="alamat_asal" ><?php echo isset($data6->alamat_asal) ? $data6->alamat_asal : ''?></textarea>
													<p class="help-block"></p>
												</div>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h3 class="panel-title">Alamat Sekarang</h3>
										</div>
										<div class="panel-body">
											<div class="form-group form-group-sm">
												<label class="control-label col-sm-3">Propinsi</label>
												<div class="col-sm-9">
													<select id="prop_asal" class="form-control" name="prop_skrg" disabled>
														<option value=''>- Pilih Propinsi-</option>
														<?php 
															if (count($data5)>0) {
																		echo '<option value="" selected>'.$data5[0]->propinsi.'</option>';
															}
														?>
													</select>
												</div>
											</div>
											<div class="form-group form-group-sm ">
												<label class="control-label col-sm-3">Kabupaten</label>
												<div class="col-sm-9">
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
												</div>
											</div>
											<div class="form-group form-group-sm ">
												<label class="control-label col-sm-3">Kecamatan</label>
												<div class="col-sm-9">
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
												<label class="control-label col-sm-3">Alamat Sekarang</label>
												<div class="col-sm-9">
													<textarea type="text" class="form-control input-sm" name="alamat_skrg" id="alamat_skrg" ><?php echo isset($data6->alamat_skrg) ? $data6->alamat_skrg : ''?></textarea>
													<p class="help-block"></p>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group form-group-sm valid required">
										<label class="control-label col-sm-3">Pendapatan Orang Tua</label>
										<div class="col-sm-5">
											<select id="pdpt_ortu" class="form-control" name="pdpt_ortu">
												<option value=''>- Pilih Pendapatan -</option>
												<option value="<=1" <?php echo isset($data6->pdpt_ortu) && $data6->pdpt_ortu=='<=1' ? 'selected' : ''?>>&le; 1.000.000</option>
												<option value="1sd3" <?php echo isset($data6->pdpt_ortu) && $data6->pdpt_ortu=='1sd3' ? 'selected' : ''?>>1.000.000 s/d 3.000.000</option>
												<option value="3sd5" <?php echo isset($data6->pdpt_ortu) && $data6->pdpt_ortu=='3sd5' ? 'selected' : ''?>>3.000.000 s/d 5.000.000</option>
												<option value="5sd10" <?php echo isset($data6->pdpt_ortu) && $data6->pdpt_ortu=='5sd10' ? 'selected' : ''?>>5.000.000 s/d 10.000.000</option>
												<option value=">10" <?php echo isset($data6->pdpt_ortu) && $data6->pdpt_ortu=='>10' ? 'selected' : ''?>>&gt; 10.000.000</option>
											</select>
											<p class="help-block"></p>
										</div>
									</div>
									<div class="form-group form-group-sm valid required">
										<label class="control-label col-sm-3">Hubungan Keluarga</label>
										<div class="col-sm-9">
											<select id="hub_keluarga" class="form-control" name="hub_keluarga">
												<option value="0" <?php echo isset($data6->hub_keluarga) && $data6->hub_keluarga==0 ? 'selected' : ''?>>Tidak Ada Hubungan</option>
												<option value="1" <?php echo isset($data6->hub_keluarga) && $data6->hub_keluarga==1 ? 'selected' : ''?>>Saudara Kandung Mahasiswa</option>
											</select>
											<p class="help-block"></p>
										</div>
									</div>
								</div>
							</div>
							<p class="text-right">
							<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
							<button type="button" class="btn btn-success btn-sm" onclick="cetak(<?php echo isset($data6->id_daftar) ? $data6->id_daftar : ''?>)">Cetak</button>
							</p>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tbh_sklh" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="" method="post">
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
          <button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(function () {
        $('.date').datetimepicker({
            pickTime:false,
			format:"DD-MM-YYYY",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });
        settgltes('<?php echo (isset($data6->stttgltes)?$data6->stttgltes:1);?>');
    });
	function mod_tbh_sklh(nil) {
		if(nil=='00000000')
			$("#tbh_sklh").modal();
	};
	function settgltes(a){
        if (a=='1') {
            $('#datetime input').prop('disabled', true);
            $("input[name=tgltes]").closest('.form-group').removeClass("has-error").addClass("has-success");
            $("input[name=tgltes]").closest('.form-group').find("p.help-block").html("");
            $('#datetime input').val("");
            return true;
        }else{
            $('#datetime input').prop('disabled', false);
        }
    }
	function simpan(){
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
	function tarif(){
	   var modbayar=$('#modbayar').val();
	   var idtarif=$('#piltarif').val();
	   if(idtarif>0 && modbayar==1){
		   $.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/ajax/getTarifDaftar",
				data:{<?php echo $csrf ?>,'id' : idtarif},
				success: function(data){	
					$('#jumtarif').html('Rp. '+data);
				},
				error:function(XMLHttpRequest){

					alert(XMLHttpRequest.responseText);
				}
			})
	   }
	   else
		   $('#jumtarif').html('Rp. 0');
	};
	
	function getlokasi(nil1,nil2,nil3,nil4,nil5,nil6){
	   var nilai=$('#'+nil1).val();
	   
		   $.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/ajax/"+nil3,
				data:{<?php echo $csrf ?>,'id' : nilai},
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
				data:{<?php echo $csrf ?>,'id' : nilai},
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
	function lompat(e){
		if(e.keyCode==13){
			window.location.href="<?php echo base_url().index_page().'admin/pendaftaran/validasi/edit/';?>"+$("#searchbox").val();
			return false;
		}
	}
	function cari(){
		var nilai=$('#searchbox').val();
		if(nilai!=''){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/ajax/getCariDaftar",
				data: {<?php echo $csrf ?>,'key' : nilai},
				cache: false,
				success: function(data)
				{
					if(data==nilai)
						window.location.href="<?php echo base_url().index_page().'admin/pendaftaran/validasi/edit/'?>"+nilai;
					else
						$("#display").html(data).show();	
				}
			});
		}
		$("#display").hide();		
	}
	function btn_carisekolah(){
		btn=$("#btn_carisekolah").val();
		if(btn==0){
			$("#car_sekolah").html('<input type="text" id="nm_sekolah" class="form-control input-sm searchbox" name="nm_sekolah" onkeyup="carisekolah()" autocomplete="off"><input type="hidden" id="kd_sekolah" class="form-control input-sm" name="kd_sekolah">');
			$("#btn_carisekolah").val(1);
			$("#btn_tbhsekolah").show();
			$("#prop_sekolah").prop("disabled",true);
			$("#kota_sekolah").prop("disabled",true);
			$("#kec_sekolah").prop("disabled",true);
			$(".partsekolah").removeClass("valid required");
			$(".partsekolah").removeClass("valid required");
			$(".partsekolah").removeClass("valid required");
		}
		else{
			sel ='<select id="kd_sekolah" class="form-control" name="kd_sekolah" onchange="mod_tbh_sklh(this.value)">';
			sel+='<option value="">- Pilih Sekolah-</option>';
			sel+=getlokasi('kec_sekolah','kd_sekolah','getSekolah',null,null,'<?php echo isset($data6->kd_sekolah) ? $data6->kd_sekolah : ""?>');
			sel+='</select>';
			$("#car_sekolah").html(sel);
			$("#btn_carisekolah").val(0);
			$("#btn_tbhsekolah").hide();
			$("#prop_sekolah").prop("disabled",false);
			$("#kota_sekolah").prop("disabled",false);
			$("#kec_sekolah").prop("disabled",false);
			$(".partsekolah").addClass("valid required");
			$(".partsekolah").addClass("valid required");
			$(".partsekolah").addClass("valid required");
			
		}
		$("#showcarisekolah").html(null);
				
	}
	function carisekolah(){
		var nilai=$('#nm_sekolah').val();
		if(nilai!=''){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/ajax/getCariSekolah",
				data: {<?php echo $csrf ?>,'key' : nilai},
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
	function cetak(id){
		$("<iframe>")                             
	        .hide()                               
	        .attr("src", "<?php echo base_url().index_page().'admin/pendaftaran/cetak/slip/' ;?>"+id) 
	        .appendTo("body"); 
		sleepFor(1000);
		cetak2(id);
	}	

	function sleepFor( sleepDuration ){
	    var now = new Date().getTime();
	    while(new Date().getTime() < now + sleepDuration){ /* do nothing */ } 
	}

	function cetak2 (id) {
		 $("<iframe>")                             
	        .hide()                               
	        .attr("src", "<?php echo base_url().index_page().'admin/pendaftaran/cetak/kartu_tes/' ;?>"+id) 
	        .appendTo("body");
	}
	<?php echo isset($data15) ? $data15 :"" ?>
</script>
<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>