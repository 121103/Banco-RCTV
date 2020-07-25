<div class="container my-3">

    <form>
        <div class="form-group">
          <label>Cliente</label>
          <input type="number" id="id" name="cedula" class="form-control" placeholder="cedula" aria-describedby="helpId">
          <small id="helpId" class="text-muted"></small>

        </div>

        <div class="form-group">
        <button id="btnB" class="btn btn-primary" onclick="return buscarCliente(this.form)">Buscar Cliente</button>
        <button id="btnM" class="btn btn-primary" onclick="return mostrar()">Mostrar solicitudes</button>
        </div>
    </form>
    <div class="container" id="respuestaSolicitudes">
    </div>

    <div class="container" id="respuestaSolicitud">
    </div>
    
    <div class="container" id="respuestaCliente">
    </div>

    <div class="container" id="respuestaSolCliente">
    </div>

    <div class="container">
      <table class="table">

        <div class="container my-2" id="codigo_serv">
        </div>
        <div class="container my-2" id="respuestaCronograma">
        </div>
      </table>
    </div>

    <script src="../../js/jefe.js"></script>
</div>
