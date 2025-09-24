<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class areakerja extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('crud_model');
      $this->load->model('master_model');
      $this->isLoggedIn();   
  }

  // areakerja
  public function index(){
    $this->global['pageTitle'] = 'Admin Panel : Data areakerja';
    
    $data['list_data']= $this->crud_model->lihatdata('tbl_areakerja');

    $this->loadViews("areakerja/data", $this->global, $data, NULL);
  }

  public function save(){
    $nama_areakerja = $this->input->post('nama_areakerja');
    $spv_id = $this->input->post('spv_id');

    $data = array(
      'nama_areakerja' => $nama_areakerja,
      'spv_id' => $spv_id,
    );

    $sql = $this->crud_model->input($data,'tbl_areakerja');

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('areakerja');
  }

  public function detailareakerja($id) {

    $where = array(
      'id_areakerja' => $id
    );

    $areakerja = $this->crud_model->GetDataByWhere($where,'tbl_areakerja');
    
    $data = array(
      'areakerja' => $areakerja[0]
    );

    echo json_encode($data);
  }

  public function update(){
    $nama_areakerja = $this->input->post('nama_areakerja');
    $spv_id = $this->input->post('spv_id');

    $where = array(
      'id_areakerja' => $id_areakerja
    );

    $data = array(
        'nama_areakerja' => $nama_areakerja,
        'spv_id' => $spv_id,
    );

    $sql = $this->crud_model->update($where, $data,'tbl_areakerja');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diubah');

    redirect('areakerja');
  }

  public function delete(){
    $id_areakerja = $this->uri->segment(3);

    $where = array(
      'id_areakerja' => $id_areakerja
    );

    $this->crud_model->delete($where, 'tbl_areakerja');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('areakerja');
  }
}