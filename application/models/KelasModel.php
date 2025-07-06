<?php

class KelasModel extends CI_Model
{
    public $id_kelas;
    public $nama_kelas;
    public $kode_kelas;

    public function insert($data){
        $this->load->database();
        if(empty($data)){
            return false;
        }
        $insert =$this->db->insert('kelas',$data);
        return $insert;         
    }

    public function save($id,$data){
        $this->load->database();
        $this->db->where('id_kelas', $id);
        $this->db->update('kelas',$data);
        return $this->db->affected_rows();
    }

    public function getKelas($id = false)
    {
        $this->load->database();
        if ($id == false) {
            return $this->db->get('kelas')->result_array();
        }

        $this->db->where('id_kelas' ,$id);
        $query = $this->db->get('kelas');
        $row = $query->result_array();
        return $row;
    }
    

    public function find($id = false)
    {
        $this->load->database();
        if ($id == false) {
            return $this->db->get('kelas')->result_array();
        }

        $this->db->where('id_kelas' ,$id);
        $query = $this->db->get('kelas');
        $row = $query->result_array();
        return $row;
    }

    public function delete($id){
        $this->load->database();
        $this->db->where('id_kelas', $id);
        return $this->db->delete('kelas');
    }

}
