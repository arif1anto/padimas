<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Konfigurasi Digit Program Studi</h1>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12 jarak_bawah">
            <?php echo form_open('',array('class'=>'form-inline')) ?>
                <button type="button" class="btn btn-primary btn-xs" onclick="tambah()">Tambah Digit Program Studi</button>
            </form>
    	</div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center" width="100">Aksi</th>
                    <th class="text-center" width="30">No</th>
					<th>Program Studi</th>                    
					<th>Digit 1 (jenjang)</th>
					<th>Digit 4 (Jurusan)</th>
					<th>Digit 5 (Jurusan)</th>
					<th>Digit 6 (status)</th>
					<th>Digit 7 (program)</th>
                  </tr>
                </thead>
                <tbody>
                    <tr id="tambah" style="display:none;">
						<?php echo form_open('admin/konfigurasi/program_studi/tambah') ?>
	                    <td class="text-center">
                            <button type="submit" class="btn btn-success btn-xs" name="id"><i class="fa fa-plus fa-fw"></i> Simpan</button>
                        </td>
                        <td></td>
	                    <td>
	                    	<div class="form-group jarak_bawah valid required">
								<select id="jenisprog" class="form-control input-sm" name="prodi" >
									<option value="">-silahkan pilih salah satu-</option>
									<?php
									if (count($data1)>0) {
										$i=0;
										foreach ($data1 as $row) {
											echo "<option value='".$row->kd_proditawar."'>".$row->prodi."</option>";
										}
									}
												
									?>
								</select>
								<p class="help-block"></p>
							</div>
						</td>
                        <td>
                            <div class="form-group jarak_bawah valid required">
                            <input type="text" class="form-control input-sm" name="dig1" placeholder="Misal: 5">
                                <p class="help-block"></p>
                            </div>
                        </td>
                        <td>
                            <div class="form-group jarak_bawah valid required">
                            <input type="text" class="form-control input-sm" name="dig4" placeholder="Misal: 0">
                                <p class="help-block"></p>
                            </div>
                        </td>						
                        <td>
                            <div class="form-group jarak_bawah valid required">
                            <input type="text" class="form-control input-sm" name="dig5" placeholder="Misal: 4">
                                <p class="help-block"></p>
                            </div>
                        </td>												
                        <td>
                            <div class="form-group jarak_bawah valid required">
                            <input type="text" class="form-control input-sm" name="dig6" placeholder="Misal: 1">
                                <p class="help-block"></p>
                            </div>
                        </td>												
                        <td>
                            <div class="form-group jarak_bawah valid required">
                            <input type="text" class="form-control input-sm" name="dig7" placeholder="Misal: 1">
                                <p class="help-block"></p>
                            </div>
                        </td>												
                        </form>
                    </tr>
                    <?php 
                        if (count($data2)>0) {
                    		$i=0;
                            foreach ($data2 as $row) {
                            	$i++;
                    ?>
                        <tr>
                        <td class="text-center" id="aksi<?php echo $row->id_programprodi ?>">
                        	<div class="btn-group btn-group-sm" role="group">
							  <button type="button" class="btn btn-warning" title="Edit" value="0" onclick="edit('<?php echo $row->id_programprodi; ?>',$(this))"><i class="fa fa-pencil"></i></button>
							  <button type="button" class="btn btn-danger" title="Hapus" value="<?php echo $row->id_programprodi ?>" onclick="hapus($(this).val())"><i class="fa fa-times"></i></button>
							</div>
                        </td>
                        <td class="text-center"><?php echo $i ?></td>
                        <td id="prodi<?php echo $row->id_programprodi ?>"><?php echo $row->prodi ?></td>
						<td id="dig1<?php echo $row->id_programprodi ?>"><?php echo $row->dgt1 ?></td>
						<td id="dig4<?php echo $row->id_programprodi ?>"><?php echo $row->dgt4 ?></td>
						<td id="dig5<?php echo $row->id_programprodi ?>"><?php echo $row->dgt5 ?></td>
						<td id="dig6<?php echo $row->id_programprodi ?>"><?php echo $row->dgt6 ?></td>
						<td id="dig7<?php echo $row->id_programprodi ?>"><?php echo $row->dgt7 ?></td>
                        </tr>
                    <?php
                            }
                        } else {
                    ?>
                        <tr>
                            <td colspan="8" class="danger text-center"><strong>Tidak ditemukan program studi</strong></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-center">Aksi</th>
                    <th class="text-center">No</th>
                    <th>Program Studi</th>                    
					<th>Digit 1 (jenjang)</th>
					<th>Digit 4 (Jurusan)</th>
					<th>Digit 5 (Jurusan)</th>
					<th>Digit 6 (status)</th>
					<th>Digit 7 (program)</th>
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
        <p id="konfirm_text">Yakin menghapus program studi ini?</p>
		<?php echo form_open('admin/konfigurasi/program_studi/hapus') ?>
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
			var dig1 = $("#dig1"+jns).html();
			var dig4 = $("#dig4"+jns).html();
			var dig5 = $("#dig5"+jns).html();
			var dig6 = $("#dig6"+jns).html();
			var dig7 = $("#dig7"+jns).html();
			var isi = '<form id="formprodi'+jns+'" method="post" action="<?php echo base_url().index_page()?>admin/konfigurasi/program_studi/edit">';
			isi += '<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">';
			isi += '<div class="form-group jarak_bawah valid required"><div class="input-group input-group-sm">';
			isi += '<button type="submit" class="btn btn-primary" name="id" value="'+jns+'"><i class="fa fa-save"></i></button>';
			isi += '</form>';
			$('#dig1'+jns).html('<input type="text" class="form-control input-sm" name="dig1" value="'+dig1+'" form="formprodi'+jns+'">');
			$('#dig4'+jns).html('<input type="text" class="form-control input-sm" name="dig4" value="'+dig4+'" form="formprodi'+jns+'">');
			$('#dig5'+jns).html('<input type="text" class="form-control input-sm" name="dig5" value="'+dig5+'" form="formprodi'+jns+'">');
			$('#dig6'+jns).html('<input type="text" class="form-control input-sm" name="dig6" value="'+dig6+'" form="formprodi'+jns+'">');
			$('#dig7'+jns).html('<input type="text" class="form-control input-sm" name="dig7" value="'+dig7+'" form="formprodi'+jns+'">');
			$('#aksi'+jns).html(isi);
			$(btn).val('1');
				
		} else {
			$(btn).val('0');
		}
	};

	function tambah(){
		$('#tambah').toggle();
	}

	function hapus(id){
		$("#konfirm_text").html("Yakin menghapus program studi ini?");
		$("#idhapus").val(id);
		$('#konfirm').modal();
	}

</script>

<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>