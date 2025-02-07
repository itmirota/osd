<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Keterlambatan extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $this->load->model('crud_model');
      $this->load->model('keterlambatan_model');
      $this->isLoggedIn();   
  }

  // DIVISI
  public function index(){
    $this->global['pageTitle'] = 'Admin Panel : Data Divisi';

    $role = $this->role;
    $pegawai_id = $this->pegawai_id;

    if($role == ROLE_MANAGER | $role == ROLE_KABAG){
      $where = array(
        'manager_id' => $pegawai_id,
        'status' => 'aktif',
      );
      $list_data = $this->keterlambatan_model->GetKeterlambatanWhere($where);
    }else{
      $list_data = $this->keterlambatan_model->GetKeterlambatan();
    }
    
    $data['list_data']= $list_data;

    $this->loadViews("keterlambatan/data", $this->global, $data, NULL);
  }

  public function save(){
    $periode = $this->input->post('periode');
    $pegawai_id = $this->input->post('pegawai_id');
    $jml_keterlambatan = $this->input->post('jml_keterlambatan');

    $data = array(
      'periode' => $periode,
      'pegawai_id' => $pegawai_id,
      'jml_keterlambatan' => $jml_keterlambatan,
    );

    $sql = $this->crud_model->input($data,'tbl_keterlambatan');

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('keterlambatan');
  }

  public function detailketerlambatan($id) {

    $where = array(
      'id_keterlambatan' => $id
    );

    $keterlambatan = $this->crud_model->GetDataByWhere($where,'tbl_keterlambatan');
    
    $data = array(
      'keterlambatan' => $keterlambatan[0]
    );

    echo json_encode($data);
  }

  public function update(){
    $periode = $this->input->post('periode');
    $pegawai_id = $this->input->post('pegawai_id');
    $jml_keterlambatan = $this->input->post('jml_keterlambatan');

    $data = array(
      'periode' => $periode,
      'pegawai_id' => $pegawai_id,
      'jml_keterlambatan' => $jml_keterlambatan,
    );


    $where = array(
      'id_keterlambatan' => $id_keterlambatan
    );

    $sql = $this->crud_model->update($where, $data,'tbl_keterlambatan');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diubah');

    redirect('keterlambatan');
  }

  public function delete(){
    $id_keterlambatan = $this->uri->segment(2);

    $where = array(
      'id_keterlambatan' => $id_keterlambatan
    );

    $this->crud_model->delete($where, 'tbl_keterlambatan');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('keterlambatan');
  }
}