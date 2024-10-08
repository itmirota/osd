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

  // ADMIN AREA
  public function listData(){
    $this->global['pageTitle'] = 'SMART OSD | Data Karyawan Mirota KSM';
    $this->global['pageHeader'] = 'Data Karyawan';

    $data = array(
      'list_data' => $this->pegawai_model->showData(),
      'departement' => $this->crud_model->lihatdata('tbl_departement'),
      'total_pegawai_aktif' => $this->pegawai_model->TotalPegawai('status','aktif'),
      'divisi' => $this->crud_model->lihatdata('tbl_divisi'),
      'jabatan' => $this->crud_model->lihatdata('tbl_jabatan'),
      'list_role' => $this->crud_model->GetDataById('roleId > 1','tbl_roles'),
      'maxNIP' => $this->pegawai_model->showMaxNIP()->nip
    );

    $this->loadViews("pegawai/data", $this->global, $data, NULL);
  }

  public function getPegawaiByDivisi($id){

    $where = array(
      'divisi_id' => $id
    );

    $pegawai = $this->crud_model->GetDataById($where,'tbl_pegawai');

    echo json_encode($pegawai);
  }

  public function listDataNonAktif(){
    $this->global['pageTitle'] = 'SMART OSD | Perizinan Mirota KSM';
    $this->global['pageHeader'] = 'Perizinan Manual Karyawan ';

    $data = array(
      'pegawai' => $this->pegawai_model->showData(),
      'list_data' => $this->pegawai_model->showDataNonAktif(),
      'total_pegawai_nonaktif' => $this->pegawai_model->TotalPegawai('status','tidak'),
      'divisi' => $this->crud_model->lihatdata('tbl_divisi'),
      'jabatan' => $this->crud_model->lihatdata('tbl_jabatan'),
      'list_role' => $this->crud_model->GetDataById('roleId > 1','tbl_roles'),
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

  public function shio($tanggal){
    $tahun = date('Y', strtotime($tanggal));

    $param1 = $tahun / 12;
    $hasil = round($param1,3);

    $pengurang = floor($param1);

    $hitung = $hasil - $pengurang;

    if ($hitung == 0){
      $shio = 0;
    }else{
      $shio = $hitung * 12;
      $shio = round($shio,0);
    }

    switch ($shio) {
      case 0:
        $shio = "Monyet";
        break;
      case 1:
        $shio = "Ayam";
        break;
      case 2:
        $shio = "Anjing";
        break;
      case 3:
        $shio = "Babi";
        break;
      case 4:
        $shio = "Tikus";
        break;
      case 5:
        $shio = "Sapi";
        break;
      case 6:
        $shio = "Harimau";
        break;
      case 7:
        $shio = "Kelinci";
        break;
      case 8:
        $shio = "Naga";
        break;
      case 9:
        $shio = "Ular";
        break;
      case 10:
        $shio = "Kuda";
        break;
      case 11:
        $shio = "Kambing";
        break;
    }

    return $shio;
  }

  public function zodiak($tgl_lahir){
    $tgl_lahir = date('m-d', strtotime($tgl_lahir));

    switch ($tgl_lahir) {
      case $tgl_lahir > "03-21" && $tgl_lahir < "04-19":
        $zodiak = "Aries";
        break;
      case $tgl_lahir > "04-20" && $tgl_lahir < "05-20":
        $zodiak = "Taurus";
        break;
      case $tgl_lahir > "05-21" && $tgl_lahir < "06-20":
        $zodiak = "Gemini";
        break;
      case $tgl_lahir > "06-21" && $tgl_lahir < "07-22":
        $zodiak = "Cancer";
        break;
      case $tgl_lahir > "07-23" && $tgl_lahir < "08-22":
        $zodiak = "Leo";
        break;
      case $tgl_lahir > "08-23" && $tgl_lahir < "09-22":
        $zodiak = "Virgo";
        break;
      case $tgl_lahir > "09-23" && $tgl_lahir < "10-22":
        $zodiak = "Libra";
        break;
      case $tgl_lahir > "10-23" && $tgl_lahir < "11-21":
        $zodiak = "Scorpio";
        break;
      case $tgl_lahir > "11-22" && $tgl_lahir < "12-21":
        $zodiak = "Sagitarius";
        break;
      case $tgl_lahir > "12-22" && $tgl_lahir < "01-19":
        $zodiak = "Capricorn";
        break;
      case $tgl_lahir > "01-20" && $tgl_lahir < "02-18":
        $zodiak = "Aquarius";
        break;
      case $tgl_lahir > "02-19" && $tgl_lahir < "03-20":
        $zodiak = "Pisces";
        break;
    }

    return $zodiak;
  }

  function intPart($floatNum) {
    return ($floatNum<-0.0000001 ? ceil($floatNum-0.0000001) : floor($floatNum+0.0000001));
  }

  public function hdate($day,$month,$year) {
    $julian = GregorianToJD($month, $day, $year);
    if ($julian >= 1937808 && $julian <= 536838867) {
      $date = cal_from_jd($julian, CAL_GREGORIAN);
      $d = $date['day'];
      $m = $date['month'] - 1;
      $y = $date['year'];
  
      $mPart = ($m-13)/12;
      $jd = $this->intPart((1461*($y+4800+$this->intPart($mPart)))/4)+
      $this->intPart((367*($m-1-12*($this->intPart($mPart))))/12)-
      $this->intPart((3*($this->intPart(($y+4900+$this->intPart($mPart))/100)))/4)+$d-32075;
  
      $l = $jd-1948440+10632;
      $n = $this->intPart(($l-1)/10631);
      $l = $l-10631*$n+354;
      $j = ($this->intPart((10985-$l)/5316))*($this->intPart((50*$l)/17719))+($this->intPart($l/5670))*($this->intPart((43*$l)/15238));
      $l = $l-($this->intPart((30-$j)/15))*($this->intPart((17719*$j)/50))-($this->intPart($j/16))*($this->intPart((15238*$j)/43))+29;
  
      $m = $this->intPart((24*$l)/709);
      $d = $l-$this->intPart((709*$m)/24);
      $y = 30*$n+$j-30;
      $yj = $y+512;
      $h = ($julian+3)%5;

      if($julian<=1948439) $y–;
  
      return array(
          'day' => $date['day'],
          'month' => $date['month'],
          'year' => $date['year'],
          'dow' => $date['dow'],
          'hijriday' => $d,
          'hijrimonth' => $m, 
          'hijriyear' => $y,
          'javayear' => $yj,
          'javadow' => $h
      );
    }
  }

  public function weton($date) {
    $imonth = Array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    $amonth = Array('Muharram','Safar','Rabi\'ul Awal','Rabi\'ul Akhir','Jumadil Awal','Jumadil Akhir','Rajab','Sya\'ban','Ramadhan','Syawal','Dzul Qa\'dah','Dzul Hijjah');
    $jmonth = Array('Suro','Sapar','Mulud','Ba\'da Mulud','Jumadil Awal','Jumadil Akhir','Rejeb','Ruwah','Poso','Syawal','Dulkaidah','Besar');
    $aday = Array('Al-Ahad','Al-Itsnayna','Ats-Tsalatsa',"Al-Arba'a","Al-Hamis","Al-Jum'a","As-Sabt");
    $iday = Array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
    $jday = Array('Pon','Wage','Kliwon','Legi','Pahing');
    $hari = ['Minggu' => 5,'Senin' => 4,'Selasa' => 3,'Rabu' => 7,'Kamis' => 8,'Jumat' => 6,'Sabtu' => 9];
    $pasaran = ['Legi' => 5,'Pahing' => 9,'Pon' => 7,'Wage' => 4,'Kliwon' => 8];

    $date = explode("-", $date);

    $date = $this->hdate($date[2], $date[1], $date[0]);
    
    // var_dump($date);

    $r['hari'] = $iday[$date['dow']];
    $r['pasaran'] = $jday[$date['javadow']];

    foreach ($hari as $key => $val) {
        if ($r['hari'] == $key) {
            $r['hari_val'] = $val;
            break;
        }
    }

    foreach ($pasaran as $key => $val) {
        if ($r['pasaran'] == $key) {
            $r['pasaran_val'] = $val;
            break;
        }
    }

    return $r['hari'].' '.$r['pasaran'];
  }

  public function save(){
    $nama_pegawai = $this->input->post('nama_pegawai');
    $nip = $this->input->post('nip');
    $jabatan_id = $this->input->post('jabatan_id');
    $divisi_id = $this->input->post('divisi_id');
    $status_pegawai = $this->input->post('status_pegawai'); 
    $tempat_lahir = $this->input->post('tempat_lahir');    
    $tgl_lahir = $this->input->post('tgl_lahir');    
    $shio = $this->shio($tgl_lahir);    
    $zodiak = $this->zodiak($tgl_lahir);    
    $weton = $this->weton($tgl_lahir);    
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
    $durasi_kontrak = $this->input->post('durasi_kontrak');
    $email_pegawai = $this->input->post('email_pegawai');  
    $status_pernikahan = $this->input->post('status_pernikahan');    
    $nama_ibu = $this->input->post('nama_ibu');    
    $nama_ayah = $this->input->post('nama_ayah');    
    $nama_pasangan = $this->input->post('nama_pasangan'); 
    $nama_anak = $this->input->post('nama_anak');    
  

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

    $data = array(
      'tgl_keluar' => $tgl_keluar,
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
    $shio = $this->input->post('shio');    
    $zodiak = $this->input->post('zodiak');    
    $weton = $this->input->post('weton');    
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
  // END ADMIN AREA
}