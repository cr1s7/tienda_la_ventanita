
<?php
require_once './Controllers/UserController.php';
require_once './Controllers/TipoDocumentoController.php';



$userController = new UserController();
$tipoDocumentoController = new TipoDocumentoController();

$action = $_GET['action'] ?? 'login';

switch ($action) {

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

    default:
        echo "404 - Página no encontrada";
        break;
}
