<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Categorías</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="Views/css/global.css">
</head>

<body class="fondo-pro">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Categorías</h2>

        <div>
            <a href="index.php?action=dashboard" class="btn btn-volver">
               ⬅ Volver al panel admin
            </a>

            <a href="index.php?action=categoriaCrear" class="btn btn-custom ms-2">
                ➕ Nueva categoría
            </a>
        </div>
    </div>

    <div class="card card-custom p-3 shadow-sm">

        <!-- BUSCADOR -->
        <div class="mb-3">
            <input type="text" id="buscarCategoria" class="form-control input-pro"
                   placeholder="🔎 Buscar categoría...">
        </div>

        <!-- TOAST SUCCESS -->
        <?php if(!empty($_SESSION['message'])): ?>
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div class="toast align-items-center text-bg-success border-0 show">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= $_SESSION['message']; ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['message']); endif; ?>

        <!-- TOAST ERROR -->
        <?php if(!empty($_SESSION['error'])): ?>
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div class="toast align-items-center text-bg-danger border-0 show">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= $_SESSION['error']; ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['error']); endif; ?>

        <div class="table-responsive">
        <table class="table tabla-pro" id="tablaCategorias">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th width="180">Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($categorias as $cat): ?>
                <tr>
                    <td><?= $cat['idCategoria']; ?></td>
                    <td><?= $cat['nombre']; ?></td>
                    <td class="d-flex gap-2">

                        <a href="index.php?action=categoriaEditar&id=<?= $cat['idCategoria']; ?>"
                           class="btn btn-sm btn-custom">
                         Editar
                        </a>

                        <!-- ELIMINAR CON TOAST CONFIRM -->
                        <button class="btn btn-sm btn-eliminar-pro btnEliminar"
                                data-id="<?= $cat['idCategoria']; ?>"
                                data-url="index.php?action=categoriaEliminar&id=<?= $cat['idCategoria']; ?>">
                                Eliminar
                        </button>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>

    </div>
</div>

<!-- MODAL CONFIRM -->
<div class="modal fade" id="modalEliminar" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirmar eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        ¿Seguro que deseas eliminar esta categoría?
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">
            Cancelar
        </button>
        <a id="btnConfirmEliminar" class="btn btn-danger">
            Sí, eliminar
        </a>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* ==============================
   BUSCADOR EN TIEMPO REAL
==============================*/
document.getElementById("buscarCategoria").addEventListener("keyup", function() {

    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll("#tablaCategorias tbody tr");

    filas.forEach(fila => {
        let texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? "" : "none";
    });

});


/* ==============================
   MODAL ELIMINAR
==============================*/
let modal = new bootstrap.Modal(document.getElementById('modalEliminar'));

document.querySelectorAll(".btnEliminar").forEach(btn => {

    btn.addEventListener("click", () => {

        let url = btn.getAttribute("data-url");
        document.getElementById("btnConfirmEliminar").href = url;

        modal.show();
    });

});


/* ==============================
   AUTO OCULTAR TOAST
==============================*/
setTimeout(() => {
    document.querySelectorAll('.toast').forEach(t => {
        new bootstrap.Toast(t).hide();
    });
}, 4000);
</script>

</body>
</html>
