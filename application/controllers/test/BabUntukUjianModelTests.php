<?php

class BabUntukUjianModelTests extends CI_Controller
{
        public function __construct() {
                parent::__construct();
                $this->load->model('BabUntukUjianModel');
        }

        public function index(){}


    public function testGetBab()
    {        
        $result = $this->BabUntukUjianModel->getBab(1);
        // assert : 1
        echo "testGetBab: " . $result[0] . "<br>"; 
    }

        
}