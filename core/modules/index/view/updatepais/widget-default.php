<?php

if(count($_POST)>0){ 

	$registro = PaisData::getById($_POST["id"]);  

	$registro->idpais= $_POST["id"];

	$registro->nombrepais = addslashes($_POST["nombrepais"]);
	$registro->update();

	//echo 'Registro => ' .print_r ($registro);
	
	print "<script>window.location='index.php?view=paises';</script>"; 

} 

?>