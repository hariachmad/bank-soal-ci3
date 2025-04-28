<?php

class BabUntukUjianModel extends CI_Model
{
    // protected $table = 'bab_untuk_ujian';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['id_bab', 'id_ujian'];

    public $id_bab;
    public $id_ujian;

    public function insert($data){
        $this->load->database();
        if(empty($data)){
            return false;
        }
        $insert =$this->db->insert('bab_untuk_ujian',$data);
        return $insert;         
    }

    public function getUjian($id_bab)
    {
        $this->load->database();
        $this->db->where('id_bab' ,$id_bab);
        $query = $this->db->select('id_ujian')->get('bab_untuk_ujian');
        $result = $query->result_array();
        return array_column($result, 'id_ujian');
    }
    public function getBab($id_ujian)
    {
        $this->load->database();
        $this->db->where('id_ujian' ,$id_ujian);
        $query = $this->db->select('id_bab')->get('bab_untuk_ujian');
        $result = $query->result_array();
        return array_column($result, 'id_bab');        
    }

    public function findAll($id){
        $this->load->database();
        $this->db->where('id_ujian' ,$id);
        return $this->db->get('bab_untuk_ujian')->result_array();
    }
}
