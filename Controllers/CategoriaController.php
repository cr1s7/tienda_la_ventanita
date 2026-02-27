<?php
require_once './Config/Database.php';
require_once './Model/Categoria.php';

class CategoriaController
{
    private $model;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->model = new CategoriaModel($db);
    }

    // Listar categorías
    public function listarCategorias()
    {
        $categorias = $this->model->listar();
        include './Views/Categorias/listar.php';
    }

    // Formulario de creación
    public function crearForm()
    {
        include './Views/Categorias/crear.php';
    }

    // Guardar categoría
    public function guardarCategoria()
    {
        $nombre = $_POST['nombre'] ?? '';
        if ($nombre) {
            $this->model->crear(['nombre' => $nombre]);
            $_SESSION['message'] = "Categoría creada correctamente";
        } else {
            $_SESSION['error'] = "Debe ingresar un nombre para la categoría";
        }
        header("Location: index.php?action=categorias");
        exit;
    }

    // Formulario de edición
    public function editarForm($id)
    {
        $categoria = $this->model->buscar($id);
        include './Views/Categorias/editar.php';
    }

    // Actualizar categoría
    public function actualizarCategoria()
    {
        $data = [
            'idCategoria' => $_POST['idCategoria'] ?? 0,
            'nombre' => $_POST['nombre'] ?? ''
        ];

        if ($data['nombre']) {
            $this->model->actualizar($data);
            $_SESSION['message'] = "Categoría actualizada correctamente";
        } else {
            $_SESSION['error'] = "Debe ingresar un nombre para la categoría";
        }

        header("Location: index.php?action=categorias");
        exit;
    }

    // Eliminar categoría
    public function eliminarCategoria($id)
    {
        try {
            $this->model->eliminar($id);
            $_SESSION['message'] = "Categoría eliminada correctamente";
        } catch (PDOException $e) {
            $_SESSION['error'] = "No se puede eliminar, tiene registros relacionados.";
        }
        header("Location: index.php?action=categorias");
        exit;
    }
}
