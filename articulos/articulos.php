<?php
include "./lib_articulos.php";
$opciones = $_GET["accion"];

if ($opciones == "guardar") {
    guardar();
}

if ($opciones == "ver") {
    Ver();
}
if ($opciones == "eliminar") {
    Eliminar();
    # code...
}
if ($opciones == "modificar") {
    Editar();
    # code...
}
if($opciones == "actualizar"){
    Actualizar();
}

?>
   



