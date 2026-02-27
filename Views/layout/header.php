<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>La Ventanita</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="Views/css/global.css">
</head>
<body>
    
<?php require_once './Config/session.php'; ?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-warning shadow-sm py-3">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand fw-bold fs-4 text-dark"
           href="index.php?action=home">
           La Ventanita
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarTienda">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTienda">

            <!-- MENÚ -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold"
                       href="index.php?action=home">
                       INICIO
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold"
                       href="index.php?action=tienda">
                       CATALOGO
                    </a>
                </li>

            </ul>

            <!-- BUSCADOR -->
            <form class="d-flex ms-auto" method="GET" action="index.php">
    
                <input type="hidden" name="action" value="tienda">

                <input class="form-control me-2"
                       type="search"
                       name="buscar"
                       placeholder="Buscar productos..."
                       value="<?= $_GET['buscar'] ?? '' ?>">

            </form>


            <?php if (isset($_SESSION['user'])): ?>

                <!-- 🔥 CARRITO BD -->
                <a href="index.php?action=carrito"
                class="btn btn-light rounded-pill px-4 position-relative ms-2">

                    <i class="bi bi-cart3"></i>
                    Carrito

                    <span id="punto-carrito"
                        class="position-absolute top-0 start-100 translate-middle
                                p-2 bg-danger border border-light rounded-circle">
                    </span>
                </a>
                
                    <a href="index.php?action=miCuenta"
                    class="btn btn-dark rounded-pill px-4 ms-2">
                    <i class="bi bi-person"></i>
                    Mi Cuenta
                    </a>

                <!-- LOGOUT -->
                <a href="index.php?action=logout"
                   class="btn-logout ms-2">

                    <i class="bi bi-door-open-fill"></i>
                    Cerrar sesión
                </a>

            <?php else: ?>

                <a href="index.php?action=login"
                   class="btn btn-dark rounded-pill px-4 ms-2">

                    <i class="bi bi-person-circle"></i>
                    Iniciar sesión
                </a>

            <?php endif; ?>

        </div>
    </div>
</nav>

<!-- 🔥 CONTENEDOR DINÁMICO DEL CARRITO -->
<div id="carrito-contenido"></div>

