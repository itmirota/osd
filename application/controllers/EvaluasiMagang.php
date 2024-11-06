<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class evaluasiMagang extends BaseController
{

  public function __construct()
  {
      parent::__construct();
      $this->load->model('evaluasiMagang_model');
      $this->load->model('pegawai_model');
      $this->load->model('crud_model');
      $this->isLoggedIn();
  }

  public function index(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Evaluasi Kerja';

    $check = $this->uri->segment(1);
    
    if ($check != 'penilaianEvaluasi'){
      $data['list_data']= $this->evaluasiMagang_model->getData();
    }else{
      $data['list_data']= $this->evaluasiMagang_model->getDataEvaluasibyDate();
    };
    
    $data['check']= $this->uri->segment(1);

    $this->loadViews("evaluasiMagang/data", $this->global, $data, NULL);
  }

  public function jadwalevaluasiMagang(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Evaluasi Kerja';

    $this->loadViews("evaluasiMagang/formulir", $this->global, NULL);
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

    $query = $this->crud_model->input($data, 'tbl_evaluasiMagang');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('evaluasiMagang');
  }

  public function hasilEvaluasi(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Evaluasi Kerja';

    $id = $this->uri->segment(2);
    
    $data['list_data']= $this->evaluasiMagang_model->getDataEvaluasi($id);
    $data['hasil']= $this->evaluasiMagang_model->getDataHasil($id);
    $data['nilai']= $this->evaluasiMagang_model->getSumHasil($id);

    $this->loadViews("evaluasiMagang/laporan", $this->global, $data, NULL);
  }

  public function penilaian(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';
    $id = $this->uri->segment(2);

    $data['list_data']= $this->evaluasiMagang_model->getDataEvaluasi($id);
    $data['id']= $id;

    $this->loadViews("evaluasiMagang/penilaian", $this->global, $data, NULL);
  }

  public function penilaian_v2(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';
    $id = $this->uri->segment(2);

    $data['list_data']= $this->evaluasiMagang_model->getDataEvaluasi($id);
    $data['id']= $id;

    $this->loadViews("evaluasiMagang/penilaian_tabel", $this->global, $data, NULL);
  }

  public function penilaian_v21(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';
    $id = $this->uri->segment(2);

    $data['list_data']= $this->evaluasiMagang_model->getDataEvaluasi($id);
    $data['id']= $id;

    $this->loadViews("evaluasiMagang/penilaian_tabel2", $this->global, $data, NULL);
  }


  public function penilaian_v3(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';
    $id = $this->uri->segment(2);

    $data['list_data']= $this->evaluasiMagang_model->getDataEvaluasi($id);
    $data['id']= $id;

    $this->loadViews("evaluasiMagang/penilaian_list", $this->global, $data, NULL);
  }

  public function penilaian_v31(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';
    $id = $this->uri->segment(2);

    $pegawai_id = $this->pegawai_id;
    $pegawai = $this->pegawai_model->getPegawaibyId($pegawai_id);

    $data = array(
      'pegawai' => $pegawai,
      'id' => $id,
      'list_data' => $this->evaluasiMagang_model->getDataEvaluasi($id)
    );

    $this->loadViews("evaluasiMagang/penilaian_list2", $this->global, $data, NULL);
  }

  public function savePenilaian(){
    $evaluasiMagang_id = $this->input->post('evaluasiMagang_id');
    $nama_penilai = $this->input->post('nama_penilai');
    $jabatan_bagian = $this->input->post('jabatan_bagian');
    $parameter1 = $this->input->post('parameter1');
    $keterangan1 = $this->input->post('keterangan1');
    $parameter2 = $this->input->post('parameter2');
    $keterangan2 = $this->input->post('keterangan2');
    $parameter3 = $this->input->post('parameter3');
    $keterangan3 = $this->input->post('keterangan3');
    $parameter4 = $this->input->post('parameter4');
    $keterangan4 = $this->input->post('keterangan4');
    $parameter5 = $this->input->post('parameter5');
    $keterangan5 = $this->input->post('keterangan5');
    $parameter6 = $this->input->post('parameter6');
    $keterangan6 = $this->input->post('keterangan6');
    $parameter6 = $this->input->post('parameter6');
    $keterangan7 = $this->input->post('keterangan7');
    $parameter7 = $this->input->post('parameter7');
    $keterangan8 = $this->input->post('keterangan8');
    $parameter8 = $this->input->post('parameter8');
    $kelebihan = $this->input->post('kelebihan');
    $kekurangan = $this->input->post('kekurangan');
    $rekomendasi = $this->input->post('rekomendasi');

    $hasil1 = ubahNilai($parameter1,2,10);
    $hasil2 = ubahNilai($parameter2,2,10);
    $hasil3 = ubahNilai($parameter3,3,15);
    $hasil4 = ubahNilai($parameter4,3,15);
    $hasil5 = ubahNilai($parameter5,2,10);
    $hasil6 = ubahNilai($parameter6,3,15);
    $hasil7 = ubahNilai($parameter7,3,15);
    $hasil8 = ubahNilai($parameter8,2,10);

    $total_nilai = $hasil1+$hasil2+$hasil3+$hasil4+$hasil5+$hasil6+$hasil7+$hasil8;

    $data = array(
      'evaluasiMagang_id' => $evaluasiMagang_id,
      'nama_penilai' => $nama_penilai,
      'jabatan_bagian' => $jabatan_bagian,
      'parameter1' => $parameter1.'|'.$keterangan1,
      'parameter2' => $parameter2.'|'.$keterangan2,
      'parameter3' => $parameter3.'|'.$keterangan3,
      'parameter4' => $parameter4.'|'.$keterangan4,
      'parameter5' => $parameter5.'|'.$keterangan5,
      'parameter6' => $parameter6.'|'.$keterangan6,
      'parameter7' => $parameter7.'|'.$keterangan7,
      'parameter8' => $parameter8.'|'.$keterangan8,
      'kelebihan' => $kelebihan,
      'kekurangan' => $kekurangan,
      'rekomendasi' => $rekomendasi,
      'total_nilai' => $total_nilai
    );

    $query = $this->crud_model->input($data, 'tbl_penilaian_magang');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('EvaluasiMagang');
  }

}