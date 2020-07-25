<?php

    require_once "../controllers/controllerAC.php";

    $funcion = $_POST["funcion"];
    $registro = new ControllerAC();
    
    echo json_encode($funcion());

    function enviar(){
        global $registro;
        $auxi = $_POST["auxiliar"];
        $codigo = $_POST["codigo_soli"];

        return $registro -> enviarSolicitudControllerAC($codigo, $auxi);
    }

    function rechazar(){
        global $registro;
        $codigo = $_POST["codigo_soli"];
        $auxi = $_POST["auxiliar"];
        return $registro -> rechazarSolicitudControllerAC($codigo, $auxi);
    }

    function mostrar(){
        global $registro;
        $user = $_POST["auxiliar"];
        return $registro ->mostrarSolicitudesControllerAC($user);
    }

    function buscar(){
        global $registro;
        $cedula = $_POST["cedula"];
        return $registro -> buscarInformacionClienteControllerAC($cedula);
    }

    function estudiar(){
        global $registro;
        $codigo = $_POST["codigo"];
        $user = $_POST["auxiliar"];
        return $registro -> buscarSolicitudControllerAC($codigo, $user);
    }

    function servicio(){
        global $registro;
        $cedula = $_POST["cedula"];
        return $registro -> buscarCliente($cedula);
    }


    function buscarCronograma(){
        global $registro;
        $codigo = $_POST["codigo_soli"];
        return $registro -> mostrarCronogramaAC($codigo);
    }

    function pagarCuota(){
        global $registro;
        $cronograma = $_POST["cronograma"];
        $cuota = $_POST["cuota"];
        return $registro -> pagarCuota($cronograma, $cuota);
    }
?>