<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class DataAccurate_model extends CI_Model
{
  public function GetDataSuppierAll(){
    $this->db->select('a.id_supplier, a.nama_vendor, a.no_rekening, a.no_npwp, a.status_pajak, a.dokumen, DATE(a.datecreated) as tanggal_input, TIME(a.datecreated) as waktu_input, DATE(a.dateprocess) as tanggal_proses, TIME(a.dateprocess) as waktu_proses, b.nama_pegawai as nama_input, b.kontak_pegawai, a.userprocess_id , c.nama_pegawai as nama_proses');
    // $this->db->select('*');
    $this->db->from('tbl_accurate_supplier a');
    $this->db->join('tbl_pegawai b','a.userinput_id = b.id_pegawai');
    $this->db->join('tbl_pegawai c','a.userprocess_id = c.id_pegawai','left');
    $query = $this->db->get();

    return $query->result();
  }

  public function GetDataSuppierWhere($where){
    $this->db->select('a.id_supplier, a.nama_vendor, a.no_rekening, a.no_npwp, a.status_pajak, a.dokumen, DATE(a.datecreated) as tanggal_input, TIME(a.datecreated) as waktu_input, DATE(a.dateprocess) as tanggal_proses, TIME(a.dateprocess) as waktu_proses, b.nama_pegawai as nama_input, b.kontak_pegawai, a.userprocess_id, c.nama_pegawai as nama_proses');
    // $this->db->select('*');
    $this->db->from('tbl_accurate_supplier a');
    $this->db->join('tbl_pegawai b','a.userinput_id = b.id_pegawai');
    $this->db->join('tbl_pegawai c','a.userprocess_id = c.id_pegawai','left');
    $this->db->where($where);
    $query = $this->db->get();

    return $query->result();
  }

  public function GetDocumentSuppier($id){
    $this->db->select('dokumen');
    $this->db->from('tbl_accurate_supplier');
    $this->db->where('id_supplier',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function GetDataCustomerAll(){
    $this->db->select('a.id_customer, a.nama_customer, a.kontak, a.email, a.alamat, a.kategori, a.tipe_pembayaran, DATE(a.datecreated) as tanggal_input, TIME(a.datecreated) as waktu_input, DATE(a.dateprocess) as tanggal_proses, TIME(a.dateprocess) as waktu_proses, b.nama_pegawai as nama_input, b.kontak_pegawai, a.userprocess_id, c.nama_pegawai as nama_proses');
    $this->db->from('tbl_accurate_customer a');
    $this->db->join('tbl_pegawai b','a.userinput_id = b.id_pegawai');
    $this->db->join('tbl_pegawai c','a.userprocess_id = c.id_pegawai','left');
    $query = $this->db->get();

    return $query->result();
  }

  public function GetDataCustomerWhere($where){
    $this->db->select('a.id_customer, a.nama_customer, a.kontak, a.email, a.alamat, a.kategori, a.tipe_pembayaran, DATE(a.datecreated) as tanggal_input, TIME(a.datecreated) as waktu_input, DATE(a.dateprocess) as tanggal_proses, TIME(a.dateprocess) as waktu_proses, b.nama_pegawai as nama_input, b.kontak_pegawai, a.userprocess_id, c.nama_pegawai as nama_proses');
    $this->db->from('tbl_accurate_customer a');
    $this->db->join('tbl_pegawai b','a.userinput_id = b.id_pegawai');
    $this->db->join('tbl_pegawai c','a.userprocess_id = c.id_pegawai','left');
    $this->db->where($where);

    $query = $this->db->get();

    return $query->result();
  }

  public function GetDataBarangJasaAll(){
    $this->db->select('a.id_barangjasa, a.nama_barang, a.kategori_barang, a.satuan_1, a.satuan_2, a.satuan_3, DATE(a.datecreated) as tanggal_input, TIME(a.datecreated) as waktu_input, DATE(a.dateprocess) as tanggal_proses, TIME(a.dateprocess) as waktu_proses, b.nama_pegawai as nama_input, b.kontak_pegawai, a.userprocess_id, c.nama_pegawai as nama_proses');
    $this->db->from('tbl_accurate_barangjasa a');
    $this->db->join('tbl_pegawai b','a.userinput_id = b.id_pegawai');
    $this->db->join('tbl_pegawai c','a.userprocess_id = c.id_pegawai','left');
    $query = $this->db->get();

    return $query->result();
  }

  public function GetDataBarangJasaWhere($where){
    $this->db->select('a.id_barangjasa, a.nama_barang, a.kategori_barang, a.satuan_1, a.satuan_2, a.satuan_3, DATE(a.datecreated) as tanggal_input, TIME(a.datecreated) as waktu_input, DATE(a.dateprocess) as tanggal_proses, TIME(a.dateprocess) as waktu_proses, b.nama_pegawai as nama_input, b.kontak_pegawai, a.userprocess_id, c.nama_pegawai as nama_proses');
    $this->db->from('tbl_accurate_barangjasa a');
    $this->db->join('tbl_pegawai b','a.userinput_id = b.id_pegawai');
    $this->db->join('tbl_pegawai c','a.userprocess_id = c.id_pegawai','left');
    $this->db->where($where);

    $query = $this->db->get();

    return $query->result();
  }

  public function GetDataPenghapusanAll(){
    $this->db->select('a.id_penghapusan, a.nomor_dokumen, a.alasan, DATE(a.datecreated) as tanggal_input, TIME(a.datecreated) as waktu_input, DATE(a.dateprocess) as tanggal_proses, TIME(a.dateprocess) as waktu_proses, b.nama_pegawai as nama_input, b.kontak_pegawai, a.userprocess_id, c.nama_pegawai as nama_proses');
    $this->db->from('tbl_accurate_penghapusan a');
    $this->db->join('tbl_pegawai b','a.userinput_id = b.id_pegawai');
    $this->db->join('tbl_pegawai c','a.userprocess_id = c.id_pegawai','left');
    $query = $this->db->get();

    return $query->result();
  }

  public function GetDataPenghapusanWhere($where){
    $this->db->select('a.id_penghapusan, a.nomor_dokumen, a.alasan, DATE(a.datecreated) as tanggal_input, TIME(a.datecreated) as waktu_input, DATE(a.dateprocess) as tanggal_proses, TIME(a.dateprocess) as waktu_proses, b.nama_pegawai as nama_input, b.kontak_pegawai, a.userprocess_id, c.nama_pegawai as nama_proses');
    $this->db->from('tbl_accurate_penghapusan a');
    $this->db->join('tbl_pegawai b','a.userinput_id = b.id_pegawai');
    $this->db->join('tbl_pegawai c','a.userprocess_id = c.id_pegawai','left');
    $this->db->where($where);

    $query = $this->db->get();

    return $query->result();
  }

  public function GetDataPenyesuaianhargaAll(){
    $this->db->select('a.id_penyesuaian, a.nama_barang, a.harga_baru, a.mulai_berlaku, a.memo_internal, DATE(a.datecreated) as tanggal_input, TIME(a.datecreated) as waktu_input, DATE(a.dateprocess) as tanggal_proses, TIME(a.dateprocess) as waktu_proses, b.nama_pegawai as nama_input, b.kontak_pegawai, a.userprocess_id, c.nama_pegawai as nama_proses');
    $this->db->from('tbl_accurate_penyesuaianharga a');
    $this->db->join('tbl_pegawai b','a.userinput_id = b.id_pegawai');
    $this->db->join('tbl_pegawai c','a.userprocess_id = c.id_pegawai','left');
    $query = $this->db->get();

    return $query->result();
  }

  public function GetDataPenyesuaianhargaWhere($where){
    $this->db->select('a.id_penyesuaian, a.nama_barang, a.harga_baru, a.mulai_berlaku, a.memo_internal, DATE(a.datecreated) as tanggal_input, TIME(a.datecreated) as waktu_input, DATE(a.dateprocess) as tanggal_proses, TIME(a.dateprocess) as waktu_proses, b.nama_pegawai as nama_input, b.kontak_pegawai, a.userprocess_id, c.nama_pegawai as nama_proses');
    $this->db->from('tbl_accurate_penyesuaianharga a');
    $this->db->join('tbl_pegawai b','a.userinput_id = b.id_pegawai');
    $this->db->join('tbl_pegawai c','a.userprocess_id = c.id_pegawai','left');
    $this->db->where($where);

    $query = $this->db->get();

    return $query->result();
  }

  public function GetDocumentPenyesuaianharga($id){
    $this->db->select('memo_internal');
    $this->db->from('tbl_accurate_Penyesuaianharga');
    $this->db->where('id_penyesuaian',$id);
    $query = $this->db->get();

    return $query->row();
  }



}