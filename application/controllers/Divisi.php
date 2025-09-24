<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Divisi extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('crud_model');
      $this->load->model('divisi_model');
      $this->load->model('pegawai_model');
      $this->isLoggedIn();   
  }

  // DIVISI
  public function index(){
    $this->global['pageTitle'] = 'Admin Panel : Data Divisi';

    $role = $this->role;
    $pegawai_id = $this->pegawai_id;

    if($role == ROLE_MANAGER){
      $where = array(
        'manager_id' => $pegawai_id,
        'status' => 'aktif',
      );
      $list_data = $this->divisi_model->GetDivisiWhere($where);
    }else{
      $list_data = $this->divisi_model->GetDivisi();
    }
    
    $data['list_data']= $list_data;
    $data['pegawai']= $this->crud_model->lihatdata('tbl_pegawai');
    $data['departement']= $this->crud_model->lihatdata('tbl_departement');


    $this->loadViews("divisi/data", $this->global, $data, NULL);
  }

  public function divisiByDept($id){
    $this->global['pageTitle'] = 'Admin Panel : Divisi';

    $data['list_data']= $this->divisi_model->GetDivisiByDeptWithCountEmployee($id);
    $data['pegawai']= $this->crud_model->lihatdata('tbl_pegawai');
    $data['departement']= $this->crud_model->lihatdata('tbl_departement');


    $this->loadViews("divisi/data", $this->global, $data, NULL);
  }

  public function save(){
    $nama_divisi = $this->input->post('nama_divisi');
    $departement_id = $this->input->post('departement_id');
    $kadiv_id = $this->input->post('kadiv_id');
    $manager_id = $this->input->post('manager_id');

    $data = array(
      'nama_divisi' => $nama_divisi,
      'departement_id' => $departement_id,
      'kadiv_id' => $kadiv_id,
      'manager_id' => $manager_id,
    );

    $sql = $this->crud_model->input($data,'tbl_divisi');

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('divisi');
  }

  public function detaildivisi($id) {

    $where = array(
      'id_divisi' => $id
    );

    $divisi = $this->crud_model->GetDataByWhere($where,'tbl_divisi');
    
    $data = array(
      'divisi' => $divisi[0]
    );

    echo json_encode($data);
  }

  public function update(){
    $id_divisi = $this->input->post('id_divisi');
    $departement_id = $this->input->post('departement_id');
    $nama_divisi = $this->input->post('nama_divisi');
    $kadiv_id = $this->input->post('kadiv_id');
    $manager_id = $this->input->post('manager_id');

    $where = array(
      'id_divisi' => $id_divisi
    );

    $data = array(
      'nama_divisi' => $nama_divisi,
      'departement_id' => $departement_id,
      'kadiv_id' => $kadiv_id,
      'manager_id' => $manager_id,
    );

    $sql = $this->crud_model->update($where, $data,'tbl_divisi');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diubah');

    redirect('divisi');
  }

  public function delete(){
    $id_divisi = $this->uri->segment(2);

    $where = array(
      'id_divisi' => $id_divisi
    );

    $this->crud_model->delete($where, 'tbl_divisi');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('divisi');
  }

  public function getDivisiByDept($id_departement){

    $divisi = $this->crud_model->GetDataByWhere(['departement_id' => $id_departement],'tbl_divisi');

    echo json_encode($divisi);
  }
  // DIVISI

  // SUBDIVISI
  // SUBDIVISI
}