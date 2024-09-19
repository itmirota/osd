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

class absensiPegawaiHarian extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $name = $this->session->userdata ( 'name' );

      $this->load->model('crud_model');
      $this->load->model('absensi_model');
    
      if(isset($name)){
      $this->isLoggedIn();
      }
  }

  public function index(){
    $this->global['pageTitle'] = 'Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Absensi Manual Karyawan ';

    $data['datenow']= DATE('d M Y');

    $this->loadViewsUser("absensiPegawaiHarian/kehadiran", $this->global, $data, NULL);
  }

  public function listdata(){
    $this->global['pageTitle'] = 'Pegawai Lepas Harian';
    $this->global['pageHeader'] = 'OSD | Satpam Area';

    $data['list_data'] = $this->crud_model->lihatdata('tbl_absensi_pegawaiHarian');

    $this->loadViewsUser("absensiPegawaiHarian/data", $this->global, $data, NULL);
  }

  public function laporan(){
    $this->global['pageTitle'] = 'Laporan Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Absensi Manual Karyawan ';

    $data['list_data'] = $this->absensi_model->report();

    $this->loadViews("absensiPegawaiHarian/laporan", $this->global, $data, NULL);
  }

  public function laporanSatpam(){
    $this->global['pageTitle'] = 'Laporan Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Absensi Manual Karyawan ';

    $data['list_data'] = $this->crud_model->lihatdata('tbl_absensi_pegawaiHarian');

    $this->loadViewsUser("absensiPegawaiHarian/laporan", $this->global, $data, NULL);
  }

  public function cekkoordinat(){
    $this->global['pageTitle'] = 'Laporan Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Absensi Manual Karyawan ';

    $jenis = $this->uri->segment(2);
    $id_pegawai = $this->uri->segment(3);

    $dataAbsen = $this->absensi_model->getDataAbsenById($id_pegawai);

    if($jenis == 'masuk'){
      $data = array(
        'bukti_absen' => $dataAbsen->bukti_absensi_in,
        'latitude' => $dataAbsen->latitude_in,
        'longitude' => $dataAbsen->longitude_in
      );
    }else{
      $data = array(
        'bukti_absen' => $dataAbsen->bukti_absensi_out,
        'latitude' => $dataAbsen->latitude_out,
        'longitude' => $dataAbsen->longitude_out
      );
    }

    $this->loadViews("absensi/lokasi", $this->global, $data, NULL);
  }

  public function Webcam()
	{
    $this->global['pageTitle'] = 'Laporan Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Absensi Manual Karyawan ';

    $where = array(
      'date' => DATE('Y-m-d'),
      'time_out' => NULL
    );

    $data = array(
      'jenis_absen' => $this->uri->segment(3),
      'pegawai' => $this->crud_model->GetDataById($where,'tbl_absensi_pegawaiHarian') 
    );


		// $this->load->view('webcam');
    $this->loadViewsUser("absensiPegawaiHarian/webcam", $this->global, $data, NULL);
	}

  public function saveWebcam(){
		$id_absensi = $this->input->post('id_absensi');
		$nama = $this->input->post('nama');
		$bagian = $this->input->post('bagian');
		$jenis_absen = $this->input->post('jenis_absen');
		$image = $this->input->post('imagecam');
		$lat = $this->input->post('lat');
		$lon = $this->input->post('lon');

		$image = str_replace('[removed]','', $image);
		$image = base64_decode($image);
		$filename = 'image_'.time().'.jpg';
		file_put_contents(FCPATH.'/assets/images/absensiPegawaiHarian/'.$filename,$image);

    if($jenis_absen == 'masuk'){
      $data = array(
        'nama' => $nama,
        'bagian' => $bagian,
        'latitude_in' => $lat,
        'longitude_in' => $lon,
        'bukti_absensi_in' => $filename,
        'date' => DATE('Y-m-d'),
        'time_in' => DATE('H:i:s')
      );
  
      $res = $this->crud_model->input($data,'tbl_absensi_pegawaiHarian');
    }else{
      $where = array(
        'id_absensi_pegawaiHarian' => $id_absensi,
      );

      $data = array(
        'time_out' => DATE('H:i:s'),
        'latitude_out' => $lat,
        'longitude_out' => $lon,
        'bukti_absensi_out' => $filename
      );
  
      $res = $this->crud_model->update($where,$data,'tbl_absensi_pegawaiHarian');
    }
		echo json_encode($res);
	}

  public function exportExcel(){
    $tgl_mulai = $this->input->post('tgl_mulai');
    $tgl_akhir = $this->input->post('tgl_akhir');
    $awal = strftime('%d/%b/%Y', strtotime($tgl_mulai));
    $akhir = strftime('%d/%b/%Y', strtotime($tgl_akhir));

    $where = array(
      'date >=' => $tgl_mulai,
      'date <=' => $tgl_akhir
    );

    if(empty($tgl_mulai)){
      $list_data = $this->absensi_model->report();
    }else{
      $list_data = $this->absensi_model->reportbyWhere($where);
    }

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="format input data pegawai.xlsx"');

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setTitle('Laporan');

    $spreadsheet->createSheet();

    // Add some data
    $spreadsheet->setActiveSheetIndex(1)
            ->setCellValue('A1', 'world!');
    
    $spreadsheet->getActiveSheet()->setTitle('Detail Laporan');

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

    $sheet->setCellValue('B2', 'Laporan Data Absensi Pegawai Harian/Magang'); // Set kolom A1 Sebagai Header
    // $sheet->mergeCells('B2:E2'); // Set Merge Cell pada kolom A1 sampai E1
    
    $sheet->setCellValue('B3', 'No');
    $sheet->setCellValue('C3', 'Nama');
    $sheet->setCellValue('D3', 'Bagian');
    $sheet->setCellValue('E3', 'Tanggal');
    $sheet->setCellValue('F3', 'Jam Masuk');
    $sheet->setCellValue('G3', 'Jam Pulang');

    $sheet->getStyle('B3')->applyFromArray($style_col);
    $sheet->getStyle('C3')->applyFromArray($style_col);
    $sheet->getStyle('D3')->applyFromArray($style_col);
    $sheet->getStyle('E3')->applyFromArray($style_col);
    $sheet->getStyle('F3')->applyFromArray($style_col);
    $sheet->getStyle('G3')->applyFromArray($style_col);

    $no = 1;
    $numrow = 4;
    foreach ($list_data as $ld) {
      $sheet->setCellValue('B'.$numrow, $no);
      $sheet->setCellValue('C'.$numrow, $ld->nama);
      $sheet->setCellValue('D'.$numrow, $ld->bagian);
      $sheet->setCellValue('E'.$numrow, $ld->date);
      $sheet->setCellValue('F'.$numrow, $ld->time_in);
      $sheet->setCellValue('G'.$numrow, $ld->time_out);

      $sheet->getColumnDimension('C')->setAutoSize(true);
      $sheet->getColumnDimension('D')->setAutoSize(true);
      $sheet->getColumnDimension('E')->setAutoSize(true);
      $sheet->getColumnDimension('F')->setAutoSize(true);
      $sheet->getColumnDimension('G')->setAutoSize(true);
  
      $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);

      $no++;
      $numrow++;
    }


    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');

    if (!empty($tgl_mulai) && !empty($tgl_akhir)){
        header('Content-Disposition: attactchment;filename="Laporan Absensi Manual" '.$awal.' - '.$akhir.'.xlsx');
    }else{
        header('Content-Disposition: attactchment;filename="Laporan Absensi Manual".xlsx');
    }

    header('Cache-Control: max-age=0');
    $writer->save("php://output");
    exit();
  }
}