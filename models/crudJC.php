<?php

    require_once "conexion.php";

    class Jefe{


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

        public static function mostrarSolicitudesModel($tipo){
            $link = Conexion::conectar();

            $sql = "SELECT * FROM solicitud WHERE tipo_soli = $tipo AND aprobada = 2";
            $stmt = $link -> prepare($sql);
            $stmt -> execute();
            
            return $stmt -> fetchAll();

        }

        public static function mostrarSolicitudModel($codigo, $tipo){
            $link = Conexion::conectar();

            $sql = "SELECT * FROM solicitud WHERE id = $codigo AND aprobada = $tipo";
            $stmt = $link -> prepare($sql);
            $stmt -> execute();
            
            return $stmt -> fetchAll();

        }


        public static function SolicitudModel($codigo, $aprob){
            $link = Conexion::conectar();

            $sql = "UPDATE solicitud SET aprobada = :aprob WHERE id = :codigo LIMIT 1";
            $stmt = $link->prepare($sql);

            return $stmt -> execute(["aprob" => $aprob, "codigo" => $codigo]);

        }


        public static function aceptarSolicitudModel($codigo, $datos_serv, $datos_g){
            $fecha_hoy = Jefe::obtenerFechaHoy();
            //Agregamos al cliente en caso de no estar registrado
            if (count(Jefe::buscarClienteModel($datos_serv["cedula_clie"])) == 0){
                Jefe::agregarCliente($datos_serv["cedula_clie"]);
            }
            //Cambiamos el estado de la solicitud a aprobado
            Jefe::SolicitudModel($codigo, 1);
            
            $link = Conexion::conectar();

            $sql = "INSERT INTO servicios 
            (codigo_serv, tipo_serv, cantidad, plazo, fecha_aprob, interes, cedula_clie, cedula_emp, cuenta_banc)
            VALUES
            (:codigo_serv, :tipo_serv, :cantidad, :plazo, :fecha_aprob, :interes, :cedula_clie, :cedula_emp, :cuenta_banc)";
            $stmt = $link->prepare($sql);

            $result = $stmt -> execute(["codigo_serv" => intval($datos_serv["codigo_serv"]),
                                    "tipo_serv" => intval($datos_serv["tipo_serv"]),
                                    "cantidad" => floatval($datos_serv["cantidad"]),
                                    "plazo" => intval($datos_serv["plazo"]),
                                    "fecha_aprob" => Jefe::obtenerFechaHoy(),
                                    "interes" => doubleval($datos_serv["interes"]),
                                    "cedula_clie" => $datos_serv["cedula_clie"],
                                    "cedula_emp" => $datos_serv["cedula_emp"],
                                    "cuenta_banc" => $datos_serv["cuenta_banc"]
                                    ]
                                );

            if ($result){
                // En caso de que se tenga una garantia este se registrarás
                if (count($datos_g) > 0){
                    Jefe::agregargarantia($codigo, $datos_g);
                }
            }
            Jefe::generarCronograma($codigo);
            return $result;

        }

        //Se agrega garantia o fiador en caso de que se requiera
        public static function agregargarantia($codigo, $datos_g){
            
            if (strlen($datos_g["fiador"]) > 0){
                Jefe::fiador($codigo, $datos_g["fiador"]);
            } else {
                Jefe::garantia($datos_g, $codigo);
            }
        }

        // agregar garantia
        private static function garantia($datos_g, $codigo){
            $link = Conexion::conectar();
            $sql = "INSERT INTO garantia (valor_g, tipo_g, direccion_g, codigo_serv)
            VALUES
            (:valor_g, :tipo_g, :direccion_g, :codigo_serv)";
            $stmt = $link->prepare($sql);

            $stmt -> execute(["valor_g" => $datos_g["valor_g"],
                "tipo_g" => $datos_g["tipo_g"],
                "direccion_g" => $datos_g["direccion_g"],
                "codigo_serv" => $codigo
                ]);

        }

        //agregar fiador
        private static function fiador($codigo, $fiador){
            $link = Conexion::conectar();
            $sql = "UPDATE servicios SET fiador = :fiador WHERE codigo_serv = :codigo LIMIT 1";
            $stmt = $link->prepare($sql);

            $stmt -> execute(["fiador" => $fiador, "codigo" => $codigo]);
        }

        //agregar cliente
        private static function agregarCliente($cedula){
            $resultado = Jefe::buscarUsuarioModel($cedula);

            $link = Conexion::conectar();
            
            $sql = "INSERT INTO cliente (cedula_clie, nombres, apellidos)
            VALUES (:cedula, :nombres, :apellidos)";

            $stmt = $link -> prepare($sql);
            foreach ($resultado as $row){
                $stmt -> execute(["cedula" => $row["cedula"],
                        "nombres" => $row["nombres"],
                        "apellidos" => $row["apellidos"]
                        ]);
            break;
            }


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

        public static function buscarUsuarioModel($cedula){
            $link = Conexion::conectar();

            $sql = "SELECT * FROM usuarios WHERE cedula = :cedula LIMIT 1";
            $stmt = $link -> prepare($sql);

            $stmt -> execute(["cedula" => $cedula]);

            return $stmt -> fetchAll();

        }

        // Funcion que retorna la fecha actual del pais
        private static function obtenerFechaHoy(){
            date_default_timezone_set('America/Bogota');
            return date("Y")."-".date("m")."-".date("d");
        }
        


        public static function generarCronograma($codigo_serv){
            $link = Conexion::conectar();
            $sql = "INSERT into cronograma (servicios_codigo) VALUES (:codigo_serv)";
            
            $stmt = $link -> prepare($sql);
            $stmt -> execute(["codigo_serv" => $codigo_serv]);
            $codigo_crono = $link -> lastInsertId();
            Jefe::generarCuotas($codigo_crono, $codigo_serv);
        }

        private static function buscarInteresCantidad($codigo_serv){
            $link = Conexion::conectar();
            $sql = "SELECT cantidad, interes, plazo, fecha_aprob FROM servicios WHERE codigo_serv = :codigo_serv LIMIT 1;";

            $stmt = $link -> prepare($sql);
            $stmt -> execute(["codigo_serv" => $codigo_serv]);

            return $stmt -> fetchAll();
        }

        private static function generarCuotas($codigo_crono, $codigo_serv){
            $resultado = Jefe::buscarInteresCantidad($codigo_serv);
            $cantidad = $resultado[0][0];
            $interes = $resultado[0][1];
            $plazo = $resultado[0][2];
            $fecha = $resultado[0][3];
            $interes_per = 0; //interes del periodo
            $amortizacion = 0;
            
            $temp = pow((1 + $interes),$plazo);
            $numerador = $cantidad * $interes * $temp;
            $denominador = $temp - 1;
            $valor_cuota = round($numerador / $denominador);
            for ($i = 1; $i <= $plazo; $i++){
                $fecha = date("Y/m/d",strtotime($fecha."+ 1 month")); 
                $interes_per = round($cantidad * $interes);
                $amortizacion = round($valor_cuota - $interes_per);
                $cantidad -= $amortizacion;
                $arr = array($i, $fecha, $valor_cuota, $interes_per, $amortizacion, $cantidad, $codigo_crono);
                Jefe::agregarCuota($arr);
            }

        }

        private static function agregarCuota($args){
            $link = Conexion::conectar();
            $sql = "INSERT INTO cuotas
            (numero_cuota, fecha_cuota, valor_cuota, interes_periodo, amortizacion, saldo, cronograma_codigo) 
            VALUES 
            (:num, :fecha, :valor, :interes, :amortizacion, :saldo, :cronograma);";
            $stmt = $link -> prepare($sql);
            $stmt -> execute([
                            "num" => $args[0],
                            "fecha" => $args[1],
                            "valor" => $args[2],
                            "interes" => $args[3],
                            "amortizacion" => $args[4],
                            "saldo" => $args[5],
                            "cronograma" => $args[6]
                            ]);
        }

        public static function mostrarCronogramaModel($codigo){
            $link = Conexion::conectar();
            $sql = "SELECT * from cuotas JOIN cronograma ON (codigo_cronograma = cronograma_codigo)
                    WHERE servicios_codigo = :codigo";
            $stmt = $link -> prepare($sql);
            $stmt -> execute(["codigo" => $codigo]);

            return $stmt -> fetchAll();
        }

    }

?>