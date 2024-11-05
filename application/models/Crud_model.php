<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model
{
    function lihatdata($table){
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();

        return $query->result();
	}

    public function update_batch($table, $data, $where){
		return $this->db->update_batch($table, $data, $where);
	}

    public function save_batch($table, $data){
		return $this->db->insert_batch($table, $data);
	}

    function getdataRow($table){
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();

        return $query->row();
	}

    function getdataRowbyWhere($ParamSelect, $where, $table){
        $this->db->select($ParamSelect);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();

        return $query->row();
	}

    function getdataOrderBy($where, $param, $order, $table){
        $this->db->select('*');
        $this->db->from($table);
		$this->db->where($where);
        $this->db->order_by($param,$order);
        $query = $this->db->get();

        return $query->result();
	}

    function GetDataByWhere($where,$table){
        $this->db->select('*');
        $this->db->from($table);
		$this->db->where($where);
        $query = $this->db->get();

        return $query->result();
    }

    function GetRowOrderby($param, $order, $table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($param,$order);
        $query = $this->db->get();

        return $query->row();
    }

    function GetDataTotal($datasum,$table){
        $this->db->select('*,SUM('.$datasum.') as sum');
        $this->db->from($table);
        $query = $this->db->get();

        return $query->row()->sum;
    }

    function GetRowById($where,$table){
        $this->db->select('*');
        $this->db->from($table);
		$this->db->where($where);
        $query = $this->db->get();

        return $query->row();
    }

    function input($data,$table)
    {
        $this->db->insert($table,$data);
    }

    function update($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

    function delete($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    function cekMaxId($id,$table){
        $this->db->select('MAX('.$id.') as maxId');
        $this->db->from($table);
        $query = $this->db->get();

        $result = $query->row();
        return $result->maxId;
    }

    function selectIn($id, $param, $table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($param.' IN ('.$id.')');
        $query = $this->db->get();

        return $query->result();
	}
}