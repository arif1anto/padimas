<?php 
$u_agent = $_SERVER['HTTP_USER_AGENT'];
if(!preg_match('/Chrome/i',$u_agent)) 
    { 
		// redirect("index");
    } 
/*
<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/bootstrap_lumen.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/plugins/summernote.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/sb-admin-2.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/plugins/morris.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/plugins/datetime_picker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<link href="<?php echo base_url() ?>assets/css/custom.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/admin-gray.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/jquery.timepicker.min.css" rel="stylesheet">
  

<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-2.1.1.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/jqueryui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/datetime_picker/moment.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/datetime_picker/id.js" charset="UTF-8"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/morris/raphael.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/metisMenu/metisMenu.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<style>
.modal-open .modal{
	background-color:rgba(000,0,0,0.6) !important;
}
</style>
*/
?>
<link href="<?php echo base_url() ?>assets/css/backend.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/backend.js"></script>