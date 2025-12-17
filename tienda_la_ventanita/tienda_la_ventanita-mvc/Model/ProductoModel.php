<?php

class ProductoModel
{
    private $conn;
    private $table = "productos";

    public function __construct($db)
    {
        $this->conn = $db;
    }


    
    public function listar()
    {
        $query = "
            SELECT 
                p.*,
                c.nombre AS categoria,
                u.nombre AS unidad,
                m.nombre AS marca
            FROM productos p
            LEFT JOIN categorias c ON p.idCategoria = c.idCategoria
            LEFT JOIN unidad_medida u ON p.idUnidad_medida = u.idUnidad
            LEFT JOIN marcas m ON p.idMarca = m.idMarca
            ORDER BY p.idProducto DESC
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function crear($data)
    {
        $sql = "INSERT INTO $this->table (nombre, preUnitario, stock, foto, idCategoria, idUnidad_medida, idMarca)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['nombre'],
            $data['preUnitario'],
            $data['stock'],
            $data['foto'],
            $data['idCategoria'],
            $data['idUnidad_medida'],
            $data['idMarca']
        ]);
    }

    public function buscar($id)
    {
        $sql = "SELECT * FROM $this->table WHERE idProducto = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($data)
    {
        $sql = "UPDATE $this->table SET nombre=?, preUnitario=?, stock=?, foto=?, idCategoria=?, idUnidad_medida=?, idMarca=?
                WHERE idProducto=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['nombre'],
            $data['preUnitario'],
            $data['stock'],
            $data['foto'],
            $data['idCategoria'],
            $data['idUnidad_medida'],
            $data['idMarca'],
            $data['idProducto']
        ]);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM $this->table WHERE idProducto=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }

    public function getCategorias()
{
    $stmt = $this->conn->prepare("SELECT * FROM categorias ORDER BY nombre ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getUnidades()
{
    $stmt = $this->conn->prepare("SELECT * FROM unidad_medida ORDER BY nombre ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getMarcas()
{
    $stmt = $this->conn->prepare("SELECT * FROM marcas ORDER BY nombre ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
