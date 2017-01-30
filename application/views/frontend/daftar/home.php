<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Selamat datang, <?php echo isset($data1[0]->nama) ? $data1[0]->nama : '' ?></h1>            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-sm-6" style="margin-bottom: 30px;">
            <!-- <a href="<?php // echo base_url().index_page()?>maba/pendaftaran" class="btn btn-block btn-primary">Lengkapi Data Pendaftaran</a> -->
            <a href="<?php echo base_url().index_page()?>maba/test" class="btn btn-block btn-primary"><?php echo $data2[0]->jml_soal>0?"Hasil":"Ikuti" ?> Tes Tertulis</a>
            <?php if ($data2[0]->jml_soal>0){ ?>
            
            <?php } if ($menu['herregistrasi']!=null) {?>
                <a href="<?php echo base_url().index_page()?>maba/herregistrasi" class="btn btn-block btn-primary">Lengkapi Data Her Registrasi</a>
            <?php } ?>
        </div>
        <div class="col-lg-8 col-sm-6">
            <div class="panel panel-default">
				<div class="panel-heading">
					<b>Informasi Penting Bagi Pendaftar</b>
				</div>
				<div class="panel-body">
					<img class="img-responsive" src="<?php echo base_url(); ?>image/alur.png" />
				</div>
            </div>            
        </div>
    </div>
</div>