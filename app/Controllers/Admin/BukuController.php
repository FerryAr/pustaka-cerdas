<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\KategoriModel;

class BukuController extends BaseController
{
    private $kategoriModel;
    private $bukuModel;

    public function __construct()
    {
        $this->isLogin();
        $this->isRole(1);

        $this->kategoriModel = new KategoriModel();
        $this->bukuModel = new BukuModel();
    }

    public function index()
    {
        $data = array(
            'title' => 'Buku',
            'role' => 'admin',
            'active' => 'buku',
            'kategori' => $this->kategoriModel->getAll(),
            'buku' => $this->bukuModel->getAll()
        );

        $this->loadView(['templates/header', 'admin/buku', 'templates/footer'], $data);
    }

    public function add()
    {
        checkRequestMethod(['POST']);

        $kategori = $_POST['kategori'];
        $penerbit = $_POST['penerbit'];
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $deskripsi = $_POST['deskripsi'];
        $isbn = $_POST['isbn'];
        $edisi = $_POST['edisi'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $jumlah_buku = $_POST['jumlah_buku'];
        $klasifikasi = $_POST['klasifikasi'];
        $no_panggil = $_POST['no_panggil'];

        $foto_sampul = $_FILES['foto_sampul'];

        if (is_uploaded_file($foto_sampul['tmp_name'])) {
            $fileExt = explode('.', $foto_sampul['name']);
            $fileExt = strtolower(end($fileExt));
            $foto_sampul_name = md5(uniqid()) . '.' . $fileExt;

            $root = dirname(__DIR__, 3);

            if (move_uploaded_file($foto_sampul['tmp_name'], $root . '/assets/img/buku/' . $foto_sampul_name)) {
                $in = $this->bukuModel->insert([
                    'id_kategori' => $kategori,
                    'penerbit' => $penerbit,
                    'pengarang' => $pengarang,
                    'judul' => $judul,
                    'deskripsi' => $deskripsi,
                    'isbn' => $isbn,
                    'edisi' => $edisi,
                    'tahun_terbit' => $tahun_terbit,
                    'jumlah_buku' => $jumlah_buku,
                    'klasifikasi' => $klasifikasi,
                    'no_panggil' => $no_panggil,
                    'foto_sampul' => $foto_sampul_name
                ]);

                if ($in) {
                    echo json_encode(['status' => 'success', 'message' => 'Buku berhasil ditambahkan']);
                } else {
                    unlink($root . '/assets/img/buku/' . $foto_sampul_name);
                    http_response_code(500);
                    echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan buku']);
                }
            } else {
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => 'Gagal mengunggah foto sampul karena ' . $_FILES['foto_sampul']['error']]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Foto sampul harus diunggah']);
        }
    }

    public function getById()
    {
        checkRequestMethod(['GET']);

        $id = $_GET['id'];

        $buku = $this->bukuModel->find($id);

        if ($buku) {
            echo json_encode(['status' => 'success', 'data' => $buku]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Buku tidak ditemukan']);
        }
    }

    public function update()
    {
        checkRequestMethod(['POST']);

        $id = $_POST['id'];
        $kategori = $_POST['kategori'];
        $penerbit = $_POST['penerbit'];
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $deskripsi = $_POST['deskripsi'];
        $isbn = $_POST['isbn'];
        $edisi = $_POST['edisi'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $jumlah_buku = $_POST['jumlah_buku'];
        $klasifikasi = $_POST['klasifikasi'];
        $no_panggil = $_POST['no_panggil'];

        $foto_sampul = isset($_FILES['foto_sampul']) ? $_FILES['foto_sampul'] : null;

        $buku = $this->bukuModel->find($id);

        if ($buku) {
            if (!is_null($foto_sampul)) {
                if (is_uploaded_file($foto_sampul['tmp_name'])) {
                    $fileExt = explode('.', $foto_sampul['name']);
                    $fileExt = strtolower(end($fileExt));
                    $foto_sampul_name = md5(uniqid()) . '.' . $fileExt;

                    $root = dirname(__DIR__, 3);

                    if (move_uploaded_file($foto_sampul['tmp_name'], $root . '/assets/img/buku/' . $foto_sampul_name)) {
                        unlink($root . '/assets/img/buku/' . $buku['foto_sampul']);

                        $up = $this->bukuModel->update($id, [
                            'id_kategori' => $kategori,
                            'penerbit' => $penerbit,
                            'pengarang' => $pengarang,
                            'judul' => $judul,
                            'deskripsi' => $deskripsi,
                            'isbn' => $isbn,
                            'edisi' => $edisi,
                            'tahun_terbit' => $tahun_terbit,
                            'jumlah_buku' => $jumlah_buku,
                            'klasifikasi' => $klasifikasi,
                            'no_panggil' => $no_panggil,
                            'foto_sampul' => $foto_sampul_name
                        ]);

                        if ($up) {
                            unlink($root . '/assets/img/buku/' . $buku['foto_sampul']);
                            echo json_encode(['status' => 'success', 'message' => 'Buku berhasil diperbarui']);
                        } else {
                            unlink($root . '/assets/img/buku/' . $foto_sampul_name);
                            http_response_code(500);
                            echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui buku']);
                        }
                    } else {
                        http_response_code(500);
                        echo json_encode(['status' => 'error', 'message' => 'Gagal mengunggah foto sampul karena ' . $_FILES['foto_sampul']['error']]);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Foto sampul tidak valid']);
                }
            } else {
                $up = $this->bukuModel->update($id, [
                    'id_kategori' => $kategori,
                    'penerbit' => $penerbit,
                    'pengarang' => $pengarang,
                    'judul' => $judul,
                    'deskripsi' => $deskripsi,
                    'isbn' => $isbn,
                    'edisi' => $edisi,
                    'tahun_terbit' => $tahun_terbit,
                    'jumlah_buku' => $jumlah_buku,
                    'klasifikasi' => $klasifikasi,
                    'no_panggil' => $no_panggil
                ]);

                if ($up) {
                    echo json_encode(['status' => 'success', 'message' => 'Buku berhasil diperbarui']);
                } else {
                    http_response_code(500);
                    echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui buku']);
                }
            }
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Buku tidak ditemukan']);
        }
    }

    public function delete() {
        checkRequestMethod(['POST']);

        $id = $_POST['id'];

        $buku = $this->bukuModel->find($id);

        if ($buku) {
            $root = dirname(__DIR__, 3);

            $del = $this->bukuModel->delete($id);

            if ($del) {
                unlink($root . '/assets/img/buku/' . $buku['foto_sampul']);
                echo json_encode(['status' => 'success', 'message' => 'Buku berhasil dihapus']);
            } else {
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus buku']);
            }
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Buku tidak ditemukan']);
        }
    }
}
