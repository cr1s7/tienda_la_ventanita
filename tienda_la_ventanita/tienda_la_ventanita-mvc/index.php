<?php
require_once __DIR__ . '/Config/Database.php';
require_once __DIR__ . '/Controllers/UserController.php';
require_once __DIR__ . '/Controllers/TipoDocumentoController.php';
require_once __DIR__ . '/Controllers/ProductoController.php';
require_once __DIR__ . '/Controllers/CategoriaController.php';
require_once __DIR__ . '/Controllers/MarcaController.php';
require_once __DIR__ . '/Controllers/HomeController.php';
require_once __DIR__ . '/Controllers/CarritoController.php';
require_once __DIR__ . '/Controllers/ProductoController.php';
require_once __DIR__ . '/Controllers/UnidadController.php';



$database = new Database();
$db = $database->getConnection();

$productoController = new ProductoController();

// Productos destacados
$destacados = $productoController->destacados();

$unidadController = new UnidadController();
$userController = new UserController();
$tipoDocumentoController = new TipoDocumentoController();
$productoController = new ProductoController();
$categoriaController = new CategoriaController();
$marcaController = new MarcaController();
$homeController = new HomeController();
$carritoController = new CarritoController($db);


$action = $_GET['action'] ?? 'home';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

    // ---------- LOGOUT ----------
    case 'logout':

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Guardar nombre antes de destruir sesión
        $nombre = $_SESSION['user']['nombre'] ?? 'Cliente';

        session_destroy();

        session_start(); // Nueva sesión para mensaje flash

        $_SESSION['mensaje_logout'] =
            "Gracias por visitarnos <b>$nombre</b>, vuelve pronto 🏪";

        header("Location: index.php?action=home");
        exit;



    // ---------- DASHBOARD ----------
    case 'dashboard':
         include './Views/Dashboard.php';
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

    //----------- CARRITO ----------
    case 'agregarCarrito':
        $carritoController->agregar();
        break;

    case 'carrito':
        $carritoController->index();
        break;

    case 'eliminarCarrito':
        $carritoController->eliminar();
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
