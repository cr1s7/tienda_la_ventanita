<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Productos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Views/css/global.css">
</head>

<body class="fondo-pro">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="titulo-pro">Productos</h2>

        <div>
            <a href="index.php?action=dashboard" class="btn-volver">
                ⬅ Volver al panel admin
            </a>

            <a href="index.php?action=productoCrear" class="btn-custom ms-2">
                ➕ Nuevo Producto
            </a>
        </div>
    </div>

    <!-- 🔎 BUSCADOR -->
    <input type="text" id="buscadorProductos" 
           class="form-control input-pro mb-4"
           placeholder="🔎 Buscar producto...">

    <div class="card card-custom p-4 shadow-lg">

        <!-- ✅ TOAST SUCCESS -->
        <?php if(!empty($_SESSION['message'])): ?>
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div class="toast toast-pro-success show">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= $_SESSION['message']; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['message']); endif; ?>

        <!-- ❌ TOAST ERROR -->
        <?php if(!empty($_SESSION['error'])): ?>
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div class="toast toast-pro-error show">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= $_SESSION['error']; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['error']); endif; ?>


        <table class="table table-hover tabla-pro" id="tablaProductos">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Foto</th>
                    <th>Categoría</th>
                    <th>Unidad</th>
                    <th>Marca</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?= $p['idProducto'] ?></td>
                    <td><?= $p['nombre'] ?></td>
                    <td>$<?= number_format($p['preUnitario']) ?></td>
                                        <td class="<?= $p['stock'] <= 5 ? 'text-danger fw-bold' : '' ?>">
                        <?= $p['stock'] ?>
                    </td>

                    <td>
                        <?php if ($p['foto']): ?>
                            <img src="uploads/<?= $p['foto'] ?>" width="50" class="img-pro">
                        <?php else: ?>
                            <span class="text-muted">Sin foto</span>
                        <?php endif; ?>
                    </td>

                    <td><?= htmlspecialchars($p['categoria'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($p['unidad'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($p['marca'] ?? '—') ?></td>


                    <td class="d-flex gap-2">
                        <a href="index.php?action=productoEditar&id=<?= $p['idProducto'] ?>" 
                           class="btn-editar">
                           ✏Editar
                        </a>

                        <a href="index.php?action=productoEliminar&id=<?= $p['idProducto'] ?>" 
                           class="btn-eliminar-pro btn-eliminar">
                            Eliminar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

// 🔎 BUSCADOR
document.getElementById("buscadorProductos")
.addEventListener("keyup", function(){

    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll("#tablaProductos tbody tr");

    filas.forEach(f => {
        f.style.display =
            f.textContent.toLowerCase().includes(filtro)
            ? ""
            : "none";
    });

});

// 🍞 AUTO OCULTAR TOAST
setTimeout(()=>{
    document.querySelectorAll(".toast").forEach(t=>{
        new bootstrap.Toast(t).hide();
    });
},4000);

// ❗ CONFIRMAR ELIMINACIÓN
document.querySelectorAll(".btn-eliminar")
.forEach(btn=>{
    btn.addEventListener("click", function(e){
        e.preventDefault();
        let url = this.href;

        Swal.fire({
            title: "¿Eliminar producto?",
            text: "Esta acción no se puede deshacer",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result)=>{
            if(result.isConfirmed){
                window.location.href = url;
            }
        });
    });
});

</script>

</body>
</html>