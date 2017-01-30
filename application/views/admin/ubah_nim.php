<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">HER-REGISTRASI</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Ubah Nomor Induk Mahasiswa</h3>
                </div>
                <div class="panel-body">
					<?php echo form_open('admin/pendaftaran/ubahnim/ok','id="formubahnim"') ?>
						<div class="form-horizontal">
							<div class="form-group form-group-sm valid required">
								<label class="control-label col-sm-4">No Pendaftaran</label>
								<div class="col-sm-8 input-sm">
									<input form="formubahnim" type="text" class="form-control" name="id_daftar" value="" id="searchbox" onkeyup="cari()" placeholder="Ketikkan Nomor Pendaftaran atau Nama Pendaftar untuk mencari data." autocomplete="off">
									<div class="input-group col-sm-6" id="display"></div>
									<p class="help-block"></p>
									<p class=" form-control-static">Nama : <strong id="nama"></strong></p>
								</div>
							</div>
							<div class="form-group form-group-sm valid numeric">
								<label class="control-label col-sm-4">NIM</label>
								<div class="col-sm-8 input-sm">
									<input form="formubahnim" type="text" class="form-control" name="nim" value="" id="getnim" onkeyup="ceknim()" maxlength="10" placeholder="Ketikkan NIM Baru" autocomplete="off">
									<p id="responnim" class="help-block"></p>
								</div>
							</div>
							<button type="submit" class="btn btn-success text-right" title="Ubah"><i class="fa fa-edit"></i> Ubah</button>
						</div>
					</form>
                </div>
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
				url: "<?php echo base_url().index_page();?>admin/ajax/getCariHer/ubahnim",
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
	function ceknim(){
		var nim=$("#getnim").val();
		if (nim!="") {
		  $.ajax({
				  type: "POST",
				  url: "<?php echo base_url().index_page();?>admin/ajax/cekNim",
				  data:{<?php echo $csrf ?>,'id':nim },
				  dataType:"text",
				  success: function(data){
					if(nim.length==10 && nim>0){
						if(data==nim)
							$("#responnim").html('<span style="color:red;">nim <b>'+data+'</b> sudah digunakan. Silahkan mencoba nim <b>'+(Number(data)+1)+'</b></span>');
						else
							$("#responnim").html('<span style="color:green;">nim ini bisa digunakan</span>');
					}else
						$("#responnim").html('<span style="color:red;">nim harus 10 digit angka</span>');
			  },
			  error:function(XMLHttpRequest){
				  alert(XMLHttpRequest.responseText);
			  }
		  })
		};
		$("#responnim").html('');
	}
</script>
<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>
