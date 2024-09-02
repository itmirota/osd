<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Departement_model extends CI_Model
{
  public function GetDepartementWithCountDivisi(){
    $this->db->select('b.id_divisi, b.nama_divisi, a.id_departement, a.nama_departement, COUNT(b.id_divisi) as jml_divisi');
    $this->db->from('tbl_departement a');
    $this->db->join('tbl_divisi b','b.departement_id = a.id_departement');
    $this->db->group_by('id_departement');
    $query = $this->db->get();

    return $query->result();
  }
}