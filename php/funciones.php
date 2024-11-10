<?php
    function establecerFecha ($fecha)
    {
        $arregloFecha = explode ('-', $fecha);
        $año = $arregloFecha[0];
        $numeroMes = $arregloFecha[1];
        $dia = $arregloFecha[2];

        switch ($numeroMes)
        {
            case '01':
                $mes = 'Enero';
                break;
            
            case '02':
                $mes = 'Febrero';
                break;
            
            case '03':
                $mes = 'Marzo';
                break;
            
            case '04':
                $mes = 'Abril';
                break;
            
            case '05':
                $mes = 'Mayo';
                break;
            
            case '06':
                $mes = 'Junio';
                break;
            
            case '07':
                $mes = 'Julio';
                break;
            
            case '08':
                $mes = 'Agosto';
                break;
            
            case '09':
                $mes = 'Septiembre';
                break;
            
            case '10':
                $mes = 'Octubre';
                break;
            
            case '11':
                $mes = 'Noviembre';
                break;
            
            case '12':
                $mes = 'Diciembre';
                break;
            
            default:
                $mes = 'ERROR';
                break;
        }

        $fechaResultado = $dia.' de '.$mes.' de '.$año;

        return $fechaResultado;
    }
?>