<!DOCTYPE html>
<html lang="en">
<head>
<title>404 Page Not Found</title>

<?php
$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url .= "://".$_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']); 
?>
<link rel="shortcut icon" href="<?php echo $base_url?>img/favicon.png" />
<link href="<?php echo $base_url?>assets/css/bootstrap_cosmo.css" rel="stylesheet">

<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	background-color: #f22613;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
	background-color: #fff;
	display: none;
}

p {
	margin: 12px 15px 12px 15px;
	font-size: 25px;
	color: #fff;
	font-weight: bold;
	text-shadow: 1px 1px 5px #000000;
}

.not_found{
	font-size: 300px;
	color: #670900;
	font-family: "Source Sans Pro", Calibri, Candara, Arial, sans-serif;
 	font-weight: bold; 
 	margin-top: 150px;
 	min-height: 150px;
}

.btn-red {
	color: #ffffff;
	background-color: #670901;
	font-family: "Source Sans Pro", Calibri, Candara, Arial, sans-serif;
	font-size: 25px;
	padding: 19px 65px;
}

.btn-red:hover {
	background-color: #520600;
}

.btn-margin{
	margin-top: 30px;
}

</style>
</head>
<body>
	<div class="row">
		<div class="col-sm-offset-3 col-sm-6">
			<img src="<?php echo $base_url.'image/404.jpg' ?>" class="img-responsive" alt="Responsive image">
		</div>
	</div>
	<div class="row btn-margin">
		<div class="col-sm-12 text-center">
			<button type="button" class="btn btn-lg btn-red" onclick="goBack()">Kembali</button>
		</div>
	</div>
	<script>
		function goBack() {
		    window.history.back()
		}
	</script>
	<div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
	</div>
</body>
</html>