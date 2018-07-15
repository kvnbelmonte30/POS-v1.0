<?php  

class ControladorUsuarios{
	
	/*========================================
	=            ingresar usuario            =
	========================================*/
	
	static public function ctrIngrsoUsuario(){

		if (isset($_POST["ingUsuario"])) {
			
			if (preg_match('/^[a-zA-Z0-9]+$/',$_POST["ingUsuario"]) && preg_match('/^[a-zA-Z0-9]+$/',$_POST["ingPassword"])) {
				
				$encriptar = crypt($_POST["ingPassword"],'$2a$07$usesomesillystringforsalt$' );

				$tabla = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){

					$_SESSION["iniciarsesion"] = "ok";
					$_SESSION["id"] = $respuesta["id"];
					$_SESSION["nombre"] = $respuesta["nombre"];
					$_SESSION["usuario"] = $respuesta["usuario"];
					$_SESSION["foto"] = $respuesta["foto"];
					$_SESSION["perfil"] = $respuesta["perfil"];

					echo '<script>

							window.location = "inicio"

						  </script>';

				}else{

					echo ' <br><div class="alert alert-danger">Érror al ingresar, vuelve a intentarlo</div>';
				}

			}

		}
	}
	
	/*=====  End of ingresar usuario  ======*/
	
	
	/*=========================================
	=            REGISTRAR USUARIO            =
	=========================================*/

	static public function ctrCrearUsuario(){

		if(isset($_POST["nuevoUsuario"])){

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) && 
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["contraseña"])) {

				/*==============================================
				=            Validar imagen usuario            =
				==============================================*/

				$ruta="";

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){

				list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

				$nuevoAncho = 500;
				$nuevoAlto = 500;

				/*===========================================================================
				=      CREACION DE DIRECTORIO DONDE SE GUARDARA LA IMAGEN DE USUARIO       =
				===========================================================================*/
				
				$directorio= "vistas/img/usuarios/".$_POST["nuevoUsuario"];
				mkdir($directorio, 0755);
				
				/*=====  End of CREACION DE DIRECTORIO DONDE SE GUARDARA LA IMAGEN   ======*/
				
				/*===================================================================================
				=      DEACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP       =
				===================================================================================*/
				
				if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {
					
					$aleatorio = mt_rand(100,999); 

					$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

					$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagejpeg($destino, $ruta);

				}
				
				if ($_FILES["nuevaFoto"]["type"] == "image/png") {
					
					$aleatorio = mt_rand(100,999); 
					$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

					$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagepng($destino, $ruta);

				}
				/*= End of DEACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP =*/
				
				
				
					

				}
				
				/*=====  End of Validar imagen usuario  ======*/
				
				$tabla = "usuarios";

				$encriptar = crypt($_POST["contraseña"],'$2a$07$usesomesillystringforsalt$' );

				$datos = array("nombre" => $_POST["nuevoNombre"], 
							   "usuario" => $_POST["nuevoUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["nuevoPerfil"],
								"foto"=>$ruta);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

					swal({

						type:"success",
						title:"El usuario ha sido guardado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location ="usuarios";
							}
							});
					</script>';
				}

			}else{

				echo '<script>

					swal({

						type:"error",
						title:"El usuario no puede ir vacio o llevar caracteres especiales.",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location ="usuarios";
							}
							});
				</script>';
			}
		}
	}

	/*=====  End of REGISTRAR USUARIO  ======*/

	/*========================================
	=            MOSTRAR USUARIOS            =
	========================================*/
	
	static public function ctrMostrarUsuarios($item, $valor){

		$tabla="usuarios";
		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
		return $respuesta;
	}
	
	/*=====  End of MOSTRAR USUARIOS  ======*/
	
}