<?php 
function tanggal($date=null){
	if($date!=null) :
		$yr=date('Y',strtotime($date));
		$mo=date('m',strtotime($date));
		$d=date('d',strtotime($date));
		$day=date('N',strtotime($date));
		
		$bln='';$hr='';
		switch($mo){
			case '01' : $bln="Januari" ;break;
			case '02' : $bln="Februari" ;break;
			case '03' : $bln="Maret" ;break;
			case '04' : $bln="April" ;break;
			case '05' : $bln="Mei" ;break;
			case '06' : $bln="Juni" ;break;
			case '07' : $bln="Juli" ;break;
			case '08' : $bln="Agustus" ;break;
			case '09' : $bln="September" ;break;
			case '10' : $bln="Oktober" ;break;
			case '11' : $bln="November" ;break;
			case '12' : $bln="Desember" ;break;
		}
		
		switch($day){
			case 1 : $hr="Senin" ;break;
			case 2 : $hr="Selasa" ;break;
			case 3 : $hr="Rabu" ;break;
			case 4 : $hr="Kamis" ;break;
			case 5 ; $hr="Jum'at" ;break;
			case 6 ; $hr="Sabtu" ;break;
			case 7 ; $hr="Minggu" ;break;
			
		}
		return $hr.', '.$d.' '.$bln.' '.$yr;
	endif;
}
$st=isset($data2['st']) && $data2['st']!=0 ? $data2['st'] : "";
$end=isset($data2['end']) && $data2['end']!=0 ? $data2['end'] : "";
?>
<style>.datetime {width:100px !important;}</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Laporan pendaftar</h1>
        </div>
    </div>
    <div class="row">
        
		<div id="cari">
			<?php echo form_open(site_url('admin/pendaftaran/excel/rekomendasi'),array("id"=>"unduh","class"=>"form-inline")) ?>
				<div class="col-sm-3 text-left jarak_bawah">
					<div class="form-group form-group-sm">		  
						<button type="submit" class="btn btn-success btn-xs" form="unduh"><i class="fa fa-file-excel-o"></i> Download Excel</button>
					</div>
				</div>
				<div class="col-sm-9 text-right jarak_bawah">
					<div class="form-group form-group-sm">
						<label class="control-label">Jalur pendaftaran</label>
						<select id="jenisprog" class="form-control" name="stat_daftar">
						<?php 
						if (count($data1)>0) {
							$i=0;
							foreach ($data1 as $row) {
									echo '<option value="'.$row->prg_id.'" '.(isset($data6->jalur_pendaftaran) && $data6->jalur_pendaftaran==$row->prg_id ? 'selected' : '').'>'.$row->prg_nama.'</option>';
							}
						}
						?>
						</select>
						<p class="help-block"></p>
					</div>
					<div id="jnsbea"class="form-group form-group-sm">
					</div>
					<div class="form-group form-group-sm ">	
							<label class="control-label">Tanggal Tes </label>						
							<div class="input-group input-group-sm">
								<input type="text" class="form-control datetime" id="tgl_awal" name="tgl_awal" data-date-format="DD-MM-YYYY" value="<?php echo $st ?>"/>
								<span class="input-group-addon input-sm">
									 s/d
								</span>
								<input type="text" class="form-control datetime" id="tgl_akhir" name="tgl_akhir" data-date-format="DD-MM-YYYY" value="<?php echo $end ?>"/>
							</div>	
					</div>
					<div class="form-group form-group-sm">
					<input type="text" id="caridata" class="form-control input-sm" name="caridata" placeholder="Cari No Pendaftaran / Nama">
					</div>
					<div class="form-group">
						<button form="cari" id="filter" onclick="carirekomendasi()" class="btn btn-default btn-xs"><i class="fa fa-filter"></i> Filter</button>
					</div>
				</div>
			</form>
        </div>

        <div class="load text-center" style="position: absolute; left: 31px; top: 304px; background-color: rgba(136, 136, 136, 0.62); z-index: 5; display: none;">
        	<i class="fa fa-refresh fa-spin fa-3x" style="color: #fff;"></i>
        </div>

        <div class="col-sm-12" id="rekomen">
            <div class="table-responsive">
              <table class="table table-hover"  >
                <thead>
                  <tr>
					<th class="text-center" width="100">Aksi</th>
					<th class="text-center" width="50">No</th>
                    <th>ID Daftar</th>
                    <th>Nama</th>
                    <th>Prodi</th>
					<th>Fakultas</th>
					<th class="text-right">SPA</th>
                    <th class="text-right">SPA Potongan</th>
					<th class="text-center">Rekomendasi</th>
					<th class="text-right">Tgl Tes (yyyy-mm--dd)</th>
					<th class="text-right">Tgl Her (yyyy-mm--dd)</th>
					<th class="text-right">Jalur Pendaftaran</th>
                  </tr>
                </thead>
                <tbody>
                        <tr>
                            <td colspan="12" class="danger text-center"><strong>Tidak ditemukan Data Pendaftar</strong></td>
                        </tr>
                </tbody>
                <tfoot>
                    <tr>
                    <th class="text-center">Aksi</th>
					<th class="text-center">No</th>
                    <th>ID Daftar</th>
                    <th>Nama</th>
                    <th>Prodi</th>
					<th>Fakultas</th>
					<th class="text-right">SPA</th>
                    <th class="text-right">SPA Potongan</th>
					<th class="text-center">Rekomendasi</th>
					<th class="text-right">Tgl Tes (yyyy-mm--dd)</th>
					<th class="text-right">Tgl Her (yyyy-mm--dd)</th>
					<th class="text-right">Jalur Pendaftaran</th>
                    </tr>
                </tfoot>
              </table>
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
        <p id="konfirm_text">Yakin menghapus Data ini?</p>
        <p class="text-right">
          <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal" onclick="hapus()">Ya</button>
          <button type="button" class="btn btn-xs btn-success" data-dismiss="modal">Tidak</button>
        </p>
      </div>
    </div>
  </div>
</div>
<script>
	var sep = '.';
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
<script>
	$(function () {
        $('.datetime').datetimepicker({
			format: "DD-MM-YYYY",
			maxDate: "<?php echo date("d/m/Y") ?>",
			pickTime: false,
            icons: {
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
        });
        $('.form-kategori').hide();
    });
	function url_lompat(){
		window.location.href="<?php echo base_url().index_page().'admin/pendaftaran/laporan/cari/';?>"+$("#tgl_awal").val()+"dn"+$("#tgl_akhir").val();
	}
	function lompat(e){
		if(e.keyCode==13){
			url_lompat();
			return false;
		}
	}

	function loading(a) {
		h = $('#rekomen tbody').height();
		w = $('#rekomen').width();
		t = $('#rekomen tbody').offset().top;
		l = $('#rekomen tbody').offset().left;
		$('.load').height(h);
		$('.load').width(w);
		$(".load").css({top: t, left: l});
		$(".load>i").css({'margin-top':(h/2)-18});
		if (a=='show') {
			$('.load').show();
		} else {
			$('.load').hide();
		}
	}

	function carirekomendasi(pg) {
		 tgl1 = $('#tgl_awal').val(); 
		 tgl2 = $('#tgl_akhir').val();
		 cari = $('#caridata').val();
		 prog = $('#jenisprog').val();
		 jnsbea = $('#jenisbea').val();
		 if(pg==null || pg=='')
			pg=1;
		 if(prog==null || prog=='')
			 prog=2;
		 $.ajax({
			  type: "POST",
			  url: "<?php echo base_url().index_page();?>admin/ajax/getrekomendasi",
			  data:{<?php echo $csrf ?>,'tgl1':tgl1,'tgl2':tgl2,'cari':cari,'page':pg,'prog':prog,'jnsbea':jnsbea},
			  dataType:"html",
			  beforeSend: function () {
				loading('show');
			  },
			  success: function(data){
			  	$('#rekomen').html(data);
				loading('hide');
			  },
			  error:function(XMLHttpRequest){
				loading('show');
			  }
	  })
	}


  function hapusPengumuman(){
    $("#konfirm_text").html("Yakin menghapus Pengumuman ini?");
    $('#konfirm').modal();
  };
  function pilih(cek) {
    cek = cek.is(':checked');
      $('table').find('td input:checkbox').prop('checked', cek);
      $('table').find('th input:checkbox').prop('checked', cek);
  };
   function edit(jns,btn){
		kondisi = $(btn).val();
		if (kondisi=='0') {
			var spapot = $("#spapot"+jns).html();
			var rekomendasi = $("#rekomendasi"+jns).html();
			var sel='<select class="form-control input-sm rekomendasi'+jns+'" name="rekomendasi" form="formrekomen'+jns+'">';
				sel +=	'<option value="diterima" '+(rekomendasi=="diterima" ? 'selected' : '')+'>Di Terima</option>';
				sel +=	'<option value="ditolak" '+(rekomendasi=="ditolak" ? 'selected' : '')+'>Di Tolak</option>';
				sel +=	'<option value="ragu-ragu" '+(rekomendasi=="ragu-ragu" ? 'selected' : '')+'>Ragu Ragu</option>';
				sel +=	'</select>';
			$('#spapot'+jns).html('<input type="text" class="form-control input-sm text-right currency spapot'+jns+'" name="spapot" value="'+spapot+'" form="formrekomen'+jns+'">');
			$('#rekomendasi'+jns).html(sel);
			$(btn).val('1');
			$('#aksi'+jns).hide();
			$('#simpan'+jns).show();
			$('.currency').on('keyup', formatCurrency);
		} else {
			$(btn).val('0');
		}
	};
	function uprekomendasi(id){
		var rekomendasi=$(".rekomendasi"+id).val();
		var spapot=$(".spapot"+id).val();
		var iddaftar=$("#iddaftar"+id).html();
		if (id!="") {
		  $.ajax({
				  type: "POST",
				  url: "<?php echo base_url().index_page();?>admin/ajax/uprekomendasi",
				  data:{<?php echo $csrf ?>,'id':id,'rekomendasi':rekomendasi,'spapot':spapot,'iddaftar':iddaftar},
				  dataType:"text",
				  success: function(data){
						$('#spapot'+id).html(spapot);
						$('#rekomendasi'+id).html(rekomendasi);
						$('#aksi'+id).show();
						$('#simpan'+id).hide();
						spatext=$('#spa'+id).html();
						spa=spatext.replace(/\D/g, '');
						spapot2=spapot.replace(/\D/g, '');
						spabyr=spa-spapot2;
						$('#spabyr'+id).html(spabyr);
			  },
			  error:function(XMLHttpRequest){
				  alert(XMLHttpRequest.responseText);
			  }
		  })
		};
	}
	function cetak(id){
	$("#cetak"+id).removeClass("btn-primary").addClass("btn-default");	
	$("<iframe>")                             
        .hide()                               
        .attr("src", "<?php echo base_url().index_page().'admin/pengumuman/cetak/' ;?>"+id) 
        .appendTo("body"); 
	}
	function cari(){
		var nilai=$('#searchbox').val();
		if(nilai!=''){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>admin/ajax/getCariHer/bea",
				data: {<?php echo $csrf ?>,'key':nilai},
				cache: false,
				success: function(data)
				{
					$("#display").html(data).show();	
					
				}
			});
		}
		$("#display").hide();		
	};
</script>
<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>