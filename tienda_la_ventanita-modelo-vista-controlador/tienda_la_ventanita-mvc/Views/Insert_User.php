<?php
require_once './Controllers/TipoDocumentoController.php';

$tipoDocumentoController = new TipoDocumentoController();
$tiposDocumento = $tipoDocumentoController->listaTipoDocumento();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="views/css/styles.css">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Registrar Usuario</h3>

        <form action="./Controller/UserController.php" method="POST">

            <div class="row">

                <!-- Número de Documento -->
                <div class="col-md-6 mb-3">
                    <label>Número de Documento:</label>
                    <input type="text" name="numDocumento" class="form-control" required>
                </div>

                <!-- Tipo de Documento (dinámico) -->
                <div class="col-md-6 mb-3">
                    <label>Tipo de Documento:</label>
                    <select name="tipoDocumento" class="form-select" required>
                        <option value="">Seleccione</option>
                        <?php foreach ($tiposDocumento as $td): ?>
                            <option value="<?php echo $td['id']; ?>">
                                <?php echo $td['nombreDocumento']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Nombre -->
                <div class="col-md-6 mb-3">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <!-- Dirección -->
                <div class="col-md-6 mb-3">
                    <label>Dirección:</label>
                    <input type="text" name="direccion" class="form-control">
                </div>

                <!-- Teléfono -->
                <div class="col-md-6 mb-3">
                    <label>Teléfono:</label>
                    <input type="text" name="telefono" class="form-control">
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label>Correo Electrónico:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <!-- Password -->
                <div class="col-md-6 mb-3">
                    <label>Contraseña:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <!-- Rol -->
                <div class="col-md-6 mb-3">
                    <label>Rol:</label>
                    <select name="idRol" class="form-select" required>
                        <option value="1">Administrador</option>
                        <option value="2">Usuario</option>
                    </select>
                </div>

            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary px-4">Registrar</button>
            </div>

        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
