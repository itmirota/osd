<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Sample extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $name = $this->session->userdata ( 'name' );

      $this->load->model('crud_model');
      $this->load->model('sample_model');
    
      if(isset($name)){
      $this->isLoggedIn();
      }
  }
// Permintaan Sample
  public function dataPermintaan(){
    $this->global['pageTitle'] = 'Permintaan Sample';

    $data = array(
      'list_data' => $this->crud_model->lihatdata('tbl_sample_permintaan'),
    );

    $this->loadViews("sample/dataPermintaan", $this->global, $data, NULL);
  }

  public function savePermintaan(){
    $tgl_permintaan = DATE('Y-m-d');
    $nama_sample = $this->input->post('nama_sample');
    $deskripsi_sample = $this->input->post('deskripsi_sample');
    $kategori_penggunaan = $this->input->post('kategori_penggunaan');
    $kategori_bahan = $this->input->post('kategori_bahan');
    $jumlah_sample = $this->input->post('jumlah_sample');
    $satuan_sample = $this->input->post('satuan_sample');

    $data = array(
      'tgl_permintaan' => $tgl_permintaan,
      'nama_sample' => $nama_sample,
      'deskripsi_sample' => $deskripsi_sample,
      'kategori_penggunaan' => $kategori_penggunaan,
      'kategori_bahan' => $kategori_bahan,
      'jumlah_sample' => $jumlah_sample,
      'satuan_sample' => $satuan_sample,
    );

    $this->crud_model->input($data,'tbl_sample_permintaan');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('permintaan-sample');
  }

  public function updateStatusPermintaan(){
    $this->isLoggedIn();

    $id = $this->uri->segment(2);
    $status = $this->uri->segment(3);

    $where = array(
        'id_sample_permintaan' => $id
    );

    $data = array(
        'status_permintaan' => $status
    );

    $res = $this->crud_model->update($where, $data,'tbl_sample_permintaan');
    $this->set_notifikasi_swal('success','Berhasil','Status Berhasil Diubah');
    redirect('permintaan-sample');
  }
// Permintaan Sample

// Pengujian Sample
  public function saveVendor(){
    $config['upload_path']          = './assets/dokumen_sample';
    $config['allowed_types']        = 'gif|jpg|png|PNG|jpeg|pdf';

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('dokumen')) {
      $this->set_notifikasi_swal('error','Gagal','Dokumen tidak boleh kosong');
      redirect('sample-masuk');

    } else {
      $file = $this->upload->data();

      $permintaan_sample_id = $this->input->post('id_sample_permintaan');
      $tgl_masuk = $this->input->post('tgl_masuk');
      $nama_supplier = $this->input->post('nama_supplier');
      $harga = $this->input->post('harga');
      $dokumen = $file['file_name'];

      $data = array(
        'permintaan_sample_id' => $permintaan_sample_id,
        'tgl_masuk' => $tgl_masuk,
        'nama_supplier' => $nama_supplier,
        'harga' => $harga,
        'dokumen_sample' => $dokumen,
      );
    }

    $res = $this->crud_model->input($data,'tbl_sample_vendor');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('sample-masuk');
  }

  public function dataUji(){
    $this->global['pageTitle'] = 'Registrasi Sample Masuk';
    $id = $this->uri->segment(2);

    $data = array(
      'data_sample' => $this->crud_model->getdataRowbyWhere('*', array('id_sample_permintaan' => $id), 'tbl_sample_permintaan'),
      'list_data' => $this->sample_model->getDatabyWhere('permintaan_sample_id ='.$id),
    );

    $this->loadViews("sample/data", $this->global, $data, NULL);
  }

  public function getDokumenSample($id){
    $dokumen = $this->crud_model->getdataRowbyWhere('dokumen_sample', 'id_sample_vendor ='.$id ,'tbl_sample_vendor');

    echo json_encode($dokumen);
  }

  public function getHasilCek($id){
    $hasil_cek = $this->crud_model->getdataRowbyWhere('tgl_cek, hasil_cek, keterangan, dokumen_cek', 'id_sample_vendor ='.$id ,'tbl_sample_vendor');

    echo json_encode($hasil_cek);
  }

  public function getHasilUji($id){
    $hasil_uji = $this->crud_model->getdataRowbyWhere('hasil_uji, tgl_selesai_uji, kesimpulan', 'id_sample_vendor ='.$id ,'tbl_sample_vendor');

    echo json_encode($hasil_uji);
  }


  public function updateStatus(){
    $this->isLoggedIn();

    $id = $this->uri->segment(2);
    $status = $this->uri->segment(3);

    $where = array(
        'id_sample_vendor' => $id
    );

    $data = array(
        'status' => $status
    );

    $res = $this->crud_model->update($where, $data,'tbl_sample_vendor');
    $this->set_notifikasi_swal('success','Berhasil','Status Berhasil Diubah');
    redirect('sample-masuk');
  }

  public function updateHasilCek(){
    $config['upload_path']          = './assets/dokumen_sample';
    $config['allowed_types']        = 'gif|jpg|png|PNG|jpeg|pdf';

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('dokumen_cek')) {
      $this->set_notifikasi_swal('error','Gagal','Dokumen tidak boleh kosong');
      redirect('sample-masuk');
    } else {
      $file = $this->upload->data();

      $id_sample_vendor = $this->input->post('id_sample_vendor');
      $tgl_cek = $this->input->post('tgl_cek');
      $hasil_cek = $this->input->post('hasil_cek');
      $keterangan = $this->input->post('keterangan');
      $dokumen = $file['file_name'];

      $data = array(
        'tgl_cek' => $tgl_cek,
        'hasil_cek' => $hasil_cek,
        'keterangan' => $keterangan,
        'dokumen_cek' => $dokumen,
      );
    }

    $res = $this->crud_model->update('id_sample_vendor ='.$id_sample_vendor, $data,'tbl_sample_vendor');
    $this->set_notifikasi_swal('success','Berhasil','Status Berhasil Diubah');
    redirect('sample-masuk');
  }

  public function updateHasiluji(){
    $id_sample_vendor = $this->input->post('id_sample_vendor');
    $tgl_selesai_uji = $this->input->post('tgl_selesai_uji');
    $hasil_uji = $this->input->post('hasil_uji');
    $kesimpulan = $this->input->post('kesimpulan');

    $data = array(
      'tgl_selesai_uji' => $tgl_selesai_uji,
      'hasil_uji' => $hasil_uji,
      'kesimpulan' => $kesimpulan
    );

    $res = $this->crud_model->update('id_sample_vendor ='.$id_sample_vendor, $data,'tbl_sample_vendor');
    $this->set_notifikasi_swal('success','Berhasil','Status Berhasil Diubah');
    redirect('sample-masuk');
  }

  public function laporan(){
    $this->global['pageTitle'] = 'Laporan Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Absensi Manual Karyawan ';

    $data['list_data'] = $this->crud_model->lihatdata('tbl_sample_vendor');

    $this->loadViews("sample/laporan", $this->global, $data, NULL);
  }
// Pengujian Sample
}