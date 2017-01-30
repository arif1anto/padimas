<?php 
$iduri=$this->uri->segment(5);
isset($data1[0]->iddaftar) ? 	$id_daftar=$data1[0]->iddaftar : $id_daftar="";
isset($data1[0]->spa) ? 		$spa=$data1[0]->spa : $spa=0;
isset($data1[0]->spa_byr) ? 	$spa_byr=$data1[0]->spa_byr : $spa_byr=0;
isset($data1[0]->spa_pot) ? 	$spa_pot=$data1[0]->spa_pot : $spa_pot=0;
isset($data1[0]->dpa) ?  		$dpa=$data1[0]->dpa : $dpa=0;
isset($data1[0]->spp_tetap) ?  	$spp_tetap=$data1[0]->spp_tetap : $spp_tetap=0;
isset($data2[0]->spa_byr) ? 	$spa_sisa=$spa_byr-$data2[0]->spa_byr : $spa_sisa=$spa_byr-0;
isset($data2[0]->dpa_byr) ?  	$dpa_sisa=$dpa-$data2[0]->dpa_byr : $dpa_sisa=$dpa-0;
isset($data2[0]->sppttp_byr) ?  	$spp_sisa=$spp_tetap-$data2[0]->sppttp_byr : $spp_sisa=$spp_tetap-0;
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Her Registrasi</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Bayar Her Registrasi</h3>
                </div>
                <div class="panel-body">
					<div class="form-horizontal">
					<div class="form-group form-group-sm ">
						<label class="control-label col-sm-3">No Pendaftaran</label>
						<div class="col-sm-9 input-sm">
							<input form="formbyr" type="text" class="form-control" name="id_daftar" value="<?php echo $id_daftar!=0 ? $id_daftar : $iduri; ?>"id="searchbox" onkeyup="cari()" onkeydown="lompat(event)" placeholder="Ketikkan Nomor Pendaftaran atau Nama Pendaftar untuk mencari data." autocomplete="off">
							<div class="input-group col-sm-6" id="display"></div>
							<p class="help-block"></p>
							<div class="form-group">
								<p class="col-xs-12 form-control-static">Nama Calon : <strong><?php echo isset($data1[0]->nama) ? $data1[0]->nama : ''?></strong></p>
							</div>
						</div>
					</div>
					
					</div>
					<?php echo form_open('admin/pendaftaran/bayar_her/tambah/'.$id_daftar,array('id'=>'formbyr','class'=>'form-horizontal','enctype'=>'multipart/form-data')) ?>
						<?php if($id_daftar!=0) : ?>
						<div class="table-responsive">
							<table class="table table-hover" border="0">
								<thead>
									<th>Jenis</th>
									<th class="text-right">Total Bayar (Rp)</th>
									<th class="text-right">Sisa Bayar (Rp)</th>
									<th class="text-center">Jumlah Bayar (Rp)</th>
									<th class="text-center">Status</th>
								</thead>
								<tbody>
									<tr>
										<td>
											SPA <?php echo $spa_pot>0 ? "(Potongan Rp. ".$spa_pot." dari Rp. ".$spa." )" : "" ?>

										</td>
										<td class="text-right">
											<?php echo number_format($spa_byr,0,',','.') ?>,-
										</td>
										<td class="text-right">
											<?php echo number_format($spa_sisa,0,',','.') ?>,-
										</td>
										<td>
											<div class="form-group form-group-sm ">
												<div class="col-sm-12">
													<input type="text" class="form-control input-sm currency" name="spa_byr" id="spa_byr" placeholder="ex:<?php echo number_format($spa_sisa,0,',','.') ?>">
													<p class="help-block"></p>
												</div>
											</div>
										</td>
										<td id="status" class="text-center">
											<?php echo $spa!=0 && $spa_sisa==0 ? '<span style="color:green">LUNAS</span>': ($spa_sisa<0 ?  '<span style="color:blue">KELEBIHAN BAYARAN </span>' : '<span style="color:red">BELUM LUNAS</span>')?>
										</td>
									</tr>
									<tr>
										<td>
											Dana Pra Kuliah
										</td>
										<td class="text-right">
											<?php echo number_format($dpa,0,',','.') ?>,-
										</td>
										<td class="text-right">
											<?php echo number_format($dpa_sisa,0,',','.') ?>,-
										</td>
										<td>
											<div class="form-group form-group-sm ">
												<div class="col-sm-12">
													<input type="text" class="form-control input-sm currency" name="dpa_byr" id="dpa_byr" placeholder="ex:<?php echo number_format($dpa_sisa,0,',','.') ?>">
													<p class="help-block"></p>
												</div>
											</div>
										</td>
										<td id="status" class="text-center">
											<?php echo $dpa!=0 && $dpa_sisa==0 ? '<span style="color:green">LUNAS</span>': ($dpa_sisa<0 ?  '<span style="color:blue">KELEBIHAN BAYARAN </span>' : '<span style="color:red">BELUM LUNAS</span>') ?>
										</td>
									</tr>
									<tr>
										<td>
											SPP Tetap
										</td>
										<td class="text-right">
											<?php echo number_format($spp_tetap,0,',','.') ?>,-
										</td>
										<td class="text-right">
											<?php echo number_format($spp_sisa,0,',','.') ?>,-
										</td>
										<td>
											<div class="form-group form-group-sm ">
												<div class="col-sm-12">
													<input type="text" class="form-control input-sm currency" name="sppttp_byr" id="sppttp_byr" placeholder="ex:<?php echo number_format($spp_sisa,0,',','.') ?>">
													<p class="help-block"></p>
												</div>
											</div>
										</td>
										<td id="status" class="text-center">
											<?php echo $spp_tetap>0 && $spp_sisa==0 ? '<span style="color:green">LUNAS</span>': ($spp_sisa<0 ?  '<span style="color:blue">KELEBIHAN BAYARAN </span>' : '<span style="color:red">BELUM LUNAS</span>') ?>
										</td>
									</tr>
								</tbody>
								<tfoot>
									<th>Jumlah</th>
									<th class="text-right"><?php echo number_format(($spa+$dpa+$spp_tetap),0,',','.') ?>,-</th>
									<th class="text-right"><?php echo number_format(($spa_sisa+$dpa_sisa+$spp_sisa),0,',','.') ?>,-</th>
									<th class="text-right" colspan="2"></th>
								</tfoot>
							</table>
						</div>	
                        <p class="text-right">
                        <button type="submit" class="btn btn-primary btn-xs">Simpan</button>
                        </p>
						<?php elseif($iduri!=0) : ?>
						<div class="table-responsive">
							<table class="table table-hover" border="0">
								<thead>
									<th class="text-center text-danger">Pendaftar dengan no pendaftaran <?php echo $iduri ?> belum melakukan her-registrasi</th>
								</thead>
							</table>	
						</div>
						<?php else : ?>
						<div class="table-responsive">
							<table class="table table-hover" border="0">
								<thead>
								</thead>
							</table>	
						</div>
						<?php endif; ?>
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
	function lompat(e){
		if(e.keyCode==13){
			window.location.href="<?php echo base_url().index_page().'admin/pendaftaran/bayar_her/cari/';?>"+$("#searchbox").val();
			return false;
		}
	}
	function cari(){
		var nilai=$('#searchbox').val();
		if(nilai!=''){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url().index_page();?>admin/ajax/getCariByrHer",
				data: {<?php echo $csrf ?>,'key':nilai },
				cache: false,
				success: function(data)
				{
					if(data==nilai)
						window.location.href="<?php echo base_url().index_page().'admin/pendaftaran/bayar_her/cari/'?>"+nilai;
					else
						$("#display").html(data).show();	
				}
			});
		}
		$("#display").hide();		
	}
</script>
<script>
	var sep = '.';
	$(document).ready(function() {
		$('.currency').on('keyup', formatCurrency);
	});
	function formatCurrency()
	{
		var f = this.value.replace(/\D/g, '');
		var l = f.length;
		var g = l % 3;
		if(isInt(f) && f>999){
			if (g == 0 )
				this.value = thousands(f);
			else
			{
				var lead = f.substring(0, g);
					f = f.substring(g, l);
				this.value = lead + sep + thousands(f);
			}
		}else if(isInt(f) && f<1000) 
			this.value = f;
		else
			this.value= '';
	}

	// Function that commatizes the thousands
	function thousands(s)
	{
		// Match groups of 3 decimals
		var t = s.match(/(\d{3})/g);
		return t.join(sep) ;		
	}
	function isInt(n) {	
	   return n>0 ? n % 1 === 0 : false;
	}
</script>
<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>
