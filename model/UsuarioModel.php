<?php
require_once(__DIR__ . "/../library/conexion.php");

class UsuarioModel {
    private $conexion;

    function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function registrar($nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $password) {
        $consulta = "INSERT INTO persona (nro_identidad, razon_social, telefono, correo, departamento, provincia, distrito, cod_postal, direccion, rol, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($consulta);
        if (!$stmt) {
            error_log("Error en prepare(): " . $this->conexion->error);
            return 0;
        }
        $stmt->bind_param("sssssssssss", $nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $password);
        $resultado = $stmt->execute();
        if ($resultado) {
            $insert_id = $this->conexion->insert_id;
            $stmt->close();
            return $insert_id;
        } else {
            error_log("Error en execute(): " . $stmt->error);
            $stmt->close();
            return 0;
        }
    }

    public function existePersona($nro_identidad) {
        $consulta = "SELECT * FROM persona WHERE nro_identidad = ?";
        $stmt = $this->conexion->prepare($consulta);
        if (!$stmt) {
            error_log("Error en prepare(): " . $this->conexion->error);
            return 0;
        }
        $stmt->bind_param("s", $nro_identidad);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $num_rows = $resultado->num_rows;
        $stmt->close();
        return $num_rows;
    }

    public function mostrarProveedores(){
        $arr_proveedores = array();
        $consulta = "SELECT * FROM persona WHERE rol = 'proveedor'";
        $sql = $this->conexion->query($consulta);

        if (!$sql) {
            error_log("Error en query(): " . $this->conexion->error);
            return $arr_proveedores;
        }
        while ($objeto = $sql->fetch_object()){
            array_push($arr_proveedores, $objeto);
        }
        return $arr_proveedores;
    }

    public function mostrarClientes(){
        $arr_clientes = array();
        $consulta = "SELECT * FROM persona WHERE rol = 'cliente'";
        $sql = $this->conexion->query($consulta);

        if (!$sql) {
            error_log("Error en query(): " . $this->conexion->error);
            return $arr_clientes;
        }
        while ($objeto = $sql->fetch_object()){
            array_push($arr_clientes, $objeto);
        }
        return $arr_clientes;
    }
    public function buscarPersonaPorNroIdentidad($nro_identidad) {
        $consulta = "SELECT id, razon_social, password FROM persona WHERE nro_identidad = ? LIMIT 1";
        $stmt = $this->conexion->prepare($consulta);
        if (!$stmt) {
            error_log("Error en prepare(): " . $this->conexion->error);
            return null;
        }
        $stmt->bind_param("s", $nro_identidad);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado && $resultado->num_rows > 0) {
            $persona = $resultado->fetch_object();
            $stmt->close();
            return $persona;
        }
        $stmt->close();
        return null;
    }

    public function mostrarUsuarios() {
        $arr_usuarios = array();
        $consulta = "SELECT * FROM persona";
        $sql = $this->conexion->query($consulta);
        if (!$sql) {
            error_log("Error en query(): " . $this->conexion->error);
            return $arr_usuarios;
        }
        while ($objeto = $sql->fetch_object()) {
            array_push($arr_usuarios, $objeto);
        }
        return $arr_usuarios;
    }
    /*
    public function obtenerUsuarioPorId($id) {
        if (!is_numeric($id) || $id <= 0) {
            return false;
        }
        $consulta = "SELECT id, nro_identidad, razon_social, correo, departamento, provincia, distrito, cod_postal, direccion, rol, estado FROM persona WHERE id = ? LIMIT 1";
        $stmt = $this->conexion->prepare($consulta);
        if (!$stmt) {
            error_log("Error en prepare(): " . $this->conexion->error);
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado && $resultado->num_rows > 0) {
            $usuario = $resultado->fetch_object();
            $stmt->close();
            return $usuario;
        }
        $stmt->close();
        return false;
    }

    public function actualizarUsuario($id, $nro_identidad, $razon_social, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $estado) {
        if (!is_numeric($id) || $id <= 0) {
            return false;
        }
        if (empty($nro_identidad) || empty($razon_social) || empty($correo) || empty($departamento) || empty($provincia) || empty($distrito) || empty($cod_postal) || empty($direccion)) {
            return false;
        }
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        if (!in_array($rol, ['user', 'admin', 'invit'])) {
            return false;
        }
        if (!in_array($estado, ['0', '1', 0, 1])) {
            return false;
        }
        if (!$this->obtenerUsuarioPorId($id)) {
            return false;
        }

        $consulta = "UPDATE persona SET nro_identidad = ?, razon_social = ?, correo = ?, departamento = ?, provincia = ?, distrito = ?, cod_postal = ?, direccion = ?, rol = ?, estado = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($consulta);

        if (!$stmt) {
            error_log("Error en prepare(): " . $this->conexion->error);
            return false;
        }
        // Asumiendo que estado es entero, lo convertimos si es necesario
        $estado = (int)$estado;
        $stmt->bind_param("ssssssssssi", $nro_identidad, $razon_social, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $estado, $id);
        $resultado = $stmt->execute();

        if (!$resultado) {
            error_log("Error en execute(): " . $stmt->error);
            $stmt->close();
            return false;
        }
        $filasAfectadas = $stmt->affected_rows;
        $stmt->close();
        return $filasAfectadas > 0;
    }

    public function existeCorreoEnOtroUsuario($correo, $excluirId) {
        $consulta = "SELECT id FROM persona WHERE correo = ? AND id != ? LIMIT 1";
        $stmt = $this->conexion->prepare($consulta);
        if (!$stmt) {
            error_log("Error en prepare(): " . $this->conexion->error);
            return false;
        }
        $stmt->bind_param("si", $correo, $excluirId);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $existe = $resultado->num_rows > 0;
        $stmt->close();
        return $existe;
    }

    public function existeIdentidadEnOtroUsuario($nro_identidad, $excluirId) {
        $consulta = "SELECT id FROM persona WHERE nro_identidad = ? AND id != ? LIMIT 1";
        $stmt = $this->conexion->prepare($consulta);
        if (!$stmt) {
            error_log("Error en prepare(): " . $this->conexion->error);
            return false;
        }
        $stmt->bind_param("si", $nro_identidad, $excluirId);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $existe = $resultado->num_rows > 0;
        $stmt->close();
        return $existe;
    }
    */

    public function ver($id){
        $consulta = "SELECT * FROM persona WHERE id = ?";
        $stmt = $this->conexion->prepare($consulta);
        if (!$stmt) {
            error_log("Error en prepare(): " . $this->conexion->error);
            return null;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado && $resultado->num_rows > 0) {
            $persona = $resultado->fetch_object();
            $stmt->close();
            return $persona;
        }
        $stmt->close();
        return null;
    }

    public function actualizar($id_persona, $nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $estado = null){
        if ($estado !== null) {
            $consulta = "UPDATE persona SET nro_identidad = ?, razon_social = ?, telefono = ?, correo = ?, departamento = ?, provincia = ?, distrito = ?, cod_postal = ?, direccion = ?, rol = ?, estado = ? WHERE id = ?";
            $stmt = $this->conexion->prepare($consulta);
            if (!$stmt) {
                error_log("Error en prepare(): " . $this->conexion->error);
                return false;
            }
            $stmt->bind_param("ssssssssssii", $nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $estado, $id_persona);
        } else {
            $consulta = "UPDATE persona SET nro_identidad = ?, razon_social = ?, telefono = ?, correo = ?, departamento = ?, provincia = ?, distrito = ?, cod_postal = ?, direccion = ?, rol = ? WHERE id = ?";
            $stmt = $this->conexion->prepare($consulta);
            if (!$stmt) {
                error_log("Error en prepare(): " . $this->conexion->error);
                return false;
            }
            $stmt->bind_param("ssssssssssi", $nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $id_persona);
        }
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }

    public function eliminar($id_persona){
        $consulta = "DELETE FROM persona WHERE id = ?";
        $stmt = $this->conexion->prepare($consulta);
        if (!$stmt) {
            error_log("Error en prepare(): " . $this->conexion->error);
            return false;
        }
        $stmt->bind_param("i", $id_persona);
        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }

}