<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

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
}