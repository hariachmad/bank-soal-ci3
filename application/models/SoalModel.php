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

    public function count_selected_questions($selectedQuestionIds) {
        $this->load->database();
        $this->db->where_in('id', $selectedQuestionIds);
        return $this->db->count_all_results('soal');
    }

    function get_selected_questions($selectedQuestionIds, $limit, $offset) {
        $this->load->database();
        $this->db->where_in('id', $selectedQuestionIds);
        $this->db->limit($limit, $offset);
        return $this->db->get('soal')->result();
    }
    

    public function getSoal($id = false)
    {
        $this->load->database();
        if ($id == false) {
            return $this->db->get('soal')->result_array();
        }

        $this->db->where('id', $id);
        $query = $this->db->get('soal');
        return $query->result_array();
    }

    public function insert($data){
        $this->load->database();
        if(empty($data)){
            return false;
        }
        $insert =$this->db->insert('soal',$data);
        return $insert;         
    }

    public function delete($id){
        $this->load->database();
        $this->db->where('id', $id);
        return $this->db->delete('soal');
    }

}
