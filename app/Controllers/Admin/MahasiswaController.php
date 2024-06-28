<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\MhsModel;
use App\Models\UsersModel;

class MahasiswaController extends BaseController
{
    private $mhsModel;
    private $userModel;

    public function __construct()
    {
        $this->mhsModel = new MhsModel();
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $data = array(
            'title' => 'Mahasiswa',
            'role' => 'admin',
            'active' => 'mhs',
            'mahasiswa' => $this->mhsModel->getAll(),
        );

        $this->loadView(['templates/header', 'admin/mahasiswa', 'templates/footer'], $data);
    }

    public function add() {
        checkRequestMethod(['POST']);

        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $prodi = $_POST['prodi'];

        $data = array(
            'nim' => $nim,
            'nama' => $nama,
            'prodi' => $prodi
        );

        $in = $this->mhsModel->insert($data);

        if ($in) {
            $this->userModel->insert(['username' => $nim, 'password' => password_hash($nim, PASSWORD_BCRYPT), 'role' => 3]);
            http_response_code(201);
            echo json_encode(['status' => 'success', 'message' => 'Mahasiswa berhasil ditambahkan']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Mahasiswa gagal ditambahkan']);
        }
    }

    public function getByNim() {
        checkRequestMethod(['GET']);

        $nim = $_GET['nim'];

        $mhs = $this->mhsModel->getByNim($nim);

        if ($mhs) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $mhs]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Mahasiswa tidak ditemukan']);
        }
    }

    public function update() {
        checkRequestMethod(['POST']);

        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $prodi = $_POST['prodi'];

        $data = array(
            'nim' => $nim,
            'nama' => $nama,
            'prodi' => $prodi
        );

        $up = $this->mhsModel->update($nim, $data);

        if ($up) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Mahasiswa berhasil diupdate']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Mahasiswa gagal diupdate']);
        }
    }

    public function delete() {
        checkRequestMethod(['POST']);

        $nim = $_POST['nim'];

        $del = $this->mhsModel->delete($nim);

        if ($del) {
            $this->userModel->deleteByUsername($nim);
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Mahasiswa berhasil dihapus']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Mahasiswa gagal dihapus']);
        }
    }
}