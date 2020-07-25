<?php

	require_once "/xampp/htdocs/rctv/models/crudJC.php";
	require_once "/xampp/htdocs/rctv/models/model.php";


    class ControllerJC{

        public function enlacesJCController(){

			if(isset($_GET["action"])){

			$enlacesController = $_GET["action"];
			}

			else{

			$enlacesController = "views/viewJC/viewJC.php";
			
			}

			$respuesta = EnlacesPaginas::enlacesJCModel($enlacesController);

			include $respuesta;

		}


		public function rechazarSolicitudControllerJC($codigo){
			if ($codigo != ""){
				$resultado = Jefe::mostrarSolicitudModel($codigo, 2);
				if (count($resultado) > 0){
					if (Jefe::SolicitudModel(intval($codigo), -1)){
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



		public function mostrarSolicitudControllerJC($codigo){
			$resultado = Jefe::mostrarSolicitudModel($codigo, 2);
			if ($resultado[0]["tipo_soli"] == 1){
				return $this->mostrarPrestamo($resultado);
			} else {
				return $this->mostrarInversion($resultado);
			}				
		}


		private function mostrarInversion($datos){
			$respuesta = "<div class=\"form-group my-5\"><table class=\"table\">
			<tr>
			<td><b><center>codigo</center></b></td>
			<td><b><center>cantidad $</center></b></td>
			<td><b><center>plazo (meses)</center></b></td>
			<td><b><center>solicitud</center></b></td>
			<td><b><center>fecha de solicitud</center></b></td>
			<td><b><center>cuenta bancaria</center></b></td>
			<td><b><center>cedula</center></b></td>
			</tr>";

			foreach ($datos as $row){
				$respuesta = $respuesta.
				"<tr>
				<td><center>".$row["id"]."</center></td>
				<td><center>".$row["cantidad"]."</center></td>
				<td><center>".$row["plazo"]."</center></td>
				<td><center>".$this->tipoSolicitud($row["tipo_soli"])."</center></td>
				<td><center>".$row["fecha_soli"]."</center></td>
				<td><center>".$row["cuenta_banc"]."</center></td>
				<td><center>".$row["codigo_usu"]."</center></td>
				<td><center>".$this -> buttonAprobar($row["id"])."</center></td>
				<td><center>".$this -> buttonRechazar($row["id"])."</center></td>
				</tr>";
			}
			$respuesta = $respuesta."</table></div>";
			return $respuesta;
		}


		private function mostrarPrestamo($datos){
			$respuesta = "<div class=\"form-group my-5\"><table class=\"table\">
			<tr>
			<td><b><center>codigo</center></b></td>
			<td><b><center>cantidad $</center></b></td>
			<td><b><center>plazo (meses)</center></b></td>
			<td><b><center>solicitud</center></b></td>
			<td><b><center>tipo garantia</center></b></td>
			<td><b><center>valor garantia</center></b></td>
			<td><b><center>direccion garantia</center></b></td>
			<td><b><center>fiador</center></b></td>
			<td><b><center>fecha de solicitud</center></b></td>
			<td><b><center>cedula</center></b></td>
			</tr>";

			foreach ($datos as $row){
				$respuesta = $respuesta.
				"<tr>
				<td><center>".$row["id"]."</center></td>
				<td><center>".$row["cantidad"]."</center></td>
				<td><center>".$row["plazo"]."</center></td>
				<td><center>".$this->tipoSolicitud($row["tipo_soli"])."</center></td>
				<td><center>".$row["tipoG"]."</center></td>
				<td><center>".$row["valorG"]."</center></td>
				<td><center>".$row["direccionG"]."</center></td>
				<td><center>".$row["fiador"]."</center></td>
				<td><center>".$row["fecha_soli"]."</center></td>
				<td><center>".$row["codigo_usu"]."</center></td>
				<td><center>".$this -> buttonAprobar($row["id"])."</center></td>
				<td><center>".$this -> buttonRechazar($row["id"])."</center></td>
				</tr>";
			}

		$respuesta = $respuesta."</table></div>";
		return $respuesta;
		}



		public function mostrarSolicitudesControllerJC(){
			$respuesta = "<div class=\"container my-3\"><h4>Prestamos</h4>".
			$this -> mostrarPrestamos()."</div>";

			$respuesta = $respuesta."<div class=\"container my-3\"><h4>inversiones</h4>".
			$this -> mostrarInversiones()."</div>";

			return $respuesta;

		}

		private function mostrarPrestamos(){
			$resultado = Jefe::mostrarSolicitudesModel(1);

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
				$respuesta = $respuesta.
					"<tr>
					<td tabindex=\"0\" onclick=\"return estudiar(".$row["id"].")\"><center>".$row["id"]."</center></td>
					<td><center>".$row["codigo_usu"]."</center></td>
					<td><center>".$row["cantidad"]."</center></td>
					<td><center>".$row["plazo"]."</center></td>
					<td><center>".$row["tipoG"]."</center></td>
					<td><center>".$row["valorG"]."</center></td>
					<td><center>".$row["direccionG"]."</center></td>
					<td><center>".$row["fiador"]."</center></td>
					<td><center>".$row["fecha_soli"]."</center></td>
					<td><center>".$this -> buttonAprobar($row["id"])."</center></td>
					<td><center>".$this -> buttonRechazar($row["id"])."</center></td>
					</tr>";
			}
			$respuesta = $respuesta."</table></div>";

			return $respuesta;
		}

		private function buttonAprobar($id){
			return "<button id=\"btnA\" class=\"btn btn-success\" onclick=\"return aprobar($id)\">Aprobar</button>";
		}

		private function buttonRechazar($id){
			return "<button id=\"btnR\" class=\"btn btn-danger\" onclick=\"return rechazar($id)\">Rechazar</button>";
		}

		private function mostrarInversiones(){
			$resultado = Jefe::mostrarSolicitudesModel(2);

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
				<td tabindex=\"0\" onclick=\"return estudiar(".$row["id"].")\"><center>".$row["id"]."</center></td>
				<td><center>".$row["codigo_usu"]."</center></td>
				<td><center>".$row["cantidad"]."</center></td>
				<td><center>".$row["plazo"]."</center></td>
				<td><center>".$row["fecha_soli"]."</center></td>
				<td><center>".$row["cuenta_banc"]."</center></td>
				<td><center>".$this -> buttonAprobar($row["id"])."</center></td>
				<td><center>".$this -> buttonRechazar($row["id"])."</center></td>
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

		public function aceptarSolicitudController($codigo, $interes){
			// verificar que el codigo no sea vacio;
			if ($codigo != ""){
				//Retornamos la solicitud aceptada por el AC
				$resultado = Jefe::mostrarSolicitudModel($codigo, 2);
				//verificar si la solicitud existe
				
				if (count($resultado) > 0){
					// almacenar la informacion
					$datos_g = [];
					$datos_serv = [];
					foreach ($resultado as $row){
						$datos_serv = [ "codigo_serv" => $row["id"],
									"tipo_serv" => $row["tipo_soli"],
									"cantidad" => $row["cantidad"],
									"plazo" => $row["plazo"],
									"interes" => $interes,
									"cedula_clie" => $row["codigo_usu"],
									"cedula_emp" => $row["auxiliar"],
									"cuenta_banc" => $row["cuenta_banc"]
						];

						if (intval($row["tipo_soli"]) == 1 ){
							$datos_g = ["fiador" => $row["fiador"],
									"valor_g" => $row["valorG"],
									"tipo_g" => $row["tipoG"],
									"direccion_g" => $row["direccionG"]
							];
						}
					break;
					}
					if (Jefe::aceptarSolicitudModel($codigo, $datos_serv, $datos_g)){
						return "<div class=\"alert alert-success\" role=\"alert\">
						Se ha aprobado la solicitud</div>";
					} else {
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


		public function buscarCliente($cedula){
			$resultado = Jefe::buscarClienteModel($cedula);
			if (count($resultado) > 0){
				$respuesta = "<h6>Cliente</h6><div class=\"form-group my-5\"><table class=\"table\">
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
			$resultado = Jefe::prestamosCliente($cedula);
			$respuesta = "<h6>Pestamos</h6><div class=\"form-group my-5\"><table class=\"table\">
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
			$resultado = Jefe::InversionesCliente($cedula);
			$respuesta = "<h6>Inversiones</h6><div class=\"form-group my-5\"><table class=\"table\">
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


		public function mostrarCronogramaJC($codigo){
			$resultado = Jefe::mostrarCronogramaModel($codigo);

			$respuesta = "<div class=\"form-group my-5\"><table class=\"table\">
			<tr>
			<td><b><center>Cuota</center></b></td>
			<td><b><center>Fecha de pago</center></b></td>
			<td><b><center>Valor de cuota</center></b></td>
			<td><b><center>Interes</center></b></td>
			<td><b><center>Amortizacion</center></b></td>
			<td><b><center>Saldo restante</center></b></td>
			<td><b><center>Estado</center></b></td>
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
				<td><center>".$this -> estadoCuota($row["estado"])."</center></td>
				</tr>";
			}
			$respuesta = $respuesta."</table></div>";
			return $respuesta;
		}

		private function estadoCuota($estado){
			if ($estado == 0){
				return "<p style=\"color:red;\">Pendiente</p>";
			}
			return "<p style=\"color:green;\">Finalizado</p>";
		}
    }
?>