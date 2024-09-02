<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Departement extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $this->load->model('crud_model');
      $this->load->model('departement_model');
      $this->isLoggedIn();   
  }


  public function index(){
    $this->global['pageTitle'] = 'Admin Panel : Dashboard';
      
    // $data['list_data']= $this->crud_model->lihatdata('tbl_departement');

    $data['list_data']= $this->departement_model->GetDepartementWithCountDivisi();


    $this->loadViews("departement/data", $this->global, $data, NULL);
  }

  public function save(){
    $nama_departement = $this->input->post('nama_departement');

    $data = array(
      'nama_departement' => $nama_departement,
    );

    $sql = $this->crud_model->input($data,'tbl_departement');

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('departement');
  }

  public function detaildepartement($id) {

    $where = array(
      'id_departement' => $id
    );

    $departement = $this->crud_model->GetDataById($where,'tbl_departement');
    
    $data = array(
      'departement' => $departement[0]
    );

    echo json_encode($data);
  }

  public function update(){
    $id_departement = $this->input->post('id_departement');
    $nama_departement = $this->input->post('nama_departement');

    $where = array(
      'id_departement' => $id_departement
    );

    $data = array(
      'nama_departement' => $nama_departement,
    );

    $sql = $this->crud_model->update($where, $data,'tbl_departement');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diubah');

    redirect('departement');
  }

  public function delete(){
    $id_departement = $this->uri->segment(2);

    $where = array(
      'id_departement' => $id_departement
    );

    $this->crud_model->delete($where, 'tbl_departement');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('departement');
  }
}