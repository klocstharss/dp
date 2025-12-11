// Variable global para almacenar el carrito
let carrito = {};

// Función para buscar productos
async function buscarProductosVenta(valor) {
    try {
        const datos = new FormData();
        datos.append('dato', valor);

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
                const precioFormateado = producto.precio ? parseFloat(producto.precio).toFixed(2) : 'N/A';
                
                html += `
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="product-item">
                        <h5>${producto.nombre}</h5>
                        <p><strong>Código:</strong> ${producto.codigo || 'N/A'}</p>
                        <p><strong>Precio:</strong> S/ ${precioFormateado}</p>
                        <p><strong>Stock:</strong> ${producto.cantidad || 0}</p>
                        <div class="input-group mb-2" style="width: 150px;">
                            <button class="btn btn-outline-secondary btn-sm" type="button" onclick="decrementarCantidad('cantidad_${producto.id}')">-</button>
                            <input type="number" class="form-control text-center" id="cantidad_${producto.id}" value="1" min="1" max="${producto.cantidad || 1}">
                            <button class="btn btn-outline-secondary btn-sm" type="button" onclick="incrementarCantidad('cantidad_${producto.id}', ${producto.cantidad || 1})">+</button>
                        </div>
                        <button class="btn btn-primary btn-sm" onclick="agregarAlCarrito(${producto.id}, '${producto.nombre}', ${producto.precio}, 'cantidad_${producto.id}')">
                            Agregar al carrito
                        </button>
                    </div>
                </div>`;
            });
            container.innerHTML = html;
        } else {
            container.innerHTML = '<div class="col-12"><p class="text-muted">No se encontraron productos</p></div>';
        }
    } catch (error) {
        console.error("Error al buscar productos:", error);
    }
}

// Función para incrementar cantidad
function incrementarCantidad(elementId, maxCantidad) {
    const input = document.getElementById(elementId);
    const valor = parseInt(input.value) || 1;
    if (valor < maxCantidad) {
        input.value = valor + 1;
    }
}

// Función para decrementar cantidad
function decrementarCantidad(elementId) {
    const input = document.getElementById(elementId);
    const valor = parseInt(input.value) || 1;
    if (valor > 1) {
        input.value = valor - 1;
    }
}

// Función para agregar producto al carrito
function agregarAlCarrito(idProducto, nombre, precio, cantidadElementId) {
    const cantidadInput = document.getElementById(cantidadElementId);
    const cantidad = parseInt(cantidadInput.value) || 1;
    
    if (cantidad <= 0) {
        alert('Ingrese una cantidad válida');
        return;
    }

    // Usar el ID del producto como clave
    const keyProducto = `producto_${idProducto}`;
    
    if (carrito[keyProducto]) {
        // Si ya existe el producto, aumentar la cantidad
        carrito[keyProducto].cantidad += cantidad;
    } else {
        // Crear nuevo item con el ID del producto como clave
        carrito[keyProducto] = {
            idProducto: idProducto,
            nombre: nombre,
            precio: parseFloat(precio),
            cantidad: cantidad,
            total: parseFloat(precio) * cantidad
        };
    }

    // Actualizar la tabla del carrito
    actualizarTablaCarrito();
    
    // Limpiar input
    cantidadInput.value = 1;
    
    alert(`${nombre} agregado al carrito`);
}

// Función para actualizar la tabla del carrito
function actualizarTablaCarrito() {
    const tbody = document.getElementById('lista_compra');
    let html = '';
    let subtotal = 0;

    for (let key in carrito) {
        if (carrito.hasOwnProperty(key)) {
            const item = carrito[key];
            const totalItem = item.precio * item.cantidad;
            subtotal += totalItem;

            html += `
            <tr>
                <td>${item.nombre}</td>
                <td>
                    <input type="number" class="form-control form-control-sm" value="${item.cantidad}" 
                           onchange="actualizarCantidadCarrito('${key}', this.value)" min="1" style="width: 60px;">
                </td>
                <td>S/ ${item.precio.toFixed(2)}</td>
                <td>S/ ${totalItem.toFixed(2)}</td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="eliminarDelCarrito('${key}')">
                        Eliminar
                    </button>
                </td>
            </tr>`;
        }
    }

    tbody.innerHTML = html || '<tr><td colspan="5" class="text-center text-muted">El carrito está vacío</td></tr>';

    // Calcular y mostrar totales
    calcularTotales(subtotal);
}

// Función para actualizar cantidad en el carrito
function actualizarCantidadCarrito(key, nuevaCantidad) {
    const cantidad = parseInt(nuevaCantidad) || 1;
    
    if (cantidad <= 0) {
        eliminarDelCarrito(key);
        return;
    }

    carrito[key].cantidad = cantidad;
    carrito[key].total = carrito[key].precio * cantidad;
    actualizarTablaCarrito();
}

// Función para eliminar del carrito
function eliminarDelCarrito(key) {
    delete carrito[key];
    actualizarTablaCarrito();
}

// Función para calcular y mostrar totales
function calcularTotales(subtotal) {
    const IGV_PORCENTAJE = 0.18; // 18% para Perú
    const igv = subtotal * IGV_PORCENTAJE;
    const total = subtotal + igv;

    // Actualizar etiquetas
    document.querySelectorAll('[id="subtotal_label"]')[0].textContent = `S/ ${subtotal.toFixed(2)}`;
    document.querySelectorAll('[id="igv_label"]')[0].textContent = `S/ ${igv.toFixed(2)}`;
    document.querySelectorAll('[id="total_label"]')[0].textContent = `S/ ${total.toFixed(2)}`;
}

// Función para realizar la venta
async function realizarVenta() {
    if (Object.keys(carrito).length === 0) {
        alert('El carrito está vacío');
        return;
    }

    try {
        const datos = new FormData();
        datos.append('carrito', JSON.stringify(carrito));

        let respuesta = await fetch(base_url + 'control/VentaController.php?tipo=registrar_venta', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        if (!respuesta.ok) {
            throw new Error(`HTTP error! status: ${respuesta.status}`);
        }

        let json = await respuesta.json();
        if (json.status) {
            alert('Venta registrada exitosamente');
            carrito = {};
            contadorCarrito = 0;
            actualizarTablaCarrito();
        } else {
            alert('Error al registrar la venta: ' + (json.msj || 'Error desconocido'));
        }
    } catch (error) {
        console.error("Error al realizar venta:", error);
        alert('Error al procesar la venta');
    }
}

// Inicializar
document.addEventListener('DOMContentLoaded', function () {
    buscarProductosVenta('');
});
