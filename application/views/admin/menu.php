<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Menu Edior</h1>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-4">
    		<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
			  <div class="panel panel-primary">
			    <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-decoration:none;">
				    <div class="panel-heading" role="tab" id="headingOne">
				      <h4 class="panel-title">
				        Page 
				      </h4>
				    </div>
			    </a>
			    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			      <div class="panel-body">
					<?php echo form_open('',array('id'=>'page')) ?>
					  <div class="form-group form-group-sm valid required">
					    <label>Nama Menu</label>
					    <div class="input-group">
					    	<div class="input-group-addon icon">
						    <select class="form-control icon" name="icon" >
						    <?php foreach ($data4 as $row2): ?>
						    	<option value="<?php echo $row2->icon_nama ?>"><?php echo $row2->icon_val ?></option>
						    <?php endforeach ?>
						    </select>
					    	</div>
					    	<input type="text" class="form-control" name="nama" placeholder="Contoh: Beranda">
					    </div>
					    <p class="help-block"></p>
					  </div>
					  <div class="form-group form-group-sm valid required">
					    <label>Page</label>
					    <select class="form-control" name="link">
					    	<?php foreach ($data3 as $row): ?>
					    	<option value="<?php echo base_url().index_page().'halaman/'.$row->page_link; ?>"><?php echo $row->page_judul ?></option>
					    	<?php endforeach ?>
					    </select>
					    <p class="help-block"></p>
					  </div>
					  <div class="form-group form-group-sm valid required">
					    <label>Menu Parent</label>
					    <select class="form-control" name="menu_parent">
					    	<option value="0">Parent</option>
					    	<?php foreach ($data2 as $row): ?>
					    	<option value="<?php echo $row->menu_id ?>"><?php echo $row->menu_nama ?></option>
					    	<?php endforeach ?>
					    </select>
					    <p class="help-block"></p>
					  </div>
					  <p class="text-right"><button type="button" class="btn btn-xs btn-primary" onclick="simpanpage('page')">Tambahkan Menu</button></p>
					</form>
			      </div>
			    </div>
			  </div>
			  <!-- Panel Kategori -->
			  <div class="panel panel-primary">
			    <a data-toggle="collapse" data-parent="#accordion1" href="#collapseKat" aria-expanded="true" aria-controls="collapseKat" style="text-decoration:none;">
				    <div class="panel-heading" role="tab" id="headingKat">
				      <h4 class="panel-title">
				        Kategori 
				      </h4>
				    </div>
			    </a>
			    <div id="collapseKat" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingKat">
			      <div class="panel-body">
					<?php echo form_open('',array('id'=>'kategori')) ?>
					  <div class="form-group form-group-sm valid required">
					    <label>Nama Menu</label>
					    <div class="input-group">
					    	<div class="input-group-addon icon">
						    <select class="form-control icon" name="icon" >
						    <?php foreach ($data4 as $row2): ?>
						    	<option value="<?php echo $row2->icon_nama ?>"><?php echo $row2->icon_val ?></option>
						    <?php endforeach ?>
						    </select>
					    	</div>
					    	<input type="text" class="form-control" name="nama" placeholder="Contoh: Beranda">
					    </div>
					    <p class="help-block"></p>
					  </div>
					  <div class="form-group form-group-sm valid required">
					    <label>Kategori</label>
					    <select class="form-control" name="link">
					    	<?php 
					    	for ($i=0; $i < count($data5); $i++) { 
					    	?>
					    	<option value="<?php echo $data5[$i]['kat_id'] ?>"><?php echo $data5[$i]["kat_nama"]."  (".$data5[$i]["kat_nart"].")" ?></option>
					    	<?php
					    	}
					    	 ?>
					    </select>
					    <p class="help-block"></p>
					  </div>
					  <div class="form-group form-group-sm valid required">
					    <select class="form-control" name="menu_parent">
					    	<option value="0">Parent</option>
					    	<?php foreach ($data2 as $row): ?>
					    	<option value="<?php echo $row->menu_id ?>"><?php echo $row->menu_nama ?></option>
					    	<?php endforeach ?>
					    </select>
					    <p class="help-block"></p>
					  </div>
					  <p class="text-right"><button type="button" class="btn btn-xs btn-primary" onclick="simpanpage('kategori')">Tambahkan Menu</button></p>
					</form>
			      </div>
			    </div>
			  </div>
			  <!-- Panel Link -->
			  <div class="panel panel-primary">
			    <a data-toggle="collapse" data-parent="#accordion1" href="#collapseLink" aria-expanded="true" aria-controls="collapseLink" style="text-decoration:none;">
				    <div class="panel-heading" role="tab" id="headingLink">
				      <h4 class="panel-title">
				        Link 
				      </h4>
				    </div>
			    </a>
			    <div id="collapseLink" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingLink">
			      <div class="panel-body">
					<?php echo form_open('',array('id'=>'link')) ?>
					  <div class="form-group form-group-sm valid required">
					    <label>Nama Menu</label>
					    <div class="input-group">
					    	<div class="input-group-addon icon">
						    <select class="form-control icon" name="icon" >
						    <?php foreach ($data4 as $row2): ?>
						    	<option value="<?php echo $row2->icon_nama ?>"><?php echo $row2->icon_val ?></option>
						    <?php endforeach ?>
						    </select>
					    	</div>
					    	<input type="text" class="form-control" name="nama" placeholder="Contoh: Beranda">
					    </div>
					    <p class="help-block"></p>
					  </div>
					  <div class="form-group form-group-sm valid required">
					    <label>Link</label>
					    <input type="text" class="form-control" name="link" value="<?php echo base_url()?>">
					    <p class="help-block"></p>
					  </div>
					  <div class="form-group form-group-sm valid required">
					    <label>Menu Parent</label>
					    <select class="form-control" name="menu_parent">
					    	<option value="0">Parent</option>
					    	<?php foreach ($data2 as $row): ?>
					    	<option value="<?php echo $row->menu_id ?>"><?php echo $row->menu_nama ?></option>
					    	<?php endforeach ?>
					    </select>
					    <p class="help-block"></p>
					  </div>
					  <p class="text-right"><button type="button" class="btn btn-xs btn-primary" onclick="simpanpage('link')">Tambahkan Menu</button></p>
					</form>
			      </div>
			    </div>
			  </div>

			</div>
    	</div>
    	<div class="col-lg-8">
    		<div class="panel panel-primary">
    			<div class="panel-heading">
    				<h3 class="panel-title">Menu Editor</h3>
    			</div>
    			<div class="panel-body">
		    		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		    		<?php 
		    			if (isset($data1) && count($data1)>0) {
		    				foreach ($data1 as $row) {
		    		?>
					  <div class="panel panel-default">
					  <!-- data-parent="#accordion" -->
					  <button type="button" class="btn btn-xs btn-danger pull-right" onclick="hapusmenu('<?php echo $row->menu_id ?>','<?php echo $row->menu_nama ?>')" style="margin-top: 6px;margin-right:10px;">Hapus</button>
					  <div class="btn-group pull-right" style="margin-top: 6px;margin-right:10px;" role="group">
						  <button type="button" class="btn btn-xs btn-primary" onclick="move('<?php echo $row->menu_id ?>','up','<?php echo $row->menu_order; ?>')" >&nbsp;&nbsp;<i class="fa fa-angle-double-up"></i>&nbsp;&nbsp;</button>
						  <button type="button" class="btn btn-xs btn-primary" onclick="move('<?php echo $row->menu_id ?>','down','<?php echo $row->menu_order; ?>')" >&nbsp;&nbsp;<i class="fa fa-angle-double-down"></i>&nbsp;&nbsp;</button>
					  </div>
					    <a data-toggle="collapse" href="#collapse<?php echo $row->menu_id ?>" aria-expanded="true" aria-controls="collapse<?php echo $row->menu_id ?>" style="text-decoration:none;">
						    <div class="panel-heading" role="tab" id="heading<?php echo $row->menu_id ?>">
							   <h4 class="panel-title">
						        <?php echo "<small>#".$row->menu_order."</small>&nbsp;&nbsp;&nbsp;".$row->menu_nama ?>
						      </h4>
						    </div>
					    </a>
					    <div id="collapse<?php echo $row->menu_id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $row->menu_id ?>">
					      <div class="panel-body">
							<?php echo form_open('',array('id'=>'menu'.$row->menu_id)) ?>
							  <div class="form-group form-group-sm valid required">
							    <label>Nama Menu</label>
							    <div class="input-group">
							    	<div class="input-group-addon icon">
								    <select class="form-control icon" name="icon" >
								    <?php 
								    	foreach ($data4 as $row2): 
								    		if($row->menu_icon==$row2->icon_nama){
								    			$sel = "selected";
								    		} else {
								    			$sel = "";
								    		}
								    ?>
								    	<option value="<?php echo $row2->icon_nama ?>" <?php echo $sel ?>><?php echo $row2->icon_val ?></option>
								    <?php endforeach ?>
								    </select>
							    	</div>
							    	<input type="text" class="form-control" name="nama" placeholder="Contoh: Beranda" value="<?php echo $row->menu_nama ?>">
							    </div>
							  </div>
							  <div class="row">
							  	<div class="col-lg-6">
								  <div class="form-group form-group-sm valid required">
								    <label>Link</label>
								    	<input type="text" class="form-control" name="link" value="<?php echo $row->menu_link ?>">
								  </div>
							  	</div>
							  	<div class="col-lg-6">
								  <div class="form-group form-group-sm">
								    <label>Link Title</label>
								    	<input type="text" class="form-control" name="link_title" value="<?php echo $row->menu_link_title ?>">
								  </div>
							  	</div>
							  </div>
							  <div class="form-group form-group-sm valid required">
							    <label>Menu Parent</label>
							    <select class="form-control" name="menu_parent">
							    	<option value="0">Parent</option>
							    	<?php foreach ($data2 as $row1): 
							    		if ($row1->menu_id!=$row->menu_id) {
							    	?>
							    	<option value="<?php echo $row1->menu_id ?>"><?php echo $row1->menu_nama ?></option>
							    	<?php } endforeach ?>
							    </select>
							  </div>
							  <p class="text-right">
							  <button type="button" class="btn btn-xs btn-primary" onclick="update('menu<?php echo $row->menu_id ?>','<?php echo $row->menu_id ?>')">Update</button>
							  <button type="button" class="btn btn-xs btn-danger" onclick="hapusmenu('<?php echo $row->menu_id ?>','<?php echo $row->menu_nama ?>')">Hapus</button>
							  </p>
							</form>
					      </div>
					    </div>
					  </div>
		    		<?php }} ?>
					</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>

<div class="modal fade" id="konfirm" tabindex="-1" role="dialog" aria-labelledby="konfirm" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header modal-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Konfirmasi Hapus</h4>
      </div>
      <div class="modal-body">
        <p id="konfirm_text">Yakin menghapus menu ini?</p>
        <p class="text-right">
	        <button id="idhapus" type="button" class="btn btn-xs btn-danger" data-dismiss="modal" onclick="hapus($(this).val())">Ya</button>
	        <button type="button" class="btn btn-xs btn-success" data-dismiss="modal">Tidak</button>
        </p>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	function update (form,id) {
		if (valid($("#"+form))) {
			var nama = $("#"+form+" input[name='nama']").val();
			var icon = $("#"+form+" select[name='icon']").val();
			var parent = $("#"+form+" select[name='menu_parent']").val();
			var link = "";
			var link_title = $("#"+form+" input[name='link_title']").val();
			var link = $("#"+form+" input[name='link']").val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/menu/updatemenu",
				data:{<?php echo $csrf ?>,'id':id,'nama':nama,'link':link,'link_title':link_title,'parent':parent,'icon':icon},
				dataType:"html",
				success: function(data){
					$("#accordion").html(data);
				},
				error:function(XMLHttpRequest){
				  alert(XMLHttpRequest.responseText);
				}
			});
		};
	};

	function simpanpage (form) {
		if (valid($("#"+form))) {
			var nama = $("#"+form+" input[name='nama']").val();
			var icon = $("#"+form+" select[name='icon']").val();
			var parent = $("#"+form+" select[name='menu_parent']").val();
			var link = "";
			if (form!="link") {
				link = $("#"+form+" select[name='link']").val();
			} else {
				link = $("#"+form+" input[name='link']").val();
			}
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/menu/simpanmenu",
				data:{<?php echo $csrf ?>,'nama':nama,'link':link,'link_title':nama,'parent':parent,'icon':icon},
				dataType:"html",
				success: function(data){
					$("#accordion").html(data);
				},
				error:function(XMLHttpRequest){
				  alert(XMLHttpRequest.responseText);
				}
			});
		};
	};

	function hapusmenu(id, nama){
		$("#konfirm_text").html("Yakin menghapus menu <strong>"+nama+"</strong>?");
		$('#idhapus').val(id);
		$('#konfirm').modal();
	};

	function hapus(id){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>admin/menu/hapusmenu",
			data:{<?php echo $csrf ?>,'id':id},
			dataType:"html",
			success: function(data){
				$("#accordion").html(data);
			},
			error:function(XMLHttpRequest){
			  alert(XMLHttpRequest.responseText);
			}
		})
	};

	function move(id,a,pos){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>admin/menu/move",
			data:{<?php echo $csrf ?>,'id':id,'action':a,'pos':pos},
			dataType:"html",
			success: function(data){
				$("#accordion").html(data);
			},
			error:function(XMLHttpRequest){
			  alert(XMLHttpRequest.responseText);
			}
		})
	};
</script>

<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>