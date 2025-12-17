<?php
require_once './Model/UnidadModel.php';

class UnidadController {
    private $model;

    public function __construct() {
        $this->model = new UnidadModel();
    }

    public function index() {
        $unidades = $this->model->listar();
        require './Views/unidades/listar.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->crear($_POST['nombre']);
            header("Location: index.php?route=unidades");
        }
        require './Views/unidades/crear.php';
    }

    public function editar() {
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->editar($id, $_POST['nombre']);
            header("Location: index.php?route=unidades");
        }

        $unidad = $this->model->buscar($id);
        require './Views/unidades/editar.php';
    }

    public function eliminar() {
        $this->model->eliminar($_GET['id']);
        header("Location: index.php?route=unidades");
    }
}
