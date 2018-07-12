<?php

 require_once"controladores/plantilla.controlador.php" ;
 require_once"controladores/usuarios.controlador.php" ;
 require_once"controladores/categorias.controlador.php" ;
 require_once"controladores/equipo.controlador.php" ;
 require_once"controladores/empleados.controlador.php" ;
 require_once"controladores/entregas.controlador.php" ;

 require_once"modelos/usuarios.modelo.php" ;
 require_once"modelos/categorias.modelo.php" ;
 require_once"modelos/equipo.modelo.php" ;
 require_once"modelos/empleados.modelo.php" ;
 require_once"modelos/entregas.modelo.php" ;

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
