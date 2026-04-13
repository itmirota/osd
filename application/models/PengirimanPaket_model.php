<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class PengirimanPaket_model extends CI_Model
{

public function getData()
{
  $this->db->select('*');
  $this->db->from('tbl_pengirimanpaket a');
  $this->db->join('tbl_pegawai b','b.id_pegawai = a.pengirim_id');
  $this->db->order_by('a.id_paket','DESC');
  
  $query = $this->db->get();
	return $query->result();
}

public function GetDataByWhere($id)
{
  $this->db->select('*');
  $this->db->from('tbl_pengirimanpaket a');
  $this->db->join('tbl_pegawai b','b.id_pegawai = a.pengirim_id');
  $this->db->where('pengirim_id',$id);
  $this->db->order_by('a.id_paket','DESC');

  $query = $this->db->get();
	return $query->result();
}

public function getDataWhere($where)
{
  $this->db->select('*');
  $this->db->from('tbl_pengirimanpaket a');
  $this->db->join('tbl_pegawai b','b.id_pegawai = a.pengirim_id');
  $this->db->where($where);
  $this->db->order_by('a.id_paket','DESC');

  $query = $this->db->get();
	return $query->result();
}

}