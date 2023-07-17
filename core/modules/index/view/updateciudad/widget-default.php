<?php

if(count($_POST)>0){ 

	$registro = CiudadData::getById($_POST["id"]);  

	$registro->idciudad= $_POST["id"];

	$registro->ciudad = addslashes($_POST["ciudad"]);
	$registro->update();
	
	print "<script>window.location='index.php?view=ciudades';</script>"; 

} 

?>