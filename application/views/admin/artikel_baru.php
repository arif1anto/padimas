<?php 
	$sts = "i";//insert
	$new_id = 0;
	if (isset($data3) && $data3!=null) {
		$new_id = $data3;
	}
	if (isset($data1) && $data1!=null) {
		$sts = "u";//update
		$new_id = $data1[0]->art_id;
	}
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Artikel <small><?php echo $sts=="i"?"Tambah":"Sunting" ?> Artikel</small></h1>
        </div>
    </div>
    <div class="row">
		<?php echo form_open('admin/artikel/'.($sts=='i'?'baru':'edit/'.$data1[0]->art_id).'/simpan',array('id'=>'artikel','enctype'=>'multipart/form-data')) ?>
    	<div class="col-lg-9">
				<div class="form-group valid required">
					<input type="text" class="form-control input-lg" name="judul" id="judul" placeholder="Masukan judul artikel disini" value="<?php echo $sts=='u'?$data1[0]->art_judul:'' ?>" onKeyup="setLink()">
					<p class="help-block"></p>
					<p id="plink"></p>
				</div>
				<div class="form-group">
					<textarea class="summernote" name="content"><?php echo $sts=='u'?$data1[0]->art_content:'' ?></textarea>
				</div>
				<script type="text/javascript">
					$(document).ready(function() {
					  $('.summernote').summernote(
							{ height: 700,                
							  minHeight: 500,             
							  maxHeight: 1000,          
							  focus: true
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
					<div class="form-group xs">
						<label>Headline &ensp;: 
						<input type="checkbox" class="checkbox-inline" name="headline" value="1" id="headline" <?php echo $data2 ?> <?php echo $data2==""?"disabled":"" ?>>
						</label>
					</div>
					<div class="form-group xs valid required">
						<label>Link :</label>
						<input type="text" class="form-control input-sm" name="link" id="link" value="<?php echo $sts=='u'?$data1[0]->art_link:'' ?>" onkeyup="setplink()">
						<p class="help-block"></p>
					</div>
					<div class="form-group xs valid required">
						<label>Tanggal Publish :</label>
						<div class='input-group date' id='datetime'>
			                <input type='text' class="form-control input-sm" name="tgl" data-date-format="YYYY-MM-DD hh:mm:ss" value="<?php echo $sts=='u'?$data1[0]->art_tgl_terbit:date_format(new datetime(),'Y-m-d H:i:s'); ?>">
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
    	<div class="col-lg-3">
    		<div class="panel panel-success">
    			<div class="panel-heading">
					Kategori
    			</div>
    			<div class="panel-body">
                        <p>Pilih kategori di bawah ini.</p>
					<div class="form-group kategori">
						<div class="checkbox">
						  <label>
						    <input type="checkbox" name="kat[0]" value="0" form="artikel">
						    Belum Dikategorikan
						  </label>
						</div>
						<?php for ($i=0; $i<count($data4); $i++): ?>
						<div class="checkbox <?php echo $data4[$i]['kat_level'] ?>">
						  <label>
						    <input type="checkbox" name="kat[<?php echo $i ?>]" value="<?php echo $data4[$i]['kat_id'] ?>" form="artikel" <?php echo $data4[$i]['kat_sel'] ?>>
						    <?php echo $data4[$i]['kat_nama']; ?>
						  </label>
						</div>
						<?php endfor ?>
					</div>
					<div class="form-group">
						<button class="btn btn-xs btn-primary" id="tambah_kat">Tambah Kategori</button>
					</div>
					<div class="form-kategori">
						<div class="form-group valid required">
						  <input type="text" class="form-control input-sm" name="kat" id="kat" placeholder="Tambahkan Kategori Baru">
						  <p class="help-block"></p>
						</div>
						<div class="form-group valid required">
							<select class="form-control input-sm" name="kat_parent" id="kat_parent">
								<option value="">- Pilih Parent Kategori -</option>
								<option value="0">...</option>
								<?php for($i=0; $i<count($data4); $i++):
									$sub=null;
									if ($data4[$i]['kat_level']!='kat-level-3') {
										if ($data4[$i]['kat_level']=='kat-level-0') {
											$sub="";
										} elseif ($data4[$i]['kat_level']=='kat-level-1') {
											$sub="&nbsp;&nbsp;&nbsp;&nbsp;";
										} elseif ($data4[$i]['kat_level']=='kat-level-2') {
											$sub="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										}
								?>
								<option value="<?php echo $data4[$i]['kat_id'] ?>"><?php echo $sub.$data4[$i]['kat_nama']; ?></option>
								<?php } endfor ?>
							</select>
							<p class="help-block"></p>
						</div>
						<div class="form-group">
							<p class="text-right">
								<button class="btn btn-primary btn-xs" type="button" onclick="addkategori($('#kat').val(),$('#kat_parent').val())">Tambah Kategori</button>
							</p>
						</div>
					</div>
    			</div>
    		</div>	
    	</div>	
    	<div class="col-lg-3">
    		<div class="panel panel-success">
    			<div class="panel-heading">
					<i class="fa fa-tags fa-fw"></i>Tags
    			</div>
    			<div class="panel-body">
					<div class="form-group">
					  <div class="input-group">
					    <input type="text" class="form-control input-sm" placeholder="Masukan Tag Artikel">
					    <span class="input-group-btn">
					      <button class="btn btn-default btn-xs" type="button"><i class="fa fa-plus"></i></button>
					    </span>
					  </div>
					  <p class="help-block">
					  	Tags: <br/>
					  	<!-- <span class="label label-success"><a class="tag" href="#"><i class="fa fa-times"></i></a> uty</span> -->
					  </p>
					</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>

<script type="text/javascript">
	var cek = "abcdefghijklmnopqrstuvwxyz0123456789._-";
    $(function () {
        $('#datetime').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });
        $('.form-kategori').hide();
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
			document.getElementById('plink').innerHTML = "<?php echo 'Link Artikel: '.base_url().index_page().'artikel/' ?>"+link.toLowerCase();
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
			document.getElementById('plink').innerHTML = "<?php echo 'Link Artikel: '.base_url().index_page().'artikel/' ?>"+link.toLowerCase();
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
		document.getElementById('plink').innerHTML = "<?php echo 'Link Artikel: '.base_url().index_page().'artikel/' ?>"+link.toLowerCase();
		document.getElementById('link').value=link.toLowerCase();
	}
	function simpandraft(){
		if (valid($("#artikel"))) {
			var judul = $("input[name='judul']").val();
			var content = $(".note-editable>p").html();
			var tgl = $("input[name='tgl']").val();
			var headline = $("input[name='headline']:checked").val();
			var link = $("input[name='link']").val();
			$.ajax({
	              type: "POST",
	              url: "<?php echo base_url();?>admin/artikel/simpandraft",
	              data:{<?php echo $csrf ?>,"judul":judul,"content":content,"tgl":tgl,"headline":headline,"link":link,"id":<?php echo $new_id; ?> },
	              dataType:"html",
	              success: function(data){
	                $("#draft").html(data);
		          },
		          error:function(XMLHttpRequest){
		              alert(XMLHttpRequest.responseText);
		          }
		      })
		};
	}
	function addkategori(kat,parent){
		if (kat!='' && parent!='') {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/artikel/tambah_kategori",
				data:{<?php echo $csrf ?>,"kat_nama":kat,"kat_parent_id":parent },
				dataType:"html",
				success: function(data){
					$(".form-group.kategori").html(data);
					$('#kat').val('');
					$("#kat").parent().removeClass("has-error").removeClass("has-success");
					$("#kat_parent").parent().removeClass("has-success").removeClass("has-error");
	    			$(".valid.required>p.help-block").html("");
				},
				error:function(XMLHttpRequest){
				  alert(XMLHttpRequest.responseText);
				}
			})
		} 
		if(kat=='') {
			$("#kat").parent().removeClass("has-success").addClass("has-error");
			$(".valid.required.has-error>p.help-block").html("Field ini harus diisi");
		} 
		if(parent==''){
			$("#kat_parent").parent().removeClass("has-success").addClass("has-error");
			$(".valid.required.has-error>p.help-block").html("Field ini harus diisi");
		}
	}
	$("#kat").keypress(function(e) {
	    if(e.which == 13) {
	        addkategori($('#kat').val(),$('#kat_parent').val());
			$("#kat").parent().removeClass("has-error");
			$("#kat_parent").parent().removeClass("has-error");
			$(".valid.required>p.help-block").html("");
	    }
	});
	$("#tambah_kat").click(function(){
		var a =  $(this).html();
		if (a=="Tambah Kategori") {
			$(this).html("Tutup");
			$('.form-kategori').show();
		} else {
			$(this).html("Tambah Kategori");
			$('.form-kategori').hide();
		}
	});
</script>

<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>