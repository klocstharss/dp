function validar_form(tipo) {
    let codigo = document.getElementById("codigo").value;
    let nombre = document.getElementById("nombre").value;
    let detalle = document.getElementById("detalle").value;
    let precio = document.getElementById("precio").value;
    let stock = document.getElementById("stock").value;
    let id_categoria = document.getElementById("id_categoria").value;
    let fecha_vencimiento = document.getElementById("fecha_vencimiento").value;
    let id_proveedor = document.getElementById("id_proveedor").value;

    // Validación para nuevo producto (requiere imagen)
    if (tipo == "nuevo") {
        let imagen = document.getElementById("imagen").value;
        if (codigo == "" || nombre == "" || detalle == "" || precio == "" || stock == "" || id_categoria == "" || fecha_vencimiento == "" || id_proveedor == "" || imagen == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Campos vacíos',
                text: 'Por favor, complete todos los campos requeridos',
                confirmButtonText: 'Entendido'
            });
            return;
        }
    } 
    // Validación para edición (no requiere imagen)
    else if (tipo == "actualizar") {
        if (codigo == "" || nombre == "" || detalle == "" || precio == "" || stock == "" || id_categoria == "" || fecha_vencimiento == "" || id_proveedor == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Campos vacíos',
                text: 'Por favor, complete todos los campos requeridos',
                confirmButtonText: 'Entendido'
            });
            return;
        }
    }
    if (tipo == "nuevo") {
        registrarProducto();
    }
    if (tipo == "actualizar") {
        actualizarProducto();
    }
}

if (document.querySelector('#frm_product')) {
    //evita que se envie el formulario
    let frm_product = document.querySelector('#frm_product');
    frm_product.onsubmit = function (e) {
        e.preventDefault();
        validar_form("nuevo");
    }
}

async function registrarProducto() {
    try {
        const frm_product = document.querySelector("#frm_product");
        const datos = new FormData(frm_product);
        let respuesta = await fetch(base_url + 'control/ProductosController.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        let json = await respuesta.json();
        if (json.status) {
            Swal.fire({
                icon: "success",
                title: "Éxito",
                text: json.msg
            });
            document.getElementById('frm_product').reset();
        } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: json.msg
            });
        }
    } catch (error) {
        console.log("Error al registrar producto: " + error);
    }
}

function cancelar() {
    Swal.fire({
        icon: "warning",
        title: "¿Estás seguro?",
        text: "Se cancelará el registro",
        showCancelButton: true,
        confirmButtonText: "Sí, cancelar",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = base_url + "?view=new-producto";
        }
    });
}

async function view_producto() {
    try {
        let respuesta = await fetch(base_url + 'control/ProductosController.php?tipo=mostrar_productos', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });
        if (!respuesta.ok) {
            throw new Error(`HTTP error! status: ${respuesta.status}`);
        }

        let json = await respuesta.json();

        if (json.status && json.data && json.data.length > 0) {
            let html = '';
            json.data.forEach((producto, index) => {
                let imagenHtml = '';
                if (producto.imagen) {
                    imagenHtml = `<img src="${base_url}${producto.imagen}" alt="${producto.nombre}" class="product-image">`;
                } else {
                    imagenHtml = '<div class="no-image"><i class="bi bi-image"></i></div>';
                }

                const precioFormateado = producto.precio ? `S/ ${parseFloat(producto.precio).toFixed(2)}` : 'N/A';

                let stockClass = 'stock-high';
                let stockText = producto.stock || 0;
                if (stockText <= 10) stockClass = 'stock-low';
                else if (stockText <= 50) stockClass = 'stock-medium';

                const categoriaHtml = producto.categoria ? `<span class="category-badge">${producto.categoria}</span>` : '';
                const proveedorHtml = producto.proveedor ? `<span class="supplier-badge">${producto.proveedor}</span>` : '';

                let fechaVencimientoHtml = '';
                if (producto.fecha_vencimiento) {
                    const fechaVenc = new Date(producto.fecha_vencimiento);
                    const hoy = new Date();
                    const diasRestantes = Math.ceil((fechaVenc - hoy) / (1000 * 60 * 60 * 24));

                    let fechaClass = '';
                    if (diasRestantes <= 30) fechaClass = 'expiry-warning';

                    fechaVencimientoHtml = `<span class="${fechaClass}">${producto.fecha_vencimiento}</span>`;
                } else {
                    fechaVencimientoHtml = '<span class="text-muted">N/A</span>';
                }

                html += `<tr>
                        <td class="text-center fw-bold">${index + 1}</td>
                        <td class="text-center">${imagenHtml}</td>
                        <td class="fw-semibold">${producto.codigo || ''}</td>
                        <td>${producto.nombre || ''}</td>
                        <td class="text-end"><span class="price-badge">${precioFormateado}</span></td>
                        <td class="text-center"><span class="stock-badge ${stockClass}">${stockText}</span></td>
                        <td>${categoriaHtml}</td>
                        <td>${proveedorHtml}</td>
                        <td class="text-center expiry-date">${fechaVencimientoHtml}</td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <a href="${base_url}productos-edit/${producto.id}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button onclick="eliminar(${producto.id})" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>`;
            });
            document.getElementById('content_productos').innerHTML = html;
        } else {
            document.getElementById('content_productos').innerHTML = '<tr><td colspan="10" class="text-center py-4"><div class="text-muted"><i class="bi bi-inbox fs-1 d-block mb-2"></i>No hay productos disponibles</div></td></tr>';
        }
    } catch (error) {
        console.error("Error al cargar productos:", error);
        document.getElementById('content_productos').innerHTML = '<tr><td colspan="10" class="text-center py-4"><div class="text-danger"><i class="bi bi-exclamation-triangle fs-1 d-block mb-2"></i>Error al cargar los productos</div></td></tr>';
    }
}

if (document.getElementById('content_productos')) {
    view_producto();
}

async function edit_producto() {
    try {
        let id_producto = document.getElementById('id_producto').value;
        const datos = new FormData();
        datos.append('id_producto', id_producto);

        let respuesta = await fetch(base_url + 'control/ProductosController.php?tipo=ver', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (!json.status) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: json.msg
            });
            return;
        }

        // Cargar datos del producto en el formulario
        document.getElementById('codigo').value = json.data.codigo;
        document.getElementById('nombre').value = json.data.nombre;
        document.getElementById('detalle').value = json.data.detalle;
        document.getElementById('precio').value = json.data.precio;
        document.getElementById('stock').value = json.data.stock;
        document.getElementById('id_categoria').value = json.data.id_categoria;
        document.getElementById('fecha_vencimiento').value = json.data.fecha_vencimiento;
        document.getElementById('id_proveedor').value = json.data.id_proveedor;

        // Mostrar imagen actual si existe
        if (json.data.imagen) {
            const currentImageContainer = document.getElementById('current-image-container');
            const currentImage = document.getElementById('current-image');

            if (currentImageContainer && currentImage) {
                currentImage.src = base_url + json.data.imagen;
                currentImageContainer.style.display = 'block';
            }
        }

    } catch (error) {
        console.log('oops, ocurrio un error' + error);
    }
}

if (document.querySelector("#frm_edit_producto")) {
    let frm_edit_producto = document.querySelector("#frm_edit_producto");
    frm_edit_producto.onsubmit = function (e) {
        e.preventDefault();
        validar_form("actualizar");
    }
}

async function actualizarProducto() {
    const frm_edit_producto = document.querySelector("#frm_edit_producto")
    const datos = new FormData(frm_edit_producto);
    
    // Verificar si se ha seleccionado una nueva imagen
    const imagenInput = document.getElementById("imagen");
    if (imagenInput.files.length === 0) {
        // Si no se seleccionó una imagen, obtener la imagen actual del producto
        const id_producto = document.getElementById("id_producto").value;
        try {
            const tempDatos = new FormData();
            tempDatos.append("id_producto", id_producto);
            
            const respuestaImagen = await fetch(base_url + 'control/ProductosController.php?tipo=ver', {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                body: tempDatos
            });
            
            const jsonImagen = await respuestaImagen.json();
            if (jsonImagen.status && jsonImagen.data.imagen) {
                // Agregar la imagen actual al FormData para conservarla
                datos.append("imagen_actual", jsonImagen.data.imagen);
            }
        } catch (error) {
            console.error("Error al obtener la imagen actual:", error);
        }
    }
    
    let respuesta = await fetch(base_url + 'control/ProductosController.php?tipo=actualizar', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    });
    json = await respuesta.json();
    if (!json.status) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Ops, ocurrio un error al actualizar, contacte con el administrador",
        });
        console.log(json.msg);
        return;
    } else {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: json.msg,
            showConfirmButton: true,
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // Recargar la página para mostrar los cambios
                location.reload();
            }
        });
    }
}

async function eliminar(id) {
    Swal.fire({
        icon: "warning",
        title: "¿Estás seguro?",
        text: "Esta acción no se puede revertir",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6"
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const datos = new FormData();
                datos.append('id_producto', id)
                let respuesta = await fetch(base_url + 'control/ProductosController.php?tipo=eliminar', {
                    method: 'POST',
                    mode: 'cors',
                    cache: 'no-cache',
                    body: datos
                });
                json = await respuesta.json();
                if (json.status) {
                    Swal.fire({
                        icon: "success",
                        title: "Eliminado",
                        text: json.msg
                    }).then(() => {
                        view_producto();
                    });

                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: json.msg
                    });
                }

            } catch (error) {
                console.log('oops, ocurrio un error' + error);
            }
        }
    });
}

async function cargar_categorias() {
    let respuesta = await fetch(base_url + 'control/CategoriaController.php?tipo=mostrar_categorias', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache'
    });
    let json = await respuesta.json();
    let contenido = '';
    if (json && json.length > 0) {
        contenido += '<option value="">Seleccione una categoria</option>';
        json.forEach(categoria => {
            contenido += '<option value="' + categoria.id + '">' + categoria.nombre + '</option>';
        });
    } else {
        contenido = '<option value = ""> No hay categorias disponibles</option>';
    }
    //console.log(contenido);
    document.getElementById("id_categoria").innerHTML = contenido;

}

async function cargar_proveedores() {
    let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=mostrar_proveedores', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache'
    });
    json = await respuesta.json();
    let contenido = '';
    if (json.status && json.data) {
        contenido += '<option value="">Seleccione un proveedor</option>';
        json.data.forEach(proveedor => {
            contenido += '<option value="' + proveedor.id + '">' + proveedor.razon_social + '</option>';
        });
    } else {
        contenido = '<option value = ""> No hay proveedores disponibles</option>';
    }
    //console.log(contenido);
    document.getElementById("id_proveedor").innerHTML = contenido;

}
