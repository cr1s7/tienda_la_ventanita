<?php
require_once __DIR__ . "/../Models/DashboardModel.php";

class DashboardController {
    private $model;
    public function __construct() {
        $this->model = new DashboardModel();
    }

    public function index() {
        $conteos = $this->model->conteosGenerales();
        $ultimasVentas = $this->model->ultimasVentas();
        $topProductos = $this->model->productosMasVendidos();
        require_once __DIR__ . "/../Views/Dashboard.php";
    }
}
