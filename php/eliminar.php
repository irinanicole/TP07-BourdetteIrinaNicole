<?php
    $ruta = '../';
    require_once ("encabezado.php");
    require_once 'header_inicio.php';
    require_once 'header_fin.php';
?>
<main class="container-fluid text-center">
    <section class="d-flex flex-column justify-content-center">
        <?php
    require_once 'conexion.php';
    $conexion = conectar();
    
    if ($conexion && !empty($_GET['id']))
    {
        $id = $_GET['id'];
        $consulta = 'SELECT nombre FROM articulo WHERE id_articulo = ?';
        $sentencia = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($sentencia, 'i', $id);
        mysqli_stmt_execute($sentencia);
        mysqli_stmt_bind_result($sentencia, $nombre);
        mysqli_stmt_store_result($sentencia);
        $cantidadFilas = mysqli_stmt_num_rows($sentencia);
        if ($cantidadFilas > 0)
        {
            mysqli_stmt_fetch($sentencia);
            echo '<h2>Eliminar Articulo</h2>';
            echo '<p>¿Está seguro que quiere eliminar el artículo <strong>'.$nombre.'</strong>?</p>';
            echo '<section><a href="eliminar_ok.php?id='.$id.'" class="btn btn-primary m-1">Aceptar</a>';
            echo '<a href="articulo_listado.php" class="btn btn-primary m-1">Cancelar</a></section>';
        }
        desconectar($conexion);
    }
    else
    {
        echo '<p>No se puede realizar la operación</p>';
        header('refresh:3;url=articulo_listado.php');
    }
    
    ?>
    </section>

</main>

<?php
    require("pie.php");
?>