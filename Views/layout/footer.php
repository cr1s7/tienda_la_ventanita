<footer class="bg-dark text-light mt-5">
    <div class="container py-5">
        <div class="row gy-4">

            <!-- INFO -->
            <div class="col-md-4">
                <h5 class="fw-bold text-warning">🏪 La Ventanita</h5>
                <p class="small mb-0">
                    Tu minimarket de confianza, siempre cerca de ti con los mejores precios.
                </p>
            </div>

            <!-- CONTACTO -->
            <div class="col-md-4">
                <h6 class="fw-bold text-warning">Contacto</h6>
                <p class="small mb-1">📍 Reservas de Cantabria</p>
                <p class="small mb-1">📞 317 302 5957</p>
                <p class="small">⏰ Lun - Dom 8:00 AM - 9:30 PM</p>
            </div>

            <!-- REDES (opcional) -->
            <div class="col-md-4">
                <h6 class="fw-bold text-warning">Síguenos</h6>
                <a href="#" class="text-light me-3"><i class="bi bi-facebook fs-5"></i></a>
                <a href="#" class="text-light me-3"><i class="bi bi-instagram fs-5"></i></a>
                <a href="#" class="text-light"><i class="bi bi-whatsapp fs-5"></i></a>
            </div>

        </div>

        <hr class="border-secondary my-4">

        <div class="text-center small">
            © <?= date('Y') ?> La Ventanita · Todos los derechos reservados
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const BASE_URL = "<?= BASE_URL ?>";
</script>

<script src="<?= BASE_URL ?>Views/Assets/js/carrito.js"></script>
</body>
</html>
