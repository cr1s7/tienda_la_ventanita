<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Nuevo Producto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h3>Nuevo Producto</h3>
  <form action="index.php?action=crearProducto" method="post">
    <div class="mb-3">
      <label>Nombre</label>
      <input class="form-control" name="nombre" required>
    </div>
    <div class="mb-3">
      <label>Descripción</label>
      <textarea class="form-control" name="descripcion"></textarea>
    </div>
    <div class="row">
      <div class="col">
        <label>Precio</label>
        <input type="number" step="0.01" class="form-control" name="precio" required>
      </div>
      <div class="col">
        <label>Stock</label>
        <input type="number" class="form-control" name="stock" value="0" required>
      </div>
    </div>
    <button class="btn btn-primary mt-3">Guardar</button>
  </form>
</div>
</body>
</html>
