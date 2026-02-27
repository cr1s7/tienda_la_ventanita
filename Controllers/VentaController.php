<?php

require_once __DIR__ . "/../Model/VentaModel.php";
require_once __DIR__ . "/../Config/Database.php";

class VentaController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new VentaModel($db);
    }

    // ===============================
    // LISTAR TODAS LAS VENTAS
    // ===============================
    public function index()
    {
        $ventas = $this->model->obtenerTodasLasVentas();
        require_once "Views/ventas/listar.php";
    }

    // ===============================
    // VER DETALLE DE VENTA
    // ===============================
    public function ver($id)
    {
        $venta = $this->model->obtenerVentaPorId($id);
        $detalle = $this->model->obtenerDetalleVenta($id);

        require_once "Views/admin/ventaVer.php";
    }

    // ===============================
    // ELIMINAR VENTA
    // ===============================
    public function eliminar($id)
    {
        $this->model->eliminarDetallePorFactura($id);
        $this->model->eliminarFactura($id);

        header("Location: index.php?action=ventas");
        exit;
    }

    // ===============================
    // VENTAS ÚLTIMOS 7 DÍAS (CORREGIDO)
    // ===============================
    public function ventasUltimos7Dias()
    {
        $stmt = $this->conn->prepare(
            "SELECT DATE(fechaEmision) as fecha,
                    SUM(total) as total
            FROM factura
            WHERE DATE(fechaEmision) BETWEEN 
                DATE_SUB(CURDATE(), INTERVAL 6 DAY)
                AND CURDATE()
            GROUP BY DATE(fechaEmision)
            ORDER BY DATE(fechaEmision) ASC"
        );

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================
    // DASHBOARD - DATOS GRAFICA
    // ===============================
    public function dashboard()
    {
        $datosBD = $this->model->ventasUltimos7Dias();

        $ventasPorFecha = [];

        foreach ($datosBD as $fila) {
            $ventasPorFecha[$fila['fecha']] = (int)$fila['total'];
        }

        $dias = [];
        $totales = [];

        for ($i = 6; $i >= 0; $i--) {
            $fechaCompleta = date('Y-m-d', strtotime("-$i days"));
            $dias[] = date('d/m', strtotime($fechaCompleta));

            $totales[] = $ventasPorFecha[$fechaCompleta] ?? 0;
        }

        require_once "Views/Dashboard.php";
    }

    
}