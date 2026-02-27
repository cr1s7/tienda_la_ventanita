// =============================
// 🔴 PUNTO ROJO NAVBAR
// =============================
function actualizarPunto(cantidad){

    let punto = document.getElementById("punto-carrito");
    if(!punto) return;

    if(cantidad > 0){
        punto.classList.remove("d-none");
    }else{
        punto.classList.add("d-none");
    }
}

// =============================
// TOAST GLOBAL
// =============================
function mostrarToast(msg,tipo="ok"){

    let toast=document.createElement("div");

    toast.className=
        "toast-carrito "+
        (tipo==="error"
            ?"toast-error"
            :"toast-ok");

    toast.innerText=msg;

    document.body.appendChild(toast);

    setTimeout(()=>toast.remove(),3000);
}

// =============================
// AGREGAR DESDE PRODUCTOS
// =============================
function agregarCarritoAJAX(id){

    fetch(
        BASE_URL + "index.php?action=agregarCarritoAjax",
        {
            method:"POST",
            headers:{
                "Content-Type":"application/x-www-form-urlencoded"
            },
            body:`idProducto=${id}&cantidad=1`
        }
    )
    .then(r=>r.json())
    .then(data=>{

        if(data.error){
            mostrarToast(data.error,"error");
            return;
        }

        mostrarToast(data.mensaje);
        actualizarPunto(data.cantidad);

        // 🔥 si estamos en vista carrito lo recarga
        if(document.getElementById("contenedorCarrito")){
            cargarCarrito();
        }
    });
}

// =============================
// CONTAR AL CARGAR
// =============================
function contarItems(){
    fetch(BASE_URL + "index.php?action=contarItemsAjax")
    .then(r=>r.json())
    .then(data=>{
        actualizarPunto(data.cantidad);
    });
}

// =============================
// CARGAR CARRITO VISTA COMPLETA
// =============================
function cargarCarrito(){

    let contenedor = document.getElementById("contenedorCarrito");
    let total = document.getElementById("totalCarrito");

    if(!contenedor){
        console.log("No existe contenedorCarrito");
        return;
    }

    fetch(BASE_URL + "index.php?action=obtenerCarritoAjax")
    .then(res => res.json())
    .then(data => {

        let html = "";

        if(data.items && data.items.length > 0){

            data.items.forEach(p => {

                let subtotal = p.cantidad * p.precio;

                html += `
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">

                            <img src="${BASE_URL}uploads/${p.imagen ?? 'default.png'}"
                                 class="me-3 rounded"
                                 width="120">

                            <div class="flex-grow-1">
                                <h6>${p.nombre}</h6>

                                <div class="d-flex align-items-center">

                                    <button class="btn btn-sm btn-outline-secondary"
                                            onclick="restar(${p.idProducto})">−</button>

                                    <span class="mx-3">
                                        ${p.cantidad}
                                    </span>

                                    <button class="btn btn-sm btn-outline-secondary"
                                            onclick="sumar(${p.idProducto})">+</button>

                                    <button class="btn btn-sm btn-outline-danger ms-3"
                                            onclick="eliminar(${p.idProducto})">
                                        Eliminar
                                    </button>

                                </div>
                            </div>

                            <div class="text-end">
                                <h5 class="fw-bold">
                                    $ ${subtotal.toLocaleString()}
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
                `;
            });

        } else {

            html = `
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="text-muted">
                        🛒 Tu carrito está vacío
                    </h5>
                </div>
            </div>
            `;
        }

        contenedor.innerHTML = html;

        if(total){
            total.innerHTML = "$ " + data.total.toLocaleString();
        }

    })
    .catch(error => console.log("Error cargarCarrito:", error));
}

function sumar(id){
    fetch(BASE_URL + "index.php?action=sumarAjax", {
        method:"POST",
        headers:{ "Content-Type":"application/x-www-form-urlencoded" },
        body:"idProducto="+id
    })
    .then(r => r.json())
    .then(data => {
        if(data.ok){
            cargarCarrito();
            actualizarPunto(data.cantidad);
        }else{
            mostrarToast("Error al sumar","error");
        }
    });
}

function restar(id){
    fetch(BASE_URL + "index.php?action=restarAjax", {
        method:"POST",
        headers:{ "Content-Type":"application/x-www-form-urlencoded" },
        body:"idProducto="+id
    })
    .then(r => r.json())
    .then(data => {
        if(data.ok){
            cargarCarrito();
            actualizarPunto(data.cantidad);
        }else{
            mostrarToast("Error al restar","error");
        }
    });
}

function eliminar(id){
    fetch(BASE_URL + "index.php?action=eliminarAjax", {
        method:"POST",
        headers:{ "Content-Type":"application/x-www-form-urlencoded" },
        body:"idProducto="+id
    })
    .then(r => r.json())
    .then(data => {
        if(data.ok){
            cargarCarrito();
            actualizarPunto(data.cantidad);
        }else{
            mostrarToast("Error al eliminar","error");
        }
    });
}

// =============================
// INIT
// =============================
document.addEventListener(
    "DOMContentLoaded",
    ()=>contarItems()
);
