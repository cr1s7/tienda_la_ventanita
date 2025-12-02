<?php
require_once __DIR__ . "/../config/Database.php";

class ReportesModel {
    private $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function crear($usuarioId, $titulo, $descripcion) {
        $sql = "INSERT INTO reportes (idUsuario, titulo, descripcion) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$usuarioId, $titulo, $descripcion]);
    }

    public function obtenerTodosConUsuario() {
        $sql = "SELECT r.*, u.nombre AS usuario 
                FROM reportes r
                LEFT JOIN usuarios u ON r.idUsuario = u.id
                ORDER BY r.creado_en DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}
