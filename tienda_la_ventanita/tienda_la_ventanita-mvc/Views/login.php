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
      width: 350px;
    }
  </style>
</head>

<body>

<div class="login-card">
  <h2>Bienvenido a La Ventanita</h2>

  <!-- RUTA CORREGIDA -->
  <form action="index.php?action=doLogin" method="POST">
    <input type="email" name="email" class="form-control mt-3" placeholder="Correo" required>
    <input type="password" name="password" class="form-control mt-3" placeholder="Contraseña" required>

    <button class="btn btn-primary w-100 mt-4">Ingresar</button>
  </form>

  <!-- ESTE ESTÁ PERFECTO -->
  <a href="index.php?action=insertUser" class="btn btn-success w-100 mt-3">
      Registrar Usuario
  </a>

</div>

</body>
</html>
