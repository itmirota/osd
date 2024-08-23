<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class EvaluasiKerja_model extends CI_Model
{
    
  function getData(){
    $this->db->select('*, DATE(tgl_evaluasi) as date, TIME(tgl_evaluasi) as time');
    $this->db->from('tbl_evaluasikerja a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c','c.id_divisi = b.divisi_id');
    $query = $this->db->get();

    return $query->result();
  }

  function getDatabyDate(){
    $this->db->select('*, DATE(tgl_evaluasi) as date, TIME(tgl_evaluasi) as time');
    $this->db->from('tbl_evaluasikerja a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c','c.id_divisi = b.divisi_id');
    $this->db->where('DATE(tgl_evaluasi)','DATE(Y-m-d)');
    $query = $this->db->get();

    return $query->result();
  }

  function getSoalbyKategori($kategori){
    $this->db->select('*');
    $this->db->from('tbl_evaluasiKerja_soal a');
    $this->db->join('tbl_evaluasiKerja_kategori b','b.id_kategori = a.kategori_id');
    $this->db->where('kategori_id',$kategori);
    $query = $this->db->get();

    return $query->result();
  }

  function getIdSoalbyKategori($kategori){
    $this->db->select('id_soal');
    $this->db->from('tbl_evaluasiKerja_soal a');
    $this->db->join('tbl_evaluasiKerja_kategori b','b.id_kategori = a.kategori_id');
    $this->db->where('kategori_id',$kategori);
    $query = $this->db->get();

    return $query->result();
  }

  function getpegawai($ids){
    $this->db->select('nama_pegawai');
    $this->db->from('tbl_pegawai');
    $this->db->where_in('id_pegawai',$ids);
    $query = $this->db->get();

    return $query->result();
  }

  function getEvaluasibyId($id){
    $this->db->select('*');
    $this->db->from('tbl_evaluasikerja a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c','c.id_divisi = b.divisi_id');
    $this->db->where('id_evaluasiKerja', $id);
    $query = $this->db->get();

    return $query->row();
  }

  function getDataHasil($id){
    $this->db->select('*');
    $this->db->from('tbl_evaluasikerja_hasil a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.penilai_id');
    $this->db->where('evaluasi_id', $id);
    $query = $this->db->get();

    return $query->result();
  }


}