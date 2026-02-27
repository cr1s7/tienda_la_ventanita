<?php

require_once __DIR__ . '/../Model/VentaModel.php';
require_once __DIR__ . '/../Model/CarritoBDModel.php';
require_once __DIR__ . '/../Model/ProductoModel.php';

class CheckoutController
{
    private $conn;
    private $productoModel;
    private $ventaModel;
    private $carritoModel;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->productoModel = new ProductoModel($db);
        $this->ventaModel = new VentaModel($db);
        $this->carritoModel = new CarritoBDModel($db);
    }

    // ===============================
    // MOSTRAR VISTA CHECKOUT
    // ===============================
    public function index()
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['user'])){
            header("Location: index.php?action=login");
            exit;
        }

        $idUsuario = $_SESSION['user']['idUsuario'];

        $productos = $this->carritoModel->obtenerDetalle($idUsuario);
        $total = $this->carritoModel->obtenerTotal($idUsuario);

        require_once './Views/home/checkout.php';
    }

    // ===============================
    // PROCESAR COMPRA
    // ===============================
    public function procesar()
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['user'])){
            header("Location: index.php?action=login");
            exit;
        }

        $idUsuario = $_SESSION['user']['idUsuario'];

        try{

            $this->conn->beginTransaction();

            // 1️⃣ Crear factura
            $idFactura = $this->ventaModel->crearVenta($idUsuario);

            // 2️⃣ Traer carrito
            $items = $this->carritoModel->obtenerDetalle($idUsuario);

            if(empty($items)){
                throw new Exception("El carrito está vacío");
            }

            $total = 0;

            foreach($items as $item){

                $producto = $this->productoModel
                                ->obtenerPorId($item['idProducto']);

                if($item['cantidad'] > $producto['stock']){
                    throw new Exception(
                        "Stock insuficiente de ".$producto['nombre']
                    );
                }

                // insertar detalle
                $this->ventaModel
                     ->insertarDetalle($idFactura, $item);

                // descontar stock
                $this->conn->prepare(
                    "UPDATE productos
                     SET stock = stock - ?
                     WHERE idProducto = ?"
                )->execute([
                    $item['cantidad'],
                    $item['idProducto']
                ]);

                $total += $item['cantidad'] * $item['precio'];
            }

            // actualizar total factura
            $this->ventaModel
                 ->actualizarTotal($idFactura, $total);

            // limpiar carrito
            $this->conn->prepare(
                "DELETE d FROM carrito_detalle d
                 JOIN carrito c
                 ON c.idCarrito = d.idCarrito
                 WHERE c.idUsuario = ?"
            )->execute([$idUsuario]);

            $this->conn->commit();

            header("Location: index.php?action=home&factura=ok&id=".$idFactura);
            exit;

        }catch(Exception $e){

            $this->conn->rollBack();
            echo "Error: ".$e->getMessage();
        }
    }

    // ===============================
    // GENERAR FACTURA PDF
    // ===============================
    public function generarPDF($idFactura)
    {
        require_once __DIR__ . '/../vendor/autoload.php';

        $venta = $this->ventaModel->obtenerVentaPorId($idFactura);
        $detalles = $this->ventaModel->obtenerDetalleVenta($idFactura);

        if(!$venta){
            die("Factura no encontrada");
        }

        $mpdf = new \Mpdf\Mpdf();

        $html = "
        <h1 style='text-align:center;'>Factura #{$venta['idFactura']}</h1>
        <p><strong>Fecha:</strong> {$venta['fechaEmision']}</p>
        <p><strong>Total:</strong> $" . number_format($venta['total'],0,',','.') . "</p>
        <hr>
        <table width='100%' border='1' cellpadding='8' cellspacing='0'>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>";

        foreach($detalles as $item){

        $html .= "
            <tr>
                <td>{$item['nombre']}</td>
                <td>{$item['cantiSalida']}</td>
                <td>$" . number_format($item['valorUnitario'],0,',','.') . "</td>
                <td>$" . number_format($item['totalVenta'],0,',','.') . "</td>
            </tr>
        ";
}

        $html .= "
            </tbody>
        </table>
        <br>
        <h3 style='text-align:right;'>Total: $" . number_format($venta['total'],0,',','.') . "</h3>
        ";

        $mpdf->WriteHTML($html);
        $mpdf->Output("Factura_{$idFactura}.pdf", "I");
    }
}