<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Bagian extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('crud_model');
      $this->load->model('bagian_model');
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
      $list_data = $this->bagian_model->GetBagianWhere($where);
    }else{
      $list_data = $this->bagian_model->GetBagian();
    }
    
    $data['list_data']= $list_data;
    $data['pegawai']= $this->crud_model->lihatdata('tbl_pegawai');
    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');
    $data['departement']= $this->crud_model->lihatdata('tbl_departement');

    $this->loadViews("bagian/data", $this->global, $data, NULL);
  }

  public function bagianByDivisi(){
    $this->global['pageTitle'] = 'Admin Panel : Bagian';

    $id = $this->uri->segment(2);

    $data['list_data']= $this->bagian_model->GetBagianByDivisiWithCountEmployee($id);
    $data['pegawai']= $this->crud_model->lihatdata('tbl_pegawai');
    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');
    $data['departement']= $this->crud_model->lihatdata('tbl_departement');

    $this->loadViews("bagian/data", $this->global, $data, NULL);
  }

  public function save(){
    $nama_bagian = $this->input->post('nama_bagian');
    $divisi_id = $this->input->post('divisi_id');
    $kabag_id = $this->input->post('kabag_id');

    $data = array(
      'nama_bagian' => $nama_bagian,
      'divisi_id' => $divisi_id,
      'kabag_id' => $kabag_id,
    );

    $sql = $this->crud_model->input($data,'tbl_bagian');

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('bagian');
  }

  public function detailbagian($id) {

    $where = array(
      'id_bagian' => $id
    );

    $bagian = $this->crud_model->GetDataByWhere($where,'tbl_bagian');
    
    $data = array(
      'bagian' => $bagian[0]
    );

    echo json_encode($data);
  }

  public function update(){
    $id_bagian = $this->input->post('id_bagian');
    $divisi_id = $this->input->post('divisi_id');
    $nama_bagian = $this->input->post('nama_bagian');
    $kabag_id = $this->input->post('kabag_id');

    $where = array(
      'id_bagian' => $id_bagian
    );

    $data = array(
      'nama_bagian' => $nama_bagian,
      'divisi_id' => $divisi_id,
      'kabag_id' => $kabag_id,
    );

    $sql = $this->crud_model->update($where, $data,'tbl_bagian');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diubah');

    redirect('bagian');
  }

  public function delete(){
    $id_bagian = $this->uri->segment(2);

    $where = array(
      'id_bagian' => $id_bagian
    );

    $this->crud_model->delete($where, 'tbl_bagian');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('bagian');
  }

  public function getBagianByDiv($id){

    $bagian = $this->crud_model->GetDataByWhere(['divisi_id' => $id],'tbl_bagian');

    echo json_encode($bagian);
  }
}