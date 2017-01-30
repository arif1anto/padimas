<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pendaftaran</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Pengambilan PIN dan Pembayaran Pendaftaran</h3>
                </div>
                <div class="panel-body">
					<?php echo form_open('',array('class'=>'form-horizontal')) ?>
						<div class="form-group form-group-sm valid required">
                            <label class="control-label col-sm-3">Jenis pendaftaran</label>
                            <div class="col-sm-9">
                                <select id="jenisprog" class="form-control" name="stat_daftar">
                                <option value="">- Pilih Salah Satu -</option>
								<?php 
								if (count($data1)>0) {
									$i=0;
									foreach ($data1 as $row) {
											echo '<option value="'.$row->prg_id.'">'.$row->prg_nama.'</option>';
									}
								}
								?>
                                </select>
                                <p class="help-block"></p>
                            </div>
                        </div>
						<div class="form-group form-group-sm valid required">
                            <label class="control-label col-sm-3">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="nama" id="nama" >
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group form-group-sm valid required">
                            <label class="control-label col-sm-3">Jumlah Pilihan</label>
                            <div  class="col-sm-9">
                                <select id="piltarif" class="form-control" name="jml_pilihan" onchange="tarif()">
                                    <option value="">- Pilih Salah Satu -</option>
                                    <?php
									if (count($data2)>0) {
										$i=0;
										foreach ($data2 as $row) {
												echo '<option value="'.$row->id_tarif.'">'.$row->jns_tarif.'</option>';
										}
									}
									?>
                                </select>
                                <p class="help-block"></p>
                            </div>
                        </div>
						<div class="form-group form-group-sm valid required">
                            <label class="control-label col-sm-3">Biaya Pendaftaran</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-addon">
                                        <span>Rp.</span>
                                    </div>
    								<input type="text" id="niltarif" name="niltarif" class="form-control">
                                </div>
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group form-group-sm valid required">
                            <label class="control-label col-sm-3">Model Pembayaran</label>
                            <div class="col-sm-9">
                                <select id="modbayar" class="form-control" name="modbayar" onchange="tarif()">
                                    <option value="">- Pilih Salah Satu -</option>
                                    <option value="1" selected>Di Tempat Pendaftaran</option>
                                    <option value="2">Di Bank</option>
									<option value="3">Bebas Biaya Pendaftaran</option>
                                </select>
                            </div>
                        </div>
						<div class="col-sm-9">
							<span class="text-danger">Pastikan fotocopy identitas / fotocopy ijazah dikumpulkan</span>
                        </div>
						
                        <p class="text-right">
                        <button type="submit" class="btn btn-primary btn-xs">Simpan</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#datetime').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },pickTime: false

        });
    });
	
	function tarif(){
	   var modbayar=$('#modbayar').val();
	   var idtarif=$('#piltarif').val();
	   if(idtarif>0 && modbayar==1){
		   $.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/ajax/getTarifDaftar",
				data:{<?php echo $csrf ?>,'id':idtarif},
				success: function(data){	
					$('#niltarif').val(data);
				},
				error:function(XMLHttpRequest){

					alert(XMLHttpRequest.responseText);
				}
			})
	   }
	   else
		   $('#niltarif').val(0);
	};
	
	<?php echo isset($data3) ? $data3 :"" ?>
</script>
<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>