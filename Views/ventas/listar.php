<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Ventas</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Views/css/global.css">
</head>

<body class="fondo-pro">

<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="titulo-pro mb-0">Ventas</h2>

    <div class="d-flex gap-2">
        <a href="index.php?action=dashboard" class="btn-volver">
            ⬅ Volver al panel admin
        </a>
    </div>
</div>

<input type="text" id="buscadorVentas"
       class="input-pro mb-4 w-100"
       placeholder="Buscar venta...">

<div class="card-custom p-4">

<table class="tabla-pro" id="tablaVentas">
    <thead>
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($ventas as $v): ?>
        <tr>
            <td><?= $v['idFactura'] ?></td>
            <td><?= $v['nombre'] ?></td>
            <td>$<?= number_format($v['total'],2) ?></td>
            <td><?= $v['fechaEmision'] ?></td>
            <td>
                <div class="d-flex gap-2">
                    <a href="index.php?action=descargarFactura&id=<?= $v['idFactura'] ?>"
                        class="btn btn-sm btn-outline-dark">
                        Descargar
                    </a>
                </div>
            </td>

        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
</div>
</body>
</html>