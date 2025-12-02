<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Productos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Productos</h3>
    <div>
      <a href="index.php?action=crearProducto" class="btn btn-primary">Nuevo producto</a>
      <a href="index.php?action=verCarrito" class="btn btn-outline-secondary">Ver carrito</a>
    </div>
  </div>

  <table class="table table-striped">
    <thead class="table-dark">
      <tr>
        <th>Nombre</th><th>Precio</th><th>Stock</th><th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($productos as $p): ?>
        <tr>
          <td><?= htmlspecialchars($p['nombre']) ?></td>
          <td>$<?= number_format($p['precio'],2) ?></td>
          <td><?= $p['stock'] ?></td>
          <td>
            <a href="index.php?action=editarProducto&id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
            <a href="index.php?action=eliminarProducto&id=<?= $p['id'] ?>" onclick="return confirm('Eliminar?')" class="btn btn-sm btn-danger">Eliminar</a>

            <!-- formulario para agregar al carrito -->
            <form action="index.php?action=agregarAlCarrito&id=<?= $p['id'] ?>" method="post" class="d-inline-block ms-2">
              <input type="number" name="cantidad" value="1" min="1" max="<?= $p['stock'] ?>" style="width:70px;">
              <button class="btn btn-sm btn-success">Agregar</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
