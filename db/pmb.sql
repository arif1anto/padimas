-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.11 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for pmb
CREATE DATABASE IF NOT EXISTS `pmb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pmb`;


-- Dumping structure for table pmb.hps_pmb_herregistrasi
CREATE TABLE IF NOT EXISTS `hps_pmb_herregistrasi` (
  `id_daftar` varchar(15) NOT NULL,
  `tgl_herregistrasi` datetime DEFAULT NULL,
  `nim` varchar(10) DEFAULT NULL,
  `ukuran_jaz` varchar(5) DEFAULT NULL,
  `kelas` char(1) DEFAULT NULL,
  `angkatan` year(4) DEFAULT NULL,
  `id_user` varchar(15) DEFAULT NULL,
  `tgl_hapus` datetime DEFAULT NULL,
  PRIMARY KEY (`id_daftar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pmb.hps_pmb_herregistrasi: 0 rows
/*!40000 ALTER TABLE `hps_pmb_herregistrasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `hps_pmb_herregistrasi` ENABLE KEYS */;


-- Dumping structure for table pmb.hps_pmb_testpa
CREATE TABLE IF NOT EXISTS `hps_pmb_testpa` (
  `id_testpa` int(11) NOT NULL AUTO_INCREMENT,
  `id_daftar` varchar(15) DEFAULT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `id_jawaban` int(11) DEFAULT NULL,
  `tgl_tes` date DEFAULT NULL,
  `tgl_hapus` datetime DEFAULT NULL,
  PRIMARY KEY (`id_testpa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table pmb.hps_pmb_testpa: ~0 rows (approximately)
/*!40000 ALTER TABLE `hps_pmb_testpa` DISABLE KEYS */;
/*!40000 ALTER TABLE `hps_pmb_testpa` ENABLE KEYS */;


-- Dumping structure for table pmb.mst_agama
CREATE TABLE IF NOT EXISTS `mst_agama` (
  `kd_agama` char(1) NOT NULL DEFAULT '' COMMENT 'PK kode agama dari tabel agama',
  `nama` varchar(20) NOT NULL DEFAULT '' COMMENT 'nama-nama agama',
  PRIMARY KEY (`kd_agama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel Agama';

-- Dumping data for table pmb.mst_agama: ~6 rows (approximately)
/*!40000 ALTER TABLE `mst_agama` DISABLE KEYS */;
INSERT IGNORE INTO `mst_agama` (`kd_agama`, `nama`) VALUES
	('1', 'Islam'),
	('2', 'Kristen Protestan'),
	('3', 'Kristen Katholik'),
	('4', 'Hindu'),
	('5', 'Budha'),
	('6', 'Konghucu');
/*!40000 ALTER TABLE `mst_agama` ENABLE KEYS */;


-- Dumping structure for table pmb.mst_fakultas
CREATE TABLE IF NOT EXISTS `mst_fakultas` (
  `kd_fakultas` int(5) NOT NULL AUTO_INCREMENT COMMENT 'PK kode fakultas (auto inc)',
  `nama_fakultas` varchar(100) NOT NULL COMMENT 'nama fakultas',
  `tglbentuk` date DEFAULT NULL COMMENT 'tanggal fakultas terbentuk',
  `no_sk` varchar(45) DEFAULT NULL COMMENT 'no sk fakultas',
  `alamat` varchar(100) DEFAULT NULL COMMENT 'alamat fakultas',
  `kec_fakultas` varchar(20) DEFAULT NULL COMMENT 'kecamatan fakultas',
  `kab_fakultas` varchar(5) DEFAULT NULL COMMENT 'kabupaten fakultas',
  `telp_fakultas` varchar(30) DEFAULT NULL COMMENT 'no telpon fakultas',
  `faximile` varchar(30) DEFAULT NULL COMMENT 'no faximile fakultas',
  `email` varchar(45) DEFAULT NULL COMMENT 'alamat email fakultas',
  `website` varchar(50) DEFAULT NULL COMMENT 'alamat website fakultas',
  `kd_pos` varchar(10) DEFAULT NULL COMMENT 'kd_pos fakultas',
  `kd_universitas` int(5) NOT NULL COMMENT 'FK kode universitas referensi tabel universitas',
  PRIMARY KEY (`kd_fakultas`),
  KEY `kd_universitas_idx` (`kd_universitas`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='tabel data fakultas';

-- Dumping data for table pmb.mst_fakultas: ~1 rows (approximately)
/*!40000 ALTER TABLE `mst_fakultas` DISABLE KEYS */;
INSERT IGNORE INTO `mst_fakultas` (`kd_fakultas`, `nama_fakultas`, `tglbentuk`, `no_sk`, `alamat`, `kec_fakultas`, `kab_fakultas`, `telp_fakultas`, `faximile`, `email`, `website`, `kd_pos`, `kd_universitas`) VALUES
	(1, 'Teknik', '2002-10-23', '256', 'Jl. Glagah Sari No. 63', 'Gamping', '00004', '(0274) 373955', '(0274) 381212', 'info@uty.ac.id', 'www.uty.ac.id', '55164', 1);
/*!40000 ALTER TABLE `mst_fakultas` ENABLE KEYS */;


-- Dumping structure for table pmb.mst_jenjang
CREATE TABLE IF NOT EXISTS `mst_jenjang` (
  `kd_jenjang` int(5) NOT NULL AUTO_INCREMENT COMMENT 'menyimpan data kode jenjang',
  `nama_jenjang` varchar(45) NOT NULL COMMENT 'menyimpan data nama jenjang',
  PRIMARY KEY (`kd_jenjang`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='tabel data jenjang perkuliahan';

-- Dumping data for table pmb.mst_jenjang: ~9 rows (approximately)
/*!40000 ALTER TABLE `mst_jenjang` DISABLE KEYS */;
INSERT IGNORE INTO `mst_jenjang` (`kd_jenjang`, `nama_jenjang`) VALUES
	(1, 'D1'),
	(2, 'D2'),
	(3, 'D3'),
	(4, 'D4'),
	(5, 'S1'),
	(6, 'S2'),
	(7, 'S3'),
	(8, 'Profesi'),
	(9, 'Kursus');
/*!40000 ALTER TABLE `mst_jenjang` ENABLE KEYS */;


-- Dumping structure for table pmb.mst_jurusan
CREATE TABLE IF NOT EXISTS `mst_jurusan` (
  `kd_jurusan` int(5) NOT NULL COMMENT 'menyimpan data kode jurusan',
  `nama_jurusan` varchar(45) NOT NULL COMMENT 'menyimpan data nama jurusan ',
  `tglbentuk` date DEFAULT NULL COMMENT 'menyimpan data tanggal Fakultas dibentuk.',
  `no_sk` varchar(45) DEFAULT NULL COMMENT 'menyimpan data nomor SK pembentukan',
  `inisial` char(4) DEFAULT NULL COMMENT 'menyimpan data inisial dari jurusan',
  `kd_fakultas` int(5) NOT NULL COMMENT 'FK menyimpan data kode fakultas referensi tabel fakultas',
  PRIMARY KEY (`kd_jurusan`,`kd_fakultas`),
  KEY `kd_fakultas_idx` (`kd_fakultas`),
  CONSTRAINT `kd_fakultas_jur` FOREIGN KEY (`kd_fakultas`) REFERENCES `mst_fakultas` (`kd_fakultas`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabel data jurusan';

-- Dumping data for table pmb.mst_jurusan: ~2 rows (approximately)
/*!40000 ALTER TABLE `mst_jurusan` DISABLE KEYS */;
INSERT IGNORE INTO `mst_jurusan` (`kd_jurusan`, `nama_jurusan`, `tglbentuk`, `no_sk`, `inisial`, `kd_fakultas`) VALUES
	(1, 'Informatika', '2002-10-23', NULL, 'INF', 1),
	(2, 'Ilmu Komunikasi', '2002-10-23', NULL, 'ILK', 1);
/*!40000 ALTER TABLE `mst_jurusan` ENABLE KEYS */;


-- Dumping structure for table pmb.mst_kecamatan
CREATE TABLE IF NOT EXISTS `mst_kecamatan` (
  `kd_kecamatan` varchar(6) NOT NULL DEFAULT '',
  `nama_kecamatan` varchar(100) NOT NULL DEFAULT '',
  `kd_kota` char(6) NOT NULL DEFAULT '',
  PRIMARY KEY (`kd_kecamatan`),
  KEY `kd_kecamatan_idx` (`kd_kecamatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel Kota';

-- Dumping data for table pmb.mst_kecamatan: ~15 rows (approximately)
/*!40000 ALTER TABLE `mst_kecamatan` DISABLE KEYS */;
INSERT IGNORE INTO `mst_kecamatan` (`kd_kecamatan`, `nama_kecamatan`, `kd_kota`) VALUES
	('046001', 'Kec. Mantrijeron', '046000'),
	('046002', 'Kec. Kraton', '046000'),
	('046003', 'Kec. Mergangsan', '046000'),
	('046004', 'Kec. Umbulharjo', '046000'),
	('046005', 'Kec. Kotagede', '046000'),
	('046006', 'Kec. Gondokusuman', '046000'),
	('046007', 'Kec. Danurejan', '046000'),
	('046008', 'Kec. Pakualaman', '046000'),
	('046009', 'Kec. Gondomanan', '046000'),
	('046010', 'Kec. Ngampilan', '046000'),
	('046011', 'Kec. Wirobrajan', '046000'),
	('046012', 'Kec. Gedongtengen', '046000'),
	('046013', 'Kec. Jetis', '046000'),
	('046014', 'Kec. Tegalrejo', '046000'),
	('046015', 'Kec. Gamping', '046000');
/*!40000 ALTER TABLE `mst_kecamatan` ENABLE KEYS */;


-- Dumping structure for table pmb.mst_kota
CREATE TABLE IF NOT EXISTS `mst_kota` (
  `kd_kota` varchar(6) NOT NULL DEFAULT '',
  `nama_kota` varchar(100) NOT NULL DEFAULT '',
  `kd_propinsi` char(6) NOT NULL DEFAULT '',
  PRIMARY KEY (`kd_kota`),
  KEY `kd_propinsi_idx` (`kd_propinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel Kota';

-- Dumping data for table pmb.mst_kota: ~1 rows (approximately)
/*!40000 ALTER TABLE `mst_kota` DISABLE KEYS */;
INSERT IGNORE INTO `mst_kota` (`kd_kota`, `nama_kota`, `kd_propinsi`) VALUES
	('046000', 'Kota Yogyakarta', '040000');
/*!40000 ALTER TABLE `mst_kota` ENABLE KEYS */;


-- Dumping structure for table pmb.mst_proditawar
CREATE TABLE IF NOT EXISTS `mst_proditawar` (
  `kd_proditawar` int(5) NOT NULL AUTO_INCREMENT COMMENT 'PK kode prodi tawar (auto inc)',
  `kd_fakultas` int(5) NOT NULL COMMENT 'FK kode fakultas referensi tabel fakultas',
  `kd_jurusan` int(5) NOT NULL COMMENT 'FK kode jurusan referensi tabel jurusan',
  `kd_program` int(5) NOT NULL COMMENT 'FK kode program referensi tabel program',
  `kd_status` int(5) NOT NULL COMMENT 'FK kode status referensi tabel status',
  `kd_jenjang` int(5) NOT NULL COMMENT 'FK kode jenjang referensi tabel jenjang',
  `prodi_status` varchar(50) NOT NULL COMMENT 'status akreditasi prodi',
  PRIMARY KEY (`kd_proditawar`),
  KEY `kd_fakultas_idx` (`kd_fakultas`),
  KEY `kd_jurusan_idx` (`kd_jurusan`),
  KEY `kd_program_idx` (`kd_program`),
  KEY `kd_status_idx` (`kd_status`),
  KEY `kd_jenjang_idx` (`kd_jenjang`),
  CONSTRAINT `kd_fakultas_proditw` FOREIGN KEY (`kd_fakultas`) REFERENCES `mst_fakultas` (`kd_fakultas`) ON UPDATE CASCADE,
  CONSTRAINT `kd_jenjang_proditw` FOREIGN KEY (`kd_jenjang`) REFERENCES `mst_jenjang` (`kd_jenjang`) ON UPDATE CASCADE,
  CONSTRAINT `kd_jurusan_proditw` FOREIGN KEY (`kd_jurusan`) REFERENCES `mst_jurusan` (`kd_jurusan`) ON UPDATE CASCADE,
  CONSTRAINT `kd_program_proditw` FOREIGN KEY (`kd_program`) REFERENCES `mst_program` (`kd_program`) ON UPDATE CASCADE,
  CONSTRAINT `kd_status_proditw` FOREIGN KEY (`kd_status`) REFERENCES `mst_status` (`kd_status`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='setup data prodi yang ditawarkan';

-- Dumping data for table pmb.mst_proditawar: ~5 rows (approximately)
/*!40000 ALTER TABLE `mst_proditawar` DISABLE KEYS */;
INSERT IGNORE INTO `mst_proditawar` (`kd_proditawar`, `kd_fakultas`, `kd_jurusan`, `kd_program`, `kd_status`, `kd_jenjang`, `prodi_status`) VALUES
	(2, 1, 1, 1, 1, 5, 'Terakreditasi A'),
	(3, 1, 1, 1, 2, 5, 'Terakreditasi A'),
	(4, 1, 2, 1, 1, 5, 'Terakreditasi A'),
	(5, 1, 2, 1, 2, 5, 'Terakreditasi A'),
	(6, 1, 2, 1, 1, 6, 'Terakreditasi A');
/*!40000 ALTER TABLE `mst_proditawar` ENABLE KEYS */;


-- Dumping structure for table pmb.mst_program
CREATE TABLE IF NOT EXISTS `mst_program` (
  `kd_program` int(5) NOT NULL AUTO_INCREMENT COMMENT 'PK kode program (auto inc)',
  `nama_program` varchar(20) NOT NULL COMMENT 'nama program',
  PRIMARY KEY (`kd_program`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='tabel data program (sami, reguler, khusus dll)';

-- Dumping data for table pmb.mst_program: ~4 rows (approximately)
/*!40000 ALTER TABLE `mst_program` DISABLE KEYS */;
INSERT IGNORE INTO `mst_program` (`kd_program`, `nama_program`) VALUES
	(1, 'Pagi'),
	(2, 'Sore'),
	(3, 'Sami'),
	(4, 'Khusus');
/*!40000 ALTER TABLE `mst_program` ENABLE KEYS */;


-- Dumping structure for table pmb.mst_propinsi
CREATE TABLE IF NOT EXISTS `mst_propinsi` (
  `kd_propinsi` char(6) NOT NULL DEFAULT '' COMMENT 'menyimpan data kode provinsi',
  `nama_propinsi` varchar(50) NOT NULL DEFAULT '' COMMENT 'menyimpan data nama provinsi',
  `kd_negara` char(6) NOT NULL DEFAULT '' COMMENT 'menyimpan data kode negara',
  PRIMARY KEY (`kd_propinsi`),
  KEY `kd_negara_idx` (`kd_negara`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel Propinsi';

-- Dumping data for table pmb.mst_propinsi: ~1 rows (approximately)
/*!40000 ALTER TABLE `mst_propinsi` DISABLE KEYS */;
INSERT IGNORE INTO `mst_propinsi` (`kd_propinsi`, `nama_propinsi`, `kd_negara`) VALUES
	('040000', 'Prop. D.I. Yogyakarta', '010000');
/*!40000 ALTER TABLE `mst_propinsi` ENABLE KEYS */;


-- Dumping structure for table pmb.mst_sekolah
CREATE TABLE IF NOT EXISTS `mst_sekolah` (
  `kd_sekolah` varchar(12) NOT NULL,
  `nama_sekolah` varchar(100) DEFAULT NULL,
  `stts_sekolah` varchar(6) DEFAULT NULL,
  `alamat_sekolah` varchar(100) DEFAULT NULL,
  `kec_sekolah` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kd_sekolah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.mst_sekolah: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_sekolah` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_sekolah` ENABLE KEYS */;


-- Dumping structure for table pmb.mst_sekolah_tmp
CREATE TABLE IF NOT EXISTS `mst_sekolah_tmp` (
  `kd_sekolah` varchar(12) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='histori penambahan sekolah';

-- Dumping data for table pmb.mst_sekolah_tmp: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_sekolah_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_sekolah_tmp` ENABLE KEYS */;


-- Dumping structure for table pmb.mst_status
CREATE TABLE IF NOT EXISTS `mst_status` (
  `kd_status` int(5) NOT NULL COMMENT 'PK kode status',
  `nama_status` varchar(20) NOT NULL COMMENT 'nama status',
  PRIMARY KEY (`kd_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabel data status(transfer,reguler)';

-- Dumping data for table pmb.mst_status: ~3 rows (approximately)
/*!40000 ALTER TABLE `mst_status` DISABLE KEYS */;
INSERT IGNORE INTO `mst_status` (`kd_status`, `nama_status`) VALUES
	(1, 'Awal'),
	(2, 'Transfer'),
	(3, 'Pindahan');
/*!40000 ALTER TABLE `mst_status` ENABLE KEYS */;


-- Dumping structure for table pmb.mst_stts_sekolah
CREATE TABLE IF NOT EXISTS `mst_stts_sekolah` (
  `id_stts` int(11) DEFAULT NULL,
  `nama_stts` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.mst_stts_sekolah: ~8 rows (approximately)
/*!40000 ALTER TABLE `mst_stts_sekolah` DISABLE KEYS */;
INSERT IGNORE INTO `mst_stts_sekolah` (`id_stts`, `nama_stts`) VALUES
	(1, 'Negeri'),
	(2, 'Swasta'),
	(1, 'Negeri'),
	(2, 'Swasta'),
	(1, 'Negeri'),
	(2, 'Swasta'),
	(1, 'Negeri'),
	(2, 'Swasta');
/*!40000 ALTER TABLE `mst_stts_sekolah` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_artikel
CREATE TABLE IF NOT EXISTS `pmb_artikel` (
  `art_id` int(11) NOT NULL AUTO_INCREMENT,
  `art_judul` varchar(225) DEFAULT NULL,
  `art_content` text,
  `art_author` varchar(10) DEFAULT NULL,
  `art_tgl_terbit` datetime DEFAULT NULL,
  `art_headline` tinyint(1) DEFAULT NULL,
  `art_link` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`art_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_artikel: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_artikel` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_artikel` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_author
CREATE TABLE IF NOT EXISTS `pmb_author` (
  `aut_username` varchar(50) NOT NULL COMMENT 'username',
  `aut_pass` varchar(255) DEFAULT NULL,
  `aut_display_name` varchar(255) DEFAULT NULL,
  `aut_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`aut_username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_author: ~1 rows (approximately)
/*!40000 ALTER TABLE `pmb_author` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_author` (`aut_username`, `aut_pass`, `aut_display_name`, `aut_email`) VALUES
	('admin', 'kuliahjogjaok', 'Kuliah Jogja', 'kuliahjogja@gmail.com');
/*!40000 ALTER TABLE `pmb_author` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_bekerja
CREATE TABLE IF NOT EXISTS `pmb_bekerja` (
  `id_daftar` varchar(10) NOT NULL COMMENT 'nim mahasiswa sebagai PK dan mereferensi ke tabel akd_mahasiswa',
  `instansi` varchar(20) DEFAULT NULL COMMENT 'instansi tempat mahasiswa bekerja',
  `gol` varchar(8) DEFAULT NULL COMMENT 'golongan pekerjaan mahasiswa',
  `jabatan` varchar(100) DEFAULT NULL COMMENT 'jabatan pekerjaan mahasiswa',
  KEY `nim_bekerja_idx` (`id_daftar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel pekerjaan mahasiswa';

-- Dumping data for table pmb.pmb_bekerja: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_bekerja` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_bekerja` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_gelombang
CREATE TABLE IF NOT EXISTS `pmb_gelombang` (
  `gel` char(5) NOT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `tbh_spa` double DEFAULT '0',
  `tbh_spa_transfer` double DEFAULT '0',
  `tbh_spa_alum` double DEFAULT '0',
  PRIMARY KEY (`gel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_gelombang: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_gelombang` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_gelombang` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_group
CREATE TABLE IF NOT EXISTS `pmb_group` (
  `id_hakakses` int(11) NOT NULL,
  `group` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_hakakses`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_group: 8 rows
/*!40000 ALTER TABLE `pmb_group` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_group` (`id_hakakses`, `group`) VALUES
	(1, 'super_admin'),
	(2, 'admin'),
	(3, 'operator'),
	(4, 'rektor'),
	(5, 'pewawancara'),
	(6, 'dekan'),
	(7, 'keuangan'),
	(8, 'cetak laporan');
/*!40000 ALTER TABLE `pmb_group` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_group_menu
CREATE TABLE IF NOT EXISTS `pmb_group_menu` (
  `id_hakakses` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id_hakakses`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_group_menu: 169 rows
/*!40000 ALTER TABLE `pmb_group_menu` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_group_menu` (`id_hakakses`, `menu_id`) VALUES
	(1, 16),
	(1, 17),
	(1, 18),
	(1, 19),
	(1, 20),
	(1, 21),
	(1, 22),
	(1, 23),
	(1, 24),
	(1, 25),
	(1, 26),
	(1, 27),
	(1, 28),
	(1, 29),
	(1, 30),
	(1, 31),
	(1, 32),
	(1, 33),
	(1, 34),
	(1, 35),
	(1, 36),
	(1, 37),
	(1, 38),
	(1, 39),
	(1, 40),
	(1, 41),
	(1, 42),
	(1, 43),
	(1, 44),
	(1, 45),
	(1, 47),
	(1, 48),
	(1, 49),
	(1, 50),
	(1, 51),
	(1, 52),
	(1, 53),
	(1, 54),
	(1, 55),
	(1, 56),
	(1, 57),
	(1, 58),
	(1, 59),
	(1, 60),
	(1, 61),
	(1, 62),
	(1, 63),
	(1, 64),
	(1, 65),
	(1, 66),
	(1, 67),
	(1, 68),
	(1, 69),
	(1, 70),
	(1, 71),
	(2, 16),
	(2, 17),
	(2, 18),
	(2, 19),
	(2, 20),
	(2, 21),
	(2, 22),
	(2, 23),
	(2, 24),
	(2, 25),
	(2, 26),
	(2, 27),
	(2, 28),
	(2, 29),
	(2, 30),
	(2, 31),
	(2, 32),
	(2, 33),
	(2, 34),
	(2, 35),
	(2, 36),
	(2, 37),
	(2, 38),
	(2, 39),
	(2, 40),
	(2, 41),
	(2, 42),
	(2, 43),
	(2, 44),
	(2, 45),
	(2, 47),
	(2, 48),
	(2, 49),
	(2, 50),
	(2, 51),
	(2, 52),
	(2, 53),
	(2, 54),
	(2, 55),
	(2, 56),
	(2, 57),
	(2, 58),
	(2, 59),
	(2, 60),
	(2, 61),
	(2, 62),
	(2, 63),
	(2, 64),
	(2, 65),
	(2, 66),
	(2, 67),
	(2, 68),
	(2, 69),
	(2, 70),
	(2, 71),
	(3, 0),
	(4, 16),
	(4, 17),
	(4, 18),
	(4, 19),
	(4, 20),
	(4, 21),
	(4, 22),
	(4, 23),
	(4, 24),
	(4, 25),
	(4, 26),
	(4, 27),
	(4, 28),
	(4, 29),
	(4, 30),
	(4, 31),
	(4, 32),
	(4, 33),
	(4, 34),
	(4, 35),
	(4, 36),
	(4, 37),
	(4, 38),
	(4, 39),
	(4, 40),
	(4, 41),
	(4, 42),
	(4, 43),
	(4, 44),
	(4, 45),
	(4, 47),
	(4, 48),
	(4, 49),
	(4, 50),
	(4, 51),
	(4, 52),
	(4, 53),
	(4, 54),
	(4, 55),
	(4, 56),
	(4, 57),
	(4, 58),
	(4, 59),
	(4, 60),
	(4, 61),
	(4, 62),
	(4, 63),
	(4, 64),
	(4, 65),
	(4, 66),
	(4, 67),
	(4, 68),
	(4, 69),
	(4, 70),
	(4, 71),
	(5, 0),
	(6, 0),
	(7, 0);
/*!40000 ALTER TABLE `pmb_group_menu` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_hakakses
CREATE TABLE IF NOT EXISTS `pmb_hakakses` (
  `aut_username` varchar(50) NOT NULL,
  `id_hakakses` int(11) NOT NULL,
  PRIMARY KEY (`aut_username`,`id_hakakses`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_hakakses: ~1 rows (approximately)
/*!40000 ALTER TABLE `pmb_hakakses` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_hakakses` (`aut_username`, `id_hakakses`) VALUES
	('admin', 1);
/*!40000 ALTER TABLE `pmb_hakakses` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_herbayar
CREATE TABLE IF NOT EXISTS `pmb_herbayar` (
  `id_daftar` varchar(15) NOT NULL DEFAULT '',
  `spp_tetap` int(11) unsigned DEFAULT NULL,
  `spp_var` int(9) unsigned DEFAULT NULL,
  `spa` int(20) unsigned DEFAULT NULL,
  `spa_pot` int(20) unsigned NOT NULL DEFAULT '0',
  `dpa` int(9) unsigned DEFAULT NULL,
  `id_user` varchar(15) DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_daftar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_herbayar: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_herbayar` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_herbayar` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_herregistrasi
CREATE TABLE IF NOT EXISTS `pmb_herregistrasi` (
  `id_daftar` varchar(15) NOT NULL,
  `tgl_herregistrasi` datetime DEFAULT NULL,
  `nim` varchar(10) DEFAULT NULL,
  `ukuran_jaz` varchar(5) DEFAULT NULL,
  `kelas` char(1) DEFAULT NULL,
  `angkatan` year(4) DEFAULT NULL,
  `id_user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_daftar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_herregistrasi: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_herregistrasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_herregistrasi` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_icon
CREATE TABLE IF NOT EXISTS `pmb_icon` (
  `icon_nama` varchar(20) NOT NULL,
  `icon_val` char(8) NOT NULL,
  PRIMARY KEY (`icon_nama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_icon: ~711 rows (approximately)
/*!40000 ALTER TABLE `pmb_icon` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_icon` (`icon_nama`, `icon_val`) VALUES
	('fa-adjust', '&#xf042;'),
	('fa-adn', '&#xf170;'),
	('fa-align-center', '&#xf037;'),
	('fa-align-justify', '&#xf039;'),
	('fa-align-left', '&#xf036;'),
	('fa-align-right', '&#xf038;'),
	('fa-ambulance', '&#xf0f9;'),
	('fa-anchor', '&#xf13d;'),
	('fa-android', '&#xf17b;'),
	('fa-angellist', '&#xf209;'),
	('fa-angle-double-down', '&#xf103;'),
	('fa-angle-double-left', '&#xf100;'),
	('fa-angle-double-righ', '&#xf101;'),
	('fa-angle-double-up', '&#xf102;'),
	('fa-angle-down', '&#xf107;'),
	('fa-angle-left', '&#xf104;'),
	('fa-angle-right', '&#xf105;'),
	('fa-angle-up', '&#xf106;'),
	('fa-apple', '&#xf179;'),
	('fa-archive', '&#xf187;'),
	('fa-area-chart', '&#xf1fe;'),
	('fa-arrow-circle-down', '&#xf0ab;'),
	('fa-arrow-circle-left', '&#xf0a8;'),
	('fa-arrow-circle-o-do', '&#xf01a;'),
	('fa-arrow-circle-o-le', '&#xf190;'),
	('fa-arrow-circle-o-ri', '&#xf18e;'),
	('fa-arrow-circle-o-up', '&#xf01b;'),
	('fa-arrow-circle-righ', '&#xf0a9;'),
	('fa-arrow-circle-up', '&#xf0aa;'),
	('fa-arrow-down', '&#xf063;'),
	('fa-arrow-left', '&#xf060;'),
	('fa-arrow-right', '&#xf061;'),
	('fa-arrow-up', '&#xf062;'),
	('fa-arrows', '&#xf047;'),
	('fa-arrows-alt', '&#xf0b2;'),
	('fa-arrows-h', '&#xf07e;'),
	('fa-arrows-v', '&#xf07d;'),
	('fa-asterisk', '&#xf069;'),
	('fa-at', '&#xf1fa;'),
	('fa-automobile', '&#xf1b9;'),
	('fa-backward', '&#xf04a;'),
	('fa-ban', '&#xf05e;'),
	('fa-bank', '&#xf19c;'),
	('fa-bar-chart', '&#xf080;'),
	('fa-bar-chart-o', '&#xf080;'),
	('fa-barcode', '&#xf02a;'),
	('fa-bars', '&#xf0c9;'),
	('fa-beer', '&#xf0fc;'),
	('fa-behance', '&#xf1b4;'),
	('fa-behance-square', '&#xf1b5;'),
	('fa-bell', '&#xf0f3;'),
	('fa-bell-o', '&#xf0a2;'),
	('fa-bell-slash', '&#xf1f6;'),
	('fa-bell-slash-o', '&#xf1f7;'),
	('fa-bicycle', '&#xf206;'),
	('fa-binoculars', '&#xf1e5;'),
	('fa-birthday-cake', '&#xf1fd;'),
	('fa-bitbucket', '&#xf171;'),
	('fa-bitbucket-square', '&#xf172;'),
	('fa-bitcoin', '&#xf15a;'),
	('fa-bold', '&#xf032;'),
	('fa-bolt', '&#xf0e7;'),
	('fa-bomb', '&#xf1e2;'),
	('fa-book', '&#xf02d;'),
	('fa-bookmark', '&#xf02e;'),
	('fa-bookmark-o', '&#xf097;'),
	('fa-briefcase', '&#xf0b1;'),
	('fa-btc', '&#xf15a;'),
	('fa-bug', '&#xf188;'),
	('fa-building', '&#xf1ad;'),
	('fa-building-o', '&#xf0f7;'),
	('fa-bullhorn', '&#xf0a1;'),
	('fa-bullseye', '&#xf140;'),
	('fa-bus', '&#xf207;'),
	('fa-cab', '&#xf1ba;'),
	('fa-calculator', '&#xf1ec;'),
	('fa-calendar', '&#xf073;'),
	('fa-calendar-o', '&#xf133;'),
	('fa-camera', '&#xf030;'),
	('fa-camera-retro', '&#xf083;'),
	('fa-car', '&#xf1b9;'),
	('fa-caret-down', '&#xf0d7;'),
	('fa-caret-left', '&#xf0d9;'),
	('fa-caret-right', '&#xf0da;'),
	('fa-caret-square-o-do', '&#xf150;'),
	('fa-caret-square-o-le', '&#xf191;'),
	('fa-caret-square-o-ri', '&#xf152;'),
	('fa-caret-square-o-up', '&#xf151;'),
	('fa-caret-up', '&#xf0d8;'),
	('fa-cc', '&#xf20a;'),
	('fa-cc-amex', '&#xf1f3;'),
	('fa-cc-discover', '&#xf1f2;'),
	('fa-cc-mastercard', '&#xf1f1;'),
	('fa-cc-paypal', '&#xf1f4;'),
	('fa-cc-stripe', '&#xf1f5;'),
	('fa-cc-visa', '&#xf1f0;'),
	('fa-certificate', '&#xf0a3;'),
	('fa-chain', '&#xf0c1;'),
	('fa-chain-broken', '&#xf127;'),
	('fa-check', '&#xf00c;'),
	('fa-check-circle', '&#xf058;'),
	('fa-check-circle-o', '&#xf05d;'),
	('fa-check-square', '&#xf14a;'),
	('fa-check-square-o', '&#xf046;'),
	('fa-chevron-circle-do', '&#xf13a;'),
	('fa-chevron-circle-le', '&#xf137;'),
	('fa-chevron-circle-ri', '&#xf138;'),
	('fa-chevron-circle-up', '&#xf139;'),
	('fa-chevron-down', '&#xf078;'),
	('fa-chevron-left', '&#xf053;'),
	('fa-chevron-right', '&#xf054;'),
	('fa-chevron-up', '&#xf077;'),
	('fa-child', '&#xf1ae;'),
	('fa-circle', '&#xf111;'),
	('fa-circle-o', '&#xf10c;'),
	('fa-circle-o-notch', '&#xf1ce;'),
	('fa-circle-thin', '&#xf1db;'),
	('fa-clipboard', '&#xf0ea;'),
	('fa-clock-o', '&#xf017;'),
	('fa-close', '&#xf00d;'),
	('fa-cloud', '&#xf0c2;'),
	('fa-cloud-download', '&#xf0ed;'),
	('fa-cloud-upload', '&#xf0ee;'),
	('fa-cny', '&#xf157;'),
	('fa-code', '&#xf121;'),
	('fa-code-fork', '&#xf126;'),
	('fa-codepen', '&#xf1cb;'),
	('fa-coffee', '&#xf0f4;'),
	('fa-cog', '&#xf013;'),
	('fa-cogs', '&#xf085;'),
	('fa-columns', '&#xf0db;'),
	('fa-comment', '&#xf075;'),
	('fa-comment-o', '&#xf0e5;'),
	('fa-comments', '&#xf086;'),
	('fa-comments-o', '&#xf0e6;'),
	('fa-compass', '&#xf14e;'),
	('fa-compress', '&#xf066;'),
	('fa-copy', '&#xf0c5;'),
	('fa-copyright', '&#xf1f9;'),
	('fa-credit-card', '&#xf09d;'),
	('fa-crop', '&#xf125;'),
	('fa-crosshairs', '&#xf05b;'),
	('fa-css3', '&#xf13c;'),
	('fa-cube', '&#xf1b2;'),
	('fa-cubes', '&#xf1b3;'),
	('fa-cut', '&#xf0c4;'),
	('fa-cutlery', '&#xf0f5;'),
	('fa-dashboard', '&#xf0e4;'),
	('fa-database', '&#xf1c0;'),
	('fa-dedent', '&#xf03b;'),
	('fa-delicious', '&#xf1a5;'),
	('fa-desktop', '&#xf108;'),
	('fa-deviantart', '&#xf1bd;'),
	('fa-digg', '&#xf1a6;'),
	('fa-dollar', '&#xf155;'),
	('fa-dot-circle-o', '&#xf192;'),
	('fa-download', '&#xf019;'),
	('fa-dribbble', '&#xf17d;'),
	('fa-dropbox', '&#xf16b;'),
	('fa-drupal', '&#xf1a9;'),
	('fa-edit', '&#xf044;'),
	('fa-eject', '&#xf052;'),
	('fa-ellipsis-h', '&#xf141;'),
	('fa-ellipsis-v', '&#xf142;'),
	('fa-empire', '&#xf1d1;'),
	('fa-envelope', '&#xf0e0;'),
	('fa-envelope-o', '&#xf003;'),
	('fa-envelope-square', '&#xf199;'),
	('fa-eraser', '&#xf12d;'),
	('fa-eur', '&#xf153;'),
	('fa-euro', '&#xf153;'),
	('fa-exchange', '&#xf0ec;'),
	('fa-exclamation', '&#xf12a;'),
	('fa-exclamation-circl', '&#xf06a;'),
	('fa-exclamation-trian', '&#xf071;'),
	('fa-expand', '&#xf065;'),
	('fa-external-link', '&#xf08e;'),
	('fa-external-link-squ', '&#xf14c;'),
	('fa-eye', '&#xf06e;'),
	('fa-eye-slash', '&#xf070;'),
	('fa-eyedropper', '&#xf1fb;'),
	('fa-facebook', '&#xf09a;'),
	('fa-facebook-square', '&#xf082;'),
	('fa-fast-backward', '&#xf049;'),
	('fa-fast-forward', '&#xf050;'),
	('fa-fax', '&#xf1ac;'),
	('fa-female', '&#xf182;'),
	('fa-fighter-jet', '&#xf0fb;'),
	('fa-file', '&#xf15b;'),
	('fa-file-archive-o', '&#xf1c6;'),
	('fa-file-audio-o', '&#xf1c7;'),
	('fa-file-code-o', '&#xf1c9;'),
	('fa-file-excel-o', '&#xf1c3;'),
	('fa-file-image-o', '&#xf1c5;'),
	('fa-file-movie-o', '&#xf1c8;'),
	('fa-file-o', '&#xf016;'),
	('fa-file-pdf-o', '&#xf1c1;'),
	('fa-file-photo-o', '&#xf1c5;'),
	('fa-file-picture-o', '&#xf1c5;'),
	('fa-file-powerpoint-o', '&#xf1c4;'),
	('fa-file-sound-o', '&#xf1c7;'),
	('fa-file-text', '&#xf15c;'),
	('fa-file-text-o', '&#xf0f6;'),
	('fa-file-video-o', '&#xf1c8;'),
	('fa-file-word-o', '&#xf1c2;'),
	('fa-file-zip-o', '&#xf1c6;'),
	('fa-files-o', '&#xf0c5;'),
	('fa-film', '&#xf008;'),
	('fa-filter', '&#xf0b0;'),
	('fa-fire', '&#xf06d;'),
	('fa-fire-extinguisher', '&#xf134;'),
	('fa-flag', '&#xf024;'),
	('fa-flag-checkered', '&#xf11e;'),
	('fa-flag-o', '&#xf11d;'),
	('fa-flash', '&#xf0e7;'),
	('fa-flask', '&#xf0c3;'),
	('fa-flickr', '&#xf16e;'),
	('fa-floppy-o', '&#xf0c7;'),
	('fa-folder', '&#xf07b;'),
	('fa-folder-o', '&#xf114;'),
	('fa-folder-open', '&#xf07c;'),
	('fa-folder-open-o', '&#xf115;'),
	('fa-font', '&#xf031;'),
	('fa-forward', '&#xf04e;'),
	('fa-foursquare', '&#xf180;'),
	('fa-frown-o', '&#xf119;'),
	('fa-futbol-o', '&#xf1e3;'),
	('fa-gamepad', '&#xf11b;'),
	('fa-gavel', '&#xf0e3;'),
	('fa-gbp', '&#xf154;'),
	('fa-ge', '&#xf1d1;'),
	('fa-gear', '&#xf013;'),
	('fa-gears', '&#xf085;'),
	('fa-gift', '&#xf06b;'),
	('fa-git', '&#xf1d3;'),
	('fa-git-square', '&#xf1d2;'),
	('fa-github', '&#xf09b;'),
	('fa-github-alt', '&#xf113;'),
	('fa-github-square', '&#xf092;'),
	('fa-gittip', '&#xf184;'),
	('fa-glass', '&#xf000;'),
	('fa-globe', '&#xf0ac;'),
	('fa-google', '&#xf1a0;'),
	('fa-google-plus', '&#xf0d5;'),
	('fa-google-plus-squar', '&#xf0d4;'),
	('fa-google-wallet', '&#xf1ee;'),
	('fa-graduation-cap', '&#xf19d;'),
	('fa-group', '&#xf0c0;'),
	('fa-h-square', '&#xf0fd;'),
	('fa-hacker-news', '&#xf1d4;'),
	('fa-hand-o-down', '&#xf0a7;'),
	('fa-hand-o-left', '&#xf0a5;'),
	('fa-hand-o-right', '&#xf0a4;'),
	('fa-hand-o-up', '&#xf0a6;'),
	('fa-hdd-o', '&#xf0a0;'),
	('fa-header', '&#xf1dc;'),
	('fa-headphones', '&#xf025;'),
	('fa-heart', '&#xf004;'),
	('fa-heart-o', '&#xf08a;'),
	('fa-history', '&#xf1da;'),
	('fa-home', '&#xf015;'),
	('fa-hospital-o', '&#xf0f8;'),
	('fa-html5', '&#xf13b;'),
	('fa-ils', '&#xf20b;'),
	('fa-image', '&#xf03e;'),
	('fa-inbox', '&#xf01c;'),
	('fa-indent', '&#xf03c;'),
	('fa-info', '&#xf129;'),
	('fa-info-circle', '&#xf05a;'),
	('fa-inr', '&#xf156;'),
	('fa-instagram', '&#xf16d;'),
	('fa-institution', '&#xf19c;'),
	('fa-ioxhost', '&#xf208;'),
	('fa-italic', '&#xf033;'),
	('fa-joomla', '&#xf1aa;'),
	('fa-jpy', '&#xf157;'),
	('fa-jsfiddle', '&#xf1cc;'),
	('fa-key', '&#xf084;'),
	('fa-keyboard-o', '&#xf11c;'),
	('fa-krw', '&#xf159;'),
	('fa-language', '&#xf1ab;'),
	('fa-laptop', '&#xf109;'),
	('fa-lastfm', '&#xf202;'),
	('fa-lastfm-square', '&#xf203;'),
	('fa-leaf', '&#xf06c;'),
	('fa-legal', '&#xf0e3;'),
	('fa-lemon-o', '&#xf094;'),
	('fa-level-down', '&#xf149;'),
	('fa-level-up', '&#xf148;'),
	('fa-life-bouy', '&#xf1cd;'),
	('fa-life-buoy', '&#xf1cd;'),
	('fa-life-ring', '&#xf1cd;'),
	('fa-life-saver', '&#xf1cd;'),
	('fa-lightbulb-o', '&#xf0eb;'),
	('fa-line-chart', '&#xf201;'),
	('fa-link', '&#xf0c1;'),
	('fa-linkedin', '&#xf0e1;'),
	('fa-linkedin-square', '&#xf08c;'),
	('fa-linux', '&#xf17c;'),
	('fa-list', '&#xf03a;'),
	('fa-list-alt', '&#xf022;'),
	('fa-list-ol', '&#xf0cb;'),
	('fa-list-ul', '&#xf0ca;'),
	('fa-location-arrow', '&#xf124;'),
	('fa-lock', '&#xf023;'),
	('fa-long-arrow-down', '&#xf175;'),
	('fa-long-arrow-left', '&#xf177;'),
	('fa-long-arrow-right', '&#xf178;'),
	('fa-long-arrow-up', '&#xf176;'),
	('fa-magic', '&#xf0d0;'),
	('fa-magnet', '&#xf076;'),
	('fa-mail-forward', '&#xf064;'),
	('fa-mail-reply', '&#xf112;'),
	('fa-mail-reply-all', '&#xf122;'),
	('fa-male', '&#xf183;'),
	('fa-map-marker', '&#xf041;'),
	('fa-maxcdn', '&#xf136;'),
	('fa-meanpath', '&#xf20c;'),
	('fa-medkit', '&#xf0fa;'),
	('fa-meh-o', '&#xf11a;'),
	('fa-microphone', '&#xf130;'),
	('fa-microphone-slash', '&#xf131;'),
	('fa-minus', '&#xf068;'),
	('fa-minus-circle', '&#xf056;'),
	('fa-minus-square', '&#xf146;'),
	('fa-minus-square-o', '&#xf147;'),
	('fa-mobile', '&#xf10b;'),
	('fa-mobile-phone', '&#xf10b;'),
	('fa-money', '&#xf0d6;'),
	('fa-moon-o', '&#xf186;'),
	('fa-mortar-board', '&#xf19d;'),
	('fa-music', '&#xf001;'),
	('fa-navicon', '&#xf0c9;'),
	('fa-newspaper-o', '&#xf1ea;'),
	('fa-openid', '&#xf19b;'),
	('fa-outdent', '&#xf03b;'),
	('fa-pagelines', '&#xf18c;'),
	('fa-paint-brush', '&#xf1fc;'),
	('fa-paper-plane', '&#xf1d8;'),
	('fa-paper-plane-o', '&#xf1d9;'),
	('fa-paperclip', '&#xf0c6;'),
	('fa-paragraph', '&#xf1dd;'),
	('fa-paste', '&#xf0ea;'),
	('fa-pause', '&#xf04c;'),
	('fa-paw', '&#xf1b0;'),
	('fa-paypal', '&#xf1ed;'),
	('fa-pencil', '&#xf040;'),
	('fa-pencil-square', '&#xf14b;'),
	('fa-pencil-square-o', '&#xf044;'),
	('fa-phone', '&#xf095;'),
	('fa-phone-square', '&#xf098;'),
	('fa-photo', '&#xf03e;'),
	('fa-picture-o', '&#xf03e;'),
	('fa-pie-chart', '&#xf200;'),
	('fa-pied-piper', '&#xf1a7;'),
	('fa-pied-piper-alt', '&#xf1a8;'),
	('fa-pinterest', '&#xf0d2;'),
	('fa-pinterest-square', '&#xf0d3;'),
	('fa-plane', '&#xf072;'),
	('fa-play', '&#xf04b;'),
	('fa-play-circle', '&#xf144;'),
	('fa-play-circle-o', '&#xf01d;'),
	('fa-plug', '&#xf1e6;'),
	('fa-plus', '&#xf067;'),
	('fa-plus-circle', '&#xf055;'),
	('fa-plus-square', '&#xf0fe;'),
	('fa-plus-square-o', '&#xf196;'),
	('fa-power-off', '&#xf011;'),
	('fa-print', '&#xf02f;'),
	('fa-puzzle-piece', '&#xf12e;'),
	('fa-qq', '&#xf1d6;'),
	('fa-qrcode', '&#xf029;'),
	('fa-question', '&#xf128;'),
	('fa-question-circle', '&#xf059;'),
	('fa-quote-left', '&#xf10d;'),
	('fa-quote-right', '&#xf10e;'),
	('fa-ra', '&#xf1d0;'),
	('fa-random', '&#xf074;'),
	('fa-rebel', '&#xf1d0;'),
	('fa-recycle', '&#xf1b8;'),
	('fa-reddit', '&#xf1a1;'),
	('fa-reddit-square', '&#xf1a2;'),
	('fa-refresh', '&#xf021;'),
	('fa-remove', '&#xf00d;'),
	('fa-renren', '&#xf18b;'),
	('fa-reorder', '&#xf0c9;'),
	('fa-repeat', '&#xf01e;'),
	('fa-reply', '&#xf112;'),
	('fa-reply-all', '&#xf122;'),
	('fa-retweet', '&#xf079;'),
	('fa-rmb', '&#xf157;'),
	('fa-road', '&#xf018;'),
	('fa-rocket', '&#xf135;'),
	('fa-rotate-left', '&#xf0e2;'),
	('fa-rotate-right', '&#xf01e;'),
	('fa-rouble', '&#xf158;'),
	('fa-rss', '&#xf09e;'),
	('fa-rss-square', '&#xf143;'),
	('fa-rub', '&#xf158;'),
	('fa-ruble', '&#xf158;'),
	('fa-rupee', '&#xf156;'),
	('fa-save', '&#xf0c7;'),
	('fa-scissors', '&#xf0c4;'),
	('fa-search', '&#xf002;'),
	('fa-search-minus', '&#xf010;'),
	('fa-search-plus', '&#xf00e;'),
	('fa-send', '&#xf1d8;'),
	('fa-send-o', '&#xf1d9;'),
	('fa-share', '&#xf064;'),
	('fa-share-alt', '&#xf1e0;'),
	('fa-share-alt-square', '&#xf1e1;'),
	('fa-share-square', '&#xf14d;'),
	('fa-share-square-o', '&#xf045;'),
	('fa-shekel', '&#xf20b;'),
	('fa-sheqel', '&#xf20b;'),
	('fa-shield', '&#xf132;'),
	('fa-shopping-cart', '&#xf07a;'),
	('fa-sign-in', '&#xf090;'),
	('fa-sign-out', '&#xf08b;'),
	('fa-signal', '&#xf012;'),
	('fa-sitemap', '&#xf0e8;'),
	('fa-skype', '&#xf17e;'),
	('fa-slack', '&#xf198;'),
	('fa-sliders', '&#xf1de;'),
	('fa-slideshare', '&#xf1e7;'),
	('fa-smile-o', '&#xf118;'),
	('fa-soccer-ball-o', '&#xf1e3;'),
	('fa-sort', '&#xf0dc;'),
	('fa-sort-alpha-asc', '&#xf15d;'),
	('fa-sort-alpha-desc', '&#xf15e;'),
	('fa-sort-amount-asc', '&#xf160;'),
	('fa-sort-amount-desc', '&#xf161;'),
	('fa-sort-asc', '&#xf0de;'),
	('fa-sort-desc', '&#xf0dd;'),
	('fa-sort-down', '&#xf0dd;'),
	('fa-sort-numeric-asc', '&#xf162;'),
	('fa-sort-numeric-desc', '&#xf163;'),
	('fa-sort-up', '&#xf0de;'),
	('fa-soundcloud', '&#xf1be;'),
	('fa-space-shuttle', '&#xf197;'),
	('fa-spinner', '&#xf110;'),
	('fa-spoon', '&#xf1b1;'),
	('fa-spotify', '&#xf1bc;'),
	('fa-square', '&#xf0c8;'),
	('fa-square-o', '&#xf096;'),
	('fa-stack-exchange', '&#xf18d;'),
	('fa-stack-overflow', '&#xf16c;'),
	('fa-star', '&#xf005;'),
	('fa-star-half', '&#xf089;'),
	('fa-star-half-empty', '&#xf123;'),
	('fa-star-half-full', '&#xf123;'),
	('fa-star-half-o', '&#xf123;'),
	('fa-star-o', '&#xf006;'),
	('fa-steam', '&#xf1b6;'),
	('fa-steam-square', '&#xf1b7;'),
	('fa-step-backward', '&#xf048;'),
	('fa-step-forward', '&#xf051;'),
	('fa-stethoscope', '&#xf0f1;'),
	('fa-stop', '&#xf04d;'),
	('fa-strikethrough', '&#xf0cc;'),
	('fa-stumbleupon', '&#xf1a4;'),
	('fa-stumbleupon-circl', '&#xf1a3;'),
	('fa-subscript', '&#xf12c;'),
	('fa-suitcase', '&#xf0f2;'),
	('fa-sun-o', '&#xf185;'),
	('fa-superscript', '&#xf12b;'),
	('fa-support', '&#xf1cd;'),
	('fa-table', '&#xf0ce;'),
	('fa-tablet', '&#xf10a;'),
	('fa-tachometer', '&#xf0e4;'),
	('fa-tag', '&#xf02b;'),
	('fa-tags', '&#xf02c;'),
	('fa-tasks', '&#xf0ae;'),
	('fa-taxi', '&#xf1ba;'),
	('fa-tencent-weibo', '&#xf1d5;'),
	('fa-terminal', '&#xf120;'),
	('fa-text-height', '&#xf034;'),
	('fa-text-width', '&#xf035;'),
	('fa-th', '&#xf00a;'),
	('fa-th-large', '&#xf009;'),
	('fa-th-list', '&#xf00b;'),
	('fa-thumb-tack', '&#xf08d;'),
	('fa-thumbs-down', '&#xf165;'),
	('fa-thumbs-o-down', '&#xf088;'),
	('fa-thumbs-o-up', '&#xf087;'),
	('fa-thumbs-up', '&#xf164;'),
	('fa-ticket', '&#xf145;'),
	('fa-times', '&#xf00d;'),
	('fa-times-circle', '&#xf057;'),
	('fa-times-circle-o', '&#xf05c;'),
	('fa-tint', '&#xf043;'),
	('fa-toggle-down', '&#xf150;'),
	('fa-toggle-left', '&#xf191;'),
	('fa-toggle-off', '&#xf204;'),
	('fa-toggle-on', '&#xf205;'),
	('fa-toggle-right', '&#xf152;'),
	('fa-toggle-up', '&#xf151;'),
	('fa-trash', '&#xf1f8;'),
	('fa-trash-o', '&#xf014;'),
	('fa-tree', '&#xf1bb;'),
	('fa-trello', '&#xf181;'),
	('fa-trophy', '&#xf091;'),
	('fa-truck', '&#xf0d1;'),
	('fa-try', '&#xf195;'),
	('fa-tty', '&#xf1e4;'),
	('fa-tumblr', '&#xf173;'),
	('fa-tumblr-square', '&#xf174;'),
	('fa-turkish-lira', '&#xf195;'),
	('fa-twitch', '&#xf1e8;'),
	('fa-twitter', '&#xf099;'),
	('fa-twitter-square', '&#xf081;'),
	('fa-umbrella', '&#xf0e9;'),
	('fa-underline', '&#xf0cd;'),
	('fa-undo', '&#xf0e2;'),
	('fa-university', '&#xf19c;'),
	('fa-unlink', '&#xf127;'),
	('fa-unlock', '&#xf09c;'),
	('fa-unlock-alt', '&#xf13e;'),
	('fa-unsorted', '&#xf0dc;'),
	('fa-upload', '&#xf093;'),
	('fa-usd', '&#xf155;'),
	('fa-user', '&#xf007;'),
	('fa-user-md', '&#xf0f0;'),
	('fa-users', '&#xf0c0;'),
	('fa-video-camera', '&#xf03d;'),
	('fa-vimeo-square', '&#xf194;'),
	('fa-vine', '&#xf1ca;'),
	('fa-vk', '&#xf189;'),
	('fa-volume-down', '&#xf027;'),
	('fa-volume-off', '&#xf026;'),
	('fa-volume-up', '&#xf028;'),
	('fa-warning', '&#xf071;'),
	('fa-wechat', '&#xf1d7;'),
	('fa-weibo', '&#xf18a;'),
	('fa-weixin', '&#xf1d7;'),
	('fa-wheelchair', '&#xf193;'),
	('fa-wifi', '&#xf1eb;'),
	('fa-windows', '&#xf17a;'),
	('fa-won', '&#xf159;'),
	('fa-wordpress', '&#xf19a;'),
	('fa-wrench', '&#xf0ad;'),
	('fa-xing', '&#xf168;'),
	('fa-xing-square', '&#xf169;'),
	('fa-yahoo', '&#xf19e;'),
	('fa-yelp', '&#xf1e9;'),
	('fa-yen', '&#xf157;'),
	('fa-youtube', '&#xf167;'),
	('fa-youtube-play', '&#xf16a;'),
	('fa-youtube-square', '&#xf166;');
/*!40000 ALTER TABLE `pmb_icon` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_iklantext
CREATE TABLE IF NOT EXISTS `pmb_iklantext` (
  `id_iklan` int(11) NOT NULL AUTO_INCREMENT,
  `iklan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_iklan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_iklantext: ~1 rows (approximately)
/*!40000 ALTER TABLE `pmb_iklantext` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_iklantext` (`id_iklan`, `iklan`) VALUES
	(1, 'SELAMAT HARI RAYA idul fitri');
/*!40000 ALTER TABLE `pmb_iklantext` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_jawabantestpa
CREATE TABLE IF NOT EXISTS `pmb_jawabantestpa` (
  `id_jawaban` int(11) NOT NULL AUTO_INCREMENT,
  `id_soal` int(11) DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL,
  `kunci_jawaban` char(1) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`id_jawaban`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_jawabantestpa: ~5 rows (approximately)
/*!40000 ALTER TABLE `pmb_jawabantestpa` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_jawabantestpa` (`id_jawaban`, `id_soal`, `jawaban`, `kunci_jawaban`, `nilai`) VALUES
	(1, 1, 'Jawab 1', '1', 10),
	(2, 1, 'Jawab 2', '0', 0),
	(3, 1, 'Jawab 3', '0', 0),
	(4, 1, 'Jawab 4', '0', 0),
	(5, 1, 'Jawab 5', '0', 0);
/*!40000 ALTER TABLE `pmb_jawabantestpa` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_jenistes
CREATE TABLE IF NOT EXISTS `pmb_jenistes` (
  `id_jenistes` tinyint(1) NOT NULL,
  `jenis_tes` varchar(30) DEFAULT NULL,
  `ket` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id_jenistes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_jenistes: ~2 rows (approximately)
/*!40000 ALTER TABLE `pmb_jenistes` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_jenistes` (`id_jenistes`, `jenis_tes`, `ket`) VALUES
	(1, 'TPA', 'Pengganti tes tertulis'),
	(2, 'Wawancara', 'Test Wawancara OL');
/*!40000 ALTER TABLE `pmb_jenistes` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_jenis_beasiswa
CREATE TABLE IF NOT EXISTS `pmb_jenis_beasiswa` (
  `kd_jenis_beasiswa` int(4) NOT NULL AUTO_INCREMENT COMMENT 'kode jenis beasiswa',
  `jenis_beasiswa` varchar(50) NOT NULL COMMENT 'jenis-jenis beasiswa',
  PRIMARY KEY (`kd_jenis_beasiswa`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_jenis_beasiswa: ~5 rows (approximately)
/*!40000 ALTER TABLE `pmb_jenis_beasiswa` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_jenis_beasiswa` (`kd_jenis_beasiswa`, `jenis_beasiswa`) VALUES
	(1, 'Bebas SPP Tetap'),
	(2, 'Bebas SPP Variabel'),
	(3, 'Bebas SPP Tetap dan SPP Variabel'),
	(6, 'Bebas SPA'),
	(7, 'Tidak Ada Beasiswa');
/*!40000 ALTER TABLE `pmb_jenis_beasiswa` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_kategori
CREATE TABLE IF NOT EXISTS `pmb_kategori` (
  `kat_id` int(11) NOT NULL AUTO_INCREMENT,
  `kat_nama` varchar(100) DEFAULT NULL,
  `kat_parent_id` int(11) DEFAULT NULL,
  `kat_link` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_kategori: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_kategori` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_kategori` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_kategorisoaltes
CREATE TABLE IF NOT EXISTS `pmb_kategorisoaltes` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(70) NOT NULL DEFAULT '',
  `jum_soal` char(3) DEFAULT NULL,
  `tot_nilai` char(3) NOT NULL DEFAULT '',
  `ta` varchar(9) NOT NULL DEFAULT '',
  `id_jenistes` tinyint(1) NOT NULL DEFAULT '0',
  `id_prioritas` char(3) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_kategorisoaltes: ~1 rows (approximately)
/*!40000 ALTER TABLE `pmb_kategorisoaltes` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_kategorisoaltes` (`id_kategori`, `nama_kategori`, `jum_soal`, `tot_nilai`, `ta`, `id_jenistes`, `id_prioritas`) VALUES
	(4, 'Coba', '10', '125', '2016/2017', 1, '1');
/*!40000 ALTER TABLE `pmb_kategorisoaltes` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_kat_artikel
CREATE TABLE IF NOT EXISTS `pmb_kat_artikel` (
  `kat_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  PRIMARY KEY (`kat_id`,`art_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_kat_artikel: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_kat_artikel` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_kat_artikel` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_keluarga
CREATE TABLE IF NOT EXISTS `pmb_keluarga` (
  `id_daftar` varchar(10) NOT NULL DEFAULT '' COMMENT 'menyimpan data nim',
  `nama` varchar(50) DEFAULT NULL COMMENT 'menyimpan data nama keluarga (misalkan nama ayah, ibu, suami, atau istri)',
  `hidup` char(1) DEFAULT 'Y' COMMENT 'menyimpan status Hidup Atau Meninggal',
  `alamat` varchar(50) DEFAULT NULL COMMENT 'menyimpan data alamat',
  `kec` varchar(50) DEFAULT NULL COMMENT 'menyimpan data kecamatan',
  `kab` varchar(50) DEFAULT NULL COMMENT 'menyimpan data kabupaten',
  `telpon` varchar(20) DEFAULT NULL COMMENT 'menyimpan data telpon',
  `pendidikan` varchar(5) DEFAULT NULL COMMENT 'menyimpan data pendidikan terakhir',
  `pekerjaan` varchar(50) DEFAULT NULL COMMENT 'menyimpan data pekerjaan',
  `instansi` varchar(100) DEFAULT NULL COMMENT 'menyimpan data tempat bekerja',
  `gol` varchar(50) DEFAULT NULL,
  `hub` varchar(10) NOT NULL COMMENT 'menyimpan data hubungan dengan mahasiswa (ayah, ibu, suami, atau istri)',
  PRIMARY KEY (`id_daftar`,`hub`),
  KEY `kab_keluarga_idx` (`kab`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel keluarga mahasiswa';

-- Dumping data for table pmb.pmb_keluarga: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_keluarga` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_keluarga` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_menu
CREATE TABLE IF NOT EXISTS `pmb_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_nama` varchar(50) DEFAULT NULL,
  `menu_link` varchar(255) DEFAULT NULL,
  `menu_link_title` varchar(255) DEFAULT NULL,
  `menu_parent` int(11) DEFAULT '0',
  `menu_icon` varchar(50) DEFAULT NULL,
  `menu_role` varchar(5) DEFAULT NULL,
  `menu_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_menu: ~55 rows (approximately)
/*!40000 ALTER TABLE `pmb_menu` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_menu` (`menu_id`, `menu_nama`, `menu_link`, `menu_link_title`, `menu_parent`, `menu_icon`, `menu_role`, `menu_order`) VALUES
	(10, 'Kontak', '[host]halaman/kontak', '', 0, 'fa-phone-square', 'user', 7),
	(12, 'Beranda', '[host]halaman/beranda', '', 0, 'fa-home', 'user', 2),
	(16, 'Post', '#', 'Post Artikel/Berita', 0, NULL, 'admin', 2),
	(17, 'Semua Artikel', '[host]admin/artikel', NULL, 24, NULL, 'admin', 2),
	(18, 'Tambah Artikel', '[host]admin/artikel/baru', NULL, 24, NULL, 'admin', 2),
	(19, 'Kategori', '[host]admin/kategori', NULL, 24, NULL, 'admin', 5),
	(20, 'Tag', '[host]admin/tag', NULL, 24, NULL, 'admin', 5),
	(21, 'Halaman', '#', NULL, 16, NULL, 'admin', 2),
	(22, 'Semua Halaman', '[host]admin/halaman', NULL, 21, NULL, 'admin', 2),
	(23, 'Tambah Halaman', '[host]admin/halaman/baru', NULL, 21, NULL, 'admin', 2),
	(24, 'Artikel', '#', NULL, 16, NULL, 'admin', 2),
	(25, 'Program', '#', NULL, 16, NULL, 'admin', 2),
	(26, 'Semua Program', '[host]admin/program', NULL, 25, NULL, 'admin', 2),
	(27, 'Tambah Program', '[host]admin/program/baru', NULL, 25, NULL, 'admin', 2),
	(28, 'Pengumuman', '#', NULL, 16, NULL, 'admin', 5),
	(29, 'Semua Pengumuman', '[host]admin/pengumuman', NULL, 28, NULL, 'admin', 2),
	(30, 'Tambah Pengumuman', '[host]admin/pengumuman/baru', NULL, 28, NULL, 'admin', 2),
	(31, 'Soal Tes', '#', NULL, 0, NULL, 'admin', 2),
	(32, 'Jenis Tes', '[host]admin/test/jenis_test', NULL, 31, NULL, 'admin', 2),
	(33, 'Kategori Soal Tes', '[host]admin/test/kategori', NULL, 31, NULL, 'admin', 2),
	(34, 'Soal Test TPA', '[host]admin/test/soal_tpa', NULL, 31, NULL, 'admin', 2),
	(35, 'Test Wawancara', '[host]admin/test/wawancara', NULL, 31, NULL, 'admin', 5),
	(36, 'Pengaturan', '#', NULL, 0, NULL, 'admin', 2),
	(37, 'Jenis Beasiswa', '[host]admin/konfigurasi/jenis_beasiswa', NULL, 36, NULL, 'admin', 2),
	(38, 'Gelombang Pendaftaran', '[host]admin/konfigurasi/setup_gelombang', NULL, 36, NULL, 'admin', 2),
	(39, 'Format Nomor Pendaftaran', '[host]admin/konfigurasi/format_nomor', NULL, 36, NULL, 'admin', 5),
	(40, 'Sumber Informasi', '[host]admin/konfigurasi/src_info', NULL, 36, NULL, 'admin', 6),
	(41, 'Syarat Her-Registrasi', '[host]admin/konfigurasi/syarat_her', NULL, 36, NULL, 'admin', 6),
	(42, 'Program Studi', '[host]admin/konfigurasi/program_studi', NULL, 36, NULL, 'admin', 7),
	(43, 'Biaya', '[host]admin/konfigurasi/biaya', NULL, 36, NULL, 'admin', 8),
	(44, 'Data Pengguna', '[host]admin/konfigurasi/user', NULL, 36, NULL, 'admin', 9),
	(45, 'Menu', '[host]admin/menu', NULL, 36, NULL, 'admin', 10),
	(47, 'Pendaftaran', '#', NULL, 0, NULL, 'admin', 5),
	(48, 'Data', '#', NULL, 0, NULL, 'admin', 6),
	(49, 'Hapus/Edit Data', '#', NULL, 0, NULL, 'admin', 6),
	(50, 'Bayar Pendaftaran', '#', NULL, 47, NULL, 'admin', 1),
	(51, 'Data Pendaftar', '[host]admin/pendaftaran/validasi', NULL, 47, NULL, 'admin', 2),
	(52, 'Her Registrasi', '[host]admin/pendaftaran/her_registrasi', NULL, 47, NULL, 'admin', 4),
	(53, 'Bayar Her Registrasi', '[host]admin/pendaftaran/bayar_her', NULL, 47, NULL, 'admin', 5),
	(54, 'Pendaftaran Baru', '[host]admin/pendaftaran', NULL, 50, NULL, 'admin', 2),
	(55, 'Edit Pendaftaran', '[host]admin/pendaftaran/edit', NULL, 50, NULL, 'admin', 2),
	(56, 'Pendaftar Harian', '[host]admin/data/pendaftar_harian', NULL, 48, NULL, 'admin', 2),
	(57, 'Pendaftar Bulanan', '[host]admin/data/pendaftar_bulanan', NULL, 48, NULL, 'admin', 2),
	(59, 'Sebaran Asal Sekolah', '#', NULL, 48, NULL, 'admin', 5),
	(60, 'Sebaran Daerah Asal', '#', NULL, 48, NULL, 'admin', 6),
	(61, 'Laporan PMB', '#', NULL, 48, NULL, 'admin', 6),
	(62, 'Lap. Pendaftar', '[host]admin/pendaftaran/export', NULL, 61, NULL, 'admin', 2),
	(63, 'Lap. Rekomendasi', '[host]admin/pendaftaran/laporan', NULL, 61, NULL, 'admin', 2),
	(64, 'Rekap PMB', '[host]admin/pendaftaran/excel/rekappmb', NULL, 61, NULL, 'admin', 2),
	(65, 'Ubah NIM', '[host]admin/pendaftaran/ubahnim', NULL, 49, NULL, 'admin', 2),
	(66, 'Ubah SPA', '[host]admin/pendaftaran/ubahspa', NULL, 49, NULL, 'admin', 2),
	(67, 'Hapus Tes TPA', '[host]admin/test/resetjwbtpamhs', NULL, 49, NULL, 'admin', 2),
	(68, 'Hapus Her-Registrasi', '[host]admin/pendaftaran/hapusher', NULL, 49, NULL, 'admin', 5),
	(69, 'Konfigurasi Umum', '[host]admin/konfigurasi/umum', NULL, 36, NULL, 'admin', 2),
	(71, 'Cetak Laporan', '[host]admin/pendaftaran/cetak_surat', NULL, 47, NULL, 'admin', 6);
/*!40000 ALTER TABLE `pmb_menu` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_page
CREATE TABLE IF NOT EXISTS `pmb_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_judul` varchar(255) NOT NULL,
  `page_content` text,
  `page_author` varchar(10) NOT NULL,
  `page_tgl` datetime DEFAULT NULL,
  `page_link` varchar(50) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_page: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_page` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_page` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_pendaftar
CREATE TABLE IF NOT EXISTS `pmb_pendaftar` (
  `id_daftar` varchar(15) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `no_induk` varchar(15) DEFAULT NULL,
  `sex` char(1) DEFAULT NULL,
  `agama` char(1) DEFAULT NULL,
  `tmp_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat_asal` varchar(100) DEFAULT NULL,
  `kec_asal` varchar(10) DEFAULT NULL,
  `kab_asal` varchar(10) DEFAULT NULL,
  `alamat_skrg` varchar(100) DEFAULT NULL,
  `kec_skrg` varchar(10) DEFAULT NULL,
  `kab_skrg` varchar(10) DEFAULT NULL,
  `jml_saudara` int(2) DEFAULT NULL,
  `anak_ke` int(2) DEFAULT NULL,
  `nm_ayah` varchar(50) DEFAULT NULL,
  `nm_ibu` varchar(50) DEFAULT NULL,
  `ket_ayah` int(1) DEFAULT NULL,
  `ket_ibu` int(1) DEFAULT NULL,
  `kerja_ayah` varchar(50) DEFAULT NULL,
  `kerja_ibu` varchar(50) DEFAULT NULL,
  `alamat_ortu` varchar(255) DEFAULT NULL,
  `pdpt_ortu` varchar(15) DEFAULT NULL,
  `nm_gurubk` varchar(50) DEFAULT NULL,
  `telp_gurubk` varchar(15) DEFAULT NULL,
  `rapor_sm1` varchar(4) DEFAULT NULL,
  `rapor_sm2` varchar(4) DEFAULT NULL,
  `rapor_sm3` varchar(4) DEFAULT NULL,
  `rapor_sm4` varchar(4) DEFAULT NULL,
  `rerata_uan` varchar(4) DEFAULT NULL,
  `nilai_total` varchar(5) DEFAULT NULL,
  `prestasi` text,
  `kd_sekolah` varchar(10) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `thn_lulus` varchar(4) DEFAULT NULL,
  `no_sttb` varchar(30) DEFAULT NULL,
  `jalur_pendaftaran` char(1) DEFAULT NULL,
  `alumni` char(1) DEFAULT NULL,
  `sdh_lulus` char(1) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `prodi_pil1` varchar(10) DEFAULT NULL,
  `prodi_pil2` varchar(10) DEFAULT NULL,
  `tgl_daftar` datetime DEFAULT NULL,
  `id_gel` char(5) DEFAULT NULL,
  `pin` varchar(15) DEFAULT NULL,
  `id_user` varchar(15) DEFAULT NULL,
  `tgl_tes` date DEFAULT NULL,
  `stt_cetakkartu` char(1) DEFAULT 'T',
  `bayar_pendaftaran` double DEFAULT NULL,
  `model_bayar` int(1) DEFAULT NULL,
  `jml_pilihan` int(1) DEFAULT NULL,
  `hub_keluarga` int(1) DEFAULT NULL,
  `goldar` varchar(2) DEFAULT NULL,
  `wn` varchar(3) DEFAULT NULL,
  `stt_mhs` char(1) DEFAULT NULL,
  `pembiayaan` char(1) DEFAULT NULL,
  `kawin` char(1) DEFAULT 'T',
  `ip` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_daftar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_pendaftar: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_pendaftar` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_pendaftar` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_pendidikan
CREATE TABLE IF NOT EXISTS `pmb_pendidikan` (
  `id` int(1) NOT NULL DEFAULT '0',
  `Jenjang` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_pendidikan: ~9 rows (approximately)
/*!40000 ALTER TABLE `pmb_pendidikan` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_pendidikan` (`id`, `Jenjang`) VALUES
	(1, 'SD'),
	(2, 'SMP'),
	(3, 'SMA'),
	(4, 'D1'),
	(5, 'D2'),
	(6, 'D3'),
	(7, 'S1'),
	(8, 'S2'),
	(9, 'S3');
/*!40000 ALTER TABLE `pmb_pendidikan` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_pengumuman
CREATE TABLE IF NOT EXISTS `pmb_pengumuman` (
  `png_id` int(11) NOT NULL AUTO_INCREMENT,
  `prg_id` int(11) DEFAULT NULL COMMENT 'link dengan tb program',
  `png_judul` varchar(100) DEFAULT NULL,
  `png_deskripsi` text CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  `png_amplop` longtext,
  `png_terima` longtext CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  `png_tolak` longtext CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  `png_tabel` longtext CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  `png_link` varchar(100) DEFAULT NULL,
  `png_tgl` datetime DEFAULT NULL,
  PRIMARY KEY (`png_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_pengumuman: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_pengumuman` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_pengumuman` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_pengumuman_srt
CREATE TABLE IF NOT EXISTS `pmb_pengumuman_srt` (
  `png_id` int(11) NOT NULL DEFAULT '0',
  `kd_jenis_beasiswa` int(11) NOT NULL DEFAULT '0',
  `png_surat` longtext,
  PRIMARY KEY (`png_id`,`kd_jenis_beasiswa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_pengumuman_srt: 0 rows
/*!40000 ALTER TABLE `pmb_pengumuman_srt` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_pengumuman_srt` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_program
CREATE TABLE IF NOT EXISTS `pmb_program` (
  `prg_id` int(11) NOT NULL AUTO_INCREMENT,
  `prg_bea` char(10) DEFAULT NULL,
  `prg_nama` varchar(50) DEFAULT NULL,
  `prg_judul` varchar(100) DEFAULT NULL,
  `prg_deskripsi` text CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  `prg_link` varchar(100) DEFAULT NULL,
  `prg_tglmulai` date DEFAULT NULL,
  `prg_tglakhir` date DEFAULT NULL,
  `prg_form` text CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  `prg_image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`prg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_program: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_program` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_program` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_programbiayaprodi
CREATE TABLE IF NOT EXISTS `pmb_programbiayaprodi` (
  `id_programbiaya` int(11) NOT NULL AUTO_INCREMENT,
  `id_programprodi` int(11) DEFAULT NULL,
  `spp_tetap` double DEFAULT '0',
  `sppv_teori` double DEFAULT '0',
  `sppv_praktek` double DEFAULT '0',
  `spa` double DEFAULT '0',
  `spa_alum` double DEFAULT '0',
  `stat_biaya` int(1) DEFAULT '0',
  `thn_berlaku` year(4) DEFAULT NULL,
  PRIMARY KEY (`id_programbiaya`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_programbiayaprodi: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_programbiayaprodi` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_programbiayaprodi` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_programprodi
CREATE TABLE IF NOT EXISTS `pmb_programprodi` (
  `id_programprodi` int(11) NOT NULL AUTO_INCREMENT,
  `kd_proditawar` int(5) DEFAULT NULL,
  `jurusan` varchar(200) DEFAULT NULL,
  `dgt1` char(1) DEFAULT NULL,
  `dgt4` char(1) DEFAULT NULL,
  `dgt5` char(1) DEFAULT NULL,
  `dgt6` char(1) DEFAULT NULL,
  `dgt7` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_programprodi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_programprodi: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_programprodi` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_programprodi` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_rekomendasi
CREATE TABLE IF NOT EXISTS `pmb_rekomendasi` (
  `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(15) DEFAULT NULL,
  `id_daftar` varchar(15) DEFAULT NULL COMMENT 'dari data pendaftar',
  `rekomendasi` varchar(50) DEFAULT NULL,
  `kd_proditawar` int(5) DEFAULT NULL,
  `ket_alasan` text,
  `catatan` text,
  `tgl_rekomendasi` date DEFAULT NULL,
  `stat_cetak` char(1) DEFAULT NULL,
  `stat_cetak_amplop` char(1) DEFAULT NULL,
  `no_surat` char(5) DEFAULT NULL,
  `png_id` int(11) DEFAULT NULL COMMENT 'di set dengan id pengumuman terakhir sesuai program',
  `kd_jenis_beasiswa` int(11) DEFAULT NULL,
  `dft_ptlain` varchar(50) DEFAULT NULL,
  `nama_ptn` varchar(50) DEFAULT NULL,
  `jur_ptn` varchar(50) DEFAULT NULL,
  `nama_pts` varchar(50) DEFAULT NULL,
  `jur_pts` varchar(50) DEFAULT NULL,
  `ingin_kuliah` varchar(20) DEFAULT NULL,
  `penampilan` varchar(50) DEFAULT NULL,
  `ket_penampilan` varchar(100) DEFAULT NULL,
  `etika` varchar(50) DEFAULT NULL,
  `ket_etika` varchar(100) DEFAULT NULL,
  `komunikasi` varchar(50) DEFAULT NULL,
  `ket_komunikasi` varchar(100) DEFAULT NULL,
  `kepribadian` varchar(50) DEFAULT NULL,
  `ket_kepribadian` varchar(100) DEFAULT NULL,
  `emosional` varchar(50) DEFAULT NULL,
  `ket_emosional` varchar(100) DEFAULT NULL,
  `paham_prodi` varchar(50) DEFAULT NULL,
  `prospek_lulus` varchar(50) DEFAULT NULL,
  `jur_sekolah` varchar(50) DEFAULT NULL,
  `nil_1` float DEFAULT NULL,
  `nil_2` float DEFAULT NULL,
  `nil_3` float DEFAULT NULL,
  `nil_4` float DEFAULT NULL,
  `nil_5` float DEFAULT NULL,
  `nil_6` float DEFAULT NULL,
  `nil_7` float DEFAULT NULL,
  `nil_8` float DEFAULT NULL,
  `nil_9` float DEFAULT NULL,
  `pend_nonformal` text,
  `pelajaran_disukai` varchar(50) DEFAULT NULL,
  `alasan_disukai` varchar(100) DEFAULT NULL,
  `pelajaran_nonsuka` varchar(50) DEFAULT NULL,
  `alasan_nonsuka` varchar(100) DEFAULT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `org_intrasekolah` varchar(50) DEFAULT NULL,
  `org_ekstrasekolah` varchar(50) DEFAULT NULL,
  `hal_lain` varchar(100) DEFAULT NULL,
  `sdr_sekolah` int(11) DEFAULT NULL,
  `sdr_kuliah` int(11) DEFAULT NULL,
  `sdr_bekerja` int(11) DEFAULT NULL,
  `sdr_berkeluarga` int(11) DEFAULT NULL,
  `stt_kawinortu` varchar(50) DEFAULT NULL,
  `biaya_tahu` varchar(50) DEFAULT NULL,
  `biaya_mampu` varchar(50) DEFAULT NULL,
  `sumber_biaya` varchar(50) DEFAULT NULL,
  `sumber_biaya_lain` varchar(50) DEFAULT NULL,
  `pddk_src_biaya` varchar(50) DEFAULT NULL,
  `pekerjaan_src_biaya` text,
  `penghasilan_src_biaya` varchar(50) DEFAULT NULL,
  `stt_rumah` varchar(50) DEFAULT NULL,
  `listrik` varchar(20) DEFAULT NULL,
  `aset_mobil` char(1) DEFAULT NULL,
  `aset_motor` char(1) DEFAULT NULL,
  `aset_lain` varchar(50) DEFAULT NULL,
  `motivasi_p1` float DEFAULT NULL,
  `motivasi_p2` float DEFAULT NULL,
  `motivasi_p3` float DEFAULT NULL,
  `motivasi_p4` float DEFAULT NULL,
  `motivasi_p5` float DEFAULT NULL,
  `motivasi_p6` float DEFAULT NULL,
  `nilai_identitas` float DEFAULT NULL,
  `nilai_kemampuan_keuangan` varchar(20) DEFAULT NULL,
  `nilai_motivasi` float DEFAULT NULL,
  `nilai_akademik` float DEFAULT NULL,
  `nilai_tpa` float DEFAULT NULL,
  `cat_rekomendasi` text,
  PRIMARY KEY (`id_rekomendasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_rekomendasi: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_rekomendasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_rekomendasi` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_setting
CREATE TABLE IF NOT EXISTS `pmb_setting` (
  `set_name` varchar(50) NOT NULL,
  `set_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`set_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_setting: ~3 rows (approximately)
/*!40000 ALTER TABLE `pmb_setting` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_setting` (`set_name`, `set_value`) VALUES
	('active_year', '2017'),
	('dpa', '1500000'),
	('interval', '7');
/*!40000 ALTER TABLE `pmb_setting` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_setting_angsuran
CREATE TABLE IF NOT EXISTS `pmb_setting_angsuran` (
  `id_confangsuran` int(11) NOT NULL AUTO_INCREMENT,
  `spa1` double DEFAULT '0',
  `spa2` double DEFAULT '0',
  `spa3` double DEFAULT '0',
  `spa4` double DEFAULT '0',
  PRIMARY KEY (`id_confangsuran`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_setting_angsuran: ~1 rows (approximately)
/*!40000 ALTER TABLE `pmb_setting_angsuran` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_setting_angsuran` (`id_confangsuran`, `spa1`, `spa2`, `spa3`, `spa4`) VALUES
	(1, 30, 30, 25, 15);
/*!40000 ALTER TABLE `pmb_setting_angsuran` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_setting_nopendaftar
CREATE TABLE IF NOT EXISTS `pmb_setting_nopendaftar` (
  `prg_id` int(11) NOT NULL,
  `noawal` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`prg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='setting no pendaftaran';

-- Dumping data for table pmb.pmb_setting_nopendaftar: ~3 rows (approximately)
/*!40000 ALTER TABLE `pmb_setting_nopendaftar` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_setting_nopendaftar` (`prg_id`, `noawal`) VALUES
	(2, '1730000'),
	(6, '1710000'),
	(7, '1720000');
/*!40000 ALTER TABLE `pmb_setting_nopendaftar` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_soaltestpa
CREATE TABLE IF NOT EXISTS `pmb_soaltestpa` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(5) NOT NULL DEFAULT '0',
  `soal` text NOT NULL,
  `id_related` int(6) unsigned DEFAULT NULL,
  `ta` varchar(9) NOT NULL DEFAULT '',
  `aktif` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_soal`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_soaltestpa: ~1 rows (approximately)
/*!40000 ALTER TABLE `pmb_soaltestpa` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_soaltestpa` (`id_soal`, `id_kategori`, `soal`, `id_related`, `ta`, `aktif`) VALUES
	(1, 4, '<p>soal 1 ?</p>', 0, '2017/2018', 'Y');
/*!40000 ALTER TABLE `pmb_soaltestpa` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_soalteswawancara
CREATE TABLE IF NOT EXISTS `pmb_soalteswawancara` (
  `id_soal` int(11) NOT NULL,
  `id_kategori` int(5) DEFAULT NULL,
  `soal` text,
  `ta` varchar(9) DEFAULT NULL,
  `aktif` char(1) DEFAULT NULL,
  `id_prioritas` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_soal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_soalteswawancara: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_soalteswawancara` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_soalteswawancara` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_src_info
CREATE TABLE IF NOT EXISTS `pmb_src_info` (
  `kd_info` int(11) NOT NULL AUTO_INCREMENT,
  `info` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kd_info`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel sumber infomasi';

-- Dumping data for table pmb.pmb_src_info: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_src_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_src_info` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_src_info_set
CREATE TABLE IF NOT EXISTS `pmb_src_info_set` (
  `id_daftar` varchar(10) DEFAULT NULL,
  `kd_info` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_src_info_set: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_src_info_set` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_src_info_set` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_syarat_her
CREATE TABLE IF NOT EXISTS `pmb_syarat_her` (
  `kd` int(11) NOT NULL AUTO_INCREMENT,
  `syarat` varchar(100) NOT NULL DEFAULT '0',
  `jum_syarat` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kd`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='tabel jenis dokumen kelengkapan her registrasi';

-- Dumping data for table pmb.pmb_syarat_her: ~10 rows (approximately)
/*!40000 ALTER TABLE `pmb_syarat_her` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_syarat_her` (`kd`, `syarat`, `jum_syarat`) VALUES
	(1, 'Surat Pemberitahuan Hasil Seleksi', 1),
	(2, 'Bukti Pembayaran', 1),
	(3, 'Fotocopy Ijazah dan SKHUN', 2),
	(4, 'Surat Keterangan Bebas Narkoba', 1),
	(5, 'Surat Keterangan Catatan Kepolisian', 1),
	(6, 'Pas Foto 2x3 Warna Biru 2 Lembar', 2),
	(9, 'Fotocopy Kartu Keluarga', 2),
	(10, 'Materai Tempel @ Rp 6.000,-', 2),
	(11, 'Formulir Her Registrasi', 1),
	(12, 'Surat Pernyataan', 2);
/*!40000 ALTER TABLE `pmb_syarat_her` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_syarat_her_set
CREATE TABLE IF NOT EXISTS `pmb_syarat_her_set` (
  `id_daftar` varchar(10) DEFAULT NULL,
  `kd` int(11) DEFAULT NULL,
  `jum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabel set syarat her registrasi';

-- Dumping data for table pmb.pmb_syarat_her_set: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_syarat_her_set` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_syarat_her_set` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_tag
CREATE TABLE IF NOT EXISTS `pmb_tag` (
  `tag_id` int(11) NOT NULL,
  `tag_nama` varchar(50) NOT NULL,
  `tag_link` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tag_id`,`tag_nama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_tag: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_tag` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_tag_artikel
CREATE TABLE IF NOT EXISTS `pmb_tag_artikel` (
  `tag_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  PRIMARY KEY (`tag_id`,`art_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_tag_artikel: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_tag_artikel` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_tag_artikel` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_tarif_daftar
CREATE TABLE IF NOT EXISTS `pmb_tarif_daftar` (
  `id_tarif` int(11) NOT NULL AUTO_INCREMENT,
  `jns_tarif` varchar(50) NOT NULL DEFAULT '0',
  `tarif` varchar(6) NOT NULL DEFAULT '0',
  `tahun` varchar(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_tarif`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='tarif pendaftaran';

-- Dumping data for table pmb.pmb_tarif_daftar: ~2 rows (approximately)
/*!40000 ALTER TABLE `pmb_tarif_daftar` DISABLE KEYS */;
INSERT IGNORE INTO `pmb_tarif_daftar` (`id_tarif`, `jns_tarif`, `tarif`, `tahun`) VALUES
	(1, '1 Pilihan', '100000', '2017'),
	(2, '2 pilihan', '150000', '2017');
/*!40000 ALTER TABLE `pmb_tarif_daftar` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_testpa
CREATE TABLE IF NOT EXISTS `pmb_testpa` (
  `id_testpa` int(11) NOT NULL AUTO_INCREMENT,
  `id_daftar` varchar(15) DEFAULT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `id_jawaban` int(11) DEFAULT NULL,
  `tgl_tes` date DEFAULT NULL,
  PRIMARY KEY (`id_testpa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_testpa: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_testpa` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_testpa` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_teswawancara
CREATE TABLE IF NOT EXISTS `pmb_teswawancara` (
  `id_teswawancara` int(11) NOT NULL AUTO_INCREMENT,
  `id_daftar` varchar(15) DEFAULT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `jawab` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_teswawancara`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pmb.pmb_teswawancara: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_teswawancara` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_teswawancara` ENABLE KEYS */;


-- Dumping structure for table pmb.pmb_transbayar
CREATE TABLE IF NOT EXISTS `pmb_transbayar` (
  `id_transbayar` int(11) NOT NULL AUTO_INCREMENT,
  `id_daftar` varchar(10) DEFAULT NULL,
  `spa_byr` double DEFAULT '0',
  `dpa_byr` double DEFAULT '0',
  `sppttp_byr` double DEFAULT '0',
  `tgl_byr` datetime DEFAULT NULL,
  PRIMARY KEY (`id_transbayar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabel histroi poembayaran untuk her registrasi';

-- Dumping data for table pmb.pmb_transbayar: ~0 rows (approximately)
/*!40000 ALTER TABLE `pmb_transbayar` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmb_transbayar` ENABLE KEYS */;


-- Dumping structure for view pmb.rankingkota
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `rankingkota` 
) ENGINE=MyISAM;


-- Dumping structure for view pmb.rankingsekolah
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `rankingsekolah` 
) ENGINE=MyISAM;


-- Dumping structure for view pmb.sebaranasal
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `sebaranasal` 
) ENGINE=MyISAM;


-- Dumping structure for trigger pmb.log_hps_pmb_herregistrasi
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `log_hps_pmb_herregistrasi` AFTER DELETE ON `pmb_herregistrasi` FOR EACH ROW BEGIN
INSERT into hps_pmb_herregistrasi values (OLD.id_daftar,OLD.tgl_herregistrasi,OLD.nim,OLD.ukuran_jaz,OLD.kelas,OLD.angkatan,OLD.id_user,NOW());END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger pmb.log_hps_pmb_testpa
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `log_hps_pmb_testpa` AFTER DELETE ON `pmb_testpa` FOR EACH ROW BEGIN
INSERT INTO hps_pmb_testpa values (old.id_testpa,old.id_daftar,old.id_soal,old.id_jawaban,old.tgl_tes,NOW());END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for view pmb.rankingkota
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `rankingkota`;
CREATE ALGORITHM=UNDEFINED DEFINER=`ict`@`%` VIEW `rankingkota` AS select `d`.`kd_kota` AS `kd_kota`,`c`.`nama_kecamatan` AS `kecamatan`,`d`.`nama_kota` AS `kota`,`e`.`nama_propinsi` AS `propinsi`,count(`a`.`kd_sekolah`) AS `jml` from ((((`pmb_pendaftar` `a` left join `mst_sekolah` `b` on((`a`.`kd_sekolah` = `b`.`kd_sekolah`))) left join `mst_kecamatan` `c` on((`b`.`kec_sekolah` = `c`.`kd_kecamatan`))) left join `mst_kota` `d` on((`c`.`kd_kota` = `d`.`kd_kota`))) left join `mst_propinsi` `e` on((`d`.`kd_propinsi` = `e`.`kd_propinsi`))) group by `c`.`kd_kota` ;


-- Dumping structure for view pmb.rankingsekolah
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `rankingsekolah`;
CREATE ALGORITHM=UNDEFINED DEFINER=`ict`@`%` VIEW `rankingsekolah` AS select `a`.`kd_sekolah` AS `kd_sekolah`,`d`.`kd_kota` AS `kd_kota`,`b`.`nama_sekolah` AS `sekolah`,`c`.`nama_kecamatan` AS `kecamatan`,`d`.`nama_kota` AS `kota`,`e`.`nama_propinsi` AS `propinsi`,count(`a`.`kd_sekolah`) AS `jml` from ((((`pmb_pendaftar` `a` left join `mst_sekolah` `b` on((`a`.`kd_sekolah` = `b`.`kd_sekolah`))) left join `mst_kecamatan` `c` on((`b`.`kec_sekolah` = `c`.`kd_kecamatan`))) left join `mst_kota` `d` on((`c`.`kd_kota` = `d`.`kd_kota`))) left join `mst_propinsi` `e` on((`d`.`kd_propinsi` = `e`.`kd_propinsi`))) group by `a`.`kd_sekolah` ;


-- Dumping structure for view pmb.sebaranasal
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `sebaranasal`;
CREATE ALGORITHM=UNDEFINED DEFINER=`ict`@`%` VIEW `sebaranasal` AS select `c`.`kd_propinsi` AS `kd`,`c`.`nama_propinsi` AS `prop`,count(`a`.`id_daftar`) AS `jml` from ((`mst_kota` `b` left join `pmb_pendaftar` `a` on((`a`.`kab_asal` = `b`.`kd_kota`))) join `mst_propinsi` `c` on((`b`.`kd_propinsi` = `c`.`kd_propinsi`))) group by `b`.`kd_propinsi` ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
