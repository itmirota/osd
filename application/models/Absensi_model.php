<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Absensi_model extends CI_Model
{
// AMBSENSI ONLINE
  public function showData($id){
    $this->db->select('*');
    $this->db->from('tbl_absensi a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->where('pegawai_id',$id);
    $this->db->where('date',DATE('Y-m-d'));
    $this->db->order_by('id_absensi','DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function getDataAbsenById($id){
    $this->db->select('*');
    $this->db->from('tbl_absensi a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->where('pegawai_id',$id);
    $this->db->order_by('id_absensi','DESC');
    $query = $this->db->get();
    return $query->row();
  }

  public function showReport(){
    $this->db->select('*');
    $this->db->from('tbl_absensi a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c','c.id_divisi = b.divisi_id');
    $this->db->order_by('id_absensi','DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function ReportAbsenOnline($id, $where){
    $this->db->select('*');
    $this->db->from('tbl_absensi a');
    $this->db->join('tbl_pegawai b','a.pegawai_id = b.id_pegawai');
    $this->db->join('tbl_divisi c','b.divisi_id = c.id_divisi');
    if ($id != 0){
      $this->db->where('pegawai_id',$id);
    }
    $this->db->where($where);
    $this->db->order_by('id_absensi','DESC');
  
    $query = $this->db->get();
    return $query->result();
  }

  public function showReportByDate(){
    $this->db->select('*');
    $this->db->from('tbl_absensi a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c','c.id_divisi = b.divisi_id');
    // $this->db->order_by('id_absensi','ASC');
    $this->db->group_by('a.date','a.pegawai_id');
    $query = $this->db->get();
    return $query->result();
  }

  public function showReportById($id){
    $this->db->select('id_absensi, pegawai_id, date, time_in, time_out, nama_pegawai, nama_divisi');
    $this->db->from('tbl_absensi a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_divisi c','c.id_divisi = b.divisi_id');
    $this->db->where('pegawai_id',$id);
    $this->db->order_by('id_absensi','ASC');
    $query = $this->db->get();
    return $query->result();
  }
// END ABSENSI ONLINE

// ABSENSI PEGAWAI HARIAN/MAGANG
  public function report(){
    $this->db->select('*');
    $this->db->from('tbl_absensi_pegawaiHarian');
    $this->db->order_by('id_absensi_pegawaiHarian','DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function reportbyWhere($where){
    $this->db->select('*');
    $this->db->from('tbl_absensi_pegawaiHarian');
    $this->db->where($where);
    $this->db->order_by('id_absensi_pegawaiHarian','DESC');
    $query = $this->db->get();
    return $query->result();
  }
// END ABSENSI PEGAWAI HARIAN/MAGANG

// ABSENSI MANUAL TOKO

public function showDataAbsenToko(){
  $this->db->select('*');
  $this->db->from('tbl_absen_toko a');
  $this->db->join('tbl_pegawai b','a.pegawai_id = b.id_pegawai');
  $this->db->join('tbl_divisi c','b.divisi_id = c.id_divisi');

  $query = $this->db->get();
  return $query->result();
}

public function showDataAbsenTokoByWhere($where){
  $this->db->select('*');
  $this->db->from('tbl_absen_toko a');
  $this->db->join('tbl_pegawai b','a.pegawai_id = b.id_pegawai');
  $this->db->join('tbl_divisi c','b.divisi_id = c.id_divisi');
  $this->db->where($where);

  $query = $this->db->get();
  return $query->result();
}

public function ReportAbsenToko($id, $where){
  $this->db->select('*');
  $this->db->from('tbl_absen_toko a');
  $this->db->join('tbl_pegawai b','a.pegawai_id = b.id_pegawai');
  $this->db->join('tbl_divisi c','b.divisi_id = c.id_divisi');
  if ($id != 0){
    $this->db->where('pegawai_id',$id);
  }
  $this->db->where($where);
  $this->db->order_by('id_absen_toko','DESC');

  $query = $this->db->get();
  return $query->result();
}

// ENDABSENSI MANUAL TOKO

}