<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Pegawai extends BaseController
{

  public function __construct()
  {
      parent::__construct();
      $this->load->model('crud_model');
      $this->load->model('pegawai_model');
      $this->load->library('form_validation');
      $this->isLoggedIn();
  }

  public function getRegencies($id){
    $result = $this->crud_model->GetDataByWhere(['province_id' => $id],'reg_regencies');

    echo json_encode($result);
  }

  public function getDistricts($id){
    $result = $this->crud_model->GetDataByWhere(['regency_id' => $id],'reg_districts');

    echo json_encode($result);
  }

  public function getVillages($id){
    $result = $this->crud_model->GetDataByWhere(['district_id' => $id],'reg_villages');

    echo json_encode($result);
  }

  // ADMIN AREA
  public function listData(){
    $this->global['pageTitle'] = 'SMART OSD | Data Karyawan Mirota KSM';
    $this->global['pageHeader'] = 'Data Karyawan';

    $where = array(
      'status_pegawai' => 'kontrak',
      'MONTH(tgl_selesai) >=' => DATE('m'),
      'MONTH(tgl_selesai) <=' => DATE('m') + 3
    );

    $where = array(
      'status_pegawai' => 'kontrak',
      'MONTH(tgl_selesai) >=' => DATE('m'),
      'MONTH(tgl_selesai) <=' => DATE('m') + 3,
      'YEAR(tgl_selesai) =' => DATE('Y')
    );

    $role = $this->role;
    $divisi = $this->divisi_id;

    if($role == ROLE_KABAG){
      $pegawai_id = $this->pegawai_id;
      $list_data = $this->pegawai_model->showDataWhere('*',['kadiv_id' => $pegawai_id,'status' => 'aktif'],NULL,NULL,NULL);
      $whereTotalPegawai = array(
        'divisi_id' => $divisi,
        'status' => "aktif"
      );
    }elseif($role == ROLE_MANAGER){
      $pegawai_id = $this->pegawai_id;
      
      $list_data = $this->pegawai_model->showDataWhere('*',['manager_id' => $pegawai_id, 'status' => 'aktif'],NULL,NULL,NULL);

      $whereTotalPegawai = array(
        'manager_id' => $pegawai_id,
        'status' => "aktif"
      );
    }else{
      $list_data = $this->pegawai_model->showData();
      
      $whereTotalPegawai = array(
        'status' => "aktif"
      );
    }

    $data = array(
      'list_data' => $list_data,
      'provinsi' => $this->crud_model->lihatdata('reg_provinces'),
      'mendekati_habis_kontrak' => $this->pegawai_model->showDataWhere('COUNT(id_pegawai) as pegawai, MONTH(tgl_selesai) as bulan', $where,'tgl_selesai','ASC','MONTH(tgl_selesai)'),
      'departement' => $this->crud_model->lihatdata('tbl_departement'),
      'total_pegawai_aktif' => $this->pegawai_model->TotalPegawai($whereTotalPegawai),
      'divisi' => $this->crud_model->lihatdata('tbl_divisi'),
      'jabatan' => $this->crud_model->lihatdata('tbl_jabatan'),
      'list_role' => $this->crud_model->GetDataByWhere('roleId > 1','tbl_roles'),
      'maxNIP' => $this->pegawai_model->showMaxNIP()->nip
    );

    $this->loadViews("pegawai/data", $this->global, $data, NULL);
  }

  public function listMasaKontrak($bulan){
    $this->global['pageTitle'] = 'SMART OSD | Data Karyawan Mirota KSM';
    $this->global['pageHeader'] = 'Data Karyawan';

    $where = array(
      'status_pegawai' => 'kontrak',
      'MONTH(tgl_selesai)' => $bulan,
      'YEAR(tgl_selesai) =' => DATE('Y')
    );

    $data = array(
      'list_data' => $this->pegawai_model->showDataWhere('*', $where, 'tgl_selesai','ASC',NULL),
      'bulan' => $bulan
    );

    $this->loadViews("pegawai/dataMasaKontrak", $this->global, $data, NULL);
  }

  public function getPegawaiByDivisi($id){

    $where = array(
      'divisi_id' => $id
    );

    $pegawai = $this->crud_model->GetDataByWhere($where,'tbl_pegawai');

    echo json_encode($pegawai);
  }

  public function listDataNonAktif(){
    $this->global['pageTitle'] = 'SMART OSD | Perizinan Mirota KSM';
    $this->global['pageHeader'] = 'Perizinan Manual Karyawan ';

    $role = $this->role;
    if($role == ROLE_KABAG){
      $divisi = $this->divisi_id;

      $wherelistdata = array(
        'divisi_id' => $divisi,
        'status' => 'tidak'
      );

      $list_data = $this->pegawai_model->showDataWhere('*',$wherelistdata ,NULL,NULL,NULL);

      $whereTotalPegawai = array(
        'divisi_id' => $divisi,
        'status' => "tidak"
      );
    }elseif($role == ROLE_MANAGER){
      $pegawai_id = $this->pegawai_id;

      $wherelistdata = array(
        'manager_id' => $pegawai_id,
        'status' => 'tidak'
      );

      $list_data = $this->pegawai_model->showDataWhere('*',$wherelistdata ,NULL,NULL,NULL);

      $whereTotalPegawai = array(
        'manager_id' => $pegawai_id,
        'status' => "tidak"
      );
    }else{
      $list_data = $this->pegawai_model->showDataNonAktif();
      
      $whereTotalPegawai = array(
        'status' => "tidak"
      );
    }

    $data = array(
      'pegawai' => $this->pegawai_model->showData(),
      'list_data' => $list_data,
      'total_pegawai_nonaktif' => $this->pegawai_model->TotalPegawai($whereTotalPegawai),
      'divisi' => $this->crud_model->lihatdata('tbl_divisi'),
      'jabatan' => $this->crud_model->lihatdata('tbl_jabatan'),
      'list_role' => $this->crud_model->GetDataByWhere('roleId > 1','tbl_roles'),
      'maxNIP' => $this->pegawai_model->showMaxNIP()->nip
    );

    $this->loadViews("pegawai/dataNonAktif", $this->global, $data, NULL);
  }

  public function saveUser($nip, $name){
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $role_id = $this->input->post('role_id');

    $data = array(
      'username' => $username,
      'password' => getHashedPassword($password),
      'nip' => $nip, 
      'createdBy'=>$this->vendorId, 
      'roleId' => $role_id,
      'createdDtm'=>date('Y-m-d H:i:s')
    );

    $this->crud_model->input($data,'tbl_users');
  }

  public function save(){
    $nama_pegawai = $this->input->post('nama_pegawai');
    $nip = $this->input->post('nip');
    $jabatan_id = $this->input->post('jabatan_id');
    $divisi_id = $this->input->post('divisi_id');
    $status_pegawai = $this->input->post('status_pegawai'); 
    $tempat_lahir = $this->input->post('tempat_lahir');    
    $tgl_lahir = $this->input->post('tgl_lahir');    
    $shio = shio($tgl_lahir);    
    $zodiak = zodiak($tgl_lahir);    
    // $weton = " ";
    $weton = weton($tgl_lahir);    
    $jenis_kelamin = $this->input->post('jenis_kelamin');    
    $pendidikan_terakhir = $this->input->post('pendidikan_terakhir');    
    $jurusan = $this->input->post('jurusan');    
    $golongan_darah = $this->input->post('golongan_darah');    
    $agama = $this->input->post('agama');  
    $provinsiktp_id = $this->input->post('provinsiktp_id');    
    $kabupatenktp_id = $this->input->post('kabupatenktp_id');    
    $kecamatanktp_id = $this->input->post('kecamatanktp_id');    
    $kelurahanktp_id = $this->input->post('kelurahanktp_id');   
    $kodepos_ktp = $this->input->post('kodepos_ktp');
    $alamat_ktp = $this->input->post('alamat_ktp');
    $provinsidomisili_id = $this->input->post('provinsidomisili_id');    
    $kabupatendomisili_id = $this->input->post('kabupatendomisili_id');    
    $kecamatandomisili_id = $this->input->post('kecamatandomisili_id');    
    $kelurahandomisili_id = $this->input->post('kelurahandomisili_id');   
    $kodepos_domisili = $this->input->post('kodepos_domisili'); 
    $alamat_domisili = $this->input->post('alamat_domisili'); 
    $kontak_pegawai = $this->input->post('kontak_pegawai');
    $no_kk = $this->input->post('no_kk');    
    $no_ktp = $this->input->post('no_ktp');    
    $no_bpjsKesehatan = $this->input->post('no_bpjsKesehatan');    
    $no_npwp = $this->input->post('no_npwp');
    $tgl_masuk = $this->input->post('tgl_masuk');    
    $durasi_kontrak = $this->input->post('durasi_kontrak');
    $email_pegawai = $this->input->post('email_pegawai');  
    $status_pernikahan = $this->input->post('status_pernikahan');    
    $nama_ibu = $this->input->post('nama_ibu');    
    $nama_ayah = $this->input->post('nama_ayah');    
    $nama_pasangan = $this->input->post('nama_pasangan'); 
    $kontak_pasangan = $this->input->post('kontak_pasangan'); 
    $nama_anak = $this->input->post('nama_anak');    
    $nama_kontakdarurat1 = $this->input->post('nama_kontakdarurat1');    
    $no_hpdarurat1 = $this->input->post('no_hpdarurat1');    
    $hubungan_darurat1 = $this->input->post('hubungan_darurat1'); 
    $nama_kontakdarurat2 = $this->input->post('nama_kontakdarurat2');    
    $no_hpdarurat2 = $this->input->post('no_hpdarurat2');    
    $hubungan_darurat2 = $this->input->post('hubungan_darurat2');       

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
      'provinsiktp_id' => $provinsiktp_id,
      'kabupatenktp_id' => $kabupatenktp_id,
      'kecamatanktp_id' => $kecamatanktp_id,
      'kelurahanktp_id' => $kelurahanktp_id,
      'kodepos_ktp' => $kodepos_ktp,
      'alamat_ktp' => $alamat_ktp,
      'provinsidomisili_id' => $provinsidomisili_id,
      'kabupatendomisili_id' => $kabupatendomisili_id,
      'kecamatandomisili_id' => $kecamatandomisili_id,
      'kelurahandomisili_id' => $kelurahandomisili_id,
      'kodepos_domisili' => $kodepos_domisili,
      'alamat_domisili' => $alamat_domisili,
      'kontak_pegawai' => $kontak_pegawai,
      'no_kk' => $no_kk,
      'no_ktp' => $no_ktp,
      'no_bpjsKesehatan' => $no_bpjsKesehatan,
      'no_npwp' => $no_npwp,
      'tgl_masuk' => $tgl_masuk,
      'tgl_selesai' => $tgl_selesai,
      'durasi_kontrak' => $durasi_kontrak,
      'email_pegawai' => $email_pegawai,
      'status_pernikahan' => $status_pernikahan,
      'nama_ibu' => $nama_ibu,
      'nama_ayah' => $nama_ayah,
      'nama_pasangan' => $nama_pasangan,
      'kontak_pasangan' => $kontak_pasangan,
      'nama_anak' => $nama_anak,
      'nama_kontakdarurat1' => $nama_kontakdarurat1,
      'no_hpdarurat1' => $no_hpdarurat1,
      'hubungan_darurat1' => $hubungan_darurat1,
      'nama_kontakdarurat2' => $nama_kontakdarurat2,
      'no_hpdarurat2' => $no_hpdarurat2,
      'hubungan_darurat2' => $hubungan_darurat2,
    );

    $sql = $this->crud_model->input($data,'tbl_pegawai');

    $this->saveUser($nip, $nama_pegawai);

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }
    redirect('Datapegawai');
  }


  public function saveNonAktif(){
    $id_pegawai = $this->input->post('id_pegawai');
    $tgl_keluar = $this->input->post('tgl_keluar');
    $alasan = $this->input->post('alasan');

    $data = array(
      'tgl_keluar' => $tgl_keluar,
      'alasan_keluar' => $alasan,
      'status'=>'tidak'
    );

    $sql = $this->crud_model->update('id_pegawai ='.$id_pegawai, $data,'tbl_pegawai');

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }
    redirect('Datapegawainonaktif');
  }

  public function listSuratPeringatan($id){
    $peringatan = $this->crud_model->getdataOrderBy('pegawai_id ='.$id, 'id_peringatan', 'ASC', 'tbl_histori_peringatan');
    echo json_encode($peringatan);
  }

  public function add_peringatan(){
    $pegawai_id = $this->input->post('id_pegawai');
    $tingkat_peringatan = $this->input->post('tingkat_peringatan');
    $datecreated = $this->input->post('tgl_surat_peringatan');

    $data = array(
      'pegawai_id' => $pegawai_id,
      'tingkat_peringatan' => $tingkat_peringatan,
      'datecreated' => $datecreated,
    );

    $update = $this->crud_model->update(['id_pegawai' => $pegawai_id],['tingkat_peringatan' => $tingkat_peringatan],'tbl_pegawai');
    $sql = $this->crud_model->input($data,'tbl_histori_peringatan');
    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('Datapegawai');

  }

  public function detailPenambahanKaryawan(){

    $year = $this->input->post('tahun');

    if(isset($year)){
    $year = $year;
    }else{
    $year = DATE('Y');
    }

    $this->global['pageTitle'] = "Daftar Pegawai Tambahan ".$year;

    $id = $this->pegawai_id;
    $role = $this->role;

    if($role == ROLE_MANAGER){
      $list_data = $this->pegawai_model->showDataWhere('*',['manager_id' => $id,'year(tgl_masuk)' => $year],'tgl_masuk','DESC',NULL);
    }else{
      $list_data = $this->pegawai_model->showDataWhere('*',['year(tgl_masuk)' => $year],'tgl_masuk','DESC',NULL);
    }

    $data = array(
      'list_data' => $list_data,
      'year' => $year,
    );

    $this->loadViews("pegawai/listPenambahan", $this->global, $data, NULL);
  }

  public function detailPenguranganKaryawan(){

    $year = $this->input->post('tahun');

    if(isset($year)){
    $year = $year;
    }else{
    $year = DATE('Y');
    }

    $this->global['pageTitle'] = "Daftar Pegawai Tambahan ".$year;

    $id = $this->pegawai_id;
    $role = $this->role;

    if($role == ROLE_MANAGER){
      $list_data = $this->pegawai_model->showDataWhere('*',['manager_id' => $id,'year(tgl_keluar)' => $year],'tgl_keluar','DESC',NULL);
    }else{
      $list_data = $this->pegawai_model->showDataWhere('*',['year(tgl_keluar)' => $year],'tgl_masuk','DESC',NULL);
    }

    $data = array(
      'list_data' => $list_data,
      'year' => $year,
    );

    $this->loadViews("pegawai/listPengurangan", $this->global, $data, NULL);
  }

  public function detailpegawai($id){

    $pegawai = $this->crud_model->GetRowById('id_pegawai ='.$id,'tbl_pegawai');

    $nip = $pegawai->nip;
    $user = $this->crud_model->GetRowById('nip ='.$nip,'tbl_users');

    $kontrak = $this->pegawai_model->getDataPerpanjanganKontrak($id);

    $data =array(
      'pegawai' => $pegawai,
      'user' => $user,
      'kontrak' => $kontrak
    );

    echo json_encode($data);
  }

  public function update(){
    $nama_pegawai = $this->input->post('nama_pegawai');
    $nip = $this->input->post('nip');
    $jabatan_id = $this->input->post('jabatan_id');
    $divisi_id = $this->input->post('divisi_id');
    $status_pegawai = $this->input->post('status_pegawai'); 
    $kuota_cuti = $this->input->post('kuota_cuti'); 
    $tempat_lahir = $this->input->post('tempat_lahir');    
    $tgl_lahir = $this->input->post('tgl_lahir');        
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
    $no_bpjsKesehatan = $this->input->post('no_bpjsKesehatan');    
    $no_npwp = $this->input->post('no_npwp');   
    $tgl_masuk = $this->input->post('tgl_masuk');   
    $tgl_selesai = $this->input->post('tgl_selesai');   
    $durasi_kontrak = $this->input->post('durasi_kontrak');   
    $email_pegawai = $this->input->post('email_pegawai');  
    $status_pernikahan = $this->input->post('status_pernikahan');    
    $nama_ibu = $this->input->post('nama_ibu');    
    $nama_ayah = $this->input->post('nama_ayah');    
    $nama_pasangan = $this->input->post('nama_pasangan');
    $nama_anak = $this->input->post('nama_anak');    
    $role_id = $this->input->post('role_id');   

    $data = array(
      'nip' => $nip,
      'nama_pegawai' => $nama_pegawai,
      'jabatan_id' => $jabatan_id,
      'divisi_id' => $divisi_id,
      'status_pegawai' => $status_pegawai,
      'kuota_cuti' => $kuota_cuti,
      'tempat_lahir' => $tempat_lahir,
      'tgl_lahir' => $tgl_lahir,
      'jenis_kelamin' => $jenis_kelamin,
      'pendidikan_terakhir' => $pendidikan_terakhir,
      'jurusan' => $jurusan,
      'golongan_darah' => $golongan_darah,
      'agama' => $agama,
      'alamat_ktp' => $alamat_ktp,
      'alamat_domisili' => $alamat_domisili,
      'kontak_pegawai' => $kontak_pegawai,
      'no_kk' => $no_kk,
      'no_ktp' => $no_ktp,
      'no_bpjsKesehatan' => $no_bpjsKesehatan,
      'no_npwp' => $no_npwp,
      'tgl_masuk' => $tgl_masuk,
      'tgl_selesai' => $tgl_selesai,
      'durasi_kontrak' => $durasi_kontrak,
      'email_pegawai' => $email_pegawai,
      'status_pernikahan' => $status_pernikahan,
      'nama_ibu' => $nama_ibu,
      'nama_ayah' => $nama_ayah,
      'nama_pasangan' => $nama_pasangan,
      'nama_anak' => $nama_anak
    );

    $where = array(
      'nip' => $nip
    );

    $sql = $this->crud_model->update($where, $data,'tbl_pegawai');
    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('Datapegawai');
  }

  public function updateNonAktif(){ 
    $id_pegawai = $this->input->post('id_pegawai');   
    $tgl_keluar = $this->input->post('tgl_keluar');   

    $where = array(
      'id_pegawai' => $id_pegawai
    );

    $data = array(
      'tgl_keluar' => $tgl_keluar,
    );

    $sql = $this->crud_model->update($where, $data,'tbl_pegawai');
    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('Datapegawainonaktif');
  }

  public function updateUser($nip, $role_id){
    $where = array(
      'nip' => $nip
    );

    $data = array(
      'roleId' => $role_id,
      'updatedBy'=>$this->vendorId, 
      'updatedDtm'=>date('Y-m-d H:i:s')
    );

    $this->crud_model->update($where, $data,'tbl_users');
  }

  public function delete($id){
    $id_pegawai = $id;

    $where = array(
      'id_pegawai' => $id_pegawai
    );

    $pegawai = $this->crud_model->GetRowById('id_pegawai='.$id_pegawai,'tbl_pegawai');
    $nip = $pegawai->nip;

    $this->crud_model->delete($where, 'tbl_pegawai');
    $this->crud_model->delete('nip ='.$nip, 'tbl_users');

    echo json_encode ($pegawai);
  }

  public function update_kontrak($id_pegawai, $kuotacuti, $durasi_kontrak, $tgl_selesai){

    $data = array(
      'durasi_kontrak' => $durasi_kontrak,
      'kuota_cuti' => $kuotacuti,
      'tgl_selesai' => $tgl_selesai
    );

    $where = array(
      'id_pegawai' => $id_pegawai
    );

    $sql = $this->crud_model->update($where, $data, 'tbl_pegawai');
  }

  public function perpanjangan_kontrak(){
    $id_pegawai = $this->input->post('id_pegawai'); 
    $durasi_kontrak = $this->input->post('durasi_kontrak');
    $tgl_kontrak = $this->input->post('tgl_kontrak');  

    $tgl_selesai = date('Y-m-d',strtotime('+'.$durasi_kontrak.'month',strtotime($tgl_kontrak)));
    $kuotacuti = $durasi_kontrak;

    $data = array(
      'pegawai_id' => $id_pegawai,
      'tgl_kontrak' => $tgl_kontrak,
      'createdBy' => $this->global ['pegawai_id'],
      'datecreated' => DATE('Y-m-d H:i:s')
    );

    $where = array(
      'id_pegawai' => $id_pegawai
    );

    $this->update_kontrak($id_pegawai, $kuotacuti, $durasi_kontrak, $tgl_selesai);
    $sql = $this->crud_model->input($data,'tbl_perpanjangan_kontrak');

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('Datapegawai');
  }

  public function format_excel(){
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="format input data pegawai.xlsx"');

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    $sheet->setCellValue('A1', 'NIK');
    $sheet->setCellValue('B1', 'Nama Karyawan');
    $sheet->setCellValue('C1', 'Jabatan');
    $sheet->setCellValue('D1', 'Departement');
    $sheet->setCellValue('E1', 'Status Karyawan');
    $sheet->setCellValue('F1', 'Tempat Lahir');
    $sheet->setCellValue('G1', 'Tanggal Lahir');
    $sheet->setCellValue('H1', 'Shio');
    $sheet->setCellValue('I1', 'Zodiak');
    $sheet->setCellValue('J1', 'Weton');
    $sheet->setCellValue('K1', 'Jenis Kelamin');
    $sheet->setCellValue('L1', 'Pendidikan Terakhir');
    $sheet->setCellValue('M1', 'Jurusan terakhir');
    $sheet->setCellValue('N1', 'Golongan Darah');
    $sheet->setCellValue('O1', 'Agama');
    $sheet->setCellValue('P1', 'Alamat(KTP)');
    $sheet->setCellValue('Q1', 'Alamat(Domisili)');
    $sheet->setCellValue('R1', 'No. Kontak');
    $sheet->setCellValue('S1', 'No. KK');
    $sheet->setCellValue('T1', 'No. KTP');
    $sheet->setCellValue('U1', 'No. Jamsostek');
    $sheet->setCellValue('V1', 'No. BPJSKes');
    $sheet->setCellValue('W1', 'NPWP');
    $sheet->setCellValue('X1', 'Tanggal Masuk');
    $sheet->setCellValue('Y1', 'Tanggal Selesai');
    $sheet->setCellValue('Z1', 'Durasi Kontrak');
    $sheet->setCellValue('AA1', 'kuota Cuti');
    $sheet->setCellValue('AB1', 'Sisa Cuti Tahun Lalu');
    $sheet->setCellValue('AC1', 'Email');
    $sheet->setCellValue('AD1', 'Nama Ibu');
    $sheet->setCellValue('AE1', 'Status Pernikahan');
    $sheet->setCellValue('AF1', 'Nama Ayah');
    $sheet->setCellValue('AG1', 'Nama Pasangan');
    $sheet->setCellValue('AH1', 'Nama Anak');
    $sheet->setCellValue('AI1', 'Username');
    $sheet->setCellValue('AJ1', 'Password');
    $sheet->setCellValue('AK1', 'Role');


    $sheet->setCellValue('A2', '0001');
    $sheet->setCellValue('B2', 'Albert');
    $sheet->setCellValue('C2', '5');
    $sheet->setCellValue('D2', '6');
    $sheet->setCellValue('E2', 'tetap/kontrak');
    $sheet->setCellValue('F2', 'yogyakarta');
    $sheet->setCellValue('G2', '2024-07-08 (thn-bln-tgl)');
    $sheet->setCellValue('H2', 'Jaran Kepang');
    $sheet->setCellValue('I2', 'Taurus');
    $sheet->setCellValue('J2', 'Pon');
    $sheet->setCellValue('K2', 'L');
    $sheet->setCellValue('L2', 'S1');
    $sheet->setCellValue('M2', 'S1 Perhutanan');
    $sheet->setCellValue('N2', 'AB');
    $sheet->setCellValue('O2', 'Islam');
    $sheet->setCellValue('P2', 'jalan xxx');
    $sheet->setCellValue('Q2', 'jalan xxx');
    $sheet->setCellValue('R2', '082323456');
    $sheet->setCellValue('S2', '347611330827');
    $sheet->setCellValue('T2', '347611330827');
    $sheet->setCellValue('U2', '347611330827');
    $sheet->setCellValue('V2', '347611330827');
    $sheet->setCellValue('W2', '(kosongkan jika tidak ada)');
    $sheet->setCellValue('X2', '2024-07-08 (thn-bln-tgl)');
    $sheet->setCellValue('Y2', '2024-07-08 (thn-bln-tgl)');
    $sheet->setCellValue('Z2', '12');
    $sheet->setCellValue('AA2', '12');
    $sheet->setCellValue('AB2', '0');
    $sheet->setCellValue('AC2', 'Email@gmail.com');
    $sheet->setCellValue('AD2', 'Tukini');
    $sheet->setCellValue('AE2', 'Tukini');
    $sheet->setCellValue('AF2', 'menikah/lajang');
    $sheet->setCellValue('AG2', 'Gudil Godel');
    $sheet->setCellValue('AH2', 'Gudil Godel');
    $sheet->setCellValue('AI2', 'albert');
    $sheet->setCellValue('AJ2', 'albert');
    $sheet->setCellValue('AK2', '8');

    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);
    $sheet->getColumnDimension('H')->setAutoSize(true);
    $sheet->getColumnDimension('I')->setAutoSize(true);
    $sheet->getColumnDimension('J')->setAutoSize(true);
    $sheet->getColumnDimension('K')->setAutoSize(true);
    $sheet->getColumnDimension('L')->setAutoSize(true);
    $sheet->getColumnDimension('M')->setAutoSize(true);
    $sheet->getColumnDimension('N')->setAutoSize(true);
    $sheet->getColumnDimension('O')->setAutoSize(true);
    $sheet->getColumnDimension('P')->setAutoSize(true);
    $sheet->getColumnDimension('Q')->setAutoSize(true);
    $sheet->getColumnDimension('R')->setAutoSize(true);
    $sheet->getColumnDimension('S')->setAutoSize(true);
    $sheet->getColumnDimension('T')->setAutoSize(true);
    $sheet->getColumnDimension('U')->setAutoSize(true);
    $sheet->getColumnDimension('V')->setAutoSize(true);
    $sheet->getColumnDimension('W')->setAutoSize(true);
    $sheet->getColumnDimension('X')->setAutoSize(true);
    $sheet->getColumnDimension('Y')->setAutoSize(true);
    $sheet->getColumnDimension('Z')->setAutoSize(true);
    $sheet->getColumnDimension('AA')->setAutoSize(true);
    $sheet->getColumnDimension('AB')->setAutoSize(true);
    $sheet->getColumnDimension('AC')->setAutoSize(true);
    $sheet->getColumnDimension('AD')->setAutoSize(true);
    $sheet->getColumnDimension('AE')->setAutoSize(true);
    $sheet->getColumnDimension('AF')->setAutoSize(true);
    $sheet->getColumnDimension('AG')->setAutoSize(true);
    $sheet->getColumnDimension('AH')->setAutoSize(true);
    $sheet->getColumnDimension('AJ')->setAutoSize(true);
    $sheet->getColumnDimension('AK')->setAutoSize(true);

    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
  }

  public function format_update_excel(){
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="format input data pegawai.xlsx"');
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'NIP');
    $sheet->setCellValue('B1', 'Durasi Kontrak');
    $sheet->setCellValue('C1', 'Kuota Cuti');

    
    
    $sheet->setCellValue('A2', '0001');
    $sheet->setCellValue('B2', '12');
    $sheet->setCellValue('C2', '12');

    
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    
    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
  }

  public function spreadsheet_update_import(){
    $upload_file=$_FILES['upload_file']['name'];
    $extension=pathinfo($upload_file,PATHINFO_EXTENSION);
    if($extension=='csv')
    {
      $reader= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else if($extension=='xls')
    {
      $reader= new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    } else
    {
      $reader= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
    $spreadsheet=$reader->load($_FILES['upload_file']['tmp_name']);
    $sheetdata=$spreadsheet->getActiveSheet()->toArray();
    $sheetcount=count($sheetdata);
    if($sheetcount>1)
    {
      $data=array();
      for ($i=1; $i < $sheetcount; $i++) {         
        $nip=$sheetdata[$i][0];
        $durasi_kontrak=$sheetdata[$i][1];
        $kuota_cuti=$sheetdata[$i][2];

        $data[]=array(
          'nip'=> $nip,
          'durasi_kontrak'=>$durasi_kontrak,
          'kuota_cuti'=>$kuota_cuti,
        );
      }
    
      $updatedata=$this->crud_model->update_batch('tbl_pegawai',$data,'nip');
      if($updatedata)
      {
        $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diinput');
      } else {
        $this->set_notifikasi_swal('danger','Gagal','Data Gagal Diinput');
      }
    
      redirect('Datapegawai');
    }
  }

  public function spreadsheet_import(){
    $upload_file=$_FILES['upload_file']['name'];
    $extension=pathinfo($upload_file,PATHINFO_EXTENSION);
    if($extension=='csv')
    {
      $reader= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else if($extension=='xls')
    {
      $reader= new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    } else
    {
      $reader= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
    $spreadsheet=$reader->load($_FILES['upload_file']['tmp_name']);
    $sheetdata=$spreadsheet->getActiveSheet()->toArray();
    $sheetcount=count($sheetdata);
    if($sheetcount>1)
    {
      $data=array();
      for ($i=1; $i < $sheetcount; $i++) {         
        $nip=sprintf("%04s", $sheetdata[$i][0]);
        $nama_pegawai=$sheetdata[$i][1];
        $jabatan_id=$sheetdata[$i][2];
        $divisi_id=$sheetdata[$i][3];
        $status_pegawai=$sheetdata[$i][4];
        $tempat_lahir=$sheetdata[$i][5];
        $tgl_lahir=$sheetdata[$i][6];
        $shio=$sheetdata[$i][7];
        $zodiak=$sheetdata[$i][8];
        $weton=$sheetdata[$i][9];
        $jenis_kelamin=$sheetdata[$i][10];
        $pendidikan_terakhir=$sheetdata[$i][11];
        $jurusan=$sheetdata[$i][12];
        $golongan_darah=$sheetdata[$i][13];
        $agama=$sheetdata[$i][14];
        $alamat_ktp=$sheetdata[$i][15];
        $alamat_domisili=$sheetdata[$i][16];
        $kontak_pegawai=$sheetdata[$i][17];
        $no_kk=$sheetdata[$i][18];
        $no_ktp=$sheetdata[$i][19];
        $no_jamsostek=$sheetdata[$i][20];
        $no_bpjsKesehatan=$sheetdata[$i][21];
        $no_npwp=$sheetdata[$i][22];
        $tgl_masuk=$sheetdata[$i][23];
        $tgl_selesai=$sheetdata[$i][24];
        $durasi_kontrak=$sheetdata[$i][25];
        $kuota_cuti=$sheetdata[$i][26];
        $sisa_cuti=$sheetdata[$i][27];
        $email_pegawai=$sheetdata[$i][28];
        $nama_ibu=$sheetdata[$i][29];
        $nama_ayah=$sheetdata[$i][30];
        $status_pernikahan=$sheetdata[$i][31];
        $nama_pasangan=$sheetdata[$i][32];
        $nama_anak=$sheetdata[$i][33];
        $username=$sheetdata[$i][34];
        $password=$sheetdata[$i][35];
        $role=$sheetdata[$i][36];

        $explodeWeton = explode(" ",$weton);

        switch ($explodeWeton[0]){
          case("Sunday"):
            $weton = "Minggu";
          break;
          case("Monday"):
            $weton = "Senin";
          break;
          case("Tuesday"):
            $weton = "Selasa";
          break;
          case("Wednesday"):
            $weton = "Rabu";
          break;
          case("Thursday"):
            $weton = "Kamis";
          break;
          case("Friday"):
            $weton = "Jumat";
          break;
          case("Saturday"):
            $weton = "Sabtu";
          break;
        }

        $data[]=array(
          'nip'=> $nip,
          'nama_pegawai'=>$nama_pegawai,
          'jabatan_id'=>$jabatan_id,
          'divisi_id'=>$divisi_id,
          'status_pegawai'=>$status_pegawai,
          'tempat_lahir'=>$tempat_lahir,
          'tgl_lahir'=>$tgl_lahir,
          'shio'=>$shio,
          'zodiak'=>$zodiak,
          'weton'=>$weton.' '.$explodeWeton[1],
          'jenis_kelamin'=>$jenis_kelamin,
          'pendidikan_terakhir'=>$pendidikan_terakhir,
          'jurusan'=>$jurusan,
          'golongan_darah'=>$golongan_darah,
          'agama'=>$agama,
          'alamat_ktp'=>$alamat_ktp,
          'alamat_domisili'=>$alamat_domisili,
          'kontak_pegawai'=>$kontak_pegawai,
          'no_kk'=>$no_kk,
          'no_ktp'=>$no_ktp,
          'no_jamsostek'=>$no_jamsostek,
          'no_bpjsKesehatan'=>$no_bpjsKesehatan,
          'no_npwp'=>$no_npwp,
          'tgl_masuk'=>$tgl_masuk,
          'tgl_selesai'=>$tgl_selesai,
          'durasi_kontrak'=>$durasi_kontrak,
          'kuota_cuti'=>$kuota_cuti,
          'sisa_cuti'=>$sisa_cuti,
          'email_pegawai'=>$email_pegawai,
          'nama_ibu'=>$nama_ibu,
          'status_pernikahan'=>$status_pernikahan,
          'nama_pasangan'=>$nama_pasangan,
          'nama_anak'=>$nama_anak,
        );

        $datauser[] = array(
          'username'=>$username,
          'password'=>getHashedPassword($password),
          'nip'=>$nip,
          'roleId'=>$role,
          'createdDtm'=>DATE('Y-m-d H:i:s'),
          'createdBy'=>1,
        );
      }

      $inserdata=$this->crud_model->save_batch('tbl_pegawai',$data);
      $inserdata=$this->crud_model->save_batch('tbl_users',$datauser);
      if($inserdata)
      {
        $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diinput');
      } else {
        $this->set_notifikasi_swal('danger','Gagal','Data Gagal Diinput');
      }

      redirect('Datapegawai');
    }
  }

  public function excel_pegawai(){
    $list_data = $this->pegawai_model->showData();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $style_col = [
      'font' => ['bold' => true], // Set font nya jadi bold
      'alignment' => [
      'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
      'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ],
      'borders' => [
          'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
          'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
          'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
          'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
      ]
    ];

    $styleRight = [
      'font' => [
        'bold' => true,
      ],
      'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
      ],
      'borders' => [
        'top' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
      ],
    ];
        

    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = [
      'alignment' => [
      'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ],
      'borders' => [
      'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
      'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
      'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
      'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
      ]
    ];

    $sheet->setCellValue('B2', 'Data Karyawan PT. Mirota KSM'); // Set kolom A1 Sebagai Header

    // $sheet->mergeCells('B2:E2'); // Set Merge Cell pada kolom A1 sampai E1
    
    $sheet->setCellValue('B5', 'No');
    $sheet->setCellValue('C5', 'NIK');
    $sheet->setCellValue('D5', 'No KTP');
    $sheet->setCellValue('E5', 'Nama Karyawan');
    $sheet->setCellValue('F5', 'Departement');
    $sheet->setCellValue('G5', 'Divisi');
    $sheet->setCellValue('H5', 'Tanggal Lahir');
    $sheet->setCellValue('I5', 'Agama');
    $sheet->setCellValue('J5', 'Alamat');
    $sheet->setCellValue('K5', 'Pendidikan');

    $sheet->getStyle('B5')->applyFromArray($style_col);
    $sheet->getStyle('C5')->applyFromArray($style_col);
    $sheet->getStyle('D5')->applyFromArray($style_col);
    $sheet->getStyle('E5')->applyFromArray($style_col);
    $sheet->getStyle('F5')->applyFromArray($style_col);
    $sheet->getStyle('G5')->applyFromArray($style_col);
    $sheet->getStyle('H5')->applyFromArray($style_col);
    $sheet->getStyle('I5')->applyFromArray($style_col);
    $sheet->getStyle('J5')->applyFromArray($style_col);
    $sheet->getStyle('K5')->applyFromArray($style_col);

    $no = 1;
    $numrow = 6;
    foreach ($list_data as $ld) {
      $sheet->setCellValue('B'.$numrow, $no);
      $sheet->setCellValue('C'.$numrow, 'MRT'.$ld->nip);
      $sheet->setCellValue('D'.$numrow, $ld->no_ktp);
      $sheet->setCellValue('E'.$numrow, $ld->nama_pegawai);
      $sheet->setCellValue('F'.$numrow, $ld->nama_departement);
      $sheet->setCellValue('G'.$numrow, $ld->nama_divisi);
      $sheet->setCellValue('H'.$numrow, $ld->tgl_lahir);
      $sheet->setCellValue('I'.$numrow, $ld->agama);
      $sheet->setCellValue('J'.$numrow, $ld->alamat_domisili);
      $sheet->setCellValue('K'.$numrow, $ld->pendidikan_terakhir.' '.$ld->jurusan);

      $sheet->getColumnDimension('C')->setAutoSize(true);
      $sheet->getColumnDimension('D')->setAutoSize(true);
      $sheet->getColumnDimension('E')->setAutoSize(true);
      $sheet->getColumnDimension('F')->setAutoSize(true);
      $sheet->getColumnDimension('G')->setAutoSize(true);
      $sheet->getColumnDimension('H')->setAutoSize(true);
      $sheet->getColumnDimension('I')->setAutoSize(true);
      $sheet->getColumnDimension('J')->setAutoSize(true);
      $sheet->getColumnDimension('K')->setAutoSize(true);
  
      $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('H'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('I'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('J'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('K'.$numrow)->applyFromArray($style_row);

      $no++;
      $numrow++;
    }

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');

    header('Content-Disposition: attactchment;filename= Data Karyawan PT Mirota KSM.xlsx');

    header('Cache-Control: max-age=0');
    $writer->save("php://output");
    exit();
  }

  public function excel_pegawai_nonAktif(){
    $list_data = $this->pegawai_model->showDataNonAktif();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $style_col = [
      'font' => ['bold' => true], // Set font nya jadi bold
      'alignment' => [
      'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
      'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ],
      'borders' => [
          'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
          'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
          'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
          'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
      ]
    ];

    $styleRight = [
      'font' => [
        'bold' => true,
      ],
      'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
      ],
      'borders' => [
        'top' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
      ],
    ];
        

    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = [
      'alignment' => [
      'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ],
      'borders' => [
      'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
      'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
      'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
      'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
      ]
    ];

    $sheet->setCellValue('B2', 'Data Karyawan PT. Mirota KSM'); // Set kolom A1 Sebagai Header

    // $sheet->mergeCells('B2:E2'); // Set Merge Cell pada kolom A1 sampai E1
    
    $sheet->setCellValue('B5', 'No');
    $sheet->setCellValue('C5', 'NIK');
    $sheet->setCellValue('D5', 'Nama Karyawan');
    $sheet->setCellValue('E5', 'Departement');
    $sheet->setCellValue('F5', 'Divisi');

    $sheet->getStyle('B5')->applyFromArray($style_col);
    $sheet->getStyle('C5')->applyFromArray($style_col);
    $sheet->getStyle('D5')->applyFromArray($style_col);
    $sheet->getStyle('E5')->applyFromArray($style_col);
    $sheet->getStyle('F5')->applyFromArray($style_col);

    $no = 1;
    $numrow = 6;
    foreach ($list_data as $ld) {
      $sheet->setCellValue('B'.$numrow, $no);
      $sheet->setCellValue('C'.$numrow, $ld->no_ktp);
      $sheet->setCellValue('D'.$numrow, $ld->nama_pegawai);
      $sheet->setCellValue('E'.$numrow, $ld->nama_departement);
      $sheet->setCellValue('F'.$numrow, $ld->nama_divisi);

      $sheet->getColumnDimension('C')->setAutoSize(true);
      $sheet->getColumnDimension('D')->setAutoSize(true);
      $sheet->getColumnDimension('E')->setAutoSize(true);
      $sheet->getColumnDimension('F')->setAutoSize(true);
  
      $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
      $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);

      $no++;
      $numrow++;
    }

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');

    header('Content-Disposition: attactchment;filename= Data Karyawan PT Mirota KSM.xlsx');

    header('Cache-Control: max-age=0');
    $writer->save("php://output");
    exit();
  }
  // END ADMIN AREA
}