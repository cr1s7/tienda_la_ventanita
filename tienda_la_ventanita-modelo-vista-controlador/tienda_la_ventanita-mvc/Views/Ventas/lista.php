<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Ventas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h3>Ventas</h3>
  <table class="table table-striped">
    <thead class="table-dark"><tr><th>ID</th><th>Fecha</th><th>Usuario</th><th>Total</th><th>Acciones</th></tr></thead>
    <tbody>
      <?php foreach($ventas as $v): ?>
        <tr>
          <td><?= $v['id'] ?></td>
          <td><?= $v['fecha'] ?></td>
          <td><?= htmlspecialchars($v['usuario']) ?></td>
          <td>$<?= number_format($v['total'],2) ?></td>
          <td><a href="index.php?action=detalleFactura&id=<?= $v['id'] ?>" class="btn btn-sm btn-primary">Ver</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
