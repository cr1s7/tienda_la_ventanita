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

    <a href="index.php?action=productos" class="btn btn-volver mb-3">⬅ Volver</a>

    <div class="card card-custom p-4 shadow-lg">
        <h2 class="mb-3">Editar Producto</h2>

        <form action="index.php?action=productoActualizar" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idProducto" value="<?= $producto['idProducto'] ?>">

            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" class="form-control mb-3" required>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" 
                        class="form-control" 
                        rows="4"><?= $producto['descripcion'] ?? '' ?></textarea>
            </div>

            <label>Precio Unitario</label>
            <input type="number" name="preUnitario" value="<?= $producto['preUnitario'] ?>" class="form-control mb-3" required>

            <label>Stock</label>
            <input type="number" name="stock" value="<?= $producto['stock'] ?>" class="form-control mb-3" required>

            <label>Foto Actual</label><br>
            <?php if (!empty($producto['foto'])): ?>
                <img src="uploads/<?= $producto['foto'] ?>" width="80" class="mb-3">
            <?php endif; ?>

            <input type="hidden" name="foto_actual" value="<?= $producto['foto'] ?>">


            <input type="file" name="foto" class="form-control mb-3">

            <label>Categoría</label>
            <select name="idCategoria" class="form-select mb-3" required>
                <?php foreach($categorias as $c): ?>
                    <option value="<?= $c['idCategoria'] ?>"
                        <?= ($c['idCategoria'] == $producto['idCategoria']) ? 'selected' : '' ?>>
                        <?= $c['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>


            <label>Unidad de Medida</label>
            <select name="idUnidad_medida" class="form-select mb-3" required>
                <?php foreach ($unidades as $u): ?>
                    <option value="<?= $u['idUnidad'] ?>"
                        <?= ($u['idUnidad'] == $producto['idUnidad_medida']) ? 'selected' : '' ?>>
                        <?= $u['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>


            <label>Marca</label>
            <select name="idMarca" class="form-select mb-4" required>
                <?php foreach($marcas as $m): ?>
                    <option value="<?= $m['idMarca'] ?>"
                        <?= ($m['idMarca'] == $producto['idMarca']) ? 'selected' : '' ?>>
                        <?= $m['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="form-check">
                <input class="form-check-input"
                    type="checkbox"
                    name="destacado"
                    value="1"
                    <?= ($producto['destacado'] == 1) ? 'checked' : '' ?>>

                <label class="form-check-label">
                    Producto destacado
                </label>
            </div>


            <button class="btn btn-primary w-100">Actualizar Producto</button>
        </form>
    </div>
</div>

</body>
</html>
