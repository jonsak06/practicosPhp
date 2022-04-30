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
        echo "Datos del estudiante:<br><br>";
        echo "Cédula: ".$rows[0]."<br>";
        echo "Nombre: ".$rows[1]."<br>";
        echo "Apellido: ".$rows[2]."<br>";
        echo "Edad: ".$rows[3]."<br>";
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
            mostrarEstudiante(mysqli_fetch_array($estudiante));
            echo "<br><a href='practicoAccesoDatos.html'>Volver</a>";
        }
        else 
        {
            echo "Estudiante no existe.<br>";
            echo "<br><a href='practicoAccesoDatos.html'>Volver</a>";
        }
    }

    //Mostrar un estudiante
    if(isset($_POST["muestraCedula"]))
    {
        $cedula = $_POST["muestraCedula"];
        if(existeEstudiante($conexion, $cedula))
        {
            $sql = "SELECT * FROM estudiante WHERE estudiante.ci = '$cedula'";
            $estudiante = mysqli_query($conexion,$sql);
            
            mostrarEstudiante(mysqli_fetch_array($estudiante));
        }
        else 
        {
            echo "Estudiante no existe.<br>";
            echo "<br><a href='practicoAccesoDatos.html'>Volver</a>";
        }

    }

    //Listado de estudiantes
    

?>