<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "login";
$route['admin'] = "login/admin";
$route['admin-login'] = "login/adminLogin";
$route['404_override'] = 'error';


/*********** MASTER DATA DEFINED ROUTES *******************/

// PEGAWAI
$route['Datapegawai'] = 'pegawai/listData';
$route['Datapegawainonaktif'] = 'pegawai/listDataNonAktif';

// SATPAM
$route['report-saldo'] = 'saldoSatpam/dataSaldo';
$route['satpam/pembelian-galon'] = 'transaksiSatpam';
$route['pembelian-galon'] = 'transaksiSatpam/report';

// RUANGAN
$route['Dataruangan'] = 'ruangan';
$route['deteleRuangan/(:num)'] = "ruangan/delete/$1";
$route['Pinjamruangan'] = 'ruangan/pinjamruangan';
$route['kerusakanRuangan'] = 'ruangan/listkerusakan';

// DEPARTEMENT
$route['Datadepartement'] = 'departement';
$route['deletedepartement/(:num)'] = "departement/delete/$1";
$route['divisi/(:any)'] = 'divisi/listdata/$1';

// DIVISI
$route['Datadivisi'] = 'divisi';
$route['deteledivisi/(:num)'] = "divisi/delete/$1";

// BARANG
$route['Databarang'] = 'barang';
$route['detelebarang/(:num)'] = "barang/delete/$1";
$route['Pinjambarang'] = 'barang/pinjambarang';
$route['kerusakanBarang'] = 'barang/listkerusakan';
$route['Peminjamanbarang'] = 'barang/peminjamanbarang';
$route['Formpeminjaman'] = 'barang/formpeminjaman';
$route['Booking'] = 'barang/booking';
$route['SimpanPeminjaman'] = 'barang/booking';

// KENDARAAN
$route['Datakendaraan'] = 'kendaraan';

// ABSENSI
$route['Absensi'] = 'absensi';
$route['Absensi-visit'] = 'absensi/absensi_visit';
$route['Absensi-visit/(:any)'] = 'absensi/Webcam_visit/$1';

$route['kehadiran/(:any)'] = 'absensi/Webcam/$1';
$route['laporanAbsensi'] = 'absensi/laporan';
$route['cekkoordinat/(:any)/(:any)'] = 'absensi/cekkoordinat/$1/$2';

// ABSENSI PEGAWAI HARIAN
$route['PHL/kehadiran'] = 'absensiPegawaiHarian';
$route['PHL/Absensi'] = 'absensiPegawaiHarian/listdata';
$route['PHL/kehadiran/(:any)'] = 'absensiPegawaiHarian/Webcam/$1';
$route['PHL/exportExcel'] = 'absensiPegawaiHarian/exportExcel';
$route['laporanAbsensiPHL'] = 'absensiPegawaiHarian/laporan';
$route['satpam/laporanAbsensiPHL'] = 'absensiPegawaiHarian/laporanSatpam';

/*********** PERIZINAN DEFINED ROUTES *******************/

// CUTI
$route['cuti'] = 'perizinan/listcuti';
$route['approvalCuti/(:any)/(:any)'] = 'perizinan/approvalCuti/$1/$2';
$route['approvalPengganti/(:any)/(:any)'] = 'perizinan/approvalCuti/$1/$2';
$route['pengajuanCuti'] = 'perizinan/listPengajuanCuti';
$route['approvalPengganti'] = 'perizinan/approvalPengganti';

// SURAT TUGAS
$route['tugas'] = 'suratTugas/listtugas';
$route['approvalTugas/(:any)/(:any)'] = 'suratTugas/approvalTugas/$1/$2';
$route['pengajuanTugas'] = 'suratTugas/listPengajuanTugas';

// IZIN Harian
$route['izin-harian'] = 'izinHarian/listIzinHarian';
$route['approvalIzinHarian/(:any)/(:any)'] = 'izinHarian/approvalIzinHarian/$1/$2';
$route['pengajuanIzinHarian'] = 'izinHarian/listPengajuanIzinHarian';

// IZIN
$route['izin'] = 'izin/listIzin';
$route['approvalIzin/(:any)/(:any)'] = 'izin/approvalIzin/$1/$2';
$route['pengajuanIzin'] = 'izin/listPengajuanIzin';

/*********** EVALUASI KINERJA DEFINED ROUTES *******************/
$route['addJadwalEvaluasi'] = 'evaluasiKerja/jadwalEvaluasiKerja';
$route['penilaianEvaluasi'] = 'evaluasiKerja';
$route['hasilEvaluasi/(:any)'] = 'evaluasiKerja/hasilEvaluasi/$1';
$route['penilaian/(:any)'] = 'evaluasiKerja/penilaian/$1';

$route['kategori-soal'] = 'evaluasiKerja/kategori';
$route['list-soal/(:any)'] = 'evaluasiKerja/listSoal/$1';
$route['hapusKategori/(:any)/(:any)'] = 'evaluasiKerja/hapusKategori/$1/$2';

//SAMPLE
$route['sample-masuk'] = 'sample/listdata';
$route['sample-masuk/(:any)/(:any)'] = 'sample/updateStatus/$1/$2';

$route['permintaan-sample'] = 'sample/dataPermintaan';
$route['uji-sample/(:any)'] = 'sample/dataUji/$1';

$route['update-status-permintaan/(:any)/(:any)'] = 'sample/updateStatusPermintaan/$1/$2';

/*********** USER DEFINED ROUTES *******************/
$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['dashboardUser'] = 'user/dashboardUser';
$route['peminjaman'] = 'user/peminjaman';
$route['logout'] = 'user/logout';
$route['userListing'] = 'user/userListing';
$route['userListing/(:num)'] = "user/userListing/$1";

$route['addNew'] = "user/addNew";
$route['addNewUser'] = "user/addNewUser";
$route['editOld'] = "user/editOld";
$route['editOld/(:num)'] = "user/editOld/$1";
$route['editUser'] = "user/editUser";
$route['deleteUser'] = "user/deleteUser";
$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";

$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

/* End of file routes.php */
/* Location: ./application/config/routes.php */