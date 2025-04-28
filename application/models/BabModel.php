<?php

class BabModel extends CI_Model
{
    // public $table = 'bab';
    // public $useTimestamps = true;
    // public $allowedFields = ['nomor_bab', 'nama_bab', 'sub_cpmk', 'id_mata_kuliah'];

    public $nomor_bab;
    public $nama_bab;
    public $sub_cpmk;
    public $id_mata_kuliah;

    public function insert($data){
        $this->load->database();
        if(empty($data)){
            return false;
        }
        $insert =$this->db->insert('bab',$data);
        return $insert;         
    }

    public function save($id,$data){
        $this->load->database();
        $this->db->where('id', $id);
        $this->db->update('bab',$data);
        return $this->db->affected_rows();
    }

    public function getBab($id = false)
    {
        $this->load->database();
        if ($id == false) {
            return $this->db->get('bab')->result_array();
        }

        $this->db->where('id' ,$id);
        $query = $this->db->get('bab');
        $row = $query->result_array();
        return $row;
    }
    

    public function find($id = false)
    {
        $this->load->database();
        if ($id == false) {
            return $this->db->get('bab')->result_array();
        }

        $this->db->where('id' ,$id);
        $query = $this->db->get('bab');
        $row = $query->result_array();
        return $row;
    }

    public function delete($id){
        $this->load->database();
        $this->db->where('id', $id);
        return $this->db->delete('bab');
    }

}
