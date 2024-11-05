<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Ruangan extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $name = $this->session->userdata ( 'name' );

      $this->load->model('user_model');
      $this->load->model('crud_model');
      $this->load->model('master_model');
    
      if(isset($name)){
      $this->isLoggedIn();
      }
  }

  // ADMIN PANEL
  public function index(){
    $this->global['pageTitle'] = 'Admin Panel : Dashboard';
      
    $data['list_data']= $this->crud_model->lihatdata('tbl_ruangan');

    $this->loadViews("ruangan/data", $this->global, $data, NULL);
  }

  public function saveRuangan(){
    $cekMaxId = $this->crud_model->cekMaxId('id_ruangan', 'tbl_ruangan');
    $id = $cekMaxId+1;
    $kode = 'ruangan';

    $nama_ruangan = $this->input->post('nama_ruangan');
    $kondisi_ruangan = $this->input->post('kondisi_ruangan');
    $keterangan_ruangan = $this->input->post('keterangan_ruangan');
    $userId = $this->uri->segment(3);
    $image_name = $this->generateBarcode($kode, $id);


    $data = array(
      'id_ruangan' => $id,
      'nama_ruangan' => $nama_ruangan,
      'kondisi_ruangan' => $kondisi_ruangan,
      'keterangan_ruangan' => $keterangan_ruangan,
      'qrcode_ruangan' => $image_name,
      'userId' => $userId
    );

    $sql = $this->crud_model->input($data,'tbl_ruangan');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('ruangan');
  }

  public function detailruangan($id) {
    $this->isLoggedIn();   

    $where = array(
      'id_ruangan' => $id
    );

    $ruangan = $this->crud_model->GetDataByWhere($where,'tbl_ruangan');
    echo json_encode($ruangan[0]);
  }

  public function update(){

    $id_ruangan = $this->input->post('id_ruangan');
    $nama_ruangan = $this->input->post('nama_ruangan');
    $kondisi_ruangan = $this->input->post('kondisi_ruangan');
    $keterangan_ruangan = $this->input->post('keterangan_ruangan');

    $where = array(
      'id_ruangan' => $id_ruangan
    );

    $data = array(
      'nama_ruangan' => $nama_ruangan,
      'kondisi_ruangan' => $kondisi_ruangan,
      'keterangan_ruangan' => $keterangan_ruangan
    );

    $sql = $this->crud_model->update($where, $data,'tbl_ruangan');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diubah');
    redirect('Ruangan');
  }

  public function delete(){
    $id_ruangan = $this->uri->segment(2);

    $where = array(
      'id_ruangan' => $id_ruangan
    );

    $this->crud_model->delete($where, 'tbl_ruangan');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('Ruangan');
  }

  public function jadwalpinjam(){
    $list_data  = $this->master_model->getjadwalruangan();

    foreach ($list_data->result_array() as $row){

        $data[] = array(
            'id' => $row['id_pinjam_ruangan'],
            'title' => $row['nama_ruangan'].' | '.$row['keterangan_pinjam'].' | '.$row['nama_pinjam_ruangan'].' '.$row['nama_divisi'],
            'start' => $row['tgl_mulai'],
            'end' => $row['tgl_selesai']
        );
    }
    
    echo json_encode($data);
  }

  public function pinjamruangan(){
    $this->global['pageTitle'] = 'SMART OSD | PT Mirota KSM';
    $data['list_data'] = $this->master_model->getjadwalruangan()->result();
    $data['ruangan']= $this->crud_model->lihatdata('tbl_ruangan');
    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');

    $this->global['pageHeader'] = 'Peminjaman Ruangan PT. Mirota KSM';

    $loginType = $this->session->userdata('loginType');
    if($loginType == 'user'){
      $this->loadViewsUser("ruangan/datapeminjaman", $this->global, $data, NULL);
    }else{
      $this->loadViews("ruangan/datapeminjaman", $this->global, $data, NULL);
    }
  }

  public function booking(){
    $this->load->library('form_validation');

    
            
    $this->form_validation->set_rules('ruangan_id','Ruangan','trim|required|numeric');
    if($this->form_validation->run() == FALSE)
    {
      $this->set_notifikasi_swal('error','GAGAL !!!','Data Divisi/Ruangan Tidak Boleh Kosong');
      redirect('Pinjamruangan');
    }
    else
    {
    $ruangan_id = $this->input->post('ruangan_id');
    $nama_peminjam = $this->input->post('nama_peminjam');
    $divisi_id = $this->input->post('divisi_id');
    $tgl_mulai = $this->input->post('tgl_mulai');
    $tgl_selesai = $this->input->post('tgl_selesai');
    $keterangan_pinjam = $this->input->post('keterangan_pinjam');

    if(is_null($nama_peminjam)){
      $nama_peminjam = $this->global['name'];
      $divisi_id = $this->global['divisi_id'];
    }

    $data = array(
      'ruangan_id' => $ruangan_id,
      'nama_pinjam_ruangan' => $nama_peminjam,
      'divisi_id' => $divisi_id,
      'tgl_mulai' => $tgl_mulai,
      'tgl_selesai' => $tgl_selesai,
      'keterangan_pinjam' => $keterangan_pinjam
    );

    $sql = $this->crud_model->input($data,'tbl_pinjam_ruangan');

    if(is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('Pinjamruangan');
  }
  }

  public function deletePinjam(){
    $id_pinjam_ruangan = $this->uri->segment(2);

    $where = array(
      'id_pinjam_ruangan' => $id_pinjam_ruangan
    );

    $this->crud_model->delete($where, 'tbl_pinjam_ruangan');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('Pinjamruangan');
  }

  public function laporankerusakan(){
    $this->global['pageTitle'] = 'SMART OSD | Asset Mirota';
      
    $this->global['pageHeader'] = 'Laporan Kerusakan Ruangan';

    $data['ruangan']= $this->crud_model->lihatdata('tbl_ruangan');
    
    if($this->global['role'] == ROLE_STAFF){
      $this->loadViewsUser("ruangan/formlaporan", $this->global, $data, NULL);
    }else{
      $this->loadViews("ruangan/formlaporan", $this->global, $data, NULL);
    }
  }

  public function savelaporan(){
    $config['upload_path']          = FCPATH.'assets/foto_kerusakan_ruangan';
    $config['allowed_types']        = 'gif|jpg|png|PNG|jpeg|pdf';

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('bukti_kerusakan'))
    {
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }
    else
    {
      $file = $this->upload->data();
      $bukti_kerusakan = $file['file_name'];

      $ruangan_id = $this->input->post('ruangan_id');
      $keterangan_kerusakan_ruangan = $this->input->post('keterangan');

      $data = array(
        'ruangan_id' => $ruangan_id,
        'keterangan_kerusakan_ruangan' => $keterangan_kerusakan_ruangan,
        'bukti_kerusakan_ruangan' => $bukti_kerusakan,
        'datecreated' => date('Y-m-d H:i:s')
      );

      $this->crud_model->input($data,'tbl_kerusakan_ruangan');
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }

    redirect('ruangan/laporankerusakan');
  }

  public function listkerusakan(){
    $this->global['pageTitle'] = 'SMART OSD | Asset Mirota';
    $this->global['pageHeader'] = 'Laporan Kerusakan ruangan';

    $data['list_data']= $this->master_model->getLaporanKerusakanruangan();

    $this->loadViews("ruangan/laporanKerusakan", $this->global, $data, NULL);
  }

  public function listpenanganan($id){
    $this->isLoggedIn();   

    $where = array(
      'kerusakan_ruangan_id' => $id
    );

    $penangananruangan = $this->master_model->getPenangananById($where,'tbl_penanganan_ruangan');
    echo json_encode($penangananruangan);
  }

  public function penangananKerusakan(){
    $id = $this->input->post('kerusakan_ruangan_id');
    $tgl_penanganan = $this->input->post('tgl_penanganan');
    $status = $this->input->post('status');
    $keterangan_penanganan = $this->input->post('keterangan_penanganan');

    $where = array(
      'id_kerusakan_ruangan' => $id
    );

    $datastatus = array(
      'status' => $status,
    );

    $penanganan = array(
      'kerusakan_ruangan_id' => $id,
      'tgl_penanganan' => $tgl_penanganan,
      'keterangan_penanganan' => $keterangan_penanganan,
      'status' => $status
    );

    $this->crud_model->update($where,$datastatus,'tbl_kerusakan_ruangan');
    $this->crud_model->input($penanganan,'tbl_penanganan_ruangan');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('kerusakanRuangan');
  }

  public function detailkerusakanruangan($id) {
    $this->isLoggedIn();   

    $where = array(
      'id_kerusakan_ruangan' => $id
    );

    $ruangan = $this->crud_model->GetDataByWhere($where,'tbl_kerusakan_ruangan');
    echo json_encode($ruangan[0]);
  }

  public function bacanotif(){
    $notif = $this->master_model->cekDataNotif('id_kerusakan_ruangan', 'tbl_kerusakan_ruangan');

    foreach ($notif as $n) {
      $data = array(
        'is_read' => 1,
      );

      $where = array(
        'id_kerusakan_ruangan' => $n->id_kerusakan_ruangan
      );

      $this->crud_model->update($where, $data, 'tbl_kerusakan_ruangan');
    }
  }

  public function approvalkerusakan(){
    $id = $this->input->post('id_kerusakan_ruangan');
    $status = $this->input->post('status');
    $tgl_penanganan = DATE('Y-m-d');

    $where = array(
      'id_kerusakan_ruangan' => $id
    );

    $data = array(
      'status' => $status,
    );

    $penanganan = array(
      'kerusakan_ruangan_id' => $id,
      'tgl_penanganan' => $tgl_penanganan,
      'status' => $status
    );

    $this->crud_model->update($where,$data,'tbl_kerusakan_ruangan');
    $this->crud_model->input($penanganan,'tbl_penanganan_ruangan');
    echo json_encode($data);
  }

  public function kebersihanruangan(){
    $id = $this->input->post('id_kebersihan_ruangan');
    $bukti_sebelum = $this->input->post('bukti_sebelum');
    $bukti_setelah = $this->input->post('bukti_setelah');
    $datecreated = DATE('Y-m-d');

    $where = array(
      'id_kerusakan_ruangan' => $id
    );

    $data = array(
      'status' => $status,
    );

    $penanganan = array(
      'kerusakan_ruangan_id' => $id,
      'tgl_penanganan' => $tgl_penanganan,
      'status' => $status
    );

    $this->crud_model->update($where,$data,'tbl_kerusakan_ruangan');
    $this->crud_model->input($penanganan,'tbl_penanganan_ruangan');
  }
}