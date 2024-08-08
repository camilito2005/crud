<?php

echo $_REQUEST["accion"];

echo $_REQUEST["id"];

$id = $_REQUEST["id"];

    include_once "./conexion.php";
    $conexion = Conexion();
    $query = <<< SQL
        "DELETE FROM articulos WHERE id_arti = $id";
SQL;
    $consulta = pg_query($conexion, $query);
    if ($consulta) {
        echo "Registro eliminado";
    }
    if (!$consulta) {
        echo "Error: No se pudo realizar la consulta";
    }
    Cerrar($conexion);

?> 