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

class Assessment extends BaseController
{

  public function __construct()
  {
      parent::__construct();
      $this->load->model('crud_model');
      $this->load->model('assessment_model');
      $this->load->model('pegawai_model');
      $this->isLoggedIn();
  }

  public function index(){
    $this->global['pageTitle'] = 'Assessment';
    $this->global['pageHeader'] = 'Assessment Karyawan ';

    $page = $this->uri->segment(1);
    $id = $this->pegawai_id;
    $nip = $this->crud_model->getdataRowbyWhere('nip', 'id_pegawai ='.$id ,'tbl_pegawai')->nip;
    $role = $this->global['role'];

    $data['role'] = $role;
    $data['page'] = $page;

    if ($page == 'DataAssessment'){
      $data['list_data']= $this->assessment_model->getAssessmentAll();
      $this->loadViews("assessment/data", $this->global, $data, NULL);
    }else{
      $data['list_data']= $this->assessment_model->getAssessment($nip);
      $this->loadViewsUser("assessment/data", $this->global, $data, NULL);
    }
  }

  public function UserPage(){
    $this->global['pageTitle'] = 'Assessment';
    $this->global['pageHeader'] = 'Assessment Karyawan ';
    $pegawai_nip = $this->global['pegawai_nip'];
    $role = $this->global['role'];

    $data['list_data']= $this->assessment_model->getAssessment($pegawai_nip);
    $data['role'] = $role;

    $this->loadViews("assessment/data", $this->global, $data, NULL);
  }

  public function save(){
    $pegawai_nip = $this->input->post('pegawai_nip');
    $penilai_nip = $this->input->post('penilai_nip');
    $assessment_tingkatan_id = $this->input->post('assessment_tingkatan_id');
    

    $data = array(
      'pegawai_nip' => $pegawai_nip,
      'penilai_nip' => $penilai_nip,
      'assessment_tingkatan_id' => $assessment_tingkatan_id
    );

    $sql = $this->crud_model->input($data,'tbl_assessment');

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('DataAssessment');
  }

  public function detailAssessment($id) {

    $where = array(
      'id_assessment' => $id
    );

    $assessment = $this->crud_model->GetDataByWhere($where,'tbl_assessment');
    
    $data = array(
      'assessment' => $assessment[0]
    );

    echo json_encode($data);
  }

  public function update(){
    $id_assessment = $this->input->post('id_assessment');
    $pegawai_nip = $this->input->post('pegawai_nip');
    $tgl_assessment = $this->input->post('tgl_assessment');
    $nilai = $this->input->post('nilai');
    $keterangan = $this->input->post('keterangan');

    $where = array(
      'id_assessment' => $id_assessment
    );

    $data = array(
      'pegawai_nip' => $pegawai_nip,
      'tgl_assessment' => $tgl_assessment,
      'nilai' => $nilai,
      'keterangan' => $keterangan,
    );

    $sql = $this->crud_model->update($where, $data,'tbl_assessment');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diubah');
    redirect('assessment');
  }

  public function delete($id){
    $where = array(
      'id_assessment' => $id
    );

    $this->crud_model->delete($where, 'tbl_assessment');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('assessment');
  }

  public function spreadsheet_import(){
    $upload_file=$_FILES['upload_file']['name'];
    $extension=pathinfo($upload_file,PATHINFO_EXTENSION);
    if($extension=='csv')
    {
      $reader= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else if($extension=='xls')
    {
      $reader= new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    } else
    {
      $reader= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
    $spreadsheet=$reader->load($_FILES['upload_file']['tmp_name']);
    $sheetdata=$spreadsheet->getActiveSheet()->toArray();
    $sheetcount=count($sheetdata);
    if($sheetcount>1)
    {
      $data=array();
      for ($i=1; $i < $sheetcount; $i++) {         
        $pegawai_nip=$sheetdata[$i][0];
        $penilai_nip=$sheetdata[$i][1];
        $assessment_tingkat_id=$sheetdata[$i][2];


        $data[]=array(
          'pegawai_nip'=> $pegawai_nip,
          'penilai_nip'=>$penilai_nip,
          'assessment_tingkatan_id'=>$assessment_tingkat_id,
        );
      }

      $inserdata=$this->crud_model->save_batch('tbl_assessment',$data);
      if($inserdata)
      {
        $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diinput');
      } else {
        $this->set_notifikasi_swal('danger','Gagal','Data Gagal Diinput');
      }

      redirect('assessment');
    }
  }

  public function list_soal(){
    $this->global['pageTitle'] = 'Assessment';
    $pegawai_nip = $this->global['pegawai_nip'];
    $role = $this->global['role'];

    $data['list_data']= $this->crud_model->lihatdata('tbl_assessment_soal');

    $this->loadViews("assessment/list_soal", $this->global, $data, NULL);
  }

  public function save_soal(){
    $jenis_soal = $this->input->post('jenis_soal');
    $kategori = $this->input->post('kategori');
    $soal = $this->input->post('soal');

    $data = array(
      'jenis_soal' => $jenis_soal,
      'kategori' => $kategori,
      'soal' => $soal,
    );

    $sql = $this->crud_model->input($data,'tbl_assessment_soal');

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('assessment/list_soal');
  }

  public function penilaian($id){
    $this->global['pageTitle'] = 'Assessment';

    $data['soal_value'] = $this->assessment_model->getSoal();
    $data['kategori'] = $this->assessment_model->getKategori()->result();
    $data['id_pegawai'] = $id;
    $data['pegawai'] =$this->crud_model->getdataRowbyWhere('nama_pegawai', 'nip ='.$id ,'tbl_pegawai');

    $this->loadViewsUser("assessment/penilaian", $this->global, $data, NULL);
  }

  public function save_penilaian($id){
    $id_penilai = $this->pegawai_id;
    $penilai_nip = $this->crud_model->getdataRowbyWhere('nip', 'id_pegawai ='.$id_penilai ,'tbl_pegawai')->nip;
  
    $jml_kategori = $this->assessment_model->getKategori()->num_rows();
    $kategori = $this->assessment_model->getKategori()->result();

    for ($i=0; $i < $jml_kategori  ; $i++) { 
      $soal[$i] = $this->assessment_model->getSoalWhere(['kategori' => $kategori[$i]->kategori])->result();
      $count_soal[$i] = $this->assessment_model->getSoalWhere(['kategori' => $kategori[$i]->kategori])->num_rows();
      
      for ($j=0; $j < $count_soal[$i] ; $j++) { 
        $jawaban[$i][$j] = $this->input->post('jawaban_'.$soal[$i][$j]->id_assessment_soal);
        $jawaban[$i][$j] = $soal[$i][$j]->id_assessment_soal.':'.$jawaban[$i][$j];
      }

      $hasil[$i] = implode(',', $jawaban[$i]);
    }

    $jawaban = implode(',', $hasil);
    $data = array(
      'pegawai_nip' => $id,
      'nilai' => $jawaban,
      'penilai_nip' => $penilai_nip,
      'tgl_assessment' => date('Y-m-d H:i:s')
    );

    $where = array (
      'pegawai_nip' => $id,
      'penilai_nip' => $penilai_nip
    );
 

    $this->crud_model->update($where, $data, 'tbl_assessment');

    $this->set_notifikasi_swal('success','Berhasil','Penilaian Berhasil Disimpan');
    redirect('assessment');
  }

  public function hasilAssessment($id){
    $this->global['pageTitle'] = 'Assessment';

    $ids = $this->uri->segment(3);

    $hasil = $this->assessment_model->getHasilAssessment($id);
    $explode_hasil = explode(',',$hasil->nilai);

    $data['explode_hasil'] = $explode_hasil;
    $data['hasil'] = $hasil;

    $this->loadViews("assessment/hasil", $this->global, $data, NULL);
  }

  public function hapusAssessment($id){
    $where = array(
      'id_assessment' => $id
    );

    $this->crud_model->delete($where, 'tbl_assessment');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('DataAssessment');
  }

  public function exportAssessment(){
    $this->global['pageTitle'] = 'Assessment';

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

    $sheet->setCellValue('B2', 'Laporan Assessment 360 Karyawan PT. Mirota KSM'); // Set kolom A1 Sebagai Header

    // $sheet->mergeCells('B2:E2'); // Set Merge Cell pada kolom A1 sampai E1
    
    $sheet->setCellValue('B5', 'No');
    $sheet->setCellValue('C5', 'Nama Karyawan');
    $sheet->setCellValue('D5', 'Departement');
    $sheet->setCellValue('E5', 'Divisi');
    $sheet->setCellValue('F5', 'Bagian');
    $sheet->setCellValue('G5', 'Total Penilai');
    $sheet->setCellValue('H5', 'Jumlah Penilai');
    $sheet->setCellValue('I5', 'Total Nilai');
    $sheet->setCellValue('J5', 'Nilai');


    $sheet->getStyle('B5')->applyFromArray($style_col);
    $sheet->getStyle('C5')->applyFromArray($style_col);
    $sheet->getStyle('D5')->applyFromArray($style_col);
    $sheet->getStyle('E5')->applyFromArray($style_col);
    $sheet->getStyle('F5')->applyFromArray($style_col);
    $sheet->getStyle('G5')->applyFromArray($style_col);
    $sheet->getStyle('H5')->applyFromArray($style_col);
    $sheet->getStyle('I5')->applyFromArray($style_col);
    $sheet->getStyle('J5')->applyFromArray($style_col);


    // $pegawai = $this->pegawai_model->showData();
    $pegawai = $this->assessment_model->getHasilAssessmentbyPegawai();

    $no = 1;
    $numrow = 6;
    for ($i=0; $i < count($pegawai) ; $i++) { 
      $hasil = $this->assessment_model->getHasilAssessmentbyId($pegawai[$i]->nip);
      $total_penilai = $this->assessment_model->getCountTotalPenilaian($pegawai[$i]->nip);
      $jumlah_penilai = $this->assessment_model->getCountJumlahPenilai($pegawai[$i]->nip);
      
      $total = 0;
      for ($j=0; $j < count($hasil) ; $j++) { 
        $explode_hasil[$j] = explode(',',$hasil[$j]->nilai);

        for ($k=0; $k < count($explode_hasil[$j]) ; $k++) { 
          $explode_jawaban[$k] = explode(':', $explode_hasil[$j][$k]);

          $jawaban[$k] = $explode_jawaban[$k][1];

          switch ($jawaban[$k]) {
            case 'ss':
              $jawaban[$k] = 4;
              break;

            case 's':
              $jawaban[$k] = 3;

              break;

            case 'ts':
              $jawaban[$k] = 2;
              break;

            case 'sts':
              $jawaban[$k] = 1;
              break;
          }

          $total = $total + (int)$jawaban[$k];
        }   

      }

        $hasilAkhir = $total/count($hasil);

        $sheet->setCellValue('B'.$numrow, $no);
        $sheet->setCellValue('C'.$numrow, $pegawai[$i]->nama_pegawai);
        $sheet->setCellValue('D'.$numrow, $pegawai[$i]->nama_departement);
        $sheet->setCellValue('E'.$numrow, $pegawai[$i]->nama_divisi);
        $sheet->setCellValue('F'.$numrow, $pegawai[$i]->nama_bagian);
        $sheet->setCellValue('G'.$numrow, count($total_penilai));
        $sheet->setCellValue('H'.$numrow, count($jumlah_penilai));
        $sheet->setCellValue('I'.$numrow, $total);
        $sheet->setCellValue('J'.$numrow, $hasilAkhir);


        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
    
        $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('H'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('I'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('J'.$numrow)->applyFromArray($style_row);

        $no++;
        $numrow++;
    }

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');

    header('Content-Disposition: attactchment;filename=Laporan Assessment360 Karyawan.xlsx');

    header('Cache-Control: max-age=0');
    $writer->save("php://output");
    exit();
  }

  public function exportAssessmentAll(){
    $this->global['pageTitle'] = 'Assessment';

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

    $sheet->setCellValue('B2', 'Laporan Assessment 360 Karyawan PT. Mirota KSM'); // Set kolom A1 Sebagai Header

    // $sheet->mergeCells('B2:E2'); // Set Merge Cell pada kolom A1 sampai E1
    
    $sheet->setCellValue('B5', 'No');
    $sheet->setCellValue('C5', 'Nama Karyawan');
    $sheet->setCellValue('D5', 'Departement');
    $sheet->setCellValue('E5', 'Divisi');
    $sheet->setCellValue('F5', 'Bagian');
    $sheet->setCellValue('G5', 'H');
    $sheet->setCellValue('H5', '1');
    $sheet->setCellValue('I5', '2');
    $sheet->setCellValue('J5', '3');
    $sheet->setCellValue('K5', 'O');
    $sheet->setCellValue('L5', '1');
    $sheet->setCellValue('M5', '2');
    $sheet->setCellValue('N5', '3');
    $sheet->setCellValue('O5', 'P');
    $sheet->setCellValue('P5', '1');
    $sheet->setCellValue('Q5', '2');
    $sheet->setCellValue('R5', '3');
    $sheet->setCellValue('S5', 'E');
    $sheet->setCellValue('T5', '1');
    $sheet->setCellValue('U5', '2');
    $sheet->setCellValue('V5', '3');

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
    $sheet->getStyle('M5')->applyFromArray($style_col);
    $sheet->getStyle('N5')->applyFromArray($style_col);
    $sheet->getStyle('O5')->applyFromArray($style_col);
    $sheet->getStyle('P5')->applyFromArray($style_col);
    $sheet->getStyle('Q5')->applyFromArray($style_col);
    $sheet->getStyle('R5')->applyFromArray($style_col);
    $sheet->getStyle('S5')->applyFromArray($style_col);
    $sheet->getStyle('T5')->applyFromArray($style_col);
    $sheet->getStyle('U5')->applyFromArray($style_col);
    $sheet->getStyle('V5')->applyFromArray($style_col);



    // $pegawai = $this->pegawai_model->showData();
    $pegawai = $this->assessment_model->getHasilAssessmentbyPegawai();

    $no = 1;
    $numrow = 6;
    foreach ($pegawai as $p) {
        $hasil = $this->assessment_model->getHasilAssessmentbyId($p->nip);
        $sheet->setCellValue('B'.$numrow, $no);
        $sheet->setCellValue('C'.$numrow, $p->nama_pegawai);
        $sheet->setCellValue('D'.$numrow, $p->nama_departement);
        $sheet->setCellValue('E'.$numrow, $p->nama_divisi);
        $sheet->setCellValue('F'.$numrow, $p->nama_bagian);
  
        $abjad = ["G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V"];
        foreach ($hasil as $h) {
        $explode_nilai = explode(",",$h->nilai);
        
        $coloum = 0;
        foreach ($explode_nilai as $nilai) {
          $explode_hasil = explode(":",$nilai);
          // var_dump($explode_hasil[1]);
          // var_dump($abjad[$coloum]);
          $sheet->setCellValue($abjad[$coloum].$numrow, $explode_hasil[1]);
          $coloum++;
        }

      }


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
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);
        $sheet->getColumnDimension('R')->setAutoSize(true);
        $sheet->getColumnDimension('S')->setAutoSize(true);
        $sheet->getColumnDimension('T')->setAutoSize(true);
        $sheet->getColumnDimension('U')->setAutoSize(true);
        $sheet->getColumnDimension('V')->setAutoSize(true);

    
        $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('H'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('I'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('J'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('J'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('K'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('L'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('M'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('O'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('P'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('Q'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('R'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('S'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('T'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('U'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('V'.$numrow)->applyFromArray($style_row);

        $no++;
        $numrow++;
    }

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');

    header('Content-Disposition: attactchment;filename=Laporan Assessment360 Karyawan.xlsx');

    header('Cache-Control: max-age=0');
    $writer->save("php://output");
    exit();
  }

  public function testing(){
      $abjad = ["H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W"];
      $hasil = $this->assessment_model->getHasilAssessmentbyId(113);

      foreach ($hasil as $h) {
        $explode_nilai = explode(",",$h->nilai);
        
        $coloum = 0;
        foreach ($explode_nilai as $nilai) {
          $explode_hasil = explode(":",$nilai);
          var_dump($explode_hasil[1]);
          var_dump($abjad[$coloum]);
          $coloum++;
        }

      }

  }
  
}