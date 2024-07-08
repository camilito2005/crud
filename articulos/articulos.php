<?php
include "./lib_articulos.php";
$opciones = $_GET["accion"];

if ($opciones == "guardar") {
    if (isset($_POST["actualizar"])) {
        Actualizar();
}
    else {
        if (!$_GET["id"]) {
        Guardar();
        }
    }

    
}
if($opciones == "eliminar"){
    Eliminar();
}



?>
   



