<?php
    $conexion = mysqli_connect("localhost", "tallerPhp", "12345", "cure");

    function existeEstudiante($conexion, $cedula)
    {
        $sql = "SELECT * FROM estudiante WHERE estudiante.ci = '$cedula'";
        $resultado = mysqli_query($conexion, $sql);
        return mysqli_fetch_array($resultado) != null;
    }

    function mostrarEstudiante($rows)
    {
        echo "Cédula: ".$rows[0]."<br>";
        echo "Nombre: ".$rows[1]."<br>";
        echo "Apellido: ".$rows[2]."<br>";
        echo "Edad: ".$rows[3]."<br>";
    }

    function array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) 
            {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }

    //Creación de estudiante
    if(isset($_POST["crearCedula"]))
    {
        $cedula = $_POST["crearCedula"];
        
        if(!existeEstudiante($conexion, $cedula))
        {
            $nombre = $_POST["crearNombre"];
            $apellido = $_POST["crearApellido"];
            $edad = $_POST["crearEdad"];

            $sql = "INSERT INTO estudiante (ci, nombre, apellido, edad) VALUES ('$cedula', '$nombre', '$apellido', $edad)";
            mysqli_query($conexion, $sql);

            echo "<br>Estudiante creado.<br>";
            echo "<br><a href='practicoAccesoDatos.html'>Volver</a>";
        } 
        else
        {
            echo "Estudiante ya existe.<br>";
            echo "<br><a href='practicoAccesoDatos.html'>Volver</a>";
        }
    }

    //Borrado de estudiante
    if(isset($_POST["borrarCedula"]))
    {
        $cedula = $_POST["borrarCedula"];

        if(existeEstudiante($conexion, $cedula))
        {
            $sql = "DELETE FROM estudiante WHERE estudiante.ci = '$cedula'";
            mysqli_query($conexion, $sql);
            echo "Estudiante borrado.<br>";
            echo "<br><a href='practicoAccesoDatos.html'>Volver</a>";
        }
        else
        {
            echo "Estudiante no existe.<br>";
            echo "<br><a href='practicoAccesoDatos.html'>Volver</a>";
        }
    }

    //Modificación de estudiante
    if(isset($_POST["modCedula"]))
    {
        $cedula = $_POST["modCedula"];
        $edad = $_POST["modEdad"];
        if(existeEstudiante($conexion, $cedula))
        {
            $sql = "UPDATE estudiante SET edad = $edad WHERE estudiante.ci = '$cedula'";
            $sql2 = "SELECT * FROM estudiante WHERE estudiante.ci = '$cedula'";
            mysqli_query($conexion,$sql);
            $estudiante = mysqli_query($conexion,$sql2);
            echo "Estudiante actualizado.<br><br>";
            echo "Datos del estudiante:<br><br>";
            mostrarEstudiante(mysqli_fetch_array($estudiante));
            echo "<br><a href='practicoAccesoDatos.html'>Volver</a>";
        }
        else 
        {
            echo "Estudiante no existe.<br>";
            echo "<br><a href='practicoAccesoDatos.html'>Volver</a>";
        }
    }

    //Modificación de estudiante 2
    if(isset($_POST["modCedula2"]))
    {
        $cedula = $_POST["modCedula2"];
        if(existeEstudiante($conexion, $cedula))
        {
            $sql = "SELECT * FROM estudiante WHERE estudiante.ci = '$cedula'";
            $estudiante = mysqli_query($conexion,$sql);
            echo "Datos del estudiante:<br><br>";
            mostrarEstudiante(mysqli_fetch_array($estudiante));
            echo "<form action='practicoAccesoDatos.php' method='POST'>";
            echo "<input type='hidden' name='modCedula3' value='$cedula'>";
            echo "<br><input type='number' name='modEdad2' placeholder='Edad' min=0 required>";
            echo "<br><input type='submit' value='Modificar'><br>"; 
            echo "</form>";
            echo "<a href='practicoAccesoDatos.html'>Volver</a>";
        }
        else
        {
            echo "Estudiante no existe.<br>";
            echo "<br><a href='practicoAccesoDatos.html'>Volver</a>";
        }
    }
    if(isset($_POST["modEdad2"]))
    {
        $cedula = $_POST["modCedula3"];
        $edad = $_POST["modEdad2"];
        $sql = "UPDATE estudiante SET edad = $edad WHERE estudiante.ci = '$cedula'";
        mysqli_query($conexion,$sql);
        echo "Estudiante actualizado.<br>";
        echo "<br><a href='practicoAccesoDatos.html'>Volver</a>";
    }

    //Mostrar un estudiante
    if(isset($_POST["muestraCedula"]))
    {
        $cedula = $_POST["muestraCedula"];
        if(existeEstudiante($conexion, $cedula))
        {
            $sql = "SELECT * FROM estudiante WHERE estudiante.ci = '$cedula'";
            $estudiante = mysqli_query($conexion,$sql);
            
            echo "Datos del estudiante:<br><br>";
            mostrarEstudiante(mysqli_fetch_array($estudiante));
            echo "<br><a href='practicoAccesoDatos.html'>Volver</a>";
        }
        else 
        {
            echo "Estudiante no existe.<br>";
            echo "<br><a href='practicoAccesoDatos.html'>Volver</a>";
        }

    }

    //Listado de estudiantes
    if(isset($_POST["listado"]))
    {
        $sql = "SELECT * FROM estudiante";
        $resultado = mysqli_query($conexion, $sql);
        echo "Lista de estudiantes:<br><br>";
        $cantidadEstudiantes = 0;
        $estudiantes = array();

        while($rows = mysqli_fetch_array($resultado))
        {
            $estudiantes[$cantidadEstudiantes] = array(
                "Cedula" => $rows[0],
                "Nombre" => $rows[1],
                "Apellido" => $rows[2],
                "Edad" => $rows[3]
            );
            $cantidadEstudiantes++;
        }

        $colApellido = array_column($estudiantes, "Apellido");
        $colNombre = array_column($estudiantes, "Nombre");
        $estudiantes = array_orderby($estudiantes, 'Apellido', SORT_ASC, 'Nombre', SORT_ASC);

        echo "<table>";
        echo "<tr style='font-weight:bold;'>";
        echo "<td>Cédula</td>";
        echo "<td>Nombre</td>";
        echo "<td>Apellido</td>";
        echo "<td>Edad</td>";
        echo "</tr>";
        foreach($estudiantes as $estudiante)
        {
            echo "<tr>";
            foreach($estudiante as $v)
            {
                echo "<td>$v</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        
        echo "<br>Cantidad de estudiantes: ".$cantidadEstudiantes."<br>";
        echo "<br><a href='practicoAccesoDatos.html'>Volver</a>";
    }


?>