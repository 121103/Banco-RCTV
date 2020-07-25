<?php

	require_once "/xampp/htdocs/rctv/models/crud.php";
	require_once "/xampp/htdocs/rctv/models/crudAd.php";

	class MvcController{

		public function plantilla(){

			include "views/template.php";
		}

		public function enlacesPaginasController(){

			if(isset($_GET["action"])){

			$enlacesController = $_GET["action"];
			}

			else{

			$enlacesController = "index";
			
			}

			$respuesta = EnlacesPaginas::enlacesPaginasModel($enlacesController);

			include $respuesta;

		}


		public function enlacesOpcionController(){

			if(isset($_GET["option"])){

			$enlacesController = $_GET["option"];
			}
			else{

			$enlacesController = "views/modules/usuarios.php";
			
			}
			$respuesta = EnlacesPaginas::enlacesOpcionModel($enlacesController);
			include $respuesta;

		}



		public function registroUsuarioController($datosController){
			return Datos::registroUsuarioModel($datosController, "usuarios");
		}




		public function ingresoUsuarioController(){

			if(isset($_POST["usuarioIngreso"])){
				$datosController = array( "usuario"=>strtolower($_POST["usuarioIngreso"]), 
								      "password"=>$_POST["passwordIngreso"]);

				$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
			if($respuesta["usuario"] == $_POST["usuarioIngreso"] && password_verify($_POST["passwordIngreso"], $respuesta["contrasena"])){
				
				session_start();

				
				$_SESSION["user"] = $respuesta["cedula"];

				if ($respuesta["tipo"] == -1){
					$_SESSION["validarSU"] = true;

					header("location:views/viewAD/viewAD.php");
				} else if ($respuesta["tipo"] == 0){
					$_SESSION["validarSU"] = true;

					header("location:views/viewJC/viewJC.php");
				} else if ($respuesta["tipo"] == 1){
					$_SESSION["validarSU"] = true;

					header("location:views/viewWr/viewAC.php");
				} else {
					$_SESSION["validar"] = true;
					header("location:index.php?action=usuarios");
				}
			}
			else{
				header("location:index.php?action=fallo");
			}
			
			
			}
		}

		public function vistaUsuarioController($user){

			$respuesta = Datos::vistaUsuarioModel("usuarios", $user);
			foreach ($respuesta as $row) {
			
				echo '<tr>
			          <td>'.$row["cedula"].'</td> 
			          <td>'.$row["usuario"].'</td> 
			          <td>'.$row["nombres"].'</td> 
			          <td>'.$row["apellidos"].'</td> 
					  <td>'.$row["correo"].'</td>
					  <td>'.$row["telefono"].'</td> 
				          <!--<td>
				              <a href="#" class="btn btn-success">
				                Editar
				              </a>
				              <a href="#" class="btn btn-danger">
				               Eliminar
				              </a>
			           	</td>-->
	          	  </tr>';
        	}
		}


		public function repeatUserController($user){
			$respuesta = Datos::repeatUserModel($user);
			
			if (count($respuesta) > 0){
				return true;
			}

			return false;
		}

		public function repeatIdController($id){
			$respuesta = Datos::repeatIdModel($id);
			
			if (count($respuesta) > 0){
				return true;
			}

			return false;
		}

		public function repeatEmailController($email){
			$respuesta = Datos::repeatEmailModel($email);
			
			if (count($respuesta) > 0){
				return true;
			}

			return false;
		}



		public function fieldEmpty($user, $pwd, $pwd_con, $id, $name, $lastname, $email, $birthdate, $phone, $dir){
			if (strlen($user) <= 0 || strlen($pwd) <= 0 || strlen($pwd_con) <= 0 || strlen($id) <= 0 ||
			strlen($name) <= 0|| strlen($lastname) <= 0 || strlen($email) <= 0 || strlen($birthdate) == 0 || strlen($phone) <= 0 || strlen($dir) <= 0) { 
				return true;
			}
			return false;
		}
	
	
		public function validPwd($pwd, $pwd_con){
			if(strcmp($pwd,$pwd_con) == 0){
				return true;
			}
			return false;
		}
	
		public function validEmail($email){
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return true;
			}
			return false;
		}
	
	
		public function calculateAge($birthdate){
			list($year,$month,$day) = explode("-",$birthdate);
			$age  = date("Y") - $year;
			$month_bd = date("m") - $month;
			$day_bd = date("d") - $day;
			if ($day_bd < 0 || $month_bd< 0)
				$age--;
			return $age;
		}
	
		public function sendEmail($correo, $nombre, $asunto, $cuerpo){
			require_once "../PHPMailer/PHPMailerAutoload.php";
	
			$mail = new PHPMailer();
		
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "tls";
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 587;
		
			$mail->Username = "bridgeline3304@gmail.com"; //Correo de donde enviaremos los correos
			$mail->Password = "BridgeLine2020"; // Password de la cuenta de envío
		
			$mail->setFrom("bridgeline3304@gmail.com", "Bridge Line");
			$mail->addAddress($correo, $nombre); //Correo receptor
		
		
			$mail->Subject = $asunto;
			$mail->Body    = $cuerpo;
		
			if($mail->send()) {
				return true;
			}
			return false;
		}
	
		public function showFails($fails){
			$msg = "";
			if (count($fails) > 0){
				$msg = $msg."<div class=\"alert alert-danger\" role=\"alert\">
				<ul>";
				foreach($fails as $error){
					$msg = $msg."<li>".$error."</li>";
				}
				$msg = $msg."</il>";
				$msg = $msg."</div>";
			}
			return $msg;
		}
	
		
		public function encrypPwd($pwd){
			return password_hash($pwd, PASSWORD_DEFAULT);
		}
	
		public function validAccount($correo, $nombre, $user){
	
			/*$url = "http://localhost/phpproject/login/activar.php?id=".$user;
			$asunto = "Bridge Line ";
			$cuerpo = "HOLA te damos la bienvenida a Bridge Line\n
					 Gracias por crear una cuenta.\nCuando verifiques tu correo electronico 
					 podras acceder a todos nuestros servicios. \nPara activar tu cuenta debes dar clic en
					 el siguiente enlace \n$url";
			
			return $this -> sendEmail($correo, $nombre, $asunto, $cuerpo);*/
			return true;
		}

		public function ingresoPrestamoGarantiaController($user){
			$resultadoPrest = Datos::buscarSolicitudModel($user, 1, 0);
			$resultadoInver = Datos::buscarSolicitudModel($user, 2, 0);

			if (count($resultadoPrest) == 0 && count($resultadoInver) == 0){

				$datos = $this->solicitudPrestamoVacio($_POST["cantidad"], $_POST["plazo"], 
				$_POST["valorG"], $_POST["ubicacionG"], $_POST["tipo"], $user);

				if (!is_null($datos)){

					if (Datos::registroPrestamoGarantiaModel($datos, "solicitud")){
						echo "<div class=\"alert alert-success\" role=\"alert\">
						La solicitud se ha registrado correctamente
					  </div>";
					} else {
						echo "<div class=\"alert alert-danger\" role=\"alert\">
						Datos incorrectos
						  </div>";
					}
				} else {
					echo "<div class=\"alert alert-danger\" role=\"alert\">
					Campos vacios
				  	</div>";
				}
			} else {
				echo "<div class=\"alert alert-warning\" role=\"alert\">
				Ya tienes una solicitud en proceso
			  </div>";
			}
		}

		private function solicitudPrestamoVacio($campo1, $campo2, $campo3, $campo4, $campo5, $campo6){
			if (!empty($campo1)  || !empty($campo2)  || 
			!empty($campo3)  || !empty($campo4)  )
			{
				return [ "cantidad" => floatval($campo1),
				"plazo" => $campo2,
				"valorG" => floatval($campo3),
				"ubicacionG" => $campo4,
				"tipoG" => $campo5,
				"usuario" => $campo6
				];
			} else {
				return Null;
			}
		}


		public function vistaHistorialPrestamoControler($user, $tipo, $aprob){
			$respuesta = Datos::buscarSolicitudModel($user, $tipo, $aprob);
			foreach ($respuesta as $row) {
				echo '<tr>
			          <td>'.$row["cantidad"].'</td> 
			          <td>'.$row["plazo"].'</td> 
			          <td>'.$row["tipoG"].'</td> 
					  <td>'.$row["valorG"].'</td> 
					  <td>'.$row["direccionG"].'</td> 
			          <td>'.$row["fiador"].'</td> 
					  <td>'.$row["fecha_soli"].'</td>
					  <td>'.$this -> tipoSoli($row["aprobada"]).'</td>  
	          	  </tr>';
        	}
		}

		private function tipoSoli($aprob){
			if ($aprob == "0"){
				return "pendiente";
			}
			if ($aprob == "1"){
				return "aprobado";
			}
			if ($aprob == "2"){
				return "En estudio";
			}
			if ($aprob == "-1"){
				return "rechazado";
			}

		}

		public function ingresoPrestamoFiadorController($user){

			//Busca solicitudes pendientes del usuario
			$resultadoPrest = Datos::buscarSolicitudModel($user, 1, 0);
			$resultadoInver = Datos::buscarSolicitudModel($user, 2, 0);

			// valida que no tenga solicitudes pendientes
			if (count($resultadoPrest) == 0 && count($resultadoInver) == 0){

				//valida que no haya campos vacios
				$datos = $this->solicitudPrestamoVacioFiador($_POST["cantidad"], $_POST["plazo"],
				$_POST["cedulaF"], $user);

				if (!is_null($datos)){

					//Valida que el fiador sea un cliente
					$fiador = Datos::buscarClienteModel($_POST["cedulaF"]);
					if (count($fiador) > 0) {
						
						//Registra la solicitud
						if(Datos::registroPrestamoFiadorModel($datos, "solicitud")){
							echo "<div class=\"alert alert-success\" role=\"alert\">
							La solicitud se ha registrado correctamente
							  </div>";
						} else {
							echo "<div class=\"alert alert-danger\" role=\"alert\">
							Datos incorrectos
							  </div>";
						}

					} else {

						echo "<div class=\"alert alert-danger\" role=\"alert\">
							El fiador no existe
							  </div>";

					}

					
				} else {
					echo "<div class=\"alert alert-danger\" role=\"alert\">
					Campos vacios
				  	</div>";
				}
			} else {
				echo "<div class=\"alert alert-warning\" role=\"alert\">
				Ya tienes una solicitud en proceso
			  	</div>";
			}
		}



		private function solicitudPrestamoVacioFiador($campo1, $campo2, $campo3, $campo4){
			if (!empty($campo1) AND !empty($campo2) AND !empty($campo3))
			{
				return [
					"cantidad" => floatval($campo1),
					"plazo" => $campo2,
					"fiador" => $campo3,
					"usuario" => $campo4
				];
			} else {
				return null;
			}
		}

		public function ingresarInversionController($id){
			$resultadoInver = Datos::buscarSolicitudModel($id, 2, 0);
			$resultadoPrest = Datos::buscarSolicitudModel($id, 1, 0);

			if (count($resultadoInver) == 0 && count($resultadoPrest) == 0){
				
				$datos = $this -> solicitudInvesionVacio($_POST["cantidad"], $_POST["plazo"],
				$_POST["cuentaBancaria"], $id);

				if (!is_null($datos)){
					if (Datos::registroInversionModel($datos, "solicitud")){

						echo "<div class=\"alert alert-success\" role=\"alert\">
						La solicitud se ha registrado correctamente
					  	</div>";
					} else {
						echo "<div class=\"alert alert-danger\" role=\"alert\">
						Datos incorrectos
						  </div>";
					}
				} else {
					echo "<div class=\"alert alert-danger\" role=\"alert\">
					Campos vacios
				  	</div>";
				}

			} else {
				echo "<div class=\"alert alert-warning\" role=\"alert\">
				Ya tienes una solicitud en proceso
			  	</div>";
			}
		}

		private function solicitudInvesionVacio($campo1, $campo2, $campo3, $campo4){
			if (!empty($campo1) AND !empty($campo2) AND !empty($campo3))
			{
				return [
					"cantidad" => floatval($campo1),
					"plazo" => $campo2,
					"cuenta_banc" => $campo3,
					"usuario" => $campo4
				];
			} else {
				return null;
			}
		}



		public function vistaHistorialInversionControler($user, $tipo, $aprob){
			$respuesta = Datos::buscarSolicitudModel($user, $tipo, $aprob);
			foreach ($respuesta as $row) {
				echo '<tr>
			          <td>'.$row["cantidad"].'</td> 
			          <td>'.$row["plazo"].'</td> 
			          <td>'.$row["cuenta_banc"].'</td> 
					  <td>'.$row["fecha_soli"].'</td> 
					  <td>'.$this -> tipoSoli($row["aprobada"]).'</td>  
	          	  </tr>';
        	}
		}


		public function changePwd($user){
			$respuesta = Datos::returnEmail($user);
			
			if (count($respuesta) > 0){
				$nombre = $respuesta[0]["usuario"];
				$cedula = $respuesta[0]["cedula"];
				$correo = $respuesta[0]["correo"];
				$url = "http://localhost/rctv/views/view/recPass.php?id=".$cedula;
				$cuerpo = "Hola ".$nombre.".
	
				Usted ha solicitado cambiar su contraseña.
				Ingrese al siguiente link para continuar, en caso contrario ignore este mensaje.
				Para mayor seguridad abra este link en una ventana privada.
				".$url;
				$asunto = "Cambiar contraseña";
				
				if ($this -> sendEmail($correo, $nombre, $asunto, $cuerpo)){
					return "<div class=\"alert alert-success\" role=\"alert\">
    					Se ha enviado un correo a ".$correo."</div>";
				} else {
					return "<div class=\"alert alert-warning\" role=\"alert\">
					Algo ocurrio
			  		</div>";
				}
				
			} else {
				return "<div class=\"alert alert-warning\" role=\"alert\">
				El usuario o correo electronico no está registrado
			  	</div>";
			}
			
		}


		public function cambiarContraseña($pw1, $pw2, $cedula){
			if ($this -> validPwd($pw1,$pw2)){
				$pwd = $this -> encrypPwd($pw1);
				if (Datos::cambiarPwd($pwd, $cedula)){
					return "<div class=\"alert alert-success\" role=\"alert\">
					La contraseña se ha actualizado correctamente
			  		</div>";
				} else {
					return "<div class=\"alert alert-warning\" role=\"alert\">
					Algo ocurrio
			  		</div>";
				}
			} else {
				return "<div class=\"alert alert-warning\" role=\"alert\">
				Las contraseñas no coinciden
			  	</div>";
			}
		}
	}
?>