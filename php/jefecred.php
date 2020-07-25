<?php
    require_once "../controllers/controllerJC.php";

    $funcion = $_POST["funcion"];
    $registro = new ControllerJC();

    echo json_encode($funcion());

    function mostrar(){
        global $registro;

        return $registro -> mostrarSolicitudesControllerJC();
    }

    function rechazar(){
        global $registro;
        $codigo = $_POST["codigo_soli"];

        return $registro -> rechazarSolicitudControllerJC($codigo);
    }

    function aprobar(){
        global $registro;
        $interes = 0.03;
        $codigo = $_POST["codigo_soli"];

        return $registro -> aceptarSolicitudController($codigo, $interes);

    }

    function buscarSolicitud(){
        global $registro;
        $codigo = $_POST["codigo_soli"];
        return $registro -> mostrarSolicitudControllerJC($codigo);
    }

    function buscarCliente(){
        global $registro;
        $cedula = $_POST["cedula"];
        return $registro -> buscarCliente($cedula);
    }

    function buscarCronograma(){
        global $registro;
        $codigo = $_POST["codigo_soli"];
        return $registro -> mostrarCronogramaJC($codigo);
    }
?>