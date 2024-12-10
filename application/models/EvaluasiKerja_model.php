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