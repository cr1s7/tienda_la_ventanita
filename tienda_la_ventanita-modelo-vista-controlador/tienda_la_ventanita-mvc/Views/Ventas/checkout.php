<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Checkout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h3>Confirmar Compra</h3>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <?php if (empty($cart)): ?>
    <div class="alert alert-info">El carrito está vacío.</div>
  <?php else: ?>
    <table class="table">
      <thead class="table-dark"><tr><th>Producto</th><th>Cantidad</th><th>Subtotal</th></tr></thead>
      <tbody>
        <?php $total = 0; foreach($cart as $it): $subtotal = $it['precio']*$it['cantidad']; $total += $subtotal; ?>
          <tr>
            <td><?= htmlspecialchars($it['nombre']) ?></td>
            <td><?= $it['cantidad'] ?></td>
            <td>$<?= number_format($subtotal,2) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <p><strong>Total a pagar: $<?= number_format($total,2) ?></strong></p>

    <form action="index.php?action=checkout" method="post">
      <button class="btn btn-success">Confirmar y pagar</button>
      <a href="index.php?action=verCarrito" class="btn btn-secondary">Volver</a>
    </form>
  <?php endif; ?>
</div>
</body>
</html>
