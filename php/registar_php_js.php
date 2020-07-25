<?php
  require "../controllers/controller.php";
  $registro = new MvcController();


  $user = strtolower($_POST["usuarioRegistro"]);
  $pwd = $_POST["passwordRegistro"];
  $pwd_con = $_POST["confirm_pwd"];
  $id = $_POST["cedula"];
  $name = strtolower($_POST["nombre"]);
  $lastname = strtolower($_POST["apellido"]);
  $email = strtolower($_POST["emailRegistro"]);
  $birthdate = $_POST["nacimiento"];
  $phone = $_POST["telefono"];
  $direccion = $_POST["direccion"];


  $type = 2;
  $active = 1;

  if ($registro -> fieldEmpty($user, $pwd, $pwd_con, $id, $name, $lastname, $email, $birthdate, $phone, $direccion)){
    $fails[] = "Existen campos vacios";
  } else {
    if (!$registro -> validPwd($pwd, $pwd_con)){
      $fails[] = "Las contraseñas no coinciden";
    }
    if (!$registro -> validEmail($email)){
      $fails[] = "El correo no es valido";
    }
    if ($registro -> calculateAge($birthdate) < 18){
      $fails[] = " NO cumple con la edad requerida";
    }
    if ($registro -> repeatUserController($user)){
      $fails[] = "El nombre de usuario ya está en uso";
    }
    if ($registro -> repeatIdController($id)){
      $fails[] = "La identificación ya está en uso";
    }
    if ($registro -> repeatEmailController($email)){
      $fails[] = "El correo electronico ya está en uso";
    }
  }


  if (empty($fails)){
    if($registro -> validAccount($email, $name, $user)){
      $pass_hash = $registro -> encrypPwd($pwd);
      $datos_registro = ["cedula"=>$id,
                        "usuario"=>$user, 
                        "contrasena"=>$pass_hash,
                        "nombres"=>$name,
                        "apellidos"=>$lastname,
                        "correo"=>$email,
                        "tipo"=>$type,
                        "fecha_nac"=>$birthdate,
                        "activo"=>$active,
                        "telefono" => $phone,
                        "direccion" => $direccion];
      if ($registro -> registroUsuarioController($datos_registro)){
        echo json_encode("<div class=\"alert alert-success\" role=\"alert\">
        El usuario se ha creado correctamente!
        </div>");
      } else{
          $fails[] = "No se pudo registrar al usuario";
      }
    } else {
        $fails[] = " El correo no pudo enviarse ";
    }
  }

  if (!empty($fails)){
      echo json_encode($registro -> showFails($fails));
  }

?>