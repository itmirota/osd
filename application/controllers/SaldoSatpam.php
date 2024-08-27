<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class SaldoSatpam extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $name = $this->session->userdata ( 'name' );

      $this->load->model('crud_model');
    
      if(isset($name)){
      $this->isLoggedIn();
      }
  }

// SALDO SATPAM
  public function saveSaldo(){
    $datecreated = $this->input->post('datecreated');
    $saldo = $this->input->post('saldo');

    $data = array(
      'datecreated' => $datecreated,
      'saldo' => $saldo,
      'sisa_saldo' => $saldo,
    );

    $this->crud_model->input($data, 'tbl_satpam_saldo');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('report-saldo');
  }

  public function kurangiSaldo($biaya){
    $id = $this->crud_model->GetRowOrderby('id_saldo','DESC','tbl_satpam_saldo')->id_saldo;
    $saldo = $this->crud_model->GetRowOrderby('id_saldo','DESC','tbl_satpam_saldo')->saldo;

    $saldo = $saldo - $biaya;
    $this->crud_model->update('id_saldo ='.$id, array('saldo' => $saldo),'tbl_satpam_saldo');
  }
// END SALDO SATPAM

// ADMIN PANEL
  public function dataSaldo(){
    $this->global['pageTitle'] = 'Saldo';


    $data = array(
      'list_data' => $this->crud_model->lihatdata('tbl_satpam_saldo'),
    );

    $this->loadViews("satpam/dataSaldo", $this->global, $data, NULL);
  }
// END ADMIN PANEL

}