<?php
require_once './Controllers/UserController.php';
require_once './Controllers/TipoDocumentoController.php';
require_once './Controllers/ProductosController.php';
require_once './Controllers/VentasController.php';
require_once './Controllers/ReportesController.php';
require_once './Controllers/DashboardController.php';


$userController = new UserController();
$tipoDocumentoController = new TipoDocumentoController();

$productosController = new ProductosController();
$ventasController    = new VentasController();

$action = $_GET['action'] ?? 'login';

switch ($action) {

    /* ======================================================
     *    LOGIN Y USUARIOS
     * =====================================================*/
    case 'login':
        include './Views/login.php';
        break;

    case 'doLogin':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->login();
        }
        break;

    case 'insertUser':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->insertUser();
            header("Location: index.php?action=dashboard");
        } else {
            $tipos = $tipoDocumentoController->listaTipoDocumento();
            include './Views/insert_User.php';
        }
        break;

    case 'dashboard':
        include './Views/Dashboard.php';
        break;

    case 'listadoProductos':
    $productosController->index();
        break;

    case 'crearProducto':
    $productosController->crear();
        break;

    case 'editarProducto':
    $id = $_GET['id'] ?? null;
    $productosController->editar($id);
        break;

    case 'eliminarProducto':
    $id = $_GET['id'] ?? null;
    $productosController->eliminar($id);
        break;

    case 'agregarAlCarrito':
    $id = $_GET['id'] ?? null;
    $productosController->agregarAlCarrito($id);
        break;

    case 'verCarrito':
    $ventasController->verCarrito();
        break;

    case 'quitarDelCarrito':
    $id = $_GET['id'] ?? null;
    $ventasController->quitarDelCarrito($id);
        break;

    case 'checkout':
    $ventasController->checkout();
        break;

    case 'listaVentas':
    $ventasController->listaVentas();
        break;

    case 'detalleFactura':
    $id = $_GET['id'] ?? null;
    $ventasController->detalle($id);
        break;

    case 'reportes':
    $reportesController->index();
        break;

    case 'crearReporte':
    $reportesController->crear();
        break;

    case 'dashboard':
    $dashboardController->index();
        break;

}

