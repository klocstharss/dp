<?php
// Configurar cabeceras CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");

// Responder a solicitudes preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once("../model/UsuarioModel.php");

$objPersona = new UsuarioModel();

$tipo = $_GET['tipo'];
if ($tipo == "registrar") {
    //print_r($_POST);
    $nro_identidad = $_POST['nro_identidad'];
    $razon_social = $_POST['razon_social'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $departamento = $_POST['departamento'];
    $provincia = $_POST['provincia'];
    $distrito = $_POST['distrito'];
    $cod_postal = $_POST['cod_postal'];
    $direccion = $_POST['direccion'];
    $rol = $_POST['rol'];
    // encriptando contraseña
    $password = password_hash($nro_identidad, PASSWORD_DEFAULT);

    if ($nro_identidad == "" || $razon_social == "" || $telefono == "" || $correo == "" || $departamento == ""  || $provincia == "" || $distrito == "" || $cod_postal == "" || $direccion == "" || $rol == "") {
        $arrResponse = array('status' => false, 'msg' => 'Error, campos vacios');
    } else {
        //validacion si existe persona con el mismo dni
        $existePersona = $objPersona->existePersona($nro_identidad);
        if ($existePersona > 0) {
            $arrResponse = array('status' => false, 'msg' => 'Error, nro de documento ya existe');
        } else {

            $respuesta = $objPersona->registrar($nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $password);
            if ($respuesta) {
                $arrResponse = array('status' => true, 'msg' => 'Registrado corectamente');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error, fallo en registro');
            }
        }
    }
    echo json_encode($arrResponse);
}

if($tipo == "iniciar_sesion"){
    $nro_identidad = $_POST['username'];
    $password = $_POST['password'];
    if ($nro_identidad == "" || $password == "") {
        $respuesta = array('status' => false, 'msg' => 'Error, campos vacios');
    }else {
        $existePersona = $objPersona->existePersona($nro_identidad);
        if (!$existePersona) {
            $respuesta = array('status' => false, 'msg' => 'Usuario no registrado');
        }else{
            $persona = $objPersona->buscarPersonaPorNroIdentidad($nro_identidad);
            if (password_verify($password, $persona->password)) {
                session_start();
                $_SESSION['ventas_id'] = $persona->id;
                $_SESSION['ventas_usuario'] = $persona->razon_social;
                $respuesta = array('status' => true, 'msg' => 'Iniciaste sesión'); 
            }else{
                $respuesta = array('status' => false, 'msg' => 'Contraseña incorrecto');
            }
        }
    }
    echo json_encode($respuesta);
}

if ($tipo == "mostrar_proveedores") {
    $proveedores = $objPersona->mostrarProveedores();
    $respuesta = array();
    if (!empty($proveedores)) {
        $respuesta = array('status' => true, 'msg' => 'Proveedores encontrados', 'data' => $proveedores);
    }else {
        $respuesta = array('status' => false, 'msg' => 'No hay proveedores registrados', 'data' => array());
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($tipo == "mostrar_clientes") {
    $clientes = $objPersona->mostrarClientes();
    $respuesta = array();
    if (!empty($clientes)) {
        $respuesta = array('status' => true, 'msg' => 'Clientes encontrados', 'data' => $clientes);
    } else {
        $respuesta = array('status' => false, 'msg' => 'No hay clientes registrados', 'data' => array());
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta);
}

if ($tipo == "mostrar_usuarios") {
    $usuarios = $objPersona->mostrarUsuarios();
    header('Content-Type: application/json');
    echo json_encode($usuarios);
}
/*
if ($tipo == "obtener_usuario"){
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo json_encode(array('status' => false, 'msg' => 'Error, id no existe'));
        exit;
    }
    $id = $_POST['id'];
    $usuario = $objpPersona->obtenerUsuarioPorId($id);
    header('Content-Type: application/json');
    if($usuario){
        echo json_encode(array('status' => true, 'data' => $usuario));
    }else{
        echo json_encode(array('status' => false, 'msg' => 'Error, usuario no encontrado'));
    }
}

if ($tipo == "actualizar_usuario") {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo json_encode(array('status' => false, 'msg' => 'ID no existe'));
        exit;
    }
    $id = $_POST['id'];
    $nro_identidad = $_POST['nro_identidad'];
    $razon_social = $_POST['razon_social'];
    $correo = $_POST['correo'];
    $departamento = $_POST['departamento'];
    $provincia = $_POST['provincia'];
    $distrito = $_POST['distrito'];
    $cod_postal = $_POST['cod_postal'];
    $direccion = $_POST['direccion'];
    $rol = $_POST['rol'];
    $estado = $_POST['estado'];

    if ($objpPersona->existeIdentidadEnOtroUsuario($nro_identidad, $id)) {
        echo json_encode(array('status' => false, 'msg' => 'El DNI ya existe en orto usuario'));
        exit;
    }
    if ($objpPersona->existeCorreoEnOtroUsuario($correo, $id)) {
        echo json_encode(array('status' => false, 'msg' => 'El correo ya existe en orto usuario'));
        exit;
    }
    $succes = $objpPersona->actualizarUsuario($id, $nro_identidad, $razon_social, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $estado);
    header('Content-Type: application/json');
    if ($succes) {
        $respuesta = array('status' => true, 'msg' => 'Usuario actualizado');
    }else{
        $respuesta = array('status' => false, 'msg' => 'Error al actualizar usuario');
    }
    echo json_encode($respuesta);
}
*/

if ($tipo == "ver"){
    $respuesta = array('status' => false, 'msg' => '');
    $id_persona = $_POST['id_persona'];
    $usuario = $objPersona->ver($id_persona);
    if ($usuario) {
        $respuesta ['status'] = true;
        $respuesta ['data'] = $usuario;
    }else {
        $respuesta['msg'] = 'Error, usuario no existe';
    }
    echo json_encode($respuesta);
}

if ($tipo == "actualizar"){
    //print_r($_POST);
    $id_persona = $_POST['id_persona'];
    $nro_identidad = $_POST['nro_identidad'];
    $razon_social = $_POST['razon_social'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $departamento = $_POST['departamento'];
    $provincia = $_POST['provincia'];
    $distrito = $_POST['distrito'];
    $cod_postal = $_POST['cod_postal'];
    $direccion = $_POST['direccion'];
    $rol = $_POST['rol'];
    $estado = isset($_POST['estado']) ? $_POST['estado'] : null;

   if ($id_persona == "" || $nro_identidad == "" || $razon_social == "" || $telefono == "" || $correo == "" || $departamento == ""  || $provincia == "" || $distrito == "" || $cod_postal == "" || $direccion == "" || $rol == "") {
        $arrResponse = array('status' => false, 'msg' => 'Error, campos vacios');
    }else {
        $existeID = $objPersona->ver($id_persona);
        if (!$existeID){
            $arrResponse = array('status' => false, 'msg' => 'Error, usuario no existe');
            echo json_encode($arrResponse);
            exit;
        } else{
            $actualizar = $objPersona->actualizar($id_persona, $nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $estado);
            if ($actualizar) {
                $arrResponse = array('status' => true, 'msg' => "actualizado correctamente");
            }else{
                $arrResponse = array('status' => false, 'msg' => $actualizar);
            }
            echo json_encode($arrResponse);
            exit;
        }
    }
}

if($tipo == "eliminar"){
    $id_persona = $_POST['id_persona'];
    if($id_persona == ""){
        $arrResponse = array('status' => false, 'msg' => 'Error, id vacio');
    }else{
        $eliminar = $objPersona->eliminar($id_persona);
        if ($eliminar) {
            $arrResponse = array('status' => true, 'msg' => 'Usuario eliminado correctamente');
        }else{
            $arrResponse = array('status' => false, 'msg' => 'Error al eliminar usuario');
        }
        echo json_encode($arrResponse);
        exit;
    }
}