<?php
class CategoriaModel
{
    private $conn;
    private $table = "categorias";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Listar todas las categorías
    public function listar()
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table ORDER BY nombre ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear categoría
    public function crear($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (nombre) VALUES (?)");
        $stmt->execute([$data['nombre']]);
    }

    // Buscar categoría por ID
    public function buscar($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE idCategoria=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar categoría
    public function actualizar($data)
    {
        $stmt = $this->conn->prepare("UPDATE $this->table SET nombre=? WHERE idCategoria=?");
        $stmt->execute([$data['nombre'], $data['idCategoria']]);
    }

    // Eliminar categoría
    public function eliminar($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE idCategoria=?");
        $stmt->execute([$id]);
    }

    public function listarPorCategoria($idCategoria)
    {
        $sql = "SELECT p.*, c.nombre AS categoria
                FROM productos p
                INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                WHERE p.idCategoria = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idCategoria]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
