<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Jenis Test</h1>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12 jarak_bawah">
            <?php echo form_open('',array('class'=>'form-inline')) ?>
                <button type="button" class="btn btn-primary btn-xs" onclick="tambah()">Tambah Jenis Test</button>
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
                    <th class="text-center" width="50">#</th>
                    <th>Jenis Test</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                    <tr id="tambah" style="display:none;">
    	                    <td class="text-center" width="100">
							<?php echo form_open('admin/test/jenis_test/tambah',array('id'=>'ftambah')) ?>
                            <button type="submit" class="btn btn-xs btn-success"><i class="fa fa-save"></i> Simpan</button></form></td>
                            <td class="text-center" width="50">
                                <div class="form-group jarak_bawah valid required">
                                    <input type="text" class="form-control input-sm" name="id" form="ftambah">
                                    <p class="help-block"></p>
                                </div>
                            </td>
    	                    <td>
    	                    	<div class="form-group jarak_bawah valid required">
    								<input type="text" class="form-control input-sm" name="jenis" form="ftambah" placeholder="Misal: TPA">
    								<p class="help-block"></p>
    							</div>
    						</td>
                            <td>
                                <div class="form-group jarak_bawah">
                                    <input type="text" class="form-control input-sm" name="ket" form="ftambah">
                                    <p class="help-block"></p>
                                </div>
                            </td>
                        </td>
                    </tr>
                    <?php 
                        if (count($data1)>0) {
                    		$i=0;
                            foreach ($data1 as $row) {
                            	$i++;
                    ?>
                        <tr id="jns<?php echo $row->id_jenistes ?>">
                        <td class="text-center">
                        	<div class="btn-group btn-group-sm" role="group">
							  <button type="button" class="btn btn-warning" title="Edit" value="0" onclick="edit('<?php echo $row->id_jenistes; ?>',$(this))"><i class="fa fa-pencil"></i></button>
							  <button type="button" class="btn btn-danger" title="Hapus" value="<?php echo $row->id_jenistes ?>" onclick="hapus($(this).val())"><i class="fa fa-times"></i></button>
							</div>
                        </td>
                        <td class="text-center"><?php echo $row->id_jenistes ?></td>
                        <td id="jenis<?php echo $row->id_jenistes ?>"><?php echo $row->jenis_tes ?></td>
                        <td id="ket<?php echo $row->id_jenistes ?>"><?php echo $row->ket ?></td>
                        </tr>
                    <?php
                            }
                        } else {
                    ?>
                        <tr>
                            <td colspan="4" class="danger text-center"><strong>Tidak ditemukan jenis test</strong></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-center" width="100">Aksi</th>
                    <th class="text-center" width="30">#</th>
                    <th>Jenis Test</th>
                    <th>Keterangan</th>
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
        <p id="konfirm_text">Yakin menghapus jenis test ini?</p>
		<?php echo form_open('admin/test/jenis_test/hapus') ?>
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

	function edit(jns,btn){
		kondisi = $(btn).val();
		if (kondisi=='0') {
            var jenis = $("#jenis"+jns).html();
            var ket = $("#ket"+jns).html();
			var id = jns;
			var isi = '<td class="text-center"><form method="post" id="fjenis'+jns+'" action="<?php echo base_url().index_page()?>admin/test/jenis_test/edit">';
                isi += '<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">';
				isi += '<button type="submit" class="btn btn-xs btn-success"><i class="fa fa-save"></i> Simpan</button></form></td>';
                isi += '<td><div class="form-group jarak_bawah valid required">';
                isi += '<input type="hidden" name="id_lama" value="'+id+'" form="fjenis'+jns+'">';
                isi += '<input type="text" class="form-control input-sm" name="id" value="'+id+'" form="fjenis'+jns+'">';
                isi += '<p class="help-block"></p></div></td>';
                isi += '<td><div class="form-group jarak_bawah valid required">';
                isi += '<input type="text" class="form-control input-sm" name="jenis" value="'+jenis+'" form="fjenis'+jns+'" placeholder="Misal: TPA">';
                isi += '<p class="help-block"></p></div></td>';
                isi += '<td><div class="form-group jarak_bawah">';
                isi += '<input type="text" class="form-control input-sm" name="ket" value="'+ket+'" form="fjenis'+jns+'">';
                isi += '<p class="help-block"></p></div></td>';
			$('#jns'+jns).html(isi);
			$(btn).val('1');
		} else {
			var jenis = $(btn).closest("tr").find("input[name='jenis']").val();
            var ket = $(btn).closest("tr").find("input[name='ket']").val();
            var id = $(btn).closest("tr").find("input[name='id']").val();
            var isi = ' <td class="text-center">';
                isi +='      <div class="btn-group btn-group-sm" role="group">';
                isi +='        <button type="button" class="btn btn-warning" title="Edit" value="0" onclick="edit('+id+',$(this))"><i class="fa fa-pencil"></i></button>';
                isi +='        <button type="button" class="btn btn-danger" title="Hapus" value="'+id+'" onclick="hapus($(this).val())"><i class="fa fa-times"></i></button>';
                isi +='      </div></td>';
                isi +='  <td class="text-center">'+id+'</td>';
                isi +='  <td id="jenis'+id+'">'+jenis+'</td>';
                isi +='  <td id="ket'+id+'">'+ket+'</td>';
			$('#jns'+jns).html(jenis);
			$(btn).val('0');
		}
	};

	function tambah(){
		$('#tambah').toggle();
	}

	function hapus(id){
		$("#konfirm_text").html("Yakin menghapus jenis test ini?");
		$("#idhapus").val(id);
		$('#konfirm').modal();
	}

</script>

<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>
