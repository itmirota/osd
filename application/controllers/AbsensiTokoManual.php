<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class AbsensiTokoManual extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $name = $this->session->userdata ( 'name' );

      $this->load->model('crud_model');
      $this->load->model('absensi_model');
    
      if(isset($name)){
      $this->isLoggedIn();
      }
  }

  public function index(){
    $this->global['pageTitle'] = 'Absen Manual Toko';
    $id = $this->global ['pegawai_id'];
    $data = array(
      'list_data' => $this->absensi_model->showDataAbsenTokoByWhere(['pegawai_id' => $id]),
    );

    $this->loadViewsUser("absensitokomanual/data", $this->global, $data, NULL);
  }

  public function laporan(){
    $periode = $this->input->post('periode');
    $datenow = DATE('Y-m');
    $this->global['pageTitle'] = 'Laporan Absen Manual Toko';

    if (isset($periode)){
      $periodeAkhir = $periode.'-20';
      $date = date_create($periode);
    }else{
      $periodeAkhir = $datenow.'-20';
      $date = date_create($datenow);
    }

    $bulan = date_format($date,'m')-1;
    $tahun = date_format($date,'Y');

    $periodeAwal = $tahun.'-'.$bulan.'-21';

    $where = array(
      'DATE(datecreated) >=' => $periodeAwal,
      'DATE(datecreated) <=' => $periodeAkhir,
    );

    $data = array(
      'periodeAwal' => $periodeAwal,
      'periodeAkhir' => $periodeAkhir,
      'list_data' => $this->absensi_model->ReportAbsenToko($where),
    );

    $this->loadViews("absensitokomanual/laporan", $this->global, $data, NULL);
  }

  public function save(){
    $config['upload_path']          = './assets/dokumen_absen_toko';
    $config['allowed_types']        = 'gif|jpg|png|PNG|jpeg|pdf';

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('dokumen')) {
      $this->set_notifikasi_swal('error','Gagal','Dokumen tidak boleh kosong / melebihi 2mb');
      redirect('absensi-toko');
    } else {
      $file = $this->upload->data();

      $pegawai_id = $this->global ['pegawai_id'];
      $datecreated = DATE('Y-m-d H:i:s');
      $dokumen = $file['file_name'];

      $data = array(
        'pegawai_id' => $pegawai_id,
        'bukti_absensi_toko' => $dokumen,
        'datecreated' => $datecreated,
      );
    }

    $res = $this->crud_model->input($data,'tbl_absen_toko');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('absensi-toko');
  }
}