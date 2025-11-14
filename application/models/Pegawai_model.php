<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{

  public function showData($id = null)
  {
    $this->db->select('*');
    $this->db->from('tbl_pegawai a');
    $this->db->join('tbl_bagian b','b.id_bagian = a.bagian_id');
    $this->db->join('tbl_divisi c','c.id_divisi = b.divisi_id');
    $this->db->join('tbl_departement d','d.id_departement = c.departement_id');
    $this->db->join('tbl_areakerja e','e.id_areakerja = a.penempatan_id','left');
    $this->db->join('tbl_pelanggaran f','f.pegawai_id = a.id_pegawai','left');
    $this->db->group_by('a.id_pegawai');
    $this->db->where('a.status','aktif');

    if (isset($id)) {
      $this->db->where('id_pegawai', $id);
    }
    
    $query = $this->db->get();
    return $query->result();
  }

  public function showDataRow($where)
  {
    $this->db->select('*');
    $this->db->from('tbl_pegawai a');
    $this->db->join('tbl_bagian b','b.id_bagian = a.bagian_id');
    $this->db->join('tbl_divisi c','c.id_divisi = b.divisi_id');
    $this->db->join('tbl_departement d','d.id_departement = c.departement_id');
    $this->db->join('tbl_areakerja e','e.id_areakerja = a.penempatan_id');
    $this->db->where($where);
    $query = $this->db->get();
    return $query->row();
  }

  public function showDataWhere($params, $where, $orderparam, $orderby, $group)
  {
    $this->db->select($params);
    $this->db->from('tbl_pegawai a');
    $this->db->join('tbl_bagian b','b.id_bagian = a.bagian_id');
    $this->db->join('tbl_divisi c','c.id_divisi = b.divisi_id');
    $this->db->join('tbl_departement d','d.id_departement = c.departement_id');
    $this->db->join('tbl_areakerja e','e.id_areakerja = a.penempatan_id');
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
    $this->db->join('tbl_bagian b','b.id_bagian = a.bagian_id');
    $this->db->join('tbl_divisi c','c.id_divisi = b.divisi_id');
    $this->db->join('tbl_departement d','d.id_departement = c.departement_id');
    $this->db->join('tbl_areakerja e','e.id_areakerja = a.penempatan_id');
    $this->db->where('a.status','tidak');
    $query = $this->db->get();
    return $query->result();
  }

  public function TotalPegawai($where)
  {
    $this->db->select('COUNT(case when jenis_kelamin="L"  then id_pegawai end) as laki, COUNT(case when jenis_kelamin="P" then id_pegawai end) as perempuan, COUNT(id_pegawai) as total_pegawai');
    $this->db->from('tbl_pegawai a');
    $this->db->join('tbl_bagian b','b.id_bagian = a.bagian_id');
    $this->db->join('tbl_divisi c','c.id_divisi = b.divisi_id');
    $this->db->join('tbl_departement d','d.id_departement = c.departement_id');
    $this->db->where($where);
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

  public function getPegawaibyId($pegawai_id)
  {
    $this->db->select('*');
    $this->db->from('tbl_pegawai a');
    $this->db->join('tbl_bagian b','b.id_bagian = a.bagian_id');
    $this->db->join('tbl_divisi c','c.id_divisi = b.divisi_id');
    $this->db->join('tbl_departement d','d.id_departement = c.departement_id');
    $this->db->join('tbl_jabatan e','e.id_jabatan = a.jabatan_id');
    $this->db->join('tbl_areakerja f','f.id_areakerja = a.penempatan_id');
    $this->db->where('id_pegawai',$pegawai_id);
    $query = $this->db->get();
    return $query->row();
  }

  public function getPegawaibyBagian($id, $id_pegawai)
  {
    $this->db->select('id_pegawai, nama_pegawai, status');
    $this->db->from('tbl_pegawai a');
    $this->db->join('tbl_bagian b','b.id_bagian = a.bagian_id');
    $this->db->where('bagian_id',$id);
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
    $this->db->where('YEAR(tgl_keluar)',DATE('Y'));
    $this->db->group_by('MONTH(tgl_keluar)');
    $this->db->order_by('tgl_keluar','ASC');
    $query = $this->db->get();

    return $query->result();
  }

    public function getPenambahanKaryawan()
  {
    $this->db->select('tgl_masuk as tanggal,COUNT(id_pegawai) as jumlah_karyawan');
    $this->db->from('tbl_pegawai');
    $this->db->where('YEAR(tgl_masuk)',DATE('Y'));
    $this->db->group_by('MONTH(tgl_masuk)');
    $this->db->order_by('tgl_masuk','ASC');
    $query = $this->db->get();

    return $query->result();
  }

  public function getPenguranganKaryawan()
  {
    $this->db->select('tgl_keluar as tanggal,COUNT(id_pegawai) as jumlah_karyawan');
    $this->db->from('tbl_pegawai');
    $this->db->where('status','tidak');
    $this->db->where('YEAR(tgl_keluar)',DATE('Y'));
    $this->db->group_by('MONTH(tgl_keluar)');
    $this->db->order_by('tgl_keluar','ASC');
    $query = $this->db->get();

    return $query->result();
  }
}