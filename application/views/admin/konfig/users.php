<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Konfigurasi Pengguna</h1>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12 jarak_bawah">
            <?php echo form_open('',array('class'=>'form-inline')) ?>
                <button type="button" class="btn btn-primary btn-xs" onclick="tambah()">Tambah Pengguna</button>
            </form>
    	</div>
    </div>
	<div class="row" id="tambah" style="display:none;">
		<div class="col-md-8 jarak_bawah">
			<?php echo form_open('admin/konfigurasi/user/tambah',array('id'=>'formuser')) ?>
				<input type="hidden" class="form-control input-sm" name="id" id="iduser">
				<div class="form-group jarak_bawah valid required">
					<label class="control-label">Username</label>
					<input type="text" class="form-control input-sm" name="uname" id="uname" placeholder="Misal: joni">
					<p class="help-block"></p>
				</div>
				<div class="form-group jarak_bawah valid required">
					<label class="control-label">Password</label>
					<input type="text" class="form-control input-sm" name="upass" id="upass" placeholder="Misal: joni@123">
					<p class="help-block"></p>
				</div>
				<div id="selakses" class="form-group jarak_bawah valid required">
					<label class="control-label">Hak Akses</label>
					<select type="text" class="form-control input-sm" name="uhak" id="uhak" placeholder="Misal: joni">
						<option value="">- pilih salah satu -</option>
						<?php 
							if(isset($data2)) :
								foreach($data2 as $r){
									echo '<option value="'.$r->id_hakakses.'">'.$r->group.'</option>';
								}
								endif;
						?>
					</select>
					<p class="help-block"></p>
				</div>
				<div class="form-group jarak_bawah valid required">
					<label class="control-label">Display Name</label>
					<input type="text" class="form-control input-sm" name="disname" id="disname" placeholder="Misal: Joni Andrean">
					<p class="help-block"></p>
				</div>
				<div class="form-group jarak_bawah valid required">
					<label class="control-label">Email</label>
					<input type="text" class="form-control input-sm" name="uemail" id="uemail" placeholder="Misal: joni@gmail.com">
					<p class="help-block"></p>
				</div>
				<button type="submit" class="btn btn-success btn-xs" name="submit"><i class="fa fa-plus fa-fw"></i> Simpan</button>
			</form>
		</div>
		<div id="tbh_hakakses"class="col-md-4 jarak_bawah">
		</div>
	</div>
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center" width="100">Aksi</th>
                    <th class="text-center" width="30">No</th>
					<th>Username</th>
                    <th>Password</th>
					<th>Display Name</th>
					<th>email</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        if (count($data1)>0) {
                    		$i=0;
                            foreach ($data1 as $row) {
                            	$i++;
                    ?>
                        <tr>
							<td class="text-center">
								<div class="btn-group btn-group-sm" role="group">
								  <button type="button" class="btn btn-warning" title="Edit" value="0" onclick="edit('<?php echo $row->aut_username; ?>',$(this))"><i class="fa fa-pencil"></i></button>
								  <button type="button" class="btn btn-danger" title="Hapus" value="<?php echo $row->aut_username ?>" onclick="hapus($(this).val())"><i class="fa fa-times"></i></button>
								</div>
							</td>
							<td class="text-center"><?php echo $i ?></td><span id="prog<?php echo $row->aut_username ?>" hidden><?php echo $row->aut_username ?></span>
							<td id="getuname<?php echo $row->aut_username ?>"><?php echo $row->aut_username ?></td>
							<td id="getpass<?php echo $row->aut_username ?>"><?php echo $row->aut_pass ?></td>
							<td id="getdisname<?php echo $row->aut_username ?>"><?php echo $row->aut_display_name ?></td>
							<td id="getemail<?php echo $row->aut_username ?>"><?php echo $row->aut_email ?></td>
                        </tr>
                    <?php
                            }
                        } else {
                    ?>
                        <tr>
                            <td colspan="4" class="danger text-center"><strong>Tidak ditemukan Pengguna</strong></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-center">Aksi</th>
                    <th class="text-center">No</th>
					<th>Username</th>
                    <th>Password</th>
					<th>Display Name</th>
					<th>email</th>
                  </tr>
                </tfoot>
              </table>
            </div>
        </div>
        <div class="col-sm-12 text-center">
        <ul class="pagination pagination-sm">
          <?php  echo $this->pagination->create_links(); ?>
        </ul>
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
        <p id="konfirm_text">Yakin menghapus Pengguna ini?</p>
		<?php echo form_open('admin/konfigurasi/user/hapus') ?>
          <input type="hidden" name="id" id="idhapus">
	        <p class="text-right">
	          <button type="submit" id="mbhapus" class="btn btn-xs btn-danger">Ya</button>
	          <button type="button" class="btn btn-xs btn-success" data-dismiss="modal">Tidak</button>
	        </p>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(function(){
		$('#tambah').hide();
		$('#tbh_hakakses').hide();
	});

    function pilih(cek) {
	    cek = cek.is(':checked');
	      $('table').find('th input:checkbox').prop('checked', cek);
	      $('table').find('tr input:checkbox').prop('checked', cek);
	};

	function edit(jns,btn){
		kondisi = $(btn).val();
		var prog = $("#prog"+jns).html();
		if (kondisi=='0') {
			$('#formuser').attr('action','<?php echo base_url().index_page()?>admin/konfigurasi/user/edit');
			$('#tambah').show();
			$('#iduser').val(jns);
			$('#uname').attr('disabled',true);
			$('#uname').val($('#getuname'+jns).html());
			$('#upass').val($('#getpass'+jns).html());
			$('#disname').val($('#getdisname'+jns).html());
			$('#uemail').val($('#getemail'+jns).html());
			$(btn).val('1');
			$('#uhak').closest('.valid.required').hide();
			$("#uhak").prop('disabled', true);
			$('#uhak').closest('.valid.required').removeClass('valid required');
			if(jns!=null){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url().index_page();?>admin/ajax/getAkses",
					data: {<?php echo $csrf ?>,'id':jns},
					cache: false,
					success: function(data)
					{
						$("#tbh_hakakses").show();
						$("#tbh_hakakses").html(data);
					}
				});
			}
		} else {
			$('#tambah').hide();
			$("#tbh_hakakses").hide();
			$(btn).val('0');
		}
	};

	function tambah(){
		$('#tambah').toggle();
		$('#formuser').attr('action','<?php echo base_url().index_page()?>admin/konfigurasi/user/tambah');
		$('#iduser').val(null);
		$('#uname').attr('disabled',false);
		$('#uname').val(null);
		$('#upass').val(null);
		$('#disname').val(null);
		$('#uemail').val(null);
		$("#selakses").show();
		$('#uhak').closest('.valid.required').show();
		$('#uhak').closest('.valid.required').addClass('valid required');
		$("#uhak").prop('disabled', false);
		$('#tbh_hakakses').hide();
	}
	
	function tambahakses(aksi){
		$('#fieldtbhakses').show();
		$('#formtbhakses').html($("#selakses select").html());
		$('#uhak').closest('.valid.required').show();
		$('#uhak').closest('.valid.required').addClass('valid required');
		$("#uhak").prop('disabled', false);
		$('#formtbhakses').change(function(){
			seltext=$('#formtbhakses option:selected').text();
			selval=$('#formtbhakses option:selected').val();
		});
		if(aksi==true){
			iduser=$("#iduser").val();
			if(iduser!=null){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url().index_page();?>admin/ajax/inAkses",
					data: {<?php echo $csrf ?>,'id':iduser,'akses':selval},
					cache: false,
					success: function(data)
					{
						if(data=="sukses"){
							$("#fieldtbhakses").after('<tr id="trakses'+selval+'"><td>'+seltext+'</td><td class="text-right"><a class="btn btn-danger btn-xs" onclick="hapusakses('+selval+')"><i class="fa fa-times"></i></a></td></tr>');
							$('#fieldtbhakses').hide();
						}
						
					}
				});
			}
		}
	}
	function hapus(id){
		$("#konfirm_text").html("Yakin menghapus user ini?");
		$("#idhapus").val(id);
		$('#konfirm').modal();
	}
	function hapusakses(id){
		iduser=$("#iduser").val();
		if(iduser!=null){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url().index_page();?>admin/ajax/delAkses",
				data: {<?php echo $csrf ?>,'id':iduser,'akses':id},
				cache: false,
				success: function(data)
				{
					if(data=="sukses"){		
						$("#trakses"+id).remove();
					}
					
				}
			});
		}
	}

</script>

<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>