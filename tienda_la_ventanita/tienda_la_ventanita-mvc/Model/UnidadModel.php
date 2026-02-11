<?php

class UnidadModel {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // LISTAR
    public function listar(){

        $sql = "SELECT *
                FROM unidad_medida
                ORDER BY nombre ASC";

        return $this->conn
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    // CREAR
    public function crear($nombre){

        $sql = "INSERT INTO unidad_medida(nombre)
                VALUES(:nombre)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            'nombre'=>$nombre
        ]);
    }

    // BUSCAR
    public function buscar($id){

        $sql = "SELECT *
                FROM unidad_medida
                WHERE idUnidad = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // EDITAR
    public function editar($id,$nombre){

        $sql = "UPDATE unidad_medida
                SET nombre = :nombre
                WHERE idUnidad = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            'nombre'=>$nombre,
            'id'=>$id
        ]);
    }

    // ELIMINAR
    public function eliminar($id){

        $sql = "DELETE FROM unidad_medida
                WHERE idUnidad = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute(['id'=>$id]);
    }
}
