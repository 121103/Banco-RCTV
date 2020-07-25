<?php

	class Conexion{

		static public function conectar(){

			$link = new PDO("mysql:host=localhost;dbname=rctv","root","****");
			return $link;

		}

	}


	?>