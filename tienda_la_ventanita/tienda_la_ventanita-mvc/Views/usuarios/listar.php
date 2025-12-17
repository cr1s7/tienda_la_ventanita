<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Usuarios</title>
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
        font-weight: bold;
    }
    .btn-custom:hover {
        background: #fdd835;
    }
</style>
</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">👥 Usuarios</h2>
        <div class="d-flex gap-2">
            <a href="index.php?action=dashboard" 
                class="btn btn-custom">
                ⬅ Volver al panel admin
            </a>
            <a href="index.php?action=insertUser" 
                class="btn btn-custom">
                ➕ Nuevo Usuario
            </a>
        </div>
    </div>

    <div class="card card-custom p-3 shadow-sm">

    <?php if(!empty($_SESSION['message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php endif; ?>

    <?php if(!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Tipo Doc</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $user): ?>
                <tr>
                    <td><?= $user['idUsuario']; ?></td>
                    <td><?= htmlspecialchars($user['nombre']); ?></td>
                    <td><?= htmlspecialchars($user['numDocumento']); ?></td>
                    <td><?= htmlspecialchars($user['tipoDocumento'] ?? '—'); ?></td>
                    <td><?= htmlspecialchars($user['telefono']); ?></td>
                    <td><?= htmlspecialchars($user['email']); ?></td>
                    <td><?= $user['idRol'] == 1 ? 'Administrador' : 'Usuario'; ?></td>
                    <td class="d-flex gap-2">
                        <a href="index.php?action=usuarioEditar&id=<?= $user['idUsuario']; ?>" class="btn btn-primary btn-sm">✏ Editar</a>
                        <a href="index.php?action=userEliminar&id=<?= $user['idUsuario']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este usuario?');">🗑 Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

</body>
</html>

