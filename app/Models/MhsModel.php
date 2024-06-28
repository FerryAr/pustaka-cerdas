<?php

namespace App\Models;

use App\Models\BaseModel;

class MhsModel extends BaseModel
{
    protected $table = 'mhs';
    protected $primaryKey = 'nim';
    protected $allowedFields = ['nim','nama', 'prodi'];

    public function getByNim($nim) {
        $query = "SELECT * FROM $this->table WHERE nim = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $nim);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}