<?php 

	require_once "conexion.php";

	/**
	* 
	*/
	class ModeloUsuarios{
		
		/*=======================================
		=           MOSTRAR USUARIOS           =
		=======================================*/

		static public function MdlMostrarUsuarios($tabla, $item, $valor){

			$stmt= conexion::conectar()-> prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt-> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt-> execute();

			return $stmt-> fetch();

			$stmt -> close();

			$stmt = null;
		}

		/*=======================================
		=        RESGISTRO DE USUARIOS          =
		=======================================*/

		static public function mdlIngresarUsuario($tabla, $datos){

			$stmt= conexion::conectar()-> prepare("INSERT INTO $tabla(nombre, usuario, password, perfil) VALUES (:nombre, :usuario, :password, :perfil)");
			$stmt-> bindParam(":nombre",$datos["nombre"], PDO::PARAM_STR);
			$stmt-> bindParam(":usuario",$datos["usuario"], PDO::PARAM_STR);
			$stmt-> bindParam(":password",$datos["password"], PDO::PARAM_STR);
			$stmt-> bindParam(":perfil",$datos["perfil"], PDO::PARAM_STR);

			if ($stmt-> execute()) {
				
				return "ok";

			}else{

				return "error";
			}

			$stmt -> close();

			$stmt = null;

		}
				
	}