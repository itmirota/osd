<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class IzinHarian_model extends CI_Model
{

  public function getData(){
    $this->db->select('*, TIME_FORMAT(waktu_mulai , "%H:%i") as waktu_mulai, TIME_FORMAT(waktu_akhir , "%H:%i") as waktu_akhir');
    $this->db->from('tbl_perizinan_harian a');
    $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c', 'c.id_divisi = b.divisi_id');
    $this->db->order_by('id_perizinan_harian','DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function getDataWhere($where){
    $this->db->select('*, TIME_FORMAT(waktu_mulai , "%H:%i") as waktu_mulai, TIME_FORMAT(waktu_akhir , "%H:%i") as waktu_akhir');
    $this->db->from('tbl_perizinan_harian a');
    $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c', 'c.id_divisi = b.divisi_id');
    $this->db->order_by('id_perizinan_harian','DESC');
    $this->db->where($where);
    $query = $this->db->get();
    return $query->result();
  }

public function getDatabyApproval($id){
  $this->db->select('*');
  $this->db->from('tbl_perizinan_harian a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
  $this->db->join('tbl_divisi c', 'c.id_divisi = b.divisi_id');
  $this->db->where('c.kadiv_id', $id);
  $this->db->or_where('c.manager_id', $id);
  $this->db->order_by('id_perizinan_harian','DESC');

  $query = $this->db->get();
  return $query->result();
}

public function GetDataByWhere($id){
  $this->db->select('*');
  $this->db->from('tbl_perizinan_harian');
  $this->db->where('id_perizinan_harian',$id);
  $query = $this->db->get();
  
  return $query->row();
}

public function getDatabyPegawai($id){
  $this->db->select('*, TIME_FORMAT(waktu_mulai , "%H:%i") as waktu_mulai, TIME_FORMAT(waktu_akhir , "%H:%i") as waktu_akhir');
  $this->db->from('tbl_perizinan_harian a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
  $this->db->where('pegawai_id',$id);
  $this->db->order_by('id_perizinan_harian','DESC');
  $query = $this->db->get();
	return $query->result();
}

public function ListApprovalbyId($id){
  $this->db->select('*, DATE(datecreated) as tgl_approval, a.status as status_approval');
  $this->db->from('tbl_approval_izinharian a');
  $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
  $this->db->where('perizinan_harian_id',$id);
  $query = $this->db->get();
	return $query->result();
}

public function cekApprovalbyPegawai($id, $where)
{
  $this->db->select('id_approval_izinharian');
  $this->db->from('tbl_approval_izinharian');
  $this->db->where('pegawai_id',$id);
  $this->db->where('perizinan_harian_id',$where);
  $query = $this->db->get();
	return $query->row();
}


public function rincianDatabyId($id){
  $this->db->select('*');
  $this->db->from('tbl_perizinan_harian a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
  $this->db->where('id_perizinan_harian',$id);
  $query = $this->db->get();
	return $query->row();
}

}