<h1>Ingreso</h1>

<form method="post">
  <div class="form-group">
    <label for="nombreUsuario">Usuario</label>
    <input type="text" class="form-control" aria-describedby="usuarioHelp" placeholder="Usuario" name="usuarioIngreso" required>
   </div>
  <div class="form-group">
    <label for="password">Contraseña</label>
    <input type="password" class="form-control" placeholder="Contraseña" name="passwordIngreso" required>
  </div>
    
  <button type="submit" class="btn btn-primary" value="Enviar">Enviar</button>
  <br>
  <div>
    <small id="helpId" class="text-muted">
    <a rel="nofollow" id="enlace" href="#" class="automatic" onclick="return olvidePwd()">¿Olvidaste tu contraseña?</a>
  </div>
  

  <div class="container mx-3" id="respuesta"></div>
  <script src="js/control.js"></script>
</form>

<?php

$ingreso = new MvcController();
$ingreso -> ingresoUsuarioController();

if(isset($_GET["action"])){

  if($_GET["action"] == "fallo"){

    echo "<div class=\"alert alert-danger\" role=\"alert\">
    Fallo al ingresar
      </div>";
  
  }

}

?>