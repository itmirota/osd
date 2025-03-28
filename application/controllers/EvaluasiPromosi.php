<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class evaluasiPromosi extends BaseController
{

  public function __construct()
  {
      parent::__construct();
      $this->load->model('evaluasiPromosi_model');
      $this->load->model('pegawai_model');
      $this->load->model('crud_model');
      $this->isLoggedIn();
  }

  public function index(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Evaluasi Kerja';

    $role = $this->role;
    $check = $this->uri->segment(1);
    
    if ($role == ROLE_HRBP | $role == ROLE_HRGA | $role == ROLE_SUPERADMIN){
      $data['list_data']= $this->evaluasiPromosi_model->getData();
    }else{
      $data['list_data']= $this->evaluasiPromosi_model->getDataEvaluasibyDate();
    };
    
    $data['check']= $this->uri->segment(1);

    $this->loadViews("evaluasiPromosi/data", $this->global, $data, NULL);
  }

  public function jadwalevaluasiPromosi(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Evaluasi Kerja';

    $data['pegawai'] = $this->crud_model->lihatdata('tbl_pegawai');

    $this->loadViews("evaluasiPromosi/formulir", $this->global, $data, NULL);
  }

  public function saveJadwalPenilaian(){
    $tgl_evaluasi = $this->input->post('tgl_evaluasi');
    $id_pegawai = $this->input->post('id_pegawai');
    
    $pegawai = $this->pegawai_model->getPegawaibyId($id_pegawai);

    $data = array(
      'tgl_evaluasi' => $tgl_evaluasi,
      'pegawai_id' => $id_pegawai,
      'nama_peserta' => $pegawai->nama_pegawai,
      'bagian' => $pegawai->nama_departement.'/'.$pegawai->nama_divisi,
    );

    $query = $this->crud_model->input($data, 'tbl_evaluasipromosi');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('evaluasiPromosi');
  }

  public function hasilEvaluasi(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Evaluasi Kerja';

    $id = $this->uri->segment(2);
    
    $data['list_data']= $this->evaluasiPromosi_model->getDataEvaluasi($id);
    $data['hasil']= $this->evaluasiPromosi_model->getDataHasil($id);
    $data['nilai']= $this->evaluasiPromosi_model->getSumHasil($id);

    $this->loadViews("evaluasiPromosi/laporan", $this->global, $data, NULL);
  }

  public function detailevaluasiPromosi($id) {
    $result = $this->crud_model->getdataRowbyWhere('*', ['id_evaluasiPromosi' => $id], 'tbl_evaluasipromosi');
    echo json_encode($result);
  }

  public function updateJadwalPenilaian(){
    $id_evaluasiPromosi = $this->input->post('id_evaluasiPromosi');
    $tgl_evaluasi = $this->input->post('tgl_evaluasi');
    $tgl_akhir_kontrak = $this->input->post('tgl_akhir_kontrak');

    $data = array(
      'tgl_evaluasi' => $tgl_evaluasi,
      'tgl_akhir_kontrak' => $tgl_akhir_kontrak,
    );

    $query = $this->crud_model->update(['id_evaluasiPromosi' => $id_evaluasiPromosi], $data, 'tbl_evaluasipromosi');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('evaluasiPromosi');
  }

  public function penilaian(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';
    $id = $this->uri->segment(2);

    $data['list_data']= $this->evaluasiPromosi_model->getDataEvaluasi($id);
    $data['id']= $id;

    $this->loadViews("evaluasiPromosi/penilaian", $this->global, $data, NULL);
  }

  public function penilaian_v2(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';
    $id = $this->uri->segment(2);

    $data['list_data']= $this->evaluasiPromosi_model->getDataEvaluasi($id);
    $data['id']= $id;

    $this->loadViews("evaluasiPromosi/penilaian_tabel", $this->global, $data, NULL);
  }

  public function penilaian_v21(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';
    $id = $this->uri->segment(2);

    $data['list_data']= $this->evaluasiPromosi_model->getDataEvaluasi($id);
    $data['id']= $id;

    $this->loadViews("evaluasiPromosi/penilaian_tabel2", $this->global, $data, NULL);
  }


  public function penilaian_v3(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';
    $id = $this->uri->segment(2);

    $data['list_data']= $this->evaluasiPromosi_model->getDataEvaluasi($id);
    $data['id']= $id;

    $this->loadViews("evaluasiPromosi/penilaian_list", $this->global, $data, NULL);
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
      'list_data' => $this->evaluasiPromosi_model->getDataEvaluasi($id)
    );

    $this->loadViews("evaluasiPromosi/penilaian_list2", $this->global, $data, NULL);
  }

  public function savePenilaian(){
    $evaluasiPromosi_id = $this->input->post('evaluasiPromosi_id');
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
    $keterangan9 = $this->input->post('keterangan9');
    $parameter9 = $this->input->post('parameter9');
    $keterangan10 = $this->input->post('keterangan10');
    $parameter10 = $this->input->post('parameter10');
    $keterangan11 = $this->input->post('keterangan11');
    $parameter11 = $this->input->post('parameter11');
    $keterangan12 = $this->input->post('keterangan12');
    $parameter12 = $this->input->post('parameter12');
    $kelebihan = $this->input->post('kelebihan');
    $kekurangan = $this->input->post('kekurangan');
    $rekomendasi = $this->input->post('rekomendasi');

    $hasil1 = ubahNilai($parameter1,3,10);
    $hasil2 = ubahNilai($parameter2,3,10);
    $hasil3 = ubahNilai($parameter3,3,10);
    $hasil4 = ubahNilai($parameter4,3,10);
    $hasil5 = ubahNilai($parameter5,3,5);
    $hasil6 = ubahNilai($parameter6,4,15);
    $hasil7 = ubahNilai($parameter7,4,5);
    $hasil8 = ubahNilai($parameter8,4,10);
    $hasil9 = ubahNilai($parameter9,3,10);
    $hasil10 = ubahNilai($parameter10,4,5);
    $hasil11 = ubahNilai($parameter11,4,5);
    $hasil12 = ubahNilai($parameter12,4,5);

    $total_nilai = $hasil1+$hasil2+$hasil3+$hasil4+$hasil5+$hasil6+$hasil7+$hasil8+$hasil9+$hasil10+$hasil11+$hasil12;

    $data = array(
      'evaluasiPromosi_id' => $evaluasiPromosi_id,
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
      'parameter9' => $parameter9.'|'.$keterangan9,
      'parameter10' => $parameter10.'|'.$keterangan10,
      'parameter11' => $parameter11.'|'.$keterangan11,
      'parameter12' => $parameter12.'|'.$keterangan12,
      'kelebihan' => $kelebihan,
      'kekurangan' => $kekurangan,
      'rekomendasi' => $rekomendasi,
      'total_nilai' => $total_nilai
    );

    $query = $this->crud_model->input($data, 'tbl_penilaian_promosi');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('evaluasiPromosi');
  }

}