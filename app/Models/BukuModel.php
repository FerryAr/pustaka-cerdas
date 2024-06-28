<?php 

namespace App\Models;

class BukuModel extends BaseModel
{
    protected $table = 'buku';
    protected $allowedFields = ['id_kategori', 'pengarang', 'penerbit', 'judul', 'deskripsi', 'isbn', 'edisi', 'tahun_terbit', 'klasifikasi', 'no_panggil', 'jumlah_buku', 'foto_sampul'];

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll() {
        $query = 'SELECT b.*, k.nama_kategori FROM buku b JOIN kategori_buku k ON b.id_kategori = k.id';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getLimit($limit = 4 ) {
        //random buku
        $query = 'SELECT b.*, k.nama_kategori FROM buku b JOIN kategori_buku k ON b.id_kategori = k.id ORDER BY RAND() LIMIT ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }
    
    public function find($id) {
        $query = "SELECT b.*, k.nama_kategori FROM buku b JOIN kategori_buku k ON b.id_kategori = k.id WHERE b.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

}