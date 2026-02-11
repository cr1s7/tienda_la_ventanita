<?php

require_once './Config/Database.php';
require_once './Model/UnidadModel.php';

class UnidadController {

    private $model;

    public function __construct(){

        $database = new Database();
        $db = $database->getConnection();

        $this->model = new UnidadModel($db);
    }

    // LISTAR
    public function index() {
        $unidades = $this->model->listar();
        require './Views/unidades/listar.php';
    }

    // CREAR
    public function crear() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->model->crear($_POST['nombre']);

            $_SESSION['message'] = "Unidad creada correctamente";

            header("Location: index.php?action=unidades");
            exit;
        }

        require './Views/unidades/crear.php';
    }

    // EDITAR
    public function editar() {

        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->model->editar($id, $_POST['nombre']);

            $_SESSION['message'] = "Unidad actualizada";

            header("Location: index.php?action=unidades");
            exit;
        }

        $unidad = $this->model->buscar($id);

        require './Views/unidades/editar.php';
    }

    // ELIMINAR
    public function eliminar() {

        $this->model->eliminar($_GET['id']);

        $_SESSION['message'] = "Unidad eliminada";

        header("Location: index.php?action=unidades");
        exit;
    }
}
