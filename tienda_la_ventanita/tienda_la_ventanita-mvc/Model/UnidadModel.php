<?php
require_once './Config/Database.php';

class UnidadModel {
    private $db;

   public function __construct($db) 
    {
        $this->conn = $db;
    }

    public function listar() {
        $sql = "SELECT * FROM unidades";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($nombre) {
        $sql = "INSERT INTO unidades (nombre) VALUES (:nombre)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['nombre' => $nombre]);
    }

    public function buscar($id) {
        $sql = "SELECT * FROM unidades WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editar($id, $nombre) {
        $sql = "UPDATE unidades SET nombre = :nombre WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['nombre' => $nombre, 'id' => $id]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM unidades WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
