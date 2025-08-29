<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Assessment_model extends CI_Model
{
  public function getAssessment($id){
    $this->db->select('id_assessment,pegawai_id,nama_pegawai,nilai');
    $this->db->from('tbl_assessment a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->where('penilai_id',$id);
    $query = $this->db->get();

    return $query->result();
  }

  public function getHasilAssessment($id){
    $this->db->select('id_assessment,nama_pegawai,nilai,tgl_assessment,nama_assessment_tingkatan');
    $this->db->from('tbl_assessment a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c','c.id_divisi = b.divisi_id');
    $this->db->join('tbl_departement d','d.id_departement = c.departement_id');
    $this->db->join('tbl_assessment_tingkatan e','e.id_assessment_tingkatan = a.assessment_tingkatan_id');
    $this->db->where('a.pegawai_id',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function getSoal(){
    $this->db->select('*');
    $this->db->from('tbl_assessment_soal');
    $query = $this->db->get();

    return $query->result();
  }

  public function getSoalById($id){
    $this->db->select('*');
    $this->db->from('tbl_assessment_soal');
    $this->db->where('id_assessment_soal',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function getSoalWhere($where){
    $this->db->select('*');
    $this->db->from('tbl_assessment_soal');
    $this->db->where($where);
    $query = $this->db->get();

    return $query;
  }

  public function getKategori(){
    $this->db->select('kategori');
    $this->db->from('tbl_assessment_soal');
    $this->db->group_by('kategori');
    $query = $this->db->get();

    return $query;
  }
}