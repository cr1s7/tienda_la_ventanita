<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Detalle Venta #<?= $venta['id'] ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h3>Detalle Venta #<?= $venta['id'] ?></h3>
  <p><strong>Usuario:</strong> <?= htmlspecialchars($venta['usuario']) ?></p>
  <p><strong>Fecha:</strong> <?= $venta['fecha'] ?></p>
  <p><strong>Total:</strong> $<?= number_format($venta['total'],2) ?></p>

  <table class="table">
    <thead class="table-dark"><tr><th>Producto</th><th>Cantidad</th><th>Subtotal</th></tr></thead>
    <tbody>
      <?php foreach($detalle as $d): ?>
        <tr>
          <td><?= htmlspecialchars($d['producto']) ?></td>
          <td><?= $d['cantidad'] ?></td>
          <td>$<?= number_format($d['subtotal'],2) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
