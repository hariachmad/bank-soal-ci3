<?php

class KelasMataKuliahModel extends CI_Model
{
    public $id_kelas;
    public $id_mata_kuliah;

    public function getAll()
    {
        $this->load->database();
        // return $this->db->get('kelas_matakuliah')->result();
        $this->db->select('kelas_matakuliah.*, kelas.nama_kelas, mata_kuliah.nama_mata_kuliah,mata_kuliah.kode_mata_kuliah,mata_kuliah.sks');
        $this->db->from('kelas_matakuliah');
        $this->db->join('kelas', 'kelas.id_kelas = kelas_matakuliah.id_kelas');
        $this->db->join('mata_kuliah', 'mata_kuliah.id = kelas_matakuliah.id_mata_kuliah');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getKelas($idMataKuliah = false)
    {
        $this->load->database();
        if ($idMataKuliah == false) {
            // return $this->db->get('kelas_matakuliah')->result();
            $this->db->select('kelas_matakuliah.*, kelas.nama_kelas');
            $this->db->from('kelas_matakuliah');
            $this->db->join('kelas', 'kelas.id_kelas = kelas_matakuliah.id_kelas', 'left');
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }

        $this->db->select('kelas_matakuliah.*, kelas.nama_kelas');
        $this->db->from('kelas_matakuliah');
        $this->db->join('kelas', 'kelas.id_kelas = kelas_matakuliah.id_kelas', 'left');
        $this->db->where('kelas_matakuliah.id_mata_kuliah', $idMataKuliah);
        $query = $this->db->get();
        $result = $query->result_array();
        return array_column($result, 'nama_kelas');
    }

    public function getMataKuliah($idKelas = false)
    {
        $this->load->database();
        if ($idKelas == false) {
            $this->db->select('kelas_matakuliah.*, mata_kuliah.nama_mata_kuliah,mata_kuliah.kode_mata_kuliah');
            $this->db->from('kelas_matakuliah');
            $this->db->join('mata_kuliah', 'mata_kuliah.id = kelas_matakuliah.id_mata_kuliah', 'left');
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }

        $this->db->select('kelas_matakuliah.*, mata_kuliah.nama_mata_kuliah,mata_kuliah.kode_mata_kuliah');
        $this->db->from('kelas_matakuliah');
        $this->db->join('mata_kuliah', 'mata_kuliah.id = kelas_matakuliah.id_mata_kuliah', 'left');
        $this->db->where('kelas_matakuliah.id_kelas', $idKelas);
        $query = $this->db->get();
        $result = $query->result_array();
        return array_column($result, 'nama_kelas');
    }

    public function insert($data)
    {
        $this->load->database();
        if (empty($data)) {
            return false;
        }
        $insert = $this->db->insert('kelas_mata_kuliah', $data);
        return $insert;
    }
}
