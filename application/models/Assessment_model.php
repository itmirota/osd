<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Assessment_model extends CI_Model
{
  public function getAssessment($id){
    $this->db->select('id_assessment,pegawai_nip,b.nama_pegawai as nama_pegawai,c.nama_pegawai as nama_penilai, nilai');
    $this->db->from('tbl_assessment a');
    $this->db->join('tbl_pegawai b','b.nip = a.pegawai_nip');
    $this->db->join('tbl_pegawai c','c.nip = a.penilai_nip');
    $this->db->where('penilai_nip',$id);
    $query = $this->db->get();

    return $query->result();
  }

  public function getAssessmentAll(){
    $this->db->select('id_assessment,pegawai_nip,b.nama_pegawai as nama_pegawai,c.nama_pegawai as nama_penilai, nilai');
    $this->db->from('tbl_assessment a');
    $this->db->join('tbl_pegawai b','b.nip = a.pegawai_nip');
    $this->db->join('tbl_pegawai c','c.nip = a.penilai_nip');
    $query = $this->db->get();

    return $query->result();
  }

  public function getHasilAssessmentbyId($id){
    $this->db->select('id_assessment,pegawai_nip,b.nama_pegawai as nama_pegawai,c.nama_pegawai as nama_penilai, nilai');
    $this->db->from('tbl_assessment a');
    $this->db->join('tbl_pegawai b','b.nip = a.pegawai_nip');
    $this->db->join('tbl_pegawai c','c.nip = a.penilai_nip');
    $this->db->where('pegawai_nip',$id);
    $this->db->where('nilai is not null');
    $this->db->order_by('pegawai_nip', 'ASC');
    $query = $this->db->get();

    return $query->result();
  }

  public function getHasilAssessmentAll(){
    $this->db->select('id_assessment,pegawai_nip,b.nama_pegawai as nama_pegawai,c.nama_pegawai as nama_penilai, nilai');
    $this->db->from('tbl_assessment a');
    $this->db->join('tbl_pegawai b','b.nip = a.pegawai_nip');
    $this->db->join('tbl_pegawai c','c.nip = a.penilai_nip');
    // $this->db->group_by('pegawai_nip');
    $this->db->order_by('pegawai_nip', 'ASC');
    
    $query = $this->db->get();

    return $query->result();
  }

  public function getHasilAssessment($id){
    $this->db->select('id_assessment,b.nama_pegawai as nama_pegawai ,nilai,tgl_assessment,nama_assessment_tingkatan, g.nama_pegawai as nama_penilai');
    $this->db->from('tbl_assessment a');
    $this->db->join('tbl_pegawai b','b.nip = a.pegawai_nip');
    $this->db->join('tbl_bagian c','c.id_bagian = b.bagian_id');
    $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
    $this->db->join('tbl_departement e','e.id_departement = d.departement_id');
    $this->db->join('tbl_assessment_tingkatan f','f.id_assessment_tingkatan = a.assessment_tingkatan_id');
    $this->db->join('tbl_pegawai g','g.id_pegawai = a.penilai_nip');
    $this->db->where('a.id_assessment',$id);
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