<!-- HERO -->

<section class="bg-warning text-center py-5 mb-4">
    <div class="container">
        <h1 class="fw-bold">Catálogo de Productos</h1>
        <p class="mb-0">Encuentra todo lo que necesitas</p>
    </div>
</section>

<div class="container">

<div class="row">

<!-- 🧭 SIDEBAR CATÁLOGO -->
<div class="col-md-3 mb-4">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-warning fw-bold">
            📦 Catálogo
        </div>

        <ul class="list-group list-group-flush">

            <!-- TODAS -->
            <a href="index.php?action=tienda"
               class="list-group-item list-group-item-action">

                Todas las categorías
            </a>

            <?php foreach ($categorias as $c): ?>

                <a href="index.php?action=tienda&categoria=<?= $c['idCategoria'] ?>"
                   class="list-group-item list-group-item-action">

                   <?= $c['nombre'] ?>

                </a>

            <?php endforeach; ?>

        </ul>

    </div>

</div>

<!-- 🛒 PRODUCTOS -->
<div class="col-md-9">

    <?php if (!empty($_GET['buscar'])): ?>

        <h5 class="mb-4">
            Resultados para:
            <span class="text-warning">
                "<?= htmlspecialchars($_GET['buscar']) ?>"
            </span>
        </h5>

    <?php endif; ?>

    <div class="row g-4">

        <?php if (empty($productos)): ?>

            <div class="alert alert-warning text-center">
                No se encontraron productos 😕
            </div>

        <?php endif; ?>

        <?php foreach ($productos as $p): ?>

            <?php
            $foto = (!empty($p['foto']) && file_exists("uploads/".$p['foto']))
                    ? $p['foto']
                    : "default.png";
            ?>

            <div class="col-12 col-sm-6 col-lg-4">

                <div class="card h-100 shadow-sm border-0">

                    <img src="<?= BASE_URL ?>uploads/<?= $foto ?>"
                         class="card-img-top"
                         style="height:200px; object-fit:cover">

                    <div class="card-body text-center">

                        <h6 class="fw-bold">
                            <?= $p['nombre'] ?>
                        </h6>

                        <p class="text-warning fw-bold mb-1">
                            $<?= number_format($p['preUnitario']) ?>
                        </p>

                        <small class="text-muted">
                            <?= $p['categoria'] ?> | <?= $p['unidad'] ?>
                        </small>

                    </div>

                    <div class="card-footer bg-white border-0">

                        <form method="POST"
                            action="index.php?action=agregarCarrito">

                            <input type="hidden"
                                name="idProducto"
                                value="<?= $p['idProducto'] ?>">

                            <input type="hidden"
                                name="cantidad"
                                value="1">


                        <a href="index.php?action=productoDetalle&id=<?= $p['idProducto'] ?>"
                        class="btn btn-outline-dark w-100">

                        Ver detalles 
                       </a>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</div>

</div>
