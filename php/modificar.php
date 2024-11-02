<?php
    $ruta = '../';
    require_once 'encabezado.php';

    include 'conexion.php';
    $conexion = conectar();

    if ($conexion && !empty($_GET['id']))
    {
        $id = $_GET['id'];
        $consulta = 'SELECT nombre, categoria, precio, foto
                     FROM articulo
                     WHERE id_articulo = ?';
        $sentencia = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($sentencia, 'i', $id);
        mysqli_stmt_execute($sentencia);
        mysqli_stmt_bind_result($sentencia, $nombre, $categoria, $precio, $foto);
        mysqli_stmt_store_result($sentencia);
        $cantFilas = mysqli_stmt_num_rows($sentencia);
        if ($cantFilas > 0)
        {
            mysqli_stmt_fetch($sentencia);
        }
    }
?>

<main class="container py-3">
    <section class="d-flex justify-content-center">
        <h2>Modificar: </h2>
        <a href="articulo_listado.php" class="btn btn-secondary rounded p-2">Cancelar</a>
        <form class="p-4 border rounded w-50" action="modificar_ok.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend class="text-center mb-4">Alta de Artículo</legend>

                <label for="nombre" class="form-label">Nombre del artículo</label>
                <input type="text" id="nombre" name="nombre" class="form-control mb-3" value="<?php echo $nombre?>">

                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" id="categoria" name="categoria" class="form-control mb-3" value="<?php echo $categoria?>">

                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" id="precio" name="precio" class="form-control mb-3" value="<?php echo $precio?>">

                <label for="imagen" class="form-label">Subir imagen del artículo</label>
                <input type="file" id="imagen" name="imagen" class="form-control mb-4">

                <input type="hidden" value="<?php echo $id?>" name="id">
                <button type="submit" class="btn btn-primary w-100">Actualizar</button>
            </fieldset>
        </form>
    </section>
</main>


<?php
    require_once 'pie.php';
?>