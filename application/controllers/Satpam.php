<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Satpam extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $name = $this->session->userdata ( 'name' );

      $this->load->model('user_model');
      $this->load->model('crud_model');
      $this->load->model('perizinan_model');
      $this->load->model('izinHarian_model');
      $this->load->model('pengirimanPaket_model');
    
      if(isset($name)){
      $this->isLoggedIn();
      }
  }

  public function index(){
    $this->global['pageTitle'] = 'Satpam Area';
    $this->global['pageHeader'] = 'OSD | Satpam Area';

    $this->loadViewsUser("satpam/dashboard", $this->global, NULL);
  }

  public function perizinan(){
    $this->global['pageTitle'] = 'SMART OSD | Data Perizinan';

    $data = array(
      'list_tugas' => $this->perizinan_model->getTugasWhere('tgl_kembali ='.NULL),
      'list_izinHarian' => $this->izinHarian_model->getDataWhere('waktu_akhir ='.NULL)
    );

    $this->loadViewsUser("satpam/perizinan", $this->global, $data, NULL);
  }

  public function saveKembaliTugas($id){

    $data = array(
      "tgl_kembali" => DATE("Y-m-d H:i:s")
    );

    $this->crud_model->update('id_tugas ='.$id, $data, 'tbl_perizinan_tugas');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('satpam/perizinan');
  }

  public function saveKembaliIzin($id){

    $data = array(
      "waktu_akhir" => DATE("H:i:s")
    );

    $this->crud_model->update('id_perizinan_harian ='.$id, $data, 'tbl_perizinan_harian');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('satpam/perizinan');
  }

  public function pinjamKendaraan(){
    $id_tugas = $this->input->post('id_tugas');
    $pegawai_id = $this->input->post('pegawai_id');
    $kendaraan_id = $this->input->post('kendaraan_id');
    $jenis_kendaraan = $this->input->post('jenis_kendaraan');
    $tgl_pinjam = DATE("Y-m-d H:i:s");


    if($jenis_kendaraan == "0"){
      $kendaraan_id = $jenis_kendaraan;
    }

    $data = array(
      "pegawai_id" => $pegawai_id,
      "kendaraan_id" => $kendaraan_id,
      "tgl_pinjam" => $tgl_pinjam
    );

    $this->crud_model->input($data,'tbl_pinjam_kendaraan');
    $this->crud_model->update('id_tugas ='.$id_tugas, array('kendaraan_id' => $kendaraan_id), 'tbl_perizinan_tugas');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('satpam/perizinan');
  }

  public function pengirimanpaket(){
    $this->global['pageTitle'] = 'SMART OSD | Data Pengiriman Paket';

    $data = array(
      'total_saldo' => $this->crud_model->GetRowOrderby('id_saldo','DESC','tbl_satpam_saldo')->saldo,
      'sisa_saldo' => $this->crud_model->getDataTotal('sisa_saldo','tbl_satpam_saldo'),
      'list_data' => $this->pengirimanPaket_model->getData(),
    );

    $this->loadViewsUser("satpam/pengirimanpaket", $this->global, $data, NULL);
  }

  public function updatediterima(){
    $id_paket = $this->uri->segment(3);
    $tgl_diterima = DATE('Y-m-d H:i:s');

    $data = $this->crud_model->update('id_paket ='.$id_paket, array('tgl_diterima' => DATE('Y-m-d H:i:s')),'tbl_pengirimanpaket');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('satpam/pengirimanpaket');
  }

  public function updatePengiriman(){
    $id_paket = $this->input->post('id_paket');
    $no_resi = $this->input->post('no_resi');
    $biaya_kirim = $this->input->post('biaya_kirim');

    $this->kurangiSaldo($biaya_kirim);

    $this->crud_model->update('id_paket ='.$id_paket, array('no_resi' => $no_resi, 'biaya_kirim' => $biaya_kirim),'tbl_pengirimanpaket');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('satpam/pengirimanpaket');
  }

  public function kurangiSaldo($biaya){
    $id = $this->crud_model->GetRowOrderby('id_saldo','DESC','tbl_satpam_saldo')->id_saldo;
    $saldo = $this->crud_model->GetRowOrderby('id_saldo','DESC','tbl_satpam_saldo')->sisa_saldo;

    $saldo = $saldo - $biaya;
    $this->crud_model->update('id_saldo ='.$id, array('sisa_saldo' => $saldo),'tbl_satpam_saldo');
  }
}