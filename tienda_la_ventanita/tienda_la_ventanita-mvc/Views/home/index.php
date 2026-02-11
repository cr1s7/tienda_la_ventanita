<?php if (!empty($_SESSION['mensaje_logout'])): ?>

    <div class="alert alert-warning text-center fw-bold shadow-sm">
        <i class="bi bi-emoji-smile"></i>
        <?= $_SESSION['mensaje_logout'] ?>
    </div>


    <?php unset($_SESSION['mensaje_logout']); ?>

<?php endif; ?>


<!-- HERO -->
<section class="bg-warning text-center py-5">
    <div class="container">
        <h1 class="fw-bold">Bienvenido a La Ventanita</h1>
        <p class="mb-0">Tu minimarket de confianza</p>
    </div>
</section>

<?php if (!empty($_GET['buscar'])): ?>

    <h5 class="mb-4">
        Resultados para:
        <span class="text-warning">
            "<?= htmlspecialchars($_GET['buscar']) ?>"
        </span>
    </h5>

<?php endif; ?>


<?php if (empty($_GET['buscar'])): ?>
<section class="container my-5">

    <h2 class="text-center mb-4 text-warning fw-bold">
        ⭐ Productos Destacados
    </h2>

    <?php if (!empty($destacados)): ?>

        <div class="carrusel-wrapper">

            <div class="carrusel-track">

                <!-- LOOP ORIGINAL -->
                <?php foreach ($destacados as $p): ?>
                    <div class="card destacado-card">

                        <img src="uploads/<?= $p['foto'] ?: 'default.png' ?>">

                        <div class="card-body text-center">

                            <h6 class="fw-bold">
                                <?= $p['nombre'] ?>
                            </h6>

                            <p class="text-warning fw-bold mb-1">
                                $<?= number_format($p['preUnitario']) ?>
                            </p>

                            <small class="text-muted d-block mb-2">
                                <?= $p['categoria'] ?>
                            </small>

                            <a href="index.php?action=productoDetalle&id=<?= $p['idProducto'] ?>"
                               class="btn btn-outline-dark btn-sm">

                               Ver detalles 
                            </a>

                        </div>

                    </div>
                <?php endforeach; ?>


                <!-- DUPLICADO (loop infinito) -->
                <?php foreach ($destacados as $p): ?>
                    <div class="card destacado-card">

                        <img src="uploads/<?= $p['foto'] ?: 'default.png' ?>">

                        <div class="card-body text-center">

                            <h6 class="fw-bold">
                                <?= $p['nombre'] ?>
                            </h6>

                            <p class="text-warning fw-bold mb-1">
                                $<?= number_format($p['preUnitario']) ?>
                            </p>

                            <small class="text-muted d-block mb-2">
                                <?= $p['categoria'] ?>
                            </small>

                            <a href="index.php?action=productoDetalle&id=<?= $p['idProducto'] ?>"
                               class="btn btn-outline-dark btn-sm">

                               Ver detalles
                            </a>

                        </div>

                    </div>
                <?php endforeach; ?>

            </div>

        </div>

    <?php else: ?>

        <div class="alert alert-warning text-center">
            No hay productos destacados
        </div>

    <?php endif; ?>

</section>
<?php endif; ?>



<script>

document.addEventListener("DOMContentLoaded", function () {

    const carousel = document.querySelector("#carouselDestacados .carousel-inner");

    // Clonar primeros slides y pegarlos al final
    const items = carousel.querySelectorAll(".carousel-item");

    items.forEach(item => {
        let clone = item.cloneNode(true);
        carousel.appendChild(clone);
    });

});

</script>






