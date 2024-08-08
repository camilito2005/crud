<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once "./conexion.php";
$conexion = Conexion();
$query = <<<SQL
"SELECT * FROM articulos";
SQL;
$consulta = pg_query($conexion, $query);

if (pg_num_rows($consulta) == 0) {
    echo "No hay registros";
}
if (!$consulta) {
    die("Query Failed");
}


if (pg_num_rows($consulta) > 0) {

    $json = array();
    while ($item = pg_fetch_array($consulta)) {
        $json[] = array( // con [] concatena los valores en un array
            'id_arti' => $item['id_arti'], 
            'nombre' => $item['nombre'],
            'marca' => $item['marca']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
Cerrar($conexion);
