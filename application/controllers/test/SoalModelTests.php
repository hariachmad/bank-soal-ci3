<?php

class SoalModelTests extends CI_Controller
{
        public function __construct() {
                parent::__construct();
                $this->load->model('SoalModel');
        }

        public function index(){}

        public function testGetSoal(){
            $result = $this->SoalModel->getSoal(1);
            //expected : "jawaban_a"
            echo "testgetSoal: " . $result["jawaban_benar"] . "<br>";
        }

}