<?php

class Mahasiswa extends CI_Controller
{
    // protected $MataKuliahModel;
    // protected $BabModel;
    // protected $SoalModel;
    // protected $UjianModel;
    // protected $KodeUjianModel;
    // protected $BabUntukUjianModel;
    // protected $KodeUsersModel;
    // protected $UserSoalUjianModel;
    // protected $UserNilaiModel;
    // protected $CountdownModel;
    // protected $helpers = ['form', 'auth'];

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('pagination');
    }


    // use ResponseTrait;

    // public function __construct()
    // {
    //     $this->MataKuliahModel = new MataKuliahModel();
    //     $this->BabModel = new BabModel();
    //     $this->UjianModel = new UjianModel();
    //     $this->SoalModel = new SoalModel();
    //     $this->KodeUjianModel = new KodeUjianModel();
    //     $this->BabUntukUjianModel = new BabUntukUjianModel();
    //     $this->KodeUsersModel = new KodeUsersModel();
    //     $this->UserSoalUjianModel = new UserSoalUjianModel();
    //     $this->UserNilaiModel = new UserNilaiModel();
    //     $this->CountdownModel = new CountdownModel();
    // }

    public function masukUjian()
    {
        $this->load->model('MataKuliahModel');
        $this->load->helper('form');
        $this->load->helper('url');
        $data = [
            'title' => 'Bank Soal',
            'mataKuliah' => $this->MataKuliahModel->getMataKuliah()
        ];

        $this->load->view('bankSoal/mahasiswa/masukUjian', $data);
    }
    public function mendaftarUjian()
    {
        $kodeUjian = $this->input->post('kode_ujian');
        $this->load->model('KodeUjianModel');
        $this->load->model('KodeUsersModel');
        // if (!$this->validate([
        //     'kode_ujian' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'Kode masih kosong.'
        //         ]
        //     ]

        // ])) {
        //     return redirect()->to('/ujian/masuk_ujian')->withInput();
        // }
        if ($this->KodeUjianModel->getKodeUjian($kodeUjian)) {
            if (!$this->KodeUsersModel->getKodeUsersId($this->session->userdata('id'), $kodeUjian)) {
                $this->KodeUsersModel->insert([
                    'id_users' => $this->session->userdata('id'),
                    'kode_ujian' => $kodeUjian,
                ]);
            }
            $kodeUsers = $this->KodeUsersModel->getKodeUsersId($this->session->userdata('id'), $kodeUjian);
            redirect('/ujian/detail_ujian/' . $kodeUsers);
        } else {
            // $validation = \Config\Services::validation();
            // $validation->setError('kode_ujian', 'Kode Salah');
            // $this->form_validation->set_error('Kode Salah');
            redirect('/ujian/masuk_ujian');
        }
    }
    public function detailUjian($id)
    {
        $this->load->database();
        $this->load->model('KodeUsersModel');
        $this->load->model('KodeUjianModel');
        $this->load->model('BabUntukUjianModel');
        $this->load->model('BabModel');
        $this->load->model('UjianModel');
        $kodeUjian = $this->KodeUsersModel->getKode($id);
        $idUjian = $this->KodeUjianModel->getUjian($kodeUjian[0]);

        // $idBabs = $this->BabUntukUjianModel->where('id_ujian', $idUjian)->findColumn('id_bab');
        $this->db->select('id_bab');
        $this->db->where('id_ujian', $idUjian);

        $query = $this->db->get('bab_untuk_ujian');
        $idBabs = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $idBabs[] = $row->id_bab;
            }
        }

        $sub_cpmk = array();
        foreach ($idBabs as $bab) {
            // $sub_cpmk[] = $this->BabModel->where('id', $bab)->findColumn('sub_cpmk')[0];
            $this->db->select('sub_cpmk');
            $this->db->where('id', $bab);
            $query = $this->db->get('bab');
            $idBabs = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $sub_cpmk[] = $row->sub_cpmk;
                }
            }
        }
        $data = [
            'title' => 'Bank Soal',
            'ujian' => $this->UjianModel->getUjian($idUjian)[0],
            'sub_cpmk' => $sub_cpmk,
            'id_kode_users' => $id
        ];

        if (empty($data['ujian'])) {
            throw new Exception('Id Sesi ' . $id . ' tidak ditemukan.');
        }

        $this->load->view('bankSoal/mahasiswa/detailUjian', $data);
    }
    public function randomize($id)
    {
        $this->load->model('KodeUsersModel');
        $this->load->model('KodeUjianModel');
        $this->load->model('BabUntukUjianModel');
        $this->load->model('UjianModel');
        $this->load->model('UserSoalUjianModel');
        $this->load->database();
        $kodeUjian = $this->KodeUsersModel->getKode($id);
        $id_ujian = $this->KodeUjianModel->getUjian($kodeUjian[0]);
        // $assignedBabs = $this->BabUntukUjianModel->where('id_ujian', $id_ujian)->findColumn('id_bab');
        $this->db->where('id_ujian', $id_ujian);
        $query = $this->db->select('id_bab')->get('bab_untuk_ujian');
        $assignedBabs = $query->result_array();
        //--------------------assign_babs adalah id bab yang dipakai untuk ujian-------------------
        // $questionCount = $this->UjianModel->where('id', $id_ujian)->findColumn('jumlah_soal')[0];
        $this->db->where('id', $id_ujian);
        $query = $this->db->select('jumlah_soal')->get('ujian');
        $questionCount = $query->result_array()[0];
        // $random = $this->UjianModel->where('id', $id_ujian)->findColumn('random')[0];
        $this->db->where('id', $id_ujian);
        $query = $this->db->select('random')->get('ujian');
        $random = $query->result_array()[0];
        $randomizedSoal = [];
        $randomSoal = [];
        $questionPerBab = round((int) $questionCount / count($assignedBabs));
        foreach ($assignedBabs as $index => $assignedBab) {
            // $allSoal = $this->SoalModel->where('id_bab', $assignedBab)->findAll();
            $this->load->database();
            $allSoal = $this->db->where('id_bab', $assignedBab["id_bab"])->get('soal')->result_array();
            if (false) {
                shuffle($allSoal);
            }
            if ($index == count($assignedBabs) - 1) {
                $randomSoal = array_slice($allSoal, 0, (int) $questionCount["jumlah_soal"]);

            } else {
                $randomSoal = array_slice($allSoal, 0, $questionPerBab);
                $questionCount = (int) $questionCount - (int) $questionPerBab;
            }
            $randomizedSoal = array_merge($randomizedSoal, $randomSoal);
        }
        // $recordExists = false;
        foreach ($randomizedSoal as $soal) {
            $idSoal = $soal["id"];
            // $existingRecord = $this->UserSoalUjianModel
            //     ->where('id_soal', $idSoal)
            //     ->where('id_kode_users', $id)
            //     ->first();

            $existingRecord = $this->db
                ->where('id_soal', $idSoal)
                ->where('id_kode_users', $id)
                ->get('user_soal_ujian')
                ->row();

            if (empty($existingRecord)) {
                // Set the flag to true if an existing record is found
                // $recordExists = true;
                // No need to continue the loop, as we found an existing record
                // break;
                $this->UserSoalUjianModel->insert([
                    'id_soal' => $idSoal,
                    'id_kode_users' => $id,
                ]);
            }
        }

        // Insert the record only if the flag remains false
        // if (!$recordExists) {
        //     foreach ($randomizedSoal as $soal) {
        //         $idSoal = $soal->id;
        //         $this->UserSoalUjianModel->insert([
        //             'id_soal' => $idSoal,
        //             'id_kode_users' => $id,
        //         ]);
        //     }
        // }
    }
    public function simpanJawabanDipilih()
    {
        $this->load->database();
        // $this->UserSoalUjianModel->where('id_kode_users', $this->request->getPost('id_kode_users'))
        //     ->where('id_soal', $this->request->getPost('id_soal'))
        //     ->set(['jawaban_dipilih' => $this->request->getPost('jawaban_dipilih')])
        //     ->update();

        $this->db->where('id_kode_users', $this->input->post('id_kode_users'))
            ->where('id_soal', $this->input->post('id_soal'))
            ->set('jawaban_dipilih', $this->input->post('jawaban_dipilih'))
            ->update('user_soal_ujian');

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['success' => true]));
    }

    public function saveRemainingDuration()
    {
        $idKodeUsers = $this->request->getPost('idKodeUsers');
        $remainingDuration = $this->request->getPost('remainingDuration');

        $this->CountdownModel->saveRemainingDuration($idKodeUsers, $remainingDuration);

        // Return a response if needed
        return $this->response->setJSON(['success' => true]);
    }
    public function mulaiUjian($id)
    {
        $this->load->database();
        $this->load->model('KodeUsersModel');
        $this->load->model('KodeUjianModel');
        $this->load->model('UserSoalUjianModel');
        $this->load->model('CountdownModel');
        $this->load->model('UjianModel');
        $this->load->model('SoalModel');

        $kodeUjian = $this->KodeUsersModel->getKode($id);
        $idUjian = $this->KodeUjianModel->getUjian($kodeUjian[0]);
        Mahasiswa::randomize($id);
        $selectedQuestionIds = $this->UserSoalUjianModel->getSoalId($id);
        $selectedAnswers = $this->UserSoalUjianModel->getSoalIdAndJawabanDipilih($id);
        $remainingTime = $this->CountdownModel->getCountdown($id);

        $currentPage = $this->input->get('page_soal') ? $this->input->get('page_soal') + 1 : 1;

        $config['base_url'] = base_url('index.php/Mahasiswa/mulaiUjian/' . $id);
        $config['total_rows'] = count($selectedQuestionIds);
        $config['per_page'] = 1;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page_soal';
        $this->pagination->initialize($config);

        $offset = ($currentPage - 1) * $config['per_page'];
        $this->db->where_in('id', $selectedQuestionIds);
        $this->db->limit($config['per_page'], $offset);
        $soal = $this->db->get('soal')->result();

        $data = array(
            'title' => 'Bank Soal',
            'ujian' => $this->UjianModel->getUjian($idUjian),
            'soal' => $soal,
            'pager' => $this->pagination->create_links(),
            'currentPage' => $currentPage,
            'jawaban' => $selectedAnswers,
            'serverTime' => date("H:i:s"),
            'remainingTime' => $remainingTime,
            'id' => $id
        );

        $this->load->view('bankSoal/mahasiswa/mulaiUjian', $data);
    }
    public function hasilUjian($id)
    {
        $this->load->database();
        $this->load->model('KodeUsersModel');
        $this->load->model('KodeUjianModel');
        $this->load->model('UjianModel');
        $this->load->model('UserSoalUjianModel');
        $this->load->model('BabUntukUjianModel');
        $this->load->model('UserNilaiModel');
        $this->load->model('BabModel');
        $kodeUjian = $this->KodeUsersModel->getKode($id);
        $idUjian = $this->KodeUjianModel->getUjian($kodeUjian[0]);
        $idUsers = $this->KodeUsersModel->getUsers($id);
        $ujian = $this->UjianModel->getUjian($idUjian);
        $soalIdAndJawaban = $this->UserSoalUjianModel->getSoalIdAndJawabanDipilih($id);
        $soalId = array_column($soalIdAndJawaban, 'id_soal');
        // $soals = $this->SoalModel->whereIn('id', $soalId)->findAll();
        $this->db->where_in('id', $soalId);
        $soals = $this->db->get('soal')->result_array();
        $jawabanDipilih = [];

        foreach ($soals as $soal) {
            $jawaban = null;
            foreach ($soalIdAndJawaban as $soalIdAndJawabans) {
                if ($soalIdAndJawabans['id_soal'] === $soal['id']) {
                    $jawaban = $soalIdAndJawabans['jawaban_dipilih'];
                    break;
                }
            }
            $isCorrect = ($jawaban === $soal['jawaban_benar']);
            array_push($jawabanDipilih, $isCorrect);
        }
        $jawabanBenar = array_sum($jawabanDipilih);
        $nilai = ($jawabanBenar / count($jawabanDipilih)) * 100;
        $existingRecord = $this->UserNilaiModel->getNilai($idUsers, $idUjian);

        if ($existingRecord && $existingRecord['nilai'] < $nilai) {
            // $this->UserNilaiModel->update($existingRecord['id'], ['nilai' => $nilai]);
            $this->db->where('id', $existingRecord['id']);
            $this->db->update('user_nilai', ['nilai' => $nilai]);
        } elseif (!$existingRecord) {
            // $this->UserNilaiModel->insert([
            //     'id_users' => $idUsers,
            //     'id_ujian' => $idUjian,
            //     'nilai' => $nilai
            // ]);
            $this->db->insert('user_nilai', [
                'id_users' => $idUsers,
                'id_ujian' => $idUjian,
                'nilai' => $nilai
            ]);
        }

        // $idBabs = $this->BabUntukUjianModel->where('id_ujian', $idUjian)->findColumn('id_bab');
        $this->db->select('id_bab');
        $this->db->where('id_ujian', $idUjian);
        $query = $this->db->get('bab_untuk_ujian');
        $idBabs = array_column($query->result_array(), 'id_bab');
        $sub_cpmk = [];
        $jumlah_soal_per_sub_cpmk = [];
        $jumlah_benar_per_sub_cpmk = [];

        foreach ($idBabs as $bab) {
            // $sub_cpmk[] = $this->BabModel->where('id', $bab)->findColumn('sub_cpmk')[0];
            $this->db->select('sub_cpmk');
            $this->db->where('id', $bab);
            $query = $this->db->get('bab');
            $result = $query->result_array();

            $sub_cpmk = array_column($result, 'sub_cpmk');

            $count_jumlah_soal = 0;
            $count_jumlah_benar = 0;
            foreach ($soals as $soal) {
                if ($soal['id_bab'] == $bab) {
                    $count_jumlah_soal += 1;
                    $jawaban = null;
                    foreach ($soalIdAndJawaban as $soalIdAndJawabans) {
                        if ($soalIdAndJawabans['id_soal'] === $soal['id']) {
                            $jawaban = $soalIdAndJawabans['jawaban_dipilih'];
                            break;
                        }
                    }
                    $isCorrect = ($jawaban === $soal['jawaban_benar']);
                    if ($isCorrect) {
                        $count_jumlah_benar += 1;
                    }
                }
            }

            $jumlah_soal_per_sub_cpmk[] = $count_jumlah_soal;
            $jumlah_benar_per_sub_cpmk[] = $count_jumlah_benar;
        }

        $combinedArray = [];

        for ($i = 0; $i < count($sub_cpmk); $i++) {
            $combinedArray[] = [$sub_cpmk[$i], $jumlah_benar_per_sub_cpmk[$i], $jumlah_soal_per_sub_cpmk[$i],];
        }

        $data = [
            'title' => 'Bank Soal',
            'nilai' => $nilai,
            'ujian' => $ujian,
            'soalUjian' => $soals,
            'soalIdAndJawaban' => $soalIdAndJawaban,
            'jawabanBenar' => $jawabanBenar,
            'sub_cpmk' => $combinedArray,
            'id' => $id
        ];


        
        $this->load->view('bankSoal/mahasiswa/hasilUjian', $data);
    }
}
