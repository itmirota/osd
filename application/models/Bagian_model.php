<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Bagian_model extends CI_Model
{
  public function GetBagian(){
    $this->db->select('a.id_bagian, a.nama_bagian, b.nama_divisi, d.nama_pegawai, COUNT(d.id_pegawai) as jml_pegawai');
    $this->db->from('tbl_bagian a');
    $this->db->join('tbl_divisi b','b.id_divisi = a.divisi_id');
    $this->db->join('tbl_departement c','c.id_departement = b.departement_id');
    $this->db->join('tbl_pegawai d','d.bagian_id = a.id_bagian');
    $this->db->group_by('id_bagian');
    $query = $this->db->get();

    return $query->result();
  }

  public function GetBagianWhere($where){
    $this->db->select('a.id_bagian, a.nama_bagian, b.nama_divisi, d.nama_pegawai, COUNT(d.id_pegawai) as jml_pegawai');
    $this->db->from('tbl_bagian a');
    $this->db->join('tbl_divisi b','b.id_divisi = a.divisi_id');
    $this->db->join('tbl_departement c','c.id_departement = b.departement_id');
    $this->db->join('tbl_pegawai d','d.bagian_id = a.id_bagian');
    $this->db->group_by('id_bagian');
    $this->db->where($where);
    $this->db->where('d.status','aktif');
    $query = $this->db->get();

    return $query->result();
  }

  public function GetBagianByDivisiWithCountEmployee($id){
    $this->db->select('a.id_bagian, a.nama_bagian, b.nama_divisi, d.nama_pegawai, COUNT(d.id_pegawai) as jml_pegawai');
    $this->db->from('tbl_bagian a');
    $this->db->join('tbl_divisi b','b.id_divisi = a.divisi_id');
    $this->db->join('tbl_departement c','c.id_departement = b.departement_id');
    $this->db->join('tbl_pegawai d','d.bagian_id = a.id_bagian');
    $this->db->where('a.divisi_id',$id);
    $this->db->where('d.status','aktif');
    $this->db->group_by('id_bagian');
    $query = $this->db->get();

    return $query->result();
  }
  
  public function GetNameKabagById($where)
  {
    $this->db->select('nama_pegawai');
    $this->db->from('tbl_bagian a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.kabag_id');
    $this->db->where($where);
    $query = $this->db->get();
    $result = $query->row();

    return $result->nama_pegawai;
  }
  
  public function GetBagianByDivisi($id_divisi){
    $this->db->select('a.id_bagian, a.nama_bagian');
    $this->db->from('tbl_bagian a');
    $this->db->where('a.divisi_id',$id_divisi);
    $query = $this->db->get();

    return $query->result();
  }
  public function GetBagianById($id){
    $this->db->select('a.id_bagian, a.nama_bagian, b.nama_divisi, d.nama_pegawai, COUNT(d.id_pegawai) as jml_pegawai');
    $this->db->from('tbl_bagian a');
    $this->db->join('tbl_divisi_new b','b.id_divisi = a.divisi_id');
    $this->db->join('tbl_pegawai c','c.id_pegawai = a.kabag_id');
    $this->db->join('tbl_pegawai d','d.bagian_id = a.id_bagian');
    $this->db->where('a.id_bagian',$id);
    $this->db->group_by('id_bagian');
    $query = $this->db->get();

    return $query->row();
  }
  
}