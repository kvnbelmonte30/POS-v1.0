/*=================================================
=            Agregando Foto de Usuario            =
=================================================*/

$(".nuevaFoto").change(function () {
	
	var imagen = this.files[0];

	/*=====================================================
	=       Validación formato de imagen .jpg o .png      =
	=====================================================*/
	
	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

		$(".nuevaFoto").val("");
		swal({

			title:"Error al subir imagen",
			text:"la imagen debe estar en formato .jpg o .png",
			type: "error",
			confirmButtonText: "cerrar"
			
			});
		/*=====  End of Validación formato de imagen .jpg o png   ======*/

		/*===========================================================
		=            Validación del tamaño de la imagen             =
		===========================================================*/
		
	}else if (imagen["size"] > 2097152) {

		$(".nuevaFoto").val("");
		swal({

			title:"Error al subir imagen",
			text:"la imagen debe pesar menos de 2 MB",
			type: "error",
			confirmButtonText: "cerrar"
			
			});
		/*=====  End of Validación del tamaño de la imagen   ======*/

		/*=====================================================
		=            previsualización de la imagen            =
		=====================================================*/

	}else{

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load",function (event) {
			
			var rutaImagen = event.target.result;

			$(".previsualizar").attr("src", rutaImagen);

		})

	}

	/*=====  End of previsualización de la imagen  ======*/
	

})

/*=====  End of Agregando Foto de usuario   ======*/
