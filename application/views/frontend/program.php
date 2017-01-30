<div class="page-detail">
    <div class="row">
        <div class="col-lg-12">
        <div class="breadcrumb det">
            <ul id="breadcrumbs-one">
                <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
                <li><a class="current"><?php echo $data1[0]->prg_nama; ?></a></li>
            </ul>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="detail">
                <div class="detail-heading">
                    <h1 class="page-header"><strong><?php echo $data1[0]->prg_judul; ?></strong></h1>
                </div>
                <div class="detail-body">
                    <?php echo $data1[0]->prg_deskripsi; ?>
                    <?php if ($data1[0]->prg_form!=null && $data1[0]->status): ?>
                    <p class="text-center">
                        <a href="<?php echo base_url().index_page().'program/'.$data1[0]->prg_link.'/daftar' ?>" class="btn btn-lg btn-primary">Isi Formulir Online</a>
                    </p>
                    <?php endif ?>
                </div>
                <div class="detail-footer">
                    
                </div>
            </div>
        </div>
    </div>
</div>