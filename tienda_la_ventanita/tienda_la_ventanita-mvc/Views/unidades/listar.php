<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Unidades de Medida</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Views/css/styles.css">
</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Unidades de Medida</h2>

        <a href="index.php?action=dashboard" class="btn btn-warning">
            ⬅ Volver al panel admin
        </a>

        <!-- ACTION CORREGIDA -->
        <a href="index.php?action=crearUnidad" class="btn btn-custom">
            ➕ Nueva Unidad
        </a>
    </div>

    <div class="card card-custom p-3 shadow-sm">

        <?php if(!empty($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <table class="table table-hover">

            <thead style="background:#fdd835;">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th width="180">Acciones</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach($unidades as $u): ?>
                <tr>

                    <!-- CAMPO CORREGIDO -->
                    <td><?= $u['idUnidad'] ?></td>

                    <td><?= $u['nombre'] ?></td>

                    <td>
                        <a href="index.php?action=editarUnidad&id=<?= $u['idUnidad'] ?>"
                           class="btn btn-primary btn-sm">
                           ✏ Editar
                        </a>

                        <a href="index.php?action=eliminarUnidad&id=<?= $u['idUnidad'] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Eliminar unidad?')">
                           🗑 Eliminar
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
