<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{

  public function showData()
  {
    $this->db->select('*');
    $this->db->from('tbl_pegawai a');
    $this->db->join('tbl_divisi b','b.id_divisi = a.divisi_id');
    $this->db->where('a.status','aktif');
    $query = $this->db->get();
    return $query->result();
  }

  public function showDataWhere($params, $where, $orderparam, $orderby, $group)
  {
    $this->db->select($params);
    $this->db->from('tbl_pegawai a');
    $this->db->join('tbl_divisi b','b.id_divisi = a.divisi_id');
    $this->db->where('a.status','aktif');
    $this->db->where($where);

    if(isset($orderby)){
    $this->db->order_by($orderparam, $orderby);
    }

    if(isset($group)){
    $this->db->group_by($group);
    }

    $query = $this->db->get();
    return $query->result();
  }

  public function showDataNonAktif()
  {
    $this->db->select('*');
    $this->db->from('tbl_pegawai a');
    $this->db->join('tbl_divisi b','b.id_divisi = a.divisi_id');
    $this->db->where('a.status','tidak');
    $query = $this->db->get();
    return $query->result();
  }

  public function TotalPegawai($whereparam, $where)
  {
    $this->db->select('COUNT(case when jenis_kelamin="L"  then id_pegawai end) as laki, COUNT(case when jenis_kelamin="P" then id_pegawai end) as perempuan, COUNT(id_pegawai) as total_pegawai');
    $this->db->from('tbl_pegawai');
    $this->db->where($whereparam, $where);
    $query = $this->db->get();
    return $query->row();
  }

  public function showDataPegawaiTetap()
  {
    $this->db->select('*');
    $this->db->from('tbl_pegawai');
    $this->db->where('status_pegawai','tetap');
    $this->db->where('status','aktif');
    $query = $this->db->get();
    return $query->result();
  }

  public function showMaxNIP()
  {
    $this->db->select('MAX(nip) as nip');
    $this->db->from('tbl_pegawai');
    $query = $this->db->get();
    return $query->row();
  }

  public function getId()
  {
    $this->db->select('MAX(id_pegawai) as id_pegawai');
    $this->db->from('tbl_pegawai');
    $query = $this->db->get();
    return $query->row();
  }

  public function getPegawaibyId($id)
  {
    $this->db->select('*');
    $this->db->from('tbl_pegawai a');
    $this->db->join('tbl_divisi b','b.id_divisi = a.divisi_id');
    $this->db->where('id_pegawai',$id);
    $query = $this->db->get();
    return $query->row();
  }

  public function getPegawaibyDivisi($id, $id_pegawai)
  {
    $this->db->select('id_pegawai, nama_pegawai, status');
    $this->db->from('tbl_pegawai a');
    $this->db->join('tbl_divisi b','b.id_divisi = a.divisi_id');
    $this->db->where('divisi_id',$id);
    $this->db->where('id_pegawai !=',$id_pegawai);
    $this->db->where('a.status','aktif');
    $query = $this->db->get();
    return $query->result();
  }

  public function getDataPerpanjanganKontrak($id){
    $this->db->select('a.pegawai_id, b.nama_pegawai, a.tgl_kontrak, c.nama_pegawai as nama_pembuat');
    $this->db->from('tbl_perpanjangan_kontrak a');
    $this->db->join('tbl_pegawai b','b.id_pegawai = a.pegawai_id');
    $this->db->join('tbl_pegawai c','c.id_pegawai = a.createdBy');
    $this->db->where('pegawai_id',$id);

    $query = $this->db->get();
    return $query->result();
  }

  public function getPegawaiBaru($where)
  {
    $this->db->select('tgl_masuk as x,COUNT(id_pegawai) as y');
    $this->db->from('tbl_pegawai');
    $this->db->where($where);
    $this->db->group_by('MONTH(tgl_masuk)');
    $query = $this->db->get();

    return $query->result();
  }

  public function getPegawainonAktif()
  {
    $this->db->select('tgl_keluar as x, COUNT(id_pegawai) as y');
    $this->db->from('tbl_pegawai');
    $this->db->where('status','tidak');
    $this->db->group_by('MONTH(tgl_keluar)');
    $this->db->order_by('tgl_keluar','ASC');
    $query = $this->db->get();

    return $query->result();
  }
}