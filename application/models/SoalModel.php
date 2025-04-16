<?php

class SoalModel extends CI_Model
{
    // protected $table = 'soal';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['soal', 'id_bab', 'jawaban_a', 'jawaban_b', 'jawaban_c', 'jawaban_d', 'jawaban_benar'];

    public $soal;
    public $id_bab;
    public $jawaban_a;
    public $jawaban_b;
    public $jawaban_c;
    public $jawaban_d;
    public $jawaban_benar;

    public function getSoal($id = false)
    {
        $this->load->database();
        if ($id == false) {
            return $this->db->get('soal')->result();
        }

        $this->db->where('id', $id);
        $query = $this->db->get('soal');
        return $query->row();
    }
}
