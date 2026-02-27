<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Unidades de Medida</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="Views/css/global.css">
</head>

<body class="fondo-pro">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold titulo-seccion">📏 Unidades de Medida</h2>

        <div class="d-flex gap-2">
            <a href="index.php?action=dashboard" class="btn btn-volver">
                ⬅ Volver al panel admin
            </a>

            <a href="index.php?action=crearUnidad" class="btn btn-custom ms-2">
                ➕ Nueva Unidad
            </a>
        </div>
    </div>

        <input type="text" id="buscadorUnidades" 
           class="form-control input-pro mb-4"
           placeholder="🔎 Buscar unidad...">

    <div class="card-custom p-4">

        <!-- ================= MENSAJES ================= -->

        <?php if(!empty($_SESSION['message'])): ?>
            <div class="toast-carrito toast-ok">
                <?= $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if(!empty($_SESSION['error'])): ?>
            <div class="toast-carrito toast-error">
                <?= $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>


        <div class="table-responsive">
        <<table class="table tabla-pro" id="tablaUnidades">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th width="200">Acciones</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach($unidades as $u): ?>
                <tr>

                    <td><?= $u['idUnidad'] ?></td>

                    <td><?= htmlspecialchars($u['nombre']) ?></td>

                    <td class="d-flex gap-2">

                        <a href="index.php?action=editarUnidad&id=<?= $u['idUnidad'] ?>"
                           class="btn-editar">
                           ✏Editar
                        </a>

                        <a href="index.php?action=eliminarUnidad&id=<?= $u['idUnidad'] ?>"
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


<!-- AUTO OCULTAR TOAST -->
<script>
setTimeout(() => {
    document.querySelectorAll('.toast').forEach(t => {
        new bootstrap.Toast(t).hide();
    });
}, 3000);

// 🔎 BUSCADOR UNIDADES
document.getElementById("buscadorUnidades")
.addEventListener("keyup", function(){

    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll("#tablaUnidades tbody tr");

    filas.forEach(f => {
        f.style.display =
            f.textContent.toLowerCase().includes(filtro)
            ? ""
            : "none";
    });

});
</script>



<!-- CONFIRMAR ELIMINACIÓN -->
<script>
document.querySelectorAll('.btn-eliminar').forEach(btn => {

    btn.addEventListener('click', function(e) {
        e.preventDefault();

        const url = this.href;

        Swal.fire({
            title: '¿Eliminar unidad?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {

            if (result.isConfirmed) {
                window.location.href = url;
            }

        });
    });

});
</script>

</body>
</html>

