<?php

class UsersModel extends CI_Model
{
    // protected $table = 'users';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['email', 'username', 'fullname'];

    public $email;
    public $username;
    public $fullname;

    public function getUser($id = false)
    {
        $this->load->database();
        if ($id == false) {
            return $this->db->get('users')->result();
        }

        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function getUserByUsername($username)
    {
        $this->load->database();
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->row_array();
    }
}
