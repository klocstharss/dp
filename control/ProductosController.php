<?php
// Configurar cabeceras CORS
header('Access-Control-Allow-Origin: https://gedion.serviciosvirtuales.com.pe');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

// Si la solicitud es OPTIONS, terminar aquí
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}
require_once("../model/ProductsModel.php");
require_once("../model/CategoriaModel.php");
require_once("../model/UsuarioModel.php");


$objProducto = new ProductsModel();
$objCategoria = new CategoriaModel();
$objPersona = new UsuarioModel();
$tipo = $_GET['tipo'];

if ($tipo == 'registrar') {
    // Captura los campos del formulario
    $codigo = $_POST['codigo'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $detalle = $_POST['detalle'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $id_categoria = $_POST['id_categoria'] ?? '';
    $fecha_vencimiento = $_POST['fecha_vencimiento'] ?? '';
    $id_proveedor = $_POST['id_proveedor'] ?? '';

    // Validar campos obligatorios (excluyendo id_proveedor)
    if ($codigo == "" || $nombre == "" || $detalle == "" || $precio == "" || $stock == "" || $id_categoria == "" || $fecha_vencimiento == "" || $id_proveedor == "") {
        $arrResponse = array('status' => false, 'msg' => 'Error, campos vacíos');
        echo json_encode($arrResponse);
        exit;
    }

    if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['status' => false, 'msg' => 'Error, imagen no recibida']);
        exit;
    }
    if ($objProducto->existeCodigo($codigo) > 0) {
        echo json_encode(['status' => false, 'msg' => 'Error, el código ya existe']);
        exit;
    }
    $file = $_FILES['imagen'];
    $ext  = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $extPermitidas = ['jpg', 'jpeg', 'png'];

    if (!in_array($ext, $extPermitidas)) {
        echo json_encode(['status' => false, 'msg' => 'Formato de imagen no permitido']);
        exit;
    }
    if ($file['size'] > 5 * 1024 * 1024) { // 5MB
        echo json_encode(['status' => false, 'msg' => 'La imagen supera 2MB']);
        exit;
    }
    $carpetaUploads = "../uploads/productos/";
    if (!is_dir($carpetaUploads)) {
        @mkdir($carpetaUploads, 0775, true);
    }

    $nombreUnico = uniqid('prod_') . '.' . $ext;
    $rutaFisica  = $carpetaUploads . $nombreUnico;
    $rutaRelativa = "uploads/productos/" . $nombreUnico;

    if (!move_uploaded_file($file['tmp_name'], $rutaFisica)) {
        echo json_encode(['status' => false, 'msg' => 'No se pudo guardar la imagen']);
        exit;
    }
    $id = $objProducto->registrar($codigo, $nombre, $detalle, $precio, $stock, $id_categoria, $fecha_vencimiento, $rutaRelativa, $id_proveedor);
    if ($id > 0) {
        echo json_encode(['status' => true, 'msg' => 'Registrado correctamente', 'id' => $id, 'img' => $rutaRelativa]);
    } else {
        @unlink($rutaFisica); // revertir archivo si falló BD
        echo json_encode(['status' => false, 'msg' => 'Error, falló en registro']);
    }
    exit;
}

if ($tipo == "mostrar_productos") {
    $respuesta = array('status' => false, 'msg' => 'fallo el controlador');
    $productos = $objProducto->mostrarProductos();
    $arrProduct = array();
    if (count($productos)) {
        foreach ($productos as $producto) {
            $categoria = $objCategoria->ver($producto->id_categoria);
            if ($categoria && property_exists($categoria, 'nombre')) {
                $producto->categoria = $categoria->nombre;
            } else {
                $producto->categoria = "Sin categoria";
            }

            $proveedor = $objPersona->ver($producto->id_proveedor);
            if ($proveedor && property_exists($proveedor, 'razon_social')) {
                $producto->proveedor = $proveedor->razon_social;
            } else {
                $producto->proveedor = "Sin proveedor";
            }
            array_push($arrProduct, $producto);
        }
        $respuesta = array('status' => true, 'msg' => '', 'data' => $arrProduct);
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta);
    exit;
}

if ($tipo == "ver") {
    $respuesta = array('status' => false, 'msg' => '');
    $id_producto = $_POST['id_producto'];
    $producto = $objProducto->ver($id_producto);
    if ($producto) {
        $respuesta['status'] = true;
        $respuesta['data'] = $producto;
    } else {
        $respuesta['msg'] = "Error, categoria no existe";
    }
    echo json_encode($respuesta);
}


if ($tipo == "actualizar") {

    $id_producto = $_POST['id_producto'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $id_categoria = $_POST['id_categoria'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $id_proveedor = $_POST['id_proveedor'];

    if ($id_producto == "" || $codigo == "" || $nombre == "" || $detalle == "" || $precio == "" || $stock == "" || $id_categoria == "" || $fecha_vencimiento == "" || $id_proveedor == "") {
        $arrResponse = array('status' => false, 'msg' => 'Error, campos vacios');
        echo json_encode($arrResponse);
        exit;
    }

    // Obtener información del producto antes de actualizar
    $producto = $objProducto->ver($id_producto);
    if (!$producto) {
        $arrResponse = array('status' => false, 'msg' => 'Error, producto no existe');
        echo json_encode($arrResponse);
        exit;
    }

    // Inicializar la variable imagen con la imagen actual del producto
    $imagen = $producto->imagen;

    // Verificar si se ha subido una nueva imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['imagen'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $extPermitidas = ['jpg', 'jpeg', 'png'];

        if (!in_array($ext, $extPermitidas)) {
            echo json_encode(['status' => false, 'msg' => 'Formato de imagen no permitido']);
            exit;
        }
        if ($file['size'] > 5 * 1024 * 1024) { // 5MB
            echo json_encode(['status' => false, 'msg' => 'La imagen supera 5MB']);
            exit;
        }
        $carpetaUploads = "../uploads/productos/";
        if (!is_dir($carpetaUploads)) {
            @mkdir($carpetaUploads, 0775, true);
        }

        $nombreUnico = uniqid('prod_') . '.' . $ext;
        $rutaFisica = $carpetaUploads . $nombreUnico;
        $rutaRelativa = "uploads/productos/" . $nombreUnico;

        if (!move_uploaded_file($file['tmp_name'], $rutaFisica)) {
            echo json_encode(['status' => false, 'msg' => 'No se pudo guardar la imagen']);
            exit;
        }

        // Eliminar imagen anterior si existe
        if (!empty($producto->imagen) && file_exists("../" . $producto->imagen)) {
            @unlink("../" . $producto->imagen);
        }

        // Actualizar la variable imagen con la nueva ruta
        $imagen = $rutaRelativa;
    }

    // Actualizar el producto en la base de datos
    $actualizar = $objProducto->actualizar($id_producto, $codigo, $nombre, $detalle, $precio, $stock, $id_categoria, $fecha_vencimiento, $id_proveedor, $imagen);

    if ($actualizar) {
        $arrResponse = array('status' => true, 'msg' => 'Actualizado correctamente');
    } else {
        // Si falló la actualización, eliminar la nueva imagen si se subió
        if (isset($rutaFisica) && file_exists($rutaFisica)) {
            @unlink($rutaFisica);
        }
        $arrResponse = array('status' => false, 'msg' => 'Error al actualizar producto');
    }
    echo json_encode($arrResponse);
    exit;
}

if ($tipo == "eliminar") {
    $id_producto = $_POST['id_producto'];
    if ($id_producto == "") {
        $arrResponse = array('status' => false, 'msg' => 'Error, id vacio');
    } else {
        // Obtener información del producto antes de eliminarlo
        $producto = $objProducto->ver($id_producto);

        $eliminar = $objProducto->eliminar($id_producto);
        if ($eliminar) {
            // Eliminar la imagen asociada si existe
            if ($producto && !empty($producto->imagen) && file_exists("../" . $producto->imagen)) {
                @unlink("../" . $producto->imagen);
            }
            $arrResponse = array('status' => true, 'msg' => 'Producto eliminado');
        } else {
            $arrResponse = array('status' => false, 'msg' => 'Error al eliminar producto');
        }
        echo json_encode($arrResponse);
        exit;
    }
}
