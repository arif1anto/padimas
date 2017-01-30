<div class="row">
    <div class="col-lg-12">
    <div class="breadcrumb">
        <ul id="breadcrumbs-one">
            <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
            <li><a class="current">Pengumuman</a></li>
        </ul>
    </div>
    </div>
</div>

<div class="row">

    <div class="col-lg-12">
    <?php 
        foreach ($data1 as $row) {
    ?>
        <div class="artikel">
            <?php if ($row->new) echo '<h4><span class="label label-danger pull-right">Baru</span></h4>'; ?>
            <div class="artikel-heading">
                <h1 class="page-header"><?php echo $row->png_judul; ?></h1>
                <small><i class="fa fa-clock-o fa-fw"></i><?php echo date_format(new DateTime($row->png_tgl),'d/m/Y H:i'); ?></small> 
            </div>
            <div class="artikel-body">
                <p>
                <?php 
                    echo substr($row->png_deskripsi,0,strpos($row->png_deskripsi,"</p>"));
                    echo "</p>"; 
                ?>
                </p>
            </div>
            <div class="artikel-footer">
                <a href="<?php echo base_url().index_page().'pengumuman/'.$row->png_link ?>" class="btn btn-default btn-sm pull-right">Lihat Pengumunan</a>
            </div>
        </div>
    <?php
        }
    ?>
    </div>
    <div class="col-lg-12 text-center">
    <ul class="pagination pagination-md">
      <?php  echo $this->pagination->create_links(); ?>
    </ul>
    </div>
</div>
