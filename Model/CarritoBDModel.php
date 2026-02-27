<?php
class CarritoBDModel {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // ===============================
    // OBTENER O CREAR CARRITO ACTIVO
    // ===============================
    public function obtenerCarritoActivo($idUsuario){

        $sql = "SELECT * FROM carrito 
                WHERE idUsuario = ? 
                AND estado = 'activo' 
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);
        $carrito = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$carrito){

            $sqlInsert = "INSERT INTO carrito(idUsuario,estado,fecha)
                          VALUES(?, 'activo', NOW())";

            $stmtInsert = $this->conn->prepare($sqlInsert);
            $stmtInsert->execute([$idUsuario]);

            return [
                'idCarrito' => $this->conn->lastInsertId()
            ];
        }

        return $carrito;
    }

    // ===============================
    // AGREGAR PRODUCTO
    // ===============================
    public function agregarProducto($idUsuario,$idProducto,$cantidad){

        $carrito = $this->obtenerCarritoActivo($idUsuario);
        $idCarrito = $carrito['idCarrito'];

        // Producto
        $sql = "SELECT stock, preUnitario 
                FROM productos 
                WHERE idProducto=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idProducto]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$producto){
            return ["error"=>"Producto no existe"];
        }

        if($cantidad > $producto['stock']){
            return ["error"=>"Stock insuficiente"];
        }

        // Existe?
        $sqlExiste = "SELECT * 
                      FROM carrito_detalle
                      WHERE idCarrito=? 
                      AND idProducto=?";

        $stmtExiste = $this->conn->prepare($sqlExiste);
        $stmtExiste->execute([$idCarrito,$idProducto]);
        $detalle = $stmtExiste->fetch(PDO::FETCH_ASSOC);

        if($detalle){

            $nuevaCantidad =
            $detalle['cantidad'] + $cantidad;

            if($nuevaCantidad > $producto['stock']){
                return ["error"=>"Supera stock"];
            }

            $sqlUpdate = "UPDATE carrito_detalle
                          SET cantidad=?
                          WHERE idDetalle=?";

            $this->conn->prepare($sqlUpdate)
            ->execute([
                $nuevaCantidad,
                $detalle['idDetalle']
            ]);

        }else{

            $sqlInsert = "INSERT INTO carrito_detalle
                          (idCarrito,idProducto,cantidad,precio)
                          VALUES(?,?,?,?)";

            $this->conn->prepare($sqlInsert)
            ->execute([
                $idCarrito,
                $idProducto,
                $cantidad,
                $producto['preUnitario']
            ]);
        }

        return ["ok"=>true];
    }

    // ===============================
    // OBTENER DETALLE
    // ===============================
    public function obtenerDetalle($idUsuario){

        $sql = "SELECT 
                    cd.idProducto,
                    cd.cantidad,
                    cd.precio,
                    p.nombre,
                    p.foto AS imagen
                FROM carrito_detalle cd
                JOIN carrito c 
                    ON cd.idCarrito = c.idCarrito
                JOIN productos p
                    ON cd.idProducto = p.idProducto
                WHERE c.idUsuario=?
                AND c.estado='activo'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================
    // SUMAR
    // ===============================
    public function sumarCantidad($idUsuario,$idProducto){

        $carrito =
        $this->obtenerCarritoActivo($idUsuario);

        $idCarrito =
        $carrito['idCarrito'];

        // stock producto
        $sqlStock =
        "SELECT stock
        FROM productos
        WHERE idProducto=?";

        $stock =
        $this->conn
        ->prepare($sqlStock);

        $stock->execute([$idProducto]);

        $stock =
        $stock->fetchColumn();

        // cantidad actual
        $sqlCant =
        "SELECT cantidad,idDetalle
        FROM carrito_detalle
        WHERE idCarrito=?
        AND idProducto=?";

        $stmt =
        $this->conn->prepare($sqlCant);

        $stmt->execute([
            $idCarrito,
            $idProducto
        ]);

        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$item) return;

        if($item['cantidad'] >= $stock){
            return [
                "error"=>"Stock máximo alcanzado"
            ];
        }

        $this->conn->prepare(
        "UPDATE carrito_detalle
        SET cantidad=cantidad+1
        WHERE idDetalle=?"
        )->execute([
            $item['idDetalle']
        ]);

        return ["ok"=>true];
    }


    // ===============================
    // RESTAR
    // ===============================
    public function restarCantidad($idUsuario,$idProducto){

        $sql = "UPDATE carrito_detalle cd
                JOIN carrito c
                ON cd.idCarrito=c.idCarrito
                SET cd.cantidad = cd.cantidad - 1
                WHERE c.idUsuario=? 
                AND cd.idProducto=? 
                AND cd.cantidad > 1
                AND c.estado='activo'";

        $this->conn->prepare($sql)
        ->execute([$idUsuario,$idProducto]);
    }

    // ===============================
    // ELIMINAR POR PRODUCTO
    // ===============================
    public function eliminarPorProducto($idUsuario,$idProducto){

        $sql = "DELETE cd FROM carrito_detalle cd
                JOIN carrito c
                ON cd.idCarrito=c.idCarrito
                WHERE c.idUsuario=? 
                AND cd.idProducto=?";

        $this->conn->prepare($sql)
        ->execute([$idUsuario,$idProducto]);
    }

    // ===============================
    // TOTAL
    // ===============================
    public function obtenerTotal($idUsuario){

        $sql="SELECT 
                SUM(cd.cantidad*cd.precio) total
              FROM carrito_detalle cd
              JOIN carrito c
                ON cd.idCarrito=c.idCarrito
              WHERE c.idUsuario=?
              AND c.estado='activo'";

        $stmt=$this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);

        return $stmt->fetchColumn() ?? 0;
    }
    // ===============================
    // CONTAR ITEMS
    // ===============================
    public function contarItems($idUsuario){

        $sql = "SELECT SUM(cd.cantidad) total
                FROM carrito_detalle cd
                JOIN carrito c
                ON cd.idCarrito=c.idCarrito
                WHERE c.idUsuario=?
                AND c.estado='activo'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);

        return $stmt->fetchColumn() ?? 0;
    }


}


