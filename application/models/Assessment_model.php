<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Assessment_model extends CI_Model
{
  public function getAssessment($id){
    $this->db->select('id_assessment,pegawai_id,nama_pegawai,nilai');
    $this->db->from('tbl_assessment a');
    $this->db->join('tbl_pegawai b','b.nip = a.pegawai_id');
    $this->db->where('penilai_id',$id);
    $query = $this->db->get();

    return $query->result();
  }

  public function getHasilAssessment($id){
    $this->db->select('id_assessment,nama_pegawai,nilai,tgl_assessment,nama_assessment_tingkatan');
    $this->db->from('tbl_assessment a');
    $this->db->join('tbl_pegawai b','b.nip = a.pegawai_id');
    // $this->db->join('tbl_bagian c','c.id_bagian = b.bagian_id');
    // $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
    // $this->db->join('tbl_departement e','e.id_departement = d.departement_id');
    $this->db->join('tbl_assessment_tingkatan f','f.id_assessment_tingkatan = a.assessment_tingkatan_id');
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
    $this->db->order_by('id_assessment_soal','ASC');
    $query = $this->db->get();

    return $query;
  }
}