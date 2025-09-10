function validar_form() {
    let nombre = document.getElementById("nombre").value;
    let detalle = document.getElementById("detalle").value;

    if (nombre == "") {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "El nombre de la categoría es obligatorio!"
        });
        return;
    }

    Swal.fire({
        title: "Guardando...",
        icon: "info",
        showConfirmButton: false
    });

    registrarCategoria();
}

if (document.querySelector('#frm_categoria')) {
    let frm_categoria = document.querySelector('#frm_categoria');
    frm_categoria.onsubmit = function(e) {
        e.preventDefault();
        validar_form();
    }
}

async function registrarCategoria() {
    try {
        const datos = new FormData(frm_categoria);
        let respuesta = await fetch(base_url + 'control/CategoriesController.php?tipo=registrar', {
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
            document.getElementById('frm_categoria').reset();
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


