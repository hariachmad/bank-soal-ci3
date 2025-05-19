<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        //   
    }

    public function logout()
    {
        $this->load->view("auth/login");   
    }

    public function viewRegister()
    {
        $this->load->view("auth/register");
    }

    public function register()
    {
        $this->load->helper('url');
        $this->load->model('AuthModel');
        $this->load->model('UsersModel');
        $register = $this->input->post("register");
        if ($register) {
            $email = $this->input->post("email");
            $fullname = $this->input->post("fullname");
            $username = $this->input->post("username");
            $password = $this->input->post("password");
            $pass_confirm = $this->input->post("pass_confirm");
            $roles = $this->input->post("roles");

            if ($fullname == '') {
                $this->session->set_flashdata('errors.fullname', "Silahkan masukan kembali Fullname");
                redirect("register");
            }

            if ($email == '') {
                $this->session->set_flashdata('errors.email', "Silahkan masukan email");
                redirect("register");
            }

            if ($username == '') {
                $this->session->set_flashdata('errors.username', "Silahkan masukan username");
                redirect("register");
            }

            if ($password == '') {
                $this->session->set_flashdata('errors.password', "Silahkan masukan username");
                redirect("register");
            }

            if ($pass_confirm == '') {
                $this->session->set_flashdata('errors.pass_confirm', "Silahkan masukan kembali Password");
                redirect("register");
            }

            if ($this->AuthModel->isEmailExists($email)) {
                $this->session->set_flashdata('errors.email', "Email Sudah Terdaftar Sebelumnya");
                $this->session->set_flashdata('errors', "Email Sudah Terdaftar Sebelumnya");
                redirect("register");
            }

            if ($this->AuthModel->isUsernameExists($username)) {
                $this->session->set_flashdata('errors.username', "Username Sudah Terdaftar Sebelumnya");
                $this->session->set_flashdata('errors', "Username Sudah Terdaftar Sebelumnya");
                redirect("register");
            }

            $data = [
                'email' => $email,
                'username' => $username,
                'fullname' => $fullname,
                'password' => $this->AuthModel->hashPassword($password),
            ];

            $users = [
                'email' => $email,
                'username' => $username,
                'fullname' => $fullname,
                'password_hash' => $this->AuthModel->hashPassword($password),
                'role' => $roles
            ];

            if ($this->AuthModel->registerUser($data)) {
                $this->UsersModel->registerUser($users);
                $this->session->set_flashdata('success', "Registrasi berhasil! Silakan login.");
                redirect('login');
            } else {
                $this->session->set_flashdata('errors', "Gagal melakukan registrasi");
                redirect('register');
            }


        }
        $this->load->view("auth/register");
    }

    public function viewLogin()
    {
        $this->load->view("auth/login");
    }

    public function login()
    {
        $this->load->helper('url');
        $this->load->model('AuthModel');
        $this->load->model('UsersModel');
        $login = $this->input->post("login");
        if ($login) {
            $username = $this->input->post("username");
            $password = $this->input->post("password");
            if ($username == '') {
                $this->session->set_flashdata('errors.login', "Silahkan masukan username");
                redirect("login");
            }

            if ($password == '') {
                $this->session->set_flashdata('errors.password', "Silahkan masukan password");
                redirect("login");
            }

            if ($this->AuthModel->verifyPassword($username, $password)) {
                
                $data = $this->UsersModel->getUserByUsername($username);
                $this->session->set_userdata(
                    [
                        "fullname" => $data["fullname"],
                        "role" => $data["role"],
                        "id" => $data["id"]
                    ]
                );
                
                // return redirect()->to('bankSoal');
                $this->redirectBasedOnRole($data["role"]);
            }
        }
        $this->load->view("auth/login");
    }

    public function redirectBasedOnRole($role)
    {
        $this->load->helper('url');
        switch ($role) {
            case 'Mahasiswa':
                redirect('/banksoal/mahasiswa');
            case 'Dosen':
                redirect('/bankSoal');
            default:
                redirect('/');
        }
    }
}