<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Carrito</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h3>Carrito de Compras</h3>
  <?php if (empty($cart)): ?>
    <div class="alert alert-info">Tu carrito está vacío.</div>
    <a href="index.php?action=listadoProductos" class="btn btn-secondary">Seguir comprando</a>
  <?php else: ?>
    <table class="table">
      <thead class="table-dark"><tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th><th></th></tr></thead>
      <tbody>
        <?php $total = 0; foreach($cart as $id => $it): $subtotal = $it['precio'] * $it['cantidad']; $total += $subtotal; ?>
          <tr>
            <td><?= htmlspecialchars($it['nombre']) ?></td>
            <td><?= $it['cantidad'] ?></td>
            <td>$<?= number_format($it['precio'],2) ?></td>
            <td>$<?= number_format($subtotal,2) ?></td>
            <td><a href="index.php?action=quitarDelCarrito&id=<?= $id ?>" class="btn btn-sm btn-danger">Quitar</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center">
      <div>
        <a href="index.php?action=listadoProductos" class="btn btn-secondary">Seguir comprando</a>
      </div>
      <div>
        <strong>Total: $<?= number_format($total,2) ?></strong>
        <a href="index.php?action=checkout" class="btn btn-success ms-3">Pagar</a>
      </div>
    </div>
  <?php endif; ?>
</div>
</body>
</html>
