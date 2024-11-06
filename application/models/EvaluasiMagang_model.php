<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class evaluasiMagang_model extends CI_Model
{
    
  function getData(){
    $this->db->select('*, DATE(tgl_evaluasi) as date');
    $this->db->from('tbl_evaluasimagang');
    $query = $this->db->get();

    return $query->result();
  }

  function getDataEvaluasi($id){
    $this->db->select('*');
    $this->db->from('tbl_evaluasimagang');
    $this->db->where('id_evaluasiMagang', $id);
    $query = $this->db->get();

    return $query->result();
  }
  
  function getDataEvaluasibyDate(){
    $this->db->select('*, DATE(tgl_evaluasi) as date, TIME(tgl_evaluasi) as time');
    $this->db->from('tbl_evaluasimagang');
    $this->db->where('DATE(tgl_evaluasi)',DATE('Y-m-d'));
    $query = $this->db->get();

    return $query->result();
  }

  function getDataHasil($id){
    $this->db->select('*');
    $this->db->from('tbl_penilaian_magang');
    $this->db->where('evaluasiMagang_id', $id);
    $query = $this->db->get();

    return $query->result();
  }

  function getSumHasil($id){
    $this->db->select('SUM(total_nilai) as total_nilai');
    $this->db->from('tbl_penilaian_magang');
    $this->db->where('evaluasiMagang_id', $id);
    $query = $this->db->get();

    return $query->row();
  }
}