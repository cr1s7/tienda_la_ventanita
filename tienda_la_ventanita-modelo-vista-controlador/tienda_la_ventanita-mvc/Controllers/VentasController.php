<?php
require_once __DIR__ . "/../Models/VentasModel.php";
require_once __DIR__ . "/../Models/ProductosModel.php";

class VentasController {
    private $model;
    private $productosModel;

    public function __construct() {
        $this->model = new VentasModel();
        $this->productosModel = new ProductosModel();
    }

    public function verCarrito() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $cart = $_SESSION['cart'] ?? [];
        require_once __DIR__ . "/../Views/Ventas/carrito.php";
    }

    public function quitarDelCarrito($id) {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header("Location: index.php?action=verCarrito");
        exit;
    }

    public function checkout() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $cart = $_SESSION['cart'] ?? [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // validar usuario logueado
            $usuarioId = $_SESSION['idUsuario'] ?? null;
            if (!$usuarioId) {
                // redirigir a login si no está logueado
                header("Location: index.php?action=login");
                exit;
            }

            // preparar items
            $items = [];
            $total = 0;
            foreach ($cart as $it) {
                $subtotal = $it['precio'] * $it['cantidad'];
                $items[] = [
                    'producto_id' => $it['producto_id'],
                    'cantidad' => $it['cantidad'],
                    'subtotal' => $subtotal
                ];
                $total += $subtotal;
            }

            try {
                $ventaId = $this->model->registrarVenta($usuarioId, $items, $total);
                // vaciar carrito
                unset($_SESSION['cart']);
                header("Location: index.php?action=detalleFactura&id=".$ventaId);
                exit;
            } catch (Exception $e) {
                $error = $e->getMessage();
                require_once __DIR__ . "/../Views/Ventas/checkout.php";
            }
        } else {
            $cart = $_SESSION['cart'] ?? [];
            require_once __DIR__ . "/../Views/Ventas/checkout.php";
        }
    }

    public function listaVentas() {
        $ventas = $this->model->obtenerVentasConUsuario();
        require_once __DIR__ . "/../Views/Ventas/lista.php";
    }

    public function detalle($id) {
        $venta = $this->model->obtenerVenta($id);
        $detalle = $this->model->detalleVenta($id);
        require_once __DIR__ . "/../Views/Ventas/detalle.php";
    }
}
