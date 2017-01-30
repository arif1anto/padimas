<div class="page-detail">
    <div class="row">
        <div class="col-lg-12">
        <div class="breadcrumb det">
            <ul id="breadcrumbs-one">
                <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
                <li><a class="current"><?php echo $data1[0]->page_judul; ?></a></li>
            </ul>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="detail">
                <div class="detail-heading">
                    <h1 class="page-header"><strong><?php echo $data1[0]->page_judul; ?></strong></h1>
                </div>
                <div class="detail-body">
                    <?php echo $data1[0]->page_content; ?>
                </div>
                <div class="detail-footer">
                    <p>
                        <small class="text-muted"><i class="fa fa-clock-o fa-fw"></i><?php echo date_format(new DateTime($data1[0]->page_tgl),'j F Y \P\u\k\u\l H:i'); ?></small>
                        <small class="text-muted"><i class="fa fa-user fa-fw"></i><?php echo $data1[0]->aut_display_name; ?></small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>