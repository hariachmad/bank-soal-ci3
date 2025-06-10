<?php

class MataKuliah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('url');
        // $this->load->library('pagination');
    }

    public function simpanMataKuliah()
    {
        try {
            $this->load->model('MataKuliahModel');
            $data = [
                'nama_mata_kuliah' => $this->input->post('nama_mata_kuliah'),
                'kode_mata_kuliah' => $this->input->post('kode_mata_kuliah')
            ];
            $result = $this->MataKuliahModel->insert($data);
            if (!$result) {
                $this->session->set_flashdata('pesan', 'Mata kuliah gagal ditambahkan');
                redirect('/banksoal/');
            }
        } catch (Exception $e) {
            var_dump($e);
            exit();
        }

        $this->session->set_flashdata('pesan', 'Mata kuliah berhasil ditambahkan');
        redirect('/banksoal/');
    }

    public function deleteMataKuliah($id)
    {
        try {
            $this->load->model('MataKuliahModel');
            $result = $this->MataKuliahModel->delete($id);
            if (!$result) {
                $this->session->set_flashdata('pesan', 'Mata kuliah gagal dihapus');
                redirect('/banksoal/');
            }
        } catch (Exception $e) {
            var_dump($e);
            exit();
        }

        $this->session->set_flashdata('pesan', 'Mata kuliah berhasil dihapus');
        redirect('/banksoal/');
    }
}
