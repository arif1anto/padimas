<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Kategori Test</h1>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12 jarak_bawah">
            <?php echo form_open('',array('class'=>'form-inline')) ?>
                <button type="button" class="btn btn-primary btn-xs" onclick="tambah()">Tambah Kategori Test</button>
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
                    <th class="text-center" width="50">No</th>
                    <th>Kategori Test</th>
                    <th class="text-right">Jumlah Soal</th>
					<th class="text-right">Total Nilai</th>
					<th class="text-center">TA</th>
					<th class="text-center">Jenis Tes</th>
					<th class="text-center">Prioritas</th>
                  </tr>
                </thead>
                <tbody>
                    <tr id="tambah" style="display:none;">
    	                    <td class="text-center" width="100">
							<?php echo form_open('admin/test/kategori/tambah',array('id'=>'ftambah')) ?>
                            <button type="submit" class="btn btn-xs btn-success"><i class="fa fa-save"></i> Simpan</button></form></td>
                            <td class="text-center" width="50">
                                <div class="form-group jarak_bawah valid required">
                                    
                                    <p class="help-block"></p>
                                </div>
                            </td>
    	                    <td>
    	                    	<div class="form-group jarak_bawah valid required">
    								<input type="text" class="form-control input-sm" name="kat" form="ftambah" placeholder="Misal: Kategori">
    								<p class="help-block"></p>
    							</div>
    						</td>
                            <td class="text-right">
                                <div class="form-group jarak_bawah valid required">
                                    <input type="text" class="form-control input-sm" name="jumsoal" form="ftambah">
                                    <p class="help-block"></p>
                                </div>
                            </td>
							<td class="text-right">
                                <div class="form-group jarak_bawah valid required">
                                    <input type="text" class="form-control input-sm" name="totnilai" form="ftambah">
                                    <p class="help-block"></p>
                                </div>
                            </td>
							<td class="text-center">
                                <div class="form-group jarak_bawah valid required">
                                    <select class="form-control input-sm" id="getta" name="ta" form="ftambah">
										<option>-pilih-</option>
										<?php
											for($ta=2008;$ta<=date('Y');$ta++){
												echo '<option value="'.$ta.'/'.($ta+1).'">'.$ta.'/'.($ta+1).'</option>';
											}
										?>
									</select>
                                    <p class="help-block"></p>
                                </div>
                            </td>
							<td>
                                <div class="form-group jarak_bawah valid required">
                                    <select class="form-control input-sm" name="jnstes" form="ftambah">
										<option>-pilih-</option>
										<?php
										if(count($data2)>0) :
											foreach($data2 as $r){
												echo '<option value="'.$r->id_jenistes.'">'.$r->jenis_tes.'</option>';
											}
										endif;	
										?>
									</select>
                                    <p class="help-block"></p>
                                </div>
                            </td>
							<td class="text-center">
                                <div class="form-group jarak_bawah valid required">
                                    <select class="form-control input-sm" name="prioritas" form="ftambah">
										<option>-pilih-</option>
										<?php
											for($a=1;$a<=5;$a++){
												echo '<option value="'.$a.'">'.$a.'</option>';
											}
										?>
									</select>
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
                        <tr id="jns">
                        <td id="aksi<?php echo $row->id_kategori; ?>"class="text-center">
                        	<div class="btn-group btn-group-sm" role="group">
							  <button type="button" class="btn btn-warning" title="Edit" value="0" onclick="edit('<?php echo $row->id_kategori; ?>',$(this))"><i class="fa fa-pencil"></i></button>
							  <button type="button" class="btn btn-danger" title="Hapus" value="<?php echo $row->id_kategori ?>" onclick="hapus($(this).val())"><i class="fa fa-times"></i></button>
							</div>
                        </td>
                        <td class="text-center"><?php echo $i ?></td>
                        <td id="kat<?php echo $row->id_kategori ?>"><?php echo $row->nama_kategori?></td>
                        <td class="text-right" id="jumsoal<?php echo $row->id_kategori ?>"><?php echo $row->jum_soal ?></td>
						<td class="text-right" id="totnilai<?php echo $row->id_kategori ?>"><?php echo $row->tot_nilai ?></td>
						<td class="text-center" id="ta<?php echo $row->id_kategori ?>"><?php echo $row->ta?></td>
						<td class="text-center" id="jnstes<?php echo $row->id_kategori ?>"><?php echo $row->jenis_tes ?></td>
						<td class="text-center" id="prioritas<?php echo $row->id_kategori ?>"><?php echo $row->id_prioritas ?></td>
                        </tr>
                    <?php
                            }
                        } else {
                    ?>
                        <tr>
                            <td colspan="4" class="danger text-center"><strong>Tidak ditemukan Kategori Test</strong></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-center" width="100">Aksi</th>
                    <th class="text-center" width="50">No</th>
                    <th>Kategori Test</th>
                    <th class="text-right">Jumlah Soal</th>
					<th class="text-right">Total Nilai</th>
					<th class="text-center">TA</th>
					<th class="text-center">Jenis Tes</th>
					<th class="text-center">Prioritas</th>
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
        <p id="konfirm_text">Yakin menghapus Kategori Test ini?</p>
		<?php echo form_open('admin/test/kategori/hapus') ?>
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
            var kat = $("#kat"+jns).html();
			var jumsoal = $("#jumsoal"+jns).html();
			var totnilai = $("#totnilai"+jns).html();
			var ta = $("#ta"+jns).html();
			var jnstes = $("#jnstes"+jns).html();
			var prioritas = $("#prioritas"+jns).html();
			var isi = '<form id="formkat'+jns+'" method="post" action="<?php echo base_url().index_page()?>admin/test/kategori/edit"><div class="form-group jarak_bawah valid required"><div class="input-group input-group-sm">';
			isi += '<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">';
			isi += '<button type="submit" class="btn btn-primary" name="id" value="'+jns+'"><i class="fa fa-save"></i></button>';
			isi += '</form>';
			var isi_ta 	='<select class="form-control input-sm" name="ta" form="formkat'+jns+'">';
				isi_ta +='<option>-pilih-</option>';
				<?php
				for($ta=2008;$ta<=date('Y');$ta++){?>
					isi_ta +='<option value="<?php echo $ta.'/'.($ta+1) ?>"'+("<?php echo $ta.'/'.($ta+1) ?>"==ta ? 'selected' : '')+'><?php echo $ta.'/'.($ta+1) ?></option>';
				<?php } ?>
				isi_ta +='</select>';
			var isi_jns  ='<select class="form-control input-sm" name="jnstes" form="formkat'+jns+'">';
				isi_jns +='<option>-pilih-</option>';
				<?php
				if(count($data2)>0) :
					foreach($data2 as $r){ ?>
					isi_jns +='<option value="<?php echo $r->id_jenistes ?>"'+("<?php echo $r->jenis_tes ?>"==jnstes ? 'selected' : '')+'><?php echo $r->jenis_tes ?></option>';
				<?php } endif; ?>
				isi_jns +='</select>';	
			var isi_prio ='<select class="form-control input-sm" name="prioritas" form="formkat'+jns+'">';
				isi_prio +='<option>-pilih-</option>';
				<?php
					for($a=1;$a<=5;$a++){?>
					isi_prio +='<option value="<?php echo $a ?>"'+("<?php echo $a ?>"==prioritas ? 'selected' : '')+'><?php echo $a ?></option>';
				<?php } ?>
			$('#kat'+jns).html('<input type="text" class="form-control input-sm" name="kat" value="'+kat+'" form="formkat'+jns+'">');
			$('#jumsoal'+jns).html('<input type="text" class="form-control input-sm" name="jumsoal" value="'+jumsoal+'" form="formkat'+jns+'">');
			$('#totnilai'+jns).html('<input type="text" class="form-control input-sm" name="totnilai" value="'+totnilai+'" form="formkat'+jns+'">');
			$('#ta'+jns).html(isi_ta);
			$('#jnstes'+jns).html(isi_jns);
			$('#prioritas'+jns).html(isi_prio);
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
		$("#konfirm_text").html("Yakin menghapus Kategori Test ini?");
		$("#idhapus").val(id);
		$('#konfirm').modal();
	}

</script>

<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>
