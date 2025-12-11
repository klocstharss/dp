<?php
require_once("../library/conexion.php");
class VentaModel {
    private $conexion;

    function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    public function registrar_temporal($id_producto, $precio, $cantidad)
     {
        $consulta = "INSERT INTO temporal_venta (id_producto, precio, cantidad) 
        VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param("idi", $id_producto, $precio, $cantidad);
        $result = $stmt->execute();
        if ($result) {
            return $this->conexion->insert_id;
        } 
        return 0;
    }
    public function actualizarCantidadTemporal($id_producto, $cantidad) {
        $consulta = "UPDATE temporal_venta SET cantidad = cantidad + ? WHERE id_producto = ?";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param("ii", $cantidad, $id_producto);
        $result = $stmt->execute();
        return $result;
    }
    public function buscarTemporales(){
        $arr_temporal = array();
        $consulta = "SELECT * FROM temporal_venta";
        $sql = $this->conexion->query($consulta);
        while ($objeto = $sql->fetch_object()) {
            array_push($arr_temporal, $objeto);
        }
        return $arr_temporal;
    }
    public function buscarTemporal($id_producto){
        $consulta = "SELECT * FROM temporal_venta WHERE id_producto = ?";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function eliminar_temporal($id){
        $consulta = "DELETE FROM temporal_venta WHERE id='$id'";
        $sql = $this->conexion->query($consulta);
        return $sql;
    }
    public function eliminar_temporales(){
        $consulta = "DELETE FROM temporal_venta";
        $sql = $this->conexion->query($consulta);
        return $sql;
    }
    //-------VENTAS REGISTRADAS(OFICIALES)


}
