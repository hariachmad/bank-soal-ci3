<?php

class KodeUjianModel extends CI_Model
{
    // protected $table = 'kode_ujian';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['kode_ujian', 'id_ujian'];

    public $kode_ujian;
    public $id_ujian;

    public function getKodeUjian($id = false)
    {
        $this->load->database();
        if ($id == false) {
            return $this->db->get('kode_ujian')->result();
        }

        $this->db->where('kode_ujian' ,$id);
        $query = $this->db->select('kode_ujian')->get('kode_ujian');
        $result = $query->result();
        $array = array_column($result, 'kode_ujian');
        if (empty($array)) {
            return null;
        }

        return $array;
    }
    public function getUjian($kode_ujian)
    {
        $this->load->database();
        $this->db->where('kode_ujian' ,$kode_ujian);
        $query = $this->db->select('id_ujian')->get('kode_ujian');
        $result = $query->result_array();
        $array = array_column($result, 'id_ujian')[0];

        if (empty($array)) {
            return null;
        }

        return $array;
    }

    public function insert($data){
        $this->load->database();
        if(empty($data)){
            return false;
        }
        $insert =$this->db->insert('kode_ujian',$data);
        return $insert;         
    }
    public function getKodeUjianByUjian($id_ujian)
    {
        $this->load->database();
        $this->db->where('id_ujian' ,$id_ujian);
        $query = $this->db->select('kode_ujian')->get('kode_ujian');
        $result = $query->result_array();
        $array = array_column($result, 'kode_ujian');

        if (empty($array)) {
            return null;
        }

        return $array;
    }
}
