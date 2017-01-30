<?php 
	$sts = "i";
	$new_id = 0;
	if (isset($data2) && $data2!=null) {
		$new_id = $data2;
	}
	if (isset($data1) && $data1!=null) {
		$sts = "u";
		$new_id = $data1[0]->id_soal;
	}
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Soal Tes Potensi Akademik <small><?php echo $sts=="i"?"Tambah":"Sunting" ?> Soal Tes Potensi Akademik</small></h1>
        </div>
    </div>
	<div class="row">
    	<div class="col-md-12 jarak_bawah">
            <?php echo form_open('',array('class'=>'form-inline')) ?>
                <button type="button" class="btn btn-primary btn-xs" onclick="tambah()">Tambah Soal</button>
            </form>
    	</div>
    </div>
    <div id="tambah"class="row" <?php echo $sts == "u" ? "" : 'style="display:none;"'  ?>>
		<?php echo form_open('admin/test/soal_tpa'.($sts=='i'?'/simpan':'/edit/'.$data1[0]->id_soal),array('id'=>'soal_tpa','enctype'=>'multipart/form-data')) ?>
    	<div class="col-lg-12">
			<div class="col-lg-6">
				<input type="hidden" name="id" value="<?php echo $new_id; ?>">
				<div class="form-group jarak_bawah">
					<label class="control-label">Soal</label>
					<textarea class="summernote" name="soal" form="soal_tpa"><?php echo $sts=='u'? $data1[0]->soal:'' ?></textarea>
					<p class="help-block"></p>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group jarak_bawah valid required">
					<label class="control-label">Kategori</label>
					<select class="form-control input-sm" name="kat" form="soal_tpa">
						<option value="">-pilih-</option>
						<?php
						if(count($data3)>0) :
							foreach($data3 as $r){
								echo '<option value="'.$r->id_kategori.'" '.(isset($data1[0]->id_kategori) && $data1[0]->id_kategori==$r->id_kategori ? "selected" : "").'>'.$r->nama_kategori.'</option>';
							}
						endif;	
						?>
					</select>     
					<p class="help-block"></p>
				</div>
				<div class="form-group jarak_bawah valid required">
					<label class="control-label">Relasi Soal</label>
					<select class="form-control input-sm" name="relasi" form="soal_tpa">
						<option value="0">-pilih-</option>
						<?php
						if(count($data4)>0) :
							foreach($data4 as $r){
								echo '<option value="'.$r->id_soal.'" '.(isset($data1[0]->id_soal) && $data1[0]->id_related==$r->id_soal ? "selected" : "").'>'.$r->id_soal.' | '.$r->soal.'</option>';
							}
						endif;	
						?>
					</select>     
					<p class="help-block"></p>
				</div>
				<div class="form-group jarak_bawah valid required">
					<label class="control-label">Tahun Ajaran</label>
					<select class="form-control input-sm" id="ta" name="ta" form="soal_tpa">
						<option value="0">-pilih-</option>
						<?php
							for($ta=2008;$ta<=date('Y');$ta++){
								echo '<option value="'.$ta.'/'.($ta+1).'" '.(isset($data1[0]->ta_soal) && $data1[0]->ta_soal==$ta.'/'.($ta+1) ? "selected" : "").'>'.$ta.'/'.($ta+1).'</option>';
							}
						?>
					</select>
					<p class="help-block"></p>
				</div>
				<div class="form-group jarak_bawah valid required">
					<label class="control-label">Tampilkan Soal</label>
					<select class="form-control input-sm" id="aktif" name="aktif" form="soal_tpa">
						<option value="Y" <?php echo isset($data1[0]->aktif) && $data1[0]->aktif=="Y" ? "selected" : ""?>>-Ya-</option>
						<option value="T" <?php echo isset($data1[0]->aktif) && $data1[0]->aktif=="T" ? "selected" : ""?>>-Tidak-</option>
					</select>
					<p class="help-block"></p>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-6">		
				<div class="form-group jarak_bawah">
					 <label class="control-label">Pilihan Jawaban</label>	
					 <div class="table-responsive">
						  <table class="table table-hover">
							<thead>
							  <tr>
								<th class="text-center" width="50">Opsi</th>
								<th class="text-center">Jawaban</th>
								<th class="text-center">Kunci</th>
							  </tr>
							</thead>
							<tbody>
							<?php 
							$i=0;
							for($a='A';$a<'F';$a++){ ?>
								<tr id="tambah" >
										<td class="text-center">
											<div class="form-group jarak_bawah">
											<?php echo $a ?>
											<input type="hidden" class="form-control input-sm" name="idjawab[<?php echo $i ?>]" form="soal_tpa" placeholder="Misal: jawaban <?php echo $a ?>" value="<?php echo isset($data1[$i]->id_jawaban) ? $data1[$i]->id_jawaban : '' ?>">
											</div>
										</td>
										<td class="text-center">
											<div class="form-group jarak_bawah valid required">
												<input type="text" class="form-control input-sm" name="jawab[<?php echo $a ?>]" form="soal_tpa" placeholder="Misal: jawaban <?php echo $a ?>" value="<?php echo isset($data1[$i]->jawaban) ? $data1[$i]->jawaban : '' ?>">
												<p class="help-block"></p>
											</div>
										</td>
										<td class="text-center" width="20px;">
											<div class="form-group jarak_bawah">
												<input type="radio" name="kunci" value="<?php echo $a ?>" form="soal_tpa" <?php echo isset($data1[$i]->kunci_jawaban) && $data1[$i]->kunci_jawaban==1 ? "checked" : ""?>>
											</div>
										</td>
								</tr>
							<?php $i++;}?>
							</tbody>	
						</table>
					</div>	
					<p class="help-block"></p>
				</div>
				<button type="submit" class="btn btn-primary btn-xs"><?php echo $sts=="i"?"Simpan":"Update" ?></button>
				<script type="text/javascript">
					$(document).ready(function() {
					  $('.summernote').summernote(
							{ height: 250,                
							  minHeight: 250,             
							  maxHeight: 250,          
							  focus: true,
							  onImageUpload: function(files, editor, welEditable) {
								sendFile(files[0],editor,welEditable);
							  }
							}
						);
					});
				</script>
			</div>	
    	</div>
		</form> 
    </div>
	<div class="row">
		<div class="col-md-12" style="margin-top:15px;">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center" width="100">Aksi</th>
                    <th class="text-center" width="50">No</th>
					<th>ID Soal</th>
                    <th>Soal</th>
                    <th class="text-center">Kategori</th>
					<th class="text-center">Relasi Soal</th>
					<th class="text-center">TA</th>
					<th class="text-center">Tampilkan</th>
                  </tr>
                </thead>
                <tbody>
					<?php 
                        if (count($data5)>0) {
                    		$i=0;
                            foreach ($data5 as $row) {
                            	$i++;
                    ?>
					<tr id="jns">
                        <td id="aksi<?php echo $row->id_soal; ?>"class="text-center">
                        	<div class="btn-group btn-group-sm" role="group">
							  <a href="<?php echo base_url().index_page(); ?>admin/test/soal_tpa<?php echo '/edit/'.$row->id_soal; ?>" class="btn btn-warning" title="Edit" value="0"><i class="fa fa-pencil"></i></a>
							  <button type="button" class="btn btn-danger" title="Hapus" value="<?php echo $row->id_soal ?>" onclick="hapus($(this).val())"><i class="fa fa-times"></i></button>
							</div>
                        </td>
                        <td ><?php echo $i ?></td>
                        <td ><?php echo $row->id_soal?></td>
                        <td ><?php echo strip_tags(substr($row->soal,0,75))."..." ?></td>
						<td class="text-center"><?php echo $row->nama_kategori ?></td>
						<td class="text-center"><?php echo $row->id_related?></td>
						<td class="text-center"><?php echo $row->ta_soal ?></td>
						<td class="text-center"><?php echo $row->aktif ?></td>
                        </tr>
                    <?php
                            }
                        } else {
                    ?>
                        <tr>
                            <td colspan="8" class="danger text-center"><strong>Tidak ditemukan Kategori Test</strong></td>
                        </tr>
                    <?php
                        }
                    ?>
				</tbody>
				 <tfoot>
				  <tr>
					<th class="text-center" width="100">Aksi</th>
                    <th class="text-center" width="50">No</th>
					<th>ID Soal</th>
                    <th>Soal</th>
                    <th class="text-center">Kategori</th>
					<th class="text-center">Relasi Soal</th>
					<th class="text-center">TA</th>
					<th class="text-center">Tampilkan</th>
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
		<?php echo form_open('admin/test/soal_tpa/hapus') ?>
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
	var cek = "abcdefghijklmnopqrstuvwxyz0123456789._-";

	function sendFile(file, editor, welEditable) {
	    data = new FormData();
	    data.append("userfile", file);
		data.append(<?php echo "'".$this->security->get_csrf_token_name()."','".$this->security->get_csrf_hash()."'" ?>);
	    url = "<?php echo base_url();?>admin/upload";
	    $.ajax({
	        data: data,
	        type: "POST",
	        url: url,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function (url) {
	            editor.insertImage(welEditable, url);
	        }
	    });
	}
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