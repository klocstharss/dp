<?php
require_once "../config/config.php";
class conexion
{
    public static function conect(){
        $mysql = new mysqli(BD_HOST, BD_USER, BD_PASSWORD, BD_NAME);
        $mysql -> set_charset(BD_CHARSET);
        date_default_timezone_set("America/Lima");
        if (mysqli_connect_errno()) {
    die("conexion fallida". mysqli_connect_errno());
    } else{
        echo "conexion exitosa";
        }
    }
}

$mysql = new mysqli(BD_HOST, BD_USER, BD_PASSWORD, BD_NAME);
$mysql -> set_charset(BD_CHARSET);
date_default_timezone_set("America/Lima");
if (mysqli_connect_errno()) {
    die("conexion fallida". mysqli_connect_errno());
} else{
    echo "conexion exitosa";
}

