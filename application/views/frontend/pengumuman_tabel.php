<?php
function ganti(array $replace, $subject) { 
   return str_replace(array_keys($replace), array_values($replace), $subject);    
}
?>
<div class="page-detail">
    <div class="row">
        <div class="col-lg-12">
        <div class="breadcrumb det">
            <ul id="breadcrumbs-one">
                <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
                <li><a href="<?php echo base_url().index_page() ?>pengumuman/<?php echo $data1[0]->png_link ?>"><?php echo $data1[0]->png_judul ?></a></li>
                <li><a class="current">Daftar <?php echo $data1[0]->png_judul ?></a></li>
            </ul>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="detail">
                <div class="detail-heading">
                    <h1 class="page-header"><?php echo $data1[0]->png_judul ?></h1>
                </div>
                <div class="detail-body">
                   <?php   
					   if(isset($data2) && $data2!=null) :
						 
						 $replace=array(
							'[TABEL]' => $data2,
						 );
						 echo ganti($replace,$data1[0]->png_tabel);
					  endif; ?>
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