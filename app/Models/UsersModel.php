<?php

namespace App\Models;

class UsersModel extends BaseModel
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'password', 'role'];

    public function __construct()
    {
        parent::__construct();
    }

    public function findByUsername($username)
    {
        $query = "SELECT * FROM $this->table WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function deleteByUsername($username)
    {
        $query = "DELETE FROM $this->table WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $username);
        return $stmt->execute();
    }
}