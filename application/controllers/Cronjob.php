<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Cronjob extends BaseController
{

  public function __construct()
  {
      parent::__construct();
      $this->load->model('crud_model');
      $this->load->model('pegawai_model');
      $this->load->library('form_validation');
  }

  function sisaCutiTahunLalu(){

    $pegawaiTetap = $this->pegawai_model->showDataPegawaiTetap();

    foreach($pegawaiTetap as $pt){
      $id_pegawai = $pt->id_pegawai;
      $kuota_cuti = $pt->kuota_cuti;

      $where = array(
        'id_pegawai' => $id_pegawai
      );

      $data = array(
        'sisa_cuti' => $kuota_cuti,
        'kuota_cuti' => 12
      );
  
      $this->crud_model->update($where, $data, 'tbl_egawai');
    }
  }

  function resetSisaCuti(){

    $data = array(
      'sisa_cuti' => 0
    );

    $this->crud_model->update('sisa_cuti != 0', $data, 'tbl_pegawai');
  }

}