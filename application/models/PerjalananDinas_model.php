<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class PerjalananDinas_model extends CI_Model
{
  public function ShowAll(){
    $this->db->select('*');
    $this->db->from('tbl_perdin a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_bagian c','c.id_bagian = b.bagian_id');
    $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
    $this->db->join('tbl_departement e','e.id_departement = d.departement_id');
    $this->db->join('tbl_jabatan f','f.id_jabatan = b.jabatan_id');
    $query = $this->db->get();
    return $query->result();
  }

  public function ShowById($id){
    $this->db->select('*,b.nama_pegawai as nama_petugas,g.nama_pegawai as nama_pengikut');
    $this->db->from('tbl_perdin a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_bagian c','c.id_bagian = b.bagian_id');
    $this->db->join('tbl_divisi d','d.id_divisi = c.divisi_id');
    $this->db->join('tbl_departement e','e.id_departement = d.departement_id');
    $this->db->join('tbl_jabatan f','f.id_jabatan = b.jabatan_id');
    $this->db->join('tbl_pegawai g','g.id_pegawai = a.pengikut_id');
    $this->db->where('id_perdin',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function ShowDetail($id){
    $this->db->select('*,DATE(a.tanggal) as tanggal, TIME(a.tanggal) as waktu ');
    $this->db->from('tbl_perdinDetail a');
    $this->db->where('perdin_id',$id);
    $query = $this->db->get();
    return $query->result();
  }

  public function ShowMaxId($id){
    $this->db->select('id_perdin');
    $this->db->from('tbl_perdin');
    $this->db->where('pegawai_id',$id);
    $this->db->order_by('id_perdin','DESC');
    $query = $this->db->get();
    return $query->row();
  }

  public function ShowSignature($id, $pegawai_id){
    $this->db->select('signature, Datecreated');
    $this->db->from('tbl_perdinsignature a');
    $this->db->where('perdin_id',$id);
    $this->db->where('pegawai_id',$pegawai_id);
    $query = $this->db->get();

    return $query->row();
  }



}