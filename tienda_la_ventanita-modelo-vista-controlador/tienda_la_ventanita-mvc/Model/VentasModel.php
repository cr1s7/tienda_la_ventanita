<?php
require_once __DIR__ . "/../config/Database.php";

class VentasModel {
    private $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Registrar venta con detalle
    // $usuarioId int, $items = [ ['producto_id'=>x,'cantidad'=>y,'subtotal'=>z], ... ], $total decimal
    public function registrarVenta($usuarioId, $items, $total) {
        try {
            $this->db->beginTransaction();

            $sql = "INSERT INTO ventas (usuario_id, total) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$usuarioId, $total]);
            $ventaId = $this->db->lastInsertId();

            $sqlDet = "INSERT INTO detalle_venta (venta_id, producto_id, cantidad, subtotal) VALUES (?, ?, ?, ?)";
            $stmtDet = $this->db->prepare($sqlDet);

            foreach ($items as $it) {
                $stmtDet->execute([$ventaId, $it['producto_id'], $it['cantidad'], $it['subtotal']]);

                // Reducir stock
                $sqlStock = "UPDATE productos SET stock = stock - ? WHERE id = ? AND stock >= ?";
                $stmtStock = $this->db->prepare($sqlStock);
                $ok = $stmtStock->execute([$it['cantidad'], $it['producto_id'], $it['cantidad']]);
                if (!$ok) {
                    throw new Exception("No hay stock suficiente para el producto ID {$it['producto_id']}");
                }
            }

            $this->db->commit();
            return $ventaId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function obtenerVentasConUsuario() {
        $sql = "SELECT v.id, v.fecha, v.total, u.nombre AS usuario
                FROM ventas v
                LEFT JOIN usuarios u ON v.usuario_id = u.id
                ORDER BY v.fecha DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function detalleVenta($ventaId) {
        $sql = "SELECT d.id, d.venta_id, p.nombre AS producto, d.cantidad, d.subtotal
                FROM detalle_venta d
                JOIN productos p ON d.producto_id = p.id
                WHERE d.venta_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$ventaId]);
        return $stmt->fetchAll();
    }

    public function obtenerVenta($ventaId) {
        $sql = "SELECT v.*, u.nombre AS usuario
                FROM ventas v
                LEFT JOIN usuarios u ON v.idUsuario = u.id
                WHERE v.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$ventaId]);
        return $stmt->fetch();
    }

    // Totales para dashboard
    public function totalVentas() {
        $sql = "SELECT COUNT(*) as numVentas, SUM(total) as totalIngresos FROM ventas";
        $stmt = $this->db->query($sql);
        return $stmt->fetch();
    }
}
