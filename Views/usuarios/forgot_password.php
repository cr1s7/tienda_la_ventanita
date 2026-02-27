<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Recuperar contraseña</title>

<link rel="stylesheet" href="Views/css/styles.css">
</head>

<body>

<div class="auth-wrapper">

    <div class="auth-card">

        <h3 class="titulo-ventanita">
            La Ventanita
        </h3>
        <h5 style="text-align:center; margin-bottom:25px;">Recuperar Contraseña</h5>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=sendCode">

            <input type="email"
                   name="email"
                   class="input-ventanita"
                   placeholder="Correo electrónico"
                   required>

            <div style="margin-top:20px;">
                <button class="btn-ventanita">
                    Enviar enlace
                </button>
            </div>

        </form>

        <div style="text-align:center; margin-top:20px;">

        <?php if(isset($_GET['origen']) && $_GET['origen'] === 'cuenta'): ?>

            <a href="index.php?action=miCuenta" class="btn-ventanita-sec">
                ← Volver
            </a>

        <?php else: ?>

            <a href="index.php?action=login" class="link-ventanita">
                Volver al login
            </a>

        <?php endif; ?>

        </div>

    </div>

</div>

</body>
</html>