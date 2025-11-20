<?php
class TipoDocumentoModel {
    private $conn;
    private $table = "tipodocumento";

    public function __construct($db) {
        $this->conn = $db;

    }

    public function gettipodocumento() {
        $query = "select * from " . $this->table;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    

    }

}