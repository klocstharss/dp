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
                
                // Verificar si existe imagen, si no mostrar placeholder
                let imagenHtml = '';
                if (producto.imagen) {
                    imagenHtml = `<img src="${base_url}${producto.imagen}" alt="${producto.nombre}" class="tarjetaProductoImagen w-100" style="height: 100%; object-fit: cover;">`;
                } else {
                    imagenHtml = '<div class="tarjetaProductoImagen d-flex align-items-center justify-content-center bg-light w-100" style="height: 100%;"><i class="bi bi-image fs-1 text-muted"></i></div>';
                }
                
                html += `
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="tarjetaProducto h-100 shadow-sm border-0" style="border-radius: 10px; overflow: hidden; display: flex; flex-direction: column;">
                        <div style="width: 100%; height: 180px; overflow: hidden; background-color: #f0f0f0;">
                            ${imagenHtml}
                        </div>
                        <div class="card-body d-flex flex-column" style="flex: 1; display: flex; flex-direction: column;">
                            <h5 class="nombreProducto fw-bold text-truncate" style="font-size: 0.95rem; margin-bottom: 0.5rem;">${producto.nombre}</h5>
                            <p class="card-text text-muted small mb-1" style="min-height: 24px; font-size: 0.85rem;">
                                <strong>Código:</strong> ${producto.codigo || 'N/A'}
                            </p>
                            <p class="precioProducto text-success fw-bold" style="font-size: 1.1rem; margin-bottom: 0.5rem;">S/ ${precioFormateado}</p>
                            <p class="card-text small mb-2" style="font-size: 0.85rem;">
                                <strong>Stock:</strong> <span class="badge bg-info">${producto.stock || 0}</span>
                            </p>
                            <div class="mt-auto" style="margin-top: auto;">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <button class="botonVerDetalles btn btn-outline-info btn-sm w-100" style="font-size: 0.8rem; padding: 0.35rem 0.5rem;" onclick="verDetalleProducto(${producto.id}, '${producto.nombre}')">
                                            Ver
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button class="botonAgregarCarrito btn btn-primary btn-sm w-100" style="font-size: 0.8rem; padding: 0.35rem 0.5rem;" onclick="agregarAlCarrito(${producto.id}, '${producto.nombre}', ${producto.precio})">
                                            Agregar
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
            container.innerHTML = '<div class="col-12"><p class="text-muted text-center py-5">No se encontraron productos</p></div>';
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
function agregarAlCarrito(idProducto, nombre, precio) {
    // Usar el ID del producto como clave
    const keyProducto = `producto_${idProducto}`;
    
    if (carrito[keyProducto]) {
        // Si ya existe el producto, aumentar la cantidad
        carrito[keyProducto].cantidad += 1;
    } else {
        // Crear nuevo item con el ID del producto como clave
        carrito[keyProducto] = {
            idProducto: idProducto,
            nombre: nombre,
            precio: parseFloat(precio),
            cantidad: 1,
            total: parseFloat(precio)
        };
    }

    // Actualizar la tabla del carrito
    actualizarTablaCarrito();
    
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
    
    // Agregar evento al input de búsqueda para Enter
    const inputBusqueda = document.getElementById('busqueda_venta');
    if (inputBusqueda) {
        inputBusqueda.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                agregarProductoPorBusqueda();
            }
        });
    }
});

// Función para agregar producto encontrado al presionar Enter
async function agregarProductoPorBusqueda() {
    const valor = document.getElementById('busqueda_venta').value.trim();
    
    if (!valor) {
        alert('Por favor ingresa un código o nombre de producto');
        return;
    }

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
        
        if (json.status && json.data && json.data.length > 0) {
            // Tomar el primer producto encontrado
            const producto = json.data[0];
            
            // Guardar en base de datos (tabla temporal_venta)
            await guardarProductoTemporal(producto.id, producto.precio, 1);
            
            // Agregar al carrito local
            const keyProducto = `producto_${producto.id}`;
            
            if (carrito[keyProducto]) {
                carrito[keyProducto].cantidad += 1;
            } else {
                carrito[keyProducto] = {
                    idProducto: producto.id,
                    nombre: producto.nombre,
                    precio: parseFloat(producto.precio),
                    cantidad: 1,
                    total: parseFloat(producto.precio)
                };
            }

            actualizarTablaCarrito();
            
            // Limpiar búsqueda y mostrar mensaje
            document.getElementById('busqueda_venta').value = '';
            buscarProductosVenta('');
            
            alert(`${producto.nombre} agregado al carrito`);
        } else {
            alert('Producto no encontrado');
        }
    } catch (error) {
        console.error("Error al buscar producto:", error);
        alert('Error al buscar el producto');
    }
}

// Función para guardar producto temporal en la base de datos
async function guardarProductoTemporal(idProducto, precio, cantidad) {
    try {
        const datos = new FormData();
        datos.append('id_producto', idProducto);
        datos.append('precio', precio);
        datos.append('cantidad', cantidad);

        let respuesta = await fetch(base_url + 'control/VentaController.php?tipo=registrarTemporal', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        if (!respuesta.ok) {
            throw new Error(`HTTP error! status: ${respuesta.status}`);
        }

        let json = await respuesta.json();
        if (!json.status) {
            console.error("Error al guardar temporal:", json.msj);
        }
    } catch (error) {
        console.error("Error al guardar producto temporal:", error);
    }
}

// Función para ver detalles del producto
function verDetalleProducto(idProducto, nombreProducto) {
    alert(`Detalles del producto: ${nombreProducto}\n\nID: ${idProducto}\n\nAquí irá la información detallada del producto.`);
}

// Inicializar
document.addEventListener('DOMContentLoaded', function () {
    buscarProductosVenta('');
    
    // Agregar evento al input de búsqueda para Enter
    const inputBusqueda = document.getElementById('busqueda_venta');
    if (inputBusqueda) {
        inputBusqueda.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                agregarProductoPorBusqueda();
            }
        });
    }
});
