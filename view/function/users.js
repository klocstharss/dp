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
        if (json.msg) {
            Swal.fire({
                icon: "success",
                title: "Éxito",
                text: json.msg
            });
            document.getElementById('frm_user').reset();
        } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: json.msg
            });
        }
    } catch (error) {
        console.log("Error al registrar categoría: " + error);
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
        let respuesta = await fetch(base_url + 'control/usuarioController.php?tipo=iniciar_sesion', {
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
        let respuesta = await fetch(base_url + 'control/usuarioController.php?tipo=mostrar_usuarios', {
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
        let respuesta = await fetch(base_url + 'control/usuarioController.php?tipo=mostrar_clientes', {
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
        let respuesta = await fetch(base_url + 'control/usuarioController.php?tipo=mostrar_proveedores', {
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

/*
async function edit_user() {
    const pathArray = window.location.pathname.split('/');
    let id = pathArray[pathArray.length - 1];
    if (!id || isNaN(id)) {
        const urlParams = new URLSearchParams(window.location.search);
        const queryId = urlParams.get('id');
        if (!queryId) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se encontró ID de usuario'
            });
            return;
        }
        id = queryId;
    }
    try {
        let respuesta = await fetch(base_url + 'control/usuarioController.php?tipo=obtener_usuario', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id=' + encodeURIComponent(id)
        });

        let response = await respuesta.json();
        if (response.status && response.data) {
            const user = response.data;
            const form = document.getElementById('frm_edit_user');
            if (form) {
                if (form.elements['id']) form.elements['id'].value = user.id || id;
                if (form.elements['nro_identidad']) form.elements['nro_identidad'].value = user.nro_identidad || '';
                if (form.elements['razon_social']) form.elements['razon_social'].value = user.razon_social || '';
                if (form.elements['correo']) form.elements['correo'].value = user.correo || '';
                if (form.elements['departamento']) form.elements['departamento'].value = user.departamento || '';
                if (form.elements['provincia']) form.elements['provincia'].value = user.provincia || '';
                if (form.elements['distrito']) form.elements['distrito'].value = user.distrito || '';
                if (form.elements['cod_postal']) form.elements['cod_postal'].value = user.cod_postal || '';
                if (form.elements['direccion']) form.elements['direccion'].value = user.direccion || '';
                if (form.elements['rol']) form.elements['rol'].value = user.rol || '';
                if (form.elements['estado']) form.elements['estado'].value = user.estado || '';
            }
            
        }else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Usuario no encontrado'
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al cargar los datos del usuario'
        });
    }
}


async function update_user() {
    const form = document.getElementById('frm_edit_user');
    const formData = new FormData(form);
    if (!formData.get('id')) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'ID de usuario no encontrado'
        });
        return;
    }

    try {
        let respuesta = await fetch(base_url + 'control/usuarioController.php?tipo=actualizar_usuario', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        let json = await respuesta.json();
        if (json.status) {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: json.msg
            }).then(() => {
                window.location.href = base_url + 'users';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: json.msg
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al actualizar el usuario'
        });
    }
}

if (document.getElementById('frm_edit_user')) {
    edit_user();

    let frm_edit_user = document.getElementById('frm_edit_user');
    frm_edit_user.onsubmit = function (e) {
        e.preventDefault();
        update_user();
    };
}
*/

async function edit_user() {
    try {
        let id_persona = document.getElementById('id_persona').value;
        const datos = new FormData();
        datos.append('id_persona', id_persona);

        let respuesta = await fetch(base_url + 'control/usuarioController.php?tipo=ver', {
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
    let respuesta = await fetch(base_url + 'control/usuarioController.php?tipo=actualizar', {
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
                let respuesta = await fetch(base_url + 'control/usuarioController.php?tipo=eliminar', {
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

async function cerrar_sesion() {
    try {
        let respuesta = await fetch(base_url + 'control/usuarioController.php?tipo=cerrar_sesion', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });
        let json = await respuesta.json();
        if (json.status) {
            window.location.href = base_url + 'login';
        } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: json.msg
            });
        }
    } catch (error) {
        console.log("Error al cerrar sesión: " + error);
    }
}

if (document.getElementById('logoutBtn')) {
    document.getElementById('logoutBtn').addEventListener('click', cerrar_sesion);
}
