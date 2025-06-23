<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class EvaluasiKerja_model extends CI_Model
{
    
  function getData(){
    $this->db->select('*, DATE(tgl_evaluasi) as date');
    $this->db->from('tbl_evaluasikerja');
    $this->db->order_by('id_evaluasiKerja','DESC');
    $query = $this->db->get();

    return $query->result();
  }

  function getDataWhere($where){
    $this->db->select('a.id_evaluasi, a.tgl_evaluasi, a.kategori_evaluasi, a.jenis_evaluasi, a.pegawai_id, b.nama_pegawai, c.nama_evaluasi_kategori as kategori, d.nama_evaluasi_jenis as jenis');
    $this->db->from('tbl_evaluasi a');
    $this->db->join('tbl_pegawai b','a.pegawai_id = b.id_pegawai');
    $this->db->join('tbl_evaluasi_kategori c', 'a.kategori_evaluasi = c.id_evaluasi_kategori');
    $this->db->join('tbl_evaluasi_jenis d','a.jenis_evaluasi = d.id_evaluasi_jenis');
    $this->db->where($where);
    $query = $this->db->get();

    return $query->result();
  }

  function getDataRow($where){
    $this->db->select('a.id_evaluasi, a.tgl_evaluasi, a.kategori_evaluasi, a.jenis_evaluasi, a.pegawai_id, b.nama_pegawai, c.nama_evaluasi_kategori as kategori, d.nama_evaluasi_jenis as jenis');
    $this->db->from('tbl_evaluasi a');
    $this->db->join('tbl_pegawai b','a.pegawai_id = b.id_pegawai');
    $this->db->join('tbl_evaluasi_kategori c', 'a.kategori_evaluasi = c.id_evaluasi_kategori');
    $this->db->join('tbl_evaluasi_jenis d','a.jenis_evaluasi = d.id_evaluasi_jenis');
    $this->db->where($where);
    $query = $this->db->get();

    return $query->row();
  }

  function getDataSoalWhere($where){
    $this->db->select('*');
    $this->db->from('tbl_evaluasi_soal a');
    $this->db->join('tbl_evaluasi_jenis b','a.jenis_evaluasi_id = b.id_evaluasi_jenis');
    $this->db->where($where);
    $query = $this->db->get();

    return $query->result();
  }

  function getDataEvaluasi($id){
    $this->db->select('*');
    $this->db->from('tbl_evaluasikerja');
    $this->db->where('id_evaluasiKerja', $id);
    $query = $this->db->get();

    return $query->result();
  }

  function getDataRowEvaluasi($id){
    $this->db->select('*');
    $this->db->from('tbl_evaluasikerja');
    $this->db->where('id_evaluasiKerja', $id);
    $query = $this->db->get();

    return $query->row();
  }
  
  function getDataEvaluasibyDate(){
    $this->db->select('*, DATE(tgl_evaluasi) as date, TIME(tgl_evaluasi) as time');
    $this->db->from('tbl_evaluasikerja');
    $this->db->where('DATE(tgl_evaluasi)',DATE('Y-m-d'));
    $this->db->order_by('id_evaluasiKerja','DESC');
    $query = $this->db->get();

    return $query->result();
  }

  function getDataHasil($id){
    $this->db->select('*');
    $this->db->from('tbl_penilaian');
    $this->db->where('evaluasiKerja_id', $id);
    $query = $this->db->get();

    return $query->result();
  }

  function getSumHasil($id){
    $this->db->select('SUM(total_nilai) as total_nilai');
    $this->db->from('tbl_penilaian');
    $this->db->where('evaluasiKerja_id', $id);
    $query = $this->db->get();

    return $query->row();
  }
}