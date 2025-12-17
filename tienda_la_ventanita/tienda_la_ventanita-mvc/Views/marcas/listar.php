<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Marcas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body { background: #fffde7; }
    .card-custom {
        background: #fff9c4;
        border-radius: 12px;
        border: 1px solid #f0e68c;
    }
    .btn-custom {
        background: #ffeb3b;
        color: #333;
    }
    .btn-custom:hover {
        background: #fdd835;
    }
</style>
</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Marcas</h2>

        <a href="index.php?action=dashboard" class="btn btn-warning">
            ⬅ Volver al panel admin
        </a>

        <a href="index.php?action=marcaCrear" class="btn btn-custom">
            ➕ Nueva Marca
        </a>
    </div>

    <div class="card card-custom p-3 shadow-sm">

        <?php if(!empty($_SESSION['message'])): ?>
            <div class="alert alert-success"><?= $_SESSION['message']; ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <table class="table table-hover">
            <thead style="background:#fdd835;">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($marcas as $m): ?>
                <tr>
                    <td><?= $m['idMarca'] ?></td>
                    <td><?= $m['nombre'] ?></td>
                    <td>
                        <a href="index.php?action=marcaEditar&id=<?= $m['idMarca'] ?>" class="btn btn-primary btn-sm">✏ Editar</a>
                        <a href="index.php?action=marcaEliminar&id=<?= $m['idMarca'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar marca?')">🗑 Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

</body>
</html>
