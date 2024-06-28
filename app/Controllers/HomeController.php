<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\PeminjamModel;
use App\Models\PeminjamDetailModel;

class HomeController extends BaseController
{
    private $bukuModel;
    private $peminjamModel;
    private $peminjamDetailModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->peminjamModel = new PeminjamModel();
        $this->peminjamDetailModel = new PeminjamDetailModel();
    }

    public function index()
    {
        $data = [
            'buku' => $this->bukuModel->getLimit(8),
        ];

        $this->loadView('home', $data);
    }

    public function katalog()
    {
        $bukuDb = $this->bukuModel->getAll();
        
        $buku = [];
        foreach ($bukuDb as $item) {
            $item['ketersediaan'] = (int)$item['jumlah_buku'] - (int)$this->peminjamDetailModel->countBukuDipinjam($item['id']);
            $buku[] = $item;
                
        }

        $data = [
            'buku' => $buku,
            'random' => $this->bukuModel->getLimit(4),
        ];

        $this->loadView('katalog', $data);
    }

    public function user() {
        $this->isLogin();
        $this->isRole(3);

        $nim = $_SESSION['user']['username'];

        $listBuku = $this->peminjamDetailModel->getBukuPeminjam($nim);

        $data = [
            'listBuku' => $listBuku,
        ];

        $this->loadView('user', $data);
    }

    public function perpanjangan() {
        $this->isLogin();
        $this->isRole(3);

        checkRequestMethod(['POST']);

        $nim = $_SESSION['user']['username'];

        $id_peminjam = $_POST['id_peminjam'];
        $id_buku = $_POST['id_buku'];

        $peminjam = $this->peminjamModel->find($id_peminjam);

        if(!$peminjam) {
            http_response_code(404);
            echo json_encode(['message' => 'Peminjam tidak ditemukan']);
            exit();
        }

        $peminjamDetail = $this->peminjamDetailModel->findByPeminjam($id_peminjam);

        if(count($peminjamDetail) == 1) {
            $this->peminjamModel->update($id_peminjam, array(
                'status_kembali' => 1
            ));
        }

        $inPeminjam = $this->peminjamModel->insert([
            'nim' => $nim,
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_kembali' => date('Y-m-d', strtotime('+7 days')),
            'status_kembali' => 0,
        ]);

        $peminjam_id = $this->peminjamModel->getInsertID();

        $in = $this->peminjamDetailModel->insert([
            'id_peminjam' => $peminjam_id,
            'id_buku' => $id_buku,
        ]);

        if($inPeminjam && $in) {
            http_response_code(200);
            echo json_encode(['message' => 'Perpanjangan berhasil']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Perpanjangan gagal']);
        }

    }
}