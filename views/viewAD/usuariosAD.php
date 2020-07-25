<div class="container">
<form id="update">
      <div class="container">
        <div class="form-group my-3 mx-3">
          <label >Cedula</label>
          <input type="number" name="cedula" id="cedula" class="form-control" >
          <label >tipo</label>
          <input type="number" name="tipo" id="type" class="form-control" min="0" max="2" placeholder="" aria-describedby="helpId">
          <small id="helpId" class="text-muted">Tipo <br>
          [0: Jefe de credito] 
          [1: Auxiliar de credito] 
          [2: Usuario]</small>
          <br><br>
          <div class="form-group">
            <button id="btn1" class="btn btn-success" onclick=" return actualizar()">Actualizar</button>
          </div>
        </div>
        <div class="form-group my-3 mx-3">
          <table>
            <tr>
                <td>
                    <button id="btn2" class="btn btn-primary" onclick="return showAll()">Buscar</button>
                </td>
            </tr>
          </table>
        </div>

        <div class="container mx-3" id="respuesta"></div>
        
      </div>
    </form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../js/admin.js"></script>
</div>