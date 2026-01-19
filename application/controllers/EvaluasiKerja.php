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

  public function ShowDataJson($id){
    $data = $this->evaluasiKerja_model->getDataWhere(['id_evaluasi' => $id]);

    echo json_encode($data[0]);
  }

  public function list_evaluasi(){
    $page = $this->uri->segment(2);

    $this->global['pageTitle'] = 'Evaluasi '.$page.' Mirota KSM';
    $this->global['pageHeader'] = 'Data Evaluasi '.$page;
    $kategori = $this->crud_model->getdataRowbyWhere('id_evaluasi_kategori,nama_evaluasi_kategori', ['nama_evaluasi_kategori' => $page], 'tbl_evaluasi_kategori');

    $data['kategori'] = $kategori;
    $data['jenis'] = $this->crud_model->lihatdata('tbl_evaluasi_jenis');
    $data['karyawan'] = $this->crud_model->lihatdata('tbl_pegawai');
    $data['list_data'] = $this->evaluasiKerja_model->getDataWhere(['kategori_evaluasi' => $kategori->id_evaluasi_kategori]);

    $this->loadViews("evaluasi/data", $this->global, $data, NULL);
  }

  public function saveJadwal(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';

    $page = $this->input->get('page');
    
    $tgl_evaluasi = $this->input->post('tgl_evaluasi');
    $pegawai_id = $this->input->post('pegawai_id');
    $kategori_evaluasi = $this->input->post('kategori_id');
    $jenis_evaluasi = $this->input->post('jenis_evaluasi');

    $data = array (
      'tgl_evaluasi' => $tgl_evaluasi,
      'pegawai_id' => $pegawai_id,
      'kategori_evaluasi' => $kategori_evaluasi,
      'jenis_evaluasi' => $jenis_evaluasi,
    );

    $sql = $this->crud_model->input($data,'tbl_evaluasi');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');

    redirect("evaluasi/".$page);
  }

  public function updateJadwal(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';

    $page = $this->input->get('page');

    $id_evaluasi = $this->input->post('id_evaluasi');
    $tgl_evaluasi = $this->input->post('tgl_evaluasi');
    $pegawai_id = $this->input->post('pegawai_id');
    $kategori_evaluasi = $this->input->post('kategori_id');
    $jenis_evaluasi = $this->input->post('jenis_evaluasi');

    $data = array (
      'tgl_evaluasi' => $tgl_evaluasi,
      'pegawai_id' => $pegawai_id,
      'kategori_evaluasi' => $kategori_evaluasi,
      'jenis_evaluasi' => $jenis_evaluasi,
    );

    $sql = $this->crud_model->update(['id_evaluasi' => $id_evaluasi],$data,'tbl_evaluasi');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');

    redirect("evaluasi/".$page);
  }

  public function deleteJadwal($id_evaluasi,$kategori){

    $kategori = $this->crud_model->getdataRowbyWhere('id_evaluasi_kategori,nama_evaluasi_kategori', ['id_evaluasi_kategori' => $kategori], 'tbl_evaluasi_kategori');
    $kategori = $kategori->nama_evaluasi_kategori;

    $sql = $this->crud_model->delete(['id_evaluasi' => $id_evaluasi],'tbl_evaluasi');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');

    redirect("evaluasi/".$kategori);
  }

  public function listJenis(){
    $this->global['pageTitle'] = 'Jenis Evaluasi Mirota KSM';
    $this->global['pageHeader'] = 'Kategori Jenis Evaluasi Mirota KSM';

    $data['list_data'] = $this->crud_model->lihatdata('tbl_evaluasi_jenis');

    $this->loadViews("evaluasi/data_jenis", $this->global, $data, NULL);
  }

  public function saveJenis(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    
    $nama_evaluasi_jenis = $this->input->post('nama_evaluasi_jenis');

    $data = array (
      'nama_evaluasi_jenis' => $nama_evaluasi_jenis,
    );

    $sql = $this->crud_model->input($data,'tbl_evaluasi_jenis');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');

    redirect("jenis-evaluasi");
  }

  public function DataJenisJson($id){
    $data = $this->crud_model->getdataRowbyWhere('*',['id_evaluasi_jenis' => $id],'tbl_evaluasi_jenis');

    echo json_encode($data);
  }

  public function updateJenis(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    
    $id_evaluasi_jenis = $this->input->post('id_evaluasi_jenis');
    $nama_evaluasi_jenis = $this->input->post('nama_evaluasi_jenis');

    $data = array (
      'nama_evaluasi_jenis' => $nama_evaluasi_jenis,
    );

    $sql = $this->crud_model->update(['id_evaluasi_jenis' => $id_evaluasi_jenis],$data,'tbl_evaluasi_jenis');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');

    redirect("jenis-evaluasi");
  }

  public function deleteJenis($id_evaluasi_jenis){
    $sql = $this->crud_model->delete(['id_evaluasi_jenis' => $id_evaluasi_jenis],'tbl_evaluasi_jenis');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');

    redirect("jenis-evaluasi");
  }

  public function list_soal(){
    $this->global['pageTitle'] = 'Soal Evaluasi Mirota KSM';
    $this->global['pageHeader'] = 'Soal Evaluasi';

    $id = $this->input->get('j');

    $data = array(
      'jenis' => $this->crud_model->getdataRowbyWhere('*',['id_evaluasi_jenis' => $id],'tbl_evaluasi_jenis'),
      'list_data' => $this->evaluasiKerja_model->getDataSoalWhere(['jenis_evaluasi_id' => $id], 'tbl_evaluasi_soal')
    );

    $this->loadViews("evaluasi/data_soal", $this->global, $data, NULL);
  }

  public function saveSoal(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Soal Evaluasi';

    $id = $this->input->get('j');
    $parameter = $this->input->post('parameter');
    $judul = $this->input->post('judul');
    $deskripsi = $this->input->post('deskripsi');
    $target = $this->input->post('target');
    $bobot = $this->input->post('bobot');

    $data = array (
      'jenis_evaluasi_id' => $id,
      'parameter' => $parameter,
      'judul' => $judul,
      'deskripsi' => $deskripsi,
      'target' => $target,
      'bobot' => $bobot,
    );

    $sql = $this->crud_model->input($data,'tbl_evaluasi_soal');
    
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('soal-evaluasi?j='.$id);
  }

    public function ShowDataSoalJson($id){
    $data = $this->crud_model->getdataRowbyWhere('*',['id_evaluasi_soal' => $id],'tbl_evaluasi_soal');

    echo json_encode($data);
  }

  public function updateSoal(){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM'; 
    $this->global['pageHeader'] = 'Soal Evaluasi';

    $id = $this->input->get('j');
    $id_evaluasi_soal = $this->input->post('id_evaluasi_soal');
    $parameter = $this->input->post('parameter');
    $judul = $this->input->post('judul');
    $deskripsi = $this->input->post('deskripsi');
    $target = $this->input->post('target');
    $bobot = $this->input->post('bobot');

    $data = array (
      'jenis_evaluasi_id' => $id,
      'parameter' => $parameter,
      'judul' => $judul,
      'deskripsi' => $deskripsi,
      'target' => $target,
      'bobot' => $bobot,
    );

    $sql = $this->crud_model->update(['id_evaluasi_soal' => $id_evaluasi_soal],$data,'tbl_evaluasi_soal');
    
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('soal-evaluasi?j='.$id);
  }

  public function deleteSoal($id_evaluasi_soal){
    $id = $this->input->get('j');

    $sql = $this->crud_model->delete(['id_evaluasi_soal' => $id_evaluasi_soal],'tbl_evaluasi_soal');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');

    redirect('soal-evaluasi?j='.$id);
  }


  public function penilaian($id){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Formulir Penilaian Karyawan';

    $pegawai_id = $this->pegawai_id;
    $pegawai = $this->pegawai_model->getPegawaibyId($pegawai_id);
    $evaluasi_data = $this->evaluasiKerja_model->getDataRow(['id_evaluasi'=>$id]);

    $data = array(
      'pegawai' => $pegawai,
      'id' => $id,
      'list_data' => $evaluasi_data, // Wrap the single row in an array for consistency with other views
      'soal_evaluasi' => $this->evaluasiKerja_model->getDataSoalWhere(['jenis_evaluasi_id' => $evaluasi_data->jenis])
    );

    $this->loadViews("evaluasi/penilaian", $this->global, $data, NULL);
  }

  public function saveNilai($id){
    $penilai_id = $this->global['pegawai_id'];
    $evaluasi = $this->evaluasiKerja_model->getDataRow(['id_evaluasi' => $id]);
    $soal = $this->evaluasiKerja_model->getDataSoalWhere(['jenis_evaluasi_id' => $evaluasi->jenis]);
    $count_soal = COUNT($soal);

    for ($i=0; $i < $count_soal  ; $i++) { 
        $jawaban[$i] = $this->input->post('nilai_'.$soal[$i]->id_evaluasi_soal);
        $jawaban[$i] = $soal[$i]->id_evaluasi_soal.':'.$jawaban[$i];
    }

    $jawaban = implode(',', $jawaban);

    $data = array(
      'evaluasi_id' => $id,
      'pegawai_id' => $evaluasi->pegawai_id,
      'nilai' => $jawaban,
      'penilai_id' => $penilai_id,
      'tgl_evaluasi' => date('Y-m-d H:i:s')
    );
 

    $this->crud_model->input($data, 'tbl_evaluasi_hasil');

    $this->set_notifikasi_swal('success','Berhasil','Penilaian Berhasil Disimpan');
    redirect('evaluasi/'.$evaluasi->kategori);
  }

  public function Hasil($id){
    $this->global['pageTitle'] = 'Evaluasi Kerja Mirota KSM';
    $this->global['pageHeader'] = 'Hasil Penilaian Karyawan';

    $evaluasi = $this->evaluasiKerja_model->getHasilEvaluasi($id)->result();
    $list_data = $this->evaluasiKerja_model->getHasilEvaluasi($id)->row();
    $detail_pegawai = $this->pegawai_model->showDataRow(['id_pegawai' => $list_data->id_dievaluasi]);
    $soal = $this->evaluasiKerja_model->getDataSoalWhere(['jenis_evaluasi_id' => $list_data->jenis_evaluasi]);

    $total = 0;
    foreach ($evaluasi as $eval) {
      // var_dump($eval->hasil_nilai);
      $explode_hasil = explode(',', $eval->hasil_nilai);

      $count =  COUNT($explode_hasil);
      $jumlah_nilai = 0;
      for($i=0; $i < $count; $i++){
        $explode_nilai[$i] = explode(':',$explode_hasil[$i]);
        $jumlah_nilai += $explode_nilai[$i][1];
      }

      $nilai = round($jumlah_nilai/$count);

      $total += $nilai;
    }


    $hasil = $total / COUNT($evaluasi);


    $data['hasil'] = $evaluasi;
    $data['list_data'] = $list_data;
    $data['detail_pegawai'] = $detail_pegawai;
    $data['soal'] = $soal;
    $data['nilai'] = $hasil;

    $this->loadViews("evaluasi/laporan", $this->global, $data, NULL);
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
    $target12 = $this->input->post('target12');
    $bobot12 = $this->input->post('bobot12');
    $target13 = $this->input->post('target13');
    $bobot13 = $this->input->post('bobot13');
    $target14 = $this->input->post('target14');
    $bobot14 = $this->input->post('bobot14');
    $target15 = $this->input->post('target15');
    $bobot15 = $this->input->post('bobot15');
    $target16 = $this->input->post('target16');
    $bobot16 = $this->input->post('bobot16');
    $target17 = $this->input->post('target17');
    $bobot17 = $this->input->post('bobot17');
    $target18 = $this->input->post('target18');
    $bobot18 = $this->input->post('bobot18');
    $target19 = $this->input->post('target19');
    $bobot19 = $this->input->post('bobot19');
    $target20 = $this->input->post('target20');
    $bobot20 = $this->input->post('bobot20');
    $target21 = $this->input->post('target21');
    $bobot21 = $this->input->post('bobot21');
    $target22 = $this->input->post('target22');
    $bobot22 = $this->input->post('bobot22');
    $target23 = $this->input->post('target23');
    $bobot23 = $this->input->post('bobot23');
    
    

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
      'target12' => $target12,
      'bobot12' => $bobot12,
      'target13' => $target13,
      'bobot13' => $bobot13,
      'target14' => $target14,
      'bobot14' => $bobot14,
      'target15' => $target15,
      'bobot15' => $bobot15,
      'target16' => $target16,
      'bobot16' => $bobot16,
      'target17' => $target17,
      'bobot17' => $bobot17,
      'target18' => $target18,
      'bobot18' => $bobot18,
      'target19' => $target19,
      'bobot19' => $bobot19,
      'target20' => $target20,
      'bobot20' => $bobot20,
      'target21' => $target21,
      'bobot21' => $bobot21,
      'target22' => $target22,
      'bobot22' => $bobot22,
      'target23' => $target23,
      'bobot23' => $bobot23,
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
    $keterangan13 = $this->input->post('keterangan13');
    $keterangan14 = $this->input->post('keterangan14');
    $keterangan15 = $this->input->post('keterangan15');
    $keterangan16 = $this->input->post('keterangan16');
    $keterangan17 = $this->input->post('keterangan17');
    $keterangan18 = $this->input->post('keterangan18');
    $keterangan19 = $this->input->post('keterangan19');
    $keterangan20 = $this->input->post('keterangan20');
    $keterangan21 = $this->input->post('keterangan21');
    $keterangan22 = $this->input->post('keterangan22');
    $parameter13 = $this->input->post('parameter13');
    $parameter14 = $this->input->post('parameter14');
    $parameter15 = $this->input->post('parameter15');
    $parameter16 = $this->input->post('parameter16');
    $parameter17 = $this->input->post('parameter17');
    $parameter18 = $this->input->post('parameter18');
    $parameter19 = $this->input->post('parameter19');
    $parameter20 = $this->input->post('parameter20');
    $parameter21 = $this->input->post('parameter21');
    $parameter22 = $this->input->post('parameter22');
    $parameter23 = $this->input->post('parameter23');
    $kelebihan = $this->input->post('kelebihan');
    $kekurangan = $this->input->post('kekurangan');
    $rekomendasi = $this->input->post('rekomendasi');

    // $evaluasi = $this->evaluasiKerja_model->getDataRowEvaluasi($evaluasiKerja_id);

    // $hasil1 = ubahNilai($parameter1,$evaluasi->target1,$evaluasi->bobot1);
    // $hasil2 = ubahNilai($parameter2,$evaluasi->target2,$evaluasi->bobot2);
    // $hasil3 = ubahNilai($parameter3,$evaluasi->target3,$evaluasi->bobot3);
    // $hasil4 = ubahNilai($parameter4,$evaluasi->target4,$evaluasi->bobot4);
    // $hasil5 = ubahNilai($parameter5,$evaluasi->target5,$evaluasi->bobot5);
    // $hasil6 = ubahNilai($parameter6,$evaluasi->target6,$evaluasi->bobot6);
    // $hasil7 = ubahNilai($parameter7,$evaluasi->target7,$evaluasi->bobot7);
    // $hasil8 = ubahNilai($parameter8,$evaluasi->target8,$evaluasi->bobot8);
    // $hasil9 = ubahNilai($parameter9,$evaluasi->target9,$evaluasi->bobot9);
    // $hasil10 = ubahNilai($parameter10,$evaluasi->target10,$evaluasi->bobot10);
    // $hasil11 = ubahNilai($parameter11,$evaluasi->target11,$evaluasi->bobot11);

    // $total_nilai = $hasil1+$hasil3+$hasil4+$hasil5+$hasil6+$hasil7+$hasil8+$hasil9+$hasil11;

    $data = array(
      'evaluasiKerja_id' => $evaluasiKerja_id,
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
      'parameter13' => $parameter13.'|'.$keterangan13,
      'parameter14' => $parameter14.'|'.$keterangan14,
      'parameter15' => $parameter15.'|'.$keterangan15,
      'parameter16' => $parameter16.'|'.$keterangan16,
      'parameter17' => $parameter17.'|'.$keterangan17,
      'parameter18' => $parameter18.'|'.$keterangan18,
      'parameter19' => $parameter19.'|'.$keterangan19,
      'parameter20' => $parameter20.'|'.$keterangan20,
      'parameter21' => $parameter21.'|'.$keterangan21,
      'parameter22' => $parameter22.'|'.$keterangan22,
      'parameter23' => $parameter23.'|'.$keterangan23,
      'kelebihan' => $kelebihan,
      'kekurangan' => $kekurangan,
      'rekomendasi' => $rekomendasi,
      'total_nilai' => ''
    );

    $query = $this->crud_model->input($data, 'tbl_penilaian');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('penilaianEvaluasi');
  }

}