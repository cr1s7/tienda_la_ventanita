<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial; }
        h2 { text-align: center; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #fbc02d;
        }
    </style>
</head>
<body>

<h2>Reporte de Ventas - Últimos 7 Días</h2>

<table>
    <thead>
        <tr>
            <th>ID Factura</th>
            <th>Fecha</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $totalGeneral = 0; ?>
        <?php foreach ($ventas as $venta): ?>
        <tr>
            <td><?= $venta['idFactura'] ?></td>
            <td><?= $venta['fechaEmision'] ?></td>
            <td>$<?= number_format($venta['total'], 0, ',', '.') ?></td>
        </tr>
        <?php $totalGeneral += $venta['total']; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<h3 style="text-align:right; margin-top:20px;">
    Total General: $<?= number_format($totalGeneral, 0, ',', '.') ?>
</h3>

</body>
</html>