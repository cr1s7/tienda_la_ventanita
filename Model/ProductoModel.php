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
        $sql = "INSERT INTO $this->table 
                (nombre, descripcion, preUnitario, stock, foto, idCategoria, idUnidad_medida, idMarca)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['nombre'],
            $data['descripcion'],
            $data['preUnitario'],
            $data['stock'],
            $data['foto'],
            $data['idCategoria'],
            $data['idUnidad_medida'],
            $data['idMarca']
        ]);
    }

    public function buscar($busqueda)
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
            WHERE (
                p.nombre LIKE :busqueda
                OR m.nombre LIKE :busqueda
            )
            AND p.stock > 0
            ORDER BY p.idProducto DESC
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":busqueda", $busqueda);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    public function actualizar($data)
    {
        $sql = "UPDATE $this->table SET
            nombre=?,
            descripcion=?,
            preUnitario=?,
            stock=?,
            foto=?,
            idCategoria=?,
            idUnidad_medida=?,
            idMarca=?,
            destacado=?
            WHERE idProducto=?";

        $stmt = $this->conn->prepare($sql);

        $destacado = isset($data['destacado']) ? 1 : 0;

        $stmt->execute([
            $data['nombre'],
            $data['descripcion'],
            $data['preUnitario'],
            $data['stock'],
            $data['foto'],
            $data['idCategoria'],
            $data['idUnidad_medida'],
            $data['idMarca'],
            $destacado,
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

public function buscarPorNombre($nombre)
{
    $stmt = $this->conn->prepare(
        "SELECT * FROM productos WHERE nombre LIKE ?"
    );
    $stmt->execute(["%$nombre%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function listarPorCategoria($idCategoria)
{
    $sql = "
        SELECT 
            p.*,
            c.nombre AS categoria,
            u.nombre AS unidad,
            m.nombre AS marca
        FROM productos p
        LEFT JOIN categorias c 
            ON p.idCategoria = c.idCategoria
        LEFT JOIN unidad_medida u 
            ON p.idUnidad_medida = u.idUnidad
        LEFT JOIN marcas m 
            ON p.idMarca = m.idMarca
        WHERE p.idCategoria = :idCategoria
        ORDER BY p.idProducto DESC
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":idCategoria", $idCategoria);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function obtenerDestacados()
{
    $sql = "
        SELECT 
            p.*,
            c.nombre AS categoria,
            u.nombre AS unidad,
            m.nombre AS marca
        FROM productos p
        LEFT JOIN categorias c 
            ON p.idCategoria = c.idCategoria
        LEFT JOIN unidad_medida u 
            ON p.idUnidad_medida = u.idUnidad
        LEFT JOIN marcas m 
            ON p.idMarca = m.idMarca
        WHERE p.destacado = 1
         AND p.stock > 0
        ORDER BY p.idProducto DESC
        LIMIT 8
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function obtenerPorId($id)
{
    $sql = "SELECT p.*, c.nombre AS categoria
            FROM productos p
            LEFT JOIN categorias c ON p.idCategoria = c.idCategoria
            WHERE p.idProducto = :id";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function productosRelacionados($idCategoria, $idProducto)
{
    $sql = "SELECT * 
            FROM productos 
            WHERE idCategoria = ?
            AND idProducto != ?
            LIMIT 4";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$idCategoria, $idProducto]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}

