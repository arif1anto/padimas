<?php 
	$sts = "i";//insert
	$new_id = 0;
	if (isset($data2) && $data2!=null) {
		$new_id = $data2;
	}
	if (isset($data1) && $data1!=null) {
		$sts = "u";//update
		$new_id = $data1[0]->page_id;
	}
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Halaman <small><?php echo $sts=="i"?"Tambah":"Sunting" ?> Halaman</small></h1>
        </div>
    </div>
    <div class="row">
	<?php echo form_open('admin/halaman/'.($sts=='i'?'baru':'edit/'.$data1[0]->page_id).'/simpan',array('id'=>'page','enctype'=>'multipart/form-data')) ?>
    	<form role="form" id="page" enctype="multipart/form-data" method="POST" action="<?php echo base_url().index_page(); ?>admin/halaman/<?php echo $sts=='i'?'baru':'edit/'.$data1[0]->page_id; ?>/simpan">	
    	<div class="col-lg-9">
				<div class="form-group valid required">
					<input type="text" class="form-control input-lg" name="judul" id="judul" placeholder="Masukan judul halaman disini" value="<?php echo $sts=='u'?$data1[0]->page_judul:'' ?>" onKeyup="setLink()">
					<p class="help-block"></p>
					<p id="plink"></p>
				</div>
				<div class="form-group">
					<textarea class="summernote" name="content"><?php echo $sts=='u'?$data1[0]->page_content:'' ?></textarea>
				</div>
				<script type="text/javascript">
					$(document).ready(function() {
					  $('.summernote').summernote(
							{ height: 700,                
							  minHeight: 500,             
							  maxHeight: 1000,          
							  focus: true,
							  onImageUpload: function(files, editor, welEditable) {
			                    sendFile(files[0],editor,welEditable);
			                  }
							}
					  	);
					});
				</script>
    	</div>
    	<div class="col-lg-3">
    		<div class="panel panel-primary">
    			<div class="panel-heading">
					Publish
					<a class="btn btn-default btn-xs pull-right" href="#">Preview</a>
    			</div>
    			<div class="panel-body">
					<div class="form-group xs">
						<label>Authors &emsp;: <strong><?php echo $user->aut_display_name ?></strong></label>
						<input type="hidden" name="id" value="<?php echo $new_id; ?>">
					</div>
					<div class="form-group xs valid required">
						<label>Link :</label>
						<input type="text" class="form-control input-sm" name="link" id="link" value="<?php echo $sts=='u'?$data1[0]->page_link:'' ?>" onkeyup="setplink()">
						<p class="help-block"></p>
					</div>
					<div class="form-group xs valid required">
						<label>Tanggal Publish :</label>
						<div class='input-group date' id='datetime'>
			                <input type='text' class="form-control input-sm" name="tgl" data-date-format="YYYY-MM-DD hh:mm:ss" value="<?php echo $sts=='u'?$data1[0]->page_tgl:date_format(new datetime(),'Y-m-d H:i:s'); ?>">
			                <span class="input-group-addon input-sm">
			                	<span class="fa fa-calendar"></span>
			                </span>
			            </div>
						<p class="help-block"></p>
					</div>
    			</div>
    			<div class="panel-footer text-right">
    					<?php echo $sts=="i"?'<button class="btn btn-default btn-xs" type="button" onclick="simpandraft()">Simpan Draft</button>':'' ?>
    					<button type="submit" class="btn btn-primary btn-xs"><?php echo $sts=="i"?"Publish":"Update" ?></button>
    					<p id="draft" class="text-primary"></p>
    			</div>
    		</div>
    	</div>
    	</form>   
    </div>
</div>

<script type="text/javascript">
	var cek = "abcdefghijklmnopqrstuvwxyz0123456789._-";

	function sendFile(file, editor, welEditable) {
	    data = new FormData();
	    data.append("userfile", file);
		data.append(<?php echo "'".$this->security->get_csrf_token_name()."','".$this->security->get_csrf_hash()."'" ?>);
	    url = "<?php echo base_url();?>admin/upload";
	    $.ajax({
	        data: data,
	        type: "POST",
	        url: url,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function (url) {
	            editor.insertImage(welEditable, url);
	        }
	    });
	}

    $(function () {
        $('#datetime').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });
    });
	$(function() { 
		var judul = document.getElementById('link').value;
		if (judul!='') {
			var link = judul.replace(/ /g, "_");
			link = link.toLowerCase();
			for (var i = 0; i < link.length; i++) {
				if (cek.indexOf(link.charAt(i))==-1){
					link = link.replace(link.charAt(i),""); i--;
				}
			}; 
			document.getElementById('link').value=link.toLowerCase();
			document.getElementById('plink').innerHTML = "<?php echo 'Link Program: '.base_url().index_page().'halaman/' ?>"+link.toLowerCase();
		} else {
			document.getElementById('link').value="";
			document.getElementById('plink').innerHTML = "";
		} });
	function setLink () {
		var judul = document.getElementById('judul').value;
		if (judul!='') {
			var link = judul.replace(/ /g, "_");
			link = link.toLowerCase();
			for (var i = 0; i < link.length; i++) {
				if (cek.indexOf(link.charAt(i))==-1){
					link = link.replace(link.charAt(i),""); i--;
				}
			}; 
			document.getElementById('link').value=link.toLowerCase();
			document.getElementById('plink').innerHTML = "<?php echo 'Link Program: '.base_url().index_page().'halaman/' ?>"+link.toLowerCase();
			$("#link").parent().removeClass("has-error").addClass("has-success");
			$("#link").parent().find("p.help-block").html("");
		} else {
			document.getElementById('link').value="";
			document.getElementById('plink').innerHTML = "";
			$("#link").parent().removeClass("has-success").addClass("has-error");
			$("#link").parent().find("p.help-block").html("Field ini harus diisi");
		}
	};
	function setplink(){
		var link = document.getElementById('link').value;
		link = link.replace(/ /g, "_");
		link = link.toLowerCase();
		for (var i = 0; i < link.length; i++) {
			if (cek.indexOf(link.charAt(i))==-1){
				link = link.replace(link.charAt(i),""); i--;
			}
		}; 
		document.getElementById('plink').innerHTML = "<?php echo 'Link Program: '.base_url().index_page().'artikel/' ?>"+link.toLowerCase();
		document.getElementById('link').value=link.toLowerCase();
	}
	function simpandraft (){
		if (valid($("#page"))) {
			var judul = $("input[name='judul']").val();
			var content = $(".note-editable>p").html();
			var tgl = $("input[name='tgl']").val();
			var link = $("input[name='link']").val();
			$.ajax({
	              type: "POST",
	              url: "<?php echo base_url();?>admin/halaman/simpandraft",
	              data:{<?php echo $csrf ?>,"judul":judul,"content":content,"tgl":tgl,"link":link,"id":<?php echo $new_id; ?>},
	              dataType:"html",
	              success: function(data){
	                $("#draft").html(data);
		          },
		          error:function(XMLHttpRequest){
		              alert(XMLHttpRequest.responseText);
		          }
		      })
		};
	};
</script>

<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>