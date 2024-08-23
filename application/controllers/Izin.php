<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Izin extends BaseController
{

  public function __construct()
  {
      parent::__construct();
      $this->load->model('crud_model');
      $this->load->model('Izin_model');
      $this->load->model('pegawai_model');
  }

  public function simpan(){
    $this->isLoggedIn();

    $config['upload_path']          = FCPATH.'assets/bukti_izin/';
    $config['allowed_types']        = 'gif|jpg|png|webp';
  
    $this->load->library('upload', $config);
  
    if ( !$this->upload->do_upload('bukti_izin'))
    {
      $this->set_notifikasi_swal('error','GAGAL !!','Data Gagal Disimpan');
      redirect('perizinan');
    }
    else
    {
    $file = $this->upload->data();
    $bukti_izin = $file['file_name'];

    $pegawai_id = $this->global ['pegawai_id'];
    $tgl_mulai = $this->input->post('tgl_mulai');
    $tgl_akhir = $this->input->post('tgl_akhir');
    $keperluan = $this->input->post('keperluan');
    $pemberi_izin = $this->input->post('pemberi_izin');

    $data = array(
      'pegawai_id' => $pegawai_id,
      'tgl_mulai' => $tgl_mulai,
      'tgl_akhir' => $tgl_akhir,
      'keperluan' => $keperluan,
      'pemberi_izin' => $pemberi_izin,
      'bukti_izin' => $bukti_izin,
      'datecreated' => DATE('Y-m-d H:i:s')
    );

    $query = $this->crud_model->input($data, 'tbl_perizinan_izin');
    $this->set_notifikasi_swal('success','Berhasil','Izin Pribadi Berhasil Diajukan');

    if($role == ROLE_STAFF){
      redirect('perizinan');
    }else{
      redirect('pengajuanIzin');
    }
    }
  }

  function rincian($id){
    $this->isLoggedIn();
    $rincian = $this->Izin_model->rincianbyId($id);

    echo json_encode($rincian);
  }

  function listApprovalIzin($id){
    $this->isLoggedIn();

    $list_approval_izin = $this->Izin_model->ListApprovalbyId($id);

    echo json_encode($list_approval_izin);
  }

  public function simpanapproval($id_pegawai, $id_izin, $status){
    $this->isLoggedIn();

    $data = array(
      'izin_id' => $id_izin,
      'pegawai_id' => $id_pegawai,
      'status' => $status,
      'datecreated' => DATE('Y-m-d H:i:s')
    );
    
    $id_approval = $this->Izin_model->cekApprovalbyPegawai($id_pegawai, $id_izin)->id;

    if(is_null($id_approval)){
      $query = $this->crud_model->input($data, 'tbl_approval_izin');
    }else{

      $where = array(
        'id_approval_izin' => $id_approval
      );

      $data = array(
        'status' => $status,
        'datecreated' => DATE('Y-m-d H:i:s')
      );

      $query = $this->crud_model->update($where, $data, 'tbl_approval_izin');
    }
  }

  public function approvalIzin(){
    $this->isLoggedIn();
    $role = $this->global ['role'];
    $id_pegawai = $this->global ['pegawai_id'];
    $page = $this->uri->segment(1);
    $id_izin = $this->uri->segment(2);
    $status = $this->uri->segment(3);

    $list_izin = $this->Izin_model->getDatabyId($id_izin);

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
      'id_izin' => $id_izin
    );

    $this->simpanapproval($id_pegawai, $id_izin, $status);
    $this->crud_model->update($where, $data, 'tbl_perizinan_izin');
    $this->set_notifikasi_swal('success','Berhasil','Data Izin Berhasil Diajukan');
    redirect('izin');
  }


/*********** ADMIN PANEL *******************/

  public function listIzin(){
    $this->isLoggedIn();

    $this->global['pageTitle'] = 'SMART OSD | Data Izin Pribadi';
    $id = $this->global ['pegawai_id'];
    $role = $this->global ['role'];

    if ($role == ROLE_HRGA){
      $list_data = $this->Izin_model->getData();
    }else{
      $list_data = $this->Izin_model->getDatabyApproval($id);
    }

    $data = array(
      'list_data' => $list_data,
    );

    $this->loadViews("perizinan/dataIzin", $this->global, $data, NULL);
  }

  function detailIzin($id){
    $this->isLoggedIn();
    $data = $this->Izin_model->getDetailbyId($id);

    echo json_encode($data);
  }

  public function listPengajuanIzin(){
    $this->isLoggedIn();
    $this->global['pageTitle'] = 'SMART OSD | Data Pengajuan Izin';
    $id = $this->global ['pegawai_id'];
    $divisi_id = $this->divisi_id;

    $data = array(
      'pegawai' => $this->crud_model->lihatdata('tbl_pegawai'),
      'list_izin' => $this->Izin_model->getDatabyPegawai($id)
    );

    $this->loadViews("perizinan/pengajuanIzin", $this->global, $data, NULL);
  }
}