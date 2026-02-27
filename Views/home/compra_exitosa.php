<div class="container py-5 text-center">
    <h2>✅ Compra realizada con éxito</h2>
    <p>Tu número de factura es:</p>
    <h4>#<?= $_GET['id'] ?? '' ?></h4>

    <a href="index.php?action=home"
       class="btn btn-primary mt-3">
       Volver al inicio
    </a>
</div>