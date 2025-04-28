<?php

class BabModelTests extends CI_Controller
{
        public function __construct() {
                parent::__construct();
                $this->load->model('BabModel');
        }

        public function index(){}


    public function testInsertBab()
    {        
        $result = $this->BabModel->getBab(1);
        // equals : 1
        echo "testInsertBab: " . $result["nomor_bab"] . "<br>"; 
    }

        
}