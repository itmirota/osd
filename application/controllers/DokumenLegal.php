<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */


class DokumenLegal extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $name = $this->session->userdata ( 'name' );

      $this->load->model('crud_model');
      $this->load->model('master_model');
    
      if(isset($name)){
      $this->isLoggedIn();
      }
  }

  public function index(){
    $this->global['pageTitle'] = 'Dokumen Legal';

    $data = array(
    'list_data' => $this->crud_model->lihatdata('tbl_dokumenLegal')
    );

    $this->loadViews("dokumenLegal/data", $this->global, $data, NULL);
  }

  public function save(){
    $config['upload_path']          = './assets/dokumen_legal';
    $config['allowed_types']        = 'gif|jpg|png|PNG|jpeg|pdf';

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('dokumen')) {
      $this->set_notifikasi_swal('error','Gagal','Dokumen gagal disimpan');
      redirect('dokumen-legal');
    } else {
    $nama_dokumen = $this->input->post('nama_dokumen');
    $tgl_input = DATE('Y-m-d');
    $file = $this->upload->data();

    $data = array(
      'nama_dokumen' => $nama_dokumen,
      'tgl_input' => $tgl_input,
      'file_dokumen' => $file['file_name']
    );

    $res = $this->crud_model->input($data,'tbl_dokumenLegal');
    $this->set_notifikasi_swal('success','Berhasil','Dokumen berhasil disimpan');
    redirect('dokumen-legal');
  }}

  public function getDokumen($id){
    $dokumen = $this->crud_model->getdataRowbyWhere('file_dokumen', 'id_dokumen ='.$id ,'tbl_dokumenLegal');

    echo json_encode($dokumen);
  }

  public function hapus($id){

    $where = array(
    'id_dokumen' => $id
    );

    $cek = $this->crud_model->getdataRowbyWhere('file_dokumen', 'id_dokumen ='.$id ,'tbl_dokumenLegal');
    unlink( FCPATH.'assets/dokumen_legal/'.$cek->file_dokumen);
    $this->crud_model->delete($where, 'tbl_dokumenLegal');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('dokumen-legal');
  }
}