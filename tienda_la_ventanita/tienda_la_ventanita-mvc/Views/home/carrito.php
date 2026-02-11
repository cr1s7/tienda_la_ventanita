<?php
$carrito = $_SESSION['carrito'] ?? [];

$total = 0;
foreach ($carrito as $p) {
    $total += $p['precio'] * $p['cantidad'];
}
?>

<div class="offcanvas offcanvas-end"
     tabindex="-1"
     id="carritoCanvas"
     style="width:400px; background:#fffde7;">

    <!-- HEADER -->
    <div class="offcanvas-header bg-warning">

        <h5 class="offcanvas-title fw-bold">
            🛒 Mi Carrito
        </h5>

        <button type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas">
        </button>

    </div>

    <!-- BODY -->
    <div class="offcanvas-body">

        <?php if (empty($carrito)): ?>

            <p class="text-center text-muted">
                Tu carrito está vacío
            </p>

        <?php else: ?>

        <table class="table table-sm">

            <thead class="table-warning">
                <tr>
                    <th>Producto</th>
                    <th>Cant</th>
                    <th>$</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

            <?php foreach ($carrito as $p): ?>

            <tr>
                <td><?= $p['nombre'] ?></td>

                <td><?= $p['cantidad'] ?></td>

                <td>
                    $<?= number_format($p['precio'] * $p['cantidad']) ?>
                </td>

                <td>
                    <a href="index.php?action=eliminarCarrito&id=<?= $p['id'] ?>"
                       class="btn btn-danger btn-sm">
                       ✖
                    </a>
                </td>
            </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

        <hr>

        <h5 class="text-end">
            Total:
            <span class="text-warning">
                $<?= number_format($total) ?>
            </span>
        </h5>

        <button class="btn btn-warning w-100 mt-3">
            Finalizar compra
        </button>

        <?php endif; ?>

    </div>
</div>

