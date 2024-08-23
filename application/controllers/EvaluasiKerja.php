<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class evaluasiKerja extends BaseController
{

  public function __construct()
  {
      parent::__construct();
      $this->load->model('evaluasiKerja_model');
      $this->load->model('pegawai_model');
      $this->load->model('crud_model');
      $this->isLoggedIn();
  }

  public function index(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Evaluasi Kerja';
    
    // if ($this->role == ROLE_HRBP){
    $data = $this->evaluasiKerja_model->getData();
    // }else{
    // $data = $this->evaluasiKerja_model->getDatabyDate();
    // }

    $data['list_data']= $data;
    $data['pegawai'] = $this->pegawai_model->showData();
    $data['kategori'] = $this->crud_model->lihatdata('tbl_evaluasiKerja_kategori');

    $this->loadViews("evaluasiKerja/data", $this->global, $data, NULL);
  }

  public function kategori(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Kategori Evaluasi Kerja';

    $data = array(
      'kategori' => $this->crud_model->lihatdata('tbl_evaluasiKerja_kategori'),
    );

    $this->loadViews("evaluasiKerja/kategori", $this->global, $data, NULL);
  }

  public function listSoal(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Soal Evaluasi Kerja';

    $kategori = $this->uri->segment(2);

    $data = array(
      'soal' => $this->evaluasiKerja_model->getSoalbyKategori($kategori),
      'id_kategori' => $kategori
    );

    $this->loadViews("evaluasiKerja/listSoal", $this->global, $data, NULL);
  }

  public function saveKategori(){
    $kategori = $this->input->post('kategori');

    $data = array(
      'nama_kategori' => $kategori,
    );

    $query = $this->crud_model->input($data, 'tbl_evaluasiKerja_kategori');
    
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('kategori-soal');
  }

  public function hapusKategori($id){

    $this->crud_model->delete('kategori_id ='.$id, 'tbl_evaluasiKerja_soal');
    $this->crud_model->delete('id_kategori ='.$id, 'tbl_evaluasiKerja_kategori');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('kategori-soal');
  }

  public function saveSoal(){
    $soal = $this->input->post('soal');
    $kategori_id = $this->uri->segment(3);

    $data = array(
      'kategori_id' => $kategori_id,
      'soal' => $soal
    );

    $query = $this->crud_model->input($data, 'tbl_evaluasiKerja_soal');
    
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('list-soal/'.$kategori_id);
  }

  public function hapusSoal($id_soal,$kategori){

    $this->crud_model->delete('id_soal ='.$id_soal, 'tbl_evaluasiKerja_soal');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('list-soal/'.$kategori);
  }

  public function jadwalEvaluasiKerja(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Evaluasi Kerja';

    $this->loadViews("evaluasiKerja/formulir", $this->global, NULL);
  }

  public function saveJadwalPenilaian(){
    $tgl_evaluasi = $this->input->post('tgl_evaluasi');
    $nama_peserta = $this->input->post('nama_peserta');
    $bagian = $this->input->post('bagian');
    $tgl_akhir_kontrak = $this->input->post('tgl_akhir_kontrak');


    $data = array(
      'tgl_evaluasi' => $tgl_evaluasi,
      'nama_peserta' => $nama_peserta,
      'bagian' => $bagian,
      'tgl_akhir_kontrak' => $tgl_akhir_kontrak,
    );

    $query = $this->crud_model->input($data, 'tbl_evaluasikerja');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('EvaluasiKerja');
  }

  public function hasilEvaluasi(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Evaluasi Kerja';

    $id = $this->uri->segment(2);
    $hasil = $this->evaluasiKerja_model->getDataHasil($id);

    foreach ($hasil as $h){
      $jml_soal = explode(',',$h->jawaban);
    }

    $data = array(
      'list_data' => $this->evaluasiKerja_model->getEvaluasibyId($id),
      'hasil' => $hasil,
      'jml_penilai' => COUNT($hasil),
      'jml_soal' => COUNT($jml_soal)
    );

    $this->loadViews("evaluasiKerja/laporan", $this->global, $data, NULL);
  }

  public function penilaian($id){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Penilaian';

    $evaluasi = $this->evaluasiKerja_model->getEvaluasibyId($id);

    $list_soal = $this->evaluasiKerja_model->getSoalbyKategori($evaluasi->kategori_id);

    $data['list_data']= $evaluasi;
    $data['list_soal']= $list_soal;

    $data = array(
      'id_evaluasi' => $id,
      'pegawai_id' => $evaluasi->pegawai_id,
      'nama_pegawai' => $evaluasi->nama_pegawai,
      'nama_divisi' => $evaluasi->nama_divisi,
      'list_data' => $evaluasi,
      'list_soal' => $list_soal,
    );

    $this->loadViews("evaluasiKerja/penilaian", $this->global, $data, NULL);
  }

  public function savePenilaian($id){
    $penilai_id = $this->pegawai_id;
    $jawaban = $this->input->post('jawaban');
    $kelebihan = $this->input->post('kelebihan');
    $kekurangan = $this->input->post('kekurangan');
    $evaluasi_id = $id;
    $pegawai_id = $this->evaluasiKerja_model->getEvaluasibyId($id)->pegawai_id;

    var_dump($penilai_id);

    $jawaban = implode(',',$jawaban);

    $data = array(
      'penilai_id' => $penilai_id,
      'pegawai_id' => $pegawai_id,
      'evaluasi_id' => $evaluasi_id,
      'jawaban' => $jawaban,
      'kelebihan' => $kelebihan,
      'kekurangan' => $kekurangan,
      'datecreated'=>date('Y-m-d H:i:s')
    );

    $query = $this->crud_model->input($data, 'tbl_evaluasikerja_hasil');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('evaluasiKerja');
  }

  public function saveJadwal(){
    $pegawai_id = $this->input->post('pegawai_id');
    $penilai_id = $this->input->post('penilai_id');
    $kategori_id = $this->input->post('kategori_id');
    $tgl_evaluasi = $this->input->post('tgl_evaluasi');

    $penilai_id = implode(",",$penilai_id);

    $data = array(
      'pegawai_id' => $pegawai_id,
      'penilai_id' => $penilai_id,
      'kategori_id' => $kategori_id,
      'tgl_evaluasi' => $tgl_evaluasi
    );

    $query = $this->crud_model->input($data, 'tbl_evaluasiKerja');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('evaluasiKerja');

  }
}