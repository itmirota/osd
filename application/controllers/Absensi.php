<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

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
    $this->global['pageTitle'] = 'Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Absensi Manual Karyawan ';
    $pegawai_id = $this->global ['pegawai_id'];

    $data['list_data']= $this->absensi_model->showData($pegawai_id);
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
    $latkantor = -7.779493249061303;
    $logkantor = 110.43453643518103;
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

    // $id = $this->input->post('id_pegawai');
    // $periode = $this->input->post('periode');
    // $datenow = DATE('Y-m');


    // if (!empty($periode)){
    //   $periodeAkhir = $periode.'-20';
    //   $date = date_create($periode);
    // }else{
    //   $periodeAkhir = $datenow.'-20';
    //   $date = date_create($datenow);
    // }

    // $bulan = date_format($date,'m')-1;
    // $tahun = date_format($date,'Y');

    // $periodeAwal = $tahun.'-'.$bulan.'-21';

    // $where = array(
    //   'DATE(datecreated) >=' => $periodeAwal,
    //   'DATE(datecreated) <=' => $periodeAkhir,
    // );

    $data['list_data']= $this->absensi_model->showReport();
    // $data['detail_data']= $this->absensi_model->showReportByDate();
    // $data['periode']= mediumdate_indo($periodeAwal).' - '.mediumdate_indo($periodeAkhir);

    // $data['list_data']= $this->absensi_model->showReportByDate();

    $this->loadViews("absensi/laporan", $this->global, $data, NULL);
  }

  public function laporanDetail(){
    $this->global['pageTitle'] = 'Laporan Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Absensi Manual Karyawan ';

    $id = $this->uri->segment(3);
    $data['list_data'] = $this->absensi_model->showReportById($id);

    $this->loadViews("absensi/detail_laporan", $this->global, $data, NULL);
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

  public function Webcam_visit()
	{
    $this->global['pageTitle'] = 'Laporan Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Absensi Manual Karyawan ';

    $data = array(
      'id_pegawai' => $this->pegawai_id,
      'nama_pegawai' => $this->name,
      'jenis_absen' => $this->uri->segment(2)
    );

    $this->loadViewsUser("absensi/webcam_visit", $this->global, $data, NULL);
	}

  public function saveWebcam(){
		$id_pegawai = $this->input->post('id');
		$jenis_absen = $this->input->post('jenis_absen');
		$image = $this->input->post('imagecam');
		$lat = $this->input->post('lat');
		$lon = $this->input->post('lon');

		$image = str_replace('[removed]','', $image);
		$image = base64_decode($image);
		$filename = 'image_'.time().'.jpg';
		file_put_contents(FCPATH.'/assets/images/absensi/'.$filename,$image);

    if($jenis_absen == 'masuk'){
      $data = array(
        'pegawai_id' => $id_pegawai,
        'latitude_in' => $lat,
        'longitude_in' => $lon,
        'bukti_absensi_in' => $filename,
        'date' => DATE('Y-m-d'),
        'time_in' => DATE('H:i:s')
      );
  
      $res = $this->crud_model->input($data,'tbl_absensi');
    }else{
      $id = $this->absensi_model->getDataAbsenById($id_pegawai)->id_absensi;
      $where = array(
        'id_absensi' => $id,
        'pegawai_id' => $id_pegawai,
        'DATE(date)' => DATE('Y-m-d'),
      );

      $data = array(
        'time_out' => DATE('H:i:s'),
        'latitude_out' => $lat,
        'longitude_out' => $lon,
        'bukti_absensi_out' => $filename
      );
  
      $res = $this->crud_model->update($where,$data,'tbl_absensi');
    }
		echo json_encode($res);
	}
}