<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nueva Unidad</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Views/css/styles.css">

</head>

<body>

<div class="container mt-4">

    <a href="index.php?action=unidades" class="btn btn-secondary mb-3">⬅ Volver</a>

    <div class="form-card shadow-sm">
        <h2 class="mb-3">Registrar Unidad</h2>

        <form action="index.php?action=unidadGuardar" method="POST">

            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control mb-3" required>

            <button class="btn btn-primary w-100">Guardar</button>
        </form>
    </div>

</div>
</body>
</html>
