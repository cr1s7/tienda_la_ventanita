<?php

class UserModel 
{
    private $conn;
    private $table = "usuarios";

    public function __construct($db) 
    {
        $this->conn = $db;
    }

    // ================= LOGIN =================
    public function login($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ================= LISTAR =================
    public function listar()
    {
        $sql = "SELECT u.*, t.nombreDocumento AS tipoDocumento
                FROM usuarios u
                LEFT JOIN tipodocumento t ON u.tipo_documento = t.id
                ORDER BY u.idUsuario DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ================= INSERTAR =================
    public function insertar($data)
    {
        $sql = "INSERT INTO usuarios 
            (numDocumento, tipo_documento, nombre, direccion, telefono, email, password, idRol)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['numDocumento'],
            $data['tipoDocumento'],
            $data['nombre'],
            $data['direccion'],
            $data['telefono'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['idRol'] ?? 2
        ]);
    }

    // ================= BUSCAR =================
    public function buscar($id)
    {
        $sql = "SELECT * FROM usuarios WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ================= ACTUALIZAR =================
    public function actualizar($data)
    {
        if (!empty($data['password'])) {

            $sql = "UPDATE usuarios SET 
                numDocumento=?, tipo_documento=?, nombre=?, direccion=?, telefono=?, email=?, password=?, idRol=?
                WHERE idUsuario=?";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $data['numDocumento'],
                $data['tipoDocumento'],
                $data['nombre'],
                $data['direccion'],
                $data['telefono'],
                $data['email'],
                password_hash($data['password'], PASSWORD_DEFAULT),
                $data['idRol'],
                $data['idUsuario']
            ]);

        } else {

            $sql = "UPDATE usuarios SET 
                numDocumento=?, tipo_documento=?, nombre=?, direccion=?, telefono=?, email=?, idRol=?
                WHERE idUsuario=?";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $data['numDocumento'],
                $data['tipoDocumento'],
                $data['nombre'],
                $data['direccion'],
                $data['telefono'],
                $data['email'],
                $data['idRol'],
                $data['idUsuario']
            ]);
        }
    }

    // ================= ELIMINAR =================
    public function eliminar($id)
    {
        $sql = "DELETE FROM usuarios WHERE idUsuario=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }
}
