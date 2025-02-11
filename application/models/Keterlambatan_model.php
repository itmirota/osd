<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Keterlambatan_model extends CI_Model
{
  public function GetKeterlambatan(){
    $this->db->select('*');
    $this->db->from('tbl_keterlambatan a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c','b.divisi_id = c.id_divisi');
    $query = $this->db->get();

    return $query->result();
  }

  public function GetKeterlambatanWhere($where){
    $this->db->select('*');
    $this->db->from('tbl_keterlambatan a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c','b.divisi_id = c.id_divisi');
    $this->db->where($where);
    $query = $this->db->get();

    return $query->result();
  }
}