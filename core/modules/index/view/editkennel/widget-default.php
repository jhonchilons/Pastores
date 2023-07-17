<?php

$GLOBALS["u"]= UserData::getById($_SESSION["user_id"]);

if($GLOBALS["u"]->is_admin > 0){ 
    $kennels   = KennelData::getById($_REQUEST['id']);
    $paises    = PaisData::getAll();

?>

<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-lg-10">

		<h2 class="breadcrumb-item active"><strong> <?php echo htmlspecialchars($kennels->kennel) ?></strong></h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php?view=home"><i class="fa fa-desktop"></i> Inicio</a></li> 
			<li class="breadcrumb-item"><a href="index.php?view=kennel">Kennel</a></li>
			<li class="breadcrumb-item active"><strong>Editar Kennel</strong></li>
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

                                <a href="index.php?view=kennel" data-toggle="tooltip" data-placement="top" title="Listar Criaderos"><i class="glyphicon glyphicon-th-list"></i></a>
								<a href="index.php?view=newkennel" data-toggle="tooltip" data-placement="top" title="Nuevo Criadero"><i class="glyphicon glyphicon-plus-sign"></i></a>
								<a href="index.php?view=editkennel&id=<?php echo $_REQUEST['id'] ?>" data-toggle="tooltip" data-placement="top" title="Refrescar"><i class="glyphicon glyphicon-repeat"></i></a> 
								<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                            </div>

                        </div>

                        <div class="ibox-content">

                            <form id="form" method="post" class="form-horizontal" action="index.php?view=updatekennel" enctype="multipart/form-data" >
								<div class="form-group row"><label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> ID</label>
								  <div class="col-sm-2"><input type="text" class="form-control" value="<?php echo $kennels->idkennel ?>" disabled="" ></div>
                                </div> 
                                
                                <div class="hr-line-dashed"></div>
								  <div class="form-group row"><label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Criadero (*)</label>
								  <div class="col-sm-10"><input type="text" class="form-control" name="kennel" value="<?php echo htmlspecialchars($kennels->kennel) ?>" required></div>
								</div>  

                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-bold"><i class="fa fa-slack"></i> Pais</label> 
                                    <div class="col-sm-4"> 

                                    <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="idpais"> 
                                        <option value="0" >SELECCIONA PAIS</option>
                                        <?php foreach($paises as $pais):?>
                                            <option value="<?php echo $pais->idpais ?>"                                            
                                                <?php if($pais->idpais!=null && $kennels->idpais==$pais->idpais) echo "selected"; ?> 
                                            >
                                            <?php echo htmlspecialchars($pais->nombrepais) ?></option>
                                        <?php endforeach;?>
                                    </select>
								  </div>
                                </div>	 

                                 
                                <div class="hr-line-dashed"></div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label font-bold"></label>
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <input name="id" type="hidden" class="form-control" value="<?php echo $kennels->idkennel ?>">
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