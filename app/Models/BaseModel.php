<?php

namespace App\Models;

use mysqli;

class BaseModel {
    protected $conn;
    protected $table;
    protected $allowedFields = [];
    protected $primaryKey = 'id';

    public function __construct() {
        $config = new \Config();
        $this->conn = new mysqli($config->db_host, $config->db_user, $config->db_pass, $config->db_name);
        
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public function getConn() {
        return $this->conn;
    }

    public function closeConn() {
        $this->conn->close();
    }

    public function find($id) {
        $query = "SELECT * FROM $this->table WHERE $this->primaryKey = $id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getAll() {
        $query = "SELECT * FROM $this->table";
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

    public function insert($data) {
        $fields = '';
        $values = '';
        foreach ($data as $key => $value) {
            if (in_array($key, $this->allowedFields)) {
                $fields .= $key . ',';
                $values .= "'$value',";
            }
        }
        $fields = rtrim($fields, ',');
        $values = rtrim($values, ',');
        $query = "INSERT INTO $this->table ($fields) VALUES ($values)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function getInsertID() {
        return $this->conn->insert_id;
    }

    public function update($id, $data) {
        $set = '';
        foreach ($data as $key => $value) {
            if (in_array($key, $this->allowedFields)) {
                $set .= $key . "='$value',";
            }
        }
        $set = rtrim($set, ',');
        $query = "UPDATE $this->table SET $set WHERE $this->primaryKey = $id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE $this->primaryKey = $id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }
}