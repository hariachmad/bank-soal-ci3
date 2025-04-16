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


    public function getBab($id = false)
    {
        $this->load->database();
        if ($id == false) {
            return $this->db->get('bab')->result();
        }

        $this->db->where('id' ,$id);
        return $this->db->get('bab')->result();
    }
}
