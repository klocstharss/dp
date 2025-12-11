<?php 
require_once("../model/VentaModel.php");
require_once("../model/ProductsModel.php");


$objProducto = new ProductsModel();
$objCategoria = new VentaModel();

$tipo = $_GET['tipo'];

if ($tipo == "registrarTemporal") {
    $respuesta = array('status' => false, 'msj' => 'fallo el controlador');
    
    $id_producto = isset($_POST['id_producto']) ? intval($_POST['id_producto']) : 0;
    $precio = isset($_POST['precio']) ? floatval($_POST['precio']) : 0;
    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 0;

    if ($id_producto > 0) {
        $b_producto = $objCategoria->buscarTemporal($id_producto);
        if ($b_producto) {
            $objCategoria->actualizarCantidadTemporal($id_producto, $cantidad);
            $respuesta = array('status' => true, 'msj' => 'actualizado');
        } else {
            $registro = $objCategoria->registrar_temporal($id_producto, $precio, $cantidad);
            $respuesta = array('status' => true, 'msj' => 'registrado');
        }
    }
    echo json_encode($respuesta);
}


