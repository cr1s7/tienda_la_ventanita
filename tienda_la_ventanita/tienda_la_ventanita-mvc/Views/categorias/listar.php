<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Categorías</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="Views/css/styles.css">
</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Categorías</h2>

        <div>
            <a href="index.php?action=dashboard" 
               class="btn"
               style="background:#f3e27f; color:#333; font-weight:bold; border:1px solid #e5d469;">
               ⬅ Volver al panel admin
            </a>

            <a href="index.php?action=categoriaCrear" class="btn btn-custom">
                ➕ Nueva categoría
            </a>
        </div>
    </div>

    <div class="card card-custom p-3 shadow-sm">

        <?php if(!empty($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if(!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th width="180">Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($categorias as $cat): ?>
                <tr>
                    <td><?= $cat['idCategoria']; ?></td>
                    <td><?= $cat['nombre']; ?></td>
                    <td>
                        <a href="index.php?action=categoriaEditar&id=<?= $cat['idCategoria']; ?>" 
                           class="btn btn-sm btn-warning">
                           <i class="bi bi-pencil-square"></i> Editar
                        </a>

                        <a href="index.php?action=categoriaEliminar&id=<?= $cat['idCategoria']; ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('¿Eliminar esta categoría?')">
                           <i class="bi bi-trash"></i> Eliminar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

</body>
</html>
