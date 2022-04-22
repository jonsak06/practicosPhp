<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctico de arreglos - Ejercicio 1</title>
</head>
<body>
    <form action="figuras.php" method="post">
        <select name="figuras" id="figuras">
            <option name="circulo">circulo</option>
            <option name="cuadrado">cuadrado</option>
            <option name="hexagono">hexagono</option>
            <option name="rectangulo">rectangulo</option>
            <option name="rombo">rombo</option>
            <option name="trapecio">trapecio</option>
            <option name="triangulo">triangulo</option>
        </select>
        <input type="submit" value="Ver imagen">
    </form>

    <?php
        $figuras =
        array("circulo" => "circulo.png",
            "cuadrado" => "cuadrado.png",
            "hexagono" => "hexagono.png",
            "rectangulo" => "rectangulo.png",
            "rombo" => "rombo.png",
            "trapecio" => "trapecioIsosceles.png",
            "triangulo" => "triangulo.png"
        );
        if(isset($_POST["figuras"])) 
        {
            echo "<img src='imagenes/".$figuras[$_POST["figuras"]]."' alt='".$_POST["figuras"]."'>";
        }
    ?>
    
</body>
</html>