<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Konfigurasi Hak Akses</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php echo form_open(base_url().index_page()."admin/konfigurasi/hakakses/simpan"); ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Hak Akses</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="form-group">
                                <label>User Group</label>
                                <div class="input-group">
                                    <select class="form-control" name="hakakses" onchange="tampil($(this))">
                                        <?php foreach ($data2 as $row): ?>
                                            <option value="<?php echo $row->id_hakakses ?>"><?php echo $row->group; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="menu">
                    <?php echo $data1 ?>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Informasi</h4>
      </div>
      <div class="modal-body">
        <p class="title">Data quesioner berhasil disimpan</p>
        <p class="text-right">
        <button type="button" id="btnNo" class="btn btn-primary" data-dismiss="modal">OK</button>
        </p>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function notifikasi(title,message) {
        $('#myModal #myModalLabel').html(title);
        $('#myModal .title').html(message);
        $('#myModal').modal('show');
        var ret = false;
        $('#btnYes').click(function() {
            $('#myModal').modal('hide');
            ret = true;
        });
        $('#btnNo').click(function() {
            $('#myModal').modal('hide');
            ret = false;
        });
        return ret;
    }

	$(".checkbox.level-0>label>input[type='checkbox'], .checkbox.level-1>label>input[type='checkbox']").click(function() {
        var ck = $(this).closest('div.checkbox').find("input[type='checkbox']");
        $(ck).prop('checked', $(this).is(':checked'));
    });

    $(function(){
        <?php  
            if (isset($data3)) {
                if ($data3=="gagal") {
                    echo("notifikasi('Peringatan','Data hakakses gagal disimpan.')");
                } elseif($data3=="sukses") {
                    echo("notifikasi('Informasi','<strong>Terimakasih</strong> Data hakakses berhasil disimpan')");
                }
            }
        ?>
    });

    function tampil (a) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().index_page();?>admin/ajax/getmenu",
            data:{<?php echo $csrf ?>,'hak':$(a).val()},
            dataType:"html",
            success: function(data){
                $('#menu').html(data);
            }
        })
    }   
</script>

<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>