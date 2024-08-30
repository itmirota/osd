<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Sample_model extends CI_Model
{
    function getData(){
        $this->db->select('a.id_sample_vendor, a.status, a.hasil_cek, a.hasil_uji, a.harga, a.tgl_masuk, a.nama_supplier, b.nama_sample ');
        $this->db->from('tbl_sample_vendor a');
        $this->db->join('tbl_sample_permintaan b','b.id_sample_permintaan = a.permintaan_sample_id');
        $query = $this->db->get();

        return $query->result();
	}

    function getDataRowbyId($where){
        $this->db->select('a.id_sample_vendor, a.status, a.hasil_cek, a.hasil_uji, a.harga, a.tgl_masuk, a.nama_supplier, b.nama_sample ');
        $this->db->from('tbl_sample_vendor a');
        $this->db->join('tbl_sample_permintaan b','b.id_sample_permintaan = a.permintaan_sample_id');
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result();
	}

    function getDatabyWhere($where){
        $this->db->select('a.id_sample_vendor, a.status, a.hasil_cek, a.hasil_uji, a.harga, a.tgl_masuk, a.nama_supplier, b.nama_sample ');
        $this->db->from('tbl_sample_vendor a');
        $this->db->join('tbl_sample_permintaan b','b.id_sample_permintaan = a.permintaan_sample_id');
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result();
	}
}