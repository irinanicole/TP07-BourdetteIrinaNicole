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
        $consulta = 'DELETE FROM articulo WHERE id_articulo = ?';
        $sentencia = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($sentencia, 'i', $id);
        $resultado = mysqli_stmt_execute($sentencia);

        if ($resultado)
        {
            echo '<h2 class="text-success">Borrado existoso</h2>';
            header('refresh:3;url=articulo_listado.php');
        }
        else
        {
            echo '<h2 class="text-danger">No se pudo eliminar</h2>';
        }
    }
    else
    {
        echo '<p>No se puede realizar la Eliminación</p>';
        header('refresh:3;url=articulo_listado.php');
    }
    desconectar($conexion);
?>
    </section>

</main>
<?php
    require("pie.php");
?>