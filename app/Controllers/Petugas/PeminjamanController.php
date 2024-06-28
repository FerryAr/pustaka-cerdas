<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;

use App\Models\BukuModel;
use App\Models\PeminjamDetailModel;
use App\Models\PeminjamModel;
use App\Models\MhsModel;

class PeminjamanController extends BaseController {
    private $mhsModel;
    private $bukuModel;
    private $peminjamModel;
    private $peminjamDetailModel;

    public function __construct() {
        $this->isLogin();
        $this->isRole(2);
        $this->mhsModel = new MhsModel();
        $this->bukuModel = new BukuModel();
        $this->peminjamModel = new PeminjamModel();
        $this->peminjamDetailModel = new PeminjamDetailModel();
    }

    public function index() {
        $data = array(
            'title' => 'Peminjaman',
            'role' => 'petugas',
            'active' => 'peminjaman',
            'buku' => $this->bukuModel->getAll(),
            'peminjam' => $this->peminjamModel->getAll(),
            'mhs' => $this->mhsModel->getAll()
        );

        $this->loadView(['templates/header', 'petugas/peminjaman', 'templates/footer'], $data);
    }

    public function add() {
        checkRequestMethod(['POST']);

        $nim = $_POST['nim'];
        $bukus = $_POST['bukus'];
        $buku = json_decode($bukus);
        $tanggal_kembali = $_POST['tanggal_kembali'];

        $error = '';

        foreach ($buku as $b) {
            $isBukuHabis = $this->peminjamDetailModel->isBukuHabis($b);
            $bukuDb = $this->bukuModel->find($b);

            if($isBukuHabis) {
                $error = 'Buku ' . $bukuDb['judul'] . ' sudah habis';
                break;
            }
        }

        if($error != '') {
            http_response_code(400);
            echo json_encode(['message' => $error]);
            return;
        }

        $bukuPinjamCount = $this->peminjamDetailModel->getCountBukuPeminjam($nim);

        if ($bukuPinjamCount == 3) {
            header("HTTP/1.0 418 I'm A Teapot");
            echo json_encode(['message' => 'Mahasiswa sudah meminjam 3 buku']);
        }

        $data = array(
            'nim' => $nim,
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_kembali' => $tanggal_kembali,
            'status_kembali' => '0'
        );

        $in = $this->peminjamModel->insert($data);
        if($in) {
            $id_peminjam = $this->peminjamModel->getInsertID();
            foreach ($buku as $b) {
                $data = array(
                    'id_peminjam' => $id_peminjam,
                    'id_buku' => $b,
                );

                $this->peminjamDetailModel->insert($data);
            }
            echo json_encode(['message' => 'Data berhasil disimpan']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Data gagal disimpan']);
        }
    }

    public function getById() {
        checkRequestMethod(['GET']);

        $id = $_GET['id'];

        $peminjam = $this->peminjamModel->find($id);
        $peminjam['nama'] = $this->mhsModel->find($peminjam['nim'])['nama'];
        $peminjamDetail = $this->peminjamDetailModel->findByPeminjam($id);

        $buku = [];
        foreach ($peminjamDetail as $pd) {
            $buku[] = $this->bukuModel->find($pd['id_buku']);
        }

        if($peminjam) {
            echo json_encode(['status' => 'success', 'data' => ['peminjam' => $peminjam, 'buku' => $buku]]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

    public function changeStatus() {
        checkRequestMethod(['POST']);

        $id = $_POST['id'];
        $status = $_POST['status'];

        $data = array(
            'status_kembali' => $status
        );

        $update = $this->peminjamModel->update($id, $data);

        if($update) {
            echo json_encode(['message' => 'Data berhasil diupdate']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Data gagal diupdate']);
        }
    }

    public function delete() {
        checkRequestMethod(['POST']);

        $id = $_POST['id'];

        $delete = $this->peminjamModel->delete($id);

        if($delete) {
            echo json_encode(['message' => 'Data berhasil dihapus']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Data gagal dihapus']);
        }
    }
}