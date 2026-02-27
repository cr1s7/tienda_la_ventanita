<?php if (isset($_GET['logout'])): ?>
    
    <div id="mensajeLogout" class="alert alert-warning text-center fw-bold shadow-sm">
        <i class="bi bi-emoji-smile"></i>
        Sesión cerrada correctamente, vuelve pronto 👋
    </div>

    <script>
        setTimeout(() => {
            const msg = document.getElementById("mensajeLogout");
            if (msg) {
                msg.style.transition = "opacity 0.5s";
                msg.style.opacity = "0";
                setTimeout(() => msg.remove(), 500);
            }
        }, 3000); // 3 segundos
    </script>

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
         Productos Destacados
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

<!-- SOBRE NOSOTROS -->
<section class="container my-5">
    
    <div class="row align-items-center shadow-sm p-4 rounded bg-light">

        <!-- 📸 Imagen izquierda -->
        <div class="col-md-5 mb-3 mb-md-0 text-center">
            <img src="uploads/nosotros.jpg" 
                 alt="Sobre Nosotros" 
                 class="img-fluid rounded shadow-sm"
                 style="max-height: 350px; object-fit: cover;">
        </div>

        <!-- 📝 Texto derecha -->
        <div class="col-md-7">
            <h2 class="text-warning fw-bold mb-3">
                Sobre Nosotros
            </h2>

            <p class="text-muted">
                En <strong>La Ventanita</strong> trabajamos cada día para ofrecerte 
                productos de calidad al mejor precio. Somos un minimarket pensado 
                para brindar comodidad, rapidez y confianza a nuestros clientes.
            </p>

            <p class="text-muted">
                Nuestro compromiso es atenderte con amabilidad y mantener siempre 
                surtido nuestro inventario para que encuentres todo lo que necesitas 
                en un solo lugar.
            </p>

        </div>

    </div>

</section>

<?php if(isset($_GET['factura']) && $_GET['factura'] == 'ok'): ?>

<!-- MODAL FACTURA EXITOSA -->
<div class="modal fade" id="modalFactura" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">

      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">
            ✅ Compra Exitosa
        </h5>
      </div>

      <div class="modal-body text-center">

        <h4 class="fw-bold mb-3">
            Factura #<?= $_GET['id'] ?>
        </h4>

        <p class="text-muted">
            Tu compra fue registrada correctamente.
        </p>

        <div class="d-grid gap-2 mt-4">

            <a href="index.php?action=descargarFactura&id=<?= $_GET['id'] ?>"
            class="btn btn-outline-dark">
            📄 Descargar Factura PDF
            </a>

            <a href="index.php?action=home"
               class="btn btn-success">
               Volver al Inicio
            </a>

        </div>

      </div>

    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var modal = new bootstrap.Modal(document.getElementById('modalFactura'));
    modal.show();
});
</script>

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






