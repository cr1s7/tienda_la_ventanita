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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['idUnidad']; // <-- CAMBIAR AQUÍ

            $this->model->editar($id, $_POST['nombre']);

            $_SESSION['message'] = "Unidad actualizada";

            header("Location: index.php?action=unidades");
            exit;
        }

        $id = $_GET['id'];
        $unidad = $this->model->buscar($id);

        require './Views/unidades/editar.php';
    }

    // ELIMINAR
// ELIMINAR
    public function eliminar() {

        $id = $_GET['id'];

        // VALIDAR RELACIÓN FK
        if($this->model->tieneProductos($id)){

            $_SESSION['error'] =
                "No se puede eliminar la unidad porque tiene productos asociados.";

            header("Location: index.php?action=unidades");
            exit;
        }

        // ELIMINAR
        if($this->model->eliminar($id)){

            $_SESSION['message'] =
                "Unidad eliminada correctamente.";

        } else {

            $_SESSION['error'] =
                "Error al eliminar la unidad.";
        }

        header("Location: index.php?action=unidades");
        exit;
    }

}
