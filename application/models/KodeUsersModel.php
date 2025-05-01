<?php

class KodeUsersModel extends CI_Model
{
    // protected $table = 'kode_users';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['kode_ujian', 'id_users'];

    public $kode_ujian;
    public $id_users;

    public function getKode($id = false)
    {
        $this->load->database();
        if ($id == false) {
            return $this->db->get('kode_users')->result();
        }

        $this->db->where('id', $id);
        $query = $this->db->select('kode_ujian')->get('kode_users');
        $result = $query->result_array();
        return array_column($result, 'kode_ujian');
    }
    public function getUsers($id = false)
    {
        $this->load->database();
        if ($id == false) {
            return $this->db->get('kode_users')->result();
        }

        $this->db->where('id', $id);
        $query = $this->db->select('id_users')->get('kode_users');
        $result = $query->result_array();
        return array_column($result, 'id_users')[0];
    }
    public function getKodeUsersId($id_users, $kode_ujian)
    {
        $this->load->database();
        $this->db->where('id_users', $id_users);
        $this->db->where('kode_ujian', $kode_ujian);
        $query = $this->db->get('kode_users');

        if ($query->num_rows() == 0) {
            return null;
        } else {
            $row = $query->row();
            return $row->id;
        }
    }

    public function insert($data){
        $this->load->database();
        if(empty($data)){
            return false;
        }
        $insert =$this->db->insert('kode_users',$data);
        return $insert;         
    }
}
