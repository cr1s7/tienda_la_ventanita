<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar Producto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h3>Editar Producto</h3>
  <form action="index.php?action=editarProducto&id=<?= $producto['id'] ?>" method="post">
    <div class="mb-3">
      <label>Nombre</label>
      <input class="form-control" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Descripción</label>
      <textarea class="form-control" name="descripcion"><?= htmlspecialchars($producto['descripcion']) ?></textarea>
    </div>
    <div class="row">
      <div class="col">
        <label>Precio</label>
        <input type="number" step="0.01" class="form-control" name="precio" value="<?= $producto['precio'] ?>" required>
      </div>
      <div class="col">
        <label>Stock</label>
        <input type="number" class="form-control" name="stock" value="<?= $producto['stock'] ?>" required>
      </div>
    </div>
    <button class="btn btn-primary mt-3">Actualizar</button>
  </form>
</div>
</body>
</html>
