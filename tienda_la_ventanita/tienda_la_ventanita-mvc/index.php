<?php
require_once './Controllers/UserController.php';
require_once './Controllers/TipoDocumentoController.php';
require_once './Controllers/ProductoController.php';
require_once './Controllers/CategoriaController.php';
require_once './Controllers/MarcaController.php';

$userController = new UserController();
$tipoDocumentoController = new TipoDocumentoController();
$productoController = new ProductoController();
$categoriaController = new CategoriaController();
$marcaController = new MarcaController();

$action = $_GET['action'] ?? 'login';

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
        session_start();
        session_destroy();
        header("Location: index.php?action=login");
        exit;

    // ---------- REGISTRO PÚBLICO ----------
    case 'register':
        $tipos = $tipoDocumentoController->listaTipoDocumento();
        include './Views/usuarios/insert_UserPublic.php';
        break;

    case 'registerSave':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->insertUserPublic();
        } else {
            header("Location: index.php?action=login");
            exit;
        }
        break;

    // ---------- DASHBOARD ----------
    case 'dashboard':
        include './Views/Dashboard.php';
        break;

    case 'dashboardUser':
        include './Views/DashboardUser.php';
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
        $productoController->listarProductos();
        break;

    case 'productoCrear':
        include './Views/Productos/crear.php';
        break;

    case 'productoGuardar':
        $productoController->guardarProducto();
        break;

    case 'productoEditar':
        $producto = $productoController->buscarProducto($_GET['id']);
        include './Views/Productos/editar.php';
        break;

    case 'productoActualizar':
        $productoController->actualizarProducto();
        break;

    case 'productoEliminar':
        $productoController->eliminarProducto($_GET['id']);
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

    // ---------- 404 ----------
    default:
        echo "404 - Página no encontrada";
        break;
}
