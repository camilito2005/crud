<?php

$opcion = $_REQUEST["accion"];
$id = $_REQUEST["id_arti"];

include_once "./conexion.php";
        $conexion = Conexion();

        $query = <<<SQL
        "SELECT id_arti,nombre,marca FROM articulos WHERE id_arti=$id";
SQL;

        $consulta = pg_query($conexion, $query);

        if (!$consulta) {
            echo "Error: No se pudo realizar la consulta";
        }
        $json = array();
        while ($item = pg_fetch_array($consulta)) {
            $json[] = array( // con [] concatena los valores en un array
                'id_arti' => $item['id_arti'], 
                'nombre' => $item['nombre'],
                'marca' => $item['marca']
            );
        }

        $jsonstring = json_encode($json[0]);
        echo $jsonstring;

/*if (!empty($_POST["name"]) and !empty($_POST["marca"])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        /*$datos = [
            "nombre" => $_POST["name"],
            "marca" => $_POST["marca"],
            "id" => $_REQUEST["id_arti"]
        ];

        $nombre = $_POST["name"];
        $marca = $_POST["marca"];
        $id = $_REQUEST["id_arti"];

        


       

        $consulta = pg_query($conexion, $query);

        if ($consulta) {
            echo "Registro actualizado";
        } else {
            if (!$consulta) {
                echo "error";
            }
        }
    }
}*/

?>