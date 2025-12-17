<?php
require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../Model/UserModel.php';
require_once __DIR__ . '/../Model/TipoDocumentoModel.php';

class UserController 
{
    private $model;
    private $tipoModel;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->model = new UserModel($db);
        $this->tipoModel = new TipoDocumentoModel($db);
    }

    public function login()
    {
           
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->model->login($email);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            session_regenerate_id(true);

            $_SESSION['user'] = [
                'id' => $user['idUsuario'],
                'nombre' => $user['nombre'],
                'rol' => $user['idRol']
            ];

            if ($user['idRol'] == 1) {
                header("Location: index.php?action=dashboard");
            } else {
                header("Location: index.php?action=dashboardUser");
            }
            exit;
        }

        $error = "Correo o contraseña incorrectos";
        include './Views/login.php';
    }



    /* ================= REGISTRO ================= */
    public function insertUser()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->insertar($_POST);
            header("Location: index.php?action=usuarios");
            exit;
        }


    }

    public function insertUserPublic()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->insertar($_POST);
            header("Location: index.php?action=login");
            exit;
        }
    }

    /* ================= USUARIOS ================= */
    public function listarUsuarios()
    {
        $usuarios = $this->model->listar();
        include './Views/usuarios/listar.php';
    }
    public function editarUsuario($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->actualizar($_POST);
            header("Location: index.php?action=usuarios");
            exit;
        } else {
            $usuario = $this->model->buscar($id);
            $tipos = $this->tipoModel->listar();
            include './Views/usuarios/edit_User.php';
        }
    }



    public function eliminarUsuario($id)
    {
        $this->model->eliminar($id);
        header("Location: index.php?action=usuarios");
        exit;
    }

    public function changePassword()
    {
        session_start();

        $userId = $_SESSION['user']['id'];

        $actual = $_POST['password_actual'];
        $nueva = $_POST['password_nueva'];
        $confirmar = $_POST['password_confirmar'];

        if ($nueva !== $confirmar) {
            $error = "Las contraseñas no coinciden";
            include './Views/usuarios/cambiar_password.php';
            exit;
        }

        $user = $this->model->buscar($userId);

        if (!password_verify($actual, $user['password'])) {
            $error = "Contraseña actual incorrecta";
            include './Views/usuarios/cambiar_password.php';
            exit;
        }

        // ✅ SOLO ACTUALIZA PASSWORD
        $this->model->actualizarPassword($userId, $nueva);

        header("Location: index.php?action=dashboard");
        exit;
    }



    /* ================= LOGOUT ================= */
    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}
