<?php

$GLOBALS["u"]= UserData::getById($_SESSION["user_id"]);

if($GLOBALS["u"]->is_admin > 0){ 
    
    $ciudads  = CiudadData::getAll();
    $jueces  = JuezData::getAll();
    $figurantes1 = FiguranteData::getAll();
    $figurantes2 = FiguranteData::getAll();
    $exposicion = ExposicionesData::getById($_REQUEST['id']);

   // echo 'Registro => ' .print_r ($exposicion);
?>


<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-lg-10">

		<h2 class="breadcrumb-item active"><strong> <?php echo htmlspecialchars($exposicion->nroexpo) ?> </strong></h2>

		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php?view=home"><i class="fa fa-desktop"></i> Inicio</a></li> 
			<li class="breadcrumb-item"><a href="index.php?view=Exposicion">Exposiciones</a></li>
			<li class="breadcrumb-item active"><strong>Editar Exposición</strong></li>
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

                                <a href="index.php?view=exposicion" data-toggle="tooltip" data-placement="top" title="Listar Exposiciones"><i class="glyphicon glyphicon-th-list"></i></a>
								<a href="index.php?view=newexposicion" data-toggle="tooltip" data-placement="top" title="Nueva Exposición"><i class="glyphicon glyphicon-plus-sign"></i></a>
								<a href="index.php?view=editexposicion&id=<?php echo $_REQUEST['id'] ?>" data-toggle="tooltip" data-placement="top" title="Refrescar"><i class="glyphicon glyphicon-repeat"></i></a> 
								<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                            </div>

                        </div>

                        <div class="ibox-content">

                            <form id="form" method="post" class="form-horizontal" action="index.php?view=updateexposicion" enctype="multipart/form-data">

                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Nro de Exposición (*)</label>
                                    <div class="col-md-6">
                                    <input required type="text" name="nroexpo" required class="form-control" id="nroexpo" placeholder="Nro Exposición" value="<?php echo htmlspecialchars($exposicion->nroexpo) ?>" required onkeyup="mayus(this);">
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Fecha de Exposición (*)</label>
                                    <div class="col-md-6">
                                    <input required type="date" name="fechaexpo" required class="form-control" id="fechaexpo" value="<?php echo htmlspecialchars($exposicion->fechaexpo) ?>" required>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Organiza (*)</label>
                                    <div class="col-md-6">
                                    <input required type="text" name="organiza" required class="form-control" id="organiza" placeholder="Organiza" value="<?php echo htmlspecialchars($exposicion->organiza) ?>" required onkeyup="mayus(this);">
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Ciudad (*)</label>
                                    <div class="col-md-6">
                                            <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="idciudad"> 
                                                <option value="0" >SELECCIONA CIUDAD...</option>
                                                <?php foreach($ciudads as $ciudad):?>
                                                    <option value="<?php echo $ciudad->idciudad ?>" 
                                                    <?php if($exposicion->idciudad==$ciudad->idciudad) echo "selected"; ?>>
                                                    <?php echo htmlspecialchars($ciudad->ciudad) ?></option>
                                                <?php endforeach;?>
                                            </select>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Lugar (*)</label>
                                    <div class="col-md-6">
                                    <input required type="text" name="lugar" required class="form-control" id="lugar" placeholder="Lugar de Exposición" value="<?php echo htmlspecialchars($exposicion->lugar) ?>" onkeyup="mayus(this);">
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Tipo Exposición (*)</label>
                                    <div class="col-md-6">
                                        <div class="i-checks">
                                            <label><input type="radio" value="NACIONAL" name="tipoexposicion" <?php if($exposicion->tipoexposicion=='NACIONAL') echo "checked";?>> <i></i> NACIONAL </label>&nbsp; &nbsp;
                                            <label><input type="radio" value="INTERNACIONAL" name="tipoexposicion" <?php if($exposicion->tipoexposicion=='INTERNACIONAL') echo "checked";?>> <i></i> INTERNACIONAL </label>&nbsp; &nbsp;
                                            <label><input type="radio" value="SIEGER PERUANO" name="tipoexposicion" <?php if($exposicion->tipoexposicion=='SIEGER PERUANO') echo "checked";?>> <i></i> SIEGER PERUANO </label>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Juez (*)</label>
                                    <div class="col-md-3">
                                            <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="idjuez"> 
                                                <option value="0" >BUSCAR JUEZ...</option>
                                                <?php foreach($jueces as $juez):?>
                                                    <option value="<?php echo $juez->idjuez ?>" 
                                                    <?php if($exposicion->idjuez==$juez->idjuez) echo "selected"; ?>>
                                                    <?php echo htmlspecialchars($juez->nombrejuez) ?></option>
                                                <?php endforeach;?>
                                            </select>
                                    </div>

                                    <label for="lugar" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Ayudante de Juez</label>
                                    <div class="col-md-3">
                                        <input required type="text" name="ayudante" required class="form-control" id="ayudante" placeholder="Ingresar Ayudante" value="<?php echo htmlspecialchars($exposicion->ayudante) ?>" onkeyup="mayus(this);">
                                    </div>  

                                </div> 
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Figurante 1</label>
                                    <div class="col-md-3">
                                            <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="idfig1"> 
                                                <option value="0" >BUSCAR FIGIRANTE...</option>
                                                <?php foreach($figurantes1 as $fig1):?>
                                                    <option value="<?php echo $fig1->idfigurante ?>" 
                                                    <?php if($exposicion->idfig1==$fig1->idfigurante) echo "selected"; ?>>
                                                    <?php echo htmlspecialchars($fig1->nombrefig) ?></option>
                                                <?php endforeach;?>
                                            </select>
                                    </div>

                                    <label class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Figurante 2</label>
                                    <div class="col-md-3">
                                            <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="idfig2"> 
                                                <option value="0" >BUSCAR FIGURANTE...</option>
                                                <?php foreach($figurantes2 as $fig2):?>
                                                    <option value="<?php echo $fig2->idfigurante ?>"
                                                    <?php if($exposicion->idfig2==$fig2->idfigurante) echo "selected"; ?>>
                                                    <?php echo htmlspecialchars($fig2->nombrefig) ?></option>
                                                <?php endforeach;?>
                                            </select>
                                    </div>                                    
                                </div>                                 
                                
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Estado Expo</label>
                                    <div class="col-md-6">
                                    <div class="i-checks">
                                        <label> <input type="radio" value="ACTIVO" name="estado" <?php if($exposicion->estadoe=='ACTIVO') echo "checked";?>> <i></i> ACTIVO </label>&nbsp; &nbsp; 
                                        <label> <input type="radio" value="REALIZADO" name="estado" <?php if($exposicion->estadoe=='REALIZADO') echo "checked";?>> <i></i> REALIZADO </label>&nbsp; &nbsp; 
                                        <label> <input type="radio" value="PENDIENTE" name="estado" <?php if($exposicion->estadoe=='PENDIENTE') echo "checked";?>> <i></i> PENDIENTE </label>&nbsp; &nbsp; 
                                        <label> <input type="radio" value="CANCELADO" name="estado" <?php if($exposicion->estadoe=='CANCELADO') echo "checked";?>> <i></i> CANCELADO </label></div>
                                    </div>
                                </div> 

                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Foto/Diseño </label>
                                    <div class="col-md-10">
                                        <input type="file" name="picture" value="<?php echo $exposicion->picture; ?>" >
                                        <?php if($exposicion->picture!=""):?>
                                        <br> <br>
                                            <img class="img-thumbnail" src="<?php echo $exposicion->picture;?>" width="400"> 
                                        <?php endif;?>
                                    </div>
                                </div>


                                <div class="hr-line-dashed"></div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label font-bold"></label>
                                    <div class="col-sm-2 col-sm-offset-2">
                                        <input name="idexposicion" type="hidden" class="form-control" value="<?php echo $exposicion->idexposicion ?>">
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