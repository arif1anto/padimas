<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?php echo base_url() ?>assets/css/logo.png">
    <title><?php echo $judul; ?></title>
    <?php $this->load->view('frontend/header') ?>
    <style type="text/css">body{margin-top:25px}li a.keluar{color:red}.hmain{margin-bottom:15px}.top10{margin-top:10px}.btn-danger{font-weight:700}h1.no-soal{font-size:5em;margin-top:0;margin-bottom:10px}#page{padding-left:20px;padding-right:20px}#page-wrapper{width:100%;margin-left:auto;margin-right:auto;float:none}#navsoal{margin:0}.progress{height:3px;margin-bottom:8px}@media(min-width:1040px){#page-wrapper{width:1024px}#page{margin-top:100px}#navsoal{margin:0 -150px}}@media (min-width: 1024px){.nav-pills>li.active>a,.nav-pills>li.active>a:hover,.nav-pills>li.active>a:focus{background-color:#021731}}</style>
</head>
<body>
    <div id="wrapper">
        <?php if ($view!="frontend/cbt/login") { ?>
        <?php $this->load->view('frontend/daftar/kop') ?>
        <?php } ?>
        <div id="page">
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
    
    <?php if ($view!="frontend/cbt/login") { ?>
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
                <i class="fa fa-phone-square fa-fw"></i>KJ (+6289610360890)<br></p>
            </div>
        </div>
        </div>
        <div class="foot-copy">
            <p class="text-center">Copyright@<?php echo Date('Y'); ?>. Developed By Kuliah Jogja</p>
        </div>
    </div>
    <a href="#" class="goto-top" onclick="gototop()"><i class="fa fa-arrow-up"></i></a>
    <?php $this->load->view('frontend/footer') ?>
    <script type="text/javascript">function gototop(){$("html,body").animate({scrollTop:0},1e3,"swing",function(){})}$(document).ready(function(){$(".goto-top").hide(),$(window).scroll(function(){var a=100*$(window).scrollTop()/($(document).height()-$(window).height());a>5?$(".goto-top").show():$(".goto-top").hide()})});</script>
    <?php } ?>
</body>
</html>
