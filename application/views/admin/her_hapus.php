<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">HER-REGISTRASI</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Hapus Data Her Registrasi Mahasiswa</h3>
                </div>
                <div class="panel-body">
					<div class="form-horizontal">
						<div class="form-group form-group-sm valid required">
							<label class="control-label col-sm-3">NIM</label>
							<div class="col-sm-9 input-sm">
								<div class="input-group input-group-sm">
									<input form="formbyr" type="text" class="form-control" name="id_daftar" value="" id="searchbox" onkeyup="cari()" placeholder="Ketikkan Nomor Pendaftaran atau Nama Pendaftar untuk mencari data." autocomplete="off">
									<div class="input-group-btn">
										<button type="button" class="btn btn-danger" title="Hapus" onclick="hapus($('#searchbox').val())"><i class="fa fa-trash"></i> Hapus</button>
									</div>
								</div>
								<div class="input-group col-sm-6" id="display"></div>
								<p class="help-block"></p>
								<div class="form-group">
									<p class="col-xs-12 form-control-static">Nama Pendaftar : <strong id="nama"></strong></p>
								</div>
							</div>
						</div>
						<label class="control-label col-sm-3"></label>
						<div class="col-sm-9 input-sm">
							
						</div>
					</div>
					
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
        <p id="konfirm_text"></p>
		<?php echo form_open('admin/pendaftaran/hapusher/hapus') ?>
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
	function cari(){
		var nilai=$('#searchbox').val();
		if(nilai!=''){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url().index_page();?>admin/ajax/getCariHer/hapusher",
				data: {<?php echo $csrf ?>,'key':nilai },
				cache: false,
				success: function(data)
				{
					if(data.match(/table/g)==null)
						$("#nama").text(data);
					else		
						$("#display").html(data).show();	
				}
			});
		}
		$("#nama").text('');
		$("#display").hide();		
	}
	function hapus(id){
		if(id!=null && id!=''){
			$("#konfirm_text").html("Yakin menghapus Her Registrasi NIM "+id+"  ini?");
			$("#idhapus").val(id);
			$('#konfirm').modal();
		}
	}
</script>
<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>
