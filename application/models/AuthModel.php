<?php


class AuthModel extends CI_Model
{
    // protected $table = 'auth';
    // protected $allowedFields = ['username', 'email', 'password', 'fullname', 'created_at', 'updated_at'];

    public $username;
    public $email;
    public $password;
    public $fullname;
    public $created_at;
    public $updated_at;

    public function registerUser(array $data)
    {
        $this->load->database();
        $this->db->insert('auth', $data);
        return $this->db->insert_id();
    }

    public function isEmailExists($email)
    {
        $this->load->database();
        $this->db->where('email', $email);
        $this->db->from('auth');
        $count = $this->db->count_all_results();
        return $count > 0;
    }

    public function isUsernameExists($username)
    {
        $this->load->database();
        $this->db->where('username', $username);
        return $this->db->count_all_results('auth') > 0;
    }

    protected function hashPassword(array $data)
    {
        $this->load->database();
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $this->load->library('encryption');
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    public function verifyPassword($username, $password)
    {
        $this->load->database();
        $this->db->where('username', $username);
        $query = $this->db->get('auth');
        $user = $query->row_array();

        if (!$user) {
            return false;
        }

        return password_verify($password, $user['password']);
    }

    public function getFullnameByUsername($username)
    {
        $this->load->database();
        $this->db->where('username', $username);
        $this->db->limit(1);
        $query = $this->db->get('auth');

        $row = $query->row_array();
        return $row;
    }
}
