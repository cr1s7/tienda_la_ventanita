<?php
require_once './Config/Database.php';

class MarcaModel {
    private $conn;

    public function __construct($db) 
    {
        $this->conn = $db;
    }

    public function listar() {
        $sql = "SELECT * FROM marcas";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($nombre) {
        $sql = "INSERT INTO marcas (nombre) VALUES (:nombre)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'nombre' => $nombre
        ]);
    }

    public function buscar($id) {
        $sql = "SELECT * FROM marcas WHERE idMarca = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editar($id, $nombre) {
        $sql = "UPDATE marcas SET nombre = :nombre WHERE idMarca = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'nombre' => $nombre,
            'id' => $id
        ]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM marcas WHERE idMarca = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'id' => $id
        ]);
    }
}
