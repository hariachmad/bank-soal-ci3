<?php

class UserSoalUjianModelTests extends CI_Controller
{
        public function __construct() {
                parent::__construct();
                $this->load->model('UserSoalUjianModel');
        }

        public function index(){}

        public function testGetUjian(){
            $result = $this->UserSoalUjianModel->getSoalId(1);
            //expected : 1
            echo "testGetUjian: " . $result[0] . "<br>";
        }

        public function testGetSoalIdAndJawabanDipilih(){
            $result = $this->UserSoalUjianModel->getSoalIdAndJawabanDipilih(1);
            var_dump($result[0]);
        }

}