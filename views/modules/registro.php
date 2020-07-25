<h1>Registro de Usuarios</h1>
<div class="container mx-3" id="respuesta"></div>
<form id="registrar">
  <div class="form-group">
    <label>Nombre de Usuario</label>
    <input type="text" class="form-control" aria-describedby="usuarioHelp" name="usuarioRegistro" required>
    <small class="form-text text-muted">El nombre de usuario es obligatorio</small>
  </div>
  <div class="form-group">
    <label>Contraseña</label>
    <input type="password" class="form-control" name="passwordRegistro" required>
  </div>

  <div class="form-group">
    <label>Confirmar contraseña</label>
    <input type="password" class="form-control" name="confirm_pwd" required>
  </div>

  <div class="form-group">
    <label>Cedula</label>
    <input type="number" class="form-control" name="cedula" required>
  </div>

  <div class="form-group">
    <label>Nombre</label>
    <input type="text" class="form-control" name="nombre" required>
  </div>

  <div class="form-group">
    <label>apellido</label>
    <input type="text" class="form-control" name="apellido" required>
  </div>

  <div class="form-group">
    <label >Correo Electrónico</label>
    <input type="email" class="form-control" aria-describedby="emailHelp" name="emailRegistro" required>
  </div>

  <div class="form-group">
    <label>Fecha de nacimiento</label>
    <input type="date" class="form-control" name="nacimiento" required>
  </div>

  <div class="form-group">
    <label>Telefono</label>
    <input type="number" class="form-control" name="telefono" required>
  </div>

  <div class="form-group">
    <label>Direccion</label>
    <input type="text" class="form-control" name="direccion" required>
  </div>
  
  <button type="submit" class="btn btn-primary" value="Enviar">Enviar</button>
</form>
<script src="http://localhost//rctv//js//form.js"></script>
