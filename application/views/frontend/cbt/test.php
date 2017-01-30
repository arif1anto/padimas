
<div class="container" >
	<div class="row">
		<div class="visible-xs">
			<div class="alert alert-warning">
				<b>Gunakan Tablet atau Desktop untuk mengerjakan Test Potensi Akademik.</b>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 hidden-xs">
			<div class="row">
				<?php echo form_open('maba/test/selesai','id="testform"') ?>
					<div class="col-lg-offset-2 col-lg-8 col-md-offset-3 col-md-6 ">
						<div class="sidepanel left bg-primary hidden-sm">
							<div class="sidepanel-heading">
								<h4 class="page-header">Data diri</h4>
							</div>
							<div class="sidepanel-body">
								<p><small>No. Pendaftaran :</small></p>
								<p><strong><?php echo $data1[0]->id_daftar ?></strong></p>
								<p><small>Nama :</small></p>
								<p><strong><?php echo $data1[0]->nama ?></strong></p>
							</div>
						</div>
						<div class="sidepanel right bg-primary hidden-sm">
							<div class="sidepanel-heading">
								<small>Sisa waktu anda :</small>
								<h1><b id="timer">00:00:00</b></h1>
								<small>Nomor soal :</small>
								<h1 class="no-soal"><b id="noSoal">1</b><b><sub>/</sub><sub id="totalSoal"><?php echo $data3[0]->jml_soal ?></sub></b></h1>
								<p><b id="soalBJ">45</b> Soal Belum Dijawab</p>
							</div>
							<button type="submit" class="btn btn-block btn-danger" id="final" style="border-radius: 0 0 5px 0;">Selesai</button>
						</div>

				        <div class="detail" style="min-height: 271px;">
				            <div class="detail-heading">
				                <h1 class="page-header">Test Potensi Akademik <small>PMB UTY <?php echo date('Y') ?></small></h1>
				            </div>
				            <div class="detail-body">
									<?php 
										$j=0;$tmp = ''; 
										for ($i=0; $i<count($data2); $i++):
											if ($tmp!=$data2[$i]->id_soal) { 
									?>
									<div class="soal" style="display:none">
										<p class="pull-right"><strong><?php echo $data2[$i]->nama_kategori ?></strong></p>
										<p>Selesaikan persoalan berikut ini:</p>
										<p>
										<?php 
											echo $data2[$i]->soal; 
										?>
										</p>
										<input type="hidden" name="soal[<?php echo $j ?>]" value="<?php echo $data2[$i]->id_soal ?>">
										<?php 
											$tmp=$data2[$i]->id_soal;
											} 
										?>
										<div class="radio">
											<label>
												<input alt="A" type="radio" name="jawaban[<?php echo $j ?>]" value="<?php echo $data2[$i]->id_jawaban ?>" /> <?php echo $data2[$i]->jawaban ?>
											</label>
										</div>
									<?php 
										$tmp2 = isset($data2[$i+1]->id_soal)?$data2[$i+1]->id_soal:"";
										if ($tmp!=$tmp2) { $j++; ?>
									</div>
									<?php } endfor ?> 
									<button type="button" class="btn btn-warning" id="prev" style="display:none">Sebelumnya</button>
									<button type="button" class="btn btn-primary" id="next">Selanjutnya</button>
								<br />
								<br />
								<div class="progress">
								  <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
									<span class="sr-only" id="progres">0% Complete (success)</span>
								  </div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<br />
			<div class="row text-center" id="navsoal">
				<div class="col-lg-12">
					<div class="btn-group" role="group">
						<?php for($i=0; $i<$data3[0]->jml_soal; $i++): 
						?>
						  <button type="button" class="btn btn-xs btn-default btn-soal" value="<?php echo $i+1 ?>"><?php echo $i+1 ?></button>
						<?php 
						endfor ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Konfirmasi?</h4>
      </div>
      <div class="modal-body">
        <p class="title">Yakin mau keluar dari halaman ini?</p>
        <p class="text-right">
        <button type="button" id="btnYes" class="btn btn-danger">Ya</button>
        <button type="button" id="btnNo" class="btn btn-primary" data-dismiss="modal">Tidak</button>
        </p>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url()?>assets/js/cbt/js.cookie.js"></script>
<script src="<?php echo base_url()?>assets/js/cbt/countdown.min.js"></script>
<script src="<?php echo base_url()?>assets/js/cbt/timer.js"></script>
<script type="text/javascript">
	document.addEventListener("keydown", keyDownTextField, false);
	$('#testform').on('keyup keypress', function(e) {
	  var keyCode = e.keyCode || e.which;
	  if (keyCode === 13) { 
		$("#next").click();
		return false;
	  }
	});
	function keyDownTextField(e) {
		var keyCode = e.keyCode;
  		var no = $("#noSoal").html();
  		var soal = $(".soal" );
  		nosoal = parseInt(no)-1;
	  	jwb = $("input[name='jawaban["+nosoal+"]']");
	  	if (keyCode==37) {
	  		$("#prev").click();
	  	} else if(keyCode==39) {
	  		$("#next").click();
	  	} else if(keyCode==65 || keyCode==97){ 
	  		$(jwb[0]).prop('checked', true);
	  	} else if(keyCode==66 || keyCode==98){
	  		$(jwb[1]).prop('checked', true);
	  	} else if(keyCode==67 || keyCode==99){
	  		$(jwb[2]).prop('checked', true);
	  	} else if(keyCode==68 || keyCode==100){
	  		$(jwb[3]).prop('checked', true);
	  	} else if(keyCode==69 || keyCode==101){
	  		$(jwb[4]).prop('checked', true);
	  	}
	}

	function cekjawaban(no){
		var r = false;
		jwb = $("input[name='jawaban["+(no)+"]']");
		for (var i = 0; i < jwb.length; i++) {
			if(jwb[i].checked){
				r = true;
			}
		}
		return r;
	}

	function cekAllJawaban(){
		btn = $("#navsoal .btn-soal");
		jml = btn.length;
		for (var i = 0; i < btn.length; i++) {
			if(cekjawaban(i)){
				$(btn[i]).removeClass("btn-default").addClass("btn-success");
				jml--;
			} else {
				$(btn[i]).removeClass("btn-success").addClass("btn-default");
			}
		}
		$("#soalBJ").text(jml);
	}

	$("body").onload = CreateTimer("timer", 3600); 
	$(function(){
		var no = $("#noSoal").html();
		var soal = $(".soal" );
	  	nosoal = parseInt(no);
		$(soal).hide();
		$(soal[nosoal-1]).show();
		bsoal = $('.btn-soal');
		$(bsoal).removeClass("btn-danger");
		$(bsoal).removeClass("btn-success");
		$(bsoal).addClass("btn-default");
		$(bsoal[nosoal-1]).addClass("btn-danger");
	});

	$("#next").click(function() {
	  var no = $("#noSoal").html();
	  var total = $("#totalSoal").html();
	  	  nosoal = parseInt(no);
	  	  totsoal = parseInt(total);
	  if (nosoal<totsoal) {
		  nosoal++;
		  var soal = $(".soal" );
		  $(soal).hide();
		  $(soal[nosoal-1]).show();

		  bsoal = $('.btn-soal');
		  $(bsoal).removeClass("btn-danger");
		  $(bsoal).addClass("btn-default");
		  $(bsoal[nosoal-1]).addClass("btn-danger");

		  cekAllJawaban();

		  var persen = nosoal/totsoal*100; 
		  $(".progress-bar").css("width",persen+"%");
		  if (nosoal>1) {
		  	$("#prev").show();
		  } else {
		  	$("#prev").hide();
		  }
		  if (nosoal>=totsoal) {
		  	$("#next").hide();
		  } else {
		  	$("#next").show();
		  }
		  $("#progres").html(persen+"% Complete (success)");
		  document.getElementById("noSoal").innerHTML = nosoal;
	  };
	});

	$("#prev").click(function() {
	  var no = $("#noSoal").html();
	  var total = $("#totalSoal").html();
	  	  nosoal = parseInt(no);
	  	  totsoal = parseInt(total);
	  if (nosoal>1) {
		  nosoal--;
		  var soal = $(".soal" );
		  $(soal).hide();
		  $(soal[nosoal-1]).show();

		  bsoal = $('.btn-soal');
		  $(bsoal).removeClass("btn-danger");
		  $(bsoal).addClass("btn-default");
		  $(bsoal[nosoal-1]).addClass("btn-danger");
		  
		  cekAllJawaban();

		  var persen = nosoal/totsoal*100; 
		  $(".progress-bar").css("width",persen+"%");
		  if (nosoal>1) {
		  	$("#prev").show();
		  } else {
		  	$("#prev").hide();
		  }
		  if (nosoal>=totsoal) {
		  	$("#next").hide();
		  } else {
		  	$("#next").show();
		  }
		  $("#progres").html(persen+"% Complete (success)");
		  document.getElementById("noSoal").innerHTML = nosoal;
	  };
	});

	$("#final").click(function() {
		$("#next").hide();
		$("#prev").hide();
		$(".soal").hide();
		$("#navsoal").hide();
		CreateTimer("timer", 0);
		Cookies.remove("time");
		return true;
	});

	$(".btn-soal").click(function() { 
		var no = $(this).val();
		var total = $("#totalSoal").html();
	  	  nosoal = parseInt(no);
	  	  totsoal = parseInt(total);
		  var soal = $(".soal" );
		  $(soal).hide();
		  $(soal[nosoal-1]).show();

		  bsoal = $('.btn-soal');
		  $(bsoal).removeClass("btn-danger");
		  $(bsoal).addClass("btn-default");
		  $(bsoal[nosoal-1]).addClass("btn-danger");
		  
		  cekAllJawaban();

		  var persen = nosoal/totsoal*100; 
		  $(".progress-bar").css("width",persen+"%");
		  if (nosoal>1) {
		  	$("#prev").show();
		  } else {
		  	$("#prev").hide();
		  }
		  if (nosoal>=totsoal) {
		  	$("#next").hide();
		  } else {
		  	$("#next").show();
		  }
		  $("#progres").html(persen+"% Complete (success)");
		  document.getElementById("noSoal").innerHTML = nosoal;
	});

	function dialog(message) {
	    $('.title').html(message);
	    $('#myModal').modal('show');
	    var ret = false;
	    $('#btnYes').click(function() {
	        $('#myModal').modal('hide');
	        ret = true;
	    });
	    $('#btnNo').click(function() {
	        $('#myModal').modal('hide');
	        ret = false;
	    });
	    return ret;
	}

	function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };
	$(document).on("keydown", disableF5);

</script>
