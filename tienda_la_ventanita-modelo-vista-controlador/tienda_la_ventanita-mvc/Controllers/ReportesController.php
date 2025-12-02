<?php
require_once __DIR__ . "/../Models/ReportesModel.php";

class ReportesController {
    private $model;
    public function __construct() {
        $this->model = new ReportesModel();
    }

    public function index() {
        $reportes = $this->model->obtenerTodosConUsuario();
        require_once __DIR__ . "/../Views/Reportes/lista.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $usuarioId = $_SESSION['idUsuario'] ?? null;
            if (!$usuarioId) {
                header("Location: index.php?action=login");
                exit;
            }

            $this->model->crear($usuarioId, $_POST['titulo'], $_POST['descripcion']);
            header("Location: index.php?action=reportes");
            exit;
        } else {
            require_once __DIR__ . "/../Views/Reportes/nuevo.php";
        }
    }
}
