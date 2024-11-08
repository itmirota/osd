<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Daftar_hadir_model extends CI_Model
{
// AMBSENSI ONLINE
  public function showData($where){
    $this->db->select('*');
    $this->db->from('tbl_daftar_hadir a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c','c.id_divisi = b.divisi_id');
    $this->db->join('tbl_departement d','d.id_departement = c.departement_id');

    if(isset($where)){
    $this->db->where($where);
    }

    $this->db->order_by('id_daftar_hadir','DESC');
    $query = $this->db->get();
    return $query->result();
  }
}