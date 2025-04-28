<?php

class UserSoalUjianModel extends CI_Model
{
    // protected $table = 'user_soal_ujian';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['id_soal', 'id_kode_users', 'jawaban_dipilih'];

    public $id_soal;
    public $id_kode_users;
    public $jawaban_dipilih;

    public function insert($data){
        $this->load->database();
        if(empty($data)){
            return false;
        }
        $insert =$this->db->insert('user_soal_ujian',$data);
        return $insert;         
    }

    public function getSoalId($id = false)
    {
        $this->load->database();
        if ($id == false) {
            return $this->db->get('user_soal_ujian')->result();
        }

        $this->db->where('id_kode_users' ,$id);
        $query = $this->db->select('id_soal')->get('user_soal_ujian');
        $result = $query->result_array();
        return array_column($result, 'id_soal');
    }
    public function getSoalIdAndJawabanDipilih($id = false)
    {
        $this->load->database();
        if ($id == false) {
            return $this->db->get('user_soal_ujian')->result();
        }

        $this->db->select('id_soal, jawaban_dipilih');
        $this->db->where('id_kode_users', $id);
        $query = $this->db->get('user_soal_ujian');
        return $query->result_array();
    }
}
