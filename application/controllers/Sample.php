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

class Sample extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $name = $this->session->userdata ( 'name' );

      $this->load->model('crud_model');
      $this->load->model('sample_model');
    
      if(isset($name)){
      $this->isLoggedIn();
      }
  }
// Permintaan Sample
  public function dataPermintaan(){
    $this->global['pageTitle'] = 'Permintaan Sample';

    $data = array(
      'list_data' => $this->crud_model->lihatdata('tbl_sample_permintaan'),
    );

    $this->loadViews("sample/dataPermintaan", $this->global, $data, NULL);
  }

  public function savePermintaan(){
    $tgl_permintaan = DATE('Y-m-d');
    $nama_sample = $this->input->post('nama_sample');
    $deskripsi_sample = $this->input->post('deskripsi_sample');
    $kategori_penggunaan = $this->input->post('kategori_penggunaan');
    $kategori_bahan = $this->input->post('kategori_bahan');
    $jumlah_sample = $this->input->post('jumlah_sample');
    $satuan_sample = $this->input->post('satuan_sample');

    $data = array(
      'tgl_permintaan' => $tgl_permintaan,
      'nama_sample' => $nama_sample,
      'deskripsi_sample' => $deskripsi_sample,
      'kategori_penggunaan' => $kategori_penggunaan,
      'kategori_bahan' => $kategori_bahan,
      'jumlah_sample' => $jumlah_sample,
      'satuan_sample' => $satuan_sample,
    );

    $this->crud_model->input($data,'tbl_sample_permintaan');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('permintaan-sample');
  }

  public function updateStatusPermintaan(){
    $this->isLoggedIn();

    $id = $this->uri->segment(2);
    $status = $this->uri->segment(3);

    $where = array(
        'id_sample_permintaan' => $id
    );

    $data = array(
        'status_permintaan' => $status
    );

    $res = $this->crud_model->update($where, $data,'tbl_sample_permintaan');
    $this->set_notifikasi_swal('success','Berhasil','Status Berhasil Diubah');
    redirect('permintaan-sample');
  }
// Permintaan Sample

// Pengujian Sample
  public function saveVendor(){
    $config['upload_path']          = './assets/dokumen_sample';
    $config['allowed_types']        = 'gif|jpg|png|PNG|jpeg|pdf';

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('dokumen')) {
      $this->set_notifikasi_swal('error','Gagal','Dokumen tidak boleh kosong');
      redirect('sample-masuk');

    } else {
      $file = $this->upload->data();

      $permintaan_sample_id = $this->input->post('id_sample_permintaan');
      $tgl_masuk = $this->input->post('tgl_masuk');
      $nama_supplier = $this->input->post('nama_supplier');
      $harga = $this->input->post('harga');
      $dokumen = $file['file_name'];

      $data = array(
        'permintaan_sample_id' => $permintaan_sample_id,
        'tgl_masuk' => $tgl_masuk,
        'nama_supplier' => $nama_supplier,
        'harga' => $harga,
        'dokumen_sample' => $dokumen,
      );
    }

    $res = $this->crud_model->input($data,'tbl_sample_vendor');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('sample-masuk');
  }

  public function dataUji(){
    $this->global['pageTitle'] = 'Registrasi Sample Masuk';
    $id = $this->uri->segment(2);

    $data = array(
      'data_sample' => $this->crud_model->getdataRowbyWhere('*', 'id_sample_permintaan ='.$id, 'tbl_sample_permintaan'),
      'list_data' => $this->sample_model->getDatabyWhere('permintaan_sample_id ='.$id),
      'id' => $id
    );

    $this->loadViews("sample/data", $this->global, $data, NULL);
  }

  public function getDokumenSample($id){
    $dokumen = $this->crud_model->getdataRowbyWhere('dokumen_sample', 'id_sample_vendor ='.$id ,'tbl_sample_vendor');

    echo json_encode($dokumen);
  }

  public function getHasilCek($id){
    $hasil_cek = $this->crud_model->getdataRowbyWhere('tgl_cek, hasil_cek, keterangan, dokumen_cek', 'id_sample_vendor ='.$id ,'tbl_sample_vendor');

    echo json_encode($hasil_cek);
  }

  public function getHasilUji($id){
    $hasil_uji = $this->crud_model->getdataRowbyWhere('hasil_uji, tgl_selesai_uji, kesimpulan', 'id_sample_vendor ='.$id ,'tbl_sample_vendor');

    echo json_encode($hasil_uji);
  }


  public function updateStatus(){
    $this->isLoggedIn();

    $id = $this->uri->segment(2);
    $status = $this->uri->segment(3);

    $where = array(
        'id_sample_vendor' => $id
    );

    $data = array(
        'status' => $status
    );

    $res = $this->crud_model->update($where, $data,'tbl_sample_vendor');
    $this->set_notifikasi_swal('success','Berhasil','Status Berhasil Diubah');
    redirect('sample-masuk');
  }

  public function updateHasilCek(){
    $config['upload_path']          = './assets/dokumen_sample';
    $config['allowed_types']        = 'gif|jpg|png|PNG|jpeg|pdf';

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('dokumen_cek')) {
      $this->set_notifikasi_swal('error','Gagal','Dokumen tidak boleh kosong');
      redirect('sample-masuk');
    } else {
      $file = $this->upload->data();

      $id_sample_vendor = $this->input->post('id_sample_vendor');
      $tgl_cek = $this->input->post('tgl_cek');
      $hasil_cek = $this->input->post('hasil_cek');
      $keterangan = $this->input->post('keterangan');
      $dokumen = $file['file_name'];

      $data = array(
        'tgl_cek' => $tgl_cek,
        'hasil_cek' => $hasil_cek,
        'keterangan' => $keterangan,
        'dokumen_cek' => $dokumen,
      );
    }

    $res = $this->crud_model->update('id_sample_vendor ='.$id_sample_vendor, $data,'tbl_sample_vendor');
    $this->set_notifikasi_swal('success','Berhasil','Status Berhasil Diubah');
    redirect('sample-masuk');
  }

  public function updateHasiluji(){
    $id_sample_vendor = $this->input->post('id_sample_vendor');
    $tgl_selesai_uji = $this->input->post('tgl_selesai_uji');
    $hasil_uji = $this->input->post('hasil_uji');
    $kesimpulan = $this->input->post('kesimpulan');

    $data = array(
      'tgl_selesai_uji' => $tgl_selesai_uji,
      'hasil_uji' => $hasil_uji,
      'kesimpulan' => $kesimpulan
    );

    $res = $this->crud_model->update('id_sample_vendor ='.$id_sample_vendor, $data,'tbl_sample_vendor');
    $this->set_notifikasi_swal('success','Berhasil','Status Berhasil Diubah');
    redirect('sample-masuk');
  }

  public function laporan(){
    $this->global['pageTitle'] = 'Laporan Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Absensi Manual Karyawan ';

    $data['list_data'] = $this->crud_model->lihatdata('tbl_sample_vendor');

    $this->loadViews("sample/laporan", $this->global, $data, NULL);
  }

  public function exportExcel(){
    $id = $this->uri->segment(2);

    $list_data = $this->sample_model->getDatabyWhere('permintaan_sample_id ='.$id);
    $data_sample = $this->crud_model->getdataRowbyWhere('*', 'id_sample_permintaan='.$id, 'tbl_sample_permintaan');

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

    $styleRight = [
      'font' => [
        'bold' => true,
      ],
      'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
      ],
      'borders' => [
        'top' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
      ],
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

    $sheet->mergeCells('B2:D2'); // Set Merge Cell pada kolom A1 sampai E1
    $sheet->setCellValue('B2', 'Laporan Uji Sampel PT. Mirota KSM'); // Set kolom A1 Sebagai Header
    

    $sheet->setCellValue('B4', 'Nama Sampel');
    $sheet->setCellValue('B5', 'Kategori');
    $sheet->setCellValue('B6', 'Kategori Bahan');
    $sheet->setCellValue('B7', 'Jumlah');
    $sheet->setCellValue('B8', 'Deskripsi');

    $sheet->setCellValue('C4', $data_sample->nama_sample); // Set kolom A1 Sebagai Header
    $sheet->setCellValue('C5', $data_sample->kategori_penggunaan); // Set kolom A1 Sebagai Header
    $sheet->setCellValue('C6', $data_sample->kategori_bahan); // Set kolom A1 Sebagai Header
    $sheet->setCellValue('C7', $data_sample->jumlah_sample.' '.$data_sample->satuan_sample); // Set kolom A1 Sebagai Header
    $sheet->setCellValue('C8', $data_sample->deskripsi_sample); // Set kolom A1 Sebagai Header

    
    $sheet->setCellValue('B10', 'Tanggal Masuk');
    $sheet->setCellValue('C10', 'Nama Supplier');
    $sheet->setCellValue('D10', 'Harga');
    $sheet->setCellValue('E10', 'Tanggal Cek');
    $sheet->setCellValue('F10', 'Keterangan');
    $sheet->setCellValue('G10', 'Tanggal Selesai Uji');
    $sheet->setCellValue('H10', 'Kesimpulan');

    $sheet->getStyle('B10')->applyFromArray($style_col);
    $sheet->getStyle('C10')->applyFromArray($style_col);
    $sheet->getStyle('D10')->applyFromArray($style_col);
    $sheet->getStyle('E10')->applyFromArray($style_col);
    $sheet->getStyle('F10')->applyFromArray($style_col);
    $sheet->getStyle('G10')->applyFromArray($style_col);
    $sheet->getStyle('H10')->applyFromArray($style_col);

    $no = 1;
    $numrow = 11;
    foreach ($list_data as $ld) {
      $sheet->setCellValue('B'.$numrow, $ld->tgl_masuk);
      $sheet->setCellValue('C'.$numrow, $ld->nama_supplier);
      $sheet->setCellValue('D'.$numrow, $ld->harga);
      $sheet->setCellValue('E'.$numrow, $ld->tgl_cek);
      $sheet->setCellValue('F'.$numrow, $ld->keterangan);
      $sheet->setCellValue('G'.$numrow, $ld->tgl_selesai_uji);
      $sheet->setCellValue('H'.$numrow, $ld->kesimpulan);

      $sheet->getColumnDimension('B')->setAutoSize(true);
      $sheet->getColumnDimension('C')->setAutoSize(true);
      $sheet->getColumnDimension('D')->setAutoSize(true);
      $sheet->getColumnDimension('E')->setAutoSize(true);
      $sheet->getColumnDimension('F')->setAutoSize(true);
      $sheet->getColumnDimension('G')->setAutoSize(true);
      $sheet->getColumnDimension('H')->setAutoSize(true);

      $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('H'.$numrow)->applyFromArray($style_row);

      $no++;
      $numrow++;
    }
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attactchment;filename=Laporan Sample '.$data_sample->nama_sample.'.xlsx');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
    exit();
  }
// Pengujian Sample
}