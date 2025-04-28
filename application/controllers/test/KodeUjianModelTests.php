<?php

class KodeUjianModelTests extends CI_Controller
{
        public function __construct() {
                parent::__construct();
                $this->load->model('KodeUjianModel');
        }

        public function index(){}


    public function testGetKodeUjian(){
        $result = $this->KodeUjianModel->getKodeUjian(1);
        // assert : 1A
        echo "testGetKodeUjian: " . $result . "<br>"; 
    }

    public function testGetUjian(){
        $result = $this->KodeUjianModel->getUjian("1A");
        // assert : 1
        echo "testGetUjian: " . $result . "<br>"; 
    }

    public function testGetKodeUjianByUjian(){
        $result = $this->KodeUjianModel->getKodeUjianByUjian(1);
        // assert : 1A
        echo "testGetKodeUjianByUjian: " . $result . "<br>";
    }

        
}