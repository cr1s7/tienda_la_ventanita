<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Producto</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Views/css/global.css">
</head>

<body class="fondo-pro">

<div class="container mt-4">
    <h2 class="mb-4"> Editar Categoría</h2>

    <div class="card card-custom p-4 shadow-lg" style="background-color: #fff9e6; border-radius: 12px;">
        <form action="index.php?action=categoriaActualizar" method="POST">
            <input type="hidden" name="idCategoria" value="<?= $categoria['idCategoria']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Categoría</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?= $categoria['nombre']; ?>" required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Actualizar</button>
                <a href="index.php?action=categorias" class="btn btn-volver"><i class="bi bi-arrow-left"></i> Volver</a>
            </div>
        </form>
    </div>
</div>


</body>
</html>
