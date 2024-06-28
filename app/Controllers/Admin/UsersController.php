<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\UsersModel;

class UsersController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $data = array(
            'title' => 'Users',
            'role' => 'admin',
            'active' => 'users',
            'users' => $this->userModel->getAll(),
        );

        $this->loadView(['templates/header', 'admin/users', 'templates/footer'], $data);
    }

    public function add() {
        checkRequestMethod(['POST']);

        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $data = array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role' => $role
        );

        $in = $this->userModel->insert($data);

        if ($in) {
            http_response_code(201);
            echo json_encode(['status' => 'success', 'message' => 'User berhasil ditambahkan']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'User gagal ditambahkan']);
        }
    }

    public function getByUsername() {
        checkRequestMethod(['GET']);

        $username = $_GET['username'];

        $user = $this->userModel->findByUsername($username);

        if ($user) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $user]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'User tidak ditemukan']);
        }
    }

    public function update() {
        checkRequestMethod(['POST']);

        $id = $_POST['id'];

        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $data = array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role' => $role
        );

        $user = $this->userModel->find($id);

        if ($user) {
            $up = $this->userModel->update($user['id'], $data);

            if ($up) {
                http_response_code(200);
                echo json_encode(['status' => 'success', 'message' => 'User berhasil diupdate']);
            } else {
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => 'User gagal diupdate']);
            }
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'User tidak ditemukan']);
        }

    }

    public function delete() {
        checkRequestMethod(['POST']);

        $username = $_POST['username'];

        $del = $this->userModel->deleteByUsername($username);

        if ($del) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'User berhasil dihapus']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'User gagal dihapus']);
        }
    }
}