<?php

if(count($_POST)>0){ 

	$registro = new CiudadData();

	$registro->ciudad = addslashes($_POST["ciudad"]);

	$registro->add();

	//echo 'Registro => ' .print_r ($registro);
	print "<script>window.location='index.php?view=ciudades';</script>"; 

} 
?>