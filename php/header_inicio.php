<?php
    $ruta = '../';
    include_once 'encabezado.php';
?>
    <header class="d-flex justify-content-between align-items-center bg bg-light">
        <section class="p-2">
            <?php
                require_once 'funciones.php';

                date_default_timezone_set('America/Argentina/Tucuman');

                $fecha = date ('Y-m-d');

                $fechaString = establecerFecha($fecha);
                
                echo '<h6>'.$fechaString.'</h6>';
            ?>
        </section>
        