<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Konfigurasi Biaya</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
			<div class="row">
				<div class="col-md-6 jarak_bawah">
					<?php echo form_open('',array('class'=>'form-inline')) ?>
						<button type="button" class="btn btn-primary btn-xs" onclick="tambah()">Tambah Biaya</button>
					</form>
				</div>
				<div class="col-md-6 jarak_bawah text-right">
					<?php echo form_open('',array('class'=>'form-inline')) ?>
						<label class="control-label">Update tahun berlaku biaya sesuai konfigurasi</label>
						<a  href="<?php echo base_url().index_page()?>admin/konfigurasi/biaya/upthnberlaku" type="button" class="btn btn-success btn-xs" >Update</a>
					</form>
				</div>
			</div>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center" width="100">Aksi</th>
                    <th class="text-center" width="30">No</th>
					<th>Program Studi</th>                    
					<th class="text-right">SPP Tetap</th>
					<th class="text-right">SPP Teori</th>
					<th class="text-right">SPP Prak</th>
					<th class="text-right">SPA</th>
					<th class="text-right">SPA ALum</th>
					<th class="text-right">Status Biaya</th>
					<th class="text-right">Tahun</th>
                  </tr>
                </thead>
                <tbody>
                    <tr id="tambah" style="display:none;">
						<?php echo form_open('admin/konfigurasi/biaya/tambah') ?>
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
											echo "<option value='".$row->id_programprodi."'>".$row->prodi."</option>";
										}
									}
												
									?>
								</select>
								<p class="help-block"></p>
							</div>
						</td>
                        <td>
                            <div class="form-group jarak_bawah valid required">
                            <input type="text" class="form-control input-sm" name="spp_ttp" placeholder="Misal: 1000000">
                                <p class="help-block"></p>
                            </div>
                        </td>
                        <td>
                            <div class="form-group jarak_bawah valid required">
                            <input type="text" class="form-control input-sm" name="spp_teo" placeholder="Misal: 1000000">
                                <p class="help-block"></p>
                            </div>
                        </td>						
                        <td>
                            <div class="form-group jarak_bawah valid required">
                            <input type="text" class="form-control input-sm" name="spp_prak" placeholder="Misal: 1000000">
                                <p class="help-block"></p>
                            </div>
                        </td>												
                        <td>
                            <div class="form-group jarak_bawah valid required">
                            <input type="text" class="form-control input-sm" name="spa" placeholder="Misal: 1000000">
                                <p class="help-block"></p>
                            </div>
                        </td>											
						<td>
                            <div class="form-group jarak_bawah valid required">
                            <input type="text" class="form-control input-sm" name="spa_alum" placeholder="Misal: 1000000">
                                <p class="help-block"></p>
                            </div>
                        </td>
						<td>
                            <div class="form-group jarak_bawah valid required">
								<select id="s_biaya" class="form-control input-sm" name="stat_biaya" >
									<option value="">-silahkan pilih salah satu-</option>
									<option value="0">static</option>
									<option value="1">sesuai gelombang</option>
								</select>
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
                        <td class="text-center" id="aksi<?php echo $row->id_programbiaya ?>">
                        	<div class="btn-group btn-group-sm" role="group">
							  <button type="button" class="btn btn-warning" title="Edit" value="0" onclick="edit('<?php echo $row->id_programbiaya; ?>',$(this))"><i class="fa fa-pencil"></i></button>
							  <button type="button" class="btn btn-danger" title="Hapus" value="<?php echo $row->id_programbiaya ?>" onclick="hapus($(this).val())"><i class="fa fa-times"></i></button>
							</div>
                        </td>
                        <td class="text-center"><?php echo $i ?></td>
                        <td id="prodi"><?php echo $row->prodi ?></td>
						<td class="text-right" id="spp_ttp<?php echo $row->id_programbiaya ?>"><?php echo $row->spp_tetap ?></td>
						<td class="text-right" id="spp_teo<?php echo $row->id_programbiaya ?>"><?php echo $row->sppv_teori ?></td>
						<td class="text-right" id="spp_prak<?php echo $row->id_programbiaya ?>"><?php echo $row->sppv_praktek ?></td>
						<td class="text-right" id="spa<?php echo $row->id_programbiaya ?>"><?php echo $row->spa ?></td>
						<td class="text-right" id="spa_alum<?php echo $row->id_programbiaya ?>"><?php echo $row->spa_alum ?></td>
						<td class="text-center" id="stat_biaya<?php echo $row->id_programbiaya ?>"><?php echo $row->stat_biaya==0 ? 'Static' : 'Sesuai Gelombang'; ?></td>
						<td class="text-right" id="th<?php echo $row->id_programbiaya ?>"><?php echo $row->thn_berlaku ?></td>
                        </tr>
                    <?php
                            }
                        } else {
                    ?>
                        <tr>
                            <td colspan="15" class="danger text-center"><strong>Tidak ditemukan program biaya</strong></td>
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
					<th class="text-right">SPP Tetap</th>
					<th class="text-right">SPP Teori</th>
					<th class="text-right">SPP Prak</th>
					<th class="text-right">SPA</th>
					<th class="text-right">SPA ALum</th>
					<th class="text-right">Status Biaya</th>
					<th class="text-right">Tahun</th>
                  </tr>
                </tfoot>
              </table>
            </div>
			<div class="col-sm-12 text-center">
				<ul class="pagination pagination-sm">
				  <?php  echo $this->pagination->create_links(); ?>
				</ul>
			</div>
        </div>
		<div class="col-md-3 jarak_bawah">
			<div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Set Persentase Angsuran</h3>
                </div>
                <div class="panel-body">
					<?php echo form_open('admin/konfigurasi/biaya/angsuran',array('class'=>'form-horizonal','enctype'=>'multipart/form-data')) ?>
						<div class="form-group form-group-sm ">
							<label class="control-label">SPA Angsuran 1</label>
							<div class="input-group input-group-sm ">
								<input type="text" class="form-control" name="spa1" value="<?php echo isset($data3[0]->spa1) ? $data3[0]->spa1 : '' ?>" /> 
								<span class="input-group-addon input-sm">
                                     %
                                </span>
							</div>
						</div>	
						<div class="form-group form-group-sm ">
							<label class="control-label">SPA Angsuran 2</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control" name="spa2" value="<?php echo isset($data3[0]->spa2) ? $data3[0]->spa2 : '' ?>" />
								<span class="input-group-addon input-sm">
                                     %
                                </span>
							</div>
						</div>	
						<div class="form-group form-group-sm ">
							<label class="control-label">SPA Angsuran 3</label>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control" name="spa3" value="<?php echo isset($data3[0]->spa3) ? $data3[0]->spa3 : '' ?>" />
								<span class="input-group-addon input-sm">
                                     %
                                </span>
							</div>
						</div>
						<div class="form-group form-group-sm ">	
							<label class="control-label">SPA Angsuran 4</label>						
							<div class="input-group input-group-sm">
								<input type="text" class="form-control" name="spa4" value="<?php echo isset($data3[0]->spa4) ? $data3[0]->spa4 : '' ?>" />
								<span class="input-group-addon input-sm">
                                     %
                                </span>
							</div>
							
						</div>
						<p class="text-right">
							<button type="submit" class="btn btn-success btn-xs">SET</button>
						</p>
					</form>
				</div>
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
        <p id="konfirm_text">Yakin menghapus program biaya ini?</p>
		<?php echo form_open('admin/konfigurasi/biaya/hapus') ?>
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
			var spp_ttp = $("#spp_ttp"+jns).html();
			var spp_teo = $("#spp_teo"+jns).html();
			var spp_prak = $("#spp_prak"+jns).html();
			var spa = $("#spa"+jns).html();
			var spa_alum = $("#spa_alum"+jns).html();
			var stat_biaya = $("#stat_biaya"+jns).html();
			var th = $("#th"+jns).html();
			var isi = '<form id="formbiaya'+jns+'" method="post" action="<?php echo base_url().index_page()?>admin/konfigurasi/biaya/edit"><div class="form-group jarak_bawah valid required"><div class="input-group input-group-sm">';
			isi += '<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">';
			isi += '<button type="submit" class="btn btn-primary" name="id" value="'+jns+'"><i class="fa fa-save"></i></button>';
			isi += '</form>';
			sel  = '<select id="s_biaya'+jns+'" class="form-control input-sm" name="stat_biaya" form="formbiaya'+jns+'">';
			sel += '<option value="0" '+(stat_biaya=="Static" ? "selected" :"" )+'>static</option>';
			sel += '<option value="1" '+(stat_biaya=="Sesuai Gelombang" ? "selected" :"" )+'>sesuai gelombang</option>';
			sel += '</select>';
			$('#spp_ttp'+jns).html('<input type="text" class="form-control input-sm" name="spp_ttp" value="'+spp_ttp+'" form="formbiaya'+jns+'">');
			$('#spp_teo'+jns).html('<input type="text" class="form-control input-sm" name="spp_teo" value="'+spp_teo+'" form="formbiaya'+jns+'">');
			$('#spp_prak'+jns).html('<input type="text" class="form-control input-sm" name="spp_prak" value="'+spp_prak+'" form="formbiaya'+jns+'">');
			$('#spa'+jns).html('<input type="text" class="form-control input-sm" name="spa" value="'+spa+'" form="formbiaya'+jns+'">');
			$('#spa_alum'+jns).html('<input type="text" class="form-control input-sm" name="spa_alum" value="'+spa_alum+'" form="formbiaya'+jns+'">');
			$('#stat_biaya'+jns).html(sel);
			$('#th'+jns).html('<input type="text" class="form-control input-sm" name="th" value="'+th+'" form="formbiaya'+jns+'">');
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