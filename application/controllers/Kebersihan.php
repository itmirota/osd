<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

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
}