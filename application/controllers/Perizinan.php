 <?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Perizinan extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('crud_model');
    $this->load->model('perizinan_model');
    $this->load->model('izinHarian_model');
    $this->load->model('izin_model');
    $this->load->model('pegawai_model');

    $this->load->library('encryption');
    $isLoggedIn = $this->session->userdata ( 'isLoggedIn' );

    if ($isLoggedIn){
      $this->isLoggedIn();
    }
  }

  public function index(){
    $this->isLoggedIn();
    $this->global['pageTitle'] = 'SMART OSD | Perizinan Mirota KSM';
    $this->global['pageHeader'] = 'Perizinan Manual Karyawan ';

    $id_pegawai = $this->global ['pegawai_id'];
    $bagian_id = $this->bagian_id;
    $divisi_id = $this->crud_model->getdataRowbyWhere('*', ['id_bagian' => $bagian_id], 'tbl_bagian')->divisi_id;

    // $pengganti = $this->pegawai_model->getPegawaibyBagian($bagian_id, $id_pegawai);
    $pengganti = $this->pegawai_model->getPegawaibyDivisi($divisi_id, $id_pegawai);

    // var_dump($divisi_id);

    $data = array(
      'totalCuti' => $this->perizinan_model->HitungTotalCuti($id_pegawai),
      'kendaraan' => $this->crud_model->lihatdata('tbl_kendaraan'),
      'pegawai' => $this->crud_model->lihatdata('tbl_pegawai'),
      'sisaCuti' => $this->perizinan_model->cekKuotaCuti($id_pegawai),
      'list_cuti' => $this->perizinan_model->getDatabyPegawai($id_pegawai),
      'list_tugas' => $this->perizinan_model->getTugasbyPegawai($id_pegawai),
      'list_izinHarian' => $this->izinHarian_model->getDatabyPegawai($id_pegawai),
      'list_izin' => $this->izin_model->getDatabyPegawai($id_pegawai),
      'pengganti' => $pengganti,
      'approval_pengganti' => $this->perizinan_model->getDatabyPengganti($id_pegawai),
      'kuota_cuti' => $this->perizinan_model->cekKuotaCuti($id_pegawai)->kuota_cuti,
      'id_pegawai' => $id_pegawai
    );

    $this->loadViewsUser("perizinan/menu", $this->global, $data, NULL);
  }

  public function simpancuti(){
    $this->isLoggedIn();

    $id_pegawai = $this->global ['pegawai_id'];
    $role = $this->global ['role'];

    $cekKuotaCuti = $this->perizinan_model->cekKuotaCuti($id_pegawai);
    $kuota = $cekKuotaCuti->kuota_cuti;

    $pegawai = $this->pegawai_model->showDataRow(['id_pegawai' => $id_pegawai]);

    $config['upload_path']          = FCPATH.'assets/bukti_cuti/';
    $config['allowed_types']        = 'gif|jpg|png|webp|pdf';
  
    $this->load->library('upload', $config);
  
    if ( !$this->upload->do_upload('bukti_cuti'))
    {
      $jenis_cuti = $this->input->post('jenis_cuti');
      $tgl_mulai = $this->input->post('tgl_mulai');
      $tgl_akhir = $this->input->post('tgl_akhir');
      $keperluan = $this->input->post('keperluan');
      $pengganti = $this->input->post('pengganti');

      $data = array(
        'pegawai_id' => $id_pegawai,
        'jenis_cuti' => $jenis_cuti,
        'tgl_mulai' => $tgl_mulai,
        'tgl_akhir' => $tgl_akhir,
        'keperluan' => $keperluan,
        'pengganti' => $pengganti,
        'approval_id' => $pegawai->atasan1.','.$pegawai->atasan2,
        'datecreated' => DATE('Y-m-d H:i:s')
      );
    }
    else
    {
      $file = $this->upload->data();
      $bukti_cuti = $file['file_name'];
      $jenis_cuti = $this->input->post('jenis_cuti');
      $detail_cuti = $this->input->post('detail_cuti');
      $tgl_mulai = $this->input->post('tgl_mulai');
      $tgl_akhir = $this->input->post('tgl_akhir');
      $keperluan = $this->input->post('keperluan');
      $pengganti = $this->input->post('pengganti');

      $data = array(
        'pegawai_id' => $id_pegawai,
        'jenis_cuti' => $jenis_cuti,
        'detail_cuti' => $detail_cuti,
        'tgl_mulai' => $tgl_mulai,
        'tgl_akhir' => $tgl_akhir,
        'keperluan' => $keperluan,
        'pengganti' => $pengganti,
        'approval_id' => $pegawai->atasan1.','.$pegawai->atasan2,
        'bukti_cuti' => $bukti_cuti,
        'datecreated' => DATE('Y-m-d H:i:s')
      );
    }

    $d1 = date_create($tgl_mulai);
    $d2 = date_create($tgl_akhir);
    $interval = date_diff($d1, $d2);
    $durasi = $interval->days;

    if($durasi == 0){
      $durasi++;
    }

    switch ($jenis_cuti) {
      case 'tahunan':
        if($kuota != 0){
          if($durasi <= 7){
            $query = $this->crud_model->input($data, 'tbl_perizinan_cuti');
            $this->kurangikuota($id_pegawai, $durasi);

            $this->set_notifikasi_swal('success','Berhasil','Data Cuti Berhasil Diajukan');
          }else{
            $this->set_notifikasi_swal('error','Gagal','Pengajuan cuti tidak boleh lebih dari 7 hari');
          }
        }else{
          $this->set_notifikasi_swal('error','Kuota Cuti Habis','anda tidak bisa mengajukan cuti karena kuota cuti anda sudah habis');
        }
      break;
      
      default:
      $query = $this->crud_model->input($data, 'tbl_perizinan_cuti');

      if($query){
      $this->set_notifikasi_swal('success','Berhasil','Data Cuti Berhasil Diajukan');
      }else{
      $this->set_notifikasi_swal('danger','Gagal','Data Cuti Gagal Diajukan');
      }
      break;
    }

    redirect('perizinan');
  }

  public function kurangikuota($id, $cuti){
    $cekKuotaCuti = $this->perizinan_model->cekKuotaCuti($id);
    $kuota = $cekKuotaCuti->kuota_cuti;
    $sisa = $cekKuotaCuti->sisa_cuti;

    if($sisa != 0){
      $data = array(
        'sisa_cuti' => $sisa - $cuti,
      );
    }else{
      $data = array(
        'kuota_cuti' => $kuota - $cuti,
      );
    }

    $where = array(
      'id_pegawai' => $id,
    );

    $query = $this->crud_model->update($where, $data, 'tbl_pegawai');
  }

  public function form_approval(){
    $this->global['pageTitle'] = 'SMART OSD | Perizinan Mirota KSM';
    $this->global['pageHeader'] = 'Perizinan Manual Karyawan ';
    $page = $this->uri->segment(1);

    if($page == 'approval-cuti'){
    $page_approval = 'simpan-approval-user';
    }else{
    $page_approval = 'simpan-approval-admin';
    }

    $id_cuti = $this->input->get('d');
    $id_approval = $this->input->get('ap');

    $id_cuti = base64_decode(urldecode($id_cuti));
    $id_approval = base64_decode(urldecode($id_approval));

    // var_dump($cuti);

    $data = array(
      'cuti' => $this->perizinan_model->GetDataByWhere($id_cuti),
      'list_approval' => $this->perizinan_model->ListApprovalbyId($id_cuti),
      'approval' => $this->pegawai_model->showDataRow(['id_pegawai' => $id_approval]),
      'page_approval' => $page_approval
    );

    if($page == 'approval-cuti'){
    $this->loadViewsUser("perizinan/form_approval", $this->global, $data, NULL);
    }else{
    $this->loadViews("perizinan/form_approval", $this->global, $data, NULL);
    }
  }

  public function approvalCuti(){
    // $this->isLoggedIn();

    // $role = $this->global ['role'];
    $page_approval = $this->uri->segment(1);

    if($page_approval == 'simpan-approval-user'){
    $page = 'approval-cuti';
    }else{
    $page = 'approval-cuti-admin';
    }

    $id_cuti = $this->input->get('d');
    $id_approval = $this->input->get('ap');
    $status = $this->input->get('st');

    $id_cuti_decoder = base64_decode(urldecode($id_cuti));
    $id_approval_decoder = base64_decode(urldecode($id_approval));

    $list_cuti = $this->perizinan_model->GetDataByWhere($id_cuti_decoder);

    $approval = explode(",",$list_cuti->approval);
    
    $id_jabatan = $this->pegawai_model->getPegawaibyId($id_approval_decoder)->jabatan_id;


    switch ($id_jabatan){
      case(6):
        $approval[0] = $status;
      break;
      case(4):
      case(5):
        $approval[1] = $status;
      break;
      default:
        $approval[2] = $status;
      break;
    }

    $implodeApproval = implode(",",$approval);

    $data = array(
      'approval' => $implodeApproval
    );

    $where = array(
      'id_cuti' => $id_cuti_decoder
    );

    if($status == "T"){
      $id = $list_cuti->pegawai_id;
      $durasi = $list_cuti->selisih;
      $this->tambahKuota($id, $durasi);
    }

    $this->simpanapproval($id_approval_decoder, $id_cuti_decoder, $status);
    $this->crud_model->update($where, $data, 'tbl_perizinan_cuti');

    $cek_status = $this->perizinan_model->GetDataByWhere($id_cuti_decoder);

    if($cek_status->approval == 'Y,N,N' || $cek_status->approval == 'Y,Y,N'){
      $this->notif_wa($id_cuti_decoder);
    }

    $this->set_notifikasi_swal('success','Berhasil','Data Cuti Berhasil Disetujui');
    redirect($page.'?d='.$id_cuti.'&ap='.$id_approval);
  }

  public function simpanapproval($id_pegawai, $id_cuti, $status){
    $data = array(
      'cuti_id' => $id_cuti,
      'pegawai_id' => $id_pegawai,
      'status' => $status,
      'datecreated' => DATE('Y-m-d H:i:s')
    );
    
    $approval = $this->perizinan_model->cekApprovalbyPegawai($id_pegawai, $id_cuti);

    // var_dump($approval);

    if(is_null($approval)){
      $query = $this->crud_model->input($data, 'tbl_approval_cuti');
    }else{
      $where = array(
        'id_approval' => $approval->id_approval
      );

      $data = array(
        'status' => $status
      );

      $query = $this->crud_model->update($where, $data, 'tbl_approval_cuti');
    }
  }

  public function notif_wa($id_cuti){
    $list_cuti = $this->perizinan_model->GetDataByWhere($id_cuti);

    $nama_pemohon = $list_cuti->nama_pegawai;

    $approval = explode(",",$list_cuti->approval_id);

    if($list_cuti->approval == 'Y,N,N'){
        $id_approval = $approval[0];
    }else{
        $id_approval = $approval[1];
    }

    $approval = $this->pegawai_model->showDataRow(['id_pegawai' => $id_approval]);
    

    $encoder_cuti = urlencode(base64_encode($id_cuti));
    $encoder_approval = urlencode(base64_encode($id_approval));

    $link = base_url('approval-cuti?d='.$encoder_cuti.'&ap='.$encoder_approval);

    // $link = base_url();
    
    $message = "Ini adalah pesan notifikasi otomatis dari OSD.\n\n";
    $message .= "Halo *$approval->nama_pegawai*,";
    $message .="\n\n*$nama_pemohon* telah mengajukan cuti,\n";
    $message .="Silahkan lakukan approval melalui:\n";
    $message .= "\u{1F449} ".$link;

    // send_message($message, $approval->kontak_pegawai);
    send_message($message, $approval->kontak_pegawai);
  }

  public function declineCuti()
  {
    $input = json_decode($this->input->raw_input_stream, true);

    $id = $input['id'] ?? null;
    $keterangan = $input['keterangan'] ?? null;

    if (!$id || !$keterangan) {
      echo json_encode([
        'status' => 'error',
        'message' => 'Data tidak lengkap'
      ]);
      return;
    }

    $data = [
      'cuti_id' => $id,
      'status' => 'N',
      'keterangan' => $keterangan,
      'pegawai_id' => $this->pegawai_id,
      'datecreated' => date('Y-m-d H:i:s')
    ];

    $this->db->insert('tbl_approval_cuti', $data);

    $list_cuti = $this->perizinan_model->GetDataByWhere($id);
    $durasi = $list_cuti->selisih + 1;
    $pegawai = $list_cuti->pegawai_id;

    $this->tambahKuota($pegawai, $durasi);

    echo json_encode([
      'status' => 'success',
      'message' => 'Pengajuan berhasil di-decline'
    ]);
    return;
  }

  public function tambahKuota($id, $durasi){
    $pegawai = $this->pegawai_model->getPegawaibyId($id);
    $sisacuti = $pegawai->kuota_cuti;

    $cuti = $sisacuti + $durasi;

    $where = array(
      'id_pegawai' => $id
    );

    $data = array(
      'kuota_cuti' => $cuti
    );

    $this->crud_model->update($where, $data, 'tbl_pegawai');
  }

  function listApproval($id){
    $list_approval = $this->perizinan_model->ListApprovalbyId($id);

    echo json_encode($list_approval);
  }
  /*********** ADMIN PANEL *******************/

  public function listcuti(){
    $this->isLoggedIn();

    $this->global['pageTitle'] = 'SMART OSD | Data Cuti Tahunan/Khusus';
    $id = $this->global ['pegawai_id'];
    $role = $this->global ['role'];
    $jabatan_id = $this->global ['jabatan_id'];

    $encrypted = $this->encryption->encrypt($id);

    if ($role == ROLE_HRGA && $jabatan_id > 5 || $role == ROLE_POOL){
      $list_data = $this->perizinan_model->getData();
    }else{
      $list_data = $this->perizinan_model->getDatabyApproval($id);
    }


    $data = array(
      'list_cuti' =>  $list_data,
      'id_pegawai' =>  $id
    );

    $this->loadViews("perizinan/dataCuti", $this->global, $data, NULL);
  }

  function detailCuti($id){
    $this->isLoggedIn();
    $data = $this->perizinan_model->getDetailbyId($id);

    echo json_encode($data);
  }

  public function listPengajuanCuti(){
    $this->global['pageTitle'] = 'SMART OSD | Data Pengajuan Cuti Tahunan/Khusus';
    $id = $this->global ['pegawai_id'];
    $divisi_id = $this->divisi_id;

    $data = array(
      'pengganti' => $this->pegawai_model->getPegawaibyDivisi($divisi_id, $id),
      'list_cuti' => $this->perizinan_model->getDatabyPegawai($id),
      'kuota_cuti' => $this->perizinan_model->cekKuotaCuti($id)->kuota_cuti
    );

    $this->loadViews("perizinan/pengajuanCuti", $this->global, $data, NULL);
  }

  public function ApprovalPengganti(){
    $this->isLoggedIn();

    $this->global['pageTitle'] = 'SMART OSD | Approval Pengganti';
    $id = $this->global ['pegawai_id'];

    $data = array(
      'approval_pengganti' => $this->perizinan_model->getDatabyPengganti($id)
    );

    $this->loadViews("perizinan/approvalPengganti", $this->global, $data, NULL);
  }

}