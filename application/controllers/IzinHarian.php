<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class IzinHarian extends BaseController
{

  public function __construct()
  {
      parent::__construct();
      $this->load->model('crud_model');
      $this->load->model('izinHarian_model');
      $this->load->model('pegawai_model');
  }

  public function simpan(){
    $this->isLoggedIn();
    $role = $this->global ['role'];
    $pegawai_id = $this->global ['pegawai_id'];
    $tgl_izin = $this->input->post('tgl_izin');
    $waktu_mulai = $this->input->post('waktu_mulai');
    $waktu_akhir = $this->input->post('waktu_akhir');
    $keperluan = $this->input->post('keperluan');

    $data = array(
      'pegawai_id' => $pegawai_id,
      'tgl_izin' => $tgl_izin,
      'waktu_mulai' => $waktu_mulai,
      'waktu_akhir' => $waktu_akhir,
      'keperluan' => $keperluan,
    );

    $query = $this->crud_model->input($data, 'tbl_perizinan_harian');
    $this->set_notifikasi_swal('success','Berhasil','Izin Pribadi Berhasil Diajukan');

    if($role == ROLE_STAFF){
      redirect('perizinan');
    }else{
      redirect('pengajuanIzinHarian');
    }
  }

  function rincian($id){
    $this->isLoggedIn();
    $rincianTugas = $this->izinHarian_model->rincianbyId($id);

    echo json_encode($rincianTugas);
  }

  function listApprovalIzin($id){
    $this->isLoggedIn();

    $list_approval_izin = $this->izinHarian_model->ListApprovalbyId($id);

    echo json_encode($list_approval_izin);
  }

  public function simpanapproval($id_pegawai, $id_perizinan_harian, $status){
    $this->isLoggedIn();

    $data = array(
      'perizinan_harian_id' => $id_perizinan_harian,
      'pegawai_id' => $id_pegawai,
      'status' => $status,
      'datecreated' => DATE('Y-m-d H:i:s')
    );
    
    $id_approval = $this->izinHarian_model->cekApprovalbyPegawai($id_pegawai, $id_perizinan_harian)->id_approval_izinharian;

    if(is_null($id_approval)){
      $query = $this->crud_model->input($data, 'tbl_approval_izinharian');
    }else{

      $where = array(
        'id_approval_izinharian' => $id_approval
      );

      $data = array(
        'status' => $status,
        'datecreated' => DATE('Y-m-d H:i:s')
      );

      $query = $this->crud_model->update($where, $data, 'tbl_approval_izinharian');
    }
  }

  public function approvalIzinHarian(){
    $this->isLoggedIn();

    $id_pegawai = $this->global ['pegawai_id'];
    $page = $this->uri->segment(1);
    $id_perizinan_harian = $this->uri->segment(2);
    $status = $this->uri->segment(3);

    $list_izin = $this->izinHarian_model->getDatabyId($id_perizinan_harian);

    $approval = explode(",",$list_izin->approval);
    
    $role = $this->global ['role'];

    switch ($role){
      case(ROLE_HRGA):
        $approval[1] = $status;
      break;
      case(ROLE_MANAGER):
        $approval[2] = $status;
      break;
      default:
        $approval[0] = $status;
      break;
    }

    $implodeApproval = implode(",",$approval);

    $data = array(
      'approval' => $implodeApproval
    );


    $where = array(
      'id_perizinan_harian' => $id_perizinan_harian
    );

    $this->simpanapproval($id_pegawai, $id_perizinan_harian, $status);
    $this->crud_model->update($where, $data, 'tbl_perizinan_harian');
    $this->set_notifikasi_swal('success','Berhasil','Data Izin Berhasil Diajukan');
    redirect('izin-harian');
  }


/*********** ADMIN PANEL *******************/

  public function listIzinHarian(){
    $this->isLoggedIn();

    $this->global['pageTitle'] = 'SMART OSD | Data Izin Harian';
    $id = $this->global ['pegawai_id'];
    $role = $this->global ['role'];

    if ($role == ROLE_HRGA){
      $list_data = $this->izinHarian_model->getData();
    }else{
      $list_data = $this->izinHarian_model->getDatabyApproval($id);
    }

    $data = array(
      'list_data' => $list_data,
    );

    $this->loadViews("perizinan/dataIzinHarian", $this->global, $data, NULL);
  }

  public function listPengajuanIzinHarian(){
    $this->isLoggedIn();
    $this->global['pageTitle'] = 'SMART OSD | Data Pengajuan Tugas';
    $id = $this->global ['pegawai_id'];
    $divisi_id = $this->divisi_id;

    $data = array(
      'list_izinHarian' => $this->izinHarian_model->getDatabyPegawai($id),
    );

    $this->loadViews("perizinan/pengajuanIzinHarian", $this->global, $data, NULL);
  }
}