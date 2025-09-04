<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Perizinan_model extends CI_Model
{

public function getData(){
  $this->db->select('a.id_cuti, b.nama_pegawai as nama_pegawai, a.keperluan, a.jenis_cuti, a.approval, DATEDIFF(tgl_akhir,tgl_mulai) as selisih, c.nama_divisi');
  $this->db->from('tbl_perizinan_cuti a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
  $this->db->join('tbl_divisi c', 'c.id_divisi = b.divisi_id');
  $this->db->order_by('id_cuti','DESC');
  $query = $this->db->get();
  return $query->result();
}

// public function getDatabyApproval($id){
//   $this->db->select('a.id_cuti, b.nama_pegawai as nama_pegawai, a.keperluan, a.jenis_cuti, a.approval, DATEDIFF(tgl_akhir,tgl_mulai) as selisih, c.nama_divisi');
//   $this->db->from('tbl_perizinan_cuti a');
//   $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
//   $this->db->join('tbl_divisi c', 'c.id_divisi = b.divisi_id');
//   $this->db->where('c.kadiv_id', $id);
//   $this->db->or_where('c.manager_id', $id);
//   $this->db->order_by('id_cuti','DESC');
//   $query = $this->db->get();
//   return $query->result();
// }

public function GetDataByWhere($id){
  $this->db->select('*, DATE(datecreated) as tgl_pengajuan, DATEDIFF(tgl_akhir,tgl_mulai) as selisih');
  $this->db->from('tbl_perizinan_cuti a');
  $this->db->where('id_cuti',$id);
  $query = $this->db->get();
  
  return $query->row();
}

public function getDetailbyId($id){
  $this->db->select('b.nama_pegawai as pengganti, tgl_mulai, tgl_akhir, keperluan, bukti_cuti');
  $this->db->from('tbl_perizinan_cuti a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pengganti');
  $this->db->where('id_cuti',$id);
  $query = $this->db->get();
  
  return $query->row();
}

public function getDatabyPegawai($id){
  $this->db->select('*, DATE(datecreated) as tgl_pengajuan, DATEDIFF(tgl_akhir, tgl_mulai) as selisih');
  $this->db->from('tbl_perizinan_cuti a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pengganti');
  $this->db->where('pegawai_id',$id);
  $this->db->order_by('id_cuti','DESC');
  $query = $this->db->get();
	return $query->result();
}

public function getDatabyPengganti($id){
  $this->db->select('*, DATE(datecreated) as tgl_pengajuan');
  $this->db->from('tbl_perizinan_cuti a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
  $this->db->where('pengganti',$id);
  $this->db->order_by('id_cuti','DESC');
  $query = $this->db->get();
	return $query->result();
}

public function hitungTotalCuti($id){
  $this->db->select('COUNT(pegawai_id) as total');
  $this->db->from('tbl_perizinan_cuti ');
  $this->db->where('pegawai_id',$id);
  $query = $this->db->get();
	return $query->row();
}

public function cekKuotaCuti($id)
{
  $this->db->select('kuota_cuti, sisa_cuti');
  $this->db->from('tbl_pegawai');
  $this->db->where('id_pegawai',$id);
  $query = $this->db->get();
	return $query->row();
}

public function ListApprovalbyId($id){
  $this->db->select('*, DATE(datecreated) as tgl_approval, a.status as status_approval');
  $this->db->from('tbl_approval_cuti a');
  $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
  $this->db->where('cuti_id',$id);
  $this->db->order_by('cuti_id','DESC');
  $query = $this->db->get();
	return $query->result();
}

public function cekApprovalbyPegawai($id, $id_cuti)
{
  $this->db->select('id_approval');
  $this->db->from('tbl_approval_cuti');
  $this->db->where('pegawai_id',$id);
  $this->db->where('cuti_id',$id_cuti);
  $this->db->order_by('cuti_id','DESC');
  $query = $this->db->get();
	return $query->row();
}

public function getTugas(){
  $this->db->select('a.id_tugas, a.kendaraan_id, d.merek_kendaraan, d.nomor_polisi, a.approval, b.nama_pegawai as nama_pegawai, c.nama_pegawai as penugasan, DATE(tgl_tugas) as tgl_tugas, TIME(tgl_tugas) as waktu_tugas, DATE(tgl_kembali) as tgl_kembali, TIME(tgl_kembali) as waktu_kembali, a.tempat_tugas, a.rincian_tugas, DATE(datecreated) as datecreated, TIME(datecreated) as timecreated, e.nama_divisi');
  $this->db->from('tbl_perizinan_tugas a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
  $this->db->join('tbl_pegawai c', 'c.id_pegawai = a.penugasan_id');
  $this->db->join('tbl_kendaraan d', 'd.id_kendaraan = a.kendaraan_id');
  $this->db->join('tbl_divisi e', 'e.id_divisi = b.divisi_id');
  $this->db->order_by('id_tugas', 'DESC');
  $query = $this->db->get();
  return $query->result();
}

public function getTugasWhere($where){
  $this->db->select('a.id_tugas, a.kendaraan_id, a.approval, a.pegawai_id, b.nama_pegawai as nama_pegawai, c.nama_pegawai as penugasan, DATE(tgl_tugas) as tgl_tugas, TIME(tgl_tugas) as waktu_tugas, DATE(tgl_kembali) as tgl_kembali, TIME(tgl_kembali) as waktu_kembali, a.tempat_tugas, a.rincian_tugas, DATE(datecreated) as datecreated, TIME(datecreated) as timecreated, e.nama_divisi');
  $this->db->from('tbl_perizinan_tugas a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
  $this->db->join('tbl_pegawai c', 'c.id_pegawai = a.penugasan_id');
  $this->db->join('tbl_divisi e', 'e.id_divisi = b.divisi_id');
  $this->db->where($where);
  $this->db->order_by('id_tugas', 'DESC');
  $query = $this->db->get();
  return $query->result();
}

public function getTugasbyPegawai($id){
  $this->db->select('a.id_tugas, a.kendaraan_id, d.merek_kendaraan, d.nomor_polisi, a.approval, b.nama_pegawai as nama_pegawai, c.nama_pegawai as penugasan, DATE(tgl_tugas) as tgl_tugas, TIME(tgl_tugas) as waktu_tugas, DATE(tgl_kembali) as tgl_kembali, TIME(tgl_kembali) as waktu_kembali, a.tempat_tugas, a.rincian_tugas, DATE(datecreated) as datecreated, TIME(datecreated) as timecreated, e.nama_divisi');
  $this->db->from('tbl_perizinan_tugas a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
  $this->db->join('tbl_pegawai c', 'c.id_pegawai = a.penugasan_id');
  $this->db->join('tbl_kendaraan d', 'd.id_kendaraan = a.kendaraan_id');
  $this->db->join('tbl_divisi e', 'e.id_divisi = b.divisi_id');
  $this->db->where('pegawai_id',$id);
  $this->db->order_by('id_tugas', 'DESC');
  $query = $this->db->get();
	return $query->result();
}

public function getTugasbyApproval($id){
  $this->db->select('a.id_tugas, a.kendaraan_id, a.approval, b.nama_pegawai as nama_pegawai, c.nama_pegawai as penugasan, DATE(tgl_tugas) as tgl_tugas, TIME(tgl_tugas) as waktu_tugas, a.tempat_tugas, a.rincian_tugas, d.merek_kendaraan, d.nomor_polisi, DATE(datecreated) as datecreated, TIME(datecreated) as timecreated, e.nama_divisi');
  $this->db->from('tbl_perizinan_tugas a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
  $this->db->join('tbl_pegawai c', 'c.id_pegawai = a.penugasan_id');
  $this->db->join('tbl_kendaraan d', 'd.id_kendaraan = a.kendaraan_id');
  $this->db->join('tbl_divisi e', 'e.id_divisi = b.divisi_id');
  $this->db->where('a.penugasan_id', $id);
  $this->db->order_by('id_tugas', 'DESC');
  $query = $this->db->get();
  return $query->result();
}

public function getTugasWhereIn($ids){
  $this->db->select('a.id_tugas, a.kendaraan_id, a.approval, b.nama_pegawai as nama_pegawai, c.nama_pegawai as penugasan, DATE(tgl_tugas) as tgl_tugas, TIME(tgl_tugas) as waktu_tugas, a.tempat_tugas, a.rincian_tugas, d.merek_kendaraan, d.nomor_polisi, DATE(datecreated) as datecreated, TIME(datecreated) as timecreated');
  $this->db->from('tbl_perizinan_tugas a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
  $this->db->join('tbl_pegawai c', 'c.id_pegawai = a.penugasan_id');
  $this->db->join('tbl_kendaraan d', 'd.id_kendaraan = a.kendaraan_id');
  $this->db->where_in('a.penugasan_id', $ids);
  $this->db->order_by('id_tugas', 'DESC');
  $query = $this->db->get();
  return $query->result();
}


public function getDataTugasbyId($id){
  $this->db->select('id_tugas, approval, DATE(datecreated) as tgl_pengajuan, DATE(tgl_tugas) as tgl_tugas');
  $this->db->from('tbl_perizinan_tugas');
  $this->db->where('id_tugas',$id);
  $query = $this->db->get();
  
  return $query->row();
}

public function rincianTugasbyId($id){
  $this->db->select('a.id_tugas, a.kendaraan_id, b.nama_pegawai as nama_pegawai, c.nama_pegawai as penugasan, DATE(tgl_tugas) as tgl_tugas, d.merek_kendaraan, d.nomor_polisi, TIME(tgl_tugas) as waktu_tugas, a.tempat_tugas, a.rincian_tugas, DATE(datecreated) as datecreated, TIME(datecreated) as timecreated');
  $this->db->from('tbl_perizinan_tugas a');
  $this->db->join('tbl_pegawai b', 'b.id_pegawai = a.pegawai_id');
  $this->db->join('tbl_pegawai c', 'c.id_pegawai = a.penugasan_id');
  $this->db->join('tbl_kendaraan d', 'd.id_kendaraan = a.kendaraan_id');
  $this->db->where('id_tugas',$id);
  $query = $this->db->get();
	return $query->row();
}

public function ListApprovalTugasbyId($id){
  $this->db->select('*, DATE(datecreated) as tgl_approvalTugas, a.status as status_approval');
  $this->db->from('tbl_approval_tugas a');
  $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
  $this->db->where('tugas_id',$id);
  $query = $this->db->get();
	return $query->result();
}


public function cekApprovalTugasbyPegawai($id, $id_tugas)
{
  $this->db->select('id_approval_tugas');
  $this->db->from('tbl_approval_tugas');
  $this->db->where('pegawai_id',$id);
  $this->db->where('tugas_id',$id_tugas);
  $query = $this->db->get();
	return $query->row();
}

}