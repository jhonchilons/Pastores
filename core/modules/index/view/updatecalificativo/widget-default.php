<?php

if(count($_POST)>0){ 

	$registro = CalificativoData::getById($_POST["id"]);  

	$registro->idcal= $_POST["id"];

	$registro->calificativo = addslashes($_POST["calificativo"]);
	$registro->estado = addslashes($_POST["estado"]);
	$registro->update();
	
	print "<script>window.location='index.php?view=calificativos';</script>"; 

} 

?>