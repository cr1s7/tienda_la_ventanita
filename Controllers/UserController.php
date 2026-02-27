<?php
require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../Model/UserModel.php';
require_once __DIR__ . '/../Model/TipoDocumentoModel.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Model/VentaModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class UserController 
{
    private $model;
    private $tipoModel;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->model = new UserModel($db);
        $this->tipoModel = new TipoDocumentoModel($db);
        $this->ventaModel = new VentaModel($db);
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
                'idUsuario' => $user['idUsuario'],
                'nombre' => $user['nombre'],
                'rol' => $user['idRol'],
                'email' => $user['email']
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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // 🔒 Blindaje de rol
            if (isset($_SESSION['user']) && $_SESSION['user']['rol'] == 1) {
                $_POST['idRol'] = $_POST['idRol'] ?? 2;
                $esAdmin = true;
            } else {
                $_POST['idRol'] = 2;
                $esAdmin = false;
            }

            // 🔐 VALIDAR EMAIL ÚNICO
            if ($this->model->buscarPorEmail($_POST['email'])) {
                $error = "Este correo ya está registrado";
                $tipos = $this->tipoModel->listar();
                include './Views/usuarios/insert_User.php';
                return;
            }

            $this->model->insertar($_POST);

            // 🔥 REDIRECCIÓN INTELIGENTE
            if ($esAdmin) {
                header("Location: index.php?action=usuarios");
            } else {
                header("Location: index.php?action=login");
            }

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

        $this->model->actualizarPassword($userId, $nueva);

        header("Location: index.php?action=dashboard");
        exit;
    }

        /* ====== FORM RECUPERAR ====== */
    public function forgotPasswordForm()
    {
        include './Views/usuarios/forgot_password.php';
    }


    /* ====== ENVIAR TOKEN ====== */
    
    /* ====== ENVIAR CÓDIGO PRO ====== */
    public function sendCode()
    {
        $email = $_POST['email'];

        $user = $this->model->buscarPorEmail($email);

        if (!$user) {
            $error = "El correo no está registrado";
            include './Views/usuarios/forgot_password.php';
            return;
        }

        $codigo = rand(100000, 999999);
        $expira = date("Y-m-d H:i:s", strtotime("+15 minutes"));

        $this->model->guardarCodigo($email, $codigo, $expira);

        /* ===== CONFIG PHPMailer ===== */
        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'miguelgg0711@gmail.com';
            $mail->Password   = 'vjjuojsqsugkcmfe';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('miguelgg0711@gmail.com', 'La Ventanita');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Codigo de recuperacion';
            $mail->Body    = "
                <h3>Recuperación de contraseña</h3>
                <p>Tu código es:</p>
                <h1>$codigo</h1>
                <p>Expira en 15 minutos</p>
            ";

            $mail->send();

            $mensaje = "Código enviado al correo";
            include './Views/usuarios/verify_code.php';

        } catch (Exception $e) {
            $error = "No se pudo enviar el correo";
            include './Views/usuarios/forgot_password.php';
        }
    }



    /* ====== VALIDAR CÓDIGO ====== */
    public function verifyCode()
    {
        $email  = $_POST['email'] ?? null;
        $codigo = $_POST['codigo'] ?? null;

        if (!$email || !$codigo) {
            header("Location: index.php?action=forgotPasswordForm");
            exit;
        }

        $user = $this->model->validarCodigo($email, $codigo);

        if (!$user) {
            $error = "Código inválido o expirado";
            include './Views/usuarios/verify_code.php';
            return;
        }

        // 👇 PASAR EMAIL A LA VISTA
        include './Views/usuarios/cambiar_password.php';
    }





    /* ====== ACTUALIZAR PASSWORD POR CÓDIGO ====== */
    public function updatePasswordCode()
    {
        $email      = $_POST['email'] ?? null;
        $password   = $_POST['password'] ?? null;
        $confirmar  = $_POST['confirmar_password'] ?? null;

        if (!$email || !$password || !$confirmar) {
            $error = "Todos los campos son obligatorios";
            include './Views/usuarios/cambiar_password.php';
            return;
        }

        // Confirmación
        if ($password !== $confirmar) {
            $error = "Las contraseñas no coinciden";
            include './Views/usuarios/cambiar_password.php';
            return;
        }

        // Reglas seguridad backend
        if (
            strlen($password) < 6 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[^A-Za-z0-9]/', $password)
        ) {
            $error = "La contraseña no cumple las reglas de seguridad";
            include './Views/usuarios/cambiar_password.php';
            return;
        }

        // Actualizar
        $this->model->actualizarPasswordCodigo($email, $password);

        $mensaje = "Contraseña actualizada correctamente";
        include './Views/login.php';
    }



    /* ================= LOGOUT ================= */
    public function logout()
    {
        // Iniciar sesión si no existe
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 👇 Guardar nombre antes de destruir
        $nombre = $_SESSION['user']['nombre'] ?? 'Cliente';

        // Vaciar variables
        $_SESSION = [];

        // Destruir cookie sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Destruir sesión
        session_destroy();

        // 👇 Redirigir con mensaje
        header(
            "Location: index.php?action=home&logout=1&nombre=" 
            . urlencode($nombre)
        );
        exit;
    }

    public function miCuenta()
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['user'])){
            header("Location: index.php?action=login");
            exit;
        }

        $idUsuario = $_SESSION['user']['idUsuario'];

        $compras = $this->ventaModel->obtenerComprasPorUsuario($idUsuario);

        require_once './Views/usuarios/mi_cuenta.php';
    }



}
