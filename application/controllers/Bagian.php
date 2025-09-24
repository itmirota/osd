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

    $divisi = $this->crud_model->GetDataRowByWhere('divisi_id',['id_bagian' => $id],'tbl_bagian');

    $data['list_data']= $this->bagian_model->GetBagianByDivisiWithCountEmployee($id);
    $data['pegawai']= $this->crud_model->lihatdata('tbl_pegawai');
    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');
    $data['departement']= $this->crud_model->lihatdata('tbl_departement');
    $data['id_divisi']= $divisi->divisi_id;

    $this->loadViews("bagian/data", $this->global, $data, NULL);
  }

  public function pegawaiByBagian($id){
    $this->global['pageTitle'] = 'Admin Panel : Data Pegawai';

    $data['list_data']= $this->pegawai_model->showDataWhere('*', ['bagian_id' => $id, 'status' => 'aktif'], NULL, NULL, NULL);
    $data['bagian_id']= $this->crud_model->GetDataRowByWhere('divisi_id',['id_bagian' => $id],'tbl_bagian')->divisi_id;

    $this->loadViews("pegawai/data", $this->global, $data, NULL);
  }

  public function save(){
    $nama_bagian = $this->input->post('nama_bagian');
    $divisi_id = $this->input->post('divisi_id');
    $atasan1 = $this->input->post('atasan1');
    $atasan2 = $this->input->post('atasan2');

    $data = array(
      'nama_bagian' => $nama_bagian,
      'atasan1' => $atasan1,
      'atasan2' => $atasan2
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

    $bagian = $this->bagian_model->GetBagianById($id);

    echo json_encode($bagian);
  }

  public function update(){
    $id = $this->input->get('id');

    $id_bagian = $this->input->post('id_bagian');
    $divisi_id = $this->input->post('divisi_id');
    $nama_bagian = $this->input->post('nama_bagian');
    $atasan1 = $this->input->post('atasan1');
    $atasan2 = $this->input->post('atasan2');

    $where = array(
      'id_bagian' => $id_bagian
    );

    $data = array(
      'nama_bagian' => $nama_bagian,
      'divisi_id' => $divisi_id,
      'atasan1' => $atasan1,
      'atasan2' => $atasan2
    );

    $sql = $this->crud_model->update($where, $data,'tbl_bagian');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diubah');

    redirect('bagian/'.$id);
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