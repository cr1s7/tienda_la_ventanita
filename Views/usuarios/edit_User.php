<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar usuarios</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Views/css/global.css">

</head>

<body class="fondo-pro">

<div class="container mt-4">
    <h2 class="mb-4">✏️ Editar Usuario</h2>

    <div class="card p-4 shadow-sm" style="background-color: #fff9e6; border-radius: 12px;">
        <form action="index.php?action=userActualizar" method="POST">
            <input type="hidden" name="idUsuario" value="<?= $usuario['idUsuario']; ?>">

            <div class="mb-3">
                <label for="numDocumento" class="form-label">Número de Documento</label>
                <input type="text" name="numDocumento" id="numDocumento" class="form-control" value="<?= $usuario['numDocumento']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="tipoDocumento" class="form-label">Tipo de Documento</label>
                <select name="tipoDocumento" id="tipoDocumento" class="form-select" required>
                    <?php foreach($tipos as $tipo): ?>
                        <option value="<?= $tipo['id']; ?>" <?= $tipo['id'] == $usuario['tipo_documento'] ? 'selected' : ''; ?>>
                            <?= $tipo['nombreDocumento']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?= $usuario['nombre']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control" value="<?= $usuario['direccion']; ?>">
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="<?= $usuario['telefono']; ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $usuario['email']; ?>" required>
            </div>

            <!-- NUEVO CAMPO: Rol -->
            <div class="mb-3">
                <label for="idRol" class="form-label">Rol</label>
                <select name="idRol" id="idRol" class="form-select" required>
                    <option value="1" <?= $usuario['idRol'] == 1 ? 'selected' : ''; ?>>Administrador</option>
                    <option value="2" <?= $usuario['idRol'] == 2 ? 'selected' : ''; ?>>Usuario</option>
                </select>
            </div>


            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Actualizar</button>
                <a href="index.php?action=usuarios" class="btn btn-volver"><i class="bi bi-arrow-left"></i> Volver</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
