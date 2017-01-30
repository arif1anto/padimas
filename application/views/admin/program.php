<?php 
  if (isset($sfilter) && $sfilter!=null) {
    $ex = explode('&', $sfilter);
    $key = $ex[0];
  } else {
    $key = null;
  }
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Program</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5 jarak_bawah">
			<?php echo form_open('',array('class'=>'form-inline')) ?>
                <a href="<?php echo base_url().index_page(); ?>admin/program/baru" class="btn btn-primary btn-xs">Buat Program Baru</a>
                <button type="button" class="btn btn-danger btn-xs" onclick="hapusprogram()">Hapus</button>
            </form>
        </div>
        <div class="col-sm-7 text-right jarak_bawah">
			<?php echo form_open('admin/program/cari',array('class'=>'form-inline','enctype'=>'multipart/form-data')) ?>
                <div class="form-group">
                    <input type="text" class="form-control input-sm" name="key" id="key" placeholder="Kata Kunci" value="<?php echo $key ?>">
                    <button class="btn btn-default btn-xs"><i class="fa fa-filter"></i> Filter</button>
                </div>
			</form>
        </div>
        <div id="ajak">
        <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center" width="40"><input type="checkbox" class="checkbox-inline" onchange="pilih($(this))"></th>
                    <th>Nama Program</th>
                    <th>Judul Program</th>
                    <th>Link</th>
                    <th>Tanggal Aktif</th>
                    <th class="text-center">Status</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        if (count($data1)>0) {
                            $id = null; 
                            foreach ($data1 as $row) {
                                $sts = $row->status; 
                    ?>
                        <tr>
                        <td class="text-center"><input  type="checkbox" name="page_<?php echo $row->prg_id;?>" value="<?php echo $row->prg_id;?>"></td>
                        <td><strong><a href="<?php echo base_url().index_page().'admin/program/edit/'.$row->prg_id; ?>" title="Click to edit"><?php echo $row->prg_nama; ?></a></strong></td>
                        <td><?php echo $row->prg_judul; ?></td>
                        <td><a href="<?php echo base_url().index_page().'program/'.$row->prg_link ?>" target="_blank"><?php echo base_url().index_page().'program/'.$row->prg_link ?></a></td>
                        <td><?php echo $row->prg_tglmulai.' s.d. '.$row->prg_tglakhir; ?></td>
                        <td class="text-center"><span class="label label-<?php echo $sts?'success':'default'; ?>"><i class="fa fa-<?php echo $sts?'check':'times'; ?>"></i></span></td>
                        </tr>
                    <?php
                            }
                        } else {
                    ?>
                        <tr>
                            <td colspan="6" class="danger text-center"><strong>Tidak ditemukan program</strong></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                    <th class="text-center"><input type="checkbox" class="checkbox-inline" onchange="pilih($(this))"></th>
                    <th>Nama Program</th>
                    <th>Judul Program</th>
                    <th>Link</th>
                    <th>Tanggal Aktif</th>
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
        <p id="konfirm_text">Yakin menghapus program ini?</p>
        <p class="text-right">
          <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal" onclick="hapus()">Ya</button>
          <button type="button" class="btn btn-xs btn-success" data-dismiss="modal">Tidak</button>
        </p>
      </div>
    </div>
  </div>
</div>

<script>
  function hapusprogram(){
    $("#konfirm_text").html("Yakin menghapus program ini?");
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
              url: "<?php echo base_url();?>admin/program/hapus",
              data:{<?php echo $csrf ?>,'id':id},
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
</script>