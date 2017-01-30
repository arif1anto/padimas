<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url()?>img/favicon.png" />

    <title><?php echo $judul; ?></title>
    <?php $this->load->view('frontend/header') ?>
</head>
<body>
    <div id="wrapper">
        <?php $this->load->view('frontend/kop') ?>
        <?php $this->load->view('frontend/slider') ?>
        <div id="page">
            <?php 
                if ($view=="" || $view=="frontend/chome/halaman/beranda"){
                    $this->load->view('frontend/slider');
                } 
            ?>
            <div class="continer-side">
                <div id="side">
                    <?php $this->load->view('frontend/info') ?>
                </div>
            </div>
            <div id="page-wrapper">
                <?php
                    if ($view!=""){
                        $this->load->view($view);
                    } else {
                        $this->load->view('frontend/home');
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="foot-menu">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <p><strong>Kampus Pusat</strong><br>
                    <i class="fa fa-map-marker fa-fw"></i>Kuliah Jogja<br>
                    <i class="fa fa-phone-square fa-fw"></i>Telp : +6289-610360890<br>
                    <i class="fa fa-envelope fa-fw"></i>Email : kuliahjogja@gmail.com</p>
            </div>
            <div class="col-sm-4">
                <p><strong>Kontak Person:</strong><br>
                <i class="fa fa-phone-square fa-fw"></i>Arifianto (+6285743409124)<br>
				<i class="fa fa-phone-square fa-fw"></i>Arif Surya Putra (+6289610360890)<br>
				<i class="fa fa-phone-square fa-fw"></i>Afwan Anggara (+628995160193)<br>
				<i class="fa fa-phone-square fa-fw"></i>Fuad Fauzi (+628117227338)</p>
            </div>
        </div>
        </div>
        <div class="foot-copy">
            <p class="text-center">Developed By Kuliah Jogja | This System under GNU GENERAL PUBLIC LICENSE Version 3</p>
        </div>
    </div>

    <a href="#" class="goto-top" onclick="gototop()"><i class="fa fa-arrow-up"></i></a>
    <?php $this->load->view('frontend/footer') ?>
    
    <script type="text/javascript"> 

        function gototop() {
          $("html,body").animate({ scrollTop: 0 }, 1000, "swing",function(){});
        };
        $(document).ready(function(){

            $(".goto-top").hide();
            $(window).scroll(function(){
                var scrollPercent = 100 * $(window).scrollTop() / ($(document).height() - $(window).height());
                if (scrollPercent>5) {
                    $(".goto-top").show();
                } else {
                    $(".goto-top").hide();
                }
            })
        });
    </script>
</body>
</html>
