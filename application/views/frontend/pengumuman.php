<div class="page-detail">
    <div class="row">
        <div class="col-lg-12">
        <div class="breadcrumb det">
            <ul id="breadcrumbs-one">
                <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
                <li><a class="current"><?php echo $data1[0]->png_judul; ?></a></li>
            </ul>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="detail">
                <div class="detail-heading">
                    <h1 class="page-header"><strong><?php echo $data1[0]->png_judul; ?></strong></h1>
                </div>
                <div class="detail-body">
                    <?php echo $data1[0]->png_deskripsi; ?>
					<?php if ($data1[0]->png_tabel!=null || $data1[0]->png_tabel!=''): ?>
                    <p class="text-center">
                        <a href="<?php echo base_url().index_page().'pengumuman/'.$data1[0]->png_link.'/tabel' ?>" class="btn btn-lg btn-primary">Lihat Pengumuman</a>
                    </p>
                    <?php endif ?>
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