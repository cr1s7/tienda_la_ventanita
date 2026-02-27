<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Marcas</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Views/css/global.css">

</head>

<body class="fondo-pro">

    <div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="titulo-pro mb-0">Marcas</h2>

        <div class="d-flex gap-2">
            <a href="index.php?action=dashboard" class="btn-volver">
                ⬅ Volver al panel admin
            </a>

            <a href="index.php?action=marcaCrear" class="btn-custom">
                ➕ Nueva Marca
            </a>
        </div>

    </div>

    <!-- 🔎 BUSCADOR -->
    <input type="text"
           id="buscadorMarcas"
           class="form-control input-pro mb-4"
           placeholder="Buscar marca...">

    <div class="card-custom p-4">

        <!-- ✅ TOAST SUCCESS -->
        <?php if(!empty($_SESSION['message'])): ?>
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div class="toast toast-pro-success border-0 show">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= $_SESSION['message']; ?>
                    </div>
                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="toast">
                    </button>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['message']); endif; ?>

        <!-- ❌ TOAST ERROR -->
        <?php if(!empty($_SESSION['error'])): ?>
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div class="toast toast-pro-error border-0 show">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= $_SESSION['error']; ?>
                    </div>
                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="toast">
                    </button>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['error']); endif; ?>

        <table class="tabla-pro" id="tablaMarcas">
            <thead>
                <tr>
                    <th width="80">#</th>
                    <th>Nombre</th>
                    <th width="180">Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($marcas as $m): ?>
                <tr>
                    <td><?= $m['idMarca'] ?></td>
                    <td><?= $m['nombre'] ?></td>
                    <td class="d-flex gap-2">
                        <a href="index.php?action=marcaEditar&id=<?= $m['idMarca'] ?>"
                           class="btn-custom btn-sm">
                           ✏Editar
                        </a>

                        <a href="index.php?action=marcaEliminar&id=<?= $m['idMarca'] ?>"
                           class="btn-eliminar-pro btn-sm btn-eliminar">
                           Eliminar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>


<!-- ================= JS ================= -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

// 🔎 BUSCADOR
document.getElementById("buscadorMarcas")
.addEventListener("keyup", function(){

    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll("#tablaMarcas tbody tr");

    filas.forEach(f=>{
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
            title: "¿Eliminar marca?",
            text: "No podrás revertir esto",
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