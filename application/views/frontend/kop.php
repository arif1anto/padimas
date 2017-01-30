<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            
    <a href="<?php echo base_url() ?>"><div class="logo"></div>
    <div class="logouty" style="background-image: url('<?php echo base_url().index_page(); ?>image/logo1.png/80');"></div>
    <div class="header">
        <div class="title">Penerimaan Mahasiswa Baru</div>
        <div class="title2"></div>
        <div class="subtitle"></div>
    </div>
    </a>

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    
    <div class="menu">
        <ul class="nav nav-pills navbar-collapse collapse">
            <?php foreach ($menu as $row) {
            ?>
            <li><a href="<?php echo $row->menu_link;?>" title="<?php echo $row->menu_link_title ?>"><i class="fa <?php echo $row->menu_icon ?> fa-fw"></i> <?php echo $row->menu_nama ?></a></li>
            <?php
            } ?>
        </ul>
    </div>
</nav>