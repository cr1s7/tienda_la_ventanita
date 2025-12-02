<?php

class UserModel 
{//atributos para conexion y tabla
    private $conn;
    private $table = "usuarios";

    public function __construct($db) 
    {
        $this->conn = $db;
    }  
    //método para insertar usuario 
    public function insertUser($numDocumento, $tipo_documento,  $nombre, $direccion, $telefono, $email, $password, $idRol)
    {//sentencia SQL para insertar
        $query = "INSERT INTO " . $this->table . "(numDocumento, tipo_documento,  
        nombre, direccion, telefono, email, password, idRol) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        //preparacion y ejecución
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$numDocumento, $tipo_documento, $nombre, $direccion, $telefono, $email, $password, $idRol]);
    }
    
}

