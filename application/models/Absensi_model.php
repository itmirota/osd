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
    $this->db->join('tbl_bagian c','c.id_bagian = b.bagian_id');
    $this->db->order_by('id_absensi','DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function ReportAbsenOnline($id, $where){
    $this->db->select('*');
    $this->db->from('tbl_absensi a');
    $this->db->join('tbl_pegawai b','a.pegawai_id = b.id_pegawai');
    $this->db->join('tbl_bagian c','b.bagian_id = c.id_bagian');
    $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
    $this->db->join('tbl_departement e','e.id_departement = d.departement_id');
    
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
    $this->db->join('tbl_bagian c','c.id_bagian = b.bagian_id');
    $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
    $this->db->join('tbl_departement e','e.id_departement = d.departement_id');
    // $this->db->order_by('id_absensi','ASC');
    $this->db->group_by('a.date','a.pegawai_id');
    $query = $this->db->get();
    return $query->result();
  }

  public function showReportById($id){
    $this->db->select('id_absensi, pegawai_id, date, time_in, time_out, nama_pegawai, nama_divisi');
    $this->db->from('tbl_absensi a');
    $this->db->join('tbl_bagian b','b.id_bagian = b.bagian_id');
    $this->db->join('tbl_divisi c','c.id_divisi = c.divisi_id');
    $this->db->join('tbl_departement d','d.id_departement = d.departement_id');
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
  $this->db->join('tbl_bagian c','c.id_bagian = b.bagian_id');
  $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
  $this->db->join('tbl_departement e','e.id_departement = d.departement_id');

  $query = $this->db->get();
  return $query->result();
}

public function showDataAbsenTokoByWhere($where){
  $this->db->select('*');
  $this->db->from('tbl_absen_toko a');
  $this->db->join('tbl_pegawai b','a.pegawai_id = b.id_pegawai');
  $this->db->join('tbl_bagian c','c.id_bagian = b.bagian_id');
  $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
  $this->db->join('tbl_departement e','e.id_departement = d.departement_id');
  $this->db->where($where);

  $query = $this->db->get();
  return $query->result();
}

public function ReportAbsenToko($id, $where){
  $this->db->select('a.id_absen_toko, a.pegawai_id, a.tgl_awal, a.tgl_akhir, a.bukti_absensi_toko, a.datecreated, b.nama_pegawai, c.nama_bagian, d.nama_divisi, e.nama_departement');
  $this->db->from('tbl_absen_toko a');
  $this->db->join('tbl_pegawai b','a.pegawai_id = b.id_pegawai');
  $this->db->join('tbl_bagian c','c.id_bagian = b.bagian_id');
  $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
  $this->db->join('tbl_departement e','e.id_departement = d.departement_id');
  if ($id != 0){
    $this->db->where('pegawai_id',$id);
  }
  $this->db->where($where);
  $this->db->order_by('id_absen_toko','DESC');

  $query = $this->db->get();
  return $query->result();
}

// END ABSENSI MANUAL TOKO


// ABSENSI ISTIRAHAT

public function getDataIstirahat(){
  $this->db->select('*');
  $this->db->from('tbl_absensi_istirahat a');
  $this->db->join('tbl_pegawai b','a.pegawai_id = b.id_pegawai');
  $this->db->join('tbl_bagian c','c.id_bagian = b.bagian_id');
  $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
  $this->db->join('tbl_departement e','e.id_departement = d.departement_id');
  $this->db->order_by('id_absensi_istirahat','DESC');

  $query = $this->db->get();
  return $query->result();
}

public function getDataRowIstirahat($id){
  $this->db->select('id_absensi_istirahat');
  $this->db->from('tbl_absensi_istirahat');
  $this->db->where('pegawai_id',$id);
  $this->db->where('date',DATE('Y-m-d'));
  $this->db->order_by('id_absensi_istirahat','DESC');
  $this->db->order_by('id_absensi_istirahat','DESC');

  $query = $this->db->get();
  return $query->row();
}

public function getDataIstirahatByBagian($bagian){
  $this->db->select('*');
  $this->db->from('tbl_absensi_istirahat a');
  $this->db->join('tbl_pegawai b','a.pegawai_id = b.id_pegawai');
  $this->db->join('tbl_bagian c','c.id_bagian = b.bagian_id');
  $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
  $this->db->join('tbl_departement e','e.id_departement = d.departement_id');
  $this->db->where('b.bagian_id',$bagian);
  $this->db->order_by('id_absensi_istirahat','DESC');

  $query = $this->db->get();
  return $query->result();

}

public function getDataIstirahatByManager($id){
  $this->db->select('*');
  $this->db->from('tbl_absensi_istirahat a');
  $this->db->join('tbl_pegawai b','a.pegawai_id = b.id_pegawai');
  $this->db->join('tbl_bagian c','c.id_bagian = b.bagian_id');
  $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
  $this->db->join('tbl_departement e','e.id_departement = d.departement_id');
  $this->db->where('b.atasan2_id',$id);
  $this->db->order_by('id_absensi_istirahat','DESC');

  $query = $this->db->get();
  return $query->result();

}

public function ReportAbsenIstirahat($where){
  $this->db->select('*');
  $this->db->from('tbl_absensi_istirahat a');
  $this->db->join('tbl_pegawai b','a.pegawai_id = b.id_pegawai');
  $this->db->join('tbl_bagian c','c.id_bagian = b.bagian_id');
  $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
  $this->db->join('tbl_departement e','e.id_departement = d.departement_id');
  
  $this->db->where($where);
  $this->db->order_by('id_absensi_istirahat','DESC');

  $query = $this->db->get();
  return $query->result();
}
// END ABSENSI ISTIRAHAT

// PEGAWAI TERLAMBAT
public function getPegawaiTerlambat($where){
  $this->db->select('*');
  $this->db->from('tbl_absensi_terlambat a');
  $this->db->join('tbl_pegawai b','a.pegawai_id = b.id_pegawai');
  $this->db->join('tbl_bagian c','c.id_bagian = b.bagian_id');
  $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
  $this->db->join('tbl_departement e','e.id_departement = d.departement_id');

  if(isset($where)){
  $this->db->where($where);
  }
  
  $this->db->order_by('id_absensi_terlambat','DESC');

  $query = $this->db->get();
  return $query->result();
}
// PEGAWAI TERLAMBAT
}