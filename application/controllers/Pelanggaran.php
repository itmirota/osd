<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Pelanggaran extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $this->load->model('crud_model');
      $this->load->model('pelanggaran_model');
      $this->isLoggedIn();   
  }

  // DIVISI
  public function index(){
    $this->global['pageTitle'] = 'Admin Panel : Data Divisi';

    $role = $this->role;
    $pegawai_id = $this->pegawai_id;

    if($role == ROLE_MANAGER){
      $list_data = $this->pelanggaran_model->GetPelanggaranWhere(['manager_id' => $pegawai_id]);
    }elseif ($role == ROLE_KABAG){
      $list_data = $this->pelanggaran_model->GetPelanggaranWhere(['kadiv_id' => $pegawai_id]);
    }else{
      $list_data = $this->pelanggaran_model->GetPelanggaran();
    }
    
    $data['list_data']= $list_data;
    $data['pegawai']= $this->crud_model->lihatdata('tbl_pegawai');

    $this->loadViews("pelanggaran/data", $this->global, $data, NULL);
  }

  public function save(){
    
    $periode = $this->input->post('periode');
    $pegawai_id = $this->input->post('pegawai_id');
    $jenis_pelanggaran = $this->input->post('jenis_pelanggaran');
    $jml_pelanggaran = $this->input->post('jml_pelanggaran');
    $satuan = $this->input->post('satuan');
    $sanksi = $this->input->post('sanksi');

    $data = array(
      'periode' => $periode,
      'pegawai_id' => $pegawai_id,
      'jenis_pelanggaran' => $jenis_pelanggaran,
      'jml_pelanggaran' => $jml_pelanggaran,
      'satuan' => $satuan,
      'sanksi' => $sanksi,
    );

    $sql = $this->crud_model->input($data,'tbl_pelanggaran');

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('pelanggaran');
  }

  public function detailpelanggaran($id) {

    $where = array(
      'id_pelanggaran' => $id
    );

    $pelanggaran = $this->crud_model->GetDataByWhere($where,'tbl_pelanggaran');
    
    $data = array(
      'pelanggaran' => $pelanggaran[0]
    );

    echo json_encode($data);
  }

  public function update(){
    $periode = $this->input->post('periode');
    $pegawai_id = $this->input->post('pegawai_id');
    $jenis_pelanggaran = $this->input->post('jenis_pelanggaran');
    $jml_pelanggaran = $this->input->post('jml_pelanggaran');
    $satuan = $this->input->post('satuan');
    $sanksi = $this->input->post('sanksi');

    $data = array(
      'periode' => $periode,
      'pegawai_id' => $pegawai_id,
      'jenis_pelanggaran' => $jenis_pelanggaran,
      'jml_pelanggaran' => $jml_pelanggaran,
      'satuan' => $satuan,
      'sanksi' => $sanksi,
    );


    $where = array(
      'id_pelanggaran' => $id_pelanggaran
    );

    $sql = $this->crud_model->update($where, $data,'tbl_pelanggaran');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diubah');

    redirect('pelanggaran');
  }

  public function delete(){
    $id_pelanggaran = $this->uri->segment(2);

    $where = array(
      'id_pelanggaran' => $id_pelanggaran
    );

    $this->crud_model->delete($where, 'tbl_pelanggaran');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('pelanggaran');
  }
}