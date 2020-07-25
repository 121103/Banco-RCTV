<?php
          
    $id = $_SESSION["user"];
  
?>
<div class="container my-3">
    <form method="post">
        <table>
            <tr>
                <td>
                    <div class="container">
                    <h3>Prestamo</h3>
                    </div>
                </td>
                <td>
                    <div class="container mx-3">
                    <h3>Garantia</h3>
                    </div>
                </td>
                <td>
                <div class="container mx-3">
                    <h3>Fiador</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <div class="container">
                            
                                <div class="form-group">
                                <label >Cantidad</label>
                                <input type="number" name="cantidad" class="form-control" placeholder="" aria-describedby="helpId">
                                </div>
                                <div class="form-group">
                                <label >Plazo</label>
                                <input type="number" name="plazo" class="form-control" placeholder="" aria-describedby="helpId">
                                </div>

                                <div class="form-group">
                                <input type="radio" id="btnG" name="btnr" value="1" onClick="Garantia(this.form)"> Garantia
                                <br>
                                <input type="radio" id="btnf" name="btnr" value="2" onClick="Fiador(this.form)"> Fiador
                                <br><br>
                            </div>
                        </tr>
                    </table>
                </td>
                <td>
                    <div class="container mx-3">
                        <div class="form-group">
                        <label >Tipo </label>
                        <select name="tipo" disabled="true">
                            <option value="inmueble">Inmueble</option>
                            <option value="automovil">Automovil</option>
                        </select><br>
                        <!--<input type="number" name="tipoG" class="form-control" placeholder="" aria-describedby="helpId" disabled="true">-->
                        <small id="helpId" class="text-muted"></small>
                        </div>
                        <div class="form-group">
                        <label >Valor</label>
                        <input type="number" name="valorG" class="form-control" placeholder="" aria-describedby="helpId" disabled="true">
                        <div class="form-group">
                        <label >Ubicación</label>
                        <input type="text" name="ubicacionG" class="form-control" placeholder="" aria-describedby="helpId" disabled="true">
                        </div>
                        
                    </div>
                </td>
                <td>
                    <div class="container mx-3">
                        <div class="form-group">
                        <label >Cedula del fiador</label>
                        <input type="number" name="cedulaF" class="form-control" placeholder="" aria-describedby="helpId" disabled="true">
                        <br>
                        </div>
                        <br><br><br><br><br><br>
                    </div>
                </td>
            </tr>
        </table>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
<script src="js/prestamo.js"></script>

<?php
    if(!empty($_POST['btnr'])){

        $prestamo = new MvcController();
        $btnr = $_POST['btnr'];


        if($btnr == "1"){
            $prestamo->ingresoPrestamoGarantiaController($id);
        } else if ($btnr == "2"){
            $prestamo->ingresoPrestamoFiadorController($id);
        }
    }
    
?>