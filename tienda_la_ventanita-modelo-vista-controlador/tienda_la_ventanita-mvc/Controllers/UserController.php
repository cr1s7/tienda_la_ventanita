<?php  

require_once './Config/Database.php';
require_once './Model/AuthModel.php';
require_once './Model/UserModel.php'; // tu CRUD normal

class UserController 
{
    private $authModel;
    private $userModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->connect();

        $this->authModel = new AuthModel($db);
        $this->userModel = new UserModel($db); 
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->authModel->login($email, $password);

        if ($user) {
            session_start();
            $_SESSION['user'] = $user;

            if ($user['idRol'] == 1) {
                header("Location: index.php?action=dashboard");
            } else {
                header("Location: index.php?action=dashboardUser");
            }
            exit;
        } else {
            $error = "Correo o contraseña incorrectos";
            include './Views/login.php';
        }
    }

    // insertar usuario (CRUD)
    public function insertUser()
    {
        $this->userModel->insertUser(
            $_POST['numDocumento'],
            $_POST['tipo_documento'],
            $_POST['nombre'],
            $_POST['direccion'],
            $_POST['telefono'],
            $_POST['email'],
            $_POST['password'],
            $_POST['idRol']
        );
    }
}
