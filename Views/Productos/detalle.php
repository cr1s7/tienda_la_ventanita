<?php require_once "Views/layout/header.php"; ?>

<?php if (isset($_SESSION['mensaje_carrito'])): ?>

<div class="toast-carrito">
    <?= $_SESSION['mensaje_carrito'] ?>
</div>

<?php unset($_SESSION['mensaje_carrito']); ?>
<?php endif; ?>

<?php if (!$producto): ?>

<div class="alert alert-danger text-center mt-5">
    Producto no encontrado
</div>

<?php require_once "Views/layout/footer.php"; ?>
<?php return; ?>

<?php endif; ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>Views/css/detalle-producto.css">

</head>
<body>
    
</body>
</html>


<div class="container my-5">

<div class="row g-5">

    <!-- 🖼️ IMAGEN -->
    <div class="col-md-5">

        <div class="detalle-img-box">

            <img src="<?= BASE_URL ?>uploads/<?= $producto['foto'] ?: 'default.png' ?>"
                 class="img-fluid">

        </div>

    </div>


    <!-- 📄 INFORMACIÓN -->
    <div class="col-md-4">

        <h4 class="producto-titulo">
            <?= $producto['nombre'] ?>
        </h4>

        <p class="sku">
            SKU: <?= $producto['idProducto'] ?>
        </p>

        
        <p class="descripcion-producto mt-2">
            <?= nl2br($producto['descripcion'] ?? 'Producto sin descripción disponible.') ?>
        </p>

        <h3 class="precio">
            $ <?= number_format($producto['preUnitario']) ?>
        </h3>

        <p class="stock">
            Últimas <?= $producto['stock'] ?> unidades
        </p>

        <hr>

        <a href="#" class="ver-detalles">
            Ver detalles del producto
        </a>

    </div>


    <!-- 🛒 CAJA COMPRA -->
    <div class="col-md-3">

        <div class="box-compra">

            <h6>Condiciones de entrega:</h6>

            <p>🚚 Enviado por: <b>La Ventanita</b></p>
            <p>📦 Disponible para: <b>Compra y recoge</b></p>

            <hr>

            <h6>Información adicional</h6>

            <p>⭐ Gana puntos Ventanita</p>

            <?php if($producto['stock'] > 0): ?>

                <button class="btn-agregar w-100"
                    onclick="agregarCarritoAJAX(<?= $producto['idProducto'] ?>)">
                    Agregar 🛒
                </button>

                <?php else: ?>

                <button class="btn-agregar w-100 btn-secondary" disabled>
                    Producto agotado
                </button>

            <?php endif; ?>

        </div>

    </div>

</div>
</div>

<div class="container my-5">

<h4 class="mb-4 fw-bold">
    Productos similares
</h4>

<div class="row">

<?php foreach($relacionados as $p): ?>

<div class="col-md-3 mb-4">

    <div class="card card-relacionado h-100">

        <img src="<?= BASE_URL ?>uploads/<?= $p['foto'] ?: 'default.png' ?>"
             class="card-img-top">

        <div class="card-body text-center">

            <h6><?= $p['nombre'] ?></h6>

            <p class="precio-rel">
                $ <?= number_format($p['preUnitario']) ?>
            </p>

            <a href="index.php?action=productoDetalle&id=<?= $p['idProducto'] ?>"
               class="btn btn-sm btn-warning">
               Ver producto
            </a>

        </div>

    </div>

</div>

<?php endforeach; ?>

</div>
</div>


<?php require_once "Views/layout/footer.php"; ?>
