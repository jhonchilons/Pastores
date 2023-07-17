<?php

$GLOBALS["u"]= UserData::getById($_SESSION["user_id"]);

if($GLOBALS["u"]->is_admin > 0){ 

    $registro = ExposicionesData::getById($_REQUEST['id']);
	//echo 'Registro => ' .print_r ($registro);

    $date1 = new DateTime("2022-07-11");
    $date2 = new DateTime("2023-04-30");
    $diff = $date1->diff($date2);
    //echo get_format($diff);
   // echo 'Registro => ' .print_r ($registro);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reportes de Inscripciones</title>
</head>
<body>
	<h2> Reportes de Inscripciones y Planilla de Ejemplares por Exposición </h2>


<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="ibox-content">
	
			<form id="form" method="post" class="form-horizontal" action="fpdf/vistainscritos.php" enctype="multipart/form-data" >
				
				<div class="form-group row">                                  
					<label class="col-sm-1 control-label font-bold"><i class="fa fa-slack"></i> </label>
					<div class="col-sm-1"><input type="hidden" class="form-control" name="idexposicion" value="<?php echo $registro->idexposicion ?>" readonly></div>             
				</div> 
				<input name="nroexpo" type="hidden" value="<?php echo $registro->nroexpo ?>">
				<input name="tipoexposicion" type="hidden" value="<?php echo $registro->tipoexposicion ?>">
				<input name="fechaexpo" type="hidden" value="<?php echo $registro->fechaexpo ?>">
				<input name="nombrejuez" type="hidden" value="<?php echo $registro->nombrejuez ?>">
				<input name="lugar" type="hidden" value="<?php echo $registro->lugar ?>">
				<input name="organiza" type="hidden" value="<?php echo $registro->organiza ?>">
				<input name="ayudante" type="hidden" value="<?php echo $registro->ayudante ?>">
				<div class="form-group row">
					<label class="col-sm-1 control-label font-bold"></label>
					<div class="col-sm-1 col-sm-offset-2">
						<button class="btn btn-success btn-sm" type="submit"> Imprimir Reporte</button>
					</div>
				</div>
			</form>


			<div class="hr-line-dashed"></div>

			<form id="form" method="post" class="form-horizontal" action="fpdf/vistaplanilla.php" enctype="multipart/form-data" >
				<div class="form-group row">                                  
					<label class="col-sm-1 control-label font-bold"><i class="fa fa-slack"></i> </label>
					<div class="col-sm-1"><input type="hidden" class="form-control" name="idexposicion" value="<?php echo $registro->idexposicion ?>" readonly></div>		
				</div> 
				<input name="nroexpo" type="hidden" value="<?php echo $registro->nroexpo ?>">
				<input name="tipoexposicion" type="hidden" value="<?php echo $registro->tipoexposicion ?>">
				<input name="fechaexpo" type="hidden" value="<?php echo $registro->fechaexpo ?>">
				<input name="nombrejuez" type="hidden" value="<?php echo $registro->nombrejuez ?>">
				<input name="lugar" type="hidden" value="<?php echo $registro->lugar ?>">
				<input name="organiza" type="hidden" value="<?php echo $registro->organiza ?>">
				<input name="ayudante" type="hidden" value="<?php echo $registro->ayudante ?>">
				<div class="form-group row">
					<label class="col-sm-1 control-label font-bold"></label>
					<div class="col-sm-1 col-sm-offset-2">
						<button class="btn btn-success btn-sm" type="submit"> Imprimir Planilla...</button>
					</div>
				</div> 
			</form>
    	</div>
    </div>
</div>

</body>
</html>


<?php } 

else { ?>	

<div class="row">

	<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content text-center p-md">
                    <h2><span class="text-navy">Informaci&oacute;n</span><br/>
                    Credenciales incorrectas</h2> 
                    <p><i class='fa fa-key'></i> Usuario en sesi&oacute;n no tiene permisos al formulario solicitado...</p> 
                </div>
            </div>
        </div>
    </div>
    </div>

</div>	


<?php } ?>	

