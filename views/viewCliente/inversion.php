<?php
          
    $id = $_SESSION["user"];
  
?>

<div class="container my-3">
    <h3>Inversion</h3>
    <form method="post">
        <div class="form-group">
          <labelç>Cantidad</label>
          <input type="number" name="cantidad" class="form-control" placeholder="" aria-describedby="helpId">
          <small id="helpId" class="text-muted"></small>
        </div>

        <div class="form-group">
          <label >Plazo</label>
          <input type="number" name="plazo" class="form-control" placeholder="" aria-describedby="helpId">
          <small id="helpId" class="text-muted"></small>
        </div>

        <div class="form-group">
          <label >Cuenta Bancaria</label>
          <input type="text" name="cuentaBancaria" class="form-control" placeholder="" aria-describedby="helpId">
          <small id="helpId" class="text-muted"></small>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    
</div>

<?php
    if(!empty($_POST["cantidad"]) OR !empty($_POST["plazo"]) OR !empty($_POST["cuentaBancaria"])){
      $inversion = new MvcController();
      $inversion -> ingresarInversionController($id);
    }
    
?>