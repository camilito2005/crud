<?php
//include "../articulos/articulos/lib_articulos.php";
//include "./lib_articulos.php";
include "./lib_articulos.php";

//Ver();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$opciones = $_REQUEST["accion"];
$search = $_POST["search"];

if ($opciones == "guardar") {
    if ($_POST["nombre"] and $_POST["marca"]) {
        Guardar();
    }

    
} else {
    if (isset($_GET["id_arti"])) {
        Actualizar();
    }
}

if ($opciones == "modificar") {
    if ($_POST["nombre"] and $_POST["marca"]) {
        Actualizar();
    }
}

if ($opciones == "eliminar") {
    Eliminar($id);
}
if ($opciones == "buscar") {
    Buscar($search);
}
/*if ($opciones == "ver") {
    echo "mostrar"; 
    ver();
}*/

?>
