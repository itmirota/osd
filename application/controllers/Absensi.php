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

class Absensi extends BaseController
{

  public function __construct()
  {
      parent::__construct();
      $this->load->model('crud_model');
      $this->load->model('absensi_model');
      $this->isLoggedIn();
  }

  public function index(){
    $this->global['pageTitle'] = 'Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Absensi Manual Karyawan ';
    $pegawai_id = $this->global ['pegawai_id'];

    $dataabsensi = $this->absensi_model->showData($pegawai_id);

    $time_in = '';
    $time_out = '';
    foreach ($dataabsensi as $da){
      $time_in = $da->time_in;
      $time_out = $da->time_out;
    }

    $data['time_in']= $time_in;
    $data['time_out']= $time_out;
    $data['pegawai_id']= $pegawai_id;
    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');
    $data['datenow']= DATE('d M Y');

    $this->loadViewsUser("absensi/data", $this->global, $data, NULL);
  }

  public function absensi_visit(){
    $this->global['pageTitle'] = 'Absensi Visit Mirota KSM';
    $this->global['pageHeader'] = 'Absensi Visit Karyawan ';
    $pegawai_id = $this->global ['pegawai_id'];

    $data['list_data']= $this->absensi_model->getAbsenVisitHariIni($pegawai_id);
    $data['datenow']= DATE('d M Y');

    $this->loadViewsUser("absensi/data_visit", $this->global, $data, NULL);
  }

  function distance($latitude1, $longitude1, $latitude2, $longitude2) {
    $theta = $longitude1 - $longitude2; 
    $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
    $distance = acos($distance); 
    $distance = rad2deg($distance); 
    $miles = $distance * 60 * 1.1515; 
    $kilometers = $miles * 1.609344;
    $meters = $kilometers  * 1000; 
    return (round($meters,2)); 
  }

  public function cekJarak(){
    $latkantor = -7.779383571804818;
    $logkantor = 110.43408080373274;
    $lat = $this->input->post('lat');
    $long = $this->input->post('long');

    $jarak = $this->distance($latkantor, $logkantor, $lat, $long);
    echo json_encode($jarak);
  }

  public function saveIn(){
    $id_pegawai = $this->global ['pegawai_id'];
    $lat = $this->input->post('lat');
    $long = $this->input->post('long');


    $data = array(
      'pegawai_id' => $id_pegawai,
      'latitude_in' => $lat,
      'longitude_in' => $long,
      'date_in' => DATE('Y-m-d H:i:s')
    );

    $query = $this->crud_model->input($data, 'tbl_absensi');

    echo json_encode($data);
  }

  public function saveOut(){
    $id_pegawai = $this->global ['pegawai_id'];
    $lat = $this->input->post('lat');
    $long = $this->input->post('long');

    $where = array(
      'pegawai_id' => $id_pegawai,
      'DATE(date_in)' => DATE('Y-m-d'),
    );

    $data = array(
      'latitude_out' => $lat,
      'longitude_out' => $long,
      'date_out' => DATE('Y-m-d H:i:s')
    );

    $query = $this->crud_model->update($where, $data, 'tbl_absensi');

    echo json_encode($data);
  }

  public function laporan(){
    $this->global['pageTitle'] = 'Laporan Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Absensi Manual Karyawan ';

    $id = $this->input->post('id_pegawai');
    $periode = $this->input->post('periode');
    $datenow = DATE('Y-m');
    $tanggal = DATE('d');

    if (!empty($periode)){
      $periodeAkhir = $periode.'-20';
      $date = date_create($periode);
    }else{
      $periodeAkhir = $datenow.'-20';
      $date = date_create($datenow);
    }

    $bulanNow = date_format($date,'m');

    if ($bulanNow == 1){
      $bulan = 12;
      $tahun = date_format($date,'Y')-1;
    }else{
      $bulan = date_format($date,'m')-1;
      $tahun = date_format($date,'Y');
    }

    if($tanggal >= 21 && $tanggal <= 31){
      $bulanAwal = $bulan + 1;
      $bulanAwal == 13 ? $bulanAwal = 1 : $bulanAwal;
      $bulanAkhir = $bulanAwal + 1;
      $bulanAkhir == 13 ? $bulanAkhir = 1 : $bulanAkhir;
      
      $periodeAwal = $tahun.'-'.$bulanAwal.'-21';
      $periodeAkhir = $tahun.'-'.$bulanAkhir.'-20';
    }else{
      $periodeAwal = $tahun.'-'.$bulan.'-21';
    }

    $where = array(
      'date >=' => $periodeAwal,
      'date <=' => $periodeAkhir,
    );

    $id = isset($id) ? $id : 0;

    $data = array(
      'id' => $id,
      'periodeAwal' => $periodeAwal,
      'periodeAkhir' => $periodeAkhir,
      'list_data' => $this->absensi_model->ReportAbsenOnline($id, $where),
      'pegawai' => $this->crud_model->lihatdata('tbl_pegawai'),
    );

    $this->loadViews("absensi/laporan", $this->global, $data, NULL);
  }

  public function laporanDetail(){
    $this->global['pageTitle'] = 'Laporan Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Absensi Manual Karyawan ';

    $id = $this->uri->segment(3);
    $data['list_data'] = $this->absensi_model->showReportById($id);

    $this->loadViews("absensi/detail_laporan", $this->global, $data, NULL);
  }

  public function exportExcel(){
    $id = $this->uri->segment(2);
    $periodeAwal = $this->uri->segment(3);
    $periodeAkhir = $this->uri->segment(4);
    $awal = strftime('%d/%b/%Y', strtotime($periodeAwal));
    $akhir = strftime('%d/%b/%Y', strtotime($periodeAkhir));

    $where = array(
      'date >=' => $periodeAwal,
      'date <=' => $periodeAkhir,
    );

    $list_data = $this->absensi_model->ReportAbsenOnline($id, $where);

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

    $sheet->setCellValue('B2', 'Laporan Absensi PT. Mirota KSM'); // Set kolom A1 Sebagai Header
    $sheet->setCellValue('B3', 'Periode: '.$awal.' - '.$akhir); //

    // $sheet->mergeCells('B2:E2'); // Set Merge Cell pada kolom A1 sampai E1
    
    $sheet->setCellValue('B5', 'No');
    $sheet->setCellValue('C5', 'Nama Karyawan');
    $sheet->setCellValue('D5', 'Departement');
    $sheet->setCellValue('E5', 'Divisi');
    $sheet->setCellValue('F5', 'Tanggal');
    $sheet->setCellValue('G5', 'Masuk');
    $sheet->setCellValue('H5', 'Pulang');

    $sheet->getStyle('B5')->applyFromArray($style_col);
    $sheet->getStyle('C5')->applyFromArray($style_col);
    $sheet->getStyle('D5')->applyFromArray($style_col);
    $sheet->getStyle('E5')->applyFromArray($style_col);
    $sheet->getStyle('F5')->applyFromArray($style_col);
    $sheet->getStyle('G5')->applyFromArray($style_col);
    $sheet->getStyle('H5')->applyFromArray($style_col);

    $no = 1;
    $numrow = 6;
    foreach ($list_data as $ld) {
      $sheet->setCellValue('B'.$numrow, $no);
      $sheet->setCellValue('C'.$numrow, $ld->nama_pegawai);
      $sheet->setCellValue('D'.$numrow, $ld->nama_departement);
      $sheet->setCellValue('E'.$numrow, $ld->nama_divisi);
      $sheet->setCellValue('F'.$numrow, $ld->date);
      $sheet->setCellValue('G'.$numrow, $ld->time_in);
      $sheet->setCellValue('H'.$numrow, $ld->time_out);

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


    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');

    if (!empty($periodeAwal) && !empty($periodeAkhir)){
        header('Content-Disposition: attactchment;filename="Laporan Absensi Online" '.$awal.' - '.$akhir.'.xlsx');
    }else{
        header('Content-Disposition: attactchment;filename="Laporan Absensi Online".xlsx');
    }

    header('Cache-Control: max-age=0');
    $writer->save("php://output");
    exit();
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

    $data = array(
      'id_pegawai' => $this->pegawai_id,
      'nama_pegawai' => $this->name,
      'jenis_absen' => $this->uri->segment(2)
    );

    $this->loadViewsUser("absensi/webcam", $this->global, $data, NULL);
	}

  public function saveWebcam(){
    $input = json_decode($this->input->raw_input_stream, true);

    $id           = $input['id'];
    $jenis_absen  = $input['jenis_absen'];
    $imagecam     = $input['imagecam'];
    $lat          = $input['lat'];
    $lon          = $input['lon'];
    $wilayah      = $input['wilayah'];
    $kota         = $input['kota'];

    // ==============================
    // VALIDASI DATA WAJIB
    // ==============================
    if (!$id || !$jenis_absen || !$imagecam) {
        echo json_encode(["status" => "error", "msg" => "Data tidak lengkap"]);
        return;
    }

    // ==============================
    // DECODE FOTO
    // ==============================
    $imagecam = str_replace("data:image/jpeg;base64,", "", $imagecam);
    $imagecam = base64_decode($imagecam);

    $folder = FCPATH . 'assets/images/absensi/';
    if (!is_dir($folder)) mkdir($folder, 0777, true);

    $filename = "absen_" . $id . "_" . time() . ".jpg";

    if (!file_put_contents($folder . $filename, $imagecam)) {
        echo json_encode(["status" => "error", "msg" => "Gagal menyimpan foto"]);
        return;
    }

    // ==============================
    // ABSEN MASUK
    // ==============================
    if ($jenis_absen == "masuk") {

        // Cek apakah sudah absen masuk hari ini
        $cek = $this->absensi_model->cekMasukHariIni($id);

        if ($cek) {
            echo json_encode(["status" => "error", "msg" => "Anda sudah absen masuk hari ini"]);
            return;
        }

        $data = [
            "pegawai_id"      => $id,
            "date"            => date('Y-m-d'),
            "time_in"         => date('H:i:s'),
            "latitude_in"     => $lat,
            "longitude_in"    => $lon,
            "wilayah_in"      => $wilayah,
            "kota_in"         => $kota,
            "bukti_absensi_in"=> $filename
        ];

        $this->db->insert("tbl_absensi", $data);

        echo json_encode(["status" => "ok"]);
        return;
    }

    // ==============================
    // ABSEN PULANG
    // ==============================
    $absen = $this->absensi_model->getAbsenMasukHariIni($id);

    if (!$absen) {
        echo json_encode(["status" => "error", "msg" => "Anda belum absen masuk"]);
        return;
    }

    // Cek apakah sudah absen pulang
    if ($absen->time_out != NULL) {
        echo json_encode(["status" => "error", "msg" => "Anda sudah absen pulang"]);
        return;
    }

    // Update data pulang
    $data = [
        "time_out"          => date("H:i:s"),
        "latitude_out"      => $lat,
        "longitude_out"     => $lon,
        "wilayah_out"       => $wilayah,
        "kota_out"          => $kota,
        "bukti_absensi_out" => $filename,
    ];

    $this->db->where("id_absensi", $absen->id_absensi);
    $this->db->update("tbl_absensi", $data);

    echo json_encode(["status" => "ok"]);
  }

  public function Webcam_visit()
	{
    $this->global['pageTitle'] = 'Laporan Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Absensi Manual Karyawan ';

    $absen = $this->absensi_model->getVisitMasukHariIni($this->pegawai_id);

    $data = array(
      'id_pegawai' => $this->pegawai_id,
      'nama_pegawai' => $this->name,
      'jenis_absen' => $this->uri->segment(2),
      'list_absen' => $absen
    );

    $this->loadViewsUser("absensi/webcam_visit", $this->global, $data, NULL);
	}

  public function saveWebcamVisit(){
    $input = json_decode($this->input->raw_input_stream, true);

    $id           = $input['id'];
    $jenis_absen  = $input['jenis_absen'];
    $imagecam     = $input['imagecam'];
    $nama_toko    = $input['nama_toko'];
    $keterangan   = $input['keterangan'];
    $lat          = $input['lat'];
    $lon          = $input['lon'];
    $wilayah      = $input['wilayah'];
    $kota         = $input['kota'];
    $kodeRandom   = $input['kodeRandom'];

    // ==============================
    // VALIDASI DATA WAJIB
    // ==============================
    if (!$id || !$jenis_absen || !$imagecam) {
        echo json_encode(["status" => "error", "msg" => "Data tidak lengkap"]);
        return;
    }

    // ==============================
    // DECODE FOTO
    // ==============================
    $imagecam = str_replace("data:image/jpeg;base64,", "", $imagecam);
    $imagecam = base64_decode($imagecam);

    $folder = FCPATH . 'assets/images/absensi/';
    if (!is_dir($folder)) mkdir($folder, 0777, true);

    $filename = "absen_" . $id . "_" . time() . ".jpg";

    if (!file_put_contents($folder . $filename, $imagecam)) {
        echo json_encode(["status" => "error", "msg" => "Gagal menyimpan foto"]);
        return;
    }

    // ==============================
    // ABSEN MASUK
    // ==============================
    if ($jenis_absen == "masuk") {

        // Cek apakah sudah absen masuk hari ini
        // $cek = $this->absensi_model->cekMasukHariIni($id);

        // if ($cek) {
        //     echo json_encode(["status" => "error", "msg" => "Anda sudah absen masuk hari ini"]);
        //     return;
        // }

        $data = [
            "pegawai_id"      => $id,
            "date"            => date('Y-m-d'),
            "time_in"         => date('H:i:s'),
            "nama_toko"       => $nama_toko,
            "latitude_in"     => $lat,
            "longitude_in"    => $lon,
            "wilayah_in"      => $wilayah,
            "kota_in"         => $kota,
            "kode_in"         => $kodeRandom,
            "bukti_absensi_in"=> $filename
        ];

        $this->db->insert("tbl_absensi_visit", $data);

        echo json_encode(["status" => "ok"]);
        return;
    }

    // ==============================
    // ABSEN PULANG
    // ==============================
    $absen = $this->absensi_model->getVisitMasukHariIni($id);

    if (!$absen) {
        echo json_encode(["status" => "error", "msg" => "Anda belum absen masuk"]);
        return;
    }

    // Cek apakah sudah absen pulang
    if ($absen->time_out != NULL) {
        echo json_encode(["status" => "error", "msg" => "Anda sudah absen pulang"]);
        return;
    }

    // Update data pulang
    $data = [
        "time_out"          => date("H:i:s"),
        "keterangan"        => $keterangan,
        "latitude_out"      => $lat,
        "longitude_out"     => $lon,
        "wilayah_out"       => $wilayah,
        "kota_out"          => $kota,
        "kode_out"          => $kodeRandom,
        "bukti_absensi_out" => $filename
    ];

    $this->db->where("id_absensi_visit", $absen->id_absensi_visit);
    $this->db->update("tbl_absensi_visit", $data);

    echo json_encode(["status" => "ok"]);
  }

  public function laporanVisit()
  {
      $this->global['pageTitle']  = 'Laporan Absensi Visit Mirota KSM';
      $this->global['pageHeader'] = 'Laporan Absensi Visit Karyawan';

      // Input user
      $id       = $this->input->post('id_pegawai');
      $periode  = $this->input->post('periode'); // format Y-m
      $today    = date('Y-m-d');
      $tanggal  = date('d');
      $datenow  = date('Y-m');

      // ================================
      // 1. Tentukan periode dasar
      // ================================
      $periodeDasar = (!empty($periode)) ? $periode : $datenow;
      $periodeAkhir = $periodeDasar . '-20';

      $dateObj = date_create($periodeDasar);
      $bulanSekarang = (int) $dateObj->format('m');
      $tahunSekarang = (int) $dateObj->format('Y');

      // ================================
      // 2. Hitung bulan sebelumnya
      // ================================
      if ($bulanSekarang == 1) {
          $bulanLalu = 12;
          $tahunLalu = $tahunSekarang - 1;
      } else {
          $bulanLalu = $bulanSekarang - 1;
          $tahunLalu = $tahunSekarang;
      }

      // ================================
      // 3. Hitung Periode Awal – Akhir
      //    Sistem penggajian 21 – 20
      // ================================
      if ($tanggal >= 21) {
          // Masuk periode bulan berikutnya
          $bulanAwal  = $bulanSekarang;
          $bulanAkhir = $bulanSekarang + 1;

          if ($bulanAkhir > 12) { 
              $bulanAkhir = 1; 
              $tahunSekarang += 1; 
          }

          $periodeAwal  = sprintf("%d-%02d-21", $tahunSekarang, $bulanAwal);
          $periodeAkhir = sprintf("%d-%02d-20", $tahunSekarang, $bulanAkhir);

      } else {
          // Masuk periode sebelumnya
          $periodeAwal  = sprintf("%d-%02d-21", $tahunLalu, $bulanLalu);
          $periodeAkhir = sprintf("%d-%02d-20", $tahunSekarang, $bulanSekarang);
      }

      // ================================
      // 4. Buat kondisi query
      // ================================
      $where = array(
          'date >=' => $periodeAwal,
          'date <=' => $periodeAkhir
      );

      $id = $id ?? 0;

      // ================================
      // 5. Siapkan data view
      // ================================
      $data = array(
          'id'           => $id,
          'periodeAwal'  => $periodeAwal,
          'periodeAkhir' => $periodeAkhir,
          'list_data'    => $this->absensi_model->getLaporanAbsenVisit($where),
      );

      // ================================
      // 6. Load view
      // ================================
      $this->loadViews("absensi/laporan_visit", $this->global, $data, NULL);
  }


  // ABSENSI ISTIRAHAT

  public function istirahat(){
    $this->global['pageTitle'] = 'Absensi Istirahat Mirota KSM';
    $this->global['pageHeader'] = 'Absensi Istirahat Karyawan ';
    $role = $this->role;
    $pegawai_id = $this->global ['pegawai_id'];

    $where = array(
      'MONTH(date)' => DATE('m'),
      'pegawai_id' => $pegawai_id 
    );

    $data['list_data']= $this->crud_model->getdataOrderBy($where,'id_absensi_istirahat','DESC','tbl_absensi_istirahat');
    $data['datenow']= DATE('d M Y');

    // Check if the "mobile" word exists in User-Agent 
    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
    $isIPhone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "iphone")); 
    
    if($isMob | $isIPhone){ 
      $this->loadViewsUser("absensi/data_istirahat", $this->global, $data, NULL);
    }else{ 
      $this->set_notifikasi_swal('error','No no no !!!','Absensi hanya dapat diakses pada smartphone yaa..');
      redirect('dashboardUser');
    }
  }

  public function absensiIstirahat(){
    $this->global['pageTitle'] = 'Istirahat Karyawan Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Istirahat Karyawan Karyawan ';

    $data = array(
      'id_pegawai' => $this->pegawai_id,
      'nama_pegawai' => $this->name,
      'jenis_absen' => $this->uri->segment(2)
    );

    $this->loadViewsUser("absensi/webcam_istirahat", $this->global, $data, NULL);
	}

  public function simpanIstriahat(){
		$id_pegawai = $this->input->post('id');
		$jenis_absen = $this->input->post('jenis_absen');
		$image = $this->input->post('imagecam');
		$lat = $this->input->post('lat');
		$lon = $this->input->post('lon');
		$wilayah = $this->input->post('wilayah');
		$kota = $this->input->post('kota');

    if (is_null($wilayah)) {
      $wilayah = "";
      $kota = "";
    }

		$image = str_replace('[removed]','', $image);
		$image = base64_decode($image);
		$filename = 'image_'.time().'.jpg';
		file_put_contents(FCPATH.'/assets/images/istirahat/'.$filename,$image);

    if($jenis_absen == 'keluar'){
      $data = array(
        'pegawai_id' => $id_pegawai,
        'latitude_out' => $lat,
        'longitude_out' => $lon,
        'bukti_out' => $filename,
        'date' => DATE('Y-m-d'),
        'time_out' => DATE('H:i')
      );
  
      $res = $this->crud_model->input($data,'tbl_absensi_istirahat');
    }else{
      $id = $this->absensi_model->getDataRowIstirahat($id_pegawai)->id_absensi_istirahat;
      
      $where = array(
        'id_absensi_istirahat' => $id,
        'pegawai_id' => $id_pegawai,
        'date' => DATE('Y-m-d'),
      );

      $data = array(
        'time_in' => DATE('H:i:s'),
        'latitude_in' => $lat,
        'longitude_in' => $lon,
        'bukti_in' => $filename
      );
  
      $res = $this->crud_model->update($where,$data,'tbl_absensi_istirahat');
    }
		echo json_encode($res);
	}

  public function hapusIstirahat($id){

    $where = array(
      'id_absensi_istirahat' => $id
    );

    $data = $this->crud_model->GetDataByWhere($where,'tbl_absensi_istirahat');
    foreach ($data as $d){
      unlink( FCPATH.'/assets/images/istirahat/'.$d->bukti_out);
      unlink( FCPATH.'/assets/images/istirahat/'.$d->bukti_in);
    }

    $this->crud_model->delete($where, 'tbl_absensi_istirahat');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('laporan-istirahat');
  }

  public function laporanIstirahat(){
    $this->global['pageTitle'] = 'Laporan Istirahat Karyawan Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Istirahat Karyawan Karyawan ';

    $divisi = $this->divisi_id;
    $role = $this->global ['role'];
    $id = $this->pegawai_id;

    $tgl_awal = $this->input->post('tgl_awal');
    $tgl_akhir = $this->input->post('tgl_akhir');
    $id_pegawai = $this->input->post('id_pegawai');

    if ($role == ROLE_HRGA | $role == ROLE_SUPERADMIN){
      $list_data = $this->absensi_model->getDataIstirahat();
    }elseif($role == ROLE_MANAGER){
      $list_data = $this->absensi_model->getDataIstirahatByManager($id);
    }else{
      $list_data = $this->absensi_model->getDataIstirahatByDivisi($divisi);
    }

    $data = array(
      'list_data' => $list_data
    );

    $this->loadViews("absensi/laporan_istirahat", $this->global, $data, NULL);
  }
  
  public function exportExcelIstirahat(){
    $awal = $this->input->post('tgl_awal');
    $akhir = $this->input->post('tgl_akhir');
    $tgl_awal = strftime('%d/%b/%Y', strtotime($awal));
    $tgl_akhir = strftime('%d/%b/%Y', strtotime($akhir));

    $where = array(
      'date >=' => $awal,
      'date <=' => $akhir,
    );

    $list_data = $this->absensi_model->ReportAbsenIstirahat($where);

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

    $sheet->setCellValue('B2', 'Laporan Absensi PT. Mirota KSM'); // Set kolom A1 Sebagai Header
    $sheet->setCellValue('B3', 'Periode: '.$awal.' - '.$akhir); //

    // $sheet->mergeCells('B2:E2'); // Set Merge Cell pada kolom A1 sampai E1
    
    $sheet->setCellValue('B5', 'No');
    $sheet->setCellValue('C5', 'Nama Karyawan');
    $sheet->setCellValue('D5', 'Departement');
    $sheet->setCellValue('E5', 'Divisi');
    $sheet->setCellValue('F5', 'Tanggal');
    $sheet->setCellValue('G5', 'Keluar');
    $sheet->setCellValue('H5', 'Masuk');

    $sheet->getStyle('B5')->applyFromArray($style_col);
    $sheet->getStyle('C5')->applyFromArray($style_col);
    $sheet->getStyle('D5')->applyFromArray($style_col);
    $sheet->getStyle('E5')->applyFromArray($style_col);
    $sheet->getStyle('F5')->applyFromArray($style_col);
    $sheet->getStyle('G5')->applyFromArray($style_col);
    $sheet->getStyle('H5')->applyFromArray($style_col);

    $no = 1;
    $numrow = 6;
    foreach ($list_data as $ld) {
      $sheet->setCellValue('B'.$numrow, $no);
      $sheet->setCellValue('C'.$numrow, $ld->nama_pegawai);
      $sheet->setCellValue('D'.$numrow, $ld->nama_departement);
      $sheet->setCellValue('E'.$numrow, $ld->nama_divisi);
      $sheet->setCellValue('F'.$numrow, $ld->date);
      $sheet->setCellValue('G'.$numrow, $ld->time_out);
      $sheet->setCellValue('H'.$numrow, $ld->time_in);

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


    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');

    if (!empty($tgl_awal) && !empty($tgl_akhir)){
        header('Content-Disposition: attactchment;filename="Laporan Istirahat " '.$tgl_awal.' - '.$tgl_akhir.'.xlsx');
    }else{
        header('Content-Disposition: attactchment;filename="Laporan Istirahat".xlsx');
    }

    header('Cache-Control: max-age=0');
    $writer->save("php://output");
    exit();
  }
  // ABSENSI ISTIRAHAT

  // ABSENSI MESIN

  public function laporan_absensi_mesin(){
    $this->global['pageTitle'] = 'Laporan Absensi Mesin Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Absensi Mesin ';

    $data['list_data'] = $this->crud_model->lihatdata('tbl_absensi_mesin');

    $this->loadViews("absensi/laporan_mesin", $this->global, $data, NULL);
  }

  public function format_absensi_mesin(){
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="format absensi mesin.xlsx"');

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    $sheet->setCellValue('A1', 'NIK');
    $sheet->setCellValue('B1', 'Nama Karyawan');
    $sheet->setCellValue('C1', 'Jabatan');
    $sheet->setCellValue('D1', 'Departement');
    $sheet->setCellValue('E1', 'Status Karyawan');
    $sheet->setCellValue('F1', 'Tempat Lahir');
    $sheet->setCellValue('G1', 'Tanggal Lahir');
    $sheet->setCellValue('H1', 'Shio');
    $sheet->setCellValue('I1', 'Zodiak');
    $sheet->setCellValue('J1', 'Weton');
    $sheet->setCellValue('K1', 'Jenis Kelamin');
    $sheet->setCellValue('L1', 'Pendidikan Terakhir');
    $sheet->setCellValue('M1', 'Jurusan terakhir');
    $sheet->setCellValue('N1', 'Golongan Darah');
    $sheet->setCellValue('O1', 'Agama');
    $sheet->setCellValue('P1', 'Alamat(KTP)');
    $sheet->setCellValue('Q1', 'Alamat(Domisili)');
    $sheet->setCellValue('R1', 'No. Kontak');
    $sheet->setCellValue('S1', 'No. KK');
    $sheet->setCellValue('T1', 'No. KTP');
    $sheet->setCellValue('U1', 'No. Jamsostek');
    $sheet->setCellValue('V1', 'No. BPJSKes');
    $sheet->setCellValue('W1', 'NPWP');
    $sheet->setCellValue('X1', 'Tanggal Masuk');
    $sheet->setCellValue('Y1', 'Tanggal Selesai');
    $sheet->setCellValue('Z1', 'Durasi Kontrak');
    $sheet->setCellValue('AA1', 'kuota Cuti');
    $sheet->setCellValue('AB1', 'Sisa Cuti Tahun Lalu');
    $sheet->setCellValue('AC1', 'Email');
    $sheet->setCellValue('AD1', 'Nama Ibu');
    $sheet->setCellValue('AE1', 'Status Pernikahan');
    $sheet->setCellValue('AF1', 'Nama Ayah');
    $sheet->setCellValue('AG1', 'Nama Pasangan');
    $sheet->setCellValue('AH1', 'Nama Anak');
    $sheet->setCellValue('AI1', 'Username');
    $sheet->setCellValue('AJ1', 'Password');
    $sheet->setCellValue('AK1', 'Role');

    $sheet->setCellValue('A2', '0001');
    $sheet->setCellValue('B2', 'Albert');
    $sheet->setCellValue('C2', '5');
    $sheet->setCellValue('D2', '6');
    $sheet->setCellValue('E2', 'tetap/kontrak');
    $sheet->setCellValue('F2', 'yogyakarta');
    $sheet->setCellValue('G2', '2024-07-08 (thn-bln-tgl)');
    $sheet->setCellValue('H2', 'Jaran Kepang');
    $sheet->setCellValue('I2', 'Taurus');
    $sheet->setCellValue('J2', 'Pon');
    $sheet->setCellValue('K2', 'L');
    $sheet->setCellValue('L2', 'S1');
    $sheet->setCellValue('M2', 'S1 Perhutanan');
    $sheet->setCellValue('N2', 'AB');
    $sheet->setCellValue('O2', 'Islam');
    $sheet->setCellValue('P2', 'jalan xxx');
    $sheet->setCellValue('Q2', 'jalan xxx');
    $sheet->setCellValue('R2', '082323456');
    $sheet->setCellValue('S2', '347611330827');
    $sheet->setCellValue('T2', '347611330827');
    $sheet->setCellValue('U2', '347611330827');
    $sheet->setCellValue('V2', '347611330827');
    $sheet->setCellValue('W2', '(kosongkan jika tidak ada)');
    $sheet->setCellValue('X2', '2024-07-08 (thn-bln-tgl)');
    $sheet->setCellValue('Y2', '2024-07-08 (thn-bln-tgl)');
    $sheet->setCellValue('Z2', '12');
    $sheet->setCellValue('AA2', '12');
    $sheet->setCellValue('AB2', '0');
    $sheet->setCellValue('AC2', 'Email@gmail.com');
    $sheet->setCellValue('AD2', 'Tukini');
    $sheet->setCellValue('AE2', 'Tukini');
    $sheet->setCellValue('AF2', 'menikah/lajang');
    $sheet->setCellValue('AG2', 'Gudil Godel');
    $sheet->setCellValue('AH2', 'Gudil Godel');
    $sheet->setCellValue('AI2', 'albert');
    $sheet->setCellValue('AJ2', 'albert');
    $sheet->setCellValue('AK2', '8');

    $sheet->getColumnDimension('A')->setAutoSize(true);
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
    $sheet->getColumnDimension('W')->setAutoSize(true);
    $sheet->getColumnDimension('X')->setAutoSize(true);
    $sheet->getColumnDimension('Y')->setAutoSize(true);
    $sheet->getColumnDimension('Z')->setAutoSize(true);
    $sheet->getColumnDimension('AA')->setAutoSize(true);
    $sheet->getColumnDimension('AB')->setAutoSize(true);
    $sheet->getColumnDimension('AC')->setAutoSize(true);
    $sheet->getColumnDimension('AD')->setAutoSize(true);
    $sheet->getColumnDimension('AE')->setAutoSize(true);
    $sheet->getColumnDimension('AF')->setAutoSize(true);
    $sheet->getColumnDimension('AG')->setAutoSize(true);
    $sheet->getColumnDimension('AH')->setAutoSize(true);
    $sheet->getColumnDimension('AJ')->setAutoSize(true);
    $sheet->getColumnDimension('AK')->setAutoSize(true);

    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
  }

  public function input_absensi_mesin(){
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
        $nip=sprintf("%04s", $sheetdata[$i][0]);
        $departement=$sheetdata[$i][1];
        $nama_pegawai=$sheetdata[$i][2];
        $date=$sheetdata[$i][3];
        $time_in=$sheetdata[$i][4];
        $time_out=$sheetdata[$i][5];

        $data[]=array(
          'nip'=> $nip,
          'departement'=>$departement,
          'nama_pegawai'=>$nama_pegawai,
          'date'=>$date,
          'time_in'=>$time_in,
          'time_out'=>$time_out
        );
      }

      $inserdata=$this->crud_model->save_batch('tbl_absensi_mesin',$data);
      if($inserdata)
      {
        $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diinput');
      } else {
        $this->set_notifikasi_swal('danger','Gagal','Data Gagal Diinput');
      }

      redirect('Datapegawai');
    }
  }
  // ABSENSI MESIN

  // KETERLAMBATAN
  public function keterlambatan(){
    $this->global['pageTitle'] = 'Laporan Istirahat Karyawan Mirota KSM';
    $role = $this->role;
    $divisi = $this->divisi;

    if($role == ROLE_MANAGER){
    $data['list_data'] = $this->absensi_model->getPegawaiTerlambat(['manager_id' => $id_pegawai]);
    }elseif($role == ROLE_KABAG){
    $data['list_data'] = $this->absensi_model->getPegawaiTerlambat(['divisi_id' => $divisi]);
    }else{
    $data['list_data'] = $this->absensi_model->getPegawaiTerlambat(NULL);
    }

    $data['pegawai'] = $this->crud_model->lihatdata('tbl_pegawai');
    $data['departement'] = $this->crud_model->lihatdata('tbl_departement');

    $this->loadViews("absensi/data_pegawai_terlambat", $this->global, $data, NULL);
  }

  public function simpanKeterlambatan(){
    $pegawai_id = $this->input->post('pegawai_id');
    $tgl_terlambat = $this->input->post('tgl_terlambat');
    $waktu_terlambat = $this->input->post('waktu_terlambat');
    $createdBy = $this->pegawai_id;


    $data = array(
      'pegawai_id' => $pegawai_id,
      'tgl_terlambat' => $tgl_terlambat,
      'waktu_terlambat' => $waktu_terlambat,
      'createdBy' => $createdBy
    );

    $sql = $this->crud_model->input($data,'tbl_absensi_terlambat');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diinput');
    redirect('karyawan-terlambat');
  }
  // KETERLAMBATAN
}