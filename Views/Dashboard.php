<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: index.php?action=login");
    exit;
}

$nombre = $_SESSION['user']['nombre'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="Views/css/dashboard.css">
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="text-white text-center mb-4"> Admin Panel</h4>


        <hr class="text-white">

        <a href="index.php?action=logout" class="text-danger"><i class="bi bi-door-open-fill"></i> Cerrar sesión</a>

        <a href="index.php?action=passwordForm" class="text-danger"><i class="bi bi-key-fill"></i> Cambiar contraseña</a>

    </div>


    <!-- CONTENIDO -->
    <div class="content">

        <h2 class="mb-4">👋 Bienvenido, <?php echo $nombre; ?></h2>

        <!-- TARJETAS -->
        <div class="row">

            <div class="col-md-4 mb-3">
                <div class="card card-custom p-4 shadow-sm">
                    <h4><i class="bi bi-people-fill"></i> Usuarios</h4>
                    <p>Gestiona los usuarios del sistema</p>
                    <a href="index.php?action=usuarios" class="btn btn-dark">Gestionar</a>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card card-custom p-4 shadow-sm">
                    <h4><i class="bi bi-box-seam"></i> Productos</h4>
                    <p>Controla inventario y precios</p>
                    <a href="index.php?action=productos" class="btn btn-dark">Gestionar</a>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card card-custom p-4 shadow-sm">
                    <h4><i class="bi bi-cart-check-fill"></i>Categorias</h4>
                    <p>Control de categorías</p>
                    <a href="index.php?action=categorias" class="btn btn-dark">Ver</a>
                </div>
            </div>

            
            <div class="col-md-4 mb-3">
                <div class="card card-custom p-4 shadow-sm">
                    <h4><i class="bi bi-cart-check-fill"></i>Marcas</h4>
                    <p>Control de Marcas</p>
                    <a href="index.php?action=marcas" class="btn btn-dark">Ver</a>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card card-custom p-4 shadow-sm">
                    <h4><i class="bi bi-cart-check-fill"></i>Unidades de Medida</h4>
                    <p>Control de Unidades de Medida</p>
                    <a href="index.php?action=unidades" class="btn btn-dark">Ver</a>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card card-custom p-4 shadow-sm">
                    <h4><i class="bi bi-cart-check-fill"></i>Gestion de ventas</h4>
                    <p>Control de reportes</p>
                    <a href="index.php?action=ventas" class="btn btn-dark">Ver</a>
                </div>
            </div>

        </div>

        <!-- GRÁFICA -->
        <div class="card mt-4 shadow-sm">
            <div class="card-body">
                <h4><i class="bi bi-graph-up"></i> Ventas últimos 7 días</h4>
                <canvas id="graficoVentas" height="100"></canvas>
                <div class="text-end mt-3">
                    <a href="index.php?action=reporteSemanal" class="btn btn-success">
                        <i class="bi bi-file-earmark-pdf-fill"></i> Generar Reporte Semanal
                    </a>
                </div>
            </div>
        </div>

</div>


    </div>

     <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {

        const canvas = document.getElementById('graficoVentas');

        if (!canvas) {
            console.error("No se encontró el canvas");
            return;
        }

        const ctx = canvas.getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($dias) ?>,
                datasets: [{
                    label: 'Ventas últimos 7 días',
                    data: <?= json_encode($totales) ?>,
                    backgroundColor: '#fbc02d'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    });
    </script>
</body>
</html>
