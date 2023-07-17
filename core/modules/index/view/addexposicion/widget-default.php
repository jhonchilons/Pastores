<?php 

if(count($_POST)>0){  

	$registro = new ExposicionesData();

//	echo 'Registro => ' .print_r ($registro);

	$registro->nroexpo = addslashes($_POST["nroexpo"]);
	$registro->fechaexpo = addslashes($_POST["fechaexpo"]);
	$registro->idciudad = addslashes($_POST["idciudad"]);
	$registro->lugar = addslashes($_POST["lugar"]);
	$registro->tipoexposicion = addslashes($_POST["tipoexposicion"]);
	$registro->idjuez = addslashes($_POST["idjuez"]);
	$registro->ayudante = addslashes($_POST["ayudante"]);
	$registro->organiza = addslashes($_POST["organiza"]);
	$registro->estado = addslashes($_POST["estado"]);

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

	print "<script>window.location='index.php?view=exposicion';</script>";

}

?>