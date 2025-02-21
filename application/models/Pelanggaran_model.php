<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pelanggaran_model extends CI_Model
{
  public function GetPelanggaran(){
    $this->db->select('*');
    $this->db->from('tbl_pelanggaran a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c','b.divisi_id = c.id_divisi');
    $this->db->join('tbl_departement d','c.departement_id = d.id_departement');
    $query = $this->db->get();

    return $query->result();
  }

  public function GetPelanggaranWhere($where){
    $this->db->select('*');
    $this->db->from('tbl_pelanggaran a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c','b.divisi_id = c.id_divisi');
    $this->db->join('tbl_departement d','c.departement_id = d.id_departement');
    $this->db->where($where);
    $query = $this->db->get();

    return $query->result();
  }
}