<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class PerjalananDinas extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('crud_model');
    $this->load->model('perjalananDinas_model');
    $this->load->model('pegawai_model');

    $this->load->library('encryption');
    $isLoggedIn = $this->session->userdata ( 'isLoggedIn' );

    if ($isLoggedIn){
      $this->isLoggedIn();
    }
  }

  public function index(){
    $this->global['pageTitle'] = 'SMART OSD | Perjalanan Dinas';
    $this->global['pageHeader'] = 'Perizinan Perjalanan Dinas';

    $data['list_data']= $this->perjalananDinas_model->ShowAll();
    $data['pegawai']= $this->crud_model->lihatdata('tbl_pegawai');

    $this->loadViews("perjalananDinas/data", $this->global, $data, NULL);
  }

  public function detail(){
    $this->global['pageTitle'] = 'SMART OSD | Perjalanan Dinas';
    $this->global['pageHeader'] = 'Perizinan Perjalanan Dinas';

    $id = $this->uri->segment(2);
    $data['perdin'] = $this->perjalananDinas_model->ShowById($id);
    $data['list_data'] = $this->perjalananDinas_model->ShowDetail($id);

    $this->loadViews("perjalananDinas/detail", $this->global, $data, NULL);
  }

  public function save(){
    $pegawai_id = $this->input->post('pegawai_id');
    $tujuan = $this->input->post('tujuan');
    $pengikut_id = $this->input->post('pengikut_id');
    $tgl_berangkat = $this->input->post('tgl_berangkat');
    $tgl_kembali = $this->input->post('tgl_kembali');
    $alasan_perjalanan = $this->input->post('alasan_perjalanan');
    $nama_trainer = $this->input->post('nama_trainer');
    $tema_training = $this->input->post('tema_training');

    $data = array(
      'pegawai_id' => $pegawai_id,
      'tujuan' => $tujuan,
      'pengikut_id' => $pengikut_id,
      'tgl_berangkat' => $tgl_berangkat,
      'tgl_kembali' => $tgl_kembali,
      'alasan_perjalanan' => $alasan_perjalanan,
      'nama_trainer' => $nama_trainer,
      'tema_training' => $tema_training,
      'CreatedBy' => $this->vendorId,
      'DateCreated' => DATE('Y-m-d'),
    );

    $sql = $this->crud_model->input($data,'tbl_perdin');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');

    $maxid = $this->perjalananDinas_model->ShowMaxId($pegawai_id)->id_perdin;
  
    redirect('perjalanan-dinas/'.$maxid);
  }

  public function saveDetail(){
    $perdin_id = $this->input->post('perdin_id');
    $tanggal = $this->input->post('tanggal');
    $keterangan_perjalanan = $this->input->post('keterangan_perjalanan');
    $lokasi = $this->input->post('lokasi');
    $tujuan = $this->input->post('tujuan');

    $data = array(
      'perdin_id' => $perdin_id,
      'tanggal' => $tanggal,
      'keterangan_perjalanan' => $keterangan_perjalanan,
      'lokasi' => $lokasi,
      'tujuan' => $tujuan,
      'CreatedBy' => $this->vendorId,
      'DateCreated' => DATE('Y-m-d H:i:s'),
    );

    $sql = $this->crud_model->input($data,'tbl_perdindetail');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('perjalanan-dinas/'.$perdin_id);
  }

  public function save_signature()
  {
      $image = $this->input->post('signature');
      $image = str_replace('[removed]', '', $image);
      $image_base64 = base64_decode($image);
      $file_name = 'signature_' . time() . '.png';
      $file_path = FCPATH . 'assets/images/signature/' . $file_name;
      file_put_contents($file_path, $image_base64);
      echo "Berhasil disimpan : " . $file_name;
  }

  private function cropSignature($file_path)
  {
    $img = imagecreatefrompng($file_path);

    $width  = imagesx($img);
    $height = imagesy($img);

    $minX = $width;
    $minY = $height;
    $maxX = 0;
    $maxY = 0;

    for ($x = 0; $x < $width; $x++) {
        for ($y = 0; $y < $height; $y++) {

            $rgba = imagecolorat($img, $x, $y);
            $alpha = ($rgba & 0x7F000000) >> 24;

            // Jika pixel tidak transparan
            if ($alpha < 127) {

                $minX = min($minX, $x);
                $minY = min($minY, $y);

                $maxX = max($maxX, $x);
                $maxY = max($maxY, $y);
            }
        }
    }

    $cropWidth  = $maxX - $minX + 1;
    $cropHeight = $maxY - $minY + 1;

    $cropped = imagecrop($img, [
        'x' => $minX,
        'y' => $minY,
        'width' => $cropWidth,
        'height' => $cropHeight
    ]);

    if ($cropped !== FALSE) {

        imagesavealpha($cropped, true);
        imagepng($cropped, $file_path);
        imagedestroy($cropped);
    }

    imagedestroy($img);
  }

  public function cetak() {
    // Panggil library pdf yang sudah dibuat
    $this->load->library('Pdf');
    
    // Ambil data (opsional, jika Anda ingin mengirim data dari database ke view)
    $data['title'] = 'Data Laporan';
    
    // Load view dan simpan hasilnya ke dalam variabel $html
    $id = $this->uri->segment(3);

    $perdin = $this->perjalananDinas_model->ShowById($id);

    $data['list_data'] = $this->perjalananDinas_model->ShowDetail($id);
    $data['perdin'] = $perdin;

    $path = FCPATH . 'assets/dist/img/mirota.png';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data_img = file_get_contents($path);
    $data['logo_base64'] = 'data:image/' . $type . ';base64,' . base64_encode($data_img);
    
    if (isset($perdin->ttd_penerima)){
    $path_ttdPenerima = FCPATH . 'assets/images/signature/'.$perdin->ttd_penerima;
    $type_penerima = pathinfo($path_ttdPenerima, PATHINFO_EXTENSION);
    $data_ttdPenerima = file_get_contents($path_ttdPenerima);
    $data['ttd_penerima'] = 'data:image/' . $type_penerima . ';base64,' . base64_encode($data_ttdPenerima);
    }

    $html = $this->load->view("perjalananDinas/cetak", $data, True);
    
    // Jalankan fungsi generate PDF
    $this->pdf->generate($html, 'laporan_perjalanan_dinas');
  }




}