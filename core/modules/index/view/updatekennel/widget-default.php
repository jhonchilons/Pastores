<?php

if(count($_POST)>0){ 

	$registro = KennelData::getById($_POST["id"]);  

	$registro->idkennel= $_POST["id"];

	$registro->kennel = addslashes($_POST["kennel"]);
	$registro->idpais = $_POST["idpais"];
	$registro->update();
	
	print "<script>window.location='index.php?view=kennel';</script>"; 

} 

?>