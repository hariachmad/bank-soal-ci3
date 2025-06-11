<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'..\vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Ujian extends CI_Controller
{
    
    // protected $MataKuliahModel;
    // protected $BabModel;
    // protected $SoalModel;
    // protected $UjianModel;
    // protected $KodeUjianModel;
    // protected $BabUntukUjianModel;
    // protected $UserNilaiModel;
    // protected $UsersModel;
    // protected $helpers = ['form'];
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        // $this->MataKuliahModel = new MataKuliahModel();
        // $this->BabModel = new BabModel();
        // $this->SoalModel = new SoalModel();
        // $this->UjianModel = new UjianModel();
        // $this->KodeUjianModel = new KodeUjianModel();
        // $this->BabUntukUjianModel = new BabUntukUjianModel();
        // $this->UsersModel = new UsersModel();
        // $this->UserNilaiModel = new UserNilaiModel();
    }

    public function tambahUjian($id)
    {
        $this->load->model('BabModel');
        $data = [
            'title' => 'Bank Soal',
            'id' => $id,
            'bab' => $this->BabModel->getBab(),
            'session' => ["fullname" => $this->session->userdata("fullname")],
        ];

        $this->load->view('bankSoal/dosen/ujian/tambahUjian', $data);
    }

    public function detailUjian($id_mata_kuliah, $id)
    {
        $this->load->model('BabUntukUjianModel');
        $this->load->model('BabModel');
        $filteredData = $this->BabUntukUjianModel->findAll($id);
        $babData = [];
        foreach ($filteredData as $row) {
            $idBab = $row['id_bab'];
            $bab = $this->BabModel->find($idBab);
            if ($bab) {
                $babData = $bab;
            }
        }

        $this->load->model('UjianModel');
        $this->load->model('SoalModel');
        $this->load->model('KodeUjianModel');
        $data = [
            'title' => 'Bank Soal',
            'id_mata_kuliah' => $id_mata_kuliah,
            'ujian' => $this->UjianModel->getUjian($id)[0],
            'soal_model' => $this->SoalModel->getSoal(),
            'bab_data' => $babData,
            'kode_ujian' => $this->KodeUjianModel->getKodeUjianByUjian($id),
        ];
        if (empty($data['ujian'])) {
            throw new Exception('Id Soal Ujian ' . $id . ' tidak ditemukan.');
        }

        $this->load->view('bankSoal/dosen/ujian/detailUjian', $data);
    }

    public function ubahUjian($id_mata_kuliah, $id)
    {
        $this->load->model('UjianModel');
        $this->load->model('BabModel');
        $this->load->model('BabUntukUjianModel');
        $data = [
            'title' => 'Bank Soal',
            'ujian' => $this->UjianModel->getUjian($id)[0],
            'id' => $id_mata_kuliah,
            'bab' => $this->BabModel->getBab(),
            'bab_untuk_ujian' => $this->BabUntukUjianModel->getBab($id)
        ];

        $this->load->view('bankSoal/dosen/ujian/ubahUjian', $data);
    }

    public function hapusUjian($id_mata_kuliah, $id)
    {
        $this->load->model('UjianModel');
        $this->UjianModel->delete($id);
        $this->session->set_flashdata('pesan', 'Ujian berhasil dihapus');
        redirect('/bankSoal/' . $id_mata_kuliah);
    }

    public function simpanUjian($id)
    {
        $this->load->database();
        $this->load->model('UjianModel');
        $this->load->model('BabUntukUjianModel');
        $query = $this->db->select('nama_ujian')
            ->from('ujian')
            ->where('id_mata_kuliah', $id)
            ->where('nama_ujian', $this->input->post('nama_ujian'));
        $result = $query->get()->result_array();
        if ($result) {
            $same_nama = array_filter($result, function ($row) {
                return $row['nama_ujian'] === $this->input->post('nama_ujian');
            });
            $rules_nama_ujian = $same_nama ? 'required|is_unique[ujian.nama_ujian]' : 'required';
        } else {
            $rules_nama_ujian = 'required';
        }
        // if (!$this->validate([
        //     'nama_ujian' => [
        //         'rules' => $rules_nama_ujian,
        //         'errors' => [
        //             'required' => 'Nama Ujian harus diisi.',
        //             'is_unique' => 'Nama Ujian sudah ada.'
        //         ]
        //     ],

        // ])) {
        //     return redirect()->to('/banksoal/' . $id . '/tambah_ujian')->withInput();
        // }
        $waktu_buka_ujian = $this->input->post('waktu_buka_ujian');
        $waktu_tutup_ujian = $this->input->post('waktu_tutup_ujian');
        $random = isset($_POST['random']) ? 1 : 0;
        $tunjukkan_nilai = isset($_POST['tunjukkan_nilai']) ? 1 : 0;
        $pilih_soal = $this->input->post('bab');
        $this->UjianModel->insert([
            'nama_ujian' => $this->input->post('nama_ujian'),
            'deskripsi_ujian' => $this->input->post('deskripsi_ujian'),
            'waktu_buka_ujian' => date('Y-m-d H:i:s', strtotime($waktu_buka_ujian)),
            'waktu_tutup_ujian' => date('Y-m-d H:i:s', strtotime($waktu_tutup_ujian)),
            'durasi_ujian' => $this->input->post('durasi_ujian'),
            'nilai_minimum_kelulusan' => $this->input->post('nilai_minimum_kelulusan'),
            'jumlah_soal' => $this->input->post('jumlah_soal'),
            'random' => $random,
            'tunjukkan_nilai' => $tunjukkan_nilai,
            'ruang_ujian' => $this->input->post('ruang_ujian'),
            'id_mata_kuliah' => $id
        ]);
        $insert_id = $this->db->insert_id();
        foreach ($pilih_soal as $value) {
            $this->BabUntukUjianModel->insert([
                'id_bab' => $value,
                'id_ujian' => $insert_id
            ]);
        }

        $this->session->set_flashdata('pesan_ujian', 'Ujian berhasil ditambahkan');
        redirect('/bankSoal/' . $id);
    }

    public function updateUjian($id_mata_kuliah, $id)
    {
        $this->load->database();
        $this->load->model('UjianModel');
        $this->load->model('BabUntukUjianModel');
        $ruang_ujian = $this->input->post('ruang_ujian');
        if ((null == $ruang_ujian)) {
            $ruang_ujian = null;
        }
        $random = (null !== ($this->input->post('random')) ? 1 : 0);
        $tunjukkan_nilai = (null !== ($this->input->post('tunjukkan_nilai')) ? 1 : 0);
        $waktu_buka_ujian = $this->input->post('waktu_buka_ujian');
        $waktu_tutup_ujian = $this->input->post('waktu_tutup_ujian');
        $ujianLama = $this->UjianModel->getUjian($id);
        if (
            $ujianLama['nama_ujian'] == $this->input->post('nama_ujian')
            && $ujianLama['deskripsi_ujian'] == $this->input->post('deskripsi_ujian')
            && $ujianLama['waktu_buka_ujian'] == date('Y-m-d H:i:s', strtotime($waktu_buka_ujian))
            && $ujianLama['waktu_tutup_ujian'] == date('Y-m-d H:i:s', strtotime($waktu_tutup_ujian))
            && $ujianLama['durasi_ujian'] == $this->input->post('durasi_ujian')
            && $ujianLama['nilai_minimum_kelulusan'] == $this->request->getVar('nilai_minimum_kelulusan')
            && $ujianLama['ruang_ujian'] == $this->input->post('ruang_ujian')
            && $ujianLama['jumlah_soal'] == $this->input->post('jumlah_soal')
            && $ujianLama['random'] == $this->input->post('random')
            && $ujianLama['tunjukkan_nilai'] == $this->input->post('tunjukkan_nilai')
        ) {
            redirect('/banksoal/' . $id_mata_kuliah . '/ubah_ujian/' . $id)->withInput();
        }

        $this->UjianModel->save($id, [
            'nama_ujian' => $this->input->post('nama_ujian'),
            'deskripsi_ujian' => $this->input->post('deskripsi_ujian'),
            'waktu_buka_ujian' => date('Y-m-d H:i:s', strtotime($waktu_buka_ujian)),
            'waktu_tutup_ujian' => date('Y-m-d H:i:s', strtotime($waktu_tutup_ujian)),
            'durasi_ujian' => $this->input->post('durasi_ujian'),
            'nilai_minimum_kelulusan' => $this->input->post('nilai_minimum_kelulusan'),
            'ruang_ujian' => $ruang_ujian,
            'jumlah_soal' => $this->input->post('jumlah_soal'),
            'random' => $random,
            'tunjukkan_nilai' => $tunjukkan_nilai,
            'id_mata_kuliah' => $id_mata_kuliah
        ]);

        $pilih_soal = $this->input->post('bab');

        $bab_untuk_ujian = $this->BabUntukUjianModel->getBab($id);

        foreach ($pilih_soal as $bab_id) {
            $found = false;
            foreach ($bab_untuk_ujian as $row) {
                if ($row == $bab_id) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $this->BabUntukUjianModel->insert(['id_ujian' => $id, 'id_bab' => $bab_id]);
            }
        }
        foreach ($bab_untuk_ujian as $row) {
            $found = false;
            foreach ($pilih_soal as $bab_id) {
                if ($row == $bab_id) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                // $this->BabUntukUjianModel->where('id_ujian', $id)->where('id_bab', $row)->delete();
                $this->db->where('id_ujian', $id)->where('id_bab', $row)->delete('nama_tabel_bab_untuk_ujian');
            }
        }
        $this->session->set_flashdata('pesan', 'Ujian berhasil diubah');
        redirect('bankSoal/' . $id_mata_kuliah);
    }

    public function saveCode()
    {
        $this->load->model('KodeUjianModel');
        $kode_ujian = $this->input->post('kode_ujian');
        $id_ujian = $this->input->post('id_ujian');

        $this->KodeUjianModel->insert([
            'kode_ujian' => $kode_ujian,
            'id_ujian' => $id_ujian
        ]);

        return $this->response->setJSON(['success' => true]);
    }

    public function exportToExcel($id)
    {
        $this->load->model("UjianModel");
        $this->load->model("UserNilaiModel");
        $this->load->model("UsersModel");
        $ujian = $this->UjianModel->getUjian($id)[0];
        $namaUjian = $ujian['nama_ujian'];
        $stringLowercase = strtolower($namaUjian);
        $stringWithUnderscores = str_replace(' ', '_', $stringLowercase);


        // $nilai = $this->UserNilaiModel->where('id_ujian', $id)->findAll();
        $this->db->where('id_ujian', $id);
        $nilai = $this->db->get('user_nilai')->result_array;

        // Create a new Spreadsheet object

        $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        // Set the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Add headers to the first row
        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'NIM');
        $sheet->setCellValue('C1', 'Nilai');
        $sheet->setCellValue('D1', 'Tanggal');

        // Iterate over the results and add them to the spreadsheet
        $row = 2;
        foreach ($nilai as $result) {
            $user = $this->UsersModel->GetUser($result['id_users']);
            $nama_user = $user['fullname'];
            $username_user = $user['username'];
            $sheet->setCellValue('A' . $row, $nama_user);
            $sheet->setCellValue('B' . $row, $username_user);
            $sheet->setCellValue('C' . $row, $result['nilai']);
            $sheet->setCellValue('D' . $row, $result['updated_at']);
            $row++;
        }

        // Create a new Excel file writer
        $writer = new Xlsx($spreadsheet);

        // Set the appropriate headers for the response
        $fileName = 'hasil_ujian_' . $stringWithUnderscores . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        // Save the spreadsheet file to the response output
        $writer->save('php://output');
        die;
    }

    public function hasilUjian(){
        $this->load->model('UjianModel');
        $payload = [
            'mata_kuliah' => $this->input->post('mata_kuliah'),
            'id_user' => $this->input->post('id_user'),
            'kode_ujian' => $this->input->post('kode_ujian')
        ];
        $data =[
            'hasil_ujian' => $this->UjianModel->hasilUjian($payload)
        ];
        $this->load->view('banksoal/dosen/ujian/HasilUjian', $data);
    }

    public function formHasilUjian(){
        $this->load->model('UjianModel');
        $payload = [
            'mata_kuliah' => '',
            'id_user' => '',
            'kode_ujian' => ''
        ];
        $data =[
            'hasil_ujian' => $this->UjianModel->hasilUjian($payload)
        ];
        $this->load->view('banksoal/dosen/ujian/formHasilUjian', $data);
    }
}
