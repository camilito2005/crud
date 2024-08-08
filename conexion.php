<?php


function conexion(){
    $host ="127.0.0.1";  //  localhost 127.0.0.1 165.232.121.46 
    $port = "5432";
    $dbname = "bdr";
    $user = "postgres";
    $password = "camilo";

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


