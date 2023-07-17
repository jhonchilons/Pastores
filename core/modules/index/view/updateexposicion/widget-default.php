<?php

if(count($_POST)>0){ 


	$registro = ExposicionesData::getById($_POST["idexposicion"]);

	$registro->idexposicion= $_POST["idexposicion"];
	$registro->nroexpo = addslashes($_POST["nroexpo"]);
	$registro->fechaexpo = addslashes($_POST["fechaexpo"]);
	$registro->idciudad = addslashes($_POST["idciudad"]);
	$registro->lugar = addslashes($_POST["lugar"]);
	$registro->tipoexposicion = addslashes($_POST["tipoexposicion"]);
	$registro->idjuez = addslashes($_POST["idjuez"]);
	$registro->ayudante = addslashes($_POST["ayudante"]);
	$registro->organiza = addslashes($_POST["organiza"]);
	$registro->estado = addslashes($_POST["estado"]);
	$registro->idfig1 = addslashes($_POST["idfig1"]);
	$registro->idfig2 = addslashes($_POST["idfig2"]);

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

	print "<script>window.location='index.php?view=exposicion';</script>"; 

} 

?>