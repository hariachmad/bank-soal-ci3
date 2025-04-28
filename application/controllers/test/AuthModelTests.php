<?php

class AuthModelTests extends CI_Controller
{
        public function __construct() {
                parent::__construct();
                $this->load->model('AuthModel');
        }

        public function index(){}

        public function testGetFullNameByUserName()
    {        
        $result = $this->AuthModel->getFullnameByUsername('hariachmad');
        echo "getFullnameByUsername: " . $result["username"] . "<br>";
    }

    public function testVerifyPassword(){
        $result = $this->AuthModel->verifyPassword('hariachmad','Oper@ti0n');
        echo "testVerifyPassword: " . $result . "<br>";
    }

        
}