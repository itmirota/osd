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

class Assessment extends BaseController
{

  public function __construct()
  {
      parent::__construct();
      $this->load->model('crud_model');
      $this->load->model('assessment_model');
      $this->isLoggedIn();
  }

  public function index(){
    $this->global['pageTitle'] = 'Assessment';
    $this->global['pageHeader'] = 'Assessment Karyawan ';
    $pegawai_id = $this->global['pegawai_id'];
    $role = $this->global['role'];

    $data['list_data']= $this->assessment_model->getAssessment($pegawai_id);
    $data['role'] = $role;

    $this->loadViews("assessment/data", $this->global, $data, NULL);
  }

  public function save(){
    $pegawai_id = $this->input->post('pegawai_id');
    $tgl_assessment = $this->input->post('tgl_assessment');
    $nilai = $this->input->post('nilai');
    $keterangan = $this->input->post('keterangan');

    $data = array(
      'pegawai_id' => $pegawai_id,
      'tgl_assessment' => $tgl_assessment,
      'nilai' => $nilai,
      'keterangan' => $keterangan,
    );

    $sql = $this->crud_model->input($data,'tbl_assessment');

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('assessment');
  }

  public function detailAssessment($id) {

    $where = array(
      'id_assessment' => $id
    );

    $assessment = $this->crud_model->GetDataByWhere($where,'tbl_assessment');
    
    $data = array(
      'assessment' => $assessment[0]
    );

    echo json_encode($data);
  }

  public function update(){
    $id_assessment = $this->input->post('id_assessment');
    $pegawai_id = $this->input->post('pegawai_id');
    $tgl_assessment = $this->input->post('tgl_assessment');
    $nilai = $this->input->post('nilai');
    $keterangan = $this->input->post('keterangan');

    $where = array(
      'id_assessment' => $id_assessment
    );

    $data = array(
      'pegawai_id' => $pegawai_id,
      'tgl_assessment' => $tgl_assessment,
      'nilai' => $nilai,
      'keterangan' => $keterangan,
    );

    $sql = $this->crud_model->update($where, $data,'tbl_assessment');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diubah');
    redirect('assessment');
  }

  public function delete($id){
    $where = array(
      'id_assessment' => $id
    );

    $this->crud_model->delete($where, 'tbl_assessment');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('assessment');
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
        $pegawai_id=$sheetdata[$i][0];
        $penilai_id=$sheetdata[$i][1];
        $assessment_tingkat_id=$sheetdata[$i][2];


        $data[]=array(
          'pegawai_id'=> $pegawai_id,
          'penilai_id'=>$penilai_id,
          'assessment_tingkatan_id'=>$assessment_tingkat_id,
        );
      }

      $inserdata=$this->crud_model->save_batch('tbl_assessment',$data);
      if($inserdata)
      {
        $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diinput');
      } else {
        $this->set_notifikasi_swal('danger','Gagal','Data Gagal Diinput');
      }

      redirect('assessment');
    }
  }

  public function list_soal(){
    $this->global['pageTitle'] = 'Assessment';
    $pegawai_id = $this->global['pegawai_id'];
    $role = $this->global['role'];

    $data['list_data']= $this->crud_model->lihatdata('tbl_assessment_soal');

    $this->loadViews("assessment/list_soal", $this->global, $data, NULL);
  }

  public function save_soal(){
    $jenis_soal = $this->input->post('jenis_soal');
    $kategori = $this->input->post('kategori');
    $soal = $this->input->post('soal');

    $data = array(
      'jenis_soal' => $jenis_soal,
      'kategori' => $kategori,
      'soal' => $soal,
    );

    $sql = $this->crud_model->input($data,'tbl_assessment_soal');

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('assessment/list_soal');
  }

  public function penilaian($id){
    $this->global['pageTitle'] = 'Assessment';

    $data['soal_value'] = $this->assessment_model->getSoal();
    $data['kategori'] = $this->assessment_model->getKategori()->result();
    $data['id_pegawai'] = $id;
    $data['pegawai'] =$this->crud_model->getdataRowbyWhere('nama_pegawai', 'id_pegawai ='.$id ,'tbl_pegawai');

    $this->loadViews("assessment/penilaian", $this->global, $data, NULL);
  }

  public function save_penilaian($id){
    $penilai_id = $this->global['pegawai_id'];
  
    $jml_kategori = $this->assessment_model->getKategori()->num_rows();
    $kategori = $this->assessment_model->getKategori()->result();

    for ($i=0; $i < $jml_kategori  ; $i++) { 
      $soal[$i] = $this->assessment_model->getSoalWhere(['kategori' => $kategori[$i]->kategori])->result();
      $count_soal[$i] = $this->assessment_model->getSoalWhere(['kategori' => $kategori[$i]->kategori])->num_rows();
      
      for ($j=0; $j < $count_soal[$i] ; $j++) { 
        $jawaban[$i][$j] = $this->input->post('jawaban_'.$soal[$i][$j]->id_assessment_soal);
        $jawaban[$i][$j] = $soal[$i][$j]->id_assessment_soal.':'.$jawaban[$i][$j];
      }

      $hasil[$i] = implode(',', $jawaban[$i]);
    }

    $jawaban = implode(',', $hasil);
    $data = array(
      'pegawai_id' => $id,
      'nilai' => $jawaban,
      'penilai_id' => $penilai_id,
      'tgl_assessment' => date('Y-m-d H:i:s')
    );

    $where = array (
      'pegawai_id' => $id,
      'penilai_id' => $penilai_id
    );
 

    $this->crud_model->update($where, $data, 'tbl_assessment');

    $this->set_notifikasi_swal('success','Berhasil','Penilaian Berhasil Disimpan');
    redirect('assessment');
  }

  public function hasilAssessment($id){
    $this->global['pageTitle'] = 'Assessment';

    $hasil = $this->assessment_model->getHasilAssessment($id);
    $explode_hasil = explode(',',$hasil->nilai);

    $data['explode_hasil'] = $explode_hasil;
    $data['hasil'] = $hasil;

    $this->loadViews("assessment/hasil", $this->global, $data, NULL);
  }
}