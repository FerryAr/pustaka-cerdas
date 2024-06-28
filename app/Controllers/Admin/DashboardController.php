<?php

namespace App\Controllers\Admin;

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
            'role' => 'admin',
            'active' => 'dashboard',
            'jumlahBuku' => count($this->bukuModel->getAll()),
            'jumlahBukuDipinjam' => $this->peminjamDetailModel->countAllBuku()
        );

        $this->loadView(['templates/header', 'admin/dashboard', 'templates/footer'], $data);
    }
}