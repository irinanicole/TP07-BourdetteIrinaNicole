<?php
    $ruta = '../';
    require_once 'encabezado.php';
    require_once 'header_inicio.php';
    require_once 'header_fin.php';
?>
<main class="container py-3">
    <section class="d-flex flex-column justify-content-center align-items-center">
<?php
    require_once 'conexion.php';
    $conexion = conectar();

    if ($conexion && !empty($_POST['id']) && !empty($_POST['nombre']) && !empty($_POST['categoria']) && !empty($_POST['precio']))
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $precio = $_POST['precio'];
        if (!empty($_FILES['imagen']['size']))
        {
            $foto = $_FILES['imagen']['name'];
            $origen = $_FILES['imagen']['tmp_name'];
            $carpeta = '../img/articulos/';
            if (!file_exists($carpeta))
            {
                mkdir($carpeta);
            }
            $destino = $carpeta.$foto;
            $r = move_uploaded_file ($origen, $destino);
            if ($r) {
                echo '<p><strong>*Imagen nueva subida correctamente*</strong></p>';
            } else {
                echo '<p class="text-danger"><strong>No se pudo subir la imagen</strong></p>';
            }
            echo '<br>';
        }
        else
        {
            $foto = '';
            $traerImagenActual = 'SELECT foto
                            FROM articulo
                            WHERE id_articulo = ?';
            $sql = mysqli_prepare($conexion, $traerImagenActual);
            mysqli_stmt_bind_param($sql, 'i', $id);
            mysqli_stmt_execute($sql);
            mysqli_stmt_bind_result($sql, $fotoEliminar);
            mysqli_stmt_store_result($sql);
            mysqli_stmt_fetch($sql);
            if (!empty($fotoEliminar)) {
                $ubicacionArchivo = '../img/articulos/'.$fotoEliminar;
                unlink($ubicacionArchivo);
            }
        }
        $consulta = 'UPDATE articulo
                     SET nombre = ?, categoria = ?, precio = ?, foto = ?
                     WHERE id_articulo = ?';
        $sentencia = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($sentencia, 'ssdsi', $nombre, $categoria, $precio, $foto, $id);
        $estado = mysqli_stmt_execute($sentencia);
        if ($estado)
        {
            echo '<h2 class="text-light">Actualización Exitosa!</h2>';
        }
        else
        {
            echo '<h2 class="text-danger">No se pudo Actualizar :(</h2>';
        }
        //header('refresh:3;url=articulo_listado.php');
    }
?>
   
    </section>
</main>


<?php
    require_once 'pie.php';
?>