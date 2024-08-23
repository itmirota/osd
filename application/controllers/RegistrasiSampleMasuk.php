<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class RegistrasiSampleMasuk extends BaseController
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

  public function listdata(){
    $this->global['pageTitle'] = 'Registrasi Sample Masuk';

    $data = array(
      'list_data' => $this->crud_model->lihatdata('tbl_bahan_sample'),
    );

    $this->loadViews("registrasiSampleMasuk/data", $this->global, $data, NULL);
  }

  public function getDokumenSample($id){
    $dokumen = $this->crud_model->getdataRowbyWhere('dokumen_sample', 'id_bahan_sample ='.$id ,'tbl_bahan_sample');

    echo json_encode($dokumen);
  }

  public function getHasilCek($id){
    $hasil_cek = $this->crud_model->getdataRowbyWhere('tgl_cek, hasil_cek, keterangan, dokumen_cek', 'id_bahan_sample ='.$id ,'tbl_bahan_sample');

    echo json_encode($hasil_cek);
  }

  public function getHasilUji($id){
    $hasil_uji = $this->crud_model->getdataRowbyWhere('hasil_uji, tgl_selesai_uji, kesimpulan', 'id_bahan_sample ='.$id ,'tbl_bahan_sample');

    echo json_encode($hasil_uji);
  }

  public function save(){
    $config['upload_path']          = './assets/dokumen_sample';
    $config['allowed_types']        = 'gif|jpg|png|PNG|jpeg|pdf';

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('dokumen')) {
      $this->set_notifikasi_swal('error','Gagal','Dokumen tidak boleh kosong');
      redirect('sample-masuk');

    } else {
      $file = $this->upload->data();

      $tgl_masuk = $this->input->post('tgl_masuk');
      $nama_supplier = $this->input->post('nama_supplier');
      $kategori = $this->input->post('kategori');
      $deskripsi = $this->input->post('deskripsi');
      $jumlah = $this->input->post('jumlah');
      $satuan = $this->input->post('satuan');
      $harga = $this->input->post('harga');
      $dokumen = $file['file_name'];

      $data = array(
        'tgl_masuk' => $tgl_masuk,
        'nama_supplier' => $nama_supplier,
        'kategori' => $kategori,
        'deskripsi' => $deskripsi,
        'jumlah' => $jumlah,
        'satuan' => $satuan,
        'harga' => $harga,
        'dokumen_sample' => $dokumen,
      );
    }
  
    $res = $this->crud_model->input($data,'tbl_bahan_sample');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('sample-masuk');
	}

  public function updateStatus(){
    $this->isLoggedIn();

    $id = $this->uri->segment(2);
    $status = $this->uri->segment(3);

    $where = array(
        'id_bahan_sample' => $id
    );

    $data = array(
        'status' => $status
    );

    $res = $this->crud_model->update($where, $data,'tbl_bahan_sample');
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

      $id_bahan_sample = $this->input->post('id_bahan_sample');
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

    $res = $this->crud_model->update('id_bahan_sample ='.$id_bahan_sample, $data,'tbl_bahan_sample');
    $this->set_notifikasi_swal('success','Berhasil','Status Berhasil Diubah');
    redirect('sample-masuk');
  }

  public function updateHasiluji(){
    $id_bahan_sample = $this->input->post('id_bahan_sample');
    $tgl_selesai_uji = $this->input->post('tgl_selesai_uji');
    $hasil_uji = $this->input->post('hasil_uji');
    $kesimpulan = $this->input->post('kesimpulan');

    $data = array(
      'tgl_selesai_uji' => $tgl_selesai_uji,
      'hasil_uji' => $hasil_uji,
      'kesimpulan' => $kesimpulan
    );

    $res = $this->crud_model->update('id_bahan_sample ='.$id_bahan_sample, $data,'tbl_bahan_sample');
    $this->set_notifikasi_swal('success','Berhasil','Status Berhasil Diubah');
    redirect('sample-masuk');
  }

  public function laporan(){
    $this->global['pageTitle'] = 'Laporan Absensi Manual Mirota KSM';
    $this->global['pageHeader'] = 'Laporan Absensi Manual Karyawan ';

    $data['list_data'] = $this->crud_model->lihatdata('tbl_bahan_sample');

    $this->loadViews("registrasiSampleMasuk/laporan", $this->global, $data, NULL);
  }
}