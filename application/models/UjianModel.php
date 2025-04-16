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


    public function getUjian($id = false)
    {

        $this->load->database();
        if ($id == false) {
            return $this->db->get('ujian')->result();
        }

        $this->db->where('id', $id);
        $query = $this->db->get('ujian');
        return $query->row();
    }
}
