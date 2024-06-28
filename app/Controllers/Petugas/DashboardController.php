<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;

use App\Models\BukuModel;
use App\Models\PeminjamDetailModel;

class DashboardController extends BaseController
{
    private $bukuModel;
    private $peminjamDetailModel;

    public function __construct() {
        $this->isLogin();
        $this->isRole(1);
        $this->bukuModel = new BukuModel();
        $this->peminjamDetailModel = new PeminjamDetailModel();
    }

    public function index()
    {
        $data = array(
            'title' => 'Dashboard',
            'role' => 'petugas',
            'active' => 'dashboard',
            'jumlahBuku' => count($this->bukuModel->getAll()),
            'jumlahBukuDipinjam' => $this->peminjamDetailModel->countAllBuku()
        );

        $this->loadView(['templates/header', 'petugas/dashboard', 'templates/footer'], $data);
    }
}