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

    $id = $this->global ['pegawai_id'];

    $data['pegawai'] = $this->crud_model->lihatdata('tbl_pegawai');
    $data['pelapor'] = $this->pegawai_model->showDataRow(['id_pegawai' => $id]);

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
    $saksi1 = $this->input->post('saksi1');
    $saksi2 = $this->input->post('saksi2');
    $kategori_insiden = $this->input->post('kategori_insiden');
    $pengobatan_cedera = $this->input->post('pengobatan_cedera');
    $deskripsi_cedera = $this->input->post('deskripsi_cedera');
    $deskripsi_pertolongan = $this->input->post('deskripsi_pertolongan');
    $kronologi_kejadian = $this->input->post('kronologi_kejadian');
    $penyebab_insiden = $this->input->post('penyebab_insiden');
    $akibat_insiden = $this->input->post('akibat_insiden');
    $langkah_perbaikan = $this->input->post('langkah_perbaikan');
    $pelapor_id = $this->global['pegawai_id'];

    $data = array(
      'pegawai_id' => $pegawai_id,
      'tgl_kejadian' => $tgl_kejadian,
      'pelapor_id' => $pelapor_id,
      'saksi1_id' => $saksi1,
      'saksi2_id' => $saksi2,
      'kategori_insiden' => $kategori_insiden,
      'pengobatan_cedera' => $pengobatan_cedera,
      'deskripsi_cedera' => $deskripsi_cedera,
      'deskripsi_pertolongan' => $deskripsi_pertolongan,
      'kronologi_kejadian' => $kronologi_kejadian,
      'penyebab_insiden' => $penyebab_insiden,
      'akibat_insiden' => $akibat_insiden,
      'langkah_perbaikan' => $langkah_perbaikan,
      'created_at' => date('Y-m-d H:i:s'),
    );

    $query = $this->crud_model->input($data, 'tbl_kecelakaan_kerja');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('kecelakaanKerja/form_kecelakaan');
  }

}