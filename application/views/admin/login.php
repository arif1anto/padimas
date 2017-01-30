<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <style>
		
    </style>
	<link rel="shortcut icon" href="<?php echo base_url()?>img/favicon.png" />
    <title>Login | PMB UTY</title>
    <?php $this->load->view('admin/header') ?>
	<script type="text/javascript">
	  var _paq = _paq || [];
	  _paq.push(["setDomains", ["*.pmb2.uty.ac.id","*.pmb2.uty.ac.id/admin"]]);
	  _paq.push(['trackPageView']);
	  _paq.push(['enableLinkTracking']);
	  (function() {
		var u="//192.168.70.89/piwik/";
		_paq.push(['setTrackerUrl', u+'piwik.php']);
		_paq.push(['setSiteId', 2]);
		var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
		g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
	  })();
	</script>
	<noscript><p><img src="//192.168.70.89/piwik/piwik.php?idsite=2" style="border:0;" alt="" /></p></noscript>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 col-lg-offset-4">
				<center>
                <div class="login-panel panel panel-primary" >
                    <div class="panel-heading">
                        <h3 class="panel-title">Silahkan login</h3>
                    </div>
                    <div class="panel-body">
                        <?php 
                            if (isset($pesan)) {
                                echo $pesan;
                            } else {
                        ?>
                        <div class="bs-callout bs-callout-info">
                            <h4>Login PMB</h4>
                            <p>Silahkan masukan Username dan Password anda</p>
                        </div>
                        <?php
                            }
							
							echo form_open('admin/login');
                        ?>
                            <fieldset>
                                <div class="form-group valid required">
                                    <input class="form-control" placeholder="Username" name="uname" type="text" autofocus autocomplete="off">
                                    <p class="help-block text-left"></p>
                                </div>
                                <div class="form-group valid required">
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                    <p class="help-block text-left"></p>
                                </div>
								<div class="form-group valid required">
									<p style="color:green;font-size:18px;background-color:#EAF9EA;">
										<?php 
										  echo $captcha; 
										  ?>
										  <input class="form-control" placeholder="captcha" name="mumet" type="text">
									</p>
                                    
                                    <p class="help-block text-left"></p>
                                </div>
                                <button class="btn btn-md btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
					<div class="panel-footer">
                        <h3 class="panel-title">Developed By ICT UTY @2016 </h3>
                    </div>
                </div> 
                </center>  
            </div>
        </div>
    </div>
    
    <div class="logo-uty"></div>

    <script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js'?>"></script>

    <?php $this->load->view('frontend/footer') ?>

</body>

</html>
