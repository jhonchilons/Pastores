<?php

$GLOBALS["u"]= UserData::getById($_SESSION["user_id"]);

if($GLOBALS["u"]->is_admin > 0){ 

    //$registro = EjemplarData::getById($_REQUEST['id']);
	$ejemplares = EjemplarData::getAll();
	
	//echo 'Registro => ' .print_r ($registro);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reportes de Participaciones</title>
</head>
<body>
<div class="row wrapper border-bottom blue-bg page-heading">
	<div class="col-lg-10">
		<h2>Reporte de Participaciones de un ejemplar en Exposciones</h2>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
					<div class="ibox-title">
                        <h5><i class="fa fa-plus-circle"></i> Reportes de Participaciones por Ejemplar</h5>
                    </div>
				<div class="ibox-content">
					<form id="form" method="post" class="form-horizontal" action="fpdf/vistaexpoxejemplar.php" enctype="multipart/form-data" >

						<div class="form-group row">
							<label class="col-sm-2 col-form-label font-bold"><i class="fa fa-slack"></i> Buscar Ejemplar (*)</label> 
							<div class="col-sm-4">
                                <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="idejemplar"> 
                                    <option value="0" >BUscar Ejemplar...</option>
                                    <?php foreach($ejemplares as $perro):?>
                                        <option value="<?php echo $perro->idejemplar ?>" >
                                        <?php echo htmlspecialchars($perro->nombredog) ?></option>
                                    <?php endforeach;?>
                                </select>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-2 control-label font-bold"></label>
							<div class="col-sm-2 col-sm-offset-2">
								<button class="btn btn-success btn-sm" type="submit"> Imprimir Reporte</button>
							</div>
						</div>
					</form>
					<div class="hr-line-dashed"></div>
				</div>
			</div>
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

<!-- Jquery Validate -->
<script src="js/plugins/validate/jquery.validate.min.js"></script>

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>

<!-- Chosen -->
<script src="js/plugins/chosen/chosen.jquery.js"></script> 

<!-- Page-Level Scripts -->

<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('#date_added').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#date_modified').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $("#form").validate({
            rules: {
                name: {
                    required: true 
                },
                lastname: {
                    required: true 
                },
                username: {
                    required: true 
                },
                email: {
                    required: true 
                } 
            }
        });
    });

    $('.chosen-select').chosen({width: "100%"}); 

</script>
