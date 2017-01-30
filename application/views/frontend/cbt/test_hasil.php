
<div class="container" style="margin-top:100px;">
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
				<div class="col-lg-offset-1 col-lg-10">
			        <div class="detail">
			            <div class="detail-heading">
			                <h1 class="page-header">Hasil Test Potensi Akademik <small>PMB UTY <?php echo date('Y') ?></small></h1>
			            </div>
			            <div class="detail-body">
							<p>Anda telah menyelesaikan Test Potensi Akademik PMB UTY Tahun <?php echo date('Y') ?>.</p>
							<!-- <p>Hasil tes Anda adalah:</p>
							<ul>
								<li>Jumlah Soal Dijawab : <strong><?php //echo $data2[0]->dijawab.' dari '.$data2[0]->jml_soal.' soal' ?></strong></li>
								<li>Jawaban Benar : <strong><?php //echo $data2[0]->benar ?></strong></li>
								<li>Jawaban Salah : <strong><?php //echo $data2[0]->dijawab-$data2[0]->benar ?></strong></li>
								<li>Tidak Dijawab : <strong><?php //echo $data2[0]->jml_soal-$data2[0]->dijawab ?></strong></li>
								<li>Skor : <strong><?php //echo $data2[0]->skor==null?'0':$data2[0]->skor; ?></strong></li>
								<li>Prosentase : <strong><?php //echo round(($data2[0]->skor/(10*$data2[0]->jml_soal))*100,2); ?>%</strong></li>
							</ul> -->
							<p>Silakan menunggu giliran Tes Wawancara pada ruangan yang telah disediakan.</p>
							<p>Halaman ini akan logout secara otomatis dalam waktu <strong><span id="logout">10</span> detik</strong></p>
							<br/>
							<div class="progress">
							  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
								<span class="sr-only" id="progres">100% Complete (success)</span>
							  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	function CreateTimer(e,t){
		Timer=document.getElementById(e);
		TotalSeconds=t;
		UpdateTimer();
		window.setTimeout("Tick()",1e3);
	}
	function Tick(){
		if(TotalSeconds<=0){
			window.location="<?php echo base_url().index_page().'maba/logout'?>";
			return true;
		}
		TotalSeconds-=1;
		UpdateTimer();
		window.setTimeout("Tick()",1e3)
	}
	function UpdateTimer(){
		var e=TotalSeconds;
		var t=Math.floor(e/86400);
		e-=t*86400;
		var n=Math.floor(e/3600);
		e-=n*3600;
		var r=Math.floor(e/60);
		e-=r*60;
		var i=(t>0?t+" days ":"")+(n>0?LeadingZero(n)+":":"")+(r>0?LeadingZero(r)+":":"")+(e);
		Timer.innerHTML=i;
	}
	function LeadingZero(e){
		return e<10?"0"+e:+e
	}
	var Timer;var TotalSeconds;

	window.onload = function() {
		CreateTimer("logout",10);
	};
</script>