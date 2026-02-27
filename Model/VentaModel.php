<?php

class VentaModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // ===============================
    // CREAR FACTURA
    // ===============================
    public function crearVenta($idUsuario)
    {
        $sql = "INSERT INTO factura (idUsuario, fechaEmision, total)
                VALUES (?, NOW(), 0)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);

        return $this->conn->lastInsertId();
    }

    // ===============================
    // INSERTAR DETALLE
    // ===============================
    public function insertarDetalle($idFactura, $item)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO detalle_salida
            (idFactura, idProducto, cantiSalida, valorUnitario, totalVenta)
            VALUES (?, ?, ?, ?, ?)"
        );

        $total = $item['cantidad'] * $item['precio'];

        return $stmt->execute([
            $idFactura,
            $item['idProducto'],
            $item['cantidad'],      // cantiSalida
            $item['precio'],        // valorUnitario
            $total                  // totalVenta
        ]);
    }

    // ===============================
    // ACTUALIZAR TOTAL FACTURA
    // ===============================
    public function actualizarTotal($idFactura, $total)
    {
        $sql = "UPDATE factura
                SET total=?
                WHERE idFactura=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$total, $idFactura]);
    }

    public function obtenerVentaPorId($id)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM factura WHERE idFactura = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerDetalleVenta($idFactura)
    {
        $stmt = $this->conn->prepare(
            "SELECT ds.cantiSalida,
                    ds.valorUnitario,
                    ds.totalVenta,
                    p.nombre
            FROM detalle_salida ds
            JOIN productos p
            ON p.idProducto = ds.idProducto
            WHERE ds.idFactura = ?"
        );

        $stmt->execute([$idFactura]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerComprasPorUsuario($idUsuario)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM factura
            WHERE idUsuario = ?
            ORDER BY fechaEmision DESC"
        );

        $stmt->execute([$idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================
    // LISTAR TODAS LAS FACTURAS (ADMIN)
    // ===============================
    public function obtenerTodasLasVentas()
    {
        $stmt = $this->conn->prepare(
            "SELECT f.idFactura,
                    f.fechaEmision,
                    f.total,
                    u.nombre
            FROM factura f
            JOIN usuarios u ON u.idUsuario = f.idUsuario
            ORDER BY f.fechaEmision DESC"
        );

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ===============================
    // ELIMINAR DETALLE POR FACTURA
    // ===============================
    public function eliminarDetallePorFactura($idFactura)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM detalle_salida WHERE idFactura = ?"
        );
        return $stmt->execute([$idFactura]);
    }


    // ===============================
    // ELIMINAR FACTURA
    // ===============================
    public function eliminarFactura($idFactura)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM factura WHERE idFactura = ?"
        );
        return $stmt->execute([$idFactura]);
    }


    // ===============================
    // VENTAS POR SEMANA (GRÁFICA)
    // ===============================
    public function ventasPorSemana()
    {
        $stmt = $this->conn->prepare(
            "SELECT DAYNAME(fechaEmision) as dia,
                    COUNT(*) as total
            FROM factura
            WHERE WEEK(fechaEmision) = WEEK(CURDATE())
            GROUP BY DAYNAME(fechaEmision)"
        );

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================
    // VENTAS ÚLTIMOS 7 DÍAS
    // ===============================
    public function ventasUltimos7Dias()
    {
        $sql = "
            SELECT 
                DATE(fechaEmision) as fecha,
                SUM(total) as total
            FROM factura
            WHERE fechaEmision >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
            GROUP BY DATE(fechaEmision)
            ORDER BY fecha ASC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerVentasUltimos7Dias() {

        $sql = "SELECT idFactura, fechaEmision, total
                FROM factura
                WHERE fechaEmision >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
                ORDER BY fechaEmision DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}