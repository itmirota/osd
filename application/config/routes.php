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
$route['daftar-hadir'] = 'DaftarHadir';
$route['laporan-daftar-hadir'] = 'DaftarHadir/laporan';

$route['area-kerja'] = 'areaKerja';
$route['kirimpaket'] = 'pengirimanpaket/save';


/*********** MASTER DATA DEFINED ROUTES *******************/

// PEGAWAI
$route['Datapegawai'] = 'pegawai/listData';
$route['Datapegawainonaktif'] = 'pegawai/listDataNonAktif';

$route['api/karyawan'] = 'api/PegawaiController/index';
$route['api/karyawan/store'] = 'api/PegawaiController/store';

// SATPAM
$route['report-saldo'] = 'saldoSatpam/dataSaldo';
$route['satpam/pembelian-galon'] = 'transaksiSatpam';
$route['pembelian-galon'] = 'transaksiSatpam/report';

// RUANGAN
$route['Dataruangan'] = 'ruangan';
$route['deleteRuangan/(:num)'] = "ruangan/delete/$1";
$route['Pinjamruangan'] = 'ruangan/pinjamruangan';
$route['kerusakanRuangan'] = 'ruangan/listkerusakan';
$route['deletePinjamRuangan/(:num)'] = "ruangan/deletePinjam/$1";

$route['laporan-kebersihan'] = "kebersihan/report";

// DEPARTEMENT
$route['Datadepartement'] = 'departement';
$route['deletedepartement/(:num)'] = "departement/delete/$1";
$route['divisi/(:num)'] = 'divisi/divisiByDept/$1';

// DIVISI
$route['Datadivisi'] = 'divisi';
$route['Subdivisi/(:num)'] = 'divisi/getSubDivisi/$1';
$route['deletedivisi/(:num)'] = "divisi/delete/$1";

// BAGIAN
$route['Databagian'] = 'bagian';
$route['bagian/(:num)'] = 'bagian/bagianByDivisi/$1';
$route['deletebagian/(:num)'] = "bagian/delete/$1";

// BARANG
$route['Databarang'] = 'barang';
$route['deletebarang/(:num)'] = "barang/delete/$1";
$route['Pinjambarang'] = 'barang/pinjambarang';

$route['data-pinjam-barang'] = 'barang/pinjambarang';
$route['save-pinjam-barang'] = 'barang/pinjambarang';

$route['kerusakanBarang'] = 'barang/listkerusakan';
$route['Formpeminjaman'] = 'barang/formpeminjaman';
$route['booking/(:any)'] = 'barang/booking/$1';
$route['SimpanPeminjaman'] = 'barang/booking';

// KENDARAAN
$route['Datakendaraan'] = 'kendaraan';
$route['deletekendaraan/(:num)'] = "kendaraan/delete/$1";

// ABSENSI
$route['Absensi'] = 'absensi';
$route['Absensi-visit'] = 'absensi/absensi_visit';
$route['Absensi-visit/(:any)'] = 'absensi/Webcam_visit/$1';
$route['export-excel-absensi/(:any)/(:any)/(:any)'] = 'absensi/exportExcel/$1/$2/$3';

$route['kehadiran/(:any)'] = 'absensi/Webcam/$1';
$route['laporanAbsensi'] = 'absensi/laporan';
$route['cekkoordinat/(:any)/(:any)'] = 'absensi/cekkoordinat/$1/$2';

// ABSENSI MESIN
$route['laporan-absensi-mesin'] = 'absensi/laporan_absensi_mesin';
$route['input-absensi-mesin'] = 'absensi/input_absensi_mesin';

// ABSENSI PEGAWAI HARIAN
$route['PHL/kehadiran'] = 'absensiPegawaiHarian';
$route['PHL/Absensi'] = 'absensiPegawaiHarian/listdata';
$route['PHL/kehadiran/(:any)'] = 'absensiPegawaiHarian/Webcam/$1';
$route['PHL/exportExcel'] = 'absensiPegawaiHarian/exportExcel';
$route['laporanAbsensiPHL'] = 'absensiPegawaiHarian/laporan';

// ABSEN TOKO
$route['absen-toko'] = 'AbsensiTokoManual';
$route['laporan-absen-toko'] = 'AbsensiTokoManual/laporan';

// ABSEN Istirahat
$route['istirahat'] = 'absensi/istirahat';
$route['istirahat/(:any)'] = 'absensi/absensiIstirahat/$1';
$route['laporan-istirahat'] = 'absensi/laporanIstirahat';
$route['export-excel-istirahat'] = 'absensi/exportExcelIstirahat';

// DATA Pelanggaran
$route['pelanggaran-karyawan'] = 'pelanggaran';
$route['deletepelanggaran/(:num)'] = 'pelanggaran/delete/$1';


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
$route['penilaian/(:any)'] = 'evaluasiKerja/penilaian_v31/$1';
// $route['penilaian-v2/(:any)'] = 'evaluasiKerja/penilaian_v2/$1';
// $route['penilaian-v21/(:any)'] = 'evaluasiKerja/penilaian_v21/$1';
// $route['penilaian-v3/(:any)'] = 'evaluasiKerja/penilaian_v3/$1';
// $route['penilaian-v31/(:any)'] = 'evaluasiKerja/penilaian_v31/$1';
/*********** EVALUASI KINERJA DEFINED ROUTES *******************/

/*********** EVALUASI SPV DEFINED ROUTES *******************/
$route['jadwal-evaluasi-spv'] = 'evaluasiSpv/jadwalEvaluasiSpv';
$route['penilaian-evaluasi-spv'] = 'evaluasiSpv';
$route['hasil-evaluasi-spv/(:any)'] = 'evaluasiSpv/hasilSpv/$1';
$route['penilaian-spv/(:any)'] = 'evaluasiSpv/penilaian_v31/$1';
/*********** EVALUASI KINERJA DEFINED ROUTES *******************/

/*********** EVALUASI KINERJA DEFINED ROUTES *******************/
$route['jadwal-evaluasi-magang'] = 'evaluasiMagang/jadwalevaluasiMagang';
$route['penilaian-evaluasi-magang'] = 'evaluasiMagang';
$route['hasil-evaluasi-magang/(:any)'] = 'evaluasiMagang/hasilEvaluasi/$1';
$route['penilaian-magang/(:any)'] = 'evaluasiMagang/penilaian_v31/$1';
/*********** EVALUASI KINERJA DEFINED ROUTES *******************/

/*********** EVALUASI PROMOSI DEFINED ROUTES *******************/
$route['jadwal-evaluasi-promosi'] = 'evaluasiPromosi/jadwalEvaluasiPromosi';
$route['penilaian-evaluasi-promosi'] = 'evaluasiPromosi';
$route['hasil-evaluasi-promosi/(:any)'] = 'evaluasiPromosi/hasilEvaluasi/$1';
$route['penilaian-promosi/(:any)'] = 'evaluasiPromosi/penilaian_v31/$1';
$route['penilaian-promosi-v2/(:any)'] = 'evaluasiPromosi/penilaian_v2/$1';
$route['penilaian-promosi-v21/(:any)'] = 'evaluasiPromosi/penilaian_v21/$1';
$route['penilaian-promosi-v3/(:any)'] = 'evaluasiPromosi/penilaian_v3/$1';
$route['penilaian-promosi-v31/(:any)'] = 'evaluasiPromosi/penilaian_v31/$1';
/*********** EVALUASI PROMOSI DEFINED ROUTES *******************/


//SAMPLE
$route['sample-masuk'] = 'sample/listdata';
$route['sample-masuk/(:any)/(:any)'] = 'sample/updateStatus/$1/$2';
$route['export-excel-sample/(:any)'] = 'sample/exportExcel/$1';

$route['permintaan-sample'] = 'sample/dataPermintaan';
$route['uji-sample/(:any)'] = 'sample/dataUji/$1';

$route['update-status-permintaan/(:any)/(:any)'] = 'sample/updateStatusPermintaan/$1/$2';

// DOKUMEN LEGAL
$route['dokumen-legal'] = 'dokumenLegal';

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