<?php

	class EnlacesPaginas{

	public static function enlacesPaginasModel($enlacesModel){

		if($enlacesModel == "nosotros" || 
		   $enlacesModel == "registro"||
		   $enlacesModel == "ingreso"||
		   $enlacesModel == "usuarios"||
		   $enlacesModel == "salir"){

			$module = "views/modules/".$enlacesModel.".php";

		}


		else if($enlacesModel == "index" ){

			$module = "views/modules/inicio.php";

		}

		else if($enlacesModel == "ok" ){

			$module = "views/modules/registro.php";

		}

		else if($enlacesModel == "fallo" ){

			$module = "views/modules/ingreso.php";

		}

		else{

			$module = "views/modules/inicio.php";

		}

		return $module;

	}

	public static function enlacesOpcionModel($enlacesModel){
		if ($enlacesModel == "cliente"||
				$enlacesModel == "prestamo"||
				$enlacesModel == "inversion"||
				$enlacesModel == "historial"){
			$module = "views/viewCliente/".$enlacesModel.".php";
		
		} else{

			$module = "views/viewCliente/cliente.php";

		}

		return $module;
	}


	public static function enlacesACModel($enlacesModel){
		if ($enlacesModel == "solicitudes"||
			$enlacesModel == "pagoCuota")
		{
			$module = "/xampp/htdocs/rctv/views/viewWr/".$enlacesModel.".php";
		
		} else{

			$module = "/xampp/htdocs/rctv/views/viewWr/solicitudes.php";

		}

		return $module;
	}

	public static function enlacesJCModel($enlacesModel){
		if ($enlacesModel == "solicitudesJC")
		{
			$module = "/xampp/htdocs/rctv/views/viewJC/".$enlacesModel.".php";
		
		} else{

			$module = "/xampp/htdocs/rctv/views/viewJC/solicitudesJC.php";

		}

		return $module;
	}

	public static function enlacesADModel($enlacesModel){
		if ($enlacesModel == "usuariosAD" ||
			$enlacesModel == "clientesAD")
		{
			$module = "/xampp/htdocs/rctv/views/viewAD/".$enlacesModel.".php";
		
		} else{

			$module = "/xampp/htdocs/rctv/views/viewAD/usuariosAD.php";

		}

		return $module;
	}



}

?>