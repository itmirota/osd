<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 23 Oktober 2025
 */

class KecelakaanKerja extends BaseController
{

  public function __construct()
  {
    parent::__construct();
    // $this->load->model('kecelakaanKerja_model');
    $this->load->model('pegawai_model');
    $this->load->model('crud_model');
  }

  public function form_kecelakaan(){
    $this->global['pageTitle'] = 'Formulir Kecelakaan Kerja';
    $this->isLoggedIn();

    $data['pegawai'] = $this->crud_model->lihatdata('tbl_pegawai');

    $this->loadViews("kecelakaanKerja/formulir", $this->global, $data, NULL);
  }

  function hitung_umur($tgl_lahir){
    $this->isLoggedIn();
    $tgl_lahir = strptime($tgl_lahir, '%Y-%m-%d');
    $tanggal_lahir = new DateTime($tgl_lahir);
    $sekarang = new DateTime();
    $umur = $sekarang->diff($tanggal_lahir)->y;
    return $umur;
  }
  
  public function getPelapor($id){
    $this->isLoggedIn();
    $pegawai = $this->pegawai_model->showDataRow(['id_pegawai' => $id]);

    $date1=date_create($pegawai->tgl_lahir);
    $date2=date_create(DATE('Y-m-d'));
    $diff=date_diff($date1,$date2);
    $umur = $diff->format("%y");

    $data = array(
      'jenis_kelamin' => $pegawai->jenis_kelamin,
      'umur' => $umur,
      'alamat_tinggal' => $pegawai->alamat_domisili,
      'nomor_induk' => $pegawai->nip,
      'bagian' => $pegawai->nama_bagian,
      'jabatan' => $pegawai->nama_jabatan,
      'no_hp' => $pegawai->kontak_pegawai
    );

    echo json_encode($data);
  }

  public function getSaksi($id){
    $this->isLoggedIn();
    $pegawai = $this->pegawai_model->showDataRow(['id_pegawai' => $id]);

    $data = array(
      'jabatan' => $pegawai->nama_jabatan,
    );

    echo json_encode($data);
  }


  public function saveKecelakaanKerja(){
    $this->isLoggedIn();

    $pegawai_id = $this->input->post('pegawai_id');
    $tgl_kejadian = $this->input->post('tgl_kejadian');
    $waktu_kejadian = $this->input->post('waktu_kejadian');
    $jenis_kecelakaan = $this->input->post('jenis_kecelakaan');
    $lokasi_kejadian = $this->input->post('lokasi_kejadian');
    $penyebab_kecelakaan = $this->input->post('penyebab_kecelakaan');
    $kronologi = $this->input->post('kronologi');
    $dampak_kecelakaan = $this->input->post('dampak_kecelakaan');
    $tindakan_diambil = $this->input->post('tindakan_diambil');
    $pelapor = $this->input->post('pelapor');
    $ttd_pelapor = $this->input->post('ttd_pelapor');
    $saksi1 = $this->input->post('saksi1');
    $ttd_saksi1 = $this->input->post('ttd_saksi1');
    $saksi2 = $this->input->post('saksi2');
    $ttd_saksi2 = $this->input->post('ttd_saksi2');
    $mengetahui = $this->input->post('mengetahui');
    $ttd_mengetahui = $this->input->post('ttd_mengetahui');
    $catatan_tambahan = $this->input->post('catatan_tambahan');

    $data = array(
      'pegawai_id' => $pegawai_id,
      'tgl_kejadian' => $tgl_kejadian,
      'waktu_kejadian' => $waktu_kejadian,
      'jenis_kecelakaan' => $jenis_kecelakaan,
      'lokasi_kejadian' => $lokasi_kejadian,
      'penyebab_kecelakaan' => $penyebab_kecelakaan,
      'kronologi' => $kronologi,
      'dampak_kecelakaan' => $dampak_kecelakaan,
      'tindakan_diambil' => $tindakan_diambil,
      'pelapor' => $pelapor,
      'ttd_pelapor' => $ttd_pelapor,
      'saksi1' => $saksi1,
      'ttd_saksi1' => $ttd_saksi1,
      'saksi2' => $saksi2,
      'ttd_saksi2' => $ttd_saksi2,
      'mengetahui' => $mengetahui,
      'ttd_mengetahui' => $ttd_mengetahui,
      'catatan_tambahan' => $catatan_tambahan,
      'datecreated' => DATE('Y-m-d H:i:s')
      );

    $query = $this->crud_model->input($data, 'tbl_kecelakaan_kerja');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('kecelakaanKerja/form_kecelakaan');
  }

}