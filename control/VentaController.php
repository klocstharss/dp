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
            // Actualizar (suma delta, puede ser negativo)
            $objCategoria->actualizarCantidadTemporal($id_producto, $cantidad);
            // Obtener registro actualizado
            $registroActual = $objCategoria->buscarTemporal($id_producto);
            if ($registroActual && isset($registroActual['cantidad'])) {
                if (intval($registroActual['cantidad']) <= 0) {
                    // Eliminar fila si la cantidad llegó a 0 o menos
                    $objCategoria->eliminar_temporal($registroActual['id']);
                    $respuesta = array('status' => true, 'msj' => 'eliminado');
                } else {
                    $respuesta = array('status' => true, 'msj' => 'actualizado');
                }
            } else {
                $respuesta = array('status' => true, 'msj' => 'actualizado');
            }
        } else {
            // Registrar nuevo registro temporal
            $registro = $objCategoria->registrar_temporal($id_producto, $precio, $cantidad);
            if ($registro > 0) {
                $respuesta = array('status' => true, 'msj' => 'registrado');
            } else {
                $respuesta = array('status' => false, 'msj' => 'error_registrar');
            }
        }
    }
    echo json_encode($respuesta);
}


