<?php foreach ($productos as $p): ?>
    <div>
        <h5><?= $p['nombre'] ?></h5>
        <p>Precio: $<?= number_format($p['preUnitario']) ?></p>
        <p>Stock: <?= $p['stock'] ?></p>
    </div>
<?php endforeach; ?>
