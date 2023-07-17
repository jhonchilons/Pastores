<?php

if(count($_POST)>0){ 

	$registro = new InscripcionData();

	$registro->idexposicion = addslashes($_POST["idexposicion"]);
	$registro->idejemplar = addslashes($_POST["idejemplar"]);
	$registro->iduser = $_SESSION["user_id"]; 
	$registro->fechareg = addslashes($_POST["fechareg"]);
	$registro->fotovoucher = addslashes($_POST["fotovoucher"]);
	$registro->contacto = addslashes($_POST["contacto"]);
	$registro->correo = addslashes($_POST["correo"]);
	$registro->celular = addslashes($_POST["celular"]);
	$registro->tipoins = addslashes($_POST["tipoins"]);
	
	if(isset($_FILES["fotovoucher"])){
		$picture = new Upload($_FILES["fotovoucher"]);
		if($picture->uploaded){
			$picture->Process("fpdf/images/");
			if($picture->processed){
				//$registro->fotovoucher = 'images_load/'.$picture->file_dst_name;
				$registro->fotovoucher = 'images/'.$picture->file_dst_name;
				$reg = 'images/'.$registro->add_with_image(); 
			}
		} else {
			$reg = 'images/'.$registro->add();
		}
	} 
	else{
	  $reg = 'images/'.$registro->add(); 
	}  
	//echo 'Registro => ' .print_r ($registro);
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Constancia de Inscripción</title>
</head>
<body>
	<h2> Constancia de Inscripción de Ejemplar </h2>
	<form id="form" method="post" class="form-horizontal" action="fpdf/vistainscripcion.php" enctype="multipart/form-data" >

		<div class="hr-line-dashed"></div>
		<div class="form-group row">                                  
			<label class="col-sm-1 control-label font-bold"><i class="fa fa-slack"></i> Expo</label>
			<div class="col-sm-1"><input type="text" class="form-control" name="idexposicion" value="<?php echo $registro->idexposicion ?>" readonly></div>
                               
			<label class="col-sm-1 control-label font-bold"><i class="fa fa-slack"></i> Ejemplar</label>
			<div class="col-sm-1"><input type="text" class="form-control" name="idejemplar" value="<?php echo $registro->idejemplar ?>" readonly></div>
		</div>  

		<div class="hr-line-dashed"></div>
		<div class="form-group row">
			<label class="col-sm-2 control-label font-bold"></label>
			<div class="col-sm-2 col-sm-offset-2">
				
				<button class="btn btn-success btn-sm" type="submit"> Imprimir Constancia</button>
			</div>
 	</form>
</body>
</html>