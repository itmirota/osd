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


class Kebersihan extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $name = $this->session->userdata ( 'name' );

      $this->load->model('crud_model');
      $this->load->model('master_model');
    
      if(isset($name)){
      $this->isLoggedIn();
      }
  }

  public function index(){
    $this->global['pageTitle'] = 'Tim Kebersihan';
    $this->global['pageHeader'] = 'OSD | Data Kebersihan';

    $this->loadViewsUser("kebersihan/dashboard", $this->global, NULL);
  }

  public function formulir(){
    $this->global['pageTitle'] = 'Tim Kebersihan';
    $this->global['pageHeader'] = 'OSD | Data Kebersihan';

    $data = array(
      'pegawai' => $this->crud_model->GetDataById(array('divisi_id' => 7),'tbl_pegawai'),
      'ruangan' => $this->crud_model->lihatdata('tbl_ruangan')
    );

    $this->loadViewsUser("kebersihan/formulir", $this->global, $data, NULL);
  }

  public function data(){
    $this->global['pageTitle'] = 'Tim Kebersihan';
    $this->global['pageHeader'] = 'OSD | Data Kebersihan';
    
    $pegawai_id = $this->input->post('pegawai_id');
    $ruangan_id = $this->input->post('ruangan_id');

    $sessionArray = array(
      'pegawai_kebersihan_id'=>$pegawai_id,
      'ruangan_id'=>$ruangan_id,                    
    );
                      
    $this->session->set_userdata($sessionArray);

    $id =$this->session->userdata ('pegawai_kebersihan_id');

    $data = array(
      'pegawai_id' => $id,
      'ruangan_id' => $this->session->userdata ('ruangan_id'),
      'list_data' => $this->master_model->getPerawatanRuanganbyId($id)
    );

    $this->loadViewsUser("kebersihan/data", $this->global, $data, NULL);
  }

  public function save(){
    $pegawai_id = $this->input->post('pegawai_id');
    $detail_perawatan = $this->input->post('detail_perawatan');
    $bukti_perawatan = $this->input->post('bukti_perawatan');
    $datecreated = DATE('Y-m-d H:i:s');


    $bukti_perawatan = str_replace('[removed]','', $bukti_perawatan);
		$bukti_perawatan = base64_decode($bukti_perawatan);
		$filename = 'buktiperawatan_'.time().'.jpg';
		file_put_contents(FCPATH.'/assets/images/kebersihan/'.$filename,$bukti_perawatan);

    $data = array(
      'pegawai_id' => $pegawai_id,
      'detail_perawatan' => $detail_perawatan,
      'bukti_perawatan' => $filename,
      'tgl_perawatan' => $datecreated
    );

    $res = $this->crud_model->input($data,'tbl_perawatan_ruangan');
    echo json_encode($res);
  }
  
  // Admin Panel
  public function report(){
    $this->global['pageTitle'] = 'Tim Kebersihan';
    $this->global['pageHeader'] = 'OSD | Data Kebersihan';
    
    $data = array(
      'list_data' => $this->master_model->getPerawatanRuangan()
    );

    $this->loadViews("kebersihan/report", $this->global, $data, NULL);
  }

  public function hapus(){
    $tgl_mulai = $this->input->post('tgl_mulai');
    $tgl_akhir = $this->input->post('tgl_akhir');

    $where = array(
      'DATE(tgl_perawatan) >=' => $tgl_mulai,
      'DATE(tgl_perawatan) <=' => $tgl_akhir,
    );

    $data = $this->crud_model->GetDataById($where,'tbl_perawatan_ruangan');
    foreach ($data as $d){
      unlink( FCPATH.'assets/images/kebersihan/'.$d->bukti_perawatan);
      $total++;
    }

    $this->crud_model->delete($where, 'tbl_perawatan_ruangan');

    $this->set_notifikasi_swal('success','Berhasil',$total.' Data Berhasil Dihapus');
    redirect('laporan-kebersihan');
  }

  public function exportExcel(){
    $tgl_mulai = $this->input->post('tgl_mulai');
    $tgl_akhir = $this->input->post('tgl_akhir');
    $awal = strftime('%d/%b/%Y', strtotime($tgl_mulai));
    $akhir = strftime('%d/%b/%Y', strtotime($tgl_akhir));

    $where = array(
      'DATE(tgl_perawatan) >=' => $tgl_mulai,
      'DATE(tgl_perawatan) <=' => $tgl_akhir
    );

    if(empty($tgl_mulai)){
      $list_data = $this->master_model->getPerawatanRuangan();
    }else{
      $list_data = $this->master_model->getPerawatanRuanganbyWhere($where);
    }

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

    $sheet->setCellValue('B2', 'Laporan Kebersihan Ruangan PT. Mirota KSM'); // Set kolom A1 Sebagai Header
    // $sheet->mergeCells('B2:E2'); // Set Merge Cell pada kolom A1 sampai E1
    
    $sheet->setCellValue('B3', 'No');
    $sheet->setCellValue('C3', 'Nama');
    $sheet->setCellValue('D3', 'Tanggal');
    $sheet->setCellValue('E3', 'Waktu');
    $sheet->setCellValue('F3', 'Detail Perawatan');

    $sheet->getStyle('B3')->applyFromArray($style_col);
    $sheet->getStyle('C3')->applyFromArray($style_col);
    $sheet->getStyle('D3')->applyFromArray($style_col);
    $sheet->getStyle('E3')->applyFromArray($style_col);
    $sheet->getStyle('F3')->applyFromArray($style_col);

    $no = 1;
    $numrow = 4;
    foreach ($list_data as $ld) {
      $sheet->setCellValue('B'.$numrow, $no);
      $sheet->setCellValue('C'.$numrow, $ld->nama_pegawai);
      $sheet->setCellValue('D'.$numrow, $ld->date);
      $sheet->setCellValue('E'.$numrow, $ld->time.' WIB');
      $sheet->setCellValue('F'.$numrow, $ld->detail_perawatan);

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

    if (!empty($tgl_mulai) && !empty($tgl_akhir)){
        header('Content-Disposition: attactchment;filename="Laporan Kebersihan" '.$awal.' - '.$akhir.'.xlsx');
    }else{
        header('Content-Disposition: attactchment;filename="Laporan Kebersihan".xlsx');
    }

    header('Cache-Control: max-age=0');
    $writer->save("php://output");
    exit();
  }
}