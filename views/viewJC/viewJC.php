<?php

  session_start();

  if (!$_SESSION["validarSU"]){
    
    header("location:../../index.php");

    exit();

  }

  $id = $_SESSION["user"];


  include "../templJC.php";
?>