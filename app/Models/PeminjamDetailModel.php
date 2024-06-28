<?php

namespace App\Models;

class PeminjamDetailModel extends BaseModel
{
    protected $table = 'peminjam_detail';
    protected $allowedFields = ['id_peminjam', 'id_buku'];

    public function __construct()
    {
        parent::__construct();
    }

    public function findByPeminjam($id_peminjam)
    {
        $query = "SELECT * FROM $this->table WHERE id_peminjam = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id_peminjam);
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

    public function countAllBuku()
    {
        $query = "SELECT COUNT(id_buku) as jumlah_buku FROM $this->table GROUP BY id_buku";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return count($data);
    }

    public function isBukuHabis($id_buku)
    {
        $query = "SELECT b.id, b.judul, b.jumlah_buku, COUNT(pd.id) AS jumlah_dipinjam FROM buku b LEFT JOIN peminjam_detail pd ON b.id = pd.id_buku LEFT JOIN peminjam p ON pd.id_peminjam = p.id WHERE b.id = ? AND p.status_kembali = 0 GROUP BY b.id HAVING jumlah_dipinjam >= b.jumlah_buku";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id_buku);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function countBukuDipinjam($id_buku)
    {
        $query = "SELECT COUNT(id) AS jumlah_dipinjam FROM $this->table WHERE id_buku = ? AND id_peminjam IN (SELECT id FROM peminjam WHERE status_kembali = 0)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id_buku);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data['jumlah_dipinjam'];
    }
    
    public function getBukuPeminjam($nim)
    {
        $query = "SELECT b.judul, b.pengarang, b.penerbit, b.tahun_terbit, b.foto_sampul, pd.id_peminjam, pd.id_buku, p.tanggal_pinjam, p.tanggal_kembali FROM buku b JOIN peminjam_detail pd ON b.id = pd.id_buku JOIN peminjam p ON pd.id_peminjam = p.id WHERE p.nim = ? AND p.status_kembali = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $nim);
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

    public function getCountBukuPeminjam($nim)
    {
        $query = " SELECT COUNT(*) AS jumlah_buku FROM peminjam_detail WHERE id_peminjam = (SELECT id FROM peminjam WHERE nim = ? AND status_kembali = 0)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $nim);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data['jumlah_buku'];
    }
}
