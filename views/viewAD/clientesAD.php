<div class="container my-3">
    <form>
      <div class="form-group">
        <select name="opcion" class="custom-select">
          <option value="contrasena">Contraseña</option>
          <option value="correo">Correo Electronico</option>
          <option value="direccion_usu">Direccion</option>
          <option value="telefono">Telefono</option>
        </select>
      </div>
        
      <div class="form-group">
        <label>Cedula</label>
        <input type="number" name="cedula" id="id" class="form-control" placeholder="" aria-describedby="helpId" required>
      </div>
      <div class="form-group">
        <label>Entrada</label>
        <input type="text" name="campo1" id="cmp1" class="form-control" placeholder="" aria-describedby="helpId" required>
      </div>
      <div class="form-group">
        <label>Confirmar entrada</label>
        <input type="text" name="campo2" id="cmp2" class="form-control" placeholder="" aria-describedby="helpId" required>
      </div>


      <button type="submit" class = "btn btn-primary" onclick="return actInfo(this.form)">Actualizar</button>
    </form>
    <div class="container my-2" id="respuesta">
      
    </div>
    <script src = "../../js/admin.js"></script>
</div>