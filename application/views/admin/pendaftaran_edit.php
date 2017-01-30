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
					<div class="form-horizontal">
						<div class="form-group form-group-sm valid required">
							<label class="control-label col-sm-3">No Pendaftaran</label>
							<div class="col-sm-9">
								<input type="text" class="form-control input-sm" name="iddaftar" id="searchbox" onkeyup="cari()" onkeydown="lompat(event)" value="<?php echo isset($data1->id_daftar) ? $data1->id_daftar : ''?>" placeholder="Ketikkan Nomor Pendaftaran atau Nama Pendaftar untuk mencari data." autocomplete="off">
								<div class="row input-sm">
									<div id="display"></div>
								</div>
								<p class="help-block"></p>
							</div>
						</div>
					</div>
					<?php echo form_open('',array('class'=>'form-horizontal')) ?>
						<div class="form-group form-group-sm valid required">
                            <label class="control-label col-sm-3">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" name="nama" id="nama" value="<?php echo isset($data1->nama) ? $data1->nama : ''?>">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group form-group-sm valid required">
                            <label class="control-label col-sm-3">Jumlah Pilihan</label>
                            <div  class="col-sm-9">
                                <select id="piltarif" class="form-control" name="jml_pilihan" onchange="tarif()">
                                    <option value="0">- Pilih -</option>
                                    <?php
									if (count($data2)>0) {
										$i=0;
										foreach ($data2 as $row) {
												echo '<option value="'.$row->id_tarif.'"'.(isset($data1->jml_pilihan) && $data1->jml_pilihan== ++$i ? 'selected' : '').'>'.$row->jns_tarif.'</option>';
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
                                <span  id="jumtarif" class="form-control">Rp. <?php echo isset($data3[0]->tarif) ? $data3[0]->tarif : '-'?></span>
								<input type="hidden"  id="niltarif" name="niltarif" class="form-control" value="<?php echo isset($data3[0]->tarif) ? $data3[0]->tarif : ''?>"/>
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group form-group-sm valid required">
                            <label class="control-label col-sm-3">Model Pembayaran</label>
                            <div class="col-sm-9">
                                <select id="modbayar" class="form-control" name="modbayar" onchange="tarif()">
                                    <option value="1" <?php echo isset($data1->model_bayar) && $data1->model_bayar==1 ? 'selected' : '' ?>>Di Tempat Pendaftaran</option>
                                    <option value="2" <?php echo isset($data1->model_bayar) && $data1->model_bayar==2 ? 'selected' : '' ?>>Di Bank</option>
									<option value="3" <?php echo isset($data1->model_bayar) && $data1->model_bayar==3 ? 'selected' : '' ?>>Bebas Biaya Pendaftaran</option>
                                </select>
                            </div>
                        </div>
						<div class="col-sm-9">
							<span style="color:red;text-decoration:blink;">Pastikan fotocopy identitas / fotocopy ijazah dikumpulkan</span>
                        </div>
                        <p class="text-right">
                        <button type="submit" class="btn btn-primary btn-xs">Simpan</button>
                        <!--<a href="javascript:void(0)" class="btn btn-success btn-xs" target="_blank" onclick="cetak(<?php echo (isset($data1->id_daftar) ? $data1->id_daftar : ""); ?>)";>Cetak</a>
                        --></p>
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
					$('#jumtarif').html('Rp. '+data);
					document.getElementById('niltarif').value=data;
				},
				error:function(XMLHttpRequest){

					alert(XMLHttpRequest.responseText);
				}
			})
	   }
	   else
		   $('#jumtarif').html('Rp. 0');
	};
	function lompat(e){
		if(e.keyCode==13){
			window.location.href="<?php echo base_url().index_page().'admin/pendaftaran/edit/';?>"+$("#searchbox").val();
			return false;
		}
	}
	function cari(){
		var nilai=$('#searchbox').val();
		if(nilai!=''){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/ajax/getCariByrDaftar",
				data: {<?php echo $csrf ?>,'key':nilai},
				cache: false,
				success: function(data)
				{
					if(data==nilai)
						window.location.href="<?php echo base_url().index_page().'admin/pendaftaran/edit/'?>"+nilai;
					else
						$("#display").html(data).show();	
				}
			});
		}
		$("#display").hide();		
	}
    function cetak(id){
        $("<iframe>")
        .hide()
        .attr("src", "<?php echo base_url().index_page().'admin/pendaftaran/cetak/slip/' ;?>"+id)
        .appendTo("body"); 
    }
	<?php echo isset($data4) ? $data4 :"" ?>
</script>
<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>
