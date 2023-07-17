<?php

$GLOBALS["u"]= UserData::getById($_SESSION["user_id"]); 

if($GLOBALS["u"]->is_admin >= 0){ 
    $calificativos   = CalificativoData::getAll();
?>

<div class="row wrapper border-bottom blue-bg page-heading">
	<div class="col-lg-10">
		<h2>Registro de Calificativos</h2>
		<ol class="breadcrumb blue-bg">
			<li class="breadcrumb-item"><a href="index.php?view=home"><i class="fa fa-desktop"></i> Inicio</a></li>  
			<li class="breadcrumb-item"><a href="index.php?view=calificativos">Calificativos</a></li>
			<li class="breadcrumb-item active"><strong>Nuevo Registro</strong></li> 
		</ol>
    </div>

</div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            <!-- FIN INICIO TITULO PARTE 1-->
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><i class="fa fa-plus-circle"></i> Registro de Calificativos</h5>
                    </div>

                    <div class="table-responsive">

                    </div>

                        <div class="ibox-content">
                            <form id="form" method="post" class="form-horizontal" action="index.php?view=addcalificativo" enctype="multipart/form-data" >
                               
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-md-2 control-label font-bold"><i class="fa fa-slack"></i> Calificativo</label>
                                    <div class="col-md-2">
                                        <input required type="text" name="calificativo" required class="form-control" id="calificativo" placeholder="Ingrese Calificativo" require onkeyup="mayus(this);">
                                    </div>
                                </div> 

                                <div class="hr-line-dashed"></div>
								  <div class="form-group row"><label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Estado</label>
								    <div class="col-sm-4">
                                        <div class="i-checks">
                                            <label> <input type="radio" value="ACTIVO" name="estado" checked > <i></i> ACTIVO </label>&nbsp;&nbsp;&nbsp;
                                            <label> <input type="radio" value="INACTIVO" name="estado" > <i></i> INACTIVO </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label font-bold"></label>
                                    <div class="col-sm-4 col-sm-offset-2"> 
                                        <button class="btn btn-primary btn-sm" type="submit"> Guardar Registro</button>
                                    </div>
                                </div>>
                                <div class="hr-line-dashed"></div>
                            </form>
                        </div>
                </div>
            </div>
	    </div>	
    </div>
<!-- FIN </div>INICIO TITULO PARTE 2-->  


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