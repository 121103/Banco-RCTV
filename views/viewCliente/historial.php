<?php
          
    $id = $_SESSION["user"];
    $historial = new MvcController();
?>

<!--  Prestamos -->
<div class="container my-3">
  <h3>Prestamos</h3>
  <div class="container my-3">
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>Cantidad $</th>
            <th>Plazo (meses)</th>
            <th>Garantia</th>
            <th>Valor garantia $</th>
            <th>Direccion garantia</th>
            <th>Fiador</th>
            <th>Fecha de solicitud</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>

          <?php

          $historial -> vistaHistorialPrestamoControler($id, 1, 0);
          $historial -> vistaHistorialPrestamoControler($id, 1, 2);
          $historial -> vistaHistorialPrestamoControler($id, 1, 1);
          $historial -> vistaHistorialPrestamoControler($id, 1, -1);

          ?>

        </tbody>
    </table>
    
  </div>
</div>
<!--  Inversiones -->





<div class="container my-3">
  <h3>Inversiones</h3>
  <div class="container my-3">
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>Cantidad $</th>
            <th>Plazo (meses)</th>
            <th>Cuenta bancaria</th>
            <th>Fecha de solicitud</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>

          <?php
          
          $historial -> vistaHistorialInversionControler($id, 2, 0);
          $historial -> vistaHistorialInversionControler($id, 2, 2);
          $historial -> vistaHistorialInversionControler($id, 2, 1);
          $historial -> vistaHistorialInversionControler($id, 2, -1);
    
          ?>

        </tbody>
    </table>
    
  </div>
</div>