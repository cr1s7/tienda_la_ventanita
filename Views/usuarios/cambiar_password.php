<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Cambiar contraseña</title>

<link rel="stylesheet" href="Views/css/styles.css">
</head>

<body>

<div class="auth-wrapper">
    <div class="auth-card">

        <h3 class="text-center mb-3">Nueva contraseña</h3>

        <?php if(isset($error)): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=updatePasswordCode">

            <input type="hidden" name="email" value="<?= $email ?? '' ?>">

            <input type="password"
                   id="password"
                   name="password"
                   class="input-ventanita"
                   placeholder="Nueva contraseña"
                   required>

            <div class="progress" style="margin:15px 0;">
                <div id="strengthBar"
                     class="progress-bar"
                     role="progressbar"
                     style="width:0%">
                </div>
            </div>

            <div class="rules">
                <div id="rule-length" class="invalid">• Mínimo 6 caracteres</div>
                <div id="rule-upper" class="invalid">• Una mayúscula</div>
                <div id="rule-number" class="invalid">• Un número</div>
                <div id="rule-symbol" class="invalid">• Un símbolo</div>
            </div>

            <input type="password"
                   id="confirmar"
                   name="confirmar_password"
                   class="input-ventanita"
                   style="margin-top:15px;"
                   placeholder="Confirmar contraseña"
                   required>

            <div style="margin-top:20px;">
                <button class="btn-ventanita">
                    Cambiar contraseña
                </button>
            </div>

        </form>

        <div style="margin-top:20px; text-align:center;">

        <?php if(isset($_GET['origen']) && $_GET['origen'] === 'cuenta'): ?>

            <a href="index.php?action=miCuenta" class="btn-ventanita-sec">
                ← Volver
            </a>

        <?php else: ?>

            <a href="index.php?action=login" class="link-ventanita">
                Volver al login
            </a>

        <?php endif; ?>

        </div>

    </div>
</div>


<script>
const password = document.getElementById("password");
const bar = document.getElementById("strengthBar");

password.addEventListener("keyup", function(){

    const val = password.value;
    let strength = 0;

    // Reglas
    const length = val.length >= 6;
    const upper  = /[A-Z]/.test(val);
    const number = /[0-9]/.test(val);
    const symbol = /[^A-Za-z0-9]/.test(val);

    toggle("rule-length", length);
    toggle("rule-upper", upper);
    toggle("rule-number", number);
    toggle("rule-symbol", symbol);

    if(length) strength++;
    if(upper)  strength++;
    if(number) strength++;
    if(symbol) strength++;

    // Barra
    const percent = (strength / 4) * 100;
    bar.style.width = percent + "%";

    if(percent <= 25) bar.className="progress-bar bg-danger";
    else if(percent <= 50) bar.className="progress-bar bg-warning";
    else if(percent <= 75) bar.className="progress-bar bg-info";
    else bar.className="progress-bar bg-success";
});

function toggle(id, valid){
    const el = document.getElementById(id);
    el.className = valid ? "valid" : "invalid";
}
</script>

</body>
</html>
