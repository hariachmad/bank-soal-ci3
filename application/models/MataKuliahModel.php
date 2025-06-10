<?php

class MataKuliahModel extends CI_Model
{
    // protected $table = 'mata_kuliah';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['nama_mata_kuliah', 'kode_mata_kuliah'];

    public $nama_mata_kuliah;
    public $kode_mata_kuliah;

    public function getMataKuliah($id = false)
    {
        $this->load->database();
        if ($id == false) {
            $query = $this->db->get('mata_kuliah');
            return $query->result_array();
        }

        $this->db->where('id', $id);
        $query = $this->db->get('mata_kuliah');
        return $query->result_array();
    }

    public function insert($data)
    {
        $this->load->database();
        if (empty($data)) {
            return false;
        }
        $insert = $this->db->insert('mata_kuliah', $data);
        return $insert;
    }

    // $this->load->database();
    //     $this->db->where('id', $id);
    //     return $this->db->delete('bab');

    public function delete($id) {
        $this->load->database();
        if (empty($id)) {
            return false;
        }
        $this->db->where('id',$id);
        return $this->db->delete('mata_kuliah');
    }
}
