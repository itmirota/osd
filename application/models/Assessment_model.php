<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Assessment_model extends CI_Model
{
  public function getAssessment($id){
    $this->db->select('*');
    $this->db->from('tbl_assessment a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->where('penilai_id',$id);
    $query = $this->db->get();

    return $query->result();
  }

  public function getSoal(){
    $this->db->select('*');
    $this->db->from('tbl_assessment_soal');
    $query = $this->db->get();

    return $query->result();
  }

  public function getSoalWhere($where){
    $this->db->select('*');
    $this->db->from('tbl_assessment_soal');
    $this->db->where($where);
    $query = $this->db->get();

    return $query->result();
  }

  public function getKategori(){
    $this->db->select('kategori');
    $this->db->from('tbl_assessment_soal');
    $this->db->group_by('kategori');
    $query = $this->db->get();

    return $query->result();
  }
}