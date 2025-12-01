<?php 
require_once("../model/VentaModel.php");
require_once("../model/ProductsModel.php");


$objProducto = new ProductsModel();
$objCategoria = new VentaModel();

$tipo = $_GET['tipo'];

if ($tipo == "registrarTemporal") {
    $respuesta = array('status' => false, 'msg' => 'fallo el controlador');
    $id_producto = $_POST['id_producto'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $b_producto = $objCategoria->buscarTemporal($id_producto);
    if ($b_producto) {
        $n_cantidad = $b_producto['cantidad'] + $cantidad;
        $objCategoria->actualizarCantidadTemporal($id_producto, $cantidad);
    } else {
        $registro = $objCategoria->registrar_temporal($id_producto, $precio, $cantidad);
        $respuesta = array('status' => true, 'msg' => 'Registrado');
    }
    echo json_encode($respuesta);
}


