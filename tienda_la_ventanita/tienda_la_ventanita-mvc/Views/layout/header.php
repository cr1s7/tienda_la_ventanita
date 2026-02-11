<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>La Ventanita</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

/* ===== WRAPPER ===== */
.carrusel-wrapper {
    overflow: hidden;
    position: relative;
}

/* ===== TRACK ===== */
.carrusel-track {
    display: flex;
    gap: 20px;
    animation: scrollCarrusel 40s linear infinite;
}

/* ===== TARJETAS ===== */
.destacado-card {
    min-width: 220px;
    flex: 0 0 auto;   /* 👈 ESTE ES EL ARREGLO */
    border: 2px solid #ffc107;
    border-radius: 15px;
    overflow: hidden;
    transition: .4s ease;
    background: white; /* opcional para que no se vea transparente */
}

.destacado-card .card-body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 160px; /* altura fija del contenido */
}


/* Imagen */
.destacado-card img {
    height: 180px;
    object-fit: cover;
}

/* Hover levanta */
.destacado-card:hover {
    transform: scale(1.08);
    z-index: 5;
}


/* ===== SCROLL CONTINUO ===== */
@keyframes scrollCarrusel {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(-50%);
    }
}

.destacado-card.centro {
    transform: scale(1.2);
    box-shadow: 0 10px 25px rgba(0,0,0,.3);
    z-index: 2;
}



.btn-logout {
    background: #212529;
    color: white;
    border-radius: 50px;
    padding: 8px 18px;
    font-weight: 500;
    transition: .3s ease;
}

.btn-logout:hover {
    background: #ffc107;
    color: black;
}


/* BUSCADOR REDONDO */
.buscador {
    max-width: 500px;
    margin: auto;
}

.buscador input {
    border-radius: 50px;
    padding-left: 20px;
}

/* CATEGORÍAS MENU */
.menu-categorias {
    background: #f1f1f1;
}

.menu-categorias a {
    color: #333;
    font-weight: 500;
    text-decoration: none;
    padding: 12px 18px;
    display: inline-block;
}

.menu-categorias a:hover {
    color: #ffc107;
}

.menu-categorias .activo {
    border-bottom: 3px solid #ffc107;
    color: #ffc107;
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-warning shadow-sm py-3">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand fw-bold fs-4 text-dark"
           href="index.php?action=home">
           La Ventanita
        </a>

        <!-- BOTÓN RESPONSIVE -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarTienda">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTienda">

            <!-- MENÚ IZQUIERDA -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- TODOS -->
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

            <form class="d-flex ms-auto" method="GET" action="index.php">
    
                <input type="hidden" name="action" value="tienda">

                <input class="form-control me-2"
                    type="search"
                    name="buscar"
                    placeholder="Buscar productos..."
                    value="<?= $_GET['buscar'] ?? '' ?>">

                <button class="btn btn-dark" type="submit">
                    🔍
                </button>

            </form>


            <?php
            $cantidad = 0;
            if (isset($_SESSION['carrito'])) {
                $cantidad = array_sum(array_column($_SESSION['carrito'], 'cantidad'));
            }
            ?>


            <?php if (isset($_SESSION['user'])): ?>

                <!-- CARRITO -->
                <button class="btn btn-light rounded-pill px-4 position-relative ms-2"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#carritoCanvas">

                    <i class="bi bi-cart3"></i>
                    Carrito

                    <span class="badge bg-danger">
                        <?= $cantidad ?>
                    </span>
                </button>

                <!-- LOGOUT -->
                <a href="index.php?action=logout" class="btn-logout ms-2">
                    <i class="bi bi-door-open-fill"></i>
                    Cerrar sesión
                </a>

            <?php else: ?>

                <!-- LOGIN -->
                <a href="index.php?action=login"
                class="btn btn-dark rounded-pill px-4 ms-2">

                    <i class="bi bi-person-circle"></i>
                    Iniciar sesión
                </a>

            <?php endif; ?>


        </div>
    </div>
</nav>