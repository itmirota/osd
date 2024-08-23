<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Izin_model extends CI_Model
{

  public function getData(){
    $this->db->select('*, DATEDIFF(tgl_akhir,tgl_mulai) as selisih');
    $this->db->from('tbl_perizinan_izin a');
    $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c', 'c.id_divisi = b.divisi_id');
    $this->db->order_by('id_izin','DESC');
    $query = $this->db->get();
    return $query->result();
  }

public function getDatabyApproval($id){
  $this->db->select('*, b.nama_pegawai as nama_pegawai, DATEDIFF(tgl_akhir,tgl_mulai) as selisih, c.nama_pegawai as pemberi_izin');
  $this->db->from('tbl_perizinan_izin a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
  $this->db->join('tbl_pegawai c', 'c.id_pegawai = a.pemberi_izin');
  $this->db->join('tbl_divisi d', 'd.id_divisi = b.divisi_id');
  $this->db->where('pemberi_izin', $id);
  $this->db->order_by('id_izin','DESC');

  $query = $this->db->get();
  return $query->result();
}

public function getDatabyId($id){
  $this->db->select('*');
  $this->db->from('tbl_perizinan_izin');
  $this->db->where('id_izin',$id);
  $query = $this->db->get();
  
  return $query->row();
}

public function getDetailbyId($id){
  $this->db->select('b.nama_pegawai as pemberi_izin, keperluan, bukti_izin');
  $this->db->from('tbl_perizinan_izin a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pemberi_izin');
  $this->db->where('id_izin',$id);
  $query = $this->db->get();
  
  return $query->row();
}

public function getDatabyPegawai($id){
  $this->db->select('*, DATEDIFF(tgl_akhir,tgl_mulai) as selisih');
  $this->db->from('tbl_perizinan_izin a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
  $this->db->where('pegawai_id',$id);
  $this->db->order_by('id_izin','DESC');
  $query = $this->db->get();
	return $query->result();
}

public function ListApprovalbyId($id){
  $this->db->select('*, DATE(datecreated) as tgl_approval, a.status as status_approval');
  $this->db->from('tbl_approval_izin a');
  $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
  $this->db->where('izin_id',$id);
  $query = $this->db->get();
	return $query->result();
}

public function cekApprovalbyPegawai($id, $where)
{
  $this->db->select('id_approval_izin as id');
  $this->db->from('tbl_approval_izin');
  $this->db->where('pegawai_id',$id);
  $this->db->where('izin_id',$where);
  $query = $this->db->get();
	return $query->row();
}


public function rincianDatabyId($id){
  $this->db->select('*');
  $this->db->from('tbl_perizinan_izin a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
  $this->db->where('id_izin',$id);
  $query = $this->db->get();
	return $query->row();
}

}