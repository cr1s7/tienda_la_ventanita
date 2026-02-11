
  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - La Ventanita</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      body {
        background: #ecfa9b;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }
      .login-card {
        background: #f5dc53;
        padding: 2rem;
        border-radius: 10px;
        width: 360px;
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
      }
    </style>
  </head>

  <body>

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

    <hr>

    <a href="index.php?action=loginGoogle"
      class="btn w-100 mb-2"
      style="background:#ffc107;font-weight:bold;">

      <i class="bi bi-google"></i>
      Continuar con Google
    </a>

    <a href="index.php?action=loginFacebook"
      class="btn btn-primary w-100">

      <i class="bi bi-facebook"></i>
      Continuar con Facebook
    </a>


    <hr>

    <a href="index.php?action=insertUser" class="btn btn-success w-100">
      Crear cuenta
    </a>
  </div>

  </body>
  </html>

