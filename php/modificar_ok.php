<?php
    $ruta = '../';
    require_once 'encabezado.php';

    require_once 'conexion.php';
    $conexion = conectar();

    if ($conexion && !empty($_POST['id']) && !empty($_POST['nombre']) && !empty($_POST['categoria']) && !empty($_POST['precio']))
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $precio = $_POST['precio'];
        if (!empty($_FILES['foto']['size']))
        {
            $foto = $_FILES['foto']['name'];
            $origen = $_FILES['foto']['tmp_name'];
            $carpeta = '../img/articulos/';
            if (!file_exists($carpeta))
            {
                mkdir($carpeta);
            }
            $destino = $carpeta.$foto;
            move_uploaded_file($origen,$destino);
        }
        else
        {
            $foto = '';
        }
        $consulta = 'UPDATE articulo
                     SET nombre = ?, categoria = ?, precio = ?, foto = ?
                     WHERE id_articulo = ?';
        $sentencia = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($sentencia, 'ssdsi', $nombre, $categoria, $precio, $foto, $id);
        $estado = mysqli_stmt_execute($sentencia);
        if ($estado)
        {
            echo '<h3>Actualización Exitosa</h3>';
        }
        else
        {
            echo '<h3>No se pudo Actualizar</h3>';
        }
        header('refreh:3;url=articulo_listado.php');
    }
?>

<main class="container py-3">
    <section class="d-flex justify-content-center">
        
    </section>
</main>


<?php
    require_once 'pie.php';
?>