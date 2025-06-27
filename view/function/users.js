function validar_form() {
   let nro_identidad = document.getElementById("nro_identidad").value;
   let razon_social = document.getElementById("razon_social").value;
   let telefono = document.getElementById("telefono").value;
   let correo = document.getElementById("correo").value;
   let departamento = document.getElementById("departamento").value;
   let provincia = document.getElementById("provincia").value;
   let distrito = document.getElementById("distrito").value;
   let cod_postal = document.getElementById("cod_postal").value;
   let direccion = document.getElementById("direccion").value;
   let rol = document.getElementById("rol").value;
   if (nro_identidad == "" || razon_social == "" || telefono == "" || correo == "" || departamento == "" || provincia == "" || distrito == "" || cod_postal == "" || direccion == "" || rol == "") {
      Swal.fire({
         icon: "error",
         title: "Oops...",
         text: "Something went wrong!",
         footer: '<a href="#">Why do I have this issue?</a>'
      });
      return;
   }


   Swal.fire({
      title: "Drag me!",
      icon: "success",
      draggable: true
   });

   registrarUsuario();

}


if (document.querySelector('#frm_user')) {
   // evita que e envie el formulario
   let frm_user = document.querySelector('#frm_user');
   frm_user.onsubmit = function (e) {
      e.preventDefault();
      validar_form();
   }
}


async function registrarUsuario() {
   try {
      //capturar campos de formulario(HTML)
      const datos = new FormData(frm_user);
      //enviar datos a controlador 
      let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=registrar', {
         method: 'POST',
         mode: 'cors',
         cache: 'no-cache',
         body: datos
      });
      let json = await respuesta.json();
      // validamos que json sea true
      if (json.status)  { //true
         alert(json.msg);
         document.getElementById('frm_user').reset();
      }else{
         alert(json.msg);
      }
      
   } catch (error) {
      console.log("Error al registrar Usuario:" + error);
   }

}


function alerth() {
   Swal.fire({
      icon: "warning",
      title: "¿Estás seguro?",
      text: "Se cancelará el registro",
      showCancelButton: true,
      confirmButtonText: "Sí, cancelar",
      cancelButtonText: "No"
   });
}
