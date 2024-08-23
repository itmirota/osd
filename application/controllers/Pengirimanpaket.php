<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Pengirimanpaket extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
    parent::__construct();
    $this->load->model('crud_model');
    $this->load->model('pengirimanPaket_model');
  }

  public function index(){
    $this->isLoggedIn();

    $this->global['pageTitle'] = 'Pengiriman Paket';
    $this->global['pageHeader'] = 'OSD | Pengiriman paket';
    $id = $this->global ['pegawai_id'];
    $role = $this->global ['role'];

    if ($role == ROLE_HRGA){
      $list_data = $this->pengirimanPaket_model->getData();
    }else{
      $list_data = $this->pengirimanPaket_model->getDatabyId($id);
    }

    $data = array(
      'total_saldo' => $this->crud_model->GetRowOrderby('id_saldo','DESC','tbl_satpam_saldo')->saldo,
      'sisa_saldo' => $this->crud_model->getDataTotal('sisa_saldo','tbl_satpam_saldo'),
      'list_data' => $list_data,
    );

    $this->loadViews("pengirimanpaket/data", $this->global, $data, NULL);
  }

  public function save(){
    $this->isLoggedIn();

    $pengirim_id = $this->pegawai_id;
    $tgl_kirim = $this->input->post('tgl_kirim');
    $deskripsi_paket = $this->input->post('deskripsi_paket');
    $nama_penerima = $this->input->post('nama_penerima');
    $alamat_penerima = $this->input->post('alamat_penerima');
    $ekspedisi = $this->input->post('ekspedisi');

    $data = array(
      'pengirim_id' => $pengirim_id,
      'tgl_kirim' => $tgl_kirim,
      'deskripsi_paket' => $deskripsi_paket,
      'nama_penerima' => $nama_penerima,
      'alamat_penerima' => $alamat_penerima,
      'ekspedisi' => $ekspedisi,
    );

    $this->crud_model->input($data,'tbl_pengirimanpaket');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('pengirimanpaket');
  }
}