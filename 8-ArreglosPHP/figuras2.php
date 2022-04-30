<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctico de arreglos - Ejercicio 2</title>
</head>
<body>
    <form action="figuras2.php" method="post">
        <input min=0 max=6 type="number" name="figura" id="figura">
        <input type="submit" value="Ver imagen y nombre de la figura">
    </form>

    <?php
        $figuras =
        array(array("circulo" => "circulo.png"),
            array("cuadrado" => "cuadrado.png"),
            array("hexagono" => "hexagono.png"),
            array("rectangulo" => "rectangulo.png"),
            array("rombo" => "rombo.png"),
            array("trapecio" => "trapecioIsosceles.png"),
            array("triangulo" => "triangulo.png")
        );
        if(isset($_POST["figura"])) 
        {
            $index = $_POST["figura"];
            $nombreFigura = array_keys($figuras[$index])[0];
            $archivoFigura = $figuras[$index][$nombreFigura];
            echo $nombreFigura."<br>";
            echo "<img src='imagenes/".$archivoFigura."' alt='".$nombreFigura."'>";
        }
    ?>
    
</body>
</html>