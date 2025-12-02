<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Reportes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Reportes</h3>
    <a href="index.php?action=crearReporte" class="btn btn-primary">Nuevo reporte</a>
  </div>

  <table class="table table-striped">
    <thead class="table-dark"><tr><th>ID</th><th>Título</th><th>Usuario</th><th>Creado</th></tr></thead>
    <tbody>
      <?php foreach($reportes as $r): ?>
        <tr>
          <td><?= $r['id'] ?></td>
          <td><?= htmlspecialchars($r['titulo']) ?></td>
          <td><?= htmlspecialchars($r['usuario']) ?></td>
          <td><?= $r['creado_en'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
