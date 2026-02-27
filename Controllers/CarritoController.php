<?php

require_once __DIR__ . '/../Model/CarritoBDModel.php';
require_once __DIR__ . '/../Model/ProductoModel.php';


class CarritoController
{
    private $productoModel;

    public function __construct($db)
    {
        $this->productoModel = new ProductoModel($db);
        $this->conn = $db;
    }

    public function agregarAjax(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        header('Content-Type: application/json');

        if(!isset($_SESSION['user'])){
            echo json_encode([
                "error"=>"Debes iniciar sesión"
            ]);
            return;
        }

        $idUsuario =
        $_SESSION['user']['idUsuario'];

        $idProducto =
        $_POST['idProducto'];

        $cantidad =
        $_POST['cantidad'] ?? 1;

        $carrito =
        new CarritoBDModel($this->conn);

        $resp =
        $carrito->agregarProducto(
            $idUsuario,
            $idProducto,
            $cantidad
        );

        if(isset($resp['error'])){
            echo json_encode($resp);
            return;
        }

        // contador
        $totalItems =
        $carrito->contarItems($idUsuario);

        echo json_encode([
            "ok"=>true,
            "mensaje"=>"Producto agregado 🛒",
            "cantidad"=>$totalItems
        ]);
    }



        // =============================
    // OBTENER CARRITO AJAX
    // =============================
    public function obtenerCarritoAjax(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        header('Content-Type: application/json'); // 🔥 AGREGA ESTO

        if(!isset($_SESSION['user'])){
            echo json_encode([
                "items"=>[],
                "total"=>0
            ]);
            return;
        }

        $idUsuario = $_SESSION['user']['idUsuario'];

        $carrito = new CarritoBDModel($this->conn);

        $items = $carrito->obtenerDetalle($idUsuario);
        $total = $carrito->obtenerTotal($idUsuario);

        echo json_encode([
            "items"=>$items,
            "total"=>$total
        ]);
    }




    // =============================
    // SUMAR
    // =============================
    public function sumarAjax(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        header('Content-Type: application/json');

        $idUsuario =
        $_SESSION['user']['idUsuario'];

        $idProducto =
        $_POST['idProducto'];

        $carrito =
        new CarritoBDModel($this->conn);

        $resp =
        $carrito->sumarCantidad(
            $idUsuario,
            $idProducto
        );

        echo json_encode(
            $resp ?? ["ok"=>true]
        );
    }




    // =============================
    // RESTAR
    // =============================
    public function restarAjax(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $idUsuario = $_SESSION['user']['idUsuario'];
        $idProducto = $_POST['idProducto'];

        $carrito = new CarritoBDModel($this->conn);
        $carrito->restarCantidad($idUsuario,$idProducto);

        echo json_encode(["ok"=>true]);
    }



    // =============================
    // ELIMINAR
    // =============================
    public function eliminarAjax(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $idUsuario = $_SESSION['user']['idUsuario'];
        $idProducto = $_POST['idProducto'];

        $carrito = new CarritoBDModel($this->conn);
        $carrito->eliminarPorProducto($idUsuario,$idProducto);

        echo json_encode(["ok"=>true]);
    }

    // =============================
    // CONTAR ITEMS AJAX
    // =============================
    public function contarAjax(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        header('Content-Type: application/json');

        if(!isset($_SESSION['user'])){
            echo json_encode(["cantidad"=>0]);
            return;
        }

        $idUsuario = $_SESSION['user']['idUsuario'];

        $carrito = new CarritoBDModel($this->conn);
        $total = $carrito->contarItems($idUsuario);

        echo json_encode([
            "cantidad"=>$total
        ]);
    }

    public function ver(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['user'])){
            header("Location: index.php?controller=auth&action=login");
            exit();
        }

        $idUsuario = $_SESSION['user']['idUsuario'];

        $carrito = new CarritoBDModel($this->conn);

        // 🔥 TRAEMOS LOS PRODUCTOS
        $productos = $carrito->obtenerDetalle($idUsuario);

        // 🔥 TRAEMOS EL TOTAL
        $total = $carrito->obtenerTotal($idUsuario);

        // =============================
        // 🔥 SI ES AJAX DEVOLVEMOS JSON
        // =============================
        if(isset($_GET['ajax']) && $_GET['ajax'] == 1){
            header('Content-Type: application/json');
            echo json_encode([
                "items"=>$productos,
                "total"=>$total
            ]);
            return;
        }

        require_once './Views/home/carrito.php';
    }


}
