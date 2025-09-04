<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function userListing()
    {
        $this->db->select('BaseTbl.userId, BaseTbl.username, BaseTbl.password, pegawai.nama_pegawai as name, BaseTbl.roleId, Roles.role, pegawai.bagian_id, pegawai.id_pegawai as pegawai_id, divisi.nama_divisi');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->join('tbl_pegawai as pegawai','pegawai.nip = BaseTbl.nip');
        $this->db->join('tbl_divisi as divisi','divisi.id_divisi = pegawai.bagian_id');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getUserByWhere($where)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.username, BaseTbl.password, pegawai.nama_pegawai as name, BaseTbl.roleId, Roles.role, pegawai.bagian_id, pegawai.id_pegawai as pegawai_id, divisi.nama_divisi');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->join('tbl_pegawai as pegawai','pegawai.nip = BaseTbl.nip');
        $this->db->join('tbl_divisi as divisi','divisi.id_divisi = pegawai.bagian_id');
        $this->db->where($where);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $query = $this->db->get();
        
        return $query->result();
    }

    function getDivisi()
    {
        $this->db->select('id_divisi, nama_divisi');
        $this->db->from('tbl_divisi');
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to check whether username id is already exist or not
     * @param {string} $username : This is username id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function checkusernameExists($username)
    {
        $this->db->select("username");
        $this->db->from("tbl_users");
        $this->db->where("username", $username);   
        $query = $this->db->get();

        return $query->result();
    }
    
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_users', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.username, BaseTbl.password, pegawai.nama_pegawai as name, BaseTbl.roleId, Roles.role, pegawai.id_pegawai as pegawai_id');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->join('tbl_pegawai as pegawai','pegawai.nip = BaseTbl.nip');
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUser($userInfo, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);       
        $query = $this->db->get('tbl_users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }
}

  