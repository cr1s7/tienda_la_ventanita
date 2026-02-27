
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Unidad</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Views/css/global.css">

</head>

<body class="fondo-pro">

<div class="container mt-4">

    <a href="index.php?action=unidades" class="btn btn-secondary mb-3">⬅ Volver</a>

    <div class="card card-custom p-4 shadow-lg">
        <h2 class="mb-3">Editar Unidad</h2>

        <form action="index.php?action=editarUnidad" method="POST">

            <input type="hidden" name="idUnidad" value="<?= $unidad['idUnidad'] ?>">

            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= $unidad['nombre'] ?>" class="form-control mb-3" required>

            <button class="btn btn-primary w-100">Actualizar</button>
        </form>
    </div>

</div>
</body>
</html>
