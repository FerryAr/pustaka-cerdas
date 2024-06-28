<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    private $kategoriModel;

    public function __construct()
    {
        $this->isLogin();
        $this->isRole(1);

        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = array(
            'title' => 'Kategori Buku',
            'role' => 'admin',
            'active' => 'kategori',
            'kategori' => $this->kategoriModel->getAll()
        );

        $this->loadView(['templates/header', 'admin/kategori', 'templates/footer'], $data);
    }

    public function add()
    {
        checkRequestMethod(['POST']);

        $nama_kategori = $_POST['nama_kategori'];
        $slug = $this->generateSlug($nama_kategori);

        $data = array(
            'nama_kategori' => $nama_kategori,
            'slug' => $slug
        );

        $in = $this->kategoriModel->insert($data);

        if ($in) {
            http_response_code(201);
            echo json_encode(['status' => 'success', 'message' => 'Kategori berhasil ditambahkan']);
        } else {
            http_response_code(500); 
            echo json_encode(['status' => 'error', 'message' => 'Kategori gagal ditambahkan']);
        }
    }

    public function delete() {
        checkRequestMethod(['POST']);

        $id = $_POST['id'];

        $kategori = $this->kategoriModel->find($id);

        if ($kategori) {
            $del = $this->kategoriModel->delete($id);

            if ($del) {
                http_response_code(200);
                echo json_encode(['status' => 'success', 'message' => 'Kategori berhasil dihapus']);
            } else {
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => 'Kategori gagal dihapus']);
            }
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Kategori tidak ditemukan']);
        }
    }

    private function generateSlug($string)
    {
        // Convert the string to lowercase
        $slug = strtolower($string);

        // Replace non-alphanumeric characters with hyphens
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);

        // Remove any leading or trailing hyphens
        $slug = trim($slug, '-');

        // Return the slug
        return $slug;
    }
}
