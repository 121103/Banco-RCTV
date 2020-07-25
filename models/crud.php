<?php

require_once "conexion.php";

class Datos{

	static public function registroUsuarioModel($datosModel, $tabla){
		$link = Conexion::conectar();
		
		$stmt = $link->prepare("INSERT INTO $tabla
		(cedula, usuario, contrasena, nombres, apellidos, correo, tipo, fecha_nac, activo, telefono, direccion_usu) 
		VALUES 
		(:cedula, :usuario, :contrasena, :nombres, :apellidos, :correo, :tipo, :fecha_nac, :activo, :telefono, :direccion)");	
			
		return $stmt->execute([
			"cedula" => $datosModel["cedula"], 
			"usuario" => $datosModel["usuario"], 
			"contrasena" => $datosModel["contrasena"], 
			"nombres" => $datosModel["nombres"], 
			"apellidos" => $datosModel["apellidos"], 
			"correo" => $datosModel["correo"], 
			"tipo" => $datosModel["tipo"], 
			"fecha_nac" => $datosModel["fecha_nac"], 
			"activo" => $datosModel["activo"],
			"telefono" => $datosModel["telefono"],
			"direccion" => $datosModel["direccion"]
		]);
		
	}

	public static function ingresoUsuarioModel($datosModel, $tabla){
		$link = Conexion::conectar();

		$stmt = $link->prepare("SELECT cedula, usuario, contrasena, tipo FROM $tabla WHERE usuario = :usuario");
		$stmt->execute(["usuario" => $datosModel["usuario"]]);

		return $stmt -> fetch();
	

	}

	public static function vistaUsuarioModel($tabla, $user){
		$link = Conexion::conectar();

		$stmt = $link->prepare("SELECT cedula, usuario, nombres, apellidos, correo, telefono FROM $tabla WHERE cedula = :cedula");
		$stmt->execute(["cedula" => $user]);

		return $stmt->fetchAll();


	}

	public static function registroPrestamoGarantiaModel($datos, $tabla){
		$link = Conexion::conectar();

		$fecha_hoy = Datos::obtenerFechaHoy();

		$sql = "INSERT INTO $tabla (cantidad, plazo, codigo_usu, tipo_soli, tipoG, valorG, direccionG, fecha_soli) 
		VALUES
		(:cantidad, :plazo, :codigo_usu, :tipo_soli, :tipoG, :valorG, :direccionG, :fecha_soli)";

		$stmt = $link->prepare($sql);
		// tipo solicitud 1 prestamo
		return $stmt->execute([
			"cantidad" => $datos["cantidad"],
			"plazo" => $datos["plazo"],
			"codigo_usu" => $datos["usuario"],
			"tipo_soli"=> 1,
			"tipoG" =>  $datos["tipoG"],
			"valorG" => $datos["valorG"],
			"direccionG" => $datos["ubicacionG"],
			"fecha_soli" => $fecha_hoy
		]);
	}


	public static function buscarSolicitudModel($user, $tipo, $aprob){
		$link = Conexion::conectar();

		$sql = "SELECT * FROM solicitud WHERE codigo_usu = $user AND tipo_soli = $tipo AND aprobada = $aprob";
		$stmt = $link->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
		/*if ($stmt->rowCount() > 0){
			return true;
		}*/

	}

	public static function buscarUsuario($cedula, $tabla){
		$link = Conexion::conectar();

		$sql = "SELECT * FROM $tabla WHERE cedula = $cedula LIMIT 1";
		$stmt = $link->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();

	}

	public static function registroPrestamoFiadorModel($datos, $tabla){
		$link = Conexion::conectar();

		$fecha_hoy = Datos::obtenerFechaHoy();
		$sql = "INSERT INTO $tabla 
		(cantidad, plazo, codigo_usu, tipo_soli, fiador, fecha_soli) 
		VALUES 
		(:cantidad, :plazo, :codigo_usu, :tipo_soli, :fiador, :fecha_hoy)";
		$stmt = $link->prepare($sql);

		return $stmt->execute([
			"cantidad" => $datos["cantidad"],
			"plazo" => $datos["plazo"], 
			"codigo_usu" => $datos["usuario"],
			"tipo_soli"=> 1,
			"fiador" =>  $datos["fiador"],
			"fecha_hoy" => $fecha_hoy
			]);
		// tipo solicitud 1 prestamo
	}


	public static function registroInversionModel($datos, $tabla){
		$link = Conexion::conectar();

		$fecha_hoy = Datos::obtenerFechaHoy();
		$sql = "INSERT INTO $tabla 
		(cantidad, plazo, codigo_usu, tipo_soli, fecha_soli, cuenta_banc) 
		VALUES 
		(:cantidad, :plazo, :codigo_usu, :tipo_soli, :fecha_hoy, :cuenta_banc)";
		$stmt = $link->prepare($sql);

		return $stmt->execute([
			"cantidad" => $datos["cantidad"],
			"plazo" => $datos["plazo"], 
			"codigo_usu" => $datos["usuario"],
			"tipo_soli"=> 2,
			"fecha_hoy" => $fecha_hoy,
			"cuenta_banc" => $datos["cuenta_banc"]
			]);
		// tipo solicitud 1 prestamo

	}
	
	 // Funcion que retorna la fecha actual del pais
	private static function obtenerFechaHoy(){
		date_default_timezone_set('America/Bogota');
		return date("Y")."-".date("m")."-".date("d");
	}
	

	public static function repeatUserModel($user){
		$link = Conexion::conectar();

		$sql = "SELECT usuario FROM usuarios WHERE  usuario = :user LIMIT 1";
		$stmt = $link -> prepare($sql);

		$stmt -> execute(["user" => $user]);

		return $stmt ->  fetchAll();
	}

	public static function repeatIdModel($id){
		$link = Conexion::conectar();

		$sql = "SELECT cedula FROM usuarios WHERE  cedula = :id LIMIT 1";
		$stmt = $link -> prepare($sql);

		$stmt -> execute(["id" => $id]);

		return $stmt ->  fetchAll();
	}

	public static function buscarClienteModel($id){
		$link = Conexion::conectar();

		$sql = "SELECT cedula_clie FROM cliente WHERE  cedula_clie = :id LIMIT 1";
		$stmt = $link -> prepare($sql);

		$stmt -> execute(["id" => $id]);

		return $stmt ->  fetchAll();
	}

	public static function repeatEmailModel($email){
		$link = Conexion::conectar();

		$sql = "SELECT correo FROM usuarios WHERE  correo = :email LIMIT 1";
		$stmt = $link -> prepare($sql);

		$stmt -> execute(["email" => $email]);

		return $stmt ->  fetchAll();
	}


	public static function returnEmail($user){
		$link = Conexion::conectar();

		$sql = "SELECT cedula, usuario, correo FROM usuarios WHERE  correo = :user OR usuario = :user LIMIT 1";
		$stmt = $link -> prepare($sql);

		$stmt -> execute(["user" => $user]);

		return $stmt ->  fetchAll();
	}

	public static function cambiarPwd($pwd, $cedula){
		$link = Conexion::conectar();

		$sql = "UPDATE usuarios SET contrasena = :pwd WHERE cedula = :cedula";
		$stmt = $link -> prepare($sql);

		return $stmt -> execute(["pwd" => $pwd, "cedula" => $cedula]);
	}
}

?>