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
                    <h3 class="panel-title">Ubah SPA Mahasiswa</h3>
                </div>
                <div class="panel-body">
					<?php echo form_open('admin/pendaftaran/ubahspa/ok','id="formubahnim"') ?>
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
							<div class="form-group form-group-sm valid required">
								<label class="control-label col-sm-4">Jumlah SPA</label>
								<div class="col-sm-8 input-sm">
									<input form="formubahnim" type="text" class="form-control currency" name="spa" value="" maxlength="10" placeholder="Ketikkan Jumlah SPA dalam angka" autocomplete="off">
									<p id="responnim" class="help-block"></p>
								</div>
							</div>
							<div class="form-group form-group-sm">
								<label class="control-label col-sm-4">Potongan SPA</label>
								<div class="col-sm-8 input-sm">
									<input form="formubahnim" type="text" class="form-control currency" name="potspa" value="" maxlength="10" placeholder="Ketikkan Jumlah SPA dalam angka" autocomplete="off">
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
				url: "<?php echo base_url().index_page();?>admin/ajax/getCariHer/bayarher",
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
</script>
<script>
	var sep = '.';
	$(document).ready(function() {
		$('.currency').on('keyup', formatCurrency);
	});
	function formatCurrency()
	{
		var f = this.value.replace(/\D/g, '');
		var l = f.length;
		var g = l % 3;
		if(isInt(f) && f>999){
			if (g == 0 )
				this.value = thousands(f);
			else
			{
				var lead = f.substring(0, g);
					f = f.substring(g, l);
				this.value = lead + sep + thousands(f);
			}
		}else if(isInt(f) && f<1000) 
			this.value = f;
		else
			this.value= '';
	}

	// Function that commatizes the thousands
	function thousands(s)
	{
		// Match groups of 3 decimals
		var t = s.match(/(\d{3})/g);
		return t.join(sep) ;		
	}
	function isInt(n) {	
	   return n>=0 ? n % 1 === 0 : false;
	}
</script>
<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>
