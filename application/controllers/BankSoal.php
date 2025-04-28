<?php

class BankSoal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->model('MataKuliahModel');
        $data = [
            'title' => 'Bank Soal',
            'mataKuliah' => $this->MataKuliahModel->getMataKuliah(),
            'session' => ["fullname" => $this->session->userdata("fullname")],
        ];

        $this->load->view('bankSoal/dosen/index', $data);
    }

    public function daftarBab($id)
    {
        $this->load->model('MataKuliahModel');
        $this->load->model('BabModel');
        $this->load->model('UjianModel');
        $data = [
            'title' => 'Bank Soal',
            'mataKuliah' => $this->MataKuliahModel->getMataKuliah($id)[0],
            'bab' => $this->BabModel->getBab(),
            'ujian' => $this->UjianModel->getUjian()
        ];

        if (empty($data['mataKuliah'])) {
            throw new Exception('Id Mata Kuliah ' . $id . ' tidak ditemukan.');
        }

        $this->load->view('bankSoal/dosen/bab/daftarBab', $data);
    }

    public function tambahBab($id)
    {
        $data = [
            'title' => 'Bank Soal',
            'id' => $id
        ];

        $this->load->view('bankSoal/dosen/bab/tambahBab', $data);
    }

    public function simpanBab($id)
    {
        $this->load->database();
        $this->load->model('BabModel');
        $query =$this->db->select('nama_bab, nomor_bab')
        ->from('bab')
        ->where('id_mata_kuliah', $id)
        ->where('nama_bab', $this->input->post('nama_bab'))
        ->or_where('nomor_bab', $this->input->post('nomor_bab'))
        ->where('id_mata_kuliah', $id);
        $result = $query->get()->result_array();
        if ($result) {
            $same_nama = array_filter($result, function ($row) {
                return $row['nama_bab'] === $this->input->post('nama_bab');
            });
            $same_nomor = array_filter($result, function ($row) {
                return $row['nomor_bab'] === $this->input->post('nomor_bab');
            });
            $rules_nama_bab = $same_nama ? 'required|is_unique[bab.nama_bab]' : 'required';
            $rules_nomor_bab = $same_nomor ? 'required|is_unique[bab.nomor_bab]' : 'required';
        } else {
            $rules_nama_bab = 'required';
            $rules_nomor_bab = 'required';
        }
        // if (!$this->validate([
        //     'nomor_bab' => [
        //         'rules' => $rules_nomor_bab,
        //         'errors' => [
        //             'required' => 'Nomor Bab harus diisi.',
        //             'is_unique' => 'Nomor Bab sudah ada.'
        //         ]
        //     ],
        //     'nama_bab' => [
        //         'rules' => $rules_nama_bab,
        //         'errors' => [
        //             'required' => 'Nama Bab harus diisi.',
        //             'is_unique' => 'Nama Bab sudah ada.'
        //         ]
        //     ],

        // ])) {
        //     return redirect()->to('/banksoal/' . $id . '/tambah_bab')->withInput();
        // }
        $this->BabModel->insert([
            'nomor_bab' => $this->input->post('nomor_bab'),
            'nama_bab' => $this->input->post('nama_bab'),
            'sub_cpmk' => $this->input->post('sub_cpmk'),
            'id_mata_kuliah' => $id
        ]);
        $this->session->set_flashdata('pesan_bab', 'Bab berhasil ditambahkan');
        redirect('/bankSoal/' . $id);
    }

    public function hapusBab($id_mata_kuliah, $id)
    {
        $this->load->model('BabModel');
        $this->BabModel->delete($id);
        $this->session->set_flashdata('pesan', 'Bab berhasil dihapus');
        redirect('/bankSoal/' . $id_mata_kuliah);
    }

    public function ubahBab($id_mata_kuliah, $id)
    {
        $this->load->model('BabModel');
        $data = [
            'title' => 'Bank Soal',
            'bab' => $this->BabModel->getBab($id)[0],
            'id' => $id_mata_kuliah
        ];
        $this->load->view('bankSoal/dosen/bab/ubahBab', $data);
    }

    public function updateBab($id_mata_kuliah, $id)
    {
        $this->load->model('BabModel');
        $babLama = $this->BabModel->getBab($id)[0];
        if ($babLama['nomor_bab'] == $this->input->post('nomor_bab') && $babLama['nama_bab'] == $this->input->post('nama_bab') && $babLama['sub_cpmk'] == $this->input->post('sub_cpmk')) {
            redirect('/bankSoal/' . $id_mata_kuliah . '/ubah_bab/' . $id)->withInput();
            exit();
        }

        $this->BabModel->save($id,[
            'nomor_bab' => $this->input->post('nomor_bab'),
            'nama_bab' => $this->input->post('nama_bab'),
            'sub_cpmk' => $this->input->post('sub_cpmk'),
            'id_mata_kuliah' => $id_mata_kuliah,
        ]);
        $this->session->set_flashdata('pesan_bab', 'Bab berhasil diubah');
        redirect('/bankSoal/' . $id_mata_kuliah);
    }
}
