<?php

class MataKuliahModelTests extends CI_Controller
{
        public function __construct() {
                parent::__construct();
                $this->load->model('MataKuliahModel');
        }

        public function index(){}

        public function testGetMataKuliah(){
            $result = $this->MataKuliahModel->getMataKuliah(1);
            echo "testGetKodeUsersId: " . $result["nama_mata_kuliah"] . "<br>";
        }

}