<?php
class rolesModel {
    private $conn;
    private $table = "roles";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getroles() {
        $query = "select * from " . $this->table;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}