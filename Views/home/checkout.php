<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-body">

            <h3 class="text-center mb-4">💳 Pasarela de Pago</h3>

            <p class="text-center">Total a pagar:</p>

            <h4 class="fw-bold text-center text-success mb-4">
                $ <?= number_format($total ?? 0, 0, ',', '.'); ?>
            </h4>

            <form id="paymentForm" action="index.php?action=procesarCompra" method="POST">

                <!-- Número de tarjeta -->
                <div class="mb-3">
                    <label class="form-label">Número de tarjeta</label>
                    <input type="text"
                           id="cardNumber"
                           name="numero_tarjeta"
                           class="form-control form-control-lg"
                           placeholder="0000 0000 0000 0000"
                           maxlength="19"
                           required>
                </div>

                <div class="row">
                    <!-- Fecha -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="text"
                               id="expiry"
                               name="fecha"
                               class="form-control form-control-lg"
                               placeholder="MM/AA"
                               maxlength="5"
                               required>
                    </div>

                    <!-- CVV -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CVV</label>
                        <input type="password"
                               id="cvv"
                               name="cvv"
                               class="form-control form-control-lg"
                               placeholder="000"
                               maxlength="3"
                               required>
                    </div>
                </div>

                <button type="submit"
                        id="payButton"
                        class="btn btn-success w-100 btn-lg"
                        disabled>
                    <span id="buttonText">Confirmar Pago</span>
                    <span id="spinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                </button>

            </form>

        </div>
    </div>

        <!-- OVERLAY BANCO -->
    <div id="bankOverlay" class="d-none">
        <div class="bank-box text-center">
            <div class="spinner-border text-warning mb-3" style="width:60px;height:60px;"></div>
            <h5 id="bankMessage">Conectando con el banco...</h5>
        </div>
    </div>
</div>

<script>
// ====== FORMATEO TARJETA ======
const cardInput = document.getElementById("cardNumber");
cardInput.addEventListener("input", function(e){
    let value = e.target.value.replace(/\D/g, "");
    value = value.substring(0,16);
    value = value.replace(/(.{4})/g, "$1 ").trim();
    e.target.value = value;
    validateForm();
});

// ====== FORMATEO FECHA ======
const expiryInput = document.getElementById("expiry");
expiryInput.addEventListener("input", function(e){
    let value = e.target.value.replace(/\D/g, "");
    value = value.substring(0,4);
    if(value.length >= 3){
        value = value.substring(0,2) + "/" + value.substring(2);
    }
    e.target.value = value;
    validateForm();
});

// ====== CVV SOLO NÚMEROS ======
const cvvInput = document.getElementById("cvv");
cvvInput.addEventListener("input", function(e){
    e.target.value = e.target.value.replace(/\D/g, "").substring(0,3);
    validateForm();
});

// ====== VALIDACIÓN GENERAL ======
function validateForm(){
    const cardValid = cardInput.value.replace(/\s/g,"").length === 16;
    const expiryValid = expiryInput.value.length === 5;
    const cvvValid = cvvInput.value.length === 3;

    const button = document.getElementById("payButton");

    if(cardValid && expiryValid && cvvValid){
        button.disabled = false;
        button.classList.remove("btn-success");
        button.classList.add("btn-primary");
    }else{
        button.disabled = true;
        button.classList.remove("btn-primary");
        button.classList.add("btn-success");
    }
}
</script>
<script>
<script>
// ====== ANIMACIÓN + RETRASO DE 2 SEGUNDOS ======
const form = document.getElementById("paymentForm");

form.addEventListener("submit", function(e){

    e.preventDefault(); // detener envío inmediato

    const button = document.getElementById("payButton");
    const text = document.getElementById("buttonText");
    const spinner = document.getElementById("spinner");

    // Bloquear botón
    button.disabled = true;
    button.classList.remove("btn-primary");
    button.classList.add("btn-warning");

    // Cambiar texto y mostrar spinner
    text.innerText = "Procesando pago...";
    spinner.classList.remove("d-none");

    // Simular espera de 2 segundos
    setTimeout(function(){
        form.submit(); // ahora sí enviar
    }, 2000);

});
</script>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>