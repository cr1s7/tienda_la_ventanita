<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Cambiar contraseña</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

<h3>Cambiar contraseña</h3>

<form method="POST" action="index.php?action=changePassword">
    <input type="password" name="password_actual" class="form-control mb-3" placeholder="Contraseña actual" required>
    <input type="password" name="password_nueva" class="form-control mb-3" placeholder="Nueva contraseña" required>
    <input type="password" name="password_confirmar" class="form-control mb-3" placeholder="Confirmar nueva contraseña" required>

    <button class="btn btn-warning">Actualizar</button>
</form>

</body>
</html>
