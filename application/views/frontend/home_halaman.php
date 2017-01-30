<div class="row">
    <div class="col-lg-12">
    <div class="breadcrumb">
        <ul id="breadcrumbs-one">
            <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
            <li><a class="current">Halaman</a></li>
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
                <h1 class="page-header"><?php echo $row->page_judul; ?></h1>
                <small class="text-muted"><i class="fa fa-user fa-fw"></i><?php echo $row->aut_display_name; ?>
                <i class="fa fa-clock-o fa-fw"></i><?php echo date_format(new DateTime($row->page_tgl),'d/m/Y H:i'); ?></small> 
            </div>
            <div class="artikel-body">
                <p>
                <?php 
                    echo substr($row->page_content,0,strpos($row->page_content,"</p>"));
                    echo "</p>"; 
                ?>
                </p>
            </div>
            <div class="artikel-footer">
                <a href="<?php echo base_url().index_page().'artikel/'.$row->page_link ?>" class="btn btn-default btn-sm pull-right">Read more</a>
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
