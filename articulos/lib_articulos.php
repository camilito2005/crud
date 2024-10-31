
<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function Buscar($search)
{
    if (!empty($search)) {

        include_once "../conexion.php";
        $conexion = Conexion();
        $query = <<<SQL
        SELECT id_arti,nombre,marca FROM articulos WHERE nombre LIKE '%$search%';
SQL;
        $consulta = pg_query($conexion, $query);
        if (pg_num_rows($consulta) == 0) {
            echo "No se encontraron resultados";
        }
        if (!$consulta) {
            die("Query Failed");
        }

        $json = [];
        if (pg_num_rows($consulta) > 0) {
            while ($row = pg_fetch_array($consulta)) {
                $json[] = [
                    "id" => $row["id_arti"],
                    "nombre" => $row["nombre"],
                    "marca" => $row["marca"]

                ];
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }
    }
}


function Guardar()
{

    if (!empty($_POST["nombre"]) and !empty($_POST["marca"])) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $array = [
                'nombre' => $_POST["nombre"],
                'marca' => $_POST["marca"]
            ];
            include_once "../conexion.php";
            $conexion = Conexion();
    
    
            $query = pg_query($conexion, "INSERT INTO articulos (nombre,marca) VALUES ('" . pg_escape_string($array['nombre']) . "','" . pg_escape_string($array['marca']) . "' )");
    
            if (!$query) {
                die("Query Failed");
            } else {
                if ($query) {
                    echo "Guardado";
                }
            }
        }
    } else {
        echo "campos vacios";
    }
}

function Formulario()
{
    $html = <<<HTML
    <form id="task-form" class="formulario" method="post">
        <input class="texto" type="text"  id="nombre" name="name" placeholder="name">
        <input class="texto" type="text"  id="marca" name="marca" placeholder="marca">
        <input type="hidden" name="id_arti" id="id_arti">
        <input id="boton2" class="guardar" type="submit" name="guardar" value="guardar">
        <!--<input type="submit" name="actualizar" value="actualizar">-->

    </form>

HTML;
    echo $html;
}

function Ver(){
    include_once "./conexion.php";
    $conexion = Conexion();
    $query = <<<SQL
    "SELECT id_arti,nombre,marca FROM articulos";
SQL;
    $consulta = pg_query($conexion, $query);
    if (pg_num_rows($consulta) == 0) {
        echo "No hay registros";
    }
    if (!$consulta) {
        die("Query Failed");
    }

    if (pg_num_rows($consulta) > 0) {
        /*$html = <<<HTML
        <table class="tabla">
            <thead class="cabezera">
                <tr>
                    <th>id</th>
                    <th>nombre</th>
                    <th>marca</th>
                    <th>eliminar</th>
                    <th>modificar</th>
                </tr>
            </thead>
            <tbody id="taks">
HTML;*/
$json = [];
        while ($item = pg_fetch_object($consulta)) {
            $json[] = [
                "id" => $item->id_arti,
                "nombre" => $item->nombre,
                "marca" => $item->marca
            ];
            /*$id = $item->id_arti;
            $nombre = $item->nombre;
            $marca = $item->marca;

            $html .= <<<HTML
            <tr>
            <td>$id </td>
            <td>$nombre</td>
            <td>$marca</td>
            <td><a onclick="return Preguntas()" href="./articulos/articulos.php?accion=eliminar&id=  $id">Eliminar</a></td>

            <td id="$id">
                    <input type="hidden" name="id" value="$id" id="id$id">
                    <input type="hidden" name="nombre" value="$nombre" id="nombre$id">
                    <input type="hidden" name="marca" value="$marca" id="marca$id">
                    <button onclick="Hola($id)" id="Boton" id="miBoton">modificar</button>
            </td>
            </tr>

HTML;*/
        }

        $jsonstring = json_encode($json); // convierte el array en un objetos json 
        echo $jsonstring;
        /*$html .= <<<HTML
        </tbody>
        </table>
HTML;
        echo $html;*/
    } else {
        echo "error: No se pudo realizar la consulta";
    }
    Cerrar($conexion);
}

function Eliminar($id)
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        include_once "../conexion.php";
        $conexion = Conexion();
        $query = <<<SQL
        "DELETE FROM articulos WHERE id_arti = $id";
SQL;
        $consulta = pg_query($conexion, $query);
        if ($consulta) {
            header("Location: ../index.php");
        } else {
            echo "Error: No se pudo realizar la consulta";
        }
        Cerrar($conexion);
    }
}
function Actualizar()
{
    if (!empty($_POST["name"]) and !empty($_POST["marca"])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            /*$datos = [
                "nombre" => $_POST["name"],
                "marca" => $_POST["marca"],
                "id" => $_REQUEST["id_arti"]
            ];*/

            $nombre = $_POST["name"];
            $marca = $_POST["marca"];
            $id = $_REQUEST["id_arti"];

            include_once "../conexion.php";
            $conexion = Conexion();


            $query = <<<SQL
            "UPDATE articulos SET nombre='$nombre', marca='$marca'
                WHERE id_arti=$id";
SQL;

            $consulta = pg_query($conexion, $query);

            if ($consulta) {
                header("Location: ../index.php");
            } else {
                if (!$consulta) {
                    echo "error";
                }
            }
        }
    }
}
