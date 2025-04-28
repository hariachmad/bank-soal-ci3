<?php


class Soal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function daftarSoal($id_mata_kuliah, $id)
    {
        $this->load->model('BabModel');
        $this->load->model('SoalModel');
        $data = [
            'title' => 'Bank Soal',
            'id_mata_kuliah' => $id_mata_kuliah,
            'bab' => $this->BabModel->getBab($id)[0],
            'soal' => $this->SoalModel->getSoal()
        ];

        if (empty($data['bab'])) {
            throw new Exception('Id Bab ' . $id . ' tidak ditemukan.');
        }

        $this->load->view('bankSoal/dosen/soal/daftarSoal', $data);
    }

    public function tambahSoal($id_mata_kuliah, $id)
    {
        $data = [
            'title' => 'Bank Soal',
            // 'validation' => \Config\Services::validation(),
            'id_mata_kuliah' => $id_mata_kuliah,
            'id' => $id
        ];
        $this->load->helper('form');
        $this->load->view('bankSoal/dosen/soal/tambahSoal', $data);
    }

    public function simpanSoal($id_mata_kuliah, $id)
    {

        // $validasi = false;
        // $soal = $this->SoalModel->getSoal();
        // foreach ($soal as $k) {
        //     if ($k['id_bab'] == $id) {
        //         $validasi = true;
        //     }
        // }
        // if ($validasi) {
        //     if (!$this->validate([
        //         'soal' => [
        //             'rules' => 'required|is_unique[soal.soal]',
        //             'errors' => [
        //                 'required' => 'Soal harus diisi.',
        //                 'is_unique' => 'Soal Bab sudah ada.'
        //             ]
        //         ],

        //     ])) {
        //         return redirect()->to('/banksoal/' . $id_mata_kuliah . '/bab/' . $id . '/tambah_soal')->withInput();
        //     }
        // }

        try {
            $this->load->model('SoalModel');
            $this->SoalModel->insert([
                'soal' => "Manusia bernafas menggunakan?",
                'jawaban_a' => $this->input->post('jawaban_a'),
                'jawaban_b' => $this->input->post('jawaban_b'),
                'jawaban_c' => $this->input->post('jawaban_c'),
                'jawaban_d' => $this->input->post('jawaban_d'),
                'jawaban_benar' => $this->input->post('jawaban_benar'),
                'id_bab' => $id
            ]);
        } catch (Exception $e) {
            var_dump($e);
            exit();
        }


        $this->session->set_flashdata('pesan', 'Soal berhasil ditambahkan');
        redirect('/bankSoal/' . $id_mata_kuliah . '/bab/' . $id);
    }

    public function hapusSoal($id_mata_kuliah, $id_bab, $id)
    {
        $this->load->model('SoalModel');
        $this->SoalModel->delete($id);
        $this->session->set_flashdata('pesan', 'Soal berhasil dihapus');
        redirect('/banksoal/' . $id_mata_kuliah . '/bab/' . $id_bab);
    }

    public function ubahSoal($id_mata_kuliah, $id_bab, $id)
    {
        $this->load->model('SoalModel');
        $data = [
            'title' => 'Bank Soal',
            // 'validation' => \Config\Services::validation(),
            'soal' => $this->SoalModel->getSoal($id)[0],
            'id_mata_kuliah' => $id_mata_kuliah,
            'id_bab' => $id_bab
        ];

        $this->load->view('bankSoal/dosen/soal/ubahSoal', $data);
    }

    public function updateSoal($id_mata_kuliah, $id_bab, $id)
    {
        $soalLama = $this->SoalModel->getSoal($id);
        if (
            $soalLama['soal'] == $this->request->getVar('soal')
            && $soalLama['jawaban_a'] == $this->request->getVar('jawaban_a')
            && $soalLama['jawaban_b'] == $this->request->getVar('jawaban_b')
            && $soalLama['jawaban_c'] == $this->request->getVar('jawaban_c')
            && $soalLama['jawaban_d'] == $this->request->getVar('jawaban_d')
            && $soalLama['jawaban_benar'] == $this->request->getVar('jawaban_benar')
        ) {
            return redirect()->to('/banksoal/' . $id_mata_kuliah . '/bab/' . $id_bab . '/ubah_soal/' . $id)->withInput();
        }

        $this->SoalModel->save([
            'id' => $id,
            'soal' => $this->request->getVar('soal'),
            'jawaban_a' => $this->request->getVar('jawaban_a'),
            'jawaban_b' => $this->request->getVar('jawaban_b'),
            'jawaban_c' => $this->request->getVar('jawaban_c'),
            'jawaban_d' => $this->request->getVar('jawaban_d'),
            'jawaban_benar' => $this->request->getVar('jawaban_benar'),
            'id_bab' => $id_bab,
        ]);
        session()->setFlashdata('pesan', 'Soal berhasil diubah');
        return redirect()->to('/banksoal/' . $id_mata_kuliah . '/bab/' . $id_bab);
    }

    public function detailSoal($id_mata_kuliah, $id_bab, $id)
    {
        $this->load->model('BabModel');
        $this->load->model('SoalModel');
        $data = [
            'title' => 'Bank Soal',
            'soal' => $this->SoalModel->getSoal($id),
            'id_mata_kuliah' => $id_mata_kuliah,
            'id_bab' => $id_bab,
            'bab' => $this->BabModel->getBab($id_bab)
        ];

        if (empty($data['soal'])) {
            throw new Exception('Id Bab ' . $id . ' tidak ditemukan.');
        }

        $this->load->view('bankSoal/dosen/soal/detailSoal', $data);
    }

    function uploadGambar()
    {
        if ($this->request->getFile('file')) {
            $dataFile = $this->request->getFile('file');
            $fileName = $dataFile->getRandomName();
            $dataFile->move("uploads/berkas/", $fileName);
            echo base_url("uploads/berkas/$fileName");
        }
    }

    function deleteGambar()
    {
        $src = $this->request->getVar('src');
        if ($src) {
            $file_name = str_replace(base_url() . "/", "", $src);
            if (unlink($file_name)) {
                echo "Delete file berhasil";
            }
        }
    }
}
