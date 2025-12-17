<?php
require_once './Config/Database.php';
require_once './Model/ProductoModel.php';

class ProductoController
{
    private $model;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->model = new ProductoModel($db);
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    // LISTAR PRODUCTOS
    public function listarProductos()
    {
        $productos = $this->model->listar();
        include './Views/Productos/listar.php';
    }

    // CREAR PRODUCTO
    public function guardarProducto()
    {
        $this->model->crear($_POST);
        $_SESSION['message'] = "Producto creado correctamente";
        header("Location: index.php?action=productos");
        exit;
    }

    // BUSCAR PRODUCTO PARA EDITAR
    public function buscarProducto($id)
    {
        return $this->model->buscar($id);
    }

    // ACTUALIZAR PRODUCTO
    public function actualizarProducto()
    {
        $this->model->actualizar($_POST);
        $_SESSION['message'] = "Producto actualizado correctamente";
        header("Location: index.php?action=productos");
        exit;
    }

    // ELIMINAR PRODUCTO (maneja FK)
    public function eliminarProducto($id)
    {
        try {
            $this->model->eliminar($id);
            $_SESSION['message'] = "Producto eliminado correctamente";
        } catch (PDOException $e) {
            // Si falla por FK
            $_SESSION['error'] = "No se puede eliminar el producto, tiene registros relacionados.";
        }

        header("Location: index.php?action=productos");
        exit;
    }

    public function crearForm()
{
    $categorias = $this->model->getCategorias();
    $unidades = $this->model->getUnidades();
    $marcas    = $this->model->getMarcas();

    include './Views/Productos/crear.php';
}

}


