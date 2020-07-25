<?php

	require_once "/xampp/htdocs/rctv/models/crudAC.php";
	require_once "/xampp/htdocs/rctv/models/model.php";

    class ControllerAC{

        public function enlacesACController(){

			if(isset($_GET["action"])){

			$enlacesController = $_GET["action"];
			}

			else{

			$enlacesController = "views/viewWr/viewAC.php";
			
			}

			$respuesta = EnlacesPaginas::enlacesACModel($enlacesController);

			include $respuesta;

		}

		public function mostrarSolicitudesControllerAC($user){
			$respuesta = "<div class=\"container my-3\"><h4>Prestamos</h4>".
			$this -> mostrarPrestamos($user)."</div>";

			$respuesta = $respuesta."<div class=\"container my-3\"><h4>inversiones</h4>".
			$this -> mostrarInversiones($user)."</div>";

			return $respuesta;

		}

		private function mostrarPrestamos($user){
			$resultado = Auxiliar::mostrarSolicitudesModel(1);

			$respuesta = "<div class=\"form-group my-5\"><table class=\"table\">
			<tr>
			<td><b><center>codigo</center></b></td>
			<td><b><center>cedula</center></b></td>
			<td><b><center>cantidad $</center></b></td>
			<td><b><center>plazo (meses)</center></b></td>
			<td><b><center>tipo garantia</center></b></td>
			<td><b><center>valor garantia</center></b></td>
			<td><b><center>direccion garantia</center></b></td>
			<td><b><center>fiador</center></b></td>
			<td><b><center>fecha de solicitud</center></b></td>
			</tr>";

			foreach ($resultado as $row){
				// tabindex me premite agregar un evento a la fila o celda
				// "<tr tabindex=\"0\" onclick=\"return hola()\">
				$respuesta = $respuesta.
					"<tr>
					<td tabindex=\"0\" onclick=\"return estudiar(".$row["id"].",".$user.")\"><center>".$row["id"]."</center></td>
					<td><center>".$row["codigo_usu"]."</center></td>
					<td><center>".$row["cantidad"]."</center></td>
					<td><center>".$row["plazo"]."</center></td>
					<td><center>".$row["tipoG"]."</center></td>
					<td><center>".$row["valorG"]."</center></td>
					<td><center>".$row["direccionG"]."</center></td>
					<td><center>".$row["fiador"]."</center></td>
					<td><center>".$row["fecha_soli"]."</center></td>
					<td><center>".$this -> buttonEnviar($row["id"], $user)."</center></td>
					<td><center>".$this -> buttonRechazar($row["id"], $user)."</center></td>
					</tr>";
			}
			$respuesta = $respuesta."</table></div>";

			return $respuesta;
		}

		private function mostrarInversiones($user){
			$resultado = Auxiliar::mostrarSolicitudesModel(2);

			$respuesta = "<div class=\"form-group my-5\"><table class=\"table\">
			<tr>
			<td><b><center>codigo</center></b></td>
			<td><b><center>cedula</center></b></td>
			<td><b><center>cantidad $</center></b></td>
			<td><b><center>plazo (meses)</center></b></td>
			<td><b><center>fecha de solicitud</center></b></td>
			<td><b><center>cuenta bancaria</center></b></td>
			</tr>";

			foreach ($resultado as $row){
				// tabindex me premite agregar un evento a la fila
				$respuesta = $respuesta.
				"<tr>
				<td tabindex=\"0\" onclick=\"return estudiar(".$row["id"].",".$user.")\"><center>".$row["id"]."</center></td>
				<td><center>".$row["codigo_usu"]."</center></td>
				<td><center>".$row["cantidad"]."</center></td>
				<td><center>".$row["plazo"]."</center></td>
				<td><center>".$row["fecha_soli"]."</center></td>
				<td><center>".$row["cuenta_banc"]."</center></td>
				<td><center>".$this -> buttonEnviar($row["id"], $user)."</center></td>
				<td><center>".$this -> buttonRechazar($row["id"], $user)."</center></td>
				</tr>";
			}
			$respuesta = $respuesta."</table></div>";

			return $respuesta;
		}

		private function tipoSolicitud($tipo){

			if (intval($tipo) == 1) {
				return "prestamo";
			}
			return "inversion";

		}

		private function buttonEnviar($codigo, $user){
			return "<button id=\"btnA\" class=\"btn btn-success\" onclick=\"return enviar($codigo, $user)\">Enviar</button>";
		}

		private function buttonRechazar($codigo, $user){
			return "<button id=\"btnR\" class=\"btn btn-danger\" onclick=\"return rechazar($codigo, $user)\">Rechazar</button>";
		}

		public function enviarSolicitudControllerAC($codigo, $auxi){
			if ($codigo != ""){
				if (count(Auxiliar::buscarSolicitudModel($codigo)) > 0){
					if (Auxiliar::SolicitudModel(intval($codigo), 2, $auxi)){
						return "<div class=\"alert alert-success\" role=\"alert\">
						Se ha aprobado la solicitud para su revision</div>";
					}  else {
						return "<div class=\"alert alert-danger\" role=\"alert\">
						Algo sucedio
						  </div>";
					}
				} else {
					return "<div class=\"alert alert-danger\" role=\"alert\">
					La solicitud no existe
					  </div>";
				}
				
			} else {
				return "<div class=\"alert alert-danger\" role=\"alert\">
				Campos vacios
				  </div>";
			}
		}

		public function rechazarSolicitudControllerAC($codigo, $auxi){
			if ($codigo != ""){
				if (count(Auxiliar::buscarSolicitudModel($codigo)) > 0){
					if (Auxiliar::SolicitudModel(intval($codigo), -1, $auxi)){
						return "<div class=\"alert alert-success\" role=\"alert\">
						Se ha rechazado la solicitud
						  </div>";
					}  else {
						return "<div class=\"alert alert-danger\" role=\"alert\">
						Algo sucedio
						  </div>";
					}
				} else {
					return "<div class=\"alert alert-danger\" role=\"alert\">
					La solicitud no existe
					  </div>";
				}
				
			} else {
				return "<div class=\"alert alert-danger\" role=\"alert\">
				Campos vacios
				  </div>";
			}
		}

		public function buscarInformacionClienteControllerAC($cedula){
			$resultado = Auxiliar::mostrarUsuarioModel($cedula);
			if (count($resultado) > 0){
				$respuesta = "<h6>Usuario</h6><div class=\"form-group my-5\"><table class=\"table\">
				<tr>
				<td><b><center>Cedula</center></b></td>
				<td><b><center>Usuario</center></b></td>
				<td><b><center>Nombres</center></b></td>
				<td><b><center>Apellidos</center></b></td>
				<td><b><center>Correo</center></b></td>
				<td><b><center>Telefono</center></b></td>
				<td><b><center>Direccion</center></b></td>
				</tr>";

				foreach ($resultado as $row){
					$respuesta = $respuesta.
					"<tr>
			        <td><center>".$row["cedula"]."</center></td> 
			        <td><center>".$row["usuario"]."</center></td> 
			        <td><center>".$row["nombres"]."</center></td> 
			        <td><center>".$row["apellidos"]."</center></td> 
					<td><center>".$row["correo"]."</center></td>
					<td><center>".$row["telefono"]."</center></td>
					<td><center>".$row["direccion_usu"]."</center></td>";
				}
				$respuesta = $respuesta."</table></div>";

				return $respuesta;
			}
			return "<div class=\"alert alert-danger\" role=\"alert\">
					No existe un usuario con esa identificacion
					</div>";

		}


		public function buscarUsuarioControllerAC($cedula){
			$respuesta = Auxiliar::mostrarUsuarioModel($cedula);

			$mensaje = "";
			if (count($respuesta) > 0){

				foreach ($respuesta as $row){
					$mensaje = $mensaje.
					$row["cedula"]."\n".
					$row["usuario"]."\n".
					$row["nombres"]."\n".
					$row["apellidos"]."\n".
					$row["correo"]."\n".
					$row["fecha_nac"]."\n".
					$row["telefono"]."\n";
				}

			} else {
				$mensaje = "No existen registros";
			}

			return $mensaje;
		}

		public function buscarSolicitudControllerAC($codigo, $user){
			$resultado = Auxiliar::mostrarSolicitudModel($codigo);
			
			if ($resultado[0]["tipo_soli"] == 1){
				return $this -> mostrarPrestamo($resultado, $user);
			} else{
				return $this -> mostrarInversion($resultado, $user);
			}
		}

		public function mostrarPrestamo($datos, $user){
			$respuesta = "<div class=\"form-group my-5\"><table class=\"table\">
			<tr>
			<td><b><center>codigo</center></b></td>
			<td><b><center>cedula</center></b></td>
			<td><b><center>cantidad $</center></b></td>
			<td><b><center>plazo (meses)</center></b></td>
			<td><b><center>tipo garantia</center></b></td>
			<td><b><center>valor garantia</center></b></td>
			<td><b><center>direccion garantia</center></b></td>
			<td><b><center>fiador</center></b></td>
			<td><b><center>fecha de solicitud</center></b></td>
			</tr>";

			foreach ($datos as $row){
				$respuesta = $respuesta.
					"<tr>
					<td><center>".$row["id"]."</center></td>
					<td><center>".$row["codigo_usu"]."</center></td>
					<td><center>".$row["cantidad"]."</center></td>
					<td><center>".$row["plazo"]."</center></td>
					<td><center>".$row["tipoG"]."</center></td>
					<td><center>".$row["valorG"]."</center></td>
					<td><center>".$row["direccionG"]."</center></td>
					<td><center>".$row["fiador"]."</center></td>
					<td><center>".$row["fecha_soli"]."</center></td>
					<td><center>".$this -> buttonEnviar($row["id"], $user)."</center></td>
					<td><center>".$this -> buttonRechazar($row["id"], $user)."</center></td>
					</tr>";
			}
			$respuesta = $respuesta."</table></div>";

			return $respuesta;

		}

		public function mostrarInversion($datos, $user){
			$respuesta = "<div class=\"form-group my-5\"><table class=\"table\">
			<tr>
			<td><b><center>codigo</center></b></td>
			<td><b><center>cedula</center></b></td>
			<td><b><center>cantidad $</center></b></td>
			<td><b><center>plazo (meses)</center></b></td>
			<td><b><center>fecha de solicitud</center></b></td>
			<td><b><center>cuenta bancaria</center></b></td>
			</tr>";

			foreach ($datos as $row){
				// tabindex me premite agregar un evento a la fila
				$respuesta = $respuesta.
				"<tr>
				<td><center>".$row["id"]."</center></td>
				<td><center>".$row["codigo_usu"]."</center></td>
				<td><center>".$row["cantidad"]."</center></td>
				<td><center>".$row["plazo"]."</center></td>
				<td><center>".$row["fecha_soli"]."</center></td>
				<td><center>".$row["cuenta_banc"]."</center></td>
				<td><center>".$this -> buttonEnviar($row["id"], $user)."</center></td>
				<td><center>".$this -> buttonRechazar($row["id"], $user)."</center></td>
				</tr>";
			}
			$respuesta = $respuesta."</table></div>";

			return $respuesta;
		}





		public function buscarCliente($cedula){
			$resultado = Auxiliar::buscarClienteModel($cedula);
			if (count($resultado) > 0){
				$respuesta = "<h6>Cliente</h6><div class=\"form-group my-1\"><table class=\"table\">
				<tr>
				<td><b><center>Cedula</center></b></td>
				<td><b><center>Usuario</center></b></td>
				<td><b><center>Nombres</center></b></td>
				<td><b><center>Apellidos</center></b></td>
				<td><b><center>Correo</center></b></td>
				<td><b><center>Telefono</center></b></td>
				<td><b><center>Direccion</center></b></td>
				</tr>";

				foreach ($resultado as $row){
					$respuesta = $respuesta.
					"<tr>
			        <td><center>".$row["cedula"]."</center></td> 
			        <td><center>".$row["usuario"]."</center></td> 
			        <td><center>".$row["nombres"]."</center></td> 
			        <td><center>".$row["apellidos"]."</center></td> 
					<td><center>".$row["correo"]."</center></td>
					<td><center>".$row["telefono"]."</center></td>
					<td><center>".$row["direccion_usu"]."</center></td>";
				}
				$respuesta = $respuesta."</table></div>";
				$datos[] = $respuesta;
				$datos[] = $this -> SolicitudesCliente($cedula);
				return $datos;
			}
			$datos[] = "<div class=\"alert alert-danger\" role=\"alert\">
						No existe un Cliente con esa identificacion
						</div>";
			
			$datos [] = "";
			return $datos;
		}


		public function SolicitudesCliente($cliente){
			$respuesta = $this -> prestamosCliente($cliente)."</br>";
			$respuesta = $respuesta."</br>".$this -> inversionesCliente($cliente);
			
			return $respuesta;
		}

		private function prestamosCliente($cedula){
			$resultado = Auxiliar::prestamosCliente($cedula);
			$respuesta = "<h6>Pestamos</h6><div class=\"form-group my-1\"><table class=\"table\">
			<tr>
			<td><b><center>codigo</center></b></td>
			<td><b><center>cedula</center></b></td>
			<td><b><center>cantidad $</center></b></td>
			<td><b><center>plazo (meses)</center></b></td>
			<td><b><center>tipo garantia</center></b></td>
			<td><b><center>valor garantia</center></b></td>
			<td><b><center>direccion garantia</center></b></td>
			<td><b><center>fiador</center></b></td>
			<td><b><center>fecha de solicitud</center></b></td>
			</tr>";

			foreach ($resultado as $row){
				// tabindex me premite agregar un evento a la fila o celda
				$respuesta = $respuesta.
					"<tr>
					<td tabindex=\"0\" onclick=\"return cronograma(".$row["id"].")\"><center>".$row["id"]."</center></td>
					<td><center>".$row["codigo_usu"]."</center></td>
					<td><center>".$row["cantidad"]."</center></td>
					<td><center>".$row["plazo"]."</center></td>
					<td><center>".$row["tipoG"]."</center></td>
					<td><center>".$row["valorG"]."</center></td>
					<td><center>".$row["direccionG"]."</center></td>
					<td><center>".$row["fiador"]."</center></td>
					<td><center>".$row["fecha_soli"]."</center></td>
					</tr>";
			}
			$respuesta = $respuesta."</table></div>";
			return $respuesta;
		}


		private function inversionesCliente($cedula){
			$resultado = Auxiliar::InversionesCliente($cedula);
			$respuesta = "<h6>Inversiones</h6><div class=\"form-group my-1\"><table class=\"table\">
			<tr>
			<td><b><center>codigo</center></b></td>
			<td><b><center>cedula</center></b></td>
			<td><b><center>cantidad $</center></b></td>
			<td><b><center>plazo (meses)</center></b></td>
			<td><b><center>fecha de solicitud</center></b></td>
			<td><b><center>cuenta bancaria</center></b></td>
			</tr>";

			foreach ($resultado as $row){
				// tabindex me premite agregar un evento a la fila
				$respuesta = $respuesta.
				"<tr>
				<td tabindex=\"0\" onclick=\"return cronograma(".$row["id"].")\"><center>".$row["id"]."</center></td>
				<td><center>".$row["codigo_usu"]."</center></td>
				<td><center>".$row["cantidad"]."</center></td>
				<td><center>".$row["plazo"]."</center></td>
				<td><center>".$row["fecha_soli"]."</center></td>
				<td><center>".$row["cuenta_banc"]."</center></td>
				</tr>";
			}
			$respuesta = $respuesta."</table></div>";

			return $respuesta;
		}


		public function mostrarCronogramaAC($codigo){
			$resultado = Auxiliar::mostrarCronogramaModel($codigo);

			$respuesta = "<div class=\"form-group my-5\"><table class=\"table\">
			<tr>
			<td><b><center>Cuota</center></b></td>
			<td><b><center>Fecha de pago</center></b></td>
			<td><b><center>Valor de cuota</center></b></td>
			<td><b><center>Interes</center></b></td>
			<td><b><center>Amortizacion</center></b></td>
			<td><b><center>Saldo restante</center></b></td>
			<td><b><center></center></b></td>
			</tr>";
			foreach ($resultado as $row){
				$respuesta = $respuesta.
				"<tr>
				<td><center>".$row["numero_cuota"]."</center></td>
				<td><center>".$row["fecha_cuota"]."</center></td>
				<td><center>".$row["valor_cuota"]."</center></td>
				<td><center>".$row["interes_periodo"]."</center></td>
				<td><center>".$row["amortizacion"]."</center></td>
				<td><center>".$row["saldo"]."</center></td>
				<td><center>".$this -> estadoCuota($row["estado"], $row["cronograma_codigo"], $row["numero_cuota"])."</center></td>
				</tr>";
			}
			$respuesta = $respuesta."</table></div>";
			return $respuesta;
		}


		private function estadoCuota($estado, $cronograma, $cuota){
			if ($estado == 0){
				return "<button id=\"bntP\" class=\"btn btn-primary\" onclick=\"return pagoCuota($cronograma, $cuota)\">Pagar</button>";
			}
			return "<p style=\"color:green;\">Finalizado</p>";
		}

		public function pagarCuota($crono, $cuota){
			if (Auxiliar::pagarCuotaModel($crono, $cuota)) {
				return "<div class=\"alert alert-success\" role=\"alert\">
				El pago de la cuota fue exitoso
				</div>";
			} else {
				return "<div class=\"alert alert-danger\" role=\"alert\">
				Algo sucedio
				</div>";
			}
		}


    }


?>