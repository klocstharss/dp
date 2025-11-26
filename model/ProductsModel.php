<?php
require_once("../library/conexion.php");
class ProductsModel
{
    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    public function registrar($codigo, $nombre, $detalle, $precio, $stock, $id_categoria, $fecha_vencimiento, $imagen, $id_proveedor)
    {
        // Escapar todos los campos para prevenir inyección SQL
        $codigo = $this->conexion->real_escape_string($codigo);
        $nombre = $this->conexion->real_escape_string($nombre);
        $detalle = $this->conexion->real_escape_string($detalle);
        $precio = $this->conexion->real_escape_string($precio);
        $stock = $this->conexion->real_escape_string($stock);
        $id_categoria = $this->conexion->real_escape_string($id_categoria);
        $fecha_vencimiento = $this->conexion->real_escape_string($fecha_vencimiento);
        $id_proveedor = $this->conexion->real_escape_string($id_proveedor);

        // Manejar el campo imagen que puede ser nulo
        $imagenEscapada = is_null($imagen) ? "NULL" : "'" . $this->conexion->real_escape_string($imagen) . "'";

        $consulta = "INSERT INTO producto (codigo, nombre, detalle, precio, stock, id_categoria, fecha_vencimiento, imagen, id_proveedor) 
                VALUES ('$codigo', '$nombre', '$detalle', '$precio', '$stock', '$id_categoria', '$fecha_vencimiento', $imagenEscapada, '$id_proveedor')";

        $sql = $this->conexion->query($consulta);
        if ($sql) {
            return $this->conexion->insert_id;
        } else {
            return 0;
        }
    }

    public function existeCodigo($codigo)
    {
        $codigo = $this->conexion->real_escape_string($codigo);
        $consulta = "SELECT id FROM producto WHERE codigo='$codigo' LIMIT 1";
        $sql = $this->conexion->query($consulta);
        return $sql->num_rows;
    }

    public function existeCategoria($nombre)
    {
        $consulta = "SELECT * FROM producto WHERE nombre='$nombre'";
        $sql = $this->conexion->query($consulta);
        return $sql->num_rows;
    }

    public function mostrarProductos()
    {
        $arr_productos = array();
        $consulta = "SELECT * FROM producto";
        error_log("Consulta SQL: " . $consulta);
        $sql = $this->conexion->query($consulta);
        if (!$sql) {
            error_log("Error en la consulta: " . $this->conexion->error);
        }
        while ($objeto = $sql->fetch_object()) {
            array_push($arr_productos, $objeto);
        }
        error_log("Número de productos encontrados: " . count($arr_productos));
        return $arr_productos;
    }


    public function ver($id)
    {
        // Escapar el ID para prevenir inyección SQL
        $id = $this->conexion->real_escape_string($id);
        
        // Verificar que el ID sea válido
        if (!is_numeric($id) || $id <= 0) {
            return null;
        }
        
        $consulta = "SELECT * FROM producto WHERE id = '$id'";
        $sql = $this->conexion->query($consulta);
        
        if ($sql && $sql->num_rows > 0) {
            return $sql->fetch_object();
        } else {
            return null;
        }
    }

    public function actualizar($id_producto, $codigo, $nombre, $detalle, $precio, $stock, $id_categoria, $fecha_vencimiento, $id_proveedor, $imagen = null)
    {
        $consulta = "UPDATE producto SET codigo='$codigo', nombre='$nombre', detalle='$detalle', precio='$precio', stock='$stock', id_categoria='$id_categoria', fecha_vencimiento='$fecha_vencimiento', id_proveedor='$id_proveedor'";

        if (!empty($imagen)) {
            $consulta .= ", imagen='$imagen'";
        }
        $consulta .= " WHERE id='$id_producto'";
        $sql = $this->conexion->query($consulta);
        return $sql;
    }

    public function verificarRelaciones($id_producto)
    {
        // Escapar el ID para prevenir inyección SQL
        $id_producto = $this->conexion->real_escape_string($id_producto);
        
        // Verificar que el ID sea válido
        if (!is_numeric($id_producto) || $id_producto <= 0) {
            return false;
        }
        
        // Verificar si el producto está siendo utilizado en la tabla compras
        $consulta_compras = "SELECT COUNT(*) as total FROM compras WHERE id_producto = '$id_producto'";
        $resultado_compras = $this->conexion->query($consulta_compras);
        $compras = $resultado_compras->fetch_assoc();
        
        // Verificar si el producto está siendo utilizado en la tabla detalle_venta
        $consulta_detalle_venta = "SELECT COUNT(*) as total FROM detalle_venta WHERE id_producto = '$id_producto'";
        $resultado_detalle_venta = $this->conexion->query($consulta_detalle_venta);
        $detalle_venta = $resultado_detalle_venta->fetch_assoc();
        
        // Devolver true si hay relaciones, false si no las hay
        return ($compras['total'] > 0 || $detalle_venta['total'] > 0);
    }
    
    public function eliminar($id_producto)
    {
        // Escapar el ID para prevenir inyección SQL
        $id_producto = $this->conexion->real_escape_string($id_producto);

        // Verificar que el ID sea válido
        if (!is_numeric($id_producto) || $id_producto <= 0) {
            return false;
        }

        // Iniciar transacción
        $this->conexion->autocommit(false);

        try {
            $consulta = "DELETE FROM producto WHERE id='$id_producto'";
            $sql = $this->conexion->query($consulta);

            if ($sql) {
                // Confirmar la transacción
                $this->conexion->commit();
                return true;
            } else {
                // Revertir la transacción
                $this->conexion->rollback();
                return false;
            }
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $this->conexion->rollback();
            return false;
        } finally {
            // Restaurar el modo autocommit
            $this->conexion->autocommit(true);
        }
    }
    public function  buscarProductoByNombreOrCodigo($dato) {
        $arr_productos = array();
        $consulta = "SELECT * FROM producto WHERE nombre LIKE '%$dato%' OR codigo LIKE '$dato%' OR detalle LIKE '%$dato%'";
        $sql = $this->conexion->query($consulta);
        while ($objeto = $sql->fetch_object()) {
            array_push($arr_productos, $objeto);
        }
        return $arr_productos;

    }    
}