<?php

class UjianModel extends CI_Model
{
    // protected $table = 'ujian';
    // protected $useTimestamps = true;
    // protected $allowedFields = ['nama_ujian', 'deskripsi_ujian', 'waktu_buka_ujian', 'waktu_tutup_ujian', 'durasi_ujian', 'nilai_minimum_kelulusan', 'jumlah_soal', 'random', 'tunjukkan_nilai','ruang_ujian','id_mata_kuliah'];

    public $nama_ujian;
    public $deskripsi_ujian;
    public $waktu_buka_ujian;
    public $waktu_tutup_ujian;
    public $durasi_ujian;
    public $nilai_minimum_kelulusan;
    public $jumlah_soal;
    public $random;
    public $tunjukkan_nilai;
    public $ruang_ujian;
    public $id_mata_kuliah;

    public function insert($data)
    {
        $this->load->database();
        if (empty($data)) {
            return false;
        }
        $insert = $this->db->insert('ujian', $data);
        return $insert;
    }

    public function save($id, $data)
    {
        $this->load->database();
        $this->db->where('id', $id);
        $this->db->update('ujian', $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->load->database();
        $this->db->where('id', $id);
        return $this->db->delete('ujian');
    }


    public function getUjian($id = false)
    {

        $this->load->database();
        if ($id == false) {
            return $this->db->get('ujian')->result_array();
        }

        $this->db->where('id', $id);
        $query = $this->db->get('ujian');
        return $query->result_array();
    }

    public function hasilUjian()
    {
        $this->load->database();
        $sql = "select D.*, un.nilai, un.created_at as tanggal from (select C.nama_mata_kuliah,C.nilai_minimum_kelulusan,C.id_ujian,us.id as id_users, us.fullname from (select B.nama_mata_kuliah,B.nilai_minimum_kelulusan,B.id_ujian,ku.id_users from 
(select A.nama_mata_kuliah,A.nilai_minimum_kelulusan,k.kode_ujian,k.id_ujian from 
(select m.nama_mata_kuliah,u.nilai_minimum_kelulusan,u.id from mata_kuliah m LEFT join ujian u on m.id = u.id_mata_kuliah) as A LEFT JOIN (select AA.*, ko.kode_ujian from (select MAX(id) as id,id_ujian from kode_ujian GROUP BY id_ujian) as AA join kode_ujian ko on AA.id = ko.id) k on k.id_ujian = A.id) as B LEFT Join kode_users ku on B.kode_ujian = ku.kode_ujian) as C LEFT JOIN users us on C.id_users = us.id) as D LEFT JOIN user_nilai un on D.id_ujian = un.id_ujian and D.id_users = un.id_users";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
}
