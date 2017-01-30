<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Perbandingan Pendaftar dan Her-registrasi Bulanan</h1>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12 jarak_bawah">
            <form class="form-inline" role="form">
				<label>Pilih Bulan :</label>
                <select class="form-control input-sm" name="tgl" onchange="laporan(this.value)">
					<?php
						for($a=1;$a<=12;$a++){
							switch($a){
								case 1 : echo "<option value='".$a."' ".(date('m')==$a ? 'selected' : '').">Januari</option>"; break;
								case 2 : echo "<option value='".$a."' ".(date('m')==$a ? 'selected' : '').">Februari</option>"; break;
								case 3 : echo "<option value='".$a."' ".(date('m')==$a ? 'selected' : '').">Maret</option>"; break;
								case 4 : echo "<option value='".$a."' ".(date('m')==$a ? 'selected' : '').">April</option>"; break;
								case 5 : echo "<option value='".$a."' ".(date('m')==$a ? 'selected' : '').">Mei</option>"; break;
								case 6 : echo "<option value='".$a."' ".(date('m')==$a ? 'selected' : '').">Juni</option>"; break;
								case 7 : echo "<option value='".$a."' ".(date('m')==$a ? 'selected' : '').">Juli</option>"; break;
								case 8 : echo "<option value='".$a."' ".(date('m')==$a ? 'selected' : '').">Agustus</option>"; break;
								case 9 : echo "<option value='".$a."' ".(date('m')==$a ? 'selected' : '').">September</option>"; break;
								case 10 : echo "<option value='".$a."' ".(date('m')==$a ? 'selected' : '').">Oktober</option>"; break;
								case 11 : echo "<option value='".$a."' ".(date('m')==$a ? 'selected' : '').">November</option>"; break;
								case 12 : echo "<option value='".$a."' ".(date('m')==$a ? 'selected' : '').">Desember</option>"; break;
							}
						}
					?>
				</select>
            </form>
    	</div>
    </div>
	<div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
               <table id="tb_dftr_days" class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Fakultas</th>
                    <th class="text-right">Pendaftar</th>
                    <th class="text-right">Her-registrasi</th>
                  </tr>
                </thead>
                <?php 
				if(isset($data1) && count($data1)>0) :
				$no=1;$jml1=0;$jml2=0;
				foreach($data1 as $r) :
					echo '
					<tr>
						<td>'.$no.'</td>
						<td>'.$r->fakultas.'</td>
						<td class="text-right text-success word-space-20">'.$r->jml_pendaftar.' </td>
						<td class="text-right text-danger word-space-20"> '.$r->jml_her.' </td>					
					</tr>
					';
					$no++;
					$jml1+=$r->jml_pendaftar;
					$jml2+=$r->jml_her;
				endforeach;
				echo '
				</tbody>
                <tfoot>
                  <tr>
                    <th class="text-center" colspan="2">TOTAL</th>
                    <th class="text-right text-success"><abbr title="Jumlah Pendaftar.">'.$jml1.'</abbr></th>
                    <th class="text-right text-danger"><abbr title="Jumlah Her-registrasi.">'.$jml2.'</abbr></th>
                  </tr>
                </tfoot>';
				else :
					echo '
					<tr>
						<td class="text-center" colspan="4">Tidak Ada Pendaftar Pada Bulan Ini</td>			
					</tr>
					</tbody>
					';
				endif;
				?>
              </table>
            </div>
        </div>
		<div class="col-md-4">
			<div class="panel panel-default">
			  <div class="panel-heading">Grafik Pendaftar dan Her-registrasi Bulanan (6 Bulan terakhir)</div>
			  <div class="panel-body">
				<div id="chartBulanan" style="height: 250px;"></div>
			  </div>
			</div>																						
		</div>
    </div>
</div>

<script type="text/javascript">

	<?php echo $chart; ?>
	
	function laporan(nil){
		if(nil!=''){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/ajax/getLaporan/bl",
				data: {<?php echo $csrf ?>,'key':nil},
				cache: false,
				success: function(data)
				{
					$("#tb_dftr_days").html(data);	
				}
			});
		}
		
	}
    

</script>

<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>