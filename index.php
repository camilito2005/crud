<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/formulario1.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>index</h2>
    <div>
        <form action="./articulos/articulos.php?accion=guardar" method="post">
            <input type="text" name="name" placeholder="name">
            <input type="text" name="marca" placeholder="marca">
            <input type="submit" name="submit"  value="guardar">
            
        </form>

    <form action="./articulos/articulos.php?accion=ver" method="post">
            <input type="submit" name="registros" value="ver">
        </form>

        

        
    </div>
</body>
</html>