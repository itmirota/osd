<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Divisi_model extends CI_Model
{
  public function GetDivisi(){
    $this->db->select('a.id_divisi, a.nama_divisi, b.nama_pegawai as kadiv, c.nama_pegawai as manager');
    $this->db->from('tbl_divisi a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.kadiv_id');
    $this->db->join('tbl_pegawai c','c.id_pegawai = a.manager_id');
    $this->db->where('id_divisi != 1');
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