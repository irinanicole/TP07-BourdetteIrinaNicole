<?php
    $ruta = '../';
    include_once 'encabezado.php';

    if (!empty($_POST['nombre']) && !empty($_POST['categoria']) && !empty($_POST['precio']))
    {
        include_once 'conexion.php';
        $conexion = conectar();
        if ($conexion)
        {
            $nombre = $_POST['nombre'];
            $categoria = $_POST['categoria'];
            $precio = $_POST['precio'];
            if (!empty($_FILES['imagen']['size']))
            {
                $imagen = $_FILES['imagen']['name'];
                $consulta = 'INSERT INTO articulo(nombre, categoria, precio, foto) VALUES (?,?,?,?)';
                $sentencia = mysqli_prepare($conexion, $consulta);
                mysqli_stmt_bind_param ($sentencia, 'ssds', $nombre, $categoria, $precio, $imagen);
            } else {
                $consulta = 'INSERT INTO articulo(nombre, categoria, precio) VALUES (?,?,?)';
                $sentencia = mysqli_prepare($conexion, $consulta);
                mysqli_stmt_bind_param ($sentencia, 'ssd', $nombre, $categoria, $precio);
            }

            $q = mysqli_stmt_execute ($sentencia);

            if ($q)
            {
                echo '<p>¡Guardado exitoso!</p>';
            }
            else
            {
                echo '<p>No se pudieron guardar los datos :(</p>';
            }
            desconectar($conexion);
        }
    }
    else
    {
        echo '<p>Faltan datos</p>';
    }
    
    header ('refresh:3;url=articulo_alta.php');

    include_once 'pie.php';
?>