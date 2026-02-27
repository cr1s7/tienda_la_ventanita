<?php

class AuthModel 
{
    private $conn;
    private $table = "usuarios";

    public function __construct($db) 
    {
        $this->conn = $db;
    }

    public function login($email, $password)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Validar contraseña
        if ($user && $password === $user['password']) {
            return $user;
        }
        return false;
    }
}
