<?php

class UserNilaiModelTests extends CI_Controller
{
        public function __construct() {
                parent::__construct();
                $this->load->model('UserNilaiModel');
        }

        public function index(){}

        public function testGetNilai(){
            $result = $this->UserNilaiModel->getNilai(1,1);
            //expected : 80
            echo "testGetNilai: " . $result["nilai"] . "<br>";
        }

}