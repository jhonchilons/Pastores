<?php

if(count($_POST)>0){ 

	$registro = new CalificativoData();

	$registro->calificativo = addslashes($_POST["calificativo"]);
	$registro->estado = addslashes($_POST["estado"]);

	$registro->add();

	//echo 'Registro => ' .print_r ($registro);
	print "<script>window.location='index.php?view=calificativos';</script>"; 

} 
?>