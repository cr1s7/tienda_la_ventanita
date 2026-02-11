
<style>
/* CARD GENERAL */
.detalle-card{
    background:#f7f7f7;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.1);
}

/* CONTENEDOR IMAGEN */
.img-container{
    background:white;
    border-radius:12px;
    padding:30px;
    text-align:center;
    box-shadow: inset 0 0 10px rgba(0,0,0,.05);
}

/* IMAGEN */
.producto-img{
    max-height:300px;
    object-fit:contain;
}

/* CATEGORIA */
.categoria{
    font-size:.8rem;
    color:#777;
    text-transform:uppercase;
}

/* TITULO */
.producto-titulo{
    color:#0d47a1;
    font-weight:700;
    margin-bottom:5px;
}

/* REFERENCIA */
.referencia{
    font-size:.9rem;
    color:#666;
}

/* BOX DESCRIPCION */
.detalle-box{
    width:100%;
    height:70px;
    border:1px solid #ccc;
    border-radius:6px;
    padding:8px;
    resize:none;
    font-size:.9rem;
    background:white;
}

/* PRECIO */
.precio{
    color:#0d47a1;
    font-weight:bold;
    margin-top:15px;
}

/* CONTADOR */
.contador{
    display:flex;
    align-items:center;
    border:2px solid #cddc39;
    border-radius:20px;
    overflow:hidden;
}

.contador button{
    background:#cddc39;
    border:none;
    padding:5px 12px;
    font-weight:bold;
}

.contador input{
    width:40px;
    text-align:center;
    border:none;
}

/* BOTON AGREGAR */
.btn-agregar{
    background:#cddc39;
    color:black;
    padding:8px 20px;
    border-radius:20px;
    font-weight:600;
    text-decoration:none;
    transition:.3s;
}

.btn-agregar:hover{
    background:#d4e157;
}

</style>



<div class="container my-5">

    <div class="detalle-card p-4">

        <div class="row g-4">

            <!-- FOTO IZQUIERDA -->
            <div class="col-lg-6">

                <div class="img-container">

                    <img src="uploads/<?= $producto['foto'] ?: 'default.png' ?>"
                         class="img-fluid producto-img">

                </div>

            </div>

            <!-- INFO DERECHA -->
            <div class="col-lg-6">

                <!-- CATEGORIA -->
                <span class="categoria">
                    <?= $producto['categoria'] ?>
                </span>

                <!-- NOMBRE -->
                <h2 class="producto-titulo">
                    <?= $producto['nombre'] ?>
                </h2>

                <!-- REFERENCIA -->
                <p class="referencia">
                    Referencia: <?= $producto['idProducto'] ?>
                </p>


                <!-- PRECIO -->
                <h3 class="precio">
                    $ <?= number_format($producto['preUnitario']) ?>
                </h3>

                <!-- CANTIDAD + BOTON -->
                <div class="d-flex align-items-center gap-3 mt-3 flex-wrap">

                    <!-- CONTADOR -->
                    <div class="contador">

                        <button onclick="cambiarCantidad(-1)">−</button>

                        <input type="text" id="cantidad" value="1">

                        <button onclick="cambiarCantidad(1)">+</button>

                    </div>

                    <!-- AGREGAR -->
                    <a href="index.php?action=agregarCarrito&id=<?= $producto['idProducto'] ?>"
                       class="btn-agregar">

                        🛒 AGREGAR
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>
