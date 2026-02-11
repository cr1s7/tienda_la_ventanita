<?php

class CarritoModel
{
    public function agregar()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // 🚫 Si no está logueado
    if (!isset($_SESSION['user'])) {

        $_SESSION['mensaje'] = "Debes iniciar sesión para agregar productos al carrito 🛒";

        header("Location: index.php?action=login");
        exit;
    }

}


    public static function obtener()
    {
        return $_SESSION['carrito'] ?? [];
    }

    public static function eliminar($id)
    {
        unset($_SESSION['carrito'][$id]);
    }

    public static function total()
    {
        $total = 0;

        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $p) {
                $total += $p['precio'] * $p['cantidad'];
            }
        }

        return $total;
    }
}
