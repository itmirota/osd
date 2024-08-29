<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class TransaksiSatpam extends BaseController
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
// PEMBELIAN SATPAM
  public function index(){
    $this->global['pageTitle'] = 'SMART OSD | Data Pembelian Galon';

    $data = array(
      'total_saldo' => $this->crud_model->GetRowOrderby('id_saldo','DESC','tbl_satpam_saldo')->saldo,
      'sisa_saldo' => $this->crud_model->getDataTotal('sisa_saldo','tbl_satpam_saldo'),
      'list_data' => $this->crud_model->lihatdata('tbl_satpam_pembelian'),
    );

    $this->loadViewsUser("satpam/pembelian", $this->global, $data, NULL);
  }
  
  public function kurangiSaldo($biaya){
    $id = $this->crud_model->GetRowOrderby('id_saldo','DESC','tbl_satpam_saldo')->id_saldo;
    $saldo = $this->crud_model->GetRowOrderby('id_saldo','DESC','tbl_satpam_saldo')->sisa_saldo;

    $saldo = $saldo - $biaya;
    $this->crud_model->update('id_saldo ='.$id, array('sisa_saldo' => $saldo),'tbl_satpam_saldo');
  }

  public function savePembelian(){
    $jenis = 'GALON';
    $jumlah = $this->input->post('jumlah');
    $harga = $this->input->post('harga');
    $tgl_pembelian = $this->input->post('tgl_pembelian');

    $data = array(
      'jenis' => $jenis,
      'jumlah' => $jumlah,
      'harga' => $harga,
      'tgl_pembelian' => $tgl_pembelian,
    );

    $this->kurangiSaldo($harga);

    $this->crud_model->input($data, 'tbl_satpam_pembelian');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('TransaksiSatpam');
  }
// END PEMBELIAN SATPAM

// ADMIN PANEL
  public function report(){
    $this->global['pageTitle'] = 'SMART OSD | Data Pembelian Galon';

    $data = array(
      'total_saldo' => $this->crud_model->GetRowOrderby('id_saldo','DESC','tbl_satpam_saldo')->saldo,
      'sisa_saldo' => $this->crud_model->getDataTotal('sisa_saldo','tbl_satpam_saldo'),
      'list_data' => $this->crud_model->lihatdata('tbl_satpam_pembelian'),
    );

    $this->loadViews("satpam/pembelian", $this->global, $data, NULL);
  }

  public function updatePembelian(){
    $id = $this->input->post('id');
    $jenis = 'GALON';
    $jumlah = $this->input->post('jumlah');
    $harga = $this->input->post('harga');
    $tgl_pembelian = $this->input->post('tgl_pembelian');

    $data = array(
      'jenis' => $jenis,
      'jumlah' => $jumlah,
      'harga' => $harga,
      'tgl_pembelian' => $tgl_pembelian,
    );

    $this->crud_model->update(array('id_pembelian' => $id),$data, 'tbl_satpam_pembelian');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('TransaksiSatpam');
  }

  public function detailPembelian(){
    $data = $this->crud_model->getdataRow('tbl_satpam_pembelian');

    echo json_encode($data);
  }
// END ADMIN PANEL

}