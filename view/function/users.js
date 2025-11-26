function validar_form(tipo) {
    let nro_documento = document.getElementById("nro_identidad").value;
    let razon_social = document.getElementById("razon_social").value;
    let telefono = document.getElementById("telefono").value;
    let correo = document.getElementById("correo").value;
    let departamento = document.getElementById("departamento").value;
    let provincia = document.getElementById("provincia").value;
    let distrito = document.getElementById("distrito").value;
    let cod_postal = document.getElementById("cod_postal").value;
    let direccion = document.getElementById("direccion").value;
    let rol = document.getElementById("rol").value;

    if (nro_documento == "" || razon_social == "" || telefono == "" || correo == "" || correo == "" || departamento == "" || provincia == "" || distrito == "" || cod_postal == "" || direccion == "" || rol == "") {

        Swal.fire({
            icon: 'warning',
            title: 'Campos vacíos',
            text: 'Por favor, complete todos los campos requeridos',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    if (tipo == "nuevo") {
        registrarUsuario();
    }
    if (tipo == "actualizar") {
        actualizarUsuario();
    }
}

if (document.querySelector('#frm_user')) {
    //evita que se envie el formulario
    let frm_user = document.querySelector('#frm_user');
    frm_user.onsubmit = function (e) {
        e.preventDefault();
        validar_form("nuevo");
    }
}

async function registrarUsuario() {
    try {
        const datos = new FormData(frm_user);
        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        let json = await respuesta.json();

        // CORRECTO: verificar 'status', no solo 'msg'
        if (json.status === false) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: json.msg
            });
            document.getElementById('frm_user').reset();
        } else if (json.status === true) {
            Swal.fire({
                icon: "success",
                title: "Éxito",
                text: json.msg
            });
            document.getElementById('frm_user').reset(); // opcional: limpiar también en éxito
        }
    } catch (error) {
        console.log("Error al conectar con el servidor: " + error);
        Swal.fire({
            icon: "error",
            title: "Error de conexión",
            text: "No se pudo conectar con el servidor"
        });
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
            window.location.href = base_url + "?views=home";
        }
    });
}

async function iniciar_sesion() {
    let usuario = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    if (usuario == "" || password == "") {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Campos vacios",
        });
        return;
    }
    try {
        const datos = new FormData(frm_login);
        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=iniciar_sesion', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        let json = await respuesta.json();
        // validamos que json.status sea = true
        if (json.status) { // true
            location.replace(base_url + 'new-user');
        } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: json.msg
            });
        }
    } catch (error) {
        console.log(error);
    }

}

async function view_users() {
    try {
        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=mostrar_usuarios', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });
        let json = await respuesta.json();
        if (json && json.length > 0) {
            let html = '';
            json.forEach((user, index) => {
                html += `<tr>
                    <td>${index + 1}</td>
                    <td>${user.nro_identidad || ''}</td>
                    <td>${user.razon_social || ''}</td>
                    <td>${user.correo || ''}</td> 
                    <td>${user.rol || ''}</td> 
                    <td>${user.estado || ''}</td>
                    <td>
                        <a href="`+ base_url + `edit-user/` + user.id + `" class="btn btn-primary">Editar</a>
                        <button onclick="eliminarUsuario(` + user.id + `)" class="btn btn-danger">Eliminar</button>
                        
                    </td>
                </tr>`;
            });
            document.getElementById('content_users').innerHTML = html;
        } else {
            document.getElementById('content_users').innerHTML = '<tr><td colspan="6">No hay usuarios disponibles</td></tr>';
        }
    } catch (error) {
        console.log(error);
        document.getElementById('content_users').innerHTML = '<tr><td colspan="6">Error al cargar los usuarios</td></tr>';
    }
}

async function view_clients() {
    try {
        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=mostrar_clientes', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });
        let json = await respuesta.json();
        let html = '';
        if (json.status && Array.isArray(json.data)) {
            json.data.forEach((user, index) => {
                html += `<tr>
                    <td>${index + 1}</td>
                    <td>${user.nro_identidad || ''}</td>
                    <td>${user.razon_social || ''}</td>
                    <td>${user.correo || ''}</td>
                    <td>${user.estado || ''}</td>
                    <td>
                        <a href="`+ base_url + `edit-client/` + user.id + `" class="btn btn-primary">Editar</a>
                        <button onclick="eliminarUsuario(` + user.id + `)" class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>`;
            });
        } else {
            html = '<tr><td colspan="6">No hay clientes disponibles</td></tr>';
        }
        const cont = document.getElementById('content_clients');
        if (cont) cont.innerHTML = html;
    } catch (error) {
        console.log(error);
        const cont = document.getElementById('content_clients');
        if (cont) cont.innerHTML = '<tr><td colspan="6">Error al cargar los clientes</td></tr>';
    }
}

async function view_proveedores() {
    try {
        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=mostrar_proveedores', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });
        let json = await respuesta.json();
        let html = '';
        if (json.status && Array.isArray(json.data)) {
            json.data.forEach((prov, index) => {
                html += `<tr>
                    <td>${index + 1}</td>
                    <td>${prov.nro_identidad || ''}</td>
                    <td>${prov.razon_social || ''}</td>
                    <td>${prov.correo || ''}</td>
                    <td>${prov.estado || ''}</td>
                    <td>
                        <a href="`+ base_url + `edit-proveedor/` + prov.id + `" class="btn btn-primary">Editar</a>
                        <button onclick="eliminarUsuario(` + prov.id + `)" class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>`;
            });
        } else {
            html = '<tr><td colspan="6">No hay proveedores disponibles</td></tr>';
        }
        const cont = document.getElementById('content_proveedores');
        if (cont) cont.innerHTML = html;
    } catch (error) {
        console.log(error);
        const cont = document.getElementById('content_proveedores');
        if (cont) cont.innerHTML = '<tr><td colspan="6">Error al cargar los proveedores</td></tr>';
    }
}

if (document.getElementById('content_users')) {
    view_users();
}

async function edit_user() {
    try {
        let id_persona = document.getElementById('id_persona').value;
        const datos = new FormData();
        datos.append('id_persona', id_persona);

        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=ver', {
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
        document.getElementById('nro_identidad').value = json.data.nro_identidad;
        document.getElementById('razon_social').value = json.data.razon_social;
        document.getElementById('telefono').value = json.data.telefono;
        document.getElementById('correo').value = json.data.correo;
        document.getElementById('departamento').value = json.data.departamento;
        document.getElementById('provincia').value = json.data.provincia;
        document.getElementById('distrito').value = json.data.distrito;
        document.getElementById('cod_postal').value = json.data.cod_postal;
        document.getElementById('direccion').value = json.data.direccion;
        document.getElementById('rol').value = json.data.rol;
        document.getElementById('estado').value = json.data.estado;

    } catch (error) {
        console.log('oops, ocurrio un error' + error);

    }

}

if (document.querySelector('#frm_edit_user')) {

    let frm_user = document.querySelector('#frm_edit_user');
    frm_user.onsubmit = function (e) {
        e.preventDefault();
        validar_form("actualizar");
    };
}

async function actualizarUsuario() {
    const datos = new FormData(frm_edit_user);
    let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=actualizar', {
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
            text: json.msg
        });
    }
}

async function eliminarUsuario(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const datos = new FormData();
                datos.append('id_persona', id);
                let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=eliminar', {
                    method: 'POST',
                    mode: 'cors',
                    cache: 'no-cache',
                    body: datos
                });
                let json = await respuesta.json();
                if (json.status) {
                    Swal.fire({
                        icon: "success",
                        title: "Eliminado",
                        text: json.msg
                    }).then(() => {
                        if (document.getElementById('content_users')) {
                            view_users();
                        } else if (document.getElementById('content_clients')) {
                            view_clients();
                        } else if (document.getElementById('content_proveedores')) {
                            view_proveedores();
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
                console.log('oops, ocurrio un error' + error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ocurrió un error al eliminar el usuario"
                });
            }
        }
    });
}
