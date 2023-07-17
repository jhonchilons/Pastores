<?php

$GLOBALS["u"]= UserData::getById($_SESSION["user_id"]);

if($GLOBALS["u"]->is_admin > 0){ 
    
    $paises  = PaisData::getAll();
    $jueces = JuezData::getById($_REQUEST['id']);

?>


<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-lg-10">

		<h2 class="breadcrumb-item active"><strong> <?php echo htmlspecialchars($jueces->nombrejuez) ?> </strong></h2>

		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php?view=home"><i class="fa fa-desktop"></i> Inicio</a></li> 
			<li class="breadcrumb-item"><a href="index.php?view=jueces">Jueces</a></li>
			<li class="breadcrumb-item active"><strong>Editar Juez</strong></li>
		</ol>

    </div>

    <div class="col-lg-2">

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

                                <a href="index.php?view=jueces" data-toggle="tooltip" data-placement="top" title="Listar Jueces"><i class="glyphicon glyphicon-th-list"></i></a>
								<a href="index.php?view=newjuez" data-toggle="tooltip" data-placement="top" title="Nuevo Juez"><i class="glyphicon glyphicon-plus-sign"></i></a>
								<a href="index.php?view=editjuez&id=<?php echo $_REQUEST['id'] ?>" data-toggle="tooltip" data-placement="top" title="Refrescar"><i class="glyphicon glyphicon-repeat"></i></a> 
								<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                            </div>

                        </div>

                        <div class="ibox-content">

                            <form id="form" method="post" class="form-horizontal" action="index.php?view=updatejuez" enctype="multipart/form-data">

                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Nombre del Juez (*)</label>
                                    <div class="col-md-6">
                                    <input required type="text" name="nombrejuez" required class="form-control" id="nombrejuez" placeholder="Nombre Juez" onkeyup="mayus(this);" value="<?php echo htmlspecialchars($jueces->nombrejuez) ?>" required>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Nro DNI/Cedula (*)</label>
                                    <div class="col-md-6">
                                    <input required type="text" name="dni" required class="form-control" id="dni" placeholder="DNI" value="<?php echo htmlspecialchars($jueces->dni) ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Fecha de Cumpleaños (*)</label>
                                    <div class="col-md-6">
                                    <input required type="date" name="fechanac" required class="form-control" id="fechanac" value="<?php echo htmlspecialchars($jueces->fechanac) ?>">
                                    </div>
                                </div> 
 
                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Correo (*)</label>
                                    <div class="col-md-6">
                                    <input required type="email" name="correo" required class="form-control" id="correo" placeholder="Correo" value="<?php echo htmlspecialchars($jueces->correo) ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Nacionalidad (*)</label>
                                    <div class="col-md-6">
                                            <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="idpais"> 
                                                <option value="0" >SELECCIONA PAIS...</option>
                                                <?php foreach($paises as $pais):?>
                                                    <option value="<?php echo $pais->idpais ?>" 
                                                    <?php if($jueces->idpais==$pais->idpais) echo "selected"; ?>>
                                                    <?php echo htmlspecialchars($pais->nombrepais) ?></option>
                                                <?php endforeach;?>
                                            </select>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Titulos Juez (*)</label>
                                    <div class="col-md-6">
                                    <input required type="text" name="titulo" required class="form-control" id="titulo" placeholder="Ejemplo: APPPA-COAPA-SV" onkeyup="mayus(this);" value="<?php echo htmlspecialchars($jueces->titulo) ?>">
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Estado como Juez (*)</label>
                                    <div class="col-md-6">
                                        <div class="i-checks">
                                            <label><input type="radio" value="ACTIVO" name="estado" <?php if($jueces->estado=='ACTIVO') echo "checked";?>> <i></i> ACTIVO </label>
                                            <label><input type="radio" value="INACTIVO" name="estado" <?php if($jueces->estado=='INACTIVO') echo "checked";?>> <i></i> INACTIVO </label>
                                        </div>
                                    </div>
                                </div> 

                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Foto Juez </label>
                                    <div class="col-md-10">
                                        <input type="file" name="picture" value="<?php echo $jueces->picture; ?>" >
                                        <?php if($jueces->picture!=""):?>
                                        <br> <br>
                                            <img class="img-thumbnail" src="<?php echo $jueces->picture;?>" width="400"> 
                                        <?php endif;?>
                                    </div>
                                </div>


                                <div class="hr-line-dashed"></div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label font-bold"></label>
                                    <div class="col-sm-2 col-sm-offset-2">
                                        <input name="idjuez" type="hidden" class="form-control" value="<?php echo $jueces->idjuez ?>">
                                        <button class="btn btn-success btn-sm" type="submit"> Actualizar Registro</button>

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