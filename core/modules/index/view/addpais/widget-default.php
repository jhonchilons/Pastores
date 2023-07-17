<?php

if(count($_POST)>0){ 

	$registro = new PaisData();

	$registro->nombrepais = addslashes($_POST["nombrepais"]);

	$registro->add();

	//echo 'Registro => ' .print_r ($registro);
	print "<script>window.location='index.php?view=paises';</script>"; 

} 
?>