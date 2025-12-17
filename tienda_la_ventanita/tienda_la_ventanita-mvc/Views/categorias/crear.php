<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUEVA CATEGORÍA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body { background: #fffde7; }
    .form-card {
        background: #fff9c4;
        padding: 2rem;
        border-radius: 12px;
        border: 1px solid #f0e68c;
    }
</style>

</head>
<body>
    <div class="container mt-4">
    <h2 class="mb-4">➕ Crear Categoría</h2>

    <div class="card p-4 shadow-sm" style="background-color: #fff9e6; border-radius: 12px;">
        <form action="index.php?action=categoriaGuardar" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Categoría</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre" required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Guardar</button>
                <a href="index.php?action=categorias" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>

