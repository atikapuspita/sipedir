-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Sep 2022 pada 08.39
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakad`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_doswal`
--

CREATE TABLE `tb_doswal` (
  `id_doswal` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_doswal`
--

INSERT INTO `tb_doswal` (`id_doswal`, `id_kelas`, `id_pegawai`, `status`) VALUES
(12, 14, 27, 1),
(13, 16, 26, 1),
(14, 15, 31, 1),
(15, 17, 29, 1),
(16, 18, 28, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(12, 'Teknik Elektronika'),
(13, 'Teknik Informatika'),
(14, 'Teknik Mesin'),
(15, 'Teknik Pengendalian Pencemaran Lingkungan'),
(16, 'Pengembangan Produk Agroindustri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kajur`
--

CREATE TABLE `tb_kajur` (
  `id_kajur` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kajur`
--

INSERT INTO `tb_kajur` (`id_kajur`, `id_jurusan`, `id_pegawai`, `status`) VALUES
(11, 12, 20, 1),
(12, 13, 22, 1),
(13, 15, 24, 1),
(14, 14, 21, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `id_prodi`, `nama_kelas`) VALUES
(14, 15, 'TI 3C'),
(15, 15, 'TI 2C'),
(16, 15, 'TI 3A'),
(17, 15, 'TI 1A'),
(18, 15, 'TI 2A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `npm` char(10) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `username_mhs` varchar(10) NOT NULL,
  `password_mhs` varchar(10) NOT NULL,
  `jk` enum('Laki - Laki','Perempuan') NOT NULL,
  `thn_angkatan` char(10) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp_mhs` varchar(13) NOT NULL,
  `foto_mhs` blob NOT NULL,
  `ttd_mhs` blob NOT NULL,
  `ttl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`id_mahasiswa`, `id_kelas`, `npm`, `nama_mhs`, `username_mhs`, `password_mhs`, `jk`, `thn_angkatan`, `alamat`, `no_telp_mhs`, `foto_mhs`, `ttd_mhs`, `ttl`) VALUES
(21, 14, '190102029', 'Atika Puspitasari', 'atika', 'atika', 'Perempuan', '2019/2020', 'Cilacap', '085876684648', 0x666f746f5f6d68735f62617275363265393630333761316230662e706e67, 0x7474645f6d68735f62617275363265393630333761343963302e706e67, 2001),
(22, 16, '190102001', 'Fezila Fetri Geby', 'fezi', 'fezi', 'Perempuan', '2019/2020', 'Cilacap Utara', '085876684648', 0x666f746f5f6d68735f62617275363265393630643364303835622e6a7067, 0x7474645f6d68735f62617275363265393630643364313536302e706e67, 2001),
(23, 14, '190102030', 'Tri Mujilestari', 'tari', 'tari', 'Perempuan', '2019/2020', 'Binangun', '085876684648', 0x666f746f5f6d68735f62617275363265393631316665363930372e6a7067, 0x7474645f6d68735f62617275363265393631316665373237362e6a7067, 2001),
(24, 14, '190102028', 'Anggita Dwi Fatimah', 'anggita', 'anggita', 'Perempuan', '2019/2020', 'Menganti', '085876684648', 0x666f746f5f6d68735f62617275363265393631373266316538332e706e67, 0x7474645f6d68735f62617275363265393631373266333332322e706e67, 2001),
(25, 14, '190202073', 'Qonaah Anggit Nurjanah', 'concon', 'concon', 'Perempuan', '2019/2020', 'Maos', '085876684648', 0x666f746f5f6d68735f62617275363265393631636432313263642e6a7067, 0x7474645f6d68735f62617275363265393631636432323063632e706e67, 2001),
(26, 14, '190102026', 'Andhina Hayuningtyas', 'andin', 'andin', 'Perempuan', '2019/2020', 'Cilacap Utara', '085876684648', 0x666f746f5f6d68735f62617275363265393632323232373034662e6a7067, 0x7474645f6d68735f62617275363265393632323232383736322e6a7067, 2001),
(27, 16, '190102002', 'Inne Wiwin', 'ine', 'ine', 'Perempuan', '2019/2020', 'Cilacap', '085876684648', 0x666f746f5f6d68735f62617275363265393632376538323762392e706e67, 0x7474645f6d68735f62617275363265393632376538333231632e6a7067, 2001),
(28, 16, '190202047', 'Yulia Dewi', 'yuli', 'yuli', 'Perempuan', '2019/2020', 'Cilacap Tengah', '085876684648', 0x666f746f5f6d68735f62617275363265393633626339613631322e6a7067, 0x7474645f6d68735f62617275363265393633626339616663352e706e67, 2001),
(29, 16, '1901020204', 'Surya Aji Sevyanto', 'surya', 'surya', 'Laki - Laki', '2019/2020', 'Cilacap', '085876684648', 0x666f746f5f6d68735f62617275363265393634313634353537372e6a7067, 0x7474645f6d68735f62617275363265393634313634356466612e706e67, 2000),
(30, 14, '190102024', 'Faiz Abdul Ghoni', 'faiz', 'faiz', 'Laki - Laki', '2019/2020', 'Cilacap', '085876684648', 0x666f746f5f6d68735f62617275363265393634373532393366622e706e67, 0x7474645f6d68735f62617275363265393634373532613730382e706e67, 2001),
(31, 14, '190102023', 'Irfan Perdana Effendi', 'irfan', 'irfan', 'Laki - Laki', '2019/2020', 'Cilacap', '085876684648', 0x666f746f5f6d68735f62617275363265393634643536373430662e6a7067, 0x7474645f6d68735f62617275363265393634643536376337372e6a7067, 2001),
(32, 14, '190202064', 'R.Cakradana Ardhanurahman Yudhatama', 'cakra', 'cakra', 'Laki - Laki', '2019/2020', 'Cilacap Tengah', '085876684648', 0x666f746f5f6d68735f62617275363265393635326635366363392e6a7067, 0x7474645f6d68735f62617275363265393635326635373432302e6a7067, 2001);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip_npak` char(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jabatan` enum('1','2','3','4','5','6','7','0') NOT NULL,
  `no_telp_pegawai` varchar(13) NOT NULL,
  `foto_pegawai` varchar(255) NOT NULL,
  `ttd_pegawai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_pegawai`, `nip_npak`, `username`, `password`, `nama_pegawai`, `jabatan`, `no_telp_pegawai`, `foto_pegawai`, `ttd_pegawai`) VALUES
(9, '197911172021212009', 'adminbaak', 'baak', 'Dwi Novia Prasetyanti, S.Kom.M.Cs.', '0', '088803952621', 'foto_pegawai_baru62e950dfb0a7b.jpg', 'ttd_pegawai_baru62d75347705ff.jpg'),
(20, '198509172019031005', 'galih', 'galis', 'Galih Mustiko Aji, S.T., M.T', '2', '085876684648', 'foto_pegawai_baru62e954744d6ed.png', 'ttd_pegawai_baru62e954744f1f5.jpg'),
(21, '197703022021211008', 'joko', 'joko', 'Joko Setia Pribadi, S.T., M.Eng', '2', '085876684648', 'foto_pegawai_baru62e954ea4950c.jpg', 'ttd_pegawai_baru62e954ea4a176.png'),
(22, '198105092021211004', 'kajur', 'kajur', 'Nur wahyu Rahadi, S.Kom., M.Eng', '2', '085876684648', 'foto_pegawai_baru62e95532b4ac6.jpg', 'ttd_pegawai_baru62e95532b59b1.jpg'),
(23, '198412012018032001', 'perpus', 'perpus', 'Cahya Vikasari, S.T., MEng', '4', '085876684648', 'foto_pegawai_baru62e9556ab7621.jpg', 'ttd_pegawai_baru62e9556ab7ebe.png'),
(24, '04178028', 'taufan', 'taufan', 'Taufan Ratri Harjanto, S.T., M.Eng', '2', '085876684648', 'foto_pegawai_baru62e955a460efa.jpg', 'ttd_pegawai_baru62e955a461a2d.jpg'),
(25, '197912062010121001', 'keuangan', 'keuangan', 'Faidzin Firdhaus, S.E., M.Ak', '3', '085876684648', 'foto_pegawai_baru62e955de7d743.png', 'ttd_pegawai_baru62e955de7e69c.png'),
(26, '196611212021211002', 'isa', 'isa', 'Isa Bahroni, S.Kom, MEng', '1', '085876684648', 'foto_pegawai_baru62e956468171f.png', 'ttd_pegawai_baru62e9564682b0a.png'),
(27, '198405072019031011', 'doswal', 'doswal', 'Andesita Prihantara, S.T., M.Eng', '1', '085876684648', 'foto_pegawai_baru62e95691c4bda.jpg', 'ttd_pegawai_baru62e95691c531a.png'),
(28, '199008082019031017', 'abdau', 'abdau', 'Prih Diantono Abdau, S.Kom., M.Kom', '1', '085876684648', 'foto_pegawai_baru62e957d55158c.png', 'ttd_pegawai_baru62e957d552dc3.jpg'),
(29, '199307142019032026', 'santi', 'santi', 'Santi Purwaningrum, S.Kom., M.Kom', '1', '085876684648', 'foto_pegawai_baru62e958e87884e.jpg', 'ttd_pegawai_baru62e958e87965b.png'),
(30, '09103008', 'abdul', 'abdul', 'Abdul Rohman Supriyono, S.T., M.Kom', '1', '085876684648', 'foto_pegawai_baru62e9593b1bd0a.png', 'ttd_pegawai_baru62e9593b1cda9.jpg'),
(31, '05168018', 'lutfi', 'lutfi', 'Lutfi Syafirullah, S.T. M.Kom', '1', '085876684648', 'foto_pegawai_baru62e959738966a.jpg', 'ttd_pegawai_baru62e959738a214.png'),
(32, '08001', 'wadir', 'wadir', 'Dr.Eng Agus Santoso', '5', '085876684648', 'foto_pegawai_baru62e959b8928ec.jpg', 'ttd_pegawai_baru62e959b893176.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `alasan` varchar(100) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `nama_ortu` varchar(50) NOT NULL,
  `ttd_ortu` blob NOT NULL,
  `berkas_pendukung` blob DEFAULT NULL,
  `status_pengajuan` enum('0','1','2','3','4','5') NOT NULL,
  `no_sk` varchar(50) DEFAULT NULL,
  `file_sk` blob DEFAULT NULL,
  `nilai` blob DEFAULT NULL,
  `semester` char(10) NOT NULL,
  `surat_persetujuan_ortu` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`id_pengajuan`, `id_mahasiswa`, `alasan`, `tgl_pengajuan`, `nama_ortu`, `ttd_ortu`, `berkas_pendukung`, `status_pengajuan`, `no_sk`, `file_sk`, `nilai`, `semester`, `surat_persetujuan_ortu`) VALUES
(55, 31, 'Pindah Kampus', '2022-09-13', 'Siti Zumrotun', 0x7474645f6f7274755f62617275363332306230663437333233332e706e67, 0x6265726b61735f62617275363332306230663437343731342e706466, '5', NULL, NULL, NULL, '4', 0x7372745f6f727475363332306230663437353632632e706466),
(56, 21, 'Di terima kerja', '2022-09-13', 'Siti Zumrotun', 0x7474645f6f7274755f62617275363332306232323930643763382e706e67, 0x6265726b61735f62617275363332306232323930653231612e706466, '4', '041/01/III - 2021/BAAK', 0x736b363332306234666139353737322e706466, 0x6e696c6169363332306234666139363563352e706466, '3', 0x7372745f6f727475363332306232323930653763372e706466),
(57, 31, 'Pindah Kampus', '2022-09-27', 'Siti Zumrotun', 0x7474645f6f7274755f62617275363333333162313037373765312e706e67, 0x6265726b61735f62617275363333333162313037396631652e706466, '1', NULL, NULL, NULL, '2', 0x7372745f6f727475363333333162313037616134662e706466);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_prodi`
--

CREATE TABLE `tb_prodi` (
  `id_prodi` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_prodi`
--

INSERT INTO `tb_prodi` (`id_prodi`, `id_jurusan`, `nama_prodi`) VALUES
(13, 12, 'D3 Teknik Listrik'),
(14, 12, 'D3 Teknik Elektronika'),
(15, 13, 'D3 Teknik Informatika'),
(16, 14, 'D3 Teknik Mesin'),
(17, 15, 'D4 Teknik Pengendalian Pencemaran Lingkungan'),
(18, 16, 'D4 Pengembangan Produk Agroindustri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_unit_kerja`
--

CREATE TABLE `tb_unit_kerja` (
  `id_unit` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `nama_unit` varchar(75) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_unit_kerja`
--

INSERT INTO `tb_unit_kerja` (`id_unit`, `id_pegawai`, `nama_unit`, `status`) VALUES
(7, 23, 'Bagian Perpustakaan', 1),
(8, 25, 'Bagian Keuangan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_verifikasi_doswal`
--

CREATE TABLE `tb_verifikasi_doswal` (
  `id_verifikasi` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `id_doswal` int(11) DEFAULT NULL,
  `tgl_verifikasi` date DEFAULT NULL,
  `status_verifikasi` varchar(20) DEFAULT NULL,
  `status_pengajuan` enum('1','5') NOT NULL,
  `alasan_tolak` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_verifikasi_doswal`
--

INSERT INTO `tb_verifikasi_doswal` (`id_verifikasi`, `id_pengajuan`, `id_doswal`, `tgl_verifikasi`, `status_verifikasi`, `status_pengajuan`, `alasan_tolak`) VALUES
(65, 55, 12, '2022-09-13', 'Ditolak', '5', 'data tidak lengkap'),
(66, 56, 12, '2022-09-13', 'Diverifikasi', '1', NULL),
(67, 57, 12, '2022-09-28', 'Diverifikasi', '1', NULL);

--
-- Trigger `tb_verifikasi_doswal`
--
DELIMITER $$
CREATE TRIGGER `trg_acc` AFTER INSERT ON `tb_verifikasi_doswal` FOR EACH ROW BEGIN
	IF NEW.status_verifikasi = 'Diverifikasi' THEN
	UPDATE tb_pengajuan SET status_pengajuan = NEW.status_pengajuan WHERE id_pengajuan = NEW.id_pengajuan;
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_tolak` AFTER INSERT ON `tb_verifikasi_doswal` FOR EACH ROW BEGIN
	IF NEW.status_verifikasi = 'Ditolak' THEN
	UPDATE tb_pengajuan SET status_pengajuan = '5' WHERE id_pengajuan = NEW.id_pengajuan;
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_verifikasi_kajur`
--

CREATE TABLE `tb_verifikasi_kajur` (
  `id_verifikasi` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `id_kajur` int(11) NOT NULL,
  `tgl_verifikasi` date NOT NULL,
  `status_verifikasi` varchar(20) NOT NULL,
  `status_pengajuan` enum('4','5') NOT NULL,
  `alasan_tolak` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_verifikasi_kajur`
--

INSERT INTO `tb_verifikasi_kajur` (`id_verifikasi`, `id_pengajuan`, `id_kajur`, `tgl_verifikasi`, `status_verifikasi`, `status_pengajuan`, `alasan_tolak`) VALUES
(10, 56, 12, '2022-09-13', 'Diverifikasi', '4', NULL);

--
-- Trigger `tb_verifikasi_kajur`
--
DELIMITER $$
CREATE TRIGGER `trg_acc2` AFTER INSERT ON `tb_verifikasi_kajur` FOR EACH ROW BEGIN
	IF NEW.status_verifikasi = 'Diverifikasi' THEN
	UPDATE tb_pengajuan SET status_pengajuan = NEW.status_pengajuan WHERE id_pengajuan = NEW.id_pengajuan;
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_tolak2` AFTER INSERT ON `tb_verifikasi_kajur` FOR EACH ROW BEGIN
	IF NEW.status_verifikasi = 'Ditolak' THEN
	UPDATE tb_pengajuan SET status_pengajuan = '5' WHERE id_pengajuan = NEW.id_pengajuan;
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_verifikasi_unit`
--

CREATE TABLE `tb_verifikasi_unit` (
  `id_verifikasi` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `tgl_verifikasi` date NOT NULL,
  `status_verifikasi` varchar(20) NOT NULL,
  `status_pengajuan` enum('2','3','5') NOT NULL,
  `alasan_tolak` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_verifikasi_unit`
--

INSERT INTO `tb_verifikasi_unit` (`id_verifikasi`, `id_pengajuan`, `id_unit`, `tgl_verifikasi`, `status_verifikasi`, `status_pengajuan`, `alasan_tolak`) VALUES
(28, 56, 7, '2022-09-13', 'Diverifikasi', '2', NULL),
(29, 56, 8, '2022-09-13', 'Diverifikasi', '3', NULL);

--
-- Trigger `tb_verifikasi_unit`
--
DELIMITER $$
CREATE TRIGGER `tgr_acc3` AFTER INSERT ON `tb_verifikasi_unit` FOR EACH ROW BEGIN
	IF NEW.status_verifikasi = 'Diverifikasi' THEN
	UPDATE tb_pengajuan SET status_pengajuan = NEW.status_pengajuan WHERE id_pengajuan = NEW.id_pengajuan;
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tgr_tolak` AFTER INSERT ON `tb_verifikasi_unit` FOR EACH ROW BEGIN
	IF NEW.status_verifikasi = 'Ditolak' THEN
	UPDATE tb_pengajuan SET status_pengajuan = '5' WHERE id_pengajuan = NEW.id_pengajuan;
	END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_doswal`
--
ALTER TABLE `tb_doswal`
  ADD PRIMARY KEY (`id_doswal`),
  ADD KEY `fk_tb_waldos_tb_kelas` (`id_kelas`),
  ADD KEY `fk_tb_waldos_tb_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id_jurusan`) USING BTREE;

--
-- Indeks untuk tabel `tb_kajur`
--
ALTER TABLE `tb_kajur`
  ADD PRIMARY KEY (`id_kajur`),
  ADD KEY `fk_tb_kajur_tb_jurusan` (`id_jurusan`),
  ADD KEY `fk_tb_kajur_tb_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `fk_tb_kelas_tb_prodi` (`id_prodi`) USING BTREE;

--
-- Indeks untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD KEY `fk_tb_mahasiswa_tb_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `fk_tb_pengajuan_tb_mahasiswa` (`id_mahasiswa`);

--
-- Indeks untuk tabel `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `fk_tb_prodi_tb_jurusans` (`id_jurusan`);

--
-- Indeks untuk tabel `tb_unit_kerja`
--
ALTER TABLE `tb_unit_kerja`
  ADD PRIMARY KEY (`id_unit`),
  ADD KEY `fk_tb_unit_kerja_tb_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `tb_verifikasi_doswal`
--
ALTER TABLE `tb_verifikasi_doswal`
  ADD PRIMARY KEY (`id_verifikasi`),
  ADD KEY `fk_tb_verifikasi_tb_pengajuan` (`id_pengajuan`),
  ADD KEY `fk_tb_verifikasi_tb_doswal` (`id_doswal`);

--
-- Indeks untuk tabel `tb_verifikasi_kajur`
--
ALTER TABLE `tb_verifikasi_kajur`
  ADD PRIMARY KEY (`id_verifikasi`),
  ADD KEY `fk_tb_verifikasi_kajur_tb_pengajuan` (`id_pengajuan`),
  ADD KEY `fk_tb_verifikasi_kajur_tb_kajur` (`id_kajur`);

--
-- Indeks untuk tabel `tb_verifikasi_unit`
--
ALTER TABLE `tb_verifikasi_unit`
  ADD PRIMARY KEY (`id_verifikasi`),
  ADD KEY `fk_tb_verifikasi_unit_tb_pengajuan` (`id_pengajuan`),
  ADD KEY `fk_tb_verifikasi_unit_tb_unit` (`id_unit`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_doswal`
--
ALTER TABLE `tb_doswal`
  MODIFY `id_doswal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_kajur`
--
ALTER TABLE `tb_kajur`
  MODIFY `id_kajur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `tb_prodi`
--
ALTER TABLE `tb_prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_unit_kerja`
--
ALTER TABLE `tb_unit_kerja`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_verifikasi_doswal`
--
ALTER TABLE `tb_verifikasi_doswal`
  MODIFY `id_verifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `tb_verifikasi_kajur`
--
ALTER TABLE `tb_verifikasi_kajur`
  MODIFY `id_verifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_verifikasi_unit`
--
ALTER TABLE `tb_verifikasi_unit`
  MODIFY `id_verifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_doswal`
--
ALTER TABLE `tb_doswal`
  ADD CONSTRAINT `fk_tb_waldos_tb_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`),
  ADD CONSTRAINT `fk_tb_waldos_tb_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`);

--
-- Ketidakleluasaan untuk tabel `tb_kajur`
--
ALTER TABLE `tb_kajur`
  ADD CONSTRAINT `fk_tb_kajur_tb_jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `tb_jurusan` (`id_jurusan`),
  ADD CONSTRAINT `fk_tb_kajur_tb_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`);

--
-- Ketidakleluasaan untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD CONSTRAINT `fk_tb_kelas_tb_prodi` FOREIGN KEY (`id_prodi`) REFERENCES `tb_prodi` (`id_prodi`);

--
-- Ketidakleluasaan untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD CONSTRAINT `fk_tb_mahasiswa_tb_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`);

--
-- Ketidakleluasaan untuk tabel `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD CONSTRAINT `fk_tb_pengajuan_tb_mahasiswa` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tb_mahasiswa` (`id_mahasiswa`);

--
-- Ketidakleluasaan untuk tabel `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD CONSTRAINT `fk_tb_prodi_tb_jurusans` FOREIGN KEY (`id_jurusan`) REFERENCES `tb_jurusan` (`id_jurusan`);

--
-- Ketidakleluasaan untuk tabel `tb_unit_kerja`
--
ALTER TABLE `tb_unit_kerja`
  ADD CONSTRAINT `fk_tb_unit_kerja_tb_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`);

--
-- Ketidakleluasaan untuk tabel `tb_verifikasi_doswal`
--
ALTER TABLE `tb_verifikasi_doswal`
  ADD CONSTRAINT `fk_tb_verifikasi_tb_doswal` FOREIGN KEY (`id_doswal`) REFERENCES `tb_doswal` (`id_doswal`),
  ADD CONSTRAINT `fk_tb_verifikasi_tb_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `tb_pengajuan` (`id_pengajuan`);

--
-- Ketidakleluasaan untuk tabel `tb_verifikasi_kajur`
--
ALTER TABLE `tb_verifikasi_kajur`
  ADD CONSTRAINT `fk_tb_verifikasi_kajur_tb_kajur` FOREIGN KEY (`id_kajur`) REFERENCES `tb_kajur` (`id_kajur`),
  ADD CONSTRAINT `fk_tb_verifikasi_kajur_tb_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `tb_pengajuan` (`id_pengajuan`);

--
-- Ketidakleluasaan untuk tabel `tb_verifikasi_unit`
--
ALTER TABLE `tb_verifikasi_unit`
  ADD CONSTRAINT `fk_tb_verifikasi_unit_tb_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `tb_pengajuan` (`id_pengajuan`),
  ADD CONSTRAINT `fk_tb_verifikasi_unit_tb_unit` FOREIGN KEY (`id_unit`) REFERENCES `tb_unit_kerja` (`id_unit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
