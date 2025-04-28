<?php

class KodeUsersModelTests extends CI_Controller
{
        public function __construct() {
                parent::__construct();
                $this->load->model('KodeUsersModel');
        }

        public function index(){}

        public function testGetKode(){
            $result = $this->KodeUsersModel->getKode(1);
            // assert : 1A
            echo "testGetKode: " . $result . "<br>";
        }

        public function testGetUsers(){
            $result = $this->KodeUsersModel->getUsers(1);
            // assert : 1
            echo "testGetUsers: " . $result . "<br>";
        }

        public function testGetKodeUsersId(){
            $result = $this->KodeUsersModel->getKodeUsersId(1,'1A');
            // assert : 1
            echo "testGetKodeUsersId: " . $result . "<br>";
        }
        
}