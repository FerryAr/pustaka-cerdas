<?php

namespace App\Models;

use App\Models\BaseModel;

class PeminjamModel extends BaseModel
{
    protected $table = 'peminjam';
    protected $allowedFields = ['nim', 'tanggal_pinjam', 'tanggal_kembali', 'status_kembali'];

    public function getByNim($nim)
    {
        $query = "SELECT * FROM $this->table WHERE nim = '$nim' AND status_kembali = 0";
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

    public function getAll() {
        $query = "SELECT *, mhs.nim, mhs.nama FROM $this->table LEFT JOIN mhs ON peminjam.nim = mhs.nim";
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
}