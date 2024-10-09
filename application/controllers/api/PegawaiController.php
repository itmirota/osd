<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class PegawaiController extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->model('pegawai_model');
        $this->load->library('form_validation');
    }

    public function index_get()
    {
        $pegawai = $this->pegawai_model->showData();
        $this->response($pegawai,200);
    }

    public function store_post()
    {
      $nama_pegawai = $this->input->post('nama_pegawai');
      $nip = $this->input->post('nip');
      $jabatan_id = $this->input->post('jabatan_id');
      $divisi_id = $this->input->post('divisi_id');
      $status_pegawai = $this->input->post('status_pegawai'); 
      $tempat_lahir = $this->input->post('tempat_lahir');    
      $tgl_lahir = $this->input->post('tgl_lahir');    
      $shio = shio($tgl_lahir);    
      $zodiak = zodiak($tgl_lahir);    
      $weton = weton($tgl_lahir);    
      $jenis_kelamin = $this->input->post('jenis_kelamin');    
      $pendidikan_terakhir = $this->input->post('pendidikan_terakhir');    
      $jurusan = $this->input->post('jurusan');    
      $golongan_darah = $this->input->post('golongan_darah');    
      $agama = $this->input->post('agama');  
      $alamat_ktp = $this->input->post('alamat_ktp');    
      $alamat_domisili = $this->input->post('alamat_domisili'); 
      $kontak_pegawai = $this->input->post('kontak_pegawai');
      $no_kk = $this->input->post('no_kk');    
      $no_ktp = $this->input->post('no_ktp');
      $tgl_masuk = $this->input->post('tgl_masuk');    
      $durasi_kontrak = $this->input->post('durasi_kontrak');
      $email_pegawai = $this->input->post('email_pegawai');      
    
  
      $tgl_selesai = date('Y-m-d',strtotime('+'.$durasi_kontrak.'month',strtotime($tgl_masuk)));
  
      $data = array(
        'nip' => $nip,
        'nama_pegawai' => $nama_pegawai,
        'jabatan_id' => $jabatan_id,
        'divisi_id' => $divisi_id,
        'status_pegawai' => $status_pegawai,
        'tempat_lahir' => $tempat_lahir,
        'tgl_lahir' => $tgl_lahir,
        'shio' => $shio,
        'zodiak' => $zodiak,
        'weton' => $weton,
        'jenis_kelamin' => $jenis_kelamin,
        'pendidikan_terakhir' => $pendidikan_terakhir,
        'jurusan' => $jurusan,
        'golongan_darah' => $golongan_darah,
        'agama' => $agama,
        'alamat_ktp' => $alamat_ktp,
        'alamat_domisili' => $alamat_domisili,
        'kontak_pegawai' => $kontak_pegawai,
        'no_ktp' => $no_ktp,
        'tgl_masuk' => $tgl_masuk,
        'tgl_selesai' => $tgl_selesai,
        'durasi_kontrak' => $durasi_kontrak,
        'email_pegawai' => $email_pegawai,
      );
  
      $sql = $this->crud_model->input($data,'tbl_pegawai');
  
      if (is_null($sql)){
          $this->response([
              'status' => true,
              'message' => 'Data Pegawai Barhasil Diinput'
          ], RestController::HTTP_OK);
      }else{
          $this->response([
              'status' => false,
              'message' => 'Data Pegawai Gagal Diinput'
          ], RestController::HTTP_BAD_REQUEST);
      }
    }
}