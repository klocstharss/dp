// Función para mostrar productos en el contenedor de ejemplo
async function mostrar_productos_ejemplo() {
    try {
        let dato = document.getElementById('busqueda_venta').value;
        const datos = new FormData();
        datos.append('dato', dato);

        let respuesta = await fetch(base_url + 'control/ProductosController.php?tipo=buscar_productos_venta', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        if (!respuesta.ok) {
            throw new Error(`HTTP error! status: ${respuesta.status}`);
        }

        let json = await respuesta.json();
        const container = document.getElementById('productos_venta');
        container.innerHTML = '';
        if (json.status && json.data && json.data.length > 0) {
            let html = '';
            json.data.forEach((producto) => {
                let imagenHtml = '';  
                if (producto.imagen) {
                    imagenHtml = `<img src="${base_url}${producto.imagen}" alt="${producto.nombre}" class="card-img-top">`;
                } else {
                    imagenHtml = '<div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 200px;"><i class="bi bi-image fs-1 text-muted"></i></div>';
                }

                const precioFormateado = producto.precio ? `S/ ${parseFloat(producto.precio).toFixed(2)}` : 'N/A';
                const categoriaHtml = producto.categoria ? producto.categoria : 'Sin categoría';
                const proveedorHtml = producto.proveedor ? producto.proveedor : 'Sin proveedor';

                html += `
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <div class="position-relative overflow-hidden" style="height: 200px;">
                            ${imagenHtml}
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-danger">Nuevo</span>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-truncate" style="min-height: 24px;">${producto.nombre || ''}</h5>
                            <p class="card-text text-muted small mb-2" style="min-height: 40px;">${producto.detalle ? producto.detalle.substring(0, 80) + '...' : ''}</p>

                            <div class="mb-3">
                                <span class="badge bg-success fs-6">${precioFormateado}</span>
                            </div>

                            <div class="mb-3">
                                <span class="badge bg-secondary me-1">${categoriaHtml}</span>
                                <span class="badge bg-info">${proveedorHtml}</span>
                            </div>

                            <div class="mt-auto">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <button onclick="verDetalles(${producto.id})" class="btn btn-outline-primary btn-sm w-100">
                                            <i class="bi bi-eye"></i> Ver
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button onclick="agregarCarrito(${producto.id})" class="btn btn-success btn-sm w-100">
                                            <i class="bi bi-cart-plus"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
            });
            container.innerHTML = html;
        } else {
            container.innerHTML = '<div class="text-center py-5"><div class="text-muted"><i class="bi bi-inbox fs-1 d-block mb-2"></i>No hay productos disponibles</div></div>';
        }
    } catch (error) {
        console.error("Error al cargar productos:", error);
        container.innerHTML = '<div class="text-center py-5"><div class="text-danger"><i class="bi bi-exclamation-triangle fs-1 d-block mb-2"></i>Error al cargar los productos</div></div>';
    }
}

// Cargar productos al inicio
document.addEventListener('DOMContentLoaded', function () {
    mostrar_productos_ejemplo();
});

let productos_venta = {};
let id = 2;
let id2 = 3;
let producto = {};
producto.nombre = "Producto de ejemplo";
producto.precio = 100;
producto.cantidad = 1;


let producto2 = {};
producto2.nombre = "Otro producto de ejemplo";
producto2.precio = 50;
producto2.cantidad = 2;
// productos_venta.push(producto);
productos_venta[id2] = producto2;
productos_venta[id] = producto;


console.log(productos_venta);

async function agregar_producto_temporal() {
    let id= document.getElementById('id_producto_venta').value;
    let precio= document.getElementById('producto_precio_venta').value;
    let cantidad= document.getElementById('producto_cantidad_venta').value;
     const datos = new FormData();
     datos.append('id_producto',id);
     datos.append('precio',precio);
     datos.append('cantidad',cantidad);
     try {
        let respuesta = await fetch(base_url + 'control/VentaController.php?tipo=registrarTemporal', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    });
    json = await respuesta.json();
    if(json.status){
        if (json.msj =="registrado") {
            alert("producto registrado")
        }else{
            alert("producto  actualizado")
        }
    }
     } catch (error) {
        console.log("error en agregar producto temporal "+error);
     }
}