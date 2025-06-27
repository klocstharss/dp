<?php
require_once("../model/UsuarioModel.php");
$objPersona= new UsuarioModel();

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
    //ENCRIPTANDO NRO_IDENTIDAD(DNI) PARA UTILIZARLO COMO PSSWORD
    $password = password_hash($nro_identidad,PASSWORD_DEFAULT);
    
    if ($nro_identidad == "" || $razon_social == "" || $telefono == "" || $correo == "" || $departamento == "" || $provincia == "" || $distrito == "" || $cod_postal == "" || $direccion == "" || $rol == "") {
        $arrResponse = array('status'=> false, 'msg' => 'Error, campos vacios' );
    } else {
        $respuesta = $objPersona-> registrar($nro_identidad, $razon_social, $telefono,  $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $password);
        $arrResponse = array('status'=> true, 'msg' => 'procedemos a registrar' );
    }
    echo json_encode($arrResponse);
}
