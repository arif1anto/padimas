<div class="row side-bar">
	<ul class="side-menu">
		<li class="menu-item"><a>Program PMB</a>
			<ul class="sub-menu">
				<?php foreach ($program as $row): ?>
					<li class="menu-item"><a href="<?php echo base_url().index_page().'program/'.$row->prg_link ?>"><?php echo $row->prg_nama ?> <?php echo $row->status?'<span class="label label-success pull-right">Dibuka</span>':'<span class="label label-danger pull-right">Ditutup</span>'; ?></a></li>
				<?php endforeach ?>
			</ul>
		</li>
		<?php if(count($pengumuman)>0){ ?>
		<li class="menu-item"><a href="<?php echo base_url().index_page().'pengumuman' ?>">Pengumuman PMB</a>
			<ul class="sub-menu">
				<?php foreach ($pengumuman as $row): ?>
					<li class="menu-item"><a href="<?php echo base_url().index_page().'pengumuman/'.$row->png_link ?>" title="<?php echo $row->png_judul ?>"><?php echo $row->png_judul ?>  <?php echo $row->new?'<span class="label label-danger pull-right">Baru</span>':''; ?></a></li>
				<?php endforeach ?>
			</ul>
		</li>
		<?php } ?>
	</ul>
</div>

<div class="row side-bar" style="margin-bottom:50px;">
    <div class="col-lg-12 text-center menu-item">
    	<h4><strong>Sekretariat Panitia</strong></h4>
    </div>
    <p class="text-center">
	Kuliah Jogja<br/> 
	website : kuliahjogja.com<br/> 
	Arifianto (+6285743409124)<br>
	Arif Surya Putra (+6289610360890)<br>
	Afwan Anggara (+628995160193)<br>
	Fuad Fauzi (+628117227338)<br/>
	Email : kuliahjogja@gmail.com</p>
</div>