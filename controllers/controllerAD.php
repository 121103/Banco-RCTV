<?php

    require_once "/xampp/htdocs/rctv/models/crudAD.php";
    require_once "/xampp/htdocs/rctv/models/model.php";


    class ControllerAD{

        public function enlacesADController(){

			if(isset($_GET["action"])){

			$enlacesController = $_GET["action"];
			}

			else{

			$enlacesController = "index";
			
			}

			$respuesta = EnlacesPaginas::enlacesADModel($enlacesController);

			include $respuesta;

		}


		public function autorizarUsuariosController($id, $tipo){
			if ($id != "" && is_numeric($tipo)){
				if (count(Admin::buscarUsuario($id)) > 0){
					$num = intval($tipo);
					if (($num >= 0) && ($num <= 2)){
						if (Admin::autorizarUsuariosModel($id,$num)){
							return "
							<div class=\"container mx-3\"><div class=\"alert alert-success\" role=\"alert\">
							El usuario con cedula \"".$id."\" Se ha actualizado correctamente
							</div></div>
							";
						} else {
							return "
							<div class=\"container mx-3\"><div class=\"alert alert-danger\" role=\"alert\">
							Error ineperado
							</div></div>
							";
						}
					} else {
						return "
							<div class=\"container mx-3\"><div class=\"alert alert-danger\" role=\"alert\">
							Valores incorrectos
							</div></div>
							";
					}
				} else {
					return "
					<div class=\"container mx-3\"><div class=\"alert alert-danger\" role=\"alert\">
					El usuario con cedula \"".$id."\" No existe
					</div></div>
					";
				}
			} else {
				return "
					<div class=\"container mx-3\"><div class=\"alert alert-danger\" role=\"alert\">
					Valores incorrectos
					</div></div>
					";
			}

		}

		public function mostrarUsuariosController(){
			$resultado =  Admin::mostrarUsuariosModel();
			$msg = "<div class=\"form-group my-3 mx-5\"><table class=\"table\">
                <tr>
                <td><b><center>Cedula</center></b></td>
                <td><b><center>Usuario</center></b></td>
                <td><b><center>Nombre</center></b></td>
                <td><b><center>Apellido</center></b></td>
                <td><b><center>Correo</center></b></td>
                <td><b><center>Telefono</center></b></td>
                <td><b><center>tipo</center></b></td>
                </tr>";

            foreach ($resultado as $row) {
                $msg = $msg."
                <tr>
                <td><center>".$row["cedula"]."</center></td>
                <td><center>".$row["usuario"]."</center></td>
                <td><center>".$row["nombres"]."</center></td>
                <td><center>".$row["apellidos"]."</center></td>
                <td><center>".$row["correo"]."</center></td>
                <td><center>".$row["telefono"]."</center></td>
                <td><center>".Admin::nombreTipo($row["tipo"])."</center></td>
                </tr>";
            }
			$msg = $msg."</table></div>";
			return $msg;
		}

		public function actualizarInfo($atr, $cedula, $campo1, $campo2){
			if (!$this -> camposVacios($cedula, $campo1, $campo2)){
				if(strcmp($campo1,$campo2) == 0){
					if ($atr == "contrasena"){
						$pwd = $this -> encrypPwd($campo1);
						Admin::actualizarInfo($atr, $cedula, $pwd);
					} else if ($atr == "correo"){
						$correo = strtolower($campo1);
						if ($this -> repeatEmail($correo) || !$this -> validEmail($correo)){
							return "
							<div class=\"container mx-3\"><div class=\"alert alert-warning\" role=\"alert\">
							El correo no es valido o ya se encuentra registrado
							</div></div>
							";
						}
						Admin::actualizarInfo($atr, $cedula, $correo);
					} else {
						Admin::actualizarInfo($atr, $cedula, $campo1);
					}
					return "
					<div class=\"container mx-3\"><div class=\"alert alert-success\" role=\"alert\">
					Usuario actualizado
					</div></div>
					";
				} else {
					return "
					<div class=\"container mx-3\"><div class=\"alert alert-warning\" role=\"alert\">
					Los valores no son iguales
					</div></div>
					";
				}
			} else {
				return "
				<div class=\"container mx-3\"><div class=\"alert alert-warning\" role=\"alert\">
				Campos vacios
				</div></div>
				";
			}
			
		}


		private function camposVacios($campo1, $campo2, $campo3){
			if ($campo1 == "" || $campo2 == "" || $campo3 == ""){
				return true;
			}
			return false;
		}

		private function encrypPwd($pwd){
			return password_hash($pwd, PASSWORD_DEFAULT);
		}

		private function repeatEmail($email){
			$respuesta = Admin::repeatEmail($email);
			
			if (count($respuesta) > 0){
				return true;
			}

			return false;
		}

		private function validEmail($email){
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return true;
			}
			return false;
		}

    }


?>