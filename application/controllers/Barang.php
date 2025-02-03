<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Barang extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $name = $this->session->userdata ( 'name' );

      $this->load->model('user_model');
      $this->load->model('crud_model');
      $this->load->model('master_model');
    
      if(isset($name)){
      $this->isLoggedIn();
      }
  }

  public function cetakQRCode(){
    $id_barang = $this->input->post('id_barang');
    $jumlah = $this->input->post('jumlah');

    $where = array(
      'id_barang' => $id_barang
    );

    $data = array(
      'barang' => $this->crud_model->GetDataByWhere($where,'tbl_barang'),
      'jumlah' => $jumlah
    );

    $this->load->view('barang/cetak',$data);
  }


  public function index(){
    $this->global['pageTitle'] = 'Admin Panel : Data Barang';
    $role = $this->role;
    $divisi = $this->divisi_id;


    if($role == ROLE_SUPERADMIN){
      $data['list_data']= $this->master_model->getDataBarang(0);
    }else{
      $data['list_data']= $this->master_model->getDataBarang($divisi);
    }
    
    $data['departement']= $this->crud_model->lihatdata('tbl_departement');
    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');
    $data['id_divisi']= $divisi;

    $this->loadViews("barang/data", $this->global, $data, NULL);
  }

  public function saveBarang(){
    $cekMaxId = $this->crud_model->cekMaxId('id_barang', 'tbl_barang');
    $id = $cekMaxId+1;
    $kode = 'barang';

    $nama_barang = $this->input->post('nama_barang');
    $tgl_pembelian = $this->input->post('tgl_pembelian');
    $lokasi_barang = $this->input->post('lokasi_barang');
    $stok_barang = $this->input->post('stok_barang');
    $keterangan_barang = $this->input->post('keterangan_barang');
    $spesifikasi_barang = $this->input->post('spesifikasi_barang');
    $userId = $this->uri->segment(3);
    $image_name = $this->generateBarcode($kode, $id);


    $data = array(
      'id_barang' => $id,
      'nama_barang' => $nama_barang,
      'tgl_pembelian' => $tgl_pembelian,
      'divisi_id' => $lokasi_barang,
      'stok_barang_normal' => $stok_barang,
      'keterangan_barang' => $keterangan_barang,
      'spesifikasi_barang' => $spesifikasi_barang,
      'qrcode_barang' => $image_name,
      'userId' => $userId
    );

    $sql = $this->crud_model->input($data,'tbl_barang');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('barang');
  }

  public function detailbarang($id) {

    $where = array(
      'id_barang' => $id
    );

    $barang = $this->crud_model->GetDataByWhere($where,'tbl_barang');
    echo json_encode($barang[0]);
  }

  public function cekStokBarang($id){
    $stok_barang = $this->master_model->cekStokBarang($id)->stok_barang_normal;

    echo json_encode($stok_barang);
  }

  public function detailkerusakanbarang($id) {

    $where = array(
      'id_kerusakan_barang' => $id
    );

    $kerusakanbarang = $this->crud_model->GetDataByWhere($where,'tbl_kerusakan_barang');
    echo json_encode($kerusakanbarang[0]);
  }

  public function update(){
    $id_barang = $this->input->post('id_barang');
    $nama_barang = $this->input->post('nama_barang');
    $tgl_pembelian = $this->input->post('tgl_pembelian');
    $divisi_id = $this->input->post('divisi_id');
    $kondisi_barang = $this->input->post('kondisi_barang');
    $stok_barang_normal = $this->input->post('stok_normal');
    $stok_barang_rusak = $this->input->post('stok_rusak');
    $keterangan_barang = $this->input->post('keterangan_barang');
    $spesifikasi_barang = $this->input->post('spesifikasi_barang');

    $where = array(
      'id_barang' => $id_barang
    );

    $data = array(
      'nama_barang' => $nama_barang,
      'tgl_pembelian' => $tgl_pembelian,
      'divisi_id' => $divisi_id,
      'stok_barang_normal' => $stok_barang_normal,
      'stok_barang_rusak' => $stok_barang_rusak,
      'keterangan_barang' => $keterangan_barang,
      'spesifikasi_barang' => $spesifikasi_barang
    );

    $sql = $this->crud_model->update($where, $data,'tbl_barang');

    if (isset($sql)){
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Diubah');
    }else{
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diubah');
    }

    redirect('barang');
  }

  public function delete(){
    $id_barang = $this->uri->segment(2);

    $where = array(
      'id_barang' => $id_barang
    );

    $this->crud_model->delete($where, 'tbl_barang');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('barang');
  }

  public function jadwalpinjam(){

    $divisi = $this->divisi_id;
    $list_data  = $this->master_model->getjadwalbarang($divisi);

    foreach ($list_data->result_array() as $row){

        $data[] = array(
            'id' => $row['id_pinjam_barang'],
            'title' => $row['nama_barang'].' | '.$row['nama_pegawai'].' '.$row['nama_divisi'].' | '.$row['jumlah_pinjam'].' pcs',
            'start' => $row['tgl_mulai'],
            'end' => $row['tgl_kembali']
        );
    }
    
    echo json_encode($data);
  }

  public function pinjambarang(){
    $this->global['pageTitle'] = 'OSD | PT Mirota KSM';
    
    $page = $this->uri->segment(1);
    $name = $this->name;
    $divisi = $this->divisi_id;

    $data['list_data'] = $this->master_model->getjadwalbarang($divisi)->result();
    $data['barang']= $this->crud_model->GetDataByWhere(['divisi_id' => $divisi],'tbl_barang');
    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');
    $data['departement']= $this->crud_model->lihatdata('tbl_departement');
    $data['pegawai']= $this->crud_model->lihatdata('tbl_pegawai');
    $data['name']= $name;
    $data['page']= $page;

    $this->global['pageHeader'] = 'Peminjaman Barang PT. Mirota KSM';

    if($page == 'Pinjambarang'){
    $this->loadViewsUser("barang/datapeminjaman", $this->global, $data, NULL);
    }else{
    $this->loadViews("barang/datapeminjaman", $this->global, $data, NULL);
    }
  }

  public function updateStokTersedia($barang_id, $cek_stok, $jumlah_barang){
    $cek_stok_dipinjam = $this->master_model->cekStokBarang($barang_id)->stok_barang_dipinjam;

    $stok_barang = $cek_stok - $jumlah_barang;
    $stok_barang_dipinjam = $cek_stok_dipinjam + $jumlah_barang;

    $stok = array(
      'stok_barang_normal' => $stok_barang,
      'stok_barang_dipinjam' => $stok_barang_dipinjam,
    );

    $where = array(
      'id_barang' => $barang_id,
    );

    $this->crud_model->update($where, $stok,'tbl_barang');
  }

  public function booking(){
    $page = $this->uri->segment(2);
    $barang_input = $this->input->post('barang_input');
    $barang_scan = $this->input->post('barang_scan');
    $jumlah_barang = $this->input->post('jumlah_barang');
    $pegawai_id = $this->input->post('pegawai_id');
    $tgl_mulai = $this->input->post('tgl_mulai');

    if($barang_scan != ""){
      $barang_id = $barang_scan;
    }else{
      $barang_id = $barang_input;
    }

    if(is_null($pegawai_id)){
      $pegawai_id = $this->global['pegawai_id'];
    }

    $cek_stok = $this->master_model->cekStokBarang($barang_id)->stok_barang_normal;

    $data = array(
      'barang_id' => $barang_id,
      'jumlah_pinjam' => $jumlah_barang,
      'pegawai_id' => $pegawai_id,
      'tgl_mulai' => $tgl_mulai,
    );


    if($cek_stok > 0){
      $this->updateStokTersedia($barang_id, $cek_stok, $jumlah_barang);

      $this->crud_model->input($data,'tbl_pinjam_barang');
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','STOK KOSONG!!!','Stok tidak cukup');
    }

    redirect($page);
  }

  public function detailpinjambarang($id) {
    $barang = $this->master_model->getPinjamBarangById($id);
    echo json_encode($barang[0]);
  }

  public function pengembalianbarang(){
    $id_pinjam_barang = $this->input->post('id_pinjam_barang');
    $jml_kembali = $this->input->post('jml_kembali');
    $tgl_kembali = $this->input->post('tgl_kembali');

    // update tanggal kembali
    $where  = array(
      'id_pinjam_barang' => $id_pinjam_barang,
    );

    $data = array(
      'tgl_kembali' => $tgl_kembali,
      'status_pinjam_barang' => 'I',
      'tgl_update' => DATE('Y-m-d H:i:s'),
      'updateId' => $this->vendorId
    );


    // update stok barang
    $barang = $this->master_model->getPinjamBarangById($id_pinjam_barang);

    foreach( $barang as $barang){
      $id_barang = $barang->id_barang;
    }

    $cek_stok = $this->master_model->cekStokBarang($id_barang)->stok_barang_normal;
    $cek_stok_dipinjam = $this->master_model->cekStokBarang($id_barang)->stok_barang_dipinjam;

    $stok_barang = $cek_stok + $jml_kembali;
    $stok_barang_dipinjam = $cek_stok_dipinjam - $jml_kembali;

    $wherestok = array(
      'id_barang' => $id_barang
    );

    $datastok = array(
      'stok_barang_normal' => $stok_barang,
      'stok_barang_dipinjam' => $stok_barang_dipinjam,
    );


    $updatestok = $this->crud_model->update($wherestok, $datastok,'tbl_barang');
    $pinjambarang = $this->crud_model->update($where, $data,'tbl_pinjam_barang');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('Pinjambarang');
  }

  public function detailpenerima($id) {
    $barang = $this->master_model->getPenerimaById($id);
    echo json_encode($barang[0]);
  }

  public function deletepinjamanbarang(){
    $id_pinjam_barang = $this->uri->segment(3);

    $where = array(
      'id_pinjam_barang' => $id_pinjam_barang
    );

    $this->crud_model->delete($where, 'tbl_pinjam_barang');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('Pinjambarang');
  }

  public function formpeminjaman(){

    $this->global['pageTitle'] = 'OSD | PT Mirota KSM';

    $data['departement']= $this->crud_model->lihatdata('tbl_departement');
    $this->global['pageHeader'] = 'Peminjaman Barang PT. Mirota KSM';


    $this->loadViewsUser("barang/formpeminjaman", $this->global, $data, NULL);
  }

  public function getBarangByDivisi($divisi){

    $barang = $this->master_model->getBarangByDivisi($divisi);

    echo json_encode($barang);
  }

  public function laporankerusakan(){
    $this->global['pageTitle'] = 'OSD | Asset Mirota';
      
    $this->global['pageHeader'] = 'Laporan Kerusakan barang';
    
    $data['barang']= $this->crud_model->lihatdata('tbl_barang');
    
    if($this->global['role'] == ROLE_STAFF){
      $this->loadViewsUser("barang/formlaporan", $this->global, $data, NULL);
    }else{
      $this->loadViews("barang/formlaporan", $this->global, $data, NULL);
    }
    
  }

  public function savelaporan(){
    $config['upload_path']          = FCPATH.'assets/foto_kerusakan_barang';
    $config['allowed_types']        = 'gif|jpg|png|PNG|jpeg|pdf';

    $barang_id = $this->input->post('barang_id');
    $jml_barang = $this->input->post('jml_barang');
    $keterangan_kerusakan_barang = $this->input->post('keterangan');

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('bukti_kerusakan'))
    {
      $this->set_notifikasi_swal('error','Gagal','Harus melampirkan bukti');
    }
    else
    {

      $file = $this->upload->data();
      $bukti_kerusakan = $file['file_name'];

      $data = array(
        'barang_id' => $barang_id,
        'jml_barang' => $jml_barang,
        'keterangan_kerusakan_barang' => $keterangan_kerusakan_barang,
        'bukti_kerusakan_barang' => $bukti_kerusakan,
        'datecreated' => date('Y-m-d H:i:s')
      );

      $this->crud_model->input($data,'tbl_kerusakan_barang');
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }

    redirect('barang/laporankerusakan');
  }

  public function listkerusakan(){
    $this->global['pageTitle'] = 'OSD | Asset Mirota';
    $this->global['pageHeader'] = 'Laporan Kerusakan barang';
    $id_divisi = $this->divisi_id;

    $data['list_data']= $this->master_model->getLaporanKerusakanBarang($id_divisi);
    
    $this->loadViews("barang/laporanKerusakan", $this->global, $data, NULL);
  }

  public function bacanotif(){
    $id_divisi = $this->divisi_id;


    $notif = $this->master_model->cekDataNotifBarang($id_divisi);

    foreach ($notif as $n) {
      $data = array(
        'is_read' => 1,
      );

      $where = array(
        'id_kerusakan_barang' => $n->id_kerusakan_barang
      );

      $this->crud_model->update($where, $data, 'tbl_kerusakan_barang');
    }
  }


  public function approvalPenanganan($id, $tgl_penanganan, $status){
    $penanganan = array(
      'kerusakan_barang_id' => $id,
      'tgl_penanganan' => $tgl_penanganan,
      'status' => $status
    );

    $this->crud_model->input($penanganan,'tbl_penanganan_barang');
  }

  public function updateStokBarang($barang_id, $jml_barang_rusak){
    $cek_stok_normal = $this->master_model->cekStokBarang($barang_id)->stok_barang_normal;
    $cek_stok_rusak = $this->master_model->cekStokBarang($barang_id)->stok_barang_rusak;

    $wherestok = array(
      'id_barang' => $barang_id
    );

    $stok = array(
     'stok_barang_normal' =>  $cek_stok_normal - $jml_barang_rusak,
     'stok_barang_rusak' =>  $cek_stok_rusak + $jml_barang_rusak,
    );

    $this->crud_model->update($wherestok,$stok,'tbl_barang');
  }
  
  public function approvalkerusakan(){
    $id = $this->input->post('id_kerusakan_barang');
    $barang_id = $this->input->post('barang_id');
    $jml_barang_rusak = $this->input->post('jml_barang_rusak');
    $status = $this->input->post('status');
    $tgl_penanganan = DATE('Y-m-d');

    $this->approvalPenanganan($id, $tgl_penanganan, $status);
    $this->updateStokBarang($barang_id, $jml_barang_rusak);

    $where = array(
      'id_kerusakan_barang' => $id
    );

    $data = array(
      'status' => $status,
    );

    $this->crud_model->update($where,$data,'tbl_kerusakan_barang');
    echo json_encode($data);
  }

  public function listpenanganan($id){
    $this->isLoggedIn();   

    $where = array(
      'kerusakan_barang_id' => $id
    );

    $penangananbarang = $this->master_model->getPenangananById($where,'tbl_penanganan_barang');
    echo json_encode($penangananbarang);
  }

  public function updateStatusPenanganan($id, $status){

    $where = array(
      'id_kerusakan_barang' => $id
    );

    $data = array(
      'status' => $status,
    );

    $this->crud_model->update($where,$data,'tbl_kerusakan_barang');
  }

  public function tambahStokNormal($barang_id, $jml_barang){
    $cek_stok_normal = $this->master_model->cekStokBarang($barang_id)->stok_barang_normal;
    $cek_stok_rusak = $this->master_model->cekStokBarang($barang_id)->stok_barang_rusak;

    $where = array(
      'id_barang' => $barang_id
    );

    $data = array(
     'stok_barang_normal' =>  $cek_stok_normal + $jml_barang,
     'stok_barang_rusak' =>  $cek_stok_rusak - $jml_barang
    );

    $this->crud_model->update($where,$data,'tbl_barang');
  }

  public function penangananKerusakan(){
    $id = $this->input->post('kerusakan_barang_id');
    $tgl_penanganan = $this->input->post('tgl_penanganan');
    $status = $this->input->post('status');
    $keterangan_penanganan = $this->input->post('keterangan_penanganan');

    $barang_id = $this->master_model->getBarangByPenangananId($id)->barang_id;
    $jml_barang = $this->master_model->getBarangByPenangananId($id)->jml_barang;

    var_dump($barang_id);
    var_dump($jml_barang);

    switch ($status) {
      case 4:
        $this->tambahStokNormal($barang_id, $jml_barang);
        break;
    }

    $data = array(
      'kerusakan_barang_id' => $id,
      'status' => $status,
      'tgl_penanganan' => $tgl_penanganan,
      'keterangan_penanganan' => $keterangan_penanganan,
    );

    $this->crud_model->input($data,'tbl_penanganan_barang');
    $this->updateStatusPenanganan($id, $status);
    redirect('kerusakanBarang');
  }

  public function cetakSemua(){
    $id = $this->input->post('id_barangcheck');

    if(isset($id)){
    $id = implode(',',$id);
    $data['barang'] = $this->crud_model->SelectIn($id, 'id_barang', 'tbl_barang');
    }else{
      $data['barang'] = $this->crud_model->lihatdata('tbl_barang');
    }

    $this->load->view('barang/cetak',$data);
  }

  public function cekBarang(){
    $this->global['pageTitle'] = 'Cek Barang';
    $this->global['pageHeader'] = 'Cek Barang';

    $this->loadViews("barang/cekbarang", $this->global, NULL);
  }

  public function cetakexcel()
  {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $style_col = [
        'font' => ['bold' => true], // Set font nya jadi bold
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ],
        'borders' => [
            'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
            'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
            'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
            'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
        ]
    ];


    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = [
        'alignment' => [
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ],
        'borders' => [
            'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
            'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
            'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
            'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
        ]
    ];


    $sheet->setCellValue('B2', 'Laporan Data Customer '); // Set kolom A1 dengan tulisan "DATA SISWA"
    $sheet->mergeCells('B2:E2'); // Set Merge Cell pada kolom A1 sampai E1

    // if (isset($tgl_awal) && isset($tgl_akhir)){
    //   $sheet->setCellValue('B3', 'Periode : '.$awal.' - '.$akhir);
    // }else{
    //   $sheet->setCellValue('B3', 'Periode : '.$periode);
    // }

    $sheet->mergeCells('B3:D3');

    $sheet->setCellValue('B5', 'No');
    $sheet->setCellValue('C5', 'Sales');
    $sheet->setCellValue('D5', 'Outlet');
    $sheet->setCellValue('E5', 'Produk');
    $sheet->setCellValue('F5', 'Produk Sebelum');
    $sheet->setCellValue('G5', 'Customer');
    $sheet->setCellValue('H5', 'Kontak');
    $sheet->setCellValue('I5', 'No. HP');
    $sheet->setCellValue('J5', 'Usia');
    $sheet->setCellValue('K5', 'Status');
    $sheet->setCellValue('L5', 'Tgl Dibuat');


    $sheet->getStyle('B5')->applyFromArray($style_col);
    $sheet->getStyle('C5')->applyFromArray($style_col);
    $sheet->getStyle('D5')->applyFromArray($style_col);
    $sheet->getStyle('E5')->applyFromArray($style_col);
    $sheet->getStyle('F5')->applyFromArray($style_col);
    $sheet->getStyle('G5')->applyFromArray($style_col);
    $sheet->getStyle('H5')->applyFromArray($style_col);
    $sheet->getStyle('I5')->applyFromArray($style_col);
    $sheet->getStyle('J5')->applyFromArray($style_col);
    $sheet->getStyle('K5')->applyFromArray($style_col);
    $sheet->getStyle('L5')->applyFromArray($style_col);

    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4

    $sheet->setCellValue('B' . $numrow, '');
    $sheet->setCellValue('C' . $numrow, '');
    $sheet->setCellValue('D' . $numrow, '');
    $sheet->setCellValue('E' . $numrow, '');
    $sheet->setCellValue('F' . $numrow, '');
    $sheet->setCellValue('G' . $numrow, '');
    $sheet->setCellValue('H' . $numrow, '');
    $sheet->setCellValue('I' . $numrow, '');
    $sheet->setCellValue('J' . $numrow, '');
    $sheet->setCellValue('K' . $numrow, '');
    $sheet->setCellValue('L' . $numrow, '');


    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);
    $sheet->getColumnDimension('H')->setAutoSize(true);
    $sheet->getColumnDimension('I')->setAutoSize(true);
    $sheet->getColumnDimension('J')->setAutoSize(true);
    $sheet->getColumnDimension('K')->setAutoSize(true);
    $sheet->getColumnDimension('L')->setAutoSize(true);


    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
    $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
    $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
    $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
    $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
    $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
    $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
    $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
    $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
    $sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
    $sheet->getStyle('K' . $numrow)->applyFromArray($style_row);
    $sheet->getStyle('L' . $numrow)->applyFromArray($style_row);


    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attactchment;filename= Data Customer.xlsx');

    header('Cache-Control: max-age=0');
    $writer->save("php://output");  
    exit();
  }
}
