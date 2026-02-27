<?php
require_once __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid py-4" style="background:#f5f5f5; min-height:100vh;">
    <div class="container">
        <div class="row">

            <!-- IZQUIERDA -->
            <div class="col-lg-8">
                <div id="contenedorCarrito">
                    <?php if (!empty($productos)) : ?>
                        <?php foreach ($productos as $producto): ?>
                            <?php $subtotal = $producto['cantidad'] * $producto['precio']; ?>
                            <?php
                            $foto = (!empty($producto['imagen']) && file_exists("uploads/".$producto['imagen']))
                                    ? $producto['imagen']
                                    : "default.png";
                            ?>

                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">

                                        <img src="<?= BASE_URL ?>uploads/<?= $foto ?>"
                                             class="me-3 rounded"
                                             width="120">

                                        <div class="flex-grow-1">
                                            <h6><?= $producto['nombre']; ?></h6>

                                            <div class="d-flex align-items-center">

                                                <button class="btn btn-sm btn-outline-secondary"
                                                        onclick="restar(<?= $producto['idProducto']; ?>)">
                                                    −
                                                </button>

                                                <span class="mx-3">
                                                    <?= $producto['cantidad']; ?>
                                                </span>

                                                <button class="btn btn-sm btn-outline-secondary"
                                                        onclick="sumar(<?= $producto['idProducto']; ?>)">
                                                    +
                                                </button>

                                                <button class="btn btn-sm btn-outline-danger ms-3"
                                                        onclick="eliminar(<?= $producto['idProducto']; ?>)">
                                                    Eliminar
                                                </button>

                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <h5 class="fw-bold">
                                                $ <?= number_format($subtotal,0,',','.'); ?>
                                            </h5>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else : ?>

                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="text-muted">
                                    🛒 Tu carrito está vacío
                                </h5>
                            </div>
                        </div>

                    <?php endif; ?>
                </div>
            </div>

            <!-- DERECHA -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">

                        <h6 class="fw-bold mb-3">Resumen de compra</h6>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Total</span>
                            <span id="totalCarrito">
                                $ <?= number_format($total ?? 0, 0, ',', '.'); ?>
                            </span>
                        </div>

                        <?php if (!empty($productos)) : ?>
                            <a href="index.php?action=checkout"
                            class="btn btn-primary w-100 mt-3 py-2">
                            Continuar compra
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>