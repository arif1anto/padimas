<?php 
  if (isset($sfilter) && $sfilter!=null) {
    $ex = explode('&', $sfilter);
    $tgl = $ex[0];
    $kat = $ex[1];
    $key = $ex[2];
    $ket = $ex[3];
  } else {
    $tgl = null; $kat = null; $key = null; $ket = null;
  }
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Artikel</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5 jarak_bawah">
		<?php echo form_open('',array('class'=>'form-inline')) ?>
                <a href="<?php echo base_url().index_page(); ?>admin/artikel/baru" class="btn btn-primary btn-xs">Buat Artikel Baru</a>
                <button type="button" class="btn btn-danger btn-xs" onclick="hapusartikel()">Hapus</button>
                <div class="btn-group ">
                  <button type="button" class="btn btn-success btn-xs" onclick="publish('true')">Publish</button>
                  <button type="button" class="btn btn-default btn-xs" onclick="publish('false')">Unpublish</button>
                </div>
            </form>
        </div>
        <div class="col-sm-7 text-right jarak_bawah">
		<?php echo form_open('admin/artikel/cari',array('class'=>'form-inline','enctype'=>'multipart/form-data')) ?>
                <div class="form-group">
                    <select class="form-control input-sm" name="tgl">
                      <option value="0" <?php echo ($tgl=="0"?"selected":"") ?>>Semua Tanggal</option>
                      <?php foreach ($data2 as $row): 
                        $sel = $row->bulan==$tgl?"selected":"";
                      ?>
                      <option value="<?php echo $row->bulan ?>" <?php echo $sel ?>><?php echo $row->nama_bulan ?></option>
                      <?php endforeach ?>
                    </select>
                    <select class="form-control input-sm" name="kat">
                      <option value="0" <?php echo ($kat=="0"?"selected":"") ?>>Semua Kategori</option>
                      <option value="null" <?php echo ($kat=="null"?"selected":"") ?>>Belum Dikategorikan</option>
                      <?php foreach ($data3 as $row): 
                        $sel = $row->kat_id==$kat?"selected":"";
                      ?>
                      <option value="<?php echo $row->kat_id ?>" <?php echo $sel ?>><?php echo $row->kat_nama ?></option>
                      <?php endforeach ?>
                    </select>
                    <input type="text" class="form-control input-sm" name="key" id="key" placeholder="Kata Kunci" value="<?php echo $key ?>">
                    <button class="btn btn-default btn-xs"><i class="fa fa-filter"></i> Filter</button>
                </div>
        </div>
        <div class="col-sm-12">
            <div class="btn-group" data-toggle="buttons" id="radio">
              <label class="btn btn-default btn-xs <?php echo $ket=='pub'?'':'active' ?>" onclick="artikel('all')">
                <input type="radio" name="art_all" autocomplete="off" value="all" <?php echo $ket=='pub'?'':'checked' ?>> All
              </label>
              <label class="btn btn-default btn-xs <?php echo $ket=='pub'?'active':'' ?>" onclick="artikel('pub')">
                <input type="radio" name="art_all" value="pub" autocomplete="off" <?php echo $ket=='pub'?'checked':'' ?>> Published
              </label>
            </div>
        </div>
        </form>
        <div id="ajak">
        <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center"><input type="checkbox" class="checkbox-inline" onchange="pilih($(this))"></th>
                    <th>Judul Artikel</th>
                    <th>Authors</th>
                    <th>Kategori</th>
                    <th>Tags</th>
                    <th>Tanggal Publish</th>
                    <th class="text-center">Headline</th>
                    <th class="text-center">Status</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        if (count($data1)>0) {
                            $id = null; 
                            foreach ($data1 as $row) {
                                $sts = $row->status; 
                                $kat = $row->kategoris;
                                $tag = $row->tags;
                    ?>
                        <tr>
                        <td class="text-center"><input  type="checkbox" name="art_<?php echo $row->art_id;?>" value="<?php echo $row->art_id;?>"></td>
                        <td><strong><a href="<?php echo base_url().index_page().'admin/artikel/edit/'.$row->art_id; ?>" title="Click to edit"><?php echo $row->art_judul; ?></a></strong></td>
                        <td><?php echo "<a href='".base_url().index_page()."admin/artikel/author/".$row->aut_username."'>".$row->aut_display_name."<a/>"; ?></td>
                        <td><?php echo $kat==null?"<a href='".base_url().index_page()."admin/artikel/kategori/belum_dikategorikan'>Belum Dikategorikan<a/>":$kat; ?></td>
                        <td><?php echo $tag; ?></td>
                        <td><?php echo $row->art_tgl_terbit==null?"Belum Dipublish": date_format(date_create($row->art_tgl_terbit),"d M Y \p\u\k\u\l H:i:s"); ?></td>
                        <td class="text-center"><span class="label label-<?php echo $row->art_headline?'success':'default'; ?>"><i class="fa fa-<?php echo $row->art_headline?'check':'times'; ?>"></i></span></td>
                        <td class="text-center"><span class="label label-<?php echo $sts?'success':'default'; ?>"><i class="fa fa-<?php echo $sts?'check':'times'; ?>"></i></span></td>
                        </tr>
                    <?php
                                $id=$row->art_id;
                            }
                        } else {
                    ?>
                        <tr>
                            <td colspan="8" class="danger text-center"><strong>Tidak ditemukan artikel</strong></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                    <th class="text-center"><input type="checkbox" class="checkbox-inline" onclick="pilih($(this))"></th>
                    <th>Judul Artikel</th>
                    <th>Authors</th>
                    <th>Kategori</th>
                    <th>Tags</th>
                    <th>Tanggal Publish</th>
                    <th class="text-center">Headline</th>
                    <th class="text-center">Status</th>
                    </tr>
                </tfoot>
              </table>
            </div>
        </div>
        <div class="col-sm-12 text-center">
        <ul class="pagination pagination-sm">
          <?php  echo $this->pagination->create_links(); ?>
        </ul>
        </div>
        </div>
        <div class="col-sm-12">
            <blockquote class="pull-right">
              <p>Keterangan untuk kolom Headline</p>
              <small>Ditampilkan di Headline (Maksimal 5 Artikel) <span class="label label-success"><i class="fa fa-check"></i></span></small>
              <small>Tidak ditampilkan di Headline <span class="label label-default"> <i class="fa fa-times"></i> </span></small>
              <br/>
              <p>Keterangan untuk kolom Status</p>
              <small>Telah diterbitkan <span class="label label-success"><i class="fa fa-check"></i></span></small>
              <small>Tidak/belum diterbitkan <span class="label label-default"> <i class="fa fa-times"></i> </span></small>
            </blockquote>
        </div>
    </div>
</div>

<div class="modal fade" id="konfirm" tabindex="-1" role="dialog" aria-labelledby="konfirm" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header modal-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Konfirmasi Hapus</h4>
      </div>
      <div class="modal-body">
        <p id="konfirm_text">Yakin menghapus artikel ini?</p>
        <p class="text-right">
          <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal" onclick="hapus()">Ya</button>
          <button type="button" class="btn btn-xs btn-success" data-dismiss="modal">Tidak</button>
        </p>
      </div>
    </div>
  </div>
</div>

<script>
  function hapusartikel(){
    $("#konfirm_text").html("Yakin menghapus artikel ini?");
    $('#konfirm').modal();
  };

  function pilih(cek) {
    cek = cek.is(':checked');
      $('table').find('td input:checkbox').prop('checked', cek);
      $('table').find('th input:checkbox').prop('checked', cek);
  };
</script>
<script type="text/javascript">
   function hapus(){
    var cek = $('table').find('td input:checkbox');
    var id = "";
    for (var i = 0; i < cek.length; i++) {
      if ($(cek[i]).is(':checked')) {
        id += $(cek[i]).val()+"|";
      };
    };
    if (id!="") {
      $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>admin/artikel/hapus",
              data:{<?php echo $csrf ?>,"id":id},
              dataType:"html",
              success: function(data){
                $("tbody").html(data);
          },
          error:function(XMLHttpRequest){
              alert(XMLHttpRequest.responseText);
          }
      })
    };
  };

  function artikel(sts){
    tgl = $('select[name=tgl]').val();
    kat = $('select[name=kat]').val();
    key = $('input[name=key]').val();
    $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>admin/artikel/getartikel",
            data:{<?php echo $csrf ?>,"sts":sts,"tgl":tgl,"kat":kat,"key":key},
            dataType:"html",
            success: function(data){
              $("#ajak").html(data);
        },
        error:function(XMLHttpRequest){
            alert(XMLHttpRequest.responseText);
        }
    })
  };

  function publish(ket){
    var cek = $('table').find('td input:checkbox');
    var id = "";
    for (var i = 0; i < cek.length; i++) {
      if ($(cek[i]).is(':checked')) {
        id += $(cek[i]).val()+"|";
      };
    };
    if (id!="") {
      $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>admin/artikel/publish",
              data:{<?php echo $csrf ?>,"id":id,"ket":ket },
              dataType:"html",
              success: function(data){
                $("tbody").html(data);
          },
          error:function(XMLHttpRequest){
              alert(XMLHttpRequest.responseText);
          }
      })
    };
  }
</script>