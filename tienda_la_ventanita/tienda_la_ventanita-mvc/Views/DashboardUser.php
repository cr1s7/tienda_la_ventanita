<?php
session_start();

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
    <title>Dashboard Usuario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #d8f3dc;
        }
        .header {
            background: #95d5b2;
            padding: 1rem;
        }
    </style>
</head>

<body>

    <div class="header d-flex justify-content-between align-items-center">
        <h3>Bienvenido</h3>

        <div>
            <span class="me-3">👋 Hola, <?php echo $nombre; ?></span>
            <a href="index.php?action=logout" class="btn btn-danger btn-sm">Cerrar sesión</a>
        </div>
    </div>

    <div class="container mt-4">

        <div class="alert alert-success">
            Gracias por iniciar sesión. Aquí podrás ver tus productos y realizar compras.
        </div>

    </div>

</body>
</html>
