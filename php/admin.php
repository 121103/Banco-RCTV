<?php
    require_once "../controllers/controllerAD.php";


    $funcion = $_POST["funcion"];
    $solicitud = new ControllerAD();

    echo json_encode($funcion());


    function autorizarUsuario(){
        global $solicitud;
        $id = $_POST["cedula"];
        $tipo = $_POST["tipo"];

        return $solicitud -> autorizarUsuariosController($id, $tipo);
    }

    function mostrarUsuarios(){
        global $solicitud;
        return $solicitud -> mostrarUsuariosController();
    }

    function actualizarInfo(){
        global $solicitud;

        $tipo = $_POST["opcion"];
        $cedula = $_POST["cedula"];
        $campo1 = $_POST["cmp1"];
        $campo2 = $_POST["cmp2"];

        return $solicitud -> actualizarInfo($tipo, $cedula, $campo1, $campo2);
    }
?>