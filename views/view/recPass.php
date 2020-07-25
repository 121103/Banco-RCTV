<?php
	$id = $_GET["id"];
?>


<!DOCTYPE html>
<html lang="es">
<head>

	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="../../css/stylepwd.css">
    <!-- <link rel="stylesheet" href="css/estilospropios.css"> -->
	<center>
    <title>
		Actualizar Contraseña
	</title>
    </center>
    
</head>
<body class="back" >
	
		<center>
			<div class="campoC">

				<h2>Actualizar contraseña</h2><br>
				<form id="" method="" action="">
					
					<label for="password"> Escribir nueva contraseña </label>
   					<input type="password" class="form-control" placeholder="" name="contraseña" required>
					<br>

					<label for="password"> Repetir nueva contraseña 	</label>
   					<input type="password" class="form-control" placeholder="" name="contraseñaR" required>
					<br>

					<button class="btn btn-primary" name="btnActualizar" onclick="return actualizar(this.form, '<?php echo $id ?>')">Actualizar</button>

				</form>

			</div>

			<div class="container" id="respuesta">
				
			</div>
		</center>


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="../../js/control.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>