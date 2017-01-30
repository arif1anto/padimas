<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="shortcut icon" href="<?php echo base_url()?>img/favicon.png" />
    <title><?php echo $judul; ?></title>
    <?php $this->load->view('admin/header') ?>
</head>

<body>

    <div id="wrapper">
        <?php $this->load->view('admin/kop');?>

        <?php 
            if (isset($view) && $view!='') {
                $this->load->view($view);
            } 
        ?>
    </div>
	<div class="foot-copy">
		<p class="text-center" style="margin:0">Copyright@<?php echo Date('Y'); ?>. Developed By Kuliah Jogja | This System under GNU GENERAL PUBLIC LICENSE Version 3</p>
	</div>
    <?php $this->load->view('admin/footer') ?>
</body>  
</html>
