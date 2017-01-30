<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="logo"></div>
    <div class="logouty" style="background-image: url('<?php echo base_url().index_page(); ?>image/logo1.png/60');"></div>
    <div class="header">
        <div class="title"><a href="<?php echo site_url() ?>admin">PADIMAS</a>  <small class="hidden-xs hidden-sm hidden-md" style="font-size: 20px; font-weight:normal;">Portal Admisi Mahasiswa</small></div>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-key fa-fw"></i> Ganti Sandi</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url().index_page().'admin/logout' ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
</nav>
<div class="navbar-default" role="navigation">
    <div class="menu-atas-container navbar-collapse">
    <?php echo $menu; /*
        <!--  
        <br>
        <?php  switch ($this->session->userdata('role')) {
            case 'super_admin':
        ?>
        <ul class="nav navbar-top-links navbar-left">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Post </a>
              <ul class="dropdown-menu multi-level">
                <li class="dropdown-submenu">
                    <a href="#">Artikel</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/artikel">Semua Artikel</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/artikel/baru">Tambah Artikel</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/kategori">Kategori</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/tag">Tag</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="#">Halaman</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/halaman">Semua Halaman</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/halaman/baru">Tambah Halaman</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="#">Program</a>
                    <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url().index_page(); ?>admin/program">Semua Program</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().index_page(); ?>admin/program/baru">Tambah Program</a>
                    </li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="#">Pengumuman</a>
                    <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url().index_page(); ?>admin/pengumuman">Semua Pengumuman</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().index_page(); ?>admin/pengumuman/baru">Tambah Pengumuman</a>
                    </li>
                    </ul>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Soal Tes </a>
              <ul class="dropdown-menu multi-level">
                        <li>
                            <a href="<?php echo base_url().index_page() ?>admin/test/jenis_test">Jenis Tes</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page() ?>admin/test/kategori">Kategori Soal Tes</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page() ?>admin/test/soal_tpa">Soal Test TPA</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page() ?>admin/test/wawancara">Test Wawancara</a>
                        </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-spin fa-gear"></i> Pengaturan </a>
              <ul class="dropdown-menu multi-level">
				<li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/umum">Konfigurasi Umum</a>
                </li>
                <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/jenis_beasiswa">Jenis Beasiswa</a>
                </li>
                 <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/setup_gelombang">Gelombang Pendaftaran</a>
                </li>
                <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/format_nomor">Format Nomor Pendaftaran</a>
                </li>
                 <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/src_info">Sumber Informasi</a>
                </li>
                 <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/syarat_her">Syarat Her-Registrasi</a>
                </li>
                <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/program_studi">Program Studi</a>
                </li>
                <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/biaya">Biaya</a>
                </li>      
                <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/user">Daftar Pengguna</a>
                </li>
                <li>
                    <a href="<?php echo base_url().index_page() ?>admin/menu"> Menus</a>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pendaftaran </a>
              <ul class="dropdown-menu multi-level"> 
                <li class="dropdown-submenu">
                    <a href="#">Bayar Pendaftaran</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran">Pendaftaran Baru</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/edit">Edit Pendaftaran</a>
                        </li>
                    </ul>
                </li>
                <li>  
                    <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/validasi">Data Pendaftar</a>
                </li>
                <li>  
                    <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/her_registrasi">Her Registrasi</a>
                </li>
				<li>  
                    <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/bayar_her">Bayar Her Registrasi</a>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data </a>
              <ul class="dropdown-menu multi-level"> 
                <li>
                    <a href="<?php echo base_url().index_page(); ?>admin/data/pendaftar_harian">Pendaftar Harian</a>
                </li>
                <li>
                    <a href="<?php echo base_url().index_page(); ?>admin/data/pendaftar_bulanan">Pendaftar Bulanan</a>
                </li>
				<li>
                    <a href="<?php echo base_url().index_page(); ?>admin/data/rasio_bulanan">Pendaftar dan Her-Registrasi Bulanan</a>
                </li>
                <li>
                    <a href="#">Sebaran Asal Sekolah</a>
                </li>
                <li>
                    <a href="#">Sebaran Daerah Sekolah</a>
                </li> 
                <li class="dropdown-submenu">
                    <a href="#">Laporan PMB</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/export">Lap Pendaftar</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/laporan">Lap Rekomendasi</a>
                        </li>
						<li>
                            <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/excel/rekappmb">Rekap PMB</a>
                        </li>
                    </ul>
                </li>               
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hapus / Edit Data </a>
              <ul class="dropdown-menu multi-level">
                <li>
					<a href="<?php echo base_url().index_page() ?>admin/pendaftaran/ubahnim">Ubah NIM</a>
				</li>
				<li>
					<a href="<?php echo base_url().index_page() ?>admin/pendaftaran/ubahspa">Ubah SPA</a>
				</li>
				<li>
					<a href="<?php echo base_url().index_page() ?>admin/test/resetjwbtpamhs">Hapus Tes TPA</a>
				</li>
				<li>
					<a href="<?php echo base_url().index_page() ?>admin/pendaftaran/hapusher">Hapus Her-Registrasi</a>
				</li>
              </ul>
            </li>
        </ul>
        <?php
                break;

            case 'admin':
        ?>
        <ul class="nav navbar-top-links navbar-left">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Post </a>
              <ul class="dropdown-menu multi-level">
                <li class="dropdown-submenu">
                    <a href="#">Artikel</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/artikel">Semua Artikel</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/artikel/baru">Tambah Artikel</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/kategori">Kategori</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/tag">Tag</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="#">Halaman</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/halaman">Semua Halaman</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/halaman/baru">Tambah Halaman</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="#">Program</a>
                    <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url().index_page(); ?>admin/program">Semua Program</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().index_page(); ?>admin/program/baru">Tambah Program</a>
                    </li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="#">Pengumuman</a>
                    <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url().index_page(); ?>admin/pengumuman">Semua Pengumuman</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().index_page(); ?>admin/pengumuman/baru">Tambah Pengumuman</a>
                    </li>
                    </ul>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Soal Tes </a>
              <ul class="dropdown-menu multi-level">
                        <li>
                            <a href="<?php echo base_url().index_page() ?>admin/test/jenis_test">Jenis Tes</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page() ?>admin/test/kategori">Kategori Soal Tes</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page() ?>admin/test/soal_tpa">Soal Test TPA</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page() ?>admin/test/wawancara">Test Wawancara</a>
                        </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-spin fa-gear"></i> Pengaturan </a>
              <ul class="dropdown-menu multi-level">
                <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/umum">Konfigurasi Umum</a>
                </li>
				<li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/jenis_beasiswa">Jenis Beasiswa</a>
                </li>
                 <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/setup_gelombang">Gelombang Pendaftaran</a>
                </li>
                <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/format_nomor">Format Nomor Pendaftaran</a>
                </li>
                 <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/src_info">Sumber Informasi</a>
                </li>
                 <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/syarat_her">Syarat Her-Registrasi</a>
                </li>
                <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/program_studi">Program Studi</a>
                </li>
                <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/biaya">Biaya</a>
                </li>                   
                <li>
                    <a href="<?php echo base_url().index_page() ?>admin/konfigurasi/user">Daftar Pengguna</a>
                </li>
                <li>
                    <a href="<?php echo base_url().index_page() ?>admin/menu"> Menus</a>
                </li> 
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data </a>
              <ul class="dropdown-menu multi-level"> 
                <li>
                    <a href="<?php echo base_url().index_page(); ?>admin/data/pendaftar_harian">Pendaftar Harian</a>
                </li>
                <li>
                    <a href="<?php echo base_url().index_page(); ?>admin/data/pendaftar_bulanan">Pendaftar Bulanan</a>
                </li>
				<li>
                    <a href="<?php echo base_url().index_page(); ?>admin/data/rasio_bulanan">Pendaftar dan Her-Registrasi Bulanan</a>
                </li>
                <li>
                    <a href="#">Sebaran Asal Sekolah</a>
                </li>
                <li>
                    <a href="#">Sebaran Daerah Sekolah</a>
                </li> 
                <li class="dropdown-submenu">
                    <a href="#">Laporan PMB</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/export">Lap Pendaftar</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/laporan">Lap Rekomendasi</a>
                        </li>
						<li>
                            <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/excel/rekappmb">Rekap PMB</a>
                        </li>
                    </ul>
                </li>               
              </ul>
            </li>
			<li>
				<a href="<?php echo base_url().index_page() ?>admin/pendaftaran/ubahspa">Ubah SPA</a>
			</li>
        </ul>
        <?php
                break;

            case 'operator':
        ?>
        <ul class="nav navbar-top-links navbar-left">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pendaftaran </a>
              <ul class="dropdown-menu multi-level"> 
                <li class="dropdown-submenu">
                    <a href="#">Bayar Pendaftaran</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran">Pendaftaran Baru</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/edit">Edit Pendaftaran</a>
                        </li>
                    </ul>
                </li>
                <li>  
                    <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/validasi">Data Pendaftar</a>
                </li>
                <li>  
                    <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/bayar_her">Bayar Her Registrasi</a>
                </li>
                <li>  
                    <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/her_registrasi">Her Registrasi</a>
                </li>
                <?php if ($this->session->userdata('user')=="sandra" || $this->session->userdata('user')=="rika"): ?>
                <li>  
                    <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/cetak_surat">Cetak Laporan</a>
                </li>
                <?php endif ?>
              </ul>
            </li>
        </ul>
        <?php
                break;
            case 'rektor':
        ?>
        <ul class="nav navbar-top-links navbar-left">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data </a>
              <ul class="dropdown-menu multi-level"> 
                <li>
                    <a href="<?php echo base_url().index_page(); ?>admin/data/pendaftar_harian">Pendaftar Harian</a>
                </li>
                <li>
                    <a href="<?php echo base_url().index_page(); ?>admin/data/pendaftar_bulanan">Pendaftar Bulanan</a>
                </li>
                <li>
                    <a href="#">Sebaran Asal Sekolah</a>
                </li>
                <li>
                    <a href="#">Sebaran Daerah Sekolah</a>
                </li> 
                <li class="dropdown-submenu">
                    <a href="#">Laporan PMB</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/export">Lap Pendaftar</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/laporan">Lap Rekomendasi</a>
                        </li>
						<li>
                            <a href="<?php echo base_url().index_page(); ?>admin/pendaftaran/excel/rekappmb">Rekap PMB</a>
                        </li>
                    </ul>
                </li>               
              </ul>
            </li>
        </ul>
        <?php
                break;
            case 'pewawancara':
        ?>
        <ul class="nav navbar-top-links navbar-left">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Soal Tes </a>
              <ul class="dropdown-menu multi-level">
                        <li>
                            <a href="<?php echo base_url().index_page() ?>admin/test/wawancara">Test Wawancara</a>
                        </li>
              </ul>
            </li>
        </ul>
        <?php
                break;
            default:
                redirect("admin/logout");
                break;
        } ?> 
         -->*/
         ?>
    </div>
</div>
