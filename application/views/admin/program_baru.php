<?php 
	$sts = "i";//insert
	$new_id = 0;
	if (isset($data2) && $data2!=null) {
		$new_id = $data2;
	}
	if (isset($data1) && $data1!=null) {
		$sts = "u";//update
		$new_id = $data1[0]->prg_id;
	}

	function findform($name=null,$form=null){
		if ($name!=null && $form!=null) {
			$a = strpos($form,$name);
			return (($a>0)?"checked":"");
		} return "";
	}
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Program <small><?php echo $sts=="i"?"Tambah":"Sunting" ?> Program</small></h1>
        </div>
    </div>
	<div class="row">
		<?php echo form_open('admin/program/'.($sts=='i'?'baru':'edit/'.$data1[0]->prg_id).'/simpan',array('id'=>'page','enctype'=>'multipart/form-data')) ?>	
		<div class="col-lg-9">
				<div class="form-group valid required">
					<input type="text" class="form-control input-lg" name="judul" id="judul" placeholder="Masukan judul program disini" value="<?php echo $sts=='u'?$data1[0]->prg_judul:'' ?>" onKeyup="setLink()">
					<p class="help-block judul"></p>
					<p id="plink"></p>
				</div>
			    <div role="tabpanel">

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#desk" aria-controls="desk" role="tab" data-toggle="tab">Deskripsi</a></li>
				    <li role="presentation"><a href="#form" id="cform" aria-controls="form" role="tab" data-toggle="tab">Form</a></li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane fade in active" id="desk">
						<div class="form-group">
							<textarea class="summernote" name="deskripsi"><?php echo $sts=='u'?$data1[0]->prg_deskripsi:'' ?></textarea>
						</div>
						<script type="text/javascript">
							$(document).ready(function() {
							  $('.summernote').summernote(
									{ height: 700,                
									  minHeight: 500,             
									  maxHeight: 1000,          
									  focus: true
									}
							  	);
							});
						</script>
				    </div>
				    <div role="tabpanel" class="tab-pane" id="form">
					<div class="tutup"></div>
				    <div class="panel" id="panel">
			    	<div class="panel-body">
		    			<div class="form-horizontal">
			    			<div class="form-group default utama">
			    				<div class="col-sm-12">Tambahkan Form Pendaftaran
                                <div class="onoff yesno pull-right">	
									<input type="checkbox" name="dgform" id="dgform" value='0' <?php echo $sts=='u' && $data1[0]->prg_form!=null?"checked":"" ?>>
									<label for="dgform" onclick="tampil()"></label>
								</div>
								</div>
							</div>
						</div><br/>
				    	<div class="form-horizontal">
	                        <div class="panel panel-primary">
	                            <div class="panel-heading">
	                                <h3 class="panel-title">Pilih Program Studi</h3>
	                                <div class="onoff pull-right" style="top:-23px;">	
										<input type="checkbox" checked name="panel_prodi" id="panel_prodi" value='1'>
										<label for="panel_prodi" onclick="pilih($(this))"></label>
									</div>
	                            </div>
	                            <div class="panel-body">
	                                <p>Silakan pilih dua program studi yang saudara minati:</p>
	                                <div class="form-group form-group-sm default">
	                                    <label class="col-sm-3 control-label">Pilihan Prodi 1</label>
	                                    <div class="col-sm-5">
	                                        <select class="form-control">
	                                        	<?php foreach ($data3 as $row): ?>
	                                            <option value="<?php echo $row->kd_proditawar ?>"><?php echo $row->nama_jenjang.'-'.$row->nama_jurusan.' ('.$row->nama_status.'-'.$row->nama_program.')' ?></option>
	                                        	<?php endforeach ?>
	                                        </select>
	                                    </div>
	                                    <div class="col-sm-4">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("prodi1",$data1[0]->prg_form):"checked"; ?> name="prodi1" id="prodi1"
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Pilihan Prodi 1</label>
					                                    <div class="col-sm-5">
					                                        <select class="form-control" name="prodi1">
					                                        <?php foreach ($data3 as $row) { ?>
					                                        	<option value="<?php echo $row->kd_proditawar ?>"><?php echo $row->nama_jenjang.'-'.$row->nama_jurusan.' ('.$row->nama_status.'-'.$row->nama_program.')' ?></option>
					                                        <?php } ?>
					                                        </select>
					                                    	<p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="prodi1"></label>
											</div>
										</div>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="col-sm-3 control-label">Pilihan Prodi 2</label>
	                                    <div class="col-sm-5">
	                                        <select class="form-control">
	                                        	<?php foreach ($data3 as $row): ?>
	                                            <option value="<?php echo $row->kd_proditawar ?>"><?php echo $row->nama_jenjang.'-'.$row->nama_jurusan.' ('.$row->nama_status.'-'.$row->nama_program.')' ?></option>
	                                        	<?php endforeach ?>
	                                        </select>
	                                    </div>
	                                    <div class="col-sm-4">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("prodi2",$data1[0]->prg_form):"checked"; ?> name="prodi2" id="prodi2" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Pilihan Prodi 2</label>
					                                    <div class="col-sm-5">
					                                        <select class="form-control" name="prodi2">
					                                        <?php foreach ($data3 as $row) { ?>
					                                        	<option value="<?php echo $row->kd_proditawar ?>"><?php echo $row->nama_jenjang.'-'.$row->nama_jurusan.' ('.$row->nama_status.'-'.$row->nama_program.')' ?></option>
					                                        <?php } ?>
					                                        </select>
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="prodi2"></label>
											</div>
										</div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="panel panel-primary">
	                            <div class="panel-heading">
	                                <h3 class="panel-title">Data Pendaftar</h3>
	                                <div class="onoff pull-right" style="top:-23px;">	
										<input type="checkbox" checked name="panel_pendaftar" id="panel_pendaftar" value='1'>
										<label for="panel_pendaftar" onclick="pilih($(this))"></label>
									</div>
	                            </div>
	                            <div class="panel-body">
	                                <p>Silakan isi data pribadi berikut ini dengan sebenar-benarnya:</p>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nama</label>
	                                    <div class="col-sm-7">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-2">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("prodi2",$data1[0]->prg_form):"checked"; ?> name="nama" id="nama" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Nama</label>
					                                    <div class="col-sm-7">
					                                        <input type="text" class="form-control" name="nama">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="nama"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nomor Induk</label>
	                                    <div class="col-sm-4">
	                                        <input type="text" class="form-control" >
	                                    </div>
	                                    <div class="col-sm-5">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("no_induk",$data1[0]->prg_form):"checked"; ?> name="no_induk" id="no_induk" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Nomor Induk</label>
					                                    <div class="col-sm-4">
					                                        <input type="text" class="form-control" name="no_induk">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="no_induk"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group default">
	                                    <label class="control-label col-sm-3">Alamat</label>
	                                    <div class="col-sm-7">
	                                        <textarea class="form-control" rows="3"></textarea>
	                                    </div>
	                                    <div class="col-sm-2">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("alamat",$data1[0]->prg_form):"checked"; ?> name="alamat" id="alamat" 
													value='<div class="form-group valid required">
					                                    <label class="control-label col-sm-3">Alamat</label>
					                                    <div class="col-sm-7">
					                                        <textarea class="form-control" rows="3" name="alamat"></textarea>
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="alamat"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nomor Telp.</label>
	                                    <div class="col-sm-4">
	                                        <div class="input-group">
	                                            <span class="input-group-addon">
	                                                <i class="fa fa-phone"></i>
	                                            </span>
	                                            <input type="text" class="form-control">
	                                        </div>
	                                    </div>
	                                    <div class="col-sm-5">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("telp",$data1[0]->prg_form):"checked"; ?> name="telp" id="telp" 
													value='<div class="form-group form-group-sm valid required numeric">
					                                    <label class="control-label col-sm-3">Nomor Telp.</label>
					                                    <div class="col-sm-4">
					                                        <div class="input-group">
					                                            <span class="input-group-addon">
					                                                <i class="fa fa-phone"></i>
					                                            </span>
					                                            <input type="text" class="form-control" name="telp">
					                                        </div>
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="telp"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Alamat Email</label>
	                                    <div class="col-sm-4">
	                                        <div class="input-group">
	                                            <span class="input-group-addon">
	                                                @
	                                            </span>
	                                            <input type="email" class="form-control">
	                                        </div>
	                                    </div>
	                                    <div class="col-sm-5">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("email",$data1[0]->prg_form):"checked"; ?> name="email" id="email" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Alamat Email</label>
					                                    <div class="col-sm-4">
					                                        <div class="input-group">
					                                            <span class="input-group-addon">
					                                                @
					                                            </span>
					                                            <input type="email" class="form-control" name="email">
					                                        </div>
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="email"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Jumlah Saudara</label>
	                                    <div class="col-sm-3">
	                                        <div class="input-group">
	                                            <input type="text" class="form-control">
	                                            <span class="input-group-addon">
	                                                Orang
	                                            </span>
	                                        </div>
	                                    </div>
	                                    <div class="col-sm-6">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("jml_saudara",$data1[0]->prg_form):"checked"; ?> name="jml_saudara" id="jml_saudara" 
													value='<div class="form-group form-group-sm valid required numeric">
					                                    <label class="control-label col-sm-3">Jumlah Saudara</label>
					                                    <div class="col-sm-3">
					                                        <div class="input-group">
					                                            <input type="text" class="form-control" name="jml_saudara">
					                                            <span class="input-group-addon">
					                                                Orang
					                                            </span>
					                                        </div>
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="jml_saudara"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Saya anak ke</label>
	                                    <div class="col-sm-3">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-6">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("anak_ke",$data1[0]->prg_form):"checked"; ?>  name="anak_ke" id="anak_ke" 
													value='<div class="form-group form-group-sm valid required numeric">
					                                    <label class="control-label col-sm-3">Saya anak ke</label>
					                                    <div class="col-sm-3">
					                                        <input type="text" class="form-control" name="anak_ke" >
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="anak_ke"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nama Ayah</label>
	                                    <div class="col-sm-4">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-3">
	                                        <select class="form-control">
	                                            <option value="1">Masih hidup</option>
	                                            <option value="1">Sudah Meninggal</option>
	                                        </select>
	                                    </div>
	                                    <div class="col-sm-2">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("nama_ayah",$data1[0]->prg_form):"checked"; ?>  name="nama_ayah" id="nama_ayah" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Nama Ayah</label>
					                                    <div class="col-sm-5">
					                                        <input type="text" class="form-control" name="nama_ayah" >
					                                    <p class="help-block"></p>
					                                    </div>
					                                    <div class="col-sm-3">
					                                        <select class="form-control" name="hidup_ayah">
					                                            <option value="1">Masih hidup</option>
					                                            <option value="0">Sudah Meninggal</option>
					                                        </select>
					                                    </div>
					                                </div>'>
												<label for="nama_ayah"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nama Ibu</label>
	                                    <div class="col-sm-4">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-3">
	                                        <select class="form-control">
	                                            <option value="1">Masih hidup</option>
	                                            <option value="1">Sudah Meninggal</option>
	                                        </select>
	                                    </div>
	                                    <div class="col-sm-2">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("nama_ibu",$data1[0]->prg_form):"checked"; ?> name="nama_ibu" id="nama_ibu" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Nama Ibu</label>
					                                    <div class="col-sm-5">
					                                        <input type="text" class="form-control" name="nama_ibu" >
					                                    <p class="help-block"></p>
					                                    </div>
					                                    <div class="col-sm-3">
					                                        <select class="form-control" name="hidup_ibu">
					                                            <option value="1">Masih hidup</option>
					                                            <option value="0">Sudah Meninggal</option>
					                                        </select>
					                                    </div>
					                                </div>'>
												<label for="nama_ibu"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Pekerjaan Ayah</label>
	                                    <div class="col-sm-3">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-6">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("pekerjaan_ayah",$data1[0]->prg_form):"checked"; ?> name="kerja_ayah" id="kerja_ayah" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Pekerjaan Ayah</label>
					                                    <div class="col-sm-3">
					                                        <input type="text" class="form-control" name="pekerjaan_ayah">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="kerja_ayah"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Pekerjaan Ibu</label>
	                                    <div class="col-sm-3">
	                                        <input type="text" class="form-control" >
	                                    </div>
	                                    <div class="col-sm-6">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("pekerjaan_ibu",$data1[0]->prg_form):"checked"; ?> name="kerja_ibu" id="kerja_ibu" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Pekerjaan Ibu</label>
					                                    <div class="col-sm-3">
					                                        <input type="text" class="form-control" name="pekerjaan_ibu">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="kerja_ibu"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group default">
	                                    <label class="control-label col-sm-3">Alamat Ayah</label>
	                                    <div class="col-sm-7">
	                                        <textarea class="form-control" rows="3"></textarea>
	                                    </div>
	                                    <div class="col-sm-2">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("alamat_ayah",$data1[0]->prg_form):"checked"; ?> name="alamat_ayah" id="alamat_ayah" 
													value='<div class="form-group valid required">
					                                    <label class="control-label col-sm-3">Alamat Ayah</label>
					                                    <div class="col-sm-7">
					                                        <textarea class="form-control" rows="3" name="alamat_ayah"></textarea>
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="alamat_ayah"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
									<div class="form-group default">
	                                    <label class="control-label col-sm-3">Alamat Ibu</label>
	                                    <div class="col-sm-7">
	                                        <textarea class="form-control" rows="3"></textarea>
	                                    </div>
	                                    <div class="col-sm-2">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("alamat_ibu",$data1[0]->prg_form):"checked"; ?> name="alamat_ibu" id="alamat_ibu" 
													value='<div class="form-group valid required">
					                                    <label class="control-label col-sm-3">Alamat Ibu</label>
					                                    <div class="col-sm-7">
					                                        <textarea class="form-control" rows="3" name="alamat_ibu"></textarea>
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="alamat_ibu"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nomor Telp./HP Ayah</label>
	                                    <div class="col-sm-4">
	                                        <div class="input-group">
	                                            <span class="input-group-addon">
	                                                <i class="fa fa-phone"></i>
	                                            </span>
	                                            <input type="text" class="form-control">
	                                        </div>
	                                    </div>
	                                    <div class="col-sm-5">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("telpon_ayah",$data1[0]->prg_form):"checked"; ?> name="telp_ayah" id="telp_ayah" 
													value='<div class="form-group form-group-sm valid required numeric">
					                                    <label class="control-label col-sm-3">Nomor Telp./HP Ayah</label>
					                                    <div class="col-sm-4">
					                                        <div class="input-group">
					                                            <span class="input-group-addon">
					                                                <i class="fa fa-phone"></i>
					                                            </span>
					                                            <input type="text" class="form-control" name="telpon_ayah">
					                                        </div>
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="telp_ayah"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
									<div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nomor Telp./HP Ibu</label>
	                                    <div class="col-sm-4">
	                                        <div class="input-group">
	                                            <span class="input-group-addon">
	                                                <i class="fa fa-phone"></i>
	                                            </span>
	                                            <input type="text" class="form-control">
	                                        </div>
	                                    </div>
	                                    <div class="col-sm-5">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("telpon_ibu",$data1[0]->prg_form):"checked"; ?> name="telp_ibu" id="telp_ibu" 
													value='<div class="form-group form-group-sm valid required numeric">
					                                    <label class="control-label col-sm-3">Nomor Telp./HP Ibu</label>
					                                    <div class="col-sm-4">
					                                        <div class="input-group">
					                                            <span class="input-group-addon">
					                                                <i class="fa fa-phone"></i>
					                                            </span>
					                                            <input type="text" class="form-control" name="telpon_ibu">
					                                        </div>
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="telp_ibu"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
									<div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Pendapatan Orang Tua</label>
										<div class="col-sm-4">
											<select class="form-control" name="pdpt_ortu">
												<option value="">- Pilih Pendapatan -</option>
												<option value="<=1">&le; 1.000.000</option>
												<option value="1sd3">1.000.000 s/d 3.000.000</option>
												<option value="3sd5">3.000.000 s/d 5.000.000</option>
												<option value=">5">&gt; 5.000.000</option>
											</select>
										</div>
										<div class="col-sm-5">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("pdpt_ortu",$data1[0]->prg_form):"checked"; ?> name="pdpt_ortu" id="pdpt_ortu" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Pendapatan Orang Tua</label>
					                                    <div class="col-sm-3">
					                                        <select class="form-control" name="pdpt_ortu">
					                                            <option value="">- Pilih Pendapatan -</option>
																<option value="<=1">&le; 1.000.000</option>
																<option value="1sd3">1.000.000 s/d 3.000.000</option>
																<option value="3sd5">3.000.000 s/d 5.000.000</option>
																<option value=">5">&gt; 5.000.000</option>
					                                        </select>
					                                    </div>
					                                </div>'>
												<label for="pdpt_ortu"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="panel panel-primary">
	                            <div class="panel-heading">
	                                <h3 class="panel-title">Data Sekolah</h3>
	                                <div class="onoff pull-right" style="top:-23px;">	
										<input type="checkbox" checked name="panel_sekolah" id="panel_sekolah" value='1'>
										<label for="panel_sekolah" onclick="pilih($(this))"></label>
									</div>
	                            </div>
	                            <div class="panel-body">
	                                <div class="form-group default">
	                                	<label class="control-label col-sm-3" style="margin-bottom: 15px;">Nama Sekolah</label>
	                                    <div class="col-sm-10 form-sekolah">
											<div class="form-group form-group-sm">
                                                <label class="control-label col-sm-3">Prov. Sekolah</label>
                                                <div class="col-sm-5">
                                                    <select id="prop_sekolah" class="form-control" name="prop_sekolah" onchange="getlokasi('prop_sekolah','kota_sekolah','getKota','kec_sekolah','kd_sekolah')">
														<option value=''>- Pilih Propinsi -</option>
														
													</select>
                                                    <p class="help-block"></p>
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="control-label col-sm-3">Kota Sekolah</label>
                                                <div class="col-sm-5">
													<select id="kota_sekolah" class="form-control" name="kota_sekolah" onchange="getlokasi('kota_sekolah','kec_sekolah','getKecamatan','kd_sekolah')">
														<option value=''>- Pilih Kota -</option>
														
													</select>
                                                    <p class="help-block"></p>
                                                </div>
                                            </div>
											<div class="form-group form-group-sm">
												<label class="control-label col-sm-3">Kecamatan</label>
												<div class="col-sm-5">
													<select id="kec_sekolah" class="form-control" name="kec_sekolah" onchange="getlokasi('kec_sekolah','kd_sekolah','getSekolah')">
														<option value=''>- Pilih Kecamatan -</option>
													
													</select>
													<p class="help-block"></p>
												</div> 
											</div>
                                            <div class="form-group form-group-sm">
                                                <label class="control-label col-sm-3">Sekolah</label>
                                                <div class="col-sm-6">
                                                    <select id="kd_sekolah" class="form-control" name="kd_sekolah">
														<option value=''>- Pilih Sekolah -</option>
													</select>
                                                    <p class="help-block"></p>
                                                </div>
                                            </div>
	                                    </div>
	                                    <div class="col-sm-2">
		                                    <div class="onoff pull-right">
												<input type="checkbox" <?php echo $sts=='u'?findform("kd_sekolah",$data1[0]->prg_form):"checked"; ?> name="nama_sekolah" id="nama_sekolah" 
													value='
													<div class="form-group form-group-sm valid required">
														<label class="control-label col-sm-3">Prov. Sekolah</label>
														<div class="col-sm-5">
															<select id="prop_sekolah" class="form-control" name="prop_sekolah" onchange=&#39;getlokasi( "prop_sekolah","kota_sekolah","getKota","kec_sekolah","kd_sekolah")&#39;>
																<option value="">- Pilih Propinsi-</option>
															<?php foreach ($data4 as $row) { ?>
					                                        	<option value="<?php echo $row->kd_propinsi ?>"><?php echo $row->nama_propinsi ?></option>
					                                        <?php } ?>
															</select>
															<p class="help-block"></p>
														</div>
													</div>
													<div class="form-group form-group-sm valid required">
														<label class="control-label col-sm-3">Kota Sekolah</label>
														<div class="col-sm-5">
															<select id="kota_sekolah" class="form-control" name="kota_sekolah" onchange=&#39;getlokasi("kota_sekolah","kec_sekolah","getKecamatan","kd_sekolah")&#39;>
																<option value="">- Pilih Kota-</option>
													
															</select>
															<p class="help-block"></p>
														</div>
													</div>
													<div class="form-group form-group-sm valid required">
														<label class="control-label col-sm-3">Kecamatan</label>
														<div class="col-sm-5">
															<select id="kec_sekolah" class="form-control" name="kec_sekolah" onchange=&#39;getlokasi("kec_sekolah","kd_sekolah","getSekolah")&#39;>
																<option value="">- Pilih Kecamatan-</option>
													
															</select>
															<p class="help-block"></p>
														</div> 
													</div>
													<div class="form-group form-group-sm valid required">
														<label class="control-label col-sm-3">Sekolah</label>
														<div class="col-sm-6">
															<select id="kd_sekolah" class="form-control" name="kd_sekolah">
																<option value="">- Pilih Sekolah-</option>
														
															</select>
															<p class="help-block"></p>
														</div>
													</div>
										
													'>
												<label for="nama_sekolah"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group default">
	                                    <label class="control-label col-sm-3">Alamat Sekolah</label>
	                                    <div class="col-sm-5">
	                                        <textarea class="form-control" rows="3"></textarea>
	                                    </div>
	                                    <div class="col-sm-4">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("alamat_sekolah",$data1[0]->prg_form):"checked"; ?> name="alamat_sekolah" id="alamat_sekolah" 
													value='<div class="form-group valid required">
					                                    <label class="control-label col-sm-3">Alamat Sekolah</label>
					                                    <div class="col-sm-5">
					                                        <textarea class="form-control" name="alamat_sekolah" rows="3"></textarea>
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="alamat_sekolah"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nomor Telp.</label>
	                                    <div class="col-sm-4">
	                                        <div class="input-group">
	                                            <span class="input-group-addon">
	                                                <i class="fa fa-phone"></i>
	                                            </span>
	                                            <input type="text" class="form-control">
	                                        </div>
	                                    </div>
	                                    <div class="col-sm-5">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("telp_sekolah",$data1[0]->prg_form):"checked"; ?> name="telp_sekolah" id="telp_sekolah" 
													value='<div class="form-group form-group-sm valid required numeric">
					                                    <label class="control-label col-sm-3">Nomor Telp.</label>
					                                    <div class="col-sm-4">
					                                        <div class="input-group">
					                                            <span class="input-group-addon">
					                                                <i class="fa fa-phone"></i>
					                                            </span>
					                                            <input type="text" class="form-control" name="telp_sekolah">
					                                        </div>
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="telp_sekolah"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nama Guru BK</label>
	                                    <div class="col-sm-5">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-4">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("nama_gurubk",$data1[0]->prg_form):"checked"; ?> name="nama_gurubk" id="nama_gurubk" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Nama Guru BK</label>
					                                    <div class="col-sm-5">
					                                        <input type="text" class="form-control" name="nama_gurubk">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="nama_gurubk"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nomor Telp./HP Guru BK</label>
	                                    <div class="col-sm-4">
	                                        <div class="input-group">
	                                            <span class="input-group-addon">
	                                                <i class="fa fa-phone"></i>
	                                            </span>
	                                            <input type="text" class="form-control">
	                                        </div>
	                                    </div>
	                                    <div class="col-sm-5">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("telp_bk",$data1[0]->prg_form):"checked"; ?> name="telp_bk" id="telp_bk" 
													value='<div class="form-group form-group-sm valid required numeric">
					                                    <label class="control-label col-sm-3">Nomor Telp./HP Guru BK</label>
					                                    <div class="col-sm-4">
					                                        <div class="input-group">
					                                            <span class="input-group-addon">
					                                                <i class="fa fa-phone"></i>
					                                            </span>
					                                            <input type="text" class="form-control" name="telp_bk">
					                                        </div>
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="telp_bk"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group">
	                                    <label class="control-label col-sm-3">Rerata nilai raport:</label>
	                                    <div class="col-sm-9"></div>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Semester 1</label>
	                                    <div class="col-sm-3">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-6">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("rapor_sm1",$data1[0]->prg_form):"checked"; ?> name="raport_smt1" id="raport_smt1" 
													value='<div class="form-group form-group-sm valid required numeric">
					                                    <label class="control-label col-sm-3">Semester 1</label>
					                                    <div class="col-sm-3">
					                                        <input type="text" class="form-control" name="rapor_sm1">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="raport_smt1"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Semester 2</label>
	                                    <div class="col-sm-3">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-6">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("rapor_sm2",$data1[0]->prg_form):"checked"; ?> name="raport_smt2" id="raport_smt2" 
													value='<div class="form-group form-group-sm valid required numeric">
					                                    <label class="control-label col-sm-3">Semester 2</label>
					                                    <div class="col-sm-3">
					                                        <input type="text" class="form-control" name="rapor_sm2">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="raport_smt2"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Semester 3</label>
	                                    <div class="col-sm-3">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-6">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("rapor_sm3",$data1[0]->prg_form):"checked"; ?> name="raport_smt3" id="raport_smt3" 
													value='<div class="form-group form-group-sm valid required numeric">
					                                    <label class="control-label col-sm-3">Semester 3</label>
					                                    <div class="col-sm-3">
					                                        <input type="text" class="form-control" name="rapor_sm3">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="raport_smt3"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Semester 4</label>
	                                    <div class="col-sm-3">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-6">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("rapor_sm4",$data1[0]->prg_form):"checked"; ?> name="raport_smt4" id="raport_smt4" 
													value='<div class="form-group form-group-sm valid required numeric">
					                                    <label class="control-label col-sm-3">Semester 4</label>
					                                    <div class="col-sm-3">
					                                        <input type="text" class="form-control" name="rapor_sm4">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="raport_smt4"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Rata-rata UAN</label>
	                                    <div class="col-sm-3">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-6">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("rerata_uan",$data1[0]->prg_form):"checked"; ?> name="rata_uan" id="rata_uan" 
													value='<div class="form-group form-group-sm valid required numeric">
					                                    <label class="control-label col-sm-3">Rata-rata UAN</label>
					                                    <div class="col-sm-3">
					                                        <input type="text" class="form-control" name="rerata_uan">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="rata_uan"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default tabel">
	                                    <label class="control-label col-sm-3">Prestasi</label>
	                                    <div class="col-sm-7">
	                                        <div class="table-responsive">
	                                          <table class="table table-bordered table-stripped">
	                                            <thead>
	                                                <tr>
	                                                <th class="text-center">Nama</th>
	                                                <th class="text-center">Tahun</th>
	                                                <th class="text-center">Institusi/Organisasi Pemberi</th>
	                                                <th class="text-center"><button type="button" class="btn btn-circle btn-xs btn-primary"><i class="fa fa-plus"></i></button></th>
	                                                </tr>
	                                            </thead>
	                                            <tbody>
	                                                <tr>
	                                                <td><input type="text" class="form-control" name="prestasi_nama"></td>
	                                                <td>
	                                                <select class="form-control" name="prestasi_tahun">
	                                                    <option>2006</option>    
	                                                    <option>2007</option>    
	                                                    <option>2008</option>    
	                                                    <option>2009</option>    
	                                                    <option>2010</option>    
	                                                    <option>2011</option>    
	                                                </select>
	                                                </td>
	                                                <td><input type="text" class="form-control" name="prestasi_tahun"></td>
	                                                <td class="text-center"><button type="button" class="btn btn-circle btn-xs btn-success"><i class="fa fa-save"></i></button></td>
	                                                </tr>
	                                            </tbody>
	                                          </table>
	                                        </div>
	                                    </div>
	                                    <div class="col-sm-2">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("prestasi_nama",$data1[0]->prg_form):"checked"; ?> name="prestasi" id="prestasi" 
													value='<div class="form-group form-group-sm">
						                                    <label class="control-label col-sm-3">Prestasi</label>
						                                    <div class="col-sm-9">
						                                        <div class="table-responsive">
						                                          <table class="table table-bordered table-stripped">
						                                            <thead>
						                                                <tr>
						                                                <th>Nama</th>
						                                                <th class="text-center">Tahun</th>
						                                                <th>Institusi/Organisasi Pemberi</th>
						                                                <th class="text-center"><button type="button" class="btn btn-circle btn-xs btn-primary"><i class="fa fa-plus"></i></button></th>
						                                                </tr>
						                                            </thead>
						                                            <tbody>
						                                                <tr>
						                                                <td><input type="text" class="form-control" name="prestasi_nama"></td>
						                                                <td>
						                                                <select class="form-control" name="prestasi_tahun">
						                                                    <option>2006</option>    
						                                                    <option>2007</option>    
						                                                    <option>2008</option>    
						                                                    <option>2009</option>    
						                                                    <option>2010</option>    
						                                                    <option>2011</option>    
						                                                </select>
						                                                </td>
						                                                <td><input type="text" class="form-control" name="prestasi_tahun"></td>
						                                                <td class="text-center"><button type="button" class="btn btn-circle btn-xs btn-success"><i class="fa fa-save"></i></button></td>
						                                                </tr>
						                                            </tbody>
						                                          </table>
						                                        </div>
						                                    </div>
						                                </div>'>
												<label for="prestasi"></label>
											</div>
										</div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="panel panel-primary">
	                            <div class="panel-heading">
	                                <h3 class="panel-title">Program Studi Diterima - [Formulir Her-Registrasi]</h3>
	                                <div class="onoff pull-right" style="top:-23px;">	
										<input type="checkbox" checked name="panel_her_prodi" id="panel_her_prodi" value='1'>
										<label for="panel_her_prodi" onclick="pilih($(this))"></label>
									</div>
	                            </div>
	                            <div class="panel-body">
	                                <p>Silakan pilih program studi tempat saudara diterima:</p>
	                                <div class="form-group form-group-sm default">
	                                    <label class="col-sm-3 control-label">Pilihan Prodi</label>
	                                    <div class="col-sm-5">
	                                        <select class="form-control">
	                                        	<?php foreach ($data3 as $row): ?>
	                                            <option value="<?php echo $row->kd_proditawar ?>"><?php echo $row->nama_jenjang.' '.$row->nama_jurusan ?></option>
	                                        	<?php endforeach ?>
	                                        </select>
	                                    </div>
	                                    <div class="col-sm-4">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("her_prodi",$data1[0]->prg_form):"checked"; ?> name="her_prodi" id="her_prodi"
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Pilihan Prodi 1</label>
					                                    <div class="col-sm-5">
					                                        <select class="form-control" name="her_prodi">
					                                        <?php foreach ($data3 as $row) { ?>
					                                        	<option value="<?php echo $row->kd_proditawar ?>"><?php echo $row->nama_jenjang.'-'.$row->nama_jurusan.' ('.$row->nama_status.'-'.$row->nama_program.')' ?></option>
					                                        <?php } ?>
					                                        </select>
					                                    	<p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="her_prodi"></label>
											</div>
										</div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="panel panel-primary">
	                            <div class="panel-heading">
	                                <h3 class="panel-title">Data Calon Mahasiswa - [Formulir Her-Registrasi]</h3>
	                                <div class="onoff pull-right" style="top:-23px;">	
										<input type="checkbox" checked name="panel_her_mhs" id="panel_her_mhs" value='1'>
										<label for="panel_her_mhs" onclick="pilih($(this))"></label>
									</div>
	                            </div>
	                            <div class="panel-body">
	                                <p>Silakan isi formulir berikut ini dengan sebenar-benarnya:</p>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nama</label>
	                                    <div class="col-sm-7">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-2">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("her_nama",$data1[0]->prg_form):"checked"; ?> name="her_nama" id="her_nama" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Nama</label>
					                                    <div class="col-sm-7">
					                                        <input type="text" class="form-control" name="nama" id="her_nama">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="her_nama"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nomor HP</label>
	                                    <div class="col-sm-4">
	                                        <div class="input-group">
	                                            <span class="input-group-addon">
	                                                <i class="fa fa-phone"></i>
	                                            </span>
	                                            <input type="text" class="form-control">
	                                        </div>
	                                    </div>
	                                    <div class="col-sm-5">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("her_telp",$data1[0]->prg_form):"checked"; ?> name="her_telp" id="her_telp" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Nomor HP</label>
					                                    <div class="col-sm-4">
					                                        <div class="input-group">
					                                            <span class="input-group-addon">
					                                                <i class="fa fa-phone"></i>
					                                            </span>
					                                            <input type="text" class="form-control" name="telp" id="her_telp">
					                                        </div>
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="her_telp"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nomor Induk Siswa</label>
	                                    <div class="col-sm-4">
	                                        <input type="text" class="form-control" >
	                                    </div>
	                                    <div class="col-sm-5">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("her_no_induk",$data1[0]->prg_form):"checked"; ?> name="her_no_induk" id="her_no_induk" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Nomor Induk Siswa</label>
					                                    <div class="col-sm-4">
					                                        <input type="text" class="form-control" name="no_induk" id="her_no_induk">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="her_no_induk"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nama Sekolah</label>
	                                    <div class="col-sm-5">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-4">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("her_nama_sekolah",$data1[0]->prg_form):"checked"; ?> name="her_nama_sekolah" id="her_nama_sekolah" 
													value='<div class="form-group form-group-sm valid required">
						                                    <label class="control-label col-sm-3">Nama Sekolah</label>
						                                    <div class="col-sm-5">
						                                        <input type="text" class="form-control" name="nama_sekolah" id="her_nama_sekolah">
						                                    <p class="help-block"></p>
						                                    </div>
						                                </div>'>
												<label for="her_nama_sekolah"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Kota / Kabupaten Sekolah</label>
	                                    <div class="col-sm-5">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-4">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("her_kota_sekolah",$data1[0]->prg_form):"checked"; ?> name="her_kota_sekolah" id="her_kota_sekolah" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Kota / Kabupaten Sekolah</label>
					                                    <div class="col-sm-5">
					                                        <input type="text" class="form-control" name="kota_sekolah" id="her_kota_sekolah">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>
					                                '>
												<label for="her_kota_sekolah"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="panel panel-primary">
	                            <div class="panel-heading">
	                                <h3 class="panel-title">Bukti Transfer Biaya - [Formulir Her-Registrasi]
	                                <div class="onoff pull-right" style="top:-6px;">	
										<input type="checkbox" checked name="panel_her_trans" id="panel_her_trans" value='1'>
										<label for="panel_her_trans" onclick="pilih($(this))"></label>
									</div>
	                                </h3>
	                            </div>
	                            <div class="panel-body">
	                                <p>Silakan isi formulir berikut ini dengan sebenar-benarnya:</p>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Nama Pengirim</label>
	                                    <div class="col-sm-5">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-4">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("her_nama_pengirim",$data1[0]->prg_form):"checked"; ?> name="her_nama_pengirim" id="her_nama_pengirim" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Nama Pengirim</label>
					                                    <div class="col-sm-5">
					                                        <input type="text" class="form-control" name="nama_pengirim" id="her_nama_pengirim">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="her_nama_pengirim"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Bank Pengiriman</label>
	                                    <div class="col-sm-5">
	                                           <input type="text" class="form-control" placeholder="misal: Bank Mandiri">
	                                    </div>
	                                    <div class="col-sm-4">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("her_bank",$data1[0]->prg_form):"checked"; ?> name="her_bank" id="her_bank" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Bank Pengiriman</label>
					                                    <div class="col-sm-5">
					                                        <input type="text" class="form-control" name="bank" id="her_bank" placeholder="misal: Bank Mandiri">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="her_bank"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Jumlah Pengiriman</label>
	                                    <div class="col-sm-5">
	                                        <input type="text" class="form-control" placeholder="misal: 1000000">
	                                    </div>
	                                    <div class="col-sm-4">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("her_jmlkirim",$data1[0]->prg_form):"checked"; ?> name="her_jmlkirim" id="her_jmlkirim" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Jumlah Pengiriman</label>
					                                    <div class="col-sm-5">
					                                        <input type="text" class="form-control" name="jmlkirim" id="her_jmlkirim" placeholder="misal: 1000000">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="her_jmlkirim"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">No. Rekening Pengirim</label>
	                                    <div class="col-sm-5">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-4">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("her_norek",$data1[0]->prg_form):"checked"; ?> name="her_norek" id="her_norek" 
													value='<div class="form-group form-group-sm valid required">
						                                    <label class="control-label col-sm-3">No. Rekening Pengirim</label>
						                                    <div class="col-sm-5">
						                                        <input type="text" class="form-control" name="norek" id="her_norek">
						                                    <p class="help-block"></p>
						                                    </div>
						                                </div>'>
												<label for="her_norek"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Berita Pengiriman</label>
	                                    <div class="col-sm-5">
	                                        <input type="text" class="form-control">
	                                    </div>
	                                    <div class="col-sm-4">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("her_berita",$data1[0]->prg_form):"checked"; ?> name="her_berita" id="her_berita" 
													value='<div class="form-group form-group-sm valid required">
					                                    <label class="control-label col-sm-3">Berita Pengiriman</label>
					                                    <div class="col-sm-5">
					                                        <input type="text" class="form-control" name="berita" id="her_berita">
					                                    <p class="help-block"></p>
					                                    </div>
					                                </div>'>
												<label for="her_berita"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                                <div class="form-group form-group-sm default">
	                                    <label class="control-label col-sm-3">Tanggal Transfer</label>
	                                    <div class="col-sm-5">
	                                    	<div class='input-group date'>
								                <input type='text' class="form-control input-sm" data-date-format="YYYY-MM-DD">
								                <span class="input-group-addon input-sm">
								                	<span class="fa fa-calendar"></span>
								                </span>
								            </div>
	                                    </div>
	                                    <div class="col-sm-4">
		                                    <div class="onoff pull-right">	
												<input type="checkbox" <?php echo $sts=='u'?findform("tgltransfer",$data1[0]->prg_form):"checked"; ?> name="her_tgltransfer" id="her_tgltransfer" 
													value='<div class="form-group form-group-sm valid required">
						                                    <label class="control-label col-sm-3">Tanggal Transfer</label>
						                                    <div class="col-sm-5">
						                                    	<div class="input-group date">
													                <input type="text" class="form-control input-sm" name="tgltransfer" data-date-format="YYYY-MM-DD">
													                <span class="input-group-addon input-sm">
													                	<span class="fa fa-calendar"></span>
													                </span>
													            </div>
																<script type="text/javascript">
																$(function () {
																	$(".input-group.date").datetimepicker({
																		icons: {
																		time: "fa fa-clock-o",
																		date: "fa fa-calendar",
																		up: "fa fa-arrow-up",
																		down: "fa fa-arrow-down"
																		}
																	});})
																</script>
						                                    <p class="help-block"></p>
						                                    </div>
						                                </div>'>
												<label for="her_tgltransfer"></label>
											</div>
										</div>
	                                    <p class="help-block"></p>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
				    </div>
			    	</div>
				    </div> <!--id form-->
				  </div> <!--tab content-->

				</div>
		</div>
		<div class="col-lg-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Publish
				</div>
				<div class="panel-body">
					<input type="hidden" name="id" value="<?php echo $new_id; ?>">
					<?php if($sts=="i" || $data1[0]->prg_image==null){ ?>
					<div class="fileinput fileinput-new" data-provides="fileinput" style="width: 100%;">
					  <div class="fileinput-new thumbnail" style="width: 100%; min-height: 150px;">
					    <img data-src="" alt="">
					  </div>
					  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100%;"></div>
					  <div>
					    <span class="btn btn-default btn-xs btn-file"><span class="fileinput-new">Pilih Gambar</span>
					    <span class="fileinput-exists">Ganti</span><input type="hidden" value="0" name="file_exist"><input type="file" name="userfile"></span>
					    <a href="#" class="btn btn-danger btn-xs fileinput-exists" data-dismiss="fileinput">Hapus</a>
					  </div>
					</div>
					<?php } else { ?>
					<div class="fileinput fileinput-exists" data-provides="fileinput" style="width: 100%;">
					  <div class="fileinput-new thumbnail" style="width: 100%; min-height: 150px;">
					    <img data-src="<?php echo $sts=='u'?base_url().index_page().$data1[0]->prg_image:'' ?>" alt="">
					  </div>
					  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100%; line-height: 10px;"><img src="<?php echo $sts=='u'?base_url().index_page().$data1[0]->prg_image:'' ?>"></div>
					  <div>
					    <span class="btn btn-default btn-xs btn-file"><span class="fileinput-new">Pilih Gambar</span>
					    <span class="fileinput-exists">Ganti</span><input type="hidden" value="1" name="file_exist"><input type="file" name="userfile"></span>
					    <a href="#" class="btn btn-danger btn-xs fileinput-exists" data-dismiss="fileinput">Hapus</a>
					  </div>
					</div>
					<?php } ?>
					<div class="form-group xs valid required">
						<label>Nama Program :</label>
						<input type="text" class="form-control input-sm" name="nama_prg" id="nama_prg" value="<?php echo $sts=='u'?$data1[0]->prg_nama:'' ?>">
						<p class="help-block"></p>
					</div>
					<div class="form-group xs valid required">
						<label>Link :</label>
						<input type="text" class="form-control input-sm" name="link" id="link" value="<?php echo $sts=='u'?$data1[0]->prg_link:'' ?>" onkeyup="setplink()">
						<p class="help-block"></p>
					</div>
					<div class="form-group xs valid required">
						<label>Tanggal Mulai :</label>
						<div class='input-group date'>
			                <input type='text' class="form-control input-sm" name="tglmulai" data-date-format="YYYY-MM-DD" value="<?php echo $sts=='u'?$data1[0]->prg_tglmulai:date_format(new datetime(),'Y-m-d'); ?>">
			                <span class="input-group-addon input-sm">
			                	<span class="fa fa-calendar"></span>
			                </span>
			            </div>
						<p class="help-block"></p>
					</div>
					<div class="form-group xs valid required">
						<label>Tanggal Akhir :</label>
						<div class='input-group date'>
			                <input type='text' class="form-control input-sm" name="tglakhir" data-date-format="YYYY-MM-DD" value="<?php echo $sts=='u'?$data1[0]->prg_tglakhir:''; ?>">
			                <span class="input-group-addon input-sm">
			                	<span class="fa fa-calendar"></span>
			                </span>
			            </div>
						<p class="help-block"></p>
					</div>
				</div>
				<div class="panel-footer text-right">
						<?php //echo $sts=="i"?'<button class="btn btn-default btn-xs" type="button" onclick="simpandraft()">Simpan Draft</button>':'' ?>
						<button type="submit" class="btn btn-primary btn-xs"><?php echo $sts=="i"?"Publish":"Update" ?></button>
						<p id="draft" class="text-primary"></p>
				</div>
			</div>
		</div>
		</form>   
	</div>

</div>

<noscript>
    <!-- cek javascript -->
</noscript>

<script type="text/javascript">
	function tampil(){
		if ($("#dgform").is(":checked")){
			$(".tutup").show();
		} else {
			$(".tutup").hide();
		}
        var w = ($(".tab-content").width());
        var h = $("#panel").height();
        var l = $("#plink").height()+10;
        if ($("#plink").html()=="" && $(".judul").html()=="") {
        	l=0
        } else if ($(".judul").html()!="") {
        	l= $(".judul").height()+5;
        };
        $('.tutup').css('top', l).css('top','+=180px');
		$('.tutup').css('width', w).css('width', '-=2px');
		$('.tutup').css('height', h).css('height', '-=55px');
	};

	$(function () {
		$('.fileinput').fileinput();
        $('.input-group.date').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });
		var judul = document.getElementById('link').value;
		if (judul!='') {
			var link = judul.replace(/ /g, "_");
			link = link.toLowerCase();
			for (var i = 0; i < link.length; i++) {
				if (cek.indexOf(link.charAt(i))==-1){
					link = link.replace(link.charAt(i),""); i--;
				}
			}; 
			document.getElementById('link').value=link.toLowerCase();
			document.getElementById('plink').innerHTML = "<?php echo 'Link Program: '.base_url().index_page().'halaman/' ?>"+link.toLowerCase();
		} else {
			document.getElementById('link').value="";
			document.getElementById('plink').innerHTML = "";
		}
    });

    $("#cform").click(function(){ 
		if ($("#dgform").is(":checked")){
			$(".tutup").hide();
		} else {
			$(".tutup").show();
		}
        var w = ($(".tab-content").width());
        var h = $("#panel").height();
        h = $('#form').height();
        var l = $("#plink").height()+10;
        if ($("#plink").html()=="" && $(".judul").html()=="") {
        	l=0
        } else if ($(".judul").html()!="") {
        	l= $(".judul").height()+5;
        };
        $('.tutup').css('top', l).css('top','+=180px');
		$('.tutup').css('width', w).css('width', '-=2px');
		$('.tutup').css('height', h).css('height', '-=80px');
    });
	
	window.onresize = function() {
		if ($("#dgform").is(":checked")){
			$(".tutup").hide();
		} else {
			$(".tutup").show();
		}
        var w = ($(".tab-content").width());
        var h = $("#panel").height();
        var l = $("#plink").height()+10;
        if ($("#plink").html()=="" && $(".judul").html()=="") {
        	l=0
        } else if ($(".judul").html()!="") {
        	l= $(".judul").height()+5;
        };
        $('.tutup').css('top', l).css('top','+=180px');
		$('.tutup').css('width', w).css('width', '-=2px');
		$('.tutup').css('height', h).css('height', '-=55px');
	};

	function pilih(cekk){
    	var cek = $(cekk).closest(".onoff").find("input[type='checkbox']");
    	var onoff = !cek.is(':checked');
		$(cekk).closest(".panel").find(".panel-body").find(".onoff > input[type='checkbox']").prop('checked', onoff);
	};

	var cek = "abcdefghijklmnopqrstuvwxyz0123456789._-";

	function setLink () {
		var judul = document.getElementById('judul').value;
		if (judul!='') {
			var link = judul.replace(/ /g, "_");
			link = link.toLowerCase();
			for (var i = 0; i < link.length; i++) {
				if (cek.indexOf(link.charAt(i))==-1){
					link = link.replace(link.charAt(i),""); i--;
				}
			}; 
			document.getElementById('link').value=link.toLowerCase();
			document.getElementById('plink').innerHTML = "<?php echo 'Link Program: '.base_url().index_page().'halaman/' ?>"+link.toLowerCase();
			$("#link").parent().removeClass("has-error").addClass("has-success");
			$("#link").parent().find("p.help-block").html("");
		} else {
			document.getElementById('link').value="";
			document.getElementById('plink').innerHTML = "";
			$("#link").parent().removeClass("has-success").addClass("has-error");
			$("#link").parent().find("p.help-block").html("Field ini harus diisi");
		}
	};
	function setplink(){
		var link = document.getElementById('link').value;
		link = link.replace(/ /g, "_");
		link = link.toLowerCase();
		for (var i = 0; i < link.length; i++) {
			if (cek.indexOf(link.charAt(i))==-1){
				link = link.replace(link.charAt(i),""); i--;
			}
		}; 
		document.getElementById('plink').innerHTML = "<?php echo 'Link Program: '.base_url().index_page().'artikel/' ?>"+link.toLowerCase();
		document.getElementById('link').value=link.toLowerCase();
	}

	$('.fileinput').on('clear.bs.fileinput', function () {
	  $("input[name=file_exist]").val("0");
	});

	$('.fileinput').on('reset.bs.fileinput', function () {
	  $("input[name=file_exist]").val("0");
	});

	$('.fileinput').on('change.bs.fileinput', function () {
	  $("input[name=file_exist]").val("1");
	});
</script>

<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>