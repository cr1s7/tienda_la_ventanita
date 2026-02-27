<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - La Ventanita</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <link rel="stylesheet" href="Views/css/login.css">


</head>

<body class="login-wrapper">

  <div class="login-card">
    <h3 class="text-center mb-3"> La Ventanita</h3>
    <h5 class="text-center">Iniciar Sesión</h5>

    <!-- MENSAJE DE ERROR -->
    <?php if (isset($error)): ?>
      <div class="alert alert-danger mt-3">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form action="index.php?action=doLogin" method="POST" class="mt-3">
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
      </div>

      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">
        Ingresar
      </button>
    </form>

    <a href="index.php?action=forgotPasswordForm">
        ¿Olvidaste tu contraseña?
    </a>

    <hr>

    <a href="index.php?action=loginGoogle"
      class="btn w-100 mb-2"
      style="background:#ffc107;font-weight:bold;">

      <i class="bi bi-google"></i>
      Continuar con Google
    </a>

    <hr>

  <a href="index.php?action=insertUser" 
    class="btn-crear-ventanita w-100 text-center">
    Crear cuenta
  </a>
  </div>

</body>
</html>
