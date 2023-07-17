<?php

if(count($_POST)>0){ 


	$registro = JuezData::getById($_POST["idjuez"]);
	
	//$registro->idjuez= $_POST["idjuez"];
	$registro->nombrejuez = addslashes($_POST["nombrejuez"]);
	$registro->dni = addslashes($_POST["dni"]);
	$registro->fechanac = addslashes($_POST["fechanac"]);
	$registro->correo = addslashes($_POST["correo"]);
	$registro->idpais = addslashes($_POST["idpais"]);
	$registro->titulo = addslashes($_POST["titulo"]);
	$registro->estado = addslashes($_POST["estado"]);

	$registro->update();

	if(isset($_FILES["picture"])){

		$picture = new Upload($_FILES["picture"]);
		if($picture->uploaded){
			$picture->Process("images_load/");
			if($picture->processed){
				$registro->picture = 'images_load/'.$picture->file_dst_name;
				$registro->update_image(); 
				echo $picture->file_dst_name;
			}
		}
	}
	//echo 'Registro => ' .print_r ($registro);

	print "<script>window.location='index.php?view=jueces';</script>"; 

} 

?>