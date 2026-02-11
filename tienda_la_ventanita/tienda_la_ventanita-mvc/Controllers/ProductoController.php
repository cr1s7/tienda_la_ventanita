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
        $_POST['destacado'] = isset($_POST['destacado']) ? 1 : 0;


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

    public function editarForm($id)
    {
        $producto   = $this->model->obtenerPorId($id);
        $categorias = $this->model->getCategorias();
        $unidades   = $this->model->getUnidades();
        $marcas     = $this->model->getMarcas();

        include './Views/Productos/editar.php';
    }



   // PRODUCTOS FRONTEND (TIENDA)
   
    public function listarProductosFrontend()
    {
        $db = (new Database())->getConnection();
        $productoModel  = new ProductoModel($db);
        $categoriaModel = new CategoriaModel($db);

        $categorias = $categoriaModel->listar();

        // 🏆 TRAER DESTACADOS
        $destacados = $productoModel->obtenerDestacados();

        // 📂 FILTRO
        if (isset($_GET['categoria'])) {
            $productos = $productoModel->listarPorCategoria($_GET['categoria']);
        } else {
            $productos = $productoModel->listar();
        }

        require __DIR__ . '/../Views/layout/header.php';
        require __DIR__ . '/../Views/home/catalogo.php';
        require __DIR__ . '/../Views/layout/footer.php';
    }


    public function tienda()
    {
        require_once './Config/Database.php';
        require_once './Model/ProductoModel.php';
        require_once './Model/Categoria.php';

        $db = (new Database())->getConnection();

        $productoModel  = new ProductoModel($db);
        $categoriaModel = new CategoriaModel($db);

        // 📂 CATEGORÍAS PARA CATÁLOGO
        $categorias = $categoriaModel->listar();

        // 🔎 BUSCADOR
        if (!empty($_GET['buscar'])) {

            $productos = $productoModel->buscar($_GET['buscar']);

        }
        // 📂 FILTRO
        elseif (!empty($_GET['categoria'])) {

            $productos = $productoModel->listarPorCategoria($_GET['categoria']);

        }
        // 🏪 NORMAL
        else {

            $productos = $productoModel->listar();

        }

        require './Views/layout/header.php';
        require './Views/home/catalogo.php';
        require './Views/layout/footer.php';
    }


    public function listarPorCategoria($idCategoria)
    {
        $sql = "
            SELECT 
                p.*,
                c.nombre AS categoria,
                u.nombre AS unidad,
                m.nombre AS marca
            FROM productos p
            LEFT JOIN categorias c 
                ON p.idCategoria = c.idCategoria
            LEFT JOIN unidad_medida u 
                ON p.idUnidad_medida = u.idUnidad
            LEFT JOIN marcas m 
                ON p.idMarca = m.idMarca
            WHERE p.idCategoria = :idCategoria
            ORDER BY p.idProducto DESC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idCategoria", $idCategoria);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function destacados()
{
    return $this->model->obtenerDestacados();
}

public function detalle($id)
{
    require_once './Config/Database.php';
    require_once './Model/ProductoModel.php';

    $database = new Database();
    $db = $database->getConnection();

    $productoModel = new ProductoModel($db);

    $producto = $productoModel->obtenerPorId($id);

    require_once './Views/productos/detalle.php';
}









}


