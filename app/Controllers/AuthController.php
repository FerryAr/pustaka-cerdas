<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\UsersModel;

class AuthController extends BaseController
{
    private $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        parent::__construct();
    }

    public function login()
    {
        $this->loadView('auth/login', ['title' => 'Login']);
    }

    public function loginAction() {
        checkRequestMethod(['POST']);

        $username = $_POST['username'];
        $password = $_POST['password'];

        

        if(empty($username) || empty($password)) {
            $_SESSION['error'] = 'Username dan password harus diisi';
            $this->redirect('/auth/login');
        }

        $user = $this->usersModel->findByUsername($username);

        if(!$user) {
            $_SESSION['error'] = 'User tidak ditemukan';
            $this->redirect('/auth/login');
        }

        if(!password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Password salah';
            $this->redirect('/auth/login');
        }

        $_SESSION['isLogin'] = true;
        $_SESSION['user'] = $user;

        if($user['role'] == 1) {
            $this->redirect('/admin/dashboard');
        } else if($user['role'] == 2) {
            $this->redirect('/petugas/dashboard');
        } else if($user['role'] == 3) {
            $this->redirect('/home/user');
        }
    }

    public function logout() {
        unset($_SESSION['isLogin']);
        unset($_SESSION['user']);
        $this->redirect('/auth/login');
    }
}
