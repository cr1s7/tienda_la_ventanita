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

    <style>
        body {
            background: #f8f9fa;
        }
        .sidebar {
            width: 260px;
            height: 100vh;
            background: #343a40;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 12px 20px;
            display: block;
            font-size: 17px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            margin-left: 260px;
            padding: 30px;
        }
        .card-custom {
            border-radius: 12px;
        }
    </style>
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

        </div>

        <!-- GRÁFICA -->
        <div class="card mt-4 shadow-sm">
            <div class="card-body">
                <h4><i class="bi bi-graph-up"></i> Ventas del mes</h4>
                <canvas id="graficoVentas" height="100"></canvas>
            </div>
        </div>

</div>


    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('graficoVentas');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                datasets: [{
                    label: 'Ventas',
                    data: [10, 23, 18, 40, 21, 15, 30]
                }]
            },
            options: { responsive: true }
        });
    </script>

</body>
</html>
