<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/formulario4.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav class="navv">
        <form class="formu-buscar">
            <input class="buscar" type="search" id="search" placeholder="search">
        </form>
    </nav>
    <h2 class="titulo">index</h2>

    <?php
    include "./articulos/lib_articulos.php";
    Formulario();
    //ver();
    ?>
    
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
        
        </tbody>
    </table>
    <script src="./js/javascript.js">
        
    </script>
</body>

</html>