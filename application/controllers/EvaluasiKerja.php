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

    $role = $this->role;
    $check = $this->uri->segment(1);
    
    if ($role == ROLE_HRBP | $role == ROLE_HRGA | $role == ROLE_SUPERADMIN){
      $data['list_data']= $this->evaluasiKerja_model->getData();
    }else{
      $data['list_data']= $this->evaluasiKerja_model->getDataEvaluasibyDate();
    };
    
    $data['check']= $this->uri->segment(1);

    $this->loadViews("evaluasiKerja/data", $this->global, $data, NULL);
  }

  public function jadwalEvaluasiKerja(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Evaluasi Kerja';

    $data['pegawai'] = $this->crud_model->lihatdata('tbl_pegawai');

    $this->loadViews("evaluasiKerja/formulir", $this->global, $data, NULL);
  }

  public function saveJadwalPenilaian(){
    $tgl_evaluasi = $this->input->post('tgl_evaluasi');
    $id_pegawai = $this->input->post('id_pegawai');
    $tujuan_evaluasi = $this->input->post('tujuan_evaluasi');
    $tgl_akhir_kontrak = $this->input->post('tgl_akhir_kontrak');
    $target1 = $this->input->post('target1');
    $bobot1 = $this->input->post('bobot1');
    $target2 = $this->input->post('target2');
    $bobot2 = $this->input->post('bobot2');
    $target3 = $this->input->post('target3');
    $bobot3 = $this->input->post('bobot3');
    $target4 = $this->input->post('target4');
    $bobot4 = $this->input->post('bobot4');
    $target5 = $this->input->post('target5');
    $bobot5 = $this->input->post('bobot5');
    $target6 = $this->input->post('target6');
    $bobot6 = $this->input->post('bobot6');
    $target7 = $this->input->post('target7');
    $bobot7 = $this->input->post('bobot7');
    $target8 = $this->input->post('target8');
    $bobot8 = $this->input->post('bobot8');
    $target9 = $this->input->post('target9');
    $bobot9 = $this->input->post('bobot9');
    $target10 = $this->input->post('target10');
    $bobot10 = $this->input->post('bobot10');
    $target11 = $this->input->post('target11');
    $bobot11 = $this->input->post('bobot11');
    

    $pegawai = $this->pegawai_model->getPegawaibyId($id_pegawai);

    $data = array(
      'tgl_evaluasi' => $tgl_evaluasi,
      'pegawai_id' => $id_pegawai,
      'nama_peserta' => $pegawai->nama_pegawai,
      'bagian' => $pegawai->nama_departement.'/'.$pegawai->nama_divisi,
      'tujuan_evaluasi' => $tujuan_evaluasi,
      'tgl_akhir_kontrak' => $tgl_akhir_kontrak,
      'target1' => $target1,
      'bobot1' => $bobot1,
      'target2' => $target2,
      'bobot2' => $bobot2,
      'target3' => $target3,
      'bobot3' => $bobot3,
      'target4' => $target4,
      'bobot4' => $bobot4,
      'target5' => $target5,
      'bobot5' => $bobot5,
      'target6' => $target6,
      'bobot6' => $bobot6,
      'target7' => $target7,
      'bobot7' => $bobot7,
      'target8' => $target8,
      'bobot8' => $bobot8,
      'target9' => $target9,
      'bobot9' => $bobot9,
      'target10' => $target10,
      'bobot10' => $bobot10,
      'target11' => $target11,
      'bobot11' => $bobot11,
    );

    $query = $this->crud_model->input($data, 'tbl_evaluasikerja');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('EvaluasiKerja');
  }

  public function hasilEvaluasi(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Evaluasi Kerja';

    $id = $this->uri->segment(2);
    
    $data['list_data']= $this->evaluasiKerja_model->getDataEvaluasi($id);
    $data['hasil']= $this->evaluasiKerja_model->getDataHasil($id);
    $data['nilai']= $this->evaluasiKerja_model->getSumHasil($id);

    $this->loadViews("evaluasiKerja/laporan", $this->global, $data, NULL);
  }

  public function detailEvaluasiKerja($id) {
    $result = $this->crud_model->getdataRowbyWhere('*', ['id_evaluasiKerja' => $id], 'tbl_evaluasikerja');
    echo json_encode($result);
  }

  public function updateJadwalPenilaian(){
    $id_evaluasiKerja = $this->input->post('id_evaluasiKerja');
    $tgl_evaluasi = $this->input->post('tgl_evaluasi');
    $tujuan_evaluasi = $this->input->post('tujuan_evaluasi');
    $tgl_akhir_kontrak = $this->input->post('tgl_akhir_kontrak');

    $data = array(
      'tgl_evaluasi' => $tgl_evaluasi,
      'tujuan_evaluasi' => isset($tujuan_evaluasi) ? $tujuan_evaluasi:'',
      'tgl_akhir_kontrak' => $tgl_akhir_kontrak,
    );

    $query = $this->crud_model->update(['id_evaluasiKerja' => $id_evaluasiKerja], $data, 'tbl_evaluasikerja');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('EvaluasiKerja');
  }

  // public function penilaian(){
  //   $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
  //   $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';
  //   $id = $this->uri->segment(2);

  //   $data['list_data']= $this->evaluasiKerja_model->getDataEvaluasi($id);
  //   $data['id']= $id;

  //   $this->loadViews("evaluasiKerja/penilaian", $this->global, $data, NULL);
  // }

  // public function penilaian_v2(){
  //   $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
  //   $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';
  //   $id = $this->uri->segment(2);

  //   $data['list_data']= $this->evaluasiKerja_model->getDataEvaluasi($id);
  //   $data['id']= $id;

  //   $this->loadViews("evaluasiKerja/penilaian_tabel", $this->global, $data, NULL);
  // }

  // public function penilaian_v21(){
  //   $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
  //   $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';
  //   $id = $this->uri->segment(2);

  //   $data['list_data']= $this->evaluasiKerja_model->getDataEvaluasi($id);
  //   $data['id']= $id;

  //   $this->loadViews("evaluasiKerja/penilaian_tabel2", $this->global, $data, NULL);
  // }


  // public function penilaian_v3(){
  //   $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
  //   $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';
  //   $id = $this->uri->segment(2);

  //   $data['list_data']= $this->evaluasiKerja_model->getDataEvaluasi($id);
  //   $data['id']= $id;

  //   $this->loadViews("evaluasiKerja/penilaian_list", $this->global, $data, NULL);
  // }

  public function penilaian_v31(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';
    $id = $this->uri->segment(2);

    $pegawai_id = $this->pegawai_id;
    $pegawai = $this->pegawai_model->getPegawaibyId($pegawai_id);

    $data = array(
      'pegawai' => $pegawai,
      'id' => $id,
      'list_data' => $this->evaluasiKerja_model->getDataEvaluasi($id)
    );

    $this->loadViews("evaluasiKerja/penilaian_list2", $this->global, $data, NULL);
  }

  public function savePenilaian(){
    $evaluasiKerja_id = $this->input->post('evaluasiKerja_id');
    $nama_penilai = $this->input->post('nama_penilai');
    $jabatan_bagian = $this->input->post('jabatan_bagian');
    $parameter1 = $this->input->post('parameter1');
    $keterangan1 = $this->input->post('keterangan1');
    // $parameter2 = $this->input->post('parameter2');
    // $keterangan2 = $this->input->post('keterangan2');
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
    $kelebihan = $this->input->post('kelebihan');
    $kekurangan = $this->input->post('kekurangan');
    $rekomendasi = $this->input->post('rekomendasi');

    $evaluasi = $this->evaluasiKerja_model->getDataRowEvaluasi($evaluasiKerja_id);

    $hasil1 = ubahNilai($parameter1,$evaluasi->target1,$evaluasi->bobot1);
    // $hasil2 = ubahNilai($parameter2,$evaluasi->target2,$evaluasi->bobot2);
    $hasil3 = ubahNilai($parameter3,$evaluasi->target3,$evaluasi->bobot3);
    $hasil4 = ubahNilai($parameter4,$evaluasi->target4,$evaluasi->bobot4);
    $hasil5 = ubahNilai($parameter5,$evaluasi->target5,$evaluasi->bobot5);
    $hasil6 = ubahNilai($parameter6,$evaluasi->target6,$evaluasi->bobot6);
    $hasil7 = ubahNilai($parameter7,$evaluasi->target7,$evaluasi->bobot7);
    $hasil8 = ubahNilai($parameter8,$evaluasi->target8,$evaluasi->bobot8);
    $hasil9 = ubahNilai($parameter9,$evaluasi->target9,$evaluasi->bobot9);
    $hasil10 = ubahNilai($parameter10,$evaluasi->target10,$evaluasi->bobot10);
    $hasil11 = ubahNilai($parameter11,$evaluasi->target11,$evaluasi->bobot11);

    $total_nilai = $hasil1+$hasil3+$hasil4+$hasil5+$hasil6+$hasil7+$hasil8+$hasil9+$hasil11;

    $data = array(
      'evaluasiKerja_id' => $evaluasiKerja_id,
      'nama_penilai' => $nama_penilai,
      'jabatan_bagian' => $jabatan_bagian,
      'parameter1' => $parameter1.'|'.$keterangan1,
      // 'parameter2' => $parameter2.'|'.$keterangan2,
      'parameter3' => $parameter3.'|'.$keterangan3,
      'parameter4' => $parameter4.'|'.$keterangan4,
      'parameter5' => $parameter5.'|'.$keterangan5,
      'parameter6' => $parameter6.'|'.$keterangan6,
      'parameter7' => $parameter7.'|'.$keterangan7,
      'parameter8' => $parameter8.'|'.$keterangan8,
      'parameter9' => $parameter9.'|'.$keterangan9,
      'parameter10' => $parameter10.'|'.$keterangan10,
      'parameter11' => $parameter11.'|'.$keterangan11,
      'kelebihan' => $kelebihan,
      'kekurangan' => $kekurangan,
      'rekomendasi' => $rekomendasi,
      'total_nilai' => $total_nilai
    );

    $query = $this->crud_model->input($data, 'tbl_penilaian');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('penilaianEvaluasi');
  }

}