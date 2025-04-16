<?php

class UserNilaiModel extends CI_Model
{
    // protected $table = 'user_nilai';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['id', 'id_users', 'id_ujian', 'nilai'];

    public $id;
    public $id_users;
    public $id_ujian;
    public $nilai;

    public function getNilai($id_users, $id_ujian)
    {
        $this->load->database();
        $this->db->where('id_users', $id_users);
        $this->db->where('id_ujian', $id_ujian); 
        $query = $this->db->get('user_nilai');
        return $query->row();
    }
}
