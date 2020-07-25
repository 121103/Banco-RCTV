<?php

    require_once "conexion.php";

    class Admin{
        
        public static function autorizarUsuariosModel($id, $type){
            $link = Conexion::conectar();

            $stmt = $link->prepare("UPDATE usuarios SET tipo = :tipo WHERE cedula = :cedula;");
            $resutado = $stmt -> execute(["tipo" => $type, "cedula" => $id]);
            if ($resutado && $type != 2){
                if (Admin::buscarEmpleado($id) == 0){
                    Admin::agregarEmpleado($id);
                } else {
                    Admin::actualizarEmpleado($id, $type);
                }
            }
            return true;
        }

        public static function mostrarUsuariosModel(){
            $link = Conexion::conectar();

            $stmt = $link->prepare("SELECT cedula, usuario, nombres, apellidos, correo, tipo, telefono FROM usuarios ORDER BY tipo;");
            $stmt -> execute();

            return $stmt -> fetchAll();
        }

        public static function nombreTipo($tipo){
            if ($tipo == -1){
                return "Administrador";
            } else if ($tipo == 0){
                return "Jefe de credito";
            } else if ($tipo == 1){
                return "Auxiliar de credito";
            }
            return "usuario";

        }


        public static function buscarEmpleado($id){
            $link = Conexion::conectar();

            $sql = "SELECT cedula FROM empleados WHERE cedula = :id";

            $stmt = $link -> prepare($sql);
            $stmt->execute(["id" => $id]);
            return count($stmt->fetchAll());


        }

        public static function buscarUsuario($id){
            $link = Conexion::conectar();

            $sql = "SELECT cedula, nombres, apellidos, tipo FROM usuarios WHERE cedula = :id LIMIT 1";

            $stmt = $link -> prepare($sql);
            $stmt->execute(["id" => $id]);
            return $stmt->fetchAll();


        }

        public static function agregarEmpleado($id){
            $datos = Admin::buscarUsuario($id);

            $link = Conexion::conectar();

            foreach ($datos as $dato) {
                $sql = "INSERT INTO empleados (cedula, nombres, apellidos, tipo) 
                VALUES (:cedula, :nombres, :apellidos, :tipo)";
                $stmt = $link -> prepare($sql);
                return $stmt->execute([
                    "cedula" => $dato["cedula"],
                    "nombres" => $dato["nombres"],
                    "apellidos" => $dato["apellidos"],
                    "tipo" => $dato["tipo"]
                ]);
                break;
            }

        }

        public static function actualizarEmpleado($id, $tipo){
            $link = Conexion::conectar();

            $stmt = $link->prepare("UPDATE empleados SET tipo_emp = :tipo WHERE cedula = :cedula;");
            $stmt -> execute(["tipo" => $tipo, "cedula" => $id]);

        }

        public static function actualizarInfo($atr, $cedula, $valor){
            $link = Conexion::conectar();

            $sql = "UPDATE usuarios SET $atr = :valor WHERE cedula = :cedula;";
            $stmt = $link->prepare($sql);
            return $stmt -> execute(["valor" => $valor, "cedula" => $cedula]);
        }

        public static function repeatEmail($email){
            $link = Conexion::conectar();
    
            $sql = "SELECT correo FROM usuarios WHERE  correo = :email LIMIT 1";
            $stmt = $link -> prepare($sql);
    
            $stmt -> execute(["email" => $email]);
    
            return $stmt ->  fetchAll();
        }
    }

    
?>