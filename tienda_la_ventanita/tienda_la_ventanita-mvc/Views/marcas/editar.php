<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Marca</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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

    <a href="index.php?action=marcas" class="btn btn-secondary mb-3">⬅ Volver</a>

    <div class="form-card shadow-sm">
        <h2 class="mb-3">Editar Marca</h2>

        <form action="index.php?action=marcaEditar" method="POST">

            <input type="hidden" name="idMarca" value="<?= $marca['idMarca'] ?>">

            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= $marca['nombre'] ?>" class="form-control mb-3" required>

            <button class="btn btn-primary w-100">Actualizar</button>
        </form>
    </div>

</div>
</body>
</html>
