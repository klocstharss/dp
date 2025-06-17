function validar_form() {
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
   if (nro_documento =="" || razon_social =="" || telefono =="" || correo =="" || departamento =="" || provincia ==""|| distrito==""|| cod_postal ==""|| direccion ==""|| rol =="") {
      alert("Error, existen campos vacios");
      return;
   }
   alert("procedemos a registrar");

}

if (document.querySelector('#frm_user')) {
   // evita que e envie el formulario
   let frm_user = document.querySelector('#frm_user')
      ;
   frm_user.onsubmit = function (e) {
      e.preventDefault();
      validar_form();
   }
}



function alerth () {
   swal("Muy bien!", "registro exitoso", "success");
   
}