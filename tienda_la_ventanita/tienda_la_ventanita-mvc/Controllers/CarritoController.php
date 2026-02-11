<?php

require_once __DIR__ . '/../Model/CarritoModel.php';
require_once __DIR__ . '/../Model/ProductoModel.php';


class CarritoController
{
    private $productoModel;

    public function __construct($db)
    {
        $this->productoModel = new ProductoModel($db);
    }

    // Agregar
    public function agregar()
    {
        $id = $_GET['id'];

        $producto = $this->productoModel->buscar($id);

        CarritoModel::agregar($producto);

        header("Location: index.php?action=tienda");
    }

    // Ver carrito
    public function index()
    {
        $carrito = CarritoModel::obtener();
        $total = CarritoModel::total();

        include './Views/home/carrito.php';
    }

    // Eliminar
    public function eliminar()
    {
        $id = $_GET['id'];

        CarritoModel::eliminar($id);

        header("Location: index.php?action=carrito");
    }
}
