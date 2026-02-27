<?php
require_once './Config/Database.php';
require_once './Model/ProductoModel.php';
require_once './Model/Categoria.php';

class HomeController
{
    public function index()
    {
        $db = (new Database())->getConnection();

        // MODELOS
        $productoModel  = new ProductoModel($db);
        $categoriaModel = new CategoriaModel($db);

        // DATOS
        $categorias = $categoriaModel->listar();
        $destacados = $productoModel->obtenerDestacados();

        // VISTAS
        require './Views/layout/header.php';
        require './Views/home/index.php';
        require './Views/layout/footer.php';
    }
}

