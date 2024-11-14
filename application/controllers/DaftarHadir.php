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

class DaftarHadir extends BaseController
{

  public function __construct()
  {
      parent::__construct();
      $this->load->model('crud_model');
      $this->load->model('pegawai_model');
      $this->load->model('daftar_hadir_model');
      $this->load->library('form_validation');
  }

  public function index(){
    $this->global['pageTitle'] = 'Input Kehadiran Karyawan Mirota KSM';

    $data = array(
      'list_data' => $this->daftar_hadir_model->showData(['a.status' => 1])
    );

    $this->loadViewsUser("event/daftar_hadir", $this->global, $data, NULL);
  }

  public function simpanDaftarHadir($id_pegawai){
    $nip = $this->pegawai_model->getPegawaibyId($id_pegawai)->nip;

    $data = array(
      'pegawai_id' => $id_pegawai,
      'event_id' => 1,
      'data_qrcode' => $this->generateBarcode('HUT51', $nip),
      'datecreated' => DATE('Y-m-d H:i')
    );
    
    $sql = $this->crud_model->input($data,'tbl_daftar_hadir');
    echo json_encode($data);
  }

  public function updateKehadiran($id){
    $pegawai_id = $this->crud_model->getdataRowbyWhere('id_pegawai', ['nip' => $id], 'tbl_pegawai')->id_pegawai;

    $sql = $this->crud_model->update(['pegawai_id' => $pegawai_id],['status' => 1, 'time_attend' => DATE('H:i')],'tbl_daftar_hadir');

    echo json_encode($sql);
  }

  public function laporan(){
    $this->isLoggedIn();
    $this->global['pageTitle'] = 'Input Kehadiran Karyawan Mirota KSM';

    $data = array(
      'list_data' => $this->daftar_hadir_model->showData(NULL)
    );

    $this->loadViews("event/laporan", $this->global, $data, NULL);
  }

  public function export_excel(){
    $id = $this->uri->segment(3);

    $list_data = $this->daftar_hadir_model->showData($id);

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

    $sheet->setCellValue('B2', 'Data Kehadiran Karyawan PT. Mirota KSM'); // Set kolom A1 Sebagai Header

    // $sheet->mergeCells('B2:E2'); // Set Merge Cell pada kolom A1 sampai E1
    
    $sheet->setCellValue('B5', 'No');
    $sheet->setCellValue('C5', 'NIK');
    $sheet->setCellValue('D5', 'Nama Karyawan');
    $sheet->setCellValue('E5', 'Tanggal Registrasi');
    $sheet->setCellValue('F5', 'Waktu Kehadiran');

    $sheet->getStyle('B5')->applyFromArray($style_col);
    $sheet->getStyle('C5')->applyFromArray($style_col);
    $sheet->getStyle('D5')->applyFromArray($style_col);
    $sheet->getStyle('E5')->applyFromArray($style_col);
    $sheet->getStyle('F5')->applyFromArray($style_col);

    $no = 1;
    $numrow = 6;
    foreach ($list_data as $ld) {
      $sheet->setCellValue('B'.$numrow, $no);
      $sheet->setCellValue('C'.$numrow, $ld->nip);
      $sheet->setCellValue('D'.$numrow, $ld->nama_pegawai);
      $sheet->setCellValue('E'.$numrow, mediumdate_indo(date("Y-m-d",strtotime($ld->datecreated))));
      $sheet->setCellValue('F'.$numrow, isset($ld->time_attend) ? date("h:i",strtotime($ld->time_attend)) : '-');

      $sheet->getColumnDimension('C')->setAutoSize(true);
      $sheet->getColumnDimension('D')->setAutoSize(true);
      $sheet->getColumnDimension('E')->setAutoSize(true);
      $sheet->getColumnDimension('F')->setAutoSize(true);
  
      $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);

      $no++;
      $numrow++;
    }

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');

    header('Content-Disposition: attactchment;filename= Data Karyawan PT Mirota KSM.xlsx');

    header('Cache-Control: max-age=0');
    $writer->save("php://output");
    exit();
  }
}