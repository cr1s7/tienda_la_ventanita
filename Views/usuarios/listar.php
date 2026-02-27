<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Usuarios</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Views/css/global.css">
</head>

<body class="fondo-pro">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold titulo-seccion">👥 Usuarios</h2>
        <div class="d-flex gap-2">
            <a href="index.php?action=dashboard" class="btn btn-volver">
                ⬅ Volver al panel admin
            </a>
            <a href="index.php?action=insertUser" class="btn btn-custom ms-2">
                ➕ Nuevo Usuario
            </a>
        </div>
    </div>

    <!-- 🔎 BUSCADOR -->
    <input type="text" id="buscadorUsuarios" class="form-control buscador-admin mb-4" placeholder="Buscar usuario...">

    <div class="card-custom p-4">

    <!-- ✅ TOAST SUCCESS -->
    <?php if(!empty($_SESSION['message'])): ?>
    <div class="toast-carrito toast-ok">
        <?= $_SESSION['message']; ?>
    </div>
    <?php unset($_SESSION['message']); endif; ?>

    <!-- ❌ TOAST ERROR -->
    <?php if(!empty($_SESSION['error'])): ?>
    <div class="toast-carrito toast-error">
        <?= $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']); endif; ?>

        <div class="table-responsive">
        <table class="table tabla-pro" id="tablaUsuarios">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Tipo Doc</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($usuarios as $user): ?>
                <tr>
                    <td><?= $user['idUsuario']; ?></td>
                    <td><?= htmlspecialchars($user['nombre']); ?></td>
                    <td><?= htmlspecialchars($user['numDocumento']); ?></td>
                    <td><?= htmlspecialchars($user['tipoDocumento'] ?? '—'); ?></td>
                    <td><?= htmlspecialchars($user['telefono']); ?></td>
                    <td><?= htmlspecialchars($user['email']); ?></td>
                    <td>
                        <span class="badge-rol <?= $user['idRol']==1 ? 'admin' : 'user'; ?>">
                            <?= $user['idRol']==1 ? 'Administrador' : 'Usuario'; ?>
                        </span>
                    </td>

                    <td class="d-flex gap-2">

                        <a href="index.php?action=usuarioEditar&id=<?= $user['idUsuario']; ?>" 
                           class="btn-editar">
                           ✏Editar
                        </a>

                        <a href="index.php?action=userEliminar&id=<?= $user['idUsuario']; ?>" 
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
</div>
<!-- ================= JS ================= -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>


// 🔎 BUSCADOR
document.getElementById("buscadorUsuarios").addEventListener("keyup", function(){

    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll("#tablaUsuarios tbody tr");

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
document.querySelectorAll(".btn-eliminar").forEach(btn=>{

    btn.addEventListener("click", function(e){

        e.preventDefault();
        let url = this.href;

        Swal.fire({
            title: "¿Eliminar usuario?",
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
