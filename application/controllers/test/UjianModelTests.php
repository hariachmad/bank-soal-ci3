<?php

class UjianModelTests extends CI_Controller
{
        public function __construct() {
                parent::__construct();
                $this->load->model('UjianModel');
        }

        public function index(){}

        

        public function testInsertUjian(){
            $data= [
                'nama_ujian' => 'ujian logika algoritma',
                'deskripsi_ujian' => 'Ujian Dilakukan Secara Online',
                'waktu_tutup_ujian' => '15:00:00',
                'waktu_buka_ujian' => '13:00:00',
                'durasi_ujian' => 120,
                'nilai_minimum_kelulusan' => 70,
                'ruang_ujian' => 'AB1',
                'jumlah_soal' => 100,
                'random' => 0,
                'tunjukkan_nilai' => 1
            ];
            $id = $this->UjianModel->insert($data);
            //expected : 1
            echo "testInsertujian(1): " . $id . "<br>";
            $result = $this->UjianModel->getUjian($id);
            //expected : "ujian logika algoritma"
            echo "testInsertUjian(2): " . $result["nama_ujian"] . "<br>";
        }

}