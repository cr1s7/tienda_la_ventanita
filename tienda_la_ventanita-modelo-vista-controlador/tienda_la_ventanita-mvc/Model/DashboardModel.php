<?php
require_once __DIR__ . "/../config/Database.php";

class DashboardModel {
    private $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function conteosGenerales() {
        $sql = "SELECT 
                    (SELECT COUNT(*) FROM usuarios) AS totalUsuarios,
                    (SELECT COUNT(*) FROM productos) AS totalProductos,
                    (SELECT COUNT(*) FROM ventas) AS totalVentas,
                    (SELECT IFNULL(SUM(total),0) FROM ventas) AS ingresosTotales
                ";
        $stmt = $this->db->query($sql);
        return $stmt->fetch();
    }

    public function ultimasVentas($limit = 5) {
        $sql = "SELECT v.id, v.fecha, v.total, u.nombre AS usuario
                FROM ventas v
                LEFT JOIN usuarios u ON v.usuario_id = u.id
                ORDER BY v.fecha DESC
                LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }

    public function productosMasVendidos($limit = 5) {
        $sql = "SELECT p.id, p.nombre, SUM(d.cantidad) AS vendidos
                FROM detalle_venta d
                JOIN productos p ON d.idProducto = p.id
                GROUP BY p.id
                ORDER BY vendidos DESC
                LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }
}
