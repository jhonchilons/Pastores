<?php

$GLOBALS["u"]= UserData::getById($_SESSION["user_id"]); 

if($GLOBALS["u"]->is_admin >= 0){ 
    //$jueces = JuezData::getAll();
    $ciudades = CiudadData::getAll();
?>

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>FIGURANTES</h2>

		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php?view=home"><i class="fa fa-desktop"></i> Inicio</a></li> 
			<li class="breadcrumb-item"><a href="index.php?view=figurantes">Figurantes</a></li>
			<li class="breadcrumb-item active"><strong>Nuevo Figurante</strong></li>
		</ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

<div class="row">

<!-- FIN INICIO TITULO PARTE 1-->
               
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><i class="fa fa-plus-circle"></i> Registro</h5>
                            <div class="ibox-tools tooltip-demo">
                                <a href="index.php?view=figurantes" data-toggle="tooltip" data-placement="top" title="Listar Exposiciones"><i class="glyphicon glyphicon-th-list"></i></a>
								<a href="index.php?view=newfigurante" data-toggle="tooltip" data-placement="top" title="Refrescar"><i class="glyphicon glyphicon-repeat"></i></a> 
								<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </div>
                        </div>

                        <div class="ibox-content">
                            <form id="form" method="post" class="form-horizontal" action="index.php?view=addfigurante" enctype="multipart/form-data"> 
                                <div class="form-group row">
                                    <label for="nroexpo" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Nrombre del Juez (*)</label>
                                    <div class="col-md-6">
                                        <input  type="text" name="nombrefig" required class="form-control" id="nombrefig" placeholder="Nombre Figurante" required onkeyup="mayus(this);">
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="organiza" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Nro DNI/Cedula</label>
                                    <div class="col-md-3">
                                        <input  type="text" name="dni" required class="form-control" id="dni" placeholder="Ingrese DNI/Cedula">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="fechaexpo" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Fecha de Nacimiento (*)</label>
                                    <div class="col-md-3">
                                        <input  type="date" name="fechanac" required class="form-control" id="fechanac" value="2023-04-01">
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="lugar" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Correo Electronico</label>
                                    <div class="col-md-6">
                                        <input required type="email" name="correo" required class="form-control" id="correo" placeholder="ingrese correo">
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Ciudad (*)</label>
                                    <div class="col-md-6">
                                            <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="idciudad"> 
                                                <option value="0" >SELECCIONA CIUDAD...</option>
                                                <?php foreach($ciudades as $ciudad):?>
                                                    <option value="<?php echo $ciudad->idciudad ?>" >
                                                    <?php echo htmlspecialchars($ciudad->ciudad) ?></option>
                                                <?php endforeach;?>
                                            </select>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="lugar" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Titulos Juez</label>
                                    <div class="col-md-6">
                                        <input required type="text" name="titulo" required class="form-control" id="titulo" placeholder="Figurante: APPPA-COAPA-FCI" onkeyup="mayus(this);">
                                    </div>
                                </div> 
                             
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Estado como Juez</label>
                                    <div class="col-md-6">
                                        <div class="i-checks">
                                            <label> <input type="radio" value="ACTIVO" name="estado" checked>  ACTIVO </label>&nbsp; &nbsp; 
                                            <label> <input type="radio" value="INACTIVO" name="estado">  INACTIVO </label>
                                        </div>
                                    </div>
                                </div> 

                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Foto (*)</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="picture">
                                    </div>
                                </div> 


                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label font-bold"></label>
                                    <div class="col-sm-2 col-sm-offset-2"> 
                                        <button class="btn btn-primary btn-sm" type="submit"> Guardar Registro</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

<!-- FIN INICIO TITULO PARTE 2-->  

</div>

</div>

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

<!-- Convertir a Mayusculas un texto -->
<script>
function mayus(e) {
    e.value = e.value.toUpperCase();
}
</script>

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