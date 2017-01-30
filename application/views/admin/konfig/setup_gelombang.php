<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Konfigurasi Gelombang Pendaftaran</h1>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12 jarak_bawah">
            <?php echo form_open('',array('class'=>'form-inline')) ?>
                <button type="button" class="btn btn-primary btn-xs" onclick="tambah()">Buat Gelombang Pendaftaran Baru</button>
            </form>
    	</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center" width="100">Aksi</th>
                    <th class="text-center" width="30">No</th>
                    <th>Gelombang</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Akhir</th>
					<th>Tambah SPA</th>
					<th>Tambah SPA (Transfer)</th>
					<th>Tambah SPA Alumni</th>
                  </tr>
                </thead>
                <tbody>	
                  <tr id="tambah" style="display:none;">
                    <td colspan="2" class="text-center">
						<?php echo form_open('admin/konfigurasi/setup_gelombang/tambah',array('id'=>'tambah_gel')) ?>
	                    	<button type="submit" class="btn btn-primary btn-block btn-xs">Simpan</button>
						</form>	
					</td>
                    <td>
	                    <input type="hidden" name="id" id="iduser">
						<div class="form-group no-margin valid required">
							<select class="form-control input-sm" name="gel" id="gel" form="tambah_gel">
								<option value="">- Pilih Salah Satu -</option>
								<option value="I">I</option>
								<option value="II">II</option>
								<option value="III">III</option>
								<option value="IV">IV</option>
								<option value="V">V</option>
								<option value="VI">VI</option>
							</select>
							<p class="help-block"></p>
						</div>
                    </td>
                    <td>
                    <div class="form-group no-margin valid required">
							<input type="text" class="form-control input-sm date" form="tambah_gel" name="tgl_mulai" id="tglumum" placeholder="Format Tgl : YYYY-MM-DD">
							<p class="help-block"></p>
						</div>
                    </td>
                    <td>
	                    <div class="form-group jarak_bawah valid required">
							<input type="text" class="form-control input-sm date" form="tambah_gel" name="tgl_akhir" id="tglakhir" placeholder="Format Tgl : YYYY-MM-DD">
							<p class="help-block"></p>
						</div>
					</td>
					<td>
	                    <div class="form-group jarak_bawah valid required">
							<input type="text" class="form-control input-sm" form="tambah_gel" name="tbh_spa" id="tglher" placeholder="rx : 1000000">
							<p class="help-block"></p>
						</div>
					</td>
					<td>
	                    <div class="form-group jarak_bawah valid required">
							<input type="text" class="form-control input-sm" form="tambah_gel" name="tbh_spa_trans" id="tglher" placeholder="rx : 1000000">
							<p class="help-block"></p>
						</div>
					</td>
					<td>
	                    <div class="form-group jarak_bawah valid required">
							<input type="text" class="form-control input-sm" form="tambah_gel" name="tbh_spa_alum" id="tglher" placeholder="rx : 1000000">
							<p class="help-block"></p>
						</div>
					</td>
                  	</tr>			
                    <?php 
                        if (count($data1)>0) {
                    		$i=0;
                            foreach ($data1 as $row) {
                            	$i++;
                    ?>
                        <tr>
                        <td id="simpan<?php echo $row->gel ?>"class="text-center">
                        	<div class="btn-group btn-group-sm" role="group">
							  <button type="button" class="btn btn-warning" title="Edit" value="0" onclick="edit('<?php echo $row->gel; ?>',$(this))"><i class="fa fa-pencil"></i></button>
							  <button type="button" class="btn btn-danger" title="Hapus" value="<?php echo $row->gel ?>" onclick="hapus($(this).val())"><i class="fa fa-times"></i></button>
							</div>
                        </td>
                        <td class="text-center"><?php echo $i ?></td>
                        <td id="gel<?php echo $row->gel ?>"><?php echo $row->gel ?></td>
                        <td id="mul<?php echo $row->gel ?>"><?php echo $row->tgl_mulai ?></td>
                        <td id="akh<?php echo $row->gel ?>"><?php echo $row->tgl_akhir ?></td>
						<td id="spa<?php echo $row->gel ?>"><?php echo $row->tbh_spa ?></td>
						<td id="spatrans<?php echo $row->gel ?>"><?php echo $row->tbh_spa_transfer ?></td>
						<td id="spaalum<?php echo $row->gel ?>"><?php echo $row->tbh_spa_alum ?></td>
                        </tr>
                    <?php
                            }
                        } else {
                    ?>
                        <tr>
                            <td colspan="8" class="danger text-center"><strong>Tidak ditemukan data gelombang pendaftaran</strong></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-center">Aksi</th>
                    <th class="text-center">No</th>
                    <th>Gelombang</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Akhir</th>
					<th>Tambah SPA</th>
					<th>Tambah SPA (Transfer)</th>
					<th>Tambah SPA Alumni</th>
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
        <p id="konfirm_text">Yakin menghapus gelombang pendaftaran ini?</p>
		<?php echo form_open('admin/konfigurasi/setup_gelombang/hapus') ?>
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
    var opt = {
			pickTime: false,
			format: "YYYY-MM-DD",
			local:"id",
			icons: {
				time: "fa fa-clock-o",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
			}
		};
	function pilih(cek) {
	    cek = cek.is(':checked');
	      $('table').find('th input:checkbox').prop('checked', cek);
	      $('table').find('tr input:checkbox').prop('checked', cek);
	};

	function edit(jns,btn){
		kondisi = $(btn).val();
		if (kondisi=='0') {
			var mul = $("#mul"+jns).html();
			var akh = $("#akh"+jns).html();
			var spa = $("#spa"+jns).html();
			var spatrans = $("#spatrans"+jns).html();
			var spaalum = $("#spaalum"+jns).html();
			var isi = '<form id="editgel"method="post" action="<?php echo base_url().index_page()?>admin/konfigurasi/setup_gelombang/edit">';
			isi += '<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">';
			isi += '<button type="submit" class="btn btn-primary btn-sm" name="id" value="'+jns+'"><i class="fa fa-save"></i> Simpan</button>';
			isi += '</form>';
			$('#simpan'+jns).html(isi);
			$('#mul'+jns).html('<input type="text" class="form-control input-sm valid required date" form="editgel" name="tgl_mulai" value="'+mul+'">');
			$('#akh'+jns).html('<input type="text" class="form-control input-sm valid required date" form="editgel" name="tgl_akhir" value="'+akh+'">');
			$('#spa'+jns).html('<input type="text" class="form-control input-sm valid required" form="editgel" name="tbh_spa" value="'+spa+'">');
			$('#spatrans'+jns).html('<input type="text" class="form-control input-sm valid required" form="editgel" name="tbh_spa_trans" value="'+spatrans+'">');
			$('#spaalum'+jns).html('<input type="text" class="form-control input-sm valid required" form="editgel" name="tbh_spa_alum" value="'+spaalum+'">');
			$(btn).val('1');
			$('.date').datetimepicker(opt);
		} else {
			$(btn).val('0');
		}
	};

	function tambah(){
		$('#tambah').toggle();
	}

	function hapus(id){
		$("#konfirm_text").html("Yakin menghapus gelombang pendaftaran ini?");
		$("#idhapus").val(id);
		$('#konfirm').modal();
	}
	$(function(){
		$('#tambah').hide();
	});
	
	$(document).ready(function(){
		$('.date').datetimepicker(opt);
	});	
</script>

<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>