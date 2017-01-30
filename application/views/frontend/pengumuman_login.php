<div class="page-detail">
    <div class="row">
        <div class="col-lg-12">
        <div class="breadcrumb det">
            <ul id="breadcrumbs-one">
                <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
                <li><a href="<?php echo base_url().index_page() ?>pengumuman/<?php echo $data1[0]->png_link ?>"><?php echo $data1[0]->png_judul ?></a></li>
                <li><a class="current">Unduh <?php echo $data1[0]->png_judul ?></a></li>
            </ul>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="detail">
				<div class="detail-heading">
                    <h1 class="page-header"></h1>
                </div>
                <div class="detail-body">
				<?php $err = isset($data2) ? $data2 :"" ;
				if($err=="error") :
				?>
					<div class="" style="background-color:#FFE000;padding:20px;line-height:1.5;">
						<h3 style="margin-top:0px;"><i style="color:red;"class="fa fa-exclamation-triangle fa-lg"></i> Sandi Salah</h3>
						<span>Pastikan sandi yang saudara masukkan adalah 7 digit pin yang didapatkan ketika mendaftar.<br/>
						Jika saudara mengalami kesulitan, silakan menghubungi Mbak Nurul di (0274)623310 Ekst.117.</span>
					</div>
				<?php endif;?>
					<?php echo form_open('',array('id'=>'commentform')) ?>				
						<center>
							<p>Masukkan sandi untuk mengunduh berkas pengumuman saudara.<br>
								<small>Sandi adalah  7 digit pin yang didapatkan ketika mendaftar. Jika mengalami kesulitan, silakan menghubungi Mbak Nurul di (0274)623310 Ekstensi 117</small>
							</p>
						</center>
						<center><input type="password" name="sandi" value="" maxlength="7" style="font-size: 14pt; text-align: center; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;"></center>					<center>
							
							<small><b style="color:red">Catatan : Jika saudara/i mengalami masalah dalam mengunduh file, disarankan Mengunduh file menggunakan Google Chrome</b></small>
						</center>
						<center><input type="submit" name="unduh" value="Unduh" class="btn btn-success"></center>
					</form>
                </div>
                <div class="detail-footer">
                    <p>
                        <small class="text-muted"><i class="fa fa-clock-o fa-fw"></i><?php echo date_format(new DateTime($data1[0]->png_tgl),'j F Y \P\u\k\u\l H:i'); ?></small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>