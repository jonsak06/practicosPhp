<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario nombres</title>
</head>
<body>
    <form action="nombres.php" method="post">
        <input type="number" name="fcantidad" min="1">
        <input type="submit" value="Enviar">
    </form>
    <?php 
            if(isset($_POST["fcantidad"]))
            {
                echo "<br>";
                echo "<form>";
                $cant = $_POST["fcantidad"];
                for($i = 0; $i < $cant; $i++)
                {
                    echo "<input placeholder='Nombre' name='nombre", $i ,"' type='text'>";
                    echo "<br>";
                    echo "<br>";
                }
                echo "<input type='submit' value='Enviar'>";
                echo "</form>";
            }
        ?>
    
</body>
</html>