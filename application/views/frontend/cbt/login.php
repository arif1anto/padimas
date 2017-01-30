<div class="container login">
	<div class="col-lg-12 col-md-12">
        <div class="detail">
            <div class="detail-heading">
                <h1 class="page-header">Portal PMB UTY <?php echo date('Y') ?></h1>
            </div>
            <div class="detail-body" style="padding-bottom: 30px;">
				<div class="row">
					<div class="col-lg-8 hidden-md hidden-sm hidden-xs">				
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="5000" data-pause="hover">
					
						  <ol class="carousel-indicators">
							<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
							<li data-target="#carousel-example-generic" data-slide-to="1"></li>
							<li data-target="#carousel-example-generic" data-slide-to="2"></li>
						  </ol>

						  <div class="carousel-inner" role="listbox">
							<div class="item active">
							  <img src="<?php echo base_url() ?>image/cbt/1.jpg" alt="...">
							</div>
							<div class="item">
							  <img src="<?php echo base_url() ?>image/cbt/4.jpg" alt="...">
							</div>
							<div class="item">
							  <img src="<?php echo base_url() ?>image/cbt/3.jpg" alt="...">
							</div>
						  </div>

						</div>
					</div>
					<div class="col-lg-4 top10">	
						<?php echo form_open('maba/login') ?>
						  <?php if(isset($data1)){ ?>
						  <div class="alert alert-danger alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <strong>Login Gagal!</strong><br/> <?php echo $data1 ?>
						  </div>
						  <?php } ?>
						  <div class="form-group valid required">
							<label for="nodaftar">No. Pendaftaran</label>
							<input type="text" class="form-control" name="nodaftar" placeholder="Masukkan No. Pendaftaran" value="<?php echo isset($data2)?$data2:''; ?>">
							<p class="help-block"></p>
						  </div>
						  <div class="form-group valid required">
							<label for="pass">Sandi</label>
							<input type="password" class="form-control" name="pass" placeholder="Masukkan Sandi">
							<p class="help-block"></p>
						  </div>
							<div class="form-group valid required">
								<label for="pass">Captcha</label>
								<div class="col-sm-12 input-group">
									<strong class="input-group-addon" style="font-size: 22px;color:green;width:70%;background-color:#EEFDEE;border:none;">
										<?php 
										  echo $data3;
										  ?>
									</strong>
									<input class="form-control" name="mumet" type="text" value="">
								</div>
								<p class="help-block text-left"></p>
							</div>						  
						  <button type="submit" class="btn btn-primary">Masuk!</button>
						</form>
						
						<hr />
						
						Butuh Bantuan? <a data-toggle="modal" data-target="#bantuan">Klik di sini</a>.
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="bantuan">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title">Bantuan Sistem CBT</h4>
	  </div>
	  <div class="modal-body">			
		<p><b>Sandi apa yang harus saya masukkan?</b><br />
		Bagi Calon Mahasiswa masukkan Sandi yang tertera di Kartu Tes.</p>
		<p><b>Saya tidak dapat menemukan Sandi pada Kartu Tes.</b><br />
		Sandi untuk <strong>Test Potensi Akademik</strong> ada di bagian kiri bawah di dekat data pribadi Anda.</p>
		<p><b>Kartu Tes saya hilang, apa yang harus saya lakukan?</b><br />
		Segera hubungi Pantia PMB tempat Anda mendaftar.</p>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  </div>
	</div>
  </div>
</div>


<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>
