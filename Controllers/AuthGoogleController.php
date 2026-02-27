<?php
require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../Model/UserModel.php';

class AuthGoogleController {

    private $client;

    public function __construct() {

        $this->client = new Google_Client();

        $clientID = $_ENV['GOOGLE_CLIENT_ID'] ?? null;
        $clientSecret = $_ENV['GOOGLE_CLIENT_SECRET'] ?? null;
        $redirectUri = $_ENV['GOOGLE_REDIRECT_URI'] ?? null;

        // 🔴 ESTO FALTABA
        $this->client->setClientId($clientID);
        $this->client->setClientSecret($clientSecret);
        $this->client->setRedirectUri($redirectUri);

        $this->client->addScope("email");
        $this->client->addScope("profile");
    }

    // 🔵 Redirige a Google
    public function login() {

        $this->client->setPrompt('select_account'); 
        // También puedes usar 'consent'

        $url = $this->client->createAuthUrl();
        header("Location: $url");
        exit;
    }


    // 🔵 Callback
   public function callback() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_GET['code'])) {

            $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            $this->client->setAccessToken($token);

            $google_oauth = new Google_Service_Oauth2($this->client);
            $info = $google_oauth->userinfo->get();

            $email = $info->email;
            $name  = $info->name;

            // 🔥 Conectar a BD
            $db = (new Database())->getConnection();
            $userModel = new UserModel($db);

            // 1️⃣ Buscar si ya existe
            $usuario = $userModel->buscarPorEmail($email);

            // 2️⃣ Si no existe → crearlo automáticamente
            if (!$usuario) {

                $data = [
                    'numDocumento' => null,
                    'tipoDocumento' => null,
                    'nombre' => $name,
                    'direccion' => null,
                    'telefono' => null,
                    'email' => $email,
                    'password' => bin2hex(random_bytes(8)), // contraseña aleatoria
                    'idRol' => 2
                ];

                $userModel->insertar($data);

                // Volver a buscar ya creado
                $usuario = $userModel->buscarPorEmail($email);
            }

            // 🔐 Guardar sesión igual que login normal
            $_SESSION['user'] = [
                'id' => $usuario['idUsuario'],
                'idUsuario' => $usuario['idUsuario'],
                'nombre' => $usuario['nombre'],
                'rol' => $usuario['idRol']
            ];

            // Redirigir según rol
            if ($usuario['idRol'] == 1) {
                header("Location: index.php?action=dashboard");
            } else {
                header("Location: index.php?action=dashboardUser");
            }

            exit;
        }
    }

}
