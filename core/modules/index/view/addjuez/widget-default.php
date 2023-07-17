<?php

if(count($_POST)>0){ 

	$registro = new JuezData();

	//$registro->idjuez = addslashes($_POST["id"]);
	$registro->nombrejuez = addslashes($_POST["nombrejuez"]);
	$registro->dni = addslashes($_POST["dni"]);
	$registro->fechanac = addslashes($_POST["fechanac"]);
	$registro->correo = addslashes($_POST["correo"]);
	$registro->idpais = addslashes($_POST["idpais"]);
	$registro->titulo = addslashes($_POST["titulo"]);
	$registro->estado = addslashes($_POST["estado"]);
	$registro->picture = addslashes($_POST["picture"]);
	
	if(isset($_FILES["picture"])){
		$picture = new Upload($_FILES["picture"]);
		if($picture->uploaded){
			$picture->Process("images_load/");
			if($picture->processed){
				//$registro->fotovoucher = 'images_load/'.$picture->file_dst_name;
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

	//echo 'Registro => ' .print_r ($registro);
	print "<script>window.location='index.php?view=jueces';</script>"; 
} 

?>