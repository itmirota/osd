-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 20 Agu 2024 pada 13.44
-- Versi server: 10.6.18-MariaDB-cll-lve
-- Versi PHP: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `susukita_osd`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_absensi`
--

CREATE TABLE `tbl_absensi` (
  `id_absensi` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time_in` time NOT NULL,
  `latitude_in` varchar(255) NOT NULL,
  `longitude_in` varchar(255) NOT NULL,
  `bukti_absensi_in` varchar(255) NOT NULL,
  `time_out` time DEFAULT NULL,
  `latitude_out` varchar(255) NOT NULL,
  `longitude_out` varchar(255) NOT NULL,
  `bukti_absensi_out` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_absensi`
--

INSERT INTO `tbl_absensi` (`id_absensi`, `pegawai_id`, `date`, `time_in`, `latitude_in`, `longitude_in`, `bukti_absensi_in`, `time_out`, `latitude_out`, `longitude_out`, `bukti_absensi_out`) VALUES
(1, 113, '2024-08-07', '15:02:03', '-7.7795562', '110.4345351', 'image_1723017723.jpg', NULL, '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_approval_cuti`
--

CREATE TABLE `tbl_approval_cuti` (
  `id_approval` int(11) NOT NULL,
  `cuti_id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `status` enum('Y','N','T') NOT NULL,
  `datecreated` datetime NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_approval_izin`
--

CREATE TABLE `tbl_approval_izin` (
  `id_approval_izin` int(11) NOT NULL,
  `izin_id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `status` enum('Y','N','T') NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_approval_izinharian`
--

CREATE TABLE `tbl_approval_izinharian` (
  `id_approval_izinharian` int(11) NOT NULL,
  `perizinan_harian_id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `status` enum('Y','N','T') NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_approval_tugas`
--

CREATE TABLE `tbl_approval_tugas` (
  `id_approval_tugas` int(11) NOT NULL,
  `tugas_id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `status` enum('Y','T') NOT NULL,
  `datecreated` datetime NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `spesifikasi_barang` text NOT NULL,
  `divisi_id` varchar(50) NOT NULL,
  `tgl_pembelian` date DEFAULT NULL,
  `stok_barang_normal` int(11) NOT NULL,
  `stok_barang_dipinjam` int(11) NOT NULL DEFAULT 0,
  `stok_barang_rusak` int(11) NOT NULL DEFAULT 0,
  `keterangan_barang` int(11) NOT NULL,
  `qrcode_barang` varchar(50) NOT NULL,
  `status_barang` varchar(50) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `spesifikasi_barang`, `divisi_id`, `tgl_pembelian`, `stok_barang_normal`, `stok_barang_dipinjam`, `stok_barang_rusak`, `keterangan_barang`, `qrcode_barang`, `status_barang`, `userId`) VALUES
(1, 'Komputer', '', '12', '2024-03-25', 0, 1, 0, 2, 'barang_1.png', '', 10),
(2, 'headset', '', '3', '2024-06-04', 8, 2, 0, 2, 'barang_2.png', '', 10),
(3, 'kursi', '', '3', '2024-07-01', 12, 0, 0, 1, 'barang_3.png', '', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_divisi`
--

CREATE TABLE `tbl_divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL,
  `kadiv_id` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_divisi`
--

INSERT INTO `tbl_divisi` (`id_divisi`, `nama_divisi`, `kadiv_id`, `manager_id`) VALUES
(1, 'PENGELOLA', NULL, NULL),
(2, 'PRODUKSI', 242, 131),
(3, 'PPIC', NULL, 131),
(4, 'QUALITY', 19, 131),
(5, 'RND', 51, 131),
(6, 'TEKNIK', 33, 131),
(7, 'HRGA', 65, 76),
(8, 'HRBP', 262, 76),
(9, 'KEUANGAN', 132, 76),
(10, 'AKUNTANSI', 132, 76),
(11, 'PURCHASING', 265, 131),
(12, 'IT', NULL, 76),
(13, 'DIGITAL MARKETING', 0, 125),
(14, 'BRAND', 0, 125),
(15, 'PROMOSI', 86, 261),
(16, 'MARKETING', NULL, 261);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(20) NOT NULL,
  `tingkat_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_jabatan`
--

INSERT INTO `tbl_jabatan` (`id_jabatan`, `nama_jabatan`, `tingkat_jabatan`) VALUES
(1, 'Direktur', 1),
(2, 'General Manager', 2),
(3, 'Manager', 3),
(4, 'Kepala Divisi', 4),
(5, 'Staff', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kendaraan`
--

CREATE TABLE `tbl_kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `jenis_kendaraan` varchar(20) NOT NULL,
  `merek_kendaraan` varchar(20) NOT NULL,
  `nomor_polisi` varchar(20) NOT NULL,
  `tgl_stnk` date NOT NULL,
  `tahun` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kendaraan`
--

INSERT INTO `tbl_kendaraan` (`id_kendaraan`, `jenis_kendaraan`, `merek_kendaraan`, `nomor_polisi`, `tgl_stnk`, `tahun`, `status`) VALUES
(0, 'kendaraan pribadi', '', '', '0000-00-00', '', ''),
(1, 'mobil', 'CHEVROLET SPIN', 'AB 1029 UN', '2023-02-27', '2014', ''),
(2, 'mobil', 'MERCEDES BENZ/S 320', 'AB 1105 CZ', '2023-10-22', '2003', ''),
(3, 'montor', 'HONDA VARIO BIRU ', 'AB 2960 NI', '2023-08-06', '2012', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kerusakan_barang`
--

CREATE TABLE `tbl_kerusakan_barang` (
  `id_kerusakan_barang` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jml_barang` int(11) NOT NULL,
  `keterangan_kerusakan_barang` text NOT NULL,
  `bukti_kerusakan_barang` varchar(50) NOT NULL,
  `datecreated` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `is_read` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kerusakan_barang`
--

INSERT INTO `tbl_kerusakan_barang` (`id_kerusakan_barang`, `barang_id`, `jml_barang`, `keterangan_kerusakan_barang`, `bukti_kerusakan_barang`, `datecreated`, `status`, `is_read`) VALUES
(2, 1, 1, 'tes', 'favicon.png', '2024-07-01 10:40:03', 0, 0),
(3, 2, 1, 'kabelnya putus', 'boxed-bg.png', '2024-07-03 09:54:50', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kerusakan_ruangan`
--

CREATE TABLE `tbl_kerusakan_ruangan` (
  `id_kerusakan_ruangan` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `keterangan_kerusakan_ruangan` text NOT NULL,
  `bukti_kerusakan_ruangan` varchar(255) NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0,
  `datecreated` datetime NOT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kerusakan_ruangan`
--

INSERT INTO `tbl_kerusakan_ruangan` (`id_kerusakan_ruangan`, `ruangan_id`, `keterangan_kerusakan_ruangan`, `bukti_kerusakan_ruangan`, `is_read`, `datecreated`, `status`) VALUES
(2, 1, 'bolong', 'favicon.png', 0, '2024-07-01 10:49:06', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `status_pegawai` enum('kontrak','tetap') NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT '',
  `tgl_lahir` date DEFAULT NULL,
  `shio` varchar(50) NOT NULL,
  `zodiak` varchar(50) NOT NULL,
  `weton` varchar(50) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `pendidikan_terakhir` varchar(50) NOT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `golongan_darah` char(2) DEFAULT NULL,
  `agama` varchar(50) NOT NULL,
  `alamat_ktp` varchar(255) NOT NULL,
  `alamat_domisili` varchar(255) NOT NULL,
  `kontak_pegawai` varchar(50) NOT NULL,
  `no_kk` varchar(255) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `no_jamsostek` varchar(255) DEFAULT NULL,
  `no_bpjsKesehatan` varchar(255) DEFAULT NULL,
  `no_npwp` varchar(255) DEFAULT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `durasi_kontrak` int(11) DEFAULT 0,
  `kuota_cuti` int(11) NOT NULL,
  `sisa_cuti` int(11) NOT NULL DEFAULT 0,
  `email_pegawai` varchar(50) NOT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `status_pernikahan` varchar(50) NOT NULL,
  `nama_pasangan` varchar(50) NOT NULL,
  `nama_anak` varchar(50) NOT NULL,
  `status` enum('aktif','tidak') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pegawai`, `nip`, `nama_pegawai`, `jabatan_id`, `divisi_id`, `status_pegawai`, `tempat_lahir`, `tgl_lahir`, `shio`, `zodiak`, `weton`, `jenis_kelamin`, `pendidikan_terakhir`, `jurusan`, `golongan_darah`, `agama`, `alamat_ktp`, `alamat_domisili`, `kontak_pegawai`, `no_kk`, `no_ktp`, `no_jamsostek`, `no_bpjsKesehatan`, `no_npwp`, `tgl_masuk`, `tgl_selesai`, `tgl_keluar`, `durasi_kontrak`, `kuota_cuti`, `sisa_cuti`, `email_pegawai`, `nama_ibu`, `nama_ayah`, `status_pernikahan`, `nama_pasangan`, `nama_anak`, `status`) VALUES
(1, '0001', 'AGUS ARIYANTO', 4, 16, 'tetap', 'Yogyakarta', '1969-06-14', 'Ayam', 'Gemini', 'Sabtu Pon', 'L', 'S1', 'Budidaya Pertanian', 'O', 'ISLAM', 'Kasatrian Polri, Balapan, Yogya', 'Kasatrian Polri, Balapan, Yogya', '0818 272 749', '3471 0304 0902 0350', '3471 0314 0669 0001', NULL, NULL, NULL, '1996-03-01', NULL, NULL, 0, 7, 0, 'agus@mirota.co.id', NULL, '', 'menikah', 'SRI SUPRAPTI, S.SOS.', 'TRISTAN ARIASEPTA', 'aktif'),
(2, '0002', 'WELLY PURWANTORO', 5, 16, 'tetap', 'Yogyakarta', '1978-07-05', 'Kuda', 'Cancer', 'Rabu Legi', 'L', 'STM', 'Elektronika', 'B', 'ISLAM', 'Jl. Solo KM 7 Ngentak Gg. Mangga 4/22 A Caturtunggal, Depok, Sleman, Yogyakarta', 'Jl. Solo KM 7 Ngentak Gg. Mangga 4/22 A Caturtunggal, Depok, Sleman, Yogyakarta', '0812 7906 441', '3404 0712 0706 0000', '3404 0705 0778 0006', NULL, NULL, NULL, '1997-08-01', NULL, NULL, 0, 7, 0, 'wellypurwantoro@ymail.com', 'SRI SULISTYANI KUSUMA H.', '', 'menikah', 'MARINI DEWI SETYAWATI', 'AZRA PUTRI ANINDITA', 'aktif'),
(3, '0003', 'SIDIQ PURNOMO', 5, 16, 'tetap', 'Magelang', '1974-07-28', 'Macan', 'Leo', 'Minggu Pon', 'L', 'SLTA', NULL, 'O', 'ISLAM', 'Jl. Mangga 66 Mangga 22, Way Dadi, Sukarame, Bandar Lampung', 'Jl. Mangga 66 Mangga 22, Way Dadi, Sukarame, Bandar Lampung', '0812 7254 0595', '1871 0220 0407 0000', '1871 0228 0774 0003', NULL, NULL, NULL, '1997-09-23', NULL, NULL, 0, 8, 0, 'sidiqpurnomo101@gmail.com', 'SITI ASIYAH', '', 'menikah', 'SUSI MARLIANTI', 'BINTANG. M, ZIDAN. A', 'aktif'),
(4, '0004', 'RAKHMAT HIDAYAT', 5, 7, 'tetap', 'Sleman', '1977-02-20', 'Ular', 'Pisces', 'Minggu Legi', 'L', 'SLTP', NULL, 'B', 'ISLAM', 'Sumber RT.01 RW.11 Balecatur, Gamping, Sleman', 'Sumber RT.01 RW.11 Balecatur, Gamping, Sleman', '0813 2809 9487', '3404 0111 0208 0060', '3404 0120 0277 0001', NULL, NULL, NULL, '2000-06-16', NULL, NULL, 0, 11, 0, 'rakhmathidayat126@gmail.com', 'MUKIRAH', '', 'menikah', 'SUNARSIH', 'HAFSAH NADIA KARIMAH', 'aktif'),
(5, '0005', 'TUWASNO', 4, 16, 'tetap', 'Yogyakarta', '1979-08-24', 'Kambing', 'Virgo', 'Jumat Legi', 'L', 'SLTA', NULL, NULL, 'ISLAM', 'Dsn. Kejoyo RT 02 RW 01 Tambong, Kabat, Banyuwangi', 'Dsn. Kejoyo RT 02 RW 01 Tambong, Kabat, Banyuwangi', '0823 2856 0100', '3510 1408 0408 0000', '3510 1424 0879 0002', NULL, NULL, NULL, '2000-09-01', NULL, NULL, 0, 8, 0, 'wasmonono@gmail.com', NULL, '', 'menikah', '', '', 'aktif'),
(6, '0006', 'KRISTIANUS SISWANTO', 4, 16, 'tetap', 'Lampung', '1977-09-06', 'Ular', 'Virgo', 'Selasa Wage', 'L', 'S1', 'Teknik Mesin', 'A', 'KATHOLIK', 'Kadirojo 2 Purwomartani, Kalasan', 'Kadirojo 2 Purwomartani, Kalasan', '0813 9272 9927', '3323 0728 0910 0000', '3323 0706 0977 0001', NULL, NULL, NULL, '2002-02-01', NULL, NULL, 0, 8, 0, 'kristianussiswantost@gmail.com', 'VERONIKA SARJIATI', '', 'menikah', '', '', 'aktif'),
(7, '0007', 'DWIJO ARIBOWO', 5, 5, 'tetap', 'Yogyakarta', '1978-01-18', 'Kuda', 'Capricorn', 'Rabu Pon', 'L', 'S1', 'Teknologi Pertanian', 'O', 'ISLAM', 'Klaci I RT.01 RW.08 Margoluwih, Seyegan, Sleman, Yogyakarta', 'Klaci I RT 01/08, Margoluwih, Seyegan, Sleman', '0878 3934 6461', '3404 0523 0208 0070', '3471 0115 1274 0002', NULL, NULL, NULL, '2002-05-01', NULL, NULL, 0, 2, 0, 'dwijo.aribowo@gmail.com', 'SUTI ASMINI', '', 'menikah', 'NOVI DAMAYANTI', 'AMANDA PUSPITA WIRANTI NINGRUM, SATRIA DWI NUGROHO', 'aktif'),
(8, '0008', 'RUSWONDO', 5, 3, 'tetap', 'Bantul', '1981-08-10', 'Ayam', 'Leo', 'Senin Pon', 'L', 'SMU', 'IPA', 'B', 'ISLAM', 'Ngelembu RT.002 RW.006 Panjang Rejo, Pundong, Bantul', 'Ngelembu RT.002 RW.006 Panjang Rejo, Pundong, Bantul', '0838 4067 5745', '3404 0808 0205 4450', '3402 0410 0881 0002', NULL, NULL, NULL, '2002-11-01', NULL, NULL, 0, 5, 0, 'ruswondoberbah@gmail.com', 'MARYATI', '', 'menikah', 'SUMARTINI', 'ALFITA KHOIRUNISA', 'aktif'),
(9, '0009', 'KURNIASIH CAHYANI', 5, 5, 'tetap', 'Sleman', '1980-05-20', 'Monyet', 'Taurus', 'Selasa Legi', 'P', 'D3', 'Gizi', 'B', 'ISLAM', 'Ngaran RT/RW 002/010 Margokaton, Seyegan', 'Ngaran RT/ RW 002/010 Margokaton, Seyegan', '0895 8066 86910', '3404 0508 0114 0000', '3471 1460 0580 0002', NULL, NULL, NULL, '2002-11-15', NULL, NULL, 0, 1, 0, 'kurni.cahyani@gmail.com', 'GIYATI', '', 'menikah', 'CAHYO ZUDIANTORO', 'MUHAMMAD ALTHAF FAYYADH, AFIQAH DHIYA ULHAQ', 'aktif'),
(10, '0010', 'HARDI SUMARTONO', 5, 9, 'tetap', 'Sleman', '1983-09-23', 'Babi', 'Libra', 'Jumat Pahing', 'L', 'SMEA', 'Akuntansi', 'A', 'KRISTEN', 'Sembuh Wetan RT/RW 004/025 Sidokarto, Godean, Sleman, Yk', 'Sembuh Wetan RT/RW 004/025 Sidokarto, Godean, Sleman, Yk', '0815 7457 4032', '3404 0228 0105 8980', '3404 0225 0983 0003', NULL, NULL, NULL, '2003-01-25', NULL, NULL, 0, 2, 0, 'hardisumartono9@gmail.com', 'DJUMADINEM', '', 'menikah', 'M. SULISTYANINGTYAS', '', 'aktif'),
(11, '0011', 'ADITYA NOVIANTO', 5, 16, 'tetap', 'Bantul', '1980-05-27', 'Monyet', 'Gemini', 'Selasa Pon', 'L', 'SMK', 'Otomotif', 'O', 'ISLAM', 'Sanden RT.2/29 Murtigading, Sanden, Bantul, Yogyakarta', 'Sanden RT.2/29 Murtigading, Sanden, Bantul, Yogyakarta', '0816 689 480', '3402 0204 1003 0570', '3402 0227 0580 0002', NULL, NULL, NULL, '2003-02-18', NULL, NULL, 0, 8, 0, 'novilactona@yahoo.co.id', 'ETTY WAHYUTRIANI', '', 'menikah', 'BEKTI SARASWATI', 'ANGGER PANDHU WIDYATMOKO, AVITO TUNGGA SAHITYA', 'aktif'),
(12, '0012', 'HERRY PURNOMO', 5, 16, 'tetap', 'Yogyakarta', '1975-11-26', 'Kelinci', 'Sagittarius', 'Rabu Wage', 'L', 'D3', 'Keuangan Perbankan', 'O', 'ISLAM', 'Danukusuman GK IV/1334 YK, RT/RW 019/006 Baciro, Gondokusuman', 'Danukusuman GK IV/1334 YK, RT/RW 019/006 Baciro, Gondokusuman', '0817 4121 255', '3471 0307 0209 0080', '3471 0326 1175 0002', NULL, NULL, NULL, '2004-12-23', NULL, NULL, 0, 7, 0, 'herrysyifa2007@gmail.com', 'MUDJI RAHAYU', '', 'menikah', 'SIWI RACHMAWATI', 'INAZTIA NATSMA LAILA ARSYIFA', 'aktif'),
(13, '0013', 'HARJANTI DWI SETYANI', 5, 16, 'tetap', 'Yogyakarta', '1981-05-09', 'Ayam', 'Taurus', 'Sabtu Kliwon', 'P', 'SMK', 'Kria Logam', 'O', 'ISLAM', 'Jl. Glagahsari RT.007 RW.002 Kel. Warungboto, Umbulharjo, Yogyakarta', 'Taman Sedayu Blok B No. 31 RT 045 Argorejo, Sedayu, Bantul, Yogyakarta', '0812 1705 8845', '3402 1715 1107 0000', '3402 1749 0581 0003', NULL, NULL, NULL, '2005-09-07', NULL, NULL, 0, 8, 0, 'harjanidwisetyani@gmail.com', 'SUHARTI', '', 'menikah', 'YULIUS DONA RYSMANA', 'NUNO PEREIRA DANI PRATAMA, JULIO DWI ANDO', 'aktif'),
(14, '0014', 'SULARTO', 5, 16, 'tetap', 'Gunungkidul', '1987-04-02', 'Kelinci', 'Aries', 'Kamis Wage', 'L', 'SMK', 'Otomotif', NULL, 'ISLAM', 'Kaliwuluh, RT 04/06 Jurangjero', 'Kaliwuluh, RT 04/06 Jurang Jero', '0896 1020 0021', '3403 1306 1015 0000', '3403 1302 0487 0001', NULL, NULL, NULL, '2009-07-21', NULL, NULL, 0, 1, 0, 'dimassularto@gmail.com', 'DALIYEM', '', 'menikah', 'SRI RAHMAWATI', '', 'aktif'),
(15, '0015', 'WIYONO', 5, 16, 'tetap', 'Yogyakarta', '1987-01-02', 'Kelinci', 'Capricorn', 'Jumat Wage', 'L', 'SMK', 'Teknik Mekanik Otomotif', NULL, 'ISLAM', 'Kaliwuluh RT 06 RW 06 Jurangjero, Ngawen, Gunung Kidul', 'Kaliwuluh RT 06 RW 06 Jurangjero, Ngawen, Gunung Kidul', '0858 9087 8770', '3403 1309 0913 0000', '3403 1302 0187 0002', NULL, NULL, NULL, '2010-01-01', NULL, NULL, 0, 4, 0, 'wyn.sigit@gmail.com', 'PARTIYEM', '', 'menikah', '', 'RAQILLA KHALIS JASMIN', 'aktif'),
(16, '0016', 'EKO PRAMONO', 5, 16, 'tetap', 'Kulon Progo', '1985-06-27', 'Kerbau', 'Cancer', 'Kamis Kliwon', 'L', 'SMK', 'Otomotif', NULL, 'ISLAM', 'Wiyu RT 033 RW 011 Kembang, Nanggulan, Kulon Progo', 'Wiyu RT 033 RW 011 Kembang, Nanggulan, Kulon Progo', '0857 2563 6029', '3401 1028 0814 0000', '3401 1027 0685 0001', NULL, NULL, NULL, '2010-05-01', NULL, NULL, 0, 5, 0, 'fanodirga10@gmail.com', 'NGATIYEM', '', 'menikah', '', '', 'aktif'),
(17, '0017', 'GAUS SUSILO WARDANI', 5, 7, 'tetap', 'Gunungkidul', '1988-08-29', 'Naga', 'Virgo', 'Senin Wage', 'L', 'SMA', 'IPA', NULL, 'ISLAM', 'Sendowo Kidul RT 003 / RW 006 Kedung Keris, Nglipar, Gunung Kidul', 'Sendowo Kidul RT 003 / RW 006 Kedung Keris, Nglipar, Gunung Kidul', '0878 3921 3569', '3403 0224 0609 0000', '3403 0229 0388 0002', NULL, NULL, NULL, '2010-11-08', NULL, NULL, 0, 12, 0, 'gauswardani549@gmail.com', 'SURATMI', '', 'menikah', 'HERLINA', 'ALAINA ELFADELA (21/11/2008)', 'aktif'),
(18, '0018', 'TIRTA AYUNINGSIH', 5, 10, 'tetap', 'Sleman', '1992-05-12', 'Monyet', 'Taurus', 'Selasa Legi', 'P', 'SMEA', 'Akuntansi', NULL, 'ISLAM', 'Klisat Sendangrejo Minggir Sleman Yogyakarta', 'Klisat, Sendangrejo, Minggir, Sleman, Yogyakarta', '0857 4792 8880', '3404 0419 0717 0000', '3404 0452 0592 0001', NULL, '', '', '2011-01-10', NULL, NULL, 0, 5, 0, 'tirtaayyu@gmail.com', 'MARTIJAH', '', 'menikah', '', '', 'aktif'),
(19, '0019', 'TRIES MUMTOHANI', 4, 4, 'tetap', 'Yogyakarta', '1985-08-18', 'Kerbau', 'Leo', 'Minggu Pahing', 'P', 'S1', 'Farmasi', 'O', 'ISLAM', 'Condongsari Ngropoh RT.06 RW.25 Depok, Sleman', 'Condongsari B-31 Condongcatur, Depok, Sleman, Yogyakarta', '0857 2977 8477', '', '3404 0758 0885 0005', NULL, NULL, NULL, '2011-05-06', NULL, NULL, 0, 4, 0, 'tries.mumtohani@gmail.com', 'MUJIYAH', '', 'menikah', 'GUNAWAN NUR. H', 'SHASHIKA BTARI AYUNDA (26/09/2016)', 'aktif'),
(20, '0020', 'DWI NUGROHO', 5, 9, 'tetap', 'Sleman', '1983-01-26', 'Babi', 'Aquarius', 'Rabu Pahing', 'L', 'S1', 'Manajemen Keuangan', 'O', 'ISLAM', 'Gg. Kamboja CT X/19 Karangasem RT/RW 005/002 Caturtunggal, Depok, Slmn', 'Gg. Kamboja CT X/19 Karangasem RT/RW 005/002 Caturtunggal, Depok, Sleman', '0856 4341 8698', '3402 1004 0219 0000', '3404 0726 0183 0010', NULL, NULL, NULL, '2011-08-01', NULL, NULL, 0, 5, 0, 'dwinug46@gmail.com', 'MUDJATI', '', 'menikah', '', '', 'aktif'),
(21, '0021', 'ISMANTO', 5, 16, 'tetap', 'Tejosari', '1974-09-11', 'Macan', 'Virgo', 'Rabu Pon', 'L', 'SMA', 'IPA', 'B', 'ISLAM', 'Jl. Sutan Syahrir No. 193 RT.12 RW.03 Tejo Agung, Metro Timur, Lampung', 'Jl. Sutan Syahrir No. 193 RT.12 RW.03 Tejo Agung, Metro Timur, Lampung', '0812 7889 6450', '1872 0424 0809 0000', '1872 0409 0976 0001', NULL, NULL, NULL, '2011-11-10', NULL, NULL, 0, 8, 0, '', 'TUNTUM', '', 'menikah', 'ERNA WATI', 'DEVA ARIYA CHANDRA SAMPOERNA, DEVTAN CHANDA BRAHMA', 'aktif'),
(22, '0022', 'AHMAD AZARRUDIN', 5, 2, 'tetap', 'Bantul', '1987-04-17', 'Kelinci', 'Aries', 'Jumat Wage', 'L', 'SMK', 'Mesin', 'B', 'ISLAM', 'Kayuhan Kulon RT/RW 002 Triwidadi, Pajangan, Bantul', 'Kayuhan Kulon RT/RW 002 Triwidadi, Pajangan, Bantul', '0858 6884 7292', '3402 0722 0904 0000', '3402 0717 0487 0001', NULL, NULL, NULL, '2012-05-04', NULL, NULL, 0, 7, 0, 'ahzarkhamiel@gmail.com', 'PAINTEN', '', 'lajang', '', '', 'aktif'),
(23, '0023', 'ELISABETH RATRI UTAMI', 5, 13, 'tetap', 'Yogyakarta', '1984-01-10', 'Tikus', 'Capricorn', 'Selasa Legi', 'P', 'S1', 'Manajemen', 'O', 'KATHOLIK', 'Perum Nogotirto Elok II, Jl. Kalimantan F.161 Gamping', 'Perum Nogotirto Elok II, Jl. Kalimantan F.161 Gamping', '0821 3833 8882', '3404 0127 0105 6600', '3404 0150 0184 0003', NULL, NULL, NULL, '2012-07-16', NULL, NULL, 0, 5, 0, '1001ratri@gmail.com', 'ENDANG TSR', '', 'lajang', '', '', 'aktif'),
(24, '0024', 'DANANJAYA DARMAWAN', 5, 7, 'tetap', 'Sleman', '1993-10-27', 'Ayam', 'Scorpio', 'Rabu Wage', 'L', 'SMK', 'Perhotelan', 'O', 'KRISTEN', 'Dsn. Kembang RT.05 RW.62 Kel. Maguwoharjo, Kec. Depok', 'Dsn. Kembang RT.05 RW.62 Kel. Maguwoharjo, Kec. Depok', '0858 6768 3455', '3404 0705 0205 8860', '3404 0727 1093 0002', NULL, '', '', '2012-09-15', '0000-00-00', NULL, 0, 6, 0, 'dananjdarmawan@gmail.com', 'LUCIA TUTIK ROHANI', '', 'lajang', '', '', 'aktif'),
(25, '0025', 'I MADE MIASTHA A.', 5, 2, 'tetap', 'Gunungkidul', '1987-05-08', 'Kelinci', 'Taurus', 'Jumat Kliwon', 'L', 'SMU', 'IPS', 'B', 'KATHOLIK', 'Panggang III RT.04 RW.05 Giriharjo, Panggang, Gunung Kidul, Yogyakarta', 'Kembang RT 05/62 Maguwoharjo, Depok, Sleman', '0857 2860 6351', '3404 0709 0713 0000', '3403 0608 0587 0001', NULL, NULL, NULL, '2012-10-04', NULL, NULL, 0, 0, 0, 'madeklaramaeka@gmail.com', 'LUDOVIKA HAENI INTARTI', '', 'menikah', 'DWI MAEKAWATI', 'KLARA YEMIMA PUTU WITYASTI', 'aktif'),
(26, '0026', 'SULISTIYO', 5, 2, 'tetap', 'Bantul', '1988-03-16', 'Naga', 'Pisces', 'Rabu Pon', 'L', 'SMK', 'Mesin', 'B', 'ISLAM', 'Juwono RT.07 Triharjo, Pandak, Bantul', 'Juwono RT.07 Triharjo, Pandak, Bantul', '0895 1213 2329', '3402 0612 0912 0000', '3402 0616 0388 0002', NULL, NULL, NULL, '2012-12-17', NULL, NULL, 0, 1, 0, 'sulistiyopandak@gmail.com', '(ALMH) MASKIYEM', '', 'menikah', 'SRI ASTUTI', 'ZIDAN DAFFA PRATAMA', 'aktif'),
(27, '0027', 'DANANG WIBOWO K', 5, 2, 'tetap', 'Sleman', '1994-02-22', 'Anjing', 'Pisces', 'Selasa Pahing', 'L', 'SMK', 'Mesin', 'O', 'ISLAM', 'Sambilegi Lor, Maguwoharjo, Depok, Sleman', 'Sambilegi Lor, RT/RW 04/54 Maguwoharjo, Depok, Sleman, Yogyakarta', '0856 4340 2560', '3404 0708 1107 0040', '3404 0722 0294 0002', NULL, NULL, NULL, '2012-12-17', NULL, NULL, 0, 1, 0, 'danangwibowo619@gmail.com', 'BONIYATI', '', 'menikah', '', '', 'aktif'),
(28, '0028', 'RINDI CAHYO WIBOWO', 5, 6, 'tetap', 'Sleman', '1985-02-07', 'Kerbau', 'Aquarius', 'Kamis Kliwon', 'L', 'SMK', 'Mesin', 'AB', 'ISLAM', 'Kadirojo I RT.07 RW.02 Purwomartani, Kalasan, Sleman', 'Kadirojo I RT.07 RW.02 Purwomartani, Kalasan, Sleman', '0857 2915 2646', '3404 1003 0909 0000', '3404 1007 0285 0001', NULL, NULL, NULL, '2012-12-17', NULL, NULL, 0, 1, 0, 'sitifajariyah42@gmail.com', 'ENDANG SRI WINARNI', '', 'menikah', 'SITI FAJARIYAH', 'ATHAYA AILSA BIUMA', 'aktif'),
(29, '0029', 'ADISATYA PRAMARDIANTO', 5, 3, 'tetap', 'Yogyakarta', '1983-10-08', 'Babi', 'Libra', 'Sabtu Pahing', 'L', 'S1', 'Teknik Elektro', 'B', 'ISLAM', 'Prawirotaman MG. III/662 Yogyakarta', 'Prawirotaman MG. III/ 662/ Yogyakarta', '0815 7959 232', '3471 1212 1211 0000', '3471 0908 1083 0001', NULL, NULL, NULL, '2013-09-20', NULL, NULL, 0, 3, 0, 'adisatya35@gmail.com', 'ISPARTINI', '', 'menikah', '', '', 'aktif'),
(30, '0030', 'ADINDA MAHARDIKA', 5, 7, 'tetap', 'Bantul', '1992-08-17', 'Monyet', 'Leo', 'Senin Pon', 'P', 'D3', 'Teknik Boga', 'O', 'ISLAM', 'Jetis 140 RT.03 Tamantirto, Kasihan, Bantul', 'Jetis 140 RT.03 Tamantirto, Kasihan, Bantul', '0838 6952 0008', '3402 1606 1104 0030', '3402 1657 0892 0004', NULL, '', '', '2014-07-31', '0000-00-00', NULL, 0, 3, 0, 'adindamahardika45@gmail.com', 'BONDAN EKOWATI', '', 'menikah', '', '', 'aktif'),
(31, '0031', 'DANANG TRIS JAYANTO', 5, 16, 'tetap', 'Gunungkidul', '1984-02-15', 'Tikus', 'Aquarius', 'Rabu Pahing', 'L', 'SMK', 'Teknik Pembentukan', NULL, 'ISLAM', 'Karangasem 8 RT/RW 004/006 Karangasem, Paliyan, Gunung Kidul', 'Karangasem 8 RT/RW 004/006 Karangasem, Paliyan, Gunung Kidul', '0817 4126 719', '3403 0506 1212 0000', '3403 0315 0284 0001', NULL, NULL, NULL, '2014-08-04', NULL, NULL, 0, 6, 0, 'danangwonosari@gmail.com', 'RUSMINI', '', 'menikah', 'YULIANA LESTARI WIDIASTUTI', 'ABIM JAYA PERMANA (23/11/2013)', 'aktif'),
(32, '0032', 'ARI PRASTYO WIBOWO', 5, 16, 'tetap', 'Jakarta', '1994-12-10', 'Anjing', 'Sagittarius', 'Sabtu Pon', 'L', 'D1', 'Komputer Aplikasi Bisnis', 'O', 'ISLAM', 'Dusun Kedungrejo RT 09 RW 04 Balerejo, Madiun, Jawa Timur', 'Dusun Kedungrejo RT 09 RW 04 Balerejo, Madiun, Jawa Timur', '0812 3423 737', '3519 1001 0100 0040', '3519 1010 1294 0003', NULL, NULL, NULL, '2015-01-05', NULL, NULL, 0, 7, 0, 'ariprastyo546@gmail.com', 'HERI MURYANTI', '', 'menikah', '', '', 'aktif'),
(33, '0033', 'ISMAIL ADIPUTRA', 4, 6, 'tetap', 'Karanganyar', '1991-06-26', 'Kambing', 'Cancer', 'Rabu Kliwon', 'L', 'D4', 'Elektro Mekanik', 'B', 'ISLAM', 'Jengglong RT.03 RW.07 Bulurejo, Gondangrejo, Karanganyar, Jateng', 'Jengglong RT.03 RW.07 Bulurejo, Gondangrejo, Karanganyar, Jateng', '0856 4230 3322', '3313 1331 0505 0070', '3313 1326 0691 0005', NULL, NULL, NULL, '2015-02-02', NULL, NULL, 0, 6, 0, 'ismail.adiputras@gmail.com', 'SITI MUSTA\'IDAH', '', 'menikah', 'ERNA NOVITASARI', '', 'aktif'),
(34, '0034', 'FRANSISKUS AGUNG APRIYANTO', 5, 7, 'tetap', 'Banjarmasin', '1982-04-07', 'Anjing', 'Aries', 'Rabu Pon', 'L', 'SMK', 'Mekanik Umum', 'A', 'KATHOLIK', 'Kadirojo 1 RT.006 RW.002 Purwomartani, Kalasan, Sleman', 'Kadirojo 1 RT.006 RW.002 Purwomartani, Kalasan, Sleman', '0877 3822 9052', '3404 1026 0111 0000', '3404 1007 0482 0002', NULL, NULL, NULL, '2015-07-08', NULL, NULL, 0, 3, 0, 'frabsiskusagung@gmail.com', 'AGNES SUPARTI', '', 'menikah', 'CHRISTINA SRI WAHYUNI', 'VINSENSIUS INESTA PANDITYATAMA', 'aktif'),
(35, '0035', 'RAHARJO', 5, 7, 'tetap', 'Sleman', '1979-11-03', 'Kambing', 'Scorpio', 'Sabtu Pahing', 'L', 'SMK', 'Bangunan Gedung', 'B', 'KRISTEN', 'Sembur RT.004 RW.014 Tirtomartani, Kalasan, Sleman', 'Sembur RT.004 RW.014 Tirtomartani, Kalasan, Sleman', '0817 271 744', '3404 1012 0207 0000', '3404 1003 1179 0003', NULL, '', '', '2015-08-05', '0000-00-00', NULL, 0, 7, 0, 'raharjosleman@gmail.com', 'SRI ANDALASIH MURNI', '', 'menikah', 'ARNIS ASTUTI', 'JUANANDA PUTRA RAHARJA, LEXZA REGA PRASETYA', 'aktif'),
(36, '0036', 'YUSTINUS BAYU DWI WIJAYANTO', 5, 16, 'tetap', 'Klaten', '1988-04-14', 'Naga', 'Aries', 'Kamis Pahing', 'L', 'S2', 'Profesi Akuntansi', 'B', 'KATHOLIK', 'Karang Wuni Wetan RT.002 RW.002 Dlimas, Ceper, Klaten', 'Karang Wuni Wetan RT.002 RW.002 Dlimas, Ceper, Klaten', '0856 4345 5941', '3310 1110 0904 0000', '3310 1114 0488 0001', NULL, NULL, NULL, '2016-04-01', NULL, NULL, 0, 7, 0, 'yustinusbayu88@gmail.com', 'WM. INDRAYATI WIJAYA', '', 'menikah', '', '', 'aktif'),
(37, '0037', 'INEZ LAVENIA YUNITA', 5, 16, 'tetap', 'Madiun', '1993-06-16', 'Ayam', 'Gemini', 'Rabu Legi', 'P', 'S1', 'Akuntansi', 'B', 'ISLAM', 'Jl. Pasar Legi No. 174 Mangge, Barat, Magetan, Jawa Timur', 'Jl. Pasar Legi No. 174 Mangge Barat, Magetan, Jawa Timur', '0851 5641 2952', '', '3520 1256 0693 0001', NULL, NULL, NULL, '2016-06-06', NULL, NULL, 0, 6, 0, 'inezlavenia@yahoo.co.id', 'NUR WAHYUNINGSIH', '', 'menikah', '', '', 'aktif'),
(38, '0038', 'MUJIONO', 5, 16, 'tetap', 'Tulungagung', '1985-08-11', 'Kerbau', 'Leo', 'Minggu Kliwon', 'L', 'SMK', 'Mesin', NULL, 'ISLAM', 'Dusun Sumber RT.005 RW.006 Pojok Ngantru, Tulung Agung', 'Dusun Sumber RT 025 RW 008, Pojok, Ngantru, Tulungagung, Jawa Timur', '0812 3373 1045', '', '3504 0411 0885 0002', NULL, NULL, NULL, '2016-08-09', NULL, NULL, 0, 8, 0, 'mujiono8511@yahoo.com', 'SURANI', '', 'menikah', 'FENI RAGIL SUGANDA', 'MUHAMMAD SYAFIQ FAIZ PRATAMA', 'aktif'),
(39, '0039', 'ENDANG SETIOWATI', 5, 16, 'kontrak', 'Pegandan', '1976-10-25', 'Naga', 'Scorpio', 'Senin Pon', 'P', 'SMA', 'IPS', NULL, 'ISLAM', 'Perum Sinar Bukit Asri No. 79 Semarang', 'Perum Sinar Bukit Asri No. 79 Semarang', '0813 2584 1865', '', '3374 0765 1076 0004', NULL, NULL, NULL, '2016-12-27', '2025-06-30', NULL, 12, 12, 0, '', 'SRI HARTINI', '', 'menikah', 'SUSANTO PONTI', 'CINTA KASIH (03/02/2012), AURA PUTRI (06/02/2009)', 'aktif'),
(40, '0040', 'RINA BUDIARTI', 5, 16, 'kontrak', 'Kudus', '1989-04-11', 'Ular', 'Aries', 'Selasa Wage', 'P', 'SMK', 'Bisnis Manajemen', NULL, 'ISLAM', 'Jetiskapuan RT/RW 004/001 Jati Kudus', 'Jetiskapuan RT/RW 004/001 Jati Kudus', '0895 8000 80815', '3320 0409 0708 0051', '3319 0551 0489 0002', NULL, NULL, NULL, '2017-01-30', '2024-07-30', NULL, 6, 5, 0, '', 'MUNISIH', '', 'menikah', 'SARONI', '', 'aktif'),
(41, '0041', 'DIAS PUTRI UTAMI', 5, 16, 'tetap', 'Yogyakarta', '1993-09-14', 'Ayam', 'Virgo', 'Selasa Legi', 'P', 'D4', 'Manajemen Teknik Studio Produksi', 'A', 'ISLAM', 'Jl. Mangga No.54B, RT.02 RW.56 Sambilegi Kidul, Maguwoharjo', 'Jl. Mangga No.54B, RT.02 RW.56 Sambilegi Kidul, Maguwoharjo', '0877 7849 7549', '3404 0712 1114 0010', '3404 0754 0993 0001', NULL, NULL, NULL, '2017-05-01', NULL, NULL, 0, 4, 0, 'diasputriutami1993@gmail.com', 'ASTI DWIMARTUTI', '', 'menikah', '', '', 'aktif'),
(42, '0042', 'ANGGIT TRI NUGROHO', 5, 2, 'tetap', 'Yogyakarta', '1996-07-18', 'Tikus', 'Cancer', 'Kamis Wage', 'L', 'SMK', 'Teknik Kendaraan Ringan', 'O', 'ISLAM', 'Krobokan RT.005 Tamanan, Banguntapan, Bantul', 'Krobokan RT.005 Tamanan, Banguntapan, Bantul', '0877 3842 4280', '3402 1205 0213 0000', '3402 1218 0796 0002', NULL, NULL, NULL, '2017-05-09', NULL, NULL, 0, 3, 0, 'anggittrinugroho1807@gmail.com', 'MARILAH', '', 'lajang', '', '', 'aktif'),
(43, '0043', 'AGUNG SUMARDHANY', 5, 16, 'tetap', 'Magetan', '1989-08-10', 'Ular', 'Leo', 'Kamis Kliwon', 'L', 'S1', 'Pendidikan Olahraga', 'O', 'ISLAM', 'Dusun Waduk RT 09 RW 02 Takeran, Magetan, Jawa Timur', 'Dusun Waduk RT 09 RW 02 Takeran, Magetan, Jawa Timur', '0813 5840 4814', '', '3520 0410 0889 0001', NULL, NULL, NULL, '2017-07-14', NULL, NULL, 0, 6, 0, 'mardha4477@gmail.com', 'SUSILOWATUN', '', 'menikah', 'ANA SANTIAWATI', '', 'aktif'),
(44, '0044', 'MOHAMMAD HELMI YAHYA', 5, 7, 'tetap', 'Sleman', '1999-04-08', 'Kelinci', 'Aries', 'Kamis Pon', 'L', 'SMK', 'Teknik Mesin', 'B', 'ISLAM', 'Tegal Klagaran RT 004 RW 035 Sendangrejo, Minggir, Sleman', 'Tegal Klagaran RT 004 RW 035 Sendangrejo, Minggir, Sleman', '0895 0695 1392', '3404 0406 0323 0001', '3471 0608 0499 0001', NULL, '', '', '2017-08-22', '0000-00-00', NULL, 0, 4, 0, 'hellmi.yaahya@gmail.com', 'AMIROTUN SOLEHA', 'TRIS ARIYANTO', 'menikah', 'SUSANITA WIDYAYANTI', '', 'aktif'),
(45, '0045', 'NUR CAHYANI', 5, 16, 'kontrak', 'Ngawi', '1983-12-29', 'Babi', 'Capricorn', 'Kamis Wage', 'P', 'SMK', 'Akuntansi', 'AB', 'ISLAM', 'Asrama Yonif 613 Raja Alam RT.001 Kel. Juata Kerikil, Kec. Tarakan Utara, Kalimantan Timur', 'Jl. Kenari No.26 Beran Ngawi', '0858 7838 1393', '6473 0424 0909 0015', '6473 0469 1283 0005', NULL, NULL, NULL, '2017-10-28', '2025-07-28', NULL, 12, 12, 0, '', 'RAKIYEM', '', 'menikah', 'ANDOKO SUSILO', 'GEFBRYLINA CAHYA ANGGUN SUSILO (03/03/2012)', 'aktif'),
(46, '0046', 'EVENDI APRIANTO', 5, 16, 'tetap', 'Gunungkidul', '1994-04-09', 'Anjing', 'Aries', 'Sabtu Pon', 'L', 'SMK', 'Teknik Fabrikasi Logam', NULL, 'ISLAM', 'Gading X RT.05 RW.010, Gading, Playen, Gunung Kidul', 'Gading X RT.05 RW.010, Gading, Playen, Gunung Kidul', '0858 7572 7232', '3403 0309 1107 6350', '3403 0309 0494 0002', NULL, NULL, NULL, '2017-11-27', NULL, NULL, 0, 1, 0, 'evendi.aprianto25@gmail.com', 'SUMILAH', '', 'menikah', '', '', 'aktif'),
(47, '0047', 'ANDRIYANTO', 5, 16, 'tetap', 'Klaten', '1988-03-10', 'Naga', 'Pisces', 'Kamis Pahing', 'L', 'SMK', 'Teknik Mesin', NULL, 'ISLAM', 'Selobayan RT/RW 011/005 Kel. Tambakan, Kec. Jogonalan, Klaten', 'Selobayan RT/RW 011/005 Kel. Tambakan, Kec. Jogonalan, Klaten', '0812 9890 9781', '3310 0830 1112 0059', '3310 0810 0388 0001', NULL, NULL, NULL, '2017-12-07', NULL, NULL, 0, 6, 0, 'andrisukani@gmail.com', 'SUMINI', '', 'lajang', '', '', 'aktif'),
(48, '0048', 'RIZAL MUSTOFA', 5, 16, 'tetap', 'Kulon Progo', '1996-09-16', 'Tikus', 'Virgo', 'Senin Wage', 'L', 'SMK', 'Teknika Kapal Penangkap Ikan', 'B', 'ISLAM', 'Wiyu RT/RW 033/011 Kembang, Nanggulan, Kulon Progo', 'Wiyu RT/RW 033/011 Kembang, Nanggulan, Kulon Progo', '0856 4162 7605', '', '3401 0616 0996 0001', NULL, NULL, NULL, '2018-02-05', NULL, NULL, 0, 6, 0, 'rizalmustofa968@gmail.com', 'ROKHIMAH', '', 'lajang', '', '', 'aktif'),
(49, '0049', 'EKO SETYO BIONO', 5, 16, 'tetap', 'Jombang', '1994-06-13', 'Anjing', 'Gemini', 'Senin Pon', 'L', 'S1', 'Akuntansi', NULL, 'ISLAM', 'Jl. Sumberboto RT/RW 01/03 Desa Japanan, Kec. Mojowarno, Kab. Jombang', 'Jl. Sumberboto RT/RW 01/03 Desa Japanan, Kec. Mojowarno, Kab. Jombang', '0823 3553 5298', '', '3401 0616 0996 0001', NULL, NULL, NULL, '2018-02-05', NULL, NULL, 0, 8, 0, 'ekk.styo13@gmail.com', NULL, '', 'lajang', '', '', 'aktif'),
(50, '0050', 'AGUS CAHYO', 5, 6, 'tetap', 'Gunungkidul', '1994-08-12', 'Anjing', 'Leo', 'Jumat Pon', 'L', 'SMK', 'Elektronika', NULL, 'ISLAM', 'Jetis RT.001 RW.005 Kel. Hargomulyo, Kec. Gedangsari, Gunung Kidul', 'Jetis RT.001 RW.005 Kel. Hargomulyo, Kec. Gedangsari, Gunung Kidul', '0822 6416 8008', '', '3403 1412 0894 0001', NULL, NULL, NULL, '2018-02-20', NULL, NULL, 0, 7, 0, 'cahyoagus874@gmail.com', 'SUGINI', '', 'menikah', '', '', 'aktif'),
(51, '0051', 'THERESIA ARUMSARI', 4, 5, 'tetap', 'Yogyakarta', '1992-06-04', 'Monyet', 'Gemini', 'Kamis Wage', 'P', 'S2', 'Ilmu & Teknologi Pangan', 'B', 'KATHOLIK', 'Jl. Kemakmuran No.2 RT/RW 057/015 Klitren, Gondokusuman, Yogyakarta', 'Jl. Kaliurang KM 7 Sengkan No.221 Yogyakarta', '0813 9264 3265', '3471 0304 0999 1130', '3471 0344 0692 0002', NULL, '', '', '2018-03-24', '0000-00-00', NULL, 0, 7, 0, 'theresia.arumsari@mirota.co.id', 'CH SRI SUDEWI', '', 'menikah', '', '', 'aktif'),
(52, '0052', 'BAYU PUTRA PRADANA', 5, 6, 'tetap', 'Surabaya', '1996-10-03', 'Tikus', 'Libra', 'Kamis Legi', 'L', 'SMK', 'Teknik Fabrikasi Logam', 'O', 'ISLAM', 'Tajen X RT.001 RW.020 Sidomoyo, Godean, Sleman, Yogyakarta', 'Tajen X RT.001 RW.020 Sidomoyo, Godean, Sleman, Yogyakarta', '0896 7880 5085', '', '3404 0203 1096 0002', NULL, NULL, NULL, '2018-07-20', NULL, NULL, 0, 8, 0, 'putrabayu123422@gmail.com', 'TRI SAYATI', '', 'lajang', '', '', 'aktif'),
(53, '0053', 'ELLY SETYORINI', 5, 16, 'kontrak', 'Jepara', '1986-09-01', 'Macan', 'Virgo', 'Senin Legi', 'P', 'SMU', 'IPA', 'O', 'ISLAM', 'Dsn. Gidangelo RT/RW 3/1 Welahan, Jepara', 'Dsn. Gidangelo RT/RW 3/1 Welahan, Jepara', '0813 5307 5548', '3320 0316 1012 0010', '3320 0341 0986 0001', NULL, NULL, NULL, '2018-08-07', '2025-05-10', NULL, 12, 12, 0, 'ellysetyorini00@gmail.com', 'SUYATI', '', 'menikah', 'KHAIRONY MUBAROK', 'REVITA ROHMIKA PUTRI (13/08/2013)', 'aktif'),
(54, '0054', 'HENRICUS NANANG YULIYANTO', 5, 2, 'tetap', 'Klaten', '1990-07-06', 'Kuda', 'Cancer', 'Jumat Kliwon', 'L', 'SMK', 'Mekanika Otomotif', 'O', 'KATHOLIK', 'Jetis RT.012 RW.005 Gatak, Ngawen, Klaten', 'Jetis RT.12 RW.05 Gatak, Ngawen, Klaten', '0857 9444 5459', '', '3277 0106 0790 0010', NULL, NULL, NULL, '2018-08-09', NULL, NULL, 0, 2, 0, 'henricusnanang90@gmail.com', 'FX. SUWARSO', '', 'lajang', '', '', 'aktif'),
(55, '0055', 'INDRA SETIAWAN', 5, 16, 'tetap', 'Jakarta', '1998-09-12', 'Macan', 'Virgo', 'Sabtu Kliwon', 'L', 'SMK', 'Akuntansi', NULL, 'ISLAM', 'Ds. Kalipakem RT.001 Kel. Seloharjo, Kec. Pundong, Kab. Bantul', 'Ds. Kalipakem RT.001 Kel. Seloharjo, Kec. Pundong, Kab. Bantul', '0831 0785 0182', '3402 0419 0914 0000', '3173 0612 0998 0001', NULL, NULL, NULL, '2018-09-03', NULL, NULL, 0, 3, 0, 'Indra1928jak@gmail.com', 'JUWATMI', '', 'menikah', '', '', 'aktif'),
(56, '0056', 'AGUS SUBANDI', 5, 4, 'tetap', 'Sleman', '1992-08-27', 'Monyet', 'Virgo', 'Kamis Pon', 'L', 'SMK', 'Electrical Avionic', 'B', 'ISLAM', 'Sorogenen II RT.001 RW.001 Kel. Purwomartani, Kec. Kalasan, Kab. Sleman 55571', 'Sorogenen II RT.001 RW.001 Kel. Purwomartani, Kec. Kalasan, Kab. Sleman 55571', '0857 1333 7921', '3404 1022 0611 0007', '3404 1027 0892 0001', NULL, '', '', '2018-09-12', '0000-00-00', NULL, 0, 5, 0, 'agussubandi999@gmail.com', 'SEMI (ALM)', '', 'menikah', '', '', 'aktif'),
(57, '0057', 'RISMAWATI DWI HANDAYANI', 5, 16, 'kontrak', 'Purwokerto', '1984-02-21', 'Tikus', 'Pisces', 'Selasa Pon', 'P', 'SMU', 'IPA', NULL, 'ISLAM', 'Griya Satria Bukit Permata BL M.6 RT.003 RW.009 Kel. Sidabowa, Kec.Patikraja, Kab. Banyumas 53171', 'Griya Satria Bukit Permata BL M.6 RT.003 RW.009 Kel. Sidabowa, Kec.Patikraja, Kab. Banyumas 53171', '0812 2844 8734', '3302 1201 0314 0001', '3302 2561 0284 0002', NULL, NULL, NULL, '2018-09-17', '2024-12-19', NULL, 6, 6, 0, 'risma669@yahoo.co.id', 'SUYATI', '', 'menikah', 'MOHAMAD PUJI HARYANTO', 'MUHAMMAD FAISAL NUR HIDAYAT (16/05/2004)', 'aktif'),
(58, '0058', 'SUBIYANTO', 5, 3, 'tetap', 'Bantul', '1992-09-20', 'Monyet', 'Virgo', 'Minggu Pahing', 'L', 'SMK', 'Otomotif', 'B', 'ISLAM', 'Sorogaten / Dagan DK V RT.004 Kel. Murtigading, Kec. Sanden, Bantul', 'Sorogaten / Dagan DK V RT.004 Kel. Murtigading Kec.Sanden Bantul', '0877 7935 3666', '3402 0219 0104 0050', '3402 0220 0992 0002', NULL, NULL, NULL, '2018-10-25', NULL, NULL, 0, 3, 0, 'subiyanto053@gmail.com', 'PARTINAH', '', 'menikah', '', '', 'aktif'),
(59, '0059', 'AINUN NUR FATHURROHMAN', 5, 2, 'tetap', 'Sleman', '1999-02-21', 'Kelinci', 'Pisces', 'Minggu Pahing', 'L', 'SMK', 'Otomotif', 'AB', 'ISLAM', 'Ngajeg RT.002 RW.025 Kel. Tirtomartani, Kec. Kalasan, Sleman', 'Ngajeg RT.002 RW.025 Kel. Tirtomartani, Kec. Kalasan, Sleman', '0838 7257 3873', '3471 0113 0722 0001', '3404 1021 0299 0006', NULL, NULL, NULL, '2018-12-22', NULL, NULL, 0, 0, 0, 'ainunafat@gmail.com', 'NURHAYATI', '', 'menikah', 'MITA CAHAYAWATI', 'RUMAISHA SEHRISH NUWAIRA (30/11/2022)', 'aktif'),
(60, '0060', 'MUHAMMAD FAUZAN NURWAKHID', 5, 2, 'tetap', 'Bantul', '1999-03-12', 'Kelinci', 'Pisces', 'Jumat Legi', 'L', 'SMK', 'Kimia Industri', 'O', 'ISLAM', 'Kranginan Mertosanan Kulon RT.010 Kel. Potorono, Kec. Banguntapan, Sleman', 'Kranginan Mertosanan Kulon RT.010 Kel. Potorono, Kec. Banguntapan, Bantul', '0896 7135 5264', '3402 1215 0905 0010', '3402 1212 0399 0002', NULL, NULL, NULL, '2018-12-22', NULL, NULL, 0, 0, 0, 'wakhidfauz@gmail.com', 'SOROWATI', '', 'lajang', '', '', 'aktif'),
(61, '0061', 'RIZKY MIANTI PRAMESWARI', 5, 16, 'kontrak', 'Surabaya', '1988-01-17', 'Naga', 'Capricorn', 'Minggu Wage', 'P', 'SMA', 'IPA', 'B', 'KRISTEN', 'Perum Griya Karya Sumput Asri Blok BW-29 Driyorejo, Gresik', 'Jl. Raden Patah No.37 Jombang', '0852 3735 6389', '3525 1518 1108 0566', '3525 1557 0188 0001', NULL, NULL, NULL, '2019-01-08', '2024-12-04', NULL, 6, 6, 0, 'pandaqucute@gmail.com', 'SAMIATI', '', 'menikah', 'BUDI SETIAWAN', '', 'aktif'),
(62, '0062', 'KASIDI', 5, 16, 'tetap', 'Sleman', '1976-08-09', 'Naga', 'Leo', 'Senin Legi', 'L', 'SMK', 'Akuntansi', 'A', 'ISLAM', 'Grogol RT.01 RW.17 Margodadi, Seyegan, Sleman', 'Grogol RT.01 RW.17 Margodadi, Seyegan, Sleman', '0819 4975 4339', '', '3404 0509 0876 0004', NULL, NULL, NULL, '2019-03-04', NULL, NULL, 0, 6, 0, 'kasidicici1976@gmail.com', 'SUKIYEM', '', 'menikah', 'CHAYATI', 'AHMAD DZAKI A (10/02/2007), NABILLA RAFIFAH (11/04', 'aktif'),
(63, '0063', 'SITI MUSYAROFAH', 5, 16, 'kontrak', 'Kudus', '1985-08-03', 'Kerbau', 'Leo', 'Sabtu Pahing', 'P', 'SMK', 'Akuntansi', 'A', 'ISLAM', 'Perum Sumber Indah No.3 RT.007 RW.004 Kel. Tenggeles, Kec. Mejobo, Kudus, Jawa Tengah', 'Perum Sumber Indah No.3 RT.007 RW.004 Kel. Tenggeles, Kec. Mejobo, Kudus, Jawa Tengah', '0819 0467 6000', '3319 0527 1010 0016', '3319 0243 0885 0006', NULL, NULL, NULL, '2019-03-04', '2025-06-22', NULL, 12, 12, 0, '', 'SUNARSIH', '', 'menikah', 'DIDIK SUDIATMOKO', 'FAUZ ZAKY AZZAHRA (26/11/2006), FIRYAL TSANY AZZAH', 'aktif'),
(64, '0064', 'DWI AMIYANTOKO', 5, 2, 'kontrak', 'Bantul', '1992-11-22', 'Monyet', 'Scorpio', 'Minggu Kliwon', 'L', 'SMK', 'Otomotif', 'B', 'ISLAM', 'Geneng Karangnongko RT.001 RW.027 Tirtomartani, Kalasan, Sleman', 'Geneng Karangnongko RT.001 RW.027 Tirtomartani, Kalasan, Sleman', '0857 1819 2293', '3402 1622 1192 0001', '3404 1022 0817 0004', NULL, NULL, NULL, '2019-04-04', '2025-03-04', NULL, 12, 2, 0, 'amiyantoko.dwi@gmail.com', 'SUDARMI', '', 'menikah', 'DINDA GUSTI', 'DZAKIANDRA RAYYAN AL AYMAN (30/09/2017)', 'aktif'),
(65, '0065', 'ADOLFUS YUNANTO PUTRO', 4, 7, 'tetap', 'Bekasi', '1982-06-17', 'Anjing', 'Gemini', 'Kamis Wage', 'L', 'S1', 'Psikologi', 'B', 'KATHOLIK', 'Mranggen Dukuh Bakung RT.002 RW.027 Kel. Bangunharjo, Kec. Sewon, Bantul', 'Perum Griya Sekar Asri Kav 15 Dusun Semail, Bangunharjo, Sewon, Bantul', '0813 2830 5050', '3402 1514 1115 0000', '3174 0917 0682 0008', NULL, '', '', '2019-06-26', '0000-00-00', NULL, 0, 5, 0, 'adolfusyp@gmail.com', 'THEODORA WARSIH', '', 'menikah', 'DYNA MULAINDAH.MA', 'KASIH KINANTHI YUNANTO (25/02/2016)', 'aktif'),
(66, '0066', 'TRI SUTOPO', 5, 2, 'kontrak', 'Klaten', '1989-02-06', 'Ular', 'Aquarius', 'Senin Kliwon', 'L', 'SMK', 'Teknik Otomotif', 'A', 'KATHOLIK', 'Sudimoro RT.001 RW.008 Kel. Ngering, Kec. Jogonalan, Klaten', 'Sudimoro RT.001 RW.008 Kel. Ngering, Kec. Jogonalan, Klaten', '0895 4226 12624', '3310 0831 0817 0006', '3310 0806 0289 0001', NULL, NULL, NULL, '2019-08-01', '2024-08-29', NULL, 6, 1, 0, 'trieadienda@gmail.com', 'SUNARTI', '', 'menikah', 'RINI SULISTYOWATI', '', 'aktif'),
(67, '0067', 'ANTON SUTOPO', 5, 2, 'kontrak', 'Bantul', '1991-06-28', 'Kambing', 'Cancer', 'Jumat Pahing', 'L', 'SMK', 'Mesin', 'O', 'ISLAM', 'Jolosutro RT.005 Kel. Srimulyo, Kec. Piyungan, Bantul 55792', 'Jolosutro RT.005 Kel. Srimulyo, Kec. Piyungan, Bantul 55792', '0895 6179 01402', '3402 1407 1218 0002', '3402 1428 0691 0001', NULL, '', '', '2019-08-01', '2024-08-29', NULL, 6, 1, 0, 'antonilineket21@gmail.com', 'LASIYEM', '', 'menikah', 'DEWI', '', 'aktif'),
(68, '0068', 'HERI ISNANTO', 5, 3, 'kontrak', 'Klaten', '1992-08-25', 'Monyet', 'Virgo', 'Selasa Legi', 'L', 'SMK', 'Otomotif', NULL, 'ISLAM', 'Gondangan RT.013 RW.008 Kel. Gondangan, Kec. Jogonalan, Klaten, Jawa Tengah 57452', 'Gondangan RT.013 RW.008 Kel. Gondangan, Kec. Jogonalan, Klaten, Jawa Tengah 57452', '0858 7534 3246', '3310 0810 0918 0002', '3310 0825 0892 0002', NULL, NULL, NULL, '2019-08-01', '2025-05-31', NULL, 12, 10, 0, 'heriisnanto2425@gmail.com', 'SUKARTI', '', 'menikah', 'LATAROVA CITRA NOVITASARI', 'ELVANO FARZAN FAEYZA (14/12/2018)', 'aktif'),
(69, '0069', 'DANIK SUTRISNIAWATI', 5, 16, 'kontrak', 'Sleman', '1987-03-17', 'Kelinci', 'Pisces', 'Selasa Pon', 'P', 'SMA', 'IPS', 'A', 'ISLAM', 'Tegal Janti RT.007 RW.003 Kel. Caturtunggal, Kec. Depok, Kab. Sleman, Yogyakarta 55281', 'Tegal Janti RT.007 RW.003 Kel. Caturtunggal, Kec. Depok, Kab. Sleman, Yogyakarta 55281', '0895 4211 65621', '3404 0727 0921 0003', '3404 0757 0387 0002', NULL, NULL, NULL, '2019-08-01', '2024-08-01', NULL, 6, 4, 0, '', 'SUMARNI', '', 'menikah', 'JUNIARTO', 'JOANA LATIFA ASMAULHUSNA (31/08/2009)', 'aktif'),
(70, '0070', 'IMAM DWI PRASETYA', 5, 2, 'kontrak', 'Sleman', '1990-11-10', 'Kuda', 'Scorpio', 'Sabtu Pahing', 'L', 'SMK', 'Mekanik Otomotif', NULL, 'ISLAM', 'Sribit RT.006 RW.013 Sendangtirto, Berbah, Sleman', 'Sribit RT.006 RW.013 Sendangtirto, Berbah, Sleman', '0896 9287 4466', '3404 0809 0419 0001', '3404 0810 1190 0003', NULL, NULL, NULL, '2019-10-24', '2024-10-25', NULL, 6, 0, 0, 'imamdwi1990@gmail.com', 'WALDIYAH', '', 'menikah', 'GABRIELLA ANGGI A', 'MASAHIRO UWAIS A.H (13/06/2019)', 'aktif'),
(71, '0071', 'AGUS DWI MAHARDIKA', 5, 4, 'kontrak', 'Boyolali', '1992-07-23', 'Monyet', 'Leo', 'Kamis Pon', 'L', 'SMK', 'Otomotif', 'O', 'ISLAM', 'Beji RT.003 RW.004 Taji, Prambanan, Klaten, Jawa Tengah 57454', 'Beji RT.003 RW.004 Taji, Prambanan, Klaten, Jawa Tengah 57454', '0856 2768 332', '3310 0105 0318 0005', '3309 0723 0792 0001', NULL, '', '', '2019-11-08', '2025-04-04', NULL, 12, 4, 0, 'dwi84413@gmail.com', 'SARTINEM', '', 'menikah', 'ERNI SETIANINGRUM', 'MARCELA AYU NINGTYAS (05/04/2018)', 'aktif'),
(72, '0072', 'MARDIYANTO', 5, 2, 'kontrak', 'Sleman', '1991-05-07', 'Kambing', 'Taurus', 'Selasa Kliwon', 'L', 'SMK', 'Mesin', 'O', 'ISLAM', 'Pagergunung II RT.001 Kel. Sitimulyo, Kec. Piyungan, Bantul 55792', 'Pagergunung II RT.001 Kel. Sitimulyo, Kec. Piyungan, Bantul 55792', '0818 0422 2062', '3402 1425 0516 0001', '3402 1407 0591 0001', NULL, '', '', '2019-11-08', '2025-01-11', NULL, 6, 6, 0, 'madiansyah518@gmail.com', 'LAGINEM', '', 'menikah', 'FARIDA', 'ANINDYA GITA A (09/05/2018)', 'aktif'),
(73, '0073', 'MARGARETTA SULISTYANINGTYAS', 5, 7, 'tetap', 'Yogyakarta', '1993-05-27', 'Ayam', 'Gemini', 'Kamis Legi', 'P', 'SMK', 'Admin Perkantoran', 'B', 'KATHOLIK', 'Nalen UH VI No.133 RT.035 RW.015 Kel. Sorosutan, Kec. Umbulharjo, Yogyakarta', 'Nalen UH VI No.133 RT.035 RW.015 Kel. Sorosutan, Kec. Umbulharjo, Yogyakarta', '0895 0635 1333', '', '3471 1367 0593 0003', NULL, NULL, NULL, '2019-12-01', NULL, NULL, 0, 0, 0, 'sulis.tyas47@gmail.com', 'ANASTASIA SUPIYAH', '', 'menikah', 'HARDI SUMARTONO', '', 'aktif'),
(74, '0074', 'ENGGAR MAHENDRAT SETIAWAN', 5, 2, 'kontrak', 'Sleman', '1992-08-03', 'Monyet', 'Leo', 'Senin Wage', 'L', 'SMK', 'Elektronika', NULL, 'ISLAM', 'Glondong RT.001 RW.001 Kel. Tirtomartani, Kec. Kalasan, Sleman', 'Glondong RT.001 RW.001 Kel. Tirtomartani, Kec. Kalasan, Sleman', '0896 7218 5349', '', '3404 1003 0892 0001', NULL, NULL, NULL, '2019-12-02', '2024-08-03', NULL, 3, 2, 0, 'enggarsetiawan192@gmail.com', 'WASINI', '', 'menikah', '', '', 'aktif'),
(75, '0075', 'AGUS NUGROHO', 5, 7, 'kontrak', 'Klaten', '1989-08-22', 'Ular', 'Leo', 'Selasa Pahing', 'L', 'SMK', 'Otomotif', 'A', 'ISLAM', 'Gunung Pegat RT.002 RW.008 Kel. Sengon, Kec. Prambanan, Klaten', 'Gunung Pegat RT.002 RW.008 Kel. Sengon, Kec. Prambanan, Klaten', '0856 2550 026', '3310 0113 1014 0001', '3310 0122 0889 0001', NULL, NULL, NULL, '2019-12-02', '2024-11-04', NULL, 6, 5, 0, 'agusnug2208@gmail.com', 'SUTINI', '', 'menikah', 'YULI LESTARI', 'MUHAMMAD ADEEVIAN DZAKY NUGROHO (22/11/2018)', 'aktif'),
(76, '0076', 'ANDRI ADMANTO', 2, 1, 'kontrak', 'Jakarta', '1985-02-09', 'Kerbau', 'Aquarius', 'Sabtu Pahing', 'L', 'S1', 'Akuntansi', 'AB', 'ISLAM', 'Bendan RT.06 RW.023 Kel.Tirtomartani, Kec.Kalasan, Kab. Sleman', 'Bendan RT.06 RW.023 Kel.Tirtomartani, Kec.Kalasan, Kab. Sleman', '0813 2807 5050', '3404 1018 0915 0003', '3404 1009 0285 0001', NULL, NULL, NULL, '2020-01-01', NULL, NULL, 0, 4, 0, 'andriadmanto0902@gmail.com', 'SUHARTINAH', '', 'menikah', 'MEIRISSA LINDA HAPSARI', 'KIM JAVIER ARSENO (10/02/2016)', 'aktif'),
(77, '0077', 'TRI HARYANTO', 5, 2, 'kontrak', 'Jakarta', '1996-01-10', 'Tikus', 'Capricorn', 'Rabu Wage', 'L', 'SMK', 'TKR', NULL, 'ISLAM', 'Banjarsari Glagaharjo, Cangkringan, Sleman, Yogyakarta', 'Banjarsari Glagaharjo, Cangkringan, Sleman, Yogyakarta', '0858 1136 3827', '', '3404 1710 0196 0002', NULL, NULL, NULL, '2020-01-02', '2024-08-31', NULL, 3, 0, 0, 'trih6768@gmail.com', 'SUWARSIH', '', 'lajang', '', '', 'aktif'),
(78, '0078', 'WIDYA WIRYAWAN', 4, 16, 'kontrak', 'Banjarnegara', '1981-11-05', 'Ayam', 'Scorpio', 'Kamis Kliwon', 'L', 'S1', 'Psikologi', 'O', 'ISLAM', 'Lingkungan Dayakan RT.04 RW.01 Kel. Kranggan, Kab. Temanggung, Jawa Tengah', 'Lingkungan Dayakan RT.04 RW.01 Kel. Kranggan, Kab. Temanggung, Jawa Tengah', '0813 2807 7752', '3323 1309 0112 0001', '3323 1305 1181 0004', NULL, NULL, NULL, '2020-01-30', '2025-07-28', NULL, 12, 12, 0, 'widya711.wiryawan@gmail.com', 'DYAH TRIWASIATIPOEDJIASTUTI', '', 'menikah', 'UDI IWAN SURYANINGSIH', 'DANISWARA PRAMA WIRYAWAN (04/10/2012)', 'aktif'),
(79, '0079', 'MUKTI INDRIYANTO', 5, 16, 'kontrak', 'Kulon Progo', '1988-12-15', 'Naga', 'Sagittarius', 'Kamis Pahing', 'L', 'S1', 'Hukum', 'A', 'ISLAM', 'Karang RT.43 RW.22 Gerbongsari Samigaluh Kulonprogo', 'Karang RT.43 RW.22 Gerbongsari Samigaluh Kulonprogo', '0822 9208 8649', '', '3401 1115 1288 0001', NULL, '', '', '2020-02-03', '2024-08-02', NULL, 6, 6, 0, 'mukti.indriyanto@gmail.com', 'ANDARMIYATI', '', 'menikah', '', '', 'aktif'),
(80, '0080', 'EMMA MAULIDA', 5, 4, 'kontrak', 'Magelang', '1997-08-21', 'Kerbau', 'Leo', 'Kamis Pon', 'P', 'S1', 'Biologi', 'AB', 'ISLAM', 'Komboran RT.03 RW.02 Kel. Paripurno, Kec. Salaman, Magelang', 'Komboran RT.03 RW.02 Kel. Paripurno, Kec. Salaman, Magelang', '0815 6556 180', '', '3308 0161 0897 0003', NULL, NULL, NULL, '2020-02-24', '2024-09-22', NULL, 12, 3, 0, 'emmamaulida93@gmail.com', 'SUMARTI', '', 'lajang', '', '', 'aktif'),
(81, '0081', 'KANANG BASUKI', 5, 6, 'kontrak', 'Sleman', '1986-02-10', 'Macan', 'Aquarius', 'Senin Pon', 'L', 'SMK', 'Teknik Mesin', 'O', 'ISLAM', 'Klangkapan II RT.003 RW.006 Kel. Margoluwih, Kec. Sayegan, Sleman', 'Klangkapan II RT.003 RW.006 Kel. Margoluwih, Kec. Sayegan, Sleman', '0813 8278 9831', '3404 0511 0712 0002', '3404 0510 1286 0003', NULL, NULL, NULL, '2020-03-09', '2024-10-09', NULL, 12, 1, 0, 'kanangbasuki27@gmail.com', 'MARJINEM', '', 'menikah', 'RINASIH', 'IQBAL HAFIZ RAMADHAN', 'aktif'),
(82, '0082', 'WAHYU NUR CAHYO', 5, 2, 'kontrak', 'Bantul', '2000-05-03', 'Naga', 'Taurus', 'Rabu Wage', 'L', 'SMK', 'Teknik Otomotif', 'B', 'ISLAM', 'Pagergunung 1 RT.02 RW.00 Kel. Sitimulyo, Kec. Piyungan, Kab. Bantul', 'Pagergunung 1 RT.02 RW.00 Kel. Sitimulyo, Kec. Piyungan, Kab. Bantul', '0895 3631 48536', '3402 1419 0903 0052', '3402 1403 0500 0001', NULL, NULL, NULL, '2020-03-23', '2025-01-22', NULL, 6, 6, 0, 'wahyunurcahyo79114@gmail.com', 'RAMBAT', '', 'lajang', '', '', 'aktif'),
(83, '0083', 'MURDIANTO', 5, 2, 'kontrak', 'Sleman', '1986-01-22', 'Macan', 'Aquarius', 'Rabu Wage', 'L', 'SMA', 'IPS', 'O', 'ISLAM', 'Ganjuran RT.002 RW.019 Kel. Sidorejo, Kec. Godean, Kab. Bantul', 'Ganjuran RT.002 RW.019 Kel. Sidorejo, Kec. Godean, Kab. Bantul', '0896 7013 3943', '3404 0228 0105 0522', '3404 0222 0186 0001', NULL, NULL, NULL, '2020-03-23', '2025-01-22', NULL, 6, 6, 0, 'murdianto412@gmail.com', 'RUMINI', '', 'menikah', 'APRILIA PUSPITA SARI', '', 'aktif'),
(84, '0084', 'CHISKA DIAN RAKASIWI', 5, 7, 'kontrak', 'Sleman', '1995-05-11', 'Babi', 'Taurus', 'Kamis Kliwon', 'P', 'SMK', 'Perhotelan', 'A', 'ISLAM', 'Sambilegi Lor RT.004 RW.054 Kel. Maguwoharjo, Kec. Depok, Kab. Sleman', 'Sambilegi Lor RT.004 RW.054 Kel. Maguwoharjo, Kec. Depok, Kab. Sleman', '0896 3347 9927', '3404 0704 0214 0004', '3404 0751 0595 0002', NULL, NULL, NULL, '2020-03-23', '2025-01-23', NULL, 12, 2, 0, 'shiskadianrakasiwi@gmail.com', 'WASILAH', '', 'menikah', 'DHIMAS AJI K', 'BINTANG AJI SAPUTRA', 'aktif'),
(85, '0085', 'MUKHLIS TAWAKAL', 5, 2, 'kontrak', 'Palembang', '1992-07-06', 'Monyet', 'Cancer', 'Senin Legi', 'L', 'SMA', 'IPA', 'AB', 'ISLAM', 'Glagah Kidul RT.002 RW.- Kel. Tamanan, Kec. Banguntapan, Kab. Bantul, Yogyakarta', 'Glagah Kidul RT.002 RW.- Kel. Tamanan, Kec. Banguntapan, Kab. Bantul, Yogyakarta', '0812 7067 0272', '3402 1205 1119 0004', '1603 0206 0792 0001', NULL, NULL, NULL, '2020-04-22', '2024-11-23', NULL, 6, 4, 0, 'mukhlistawakal@gmail.com', 'ERWANA NINGSIH', '', 'menikah', 'LESTARI', '', 'aktif'),
(86, '0086', 'HENDRAWAN CAHYO', 4, 15, 'kontrak', 'Klaten', '1992-10-10', 'Monyet', 'Libra', 'Sabtu Pahing', 'L', 'SMK', 'Teknik Otomotif', 'O', 'ISLAM', 'Duwet RT.015 RW.006 Kel. Duwet, Kec.Ngawen, Kab. Klaten, Yogyakarta', 'Duwet RT.015 RW.006 Kel. Duwet, Kec.Ngawen, Kab. Klaten, Yogyakarta', '0857 7377 3247', '3310 2214 0405 0013', '3310 2210 1092 0003', NULL, NULL, NULL, '2020-04-22', '2024-09-22', NULL, 12, 4, 0, 'dion.rewo@gmail.com', 'SRI SUGIYANTI', '', 'menikah', 'AGUSTINA TIARANINGSIH', 'FLORENTINA ELINA NATHANIA (27/05/2023)', 'aktif'),
(87, '0087', 'EGA PRASETYA', 5, 7, 'kontrak', 'Sleman', '1996-03-28', 'Tikus', 'Aries', 'Kamis Pahing', 'L', 'SMK', 'Desain Dan Produksi Kriya', 'B', 'ISLAM', 'Jalan Tongkol V No.26, Kel. Minomartani, Kec. Ngaglik, Sleman', 'Jalan Tongkol V No.26, Kel. Minomartani, Kec. Ngaglik, Sleman', '0855 3689 3958', '3404 1212 0205 7188', '3404 1228 0396 0002', NULL, NULL, NULL, '2020-04-30', '2024-11-30', NULL, 12, 7, 0, 'egaprasetya68@gmail.com', 'SITI PRIHATIN', '', 'lajang', '', '', 'aktif'),
(88, '0088', 'DIKHA SATRIAPUTRA', 4, 16, 'kontrak', 'Kediri', '1986-06-17', 'Macan', 'Gemini', 'Selasa Kliwon', 'L', 'S1', 'Teknik Geofisika', 'O', 'ISLAM', 'Keputren RT.04 Kel. Pleret, Kec. Pleret, Bantul 55791', 'Keputren RT.04 Kel. Pleret, Kec. Pleret, Bantul 55791', '0813 2910 3846', '', '3571 0217 0686 0001', NULL, NULL, NULL, '2020-05-08', NULL, NULL, NULL, 0, 0, 'dikha_satriaputra@yahoo.com', 'NI MADE WARTINI', '', 'menikah', 'NURFITRIA YULINDA', 'ZAKIA ADZNI W', 'aktif'),
(89, '0089', 'ADE MAULANA SAPUTRA', 5, 2, 'kontrak', 'Sleman', '1997-12-29', 'Kerbau', 'Capricorn', 'Senin Pon', 'L', 'SMK', 'Teknik Bangunan', 'B', 'ISLAM', 'Salakan, Trihanggo, Gamping, Sleman, Yogyakarta', 'Salakan, Trihanggo, Gamping, Sleman, Yogyakarta', '0857 4011 5248', '3404 0108 0520 0009', '3404 0129 1297 0002', NULL, NULL, NULL, '2020-06-02', '2025-01-03', NULL, 12, 0, 0, '', 'SUMINEM', '', 'menikah', 'TRI UTAMI', '', 'aktif'),
(90, '0090', 'ADIB HAYKAL', 5, 14, 'kontrak', 'Pemalang', '1999-11-22', 'Kelinci', 'Scorpio', 'Senin Legi', 'L', 'SMA', 'IPA', 'A', 'ISLAM', 'Sentulrejo MG II/639 RT/RW 032/009 Kel. Wirogunan, Mergangsan', 'Jl. Agung Sedayu Blok G RT 07/60 Joho Kel. Condong Catur, Depok, Sleman', '0818 0459 6799', '3471 1218 0319 0001', '3327 0122 1199 0003', NULL, NULL, NULL, '2020-06-02', '2024-07-31', NULL, 12, 12, 0, 'adib99haykal@gmail.com', 'NADIAH', '', 'lajang', '', '', 'aktif'),
(91, '0091', 'FANI SETIAWAN', 5, 7, 'kontrak', 'Gunungkidul', '1998-07-09', 'Macan', 'Cancer', 'Kamis Kliwon', 'L', 'SMK', 'Audio Video', 'O', 'ISLAM', 'Watubelah RT.004/RW.004 Kemandang Tanjungsari, Gunung Kidul, DIY', 'Watubelah RT.004/RW.004 Kemandang Tanjungsari, Gunung Kidul, DIY', '0857 4877 5435', '3403 1726 0111 0017', '3403 1709 0898 0001', NULL, NULL, NULL, '2020-06-16', '2025-01-15', NULL, 12, 12, 0, 'fanisetiawann123@gmail.com', 'SUMINEM', '', 'lajang', '', '', 'aktif'),
(92, '0092', 'MUHAMMAD ERI AHADI', 5, 16, 'kontrak', 'Sumbawa', '1988-01-17', 'Naga', 'Capricorn', 'Minggu Wage', 'L', 'S1', 'Pendidikan Luar Sekolah', NULL, 'ISLAM', 'Dsn. Yosowinangun RT.01/03 Dsn. Jajab Kec. Gambiran, Kab. Banyuwangi', 'Dsn. Yosowinangun RT.01/03 Dsn. Jajab Kec. Gambiran, Kab. Banyuwangi', '0822 6440 1774', '3510 0709 0317 0005', '3510 0717 0188 0004', NULL, NULL, NULL, '2020-08-01', '2024-12-03', NULL, 6, 6, 0, 'erihadi011188@gmail.com', 'JUMAIRIK', '', 'menikah', 'ENDANG TARWINANTI', 'OZI RAMADHAN (09/08/2017)', 'aktif'),
(93, '0093', 'NURUL HAKIKI', 5, 16, 'kontrak', 'Probolinggo', '1989-01-11', 'Ular', 'Capricorn', 'Rabu Wage', 'P', 'SMK', 'Sekretaris', NULL, 'ISLAM', 'Jl. Serayu RT/RW. 002/001 Kel. Jrebeng Kulon, Kec. Kedopok, Probolinggo', 'Jl. Serayu RT/RW. 002/001 Kel. Jrebeng Kulon, Kec. Kedopok, Probolinggo', '0857 3060 3337', '3574 0524 0719 0004', '3574 0451 0189 0002', NULL, NULL, NULL, '2020-09-17', '2024-08-16', NULL, 6, 3, 0, 'hakikinurul753@gmail.com', NULL, '', 'menikah', 'HENDRA', '', 'aktif'),
(94, '0094', 'SUDARYANTO', 5, 4, 'kontrak', 'Bantul', '1991-10-04', 'Kambing', 'Libra', 'Jumat Kliwon', 'L', 'SMK', 'Otomotif', 'B', 'ISLAM', 'Wolosono RT.001/RW Kebonagung, Imogiri, Bantul', 'Wolosono RT.001/RW Kebonagung, Imogiri, Bantul', '0858 6747 9417', '3402 1023 0803 0046', '3402 1023 0803 0046', NULL, '', '', '2020-10-15', '2025-05-17', NULL, 12, 11, 0, 'sudaryanto887@gmail.com', 'SUMIYEM', '', 'menikah', '', '', 'aktif'),
(95, '0095', 'FARIZ FATHULLAH', 5, 16, 'kontrak', 'Yogyakarta', '1990-08-15', 'Kuda', 'Leo', 'Rabu Kliwon', 'L', 'SMK', 'Listrik', 'A', 'ISLAM', 'Kedungpoh Lor RT.001/003 Kedungpoh Lor, Nglipar, Gunung Kidul.', 'Kedungpoh Lor RT.001/003 Kedungpoh Lor, Nglipar, Gunung Kidul.', '0882 2782 9348', '3403 0214 0518 0001', '3404 0615 0890 0005', NULL, NULL, NULL, '2020-10-21', '2025-01-22', NULL, 6, 6, 0, 'farizfath90@gmail.com', 'MARSIANA', '', 'menikah', 'TUTIK LESTARI', 'AHSAN ABQARY ZAKARIYYA (23/12/2018)', 'aktif'),
(96, '0096', 'LULUK YUNIATI', 5, 16, 'kontrak', 'Blitar', '1992-05-05', 'Monyet', 'Taurus', 'Selasa Wage', 'P', 'SMK', 'Keuangan', NULL, 'ISLAM', 'Dsn. Turi RT.002/RW.002 Desa Toyaning, Kec. Rejoso, Pasuruhan', 'Dsn. Turi RT.002/RW.002 Desa Toyaning, Kec. Rejoso, Pasuruhan', '0822 3128 4514', '35 1423 0517 0002', '3575 0145 0592 0003', NULL, NULL, NULL, '2020-11-01', '2024-08-28', NULL, 12, 6, 0, '', 'KARTINI', '', 'menikah', 'MOHAMMAD KHAMID MASRUDI', 'NAFLA SYAKIRA (22/06/2017)', 'aktif'),
(97, '0097', 'HANIF JEMMY LATIFI', 5, 16, 'kontrak', 'Magelang', '1990-08-30', 'Kuda', 'Virgo', 'Kamis Kliwon', 'L', 'SMA', 'Bahasa', 'B', 'ISLAM', 'Perum Manunggal Sejahtera II RT.6/7 Salatiga', 'Jl. Nangka 2 Maguwoharjo, Depok, Sleman', '0878 7883 7135', '3373 0120 0110 0003', '3373 0130 0890 0002', NULL, NULL, NULL, '2020-11-23', '2024-12-24', NULL, 6, 6, 0, 'jimmyhanif@gmail.com', 'HINDARTI', '', 'lajang', '', '', 'aktif'),
(98, '0098', 'NURYANTI', 5, 16, 'kontrak', 'Madiun', '1992-05-18', 'Monyet', 'Taurus', 'Senin Pahing', 'P', 'SMK', 'Bisnis Manajemen', NULL, 'ISLAM', 'Ganting RT/RW 009/004 Karangsono, Kwadungan, Ngawi', 'Ganting RT/RW 009/004 Karangsono, Kwadungan, Ngawi', '0857 4800 0323', '3521 0610 0816 0001', '3519 0958 0592 0000', NULL, NULL, NULL, '2021-01-01', '2024-12-29', NULL, 6, 6, 0, '', NULL, '', '', '', '', 'aktif'),
(99, '0099', 'ADE RESTU PRASETYO', 5, 16, 'kontrak', 'Yogyakarta', '1991-12-08', 'Kambing', 'Sagittarius', 'Minggu Kliwon', 'L', 'SMK', 'Otomotif', 'O', 'ISLAM', 'Sutopadan, Ngestiharjo, Kasihan, Bantul', 'Kadirojo 2 Purwomartani, Kalasan, Sleman', '0823 2359 3345', '3402 1608 1291 0001', '34021 6111 1044 0008', NULL, NULL, NULL, '2021-02-01', '2025-01-29', NULL, 12, 7, 0, 'aderestuprasetyo@gmail.com', 'ANI ISMIYATI', '', 'menikah', 'RISALIA WIBOWO', '', 'aktif'),
(100, '0100', 'FAJAR DWI HARTANTO', 5, 12, 'kontrak', 'Sleman', '1991-07-16', 'Kambing', 'Cancer', 'Selasa Kliwon', 'L', 'S1', 'Teknologi Informatika', 'B', 'ISLAM', 'Ngepos RT.04/24 Lumbungrejo, Tempel, Sleman, Yogyakarta', 'Ngepos RT.04/24 Lumbungrejo, Tempel, Sleman, Yogyakarta', '0856 2925 558', '3404 1424 0818 0003', '3404 1416 0791 0003', NULL, NULL, NULL, '2021-07-12', '2025-01-15', NULL, 6, 6, 0, 'fajardwi016@gmail.com', 'SITI NURIYAH', '', 'menikah', 'AMALIAH KHAIRINA', 'BARIQ ZAFRAN HARTANTO (20/05/2019)', 'aktif'),
(101, '0101', 'KHUSNUL FITRIYANI', 5, 16, 'kontrak', 'Tulungagung', '1994-03-26', 'Anjing', 'Aries', 'Sabtu Wage', 'P', 'SMA', 'IPA', NULL, 'ISLAM', 'Dusun Sukunan RT 004/RW 005 Sukokerto, Pajarakan, Probolinggo, Jawa Timur', 'Dusun Sukunan RT 004/RW 005 Sukokerto, Pajarakan, Probolinggo, Jawa Timur', '0813 5989 0875', '', '3513 1666 0394 0001', NULL, NULL, NULL, '2021-08-21', '2024-08-18', NULL, 12, 10, 0, '', NULL, '', '', '', '', 'aktif'),
(102, '0102', 'RISTIANTO RAHMAN', 5, 4, 'kontrak', 'Sleman', '1996-10-13', 'Tikus', 'Libra', 'Minggu Legi', 'L', 'S1', 'Kimia', 'A', 'ISLAM', 'Ngemplak II, Umbulmartani, Ngemplak Sleman', 'Ngemplak II, Umbulmartani, Ngemplak Sleman', '0878 9955 7108', '3404 1112 0205 1857', '3404 1113 1096 0002', NULL, NULL, NULL, '2021-10-25', '2025-04-19', NULL, 12, 10, 0, 'ari.kunta13@gmail.com', 'ISTI HIDAYATI', '', 'lajang', '', '', 'aktif');
INSERT INTO `tbl_pegawai` (`id_pegawai`, `nip`, `nama_pegawai`, `jabatan_id`, `divisi_id`, `status_pegawai`, `tempat_lahir`, `tgl_lahir`, `shio`, `zodiak`, `weton`, `jenis_kelamin`, `pendidikan_terakhir`, `jurusan`, `golongan_darah`, `agama`, `alamat_ktp`, `alamat_domisili`, `kontak_pegawai`, `no_kk`, `no_ktp`, `no_jamsostek`, `no_bpjsKesehatan`, `no_npwp`, `tgl_masuk`, `tgl_selesai`, `tgl_keluar`, `durasi_kontrak`, `kuota_cuti`, `sisa_cuti`, `email_pegawai`, `nama_ibu`, `nama_ayah`, `status_pernikahan`, `nama_pasangan`, `nama_anak`, `status`) VALUES
(103, '0103', 'FAKHMI ZIADATUL BARQAH', 5, 4, 'kontrak', 'Kebumen', '1996-07-20', 'Tikus', 'Cancer', 'Sabtu Legi', 'L', 'S1', 'Teknik Lingkungan', 'B', 'ISLAM', 'Plarangan RT.04/01 Karanganyar, Kebumen', 'Plarangan RT.04/01 Karanganyar, Kebumen', '0822 2075 8419', '3305 2015 0207 5248', '3305 2020 0796 0002', NULL, NULL, NULL, '2021-11-01', '2025-04-29', NULL, 12, 9, 0, 'fakhmiziadatul20@gmail.com', 'KHIKMAH', '', 'menikah', '', '', 'aktif'),
(104, '0104', 'AGUS TRIYANTO', 5, 7, 'kontrak', 'Jakarta', '1988-07-29', 'Naga', 'Leo', 'Jumat Pon', 'L', 'SMP', NULL, NULL, 'ISLAM', 'Slegerengan Kalitengah Wedi Klaten RT.060/026', 'Slegerengan Kalitengah Wedi Klaten RT.060/026', '0877 4227 8321', '3310 0303 0214 0002', '3310 0229 0788 0001', NULL, NULL, NULL, '2021-11-18', '2024-08-24', NULL, 3, 1, 0, 'ags.3ynto@gmail.com', 'MARYAM', '', 'menikah', 'ARUM MIYATI', 'RAFA ALIF SYAHPUTRA (01/11/2014)', 'aktif'),
(105, '0105', 'DEWI KURNIA', 5, 16, 'kontrak', 'Surakarta', '1991-09-13', 'Kambing', 'Virgo', 'Jumat Wage', 'P', 'SMA', 'IPA', NULL, 'ISLAM', 'Bibis Wetan RT. 01, RW. XX Gilingan, Banjarsari, Surakarta 57134', 'Bibis Wetan RT. 01, RW. XX Gilingan, Banjarsari, Surakarta 57134', '0812 2834 445', '', '3372 0553 0991 0004', NULL, NULL, NULL, '2021-12-06', '2024-11-10', NULL, 6, 6, 0, 'dewikurnia1991@gmail.com', NULL, '', '', '', '', 'aktif'),
(106, '0106', 'JOHAN WIDARYANTO', 5, 16, 'kontrak', 'Kendal', '1992-02-02', 'Monyet', 'Aquarius', 'Minggu Legi', 'L', 'SMK', 'Otomotif', 'A', 'ISLAM', 'Salaran RT.021/005 Ngoro Oro, Patuk, Gunung Kidul 55862', 'Salaran RT.021/005 Ngoro Oro, Patuk, Gunung Kidul 55862', '0878 3031 9030', '3403 0412 0820 0003', '3424 0602 0292 0001', NULL, '', '', '2021-12-15', '2024-12-24', NULL, 6, 5, 0, 'widaryantojohan@gmail.com', 'SUMARNI', '', 'menikah', 'ZULLY WARSIH', 'BELVA HERLY', 'aktif'),
(107, '0107', 'SLAMET YULIANTO', 4, 16, 'kontrak', 'Pamekasan', '1988-07-05', 'Naga', 'Cancer', 'Selasa Wage', 'L', 'S1', 'Teknik Informatika', NULL, 'ISLAM', 'Jalan Merpati RT/RW 002/002, Kel. Gunung Sekar - Sampang', 'Jalan Merpati RT/RW 002/002, Kel. Gunung Sekar - Sampang', '0857 3269 5584', '3527 0312 0918 0015', '3528 0205 0788 0001', NULL, NULL, NULL, '2021-12-17', '2024-12-13', NULL, 6, 5, 0, 'slametyulianto404@gmail.com', NULL, '', 'menikah', 'MARIA CHIKA SANTOSO', 'MUHAMMAD AZKA (23/08/2016)', 'aktif'),
(108, '0108', 'GUNAWAN SAPUTRA', 5, 3, 'kontrak', 'Sleman', '1998-01-01', 'Macan', 'Capricorn', 'Kamis Legi', 'L', 'SMK', 'IPS', 'A', 'ISLAM', 'Tempel Sari Banjeng RT 04/35 Maguwoharjo, Depok, Sleman, Yogyakarta', 'Tempel Sari Banjeng RT 04/35 Maguwoharjo, Depok, Sleman, Yogyakarta', '0899 7437 676', '3404 0703 0407 0039', '3404 0701 0198 0005', NULL, NULL, NULL, '2022-01-26', '2024-07-27', '2024-07-22', 6, 0, 0, 'saputragunawan970@gmail.com', 'TUTI ARIYANI', '', 'lajang', '', '', 'tidak'),
(109, '0109', 'NURUL YULIATI', 5, 4, 'kontrak', 'Sleman', '1993-07-06', 'Ayam', 'Cancer', 'Selasa Legi', 'P', 'S1', 'Manajemen', 'B', 'ISLAM', 'Jaten RT.007/31 Sendangadi, Mlati', 'Jaten RT.007/31 Sendangadi, Mlati', '0822 3356 4520', '3404 0614 0318 0010', '3404 0646 0793 0001', NULL, NULL, NULL, '2022-02-14', '2024-11-15', NULL, 12, 5, 0, 'yuliati.nurul@gmail.com', 'YULI ASTUTI', '', 'menikah', 'BAYU NUGROHO', 'SUKMA LILIA JERE (14/09/2018)', 'aktif'),
(110, '0110', 'MEY KUSUMA JATI', 5, 9, 'kontrak', 'Bantul', '1999-05-09', 'Kelinci', 'Taurus', 'Minggu Wage', 'P', 'D3', 'Akuntansi', 'B', 'ISLAM', 'Sambeng III RT.02 Poncosari, Srandakan, Bantul, Yogyakarta', 'Sambeng III RT.02 Poncosari, Srandakan, Bantul, Yogyakarta', '0895 3923 41251', '3402 0125 0504 0308', '3402 0149 0599 0001', NULL, NULL, NULL, '2022-02-25', '2024-11-26', NULL, 6, 5, 0, 'kusumamey09@gmail.com', 'SAYUNI', '', 'lajang', '', '', 'aktif'),
(111, '0111', 'AISYAH RISKI MILENIA', 5, 4, 'kontrak', 'Klaten', '2000-01-10', 'Naga', 'Capricorn', 'Senin Kliwon', 'P', 'S1', 'Kimia', NULL, 'ISLAM', 'Cucukan RT.02/RW.05 Wonoboyo, Jogonalan, Klaten', 'Cucukan RT.02/RW.05 Wonoboyo, Jogonalan, Klaten', '0857 9940 6066', '', '3310 0850 0100 0001', NULL, '', '', '2022-03-28', '2024-09-28', NULL, 12, 3, 0, 'ais.millenia@gmail.com', '', '', 'lajang', '', '', 'aktif'),
(112, '0112', 'TITI RESMIATI', 5, 16, 'kontrak', 'Tegal', '1980-04-23', 'Monyet', 'Taurus', 'Rabu Wage', 'P', 'D3', 'Komputerisasi Akuntansi', NULL, 'ISLAM', 'Jl. Sumbing RT.04/06 No.127 Dukuhwringin, Slawi', 'Jl. Sumbing RT.04/06 No.127 Dukuhwringin, Slawi', '0858 6668 4023', '3328 1013 0716 0007', '6402 0363 0480 0001', NULL, NULL, NULL, '2022-04-01', '2024-09-02', NULL, 6, 4, 0, '', 'TASUNI', '', 'menikah', 'ABDUL MANAF', '', 'aktif'),
(113, '0113', 'TRI CAHYA WIBAWA', 5, 12, 'kontrak', 'Yogyakarta', '1994-04-30', 'Anjing', 'Taurus', 'Sabtu Wage', 'L', 'S1', 'Teknik Informatika', 'AB', 'ISLAM', 'Jl. Balirejo UH 2/381C RT/RW 21/07 Mujamuju, Umbulharjo, Yogyakarta', 'Jl. Balirejo UH 2/381C RT/RW 21/07 Mujamuju, Umbulharjo, Yogyakarta', '0899 3932 789', '', '3471 1330 0494 0000', NULL, '', '', '2022-04-20', '2024-11-20', NULL, 12, 3, 0, 'tricahyawbw@gmail.com', 'SATINAH (ALM)', 'WICAKSONO RAHARJO', 'menikah', 'MEYSITA DWI PRATIWI', '', 'aktif'),
(114, '0114', 'SRI BUDIARTI', 5, 16, 'kontrak', 'Jakarta', '1984-09-10', 'Tikus', 'Virgo', 'Senin Kliwon', 'P', 'SMU', 'IPA', NULL, 'ISLAM', 'Jl. RA Kartini RT.02/04 No.9C Saditan, Brebes', 'Jl. RA Kartini RT.02/04 No.9C Saditan, Brebes', '0858 6038 6408', '3329 0924 0311 0015', '3329 0950 0984 0011', NULL, NULL, NULL, '2022-05-20', '2024-11-21', NULL, 6, 6, 0, '', 'SOLICHA', '', 'menikah', 'JOKO PURBO YUWONO', 'ERLAND AKBAR ARGANI (01/07/2012), EQ BUDIWIYONO (3', 'aktif'),
(115, '0115', 'SUPRIHARTO', 5, 16, 'kontrak', 'Magelang', '1973-06-17', 'Kerbau', 'Gemini', 'Minggu Pahing', 'L', 'SMA', 'IPA', 'O', 'ISLAM', 'Jetis RT 03 RW 13 Caturharjo, Sleman, DIY', 'Jetis RT 03 RW 13 Caturharjo, Sleman, DIY', '0821 3474 5584', '', '3404 1317 0773 0004', NULL, NULL, NULL, '2022-06-08', '2024-12-09', NULL, 6, 5, 0, '', NULL, '', 'menikah', '', '', 'aktif'),
(116, '0116', 'INDRA PRIYO BINTARA', 5, 16, 'kontrak', 'Surabaya', '1981-04-25', 'Ayam', 'Taurus', 'Sabtu Legi', 'L', 'S1', 'Ilmu Hukum', 'B', 'ISLAM', 'Bendul Merisi Permai Blok A-6 RT 001 RW 009 Bendul Merisi, Wonocolo, Surabaya', 'Bendul Merisi Permai Blok A-6 RT 001 RW 009 Bendul Merisi, Wonocolo, Surabaya', '0816 1513 1951', '3578 0205 0911 0009', '3578 0225 0481 0003', NULL, NULL, NULL, '2022-06-10', '2024-09-12', NULL, 3, 3, 0, 'indrapriyob5@gmail.com', 'TITIN SUGIHARTIN', '', 'menikah', 'RIZKI ANGGRAINI YUNITA S.', 'AIDAN VALLIANT ALTHAF R.B (23/07/2011), ELDRIDGE Z', 'aktif'),
(117, '0117', 'URIP SUSANTO', 5, 16, 'kontrak', 'Pamekasan', '1989-10-21', 'Ular', 'Libra', 'Sabtu Pahing', 'L', 'SMA', 'IPS', NULL, 'ISLAM', 'Dusun Lebi, Kel. Ceguk, Kec. Tlanakan, Kab. Pamekasan, Jawa Timur', 'Dusun Lebi, Kel. Ceguk, Kec. Tlanakan, Kab. Pamekasan, Jawa Timur', '0823 3044 3943', '3528 0118 0717 0001', '3528 0121 1089 0003', NULL, NULL, NULL, '2022-07-08', '2024-08-09', NULL, 6, 2, 0, '', 'RUKMIYATI', '', 'menikah', 'NOER LAILY FEBRIANA', 'ARINAL HAQUE (07/06/2016)', 'aktif'),
(118, '0118', 'ABDUL AZIZ', 4, 16, 'kontrak', 'Tegal', '1990-06-22', 'Kuda', 'Cancer', 'Jumat Legi', 'L', 'S1', 'Sarjana Pendidikan', NULL, 'ISLAM', 'Jl. Nanas Gg. 3 No. 3 RT 02 RW 05 Kel. Pekauman, Kec. Tegal, Kota Tegal', 'Jl. Nanas Gg. 3 No. 3 RT 02 RW 05 Kel. Pekauman, Kec. Tegal, Kota Tegal', '0819 0209 3090', '3376 0129 1013 0006', '3328 1722 0690 0002', NULL, NULL, NULL, '2022-07-20', '2025-01-22', NULL, 12, 8, 0, 'aziz.tegal66@gmail.com', 'WASRIPAH', '', 'menikah', 'TRI PURWANTI', 'NADA HANUN MUMTAZAH', 'aktif'),
(119, '0119', 'RENADA ANJAS PRASETYA', 5, 10, 'kontrak', 'Klaten', '1999-04-20', 'Kelinci', 'Aries', 'Selasa Kliwon', 'P', 'S1', 'Akuntansi', 'B', 'ISLAM', 'Jl. Nakulo Manis Rejo, Maguwoharjo, Depok, Sleman, Yogyakarta', 'Jl. Nakulo Manis Rejo, Maguwoharjo, Depok, Sleman, Yogyakarta', '0815 7238 7338', '', '3404 0760 0499 0005', NULL, NULL, NULL, '2022-08-23', '2025-02-22', NULL, 12, 6, 0, 'renadaprasetya123@gmail', 'SRI SUNDARI', '', 'lajang', '', '', 'aktif'),
(120, '0120', 'IDA ROSIDA', 5, 16, 'kontrak', 'Probolinggo', '1993-05-15', 'Ayam', 'Taurus', 'Sabtu Wage', 'P', 'SMA', 'IPS', NULL, 'ISLAM', 'Dusun Krajan II RT.07/02 Desa Maron Wetan, Kec. Maron, Kab. Probolinggo', 'Dusun Krajan II RT.07/02 Desa Maron Wetan, Kec. Maron, Kab. Probolinggo', '0823 3024 4991', '3513 1713 1020 0004', '3513 1755 0593 0000', NULL, NULL, NULL, '2022-08-24', '2024-09-29', NULL, 6, 4, 0, '', NULL, '', '', '', '', 'aktif'),
(121, '0121', 'RATNA PUTRI NILAM SARI', 5, 16, 'kontrak', 'Blitar', '1999-08-11', 'Kelinci', 'Leo', 'Rabu Pon', 'P', 'SMK', NULL, NULL, 'ISLAM', 'Jl. Tidar No. 23 Blitar', 'Jl. Tidar No. 23 Blitar', '0858 5188 2900', '', '3572 0151 0891 0000', NULL, NULL, NULL, '2022-09-19', '2024-12-19', NULL, 6, 6, 0, 'ratnaputri383@gmail.com', NULL, '', '', '', '', 'aktif'),
(122, '0122', 'KHASANIAH', 5, 16, 'kontrak', 'Pemalang', '1988-05-20', 'Naga', 'Taurus', 'Jumat Pon', 'P', 'SMA', 'IPA', NULL, 'ISLAM', 'RT.02 RW.06 Desa Serang, Kecamatan Petarukan, Kabupaten Pemalang', 'RT.02 RW.06 Desa Serang, Kecamatan Petarukan, Kabupaten Pemalang', '0838 0899 5044', '3327 1019 1112 0007', '3327 1060 0588 0147', NULL, NULL, NULL, '2022-10-01', '2024-10-04', NULL, 6, 4, 0, 'priyambodoniah@gmail.com', 'WASIATURROHIMAH', '', 'menikah', 'BOWO PRIYAMBODO', 'GHASSAN ADYA PRIYAMKHA, GHAZIYA JILIKA PRIYAMKHA, ', 'aktif'),
(123, '0123', 'NIKEN DIANA PUTRI PURNAMASARI', 5, 16, 'kontrak', 'Jombang', '2003-05-23', 'Kambing', 'Gemini', 'Jumat Wage', 'P', 'SMK', 'IPS', NULL, 'ISLAM', 'Dusun Sawiaji, Ds. Beji, Kec. Jogoroto, Jombang', 'Dusun Sawiaji, Ds. Beji, Kec. Jogoroto, Jombang', '0882 0092 14223', '', '3517 1363 0103 0000', NULL, '', '', '2022-10-29', '2024-12-01', NULL, 6, 6, 0, 'nikendianap@gmail.com', '', '', '', '', '', 'aktif'),
(124, '0124', 'RIZA RIKHLATUR ROKHMAH', 5, 16, 'kontrak', 'Surabaya', '2000-04-04', 'Naga', 'Aries', 'Selasa Kliwon', 'P', 'S1', 'Gizi', NULL, 'ISLAM', 'Jl. Joyoboyo 53 RT.020/RW.002 Medaeng Waru, Sidoarjo', 'Jl. Joyoboyo 53 RT.020/RW.002 Medaeng Waru, Sidoarjo', '0882 1757 5130', '3515 18300 1090 0057', '3515 1844 0400 0000', NULL, NULL, NULL, '2022-11-11', '2025-05-10', NULL, 12, 12, 0, 'rizarikhla2@gmail.com', 'CHOMAILIL ZUHRO', '', 'lajang', '', '', 'aktif'),
(125, '0125', 'ARVIAN ARIEFIONO S. KOM', 4, 14, 'kontrak', 'Sleman', '1993-03-08', 'Ayam', 'Pisces', 'Senin Legi', 'L', 'S1', 'Teknik Informatika', 'A', 'ISLAM', 'Glagah UH 4/133A Warungboto, Umbulharjo, Yogyakarta', 'Glagah UH 4/133A Warungboto, Umbulharjo, Yogyakarta', '0821 2225 2355', '', '3471 1308 0393 0002', NULL, NULL, NULL, '2022-12-01', NULL, NULL, NULL, 0, 0, '', 'SUMARNI ARYANI', '', 'menikah', 'NURIS FITRIANI', 'REYHAN A.R (07/06/2017)', 'aktif'),
(126, '0126', 'RISMA NURFADILA', 5, 4, 'kontrak', 'Sleman', '1999-12-18', 'Kelinci', 'Sagittarius', 'Sabtu Pahing', 'P', 'SMK', 'Teknik Kimia', 'B', 'ISLAM', 'Geneng Karangnongko RT.002/027 Kel. Tirtomartani, Kec. Kalasan, Kab. Sleman, DIY', 'Geneng Karangnongko RT.002/027 Kel. Tirtomartani, Kec. Kalasan, Kab. Sleman, DIY', '0838 6719 2058', '', '3404 1058 1299 0001', NULL, NULL, NULL, '2022-12-12', '2025-06-09', NULL, 12, 12, 0, 'nurfadilarisma@gmail.com', 'SISWATUN', '', 'lajang', '', '', 'aktif'),
(127, '0127', 'IRMA TRI WULANDARI', 5, 16, 'kontrak', 'Jakarta', '1989-04-18', 'Ular', 'Aries', 'Selasa Legi', 'P', 'SMK', NULL, NULL, 'ISLAM', 'Jl. MT Haryono VI C/859 C RT/RW 006/004 Dinoyo, Lowolwaru, Malang', 'Jl. MT Haryono VI C/859 C RT/RW 006/004 Dinoyo, Lowolwaru, Malang', '0857 5973 7269', '', '3573 0558 0489 0000', NULL, NULL, NULL, '2023-01-05', '2024-10-07', NULL, 6, 5, 0, '', NULL, '', '', '', '', 'aktif'),
(128, '0128', 'DANU WARDOYO', 4, 16, 'kontrak', 'Semarang', '1982-07-13', 'Anjing', 'Cancer', 'Selasa Kliwon', 'L', 'S1', 'Sastra', NULL, 'ISLAM', 'Cilosari Dalam RT/RW 009/007 Kemijen, Semarang Timur', 'Cilosari Dalam RT/RW 009/007 Kemijen, Semarang Timur', '0896 3792 1156', '', '3374 0313 0782 0003', NULL, NULL, NULL, '2023-01-09', '2024-07-10', '2024-07-11', 6, 2, 0, 'aryasakti1010@gmail.com', 'WARSINOM', '', 'menikah', 'SRI WAHYUNINGSIH', 'EKA BIMA S. (2005), IBRA J.J (04/04/2018) ', 'tidak'),
(129, '0129', 'NADIA HAPSARI OKTARINA', 5, 5, 'kontrak', 'Salatiga', '1989-10-29', 'Ular', 'Scorpio', 'Minggu Kliwon', 'P', 'S1', 'Ilmu Gizi', 'B', 'ISLAM', 'Jalan Argoyuwono No.43 Salatiga', 'Prangwedanan RT. 01/03 Potorono, Banguntapan, Bantul', '0821 3664 3370', '', '3373 0369 1089 0001', NULL, '', '', '2023-01-31', '2024-07-31', NULL, 12, 1, 0, '', '', '', '', '', '', 'aktif'),
(130, '0130', 'ADITYA NURUL HUDA', 5, 9, 'kontrak', 'Temanggung', '1987-07-08', 'Kelinci', 'Cancer', 'Rabu Legi', 'L', 'D3', 'Akuntansi', 'B', 'ISLAM', 'Klurak RT. 03 RW. 04 Gundang Winangun, Ngadirejo, Temanggung', 'Jalan AM. Sangaji Yogyakarta', '0858 0127 5178', '', '3323 0908 0787 0003', NULL, NULL, NULL, '2023-03-09', '2024-08-08', NULL, 12, 1, 0, 'adityanurulhuda98@gmail.com', 'MISTIYAH', '', 'lajang', '', '', 'aktif'),
(131, '0131', 'PASKALIS PURWAKA WISNUTAMA', 3, 1, 'kontrak', 'Cilacap', '1982-03-25', 'Anjing', 'Aries', 'Kamis Kliwon', 'L', 'S1', 'Teknik Mesin', NULL, 'KATHOLIK', 'Krijing Kidul, Jatisarono, Nanggulan, Kulon Progo', 'Krijing Kidul, Jatisarono, Nanggulan, Kulon Progo', '0821 1447 3663', '', '3404 0325 0382 0004', NULL, '', '', '2023-03-21', '2024-09-21', NULL, 12, 0, 0, 'purwakaareas@yahoo.com', 'SUYATI', '', 'lajang', '', '', 'aktif'),
(132, '0132', 'ISTIANA', 4, 9, 'kontrak', 'Sleman', '1994-01-14', 'Anjing', 'Capricorn', 'Jumat Pon', 'P', 'S1', 'Akuntansi', 'O', 'ISLAM', 'Prayan Denokan RT/RW 006/026 Sendangsari, Minggir, Sleman', 'Prayan Denokan RT/RW 006/026 Sendangsari, Minggir, Sleman', '0878 1282 5384', '', '3404 1354 0194 0001', NULL, NULL, NULL, '2023-03-27', '2024-10-10', NULL, 12, 1, 0, 'istiana18@gmail.com', 'SITI SUHARTINAH', '', 'menikah', 'GANA NURPUTRA P.', 'GHIBRAN P. R', 'aktif'),
(133, '0133', 'DIAN NURUL KHIKMAH', 5, 16, 'kontrak', 'Cirebon', '1989-11-03', 'Ular', 'Scorpio', 'Jumat Kliwon', 'P', 'S1', 'Ekonomi Syariah', NULL, 'ISLAM', 'Jl. Raya Sapugarut RT 04 / RW 02 Buaran Pekalongan', 'Jl. Raya Sapugarut RT 04 / RW 02 Buaran Pekalongan', '0857 4180 3881', '3326 1421 0416 0010', '3326 1243 1190 0001', NULL, '', '', '2023-05-02', '2024-11-03', NULL, 6, 3, 0, 'dian.imutsz@gmail.com', ' ', '', '', '', '', 'aktif'),
(134, '0134', 'LARASATI AZIZAH', 5, 11, 'kontrak', 'Yogyakarta', '1998-08-06', 'Macan', 'Leo', 'Kamis Pon', 'P', 'S1', 'Sarjana Pendidikan', 'O', 'ISLAM', 'Gesikan 02, Sidomoyo, Godean, Sleman, Yogyakarta', 'Gesikan 02, Sidomoyo, Godean, Sleman, Yogyakarta', '0895 0645 4335', '3471 0504 0999 0111', '3471 0546 0898 0001', NULL, '', '', '2023-06-02', '2024-12-04', NULL, 12, 5, 0, 'lrstazizah@gmail.com', 'KATIMAH', '', 'lajang', '', '', 'aktif'),
(135, '0135', 'HENDRI MUSTOFA', 4, 16, 'kontrak', 'Malang', '1983-08-06', 'Babi', 'Leo', 'Sabtu Wage', 'L', 'S1', 'Manajemen', NULL, 'ISLAM', 'Jl. Teluk Bayur RT 03 RW 08 Jawa Timur ', 'Jl. Teluk Bayur RT 03 RW 08 Jawa Timur ', '0812 4965 5984', '', '3507 3206 0883 0002', NULL, NULL, NULL, '2023-06-26', '2024-12-27', NULL, 12, 6, 0, 'hendrimustofa58@gmail.com', NULL, '', '', '', '', 'aktif'),
(136, '0136', 'SONY ANDRIAN', 4, 16, 'kontrak', 'Kediri', '1988-01-07', 'Naga', 'Capricorn', 'Kamis Wage', 'L', 'SMAN', NULL, 'A', 'ISLAM', 'Bangsri 1 RT/RW 01/01, Bangsri, Nglegok, Kab. Blitar, Jawa Timur', 'Bangsri 1 RT/RW 01/01, Bangsri, Nglegok, Kab. Blitar, Jawa Timur', '0822 4404 1019', '', '3571 0207 0188 0006', NULL, NULL, NULL, '2023-07-03', '2024-10-16', NULL, 3, 3, 0, 'sony_andrian1988@yahoo.com', NULL, '', 'menikah', '', '', 'aktif'),
(137, '0137', 'RAGIL SAFITRI', 5, 16, 'kontrak', 'Jombang', '1999-05-02', 'Kelinci', 'Taurus', 'Minggu Pahing', 'P', 'SMK', NULL, NULL, 'ISLAM', 'Dsn. Caruk Kulon RT 001 RW 001 Ds Jabon, Kec. Jombang, Kab. Jombang', 'Dsn. Caruk Kulon RT 001 RW 001 Ds Jabon, Kec. Jombang, Kab. Jombang', '0858 1265 3329', '', '3517 0942 0599 0001', NULL, NULL, NULL, '2023-07-18', '2024-10-20', NULL, 6, 3, 0, '', NULL, '', '', '', '', 'aktif'),
(138, '0138', 'WAHYUNI', 5, 16, 'kontrak', 'Surakarta', '1990-11-16', 'Kuda', 'Scorpio', 'Jumat Pon', 'P', 'SMK', NULL, NULL, 'ISLAM', 'Ngebrak RT 002 RW 011 Getan, Baki, Sukoharjo', 'Ngebrak RT 002 RW 011 Getan, Baki, Sukoharjo', '0882 2010 6417', '3311 1025 0116 0003', '3372 0356 1190 0001', NULL, NULL, NULL, '2023-07-19', '2025-01-20', NULL, 6, 6, 0, '', 'SRI SUDARMI', '', 'menikah', 'JANU ANDRIYANTO ADIWIBOWO', 'MUHAMMAD SATRIA (27/01/2015)', 'aktif'),
(139, '0139', 'PATRIA WIJAYANTO', 5, 3, 'kontrak', 'Yogyakarta', '1993-08-14', 'Ayam', 'Leo', 'Sabtu Kliwon', 'L', 'S1', 'Teknik Mesin', 'A', 'ISLAM', 'Ngadiwinaton NG 1/925 RT 51 RW 11 Ngampilan Yogyakarta', 'Ngadiwinaton NG 1/925 RT 51 RW 11 Ngampilan Yogyakarta', '0856 9417 8670', '', '3471 0614 0893 0001', NULL, NULL, NULL, '2023-07-21', '2024-08-20', NULL, 1, 1, 0, 'patriawijayanto@gmail.com', 'NGADIEM', '', 'menikah', 'RISTITUTA NUR H.', 'HAMSURI ALLENA P. (03/12/2012)', 'aktif'),
(140, '0140', 'ADE YOSGI EMARA', 5, 16, 'kontrak', 'Sleman', '1996-09-05', 'Tikus', 'Virgo', 'Kamis Pon', 'L', 'SMK', 'Otomotif TKR', 'O', 'ISLAM', 'Jl. Tengiri 9 No 2 Minomartani, Ngaglik, Sleman, Yogyakarta', 'Jl. Tengiri 9 No 2 Minomartani, Ngaglik, Sleman, Yogyakarta', '0882 3284 8297', '3404 1223 0920 0005', '3404 1205 0996 0001', NULL, NULL, NULL, '2023-08-02', '2024-11-02', NULL, 6, 0, 0, 'adeyosgi.ay@gmail.com', 'ERWIN NURYANI', '', 'menikah', 'HASNA AMALIA', 'QUEENARA ADENA SHEINAFA (25/04/2019), EL ZAYNI (05', 'aktif'),
(141, '0141', 'RITA DEA NATALIA', 5, 16, 'kontrak', 'Wonogiri', '2000-10-07', 'Naga', 'Libra', 'Sabtu Legi', 'P', 'SMK', NULL, NULL, 'ISLAM', 'Beji RT 002 RW 012 Pasekan, Eromoko, Wonogiri', 'Jl. Raya Seturan, Jln. Amarta No 1 Sleman', '0822 1191 3269', '', '331 2084 7000 0001', NULL, NULL, NULL, '2023-08-04', '2025-01-03', NULL, 3, 3, 0, 'ritadn07@gmail.com', NULL, '', '', '', '', 'aktif'),
(142, '0142', 'FARISA NURIN SABRINA', 5, 10, 'kontrak', 'Sleman', '1997-06-10', 'Kerbau', 'Gemini', 'Selasa Legi', 'P', 'S1', 'Akuntansi', 'B', 'ISLAM', 'Ledoksari RT 04 RW 07 Bokoharjo, Prambanan, Sleman ', 'Klurak Baru RT 001 RW 004 Bokoharjo, Prambanan, Sleman', '0831 6244 5355', '', '3404 0950 0697 0003', NULL, '', '', '2023-08-07', '2025-02-08', NULL, 12, 0, 0, 'farisanurinsabrina@gmail.com', 'AMIROTUN SHOLIKHAH', '', 'lajang', '', '', 'aktif'),
(143, '0143', 'PRAMUDYA AMAR WICAKSONO', 5, 16, 'kontrak', 'Jombang', '2000-03-13', 'Naga', 'Pisces', 'Senin Pon', 'L', 'SMA', NULL, NULL, 'ISLAM', 'Dsn Ngrandu RT 006 RW 001 Cangkringrandu, Perak, Jombang, Jawa Timur', 'Dsn Ngrandu RT 006 RW 001 Cangkringrandu, Perak, Jombang, Jawa Timur', '0856 9692 2271', '3517 0125 0521 0004', '3517 0113 0300 0004', NULL, NULL, NULL, '2023-08-21', '2024-08-21', NULL, 6, 0, 0, '', NULL, '', '', '', '', 'aktif'),
(144, '0144', 'ANA MIFTAHUL JANNAH', 5, 16, 'kontrak', 'Banyuwangi', '2003-05-14', 'Kambing', 'Taurus', 'Rabu Kliwon', 'P', 'SMK', 'Akuntansi', NULL, 'ISLAM', 'Dsn. Sumberkepuh RT 06 RW 01 Desa Kedungwungu, Kec. Tegaldlimo, Banyuwangi', 'Dsn. Sumberkepuh RT 06 RW 01 Desa Kedungwungu, Kec. Tegaldlimo, Banyuwangi', '0821 4143 4402', '3510 0407 1005 5152', '3510 0454 0503 0002', NULL, NULL, NULL, '2023-08-25', '2024-08-08', NULL, 6, 0, 0, '', NULL, '', '', '', '', 'aktif'),
(145, '0145', 'CICILIA SUSANTI', 5, 16, 'kontrak', 'Kulon Progo', '2000-11-30', 'Naga', 'Sagittarius', 'Kamis Kliwon', 'P', 'SMK', 'Akuntansi', 'O', 'ISLAM', 'Kweni RT 008 RW 000 Panggungharjo, Sewon, Bantul', 'Kweni RT 008 RW 000 Panggungharjo, Sewon, Bantul', '0899 9382 390', '3402 1518 1121 0007', '3401 1170 1100 0001', NULL, NULL, NULL, '2023-08-27', '2024-08-28', NULL, 6, 0, 0, 'cicilia.susanti3011@gmail.com', 'SUPARTINI', '', 'menikah', 'FAJAR PUTRO PRABOWO', 'MUHAMMAD ALIF ALFARIZKY (01/11/2021)', 'aktif'),
(146, '0146', 'AANS CHANDRA WIJAYA', 4, 16, 'kontrak', 'Yogyakarta', '1988-11-26', 'Naga', 'Sagittarius', 'Sabtu Pon', 'L', 'D4', 'Management Keuangan', NULL, 'ISLAM', 'Jalan Manunggal Pratama RT 009 RW 012 Cibubur, Ciracas', 'Semaki Kulon UH I/396 RT 34 RW 10 Umbulharjo, Yogyakarta, 55166', '0897 7870 519', '', '3471 1326 1188 0003', NULL, NULL, NULL, '2023-09-08', '2024-09-09', NULL, 6, 0, 0, 'aanz.chandra1126@gmail.com', NULL, '', '', '', '', 'aktif'),
(147, '0147', 'WAHYU ASTUTIK', 5, 16, 'kontrak', 'Kediri', '1992-09-19', 'Monyet', 'Virgo', 'Sabtu Legi', 'P', 'SMK', 'Keuangan', NULL, 'ISLAM', 'Dsn Kecik RT 029 RW 006 Keling, Kepung, Kediri', 'Dsn Kecik RT 029 RW 006 Keling, Kepung, Kediri', '0877 9657 8571', '', '3506 1859 0992 0001', NULL, NULL, NULL, '2023-09-11', '2024-09-02', NULL, 6, 0, 0, '', NULL, '', 'menikah', '', '', 'aktif'),
(148, '0148', 'FICKY OLIVIA', 5, 16, 'kontrak', 'Pekalongan', '1991-11-23', 'Kambing', 'Sagittarius', 'Sabtu Kliwon', 'P', 'SMK', 'Bisnis Dan Manajemen', NULL, 'ISLAM', 'Dsn Wonosari RT 001 RW 001 Kec. Siwalan, Kab. Pekalongan, Jawa Barat', 'Dsn Wonosari RT 001 RW 001 Kec. Siwalan, Kab. Pekalongan, Jawa Barat', '0857 7172 0865', '', '3326 1763 1191 0001', NULL, NULL, NULL, '2023-09-21', '2024-09-02', NULL, 6, 0, 0, '', NULL, '', '', '', '', 'aktif'),
(149, '0149', 'YOHANIS HARHARI', 5, 16, 'kontrak', 'Temanggung', '1980-09-09', 'Monyet', 'Virgo', 'Selasa Pon', 'L', 'SMK', 'Administrasi Perkantoran', 'B', 'ISLAM', 'Kuwon Kidul RT 005 RW 014, Pacarejo, Semanu, Gunung Kidul', 'Jl. Retno Dumilah No. 4 Rejowinangun, Kotagede, Yogyakarta', '0822 2012 7933', '', '3323 0609 0980 0006', NULL, NULL, NULL, '2023-09-26', '2024-09-26', NULL, 6, 0, 0, 'yohanisharhari@gmail.com', 'MARFUAH (ALM)', '', 'menikah', 'YUNIATI', 'YUNAN F. (17/02/2004)', 'aktif'),
(150, '0150', 'PUTRI SALSABILA ASYA', 5, 16, 'kontrak', 'Metro', '2001-04-08', 'Ular', 'Aries', 'Minggu Wage', 'P', 'SMK', 'Administrasi Perkantoran', 'O', 'ISLAM', 'Jl. KH Dewantara RT 022 RW 010 Kel. Iring Mulyo, Kec. Metro Timur, Kota Metro, Lampung', 'Jl. KH Dewantara RT 022 RW 010 Kel. Iring Mulyo, Kec. Metro Timur, Kota Metro, Lampung', '0882 8784 7022', '1872 0425 0108 0002', '1872 0448 0401 0002', NULL, NULL, NULL, '2023-10-02', '2024-10-04', NULL, 6, 0, 0, '', NULL, '', 'lajang', '', '', 'aktif'),
(151, '0151', 'MERIANA', 5, 16, 'kontrak', 'Pamekasan', '1995-01-19', 'Babi', 'Capricorn', 'Kamis Pon', 'P', 'SMK', 'Akuntansi', NULL, 'ISLAM', 'Dsn Barat RT 001 RW 004 Kel. Laden, Kec. Pamekasan, Kab. Pamekasan, Jawa Timur', 'Dsn Barat RT 001 RW 004 Kel. Laden, Kec. Pamekasan, Kab. Pamekasan, Jawa Timur', '0813 5793 8759', '3528 0416 0819 0001', '3528 0459 0195 0001', NULL, NULL, NULL, '2023-10-02', '2025-01-03', NULL, 6, 0, 0, '', NULL, '', 'cerai hidup', '', 'MOH. MAULIDAN AZHIM SIDDIK ARRAFIH (13/12/2016)', 'aktif'),
(152, '0152', 'IHKSAN DWI ANANTA', 5, 6, 'kontrak', 'Bantul', '2004-10-31', 'Monyet', 'Scorpio', 'Minggu Legi', 'L', 'SMK', 'Pengelasan', 'AB', 'ISLAM', 'Ngentak, Seloharjo, Pundong, Bantul, Yogyakarta', 'Ngentak, Seloharjo, Pundong, Bantul, Yogyakarta', '0812 2640 0732', '3402 0411 0719 0001', '3402 0431 1004 0002', NULL, NULL, NULL, '2023-10-09', '2025-07-10', NULL, 12, 0, 0, 'cupuenjim@gmail.com', 'SUMARSIH', '', 'lajang', '', '', 'aktif'),
(153, '0153', 'PUTRI PUSPIKASARI', 5, 16, 'kontrak', 'Mojokerto', '2000-08-07', 'Naga', 'Leo', 'Senin Kliwon', 'P', 'S1', 'Gizi', 'O', 'ISLAM', 'Dsn. Blijo RT 003 RW 001 Sebani, Tarik, Sidoarjo, Jawa Timur', 'Dsn. Blijo RT 003 RW 001 Sebani, Tarik, Sidoarjo, Jawa Timur', '0816 1115 164', '3515 0126 0109 1488', '3515 0147 0800 0002', NULL, NULL, NULL, '2023-10-16', '2025-07-17', NULL, 12, 0, 0, 'putripuspika3@gmail.com', 'TRI JUANIK', '', 'lajang', '', '', 'aktif'),
(154, '0154', 'TITIS IRMA OCTALINA', 5, 16, 'kontrak', 'Pekalongan', '1991-10-28', 'Kambing', 'Scorpio', 'Senin Wage', 'P', 'SMA', NULL, 'A', 'ISLAM', 'Kelurahan Panjang Wetan GG. 6 No. 43 A RT 003 RW 005 Panjang Wetan, Pekalongan Utara', 'Kelurahan Panjang Wetan GG. 6 No. 43 A RT 003 RW 005 Panjang Wetan, Pekalongan Utara', '0819 1586 7401', '3375 0327 0820 0001', '3375 0368 1091 0003', NULL, NULL, NULL, '2023-10-16', '2024-10-18', NULL, 6, 0, 0, '', 'ERMINAH', '', 'menikah', 'SUWITO', 'ATHA\' RAFKHA YAQHZANA (10/06/2012), ACQUILA EMBUN ', 'aktif'),
(155, '0155', 'SITI KHUMAIROH', 5, 16, 'kontrak', 'Pasuruan', '1996-11-26', 'Tikus', 'Sagittarius', 'Selasa Kliwon', 'P', 'SMK', 'Akuntansi', NULL, 'ISLAM', 'Warungdowo Tengah RT 003 RW 007 Warungdowo, Pohjentrek, Pasuruan, Jawa Timur', 'Warungdowo Tengah RT 003 RW 007 Warungdowo, Pohjentrek, Pasuruan, Jawa Timur', '089 8338 2216', '3514 1704 0618 0003', '3514 1666 1196 0005', NULL, NULL, NULL, '2023-10-17', '2025-01-17', NULL, 6, 6, 0, '', 'HALIMAH', '', 'menikah', 'IMAM RUSDIANTO', 'VIONA ZANITHA IZZARA (02/11/2018)', 'aktif'),
(156, '0156', 'DIYANA FATIMATUZ ZAHRO', 5, 16, 'kontrak', 'Tuban', '2005-07-21', 'Ayam', 'Cancer', 'Kamis Wage', 'P', 'SMK', 'Kimia Industri', NULL, 'ISLAM', 'Dsn. Krajan RT 002 RW 002, Kel. Boto, Kec. Semanding, Kab. Tuban', 'Dsn. Krajan RT 002 RW 002, Kel. Boto, Kec. Semanding, Kab. Tuban', '0812 1672 6036', '', '3523 1561 0705 0001', NULL, NULL, NULL, '2023-10-17', '2024-10-19', NULL, 3, 0, 0, 'diyanafatimatuzz@gmail.com', NULL, '', '', '', '', 'aktif'),
(157, '0157', 'DAFID TRI PRADITIA', 5, 4, 'kontrak', 'Bantul', '2004-10-28', 'Monyet', 'Scorpio', 'Kamis Pon', 'L', 'SMK', 'Kimia Industri', 'O', 'ISLAM', 'Kretek Lor RT 03 Jambidan, Banguntapan, Bantul, Yogyakarta', 'Kretek Lor RT 03 Jambidan, Banguntapan, Bantul, Yogyakarta', '0851 5978 8869', '', '3402 1228 1004 0001', NULL, NULL, NULL, '2023-10-20', '2025-07-28', NULL, 12, 0, 0, 'dafidtp@gmail.com', 'NGADIYEM', '', 'lajang', '', '', 'aktif'),
(158, '0158', 'CHOIRUDDIN', 5, 7, 'kontrak', 'Sleman', '1998-04-27', 'Macan', 'Taurus', 'Senin Pahing', 'L', 'SMK', 'Otomotif', 'O', 'ISLAM', 'Polengan, Madurejo, Prambanan, Sleman, Yogyakarta', 'Polengan, Madurejo, Prambanan, Sleman, Yogyakarta', '0813 9399 5144', '3404 0919 0208 0024', '3404 0927 0498 0002', NULL, NULL, NULL, '2023-10-23', '2025-01-24', NULL, 6, 0, 0, '', 'MARFUAH', '', 'menikah', '', '', 'aktif'),
(159, '0159', 'INDRAYANTO', 5, 2, 'kontrak', 'Sleman', '1995-01-28', 'Babi', 'Aquarius', 'Sabtu Pahing', 'L', 'SMK', 'Otomotif', 'O', 'ISLAM', 'Krajan XV RT 03 RW 34, Sidoluhur, Godean, Sleman, Yogyakarta', 'Krajan XV RT 03 RW 34, Sidoluhur, Godean, Sleman, Yogyakarta', '0851 5515 7535', '', '3404 0228 0195 0001', NULL, NULL, NULL, '2023-10-27', '2024-08-29', NULL, 6, 0, 0, '', 'HARYANTI', '', '', '', '', 'aktif'),
(160, '0160', 'MUHAMMAD AZIIS AZDZAKY', 5, 15, 'kontrak', 'Magelang', '1997-01-26', 'Kerbau', 'Aquarius', 'Minggu Legi', 'L', 'S1', 'Teknik Kimia', 'AB', 'ISLAM', 'Perum Bumi Neikarta No 69 Pranan, Danurejo, Mertoyudan, Magelang', 'Perum Bumi Neikarta No 69 Pranan, Danurejo, Mertoyudan, Magelang', '0857 9996 4180', '', '3371 0126 0197 0004', NULL, NULL, NULL, '2023-10-30', '2024-10-30', NULL, 6, 0, 0, 'az.azdzaky7@gmail.com', NULL, '', 'lajang', '', '', 'aktif'),
(161, '0161', 'ALDY ALFIYANTO', 5, 4, 'kontrak', 'Bantul', '1997-10-14', 'Kerbau', 'Libra', 'Selasa Pahing', 'L', 'S1', 'Teknik Kimia', 'O', 'ISLAM', 'Banyakan 1, Sitimulyo, Piyungan, Bantul, Yogyakarta', 'Banyakan 1, Sitimulyo, Piyungan, Bantul, Yogyakarta', '0896 8969 7059', '', '3402 1414 1097 0001', NULL, NULL, NULL, '2023-10-30', '2024-09-03', NULL, 3, 0, 0, 'aldyalfianto1@gmail.com', 'SARJIMAH', '', 'lajang', '', '', 'aktif'),
(162, '0162', 'ALDI WAHYU RAMADHAN', 5, 4, 'kontrak', 'Sleman', '1999-11-29', 'Kelinci', 'Sagittarius', 'Senin Pon', 'L', 'S1', 'Peternakan', 'B', 'ISLAM', 'Perum Asana Mutiara 3 BI, Ngentak, Pelem, Banguntapan, Bantul, Yogyakarta', 'Perum Asana Mutiara 3 BI, Ngentak, Pelem, Banguntapan, Bantul, Yogyakarta', '0858 7994 2855', '', '3471 1229 1199 0003', NULL, NULL, NULL, '2023-10-30', '2024-09-02', NULL, 6, 0, 0, 'aldiwahyu.r@gmail.com', 'CATURDEWI S.', '', 'lajang', '', '', 'aktif'),
(163, '0163', 'BUDI SETYAWAN', 5, 2, 'kontrak', 'Klaten', '1988-01-22', 'Naga', 'Aquarius', 'Jumat Wage', 'L', 'SMK', 'Otomotif', NULL, 'ISLAM', 'Tampingan, Jimbung, Kalikotes, Klaten', 'Tampingan, Jimbung, Kalikotes, Klaten', '0858 2669 1844', '3310 2330 0604 0561', '3310 2322 0188 0002', NULL, NULL, NULL, '2023-11-01', '2024-09-03', NULL, 3, 0, 0, 'budisetyawan261@gmail.com', 'SRIYATUN', '', '', '', '', 'aktif'),
(164, '0164', 'MUHAMMAD IQBAL SETIAWAN', 5, 2, 'kontrak', 'Klaten', '2002-06-06', 'Kuda', 'Gemini', 'Kamis Pon', 'L', 'SMK', 'Teknik Pemesinan', 'AB', 'ISLAM', 'Cabean RT 15 RW 07 Bakung, Jogonalan, Klaten', 'Cabean RT 15 RW 07 Bakung, Jogonalan, Klaten', '0857 2790 5117', '', '3310 0806 0602 0003', NULL, NULL, NULL, '2023-11-02', '2024-09-06', NULL, 3, 0, 0, 'setiawaniqbal108@gmail.com', 'SULASTRI', '', 'lajang', '', '', 'aktif'),
(165, '0165', 'WAHYU DWI SAPUTRO', 5, 2, 'kontrak', 'Gunungkidul', '2004-04-09', 'Monyet', 'Aries', 'Jumat Legi', 'L', 'SMK', 'Teknik Sepeda Motor', 'O', 'ISLAM', 'Gedali RT 011 RW 003 Beji, Patuk, Gunung Kidul', 'Gedali RT 011 RW 003 Beji, Patuk, Gunung Kidul', '0856 4083 7908', '', '3403 0409 0404 0003', NULL, '', '', '2023-11-02', '2024-11-08', NULL, 3, 3, 0, 'wahyuputra0904@gmail.com', 'SRI ISWANDARI', '', 'lajang', '', '', 'aktif'),
(166, '0166', 'VALENTINO SIAHAAN', 5, 7, 'kontrak', 'Siantar', '1995-01-19', 'Babi', 'Capricorn', 'Kamis Pon', 'L', 'SMA', 'IPS', NULL, 'KRISTEN', 'Jalan Raya Alamanda, Desa Tapung, Kecamatan Kampar RT 009 RW 004', 'Jalan Merpati, Condongcatur, Sleman, Yogyakarta', '0838 7845 7033', '', '1401 1019 0195 0004', NULL, NULL, NULL, '2023-11-03', '2024-09-05', NULL, 6, 0, 0, 'anggireyiand11@gmail.com', 'RESTA BR SIREGAR', '', 'lajang', '', '', 'aktif'),
(167, '0167', 'ALEXANDER HERMAWAN', 5, 2, 'kontrak', 'Magelang', '1995-11-11', 'Babi', 'Scorpio', 'Sabtu Wage', 'L', 'SMK', 'Kendaraan Ringan', 'O', 'KATHOLIK', 'Dsn. Berut RT 001 RW 012 Sumber, Dukun, Magelang', 'Dsn. Berut RT 001 RW 012 Sumber, Dukun, Magelang', '0857 7787 9072', '3308 0603 0710 1983', '3308 0611 1195 0001', NULL, NULL, NULL, '2023-11-03', '2024-09-02', NULL, 6, 0, 0, 'alexanderhermawan11@gmail.com', 'MARCELINA YUNIARSIH', '', 'lajang', '', '', 'aktif'),
(168, '0168', 'EKO YULIANTO', 5, 2, 'kontrak', 'Klaten', '1993-07-08', 'Ayam', 'Cancer', 'Kamis Pon', 'L', 'SMK', 'Otomotif', 'O', 'ISLAM', 'Bakung RT 18 RW 05 Jogonalan, Klaten', 'Bakung, Jogonalan, Klaten', '0899 7487 278', '3310 0808 0807 0015', '3310 0808 0793 0002', NULL, '', '', '2023-11-03', '2024-09-06', NULL, 3, 3, 0, 'monsterjack36@gmail.com', 'SANIYEM', '', 'lajang', '', '', 'aktif'),
(169, '0169', 'KHUSNATUL ELFIYATI YOURS NEATA', 5, 16, 'kontrak', 'Tegal', '1993-02-07', 'Ayam', 'Aquarius', 'Minggu Pahing', 'P', 'SMA', NULL, NULL, 'ISLAM', 'Tanjungharja RT 002 RW 005 Tanjungharja, Kramat', 'Tanjungharja RT 002 RW 005 Tanjungharja, Kramat', '0822 2605 2345', '', '3328 1547 0293 0004', NULL, NULL, NULL, '2023-11-06', '2024-11-08', NULL, 6, 0, 0, 'yoursneata@gmail.com', NULL, '', 'menikah', '', '', 'aktif'),
(170, '0170', 'SEPTIAN DWI RULIANA', 5, 16, 'kontrak', 'Buton', '1998-09-01', 'Macan', 'Virgo', 'Selasa Wage', 'P', '', NULL, 'O', 'ISLAM', 'Dsn. Wrajan RT 003 RW 004 Wonotirto, Wonotirto', 'Dsn. Wrajan RT 003 RW 004 Wonotirto, Wonotirto', '0812 3096 2162', '', '9202 1241 0998 0002', NULL, NULL, NULL, '2023-11-06', '2024-08-08', NULL, 3, 0, 0, '', NULL, '', 'lajang', '', '', 'aktif'),
(171, '0171', 'RISKY AGUNG SUCIPTO', 5, 4, 'kontrak', 'Grobogan', '1998-04-28', 'Macan', 'Taurus', 'Selasa Pon', 'L', 'SMK', 'Teknik Mekatronika', NULL, 'ISLAM', 'Jl. Patran No 1 RT 1 / RW 1 Patran, Banyuraden, Kec. Gamping, Kab. Sleman', 'Kp.Gelam Jaya RT 06 RW 03 Kel. Gelamjaya, Kec. Pasar Kemis, Tangerang', '0895 3216 63413', '3671 0823 0512 0064', '3671 0828 0498 0007', NULL, NULL, NULL, '2023-11-10', '2024-08-11', '2024-07-23', 6, 0, 0, 'agungsucipto313@gmail.com', 'WATI', '', 'lajang', '', '', 'tidak'),
(172, '0172', 'YUSUF PUSPITA', 5, 4, 'kontrak', 'Magelang', '1998-08-02', 'Macan', 'Leo', 'Minggu Wage', 'L', 'MAN', 'IPS', 'O', 'ISLAM', 'Dawung RT 02 RW 07 Dawung, Tegalrejo, Magelang', 'Dawung RT 02 RW 07 Dawung, Tegalrejo, Magelang', '0857 1363 4161', '3308 1919 0815 0003', '3308 1902 0898 0003', NULL, NULL, NULL, '2023-11-10', '2024-09-15', NULL, 6, 0, 0, 'yusufpuspita98@gmail.com', 'ASLAMIYAH', '', 'lajang', '', '', 'aktif'),
(173, '0173', 'ARIF NUR ROHMAN', 5, 2, 'kontrak', 'Sleman', '1996-12-23', 'Tikus', 'Capricorn', 'Senin Pahing', 'L', 'SMK', 'Otomotif', 'O', 'ISLAM', 'Plembon RT 03 RW 012 Sendangsari, Minggir, Sleman', 'Plembon RT 03 RW 012 Sendangsari, Minggir, Sleman', '0878 8284 3964', '', '3404 0423 1296 0001', NULL, NULL, NULL, '2023-11-10', '2024-09-15', NULL, 6, 0, 0, 'arifnurrohman48@gmail.com', NULL, '', 'menikah', '', '', 'aktif'),
(174, '0174', 'REYHAN MUKTI ADITYA', 5, 4, 'kontrak', 'Sleman', '2004-06-16', 'Monyet', 'Gemini', 'Rabu Wage', 'L', 'SMK', 'Teknik Otomasi Industri', 'O', 'ISLAM', 'Rejosari Meguwo RT 08 RW 48 Maguwoharjo, Depok, Sleman', 'Rejosari Meguwo RT 08 RW 48 Maguwoharjo, Depok, Sleman', '0838 7745 3772', '3404 0713 0807 0049', '3404 0716 0604 0001', NULL, NULL, NULL, '2023-11-13', '2024-08-14', NULL, 6, 0, 0, 'reyhanmuktiaditya@gmail.com', 'SITI NGAISAH', '', 'lajang', '', '', 'aktif'),
(175, '0175', 'SOFIRDA SASKIA FARDIANSYAH', 5, 16, 'kontrak', 'Pamekasan', '1998-04-09', 'Macan', 'Aries', 'Kamis Wage', 'P', 'SMA', NULL, NULL, 'ISLAM', 'Dsn. Tengah Mangar, Tlanakan, Pamekasan', 'Dsn. Tengah Mangar, Tlanakan, Pamekasan', '0819 3977 5533', '', '3528 0449 0498 0001', NULL, NULL, NULL, '2023-11-13', '2024-11-08', NULL, 6, 0, 0, 'sofirdasf@gmail.com', NULL, '', 'menikah', '', '', 'aktif'),
(176, '0176', 'BERTY SATYA GRAHA', 5, 2, 'kontrak', 'Prabumulih', '1985-09-03', 'Kerbau', 'Virgo', 'Selasa Pon', 'L', 'SMK', 'Otomotif', 'A', 'ISLAM', 'Jalan Dahlia No 21 Taman Cimanggu, Bogor', 'Jalan Mondoliko UH 2 Mujamuju, Umbulharjo', '0899 3918 877', '3271 0620 0509 0020', '3271 0603 0985 0008', NULL, NULL, NULL, '2023-11-14', '2024-09-16', NULL, 6, 0, 0, 'rocketrokersbear@gmail.com', 'DWI YULIATI', '', 'lajang', '', '', 'aktif'),
(177, '0177', 'TEGAR RAGIL PAMUNGKAS', 5, 2, 'kontrak', 'Gunungkidul', '2002-11-04', 'Kuda', 'Scorpio', 'Senin Wage', 'L', 'SMK', 'Kendaraan Ringan', NULL, 'ISLAM', 'Asemlulang, Sidorejo, Ponjong, Gunung Kidul, DIY', 'Tlukan Sambilegi Kidul RT 008 RW 058, Maguwoharjo, Depok, Sleman, DIY', '0812 8502 5002', '', '3403 1009 1102 0003', NULL, NULL, NULL, '2023-11-20', '2024-09-20', NULL, 3, 0, 0, 'Tegarragil23@gmail.com', 'NASIRAH', '', 'lajang', '', '', 'aktif'),
(178, '0178', 'ABD ROHIM', 5, 16, 'kontrak', 'Sampang', '1989-11-22', 'Ular', 'Scorpio', 'Rabu Wage', 'L', 'MA', 'IPS', 'B+', 'ISLAM', 'Dsn. Marengit Timur, Bira Timur, Sokobanah, Sampang, Madura', 'Benyo, Sendangsari, Pajangan, Bantul', '0882 2153 1089', '3527 1116 0312 0098', '3527 1122 1189 0002', NULL, NULL, NULL, '2023-11-20', '2024-08-21', NULL, 12, 0, 0, 'safuhmad678@gmail.com', 'MARBIYA', '', 'menikah', 'OKTA NUR KH.', '', 'aktif'),
(179, '0179', 'KURNIAWAN FEBRIYANTO', 5, 2, 'kontrak', 'Klaten', '2000-02-21', 'Naga', 'Pisces', 'Senin Pahing', 'L', 'SMK', 'Otomotif', NULL, 'ISLAM', 'Nengahan RT 24 RW 12 Somokaten, Karangnongko, Klaten', 'Nengahan RT 24 RW 12 Somokaten, Karangnongko, Klaten', '0856 9562 0895', '3310 1005 0404 1060', '3310 1061 0200 0001', NULL, NULL, NULL, '2023-11-22', '2024-09-25', NULL, 3, 0, 0, 'kurniawanfebriyant@gmail.com', 'RUSTAMINAH', '', 'lajang', '', '', 'aktif'),
(180, '0180', 'RIDWAN YULI NOVIANTO', 5, 2, 'kontrak', 'Bantul', '1999-11-27', 'Kelinci', 'Sagittarius', 'Sabtu Legi', 'L', 'SMK', 'Teknik Pemesinan', 'O', 'ISLAM', 'Bandut Lor RT 34 Argorejo, Sedayu, Bantul', 'Bandut Lor RT 34 Argorejo, Sedayu, Bantul', '0821 3398 4055', '', '3402 1727 1199 0003', NULL, NULL, NULL, '2023-11-27', '2024-09-27', NULL, 6, 0, 0, 'ridwanyuli99@gmail.com', NULL, '', 'lajang', '', '', 'aktif'),
(181, '0181', 'MEYLIANA CHRISMONITA RATRI AMBARWATI', 5, 16, 'kontrak', 'Sleman', '1999-05-13', 'Kelinci', 'Taurus', 'Kamis Pon', 'P', 'S1', 'Kimia', NULL, 'ISLAM', 'Ngaglik X RT 001 RW 026 Sumbersari, Moyudan, Sleman, DIY 55563', 'Ngaglik X RT 001 RW 026 Sumbersari, Moyudan, Sleman, DIY 55563', '0857 1285 6451', '', '3404 0353 0599 0003', NULL, NULL, NULL, '2023-11-27', '2024-08-28', NULL, 6, 0, 0, 'chrismonitameyliana@gmail.com', NULL, '', '', '', '', 'aktif'),
(182, '0182', 'HALIMATUS SADIYAH', 5, 16, 'kontrak', 'Lumajang', '1995-04-14', 'Babi', 'Aries', 'Jumat Pon', 'P', 'SMK', NULL, NULL, 'ISLAM', 'Jalan Argopuro Gg. H. Rohim RT 004 RW 020 Citrodiwangsan, Lumajang', 'Jalan Argopuro Gg. H. Rohim RT 004 RW 020 Citrodiwangsan, Lumajang', '0852 6486 4177', '', '3508 1054 0495 0001', NULL, NULL, NULL, '2023-11-27', '2024-08-28', NULL, 6, 0, 0, '', NULL, '', 'menikah', '', '', 'aktif'),
(183, '0183', 'LUTFYA TSANI MUGITS', 5, 16, 'kontrak', 'Indramayu', '2001-05-27', 'Ular', 'Gemini', 'Minggu Pon', 'P', 'S1', 'Gizi', NULL, 'ISLAM', 'Blok Cilegeh RT 013 RW 005 Temiyang, Kroya', '', '0831 0339 3275', '', '', NULL, NULL, NULL, '2023-11-29', '2024-09-01', '2024-08-05', 6, 0, 0, '', NULL, '', '', '', '', 'tidak'),
(184, '0184', 'HARTANTO', 5, 2, 'kontrak', 'Kulon Progo', '1993-09-19', 'Ayam', 'Virgo', 'Minggu Legi', 'L', 'SMK', 'Otomotif', 'B', 'ISLAM', 'Plugon RT 1/ RW 1 Donomulyo, Nanggulan, Kulon Progo, Yogyakarta 55671', 'Plugon RT 1/ RW 1 Donomulyo, Nanggulan, Kulon Progo, Yogyakarta 55671', '0877 3473 3956', '3401 1014 0116 0000', '3401 1019 0993 0001', NULL, NULL, NULL, '2023-11-30', '2024-09-01', '2024-08-08', 6, 0, 0, 'maztanto0@gmail.com', 'KEMIYEM', '', 'menikah', 'WIDARTI', 'ELVAN NAHRUL HIDAYAT', 'tidak'),
(185, '0185', 'TRI SURYANTO', 5, 7, 'kontrak', 'Gunungkidul', '1992-07-27', 'Monyet', 'Leo', 'Senin Pahing', 'L', 'SMK', 'Teknik Industri', 'B', 'ISLAM', 'Kulwo RT 06 RW 09 Bejiharjo, Karangmojo, Gunung Kidul', '', '0819 0375 5343', '', '3403 1427 0792 0002', NULL, NULL, NULL, '2023-12-01', '2025-01-02', NULL, 6, 0, 0, 'suryanto07.ts@gmail.com', 'PAIKEM', '', 'menikah', 'ANA SETYAWATI', 'CHERYI ALENA S (25/03/2021)', 'aktif'),
(186, '0186', 'WAHYU AGUSTIN', 5, 16, 'kontrak', 'Probolinggo', '2000-08-03', 'Naga', 'Leo', 'Kamis Legi', 'P', 'SMK', 'Multimedia', NULL, 'ISLAM', 'Dusun Kolor RT 007 RW 003, Desa Sindet Anyar, Kec. Besuk, Kab. Probolinggo', 'Dusun Kolor RT 007 RW 003, Desa Sindet Anyar, Kec. Besuk, Kab. Probolinggo', '0821 3904 8533', '', '3513 1343 0800 0003', NULL, NULL, NULL, '2023-12-04', '2024-09-05', NULL, 6, 0, 0, '', NULL, '', '', '', '', 'aktif'),
(187, '0187', 'AHMAD FAJAR', 5, 2, 'kontrak', 'Magelang', '1988-08-15', 'Naga', 'Leo', 'Senin Kliwon', 'L', 'SMK', 'Otomotif', 'AB', 'ISLAM', 'Jampiroso, Karangtalun, Ngluwar, Magelang', 'Jampiroso, Karangtalun, Ngluwar, Magelang', '0878 8777 6427', '3308 0315 0414 0001', '3308 0315 0888 0003', NULL, NULL, NULL, '2023-12-11', '2024-09-12', NULL, 6, 0, 0, 'Ahmadfajaryprs@gmail.com', 'MARYATUN', '', 'menikah', 'TRI HARYANTI', '', 'aktif'),
(188, '0188', 'ZULFIKAR MUGSITH SULTONI', 5, 7, 'kontrak', 'Tuban', '2004-10-10', 'Monyet', 'Libra', 'Minggu Kliwon', 'L', 'SMA', 'IPS', NULL, 'ISLAM', 'Puri Indah Tuban', 'Jalan Abu Bakar, Maguwoharjo', '0895 4143 60188', '', '3523 1610 1004 0003', NULL, NULL, NULL, '2023-12-11', '2024-09-12', NULL, 6, 0, 0, 'fikar.toni@gmail.com', 'ZULHEMA', '', 'lajang', '', '', 'aktif'),
(189, '0189', 'DANI SAPUTRA ', 5, 2, 'kontrak', 'Sumberrejo', '2000-07-16', 'Naga', 'Cancer', 'Minggu Pon', 'L', 'SMK ', 'Teknik Kendaraan', NULL, 'ISLAM', 'Dusun II RT 006 RW 003 Sumber Rejo, Kota Gajah, Lampung Tengah', 'Bugisan RT 003 RW 001, Prambanan, Klaten, Jawa Tengah', '0856 6432 8580', '1802 2320 0505 5990', '1802 2318 1200 0001', NULL, NULL, NULL, '2023-12-11', '2025-03-12', NULL, 12, 0, 0, 'danisaputraaa62@gmail.com', 'JAINAB', '', 'lajang ', '', '', 'aktif'),
(190, '0190', 'SEPTWIN UTAMI SARI', 5, 16, 'kontrak', 'Blora', '1999-09-14', 'Kelinci', 'Virgo', 'Selasa Pahing', 'P', 'SMK', NULL, NULL, 'ISLAM', 'Ds. Kalen RT 01 RW 03, Kec. Kedungtuban, Kab. Blora', 'Ds. Kalen RT 01 RW 03, Kec. Kedungtuban, Kab. Blora', '0838 5489 1209', '', '3316 0454 0999 0001', NULL, NULL, NULL, '2023-12-15', '2024-09-16', NULL, 3, 0, 0, 'septwinutami@gmail.com', NULL, '', '', '', '', 'aktif'),
(191, '0191', 'MIKO WAHYU PRASETYO', 5, 4, 'kontrak', 'Gunungkidul', '2003-05-30', 'Kambing', 'Gemini', 'Jumat Legi', 'L', 'SMK', 'Otomotif', NULL, 'ISLAM', 'Gading VI RT 005 RW 006, Gading, Playen, Gunung Kidul', 'Gading VI RT 005 RW 006, Gading, Playen, Gunung Kidul', '0889 8364 7673', '3403 0309 1107 6583', '3403 0330 0503 0003', NULL, NULL, NULL, '2023-12-18', '2025-01-19', NULL, 6, 0, 0, 'mikowahyuprasetyo@gmail.com', 'MURTINI', '', 'lajang', '', '', 'aktif'),
(192, '0192', 'MUHAMMAD FANDY NUR SALEH', 5, 4, 'kontrak', 'Klaten', '2005-05-03', 'Ayam', 'Taurus', 'Selasa Kliwon', 'L', 'SMK', 'Otomotif', NULL, 'ISLAM', 'Bogo RT 13 RW 08, Tibayan, Jatinom, Klaten', 'Bogo RT 13 RW 08, Tibayan, Jatinom, Klaten', '0821 1448 9250', '3310 2010 1120 0007', '3173 0203 0505 0011', NULL, NULL, NULL, '2023-12-26', '2024-09-27', NULL, 6, 0, 0, 'fandynursaleh@gmail.com', 'SRI SUGIYAH', '', 'lajang', '', '', 'aktif'),
(193, '0193', 'RICHARD VINALDA', 5, 2, 'kontrak', 'Gunungkidul', '2001-10-08', 'Ular', 'Libra', 'Senin Pahing', 'L', 'SMK', 'Otomotif', NULL, 'ISLAM', 'Ploso, Dadapayu, Semanu, Gunung Kidul', 'Sorogenen I', '0895 3207 38866', '3403 0829 0817 0001', '3403 0850 0801 0002', NULL, NULL, NULL, '2023-12-26', '2024-09-28', NULL, 3, 0, 0, 'richardvinalda098@gmail.com', 'AMBARWATI', '', 'lajang', '', '', 'aktif'),
(194, '0194', 'AHMAD GEMBONG PRABOWO', 5, 2, 'kontrak', 'Sleman', '1996-07-30', 'Tikus', 'Leo', 'Selasa Legi', 'L', 'SMK', 'Komputer Jaringan', 'O', 'ISLAM', 'Melikan RT 003 RW 011 Sumberharjo, Prambanan', 'Melikan RT 003 RW 011 Sumberharjo, Prambanan', '0895 0788 4918', '', '3275 0130 0796 0024', NULL, NULL, NULL, '2023-12-26', '2024-09-27', NULL, 6, 0, 0, 'gembongahmad7@gmail.com', 'SRI LESTARI', '', 'lajang', '', '', 'aktif'),
(195, '0195', 'ZAENURI', 5, 2, 'kontrak', 'Sleman', '1993-01-04', 'Ayam', 'Capricorn', 'Senin Pon', 'L', 'SMK', 'Teknik Pemesinan', NULL, 'ISLAM', 'Beran Lor RT 03 RW 21 Tridadi, Sleman, Yogyakarta', 'Kembang RT 04 RW 62 Maguwoharjo, Depok, Sleman, Yogyakarta', '0895 3559 00605', '', '3404 1304 0193 0001', NULL, NULL, NULL, '2023-12-26', '2024-09-27', NULL, 6, 0, 0, 'nurekkganteng@gmail.com', 'SUPARNI', '', 'lajang', '', '', 'aktif'),
(196, '0196', 'WALJANAH ROSEZANA PUTRI HERNA', 5, 14, 'kontrak', 'Wonosobo', '2001-06-11', 'Ular', 'Gemini', 'Senin Pon', 'P', 'D4', 'Broadcasting', NULL, 'ISLAM', 'Tanjung Sari RT 05 RW 01 Kemiriombo, Kaliwiro, Wonosobo, Jawa Tengah 56364', 'Jalan KH. Abdurrahman Wahid No. 100 RT 02 RW 12 Kalianget, Wonosobo, Jawa Tengah 56319', '0821 3543 2071', '', '3307 0451 0601 0003', NULL, NULL, NULL, '2023-12-26', '2024-12-27', NULL, 6, 0, 0, 'rosezanap11@gmail.com', 'CHATHERINA', '', 'lajang', '', '', 'aktif'),
(197, '0197', 'MARCELLINA THOMASARI ANINDITA', 5, 3, 'kontrak', 'Sleman', '1985-08-21', 'Kerbau', 'Leo', 'Rabu Kliwon', 'P', 'S1', 'Teknik Industri', 'A', 'KATHOLIK', 'Cebongan Lor RT 004 RW 005 Tlogoadi, Mlati, Sleman', 'Sanggrahan, Wirorejan RT 03 RW 01 Prambanan, Kab. Klaten', '0817 9437 017', '', '3404 0661 0885 0005', NULL, NULL, NULL, '2024-01-02', '2025-07-03', NULL, 12, 0, 0, 'thomasarianindita@gmail.com', 'SITI HANDAYANI SARI', '', 'menikah', 'BONDHAN W.', '', 'aktif'),
(198, '0198', 'RIGI WAHYU UTOMO', 5, 4, 'kontrak', 'Sleman', '2000-10-25', 'Naga', 'Scorpio', 'Rabu Wage', 'L', 'SUPM', 'Perikanan', 'B', 'ISLAM', 'Kadisoka RT 05 RW 02 Purwomartani, Kalasan, Sleman', '', '0821 1327 0679', '3404 1020 0112 0001', '3404 1025 1100 0002', NULL, NULL, NULL, '2024-01-02', '2024-10-03', NULL, 6, 0, 0, 'rigiwhy1976@gmail.com', 'SUHARNI', '', 'lajang', '', '', 'aktif'),
(199, '0199', 'FITRI NOVITA ANGGRAINI', 5, 16, 'kontrak', 'Bojonegoro', '1993-11-29', '#N/A', 'Sagittarius', 'Senin Pahing', 'P', '', NULL, 'AB', 'ISLAM', 'Jalan TGP No. 29 RT 019 RW 003 Banjarejo, Bojonegoro', 'Jalan TGP No. 29 RT 019 RW 003 Banjarejo, Bojonegoro', '0822 6445 4395', '', '3522 1569 1193 0003', NULL, NULL, NULL, '2024-01-02', '2025-01-04', NULL, 6, 0, 0, '', 'SUJIYEM', '', 'menikah', '', '', 'aktif'),
(200, '0200', 'LESMANA', 5, 2, 'kontrak', 'Sleman', '1991-08-24', 'Kambing', 'Virgo', 'Sabtu Wage', 'L', 'SMK', 'Teknik Mekanik Otomotif', 'B', 'ISLAM', 'Jetis RT 03 RW 02 Sinduadi, Mlati, Sleman, DIY', 'Jetis RT 03 RW 02 Sinduadi, Mlati, Sleman, DIY', '0856 4744 5531', '', '3404 0424 0891 0003', NULL, NULL, NULL, '2024-01-05', '2024-10-06', NULL, 6, 0, 0, 'Lesmanaone1@gmail.com', 'TUKIDAH', '', 'menikah', 'NURROHMI ENDAH HERSIWI', 'NAKULA AL HAFIDZ (08/07/2019)', 'aktif'),
(201, '0201', 'ELI KARDILLA', 5, 14, 'kontrak', 'Bone', '2000-11-06', 'Naga', 'Scorpio', 'Senin Legi', 'P', 'S1', 'Adm. Publik', 'AB', 'ISLAM', 'Mantaritip', 'Jl. Taman Siswa, Mergangsan Kidul, DIY', '0853 4875 6772', '', '6403 0346 1100 0001', NULL, NULL, NULL, '2024-01-08', '2024-10-08', NULL, 3, 0, 0, 'ellykardilla06@gmail.com', 'NURHAYATI', '', 'lajang ', '', '', 'aktif'),
(202, '0202', 'ANGGAR NUR MARDIYANTO', 5, 2, 'kontrak', 'Sleman', '1995-03-14', 'Babi', 'Pisces', 'Selasa Pahing', 'L', 'SMK', 'Tekniki Kendaraan Ringan', 'A', 'ISLAM', 'Sleman 3 RT 08 RW 10, Sleman, Yogyakarta', 'Sleman 3 RT 08 RW 10, Sleman, Yogyakarta', '0895 7098 61199', '3404 1309 1019 0002', '3404 1314 3950 0003', NULL, NULL, NULL, '2024-01-10', '2024-08-12', NULL, 3, 0, 0, 'anggarnur9@gmail.com', 'PUJIYATI', '', 'menikah', 'NOFIATUN KHASANAH', 'FAHIMA BENING EMBUN (07/07/2020)', 'aktif'),
(203, '0203', 'JOVANKA MAHADIKA', 5, 2, 'kontrak', 'Klaten', '1999-10-15', 'Kelinci', 'Libra', 'Jumat Pon', 'L', 'SMK', 'Teknik Mekatronika', 'O', 'KATHOLIK', 'Semalen RT 02 RW 07 Ngering, Jogonalan, Klaten', 'Semalen RT 02 RW 07 Ngering, Jogonalan, Klaten', '0821 3396 8490', '3310 0811 0408 0015', '3310 0815 1099 0002', NULL, NULL, NULL, '2024-01-10', '2024-11-12', NULL, 3, 3, 0, 'mahadikaa12@gmail.com', 'A RENI SUSILOWATI ', '', 'lajang ', '', '', 'aktif'),
(204, '0204', 'DIMAS SETYO NUGROHO', 5, 2, 'kontrak', 'Sleman', '2004-03-29', 'Monyet', 'Aries', 'Senin Kliwon', 'L', 'SMK', 'Teknik Kendaraan Ringan', NULL, 'ISLAM', 'Nglinggan, Wedomartani, Ngemplak, Sleman, yogyakarta', 'Nglinggan, Wedomartani, Ngemplak, Sleman, yogyakarta', '0888 0297 4088', '', '3404 1129 0304 0001', NULL, NULL, NULL, '2024-01-10', '2024-08-12', NULL, 3, 0, 0, 'dimassetyo432@gmail.com', 'PARYATIK', '', 'lajang ', '', '', 'aktif'),
(205, '0205', 'SUMARWANTO', 5, 2, 'kontrak', 'Gunungkidul', '2004-04-29', 'Monyet', 'Taurus', 'Kamis Legi', 'L', 'SMK', 'Teknik Otomotif', NULL, 'ISLAM', 'Selorejo RT 002 RW 001, Solo, Paliyan, Gunung Kidul, Daerah Istimewa Yogyakarta', 'Selorejo RT 002 RW 001, Solo, Paliyan, Gunung Kidul, Daerah Istimewa Yogyakarta', '0838 9718 4987', '', '3402 0529 0404 0001', NULL, NULL, NULL, '2024-01-10', '2024-08-12', NULL, 3, 0, 0, 'sumarwanto294@gmail.com', 'SURANI', '', 'lajang ', '', '', 'aktif'),
(206, '0206', 'EURICO DWI MURAKI', 5, 2, 'kontrak', 'Bantul', '2004-10-02', 'Monyet', 'Libra', 'Sabtu Pahing', 'L', 'SMK', 'Otomotif', 'O', 'ISLAM', 'Kranginan, Mertosanan Kulon RT 005, Portorono, Banguntapan', 'Kranginan RT 05 Martosonon Kulon, Portorono, Banguntapan, Bantul', '0819 9721 9679', '', '3402 1202 1004 0003', NULL, NULL, NULL, '2024-01-10', '2024-11-12', NULL, 3, 3, 0, 'dwimurakieurico@gmail.com', 'HARTATI', '', 'lajang ', '', '', 'aktif'),
(207, '0207', 'MEKA OFIEVEBRIE KUNCAHYO', 5, 16, 'kontrak', 'Soroako', '1987-02-28', 'Kelinci', 'Pisces', 'Sabtu Legi', 'L', '', NULL, NULL, 'ISLAM', 'Dusun Banyuurip RT 047 RW 012 Sonoageng, Prambon', 'Dusun Banyuurip RT 047 RW 012 Sonoageng, Prambon', '0857 3612 3999', '', '3506 1628 0287 0003', NULL, NULL, NULL, '2024-01-10', '2025-01-10', NULL, 6, 6, 0, '', NULL, '', 'menikah', '', '', 'aktif'),
(208, '0208', 'ENANG DWI MARTA ', 5, 2, 'kontrak', 'Sleman', '2004-03-02', 'Monyet', 'Pisces', 'Selasa Pon', 'L', 'SMK', 'Instalasi Tenaga Listrik', 'AB', 'ISLAM', 'Gedongan, Tlogoadi, Mlati, Sleman', 'Gedongan, Tlogoadi, Mlati, Sleman', '0838 4415 2511', '3404 0604 1006 0002', '3404 0602 0304 0001', NULL, '', '', '2024-01-11', '2024-11-14', NULL, 3, 3, 0, 'enangdwim@gmail.com', 'SURATMI ', '', '', '', '', 'aktif'),
(209, '0209', 'HIDAYAT KARUNIA AKBAR ', 5, 2, 'kontrak', 'Klaten', '2004-09-02', 'Monyet', 'Virgo', 'Kamis Pahing', 'L', 'SMK', 'Teknik Mesin', 'AB', 'ISLAM', 'Wirosari RT 12 RW 05 Somopuro, Jogonalan, Klaten', 'Wirosari RT 12 RW 05 Somopuro, Jogonalan, Klaten', '0895 3660 03617', '', '3310 0802 0904 0001', NULL, NULL, NULL, '2024-01-11', '2024-08-13', NULL, 3, 0, 0, 'hidayatakbar476@gmail.com', 'SRI WAHYUNINGSIH', '', 'lajang ', '', '', 'aktif'),
(210, '0210', 'DIAN KRISTANTO', 5, 2, 'kontrak', 'Sleman', '2004-12-26', 'Monyet', 'Capricorn', 'Minggu Pahing', 'L', 'SMK', 'Listrik', 'O', 'ISLAM', 'Palgading, Sinduharjo, Ngaglik, Sleman', 'Palgading, Sinduharjo, Ngaglik, Sleman', '0896 7166 3757', '', '3404 1226 1204 0002', NULL, NULL, NULL, '2024-01-11', '2024-08-13', NULL, 3, 0, 0, 'diankristanto114@gmail.com', 'PAINAH ', '', 'lajang ', '', '', 'aktif'),
(211, '0211', 'DIKA FAJAR PRATAMA', 5, 3, 'kontrak', 'Bantul', '1995-02-17', 'Babi', 'Aquarius', 'Jumat Pahing', 'L', 'SMK', 'Otomotif', 'O', 'ISLAM', 'Prayon RT 01 Srimulyo, Piyungan, Bantul', 'Prayon RT 01 Srimulyo, Piyungan, Bantul', '0858 7922 7809', '3402 1417 1003 0150', '3402 1417 0295 0001', NULL, NULL, NULL, '2024-01-11', '2024-08-13', NULL, 3, 0, 0, 'dfajarpratama@gmail.com', 'ISENI', '', 'menikah', 'EMYLIANA DEWI ', '', 'aktif');
INSERT INTO `tbl_pegawai` (`id_pegawai`, `nip`, `nama_pegawai`, `jabatan_id`, `divisi_id`, `status_pegawai`, `tempat_lahir`, `tgl_lahir`, `shio`, `zodiak`, `weton`, `jenis_kelamin`, `pendidikan_terakhir`, `jurusan`, `golongan_darah`, `agama`, `alamat_ktp`, `alamat_domisili`, `kontak_pegawai`, `no_kk`, `no_ktp`, `no_jamsostek`, `no_bpjsKesehatan`, `no_npwp`, `tgl_masuk`, `tgl_selesai`, `tgl_keluar`, `durasi_kontrak`, `kuota_cuti`, `sisa_cuti`, `email_pegawai`, `nama_ibu`, `nama_ayah`, `status_pernikahan`, `nama_pasangan`, `nama_anak`, `status`) VALUES
(212, '0212', 'EDWIN BAYU MAHARDIKA', 5, 2, 'kontrak', 'Magelang', '1984-08-28', 'Tikus', 'Virgo', 'Selasa Pahing', 'L', 'S1', 'Teknik Industri ', 'O', 'ISLAM', 'Susukan Barat RT 002 RW 001 Grabag, Magelang', 'Jl. Perumnas B 26c Condongcatur, Depok, Sleman', '0813 2914 5929', '', '3308 1828 0884 0009', NULL, NULL, NULL, '2024-01-11', '2024-11-13', NULL, 3, 3, 0, 'edwinbayumahardika@gmail.com', 'SRI ENI', '', 'menikah', 'THASYA R', 'ASYRAF M (18/02/2010), RAJENDRA M (12/07/2016)', 'aktif'),
(213, '0213', 'HENDRA SETYAWAN', 5, 2, 'kontrak', 'Bantul', '2004-01-04', 'Monyet', 'Capricorn', 'Minggu Kliwon', 'L', 'SMK', 'Teknik Otomotif', 'O', 'ISLAM', 'Demangan, Ponegaran, RT 06', 'Demangan, Panegaran, Banguntapan, Bantul', '0896 2457 5198', '', '3402 1204 0104 0001', NULL, NULL, NULL, '2024-01-11', '2024-08-13', NULL, 3, 0, 0, 'setyawanhendra778@gmail.com', 'ROHMIYATI', '', 'lajang ', '', '', 'aktif'),
(214, '0214', 'ARIF MUNANDAR', 5, 4, 'kontrak', 'Sleman', '1997-09-07', 'Kerbau', 'Virgo', 'Minggu Kliwon', 'L', 'SMK', 'Kimia Industri', 'B', 'ISLAM', 'Munggon, Sendangtirto, Brebah, Sleman', 'Munggon, Sendangtirto, Brebah, Sleman', '0896 2302 8855', '3404 0808 0205 2191', '3404 0807 0997 0001', NULL, NULL, NULL, '2024-01-11', '2024-10-10', NULL, 6, 0, 0, 'arifmunandar551@gmail.com', 'SURAJINAH', '', 'lajang ', '', '', 'aktif'),
(215, '0215', 'MAULANA NURIL ALWAN', 5, 6, 'kontrak', 'Bantul', '2003-12-05', 'Kambing', 'Sagittarius', 'Jumat Kliwon', 'L', 'SMK', 'Teknik Listrik', 'O', 'ISLAM', 'Depok, RT 01 Wonolelo, Pleret, Bantul', 'Depok, RT 01 Wonolelo, Pleret, Bantul', '0895 3900 61988', '', '3402 1305 1203 0002', NULL, NULL, NULL, '2024-01-11', '2025-04-10', NULL, 12, 0, 0, 'maulananurila@gmail.com', 'WARTINI', '', 'lajang ', '', '', 'aktif'),
(216, '0216', 'CAHYO ADYTYAS SULARTO ', 5, 2, 'kontrak', 'Klaten', '1990-12-23', 'Kuda', 'Capricorn', 'Minggu Kliwon', 'L', 'SMK', 'Otomotif', NULL, 'ISLAM', 'Sumbarejo, RT 01 RW 108', 'Klaten', '0852 2553 8444', '', '3310 2623 01090001', NULL, NULL, NULL, '2024-01-12', '2024-08-14', NULL, 3, 0, 0, 'adittryas@gmail.com', 'SUDARSIH ', '', 'menikah', 'EKA SETYA NINGSIH ', 'SEVENTEENA SYIFA ADITYA (17/09/2013), HAFIZ AJI PR', 'aktif'),
(217, '0217', 'HARIS SUSANTO ', 5, 2, 'kontrak', 'Bantul', '1985-05-20', 'Kerbau', 'Taurus', 'Senin Pahing', 'L', 'SMK', 'Teknik Mesin', 'B', 'ISLAM', 'Tilanam RT 02 Wukirsari, Imogiri, Bantul', 'Tilanam RT 02 Wukirsari, Imogiri, Bantul', '0812 6870 029', '', '3402 1020 0585 0002', NULL, NULL, NULL, '2024-01-12', '2024-11-14', NULL, 3, 3, 0, 'kartasemita76@gmail.com', NULL, '', 'menikah', 'TIA HERDIANA', 'KEENAN R. S (03/12/2017), KAVIN P. S (05/09/2020)', 'aktif'),
(218, '0218', 'SURYADI ', 5, 2, 'kontrak', 'Bantul', '1990-12-08', 'Kuda', 'Sagittarius', 'Sabtu Kliwon', 'L', 'SMK', 'Teknik Mesin', 'O', 'ISLAM', 'Jolosutro RT 02 Srimulyo , Piyungan', 'Jolosutro, Srimulyo, Piyungan, Bantul', '0819 1999 9359', '', '4302 1408 1290 0002', NULL, NULL, NULL, '2024-01-12', '2024-08-14', NULL, 3, 0, 0, 'suryasryd@gmail.com', 'SUPATMIYATI ', '', 'lajang ', '', '', 'aktif'),
(219, '0219', 'RESEPTA NUR HANDRIANTO ', 5, 2, 'kontrak', 'Sleman', '1997-09-09', 'Kerbau', 'Virgo', 'Selasa Pahing', 'L', 'S1', 'Teknik Industri ', 'B', 'ISLAM', 'Depok Maguwo RT 05 RW 47 Maguwoharjo, Depok, Sleman, Yogyakarta', 'Depok Maguwo RT 05 RW 47 Maguwoharjo, Depok, Slema, Yogyakarta', '0857 4322 2085', '', '3404 0709 0997 0002', NULL, NULL, NULL, '2024-01-12', '2024-11-14', NULL, 3, 3, 0, 'reseptanurhandrianto@gamial.com', 'UMINI HANIAH', '', 'lajang ', '', '', 'aktif'),
(220, '0220', 'FENDI LILO PRAYOGO', 5, 2, 'kontrak', 'Bantul', '2004-05-18', 'Monyet', 'Taurus', 'Selasa Kliwon', 'L', 'SMK', 'Otomotif', NULL, 'ISLAM', 'Jolosutro, Srimulyo, Piyungan Bantuk', 'Jolosutro, Srimulyo, Piyungan Bantuk', '0877 0889 9181', '3402 1404 1103 0126', '3402 1418 0504 0001', NULL, NULL, NULL, '2024-01-12', '2024-11-14', NULL, 3, 3, 0, 'fendililo3@gmail.com', 'SUPATMIYATI ', '', 'lajang ', '', '', 'aktif'),
(221, '0221', 'BAYU SETYAJI UTAMA', 5, 4, 'kontrak', 'Cilacap', '1996-01-09', 'Tikus', 'Capricorn', 'Selasa Pon', 'L', 'SMK', 'Teknik Permesinan', 'B', 'ISLAM', 'RT 02 RW 30 Tajem, Maguwoharjo, Depok, Sleman, Yogyakarta', 'RT 02 RW 30 Tajem, Maguwoharjo, Depok, Sleman, Yogyakarta', '0895 3445 85070', '', '3301 2309 0196 0003', NULL, NULL, NULL, '2024-01-12', '2024-11-14', NULL, 6, 0, 0, 'ujik1213@gmail.com', 'RASITI', '', 'lajang ', '', '', 'aktif'),
(222, '0222', 'WAHYU SAPUTRA', 5, 2, 'kontrak', 'Klaten', '2004-02-06', 'Monyet', 'Aquarius', 'Jumat Pon', 'L', 'SMK', 'Teknik Sepeda Motor', 'B+', 'ISLAM', 'Nangsri RT 015 RW 006, Nangsri, Manisrenggo, Klaten', 'Nangsri RT 015 RW 006, Nangsri, Manisrenggo, Klaten', '0821 3506 9700', '', '3310 0906 0204 0003', NULL, NULL, NULL, '2024-01-12', '2024-08-14', NULL, 3, 0, 0, 'wahyusputro624@gmail.com', 'TITI HANDAYANI', '', 'lajang ', '', '', 'aktif'),
(223, '0223', 'BAYU TIRTA NURJAYANTO ', 5, 2, 'kontrak', 'Sleman', '2005-04-19', 'Ayam', 'Aries', 'Selasa Legi', 'L', 'SMK', 'Teknik Instalasi Tenaga Listrik ', 'A+', 'ISLAM', 'Gedongan RT 02 RW 24 Tlogadi, Mlati, Sleman', 'Gedongan RT 02 RW 24 Tlogadi, Mlati, Sleman', '0895 1114 2446', '', '3404 0619 0405 0002', NULL, NULL, NULL, '2024-01-12', '2024-11-14', NULL, 3, 3, 0, 'bayutirtayk@gmail.com', 'WIDAYATI', '', 'lajang ', '', '', 'aktif'),
(224, '0224', 'LEONARDUS ADAM IRAWAN ', 5, 2, 'kontrak', 'Sleman', '2001-06-20', 'Ular', 'Gemini', 'Rabu Pahing', 'L', 'S1', 'Pendidikan Teknik Mesin', 'O', 'KATHOLIK', 'Bunder, Purwobinangun, Pokem, Sleman', 'Bunder, Purwobinangun, Pokem, Sleman', '0856 4372 3542', '3404 1616 0205 5490', '3404 1602 0601 0003', NULL, NULL, NULL, '2024-01-12', '2024-11-14', NULL, 3, 3, 0, 'leonardusadam81@gmail.com', 'SUPIYAH', '', 'lajang ', '', '', 'aktif'),
(225, '0225', 'FENDRI GUNAWAN', 5, 2, 'kontrak', 'Kulon Progo', '2001-12-25', 'Ular', 'Capricorn', 'Selasa Kliwon', 'L', 'SMK', 'TKR', 'O', 'ISLAM', 'Kenteng Pendukuhan 7', 'Kenteng, Pendukuhan 7, Banaran, Galur, Kulon Progo', '0822 2661 2697', '', '3401 0525 1201 0001', NULL, NULL, NULL, '2024-01-12', '2024-08-14', NULL, 3, 0, 0, 'dhaermash@gmail.com', NULL, '', 'menikah', 'PUTRI JATI S', 'DEVANO ALFARIZI E (24/11/2021)', 'aktif'),
(226, '0226', 'ARIN SAVITRI ', 5, 4, 'kontrak', 'Klaten', '2001-01-01', 'Ular', 'Capricorn', 'Senin Pahing', 'P', 'S1', 'ITP', 'O', 'ISLAM', 'Dondong RT 13 RW 04, Jogoprayan, Gantiwarno, Klaten', 'Dondong RT 13 RW 04, Jogoprayan, Gantiwarno, Klaten', '0821 3859b 5682', '3310 0210 0812 0011', '3310 0241 0101 0001', NULL, NULL, NULL, '2024-01-12', '2024-11-14', NULL, 6, 0, 0, 'arinsavitri942@gmail.com', 'LAMIYEM', '', 'lajang ', '', '', 'aktif'),
(227, '0227', 'DANINDRA SAYNUR RIYADI', 5, 2, 'kontrak', 'Klaten', '2003-11-24', 'Kambing', 'Sagittarius', 'Senin Wage', 'L', 'SMK', 'Teknik Elektronika', 'B+', 'ISLAM', 'RT 10 RW 04 Duwet, Duwt, Klsten ', 'RT 10 RW 04 Duwet, Duwet, Klsten ', '0823 76 4 8190', '', '3310 2224 1103 0001', NULL, NULL, NULL, '2024-01-15', '2024-08-16', NULL, 3, 0, 0, 'danisaynur399@gmail.com', 'PUJI LESTARI ', '', 'lajang ', '', '', 'aktif'),
(228, '0228', 'NISWATIN PURNAMAWATI', 5, 16, 'kontrak', 'Lamongan', '1993-08-30', 'Ayam', 'Virgo', 'Senin Legi', 'P', '', NULL, NULL, 'ISLAM', 'Kedunggadung RT 002 RW 005 Deketagung, Sugio', 'Kedunggadung RT 002 RW 005 Deketagung, Sugio', '0812 5929 5203', '', '3524 1270 0893 0001', NULL, NULL, NULL, '2024-01-15', '2024-10-17', NULL, 3, 0, 0, '', NULL, '', 'menikah', '', '', 'aktif'),
(229, '0229', 'MARTIN INDRIAN FIRMAN FIRDAUS', 5, 7, 'kontrak', 'Sleman', '1989-04-06', 'Ular', 'Aries', 'Kamis Wage', 'L', 'AKADEMI', 'Hotel & Kapal', 'B', 'ISLAM', 'Ngalian RT 01 RW 21, Widodomartani, Ngemplak, Sleman', 'Ngalian RT 01 RW 21, Widodomartani, Ngemplak, Sleman', '0852 3449 6108', '', '3404 1106 0489 0001', NULL, NULL, NULL, '2024-01-16', '2024-11-18', NULL, 6, 0, 0, 'riyu_sailorman10@gmail.com', 'SUPATMI INDARTI', '', 'cerai hidup', '', '', 'aktif'),
(230, '0230', 'ERIC RIZQIANSYAH', 5, 2, 'kontrak', 'Sleman', '2003-07-03', 'Kambing', 'Cancer', 'Kamis Kliwon', 'L', 'SMK', 'Teknik Audio Video', 'O', 'ISLAM', 'Tepan, Ngentak RT 05 RW 24, Bangunkerto, Turi, Sleman', 'Tepan, Ngentak, Bangunkerto, Turi, Sleman', '0831 1301 0150', '3404 1514 0306 0005', '3404 1503 0703 0001', NULL, NULL, NULL, '2024-01-17', '2024-11-18', NULL, 3, 3, 0, 'ericrizqiansyah03@gmail.com', 'PUJI RAHAYU ', '', 'lajang ', '', '', 'aktif'),
(231, '0231', 'HONO', 5, 7, 'kontrak', 'Kulon Progo', '1992-04-09', 'Monyet', 'Aries', 'Kamis Pon', 'L', 'SMK', 'Otomotif', 'O', 'ISLAM', 'Ledok RT 15 RW 00, Sidorejo, Lendah, Kulon Progo', 'Ledok RT 15 RW 00, Sidorejo, Lendah, Kulon Progo', '0882 0075 28201', '', '3401 0509 04920001', NULL, NULL, NULL, '2024-01-17', '2024-11-18', NULL, 6, 0, 0, 'honoangkringan@gmail.com', NULL, '', 'menikah', 'ERNA KUSUMANDARI ', 'DIFANO. M. A (15/12/2020)', 'aktif'),
(232, '0232', 'BAYU SETIAWAN', 5, 3, 'kontrak', 'Yogyakarta', '1991-08-01', 'Kambing', 'Leo', 'Kamis Legi', 'L', 'SMK', 'Perindustrian', NULL, 'ISLAM', 'Jlamprang RT 01 RW 01, Pandowoharjo, Sleman', 'Jlamprang RT 01 RW 01, Pandowoharjo, Sleman', '0813 9176 0542', '3404 1329 1215 0003', '3402 1201 0891 0004', NULL, NULL, NULL, '2024-01-17', '2024-08-18', NULL, 3, 0, 0, 'bayukonoha77@gmail.com', 'WARTINI', '', 'menikah', 'DESTIN', 'FATHANIAN (19/11/2015)', 'aktif'),
(233, '0233', 'LAURENSIA SEKAR ESTI PERWITASARI', 5, 5, 'kontrak', 'Klaten', '2001-01-16', 'Ular', 'Capricorn', 'Selasa Pahing', 'P', 'S1', 'Ekonomi Management', 'B', 'KATHOLIK', 'Beku 003/ 004 Gadungan, Wedi, Klaten', 'Beku 003/ 004 Gadungan, Wedi, Klaten', '0899 5024 851', '3310 0328 0606 0009', '3310 0356 0101 0001', NULL, NULL, NULL, '2024-01-22', '2025-01-22', NULL, 6, 0, 0, 'laurensia.sep@gmail.com', 'CHRISTINA SRI MULYANI', '', 'lajang ', '', '', 'aktif'),
(234, '0234', 'KEVIN HASTO HIDAYAT ', 5, 4, 'kontrak', 'Yogyakarta', '2005-10-14', 'Ayam', 'Libra', 'Jumat Wage', 'L', 'SMK', 'Teknik Kimia Industri ', 'B', 'ISLAM', 'Jamblangan, Banguntapan, Bantul ', 'Jamblangan, Banguntapan, Bantul ', '0857 4734 4924', '', '3402 1214 1005 0001', NULL, NULL, NULL, '2024-01-25', '2024-11-26', NULL, 3, 3, 0, 'kevinhasta14@gmail.com', 'SANTI RACHMAWATI', '', 'lajang ', '', '', 'aktif'),
(235, '0235', 'ALDHEO ILHAM SEPTIANTO', 5, 2, 'kontrak', 'Klaten', '2002-09-03', 'Kuda', 'Virgo', 'Selasa Pahing', 'L', 'SMK', 'Teknik Listrik', 'O', 'ISLAM', 'Kecemen, Manisrenggo, Jawa Tengah', 'Kecemen, Manisrenggo, Jawa Tengah', '0816 1757 8175', '', '3310 0903 0902 0001', NULL, NULL, NULL, '2024-01-25', '2024-08-26', NULL, 6, 0, 0, 'ilhamseptianto.3@gmail.com', 'SUHARTINI', '', 'lajang ', '', '', 'aktif'),
(236, '0236', 'SIDIQ ARDYANSYAH', 5, 4, 'kontrak', 'Sleman', '2005-02-18', 'Ayam', 'Aquarius', 'Jumat Legi', 'L', 'SMK', 'Teknik Listrik', 'O', 'ISLAM', 'Gayan RT 04 RW 42 Argomulyo, Cangkringan, Sleman, DIY', 'Gayan RT 04 RW 42 Argomulyo, Cangkringan, Sleman, DIY', '0822 6546 6996', '', '3404 1718 0205 0001', NULL, NULL, NULL, '2024-01-25', '2024-08-26', NULL, 6, 0, 0, 'ardiansyahsidiq18@gmail.com', 'HENI SETYAWATI', '', 'lajang ', '', '', 'aktif'),
(237, '0237', 'ABBIYUKA DZAKY ASKILANSYAH', 5, 4, 'kontrak', 'Yogyakarta', '2006-03-01', 'Anjing', 'Pisces', 'Rabu Pahing', 'L', 'SMK', 'Kimia Industri', 'AB', 'ISLAM', 'Minggiran, Kec. Mantrijeron, Kel. Suryodiningratan, Yogyakarta', 'Minggiran, Kec. Mantrijeron, Kel. Suryodininbgratan, Yogyakarta', '0831 0347 9451', '', '3471 1201 0306 0001', NULL, NULL, NULL, '2024-01-25', '2024-08-26', NULL, 6, 0, 0, 'abbiyukaaskilansyah@gmail.com', 'ASTUTI TRI HANDAYANI ', '', 'lajang ', '', '', 'aktif'),
(238, '0238', 'ARDIANTO EKO WAHYU NUGROHO', 5, 16, 'kontrak', 'Yogyakarta', '1993-07-13', 'Ayam', 'Cancer', 'Selasa Pon', 'L', 'S1', 'Ilmu Ekonomi ', NULL, 'ISLAM', 'Jl. Arjuna No. 18 C RT 40 RW 10 Wirobrajan, Yogyakarta', 'Jl. Arjuna No. 18 C RT 40 RW 10 Wirobrajan, Yogyakarta', '0838 3886 5121', '', '3471 0713 0793 0001', NULL, NULL, NULL, '2024-01-29', '2024-10-30', NULL, 6, 0, 0, 'ardikowahyu12@gmail.com', NULL, '', 'menikah', '', '', 'aktif'),
(239, '0239', 'MUHAMMAD ARIF NUR RAHMAN', 5, 2, 'kontrak', 'Bantul', '2003-08-21', 'Kambing', 'Leo', 'Kamis Wage', 'L', 'SMK', 'Audio Vidio', 'B', 'ISLAM', 'Babadan, Dk Babadan RT 01 RW 00 Bantul', 'Jl. Diponegoro RT. 01 Babadan Bantul, Daerah Istimewa Yogyakarta', '0895 0132 4436', '3402 0807 0803 0004', '3402 0821 0803 0001', NULL, NULL, NULL, '2024-01-30', '2024-09-02', NULL, 6, 0, 0, 'arifrahman33302gmail.com', 'SRI SURYANI ', '', 'lajang ', '', '', 'aktif'),
(240, '0240', 'INSAN BUDIMAN', 5, 2, 'kontrak', 'Palgading', '2004-05-27', 'Monyet', 'Gemini', 'Kamis Wage', 'L', 'SMK', 'Listrik', 'A', 'ISLAM', 'Palgading RT 02 RW 17 No. 44 Sinuharjo, Ngaglik, Sleman', 'Palgading RT 02 RW 17 No. 44 Sinuharjo, Ngaglik, Sleman', '0896 0976 4881', '3404 1222 1107 0017', '3404 1227 0504 0002', NULL, NULL, NULL, '2024-01-30', '2024-09-03', NULL, 3, 0, 0, 'insanbudiman2004@gmail.com', 'SRI ANDAYANI', '', 'lajang ', '', '', 'aktif'),
(241, '0241', 'DYAS PRADIKA ', 5, 2, 'kontrak', 'Klaten', '2003-08-01', 'Kambing', 'Leo', 'Jumat Wage', 'L', 'SMK', 'Teknik Tenaga Listrik', 'A', 'ISLAM', 'Tegal Krapyak, Pakahan', 'Tegal Krapyak, Pakahan, Jogonalan, Klaten', '0838 4007 708', '', '3310 0801 0803 0001', NULL, NULL, NULL, '2024-01-30', '2024-09-03', NULL, 3, 0, 0, 'dyaspradika8@gmail.com', 'MUJIRAH ', '', 'lajang ', '', '', 'aktif'),
(242, '0242', 'BUDI SETIAWAN', 4, 2, 'kontrak', 'Tangerang', '1985-01-22', 'Kerbau', 'Aquarius', 'Selasa Wage', 'L', 'S1', 'Teknik Elektro', 'A', 'ISLAM', 'Griya Asri Cluster Kenari Blok 01/30, RT 10 RW 10, Cikande, Serang, Banten', 'Griya Asri Cluster Kenari Blok 01/30, RT 10 RW 10, Cikande, Serang, Banten', '0856 2969 787', '', '', NULL, NULL, NULL, '2024-02-01', '2024-08-01', NULL, 6, 0, 0, 'budisetiawan2011@gmail.com', 'C. SUPRATWI', '', 'menikah', 'SURIYATI', 'ALULEN GALEN (24/06/2017)', 'aktif'),
(243, '0243', 'AGUSTINA WULANSARI', 5, 16, 'kontrak', 'Tulungagung', '1991-08-20', 'Kambing', 'Leo', 'Selasa Kliwon', 'P', 'SMK', 'Akuntansi', NULL, 'ISLAM', 'Dusun Ngegong RT 01 RW 06, Banjarsari, Ngantru, Tulungagung', 'Dusun Ngegong RT 01 RW 06, Banjarsari, Ngantru, Tulungagung', '0821 4164 7700', '', '3504 0460 0891 0003', NULL, NULL, NULL, '2024-02-02', '2024-11-03', NULL, 6, 0, 0, '', NULL, '', 'menikah', 'YANI SUDARIYANTO', 'KAYLA MARITZA PUTRI (04/03/2015), RAJENDRA SEAN PU', 'aktif'),
(244, '0244', 'ALFIAN DWI FEBRIANTO', 5, 2, 'kontrak', 'Klaten', '2001-02-18', 'Ular', 'Aquarius', 'Minggu Kliwon', 'L', 'SMK', 'Teknik Pemesinan', NULL, 'ISLAM', 'Ngargopuspito, Randulanang, Jatinum, Klaten', 'Ngargopuspito, Randulanang, Jatinum, Klaten', '0822 2345 4385', '', '3310 2018 0201 0002', NULL, NULL, NULL, '2024-02-02', '2024-08-03', NULL, 3, 0, 0, 'f.alfiandwi@gmail.com', 'HARYANI', '', 'lajang', '', '', 'aktif'),
(245, '0245', 'GALIH SETYO BUDI', 5, 2, 'kontrak', 'Klaten', '1999-07-07', 'Kelinci', 'Cancer', 'Rabu Pon', 'L', 'SMK', 'Otomotif', NULL, 'ISLAM', 'Semalen Ngering, Jogonalan, Klaten', 'Semalen Ngering, Jogonalan, Klaten', '0878 8803 1146', '3310 0811 1016 0007', '3310 2307 0799 0002', NULL, NULL, NULL, '2024-02-02', '2024-11-03', NULL, 3, 3, 0, 'setyobudigalih@gmail.com', 'TANEM', '', 'lajang', '', '', 'aktif'),
(246, '0246', 'BAYU CAHYONO', 5, 16, 'kontrak', 'Purworejo', '1982-04-28', 'Anjing', 'Taurus', 'Rabu Wage', 'L', 'D3', 'Manajemen Informatika', 'O', 'ISLAM', 'Suwawal RT 01 RW 02, Suwawal, Mlonggo, Jepara', 'Dusun Tempel Rejosari RT 04 RW 03, Wonolopo, Mijen, Semarang', '0821 3740 8116 / 0831 0375 6988', '', '3320 0728 0482 0003', NULL, NULL, NULL, '2024-02-05', '2024-11-06', NULL, 6, 0, 0, 'bayucahbayu@gmail.com', NULL, '', 'menikah', '', '', 'aktif'),
(247, '0247', 'BELLA SAGITA', 5, 16, 'kontrak', 'Bantul', '1999-12-14', 'Kelinci', 'Sagittarius', 'Selasa Pon', 'P', 'S1', 'Gizi', 'O', 'ISLAM', 'Boto RT 070, Patalan, Jetis, Bantul', 'Boto RT 070, Patalan, Jetis, Bantul', '0895 3636 73250', '', '3402 0954 1299 0001', NULL, NULL, NULL, '2024-02-05', '2024-11-06', NULL, 6, 0, 0, 'bellasagitaa99@gmail.com', 'YULIYAH', '', 'lajang', '', '', 'aktif'),
(248, '0248', 'TABAH PRAKOSO', 5, 3, 'kontrak', 'Bantul', '2003-01-15', 'Kambing', 'Capricorn', 'Rabu Legi', 'L', 'SMK', 'Otomotif', 'B', 'ISLAM', 'Gunung Kunci RT 04, Tirtoharjo, Kretek, Bantul, Yogyakarta', 'Gunung Kunci RT 04, Tirtoharjo, Kretek, Bantul, Yogyakarta', '0882 3325 9423', '3402 0323 0221 0005', '3402 0315 0103 0001', NULL, NULL, NULL, '2024-02-07', '2024-08-08', '2024-08-12', 3, 0, 0, 'tabahprakoso133@gmail.com', 'SUPRIHATIN', '', 'lajang', '', '', 'tidak'),
(249, '0249', 'RIZAL WAHYU NUGROHO', 5, 4, 'kontrak', 'Kebumen', '1995-07-29', 'Babi', 'Leo', 'Sabtu Wage', 'L', 'SMK', 'Electrical Avionic', 'O', 'ISLAM', 'Baturan RT 01 RW 019 Trihanggo, Gamping, Sleman', 'Baturan RT 01 RW 019 Trihanggo, Gamping, Sleman', '0896 6605 9151', '3404 0114 0823 0004', '3305 1029 0795 0001', NULL, NULL, NULL, '2024-02-07', '2024-08-08', NULL, 3, 0, 0, 'rizalwahyu29@gmail.com', 'ENDANG MASTUTI', '', 'menikah', 'NADIA DWI A', '', 'aktif'),
(250, '0250', 'RONY SETIAWAN', 5, 2, 'kontrak', 'Klaten', '1989-08-20', 'Ular', 'Leo', 'Minggu Kliwon', 'L', 'SMK', 'Teknik Pemesinan', 'A', 'ISLAM', 'Babadan RT 01 RW 06, Beluk, Bayat, Klaten', 'Babadan RT 01 RW 06, Beluk, Bayat, Klaten', '0857 8673 0295', '', '3310 0420 0889 0003', NULL, NULL, NULL, '2024-02-09', '2024-08-10', NULL, 3, 0, 0, 'rhonisetiawan5@gmail.com', 'SURANI', '', 'menikah', 'ZULFA AKMALIA AINI', '', 'aktif'),
(251, '0251', 'NICOLAS NUGROHO GUSTI', 5, 2, 'kontrak', 'Bantul', '2000-07-15', 'Naga', 'Cancer', 'Sabtu Pahing', 'L', 'SMK', 'Kimia Industri', 'B', 'KATHOLIK', 'Jogonalan Kidul RT 01, Tirtonirmolo, Kasihan, Bantul', 'Jogonalan Kidul RT 01, Tirtonirmolo, Kasihan, Bantul', '0896 2816 5303', '', '3402 1615 0700 0008', NULL, NULL, NULL, '2024-02-09', '2024-11-10', NULL, 3, 3, 0, 'niconugroho72@gmail.com', 'TYAS UTAMI', '', 'lajang', '', '', 'aktif'),
(252, '0252', 'YULIUS ANDIKA KURNIAWAN', 5, 2, 'kontrak', 'Magelang', '1993-06-30', 'Ayam', 'Cancer', 'Rabu Kliwon', 'L', 'SMK', 'Otomotif', 'A', 'KATHOLIK', 'Kwayuhan No. 105/150 RT 05 RW 02, Gelangan, Magelang Tengah', 'Kwayuhan No. 105/150 RT 05 RW 02, Gelangan, Magelang Tengah', '0857 3094 2748', '', '3371 0230 0693 0001', NULL, NULL, NULL, '2024-02-09', '2024-08-10', NULL, 3, 0, 0, 'kyuliviandika@gmail.com', 'YUNIARTI', '', 'lajang', '', '', 'aktif'),
(253, '0253', 'YOHANES WAWAN SETIAWAN', 5, 2, 'kontrak', 'Magelang', '2005-05-07', 'Ayam', 'Taurus', 'Sabtu Wage', 'L', 'SMK', 'Otomotif', NULL, 'KATHOLIK', 'Tirip, Kalibawang, Kulonprogo', 'Tirip, Kalibawang, Kulonprogo', '0882 0037 98725', '3308 0226 0213 0002', '3308 0207 0505 0002', NULL, NULL, NULL, '2024-02-09', '2024-11-10', NULL, 3, 3, 0, 'yohaswawns@gmail.com', 'MURJIYEM', '', 'lajang', '', '', 'aktif'),
(254, '0254', 'WISNU DWI PRASETYO', 5, 4, 'kontrak', 'Sleman', '1999-05-08', 'Kelinci', 'Taurus', 'Sabtu Pon', 'L', 'SMK', 'Teknik Mesin', NULL, 'ISLAM', 'Dawung RT 01 RW 013, Bokoharjo, Prambanan, Sleman, Yogyakarta', 'Dawung RT 01 RW 013, Bokoharjo, Prambanan, Sleman, Yogyakarta', '0821 4712 0164', '', '3404 0908 0599 0001', NULL, NULL, NULL, '2024-02-09', '2024-11-08', NULL, 6, 0, 0, 'wisnudwiprasetyo8599@gmail.com', 'WARTINI', '', 'lajang', '', '', 'aktif'),
(255, '0255', 'AHMAD MIFTAHUZ ZAMANI', 5, 16, 'kontrak', 'Banyumas', '1997-03-22', 'Kerbau', 'Aries', 'Sabtu Legi', 'L', 'S1', 'Pendidikan Jasmani Kesehatan dan Rekreasi', 'O', 'ISLAM', 'Sirau RT 01 RW 02 Sirau, Kemranjen, Banyumas', 'Sirau RT 01 RW 02 Sirau, Kemranjen, Banyumas', '0812 2506 0927', '', '3302 0622 0397 0001', NULL, NULL, NULL, '2024-02-12', '2024-11-13', NULL, 6, 0, 0, '', NULL, '', '', '', '', 'aktif'),
(256, '0256', 'SINTA', 5, 16, 'kontrak', 'Kuningan', '1997-11-22', 'Kerbau', 'Scorpio', 'Sabtu Legi', 'P', 'SMK', 'Usaha Perjalanan Wisata', NULL, 'ISLAM', 'Lingk. Manis RT 07 RW 04, Sukamulya, Cigugur, Kuningan', 'Lingk. Manis RT 07 RW 04, Sukamulya, Cigugur, Kuningan', '0821 111 75524', '', '3208 1862 1197 0002', NULL, NULL, NULL, '2024-02-12', '2024-11-13', NULL, 6, 0, 0, '', NULL, '', 'lajang', '', '', 'aktif'),
(257, '0257', 'NABILA BALQIS AMANI', 5, 14, 'kontrak', 'Gresik', '2001-08-28', 'Ular', 'Virgo', 'Selasa Legi', 'P', 'S1', 'Animasi', 'O', 'ISLAM', 'Jalan Mirah No. 08 PPS, Manyar, Gresik', 'Jalan Amposari Timur 2 No. 03 Kedungmundu, Tembalang, Semarang, Jawa Tengah', '0857 0755 3817', '3525 1012 1108 2875', '3525 1068 0801 0002', NULL, NULL, NULL, '2024-02-12', '2024-11-12', NULL, 3, 3, 0, 'balqisamani78@gmail.com', 'LUSIANI PANCAWATI', '', 'lajang', '', '', 'aktif'),
(258, '0258', 'HASAN NUR MUSTAKIM', 5, 2, 'kontrak', 'Klaten', '1998-01-01', 'Macan', 'Capricorn', 'Kamis Legi', 'L', 'SMK', 'Teknik Mesin', 'AB', 'ISLAM', 'Jombor RT 02 RW 12, Jabung, Jantiwarno, Klaten', 'Jombor RT 02 RW 012 Jabung, Gantiwarno, Klaten', '0813 9815 3798', '3310 0220 0418 0001', '3310 0201 0198 0002', NULL, NULL, NULL, '2024-02-17', '2024-09-19', NULL, 3, 0, 0, 'hasannurmustakim@gmail.com', 'SUPARNI', '', 'lajang', '', '', 'aktif'),
(259, '0259', 'ADE WAHYONO', 5, 6, 'kontrak', 'Sleman', '1997-09-01', 'Kerbau', 'Virgo', 'Senin Wage', 'L', 'SMK', 'Teknik Pemesinan', 'A', 'ISLAM', 'Sembego No 16 A RT 14 RW 38 Maguwoharjo, Depok, Sleman, Yogyakarta', 'Mancasan Jlatren RT 06 RW 23 Jogotirto, Berbah, Sleman, Yogyakarta', '0895 3972 67021', '', '3404 0701 0997 0007', NULL, NULL, NULL, '2024-02-17', '2025-06-18', NULL, 12, 0, 0, 'adewahyono744@gmail.com', 'SITI UMINAH', '', 'menikah', 'RIRIN KARTIKA WATI', 'LUVENA AURIA FELICIA (07/03/2021)', 'aktif'),
(260, '0260', 'TIMBUL WAHYUDI', 5, 2, 'kontrak', 'Sleman', '1981-10-17', 'Ayam', 'Libra', 'Sabtu Legi', 'L', 'SMK', 'Mekanik Umum', NULL, 'ISLAM', 'Desa Karangjaba RT 001 RW 000 Lamandau, Kalimantan Tengah', 'Sanggrahan RT 04 RW 12 Maguwoharjo, Depok, Sleman Yogyakarta', '0812 5501 8051', '', '3214 0117 1081 0002', NULL, NULL, NULL, '2024-02-17', '2024-09-19', '2024-07-12', 3, 0, 0, '', NULL, '', 'menikah', 'TURMINI', '', 'tidak'),
(261, '0261', 'ANDRI FEBRIANTO', 3, 1, 'kontrak', 'Bantul', '1981-02-08', 'Ayam', 'Aquarius', 'Minggu Kliwon', 'L', 'S1', 'Public Health', 'O', 'ISLAM', 'Jalan Sekarjagad IV/27 Pajang, Laweyan, Surakarta', 'Jalan Sekarjagad IV/27 Pajang, Laweyan, Surakarta', '0878 0802 1981', '', '3372 0108 0281 0003', NULL, NULL, NULL, '2024-02-19', '2024-08-19', NULL, 6, 0, 0, 'febriantoandri00@gmail.com', 'ENDAH S.', '', 'menikah', 'ATIK SULISTYANINGSIH', 'KIRANA PUTRI (20/07/2008)', 'aktif'),
(262, '0262', 'ELISABETH NATASHA PUTRIKARISA', 4, 8, 'kontrak', 'Sleman', '1995-01-10', 'Babi', 'Capricorn', 'Selasa Wage', 'P', 'S1', 'Ilmu Komunikasi', 'O', 'KATHOLIK', 'Juwangen RT 01 RW 01 Purwomartani, Kalasan, Sleman, Yogyakarta', 'Juwangen RT 01 RW 01 Purwomartani, Kalasan, Sleman, Yogyakarta', '0895 34211 3891', '', '3404 1050 0195 0001', NULL, NULL, NULL, '2024-02-20', '2024-08-20', NULL, 6, 0, 0, 'elisabethntsh@gmail.com', 'BERNADETTA TRIANA N.U', '', 'menikah', 'PUTHUT NUGRAHA', '', 'aktif'),
(263, '0263', 'FARIDA MUTHI\'AH NUFIKARRAHMAH', 5, 8, 'kontrak', 'Sleman', '2001-07-18', 'Ular', 'Cancer', 'Rabu Kliwon', 'P', 'S1', 'Psikologi', 'A', 'ISLAM', 'Temulawak, Triharjo, Sleman, Yogyakarta', 'Temulawak, Triharjo, Sleman, Yogyakarta', '0857 0189 9709', '', '3404 1358 0701 0001', NULL, '', '', '2024-02-20', '2024-08-20', NULL, 6, 0, 0, 'faridamuthi@gmail.com', 'TERESTA FEBRIANTI', '', 'lajang', '', '', 'aktif'),
(264, '0264', 'MUHAMMAD RAFI MULYAWAN', 5, 4, 'kontrak', 'Sleman', '2005-07-10', 'Ayam', 'Cancer', 'Minggu Pon', 'L', 'SMK', 'Kimia Industri', 'O', 'ISLAM', 'Kalongan Santan Gg 1 No. 2 Maguwoharjo, Depok, Sleman', 'Jomblangan, Banguntapan, Bantul', '0895 3218 85441', '3404 0705 0205 4896', '3404 0710 0705 0001', NULL, NULL, NULL, '2024-02-22', '2024-09-18', NULL, 6, 0, 0, 'muhammadrafimulyawan@gmail.com', 'NUR SETYANINGSIH', '', 'lajang', '', '', 'aktif'),
(265, '0265', 'DEVI DAMARMAYA', 4, 11, 'kontrak', 'Kebumen', '1993-07-14', 'Ayam', 'Cancer', 'Rabu Wage', 'P', 'S1', 'Ekonomi Management', 'B', 'KATHOLIK', 'Jl. Kalingga Rejowinangun Utara, Magelang', 'Gang Punakawan Kav. 3C, Sonopakis KIdul, Kasihan, Bantul, Yogyakarta', '0813 2680 1598', '', '3305 1254 0793 0004', NULL, NULL, NULL, '2024-02-26', '2025-05-25', NULL, 12, 0, 0, 'damarmaya14@gmail.com', 'SUPINI', '', 'menikah', 'ASWIN PRANATA', '', 'aktif'),
(266, '0266', 'BUNDAN PRIHATOMO TIRTO', 5, 7, 'kontrak', 'Klaten', '1991-12-15', 'Kambing', 'Sagittarius', 'Minggu Pahing', 'L', 'SMK', 'Teknik Listrik', NULL, 'ISLAM', 'Sengon 02/03 Prambanan, Klaten', 'Sengon 02/03 Prambanan, Klaten', '0856 0004 5392', '', '1124 0915 1291 0001', NULL, NULL, NULL, '2024-02-28', '2024-08-28', NULL, 6, 0, 0, 'bondanprihatomo@gmail.com', 'SAJIYEM', '', 'menikah', 'MAYA RINAWATI', 'DZAKYA SHAQUEENA T. (21/02/2017)', 'aktif'),
(267, '0267', 'NURI BURHAM TANUJAYA', 5, 2, 'kontrak', 'Klaten', '2004-06-27', 'Monyet', 'Cancer', 'Minggu Kliwon', 'L', 'SMK', 'Teknik Kendaraan Ringan', 'O', 'ISLAM', 'Dukuh Kidul RT 032 RW 018 Pakahan, Jogonalan, Klaten', 'Dukuh Kidul RT 032 RW 018 Pakahan, Jogonalan, Klaten', '0895 2315 9480', '3310 0820 0704 4291', '3310 0827 0604 0001', NULL, '', '', '2024-03-02', '2024-11-05', NULL, 3, 3, 0, 'nuri.burham@gmail.com', 'SLAMET RAHAYU', '', 'lajang', '', '', 'aktif'),
(268, '0268', 'ARDHIAN WIDHIYATMOKO', 5, 2, 'kontrak', 'Klaten', '1997-05-17', 'Kerbau', 'Taurus', 'Sabtu Pahing', 'L', 'SMK', 'Teknik Pemesinan', 'A', 'ISLAM', 'Demangan RT 01 RW 09 Kajoran, Klaten Selatan, Klaten', 'Demangan RT 01 RW 09 Kajoran, Klaten Selatan, Klaten', '0812 9263 1066', '', '3310 2617 0597 0001', NULL, NULL, NULL, '2024-03-02', '2024-08-04', NULL, 3, 0, 0, 'ardian.aw19@gmail.com', NULL, '', 'lajang', '', '', 'aktif'),
(269, '0269', 'RAHMAD ADE ARIFANDI', 5, 2, 'kontrak', 'Klaten', '1999-04-24', 'Kelinci', 'Taurus', 'Sabtu Wage', 'L', 'SMK', 'Elektro', 'B', 'ISLAM', 'Margorejo RT 10 RW 06, Canan, Wedi, Klaten', 'Margorejo RT 10 RW 06, Canan, Wedi, Klaten', '0857 0224 4300', '', '3310 0324 0499 0002', NULL, NULL, NULL, '2024-03-06', '2024-11-08', NULL, 3, 3, 0, 'rahmadfandi0@gmail.com', 'SRI MARTININGSIH', '', 'lajang', '', '', 'aktif'),
(270, '0270', 'BAKTI AGULING NUSWANTORO', 5, 7, 'kontrak', 'Kota Padang Baru', '1997-08-05', 'Kerbau', 'Leo', 'Selasa Pahing', 'L', 'SMA', 'IPS', 'A/', 'ISLAM', 'Desa Karang Jaya, Kec. Selupu Rejang, Kab. Rejang Lebong, Bengkulu', 'Temanggai, Malokiwo, Sleman', '0821 3502 2192', '', '1702 1105 0897 0001', NULL, NULL, NULL, '2024-03-12', '2024-12-13', NULL, 6, 0, 0, 'baktiagulingnuswantoro7@gmail.com', 'RATNAWATI', '', 'lajang', '', '', 'aktif'),
(271, '0271', 'LA ODE JIAN RAHARJA', 5, 5, 'kontrak', 'Kendari', '1993-11-11', 'Ayam', 'Scorpio', 'Kamis Wage', 'L', 'S1', 'Desain Produk', 'O+', 'KRISTEN', 'Jalan MT. Haryono Lrg Oselga No. 2 Kendari, Sulawesi Tenggara', 'Jalan Candi Gebang II Ngemplak No. 61B Wedomartani, Sleman', '0878 4058 9114', '', '7471 1011 1192 0001', NULL, NULL, NULL, '2024-03-12', '2024-09-12', NULL, 6, 0, 0, 'raharjiaa74@gmail.com', 'RATU YULIANA', '', 'lajang', '', '', 'aktif'),
(272, '0272', 'ILMI HANDOYO NUGROHO', 5, 4, 'kontrak', 'Bantul', '2005-12-31', 'Ayam', 'Capricorn', 'Sabtu Pahing', 'L', 'SMK', 'Teknik Kimia Industri', 'O', 'ISLAM', 'Sompok, Sriharjo, Imogiri, Bantul', 'Sompok, Sriharjo, Imogiri, Bantul', '0895 4241 58030', '3402 1003 0803 0294', '3402 1031 1205 0001', NULL, '', '', '2024-03-13', '2025-01-15', NULL, 6, 0, 0, 'ilmihandoyo@gmail.com', 'SUYANTI', '', 'lajang', '', '', 'aktif'),
(273, '0273', 'FERNANDO RAFI SURYA MAHENDRA', 5, 4, 'kontrak', 'Klaten', '2006-07-11', 'Anjing', 'Cancer', 'Selasa Wage', 'L', 'SMK', 'Teknik Kimia Industri', NULL, 'ISLAM', 'Dukuh RT 02 RW 09 Donokerto, Turi, Sleman, Yogyakarta', 'Dukuh RT 02 RW 09 Donokerto, Turi, Sleman, Yogyakarta', '0896 9279 7020', '', '3404 1511 0706 0002', NULL, NULL, NULL, '2024-03-13', '2025-01-14', NULL, 6, 0, 0, 'nandoorafi2@gmail.com', 'ETIK MURWANINGSIH', '', 'lajang', '', '', 'aktif'),
(274, '0274', 'NARENDRA AGUS SAPUTRA', 5, 4, 'kontrak', 'Bantul', '2005-07-14', 'Ayam', 'Cancer', 'Kamis Pahing', 'L', 'SMK', 'Teknik Kimia Industri', NULL, 'ISLAM', 'Kalipentung, Kalitirto, Berbah, Sleman, Yogyakarta', 'Kalipentung, Kalitirto, Berbah, Sleman, Yogyakarta', '0819 9425 2130', '', '3402 1414 0705 0002', NULL, '', '', '2024-03-13', '2025-01-02', NULL, 6, 0, 0, 'narendraaguss14@gmail.com', 'ANTIN WINARSIH', '', 'lajang', '', '', 'aktif'),
(275, '0275', 'HAGNIASA WIRALGA', 5, 4, 'kontrak', 'Sleman', '2006-05-01', 'Anjing', 'Taurus', 'Senin Pon', 'L', 'SMK', 'Teknik Kimia Industri', 'A', 'ISLAM', 'Tebon, Kragilan RT 02 RW 31 Sidoluhur, Godean, Sleman, Yogyakarta', 'Tebon, Kragilan RT 02 RW 31 Sidoluhur, Godean, Sleman, Yogyakarta', '0899 5725 029', '', '3404 0201 0506 0004', NULL, '', '', '2024-03-13', '2025-01-02', NULL, 6, 0, 0, 'asahagniasa123@gmail.com', 'IPTIMUR', '', 'lajang', '', '', 'aktif'),
(276, '0276', 'EKA MURNIAASIH', 5, 16, 'kontrak', 'Cirebon', '1990-06-11', 'Kuda', 'Gemini', 'Senin Kliwon', 'P', 'SMK', 'Akuntansi', 'O', 'ISLAM', 'Desa Kebarepan RT 03 RW 02 Kec. Plumbon, Kab. Cirebon 45155', 'Desa Kebarepan RT 03 RW 02 Kec. Plumbon, Kab. Cirebon 45155', '0898 0639 363', '', '3209 1851 0690 0005', NULL, NULL, NULL, '2024-03-13', '2024-12-14', '2024-07-15', 6, 0, 0, 'nathaniahardika@gmail.com', NULL, '', 'menikah', '', '', 'tidak'),
(277, '0277', 'RENO TITO WIDIYANTO', 5, 2, 'kontrak', 'Gunungkidul', '2004-12-05', 'Monyet', 'Sagittarius', 'Minggu Legi', 'L', 'SMK', 'Teknik Kendaraan Ringan', 'O', 'KRISTEN', 'Nglampar RT 01 RW 10 Wiladeg, Karangmojo, Gunung Kidul', 'Nglampar RT 01 RW 10 Wiladeg, Karangmojo, Gunung Kidul', '0857 4716 6625', '3403 0914 0115 0003', '3403 1305 1204 0001', NULL, NULL, NULL, '2024-03-18', '2024-08-09', '2024-07-26', 3, 0, 0, 'renowidiyanto04@gmail.com', 'HARYATI', '', 'lajang', '', '', 'tidak'),
(278, '0278', 'ARROYAN PANGAYOM SAN', 5, 2, 'kontrak', 'Yogyakarta', '2004-04-29', 'Monyet', 'Taurus', 'Kamis Legi', 'L', 'SMK', 'Teknik Kendaraan Ringan', NULL, 'ISLAM', 'Dukuh MJ I/1275 Kel. Gedongkiwo, Kec. Mantrijeron, Yogyakarta', 'Dukuh MJ I/1275 Kel. Gedongkiwo, Kec. Mantrijeron, Yogyakarta', '0896 7327 1677', '', '3471 0829 0404 0002', NULL, NULL, NULL, '2024-03-18', '2024-07-19', '2024-07-20', 3, 0, 0, 'arroyanpangayom04@gmail.com', NULL, '', 'lajang', '', '', 'tidak'),
(279, '0279', 'ANDIKA BAGUS KUNCORO', 5, 2, 'kontrak', 'Purworejo', '2001-08-17', 'Ular', 'Leo', 'Jumat Kliwon', 'L', 'SMK', 'Otomotif', NULL, 'ISLAM', 'Kaliduren, Kebonharjo, Samigaluh, Kulon Progo', 'Kaliduren, Kebonharjo, Samigaluh, Kulon Progo', '0812 2738 1834', '', '3401 1117 0801 0001', NULL, NULL, NULL, '2024-03-18', '2024-07-19', '2024-07-15', 3, 0, 0, 'andikabagus101@gmail.com', NULL, '', 'menikah', 'WINDA AYU P', '', 'tidak'),
(280, '0280', 'NURRINDRA ADIGUNA SYAHPUTRA', 5, 2, 'kontrak', 'Gunungkidul', '2000-06-07', 'Naga', 'Gemini', 'Rabu Wage', 'L', 'SMK', 'Teknik Fabrikasi Listrik', 'AB', 'ISLAM', 'Bintaran Kulon RT 01 Srimulyo, Piyungan, Bantul, Yogyakarta', 'Bintaran Kulon RT 01 Srimulyo, Piyungan, Bantul, Yogyakarta', '0896 7448 1331', '', '3403 0107 0600 0001', NULL, NULL, NULL, '2024-03-18', '2024-07-19', '2024-07-20', 3, 0, 0, 'nurrindrasyah@gmail.com', NULL, '', 'lajang', '', '', 'tidak'),
(281, '0281', 'DEDI PURNOMO', 5, 2, 'kontrak', 'Klaten', '1998-03-17', 'Macan', 'Pisces', 'Selasa Legi', 'L', 'SMK', 'Otomotif', 'O', 'ISLAM', 'Borongan RT 001 RW 001 Tlogo, Prambanan', 'Borongan RT 001 RW 001 Tlogo, Prambanan', '0896 6544 9408', '', '3310 0117 0398 0002', NULL, NULL, NULL, '2024-03-18', '2024-11-20', NULL, 3, 3, 0, 'dpurnomo0838@gmail.com', 'SUMARNI', '', 'lajang', '', '', 'aktif'),
(282, '0282', 'DESY PURNAMASARI', 5, 16, 'kontrak', 'Pamekasan', '1994-12-16', 'Anjing', 'Sagittarius', 'Jumat Wage', 'P', 'SMK', 'Tata Boga', NULL, 'ISLAM', 'Jalan P. Trunojoyo VII RT 05 RW 03 Kel. Patemon, Kec. Pamekasan', 'Jalan P. Trunojoyo VII RT 05 RW 03 Kel. Patemon, Kec. Pamekasan', '0877 5957 3198', '', '3528 0456 1294 0003', NULL, NULL, NULL, '2024-03-18', '2024-09-19', NULL, 3, 0, 0, '', NULL, '', 'cerai hidup', '', '', 'aktif'),
(283, '0283', 'IVANA', 5, 16, 'kontrak', 'Probolinggo', '1981-03-20', 'Ayam', 'Pisces', 'Jumat Kliwon', 'P', 'D3', 'Desain Grafis', NULL, 'ISLAM', 'Jalan KH. Abdul Azis RT 01 RW 07 Kel. Kebonsari Kulon, Kec. Kanigaran, Kota Probolinggo', 'Jalan KH. Abdul Azis No. 90 Probolinggo', '0822 4444 6114', '3574 0406 0521 0005', '3574 0460 0381 0007', NULL, NULL, NULL, '2024-03-18', '2025-06-19', NULL, 12, 0, 0, '', NULL, '', 'cerai hidup', '', '', 'aktif'),
(284, '0284', 'ADI HIDAYAT', 5, 6, 'kontrak', 'Gunungkidul', '2000-03-06', 'Naga', 'Pisces', 'Senin Legi', 'L', 'SMK', 'Elektronika Industri', 'B', 'ISLAM', 'Karangnongko RT 05 RW 03 Kemiri, Tanjungsari, Gunungkidul, Yogyakarta', 'Karangnongko RT 05 RW 03 Kemiri, Tanjungsari, Gunungkidul, Yogyakarta', '0822 2316 3647', '', '3403 1706 0300 0001', NULL, NULL, NULL, '2024-03-20', '2025-06-21', NULL, 12, 0, 0, 'adihidayat238@gmail.com', 'SUTIRAH', '', 'lajang', '', '', 'aktif'),
(285, '0285', 'MUHAMMAD TEGAR HERAWAN', 5, 6, 'kontrak', 'Yogyakarta', '2002-06-01', 'Kuda', 'Gemini', 'Sabtu Pon', 'L', 'SMK', 'Teknik Listrik', NULL, 'ISLAM', 'Gedongkiwo MJ I/1160 RT 62 RW 12 Mantrijeron, Yogyakarta', 'Gedongkiwo MJ I/1160 RT 62 RW 12 Mantrijeron, Yogyakarta', '0895 2822 5156', '', '3471 0801 0602 0001', NULL, NULL, NULL, '2024-03-20', '2025-06-21', NULL, 12, 0, 0, 'tegarherawan1@gmail.com', 'EKA SULISTIYANA', '', 'lajang', '', '', 'aktif'),
(286, '0286', 'SAADATUD DAROIN', 5, 16, 'kontrak', 'Sampang', '1996-07-05', 'Tikus', 'Cancer', 'Jumat Legi', 'P', 'MA', NULL, 'A', 'ISLAM', 'Dsn. Krampon Timur, Kec. Torjun, Kab. Sampang', 'Dsn. Krampon Timur, Kec. Torjun, Kab. Sampang', '0877 2329 9843', '3527 0227 0923 0003', '3527 0256 0694 0001', NULL, NULL, NULL, '2024-03-23', '2024-09-24', NULL, 3, 0, 0, 'daroinsaadatud6@gmail.com', NULL, '', 'cerai hidup', '', '', 'aktif'),
(287, '0287', 'MUHAMMAD VITRA ABDILLAH', 5, 2, 'kontrak', 'Jombang', '1995-03-16', 'Babi', 'Pisces', 'Kamis Wage', 'L', '', 'Agama', 'O', 'ISLAM', 'Ngembeh RT 05 RW 07 Ngumpul, Jogoroto, Jombang', 'Warak, Mlati, Sleman', '0882 3215 6219', '', '3517 1916 0395 0002', NULL, NULL, NULL, '2024-04-01', '2024-10-27', '2024-07-18', 3, 0, 0, 'vitramuhammad95@gmail.com', NULL, '', 'menikah', 'FINDY DIAH', '', 'tidak'),
(288, '0288', 'CAHYA SAPUTRO', 5, 6, 'kontrak', 'Bantul', '1997-01-07', 'Kerbau', 'Capricorn', 'Selasa Pahing', 'L', 'SMK', 'Teknik Instalasi Listrik', 'AB', 'ISLAM', 'Onggopatran, Kebonagung, Imogiri, Bantul', 'Onggopatran, Kebonagung, Imogiri, Bantul', '0857 9922 5255', '', '3402 1007 0197 0001', NULL, NULL, NULL, '2024-04-02', '2025-07-02', NULL, 12, 0, 0, 'cahyosaputro906@gmail.com', 'WARTINI', '', 'menikah', 'ISLAMITA AYU', 'M. UMAR A.S (10/09/2023)', 'aktif'),
(289, '0289', 'DYAH ANGGRIANI', 5, 16, 'kontrak', 'Tangerang', '1998-07-13', 'Macan', 'Cancer', 'Senin Wage', 'P', 'S1', 'Gizi', NULL, 'ISLAM', 'Kabunan RT 02 RW 15 Widodomartani, Ngemplak', 'Kabunan RT 02 RW 15 Widodomartani, Ngemplak', '0857 1761 9750', '3603 1214 0708 0117', '3603 1253 0798 0001', NULL, '', '', '2024-04-16', '2025-01-17', NULL, 6, 0, 0, 'dyahanggriani68@gmail.com', '', '', 'lajang', '', '', 'aktif'),
(290, '0290', 'AFRI PRASETYO', 5, 16, 'kontrak', 'Surakarta', '1982-04-19', 'Anjing', 'Aries', 'Senin Kliwon', 'L', '', '', 'O', 'ISLAM', 'Jalan Serbaguna Blok Kapling 2 RT 01 RW 04 Adidharma, Gunungjati, Cirebon, Jawa Barat', 'Jalan Serbaguna Blok Kapling 2 RT 01 RW 04 Adidharma, Gunungjati, Cirebon, Jawa Barat', '0812 9338 5064', '3209 2120 0522 0006', '3372 0119 0482 0002', NULL, '', '', '2024-04-16', '2024-10-17', NULL, 3, 0, 0, 'afri.prasetyo2012@gmail.com', '', '', 'menikah', '', '', 'aktif'),
(291, '0291', 'DARMA ADRIEL LELONU', 5, 4, 'kontrak', 'Yogyakarta', '2005-05-02', 'Ayam', 'Taurus', 'Senin Wage', 'L', 'SMK', 'Kimia Industri', 'A', 'KATHOLIK', 'Siyangan, Triharjo, Pandak, Bantul', 'Siyangan, Triharjo, Pandak, Bantul', '0882 3271 1025', '', '3402 0602 0505 0001', NULL, NULL, NULL, '2024-04-16', '2024-08-17', NULL, 3, 0, 0, 'darmaadriellelonu@gmail.com', 'KARIANI', '', 'lajang', '', '', 'aktif'),
(292, '0292', 'GILANG NORMAN AJI', 5, 4, 'kontrak', 'Magelang', '1993-06-20', 'Ayam', 'Gemini', 'Minggu Kliwon', 'L', 'SMK', 'Mesin', NULL, 'ISLAM', 'Selo Merah RT 02 RW 02 Banyudono, Dukun, Magelang', 'Selo Merah RT 02 RW 02 Banyudono, Dukun, Magelang', '0823 3416 9626', '', '3308 0620 0693 0003', NULL, NULL, NULL, '2024-04-16', '2024-08-17', NULL, 3, 0, 0, 'gilangnorman24@gmail.com', NULL, '', 'cerai hidup', '', 'EMIER SHAQUILLE A. (24/05/2018)', 'aktif'),
(293, '0293', 'ELDA PUSPA RUSTANTRI', 5, 16, 'kontrak', 'Banyuwangi', '1993-05-24', 'Ayam', 'Gemini', 'Senin Pon', 'P', 'S1', 'Gizi Klinik', NULL, 'ISLAM', 'Dsn. Bangorejo RT 02 RW 04 Kel. Bangorejo, Kec. Bangorejo', 'Dsn. Bangorejo RT 02 RW 04 Kel. Bangorejo, Kec. Bangorejo', '0852 5971 4826', '3510 0206 1005 2323', '3510 0264 0593 0003', NULL, NULL, NULL, '2024-04-20', '2025-01-20', NULL, 6, 0, 0, 'eldarustan@gmail.com', NULL, '', 'lajang', '', '', 'aktif'),
(294, '0294', 'NOVI INDRAWATI', 5, 16, 'kontrak', 'Sampang', '1994-06-16', 'Anjing', 'Gemini', 'Kamis Legi', 'P', 'SMK', NULL, NULL, 'ISLAM', 'Jalan Imam Ghazali RT 02 RW 01 Kel. Gunung Sekar, Kec. Sampang', 'Jalan Imam Ghazali RT 02 RW 01 Kel. Gunung Sekar, Kec. Sampang', '0823 3813 8247', '3527 0322 1116 0006', '3527 0356 0694 0002', NULL, NULL, NULL, '2024-04-20', '2025-01-20', NULL, 6, 0, 0, 'noviwahyudi09@gmail.com', NULL, '', 'menikah', '', '', 'aktif'),
(295, '0295', 'ELISABET ANGGRAINI', 5, 16, 'kontrak', 'Surabaya', '2000-04-26', 'Naga', 'Taurus', 'Rabu Pahing', 'P', 'D4', 'Gizi', NULL, 'ISLAM', 'Perum Griya Permata Hijau T - 15 RT 03 RW 03 Kel. Wedoroklurak, Kec. Candi', 'Perum Griya Permata Hijau T - 15 RT 03 RW 03 Kel. Wedoroklurak, Kec. Candi', '0896 6806 6572', '3515 0701 0312 0015', '3578 2366 0400 0002', NULL, NULL, NULL, '2024-04-20', '2025-07-20', NULL, 12, 0, 0, 'elisabetanggra@gmail.com', NULL, '', 'lajang', '', '', 'aktif'),
(296, '0296', 'JUANG PERKASA', 5, 3, 'kontrak', 'Malang', '1990-05-20', 'Kuda', 'Taurus', 'Minggu Pon', 'L', 'S1', 'Sistem Informasi', 'A', 'ISLAM', 'Jalan Ahmad Yani, Songgon, Banyuwangi, Jawa Timur', 'Ponjong, Silingi, Gunung Kidul', '0821 3820 7486', '', '3273 1320 0590 0005', NULL, NULL, NULL, '2024-04-22', '2024-08-23', NULL, 3, 0, 0, 'juangperkasa90@gmail.com', 'SETYOWAHYUNINGSIH', '', 'menikah', 'AMETA PUTRI MAULIDA S.', 'AURURA YUKI MIRAI P (28/06/2019), KAI YUTAKA PRASE', 'aktif'),
(297, '0297', 'SUTARI', 5, 7, 'kontrak', 'Gunungkidul', '1991-04-29', 'Kambing', 'Taurus', 'Senin Pahing', 'P', 'SMP', NULL, NULL, 'ISLAM', 'Jonge RT 03 RW 04 Kel. Pacarrejo, Kec. Semanu, Kab. Gunung Kidul, Yogyakarta', 'Jonge RT 03 RW 04 Kel. Pacarrejo, Kec. Semanu, Kab. Gunung Kidul, Yogyakarta', '0856 4055 0409', '3403 0828 1216 0002', '3403 0869 0491 0004', NULL, NULL, NULL, '2024-04-25', '2024-08-26', NULL, 3, 0, 0, 'sutari36@gmail.com', 'MUJINEM', '', 'menikah', 'MUHAMAD HANDOKO', 'MUHAMMAD FAHRI KAIVAN (16/05/2017)', 'aktif'),
(298, '0298', 'GINANJAR ADI WIBOWO', 5, 2, 'kontrak', 'Karanganyar', '1994-06-22', 'Anjing', 'Cancer', 'Rabu Pahing', 'L', 'SMA', 'IPS', 'O', 'ISLAM', 'Sobayan RT 04 RW 12 Kel. Brujul, Kec. Jaten, Kab. Karanganyar', 'Sokomarto RT 04 RW 23 Kel. Donokerto, Kec. Turi, Kab. Sleman, Yogyakarta', '0852 2526 9269', '3313 1124 0723 0001', '3313 1122 0694 0004', NULL, NULL, NULL, '2024-04-29', '2025-01-29', NULL, 6, 0, 0, 'adi.ginan123@gmail.com', 'SRI SUMARNI', '', 'menikah', 'NURUL KHOIRIN ATIFAH', 'MUHAMMAD ALFARIZQI ABYAN WIBIWO (16/01/2024)', 'aktif'),
(299, '0299', 'RAMADHANTI NUR IHSANI', 5, 4, 'kontrak', 'Sleman', '2003-11-09', 'Kambing', 'Scorpio', 'Minggu Wage', 'P', 'SMK', 'Kimia Analisis', 'B', 'ISLAM', 'Jalan Teratai No. 99 RT 04 RW 57 Sambilegi Kidul, Maguwoharjo, Depok, Sleman, DIY', 'Jalan Teratai No. 99 RT 04 RW 57 Sambilegi Kidul, Maguwoharjo, Depok, Sleman, DIY', '0819 0243 8862', '', '3404 0749 1103 0002', NULL, NULL, NULL, '2024-04-29', '2025-01-29', NULL, 6, 0, 0, 'ramadhanti.nurihsani@gmail.com', 'SUPRIYATI NINGSIH', '', 'lajang', '', '', 'aktif'),
(300, '0300', 'DHITO PAWOKO PUTRO', 5, 2, 'kontrak', 'Sleman', '2003-12-14', 'Kambing', 'Sagittarius', 'Minggu Wage', 'L', 'SMK', 'Teknik Sepeda Motor', 'O', 'ISLAM', 'Jogobayan, Sorogenen 1, Purwomartani, Kalasan, Sleman', 'Jogobayan, Sorogenen 1, Purwomartani, Kalasan, Sleman', '0877 9364 4726', '', '3404 1014 1203 0001', NULL, NULL, NULL, '2024-04-29', '2024-07-29', '2024-07-26', 3, 0, 0, 'ditho322@gmail.com', NULL, '', 'lajang', '', '', 'tidak'),
(301, '0301', 'FELLISISTAS DINTA MAHARTIA', 5, 16, 'kontrak', 'Bogor', '2000-01-23', 'Naga', 'Aquarius', 'Minggu Pon', 'P', 'SMA', 'IPA', 'A', 'KATHOLIK', 'Sejati Trukan RT 003 RW 025 Sumberarum, Moyudan', 'Sejati Trukan RT 003 RW 025 Sumberarum, Moyudan', '0823 2955 9890', '3404 0327 0907 0003', '3404 0363 0100 0001', NULL, NULL, NULL, '2024-05-02', '2024-08-02', NULL, 3, 0, 0, 'yeolheng@gmail.com', 'MARIA YOSEPHIN SUMILIH L.', '', 'lajang', '', '', 'aktif'),
(302, '0302', 'HALIMATUS ZEHROH', 5, 16, 'kontrak', 'Bangkalan', '2000-12-13', 'Naga', 'Sagittarius', 'Rabu Pon', 'P', 'S1', NULL, NULL, 'ISLAM', 'Dsn. Bilaporah Barat RT 007 RW 007 Kel. Bilaporah, Kec. Socah', 'Dsn. Bilaporah Barat RT 007 RW 007 Kel. Bilaporah, Kec. Socah', '0823 3846 2799', '', '3526 0253 1200 0001', NULL, NULL, NULL, '2024-05-14', '2024-08-13', NULL, 3, 0, 0, 'halimatuszehroh17@gmail.com', NULL, '', 'lajang', '', '', 'aktif'),
(303, '0303', 'RAIHAN ARIA HAFIZH', 5, 4, 'kontrak', 'Yogyakarta', '2006-11-16', 'Anjing', 'Scorpio', 'Kamis Pahing', 'L', 'SMK', 'Kimia Industri', 'O', 'ISLAM', 'Jogonegaran GT I/838', 'Jogonegaran GT I/838', '0817 6184 72', '', '3372 0616 1106 0008', NULL, NULL, NULL, '2024-05-14', '2024-11-13', NULL, 3, 3, 0, 'raihanaria1234@gmail.com', 'NUR CAHYATI', '', 'lajang', '', '', 'aktif'),
(304, '0304', 'YANUAR PRIMA SYUKRI ALHAMDA', 5, 16, 'kontrak', 'Sleman', '1999-01-28', 'Kelinci', 'Aquarius', 'Kamis Pon', 'L', 'S1', 'Manajemen', 'B', 'ISLAM', 'Karang Malang, Sidomoyo, Godean, Sleman, Yogyakarta', 'Karang Malang, Sidomoyo, Godean, Sleman, Yogyakarta', '0895 6064 91420', '', '3404 0228 0199 0007', NULL, NULL, NULL, '2024-05-17', '2024-11-17', NULL, 6, 0, 0, 'yanuarprimasyukrialhamda@gmail.com', 'KUN SRI MCC (ALMH)', '', 'lajang', '', '', 'aktif'),
(305, '0305', 'DWI AMANDARIS', 5, 2, 'kontrak', 'Gunungkidul', '1989-01-23', 'Ular', 'Aquarius', 'Senin Legi', 'L', 'SMK', 'Otomotif', 'AB', 'ISLAM', 'Ngunut Tengah RT 08 RW 02 Ngunut, Playen, Gunung Kidul', 'Ngunut Tengah RT 08 RW 02 Ngunut, Playen, Gunung Kidul', '0819 0374 9555', '', '3403 0323 0189 0001', NULL, NULL, NULL, '2024-05-18', '2024-11-20', NULL, 3, 3, 0, 'jackyamanda777@gmail.com', NULL, '', 'menikah', 'ARDIYA MUGI L', 'DERA AYU A (15/06/2015), GARDIKA GIGIH P (07/01/20', 'aktif'),
(306, '0306', 'KRISTIANTO RAMADHAN', 5, 2, 'kontrak', 'Jakarta', '1999-01-12', 'Kelinci', 'Capricorn', 'Selasa Pahing', 'L', 'SMK', 'Teknik Pemesinan', NULL, 'ISLAM', 'Banjarsari RT 01 RW 04 Glagaharjo, Cangkringan, Sleman', 'Banjarsari RT 01 RW 04 Glagaharjo, Cangkringan, Sleman', '0882 3330 1744', '3404 1701 0414 0001', '3404 1712 0199 0001', NULL, NULL, NULL, '2024-05-18', '2024-11-18', NULL, 3, 3, 0, 'ramadhankris363@gmail.com', 'SRI HARYANTI', '', 'lajang', '', '', 'aktif'),
(307, '0307', 'ABI LUTFI FADHLURROHMAN', 5, 2, 'kontrak', 'Klaten', '2001-02-01', 'Ular', 'Aquarius', 'Kamis Pon', 'L', 'SMK', 'Teknik Pemesinan', 'AB', 'ISLAM', 'Dk. Pandansari RT 06 RW 03 Ds. Somopuro, Kec. Jogonalan, Kab. Klaten', 'Dk. Pandansari RT 06 RW 03 Ds. Somopuro, Kec. Jogonalan, Kab. Klaten', '0812 3707 3170', '', '310 0801 0201 0002', NULL, NULL, NULL, '2024-05-18', '2024-08-18', '2024-07-29', 3, 0, 0, 'abilutfifadhlurrohman@gmail.com', 'RANTIYEM', '', 'lajang', '', '', 'tidak'),
(308, '0308', 'ARIF SYARIFUDIN', 5, 2, 'kontrak', 'Klaten', '1993-05-02', 'Ayam', 'Taurus', 'Minggu Legi', 'L', 'SMK', 'Listrik', 'O', 'ISLAM', 'Polodadi RT 01 RW 01 Tarubasan, Karanganom, Klaten', 'Polodadi RT 01 RW 01 Tarubasan, Karanganom, Klaten', '0857 1501 9969', '', '3310 1802 0593 0001', NULL, NULL, NULL, '2024-05-20', '2024-11-20', NULL, 3, 3, 0, 'arifudinynwa76@gmail.com', 'TRINI', '', 'lajang', '', '', 'aktif'),
(309, '0309', 'MUHAMMAD DHANI ASRORI', 5, 3, 'kontrak', 'Sleman', '2005-06-05', 'Ayam', 'Gemini', 'Minggu Pon', 'L', 'SMK', 'Kriya Keramik', NULL, 'ISLAM', 'Dondong RT 05 RW 21 Tegaltirto, Berbah, Sleman, Yogyakarta', 'Dondong RT 05 RW 21 Tegaltirto, Berbah, Sleman, Yogyakarta', '0857 0074 3826', '', '3404 0805 0605 0002', NULL, NULL, NULL, '2024-05-20', '2024-09-20', NULL, 3, 0, 0, 'dhaniasrori@gmail.com', 'PURI WIYANTI', '', 'lajang', '', '', 'aktif'),
(310, '0310', 'FAJAR HANDOKO', 5, 2, 'kontrak', 'Klaten', '1995-11-21', 'Babi', 'Scorpio', 'Selasa Wage', 'L', 'SMK', 'Teknik Pemesinan', 'O', 'ISLAM', 'Pule RT 02 RW 07 Pasung, Wedi, Klaten', 'Pule RT 02 RW 07 Pasung, Wedi, Klaten', '0857 0004 4996', '3310 0309 0623 0002', '3310 0321 1195 0001', NULL, NULL, NULL, '2024-05-21', '2024-08-21', NULL, 3, 0, 0, 'fajarhandoko74@gmail.com', 'SULISTYORINI', '', 'menikah', 'RIA FITRIYASARI', '', 'aktif'),
(311, '0311', 'IRFAN ROFIQO AKBAR', 5, 2, 'kontrak', 'Sleman', '2001-12-02', 'Ular', 'Sagittarius', 'Minggu Pahing', 'L', 'D3', 'Teknik Pemesinan', NULL, 'ISLAM', 'Ngaglik RT 04 RW 49 Caturharjo, Sleman, Yogyakarta', 'Ngaglik RT 04 RW 49 Caturharjo, Sleman, Yogyakarta', '0838 2257 1953', '', '', NULL, NULL, NULL, '2024-05-21', '2024-08-21', NULL, 3, 0, 0, 'irfanfiqo@gmail.com', 'SITI UDININGSIH', '', 'lajang', '', '', 'aktif'),
(312, '0312', 'RIZKA FATMA BAUW', 5, 16, 'kontrak', 'Kediri', '1988-06-03', 'Naga', 'Gemini', 'Jumat Pahing', 'P', 'SMA', NULL, 'AB', 'ISLAM', 'Jalan Gang Dahlia 3 RT 024 RW 003 Dlopo, Kediri', 'Jalan Gang Dahlia 3 RT 024 RW 003 Dlopo, Kediri', '0812 3348 4329', '9205 1822 0611 0003', '9205 1843 0688 0001', NULL, NULL, NULL, '2024-05-22', '2024-08-22', NULL, 3, 0, 0, '', NULL, '', 'menikah', '', '', 'aktif'),
(313, '0313', 'HASAN PAMBUDI', 5, 2, 'kontrak', 'Sleman', '1992-06-06', 'Monyet', 'Gemini', 'Sabtu Legi', 'L', 'SMK', 'Elektro Industri', 'O', 'ISLAM', 'Mancasan Tundan RT 03 RW 02 Purwomartani, Kalasan, Sleman', 'Mancasan Tundan RT 03 RW 02 Purwomartani, Kalasan, Sleman', '0895 6058 17181', '', '3404 1006 0692 0002', NULL, NULL, NULL, '2024-06-03', '2024-09-03', NULL, 3, 0, 0, 'hasanpambudi@gmail.com', 'SRI SULASIKI', '', 'menikah', 'IRMA WIDIAWATI', 'ZANNA A.R (30/07/2020)', 'aktif'),
(314, '0314', 'ADI SAPUTRO', 5, 2, 'kontrak', 'Klaten', '1998-05-12', 'Macan', 'Taurus', 'Selasa Pahing', 'L', 'SMK', 'Teknik Kendaraan Ringan', NULL, 'ISLAM', 'Karangasem RT 04 RW 02 Lawas, Klaten', 'Karangasem RT 04 RW 02 Lawas, Klaten', '0878 1791 0146', '', '3310 0512 0598 0002', NULL, NULL, NULL, '2024-06-03', '2024-09-03', NULL, 3, 0, 0, 'adisptr01@gmail.com', 'WARSINI', '', 'lajang', '', '', 'aktif'),
(315, '0315', 'ANISA', 5, 16, 'kontrak', 'Jedah', '2001-08-09', 'Ular', 'Leo', 'Kamis Pahing', 'P', 'S1', 'Gizi', 'B', 'ISLAM', 'Adiwerna RT 001 RW 002 Adiwerna, Tegal, Jawa Tengah', 'Adiwerna RT 001 RW 002 Adiwerna, Tegal, Jawa Tengah', '0895 6354 07859', '3328 1124 0523 0009', '3328 1149 0801 0006', NULL, NULL, NULL, '2024-06-05', '2024-09-05', NULL, 3, 0, 0, 'anisaunr.009@gmail.com', 'NUR INAYAH', '', 'lajang', '', '', 'aktif'),
(316, '0316', 'FAUZIAH AYU SULISTIOWATI', 5, 16, 'kontrak', 'Malang', '1996-03-27', 'Tikus', 'Aries', 'Rabu Legi', 'P', 'S1', NULL, NULL, 'ISLAM', 'Jalan Welirang Gg Pande No. 91 Kepanjen, Kab. Malang', 'Jalan Welirang Gg Pande No. 91 Kepanjen, Kab. Malang', '0812 1668 1815', '3507 1322 0605 0002', '3507 1367 0396 0002', NULL, NULL, NULL, '2024-06-10', '2024-09-10', NULL, 3, 0, 0, 'fauziahayu24@gmail.com', 'DEWI KUSUMAWATI', '', 'lajang', '', '', 'aktif'),
(317, '0317', 'M. ADAM ROSIES', 5, 8, 'kontrak', 'Sukabumi', '1999-02-20', 'Kelinci', 'Pisces', 'Sabtu Legi', 'L', 'S1', 'Psikologi', 'O', 'ISLAM', 'Dusun Manis, Desa Mertapada Kulon, Kec. Astana Japura, Kab. Cirebon', 'Gang Bima, Pugeran, Maguwoharjo, Sleman', '0896 9597 7199', '', '3209 1021 0299 0010', NULL, NULL, NULL, '2024-06-12', NULL, NULL, NULL, 0, 0, 'adam87367@gmail.com', 'YENI SUNDAYANI', '', 'lajang', '', '', 'aktif'),
(318, '0318', 'IFAN ADIPUTRA DOFANDIKA', 5, 13, 'kontrak', 'Sleman', '2004-03-27', 'Monyet', 'Aries', 'Sabtu Pon', 'L', 'SMK', 'DPIB', 'A', 'ISLAM', 'Gamping Lor RT. 05 RW. 12 Ambarketawang, Gamping', 'Gamping Lor RT. 05 RW. 12 Ambarketawang, Gamping', '0857 8697 3746', '', '3404 0127 0304 0001', NULL, NULL, NULL, '2024-06-18', '2024-09-18', NULL, 3, 0, 0, 'dovandika@gmail.com', 'YANI SRI HARTINI', '', 'lajang', '', '', 'aktif'),
(319, '0319', 'RADEN MUHAMMAD ISMOYOJATI', 5, 6, 'kontrak', 'Bogor', '1997-05-13', 'Kerbau', 'Taurus', 'Selasa Pon', 'L', 'SMK', 'Teknik Mesin', NULL, 'ISLAM', 'Lodoyong, Lumbungrejo, Tempel, Sleman', 'Jurugan, Bangunkerto, Turi, Sleman', '0813 2718 1753', '', '3404 1413 0597 0003', NULL, NULL, NULL, '2024-06-25', '2024-09-25', NULL, 3, 0, 0, 'radenjati7@gmail.com', 'SRI SULASTRI', '', 'lajang', '', '', 'aktif'),
(320, '0320', 'AUZI PUTRA ARJUNA', 5, 6, 'kontrak', 'Sleman', '2006-06-07', 'Anjing', 'Gemini', 'Rabu Kliwon', 'L', 'SMK', 'Teknik Listrik', NULL, 'ISLAM', 'Tegalrejo, Sumbersari, Moyudan, Sleman', 'Tegalrejo, Sumbersari, Moyudan, Sleman', '0882 3703 5390', '', '3404 0307 0606 0001', NULL, NULL, NULL, '2024-06-25', '2024-09-25', NULL, 3, 0, 0, 'auziputra7@gmail.com', 'IKA SUWARNI', '', 'lajang', '', '', 'aktif');
INSERT INTO `tbl_pegawai` (`id_pegawai`, `nip`, `nama_pegawai`, `jabatan_id`, `divisi_id`, `status_pegawai`, `tempat_lahir`, `tgl_lahir`, `shio`, `zodiak`, `weton`, `jenis_kelamin`, `pendidikan_terakhir`, `jurusan`, `golongan_darah`, `agama`, `alamat_ktp`, `alamat_domisili`, `kontak_pegawai`, `no_kk`, `no_ktp`, `no_jamsostek`, `no_bpjsKesehatan`, `no_npwp`, `tgl_masuk`, `tgl_selesai`, `tgl_keluar`, `durasi_kontrak`, `kuota_cuti`, `sisa_cuti`, `email_pegawai`, `nama_ibu`, `nama_ayah`, `status_pernikahan`, `nama_pasangan`, `nama_anak`, `status`) VALUES
(321, '0321', 'FATHONI NUR PRATIWI', 5, 15, 'kontrak', 'Sleman', '2000-07-16', 'Naga', 'Cancer', 'Minggu Pon', 'P', 'S1', 'Manajemen Pemasaran', NULL, 'ISLAM', 'Karangmojo, Purwomartani, Kalasan, Sleman, Yogyakarta', 'Karangmojo, Purwomartani, Kalasan, Sleman, Yogyakarta', '0897 2061 239', '', '3404 1056 0700 0001', NULL, '', '', '2024-06-26', '2024-09-26', NULL, 3, 0, 0, 'fathoninurpratiwi6@gmail.com', 'SAMI ASIH', '', 'lajang', '', '', 'aktif'),
(322, '0322', 'YANI FEBRIANI', 5, 16, 'kontrak', 'Kota Cirebon', '1989-02-16', 'Ular', 'Aquarius', 'Kamis Kliwon', 'P', 'SMA', NULL, NULL, 'ISLAM', 'Jalan Mayor Sastraatmaja Gg Garuda RT 004 RW 005 Kesepuhan, Lemah Wungkuk, Kota Cirebon', 'Jalan Mayor Sastraatmaja Gg Garuda RT 004 RW 005 Kesepuhan, Lemah Wungkuk, Kota Cirebon', '0857 9831 6821', '3274 0210 0609 0006', '3274 0256 0289 0007', NULL, NULL, NULL, '2024-07-15', '2024-10-15', NULL, 3, 0, 0, 'febrianiyani5@gmail.com', 'TITIN SUNITI', '', 'menikah', 'SARIFUDIN', '', 'aktif'),
(323, '0323', 'ARWAN NURYANTO', 5, 7, 'kontrak', 'Klaten', '1987-03-10', 'Kelinci', 'Pisces', 'Selasa Legi', 'L', 'SMK', 'Otomotif', 'O', 'ISLAM', 'Karangjono RT 13/07, Tanjungan, Wedi, Klaten', 'Karangjono RT 13/07, Tanjungan, Wedi, Klaten', '0857 4326 4091', '', '3310 0310 0387 0003', NULL, '', '', '0000-00-00', '2024-10-17', NULL, NULL, 0, 0, 'arwan89@gmail.com', 'LAGIYEM', '', 'menikah', 'ANDARINI', 'AULIA PUTRI AZZAHRA (12/05/2013) CARLISA FITRIA TS', 'aktif'),
(324, '0324', 'BAGAS PUTRANTO', 4, 3, 'kontrak', 'Gunungkidul', '1998-05-28', 'Macan', 'Gemini', 'Kamis Pon', 'L', 'D3', 'Teknik Industri', 'O', 'ISLAM', 'Kwarasan Tengah RT 01 RW 02 Kedungkeris, Nglipar, Gunungkidul, Yogyakarta', 'Kwarasan Tengah RT 01 RW 02 Kedungkeris, Nglipar, Gunungkidul, Yogyakarta', '0818 0490 2543', '3403 0201 1122 0001', '3403 0328 0598 0003', NULL, NULL, NULL, '2024-07-22', '2024-10-22', '2024-08-06', 3, 0, 0, 'bagas.putranto1@gmail.com', 'NANIK EKO SISWANTI (ALMH)', '', 'MENIKAH', 'HELISA PRATIWI', 'FARRAZ SAGARA MAKAYASA (26/10/2023)', 'tidak'),
(325, '0325', 'MIRA ARUMSARI', 5, 16, 'kontrak', 'Kudus', '1989-06-15', 'Ular', 'Gemini', 'Kamis Wage', 'P', 'D3', NULL, NULL, 'ISLAM', 'Mlati Sawahan No. 148 RT 004 RW 005 Mlati Lor, Kota Kudus', 'Mlati Sawahan No. 148 RT 004 RW 005 Mlati Lor, Kota Kudus', '0817 7415 1224', '', '3319 0255 0689 0005', NULL, NULL, NULL, '2024-07-22', '2024-10-22', NULL, 3, 0, 0, '', NULL, '', '', '', '', 'tidak'),
(326, '0326', 'EKA WIDYASARI', 5, 16, 'kontrak', 'Surabaya', '1992-11-21', 'Monyet', 'Scorpio', 'Sabtu Wage', 'P', 'SMK', 'Administrasi Perkantoran', NULL, 'ISLAM', 'Pulosari 3K/83 RT 002 RW 007 Gunungsari, Dukuh Pakis', 'Pulosari 3K/83 RT 002 RW 007 Gunungsari, Dukuh Pakis', '0857 2150 9748', '3578 2117 1017 0002', '3578 1661 1194 0011', NULL, NULL, NULL, '2024-07-22', '2024-10-22', NULL, 3, 0, 0, 'ewidyasari13@gmail.com', NULL, '', 'menikah', '', '', 'aktif'),
(328, '0327', 'AHMAD SURYAWAN', 5, 16, 'kontrak', 'Kendal', '1986-09-05', 'Macan', 'Virgo', 'Jumat Kliwon', 'L', '-', '-', '--', 'ISLAM', 'Perum Puri Indah Tampingan 2 Blok J No 4 RT 008 RW 002 Tampingan, Boja, Kendal, Jawa Tengah', 'Perum Puri Indah Tampingan 2 Blok J No 4 RT 008 RW 002 Tampingan, Boja, Kendal, Jawa Tengah', '0813 9021 1229', '3324 0710 0816 0001', '3324 0705 0986 0004', NULL, '', '', '2024-08-01', '2024-11-01', NULL, 3, 3, 0, 'ahmadsuryawan229@gmail.com', 'SUPARMI', 'ROMDHON', 'menikah', 'NUR ASIYAH', 'MUHAMMAD ALFARIDZI (12/02/2009), AZZAM RIZKY MAULA', 'aktif'),
(329, '0328', 'YAN BASTIAN', 5, 16, 'kontrak', 'Kulon Progo', '2000-01-20', 'Naga', 'Capricorn', 'Kamis Kliwon', 'L', 'SMK', 'Nautika', 'B', 'ISLAM', 'Pedukuhan II Pleret RT 008 RW 004 Pleret, Panjatan, Kulon Progo', 'Pedukuhan II Pleret RT 008 RW 004 Pleret, Panjatan, Kulon Progo', '0856 4121 8588', '', '3401 0320 0100 0001', NULL, '', '', '2024-08-01', '1970-01-01', NULL, 0, 0, 0, 'yanbastian514@gmail.com', 'SURATIYEM', 'JOHANSYAH (ALM)', 'lajang', '', '', 'aktif'),
(330, '0329', 'SLAMET DAROENI', 5, 16, 'kontrak', 'Banyumas', '1985-09-09', 'Kerbau', 'Virgo', 'Senin Wage', 'L', '-', '-', NULL, 'ISLAM', 'Kutasari RT 003 RW 004 Kutasari, Baturraden', 'Kutasari RT 003 RW 004 Kutasari, Baturraden', '0853 2700 2724', '3302 2205 0315 0003', '3302 2209 0985 0005', NULL, '', '', '2024-08-07', '2024-11-06', NULL, 3, 0, 0, 'zie.daroeni@gmail.com', 'RATMI', 'SUKIMAN', 'menikah', 'DWI RETNONINGSIH', 'AISYAH NUHA ZAHIRA (07/04/2015), MUHAMMAD LUTHFAN ', 'aktif'),
(331, '0330', 'SITI MARDIANA', 5, 5, 'kontrak', 'Sri Budaya', '1996-12-05', 'Tikus', 'Sagittarius', 'Kamis Wage', 'P', 'S1', 'Biologi', 'A', 'ISLAM', 'Dusun Mekar Harapan, Sri Budaya, Kec. Way Seputih, Kab. Lampung Tengah, Lampung', 'Jalan Wijayakusuma, Patran, Banyuraden, Gamping, Sleman, Yogyakarta', '0813 6964 3316', '', '1802 2545 1296 0001', NULL, '', '', '2024-08-13', '2024-11-12', NULL, 0, 0, 0, 'sitimardianasuwadi@gmail.com', 'MUAWANAH', 'RURI SUWADI', 'menikah', 'SETO KURNIAWAN', '', 'aktif'),
(332, '0331', 'AIR RISTYA WAHYU MULIA', 5, 16, 'kontrak', 'Klaten', '2000-02-27', 'Naga', 'Pisces', 'Minggu Pon', 'P', 'S1', 'Gizi', 'A', 'KATHOLIK', 'Semangkak RT 02 RW 03 Semangkak, Klaten Tengah, Klaten', 'Semangkak RT 02 RW 03 Semangkak, Klaten Tengah, Klaten', '0858 7697 0365', '', '3310 2567 0200 0001', NULL, '', '', '2024-08-13', '1970-01-01', NULL, 0, 0, 0, 'airristya@gmail.com', 'SULISTYAWATI. K', 'PARISTANTA', 'lajang', '', '', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penanganan_barang`
--

CREATE TABLE `tbl_penanganan_barang` (
  `id_penanganan_barang` int(11) NOT NULL,
  `kerusakan_barang_id` int(11) NOT NULL,
  `tgl_penanganan` date NOT NULL,
  `keterangan_penanganan` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penanganan_ruangan`
--

CREATE TABLE `tbl_penanganan_ruangan` (
  `id_penanganan_ruangan` int(11) NOT NULL,
  `kerusakan_ruangan_id` int(11) NOT NULL,
  `tgl_penanganan` date NOT NULL,
  `keterangan_penanganan` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengirimanpaket`
--

CREATE TABLE `tbl_pengirimanpaket` (
  `id_paket` int(11) NOT NULL,
  `tgl_kirim` date NOT NULL,
  `tgl_diterima` datetime DEFAULT NULL,
  `pengirim_id` int(11) NOT NULL,
  `deskripsi_paket` varchar(255) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `alamat_penerima` varchar(255) NOT NULL,
  `ekspedisi` varchar(255) NOT NULL,
  `no_resi` varchar(255) DEFAULT NULL,
  `biaya_kirim` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pengirimanpaket`
--

INSERT INTO `tbl_pengirimanpaket` (`id_paket`, `tgl_kirim`, `tgl_diterima`, `pengirim_id`, `deskripsi_paket`, `nama_penerima`, `alamat_penerima`, `ekspedisi`, `no_resi`, `biaya_kirim`) VALUES
(3, '2024-08-13', '2024-08-19 13:00:25', 129, 'NDA dan pengiriman sampel', 'Alexandro Owen B', 'Jalan Kebon Jeruk Baru Blok B3 No2 , Kec. Kebon Jeruk , Jakarta Barat', 'JNE', '140210001432224', 16000),
(4, '2024-08-12', '2024-08-19 13:00:34', 51, 'Susu', 'Bu Kiki (Kapal Api Global)', 'Jl. Taman Jatibaru Barat No.1, Cideng, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10150', 'JNE YES', '140210008552124', 32000),
(5, '2024-08-13', '2024-08-19 13:00:39', 321, 'Surat Perjanjian Kerja Sama Prambanan Color Run Festival 25 Agustus 2024\r\n(Satu Rangkap)', 'Bapak Adji Hamdi (Destu Andi Fauzi)', 'Jl. Sunan Drajat Nomor C1, Rawamangun, Jakarta Timur 13220', 'JNE REG', '140210008608524', 16000),
(6, '2024-08-13', '2024-08-19 13:00:43', 65, 'Surat Asuransi Umum Bumida', 'Kristianus Siswanto', 'Taman Tekno Blok E.30 Setu, Tangerang Selatan', 'JNE REG', '140210008607624', 18000),
(7, '2024-08-13', '2024-08-19 13:00:47', 129, 'Sampel produk PT Mirugo Hokkaido Indonesia untuk pemeriksaan ke PT SIG', 'PT Saraswanti Indo Genetech', 'Jalan Rasamala No 20 Taman Yasmin, Bogor', 'JNE', '140210008609424', 36000),
(8, '2024-08-20', '2024-08-20 11:39:16', 142, 'DOKUMEN INVOICE KIRIM GIZZI TGL 19 AGUSTUS 2024', 'PT FASTRATA BUANA Up. Ibu Nur bag.Accounting (0858', 'PT FASTRATA BUANA (Jl. Suci No. 75, Susukan, Ciracas, Jakarta Timur)', 'JNE YES', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perawatan_kendaraan`
--

CREATE TABLE `tbl_perawatan_kendaraan` (
  `id_perawatan_kendaraan` int(11) NOT NULL,
  `kendaraan_id` int(11) NOT NULL,
  `tgl_perawatan` datetime NOT NULL,
  `detail_perawatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_perawatan_kendaraan`
--

INSERT INTO `tbl_perawatan_kendaraan` (`id_perawatan_kendaraan`, `kendaraan_id`, `tgl_perawatan`, `detail_perawatan`) VALUES
(1, 1, '2024-03-14 14:09:00', 'ganti oli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perawatan_ruangan`
--

CREATE TABLE `tbl_perawatan_ruangan` (
  `id_perawatan_ruangan` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `tgl_perawatan` datetime NOT NULL,
  `detail_perawatan` varchar(255) NOT NULL,
  `bukti_perawatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_perawatan_ruangan`
--

INSERT INTO `tbl_perawatan_ruangan` (`id_perawatan_ruangan`, `pegawai_id`, `tgl_perawatan`, `detail_perawatan`, `bukti_perawatan`) VALUES
(12, 65, '2024-08-09 16:40:30', '', 'buktiperawatan_1723196430.jpg'),
(13, 65, '2024-08-09 16:40:43', 'Ruang hrga', 'buktiperawatan_1723196443.jpg'),
(14, 65, '2024-08-09 18:07:56', 'Ruang ga', 'buktiperawatan_1723201676.jpg'),
(15, 65, '2024-08-11 15:46:23', 'Membersihkan lantai ruang tamu', 'buktiperawatan_1723365983.jpg'),
(16, 65, '2024-08-11 15:52:57', 'Membersihkan lantai ruang produksi', 'buktiperawatan_1723366377.jpg'),
(17, 188, '2024-08-12 07:07:17', '', 'buktiperawatan_1723421237.jpg'),
(18, 188, '2024-08-12 07:07:43', 'membuka gorden', 'buktiperawatan_1723421263.jpg'),
(19, 188, '2024-08-12 07:08:17', 'membuang sampah yang ada dikantor', 'buktiperawatan_1723421297.jpg'),
(20, 188, '2024-08-12 07:18:51', 'pel ruang general manager (raminten)', 'buktiperawatan_1723421931.jpg'),
(21, 188, '2024-08-12 07:19:12', 'pel ruang hrd', 'buktiperawatan_1723421952.jpg'),
(22, 188, '2024-08-12 07:19:31', 'buang sampah', 'buktiperawatan_1723421971.jpg'),
(23, 188, '2024-08-12 07:30:31', 'Pel area kantor', 'buktiperawatan_1723422631.jpg'),
(24, 188, '2024-08-12 07:30:41', 'Pel area kantor', 'buktiperawatan_1723422641.jpg'),
(25, 188, '2024-08-12 07:31:01', 'Pel area kantor', 'buktiperawatan_1723422661.jpg'),
(26, 188, '2024-08-12 07:35:40', 'Pel lorong kantor', 'buktiperawatan_1723422940.jpg'),
(27, 188, '2024-08-12 07:42:38', 'cadangan air minum galon', 'buktiperawatan_1723423358.jpg'),
(28, 188, '2024-08-12 08:02:51', 'Pel ruang interview', 'buktiperawatan_1723424571.jpg'),
(29, 188, '2024-08-12 08:03:12', 'Pel ruang interview ', 'buktiperawatan_1723424592.jpg'),
(30, 188, '2024-08-12 08:03:33', 'Pel ruang prosteo', 'buktiperawatan_1723424613.jpg'),
(31, 188, '2024-08-12 08:24:32', 'Membuka jendela lorong aula', 'buktiperawatan_1723425872.jpg'),
(32, 188, '2024-08-12 08:25:33', 'Pel lobby kantor', 'buktiperawatan_1723425933.jpg'),
(33, 84, '2024-08-12 08:47:23', 'Sift pagi.. Adinda&chika\nPaking', 'buktiperawatan_1723427243.jpg'),
(34, 84, '2024-08-12 08:47:52', 'Adinda & chika paking', 'buktiperawatan_1723427272.jpg'),
(35, 84, '2024-08-12 08:48:28', 'Adinda & chiska\nPaking', 'buktiperawatan_1723427308.jpg'),
(36, 188, '2024-08-12 10:13:43', 'Menyiram tanaman outdoor', 'buktiperawatan_1723432423.jpg'),
(37, 188, '2024-08-12 10:14:17', 'Membersihkan wastafel kantor', 'buktiperawatan_1723432457.jpg'),
(38, 188, '2024-08-12 10:14:33', 'Membersihkan kamar mandi kantor', 'buktiperawatan_1723432473.jpg'),
(39, 188, '2024-08-12 10:39:04', 'Pel ruang aula', 'buktiperawatan_1723433944.jpg'),
(40, 231, '2024-08-12 13:17:37', 'Membersihkan area dapur belakang. ', 'buktiperawatan_1723443457.jpg'),
(41, 231, '2024-08-12 13:18:38', 'Membersihkan toilet belakang. ', 'buktiperawatan_1723443518.jpg'),
(42, 231, '2024-08-12 13:32:33', 'Membersihakan mushola. ', 'buktiperawatan_1723444353.jpg'),
(43, 231, '2024-08-12 13:32:54', 'Membersihkan toilet mushola . ', 'buktiperawatan_1723444374.jpg'),
(44, 30, '2024-08-12 13:50:50', 'Baju Produksi \nshift 1 Laundry Chiska & Dinda', 'buktiperawatan_1723445450.jpg'),
(45, 30, '2024-08-12 13:51:47', 'Baju proses\nShift 1 Laundry Chiska & Dinda', 'buktiperawatan_1723445507.jpg'),
(46, 30, '2024-08-12 13:58:34', 'Ruang proses (lap handuk, topi masker dan lain-lain)\nShift 1 Laundry Chiska & Dinda', 'buktiperawatan_1723445914.jpg'),
(47, 30, '2024-08-12 13:59:46', 'Ruang proses (plastik untuk kaki)\nShift 1 Laundry Chiska & Dinda', 'buktiperawatan_1723445986.jpg'),
(48, 30, '2024-08-12 14:01:05', 'Ruang proses (jumper)\nShift 1 Laundry Chiska & Dinda', 'buktiperawatan_1723446065.jpg'),
(49, 188, '2024-08-12 14:05:04', 'Membersihkan sawang di area kantor ', 'buktiperawatan_1723446304.jpg'),
(50, 188, '2024-08-12 14:05:46', 'Membersihkan sawang di area kantor ', 'buktiperawatan_1723446346.jpg'),
(51, 188, '2024-08-12 14:06:16', 'Membersihkan sawang di area kantor ', 'buktiperawatan_1723446376.jpg'),
(52, 188, '2024-08-12 14:06:39', 'Membersihkan sawang di area kantor ', 'buktiperawatan_1723446399.jpg'),
(53, 158, '2024-08-12 20:10:40', '', 'buktiperawatan_1723468240.jpg'),
(54, 158, '2024-08-12 20:11:39', 'Shift 2 Loundry \n(udin dan sutari) \nRuang Packing ', 'buktiperawatan_1723468299.jpg'),
(55, 158, '2024-08-12 20:16:22', 'Shift 2 Loundry (udin dan sutari) \nRuang ganti Proses', 'buktiperawatan_1723468582.jpg'),
(56, 158, '2024-08-12 20:17:40', 'Shift 2 Loundry (udin dan sutari) \nStock baju jumper Ruang Proses\n', 'buktiperawatan_1723468660.jpg'),
(57, 158, '2024-08-12 20:18:18', 'Shift 2 Loundry (udin dan sutari) \nStock kain lap dan masker Ruang Proses', 'buktiperawatan_1723468698.jpg'),
(58, 188, '2024-08-13 06:57:20', 'Membuka gorden kantor', 'buktiperawatan_1723507040.jpg'),
(59, 188, '2024-08-13 07:00:04', 'Membuka kunci ruang pontry', 'buktiperawatan_1723507204.jpg'),
(60, 188, '2024-08-13 07:00:30', 'Membuka kunci pintu ruang kantor', 'buktiperawatan_1723507230.jpg'),
(61, 188, '2024-08-13 07:02:25', 'Membuka kunci pintu ruang belakang menuju kantor', 'buktiperawatan_1723507345.jpg'),
(62, 188, '2024-08-13 07:21:07', 'Membersihkan ruang general manager (raminten)', 'buktiperawatan_1723508467.jpg'),
(63, 188, '2024-08-13 07:21:24', 'Membersihkan ruang hrd', 'buktiperawatan_1723508484.jpg'),
(64, 188, '2024-08-13 08:03:51', 'Membersihkan lobby atas', 'buktiperawatan_1723511031.jpg'),
(65, 188, '2024-08-13 08:04:22', 'Membersihkan ruang interview 1', 'buktiperawatan_1723511062.jpg'),
(66, 188, '2024-08-13 08:04:47', 'Membersihkan ruang interview 2', 'buktiperawatan_1723511087.jpg'),
(67, 188, '2024-08-13 09:10:47', 'Menyiram tanaman lobby atas', 'buktiperawatan_1723515047.jpg'),
(68, 188, '2024-08-13 09:19:25', 'Membersihkan wastafel lobby atas', 'buktiperawatan_1723515565.jpg'),
(69, 188, '2024-08-13 09:38:02', 'Membersihkan meja dan kursi lobby atas', 'buktiperawatan_1723516682.jpg'),
(70, 188, '2024-08-13 09:38:41', 'Membersihkan benda benda berdebu di lobby atas', 'buktiperawatan_1723516721.jpg'),
(71, 30, '2024-08-13 11:11:34', 'Pembungkusan sarung tangan\nShift 2 laundry Dinda & Chiska', 'buktiperawatan_1723522294.jpg'),
(72, 158, '2024-08-13 14:22:30', 'Stok baju biru Produksi\nShift 1 (Udin dan Sutari)', 'buktiperawatan_1723533750.jpg'),
(73, 158, '2024-08-13 14:23:42', 'Stok baju Jumper produksi\nShift 1 (Udin dan Sutari)', 'buktiperawatan_1723533822.jpg'),
(74, 158, '2024-08-13 14:24:30', 'Stok masker dan kain lap produksi\nShift 1 (Udin dan Sutari)', 'buktiperawatan_1723533870.jpg'),
(75, 158, '2024-08-13 14:31:56', 'Stok baju biru packing\nShift 1 (Udin dan Sutari)', 'buktiperawatan_1723534316.jpg'),
(76, 158, '2024-08-13 14:31:56', 'Stok baju biru packing\nShift 1 (Udin dan Sutari)', 'buktiperawatan_1723534316.jpg'),
(77, 158, '2024-08-13 14:31:56', 'Stok baju biru packing\nShift 1 (Udin dan Sutari)', 'buktiperawatan_1723534316.jpg'),
(78, 188, '2024-08-13 14:32:21', 'Membersihkan kamar mandi kantor', 'buktiperawatan_1723534341.jpg'),
(79, 188, '2024-08-13 14:32:51', 'Pel ruang aula', 'buktiperawatan_1723534371.jpg'),
(80, 158, '2024-08-13 14:32:59', 'Stock masker dan lap\nShift 1 (Udin dan Sutari)', 'buktiperawatan_1723534379.jpg'),
(81, 158, '2024-08-13 14:33:50', 'Stok kain lap dan masker\nShift 1 (Udin dan Sutari)', 'buktiperawatan_1723534430.jpg'),
(82, 188, '2024-08-13 14:37:30', 'Cadangan air minum galon', 'buktiperawatan_1723534650.jpg'),
(83, 270, '2024-08-13 14:37:48', 'sebelum di pel lorong utara ,shif 2 bakti , mas tri dan mas agus ', 'buktiperawatan_1723534668.jpg'),
(84, 270, '2024-08-13 14:38:11', 'lorong selatan ', 'buktiperawatan_1723534691.jpg'),
(85, 270, '2024-08-13 14:38:18', '', 'buktiperawatan_1723534698.jpg'),
(86, 270, '2024-08-13 14:38:43', '', 'buktiperawatan_1723534723.jpg'),
(87, 270, '2024-08-13 15:06:27', '', 'buktiperawatan_1723536387.jpg'),
(88, 270, '2024-08-13 15:07:02', 'semua ruangan sedah di pel dan di matikan lampu dan ac ', 'buktiperawatan_1723536422.jpg'),
(89, 30, '2024-08-13 16:25:34', 'Baju packing\nShift 2 laundry Dinda & Chiska', 'buktiperawatan_1723541134.jpg'),
(90, 30, '2024-08-13 16:28:10', 'Ruang packing (topi masker)\nShift 2 laundry Dinda & Chiska', 'buktiperawatan_1723541290.jpg'),
(91, 30, '2024-08-13 16:29:37', 'Ruang packing Lab handuk IPC \nShift 2 laundry Chiska & Dinda', 'buktiperawatan_1723541377.jpg'),
(92, 84, '2024-08-13 16:40:31', 'Baju proses \nShift 2 laundry Chiska & Adinda', 'buktiperawatan_1723542031.jpg'),
(93, 84, '2024-08-13 16:41:51', 'Ruang proses (plastik untuk kaki)\nShift 2 laundry Chiska & Adinda', 'buktiperawatan_1723542111.jpg'),
(94, 84, '2024-08-13 16:43:23', 'Ruang proses (jumper)\nShift 2 laundry Chiska & Adinda', 'buktiperawatan_1723542203.jpg'),
(95, 84, '2024-08-13 16:44:22', 'Ruang proses lab handuk, topi masker dan lain-lain\nShift 2 laundry Chiska & Adinda', 'buktiperawatan_1723542262.jpg'),
(96, 188, '2024-08-14 07:15:58', 'Membuka semua pintu di area kantor', 'buktiperawatan_1723594558.jpg'),
(97, 188, '2024-08-14 07:20:15', 'Pel dan membersihkan ruang general manager (raminten)', 'buktiperawatan_1723594815.jpg'),
(98, 188, '2024-08-14 07:23:38', 'Pel dan membersihkan ruang hrd', 'buktiperawatan_1723595018.jpg'),
(99, 270, '2024-08-14 07:25:14', 'membersikan filter ac , bakti,mas agus,mas tri dan mas martin ', 'buktiperawatan_1723595114.jpg'),
(100, 270, '2024-08-14 07:25:39', '', 'buktiperawatan_1723595139.jpg'),
(101, 188, '2024-08-14 07:29:30', 'Membersihkan area kantor', 'buktiperawatan_1723595370.jpg'),
(102, 188, '2024-08-14 07:40:44', 'Pel semua area kantor', 'buktiperawatan_1723596044.jpg'),
(103, 188, '2024-08-14 07:42:46', 'Membuka semua gorden di area kantor', 'buktiperawatan_1723596166.jpg'),
(104, 231, '2024-08-14 07:54:19', 'Membersihkan Ruang Mo. ', 'buktiperawatan_1723596859.jpg'),
(105, 231, '2024-08-14 07:55:12', 'Membersihkan Ruang Dapur. ', 'buktiperawatan_1723596912.jpg'),
(106, 231, '2024-08-14 07:56:16', 'Membersihkan Toilet Belakang. ', 'buktiperawatan_1723596976.jpg'),
(107, 188, '2024-08-14 07:59:03', 'Pel dan membersihkan ruang prosteo', 'buktiperawatan_1723597143.jpg'),
(108, 188, '2024-08-14 08:04:29', 'Pel dan membersihkan ruang interview 1', 'buktiperawatan_1723597469.jpg'),
(109, 188, '2024-08-14 08:04:57', 'Pel dan membersihkan ruang interview 2', 'buktiperawatan_1723597497.jpg'),
(110, 84, '2024-08-14 08:25:59', 'Baju biru proses\nShift 1 Laundry Chiska & adinda', 'buktiperawatan_1723598759.jpg'),
(111, 84, '2024-08-14 08:27:22', 'Baju biru proses & Qc\nShift 1 Laundry Chiska dan Adinda', 'buktiperawatan_1723598842.jpg'),
(112, 84, '2024-08-14 08:27:22', 'Baju biru proses & Qc\nShift 1 Laundry Chiska dan Adinda', 'buktiperawatan_1723598842.jpg'),
(113, 84, '2024-08-14 08:27:22', 'Baju biru proses & Qc\nShift 1 Laundry Chiska dan Adinda', 'buktiperawatan_1723598842.jpg'),
(114, 84, '2024-08-14 08:32:14', 'Ruang produksi (lap handuk, topi, masker dan lain-lain)\nShift 1 Laundry Chiska dan Adinda', 'buktiperawatan_1723599134.jpg'),
(115, 84, '2024-08-14 08:33:08', 'Ruang proses (jumper)\nShift 1 Laundry Chiska dan lain-lain', 'buktiperawatan_1723599188.jpg'),
(116, 270, '2024-08-14 09:10:09', '', 'buktiperawatan_1723601409.jpg'),
(117, 270, '2024-08-14 09:10:39', 'sesudah ', 'buktiperawatan_1723601439.jpg'),
(118, 270, '2024-08-14 09:14:24', 'mengganti keset dan di pel ', 'buktiperawatan_1723601664.jpg'),
(119, 270, '2024-08-14 09:35:13', 'membersikan toilet', 'buktiperawatan_1723602913.jpg'),
(120, 188, '2024-08-14 10:50:00', 'Menyiram tanaman lobby atas', 'buktiperawatan_1723607400.jpg'),
(121, 270, '2024-08-14 10:57:05', 'toilet semua sudah bersih', 'buktiperawatan_1723607825.jpg'),
(122, 270, '2024-08-14 11:05:53', 'semua koridor sudah di pel', 'buktiperawatan_1723608353.jpg'),
(123, 188, '2024-08-14 11:07:06', 'Pel dan membersihkan lobby atas', 'buktiperawatan_1723608426.jpg'),
(124, 188, '2024-08-14 11:42:07', 'Membersihkan dan merapikan meja kursi ruang aula', 'buktiperawatan_1723610527.jpg'),
(125, 34, '2024-08-14 13:14:13', '', 'buktiperawatan_1723616053.jpg'),
(126, 34, '2024-08-14 13:15:20', 'Wastafel ruang antara lab mikro  dan ruang  duabe', 'buktiperawatan_1723616120.jpg'),
(127, 34, '2024-08-14 13:19:35', 'Toilet sebelah barat ruang diabe belum di bersihkan ', 'buktiperawatan_1723616375.jpg'),
(128, 34, '2024-08-14 13:29:47', 'Toilet sebelah barat ruang diabe setelah d bersihkan', 'buktiperawatan_1723616987.jpg'),
(129, 34, '2024-08-14 13:32:07', 'Toilet sebelah lab mikro bawah tangga sebelum di bersihkan ', 'buktiperawatan_1723617127.jpg'),
(130, 34, '2024-08-14 13:40:50', 'Toilet sebelah lab mikro bawah tangga setelah di bersihkan ', 'buktiperawatan_1723617650.jpg'),
(131, 34, '2024-08-14 13:50:45', 'Toilet lab kimia sebelum di bersihkan ', 'buktiperawatan_1723618245.jpg'),
(132, 34, '2024-08-14 13:57:56', 'Toilet sebelah lab kimia setelah d bersihkan ', 'buktiperawatan_1723618676.jpg'),
(133, 30, '2024-08-14 14:26:46', 'Baju biru packing\nShift 1 Laundry Chiska dan Adinda', 'buktiperawatan_1723620406.jpg'),
(134, 30, '2024-08-14 14:27:21', 'Ruang packing topi masker \nShift 1 Laundry Chiska dan Adinda', 'buktiperawatan_1723620441.jpg'),
(135, 30, '2024-08-14 14:27:51', 'Ruang packing lap IPC\nShift 1 Laundry Chiska dan Adinda', 'buktiperawatan_1723620471.jpg'),
(136, 270, '2024-08-14 14:32:47', 'semua ruang produksi sebelum di pel', 'buktiperawatan_1723620767.jpg'),
(137, 188, '2024-08-14 14:54:08', 'Membersihkan kamar mandi kantor pria dan wanita', 'buktiperawatan_1723622048.jpg'),
(138, 188, '2024-08-14 14:54:30', 'Membersihkan wastafel lobby', 'buktiperawatan_1723622070.jpg'),
(139, 188, '2024-08-14 14:55:00', 'Pel ruang aula', 'buktiperawatan_1723622100.jpg'),
(140, 270, '2024-08-14 14:59:43', 'semua ruangan produksi sesudah di pel dan di matikan ac nua ', 'buktiperawatan_1723622383.jpg'),
(141, 270, '2024-08-15 07:25:01', 'sanitadi ruang ganti shift ,bakti,mas martin ,mas tri ', 'buktiperawatan_1723681501.jpg'),
(142, 188, '2024-08-15 07:26:40', 'Pel dan membersihkan ruang hrd', 'buktiperawatan_1723681600.jpg'),
(143, 188, '2024-08-15 07:26:55', 'Pel dan membersihkan ruang raminten', 'buktiperawatan_1723681615.jpg'),
(144, 270, '2024-08-15 07:41:39', 'sudah sanitasi semua nya', 'buktiperawatan_1723682499.jpg'),
(145, 188, '2024-08-15 07:44:33', 'Pel lorong kantor dan area kantor', 'buktiperawatan_1723682673.jpg'),
(146, 30, '2024-08-15 07:50:18', 'Ruang proses (jumper)\nShift 1 Laundry Chiska dan Adinda', 'buktiperawatan_1723683018.jpg'),
(147, 30, '2024-08-15 07:54:38', 'Baju biru proses \nShift 1 Laundry Chiska dan Adinda', 'buktiperawatan_1723683278.jpg'),
(148, 270, '2024-08-15 07:55:56', 'ngepel semua koridor sebelum ', 'buktiperawatan_1723683356.jpg'),
(149, 270, '2024-08-15 07:56:51', 'membersikan semua toilet sebelum', 'buktiperawatan_1723683411.jpg'),
(150, 188, '2024-08-15 08:15:40', 'Isi ulang semportan alkohol di ruang pontry', 'buktiperawatan_1723684540.jpg'),
(151, 188, '2024-08-15 08:16:23', 'Pel dan membersihkan ruang prosteo', 'buktiperawatan_1723684583.jpg'),
(152, 188, '2024-08-15 08:48:06', 'Sampah hasil seluruh area kantor ', 'buktiperawatan_1723686486.jpg'),
(153, 188, '2024-08-15 08:48:43', 'Cadangan air minum galon ', 'buktiperawatan_1723686523.jpg'),
(154, 188, '2024-08-15 09:54:53', 'Menyiram tanaman lobby atas', 'buktiperawatan_1723690493.jpg'),
(155, 188, '2024-08-15 09:58:37', 'Membersihkan wastafel lobby atas ', 'buktiperawatan_1723690717.jpg'),
(156, 270, '2024-08-15 10:19:32', 'toilet semua sesudah ', 'buktiperawatan_1723691972.jpg'),
(157, 270, '2024-08-15 10:19:56', 'koridor semua sesudah ', 'buktiperawatan_1723691996.jpg'),
(158, 158, '2024-08-15 10:23:45', 'Baju packing\nLaundry (Choirudin, Chiska, Adinda)', 'buktiperawatan_1723692225.jpg'),
(159, 158, '2024-08-15 10:25:17', 'Ruang packing (lap handuk IPC)\nLaundry (Choirudin, Chiska, Adinda)', 'buktiperawatan_1723692317.jpg'),
(160, 84, '2024-08-15 10:26:43', 'Ruang packing (topi masker)\nLaundry (Chiska, Adinda, Choirudin)', 'buktiperawatan_1723692403.jpg'),
(161, 188, '2024-08-15 11:03:12', 'Membersihkan dan merapikan benda benda yang ada di lobby atas', 'buktiperawatan_1723694592.jpg'),
(162, 270, '2024-08-15 11:43:27', 'sampah 25 agustus 2024 ,bakti dan mas tri', 'buktiperawatan_1723697007.jpg'),
(163, 270, '2024-08-15 14:37:24', 'ngepel produksi sebelum ,di kerjakan oleh,bakti, mas agus ,mas martin dan mas tri', 'buktiperawatan_1723707444.jpg'),
(164, 188, '2024-08-15 15:06:23', 'Membersihkan figure di ruang aula', 'buktiperawatan_1723709183.jpg'),
(165, 188, '2024-08-15 15:06:35', 'Membersihkan sawang', 'buktiperawatan_1723709195.jpg'),
(166, 270, '2024-08-15 15:09:51', 'ruangan produksi sesudah di pel matikan ac dan lampu ', 'buktiperawatan_1723709391.jpg'),
(167, 84, '2024-08-15 15:17:01', 'Lap topi masker produksi \nLaundry ', 'buktiperawatan_1723709821.jpg'),
(168, 188, '2024-08-16 07:20:18', 'Pel ruang general manager', 'buktiperawatan_1723767618.jpg'),
(169, 188, '2024-08-16 07:20:27', 'Pel ruang hrd', 'buktiperawatan_1723767627.jpg'),
(170, 188, '2024-08-16 07:20:38', 'Pel area kantor', 'buktiperawatan_1723767638.jpg'),
(171, 188, '2024-08-16 07:20:45', 'Pel area kantor', 'buktiperawatan_1723767645.jpg'),
(172, 188, '2024-08-16 07:20:56', 'Pel area kantor', 'buktiperawatan_1723767656.jpg'),
(173, 188, '2024-08-16 07:21:04', 'Pel area kantor', 'buktiperawatan_1723767664.jpg'),
(174, 270, '2024-08-16 07:24:30', 'membersikan vakum ,bakti, mas tri dan mas agus ', 'buktiperawatan_1723767870.jpg'),
(175, 30, '2024-08-16 07:41:43', 'Ruang packing lap Qc\nLaundry Choirudin, Chiska dan Adinda', 'buktiperawatan_1723768903.jpg'),
(176, 30, '2024-08-16 07:42:32', 'Ruang packing topi masker \nLaundry Choirudin, Chiska dan Adinda', 'buktiperawatan_1723768952.jpg'),
(177, 84, '2024-08-16 07:43:50', 'Baju packing\nLaundry Choirudin, Chiska dan Adinda', 'buktiperawatan_1723769030.jpg'),
(178, 158, '2024-08-16 07:59:16', 'Ruang proses (jumper)\nLaundry Choirudin, Chiska dan Adinda', 'buktiperawatan_1723769956.jpg'),
(179, 158, '2024-08-16 08:02:14', 'Ruang proses (lap handuk, topi masker)\nLaundry Choirudin, Chiska dan Adinda', 'buktiperawatan_1723770134.jpg'),
(180, 188, '2024-08-16 08:20:47', 'Pel lobby atas', 'buktiperawatan_1723771247.jpg'),
(181, 188, '2024-08-16 08:55:01', 'Cadangan airi minum galon', 'buktiperawatan_1723773301.jpg'),
(182, 188, '2024-08-16 09:01:55', 'Pel dan membersihkan ruang prosteo', 'buktiperawatan_1723773715.jpg'),
(183, 188, '2024-08-16 09:02:05', 'Pel ruang interview 1', 'buktiperawatan_1723773725.jpg'),
(184, 188, '2024-08-16 09:02:24', 'Pel ruang interview 2', 'buktiperawatan_1723773744.jpg'),
(185, 188, '2024-08-16 09:02:55', 'Menyiram tanaman lobby atas outdoor', 'buktiperawatan_1723773775.jpg'),
(186, 188, '2024-08-16 09:02:55', 'Menyiram tanaman lobby atas outdoor', 'buktiperawatan_1723773775.jpg'),
(187, 188, '2024-08-16 09:03:28', 'Pel dan membersihkan ruang pontry', 'buktiperawatan_1723773808.jpg'),
(188, 188, '2024-08-16 09:03:59', 'Membersihkan wastafel lobby atas', 'buktiperawatan_1723773839.jpg'),
(189, 188, '2024-08-16 09:04:29', 'Membersihkan meja kursi dan benda benda yang berdebu di lobby atas', 'buktiperawatan_1723773869.jpg'),
(190, 188, '2024-08-16 09:05:20', 'Membersihkan kamar mandi pria dan wanita di lobby atas', 'buktiperawatan_1723773920.jpg'),
(191, 270, '2024-08-16 10:07:56', 'mengepel semua koridor luar area peoduksi', 'buktiperawatan_1723777676.jpg'),
(192, 30, '2024-08-16 15:32:56', 'Baju proses\nLaundry Choirudin, Chiska dan Adinda', 'buktiperawatan_1723797176.jpg'),
(193, 84, '2024-08-16 15:36:28', 'Ruang proses lap handuk topi masker dan lain-lain\nLaundry Choirudin, Chiska dan Adinda', 'buktiperawatan_1723797388.jpg'),
(194, 270, '2024-08-19 06:55:10', 'cek suhu pagi ,bakti,mas tri', 'buktiperawatan_1724025310.jpg'),
(195, 188, '2024-08-19 06:58:54', 'Membuka semua pintu yang terkunci di area kantor', 'buktiperawatan_1724025534.jpg'),
(196, 188, '2024-08-19 07:00:52', 'Membuka semua gorden yang tertutup di area kantor', 'buktiperawatan_1724025652.jpg'),
(197, 188, '2024-08-19 07:01:09', 'Pel lorong kantor', 'buktiperawatan_1724025669.jpg'),
(198, 188, '2024-08-19 07:01:16', 'Pel area kantor', 'buktiperawatan_1724025676.jpg'),
(199, 188, '2024-08-19 07:02:12', 'Pel dan membersihkan ruang general manager ', 'buktiperawatan_1724025732.jpg'),
(200, 188, '2024-08-19 07:02:28', 'Pel dan membersihkan ruang hrd ', 'buktiperawatan_1724025748.jpg'),
(201, 188, '2024-08-19 07:02:43', 'Pel area kantor', 'buktiperawatan_1724025763.jpg'),
(202, 188, '2024-08-19 07:02:51', 'Pel area kantor', 'buktiperawatan_1724025771.jpg'),
(203, 188, '2024-08-19 07:02:58', 'Pel area kantor', 'buktiperawatan_1724025778.jpg'),
(204, 188, '2024-08-19 08:26:31', 'Pel dan membersihkan ruang prosteo ', 'buktiperawatan_1724030791.jpg'),
(205, 188, '2024-08-19 08:26:42', 'Pel ruang interview 1', 'buktiperawatan_1724030802.jpg'),
(206, 188, '2024-08-19 08:26:59', 'Pel ruang interview 2', 'buktiperawatan_1724030819.jpg'),
(207, 188, '2024-08-19 08:27:49', 'Menyiram tanaman lobby atas ', 'buktiperawatan_1724030869.jpg'),
(208, 270, '2024-08-19 08:51:52', 'membersihkan semua kamar mandi bakti,mas tri', 'buktiperawatan_1724032312.jpg'),
(209, 188, '2024-08-19 08:54:59', 'Pel lobby atas', 'buktiperawatan_1724032499.jpg'),
(210, 30, '2024-08-19 09:19:17', 'Proses penepungan sarung tangan', 'buktiperawatan_1724033957.jpg'),
(211, 270, '2024-08-19 09:54:42', 'sesudah membersihkan semua toilet ', 'buktiperawatan_1724036082.jpg'),
(212, 270, '2024-08-19 10:05:24', 'membersihkan wastafel', 'buktiperawatan_1724036724.jpg'),
(213, 188, '2024-08-19 10:05:49', 'Membersihkan wastafel ', 'buktiperawatan_1724036749.jpg'),
(214, 270, '2024-08-19 10:05:56', 'membersihkan semua koridor area produksi ', 'buktiperawatan_1724036756.jpg'),
(215, 188, '2024-08-19 10:06:01', 'Mengganti lap tangan', 'buktiperawatan_1724036761.jpg'),
(216, 188, '2024-08-19 10:45:35', 'Cadangan air minum galon', 'buktiperawatan_1724039135.jpg'),
(217, 188, '2024-08-19 10:50:08', 'Isi ulang sabun cuci tangan', 'buktiperawatan_1724039408.jpg'),
(218, 30, '2024-08-19 11:18:12', 'Pembungkusan sarung tangan ', 'buktiperawatan_1724041092.jpg'),
(219, 188, '2024-08-19 14:32:37', 'Membersihkan kamar mandi pria dan wanita', 'buktiperawatan_1724052757.jpg'),
(220, 188, '2024-08-19 15:00:06', 'Pel dan membersihkan ruang aula', 'buktiperawatan_1724054406.jpg'),
(221, 158, '2024-08-19 16:13:27', 'Kain Lap IPC dan Lap tangan Packing', 'buktiperawatan_1724058807.jpg'),
(222, 158, '2024-08-19 16:14:17', 'Topi dan Masker Packing', 'buktiperawatan_1724058857.jpg'),
(223, 297, '2024-08-19 16:15:02', 'Baju Biru packing', 'buktiperawatan_1724058902.jpg'),
(224, 297, '2024-08-19 16:24:37', 'Baju Jumper Produksi', 'buktiperawatan_1724059477.jpg'),
(225, 297, '2024-08-19 16:25:41', 'Kaos Tangan Produksi', 'buktiperawatan_1724059541.jpg'),
(226, 297, '2024-08-19 16:26:07', 'Plastik Produksi', 'buktiperawatan_1724059567.jpg'),
(227, 84, '2024-08-19 16:29:03', 'Kain lap, topi dan masker, kain pel dan kain keset, kain lap tangan', 'buktiperawatan_1724059743.jpg'),
(228, 84, '2024-08-19 16:30:20', 'Baju Biru Produksi', 'buktiperawatan_1724059820.jpg'),
(229, 270, '2024-08-20 06:30:08', 'menghidupkan lampu dan ac bakti dan mas tri', 'buktiperawatan_1724110208.jpg'),
(230, 270, '2024-08-20 06:54:42', 'cek suhu pagi', 'buktiperawatan_1724111682.jpg'),
(231, 188, '2024-08-20 07:00:01', 'Buka semua pintu yang terkunci di area kantor', 'buktiperawatan_1724112001.jpg'),
(232, 188, '2024-08-20 07:00:30', 'Buka semua gorden di area kantor ', 'buktiperawatan_1724112030.jpg'),
(233, 188, '2024-08-20 07:01:47', 'Pel lorong kantor ', 'buktiperawatan_1724112107.jpg'),
(234, 188, '2024-08-20 07:02:03', 'Pel area kantor ', 'buktiperawatan_1724112123.jpg'),
(235, 188, '2024-08-20 07:02:17', 'Pel ruang general manager ', 'buktiperawatan_1724112137.jpg'),
(236, 188, '2024-08-20 07:02:32', 'Pel ruang hrd', 'buktiperawatan_1724112152.jpg'),
(237, 188, '2024-08-20 07:02:39', 'Pel area kantor ', 'buktiperawatan_1724112159.jpg'),
(238, 188, '2024-08-20 07:04:05', 'Pel area kantor ', 'buktiperawatan_1724112245.jpg'),
(239, 188, '2024-08-20 07:04:15', 'Pel area kantor ', 'buktiperawatan_1724112255.jpg'),
(240, 188, '2024-08-20 07:13:02', 'Isi ulang sabun cuci tangan ', 'buktiperawatan_1724112782.jpg'),
(241, 270, '2024-08-20 08:00:31', 'membersikan ac ', 'buktiperawatan_1724115631.jpg'),
(242, 188, '2024-08-20 08:18:27', 'Mneyiram tanaman lobby atas', 'buktiperawatan_1724116707.jpg'),
(243, 188, '2024-08-20 08:18:35', 'Pel lobby atas', 'buktiperawatan_1724116715.jpg'),
(244, 231, '2024-08-20 08:34:49', 'Membersihkan dapur belakang. ', 'buktiperawatan_1724117689.jpg'),
(245, 231, '2024-08-20 08:35:11', 'Membersihkan lorong belakang. ', 'buktiperawatan_1724117711.jpg'),
(246, 231, '2024-08-20 08:35:35', 'Membersihkan toilet belakang . ', 'buktiperawatan_1724117735.jpg'),
(247, 270, '2024-08-20 08:51:32', 'membersikan koridor dan loker packing ', 'buktiperawatan_1724118692.jpg'),
(248, 30, '2024-08-20 09:12:27', 'Pembungkusan sarung tangan', 'buktiperawatan_1724119947.jpg'),
(249, 30, '2024-08-20 10:03:13', 'Proses autoklaf sarung tangan', 'buktiperawatan_1724122993.jpg'),
(250, 297, '2024-08-20 10:37:41', 'Baju biru proses', 'buktiperawatan_1724125061.jpg'),
(251, 297, '2024-08-20 10:39:50', 'Jumper proses produksi', 'buktiperawatan_1724125190.jpg'),
(252, 84, '2024-08-20 10:41:23', 'Ruang proses lap handuk, topi, masker dan lain-lain', 'buktiperawatan_1724125283.jpg'),
(253, 84, '2024-08-20 10:42:07', 'Sarung tangan proses', 'buktiperawatan_1724125327.jpg'),
(254, 84, '2024-08-20 10:43:01', 'Ruang proses (plastik untuk kaki)', 'buktiperawatan_1724125381.jpg'),
(255, 270, '2024-08-20 11:25:38', 'gudang afal mas tri dan bakti', 'buktiperawatan_1724127938.jpg'),
(256, 188, '2024-08-20 13:15:42', 'Membersihkan wastafel ', 'buktiperawatan_1724134542.jpg'),
(257, 188, '2024-08-20 13:16:06', 'Membersihkan dan merapikan benda benda yang ada di lobby atas', 'buktiperawatan_1724134566.jpg'),
(258, 188, '2024-08-20 13:25:08', 'Membersihkan kaca aula', 'buktiperawatan_1724135108.jpg'),
(259, 188, '2024-08-20 13:37:38', 'Cadangan air minum galon ', 'buktiperawatan_1724135858.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perizinan_cuti`
--

CREATE TABLE `tbl_perizinan_cuti` (
  `id_cuti` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `jenis_cuti` enum('tahunan','khusus') NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `pengganti` int(11) NOT NULL,
  `approval` varchar(50) NOT NULL DEFAULT 'N,N,N',
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perizinan_harian`
--

CREATE TABLE `tbl_perizinan_harian` (
  `id_perizinan_harian` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `tgl_izin` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_akhir` time DEFAULT NULL,
  `keperluan` varchar(255) NOT NULL,
  `approval` varchar(50) NOT NULL DEFAULT 'N,N,N',
  `is_read` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perizinan_izin`
--

CREATE TABLE `tbl_perizinan_izin` (
  `id_izin` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `pemberi_izin` int(11) NOT NULL,
  `approval` char(5) NOT NULL DEFAULT 'N,N,N',
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perizinan_tugas`
--

CREATE TABLE `tbl_perizinan_tugas` (
  `id_tugas` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `penugasan_id` int(11) NOT NULL,
  `tgl_tugas` datetime NOT NULL,
  `tgl_kembali` datetime DEFAULT NULL,
  `tempat_tugas` varchar(50) NOT NULL,
  `rincian_tugas` varchar(255) NOT NULL,
  `kendaraan_id` int(11) NOT NULL,
  `approval` varchar(20) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perpanjangan_kontrak`
--

CREATE TABLE `tbl_perpanjangan_kontrak` (
  `id_perpanjangan` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `tgl_kontrak` date NOT NULL,
  `createdBy` int(11) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_perpanjangan_kontrak`
--

INSERT INTO `tbl_perpanjangan_kontrak` (`id_perpanjangan`, `pegawai_id`, `tgl_kontrak`, `createdBy`, `datecreated`) VALUES
(9, 207, '2024-07-10', 44, '2024-08-19 15:06:46'),
(10, 168, '2024-09-06', 44, '2024-08-20 11:06:09'),
(11, 168, '2024-12-06', 44, '2024-08-20 11:06:57'),
(12, 168, '2025-06-06', 44, '2024-08-20 11:07:37'),
(13, 245, '2024-08-03', 44, '2024-08-20 11:34:34'),
(14, 267, '2024-08-04', 44, '2024-08-20 11:36:16'),
(15, 165, '2024-08-07', 44, '2024-08-20 11:42:33'),
(16, 269, '2024-08-08', 44, '2024-08-20 11:44:14'),
(17, 253, '2024-08-10', 44, '2024-08-20 11:45:54'),
(18, 251, '2024-08-10', 44, '2024-08-20 11:47:00'),
(19, 206, '2024-08-12', 44, '2024-08-20 11:48:16'),
(20, 257, '2024-08-12', 44, '2024-08-20 11:50:47'),
(21, 203, '2024-08-12', 44, '2024-08-20 11:51:59'),
(22, 303, '2024-08-13', 44, '2024-08-20 11:53:52'),
(23, 212, '2024-08-13', 44, '2024-08-20 11:54:50'),
(24, 219, '2024-08-14', 44, '2024-08-20 11:56:47'),
(25, 208, '2024-08-13', 44, '2024-08-20 11:58:19'),
(26, 217, '2024-08-14', 44, '2024-08-20 12:00:39'),
(27, 220, '2024-08-14', 44, '2024-08-20 13:05:22'),
(28, 224, '2024-08-14', 44, '2024-08-20 13:07:07'),
(29, 223, '2024-08-14', 44, '2024-08-20 13:08:21'),
(30, 306, '2024-08-18', 44, '2024-08-20 13:10:51'),
(31, 230, '2024-08-18', 44, '2024-08-20 13:12:13'),
(32, 308, '2024-08-20', 44, '2024-08-20 13:13:51'),
(33, 281, '2024-08-20', 44, '2024-08-20 13:15:08'),
(34, 305, '2024-08-20', 44, '2024-08-20 13:16:14'),
(35, 234, '2024-08-26', 44, '2024-08-20 13:18:46'),
(36, 141, '2024-10-03', 44, '2024-08-20 13:37:23'),
(37, 155, '2024-07-17', 44, '2024-08-20 13:43:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pinjam_barang`
--

CREATE TABLE `tbl_pinjam_barang` (
  `id_pinjam_barang` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah_pinjam` int(11) NOT NULL,
  `nama_pinjam_barang` varchar(50) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_kembali` datetime DEFAULT NULL,
  `updateId` int(11) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `status_pinjam_barang` varchar(20) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pinjam_barang`
--

INSERT INTO `tbl_pinjam_barang` (`id_pinjam_barang`, `barang_id`, `jumlah_pinjam`, `nama_pinjam_barang`, `divisi_id`, `tgl_mulai`, `tgl_kembali`, `updateId`, `tgl_update`, `status_pinjam_barang`) VALUES
(40, 2, 1, 'User', 3, '2024-06-04 14:58:29', NULL, NULL, NULL, 'N'),
(41, 2, 1, 'diki', 3, '2024-07-01 10:56:01', NULL, NULL, NULL, 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pinjam_ruangan`
--

CREATE TABLE `tbl_pinjam_ruangan` (
  `id_pinjam_ruangan` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `nama_pinjam_ruangan` varchar(50) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `keterangan_pinjam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pinjam_ruangan`
--

INSERT INTO `tbl_pinjam_ruangan` (`id_pinjam_ruangan`, `ruangan_id`, `nama_pinjam_ruangan`, `divisi_id`, `tgl_mulai`, `tgl_selesai`, `keterangan_pinjam`) VALUES
(1, 14, 'Cahyo', 3, '2024-02-07 09:14:26', '2024-02-08 15:14:26', 'meeting'),
(2, 14, 'kasidi', 3, '2024-02-09 15:48:00', '2024-02-09 16:48:00', 'ada deh'),
(3, 2, 'cahyo', 3, '2024-03-13 12:26:00', '2024-03-14 12:26:00', 'testing'),
(4, 1, 'User', 3, '2024-06-04 13:59:00', '2024-06-04 13:59:00', 'ssss'),
(5, 1, 'User', 3, '2024-06-05 14:10:00', '2024-06-06 14:10:00', 'ssss'),
(6, 1, 'HRGA', 4, '2024-07-02 14:18:00', '2024-07-03 14:18:00', 'tes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` bigint(20) NOT NULL DEFAULT 1,
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Manager'),
(6, 'HRBP'),
(7, 'Admin Pool'),
(8, 'Staff'),
(5, 'HRGA'),
(4, 'Kepala Bagian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ruangan`
--

CREATE TABLE `tbl_ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL,
  `kondisi_ruangan` varchar(50) NOT NULL,
  `keterangan_ruangan` longtext NOT NULL,
  `qrcode_ruangan` varchar(50) NOT NULL,
  `status_ruangan` varchar(50) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_ruangan`
--

INSERT INTO `tbl_ruangan` (`id_ruangan`, `nama_ruangan`, `kondisi_ruangan`, `keterangan_ruangan`, `qrcode_ruangan`, `status_ruangan`, `userId`) VALUES
(1, 'Ruangan Aula', 'baik', '', 'ruangan_1.png', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_satpam_pembelian`
--

CREATE TABLE `tbl_satpam_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_satpam_pembelian`
--

INSERT INTO `tbl_satpam_pembelian` (`id_pembelian`, `jenis`, `jumlah`, `harga`, `tgl_pembelian`) VALUES
(6, 'GALON', 8, 48000, '2024-08-15'),
(8, 'GALON', 6, 36000, '2024-08-19'),
(9, 'GALON', 5, 30000, '2024-08-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_satpam_saldo`
--

CREATE TABLE `tbl_satpam_saldo` (
  `id_saldo` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `sisa_saldo` int(11) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_satpam_saldo`
--

INSERT INTO `tbl_satpam_saldo` (`id_saldo`, `saldo`, `sisa_saldo`, `datecreated`) VALUES
(2, 750000, 566000, '2024-08-14 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `username` varchar(128) NOT NULL COMMENT 'login username',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `nip` varchar(50) NOT NULL,
  `roleId` tinyint(4) NOT NULL,
  `hash_key` varchar(255) DEFAULT NULL,
  `hash_expiry` varchar(255) DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `username`, `password`, `nip`, `roleId`, `hash_key`, `hash_expiry`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'superadmin', '$2y$10$C33Ha5pwn5SwZjFsQQV6KOib7F/wmPlDtuJkl.BbblvcucpAYhYeS', '0113', 1, NULL, NULL, 1, '2024-06-04 12:30:49', 113, '2024-08-19 14:55:12'),
(2, 'agusari', '$2y$10$3WcEJaotjH0Onv9cdo33pOfeDoCmJYCI6oRaEYIG7WW/SLGi3.S26', '0001', 4, NULL, NULL, 1, '2024-08-02 15:43:37', NULL, NULL),
(3, 'welly', '$2y$10$HA8SUMKgKuZbh9fahvOQN.8yqIlPhluEx2ZVIRMZN6Pvgb2ipGaH.', '0002', 8, NULL, NULL, 1, '2024-08-02 15:43:37', NULL, NULL),
(4, 'sidiqpurnomo', '$2y$10$ZnMT7M6gEO0TKH.7zSsgX.CS5JOvPh7ncg199ypfh95P/QGQ2vxbm', '0003', 8, NULL, NULL, 1, '2024-08-02 15:43:37', NULL, NULL),
(5, 'rakhmat', '$2y$10$WrN96AQ8uCJnjvx54a1x5uRFV3ttxQ2wYnRmn56NyiZDKdFmslLfC', '0004', 8, NULL, NULL, 1, '2024-08-02 15:43:37', NULL, NULL),
(6, 'wasno', '$2y$10$mhqmvJKumiUYjRROPzkXxu6zKSCRyvgkApp5b2Jdd3vw028pssRgC', '0005', 7, NULL, NULL, 1, '2024-08-02 15:43:37', NULL, NULL),
(7, 'kristianus', '$2y$10$wbr7KQQxgJQa.CroVZ0ThetMHxYRPaYAbKezz4T62Y0YJb11rHBBy', '0006', 4, NULL, NULL, 1, '2024-08-02 15:43:37', NULL, NULL),
(8, 'bowo', '$2y$10$fCz8.JR1Q18uaovXDTtZ3eVlMXfUy1NYtSLl1gco9qA31JRSMsB4S', '0007', 8, NULL, NULL, 1, '2024-08-02 15:43:37', NULL, NULL),
(9, 'wondo', '$2y$10$OVXHmpzLN7P8oFo.RvUxZO.VjhpgD2Q6fKW.BIhJLMJrcITdtx/Jy', '0008', 8, NULL, NULL, 1, '2024-08-02 15:43:37', NULL, NULL),
(10, 'kurni', '$2y$10$jlB/yi14dqr7j1Qtguu3GeX2vC5iL4r9gSn5qMkFX5yELwH8uLO7q', '0009', 8, NULL, NULL, 1, '2024-08-02 15:43:37', NULL, NULL),
(11, 'hardi', '$2y$10$LSDa8cqjb/fDLwdynLYpZ.N.qDV.K7i1LVeDA/8F0bWDI2hWFThSa', '0010', 8, NULL, NULL, 1, '2024-08-02 15:43:37', NULL, NULL),
(12, 'novianto', '$2y$10$XM.oRS7qs8.x6hA/Vr8CpOfgjqFuRUTgN1SbSm1He6J1gDNr/FaX.', '0011', 8, NULL, NULL, 1, '2024-08-02 15:43:37', NULL, NULL),
(13, 'herry', '$2y$10$nCE/Ux8EfuFI6pLopq9KN.ri2hbqj6vc4if5Y4S/fTJRBjyu4a6E2', '0012', 8, NULL, NULL, 1, '2024-08-02 15:43:38', NULL, NULL),
(14, 'anik', '$2y$10$h9UlgNNHje4AsRwmL/DwaOXMtAxyU2l967KSF9RR1.1vFeC6.Kshm', '0013', 8, NULL, NULL, 1, '2024-08-02 15:43:38', NULL, NULL),
(15, 'larto', '$2y$10$/TIAyoXx6IWnSohSAI2sKe7S93pvd4VyucNaOKdT7PlCYgQ1NVxHu', '0014', 8, NULL, NULL, 1, '2024-08-02 15:43:38', NULL, NULL),
(16, 'wiyono', '$2y$10$K0MUAinaC5IcuNy0OWFroeF7hs7pt04auDQUkFzene.IkJeTlH1YG', '0015', 8, NULL, NULL, 1, '2024-08-02 15:43:38', NULL, NULL),
(17, 'ekopramono', '$2y$10$sMyLL7jHG73BFKBej9CGt.VDQF5CW0/3mBFXCqKISWIuHfWV0.9Pe', '0016', 8, NULL, NULL, 1, '2024-08-02 15:43:38', NULL, NULL),
(18, 'gaus', '$2y$10$c8BMH1O8ozywdpi1vatY..VZbyggfLA74t.fv4.Rq8/fVSeJ1tkVO', '0017', 8, NULL, NULL, 1, '2024-08-02 15:43:38', NULL, NULL),
(19, 'ayuk', '$2y$10$izmGlmT48ihtgVe3xbdnV.BHNd3lTJaszK7eDWLJKyTEL9SHAWEd6', '0018', 8, NULL, NULL, 1, '2024-08-02 15:43:38', 44, '2024-08-08 13:47:50'),
(20, 'tries', '$2y$10$nuWdc4S22aCKyTognZIjD.igJcL1MLvc6nwyNmQEBYbi693VQtoOK', '0019', 4, NULL, NULL, 1, '2024-08-02 15:43:38', NULL, NULL),
(21, 'dwinugroho', '$2y$10$/9oFFlLV7CMAQ1lplMpGO.WWRBVvJxjBk2gBoZg19ukH/xAcm2LnK', '0020', 8, NULL, NULL, 1, '2024-08-02 15:43:38', NULL, NULL),
(22, 'ismanto', '$2y$10$7/xADqbUG.uJ3iDHELGyweUSYpqUhQ/gEZ6XHV.O7J4TAiRUJu4bC', '0021', 8, NULL, NULL, 1, '2024-08-02 15:43:38', NULL, NULL),
(23, 'ahmad', '$2y$10$1RgnqOxxSyLJLuPkBXNqbOH15ohIEnmwvz8HEUX8AVXSa0uz84v6G', '0022', 8, NULL, NULL, 1, '2024-08-02 15:43:38', NULL, NULL),
(24, 'elisabeth', '$2y$10$Hs8uJoYbMit5SpDP0x5TbuCsGJa.UbhVD8uDvoUMHyDS9qV3bdfsK', '0023', 8, NULL, NULL, 1, '2024-08-02 15:43:38', NULL, NULL),
(25, 'danan', '$2y$10$4wR6N4BeIne5fGvewljFD.FiQeT68XIZI3YO73pJvtKvgatG8uSmy', '0024', 8, NULL, NULL, 1, '2024-08-02 15:43:38', 44, '2024-08-15 13:59:44'),
(26, 'made', '$2y$10$mSOEF09aZUOQBh9gIId/OejyuUmEueVWQgftnLW6gP7sCGzkCT0RG', '0025', 8, NULL, NULL, 1, '2024-08-02 15:43:38', NULL, NULL),
(27, 'sulistiyo', '$2y$10$ThfOJgr9aBZiuJcguGxjOeSKkfIcslMkFHrwg23vGT7QZ2luZSEFq', '0026', 8, NULL, NULL, 1, '2024-08-02 15:43:39', NULL, NULL),
(28, 'danangwibowo', '$2y$10$MTiJN5zNPHrYlB7FtwiJyOlWyiSq1RTWoOuUI1MT6TQUMy3EOyMta', '0027', 8, NULL, NULL, 1, '2024-08-02 15:43:39', NULL, NULL),
(29, 'rindi', '$2y$10$FtHlIBl3BCZrKWThpZ6qWOQt2k5SM9GLrab2lYN8PrAsriutQ/Xoa', '0028', 8, NULL, NULL, 1, '2024-08-02 15:43:39', NULL, NULL),
(30, 'adisatya', '$2y$10$YFCATp5QjFOZFHI04Eg2vuZ1/8EcBa0mpRDrOg/ktJYH46EbUV0F6', '0029', 8, NULL, NULL, 1, '2024-08-02 15:43:39', NULL, NULL),
(31, 'dinda', '$2y$10$W5ArFGbrJwgpFmUTactE9.vJjlInh0oFU0IpShP4/U79316o17A7a', '0030', 8, NULL, NULL, 1, '2024-08-02 15:43:39', 44, '2024-08-08 13:46:27'),
(32, 'danangtris', '$2y$10$/KO5SYp/a6nFpA6Pj21H2esrGVK44gOiZUz7jqxqTdVqyXWyrM1uy', '0031', 8, NULL, NULL, 1, '2024-08-02 15:43:39', NULL, NULL),
(33, 'ariprastyo', '$2y$10$hWgVG/XapPAhT/PO5sXDtOcjZHHrq/3v7dKdcSBbkk5GGzVmT5M5m', '0032', 8, NULL, NULL, 1, '2024-08-02 15:43:39', NULL, NULL),
(34, 'ismail', '$2y$10$39zkKrEkhuBVrRPqEKHJeuZrjeR9oBgkyDCKb.AwExhb9rl.fRo.m', '0033', 4, NULL, NULL, 1, '2024-08-02 15:43:39', NULL, NULL),
(35, 'agungapriyanto', '$2y$10$s.bU5.1hgS9Ve1OrKLTMquDqhbe2bLPirb6Xh74RpdanORxTqr8F6', '0034', 8, NULL, NULL, 1, '2024-08-02 15:43:39', NULL, NULL),
(36, 'raharjo', '$2y$10$r3yhgBaxWc.sDLwhKHtAeuTrzHeq9l0zqnYFsoVL6WvEOerbuVuJq', '0035', 8, NULL, NULL, 1, '2024-08-02 15:43:39', 44, '2024-08-08 13:47:09'),
(37, 'bayudwi', '$2y$10$JIN5AisXr6345jfRMZR52.VD7wh8rid7S/Jp5ZQsRpUF8BU5s5p/a', '0036', 8, NULL, NULL, 1, '2024-08-02 15:43:39', NULL, NULL),
(38, 'inez', '$2y$10$V5DS8xroQdXxA7JS0pB/XOEgoT2DgJjVe6/B4IwWJMcr8M8UHTndS', '0037', 8, NULL, NULL, 1, '2024-08-02 15:43:39', NULL, NULL),
(39, 'mujiono', '$2y$10$Tk/7cBN8KpYFd.pIFJm6b.nxMRvqiXOld87bInej65yRwMyrAtmry', '0038', 8, NULL, NULL, 1, '2024-08-02 15:43:39', NULL, NULL),
(40, 'santi', '$2y$10$gQklQ9Sv0QpPgiazH6m7Tu7Z6.ujwzEEfgJvWSW1dUwR8V.dSyYWG', '0039', 8, NULL, NULL, 1, '2024-08-02 15:43:39', NULL, NULL),
(41, 'rina', '$2y$10$htZsV1hlJnFXjKDwVSXM0.NoeIJYWV4VHFIdToP6FueyjDlNSKPZu', '0040', 8, NULL, NULL, 1, '2024-08-02 15:43:40', NULL, NULL),
(42, 'dias', '$2y$10$aSxQzqdw5BGxeLynlrbCau64e9lyAtxE/eG84n0DBgPxIEBwG5mgO', '0041', 8, NULL, NULL, 1, '2024-08-02 15:43:40', NULL, NULL),
(43, 'anggit', '$2y$10$TqPfzbbPoLs9ENtaJy75/..2vXhZf3ikjyBfOykoRLCCN5Nj9VmFW', '0042', 8, NULL, NULL, 1, '2024-08-02 15:43:40', NULL, NULL),
(44, 'agungsumardhany', '$2y$10$66hzTTkvIHS660NgUYlRBO2v4X02eRnCbpsGKVh8vrslGUIOPZrQe', '0043', 8, NULL, NULL, 1, '2024-08-02 15:43:40', NULL, NULL),
(45, 'helmi', '$2y$10$J1AMDAWxmnFv8tDIebAWmeD73bJSwjoJ1T11MTrsX6AMH90AMySLu', '0044', 5, NULL, NULL, 1, '2024-08-02 15:43:40', 44, '2024-08-02 16:11:28'),
(46, 'nurcahyani', '$2y$10$P4U0vbqi3oavrD6JytYau.K2ZDGDHppd2m/POS9YZVxf.9zWyo9L2', '0045', 8, NULL, NULL, 1, '2024-08-02 15:43:40', NULL, NULL),
(47, 'evendi', '$2y$10$N8FSkrmGktacyarOEwlBhue8Z4F3sG438l5Y4./EfCrCwvmB.9yMC', '0046', 8, NULL, NULL, 1, '2024-08-02 15:43:40', NULL, NULL),
(48, 'andriyanto', '$2y$10$cJqyq282dxUjFAO4IANRQu1oRTwEN2vd21PT.CI62jEAVWf/Z/L7y', '0047', 8, NULL, NULL, 1, '2024-08-02 15:43:40', NULL, NULL),
(49, 'rizalmustofa', '$2y$10$YGJ7o.pgMG48nnvY/jPP5uQMvCQ2sUiUw.QaG1D2LFNDYu.FrhtnO', '0048', 8, NULL, NULL, 1, '2024-08-02 15:43:40', NULL, NULL),
(50, 'ekosetyo', '$2y$10$o1zILz0GJaKbEtbfoGxhLuZ5piCWmp10/lr1aq256V8oHvMv.uRga', '0049', 8, NULL, NULL, 1, '2024-08-02 15:43:40', NULL, NULL),
(51, 'aguscahyo', '$2y$10$LxPMh8JcWFicD18LBv1xpu9uZD5S8.mq9EXhazqLd8bOBrcKLJ7LO', '0050', 8, NULL, NULL, 1, '2024-08-02 15:43:40', NULL, NULL),
(52, 'sari', '$2y$10$WxOM6ksg8DiIfr68dd8uYePcTQzk0NOw2W6t6GrwEmqnFAH9VIDcS', '0051', 2, NULL, NULL, 1, '2024-08-02 15:43:40', 44, '2024-08-12 13:18:01'),
(53, 'bayuputra', '$2y$10$jRyD73MEbc7Y3LlSa/TJzulACmyjdA212q3LI137oJMtELCUvveWm', '0052', 8, NULL, NULL, 1, '2024-08-02 15:43:40', NULL, NULL),
(54, 'elly', '$2y$10$124vkSCDy8G1tyF.toMnned0aOFDsUtSdwIBUE8NYJkujmR.eZe/.', '0053', 8, NULL, NULL, 1, '2024-08-02 15:43:40', NULL, NULL),
(55, 'nanang', '$2y$10$Z92ZusI1ShyGtFHsbREaue6iKZgC9OlLFw1DSB5jD.QRPJ07yJjMm', '0054', 8, NULL, NULL, 1, '2024-08-02 15:43:40', NULL, NULL),
(56, 'indrasetiawan', '$2y$10$L2USOpaUcv7ifb3EsmDZYe4XSWn35i68etcLyIClLtS3A0yHzFTM2', '0055', 8, NULL, NULL, 1, '2024-08-02 15:43:41', NULL, NULL),
(57, 'bandi', '$2y$10$SlO9nx9MNfCHGqZgk9fT/.ut/M6eD6lnLtP19okaNoUGlrkF.pNu2', '0056', 8, NULL, NULL, 1, '2024-08-02 15:43:41', 44, '2024-08-08 13:43:35'),
(58, 'rismawati', '$2y$10$NgeTnuNUF3/.K.1sIXDMtusIA0GzuJNQlItvT.75e2/lG492m4xTK', '0057', 8, NULL, NULL, 1, '2024-08-02 15:43:41', NULL, NULL),
(59, 'subi', '$2y$10$FUN0wJhvx2g5epj7O3pqieYvzPGqJ0FmEnAldpHr.9/OKOblL75ci', '0058', 8, NULL, NULL, 1, '2024-08-02 15:43:41', NULL, NULL),
(60, 'fathur', '$2y$10$xuhOcWYwpZ1xgd.TYggvDeUEpLtIobyLTiG.jlpRe5FaDBr5O7noG', '0059', 8, NULL, NULL, 1, '2024-08-02 15:43:41', NULL, NULL),
(61, 'fauzan', '$2y$10$8dAtcvg19zCWh8kVhlpQAukcNfLsdCzTBD.coVAFgYO3barLglyry', '0060', 8, NULL, NULL, 1, '2024-08-02 15:43:41', NULL, NULL),
(62, 'rizkymianti', '$2y$10$zGqLJJ3GiwmnqYMhueIrdOZFFIhmereSKT6OVJyzCK/BwF2VjXxT.', '0061', 8, NULL, NULL, 1, '2024-08-02 15:43:41', NULL, NULL),
(63, 'kasidi', '$2y$10$N336Pd7bLJoGpY0AZm6FKeuANW26yC4S1WErX34GoFpaLRzFV1Ba.', '0062', 8, NULL, NULL, 1, '2024-08-02 15:43:41', NULL, NULL),
(64, 'saroh', '$2y$10$2cpDkDwjJRcJsSl/KNvrv.qomTY3pYshO6XdtEakx.X77Hq2Y7nJW', '0063', 8, NULL, NULL, 1, '2024-08-02 15:43:41', NULL, NULL),
(65, 'dwiamiyantoko', '$2y$10$6YCKPDQNXV/ehpVPu7cQfu0lQyB8WjIUvZ2fDXR5awR7HicWU6xBi', '0064', 8, NULL, NULL, 1, '2024-08-02 15:43:41', NULL, NULL),
(66, 'ado', '$2y$10$w.s2CYeoNZ7inUrwmlJ0S.1RjM.7mhs20WKX7piF3rLjMpnqqDaV.', '0065', 5, NULL, NULL, 1, '2024-08-02 15:43:41', 44, '2024-08-13 16:07:12'),
(67, 'trisutopo', '$2y$10$9ceEym5xH0nJVsT9LMpFpOhsU8boJGV1PRUIFnwW.C6tuMkz7oqR2', '0066', 8, NULL, NULL, 1, '2024-08-02 15:43:41', NULL, NULL),
(68, 'anton', '$2y$10$J3rqYT0oAckvoxAOscTZU.lz/uKuVQeCUHFqL4Wq9bh34cKTn5mC6', '0067', 8, NULL, NULL, 1, '2024-08-02 15:43:41', 44, '2024-08-08 13:41:54'),
(69, 'heri', '$2y$10$zJO2t7S2Ol4/NPThOForBuikzXtexCg5Q4YsVM4JLrU0.qdgOgU4S', '0068', 8, NULL, NULL, 1, '2024-08-02 15:43:41', NULL, NULL),
(70, 'danik', '$2y$10$fMBq3Ins7P5ADcv/SyXOjeK7riB9TjS47Kzoa8AickkrhCDZRi3nW', '0069', 8, NULL, NULL, 1, '2024-08-02 15:43:42', NULL, NULL),
(71, 'imam', '$2y$10$YonDdVI4H7tojrygtRcvbOMms1mqD26BlhtD.SWQjVawv5pO.wvYS', '0070', 8, NULL, NULL, 1, '2024-08-02 15:43:42', NULL, NULL),
(72, 'agusdwi', '$2y$10$CFx9JmbGqRVwWXIxTehWWOvOpggvLGPHNYCfjq6Pdx8CYXaKNOnAi', '0071', 8, NULL, NULL, 1, '2024-08-02 15:43:42', 44, '2024-08-08 13:43:58'),
(73, 'mardiyanto', '$2y$10$rUBwZ2a4FLQrf9gUDAEwsOve2y7nMXLlX7ASPkUII/FBSwIMSfV2S', '0072', 8, NULL, NULL, 1, '2024-08-02 15:43:42', 44, '2024-08-20 13:40:08'),
(74, 'tyas', '$2y$10$8gHgdilkd/.vypsD9x.7Cu6HFg2kzHrmxeoKbEi0uPsWN8mD1VrTS', '0073', 5, NULL, NULL, 1, '2024-08-02 15:43:42', NULL, NULL),
(75, 'enggar', '$2y$10$mvCkIv4sfJLyRsXM3HNFOOq9hqHtivSptxqT8Se8SzVNEttTMOKN2', '0074', 8, NULL, NULL, 1, '2024-08-02 15:43:42', NULL, NULL),
(76, 'agusnugroho', '$2y$10$xK36QjujuuLDy2KSUzmvfOuxei6K5wMsGX18zt7hNZeZlps4kOISy', '0075', 8, NULL, NULL, 1, '2024-08-02 15:43:42', NULL, NULL),
(77, 'andri', '$2y$10$CqZSLOCauOYzkw3.GDEekeEwPTSp/2SU1BdY/QdfvN00BVekXKFxO', '0076', 3, NULL, NULL, 1, '2024-08-02 15:43:42', NULL, NULL),
(78, 'triharyanto', '$2y$10$DuZxCqI3un5Cfz4nyCpdTOCyOZHZB7C6.XPz/QSOURpwNg/Lc3qn.', '0077', 8, NULL, NULL, 1, '2024-08-02 15:43:42', NULL, NULL),
(79, 'widya', '$2y$10$vStIG0frWaUdB0yH9gynQugPl5AQfLKzwRWvnchkRMbjMr6bCOTx6', '0078', 4, NULL, NULL, 1, '2024-08-02 15:43:42', NULL, NULL),
(80, 'mukti', '$2y$10$QHNpzgQYgpVr5szk9x3okO26Npb7B/0Yws29FhtFR3U6Qkp73kUMW', '0079', 8, NULL, NULL, 1, '2024-08-02 15:43:42', 44, '2024-08-08 14:11:03'),
(81, 'emma', '$2y$10$X6lyR3/kNdsMmE8NEpevK.hsO52AA41AymP14/49ucXCMFnESBbp2', '0080', 8, NULL, NULL, 1, '2024-08-02 15:43:42', NULL, NULL),
(82, 'kanang', '$2y$10$jmSTi1LpptcyeGp96lqAN.wbeDlISRmXLxnX2hn4M5q7oWzbRqLQu', '0081', 8, NULL, NULL, 1, '2024-08-02 15:43:42', NULL, NULL),
(83, 'wahyunur', '$2y$10$8fdXZgtEAsv48AbDtxXklO4nSacWakIMotbyrIBQbsqOp/QrYwSlG', '0082', 8, NULL, NULL, 1, '2024-08-02 15:43:42', NULL, NULL),
(84, 'murdianto', '$2y$10$x1SQbNdgCGd/3ep/hisQuui9GAL62/63nxYmPFJmvsj4XglOqQy/.', '0083', 8, NULL, NULL, 1, '2024-08-02 15:43:43', NULL, NULL),
(85, 'chiska', '$2y$10$hDt.pnIDPBZQndC5BCQppelsFx1e5HJ6yxUWiABdXP/c8itqwNKq6', '0084', 8, NULL, NULL, 1, '2024-08-02 15:43:43', NULL, NULL),
(86, 'mukhlis', '$2y$10$tqfcXYEfXKuKWe41GXzc8ui1b8Y5qPPGn3wZEuZWrXvRzATO9pSe6', '0085', 8, NULL, NULL, 1, '2024-08-02 15:43:43', NULL, NULL),
(87, 'cahyo', '$2y$10$1S869lNpQcR5eEhKYh0EHuLYt4EI.GbhESw2m.TCEC9KIjMfkKNw2', '0086', 4, NULL, NULL, 1, '2024-08-02 15:43:43', NULL, NULL),
(88, 'ega', '$2y$10$t37Nku6EL20k3.V959S25.LmFG39csblIxI7nQl0PVWQh2wQ4SIpq', '0087', 8, NULL, NULL, 1, '2024-08-02 15:43:43', NULL, NULL),
(89, 'dikha', '$2y$10$7RE/2Otp2vuXe/e8J2ZtR.vYlD.c0VIV4J0.FL72Lwufqqs9nMeXC', '0088', 4, NULL, NULL, 1, '2024-08-02 15:43:43', NULL, NULL),
(90, 'ademaulana', '$2y$10$G35lOlEeSRjoAvpLyDQyx.e3.d3lj3tZgUeeFqmasOfygKA1eFpci', '0089', 8, NULL, NULL, 1, '2024-08-02 15:43:43', NULL, NULL),
(91, 'adib', '$2y$10$ZL91hMNGiIYhGPTyiTxya..MjugtWnii7mxeoHMHiAHdXkVM0dfHi', '0090', 8, NULL, NULL, 1, '2024-08-02 15:43:43', NULL, NULL),
(92, 'awan', '$2y$10$PneF2eqVrRkagwUZgbSrYeb7nwebN6Y6D8H6.H4aTdzFNhyE2enxi', '0091', 8, NULL, NULL, 1, '2024-08-02 15:43:43', NULL, NULL),
(93, 'eri', '$2y$10$5Bk8aeVasCKwNfQiunGcleb0tT2DTBqPVbSstGQudIrVaGOxROHla', '0092', 8, NULL, NULL, 1, '2024-08-02 15:43:43', NULL, NULL),
(94, 'nurulhakiki', '$2y$10$URVZx6Ki1Ics8wXQ0xa3U.31k2xIrj75JcY5ZdXzFMhVRx7Xy82pG', '0093', 8, NULL, NULL, 1, '2024-08-02 15:43:43', NULL, NULL),
(95, 'sudar', '$2y$10$MS3d3pQiAyE070OfYqIlB.CrmBkibfJZlvirS29Vo4x/mnMnkXTyK', '0094', 8, NULL, NULL, 1, '2024-08-02 15:43:43', 44, '2024-08-08 13:44:24'),
(96, 'fariz', '$2y$10$SYDNO1v6GilGRWvmLZ8Z1eL8RItdFgU929vWozRDyTDpVn4lhScLa', '0095', 8, NULL, NULL, 1, '2024-08-02 15:43:43', NULL, NULL),
(97, 'luluk', '$2y$10$4ucXHf6TBwodUtUDWeT0ku3BytR828C8g0HLCJksunUOeC81oxUbi', '0096', 8, NULL, NULL, 1, '2024-08-02 15:43:43', NULL, NULL),
(98, 'hanif', '$2y$10$QxQV0hj6vi534FdO5xpQX.sBBmTZ.u9hrKnnCWdcxx6LSVCzKItBi', '0097', 8, NULL, NULL, 1, '2024-08-02 15:43:44', NULL, NULL),
(99, 'nuryanti', '$2y$10$kDPitIMlHr.ZQgJ5BMsWNefwTYEdhyiUsI0XMX8Ub3H9ne/xD88O.', '0098', 8, NULL, NULL, 1, '2024-08-02 15:43:44', NULL, NULL),
(100, 'aderestu', '$2y$10$QUfvayTOlETv/C4kC81vouCQ1JdGckpRRHZTAy9/5X2zalI/vISdK', '0099', 8, NULL, NULL, 1, '2024-08-02 15:43:44', NULL, NULL),
(101, 'fajardwi', '$2y$10$UWDjrz.MdbtVKfSGs/EqyOXtisTLVSO042xZ.nq5FY1UlEM6dB0zu', '0100', 8, NULL, NULL, 1, '2024-08-02 15:43:44', NULL, NULL),
(102, 'khusnul', '$2y$10$pzfK1Pey1lYiEPY.dCJdo.5jdBehgO7mGFplVgM2.GRmUi3XCFkYi', '0101', 8, NULL, NULL, 1, '2024-08-02 15:43:44', NULL, NULL),
(103, 'aris', '$2y$10$J2PUSE1m3MolJWyeat7Juu883JlWRFbRWscAiiaupYGK/hfTd1pmu', '0102', 8, NULL, NULL, 1, '2024-08-02 15:43:44', NULL, NULL),
(104, 'fakhmi', '$2y$10$4yu9AUvdW6b7XjH3UmX0aeGzBcdn034OKuuQZMKy68lZr/3t45X06', '0103', 8, NULL, NULL, 1, '2024-08-02 15:43:44', NULL, NULL),
(105, 'agustriyanto', '$2y$10$ulBMjqJrlyluxhh5Ng94tu5cFhk.Bb6m1ax7g4JDWrdHvx/2WZfJ.', '0104', 8, NULL, NULL, 1, '2024-08-02 15:43:44', NULL, NULL),
(106, 'dewikurnia', '$2y$10$LWoqMPuDsjT9VwCY.Y2SWul1evmqvPw7oklo0kXAJQls8tGra9iH2', '0105', 8, NULL, NULL, 1, '2024-08-02 15:43:44', NULL, NULL),
(107, 'johan', '$2y$10$QAMQy7.6OYiHIxzjfafZceMHRUm2lyr4O4W4h84luY6xDCHia7aU6', '0106', 8, NULL, NULL, 1, '2024-08-02 15:43:44', 44, '2024-08-20 13:28:37'),
(108, 'yayan', '$2y$10$29koHHdw.VlrUlNtUsKRGuoXjKIivhIfrosrqEfW9lUOV/qrlAQoe', '0107', 4, NULL, NULL, 1, '2024-08-02 15:43:44', NULL, NULL),
(109, 'gunawan', '$2y$10$C1uqGx4d3bTarK0A4HMS9Ozn7gw5HasZnHFK7ak5rbNUZyRWLuLfO', '0108', 8, NULL, NULL, 1, '2024-08-02 15:43:44', NULL, NULL),
(110, 'nurulyuliati', '$2y$10$cLPLiaMx4rUTVD.ojgDsouOcx864nBBOJm3nlg5qSOGr46VA3Bo6i', '0109', 8, NULL, NULL, 1, '2024-08-02 15:43:44', NULL, NULL),
(111, 'mey', '$2y$10$fFt.xCE2e.ut8t8mJk9jJu0n6oPvj2LG2z3vrIn93JrfEaPbfpcfC', '0110', 8, NULL, NULL, 1, '2024-08-02 15:43:44', NULL, NULL),
(112, 'aisyah', '$2y$10$Nq0UDck2Mf02HrDQdYQ2NOopmoU6G7v/JDTIv/7nV1cMyWVfHG8r.', '0111', 8, NULL, NULL, 1, '2024-08-02 15:43:45', 44, '2024-08-08 13:45:06'),
(113, 'titi', '$2y$10$6cdDRY1R4PY1As4gPvo.xe9fpAPKSKAPSFclXxHGOh6991iNpchCK', '0112', 8, NULL, NULL, 1, '2024-08-02 15:43:45', NULL, NULL),
(114, 'tricahya', '$2y$10$87TOnW/DHLJOS8cVnwSfB.WxYLEMaOnauhi5RYUebzeNmlnD66FwG', '0113', 0, NULL, NULL, 1, '2024-08-02 15:43:45', 113, '2024-08-19 14:55:12'),
(115, 'sribudiarti', '$2y$10$bUqEv2EXz83XBMQTgJEoJuh18d58CtwJKLl3KsnHyqMSyI2yH.bM2', '0114', 8, NULL, NULL, 1, '2024-08-02 15:43:45', NULL, NULL),
(116, 'supriharto', '$2y$10$1VqJDqO4hM3bwt882QMbCuJoshHOV4pHNLIEovP.pPNI/hvsOG.Nm', '0115', 8, NULL, NULL, 1, '2024-08-02 15:43:45', NULL, NULL),
(117, 'indrapriyo', '$2y$10$ybBX5BljJ0KvpTdc5njzLO4EOuOAcm8VjWm8dUzFf8M7TD6.ZOxiu', '0116', 8, NULL, NULL, 1, '2024-08-02 15:43:45', NULL, NULL),
(118, 'urip', '$2y$10$QaIB.uUufBRE6IXzijkOre9QpYJOqL1v5GMyHTL/TP5MVm9tiqgMe', '0117', 8, NULL, NULL, 1, '2024-08-02 15:43:45', NULL, NULL),
(119, 'abdulaziz', '$2y$10$Wdo17H4nWJD5aDV3VHmqmu36FXr7rjgppF3KwKzBQWJ0xb7B5sFey', '0118', 8, NULL, NULL, 1, '2024-08-02 15:43:45', NULL, NULL),
(120, 'renada', '$2y$10$SLypQkvJu.At2.IevBmHXOOeSLmioEvxQfHkm7zrjZMT1HFq/kJPq', '0119', 8, NULL, NULL, 1, '2024-08-02 15:43:45', NULL, NULL),
(121, 'ida', '$2y$10$BNx1WVXrgLvEAvGiT5kkqO7yZTB4fdOUSehF2cis/Wzq/B29gJFG2', '0120', 8, NULL, NULL, 1, '2024-08-02 15:43:45', NULL, NULL),
(122, 'ratna', '$2y$10$PBcN8tTnsiYPv8S2eGBsQe.q1p3QahES9SUdvvZs4ORyGMDNXUBhy', '0121', 8, NULL, NULL, 1, '2024-08-02 15:43:45', NULL, NULL),
(123, 'khasaniah', '$2y$10$2czSj.E5NuxnGiMLOc9pXufCYeeswqwKys3bRWp4XHA3EnZili2be', '0122', 8, NULL, NULL, 1, '2024-08-02 15:43:45', NULL, NULL),
(124, 'niken', '$2y$10$uUBZXk1PXGPThyqaWFC1x.khZG/SAkoT6wZhvEzLnu8uiuud/zq3C', '0123', 8, NULL, NULL, 1, '2024-08-02 15:43:45', 44, '2024-08-20 13:22:02'),
(125, 'riza', '$2y$10$VZN9MozOR2Gwxz0shzKlle5diReWCv4GbUWjTflxdfIEuwjY4z9cS', '0124', 8, NULL, NULL, 1, '2024-08-02 15:43:45', NULL, NULL),
(126, 'arvian', '$2y$10$TJdK.FvpyIETtvvX6lo4FuoD2/N7oxiRrYTnR9Pt53tdUk8bbRNs2', '0125', 3, NULL, NULL, 1, '2024-08-02 15:43:46', NULL, NULL),
(127, 'risma', '$2y$10$KuRzhMYBbVm..KKrK9sHzOXra5/SKMr.0sUxv6LNbx1rly3MUXjX2', '0126', 8, NULL, NULL, 1, '2024-08-02 15:43:46', NULL, NULL),
(128, 'irma', '$2y$10$7sPK6N8WCYM4kiPyPbxDa.GQ27hwWxk9Q.buStLsXKTi4w9Qzxjyu', '0127', 8, NULL, NULL, 1, '2024-08-02 15:43:46', NULL, NULL),
(129, 'danu', '$2y$10$eNVbNnjcNqCKvcRotUybVO4hGru1ijn9eo08UrV2Cw.sWzcOeflZK', '0128', 4, NULL, NULL, 1, '2024-08-02 15:43:46', NULL, NULL),
(130, 'nadia', '$2y$10$9J1wOxEW7fSEQ00ZMornoezNRp.oIrE7hv8FZZ.GQ6LhWyI6oZjAq', '0129', 2, NULL, NULL, 1, '2024-08-02 15:43:46', 44, '2024-08-12 13:54:54'),
(131, 'tyan', '$2y$10$8QI4rZ/ZcUNYHOcoVDqxNOJLVpbsTlIfQYJ6v7RoXNELdB9wNZgqu', '0130', 8, NULL, NULL, 1, '2024-08-02 15:43:46', NULL, NULL),
(132, 'paskalis', '$2y$10$6Ssz0kQg8EfmPlDZYM3bY.jHvvFG//Uqt6LmPe/62SeVmN8H7GP0C', '0131', 3, NULL, NULL, 1, '2024-08-02 15:43:46', 44, '2024-08-08 13:50:01'),
(133, 'nana', '$2y$10$taIsAzOaK9ZrTpJSItPkr.jsizgPRv7Pu3MRlotb2xL4AW3V8dyOe', '0132', 4, NULL, NULL, 1, '2024-08-02 15:43:46', NULL, NULL),
(134, 'diannurul', '$2y$10$4zeu6ONiYuDwaC9X1g34nechc4xjjevnrnFFSap8i10.O1f5D6Z1G', '0133', 8, NULL, NULL, 1, '2024-08-02 15:43:46', 44, '2024-08-08 13:54:23'),
(135, 'laras', '$2y$10$OEghtMpndyBBltEBjeelXuu9MqnqWTSTACkQpKr.bpwZG8obmoojS', '0134', 2, NULL, NULL, 1, '2024-08-02 15:43:46', 44, '2024-08-13 11:39:02'),
(136, 'hendri', '$2y$10$vVusV4U2UEd7rATBDYbF8u4MM510hZV05CpqPclPQVcJCsGDeklT2', '0135', 4, NULL, NULL, 1, '2024-08-02 15:43:46', NULL, NULL),
(137, 'sony', '$2y$10$p4w6XaH/PdBPNdddhR94wukdna5M.0jyHVvsFZhL5SK9Dm5pXSuCa', '0136', 4, NULL, NULL, 1, '2024-08-02 15:43:46', NULL, NULL),
(138, 'ragilsafitri', '$2y$10$vWD0XlIsHQYjHQIILgH.n.6LdAcy.u3BJ3uih3pZrofpjwjaIUujC', '0137', 8, NULL, NULL, 1, '2024-08-02 15:43:46', NULL, NULL),
(139, 'wahyuni', '$2y$10$DL.G0bLyG.6onj7/FO0nIeXiu6eZxk.IvA6xViCFJVtX0q6d9BfLi', '0138', 8, NULL, NULL, 1, '2024-08-02 15:43:47', NULL, NULL),
(140, 'patria', '$2y$10$oFGa08Qt8AAYqJxe1gcD0elI8IorObY7PlZXuu.dG94I2LBLoZREe', '0139', 8, NULL, NULL, 1, '2024-08-02 15:43:47', NULL, NULL),
(141, 'adeyosgi', '$2y$10$k7aupC7kUw9K4MNLLRLnjOpUCVQqvigAkCEFOT331xiflMijOKTbO', '0140', 8, NULL, NULL, 1, '2024-08-02 15:43:47', NULL, NULL),
(142, 'ritadea', '$2y$10$ZSFGoZp5bdw72kKKDPOzgev9RWioO6UzgZoZ2V.lIEk/YaITLtQz2', '0141', 8, NULL, NULL, 1, '2024-08-02 15:43:47', NULL, NULL),
(143, 'farisa', '$2y$10$CG0SfqF9MmVzgzXyFJCf6eKXuWjFazoR2u3asgcdIqqSyqhmIxKe6', '0142', 2, NULL, NULL, 1, '2024-08-02 15:43:47', 44, '2024-08-20 10:46:18'),
(144, 'pramudya', '$2y$10$9USU4avO8/OHq9XgcaugMe45tXhtyW/qaGtBvREoHrPYfdvKnHspm', '0143', 8, NULL, NULL, 1, '2024-08-02 15:43:47', NULL, NULL),
(145, 'anamiftahul', '$2y$10$mxT.8Np6dhMw0lz96VuZ6uQw0jND/0YnA34VLICILr4Q9byzeIzjW', '0144', 8, NULL, NULL, 1, '2024-08-02 15:43:47', NULL, NULL),
(146, 'cicilia', '$2y$10$yZ3Z.eglObyj9kOK4PoDhubCsUAkQjs8Iill./2yQL4kU6fSMPfAC', '0145', 8, NULL, NULL, 1, '2024-08-02 15:43:47', NULL, NULL),
(147, 'aans', '$2y$10$SLDyvk0yBJ/DsbTZ0CcaKOzROa5amcRaWbGgNGgF9CqbgYaW7TUGK', '0146', 4, NULL, NULL, 1, '2024-08-02 15:43:47', NULL, NULL),
(148, 'wahyuastutik', '$2y$10$OJryRBgrBU7QMoP7R1lcmO/vg1Ox7P08.2GTkWA5eOKZu/tZXS3t6', '0147', 8, NULL, NULL, 1, '2024-08-02 15:43:47', NULL, NULL),
(149, 'ficky', '$2y$10$6F7.TWl5Q8KgBY/8xwT4LOgaHZcZ8nu3bH4V/zPo/fCqAGmTfI23C', '0148', 8, NULL, NULL, 1, '2024-08-02 15:43:47', NULL, NULL),
(150, 'yohanis', '$2y$10$ZBhpbnZKVG3RQUsAHs1pf.pnMs7L2T.tCfSZPkXV8pCKYTqxOeNqm', '0149', 8, NULL, NULL, 1, '2024-08-02 15:43:47', NULL, NULL),
(151, 'putrisalsabila', '$2y$10$LjXs9CuaJDOuK4trapavzunZh2bJy.qWmrKqFbc4Lc3HEXgwGhQ4e', '0150', 8, NULL, NULL, 1, '2024-08-02 15:43:47', NULL, NULL),
(152, 'meriana', '$2y$10$xT1Y3fWJofVHmWy4ibw8Qe3/Yf8leIY89TnNACiRWk8Rr9yKr0OXS', '0151', 8, NULL, NULL, 1, '2024-08-02 15:43:47', NULL, NULL),
(153, 'ihksan', '$2y$10$HFMEzcayVcpcDOdSDD3P1./840RG8RU0gpD1awv45Gvv1IQlfnTzK', '0152', 8, NULL, NULL, 1, '2024-08-02 15:43:48', NULL, NULL),
(154, 'putripuspika', '$2y$10$AoFybWypshC8C0F3ihZSoOZrCz5iQKW0icSMt5S7W8P0iSRvfumj6', '0153', 8, NULL, NULL, 1, '2024-08-02 15:43:48', NULL, NULL),
(155, 'titis', '$2y$10$./e3WV/MxKlVXYymlNNXV.9ekYimKPwbLA8or0K77AQezVBR.12HK', '0154', 8, NULL, NULL, 1, '2024-08-02 15:43:48', NULL, NULL),
(156, 'siti', '$2y$10$U8NYVLAELP9d3yAjY/.WhunpEKiaS2OdtuZT/tGRHVjKPubwmPHJW', '0155', 8, NULL, NULL, 1, '2024-08-02 15:43:48', NULL, NULL),
(157, 'diyana', '$2y$10$bVRsjicOcjgKYLhogwVWXuzzhBaeIt3r5iaXR4SeZSBeXKbRsjPeG', '0156', 8, NULL, NULL, 1, '2024-08-02 15:43:48', NULL, NULL),
(158, 'dafid', '$2y$10$/qMk2xI67l5hxpXmTOSk..HHv2coWfHSWQLh8JI9wVQCWokH8JqLy', '0157', 8, NULL, NULL, 1, '2024-08-02 15:43:48', NULL, NULL),
(159, 'udin', '$2y$10$HSba4wkh7t.NStRZROpA1uvlSu/VEPV/Q2WxX60WhDuHmG7WpEvuK', '0158', 8, NULL, NULL, 1, '2024-08-02 15:43:48', NULL, NULL),
(160, 'indrayanto', '$2y$10$LLqWaF3yVY4AWY0euLMd7e21e9eHJNIACCC4NXj0BjZaYewHVmeC.', '0159', 8, NULL, NULL, 1, '2024-08-02 15:43:48', NULL, NULL),
(161, 'aziis', '$2y$10$5P8CGIJqV/QEJb5huHfhHenfpIEsrF9gedsdYPA4jyovdwSymS8e.', '0160', 8, NULL, NULL, 1, '2024-08-02 15:43:48', NULL, NULL),
(162, 'aldy', '$2y$10$dObwX/.m7hsLCdPmzRhxtOutYQulf6lKlY0cDh9tFk2nbI3mw7oqq', '0161', 8, NULL, NULL, 1, '2024-08-02 15:43:48', NULL, NULL),
(163, 'aldi', '$2y$10$mr8xsrEuJJ30pprBqr.6h.6ems6gMFseLdmxp38nI2cgccvstGvPe', '0162', 8, NULL, NULL, 1, '2024-08-02 15:43:48', NULL, NULL),
(164, 'budisetyawan', '$2y$10$SNQSjObIngCzCmh6R8loTeZuIVyjscLJTj0kQXHWa9h9VvkCj/m/G', '0163', 8, NULL, NULL, 1, '2024-08-02 15:43:48', NULL, NULL),
(165, 'iqbal', '$2y$10$CBBlFReam2mQWVsdprfKhOVxZW9pXk0gp8r2Z4K/CyB7MyU0FHmv2', '0164', 8, NULL, NULL, 1, '2024-08-02 15:43:48', NULL, NULL),
(166, 'wahyudwi', '$2y$10$HsaWEwF6dVsdOlBCKj7D1eYilQGiCpjrgi/4lF7gk6Wlkt6q8BzGO', '0165', 8, NULL, NULL, 1, '2024-08-02 15:43:49', 44, '2024-08-20 11:43:13'),
(167, 'valen', '$2y$10$Dshoa7sTXhKfP4/POUs.yu98reuVbW0AfPQ7n8FbzhbgJYY6RIdrm', '0166', 8, NULL, NULL, 1, '2024-08-02 15:43:49', NULL, NULL),
(168, 'alex', '$2y$10$IqeBIh9VHgwezxYro026E.ZJynQmdKpuIpOnwAN6x9R841ndkNwFG', '0167', 8, NULL, NULL, 1, '2024-08-02 15:43:49', NULL, NULL),
(169, 'ekoyulianto', '$2y$10$7rCJtEdEnP1BzoWfpPEleu9D6nHDY162fc59ycFqDw9qgMU7.Qu6O', '0168', 8, NULL, NULL, 1, '2024-08-02 15:43:49', 44, '2024-08-20 11:08:47'),
(170, 'khusnatul', '$2y$10$20wheqnilVv6JqAVSeOMG.p6aFBCItX66UvNsbjw.JyxTKqSmRN.u', '0169', 8, NULL, NULL, 1, '2024-08-02 15:43:49', NULL, NULL),
(171, 'septian', '$2y$10$zOmzQA87Yyn1J/LmebQciOVwhwzhhqNiHTfomYLkj2cdomVddfXGK', '0170', 8, NULL, NULL, 1, '2024-08-02 15:43:49', NULL, NULL),
(172, 'riskyagung', '$2y$10$o03VWfBpEzRSs2AXHAhG0.NtubHal6dbXaD3t.Wbh.EHhcREO4HIe', '0171', 8, NULL, NULL, 1, '2024-08-02 15:43:49', NULL, NULL),
(173, 'yusuf', '$2y$10$9vfV8REs1psXNvQIHVM0UON1uRhFaNcmsv5yRDynldH/qd81s1nja', '0172', 8, NULL, NULL, 1, '2024-08-02 15:43:49', NULL, NULL),
(174, 'arifnur', '$2y$10$ezZPe/KMQN.Uid0gerCH/O9ZG6d916gO8J8oKww.ab38bb/2Th7A.', '0173', 8, NULL, NULL, 1, '2024-08-02 15:43:49', NULL, NULL),
(175, 'reyhan', '$2y$10$tvedP5Q3gvv5GptXgWwNZ.LSGvHj4GaNvn2LZ3lG91hMoLmJsSsOW', '0174', 8, NULL, NULL, 1, '2024-08-02 15:43:49', NULL, NULL),
(176, 'sofirda', '$2y$10$iEsYOVmdgFBQJowG/DzNsOE8j4km3pCezPEYVbczQgIi7LOSCt7ny', '0175', 8, NULL, NULL, 1, '2024-08-02 15:43:49', NULL, NULL),
(177, 'berty', '$2y$10$EjRORVpyiuFG7THZBrvPsuEon7JRndTnUseGY4OrIm9NsFwN1fc3O', '0176', 8, NULL, NULL, 1, '2024-08-02 15:43:49', NULL, NULL),
(178, 'tegarragil', '$2y$10$iSW/8uGyUTdAdekOKvH1rOgX3oWi45DHoWaUGZ2fRBAPiwvUwNgHu', '0177', 8, NULL, NULL, 1, '2024-08-02 15:43:49', NULL, NULL),
(179, 'rohim', '$2y$10$ViDP1i5cWSjpLf0GBS6TaufEYmb8JJO/K2bMWPx19S1w6fVG8xgMi', '0178', 8, NULL, NULL, 1, '2024-08-02 15:43:49', NULL, NULL),
(180, 'kurniawan', '$2y$10$j9JfNtW0hZ/YgWzYpGaa/epihf1CRZl6i9XvVFh78rmRjg0NZDiWa', '0179', 8, NULL, NULL, 1, '2024-08-02 15:43:50', NULL, NULL),
(181, 'ridwan', '$2y$10$fgLiEyLMVi73twQwY1Fe9OrYbeQ9cd90Ht79EY0mxWzS.Gz1/GCHC', '0180', 8, NULL, NULL, 1, '2024-08-02 15:43:50', NULL, NULL),
(182, 'chrismon', '$2y$10$nRQucKGgf23REQ2YuBoSCOGgQ.DkwPqV5jQgaFj755GAAdIGkz4cm', '0181', 8, NULL, NULL, 1, '2024-08-02 15:43:50', NULL, NULL),
(183, 'sadiyah', '$2y$10$iFpdgN8p1u/irioguLwejueFT0ZAxGVEvxTzEP4vIKrp84qy81zPm', '0182', 8, NULL, NULL, 1, '2024-08-02 15:43:50', NULL, NULL),
(184, 'lutfya', '$2y$10$bkztVTvXK8h6gbhDtvQKFuvZO2wsW1T1S4o1wTP5D6CJAk3wNv2Jy', '0183', 8, NULL, NULL, 1, '2024-08-02 15:43:50', NULL, NULL),
(185, 'hartanto', '$2y$10$7W11RGASNjPMCuAySja3FuBQ4WXvZPkG.LXaUM0rnYbtezQhNX3gq', '0184', 8, NULL, NULL, 1, '2024-08-02 15:43:50', NULL, NULL),
(186, 'trisuryanto', '$2y$10$GWsUYa.N4yZVcq2AWLtYOeHrbXbL9US8SWrP8LjKyP.fzEz6aLIqG', '0185', 8, NULL, NULL, 1, '2024-08-02 15:43:50', NULL, NULL),
(187, 'wahyuagustin', '$2y$10$.1NxQyGTddH5Z24N8MQMr.5pM6PHnClst.GeZRVlEhEL9RrQIiOGO', '0186', 8, NULL, NULL, 1, '2024-08-02 15:43:50', NULL, NULL),
(188, 'ahmadfajar', '$2y$10$vlzAHy6iLsrWjOortyby6O5gwZiMVPnL/I1VSD1vcxlh1cpctGmZ.', '0187', 8, NULL, NULL, 1, '2024-08-02 15:43:50', NULL, NULL),
(189, 'zulfikar', '$2y$10$P8aSwzJpD.elsurjPIjPz.3upo3LpSbyq9aLWxgGGjKgK2S.YSifC', '0188', 8, NULL, NULL, 1, '2024-08-02 15:43:50', NULL, NULL),
(190, 'danisaputra', '$2y$10$IZXjxaDeOMn4gS6qhgztn.tXIqZf1q0ua4ovJb3D1RXRcQEx14Cbe', '0189', 8, NULL, NULL, 1, '2024-08-02 15:43:50', NULL, NULL),
(191, 'septwin', '$2y$10$NM.DAKVj9AAcyTO2C727oOaFlqR/YuGDKJVkWMkFXq41bH2ZlEB4i', '0190', 8, NULL, NULL, 1, '2024-08-02 15:43:50', NULL, NULL),
(192, 'miko', '$2y$10$l8xJwiMnHYrQ34Dc3PxS9eS.BuVnvJ5JzE/fMDauDU1GwPIaN7XzC', '0191', 8, NULL, NULL, 1, '2024-08-02 15:43:50', NULL, NULL),
(193, 'fandy', '$2y$10$WLvZrEPrPv31ntjY.d6w2.7sxk5bZJ5mtZmXtK2D1I43bY7Q3mHQK', '0192', 8, NULL, NULL, 1, '2024-08-02 15:43:51', NULL, NULL),
(194, 'richard', '$2y$10$9hQVB5FjX5TekkYRgSnnl.GsWePmQlUaF2BAQqyBwyzv3SD3xFXZu', '0193', 8, NULL, NULL, 1, '2024-08-02 15:43:51', NULL, NULL),
(195, 'gembong', '$2y$10$9bEAWfBlOKX0ohbbxLR1K./JyCvEbff7sMH7sFc1dJ9OwdGyNiWci', '0194', 8, NULL, NULL, 1, '2024-08-02 15:43:51', NULL, NULL),
(196, 'zaenuri', '$2y$10$HcwiOrsYvBgbziSmYJvvYejZF2E1jD8KUN2Kp41oUlBGmL9nWTHta', '0195', 8, NULL, NULL, 1, '2024-08-02 15:43:51', NULL, NULL),
(197, 'ocha', '$2y$10$2I7ajX4btURire3nr7Tdp.tvE2kzBIfGGXPkVDtT.KYPNmRmS5bTq', '0196', 8, NULL, NULL, 1, '2024-08-02 15:43:51', NULL, NULL),
(198, 'dita', '$2y$10$Q9bHnowj7aO9WHSVx7vHY.DPcC2cLI3h6vV/FJrxVkvNDr9U9ryHe', '0197', 8, NULL, NULL, 1, '2024-08-02 15:43:51', NULL, NULL),
(199, 'rigi', '$2y$10$BKpXVdZgE/3xq.OFGvDG7.NfXgjWe4TaOaxhV8SSofFlB9sOu9ira', '0198', 8, NULL, NULL, 1, '2024-08-02 15:43:51', NULL, NULL),
(200, 'fitri', '$2y$10$3L.E1R66afwU6QYy/qPNmuqZbr/Omy07rb.9nuBbMCDmDyZvYcZyO', '0199', 8, NULL, NULL, 1, '2024-08-02 15:43:51', NULL, NULL),
(201, 'lesmana', '$2y$10$oB6hVyXstlWswKJHDikPGuOZ4kzjQYIwJPzC2ilEUNTvtRrzGrI8C', '0200', 8, NULL, NULL, 1, '2024-08-02 15:43:51', NULL, NULL),
(202, 'elikardilla', '$2y$10$J9bVPFRB3M4W6HWL7UuwUeBhPKDcupI8RQ8I4K6NHbdoCTZVpyTim', '0201', 8, NULL, NULL, 1, '2024-08-02 15:43:51', NULL, NULL),
(203, 'anggar', '$2y$10$o/lTjODLBWy6oOqAPof2mOyuleOYwbDGgbBa7hVKsZtTIH78fW9BW', '0202', 8, NULL, NULL, 1, '2024-08-02 15:43:51', NULL, NULL),
(204, 'jovanka', '$2y$10$S4h3zsApogelrvyK1xn/4ulTIVpNhF/poLNVO3poz/UMj21EKTI.G', '0203', 8, NULL, NULL, 1, '2024-08-02 15:43:51', NULL, NULL),
(205, 'dimas', '$2y$10$xnqA7x9L5Y4qc8NOebzkt.AWu/LiV89qC3hv6BwQGDn/k2bHZQ0MW', '0204', 8, NULL, NULL, 1, '2024-08-02 15:43:51', NULL, NULL),
(206, 'sumarwanto', '$2y$10$/otSUjVpusfNi6uIhGnw2.mBpUfkAdDgKflR9TuG.Lnrjc98JZrdy', '0205', 8, NULL, NULL, 1, '2024-08-02 15:43:52', NULL, NULL),
(207, 'eurico', '$2y$10$RumGfTgObVm.4GfQG9vblO9UQ2sml98.dlFKp2KJkHwo7TBoWO1XS', '0206', 8, NULL, NULL, 1, '2024-08-02 15:43:52', NULL, NULL),
(208, 'meka', '$2y$10$Gd6tYU6IE3ZbIsxlr9dJw./XWixxSBd0Rg9IgxZCmaLU5.cfnGu/6', '0207', 8, NULL, NULL, 1, '2024-08-02 15:43:52', NULL, NULL),
(209, 'enang', '$2y$10$49hDv/a3o/ied6syZp6Q9e8APoLUtY.QySjpiX4hjF2IeyMjySWfi', '0208', 8, NULL, NULL, 1, '2024-08-02 15:43:52', 44, '2024-08-20 11:59:05'),
(210, 'akbar', '$2y$10$RKOO4G.ZwgyHtRnckm39W./3D791u4ebBtXKieuDgvYct.B8qlsBi', '0209', 8, NULL, NULL, 1, '2024-08-02 15:43:52', NULL, NULL),
(211, 'diankristanto', '$2y$10$V60Q5JLS3JWZcnBRmhzu/eGAByzP/onT5i75owm0BBF.5CkeA5ZMO', '0210', 8, NULL, NULL, 1, '2024-08-02 15:43:52', NULL, NULL),
(212, 'dika', '$2y$10$EpGCgP0DR.4n3FAPx3gMTeq7vpqmDCRPMNXBet22opxmuyiCdngEm', '0211', 8, NULL, NULL, 1, '2024-08-02 15:43:52', NULL, NULL),
(213, 'edwin', '$2y$10$vW.SNfUINmbzdbzUivCwDOq/NOc8JtBgQ6CaLruFSrLBgfxxLVE7K', '0212', 8, NULL, NULL, 1, '2024-08-02 15:43:52', NULL, NULL),
(214, 'hendra', '$2y$10$SxKaLhgtGgHRkyN.TuqV7OM1BzCYYYw0nx8yryRMbi489sxKVaQ/q', '0213', 8, NULL, NULL, 1, '2024-08-02 15:43:52', NULL, NULL),
(215, 'arifmunandar', '$2y$10$5G94gn8V81.EVZKfPqWcKuWaXSitTEwpnD4g4f9L.VJd4z9YS9R1a', '0214', 8, NULL, NULL, 1, '2024-08-02 15:43:52', NULL, NULL),
(216, 'nuril', '$2y$10$HJ4juFyKzSxAGm8Fni5sY.3Kye8J9cbe6rXbOtP6kO2N47rM7V3hy', '0215', 8, NULL, NULL, 1, '2024-08-02 15:43:52', NULL, NULL),
(217, 'cahyoadytyas', '$2y$10$zB8MG5bU0KtdJhpBvNGZqOTk5dT8NOSIQiXqeYbIrvcfvsmg4yGVu', '0216', 8, NULL, NULL, 1, '2024-08-02 15:43:52', NULL, NULL),
(218, 'haris', '$2y$10$4X4NbQLannv.IJqfVX3L6u09eSlUT22dmBCt.K78/GR/Bfym.m59i', '0217', 8, NULL, NULL, 1, '2024-08-02 15:43:52', NULL, NULL),
(219, 'suryadi', '$2y$10$Dy3O4gS18SkuE7UGb8viseGhtfgFQs/rIWB8Z5zn/wMyzKzs7u4oe', '0218', 8, NULL, NULL, 1, '2024-08-02 15:43:52', NULL, NULL),
(220, 'resepta', '$2y$10$tAHsXlHZ/TOceK6BcQECQutzimzEWHPdVe7mZMuQU5aAoQgbJNYpS', '0219', 8, NULL, NULL, 1, '2024-08-02 15:43:53', NULL, NULL),
(221, 'fendi', '$2y$10$G6JRGQUCHQ7VgbMEWfoi5./e90mSNRGRopuxmp1LtPV3JoLWV23Ca', '0220', 8, NULL, NULL, 1, '2024-08-02 15:43:53', NULL, NULL),
(222, 'bayusetya', '$2y$10$IL3yyu1dfT5JG0W/VvldG.77jnesH6scvHJuJNzh69mvaF8pnHeNK', '0221', 8, NULL, NULL, 1, '2024-08-02 15:43:53', NULL, NULL),
(223, 'wahyusaputra', '$2y$10$g4unk9auENVouz7/gDPSVOotLU7YVKCwWyoSChCLmvh604AQ32Bgu', '0222', 8, NULL, NULL, 1, '2024-08-02 15:43:53', NULL, NULL),
(224, 'bayutirta', '$2y$10$ik8hRKjfwTYAc3JoGMjo/.hUPpwUbMcxgNIqqmlh/FbqvZuT7.nCi', '0223', 8, NULL, NULL, 1, '2024-08-02 15:43:53', NULL, NULL),
(225, 'leonardus', '$2y$10$qK7CHW1qr8wExvXzkxjRIOcn7zwigXQ3MCRAtBSV.378fJetoEurC', '0224', 8, NULL, NULL, 1, '2024-08-02 15:43:53', NULL, NULL),
(226, 'fendri', '$2y$10$PrSMOSfHEdDUvKvPf2.v7OhvTG4xS3PK4uRndV3kpHdaKusdQwnVm', '0225', 8, NULL, NULL, 1, '2024-08-02 15:43:53', NULL, NULL),
(227, 'arin', '$2y$10$f5ZqlQU0IIJz/oSJs7O7S.iA7q/sYtc9c7ik21oTBvV9NAT.bfrZu', '0226', 8, NULL, NULL, 1, '2024-08-02 15:43:53', NULL, NULL),
(228, 'danindra', '$2y$10$dX3aA/0xodIRWBSpTYucKe46Qi3F3e8S1qKSAL3.IUbVQec679vgO', '0227', 8, NULL, NULL, 1, '2024-08-02 15:43:53', NULL, NULL),
(229, 'niswatin', '$2y$10$3QU42yW6fik6pUaJWf1fKO/xyf9mFqfQs0zuxysWg0OkoHaPYuIZe', '0228', 8, NULL, NULL, 1, '2024-08-02 15:43:53', NULL, NULL),
(230, 'martin', '$2y$10$vSSRtnE5R11yeis.hlJl9e9th/kmUdjIamkv8fh6gt8gSKyA.KZAu', '0229', 8, NULL, NULL, 1, '2024-08-02 15:43:53', NULL, NULL),
(231, 'eric', '$2y$10$d08eEFefDt034mOwR8mADeHGxo8aMbuKWZAjbRV4WrleG7x3KE0I2', '0230', 8, NULL, NULL, 1, '2024-08-02 15:43:53', NULL, NULL),
(232, 'hono', '$2y$10$8oaS4.SgZ9GbKhsa0z5qmOLldiwGwx2ZdXEdVVyvqbFFUp47MnqZy', '0231', 8, NULL, NULL, 1, '2024-08-02 15:43:53', NULL, NULL),
(233, 'bayusetiawan', '$2y$10$VpUBqY9r3vKqthfthf6MouVnRuOVk.sluhG4fgBHrVZFmip.jX3/W', '0232', 8, NULL, NULL, 1, '2024-08-02 15:43:53', NULL, NULL),
(234, 'lauren', '$2y$10$bsgr.bnzd7DgE6J.UHQcK.Nq63upabn5fdvjsQaDZejLn9mPZcrYG', '0233', 8, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(235, 'kevin', '$2y$10$GMshDbld16T.oAyC5nal5.myIDpRbzNzM/eDiRpUY9qMilR2JWFne', '0234', 8, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(236, 'aldheo', '$2y$10$Wz/Tp2NX.DL1U.Xic8zCHOyO9lJFUuVlAC9z72s8Ukoxscj6LG5VG', '0235', 8, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(237, 'sidiqardy', '$2y$10$zF3hasHETvDjkOWToTYmyeHQ0VeT3FiTlAxjLShu2htZB537sr7AS', '0236', 8, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(238, 'abbiyuka', '$2y$10$FZuJ5N8Hr2jpSbvbOeZ8teRjXBjKRryWf3HfEuGiU2dDWIOxfrYD.', '0237', 8, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(239, 'ardianto', '$2y$10$LErrxdCYniOgf3RoI2eMyu.nvEf1eSq4B5mc99kwlvmGRwmFsgtX.', '0238', 8, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(240, 'muharif', '$2y$10$OVp92xUgByA4ZVeBuH0TpO4Mv392nxWJJWdDHZJi4QRtgK453QlF6', '0239', 8, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(241, 'insan', '$2y$10$LuJ03IXMqeYbgv9IVDxYOuR.sO6CuSQMS0koTpPh6ln9cpEXs7Qha', '0240', 8, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(242, 'dyas', '$2y$10$Cg81Dop88dHa0vgbuhTCEuJrHriveoiZ27enw672hc4A0o2d5eVty', '0241', 8, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(243, 'budisetiawan', '$2y$10$Cf3FgeNLOXr8nEKDK0uufu38zYgOCSBbmUSUSsHdzXwArBs5nmaMS', '0242', 4, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(244, 'agustina', '$2y$10$TCgzHDTMpty/FAeso7p7a.1NH.pdBpko11uWpVwFazHyumTKMz17i', '0243', 8, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(245, 'alfian', '$2y$10$Sjc.81QPmJLlWG4JpxBU/unft0eOUBBGMPESQ1pesP3Bxs5jac26C', '0244', 8, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(246, 'galih', '$2y$10$1ziFOV6w5OKm0SWu4ch.lOPNeiA8QFxEEGqZPu7bbWTPs0DuoFZJu', '0245', 8, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(247, 'bayucahyono', '$2y$10$nr0i1pcCIJvfC3.75Rrf/.Jwx8ugQYHKmw8Et9w2v3xN7vhN2dML2', '0246', 8, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(248, 'bella', '$2y$10$XBoGz/ae9i8jF5BZF8FOwu68e7/KyZR5zoiyTuC6hwhXJJCRu34Hi', '0247', 8, NULL, NULL, 1, '2024-08-02 15:43:54', NULL, NULL),
(249, 'tabah', '$2y$10$UlS41L.EwoYK4mCfFmO89.CMGeWur5qMLGPho6TDNLmgL.h3UpwHS', '0248', 8, NULL, NULL, 1, '2024-08-02 15:43:55', NULL, NULL),
(250, 'rizalwahyu', '$2y$10$xI/36FqCzEH346l3o781Ju1pOcueyN684TripIy/nR3NN1QCXD6Sm', '0249', 8, NULL, NULL, 1, '2024-08-02 15:43:55', NULL, NULL),
(251, 'rony', '$2y$10$BVwYAmV3XY73GGe1rJKeMuNAsjoamlO6Ox4ikIsi8tsqx0W2pU.4W', '0250', 8, NULL, NULL, 1, '2024-08-02 15:43:55', NULL, NULL),
(252, 'nicolas', '$2y$10$rhCy6zbkMkqQIimCy5rF2uOH472ENxvNAwmsESsP.GJWWlmzAb/LK', '0251', 8, NULL, NULL, 1, '2024-08-02 15:43:55', NULL, NULL),
(253, 'yulius', '$2y$10$6pIpCb.RtnAumgT1QW7ayOdjY4qE4hqHw2D6acXam0TdusUoF0mii', '0252', 8, NULL, NULL, 1, '2024-08-02 15:43:55', NULL, NULL),
(254, 'wawan', '$2y$10$7j.dFzj148dcCYJH5YUya.e9W0tur7sF0xyH89XUSPnTdFp93aUkq', '0253', 8, NULL, NULL, 1, '2024-08-02 15:43:55', NULL, NULL),
(255, 'wisnudwi', '$2y$10$qnBEWC9y4OH4VaXR0vjpDejbQITPgMJWm60OmBrfsJRK17YcDDnby', '0254', 8, NULL, NULL, 1, '2024-08-02 15:43:55', NULL, NULL),
(256, 'ahmadmiftahuz', '$2y$10$I7DYJf/2r67.v2oFSx4sxeuAARNPseHeFY/AJX8BjT1sB.xdAOoZq', '0255', 8, NULL, NULL, 1, '2024-08-02 15:43:55', NULL, NULL),
(257, 'sinta', '$2y$10$8HKaNtdj.Sah5nBhd14hO.Bm5921ZPGBUYwS7BSMn.qxRVOg44lVC', '0256', 8, NULL, NULL, 1, '2024-08-02 15:43:55', NULL, NULL),
(258, 'ais', '$2y$10$AKqPDfwmpRu.T1SCUmxseuqe8vV133tkUWPQHzV2VIbp5v0a5IfVq', '0257', 8, NULL, NULL, 1, '2024-08-02 15:43:55', NULL, NULL),
(259, 'hasannur', '$2y$10$dPmalSbsQNOjGbak.MKKgubLjNcbQ3CZtrCYMn.WGj70RNXzxo5cW', '0258', 8, NULL, NULL, 1, '2024-08-02 15:43:55', NULL, NULL),
(260, 'adewahyono', '$2y$10$M/jl4vj/E9uuGI64E0gDdOvO//hSFdShPtKFs8nILzT/oNxUHKaU2', '0259', 8, NULL, NULL, 1, '2024-08-02 15:43:55', NULL, NULL),
(261, 'timbul', '$2y$10$GkcLms3rmDHbw0yXcqyCoOsDIQxJJ8kVP3z12mAkV0K6At2JRDomS', '0260', 8, NULL, NULL, 1, '2024-08-02 15:43:55', NULL, NULL),
(262, 'febri', '$2y$10$PW52r41RioqrqPb9lrNQwua8F3ZrSTLfNg6gnjPtIqyZdhk.oVP.u', '0261', 3, NULL, NULL, 1, '2024-08-02 15:43:55', NULL, NULL),
(263, 'elsa', '$2y$10$CKAltsE7GAa4MN1gpOVWJ.D/rF9lf1u.z8BZR/5fc4UsZ/VUlf1Ze', '0262', 6, NULL, NULL, 1, '2024-08-02 15:43:56', NULL, NULL),
(264, 'farida', '$2y$10$CBqF5Kxg43Y5kyY4rOaVEOxEy/zFZQ1HAcJfjgtK9oynTgUMu.QZe', '0263', 6, NULL, NULL, 1, '2024-08-02 15:43:56', 113, '2024-08-19 14:28:55'),
(265, 'rafi', '$2y$10$aFGDmPzLhCPc33Lr2TjORuSfM/buPlTmkXYqO27KI3r477LHqhew.', '0264', 8, NULL, NULL, 1, '2024-08-02 15:43:56', NULL, NULL),
(266, 'devi', '$2y$10$FQy.m2xoY4s8NgcLrH0du.2LzUc/miNKnvlObhGgiLO1mVZvAYuD6', '0265', 4, NULL, NULL, 1, '2024-08-02 15:43:56', NULL, NULL),
(267, 'bundan', '$2y$10$66sz.L71hV3DOiNpgdFlj.xD.4gTYlITD1QtPNDAXOIrh9FcmHdk6', '0266', 8, NULL, NULL, 1, '2024-08-02 15:43:56', NULL, NULL),
(268, 'nuri', '$2y$10$khWzcuVOjc0ioBS9gjD75.w92KvRzb4dksvpHvFK3E.LT2PbJJhMO', '0267', 8, NULL, NULL, 1, '2024-08-02 15:43:56', 44, '2024-08-20 11:37:44'),
(269, 'ardhian', '$2y$10$Unao./puWD.aB1w33FBUzu.eO5afUUpsaY2zI9yJK9uplJO6m0lRO', '0268', 8, NULL, NULL, 1, '2024-08-02 15:43:56', NULL, NULL),
(270, 'rahmadade', '$2y$10$/19yODxMa9b.bVW8Ry8V1ubiY80o1AgjBJrq2lZcDpDxsQho8I8o2', '0269', 8, NULL, NULL, 1, '2024-08-02 15:43:56', NULL, NULL),
(271, 'bakti', '$2y$10$jQdxnbMc6V9vfpo828Mu7OMUpPaaA6QrrTWsRFQeyUokwYzR3Y3Le', '0270', 8, NULL, NULL, 1, '2024-08-02 15:43:56', NULL, NULL),
(272, 'laode', '$2y$10$OgYEFYyu/FUXODbxCkrWdeTUSY/d/Muy4oSMzPG6MqK.KXgWffqOW', '0271', 8, NULL, NULL, 1, '2024-08-02 15:43:56', NULL, NULL),
(273, 'ilmi', '$2y$10$kEL5xlI4XTCmzci1iwvbGOp6Ku9e7raOU5kSMww0xC6YkHuiWSNJ6', '0272', 8, NULL, NULL, 1, '2024-08-02 15:43:56', 44, '2024-08-20 13:42:12'),
(274, 'fernando', '$2y$10$SpUJ2AkSlhxZXTKf66jZH.3G6hzCQnpLnef2LEOeDH1K0IAWPeAh.', '0273', 8, NULL, NULL, 1, '2024-08-02 15:43:56', NULL, NULL),
(275, 'narendra', '$2y$10$fhCfbFkYXl1tCLmDBKsl1OB0AexqDQQ8WkrzJ5N396BZDOtD45Idu', '0274', 8, NULL, NULL, 1, '2024-08-02 15:43:56', 44, '2024-08-20 13:34:58'),
(276, 'ralga', '$2y$10$x2whBfNU1kKtXGdHy3FfqeOq572cXXeyQ.GBecw7MgjE1dvn1.35O', '0275', 8, NULL, NULL, 1, '2024-08-02 15:43:56', 44, '2024-08-20 13:35:58'),
(277, 'ekamurnia', '$2y$10$yoiZLWsK7Zr7o8H3qvmjU.LoOL2LJntyDFuk0RgXSvpKLSBVS6uOu', '0276', 8, NULL, NULL, 1, '2024-08-02 15:43:57', NULL, NULL),
(278, 'tito', '$2y$10$WF5QTxlCVeOXM/vifnRKW.E1XF/7rGmt1EQJ/aVbugBNquKxWuy/u', '0277', 8, NULL, NULL, 1, '2024-08-02 15:43:57', NULL, NULL),
(279, 'arroyan', '$2y$10$Dyf1f7t71xdUIGeeFbHKt.BAmyt1P/0x6Pjl5xqH/JcOqIjrWMp2.', '0278', 8, NULL, NULL, 1, '2024-08-02 15:43:57', NULL, NULL),
(280, 'andika', '$2y$10$huncw8ABFH.wF50vLy8gzOLBPWLYTHUJXauxA7NdVCdMK9UeS.l3.', '0279', 8, NULL, NULL, 1, '2024-08-02 15:43:57', NULL, NULL),
(281, 'nurrindra', '$2y$10$Tq4J/GzJnPE/q0pak3Kafun8FMm2Yin26RrBXqYxRA4hF4lhcp0AS', '0280', 8, NULL, NULL, 1, '2024-08-02 15:43:57', NULL, NULL),
(282, 'dedi', '$2y$10$mkYWqhYDVvmpRkcuHQm37uMaXrCcOYJ0CZ1aj0v2ApMXUQN83QjyK', '0281', 8, NULL, NULL, 1, '2024-08-02 15:43:57', NULL, NULL),
(283, 'desy', '$2y$10$2MtUgF28uW/QTW0yuzxGzuYNvNTaXQATjqSbuCvu88/dIkhoj53j.', '0282', 8, NULL, NULL, 1, '2024-08-02 15:43:57', NULL, NULL),
(284, 'ivana', '$2y$10$9.dYWeeRJW6Qoh.GHYu2IOsOP3d8lKCXHErstTTXOyZku5wtXzNFS', '0283', 8, NULL, NULL, 1, '2024-08-02 15:43:57', NULL, NULL),
(285, 'adihidayat', '$2y$10$lqrSErsJ8vfj4bQCrpG3WelSdqf8XWZOE8rfe6z4ayT7eX/aR0dd.', '0284', 8, NULL, NULL, 1, '2024-08-02 15:43:57', NULL, NULL),
(286, 'tegarherawan', '$2y$10$y9Q.3D6lyDvhMgQts4CCUOnO24pdfxE/pEF/Nrdy06fn3JaeiQx36', '0285', 8, NULL, NULL, 1, '2024-08-02 15:43:57', NULL, NULL),
(287, 'atud', '$2y$10$Dn5wp6U7ukCIQPVxgwI9Fe3UfJA0EG20.RqhMxuX837BqlPrsiTHW', '0286', 8, NULL, NULL, 1, '2024-08-02 15:43:57', NULL, NULL),
(288, 'vitra', '$2y$10$d3kNPEq4bVvpl3phjfZbuuvRY311pWAKq5.DfdyYO8FJQCiXOYNWm', '0287', 8, NULL, NULL, 1, '2024-08-02 15:43:57', NULL, NULL),
(289, 'cahyasaputro', '$2y$10$tx/kAPLgVS90ScuZJPj.HuQpjuATqDl7R5F62P6BEpOlPFEb0Fwja', '0288', 8, NULL, NULL, 1, '2024-08-02 15:43:57', NULL, NULL),
(290, 'dyah', '$2y$10$qTjfqLUeO2EO4UL5OOc2X.lvzfwsT6scey407rPJ1YRXkDlowklue', '0289', 8, NULL, NULL, 1, '2024-08-02 15:43:58', 44, '2024-08-20 13:42:57'),
(291, 'afri', '$2y$10$WjYLpHYvFGNJ.CuYXgxZJuBq7SQrYwPKl4ENGGxCMQNrze5VrtNy2', '0290', 8, NULL, NULL, 1, '2024-08-02 15:43:58', 44, '2024-08-20 11:24:15'),
(292, 'darma', '$2y$10$L57MOM/AtYhghaO7KtcOtOW5nV8NELO2UWopkeQSN6v1VTnqxQy6G', '0291', 8, NULL, NULL, 1, '2024-08-02 15:43:58', NULL, NULL),
(293, 'gilang', '$2y$10$kAewyZtuhiMVjpxdayjZ6uVEkFP7oWOWlCeKhnZmU50d1BKoqd.Q.', '0292', 8, NULL, NULL, 1, '2024-08-02 15:43:58', NULL, NULL),
(294, 'elda', '$2y$10$VxO2HLYJ6AbRbsdXzTSfT.8aafnO30gJjMeRJvs8ZDUpKhmHaokWq', '0293', 8, NULL, NULL, 1, '2024-08-02 15:43:58', NULL, NULL),
(295, 'indrawati', '$2y$10$NhQgTzu9GQ5Nbnt3PX86zuZXh/I8gTNH/otdcPLbpmoqPuQAmhXlS', '0294', 8, NULL, NULL, 1, '2024-08-02 15:43:58', NULL, NULL),
(296, 'anggraini', '$2y$10$8KDKcy6MNJiTwfrDOkOv5uVF0Nff7.AtBeqqjvg3N3p1P6abQnz1G', '0295', 8, NULL, NULL, 1, '2024-08-02 15:43:58', NULL, NULL),
(297, 'juang', '$2y$10$4NGGBt33F5g4DrlJPvYkzucATplGc.i/rURmJHHOwMoCFvH1mN2d.', '0296', 8, NULL, NULL, 1, '2024-08-02 15:43:58', NULL, NULL),
(298, 'sutari', '$2y$10$hrOP2lKAVOl0s13S1X.j9utAvLTK5//vodMyOo0HVXVEhtq7xJhAG', '0297', 8, NULL, NULL, 1, '2024-08-02 15:43:58', NULL, NULL),
(299, 'ginanjar', '$2y$10$8nkrJSksra006NoeAVkX/.8CjBUpFytgcna0muwumELHuL6McZS1G', '0298', 8, NULL, NULL, 1, '2024-08-02 15:43:58', NULL, NULL),
(300, 'ramadhanti', '$2y$10$HGgmm2zjXmVSWw7dSE1VZeuVqPOeUzw3si/dKR08jfbGxp3M.5V6m', '0299', 8, NULL, NULL, 1, '2024-08-02 15:43:58', NULL, NULL),
(301, 'dhito', '$2y$10$pSgfyTkiMng7T.hHgfJhBOX/omxVL0QUP9W4cG1aM8D.njbxRH.Wi', '0300', 8, NULL, NULL, 1, '2024-08-02 15:43:58', NULL, NULL),
(302, 'dinta', '$2y$10$bEDRJpQmOW7yWXAF8db7ye8UQdKAGqSh9xj8mXVHs7y6uZMzsP6v2', '0301', 8, NULL, NULL, 1, '2024-08-02 15:43:58', NULL, NULL),
(303, 'zehroh', '$2y$10$VDokUlDJ0DyjobO7Jaq7teDLjETmCr9k441KwsF1VreLcrnf7R.Qq', '0302', 8, NULL, NULL, 1, '2024-08-02 15:43:58', NULL, NULL),
(304, 'raihan', '$2y$10$MezRlP4aDaXlbmhQ/4JoN.ZnLUMeUccVpHyA96YAD3odnuI7d1w2a', '0303', 8, NULL, NULL, 1, '2024-08-02 15:43:59', NULL, NULL),
(305, 'yanuar', '$2y$10$PR6/KpBDl3dS/Bwhk5WYZeGRF2ulw42UPvq0izJ3R9FxP2KuBheBK', '0304', 8, NULL, NULL, 1, '2024-08-02 15:43:59', NULL, NULL),
(306, 'dwiamandaris', '$2y$10$pw8pA8sbT8yBAP7a9mED8..GPNv7PL8f8Bc3WycgpY2pm1mAnVtta', '0305', 8, NULL, NULL, 1, '2024-08-02 15:43:59', NULL, NULL),
(307, 'kristianto', '$2y$10$U/nXai/k8gCa31tGXXp3dOovGQP.s8EyYg0aebRhC6xzygUvb4P7a', '0306', 8, NULL, NULL, 1, '2024-08-02 15:43:59', NULL, NULL),
(308, 'abilutfi', '$2y$10$ehLAKWuxicG56An8GNJhkObcSNAMH7TSsdByqcdTmgI9N6SctSlyW', '0307', 8, NULL, NULL, 1, '2024-08-02 15:43:59', NULL, NULL),
(309, 'arifsyarifudin', '$2y$10$YOP/46H7t/c8wmIl18T9QeiZQweF1ocR9WvHkSHYHSuJ8bExlzEfW', '0308', 8, NULL, NULL, 1, '2024-08-02 15:43:59', NULL, NULL),
(310, 'dhaniasrori', '$2y$10$81B3Rk4OXd4s3xwyejacA.Wmhq8GyLoJtyRyqA0q09UaeT1rwgC6i', '0309', 8, NULL, NULL, 1, '2024-08-02 15:43:59', NULL, NULL),
(311, 'fajarhandoko', '$2y$10$GwsPCrs7L2u7MfjHriLXSeZVSBwdcPpM7AMuaB2vQZchJuXpDoe/a', '0310', 8, NULL, NULL, 1, '2024-08-02 15:43:59', NULL, NULL),
(312, 'irfan', '$2y$10$DB10eePxwMH8nOhsJAVqDesVOQxRThkhEPdYM4H1d/oRGJxYbx2BC', '0311', 8, NULL, NULL, 1, '2024-08-02 15:43:59', NULL, NULL),
(313, 'rizkafatma', '$2y$10$8GXMLaJELqGSV.w6Ian6HeWruTBtujyV6brfTRfRT1P5bF4bjGhfi', '0312', 8, NULL, NULL, 1, '2024-08-02 15:43:59', NULL, NULL),
(314, 'hasanpambudi', '$2y$10$f29C8auZzA4VpMSlXLAsGuGfPNzgBcgWzLYaxdD22vpSHPWMACJ9e', '0313', 8, NULL, NULL, 1, '2024-08-02 15:43:59', NULL, NULL),
(315, 'adisaputro', '$2y$10$Zm78tu9BKrd1llqmXe4y6eB8lUBnGwL9qm2lOIb4BeZeVT991GdaC', '0314', 8, NULL, NULL, 1, '2024-08-02 15:43:59', NULL, NULL),
(316, 'anisa', '$2y$10$6pL3W5mUbaFdTm6RlMk09uTVJ53cqgWuwyWwmPv0iCpXUgKnUw1vS', '0315', 8, NULL, NULL, 1, '2024-08-02 15:43:59', NULL, NULL),
(317, 'fauziah', '$2y$10$YR.z.rW2KHRT2ILmVM434eg/aM/niEcSI3iLNX6KtzHdIu107rOkG', '0316', 8, NULL, NULL, 1, '2024-08-02 15:44:00', NULL, NULL),
(318, 'adamrosies', '$2y$10$qnZEaic/LhxKKoNccJ1Q0.v23GDZZeHPUXqMZyljDjuuxukgkUu9.', '0317', 8, NULL, NULL, 1, '2024-08-02 15:44:00', NULL, NULL),
(319, 'ifan', '$2y$10$MvIe3D3cFzo/ipG4.XOTdej3nEz9oJGKq3jb.9fMD/jk8k3jWQKU2', '0318', 8, NULL, NULL, 1, '2024-08-02 15:44:00', NULL, NULL),
(320, 'jati', '$2y$10$YPUsD/gP1fiZtpT6EFuwTO7KsgIcny1U.Y/8jFY9jmCjB.QHdVXY6', '0319', 8, NULL, NULL, 1, '2024-08-02 15:44:00', NULL, NULL),
(321, 'auzi', '$2y$10$/nB0pcKw7Uv4TjbNa87l6O2Rcxcgj0ZO6RjRks52ErntS9MrcIA9e', '0320', 8, NULL, NULL, 1, '2024-08-02 15:44:00', NULL, NULL),
(322, 'tiwi', '$2y$10$.wYcY7OdLkOK1sLsNczAsus2wWfQrP1LjIYhScHhBmoHJ2Su62Zg6', '0321', 2, NULL, NULL, 1, '2024-08-02 15:44:00', 44, '2024-08-13 15:21:09'),
(323, 'yani', '$2y$10$ed1uXuZ6OSLAWuc7b4orE.AM45FX0X41tJ4m/OE0B28mR.gs6PTR.', '0322', 8, NULL, NULL, 1, '2024-08-02 15:44:00', NULL, NULL),
(324, 'arwan', '$2y$10$Qm8WZhbm00Kd4HhcIV1gtuAAEOtirIBzckSpYtV6tZcv98jiVujOa', '0323', 8, NULL, NULL, 1, '2024-08-02 15:44:00', 44, '2024-08-20 11:25:54'),
(325, 'bagas', '$2y$10$oGSIhbscgqQY72S5Lj6CfeYhGqV2tfq2Gxp.BzH6MFd.IVgm4vpXK', '0324', 4, NULL, NULL, 1, '2024-08-02 15:44:00', NULL, NULL),
(326, 'mira', '$2y$10$wn86Ur71oib3HiH/9diGk.YI7GcjdrtK58dNpSNcfnjZ1cdxhqYcy', '0325', 8, NULL, NULL, 1, '2024-08-02 15:44:00', NULL, NULL),
(327, 'ekawidyasari', '$2y$10$YrqvyiJ5vfYMMV0yV4ATNufcrqpVtK0ZSAcWxHMwkUh9iws85QRn2', '0326', 8, NULL, NULL, 1, '2024-08-02 15:44:00', NULL, NULL),
(329, 'suryawan', '$2y$10$MNwM3DGVd4bOHBMQ5RILWOnGPABU8eykimiFoUDshFuKgHBPTVmp.', '0327', 8, NULL, NULL, 44, '2024-08-14 16:31:51', NULL, NULL),
(330, 'bastian', '$2y$10$Wy2BJMucPmLHtUnOJpg9WOfL6H2MBnXJdc17jQ.GOwzIFG8cZlfza', '0328', 8, NULL, NULL, 44, '2024-08-14 16:34:51', NULL, NULL),
(331, 'roeni', '$2y$10$e1WU4aNoayXPq2lKK/0KRuJfVUItwAqta92Il3Br2E0cL0mmCuceu', '0329', 8, NULL, NULL, 44, '2024-08-14 16:37:52', 44, '2024-08-20 11:40:00'),
(332, 'mardiana', '$2y$10$pYOvX14DQ1XDQtXszz.Ov.D4UF0h05x49aMM3I6X4ZiVXBnvZix2y', '0330', 8, NULL, NULL, 44, '2024-08-14 16:42:19', 44, '2024-08-20 11:50:07'),
(333, 'ristya', '$2y$10$FKrJSqrML8K6HwPV26LMVu3HA34QQQTNFv6IDvDbqzx77LEaLzH.q', '0331', 8, NULL, NULL, 44, '2024-08-14 16:45:56', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indeks untuk tabel `tbl_approval_cuti`
--
ALTER TABLE `tbl_approval_cuti`
  ADD PRIMARY KEY (`id_approval`);

--
-- Indeks untuk tabel `tbl_approval_izin`
--
ALTER TABLE `tbl_approval_izin`
  ADD PRIMARY KEY (`id_approval_izin`);

--
-- Indeks untuk tabel `tbl_approval_izinharian`
--
ALTER TABLE `tbl_approval_izinharian`
  ADD PRIMARY KEY (`id_approval_izinharian`);

--
-- Indeks untuk tabel `tbl_approval_tugas`
--
ALTER TABLE `tbl_approval_tugas`
  ADD PRIMARY KEY (`id_approval_tugas`);

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tbl_divisi`
--
ALTER TABLE `tbl_divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indeks untuk tabel `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `tbl_kendaraan`
--
ALTER TABLE `tbl_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indeks untuk tabel `tbl_kerusakan_barang`
--
ALTER TABLE `tbl_kerusakan_barang`
  ADD PRIMARY KEY (`id_kerusakan_barang`);

--
-- Indeks untuk tabel `tbl_kerusakan_ruangan`
--
ALTER TABLE `tbl_kerusakan_ruangan`
  ADD PRIMARY KEY (`id_kerusakan_ruangan`);

--
-- Indeks untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `tbl_penanganan_barang`
--
ALTER TABLE `tbl_penanganan_barang`
  ADD PRIMARY KEY (`id_penanganan_barang`);

--
-- Indeks untuk tabel `tbl_penanganan_ruangan`
--
ALTER TABLE `tbl_penanganan_ruangan`
  ADD PRIMARY KEY (`id_penanganan_ruangan`);

--
-- Indeks untuk tabel `tbl_pengirimanpaket`
--
ALTER TABLE `tbl_pengirimanpaket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `tbl_perawatan_kendaraan`
--
ALTER TABLE `tbl_perawatan_kendaraan`
  ADD PRIMARY KEY (`id_perawatan_kendaraan`);

--
-- Indeks untuk tabel `tbl_perawatan_ruangan`
--
ALTER TABLE `tbl_perawatan_ruangan`
  ADD PRIMARY KEY (`id_perawatan_ruangan`);

--
-- Indeks untuk tabel `tbl_perizinan_cuti`
--
ALTER TABLE `tbl_perizinan_cuti`
  ADD PRIMARY KEY (`id_cuti`);

--
-- Indeks untuk tabel `tbl_perizinan_harian`
--
ALTER TABLE `tbl_perizinan_harian`
  ADD PRIMARY KEY (`id_perizinan_harian`);

--
-- Indeks untuk tabel `tbl_perizinan_izin`
--
ALTER TABLE `tbl_perizinan_izin`
  ADD PRIMARY KEY (`id_izin`);

--
-- Indeks untuk tabel `tbl_perizinan_tugas`
--
ALTER TABLE `tbl_perizinan_tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indeks untuk tabel `tbl_perpanjangan_kontrak`
--
ALTER TABLE `tbl_perpanjangan_kontrak`
  ADD PRIMARY KEY (`id_perpanjangan`);

--
-- Indeks untuk tabel `tbl_pinjam_barang`
--
ALTER TABLE `tbl_pinjam_barang`
  ADD PRIMARY KEY (`id_pinjam_barang`);

--
-- Indeks untuk tabel `tbl_pinjam_ruangan`
--
ALTER TABLE `tbl_pinjam_ruangan`
  ADD PRIMARY KEY (`id_pinjam_ruangan`);

--
-- Indeks untuk tabel `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indeks untuk tabel `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indeks untuk tabel `tbl_satpam_pembelian`
--
ALTER TABLE `tbl_satpam_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `tbl_satpam_saldo`
--
ALTER TABLE `tbl_satpam_saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indeks untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_approval_cuti`
--
ALTER TABLE `tbl_approval_cuti`
  MODIFY `id_approval` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_approval_izin`
--
ALTER TABLE `tbl_approval_izin`
  MODIFY `id_approval_izin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_approval_izinharian`
--
ALTER TABLE `tbl_approval_izinharian`
  MODIFY `id_approval_izinharian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_approval_tugas`
--
ALTER TABLE `tbl_approval_tugas`
  MODIFY `id_approval_tugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_divisi`
--
ALTER TABLE `tbl_divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_kendaraan`
--
ALTER TABLE `tbl_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_kerusakan_barang`
--
ALTER TABLE `tbl_kerusakan_barang`
  MODIFY `id_kerusakan_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_kerusakan_ruangan`
--
ALTER TABLE `tbl_kerusakan_ruangan`
  MODIFY `id_kerusakan_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT untuk tabel `tbl_penanganan_barang`
--
ALTER TABLE `tbl_penanganan_barang`
  MODIFY `id_penanganan_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_penanganan_ruangan`
--
ALTER TABLE `tbl_penanganan_ruangan`
  MODIFY `id_penanganan_ruangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengirimanpaket`
--
ALTER TABLE `tbl_pengirimanpaket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_perawatan_kendaraan`
--
ALTER TABLE `tbl_perawatan_kendaraan`
  MODIFY `id_perawatan_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_perawatan_ruangan`
--
ALTER TABLE `tbl_perawatan_ruangan`
  MODIFY `id_perawatan_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT untuk tabel `tbl_perizinan_cuti`
--
ALTER TABLE `tbl_perizinan_cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_perizinan_harian`
--
ALTER TABLE `tbl_perizinan_harian`
  MODIFY `id_perizinan_harian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_perizinan_izin`
--
ALTER TABLE `tbl_perizinan_izin`
  MODIFY `id_izin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_perizinan_tugas`
--
ALTER TABLE `tbl_perizinan_tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_perpanjangan_kontrak`
--
ALTER TABLE `tbl_perpanjangan_kontrak`
  MODIFY `id_perpanjangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `tbl_pinjam_barang`
--
ALTER TABLE `tbl_pinjam_barang`
  MODIFY `id_pinjam_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `tbl_pinjam_ruangan`
--
ALTER TABLE `tbl_pinjam_ruangan`
  MODIFY `id_pinjam_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_satpam_pembelian`
--
ALTER TABLE `tbl_satpam_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_satpam_saldo`
--
ALTER TABLE `tbl_satpam_saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
