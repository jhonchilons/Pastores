<?php

if(count($_POST)>0){ 


	$registro = SocioData::getById($_POST["idsocio"]);
	
	//$registro->idjuez= $_POST["idjuez"];
	$registro->apellidos = addslashes($_POST["apellidos"]);
	$registro->nombres = addslashes($_POST["nombres"]);
	$registro->fechanac = addslashes($_POST["fechanac"]);
	$registro->dni = addslashes($_POST["dni"]);
	$registro->direccion = addslashes($_POST["direccion"]);
	$registro->idciudad = addslashes($_POST["idciudad"]);
	$registro->idpais = addslashes($_POST["idpais"]);
	$registro->estadocivil = addslashes($_POST["estadocivil"]);
	$registro->conyugue = addslashes($_POST["conyugue"]);
	$registro->profesion = addslashes($_POST["profesion"]);
	$registro->cargo = addslashes($_POST["cargo"]);
	$registro->lugartrabajo = addslashes($_POST["lugartrabajo"]);
	$registro->clubes = addslashes($_POST["clubes"]);
	$registro->estadosocio = addslashes($_POST["estadosocio"]);
	$registro->tiposocio = addslashes($_POST["tiposocio"]);
	$registro->idsocio1 = addslashes($_POST["idsocio1"]);
	$registro->idsocio2 = addslashes($_POST["idsocio2"]);
	$registro->fechaingreso = addslashes($_POST["fechaingreso"]);
	$registro->nrosocio = addslashes($_POST["nrosocio"]);
	$registro->correo = addslashes($_POST["correo"]);
	$registro->nrocelular = addslashes($_POST["nrocelular"]);
	//$registro->picture = addslashes($_POST["picture"]);

	$registro->update();

	if(isset($_FILES["picture"])){

		$picture = new Upload($_FILES["picture"]);
		if($picture->uploaded){
			$picture->Process("images_socios/");
			if($picture->processed){
				$registro->picture = 'images_socios/'.$picture->file_dst_name;
				$registro->update_image(); 
				echo $picture->file_dst_name;
			}
		}
	}
	//echo 'Registro => ' .print_r ($registro);

	print "<script>window.location='index.php?view=socios';</script>"; 

} 

?>