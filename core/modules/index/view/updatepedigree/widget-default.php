<?php
if(count($_POST)>0){ 

	$registro = PedigreeData::getById($_POST["id"]);

	$registro->idpedigree= $_POST["id"];
	$registro->nombredog = addslashes($_POST["nombredog"]);
	$registro->titulos = addslashes($_POST["titulos"]);
	$registro->sexo = addslashes($_POST["sexo"]);
	$registro->idraza = $_POST["idraza"];
	$registro->libro = addslashes($_POST["libro"]);
	$registro->nroregistro = addslashes($_POST["nroregistro"]);
	$registro->kkl = addslashes($_POST["kkl"]);

	$registro->fechanac = addslashes($_POST["fechanac"]);
	$registro->apariencia = addslashes($_POST["apariencia"]);
	$registro->idpadre = $_POST["idpadre"];
	$registro->idmadre = $_POST["idmadre"];
	$registro->codoeh = addslashes($_POST["codoeh"]);


	$registro->caderahd = addslashes($_POST["caderahd"]);
	$registro->tatuaje = addslashes($_POST["tatuaje"]);
	$registro->microchip = addslashes($_POST["microchip"]);
	$registro->dna = addslashes($_POST["dna"]);
	$registro->otros = addslashes($_POST["otros"]); 
	
	$registro->update();

	if(isset($_FILES["picture"])){
		$picture = new Upload($_FILES["picture"]);
		if($picture->uploaded){
			$picture->Process("../images_load/");
			if($picture->processed){
				$registro->picture = 'images_load/'.$picture->file_dst_name;
				
				$registro->update_image(); 

				echo $picture->file_dst_name;
			}
		}
	}
	
	print "<script>window.location='index.php?view=pedigree';</script>"; 

} 
?>