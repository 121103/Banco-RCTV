<?php

  $id = $_SESSION["user"];

?>

<div class="container my-3">

    <form id="solicitud">
        <div class="form-group">
          <label>Cedula</label>
          <input type="number" id="codigo" name="cedula" class="form-control" placeholder="" aria-describedby="helpId">
          <small id="helpId" class="text-muted"></small>

        </div>

        <div class="form-group">
        <button id="btnE" class="btn btn-success" onclick="return buscar(this.form)">Buscar cliente</button>
        <button id="btnM" class="btn btn-primary" onclick="return mostrar('<?php echo $id; ?>')">Mostrar solicitudes</button>
        </div>
    </form>
    <div class="container" id="respuestaSolicitud">   
    </div>

    <div class="container" id="respuestaUsuario">   
    </div>

</div>

<script src="../../js/auxiliar.js"></script>