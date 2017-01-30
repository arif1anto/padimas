<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Konfigurasi Sumber Informasi</h1>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12 jarak_bawah">
			<?php echo form_open('',array('class'=>'form-inline')) ?>
                <button type="button" class="btn btn-primary btn-xs" onclick="tambah()">Tambah Sumber Informasi</button>
            </form>
    	</div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center" width="100">Aksi</th>
                    <th class="text-center" width="30">No</th>
                    <th>Sumber Informasi</th>
                  </tr>
                </thead>
                <tbody>
                    <tr id="tambah" style="display:none;">
	                    <td class="text-right" colspan="2">Sumber Informasi :</td>
	                    <td>
							<?php echo form_open('admin/konfigurasi/src_info/tambah') ?>
	                    	<div class="form-group jarak_bawah valid required">
		                    	<div class="input-group input-group-sm">
								<input type="text" class="form-control" name="info" placeholder="Misal: Koran.">
								<div class="input-group-btn">
								<button type="submit" class="btn btn-success" name="id"><i class="fa fa-plus"></i></button>
								</div>
								</div>
								<p class="help-block"></p>
							</div>
							</form>
						</td>
                    </tr>
                    <?php 
                        if (count($data1)>0) {
                    		$i=0;
                            foreach ($data1 as $row) {
                            	$i++;
                    ?>
                        <tr>
                        <td class="text-center">
                        	<div class="btn-group btn-group-sm" role="group">
							  <button type="button" class="btn btn-warning" title="Edit" value="0" onclick="edit('<?php echo $row->kd_info; ?>',$(this))"><i class="fa fa-pencil"></i></button>
							  <button type="button" class="btn btn-danger" title="Hapus" value="<?php echo $row->kd_info ?>" onclick="hapus($(this).val())"><i class="fa fa-times"></i></button>
							</div>
                        </td>
                        <td class="text-center"><?php echo $i ?></td>
                        <td id="jenis<?php echo $row->kd_info ?>"><?php echo $row->info ?></td>
                        </tr>
                    <?php
                            }
                        } else {
                    ?>
                        <tr>
                            <td colspan="3" class="danger text-center"><strong>Tidak ditemukan jenis beasiswa</strong></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-center">Aksi</th>
                    <th class="text-center">No</th>
                    <th>Jenis Beasiswa</th>
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

<div class="modal fade" id="konfirm" tabindex="-1" role="dialog" aria-labelledby="konfirm" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header modal-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Konfirmasi Hapus</h4>
      </div>
      <div class="modal-body">
        <p id="konfirm_text">Yakin menghapus jenis sumber info ini?</p>
		<?php echo form_open('admin/konfigurasi/src_info/hapus') ?>
          <input type="hidden" name="id" id="idhapus">
	        <p class="text-right">
	          <button type="submit" id="mbhapus" class="btn btn-xs btn-danger">Ya</button>
	          <button type="button" class="btn btn-xs btn-success" data-dismiss="modal">Tidak</button>
	        </p>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(function(){
		$('#tambah').hide();
	});

    function pilih(cek) {
	    cek = cek.is(':checked');
	      $('table').find('th input:checkbox').prop('checked', cek);
	      $('table').find('tr input:checkbox').prop('checked', cek);
	};

	function edit(jns,btn){
		kondisi = $(btn).val();
		if (kondisi=='0') {
			var jenis = $("#jenis"+jns).html();
			var isi='<form method="post" action="<?php echo base_url().index_page()?>admin/konfigurasi/src_info/edit">';
			isi += '<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">';
			isi += '<div class="form-group jarak_bawah valid required"><div class="input-group input-group-sm">';
			isi += '<input type="text" class="form-control" name="info" value="'+jenis+'">';
			isi += '<div class="input-group-btn">';
			isi += '<button type="submit" class="btn btn-primary" name="id" value="'+jns+'"><i class="fa fa-save"></i></button></div></div>'
			isi += '</div></form>';
			$('#jenis'+jns).html(isi);
			$(btn).val('1');
		} else {
			var jenis = $(btn).closest("tr").find("input[name='info']").val();
			$('#jenis'+jns).html(jenis);
			$(btn).val('0');
		}
	};

	function tambah(){
		$('#tambah').toggle();
	}

	function hapus(id){
		$("#konfirm_text").html("Yakin menghapus jenis beasiswa ini?");
		$("#idhapus").val(id);
		$('#konfirm').modal();
	}

</script>

<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>