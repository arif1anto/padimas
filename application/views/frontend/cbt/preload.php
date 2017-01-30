

<div class="container">
	<div class="visible-xs">
		<div class="alert alert-warning">
			<b>Gunakan Tablet atau Desktop untuk mengerjakan <strong>Test Potensi Akademik</strong></b>
		</div>
	</div>
	<div class="col-lg-offset-1 col-lg-10 hidden-xs">
        <div class="detail" style="min-height: 271px;">
            <div class="detail-heading">
                <h1 class="page-header">Test Potensi Akademik PMB UTY <?php echo date('Y') ?></h1>
            </div>
            <div class="detail-body">
				<?php if ($data2[0]->jml_soal>0) { ?>
				<p>Anda telah menyelesaikan <strong>Test Potensi Akademik</strong> PMB UTY Tahun <?php echo date('Y') ?>.</p>
				
				<!-- <ul>
					<li>Jumlah Soal Dijawab : <strong><?php //echo $data2[0]->dijawab.' dari '.$data2[0]->jml_soal.' soal' ?></strong></li>
					<li>Jawaban Benar : <strong><?php //echo $data2[0]->benar ?></strong></li>
					<li>Jawaban Salah : <strong><?php //echo $data2[0]->dijawab-$data2[0]->benar ?></strong></li>
					<li>Tidak Dijawab : <strong><?php //echo $data2[0]->jml_soal-$data2[0]->dijawab ?></strong></li>
					<li>Skor : <strong><?php //echo $data2[0]->skor==null?'0':$data2[0]->skor; ?></strong></li>
					<li>Presentase : <strong><?php //echo round(($data2[0]->skor/(10*$data2[0]->jml_soal))*100,2); ?>%</strong></li>
				</ul> -->
				<p>Silakan menunggu giliran Tes Wawancara pada ruangan yang telah disediakan.</p>
				<?php } else { ?>
				<strong>Aturan Main</strong>
				<ol style="text-justify">
					<li>Soal berupa pilihan ganda.</li>
					<li>Soal terdiri dari beberapa kategori.</li>
					<li>Setiap kategori soal memiliki total nilai dan jumlah soal tertentu.</li>
					<li>Waktu mengerjakan soal dimulai setelah anda mengklik tombol "Mulai Mengerjakan".</li>
					<!-- <li>Anda disarankan untuk mengklik tombol simpan minimal setiap 5 menit, untuk mengantisipasi jika sewaktu-waktu listrik mati, maka hasil tes anda sudah tersimpan.</li> -->
					<li>Jika anda sudah selesai mengerjakan sebelum waktu berakhir, maka klik tombol selesai untuk keluar dari halaman tes TPA</li>
					<!-- <li>Pada saat 5 menit waktu yang tersisa untuk mengerjakan, maka akan ditampilkan pesan peringatan.</li> -->
					<li>Sisa waktu mengerjakan dan jumlah soal yang belum terjawab ditampilkan pada panel sebelah kanan soal</li>
					<li>Di bagian bawah soal terdapat navigasi soal dari nomor 1 sampai 45, keterangan warnanya sebagai berikut: 
					<br>warna <span class="label label-danger">Merah</span> menunjukan soal yang sedang ditampilkan 
					<br>warna <span class="label" style="background: #090909">Hitam</span> menunjukan soal yang belum dijawab
					<br>warna <span class="label label-success">Hijau</span> menunjukan soal yang sudah dijawab</li>
					<li>Jika waktu sudah habis dan anda belum selesai mengerjakan, maka sistem akan langsung menutup halaman kerja anda dan logout. Namun anda jangan khawatir, karena sebelum logout, sistem sudah terlebih dahulu menyimpan pekerjaan anda ke database.</li>
					<li>Jangan klik SELESAI sebelum anda benar-benar yakin telah menyelesaikan tes ini.</li>
				</ol>
				<hr/>
				<p class="text-center">
					<a href="<?php echo base_url().index_page().'maba/test/mulai' ?>" class="btn btn-lg btn-danger">Mulai Mengerjakan</a>
				</p>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

