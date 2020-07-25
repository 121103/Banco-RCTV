<div class="container my-5">
    <form>
        <div class="form-group">
          <label >Cedula del cliente</label>
          <input type="number" name="cedula" class="form-control" placeholder="" aria-describedby="helpId">
          <small id="helpId" class="text-muted"></small>
        </div>

        <div class="container">
            <button id="bntS" class="btn btn-primary" onclick="return servicio(this.form)">Buscar</button>
        </div>
    </form>
    <div class="container my-3" id="resCliente">
    </div>

    <div class="container my-2" id="resServicio">
    </div>

    <div class="container my-10" id="codigo_serv">
    </div>

    <div class="container my-2" id="cronograma">
    </div>
    <script src="../../js/auxiliar.js"></script>
</div>
