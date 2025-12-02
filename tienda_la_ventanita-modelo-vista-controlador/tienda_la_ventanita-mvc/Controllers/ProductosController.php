<?php
require_once __DIR__ . "/../Models/ProductosModel.php";

class ProductosController {
    private $model;
    public function __construct() {
        $this->model = new ProductosModel();
    }

    public function index() {
        $productos = $this->model->obtenerTodos();
        require_once __DIR__ . "/../Views/Productos/lista.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->crear($_POST['nombre'], $_POST['precio'], $_POST['stock']);
            header("Location: index.php?action=listadoProductos");
            exit;
        } else {
            require_once __DIR__ . "/../Views/Productos/nuevo.php";
        }
    }

    public function editar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->actualizar($id, $_POST['nombre'], $_POST['precio'], $_POST['stock']);
            header("Location: index.php?action=listadoProductos");
            exit;
        } else {
            $producto = $this->model->obtenerPorId($id);
            require_once __DIR__ . "/../Views/Productos/editar.php";
        }
    }

    public function eliminar($id) {
        $this->model->eliminar($id);
        header("Location: index.php?action=listadoProductos");
        exit;
    }

    public function agregarAlCarrito($id) {
        // inicializar sesión si no existe
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();

        $producto = $this->model->obtenerPorId($id);
        if (!$producto) {
            header("Location: index.php?action=listadoProductos");
            exit;
        }

        $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1;

        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
        // si ya existe, sumar cantidad
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['cantidad'] += $cantidad;
        } else {
            $_SESSION['cart'][$id] = [
                'producto_id' => $id,
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => $cantidad
            ];
        }

        header("Location: index.php?action=verCarrito");
        exit;
    }
}
