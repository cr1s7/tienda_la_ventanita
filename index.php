<?php
date_default_timezone_set('America/Bogota');

session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Config/Database.php';
require_once __DIR__ . '/Controllers/UserController.php';
require_once __DIR__ . '/Controllers/TipoDocumentoController.php';
require_once __DIR__ . '/Controllers/ProductoController.php';
require_once __DIR__ . '/Controllers/CategoriaController.php';
require_once __DIR__ . '/Controllers/MarcaController.php';
require_once __DIR__ . '/Controllers/HomeController.php';
require_once __DIR__ . '/Controllers/CarritoController.php';
require_once __DIR__ . '/Controllers/UnidadController.php';
require_once __DIR__ . '/Config/session.php';
require_once __DIR__ . '/Controllers/AuthGoogleController.php';
require_once __DIR__ . '/Controllers/CheckoutController.php';
require_once __DIR__ . '/Controllers/VentaController.php';
require_once __DIR__ . '/Controllers/ReporteController.php';




define("BASE_URL", "http://localhost/tienda_la_ventanita/tienda_la_ventanita-mvc/");





$database = new Database();
$db = $database->getConnection();

$productoController = new ProductoController();
$reportesController = new ReporteController();
$destacados = $productoController->destacados();
$authGoogle = new AuthGoogleController();
$unidadController = new UnidadController();
$userController = new UserController();
$tipoDocumentoController = new TipoDocumentoController();
$ventaController = new VentaController($db);
$productoController = new ProductoController();
$categoriaController = new CategoriaController();
$marcaController = new MarcaController();
$homeController = new HomeController();
$carritoController = new CarritoController($db);
$checkoutController = new CheckoutController($db);


$action = $_GET['action'] ?? 'home';


function requireLogin()
{
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=login");
        exit;
    }
}

function requireAdmin()
{
    requireLogin();
    
    if ($_SESSION['user']['rol'] != 1) {
        header("Location: index.php?action=dashboardUser");
        exit;
    }
}


switch ($action) {

    // ---------- LOGIN ----------
    case 'login':
        include './Views/login.php';
        break;

    case 'doLogin':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->login();
        } else {
            header("Location: index.php?action=login");
            exit;
        }
        break;

    // ---------- RECUPERAR PASSWORD ----------
    case 'forgotPasswordForm':
        $userController->forgotPasswordForm();
        break;

    // ===== RECUPERACIÓN POR CÓDIGO =====

    case 'sendCode':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->sendCode();
        }
        break;

    case 'verifyCode':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->verifyCode();
        }
        break;

    case 'updatePasswordCode':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->updatePasswordCode();
        }
        break;



    // ---------- LOGOUT ----------
    case 'logout':
        $userController->logout();
        break;

    // ---------- DASHBOARD ----------
    case 'dashboard':
         $ventaController->dashboard();
       break;

    case 'dashboardUser':
        $homeController->index();
        break;


    // ---------- USUARIOS ----------
    case 'usuarios':
        $userController->listarUsuarios();
        break;

    case 'insertUser':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->insertUser();
        } else {
            $tipos = $tipoDocumentoController->listaTipoDocumento();
            include './Views/usuarios/insert_User.php';
        }
        break;

    case 'usuarioEditar':
        if (isset($_GET['id'])) {
            $userController->editarUsuario($_GET['id']);
        } else {
            header("Location: index.php?action=usuarios");
            exit;
        }
        break;

    case 'userActualizar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->editarUsuario($_POST['idUsuario']);
        } else {
            header("Location: index.php?action=usuarios");
            exit;
        }
        break;

    case 'userEliminar':
        if (isset($_GET['id'])) {
            $userController->eliminarUsuario($_GET['id']);
        } else {
            header("Location: index.php?action=usuarios");
            exit;
        }
        break;

    case 'changePassword':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->changePassword();
        }
        break;

    case 'passwordForm':
        include './Views/usuarios/cambiar_password.php';
        break;

    case 'miCuenta':
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $userController->miCuenta();
        break;


    // ---------- PRODUCTOS ----------
    case 'productos':
        requireAdmin();
        $productoController->listarProductos();
        break;


    case 'productoCrear':
        requireAdmin();
        $productoController->crearForm();
        break;

    case 'productoGuardar':
        requireAdmin();
        $productoController->guardarProducto();
        break;


    case 'productoActualizar':
        requireAdmin();
        $productoController->actualizarProducto();
        break;

    case 'productoEditar':
        $controller = new ProductoController();
        $controller->editarForm($_GET['id']);
        break;


    case 'productoEliminar':
        requireAdmin();
        $productoController->eliminarProducto($_GET['id']);
        break;
        
    case 'productosTienda':
        $productoController->listarProductosFrontend();
        break;

    case 'tienda':
        $productoController->tienda();
        break;


    case 'buscarProducto':
    $productoController->buscarFrontend();
    break;

    case 'productoDetalle':
    $productoController->detalle($_GET['id']);
    break;



    // ---------- CATEGORÍAS ----------
    case 'categorias':
        $categoriaController->listarCategorias();
        break;

    case 'categoriaCrear':
        $categoriaController->crearForm();
        break;

    case 'categoriaGuardar':
        $categoriaController->guardarCategoria();
        break;

    case 'categoriaEditar':
        $categoriaController->editarForm($_GET['id']);
        break;

    case 'categoriaActualizar':
        $categoriaController->actualizarCategoria();
        break;

    case 'categoriaEliminar':
        $categoriaController->eliminarCategoria($_GET['id']);
        break;

    // ---------- MARCAS ----------
    case 'marcas':
        $marcaController->index();
        break;

    case 'marcaCrear':
        $marcaController->crear();
        break;

    case 'marcaEditar':
        $marcaController->editar();
        break;

    case 'marcaEliminar':
        $marcaController->eliminar();
        break;


    //----------- HOME ----------
    case 'home':
        $homeController->index();
        break;

    //----------- VENTAS ----------
    case 'ventas':
        $ventaController->index();
    break;

    case 'reporteSemanal':
        $reportesController->reporteSemanal();
    break;

    //----------- CARRITO ----------

    case 'agregarCarritoAjax':
        $controller = new CarritoController($db);
        $controller->agregarAjax();
    break;


    case 'finalizarCompra':
        $controller = new CarritoController($db);
        $controller->finalizarCompra();
    break;

    case 'obtenerCarritoAjax':
        $carritoController->obtenerCarritoAjax();
    break;


    case 'sumarAjax':
        $carritoController->sumarAjax();
    break;

    case 'restarAjax':
        $carritoController->restarAjax();
    break;

    case 'eliminarAjax':
        $carritoController->eliminarAjax();
    break;

    case 'contarItemsAjax':
        $carritoController->contarAjax();
    break;
    
    case 'carrito':
        $carritoController->ver();
    break;

    // -------- CHECKOUT (PASARELA SIMULADA) --------

    // =======================
    // CHECKOUT
    // =======================

    case 'checkout':
        $checkoutController->index();
    break;

    case 'procesarCompra':
        $checkoutController->procesar();
    break;

    case 'descargarFactura':
        if(isset($_GET['id'])){
            $checkoutController->generarPDF($_GET['id']);
        }
    break;

    // -------gogle auth------- 
    case 'loginGoogle': 
        $authGoogle->login(); 
    break; 
    
    case 'googleCallback': 
        $authGoogle->callback(); 
    break;



  
    // ===== UNIDADES =====
    case 'unidades':
        $controller = new UnidadController();
        $controller->index();
        break;

    case 'crearUnidad':
        $controller = new UnidadController();
        $controller->crear();
        break;

    case 'editarUnidad':
        $controller = new UnidadController();
        $controller->editar();
        break;

    case 'eliminarUnidad':
        $controller = new UnidadController();
        $controller->eliminar();
        break;



    // ---------- 404 ----------
    default:
        echo "404 - Página no encontrada";
        break;
}
