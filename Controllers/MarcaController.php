<?php
require_once './Model/MarcaModel.php';
require_once './Config/Database.php';

class MarcaController {
    private $model;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->model = new MarcaModel($db);
    }

    public function index() {
        $marcas = $this->model->listar();
        require './Views/marcas/listar.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->crear($_POST['nombre']);
            $_SESSION['message'] = "Marca registrada correctamente.";
            header("Location: index.php?action=marcas");
            exit;
        }
        require './Views/marcas/crear.php';
    }

    public function editar() {
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->editar($_POST['idMarca'], $_POST['nombre']);
            $_SESSION['message'] = "Marca actualizada.";
            header("Location: index.php?action=marcas");
            exit;
        }

        $marca = $this->model->buscar($id);
        require './Views/marcas/editar.php';
    }

    public function eliminar() {
        $this->model->eliminar($_GET['id']);
        $_SESSION['message'] = "Marca eliminada.";
        header("Location: index.php?action=marcas");
    }
}
