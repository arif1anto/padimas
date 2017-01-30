<div class="row">
    <div class="col-lg-12">
        <div class="detail">
            <div class="detail-heading">
                <h1 class="page-header">Formulir Pendaftaran PMB</h1>
            </div>
            <div class="detail-body">
                <?php if (count($data2)>0) { ?>
                <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="<?php echo base_url().index_page()."maba/pendaftaran/simpan" ?>">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Registrasi</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group form-group-sm">
                                <label class="col-sm-3 control-label">No. Registrasi</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo $data2->id_daftar; ?>" disabled>
                                    <input type="hidden" name="id_daftar" value="<?php echo $data2->id_daftar; ?>">
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="col-sm-3 control-label">Jalur Pendaftaran</label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                    <label>
                                      <input type="radio" name="jalur" value="1" checked onchange="setprodi($(this).val(),'<?php echo $data2->prodi_pil1;?>','<?php echo $data2->prodi_pil2;?>')"> Reguler Awal
                                    </label>
                                    </div>
                                    <div class="radio">
                                    <label>
                                      <input type="radio" name="jalur" value="2" <?php echo $data2->kd_status=="2"?"checked":""; ?> onchange="setprodi($(this).val(),'<?php echo $data2->prodi_pil1;?>','<?php echo $data2->prodi_pil2;?>')"> Reguler Transfer
                                    </label>
                                    </div>
                                    <div class="radio">
                                    <label>
                                      <input type="radio" name="jalur" value="3" <?php echo $data2->kd_status=="3"?"checked":""; ?> onchange="setprodi($(this).val(),'<?php echo $data2->prodi_pil1;?>','<?php echo $data2->prodi_pil2;?>')"> Reguler Pindahan(blm lulus)
                                    </label>
                                    </div>
                                    <div class="radio">
                                    <label>
                                      <input type="radio" name="jalur" value="4" <?php echo $data2->kd_status=="4"?"checked":""; ?> onchange="setprodi($(this).val(),'<?php echo $data2->prodi_pil1;?>','<?php echo $data2->prodi_pil2;?>')"> Non Reguler
                                    </label>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="col-sm-3 control-label">Ingin Tes Tanggal</label>
                                <div class="col-sm-3">
                                    <div class="radio">
                                    <label>
                                      <input type="radio" name="tgltes" value="1" <?php echo $data2->stttgltes==1?"checked":""; ?> onchange="settgltes($(this).val())"> Hari ini
                                    </label>
                                    </div>
                                    <div class="radio">
                                    <label>
                                      <input type="radio" name="tgltes" value="2" <?php echo $data2->stttgltes==1?"":"checked";?> onchange="settgltes($(this).val())"> Tanggal
                                    </label>
                                    </div>
                                    <div class='input-group date' id='datetime'  style="margin-left:20px;">
                                        <?php 
                                            $tgltes = (($data2->tgl_test_id==null || $data2->tgl_test_id=="00-00-0000")?date("d-m-Y"):$data2->tgl_test_id);
                                         ?>
                                        <input type='text' class="form-control input-sm" name="tgl_test" data-date-format="DD-MM-YYYY" value='<?php echo $data2->stttgltes==1?"":$tgltes;?>'>
                                        <span class="input-group-addon input-sm">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <p class="help-block-2" style="margin-left:20px;">DD-MM-YYYY</p>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Pilih Program Studi</h3>
                        </div>
                        <div class="panel-body">
                            <p>Silakan pilih dua program studi yang saudara minati:</p>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Jenis Pendaftaran</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="jalur_pendaftaran">
                                        <option value="">- Pilih -</option>
                                        <?php foreach ($data3 as $row): 
                                            $sel = ($row->prg_id==$data2->jalur_pendaftaran)?"selected":"";
                                        ?>
                                        <option value="<?php echo $row->prg_id; ?>" <?php echo $sel ?>><?php echo $row->prg_nama ?></option>
                                        <?php endforeach ?>
                                    </select> 
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Pilihan 1</label>
                                <div class="col-sm-5">
                                    <select class="form-control prodi" name="prodi_pil1">
                                        <option value="">- Pilih -</option>
                                        <?php foreach ($data1 as $row): 
                                            $sel = ($row->kd_proditawar==$data2->prodi_pil1)?"selected":"";
                                        ?>
                                        <option value="<?php echo $row->kd_proditawar ?>" <?php echo $sel ?>><?php echo $row->nama_jenjang.' '.$row->nama_jurusan.' ('.$row->nama_program.') - '.$row->nama_status?></option>
                                        <?php endforeach ?>
                                    </select>
                                	<p class="help-block"></p>
                                </div>
                            </div>
                            <?php if($data2->jml_pilihan==2){ ?>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Pilihan 2</label>
                                <div class="col-sm-5">
                                    <select class="form-control prodi" name="prodi_pil2">
                                        <option value="">- Pilih -</option>
                                        <?php foreach ($data1 as $row): 
                                            $sel = ($row->kd_proditawar==$data2->prodi_pil2)?"selected":"";
                                        ?>
                                        <option value="<?php echo $row->kd_proditawar ?>" <?php echo $sel ?>><?php echo $row->nama_jenjang.' '.$row->nama_jurusan.' ('.$row->nama_program.') - '.$row->nama_status ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Pendaftar</h3>
                        </div>
                        <div class="panel-body">
                            <p>Silakan isi data pribadi berikut ini dengan sebenar-benarnya:</p>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Nama</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nama" value="<?php echo $data2->nama ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Jenis Kelamin</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="sex">
                                        <option value="">- Pilih -</option>
                                        <option value="P" <?php echo $data2->sex=="P"?"selected":""; ?>>Laki-laki</option>
                                        <option value="W" <?php echo $data2->sex=="W"?"selected":""; ?>>Perempuan</option>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Agama</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="agama">
                                        <option value="">- Pilih -</option>
                                        <?php foreach ($data4 as $row): 
                                            $sel = ($row->kd_agama==$data2->agama)?"selected":"";
                                        ?>
                                        <option value="<?php echo $row->kd_agama; ?>" <?php echo $sel ?>><?php echo $row->nama ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Tempat Lahir</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="tmp_lahir" value="<?php echo $data2->tmp_lahir ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Tanggal Lahir</label>
                                <div class="col-sm-4">
                                    <div class='input-group date'>
                                        <input type='text' class="form-control input-sm" name="tgl_lahir" data-date-format="DD-MM-YYYY" value='<?php echo $data2->tgl_lahir_id!="00-00-0000"?$data2->tgl_lahir_id:"";?>'>
                                        <span class="input-group-addon input-sm">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <p class="help-block-2">DD/MM/YYYY</p>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Alamat</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="alamat_asal" rows="3" ><?php echo $data2->alamat_asal ?></textarea>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Propinsi</label>
                                <div class="col-sm-4">
                                    <select id="prop_asal" class="form-control" name="prop_asal" onchange="getlokasi('prop_asal','kota_asal','getKota','kec_asal')">
                                        <option value=''>- Pilih Propinsi -</option>
                                        <?php 
                                            if (count($data5)>0) {
                                                $i=0;
                                                foreach ($data5 as $row) {
                                                        echo '<option value="'.$row->kd_propinsi.'"'.(isset($data2->prop_asal) && $data2->prop_asal==$row->kd_propinsi ? 'selected' : '').'>'.$row->nama_propinsi.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Kabupaten</label>
                                <div class="col-sm-4">
                                    <select id="kota_asal" class="form-control" name="kab_asal" onchange="getlokasi('kota_asal','kec_asal','getKecamatan')">
                                        <option value=''>- Pilih Kota -</option>
                                        <?php 
                                            if (count($data6)>0) {
                                                $i=0;
                                                foreach ($data6 as $row) {
                                                        echo '<option value="'.$row->kd_kota.'"'.(isset($data2->kab_asal) && $data2->kab_asal==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Kecamatan</label>
                                <div class="col-sm-4">
                                    <select id="kec_asal" class="form-control" name="kec_asal">
                                        <option value=''>- Pilih Kecamatan -</option>
                                        <?php 
                                            if (count($data7)>0) {
                                                $i=0;
                                                foreach ($data7 as $row) {
                                                        echo '<option value="'.$row->kd_kecamatan.'"'.(isset($data2->kec_asal) && $data2->kec_asal==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required numeric">
                                <label class="control-label col-sm-3">Telepon/HP</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                        <input type="text" class="form-control" name="telp" value="<?php echo $data2->telp; ?>">
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Sekolah</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Provinsi Sekolah</label>
                                <div class="col-sm-5">
                                    <select id="prop_sekolah" class="form-control" name="prop_sekolah" onchange="getlokasi('prop_sekolah','kota_sekolah','getKota','kec_sekolah','kd_sekolah')">
                                        <option value=''>- Pilih Propinsi -</option>
                                        <?php 
                                            if (count($data5)>0) {
                                                $i=0;
                                                foreach ($data5 as $row) {
                                                        echo '<option value="'.$row->kd_propinsi.'"'.(isset($data2->prop_sekolah) && $data2->prop_sekolah==$row->kd_propinsi ? 'selected' : '').'>'.$row->nama_propinsi.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Kota Sekolah</label>
                                <div class="col-sm-5">
                                    <select id="kota_sekolah" class="form-control" name="kota_sekolah" onchange="getlokasi('kota_sekolah','kec_sekolah','getKecamatan','kd_sekolah')">
                                        <option value=''>- Pilih Kota -</option>
                                        <?php 
                                            if (count($data8)>0) {
                                                $i=0;
                                                foreach ($data8 as $row) {
                                                        echo '<option value="'.$row->kd_kota.'"'.(isset($data2->kota_sekolah) && $data2->kota_sekolah==$row->kd_kota ? 'selected' : '').'>'.$row->nama_kota.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Kecamatan Sekolah</label>
                                <div class="col-sm-5">
                                    <select id="kec_sekolah" class="form-control" name="kec_sekolah" onchange="getlokasi('kec_sekolah','kd_sekolah','getSekolah')">
                                        <option value=''>- Pilih Kecamatan -</option>
                                        <?php 
                                            if (count($data9)>0) {
                                                $i=0;
                                                foreach ($data9 as $row) {
                                                        echo '<option value="'.$row->kd_kecamatan.'"'.(isset($data2->kec_sekolah) && $data2->kec_sekolah==$row->kd_kecamatan ? 'selected' : '').'>'.$row->nama_kecamatan.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Asal Sekolah</label>
                                <div class="col-sm-5">
                                    <select id="kd_sekolah" class="form-control" name="kd_sekolah">
                                        <option value=''>- Pilih Sekolah-</option>
                                        <?php 
                                            if (count($data10)>0) {
                                                $i=0;
                                                foreach ($data10 as $row) {
                                                        echo '<option value="'.$row->kd_sekolah.'" '.(isset($data2->kd_sekolah) && $data2->kd_sekolah==$row->kd_sekolah ? 'selected' : '').'>'.$row->nama_sekolah.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Jurusan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="jurusan" value="<?php echo $data2->jurusan ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Alamat Sekolah</label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" name="alamat_sekolah" rows="3"> <?php echo $data2->alamat_sekolah ?></textarea>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">Sudah lulus</label>
                                <div class="col-sm-5">
                                    <div class="radio">
                                        <label><input type="radio" name="sdh_lulus" value="1" <?php echo $data2->sdh_lulus?"checked":"" ?>>Sudah</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="sdh_lulus" value="0" <?php echo !$data2->sdh_lulus?"checked":"" ?>>Belum</label>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required numeric">
                                <label class="control-label col-sm-3">Tahun Kelulusan</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="thn_lulus" value="<?php echo $data2->thn_lulus ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required">
                                <label class="control-label col-sm-3">No STTB</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="no_sttb" value="<?php echo $data2->no_sttb ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required numeric">
                                <label class="control-label col-sm-3">Nilai Total</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="nilai_total" value="<?php echo $data2->nilai_total ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group form-group-sm valid required numeric">
                                <label class="control-label col-sm-3">IPK</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="rerata_uan" value="<?php echo $data2->rerata_uan ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>    
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Sumber Informasi</h3>
                        </div>
                        <div class="panel-body">                    
                            <?php 
                                if (isset($data11) && $data11!=null && count($data11)>0) {
                                    $i=0;
                                    foreach ($data11 as $row) { 
                                        echo '<div class="col-sm-4">
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="set_info[]" id="set_info'.$i.'" value="'.$row->id_info.'"'.($row->kd_info!=null  ? "checked": "").'>'.$row->info.
                                                    '</label>
                                                </div>
                                              </div>';
                                              $i++;
                                    }
                                }
                            ?>  
                        </div>
                    </div>     
                    <p class="text-left">
                        <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
                    </p>
                </form>
                <?php } else { ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                  <strong style="font-size:18px;"><i class="fa fa-info-circle fa-fw"></i>Error!</strong><br>
                    Tidak ditemukan data pendaftar, silahkan <a href="<?php echo base_url().index_page() ?>/maba/logout">logout</a> kemudian login lagi.
                </div>
                <?php } ?>
            </div>
            <div class="detail-footer">
                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url().index_page(); ?>assets/js/validasi.js"></script>
<script type="text/javascript">
    $(function () {
        $('.date').datetimepicker({
            pickTime:false,
            local:"id",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });
        settgltes('<?php echo $data2->stttgltes;?>');
        setprodi('<?php echo $data2->kd_status;?>','<?php echo $data2->prodi_pil1;?>','<?php echo $data2->prodi_pil2;?>');
    });


    function settgltes(a){
        if (a=='1') {
            $('#datetime input').prop('disabled', true);
            $("input[name=tgltes]").closest('.form-group').removeClass("has-error").addClass("has-success");
            $("input[name=tgltes]").closest('.form-group').find("p.help-block").html("");
            $('#datetime input').val("");
            return true;
        }else{
            $('#datetime input').prop('disabled', false);
            return validasi_tgltes();
        }
    }

    function validasi_tgltes(){
        a = $('#datetime input').val();
        cek = (a!="");
        if (cek==false) {
            $('select[name=dd_tgltes]').closest('.form-group').removeClass("has-success").addClass("has-error");
            $('select[name=dd_tgltes]').closest('.form-group').find("p.help-block").html("Lengkapi tanggal tes");
        } else {
            $('select[name=dd_tgltes]').closest('.form-group').removeClass("has-error").addClass("has-success");
            $('select[name=dd_tgltes]').closest('.form-group').find("p.help-block").html("");
        }
        return cek;
    }


    function getlokasi(nil1,nil2,nil3,nil4,nil5){
       var nilai=$('#'+nil1).val();
       
           $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>ajax/"+nil3,
                data:"id="+nilai,
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

    function setprodi(a,b,c){
        if(a==""){
            a = "1";
        }
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>ajax/getProdiByJalur",
            data:"id="+a+"&p="+b,
            dataType:'html',
            success: function(data){    
                $('select[name=prodi_pil1]').html(data);
            },
            error:function(XMLHttpRequest){
                alert(XMLHttpRequest.responseText);
            }
        });
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>ajax/getProdiByJalur",
            data:"id="+a+"&p="+c,
            dataType:'html',
            success: function(data){    
                $('select[name=prodi_pil2]').html(data);
            },
            error:function(XMLHttpRequest){
                alert(XMLHttpRequest.responseText);
            }
        });
    }
</script>