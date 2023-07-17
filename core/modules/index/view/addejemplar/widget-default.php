<?php

if(count($_POST)>0){  

	$registro = new EjemplarData();

	$registro->nombredog = addslashes($_POST["nombredog"]);
	$registro->sexo = addslashes($_POST["sexo"]);
	$registro->libro = addslashes($_POST["libro"]);
	$registro->nroregistro = addslashes($_POST["nroregistro"]);
	$registro->fechanac = addslashes($_POST["fechanac"]);
	$registro->padre = addslashes($_POST["padre"]);
	$registro->madre =addslashes($_POST["madre"]);
	$registro->codoeh = addslashes($_POST["codoeh"]);
	$registro->caderahd = addslashes($_POST["caderahd"]);
	$registro->tatuaje = addslashes($_POST["tatuaje"]);
	$registro->microchip = addslashes($_POST["microchip"]);
	$registro->dna = addslashes($_POST["dna"]);
	$registro->bh = $_POST["bh"];
	$registro->cabda = addslashes($_POST["cabda"]);
	$registro->seleccion = addslashes($_POST["seleccion"]);
	$registro->igp = addslashes($_POST["igp"]);
	$registro->tipopelo = addslashes($_POST["tipopelo"]);
	$registro->iduser = $_SESSION["user_id"];
	$registro->criador = addslashes($_POST["criador"]);
	$registro->propietario = addslashes($_POST["propietario"]);
	$registro->idpais = addslashes($_POST["idpais"]);

//echo 'Registro => ' .print_r ($registro);

	if(isset($_FILES["picture"])){
		$picture = new Upload($_FILES["picture"]);
		if($picture->uploaded){
			$picture->Process("images_load/");
			if($picture->processed){
				$registro->picture = 'images_load/'.$picture->file_dst_name;
				$reg = 'images_load/'.$registro->add_with_image(); 
			}
		} else {
			$reg = 'images_load/'.$registro->add();
		}
	} 
	else{
	  $reg = 'images_load/'.$registro->add(); 
	}  
	
	print "<script>window.location='index.php?view=ejemplar';</script>"; 

} 

?>