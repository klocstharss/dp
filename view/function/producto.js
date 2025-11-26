function validar_form(tipo) {
    let codigo = document.getElementById("codigo").value;
    let nombre = document.getElementById("nombre").value;
    let detalle = document.getElementById("detalle").value;
    let precio = document.getElementById("precio").value;
    let stock = document.getElementById("stock").value;
    let id_categoria = document.getElementById("id_categoria").value;
    let fecha_vencimiento = document.getElementById("fecha_vencimiento").value;
    let codigo_barra = document.getElementById("codigo_barra") ? document.getElementById("codigo_barra").value : "";
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

        const container = document.getElementById('content_productos');
        container.innerHTML = ''; // Limpiar contenido anterior

        if (json.status && json.data && json.data.length > 0) {
            json.data.forEach((producto) => {
                const productCard = document.createElement('div');
                productCard.className = 'product-card';

                const imageContainer = document.createElement('div');
                imageContainer.className = 'product-image-container';
                if (producto.imagen) {
                    const img = document.createElement('img');
                    img.src = base_url + producto.imagen;
                    img.alt = producto.nombre;
                    img.className = 'product-image';
                    imageContainer.appendChild(img);
                } else {
                    const div = document.createElement('div');
                    div.className = 'no-image';
                    const icon = document.createElement('i');
                    icon.className = 'bi bi-image';
                    div.appendChild(icon);
                    imageContainer.appendChild(div);
                }
                productCard.appendChild(imageContainer);

                const productBody = document.createElement('div');
                productBody.className = 'product-body';

                const title = document.createElement('h5');
                title.className = 'product-title';
                title.textContent = producto.nombre || '';
                productBody.appendChild(title);

                const priceContainer = document.createElement('div');
                priceContainer.className = 'price-container';
                const priceBadge = document.createElement('span');
                priceBadge.className = 'price-badge';
                priceBadge.textContent = producto.precio ? `S/ ${parseFloat(producto.precio).toFixed(2)}` : 'N/A';
                priceContainer.appendChild(priceBadge);
                productBody.appendChild(priceContainer);

                const tags = document.createElement('div');
                tags.className = 'product-tags';
                const tag1 = document.createElement('span');
                tag1.className = 'tag';
                tag1.textContent = producto.categoria || 'Sin categoría';
                tags.appendChild(tag1);
                const tag2 = document.createElement('span');
                tag2.className = 'tag';
                tag2.textContent = producto.proveedor || 'Sin proveedor';
                tags.appendChild(tag2);
                productBody.appendChild(tags);

                const actions = document.createElement('div');
                actions.className = 'product-actions';
                const btnDetails = document.createElement('button');
                btnDetails.onclick = () => verDetalles(producto.id);
                btnDetails.className = 'btn btn-primary';
                const iconDetails = document.createElement('i');
                iconDetails.className = 'bi bi-eye';
                btnDetails.appendChild(iconDetails);
                btnDetails.appendChild(document.createTextNode(' Ver más detalles'));
                actions.appendChild(btnDetails);
                const btnCart = document.createElement('button');
                btnCart.onclick = () => agregarCarrito(producto.id);
                btnCart.className = 'btn btn-success';
                const iconCart = document.createElement('i');
                iconCart.className = 'bi bi-cart-plus';
                btnCart.appendChild(iconCart);
                btnCart.appendChild(document.createTextNode(' Agregar al carrito'));
                actions.appendChild(btnCart);
                productBody.appendChild(actions);

                productCard.appendChild(productBody);
                container.appendChild(productCard);
            });
        } else {
            const div = document.createElement('div');
            div.className = 'text-center py-5';
            const mutedDiv = document.createElement('div');
            mutedDiv.className = 'text-muted';
            const icon = document.createElement('i');
            icon.className = 'bi bi-inbox fs-1 d-block mb-2';
            mutedDiv.appendChild(icon);
            mutedDiv.appendChild(document.createTextNode('No hay productos disponibles'));
            div.appendChild(mutedDiv);
            container.appendChild(div);
        }
    } catch (error) {
        console.error("Error al cargar productos:", error);
        const container = document.getElementById('content_productos');
        container.innerHTML = '';
        const tr = document.createElement('tr');
        const td = document.createElement('td');
        td.colSpan = 10;
        td.className = 'text-center py-4';
        const div = document.createElement('div');
        div.className = 'text-danger';
        const icon = document.createElement('i');
        icon.className = 'bi bi-exclamation-triangle fs-1 d-block mb-2';
        div.appendChild(icon);
        div.appendChild(document.createTextNode('Error al cargar los productos'));
        td.appendChild(div);
        tr.appendChild(td);
        container.appendChild(tr);
    }
}

if (document.getElementById('content_productos')) {
    // Determinar si estamos en la vista de tabla o de tarjetas
    const isTableView = document.querySelector('table') !== null;
    
    if (isTableView) {
        view_producto_tabla();
    } else {
        view_producto();
    }
}

async function view_producto_tabla() {
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

        const tbody = document.getElementById('content_productos');
        tbody.innerHTML = ''; // Limpiar contenido anterior

        if (json.status && json.data && json.data.length > 0) {
            json.data.forEach((producto, index) => {
                const tr = document.createElement('tr');

                // Columna #
                const tdIndex = document.createElement('td');
                tdIndex.className = 'text-center fw-bold';
                tdIndex.textContent = index + 1;
                tr.appendChild(tdIndex);

                // Columna Imagen
                const tdImagen = document.createElement('td');
                tdImagen.className = 'text-center';
                if (producto.imagen) {
                    const img = document.createElement('img');
                    img.src = base_url + producto.imagen;
                    img.alt = producto.nombre;
                    img.className = 'product-image';
                    tdImagen.appendChild(img);
                } else {
                    const div = document.createElement('div');
                    div.className = 'no-image';
                    const icon = document.createElement('i');
                    icon.className = 'bi bi-image';
                    div.appendChild(icon);
                    tdImagen.appendChild(div);
                }
                tr.appendChild(tdImagen);

                // Columna Código
                const tdCodigo = document.createElement('td');
                tdCodigo.className = 'fw-semibold';
                tdCodigo.textContent = producto.codigo || '';
                tr.appendChild(tdCodigo);

                // Columna Nombre
                const tdNombre = document.createElement('td');
                tdNombre.textContent = producto.nombre || '';
                tr.appendChild(tdNombre);

                // Columna Precio
                const tdPrecio = document.createElement('td');
                tdPrecio.className = 'text-end';
                const spanPrecio = document.createElement('span');
                spanPrecio.className = 'price-badge';
                spanPrecio.textContent = producto.precio ? `S/ ${parseFloat(producto.precio).toFixed(2)}` : 'N/A';
                tdPrecio.appendChild(spanPrecio);
                tr.appendChild(tdPrecio);

                // Columna Stock
                const tdStock = document.createElement('td');
                tdStock.className = 'text-center';
                const spanStock = document.createElement('span');
                let stockClass = 'stock-high';
                let stockText = producto.stock || 0;
                if (stockText <= 10) stockClass = 'stock-low';
                else if (stockText <= 50) stockClass = 'stock-medium';
                spanStock.className = `stock-badge ${stockClass}`;
                spanStock.textContent = stockText;
                tdStock.appendChild(spanStock);
                tr.appendChild(tdStock);

                // Columna Categoría
                const tdCategoria = document.createElement('td');
                if (producto.categoria) {
                    const spanCat = document.createElement('span');
                    spanCat.className = 'category-badge';
                    spanCat.textContent = producto.categoria;
                    tdCategoria.appendChild(spanCat);
                }
                tr.appendChild(tdCategoria);

                // Columna Proveedor
                const tdProveedor = document.createElement('td');
                if (producto.proveedor) {
                    const spanProv = document.createElement('span');
                    spanProv.className = 'supplier-badge';
                    spanProv.textContent = producto.proveedor;
                    tdProveedor.appendChild(spanProv);
                }
                tr.appendChild(tdProveedor);

                // Columna Vencimiento
                const tdVencimiento = document.createElement('td');
                tdVencimiento.className = 'text-center expiry-date';
                if (producto.fecha_vencimiento) {
                    const fechaVenc = new Date(producto.fecha_vencimiento);
                    const hoy = new Date();
                    const diasRestantes = Math.ceil((fechaVenc - hoy) / (1000 * 60 * 60 * 24));
                    let fechaClass = '';
                    if (diasRestantes <= 30) fechaClass = 'expiry-warning';
                    const spanFecha = document.createElement('span');
                    spanFecha.className = fechaClass;
                    spanFecha.textContent = producto.fecha_vencimiento;
                    tdVencimiento.appendChild(spanFecha);
                } else {
                    const spanNA = document.createElement('span');
                    spanNA.className = 'text-muted';
                    spanNA.textContent = 'N/A';
                    tdVencimiento.appendChild(spanNA);
                }
                tr.appendChild(tdVencimiento);

                // Columna Código de Barra
                const tdBarcode = document.createElement('td');
                tdBarcode.className = 'text-center';
                tdBarcode.style.backgroundColor = 'white';
                const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                svg.id = `barcode${producto.id}`;
                tdBarcode.appendChild(svg);
                tr.appendChild(tdBarcode);

                // Columna Acciones
                const tdAcciones = document.createElement('td');
                tdAcciones.className = 'text-center';
                const divActions = document.createElement('div');
                divActions.className = 'action-buttons';
                const aEdit = document.createElement('a');
                aEdit.href = base_url + 'productos-edit/' + producto.id;
                aEdit.className = 'btn btn-primary btn-sm';
                const iconEdit = document.createElement('i');
                iconEdit.className = 'bi bi-pencil';
                aEdit.appendChild(iconEdit);
                divActions.appendChild(aEdit);
                const btnDelete = document.createElement('button');
                btnDelete.onclick = () => eliminar(producto.id);
                btnDelete.className = 'btn btn-danger btn-sm';
                const iconDelete = document.createElement('i');
                iconDelete.className = 'bi bi-trash';
                btnDelete.appendChild(iconDelete);
                divActions.appendChild(btnDelete);
                tdAcciones.appendChild(divActions);
                tr.appendChild(tdAcciones);

                tbody.appendChild(tr);
            });

            // Generar códigos de barras para cada producto
            // tiene que salir el codigo de barra de acuerdo al codigo del producto guardado 
            // en la base de datos 
            json.data.forEach((producto) => {
                JsBarcode("#barcode" + producto.id, producto.codigo_barra || ""+producto.codigo, {
                    format: "CODE128",
                    lineColor: "#0aa",
                    width: 2,
                    height: 40,
                    displayValue: true
                });
            });
        } else {
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            td.colSpan = 11;
            td.className = 'text-center py-4';
            const div = document.createElement('div');
            div.className = 'text-muted';
            const icon = document.createElement('i');
            icon.className = 'bi bi-inbox fs-1 d-block mb-2';
            div.appendChild(icon);
            div.appendChild(document.createTextNode('No hay productos disponibles'));
            td.appendChild(div);
            tr.appendChild(td);
            tbody.appendChild(tr);
        }
    } catch (error) {
        console.error("Error al cargar productos:", error);
        const tbody = document.getElementById('content_productos');
        tbody.innerHTML = '';
        const tr = document.createElement('tr');
        const td = document.createElement('td');
        td.colSpan = 11;
        td.className = 'text-center py-4';
        const div = document.createElement('div');
        div.className = 'text-danger';
        const icon = document.createElement('i');
        icon.className = 'bi bi-exclamation-triangle fs-1 d-block mb-2';
        div.appendChild(icon);
        div.appendChild(document.createTextNode('Error al cargar los productos'));
        td.appendChild(div);
        tr.appendChild(td);
        tbody.appendChild(tr);
    }
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
        document.getElementById('codigo_barra').value = json.data.codigo_barra;
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
                datos.append("id_producto", id);
                let respuesta = await fetch(base_url + "control/ProductosController.php?tipo=eliminar", {
                    method: "POST",
                    mode: "cors",
                    cache: "no-cache",
                    body: datos
                });
                let json = await respuesta.json();
                if (json.status) {
                    Swal.fire({
                        icon: "success",
                        title: "Eliminado",
                        text: json.msg
                    }).then(() => {
                        // Determinar si estamos en la vista de tabla o de tarjetas
                        const isTableView = document.querySelector("table") !== null;
                        
                        if (isTableView) {
                            view_producto_tabla();
                        } else {
                            view_producto();
                        }
                    });

                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: json.msg
                    });
                }

            } catch (error) {
                console.error("Error al eliminar producto:", error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ocurrió un error al intentar eliminar el producto. Inténtelo de nuevo más tarde."
                });
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

// Función para ver los detalles de un producto
function verDetalles(id) {
    window.location.href = base_url + "productos-detalle/" + id;
}

// Función para agregar un producto al carrito
function agregarCarrito(id) {
    Swal.fire({
        icon: "success",
        title: "Producto agregado",
        text: "El producto ha sido agregado al carrito correctamente",
        confirmButtonText: "OK"
    });
}
