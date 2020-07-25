
<?php

  session_start();

  if (!$_SESSION["validar"]){
    
    header("location:index.php?action=ingreso");

    exit();

  }
  $id = $_SESSION["user"];
  $ingreso = new MvcController();
?>



<h1>Usuarios</h1>


<div>
<?php 
  include "views/viewCliente/templCliente.php";
?>
</div>
