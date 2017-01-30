<div class="page-detail">
    <div class="row">
        <div class="col-lg-12">
        <div class="breadcrumb det">
            <ul id="breadcrumbs-one">
                <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
                <li><a href="<?php echo base_url().index_page() ?>program/<?php echo $data1[0]->prg_link ?>"><?php echo $data1[0]->prg_nama ?></a></li>
                <li><a class="current">Pendaftaran <?php echo $data1[0]->prg_nama ?></a></li>
            </ul>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="detail">
                <div class="detail-heading">
                    <h1 class="page-header">Formulir <?php echo $data1[0]->prg_judul ?></h1>
                </div>
                <div class="detail-body">
                    <div class="alert alert-info alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <strong style="font-size:18px;"><i class="fa fa-info-circle fa-fw"></i>Informasi!</strong><br/>
                        <ol style="text-justify">
                        <li>Berdo'alah sebelum mengisi formulir sesuai dengan keyakinan masing-masing.</li>
                        <li>Pastikan Saudara sudah membaca penjelasan mengenai Program PMDK, jika belum membacanya silakan dibaca di sini.</li>
                        <li>Isilah formulir berikut ini dengan lengkap dan benar.</li>
                        <li>Ikuti format atau contoh yang disediakan agar tidak terjadi kesalahan dalam mengisi formulir.</li>
                        <li>Baca baik-baik konfirmasi pendaftaran yang sudah saudara lakukan, simpan atau cetak informasi yang dirasa penting.</li>
                        </ol>
                    </div>
					<?php echo form_open('',array('class'=>'form-horizontal','enctype'=>'multipart/form-data')) ?>
						<?php echo $data1[0]->prg_form ?>                            
						<p>Untuk melengkapi proses pendaftaran silahkan isi captcha dengan hasil penjumlahan berikut ini dengan <strong>angka</strong>:</p>
						<div class="col-sm-12 form-group valid required">
							<div class="col-sm-4 input-group">
								<strong class="input-group-addon" style="color:#fff;font-size: 22px;background-color:#252525;border:none;">
									<?php 
									  echo $data3;
									  ?>
								</strong>
								<input class="form-control" name="mumet" placeholder="captcha" type="text" style="z-index:1;">
							</div>
							<p class="capca-salah text-left" style="color:#ff0039"></p>
						</div>
						<p class="text-left"><button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-send fa-fw"></i> Kirim ke Panitia</button></p>
                    </form>
                </div>
                <div class="detail-footer">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo isset($data2) ? $data2 : "" ?>

<script>
function getlokasi(nil1,nil2,nil3,nil4,nil5){
	   var nilai=$('#'+nil1).val();
	   
		   $.ajax({
				type: "POST",
				url: "<?php echo base_url().index_page();?>ajax/"+nil3,
				data:{<?php echo $csrf ?>,'id':nilai},
				dataType:'html',
				success: function(data){	
					$('#'+nil2).html(data);
				},
				error:function(XMLHttpRequest){

					alert(XMLHttpRequest.responseText);
				}
			});
			if(nil4!=null)
				$('#'+nil4).html("<option value=''>- Pilih Salah Satu -</option>");
			if(nil5!=null)
				$('#'+nil5).html("<option value=''>- Pilih Salah Satu -</option>");
	};
</script>
<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>