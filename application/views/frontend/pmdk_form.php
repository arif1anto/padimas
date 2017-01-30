<div class="page-detail">
    <div class="row">
        <div class="col-lg-12">
        <div class="breadcrumb det">
            <ul id="breadcrumbs-one">
                <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
                <li><a href="<?php echo base_url().index_page() ?>program/">Program</a></li>
                <li><a href="<?php echo base_url().index_page() ?>program/pmdk">Program PMDK</a></li>
                <li><a class="current">Pendaftaran PMDK</a></li>
            </ul>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="detail">
                <div class="detail-heading">
                    <h1 class="page-header">Formulir Pendaftaran Program PMDK</h1>
                </div>
                <div class="detail-body">
                    <div class="alert alert-info alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <strong style="font-size:18px;"><i class="fa fa-info-circle fa-fw"></i>Informasi!</strong><br/>
                        <ol style="text-justify">
                        <li>Berdo'alah sebelum mengisi formulir sesuai dengan keyakinan masing-masing.</li>
                        <li>Pastikan Saudara sudah membaca penjelasan mengenai Program PMDK, jika belum membacanya silakan dibaca di sini.</li>
                        <li>Isilah formulir berikut ini dengan lengkap dan benar.</li>
                        <li>Ikuti format atau contoh yang disediakan agar tidak terjadi kesalahan dalam mengisi formulir.</li>
                        <li>Baca baik-baik konfirmasi pendaftaran yang sudah saudara lakukan, simpan atau cetak informasi yang dirasa penting.</li>
                        </ol>
                    </div>
                    <form class="form-horizontal" >
                        <fieldset>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Pilih Program Studi</h3>
                            </div>
                            <div class="panel-body">
                                <p>Silakan pilih dua program studi yang saudara minati:</p>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Pilihan Prodi 1</label>
                                    <div class="col-lg-5">
                                        <select class="form-control" name="prodi1">
                                            <option value="">D3 Akutansi</option>
                                            <option value="">D3 Akutansi</option>
                                            <option value="">D3 Akutansi</option>
                                            <option value="">D3 Akutansi</option>
                                            <option value="">D3 Akutansi</option>
                                        </select>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Pilihan Prodi 2</label>
                                    <div class="col-lg-5">
                                        <select class="form-control" name="prodi2">
                                            <option value="">D3 Akutansi</option>
                                            <option value="">D3 Akutansi</option>
                                            <option value="">D3 Akutansi</option>
                                            <option value="">D3 Akutansi</option>
                                            <option value="">D3 Akutansi</option>
                                        </select>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Data Pendaftar</h3>
                            </div>
                            <div class="panel-body">
                                <p>Silakan isi data pribadi berikut ini dengan sebenar-benarnya:</p>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Nama</label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" name="nama">
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Nomor Induk</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="no_induk">
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group valid required">
                                    <label class="control-label col-lg-3">Alamat</label>
                                    <div class="col-lg-7">
                                        <textarea class="form-control" rows="3" name="alamat"></textarea>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Nomor Telp.</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                            <input type="text" class="form-control" name="telp">
                                        </div>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Alamat Email</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                @
                                            </span>
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Jumlah Saudara</label>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="jml_saudara" >
                                            <span class="input-group-addon">
                                                Orang
                                            </span>
                                        </div>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Saya anak ke</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" name="anak_ke" >
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Nama Ayah</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="nama_ayah" >
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="form-control" name="ket_ayah">
                                            <option value="1">Masih hidup</option>
                                            <option value="1">Sudah Meninggal</option>
                                        </select>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Nama Ibu</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="nama_ibu" >
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="form-control" name="ket_ibu">
                                            <option value="1">Masih hidup</option>
                                            <option value="1">Sudah Meninggal</option>
                                        </select>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Pekerjaan Ayah</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" name="kerja_ayah">
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Pekerjaan Ibu</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" name="kerja_ibu">
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group valid required">
                                    <label class="control-label col-lg-3">Alamat lengkap</label>
                                    <div class="col-lg-7">
                                        <textarea class="form-control" rows="3" name="alamat_ortu"></textarea>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Nomor Telp./HP</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                            <input type="text" class="form-control" name="telp_ortu">
                                        </div>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Data Sekolah</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Nama Sekolah</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="nama_sekolah">
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group valid required">
                                    <label class="control-label col-lg-3">Alamat Sekolah</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control" name="alamat_sekolah" rows="3"></textarea>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Nomor Telp.</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                            <input type="text" class="form-control" name="telp_sekolah">
                                        </div>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Nama Guru BK</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="nama_gurubk">
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Nomor Telp./HP Guru BK</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                            <input type="text" class="form-control" name="telp_bk">
                                        </div>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-3">Rerata nilai raport:</label>
                                    <div class="col-sm-9"></div>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Semester 1</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" name="raport_smt1">
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Semester 2</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" name="raport_smt2">
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Semester 3</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" name="raport_smt3">
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-group-sm valid required">
                                    <label class="control-label col-lg-3">Prestasi</label>
                                    <div class="col-lg-9">
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
                                                <td>Juara I Lomba Makan Krupuk</td>
                                                <td class="text-center">2012</td>
                                                <td>Pak RT</td>
                                                <td class="text-center"><button type="button" class="btn btn-circle btn-xs btn-danger"><i class="fa fa-times"></i></button></td>
                                                </tr>
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
                                </div>
                            </div>
                        </div>
                                <p>Centang pernyataan setuju dan isi kode yang ditampilkan berikut ini:</p>
                                <div class="checkbox">
                                    <label>
                                      <input type="checkbox"> Saya menandatangani formulir pendaftaran untuk saya kirimkan ke Panitia PMB UTY 2014/2015
                                    </label>
                                </div><br/>
                                <p class="text-left"><button class="btn btn-lg btn-primary"><i class="fa fa-send fa-fw"></i> Kirim ke Panitia</button></p>
                            
                    </fieldset>
                    </form>
                </div>
                <div class="detail-footer">
                    
                </div>
            </div>
        </div>
    </div>
</div>