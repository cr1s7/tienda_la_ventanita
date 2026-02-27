<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5">

    <h3 class="mb-4">👤 Mi Cuenta</h3>

    <!-- DATOS USUARIO -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5>Información personal</h5>
            <p><strong>Nombre:</strong> <?= $_SESSION['user']['nombre'] ?></p>
            <p><strong>Email:</strong> <?= $_SESSION['user']['email'] ?></p>
        </div>
    </div>

    <!-- HISTORIAL -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5>🧾 Mis Compras</h5>

            <?php if(empty($compras)): ?>
                <p>No tienes compras registradas.</p>
            <?php else: ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Factura</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($compras as $compra): ?>
                        <tr>
                            <td>#<?= $compra['idFactura'] ?></td>
                            <td><?= $compra['fechaEmision'] ?></td>
                            <td>$<?= number_format($compra['total'],0,',','.') ?></td>
                            <td>
                                <a href="index.php?action=descargarFactura&id=<?= $compra['idFactura'] ?>"
                                   class="btn btn-sm btn-outline-dark">
                                   Descargar
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php endif; ?>
        </div>
    </div>

    <!-- CAMBIAR PASSWORD -->
        <a href="index.php?action=forgotPasswordForm&origen=cuenta" class="btn btn-warning">
            Cambiar contraseña
        </a>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>