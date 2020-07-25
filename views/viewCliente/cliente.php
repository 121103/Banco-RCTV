<?php
          
    $id = $_SESSION["user"];
  
?>
<div class="container my-3">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Cedula</th>
        <th>Usuario</th>
        <th>nombres</th>
        <th>apellidos</th>
        <th>Email</th>
        <th>Telefono</th>
      </tr>
    </thead>
    <tbody>
          
      <?php
          
      $ingreso = new MvcController();
      $ingreso -> vistaUsuarioController($id);
  
      ?>
         
    </tbody>
  </table>
</div>         