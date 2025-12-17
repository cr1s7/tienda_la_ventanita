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

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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

<div class="container mt-5">

    <a href="index.php?action=usuarios" class="btn btn-secondary mb-3">⬅ Volver</a>

    <div class="form-card shadow-sm">

        <h2 class="text-center mb-4">Registrar Usuario</h2>

        <form action="index.php?action=insertUser" method="POST">

            <div class="row">

                <!-- Número de Documento -->
                <div class="col-md-6 mb-3">
                    <label class="fw-semibold">Número de Documento</label>
                    <input type="text" name="numDocumento" class="form-control" required>
                </div>

                <!-- Tipo Documento -->
                <div class="col-md-6 mb-3">
                    <label class="fw-semibold">Tipo de Documento</label>
                    <select name="tipoDocumento" class="form-select" required>
                        <option value="">Seleccione</option>
                        <?php foreach ($tiposDocumento as $td): ?>
                            <option value="<?= $td['id']; ?>">
                                <?= $td['nombreDocumento']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Nombre -->
                <div class="col-md-6 mb-3">
                    <label class="fw-semibold">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <!-- Dirección -->
                <div class="col-md-6 mb-3">
                    <label class="fw-semibold">Dirección</label>
                    <input type="text" name="direccion" class="form-control">
                </div>

                <!-- Teléfono -->
                <div class="col-md-6 mb-3">
                    <label class="fw-semibold">Teléfono</label>
                    <input type="text" name="telefono" class="form-control">
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label class="fw-semibold">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <!-- CONTRASEÑA -->
                <div class="col-md-6 mb-3">
                    <label class="fw-semibold">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <!-- CONFIRMAR -->
                <div class="col-md-6 mb-3">
                    <label class="fw-semibold">Confirmar Contraseña</label>
                    <input type="password" name="confirmPassword" class="form-control" required>
                </div>

                <!-- ROL -->
                <div class="col-md-6 mb-3">
                    <label class="fw-semibold">Rol del Usuario</label>
                    <select name="idRol" class="form-select" required>
                        <option value="2">Usuario</option>
                        <option value="1">Administrador</option>
                    </select>
                </div>

            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary px-4">
                    Registrar Usuario
                </button>
            </div>

        </form>
    </div>
</div>

</body>
</html>
