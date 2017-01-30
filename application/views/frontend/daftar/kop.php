<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            
    <div class="logo"></div>
    <div class="logouty"  style="background-image: url('<?php echo base_url().index_page(); ?>image/logo1.png/80');"></div>
    <div class="header">
        <div class="title">Penerimaan Mahasiswa Baru</div>
        <div class="title2"></div>
        <div class="subtitle"></div>
    </div>

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
            <?php foreach ($menu as $row): echo $row; endforeach ?>
        </ul>
    </div>
    
</nav>