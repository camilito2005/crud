<?php


function conexion(){
    $host ="165.232.121.46";
    $port = "5432";
    $dbname = "relaciones";
    $user = "smartinfo";
    $password = "smartinfo";

    $conexion = pg_connect("host=$host port=$port dbname=$dbname user= $user password=$password");

    /*if(!$conexion){
        echo "Error: No se ha podido conectar a la base de datos";
    }
    else{
        echo "Conexión exitosa";
    }*/

    return $conexion;

}

function Cerrar($conexion){
    sleep(5);
   
    pg_close($conexion);
    /*if ($conexion) {
        echo "Conexión cerrada";
    }
    else{
        echo "<br/>Error: No se ha podido cerrar la conexión";
    }*/

}

?>


