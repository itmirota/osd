<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class SuratTugas extends BaseController
{

  public function __construct()
  {
      parent::__construct();
      $this->load->model('crud_model');
      $this->load->model('perizinan_model');
      $this->load->model('pegawai_model');
  }

  function rincianTugas($id){
    $rincianTugas = $this->perizinan_model->rincianTugasbyId($id);

    echo json_encode($rincianTugas);
  }

  function listApprovalTugas($id){
    $this->isLoggedIn();

    $list_approval_tugas = $this->perizinan_model->ListApprovalTugasbyId($id);

    echo json_encode($list_approval_tugas);
  }

  public function simpanapprovaltugas($id_pegawai, $id_tugas, $status){
    $this->isLoggedIn();

    $data = array(
      'tugas_id' => $id_tugas,
      'pegawai_id' => $id_pegawai,
      'status' => $status,
      'datecreated' => DATE('Y-m-d H:i:s')
    );
    
    $id_approval_tugas = $this->perizinan_model->cekApprovalTugasbyPegawai($id_pegawai, $id_tugas)->id_approval_tugas;

    if(is_null($id_approval_tugas)){
      $query = $this->crud_model->input($data, 'tbl_approval_tugas');
    }else{

      $where = array(
        'id_approval_tugas' => $id_approval_tugas
      );

      $data = array(
        'status' => $status
      );

      $query = $this->crud_model->update($where, $data, 'tbl_approval_tugas');
    }
  }

  public function approvalTugas(){
    $this->isLoggedIn();

    $id_pegawai = $this->global ['pegawai_id'];
    $page = $this->uri->segment(1);
    $id_tugas = $this->uri->segment(2);
    $status = $this->uri->segment(3);

    $list_tugas = $this->perizinan_model->getDataTugasbyId($id_tugas);

    $approval = explode(",",$list_tugas->approval);
    
    $role = $this->global ['role'];

    switch ($role){
      case(ROLE_HRGA):
        $approval[0] = $status;
      break;
      case(ROLE_POOL):
        $approval[2] = $status;
      break;
      default:
        $approval[1] = $status;
      break;
    }

    $implodeApproval = implode(",",$approval);

    $data = array(
      'approval' => $implodeApproval
    );


    $where = array(
      'id_tugas' => $id_tugas
    );

    $this->simpanapprovaltugas($id_pegawai, $id_tugas, $status);
    $this->crud_model->update($where, $data, 'tbl_perizinan_tugas');
    $this->set_notifikasi_swal('success','Berhasil','Data tugas Berhasil Diajukan');
    redirect('tugas');
  }

  public function simpanSuratTugas(){
    $this->isLoggedIn();
    $role = $this->global ['role'];
    $pegawai_id = $this->global ['pegawai_id'];
    $penugasan_id = $this->input->post('penugasan_id');
    $tgl_tugas = $this->input->post('tgl_tugas');
    $tempat_tugas = $this->input->post('tempat_tugas');
    $rincian_tugas = $this->input->post('rincian_tugas');

    $data = array(
      'pegawai_id' => $pegawai_id,
      'penugasan_id' => $penugasan_id,
      'tgl_tugas' => $tgl_tugas,
      'tempat_tugas' => $tempat_tugas,
      'rincian_tugas' => $rincian_tugas,
      'approval' => "N,N,N",
      'datecreated' => DATE('Y-m-d H:i:s')
    );

    $query = $this->crud_model->input($data, 'tbl_perizinan_tugas');
    $this->set_notifikasi_swal('success','Berhasil','Surat Tugas Berhasil Diajukan');

    if($role == ROLE_STAFF){
      redirect('perizinan');
    }else{
      redirect('pengajuanTugas');
    }
  }

/*********** ADMIN PANEL *******************/
  public function listtugas(){
    $this->isLoggedIn();

    $this->global['pageTitle'] = 'SMART OSD | Data Cuti Tahunan/Khusus';
    $id = $this->global ['pegawai_id'];
    $role = $this->global ['role'];

    if ($role == ROLE_HRGA || $role == ROLE_POOL){
      $list_data = $this->perizinan_model->getTugas();
    }else{
      $list_data = $this->perizinan_model->getTugasbyApproval($id);
    }

    $data = array(
      'list_tugas' => $list_data,
    );

    $this->loadViews("perizinan/dataTugas", $this->global, $data, NULL);
  }

  public function listPengajuanTugas(){
    $this->isLoggedIn();
    $this->global['pageTitle'] = 'SMART OSD | Data Pengajuan Tugas';
    $id = $this->global ['pegawai_id'];
    $divisi_id = $this->divisi_id;

    $data = array(
      'pegawai' => $this->crud_model->lihatdata('tbl_pegawai'),
      'kendaraan' => $this->crud_model->lihatdata('tbl_kendaraan'),
      'list_tugas' => $this->perizinan_model->getTugasbyPegawai($id)
    );

    $this->loadViews("perizinan/pengajuanTugas", $this->global, $data, NULL);
  }
}