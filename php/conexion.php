<?php
    function conectar()
    {
        $servidor = 'localhost';
        $usuario = 'root';
        $clave = '';
        $baseDatos = 'labo2';

        // set_error_handler (function () {
        //     throw new Exception("Error");
        // });

        try {
            $conexion = mysqli_connect($servidor, $usuario, $clave, $baseDatos);
        }
        catch (Exception $e) {
            $conexion = false;
            echo '<p>Error. Comuníquese con su administrador.</p>';
        }
        
        return ($conexion);
    }

    function desconectar ($conexion)
    {
        if ($conexion)
        {
            mysqli_close($conexion);
        } else {
            echo '<p>No se puede desconectar porque no hay conexión abierta.</p>';
        }
    }
?>