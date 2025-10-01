<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pelanggaran_model extends CI_Model
{
  public function GetPelanggaran(){
    $this->db->select('*');
    $this->db->from('tbl_pelanggaran a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_bagian c','c.id_bagian = a.bagian_id');
    $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
    $this->db->join('tbl_departement e','e.id_departement = d.departement_id');
    $query = $this->db->get();

    return $query->result();
  }

  public function GetPelanggaranWhere($where){
    $this->db->select('*');
    $this->db->from('tbl_pelanggaran a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_bagian c','c.id_bagian = a.bagian_id');
    $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
    $this->db->join('tbl_departement e','e.id_departement = d.departement_id');
    $this->db->where($where);
    $query = $this->db->get();

    return $query->result();
  }
}