<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class DataAccurate extends BaseController
{
  public function __construct()
  {
      parent::__construct();
      $this->load->model('crud_model');
      $this->load->model('dataAccurate_model');
      $this->isLoggedIn();
  }

  // DATA SUPPIER

  public function DataSupplier(){
    $id = $this->pegawai_id;
    $role = $this->role;
$bagian_id = $this->bagian_id;

    $this->global['pageTitle'] = 'Admin Panel : Data Suppier';

    if($role == ROLE_SUPERADMIN || ($role == ROLE_ADMIN && $bagian_id == ACCOUNTING)){
      $data['list_data']= $this->dataAccurate_model->GetDataSuppierAll();
    }else{
      $data['list_data']= $this->dataAccurate_model->GetDataSuppierWhere(['userinput_id'=> $id]);
    }

    $this->loadViews("accurate/data_supplier", $this->global, $data, NULL);
  }

  public function getDokumenSupplier($id){
    $dokumen = $this->dataAccurate_model->GetDocumentSuppier($id);

    echo json_encode($dokumen);
  }

  public function saveSuppier(){
    $nama_vendor = $this->input->post('nama_vendor');
    $no_rekening = $this->input->post('no_rekening');
    $no_npwp = $this->input->post('no_npwp');
    $status_pajak = $this->input->post('status_pajak');
    $userinput_id = $this->pegawai_id;


    $config['upload_path']          = FCPATH.'assets/dokumen_supplier/';
    $config['allowed_types']        = 'pdf';
  
    $this->load->library('upload', $config);
  
    if ( !$this->upload->do_upload('dokumen'))
    {
      $this->set_notifikasi_swal('error','GAGAL !!','Dokumen tidak boleh kosong');
      redirect('data-supplier');
    }
    else
    {

    $file = $this->upload->data();
    $dokumen = $file['file_name'];

    $data = array (
      'nama_vendor' => $nama_vendor,
      'no_rekening' => $no_rekening,
      'no_npwp' => $no_npwp,
      'dokumen' => $dokumen,
      'status_pajak' => $status_pajak,
      'userinput_id' => $userinput_id,
      'datecreated' => DATE('Y-m-d H:i:s')
    );

    $sql = $this->crud_model->input($data,'tbl_accurate_supplier');
    $this->set_notifikasi_swal('success','Berhasil','Suppier Baru Berhasil Ditambahkan');
    redirect('data-supplier');
    }
  }

  public function UpdateProsesSupplier(){
    $pegawai_id = $this->pegawai_id;

    $input = json_decode($this->input->raw_input_stream, true);
    $id    = $input['id'];

    if (!$id) {
      echo json_encode(["status" => "error", "msg" => "Data tidak lengkap"]);
      return;
    }

    $data = [
      "userprocess_id"      => $pegawai_id,
      "dateprocess"     => DATE('Y-m-d H:i:s'),
    ];

    $this->crud_model->update(["id_supplier" => $id], $data, "tbl_accurate_supplier");

    echo json_encode(["status" => "success", "message" => "data berhasil disimpan"]);
    return;
  }

  // END DATA SUPPIER

  // DATA CUSTOMER
  public function DataCustomer(){
    $id = $this->pegawai_id;
    $role = $this->role;
$bagian_id = $this->bagian_id;

    $this->global['pageTitle'] = 'Admin Panel : Data Customer';

    if($role == ROLE_SUPERADMIN || ($role == ROLE_ADMIN && $bagian_id == ACCOUNTING)){
      $data['list_data']= $this->dataAccurate_model->GetDataCustomerAll();
    }else{
      $data['list_data']= $this->dataAccurate_model->GetDataCustomerWhere(['userinput_id'=> $id]);
    }

    $this->loadViews("accurate/data_customer", $this->global, $data, NULL);
  }

  public function saveCustomer(){
    $nama_customer = $this->input->post('nama_customer');
    $kontak = $this->input->post('kontak');
    $email = $this->input->post('email');
    $alamat = $this->input->post('alamat');
    $kategori = $this->input->post('kategori');
    $tipe_pembayaran = $this->input->post('tipe_pembayaran');

    $userinput_id = $this->pegawai_id;


    $data = array (
      'nama_customer' => $nama_customer,
      'kontak' => $kontak,
      'email' => $email,
      'alamat' => $alamat,
      'kategori' => $kategori,
      'tipe_pembayaran' => $tipe_pembayaran,
      'userinput_id' => $userinput_id,
      'datecreated' => DATE('Y-m-d H:i:s')
    );

    $sql = $this->crud_model->input($data,'tbl_accurate_customer');
    $this->set_notifikasi_swal('success','Berhasil','Customer Baru Berhasil Ditambahkan');
    redirect('data-customer');
  }

  public function UpdateProsesCustomer(){
    $pegawai_id = $this->pegawai_id;

    $input = json_decode($this->input->raw_input_stream, true);
    $id    = $input['id'];

    if (!$id) {
      echo json_encode(["status" => "error", "msg" => "Data tidak lengkap"]);
      return;
    }

    $data = [
      "userprocess_id"      => $pegawai_id,
      "dateprocess"     => DATE('Y-m-d H:i:s'),
    ];

    $this->crud_model->update(["id_customer" => $id], $data, "tbl_accurate_customer");

    echo json_encode(["status" => "success", "message" => "data berhasil disimpan"]);
    return;
  }

  // END DATA CUSTOMER


  // DATA BARANG JASA
  public function DataBarangJasa(){
    $id = $this->pegawai_id;
    $role = $this->role;
$bagian_id = $this->bagian_id;

    $this->global['pageTitle'] = 'Admin Panel : Data Barang & Jasa';

    if($role == ROLE_SUPERADMIN || ($role == ROLE_ADMIN && $bagian_id == ACCOUNTING)){
      $data['list_data']= $this->dataAccurate_model->GetDataBarangJasaAll();
    }else{
      $data['list_data']= $this->dataAccurate_model->GetDataBarangJasaWhere(['userinput_id'=> $id]);
    }

    $this->loadViews("accurate/data_barangjasa", $this->global, $data, NULL);
  }

  public function saveBarangJasa(){
    $nama_barang = $this->input->post('nama_barang');
    $kategori_barang = $this->input->post('kategori_barang');
    $satuan_1 = $this->input->post('satuan_1');
    $satuan_2 = $this->input->post('satuan_2');
    $satuan_3 = $this->input->post('satuan_3');

    $userinput_id = $this->pegawai_id;


    $data = array (
      'nama_barang' => $nama_barang,
      'kategori_barang' => $kategori_barang,
      'satuan_1' => $satuan_1,
      'satuan_2' => $satuan_2,
      'satuan_3' => $satuan_3,
      'userinput_id' => $userinput_id,
      'datecreated' => DATE('Y-m-d H:i:s')
    );

    $sql = $this->crud_model->input($data,'tbl_accurate_barangjasa');
    $this->set_notifikasi_swal('success','Berhasil','Barang & Jasa Baru Berhasil Ditambahkan');
    redirect('data-barangjasa');
  }

  public function UpdateProsesBarangjasa(){
    $pegawai_id = $this->pegawai_id;

    $input = json_decode($this->input->raw_input_stream, true);
    $id    = $input['id'];

    if (!$id) {
      echo json_encode(["status" => "error", "msg" => "Data tidak lengkap"]);
      return;
    }

    $data = [
      "userprocess_id"      => $pegawai_id,
      "dateprocess"     => DATE('Y-m-d H:i:s'),
    ];

    $this->crud_model->update(["id_barangjasa" => $id], $data, "tbl_accurate_barangjasa");

    echo json_encode(["status" => "success", "message" => "data berhasil disimpan"]);
    return;
  }
  // END DATA BARANG JASA

  // DATA PENGHAPUSAN
  public function DataPenghapusan(){
    $id = $this->pegawai_id;
    $role = $this->role;
$bagian_id = $this->bagian_id;

    $this->global['pageTitle'] = 'Admin Panel : Data Penghapusan';

    if($role == ROLE_SUPERADMIN || ($role == ROLE_ADMIN && $bagian_id == ACCOUNTING)){
      $data['list_data']= $this->dataAccurate_model->GetDataPenghapusanAll();
    }else{
      $data['list_data']= $this->dataAccurate_model->GetDataPenghapusanWhere(['userinput_id'=> $id]);
    }

    $this->loadViews("accurate/data_penghapusan", $this->global, $data, NULL);
  }

  public function savePenghapusan(){
    $nomor_dokumen = $this->input->post('no_dokumen');
    $alasan = $this->input->post('alasan');

    $userinput_id = $this->pegawai_id;


    $data = array (
      'nomor_dokumen' => $nomor_dokumen,
      'alasan' => $alasan,
      'userinput_id' => $userinput_id,
      'datecreated' => DATE('Y-m-d H:i:s')
    );

    $sql = $this->crud_model->input($data,'tbl_accurate_penghapusan');
    $this->set_notifikasi_swal('success','Berhasil','Penghapusan data Berhasil Ditambahkan');
    redirect('data-penghapusan');
  }

  public function UpdateProsesPenghapusan(){
    $pegawai_id = $this->pegawai_id;

    $input = json_decode($this->input->raw_input_stream, true);
    $id    = $input['id'];

    if (!$id) {
      echo json_encode(["status" => "error", "msg" => "Data tidak lengkap"]);
      return;
    }

    $data = [
      "userprocess_id"      => $pegawai_id,
      "dateprocess"     => DATE('Y-m-d H:i:s'),
    ];

    $this->crud_model->update(["id_penghapusan" => $id], $data, "tbl_accurate_penghapusan");

    echo json_encode(["status" => "success", "message" => "data berhasil disimpan"]);
    return;
  }
  // END DATA PENGHAPUSAN

  // DATA  PENYESUAIAN HARGA
  public function DataPenyesuaianharga(){
    $id = $this->pegawai_id;
    $role = $this->role;
$bagian_id = $this->bagian_id;

    $this->global['pageTitle'] = 'Admin Panel : Data Penyesuaian Harga';

    if($role == ROLE_SUPERADMIN || ($role == ROLE_ADMIN && $bagian_id == ACCOUNTING)){
      $data['list_data']= $this->dataAccurate_model->GetDataPenyesuaianhargaAll();
    }else{
      $data['list_data']= $this->dataAccurate_model->GetDataPenyesuaianhargaWhere(['userinput_id'=> $id]);
    }

    $this->loadViews("accurate/data_penyesuaianharga", $this->global, $data, NULL);
  }

  public function savePenyesuaianharga(){
    $nama_barang = $this->input->post('nama_barang');
    $harga_baru = $this->input->post('harga_baru');
    $mulai_berlaku = $this->input->post('mulai_berlaku');
    $userinput_id = $this->pegawai_id;


    $config['upload_path']          = FCPATH.'assets/dokumen_penyesuaianharga/';
    $config['allowed_types']        = 'pdf';
  
    $this->load->library('upload', $config);
  
    if ( !$this->upload->do_upload('dokumen'))
    {
      $this->set_notifikasi_swal('error','GAGAL !!','Dokumen tidak boleh kosong');
      redirect('data-penyesuaianharga');
    }
    else
    {

    $file = $this->upload->data();
    $dokumen = $file['file_name'];

    $data = array (
      'nama_barang' => $nama_barang,
      'harga_baru' => $harga_baru,
      'mulai_berlaku' => $mulai_berlaku,
      'memo_internal' => $dokumen,
      'userinput_id' => $userinput_id,
      'datecreated' => DATE('Y-m-d H:i:s')
    );

    $sql = $this->crud_model->input($data,'tbl_accurate_penyesuaianharga');
    $this->set_notifikasi_swal('success','Berhasil','penyesuaianharga data Berhasil Ditambahkan');
    redirect('data-penyesuaianharga');
    }
  }

  public function getDokumenPenyesuaianharga($id){
    $dokumen = $this->dataAccurate_model->GetDocumentPenyesuaianharga($id);

    echo json_encode($dokumen);
  }

  public function UpdateProsesPenyesuaianharga(){
    $pegawai_id = $this->pegawai_id;

    $input = json_decode($this->input->raw_input_stream, true);
    $id    = $input['id'];

    if (!$id) {
      echo json_encode(["status" => "error", "msg" => "Data tidak lengkap"]);
      return;
    }

    $data = [
      "userprocess_id"      => $pegawai_id,
      "dateprocess"     => DATE('Y-m-d H:i:s'),
    ];

    $this->crud_model->update(["id_penyesuaian" => $id], $data, "tbl_accurate_penyesuaianharga");

    echo json_encode(["status" => "success", "message" => "data berhasil disimpan"]);
    return;
  }
  // END DATA  PENYESUAIAN HARGA

}