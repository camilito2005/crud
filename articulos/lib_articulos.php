<script>
    function Ocultar(){

// guardo el valor de id en la variable miBoton
const boton1 = document.getElementById("Boton");
// guardo el valor de id en la variable boton2
const boton2 = document.getElementById("boton2");

// si el boton1 es clickeado se oculta el boton2

boton1.addEventListener("click", () => {
  boton2.style.display = "none";
  console.log("hola");
});
document.getElementById("boton2").style.display = "none";


}
</script>
<?php


function Guardar()
{

    if (!empty($_POST["name"]) and !empty($_POST["marca"])) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $array = [
                'nombre' => $_POST["name"],
                'marca' => $_POST["marca"]
            ];
            include "../conexion.php";

            $conexion = Conexion();


            $query = pg_query($conexion, "INSERT INTO articulos (nombre,marca) VALUES ('" . pg_escape_string($array['nombre']) . "','" . pg_escape_string($array['marca']) . "' )");

            if ($query) {
                header("Location: ../index.php");
            } else {
                if (!$query) {
                    echo "error";
                }
            }
        }
    } else {
        echo "campos vacios";
    }
}

function Formulario(){
    $html = <<<HTML
    <form class="formulario" action="./articulos/articulos.php?accion=guardar" method="post">
        <input class="texto" type="text"  id="nombre" name="name" placeholder="name">
        <input class="texto" type="text"  id="marca" name="marca" placeholder="marca">
        <input type="hidden" name="id_arti" id="id_arti">
        <input id="boton2" class="guardar" type="submit" name="submit" value="guardar">
        <input type="submit" name="actualizar" value="actualizar">

    </form>

HTML;
echo $html;
}

function Ver()
{
    include_once "./conexion.php";
    $conexion = Conexion();
    $query = "SELECT * FROM articulos";
    $consulta = pg_query($conexion, $query);
    if (pg_num_rows($consulta) == 0) {
        echo "No hay registros";
    }

    if (pg_num_rows($consulta) > 0) {
        $html = <<<HTML
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
            <tbody>
HTML;
        while ($item = pg_fetch_object($consulta)) {
            $id = $item->id_arti;
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
                    <button onclick="Hola($id)" id="Boton" onclick="Ocultar()" id="miBoton">prueba</button>
                <button class="" onclick="Ocultar()" >modificar</button>
            </td>
            </tr>

HTML;
        }
        $html .= <<<HTML
        </tbody>
        </table>
HTML;
        echo $html;
    } else {
        echo "Error: No se pudo realizar la consulta";
    }
    Cerrar($conexion);
}

function Eliminar()
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        include_once "../conexion.php";
        $conexion = Conexion();
        $query = "DELETE FROM articulos WHERE id_arti = $id";
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
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if (!empty($_POST["name"]) and !empty($_POST["marca"])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $datos = [
                "nombre" => $_POST["name"],
                "marca" => $_POST["marca"],
                "id" => $_REQUEST["id_arti"]
            ];

            /*$nombre = $_POST["name"];
            $marca = $_POST["marca"];
            $id = $_REQUEST["id_arti"];*/

            include "../conexion.php";

            $conexion = Conexion();


            $query = "UPDATE articulos SET nombre='[nombre]', marca='$marca'
                WHERE id_arti=$id";

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
