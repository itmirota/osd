<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

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
}