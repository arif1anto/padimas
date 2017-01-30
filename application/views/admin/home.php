<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">PMB Kita Hari Ini. <small class="dash1 text-right"></small></h1>            
        </div>
    </div>
	<div class="row">
        <div class="col-md-6 col-lg-3">
			<div class="panel">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-5x fa-user"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="dash2"></div>
							<span>Pendaftar Hari Ini</span>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url().index_page(); ?>admin/data/pendaftar_harian">
					<div class="panel-footer">
						<span class="pull-left">Total Pendaftar : <span class="dash11"></span></span>
						<span class="pull-right">Detail <i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="panel">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-5x fa-graduation-cap"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="dash3"></div>						
							<span>Pendaftar Her-Registrasi Hari ini</span>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<a href="#">
					<span class="pull-left">Total Her-Registrasi</span>
					<span class="pull-right"><span class="dash10"></span></span>
					<div class="clearfix"></div>
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="panel">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-5x fa-pencil"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="guede text-success word-space-20"><span class="dash9"></span></div>
							<span>Belum Tes Tertulis Hari Ini</span>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url().index_page(); ?>admin/data/pendaftar_harian">
					<div class="panel-footer">
						<span class="pull-left">Lihat Selengkapnya</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="panel">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-5x fa-comments"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="guede text-primary word-space-20"><span class="dash8"></span></div>
							<span>Belum Wawancara Hari Ini</span>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url().index_page(); ?>admin/data/pendaftar_harian">
					<div class="panel-footer">
						<span class="pull-left">Lihat Selengkapnya</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel">	
				<div class="panel-heading text-center"><b>Data Jumlah Mahasiswa Her-Registrasi Per Prodi</b></div>
				<div class="panel-body">
					<div id="chartProdi" style="height: 400px;"></div>					
					<div id="legend"></div>					
				</div>
				<div class="panel-footer">
					<div class='dash4 row'>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel">	
				<div class="panel-heading text-center"><b>Sebaran Daerah Asal Mahasiswa Baru</b></div>
				<div class="panel-body">
					<div id="chartProp" style="height: 400px;"></div>					
					<div id="legend"></div>					
				</div>
				<div class="panel-footer">
					<div class='dash7 row'>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="panel">
				<div class="panel-heading">
					<center><b>TOP 5 KABUPATEN/KOTA</b></center>
				</div>
				<ul class="dash5 list-group">				
				</ul>
				<a href="#">
					<div class="panel-footer">
						<span class="pull-left">Lihat Selengkapnya</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel">
				<div class="panel-heading">
					<center><b>TOP 5 SEKOLAH</b></center>
				</div>
				<ul class="dash6 list-group">					
				</ul>
				<a href="#">
					<div class="panel-footer">
						<span class="pull-left">Lihat Selengkapnya</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function dash(param){
	$.ajax({
		type: "GET",
		url: "<?php echo site_url('admin/ajax/dashboard')?>/"+param,
		data: {},
		success: function(data){
			$('.dash'+param).html(data);
		}
	});
}
dash(1);
dash(2);
dash(3);
dash(4);
dash(5);
dash(6);
dash(7);
dash(8);
dash(9);
dash(10);
dash(11);

</script>
