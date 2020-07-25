<?php
    require "../controllers/controller.php";
    $registro = new MvcController();

    $funcion = $_POST["funcion"];
    echo json_encode($funcion());

    function olvidePwd(){
        global $registro;
        $user = $_POST["usuarioIngreso"];

        return $registro -> changePwd($user);
    }


    function cambiarContraseña(){
        global $registro;

        $pw1 = $_POST["contraseña"];
        $pw2 = $_POST["contraseñaR"];
        $cedula = $_POST["cedula"];

        return $registro -> cambiarContraseña($pw1, $pw2, $cedula);
    }   

?>