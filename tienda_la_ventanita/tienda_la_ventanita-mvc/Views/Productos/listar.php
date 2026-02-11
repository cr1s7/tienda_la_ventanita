<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Productos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Views/css/styles.css">

</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Productos</h2>
        <a href="index.php?action=dashboard" 
            class="btn mt-3"
            style="background:#f3e27f; color:#333; font-weight:bold; border:1px solid #e5d469;">
             ⬅ Volver al panel admin
        </a>

        <a href="index.php?action=productoCrear" class="btn btn-custom">
            ➕ Nuevo Producto
        </a>
    </div>

    <div class="card card-custom p-3 shadow-sm">

    <?php if(!empty($_SESSION['message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['message']; ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <?php if(!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>


        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Foto</th>
                    <th>Categoría</th>
                    <th>Unidad</th>
                    <th>Marca</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?= $p['idProducto'] ?></td>
                    <td><?= $p['nombre'] ?></td>
                    <td>$<?= number_format($p['preUnitario']) ?></td>
                    <td><?= $p['stock'] ?></td>
                    <td>
                        <?php if ($p['foto']): ?>
                            <img src="uploads/<?= $p['foto'] ?>" width="50">
                        <?php else: ?>
                            <span class="text-muted">Sin foto</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($p['categoria'] ?? $p['idCategoria'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($p['unidad'] ?? $p['idUnidad_medida'] ?? $p['idUnidad'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($p['marca'] ?? $p['idMarca'] ?? '—') ?></td>

                    <td>
                        <a href="index.php?action=productoEditar&id=<?= $p['idProducto'] ?>" class="btn btn-warning">Editar</a>
                        <a href="index.php?action=productoEliminar&id=<?= $p['idProducto'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar producto?')">🗑 Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

</body>
</html>
