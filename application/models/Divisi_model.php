<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Divisi_model extends CI_Model
{
  public function GetDivisi(){
    $this->db->select('a.id_divisi, a.nama_divisi, COUNT(b.id_pegawai) as jml_pegawai');
    $this->db->from('tbl_divisi a');
    $this->db->join('tbl_pegawai b','b.divisi_id = a.id_divisi');
    $this->db->group_by('id_divisi');
    $this->db->where('b.status','aktif');
    $query = $this->db->get();

    return $query->result();
  }

  public function GetDivisiWhere($where){
    $this->db->select('*, COUNT(b.id_pegawai) as jml_pegawai');
    $this->db->from('tbl_divisi a');
    $this->db->join('tbl_pegawai b','b.divisi_id = a.id_divisi');
    $this->db->group_by('id_divisi');
    $this->db->where($where);
    $query = $this->db->get();

    return $query->result();
  }

  public function GetDivisiByDeptWithCountEmployee($id){
    $this->db->select('a.id_divisi, a.nama_divisi, COUNT(b.id_pegawai) as jml_pegawai');
    $this->db->from('tbl_divisi a');
    $this->db->join('tbl_pegawai b','b.divisi_id = a.id_divisi');
    $this->db->join('tbl_departement c','c.id_departement = a.departement_id');
    $this->db->where('a.departement_id',$id);
    $this->db->where('b.status','aktif');
    $this->db->group_by('id_divisi');
    $query = $this->db->get();

    return $query->result();
  }

  public function GetNameKadivById($where)
  {
    $this->db->select('nama_pegawai');
    $this->db->from('tbl_divisi a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.kadiv_id');
    $this->db->where($where);
    $query = $this->db->get();
    $result = $query->row();

    return $result->nama_pegawai;
  }

  public function GetNameManagerById($where)
  {
    $this->db->select('nama_pegawai');
    $this->db->from('tbl_divisi a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.manager_id');
    $this->db->where($where);
    $query = $this->db->get();
    $result = $query->row();

    return $result->nama_pegawai;
  }
}