<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h3>Dashboard</h3>

  <div class="row">
    <div class="col-md-3">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body">
          <h5 class="card-title">Usuarios</h5>
          <p class="card-text"><?= $conteos['totalUsuarios'] ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-success mb-3">
        <div class="card-body">
          <h5 class="card-title">Productos</h5>
          <p class="card-text"><?= $conteos['totalProductos'] ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-warning mb-3">
        <div class="card-body">
          <h5 class="card-title">Ventas</h5>
          <p class="card-text"><?= $conteos['totalVentas'] ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-white bg-danger mb-3">
        <div class="card-body">
          <h5 class="card-title">Ingresos</h5>
          <p class="card-text">$<?= number_format($conteos['ingresosTotales'],2) ?></p>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-md-6">
      <h5>Últimas ventas</h5>
      <table class="table">
        <thead class="table-dark"><tr><th>ID</th><th>Fecha</th><th>Usuario</th><th>Total</th></tr></thead>
        <tbody>
          <?php foreach($ultimasVentas as $v): ?>
            <tr>
              <td><?= $v['id'] ?></td>
              <td><?= $v['fecha'] ?></td>
              <td><?= htmlspecialchars($v['usuario']) ?></td>
              <td>$<?= number_format($v['total'],2) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="col-md-6">
      <h5>Productos más vendidos</h5>
      <table class="table">
        <thead class="table-dark"><tr><th>Producto</th><th>Vendidos</th></tr></thead>
        <tbody>
          <?php foreach($topProductos as $p): ?>
            <tr>
              <td><?= htmlspecialchars($p['nombre']) ?></td>
              <td><?= $p['vendidos'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>

