document.addEventListener("DOMContentLoaded", function() {
    // Cargar todos los productos al inicio
    cargarProductosVenta();

    // Configurar el evento de búsqueda
    document.getElementById("btnBuscarProducto").addEventListener("click", function() {
        const dato = document.getElementById("txtBuscarProducto").value;
        if (dato.trim() === "") {
            cargarProductosVenta();
        } else {
            buscarProductosVenta(dato);
        }
    });

    // También buscar cuando se presiona Enter en el campo de texto
    document.getElementById("txtBuscarProducto").addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
            const dato = this.value;
            if (dato.trim() === "") {
                cargarProductosVenta();
            } else {
                buscarProductosVenta(dato);
            }
        }
    });
});

// Función para cargar todos los productos
async function cargarProductosVenta() {
    try {
        console.log("Cargando productos desde:", base_url + 'control/ProductosController.php?tipo=mostrar_productos');
        
        let respuesta = await fetch(base_url + 'control/ProductosController.php?tipo=mostrar_productos', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });

        console.log("Respuesta del servidor:", respuesta);
        let json = await respuesta.json();
        console.log("Datos JSON:", json);
        const container = document.getElementById('productos_venta');
        container.innerHTML = '';

        if (json.status && json.data && json.data.length > 0) {
            json.data.forEach(producto => {
                crearTarjetaProducto(producto);
            });
        } else {
            container.innerHTML = `<div class="col-12 text-center py-5">
                <div class="text-muted">
                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                    No hay productos disponibles
                </div>
            </div>`;
        }
    } catch (error) {
        console.error("Error al cargar productos:", error);
        console.error("Error detallado:", error.message);
        console.error("Stack trace:", error.stack);
        const container = document.getElementById('productos_venta');
        container.innerHTML = `<div class="col-12 text-center py-5">
            <div class="text-danger">
                <i class="bi bi-exclamation-triangle fs-1 d-block mb-2"></i>
                Error al cargar los productos: ${error.message}
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" onclick="cargarProductosVenta()">Reintentar</button>
            </div>
        </div>`;
    }
}

// Función para buscar productos
async function buscarProductosVenta(dato) {
    try {
        const datos = new FormData();
        datos.append('dato', dato);

        let respuesta = await fetch(base_url + 'control/ProductosController.php?tipo=buscar_productos_venta', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json = await respuesta.json();
        const container = document.getElementById('productos_venta');
        container.innerHTML = '';

        if (json.status && json.data && json.data.length > 0) {
            json.data.forEach(producto => {
                crearTarjetaProducto(producto);
            });
        } else {
            container.innerHTML = `<div class="col-12 text-center py-5">
                <div class="text-muted">
                    <i class="bi bi-search fs-1 d-block mb-2"></i>
                    No se encontraron productos para "${dato}"
                </div>
            </div>`;
        }
    } catch (error) {
        console.error("Error al buscar productos:", error);
        const container = document.getElementById('productos_venta');
        container.innerHTML = `<div class="col-12 text-center py-5">
            <div class="text-danger">
                <i class="bi bi-exclamation-triangle fs-1 d-block mb-2"></i>
                Error al buscar productos
            </div>
        </div>`;
    }
}

// Función para crear la tarjeta de producto
function crearTarjetaProducto(producto) {
    const container = document.getElementById('productos_venta');

    const col = document.createElement('div');
    col.className = 'col-md-3 mb-3';

    const card = document.createElement('div');
    card.className = 'card h-100';

    // Imagen del producto
    const imageContainer = document.createElement('div');
    imageContainer.className = 'card-img-top';
    imageContainer.style.height = '180px';
    imageContainer.style.overflow = 'hidden';
    imageContainer.style.backgroundColor = '#f8f9fa';

    if (producto.imagen) {
        const img = document.createElement('img');
        img.src = base_url + producto.imagen;
        img.alt = producto.nombre;
        img.className = 'img-fluid h-100';
        img.style.objectFit = 'cover';
        imageContainer.appendChild(img);
    } else {
        const noImageDiv = document.createElement('div');
        noImageDiv.className = 'd-flex align-items-center justify-content-center h-100';
        noImageDiv.innerHTML = '<i class="bi bi-image fs-1 text-muted"></i>';
        imageContainer.appendChild(noImageDiv);
    }

    card.appendChild(imageContainer);

    // Cuerpo de la tarjeta
    const cardBody = document.createElement('div');
    cardBody.className = 'card-body d-flex flex-column';

    // Nombre del producto
    const title = document.createElement('h5');
    title.className = 'card-title';
    title.textContent = producto.nombre;
    cardBody.appendChild(title);

    // Descripción
    const description = document.createElement('p');
    description.className = 'card-text text-muted small';
    description.textContent = producto.detalle ? (producto.detalle.length > 50 ? producto.detalle.substring(0, 50) + '...' : producto.detalle) : 'Sin descripción';
    cardBody.appendChild(description);

    // Precio
    const price = document.createElement('h4');
    price.className = 'card-text text-primary';
    price.textContent = 'S/ ' + parseFloat(producto.precio).toFixed(2);
    cardBody.appendChild(price);

    // Stock
    const stock = document.createElement('p');
    stock.className = 'card-text small';
    stock.innerHTML = `Stock: <span class="badge ${producto.stock > 10 ? 'bg-success' : 'bg-danger'}">${producto.stock}</span>`;
    cardBody.appendChild(stock);

    // Categoría
    const category = document.createElement('p');
    category.className = 'card-text small';
    category.innerHTML = `Categoría: <span class="badge bg-info text-dark">${producto.categoria || 'Sin categoría'}</span>`;
    cardBody.appendChild(category);

    // Botón
    const buttonContainer = document.createElement('div');
    buttonContainer.className = 'mt-auto';

    const button = document.createElement('button');
    button.className = 'btn btn-primary w-100';
    button.innerHTML = '<i class="bi bi-cart-plus"></i> Agregar';
    button.onclick = function() {
        agregarProductoAlCarrito(producto);
    };

    buttonContainer.appendChild(button);
    cardBody.appendChild(buttonContainer);

    card.appendChild(cardBody);
    col.appendChild(card);
    container.appendChild(col);
}

// Función para agregar producto al carrito
function agregarProductoAlCarrito(producto) {
    // Obtener la tabla del carrito
    const tablaCarrito = document.getElementById('lista_compra');

    // Verificar si el producto ya está en el carrito
    let productoExistente = false;
    const filas = tablaCarrito.getElementsByTagName('tr');

    for (let i = 0; i < filas.length; i++) {
        const celdas = filas[i].getElementsByTagName('td');
        if (celdas.length > 0 && celdas[0].textContent === producto.nombre) {
            // El producto ya está en el carrito, aumentar cantidad
            const celdaCantidad = celdas[1];
            const cantidadActual = parseInt(celdaCantidad.textContent);
            const inputCantidad = celdaCantidad.querySelector('input');

            if (inputCantidad) {
                inputCantidad.value = cantidadActual + 1;
            } else {
                celdaCantidad.textContent = cantidadActual + 1;
            }

            // Actualizar total
            const celdaTotal = celdas[3];
            const precio = parseFloat(producto.precio);
            const nuevaCantidad = cantidadActual + 1;
            celdaTotal.textContent = 'S/ ' + (precio * nuevaCantidad).toFixed(2);

            productoExistente = true;
            break;
        }
    }

    if (!productoExistente) {
        // El producto no está en el carrito, agregarlo
        const fila = document.createElement('tr');

        // Nombre del producto
        const celdaNombre = document.createElement('td');
        celdaNombre.textContent = producto.nombre;
        fila.appendChild(celdaNombre);

        // Cantidad
        const celdaCantidad = document.createElement('td');
        celdaCantidad.textContent = '1';
        fila.appendChild(celdaCantidad);

        // Precio
        const celdaPrecio = document.createElement('td');
        celdaPrecio.textContent = 'S/ ' + parseFloat(producto.precio).toFixed(2);
        fila.appendChild(celdaPrecio);

        // Total
        const celdaTotal = document.createElement('td');
        celdaTotal.textContent = 'S/ ' + parseFloat(producto.precio).toFixed(2);
        fila.appendChild(celdaTotal);

        // Acciones
        const celdaAcciones = document.createElement('td');
        const botonEliminar = document.createElement('button');
        botonEliminar.className = 'btn btn-danger btn-sm';
        botonEliminar.innerHTML = '<i class="bi bi-trash"></i>';
        botonEliminar.onclick = function() {
            fila.remove();
            actualizarTotales();
        };
        celdaAcciones.appendChild(botonEliminar);
        fila.appendChild(celdaAcciones);

        tablaCarrito.appendChild(fila);
    }

    // Actualizar totales
    actualizarTotales();

    // Mostrar mensaje de éxito
    Swal.fire({
        icon: 'success',
        title: 'Producto agregado',
        text: 'El producto ha sido agregado al carrito correctamente',
        timer: 1500,
        showConfirmButton: false
    });
}

// Función para actualizar los totales del carrito
function actualizarTotales() {
    const filas = document.getElementById('lista_compra').getElementsByTagName('tr');
    let subtotal = 0;

    for (let i = 0; i < filas.length; i++) {
        const celdas = filas[i].getElementsByTagName('td');
        if (celdas.length > 3) {
            const textoTotal = celdas[3].textContent;
            const valorTotal = parseFloat(textoTotal.replace('S/ ', ''));
            subtotal += valorTotal;
        }
    }

    const igv = subtotal * 0.18;
    const total = subtotal + igv;

    // Actualizar los valores en la vista
    const labelsSubtotal = document.querySelectorAll('label');
    if (labelsSubtotal.length >= 3) {
        labelsSubtotal[0].textContent = 'S/ ' + subtotal.toFixed(2);
        labelsSubtotal[1].textContent = 'S/ ' + igv.toFixed(2);
        labelsSubtotal[2].textContent = 'S/ ' + total.toFixed(2);
    }
}