<?php
    $ruta = '../';
    require_once 'encabezado.php';
?>
<!-- Header del ejercicio 01 del tp05 -->
<header class="d-flex flex-row justify-content-end align-items-center">
<?php
    include_once 'conexion.php';
    $conexion = conectar();
    if ($conexion && !empty($_GET['usu']))
    {
        $usuario = $_GET['usu']; // utilizo este dato de la página 'logueo.php' para buscar la imagen específica de ese usuario
        $consulta = 'SELECT usuario, foto FROM usuario WHERE usuario= ?';
        $sentencia = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param ($sentencia, 's', $usuario);
        mysqli_stmt_execute ($sentencia);
        mysqli_stmt_bind_result ($sentencia, $usu, $foto); // tomo los datos de usuario y foto y los guardo en variables
        mysqli_stmt_fetch($sentencia);
        echo '<h1 class="text-dark p-2">'.$usu.'</h1>';
        // Ahora analizo si el usuario tiene foto o ese campo está vacío
        if (!empty($foto))
        {
            echo '<img class="img-fluid rounded m-2 p-1" style="width: 10%;height: 10%;" src="../img/usuarios/'.$foto.'">';
        }
        else
        {
            echo '<img class="img-fluid rounded m-2 p-1" style="width: 10%;height: 10%;" src="../img/usuarios/usuario_default.png">';
        }
        desconectar($conexion);
    }
?>
</header>

<main class="container">
    <section>
        <article class="row text-center">
            <section class="menu_tmp pt-3 pb-3">
                <a class="btn btn-dark" href="articulo_alta.php">+ Alta Articulo</a>
            </section>
            <section class="d-flex justify-content-center">
                <table class="table table-bordered table-hover table-striped w-auto">
                    <caption class="caption-top text-center bg-dark text-white">Listado de articulos</caption>
                    <thead>
                        <tr>
                            <th class="bg-secondary text-white">Foto</th>
                            <th class="bg-secondary text-white">Producto</th>
                            <th class="bg-secondary text-white">Categoria</th>
                            <th class="bg-secondary text-white">Precio</th>
                            <th class="bg-secondary text-white">Modificar</th>
                            <th class="bg-secondary text-white">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $newConexion = conectar();
                        if ($newConexion)
                        {
                            $newConsulta = 'SELECT id_articulo, nombre, categoria, precio, foto FROM articulo';
                            $newSentencia = mysqli_prepare ($newConexion, $newConsulta);
                            $newQ = mysqli_stmt_execute($newSentencia);
                            if ($newQ)
                            {
                                mysqli_stmt_bind_result ($newSentencia, $id, $nombre, $categoria, $precio, $fotoProd); // vinculo resultados con variables
                                mysqli_stmt_store_result($newSentencia);
                                while (mysqli_stmt_fetch($newSentencia)) {
                                ?>
                                    <tr class="align-middle">
                                        <td>
                                            <?php
                                            if (!empty($fotoProd))
                                            {
                                                echo '<img class="img-fluid" src="../img/articulos/'.$fotoProd.'">';
                                            }
                                            else
                                            {
                                                echo '<img class="img-fluid" src="../img/articulos/sin_imagen.png">';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                        <?php echo $nombre?>
                                        </td>
                                        <td>
                                        <?php echo $categoria?>
                                        </td>
                                        <td>
                                        <?php echo '$ '.number_format($precio,0,'','.')?>
                                        </td>
                                        <td>
                                            <?php echo '<a href="modificar.php?id='.$id.'">';?><img src="../img/iconos/modificar.png" class="p-4" alt="modificar"></a>
                                        </td>
                                        <td>
                                            <?php echo '<a href="eliminar.php?id='.$id.'">';?><img src="../img/iconos/eliminar.png" class="p-4" alt="eliminar"></a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                        desconectar($newConexion);
                    }
                        ?>
                    </tbody>
                </table>
            </section>
        </article>
    </section>
</main>

<?php
    require_once 'pie.php';
?>