<div class="row">
    <div class="col-lg-12">
    <div class="breadcrumb">
        <ul id="breadcrumbs-one">
            <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
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
            <div class="artikel-heading">
                <h1 class="page-header"><?php echo $row->art_judul; ?></h1>
                <small class="text-muted"><i class="fa fa-user fa-fw"></i><?php echo $row->aut_display_name; ?>
                <i class="fa fa-clock-o fa-fw"></i><?php echo date_format(new DateTime($row->art_tgl_terbit),'d/m/Y H:i'); ?></small> 
            </div>
            <div class="artikel-body">
                <p>
                <?php 
                    echo substr($row->art_content,0,strpos($row->art_content,"</p>"));
                    echo "</p>"; 
                ?>
                </p>
            </div>
            <div class="artikel-footer">
                <a href="<?php echo base_url().index_page().'artikel/'.$row->art_link ?>" class="btn btn-default btn-sm pull-right">Read more</a>
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
