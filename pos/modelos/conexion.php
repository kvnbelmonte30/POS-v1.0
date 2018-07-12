<?php 

	class conexion
	{
		
	 static public function conectar()
		{
			$link = new PDO("mysql:host=localhost;dbname=POS","root","");

			$link->exec("set names utf8");

			return $link;
		}
	}

 ?>