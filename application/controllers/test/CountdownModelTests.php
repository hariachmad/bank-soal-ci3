<?php

class CountdownModelTests extends CI_Controller
{
        public function __construct() {
                parent::__construct();
                $this->load->model('CountdownModel');
        }

        public function index(){}


    public function testGetCountdown()
    {        
        $result = $this->CountdownModel->getCountdown(1);
        // assert : 60
        echo "testGetBab: " . $result . "<br>"; 
    }

    public function testSaveRemainingDuration(){
        $this->CountdownModel->saveRemainingDuration(1,60);
        echo "Success execute saveRemainingDuration";
    }

        
}