<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Perizinan extends BaseController
{
  public function __construct()
  {
      parent::__construct();
      $this->load->model('crud_model');
      $this->load->model('perizinan_model');
      $this->load->model('izinHarian_model');
      $this->load->model('izin_model');
      $this->load->model('pegawai_model');
      $this->isLoggedIn();
  }

  public function index(){
    $this->global['pageTitle'] = 'SMART OSD | Perizinan Mirota KSM';
    $this->global['pageHeader'] = 'Perizinan Manual Karyawan ';

    $id_pegawai = $this->global ['pegawai_id'];
    $divisi_id = $this->divisi_id;

    $data = array(
      'totalCuti' => $this->perizinan_model->HitungTotalCuti($id_pegawai),
      'kendaraan' => $this->crud_model->lihatdata('tbl_kendaraan'),
      'pegawai' => $this->crud_model->lihatdata('tbl_pegawai'),
      'sisaCuti' => $this->perizinan_model->cekKuotaCuti($id_pegawai),
      'list_cuti' => $this->perizinan_model->getDatabyPegawai($id_pegawai),
      'list_tugas' => $this->perizinan_model->getTugasbyPegawai($id_pegawai),
      'list_izinHarian' => $this->izinHarian_model->getDatabyPegawai($id_pegawai),
      'list_izin' => $this->izin_model->getDatabyPegawai($id_pegawai),
      'pengganti' => $this->pegawai_model->getPegawaibyDivisi($divisi_id, $id_pegawai),
      'approval_pengganti' => $this->perizinan_model->getDatabyPengganti($id_pegawai),
      'kuota_cuti' => $this->perizinan_model->cekKuotaCuti($id_pegawai)->kuota_cuti
    );

    $this->loadViewsUser("perizinan/menu", $this->global, $data, NULL);
  }

  public function simpancuti(){
    $id_pegawai = $this->global ['pegawai_id'];
    $role = $this->global ['role'];

    $cekKuotaCuti = $this->perizinan_model->cekKuotaCuti($id_pegawai);
    $kuota = $cekKuotaCuti->kuota_cuti;

    $config['upload_path']          = FCPATH.'assets/bukti_cuti/';
    $config['allowed_types']        = 'gif|jpg|png|webp|pdf';
  
    $this->load->library('upload', $config);
  
    if ( !$this->upload->do_upload('bukti_cuti'))
    {
      $jenis_cuti = $this->input->post('jenis_cuti');
      $tgl_mulai = $this->input->post('tgl_mulai');
      $tgl_akhir = $this->input->post('tgl_akhir');
      $keperluan = $this->input->post('keperluan');
      $pengganti = $this->input->post('pengganti');

      $data = array(
        'pegawai_id' => $id_pegawai,
        'jenis_cuti' => $jenis_cuti,
        'tgl_mulai' => $tgl_mulai,
        'tgl_akhir' => $tgl_akhir,
        'keperluan' => $keperluan,
        'pengganti' => $pengganti,
        'datecreated' => DATE('Y-m-d H:i:s')
      );
    }
    else
    {
      $file = $this->upload->data();
      $bukti_cuti = $file['file_name'];
      $jenis_cuti = $this->input->post('jenis_cuti');
      $detail_cuti = $this->input->post('detail_cuti');
      $tgl_mulai = $this->input->post('tgl_mulai');
      $tgl_akhir = $this->input->post('tgl_akhir');
      $keperluan = $this->input->post('keperluan');
      $pengganti = $this->input->post('pengganti');


      $data = array(
        'pegawai_id' => $id_pegawai,
        'jenis_cuti' => $jenis_cuti,
        'detail_cuti' => $detail_cuti,
        'tgl_mulai' => $tgl_mulai,
        'tgl_akhir' => $tgl_akhir,
        'keperluan' => $keperluan,
        'pengganti' => $pengganti,
        'bukti_cuti' => $bukti_cuti,
        'datecreated' => DATE('Y-m-d H:i:s')
      );
    }

    $d1 = date_create($tgl_mulai);
    $d2 = date_create($tgl_akhir);
    $interval = date_diff($d1, $d2);
    $durasi = $interval->days;

    if($durasi == 0){
      $durasi++;
    }

    switch ($jenis_cuti) {
      case 'tahunan':
        if($kuota != 0){
          if($durasi <= 7){
            $query = $this->crud_model->input($data, 'tbl_perizinan_cuti');
            $this->kurangikuota($id_pegawai, $durasi);

            $this->set_notifikasi_swal('success','Berhasil','Data Cuti Berhasil Diajukan');
          }else{
            $this->set_notifikasi_swal('error','Gagal','Pengajuan cuti tidak boleh lebih dari 7 hari');
          }
        }else{
          $this->set_notifikasi_swal('error','Kuota Cuti Habis','anda tidak bisa mengajukan cuti karena kuota cuti anda sudah habis');
        }
      break;
      
      default:
      $query = $this->crud_model->input($data, 'tbl_perizinan_cuti');

      if($query){
      $this->set_notifikasi_swal('success','Berhasil','Data Cuti Berhasil Diajukan');
      }else{
      $this->set_notifikasi_swal('danger','Gagal','Data Cuti Gagal Diajukan');
      }
      break;
    }

    redirect('perizinan');
  }

  public function kurangikuota($id, $cuti){
    $cekKuotaCuti = $this->perizinan_model->cekKuotaCuti($id);
    $kuota = $cekKuotaCuti->kuota_cuti;
    $sisa = $cekKuotaCuti->sisa_cuti;

    if($sisa != 0){
      $data = array(
        'sisa_cuti' => $sisa - $cuti,
      );
    }else{
      $data = array(
        'kuota_cuti' => $kuota - $cuti,
      );
    }

    $where = array(
      'id_pegawai' => $id,
    );

    $query = $this->crud_model->update($where, $data, 'tbl_pegawai');
  }

  public function simpanapproval($id_pegawai, $id_cuti, $status){
    $data = array(
      'cuti_id' => $id_cuti,
      'pegawai_id' => $id_pegawai,
      'status' => $status,
      'datecreated' => DATE('Y-m-d H:i:s')
    );
    
    $id_approval = $this->perizinan_model->cekApprovalbyPegawai($id_pegawai, $id_cuti)->id_approval;

    if(is_null($id_approval)){
      $query = $this->crud_model->input($data, 'tbl_approval_cuti');
    }else{

      $where = array(
        'id_approval' => $id_approval
      );

      $data = array(
        'status' => $status
      );

      $query = $this->crud_model->update($where, $data, 'tbl_approval_cuti');
    }
  }

  public function approvalCuti(){
    $role = $this->global ['role'];
    $id_pegawai = $this->global ['pegawai_id'];
    $page = $this->uri->segment(1);
    $id_cuti = $this->uri->segment(2);
    $status = $this->uri->segment(3);

    $list_cuti = $this->perizinan_model->getDatabyId($id_cuti);

    $approval = explode(",",$list_cuti->approval);
    
    $id_jabatan = $this->pegawai_model->getPegawaibyId($id_pegawai)->jabatan_id;


    switch ($id_jabatan){
      case(5):
        $approval[0] = $status;
      break;
      case(4):
        $approval[1] = $status;
      break;
      default:
        $approval[2] = $status;
      break;
    }

    $implodeApproval = implode(",",$approval);

    $data = array(
      'approval' => $implodeApproval
    );

    $where = array(
      'id_cuti' => $id_cuti
    );

    if($status == "T"){
      $id = $list_cuti->pegawai_id;
      $durasi = $list_cuti->selisih;
      $this->tambahKuota($id, $durasi);
    }

    $this->simpanapproval($id_pegawai, $id_cuti, $status);
    $this->crud_model->update($where, $data, 'tbl_perizinan_cuti');
    $this->set_notifikasi_swal('success','Berhasil','Data Cuti Berhasil Disetujui');
    

    if($page == 'approvalPengganti'){
      redirect('perizinan');
    }else{
      redirect('cuti');
    }
  }

  public function tambahKuota($id, $durasi){
    $pegawai = $this->pegawai_model->getPegawaibyId($id);
    $sisacuti = $pegawai->kuota_cuti;

    $cuti = $sisacuti + $durasi;

    $where = array(
      'id_pegawai' => $id
    );

    $data = array(
      'kuota_cuti' => $cuti
    );

    $this->crud_model->update($where, $data, 'tbl_pegawai');
  }

  function listApproval($id){
    $list_approval = $this->perizinan_model->ListApprovalbyId($id);

    echo json_encode($list_approval);
  }
  /*********** ADMIN PANEL *******************/

  public function listcuti(){
    $this->global['pageTitle'] = 'SMART OSD | Data Cuti Tahunan/Khusus';
    $id = $this->global ['pegawai_id'];
    $role = $this->global ['role'];

    if ($role == ROLE_HRGA || $role == ROLE_POOL){
      $list_data = $this->perizinan_model->getData();
    }else{
      $list_data = $this->perizinan_model->getDatabyApproval($id);
    }

    $data = array(
      'list_cuti' =>  $list_data
    );

    $this->loadViews("perizinan/dataCuti", $this->global, $data, NULL);
  }

  function detailCuti($id){
    $this->isLoggedIn();
    $data = $this->perizinan_model->getDetailbyId($id);

    echo json_encode($data);
  }

  public function listPengajuanCuti(){
    $this->global['pageTitle'] = 'SMART OSD | Data Pengajuan Cuti Tahunan/Khusus';
    $id = $this->global ['pegawai_id'];
    $divisi_id = $this->divisi_id;

    $data = array(
      'pengganti' => $this->pegawai_model->getPegawaibyDivisi($divisi_id, $id),
      'list_cuti' => $this->perizinan_model->getDatabyPegawai($id),
      'kuota_cuti' => $this->perizinan_model->cekKuotaCuti($id)->kuota_cuti
    );

    $this->loadViews("perizinan/pengajuanCuti", $this->global, $data, NULL);
  }

  public function ApprovalPengganti(){
    $this->global['pageTitle'] = 'SMART OSD | Approval Pengganti';
    $id = $this->global ['pegawai_id'];

    $data = array(
      'approval_pengganti' => $this->perizinan_model->getDatabyPengganti($id)
    );

    $this->loadViews("perizinan/approvalPengganti", $this->global, $data, NULL);
  }

}