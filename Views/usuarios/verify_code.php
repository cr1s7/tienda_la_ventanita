<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Verificar código</title>

<link rel="stylesheet" href="Views/css/styles.css">
</head>

<body>

<div class="auth-wrapper">
    <div class="auth-card">

        <h3 style="text-align:center; margin-bottom:25px;">
            Verificar Código
        </h3>

        <?php if(isset($error)): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=verifyCode">

            <input type="hidden" name="email" value="<?= $email ?>">

            <input type="text"
                   name="codigo"
                   class="input-ventanita"
                   placeholder="Ingrese el código"
                   required>

            <div style="margin-top:20px;">
                <button class="btn-ventanita">
                    Verificar código
                </button>
            </div>

        </form>

        <div style="margin-top:20px; text-align:center;">

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