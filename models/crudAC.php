<?php
    require_once "conexion.php";

    class Auxiliar{

        public static function mostrarSolicitudModel($codigo){
            $link = Conexion::conectar();

            $sql = "SELECT * FROM solicitud WHERE id = :codigo LIMIT 1";
            $stmt = $link -> prepare($sql);
            $stmt -> execute(["codigo" => $codigo]);
            
            return $stmt -> fetchAll();
        }

        public static function mostrarSolicitudesModel($tipo){
            $link = Conexion::conectar();

            $sql = "SELECT * FROM solicitud WHERE aprobada = 0 AND tipo_soli = $tipo";
            $stmt = $link -> prepare($sql);
            $stmt -> execute();
            
            return $stmt -> fetchAll();

        }

        public static function SolicitudModel($codigo, $aprob, $auxi){
            $link = Conexion::conectar();

            $sql = "UPDATE solicitud SET aprobada = :aprob, auxiliar = :auxi WHERE id = :codigo LIMIT 1";
            $stmt = $link->prepare($sql);

            return $stmt -> execute(["aprob" => $aprob, "auxi" => $auxi, "codigo" => $codigo]);

        }


        public static function mostrarServicioClienteModel($cedula){
            $link = Conexion::conectar();

            $sql = "SELECT * FROM servicios WHERE cedula_clie = :cedula";
            $stmt = $link->prepare($sql);

            $stmt -> execute(["cedula" => $cedula]);

            return $stmt -> fetchAll();

        }

        public static function mostrarUsuarioModel($cedula){
            $link = Conexion::conectar();

            $sql = "SELECT * FROM usuarios WHERE cedula = :cedula";
            $stmt = $link->prepare($sql);

            $stmt -> execute(["cedula" => $cedula]);

            return $stmt -> fetchAll();

        }

        public static function buscarSolicitudModel($id){
            $link = Conexion::conectar();

            $sql = "SELECT id FROM solicitud WHERE id = :id";
            $stmt = $link->prepare($sql);

            $stmt -> execute(["id" => $id]);

            return $stmt -> fetchAll();

        }


        public static function buscarClienteModel($cedula){
            $link = Conexion::conectar();

            $sql = "SELECT t1.cedula, t1.usuario, t1.nombres, t1.apellidos, t1.correo, t1.telefono, t1.direccion_usu
                    FROM usuarios as t1 JOIN cliente as t2 
                    WHERE t2.cedula_clie = t1.cedula AND t2.cedula_clie = :cedula";
            $stmt = $link -> prepare($sql);

            $stmt -> execute(["cedula" => $cedula]);

            return $stmt -> fetchAll();
        }


        public static function prestamosCliente($cedula){
            $link = Conexion::conectar();

            $sql = "SELECT * FROM solicitud WHERE codigo_usu = $cedula AND tipo_soli = 1 AND aprobada = 1";
            $stmt = $link -> prepare($sql);
            $stmt -> execute();
            
            return $stmt -> fetchAll();
        }

        public static function InversionesCliente($cedula){
            $link = Conexion::conectar();

            $sql = "SELECT * FROM solicitud WHERE codigo_usu = $cedula AND tipo_soli = 2 AND aprobada = 1";
            $stmt = $link -> prepare($sql);
            $stmt -> execute();
            
            return $stmt -> fetchAll();
        }


        public static function mostrarCronogramaModel($codigo){
            $link = Conexion::conectar();
            $sql = "SELECT * from cuotas JOIN cronograma ON (codigo_cronograma = cronograma_codigo)
                    WHERE servicios_codigo = :codigo";
            $stmt = $link -> prepare($sql);
            $stmt -> execute(["codigo" => $codigo]);

            return $stmt -> fetchAll();
        }

        public static function pagarCuotaModel($crono, $cuota){
            $link = Conexion::conectar();
            $sql = "UPDATE cuotas SET estado = 1 WHERE cronograma_codigo = :crono AND numero_cuota = :cuota";
            $stmt = $link -> prepare($sql);
            return $stmt -> execute(["crono" => $crono, "cuota" => $cuota]);
        }
    }
    
?>