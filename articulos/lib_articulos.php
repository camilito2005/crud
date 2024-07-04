<?php




function Guardar(){

    if (!empty($_POST["name"]) and !empty($_POST["marca"])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $array = [
                'nombre' => $_POST["name"],
                'marca' => $_POST["marca"]
            ];
            include "../conexion.php";

            $conexion = Conexion();
            
            
            $query = pg_query($conexion, "INSERT INTO articulos (nombre,marca) VALUES ('" . pg_escape_string($_POST['name']) . "','" . pg_escape_string($_POST['marca']) . "' )");
            
            if ($query) {
                header("Location: ../index.php");
            }
            else {
                if (!$query) {
                    echo "error";
                }
            }
        }
        
        
    }
    else {
        echo "campos vacios";
    }
    
    }

    
function Ver(){
        include_once "../conexion.php";
        $conexion = Conexion();
        $query = "SELECT * FROM articulos";
        $consulta = pg_query($conexion, $query);
        if ($consulta) {

            while ($item = pg_fetch_object($consulta)) {
                echo "<br>" . $item->id_arti . " " . $item->nombre . " " . $item->marca . "<a href='./articulos.php?accion=eliminar&id=" . $item->id_arti . "  '>Eliminar</a>" . "<a href='./articulos.php?accion=modificar&id=" . $item->id_arti . "'>Modificar</a>";

        }

        //
        }
        else {
            echo "Error: No se pudo realizar la consulta";
        }
        Cerrar($conexion);

    }

    function Editar(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            include_once "../conexion.php";
            $conexion = Conexion();
            $query = "SELECT * FROM articulos WHERE id_arti = $id";
            $consulta = pg_query($conexion, $query);
            if ($consulta) {
                $$item = pg_fetch_object($consulta);
                echo "<form action='./articulos.php?accion=actualizar' method='post'>";
                echo "<input type='text' name='name' value='" . $$item->nombre . "'>";
                echo "<input type='text' name='marca' value='" . $$item->marca . "'>";
                echo "<input type='hidden' name='id' value='" . $$item->id_arti . "'>";
                echo "<input type='submit' name='actualizar' value='modificar'>";
                echo "</form>";


            }
            else {
                echo "Error: No se pudo realizar la consulta";
            }
            Cerrar($conexion);
        }
    }

    function Actualizar(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $array = [
                'nombre' => $_POST["name"],
                'marca' => $_POST["marca"],
                'id' => $_POST["id"]
            ];
            include "../conexion.php";

            $conexion = Conexion();
            
            
            $query = pg_query($conexion, "UPDATE articulos SET nombre = '" . pg_escape_string($_POST['name']) . "', marca = '" . pg_escape_string($_POST['marca']) . "' WHERE id_arti = " . $_POST['id']);
            
            if ($query) {
                header("Location: ./articulos.php?accion=ver");
            }
            else {
                if (!$query) {
                    echo "error";
                }
            }
        }
    }
    
function Eliminar(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            include_once "../conexion.php";
            $conexion = Conexion();
            $query = "DELETE FROM articulos WHERE id_arti = $id";
            $consulta = pg_query($conexion, $query);
            if ($consulta) {
                header("Location: ./articulos.php?accion=ver");
            }
            else {
                echo "Error: No se pudo realizar la consulta";
            }
            Cerrar($conexion);
        }
    }



?>