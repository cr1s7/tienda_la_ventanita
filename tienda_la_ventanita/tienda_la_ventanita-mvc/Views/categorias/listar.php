<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Productos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background: #fffde7; /* Amarillo claro */
    }
    .card-custom {
        background: #fff9c4; /* Más amarillo suave */
        border-radius: 12px;
        border: 1px solid #f0e68c;
    }
    .table thead {
        background: #fdd835; /* Amarillo más fuerte */
        color: #333;
    }
    .btn-custom {
        background: #ffeb3b;
        color: #333;
        border: none;
    }
    .btn-custom:hover {
        background: #fdd835;
    }
</style>
</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Categorias</h2>
        <a href="index.php?action=dashboard" 
            class="btn mt-3"
            style="background:#f3e27f; color:#333; font-weight:bold; border:1px solid #e5d469;">
             ⬅ Volver al panel admin
        </a>

        <a href="index.php?action=categoriaCrear" class="btn btn-custom">
            ➕ Nuevo categoria
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


        <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categorias as $cat): ?>
            <tr>
                <td><?= $cat['idCategoria']; ?></td>
                <td><?= $cat['nombre']; ?></td>
                <td>
                    <a href="index.php?action=categoriaEditar&id=<?= $cat['idCategoria']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square">Editar</i></a>
                    <a href="index.php?action=categoriaEliminar&id=<?= $cat['idCategoria']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta categoría?')"><i class="bi bi-trash">Eliminar</i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    </div>
</div>

</body>
</html>
