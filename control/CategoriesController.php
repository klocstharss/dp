<?php
require_once("../model/CategoriesModel.php");
$objCategoria = new CategoriesModel();

$tipo = $_GET['tipo'];
if ($tipo == "registrar") {
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];

    if ($nombre == "") {
        $arrResponse = array('status' => false, 'msg' => 'Error, el nombre de la categoría es obligatorio');
    } else {
        $existeCategoria = $objCategoria->existeCategoria($nombre);
        if ($existeCategoria > 0) {
            $arrResponse = array('status' => false, 'msg' => 'Error, la categoría ya existe');
        } else {
            $arrResponse = array('status' => true, 'msg' => 'Registro exitoso');
            $respuesta = $objCategoria->registrar($nombre, $detalle);
            if ($respuesta) {
                $arrResponse = array('status' => true, 'msg' => 'Categoría registrada exitosamente');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error, fallo en el registro');
            }
        }
    }
    echo json_encode($arrResponse);
}