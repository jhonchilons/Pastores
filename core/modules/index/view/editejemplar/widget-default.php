<?php

$GLOBALS["u"]= UserData::getById($_SESSION["user_id"]);

if($GLOBALS["u"]->is_admin > 0){ 

    $ejemplar = EjemplarData::getById($_REQUEST['id']);
    $machos   = EjemplarData::getAllMachos();
    $hembras  = EjemplarData::getAllHembras();
    $paises    = PaisData::getAll();
    /*$kennels  = KennelData::getAll();*/
?>

<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-lg-10">

		<h2 class="breadcrumb-item active"><strong> <?php echo htmlspecialchars($ejemplar->nombredog) ?></strong></h2>

		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php?view=home"><i class="fa fa-desktop"></i> Inicio</a></li> 
			<li class="breadcrumb-item"><a href="index.php?view=ejemplar">Ejemplares</a></li>
			<li class="breadcrumb-item active"><strong>Editar Ejemplar</strong></li>
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
                                <a href="index.php?view=ejemplar" data-toggle="tooltip" data-placement="top" title="Listar Ejemplar"><i class="glyphicon glyphicon-th-list"></i></a>
								<a href="index.php?view=newejemplar" data-toggle="tooltip" data-placement="top" title="Nuevo Ejemplar"><i class="glyphicon glyphicon-plus-sign"></i></a>
								<a href="index.php?view=editejemplar&id=<?php echo $_REQUEST['id'] ?>" data-toggle="tooltip" data-placement="top" title="Refrescar"><i class="glyphicon glyphicon-repeat"></i></a> 
								<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </div>

                        </div>

                        <div class="ibox-content">
                            <form id="form" method="post" class="form-horizontal" action="index.php?view=updateejemplar" enctype="multipart/form-data" >
								<div class="form-group row"><label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> ID</label>
								  <div class="col-sm-1"><input type="text" class="form-control" value="<?php echo $ejemplar->idejemplar ?>" disabled="" ></div>
                                </div> 
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">                                  
                                  <label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Nombre Ejemplar (*)</label>
								  <div class="col-sm-6"><input type="text" class="form-control" name="nombredog" value="<?php echo htmlspecialchars($ejemplar->nombredog) ?>" placeholder="Ejemplo: REMO VOM FICHTENSCHLAG" required onkeyup="mayus(this);"></div>
								</div>  

                                <div class="hr-line-dashed"></div>
                                    <div class="form-group row"><label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Sexo (*)</label>
                                    <div class="col-sm-4">
                                        <div class="i-checks"><label> <input type="radio" value="MACHO" name="sexo" <?php if($ejemplar->sexo == "MACHO") echo "checked"; ?>> <i></i> MACHO </label>&nbsp;&nbsp;&nbsp;
                                                              <label> <input type="radio" value="HEMBRA" name="sexo" <?php if($ejemplar->sexo == "HEMBRA") echo "checked"; ?>> <i></i> HEMBRA </label></div>
                                    </div>

                                    <label class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Fecha Nac</label> 
                                    <div class="col-sm-2">
                                        <input type="date" name="fechanac" class="form-control" value="<?php echo $ejemplar->fechanac; ?>" > 
                                    </div>                                    
                                </div>
 
                                <div class="hr-line-dashed"></div>
								  <div class="form-group row"><label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Libro (*)</label>
								  <div class="col-sm-4">
                                        <input type="text" class="form-control" name="libro" value="<?php echo htmlspecialchars($ejemplar->libro) ?>" placeholder="Ejemplo: APPPA - LER/ACOA - ROI" onkeyup="mayus(this);">
                                  </div>

                                  <label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Nro de Regitro (*)</label>
								  <div class="col-sm-4">
                                        <input type="text" class="form-control" name="nroregistro" value="<?php echo htmlspecialchars($ejemplar->nroregistro) ?>" >
                                  </div>
                                </div> 

                                <div class="hr-line-dashed"></div>
								<div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-bold"><i class="fa fa-slack"></i> Padre (*)</label> 
                                    <div class="col-sm-4">
                                    <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="padre"> 
                                        <option value="0" <?php if($ejemplar->padre=='0') echo "selected"; ?>>SELECCIONA PADRE</option>
                                        <?php foreach($machos as $macho):?>
                                            <option value="<?php echo $macho->idejemplar ?>" 
                                            <?php if($ejemplar->padre==$macho->idejemplar) echo "selected"; ?>>
                                            <?php echo htmlspecialchars($macho->nombredog) ?></option>
                                        <?php endforeach;?>
                                    </select>
                                    </div>

                                    <label class="col-sm-2 col-form-label font-bold"><i class="fa fa-slack"></i> Madre (*)</label> 
                                    <div class="col-sm-4">
                                    <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="madre"> 
                                        <option value="0" <?php if($ejemplar->madre=='0') echo "selected"; ?>>SELECCIONA MADRE</option>
                                        <?php foreach($hembras as $hembra):?>
                                            <option value="<?php echo $hembra->idejemplar ?>" 
                                            <?php if($ejemplar->madre==$hembra->idejemplar) echo "selected"; ?>>
                                            <?php echo htmlspecialchars($hembra->nombredog) ?></option>
                                        <?php endforeach;?>
                                    </select>
                                    </div>
                                </div> 

                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Examenes de Codo (*)</label>
                                    <div class="col-sm-4">
                                        <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="codoeh"> 
                                                <option value="No Tiene"<?php if($ejemplar->codoeh=='No Tiene') echo "selected"; ?>>SELECCIONA...</option>
                                                <option value="(A) Normal"<?php if($ejemplar->codoeh=='(A) Normal') echo "selected"; ?>>(A) Normal</option>
                                                <option value="(A) Casi Normal"<?php if($ejemplar->codoeh=='(A) Casi Normal') echo "selected"; ?>>(A) Casi Normal</option>
                                                <option value="(A) Todavia Permitido"<?php if($ejemplar->codoeh=='(A) Todavia Permitido') echo "selected"; ?>>(A) Todavia Permitido</option>
                                        </select>
                                    </div>

                                    <label class="col-sm-2 col-form-label font-bold"><i class="fa fa-slack"></i> Examenes Cadera (*)</label> 
                                    <div class="col-sm-4">
                                        <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="caderahd"> 
                                        <option value="No Tiene"<?php if($ejemplar->caderahd=='No Tiene') echo "selected"; ?>>SELECCIONA...</option>
                                                <option value="(A) Normal"<?php if($ejemplar->caderahd=='(A) Normal') echo "selected"; ?>>(A) Normal</option>
                                                <option value="(A) Casi Normal"<?php if($ejemplar->caderahd=='(A) Casi Normal') echo "selected"; ?>>(A) Casi Normal</option>
                                                <option value="(A) Todavia Permitido"<?php if($ejemplar->caderahd=='(A) Todavia Permitido') echo "selected"; ?>>(A) Todavia Permitido</option>
                                        </select>
                                    </div>
                                </div> 
                                

                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Tatuaje (*)</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="tatuaje" value="<?php echo htmlspecialchars($ejemplar->tatuaje) ?>" >
                                    </div>

                                    <label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Microchip (*)</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="microchip" value="<?php echo htmlspecialchars($ejemplar->microchip) ?>" minlength="0" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"type = "number"maxlength = "15">
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Dna (*)</label>
                                    <div class="col-sm-4">
                                        <div class="i-checks">
                                            <label> <input type="radio" value="SI" name="dna" <?php if($ejemplar->dna=='SI') echo "checked";?>> <i></i> SI </label>&nbsp;&nbsp;&nbsp;
                                            <label> <input type="radio" value="NO" name="dna" <?php if($ejemplar->dna=='NO') echo "checked";?>> <i></i> NO </label>
                                        </div>
                                    </div>

                                    <label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Tipo de Pelo</label>
                                    <div class="col-sm-4">
                                        <div class="i-checks">
                                            <label><input type="radio" value="Normal" name="tipopelo" <?php if($ejemplar->tipopelo=='Normal') echo "checked";?>> <i></i> Pelo Normal </label>&nbsp;&nbsp;
                                            <label><input type="radio" value="Largo" name="tipopelo" <?php if($ejemplar->tipopelo=='Largo') echo "checked";?>> <i></i> Pelo Largo </label>
                                        </div>
                                    </div>                                             
                                </div> 

                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Examenes de Trabajo</label>
                                    <div class="col-sm-6">
                                        <div class="i-checks">
                                            <label><input type="checkbox" value="SI" name="cabda" <?php if($ejemplar->cabda=='SI') echo "checked";?>> <i></i> Cabda </label>&nbsp;&nbsp;
                                            <label><input type="checkbox" value="SI" name="bh" <?php if($ejemplar->bh=='SI') echo "checked";?>> <i></i> BH </label>&nbsp;&nbsp; 
                                            <label><input type="radio" value="" name="igp" <?php if($ejemplar->igp=='') echo "checked";?>> <i></i> Sin IGP </label>&nbsp;&nbsp;
                                            <label><input type="radio" value="IGP1" name="igp" <?php if($ejemplar->igp=='IGP1') echo "checked";?>> <i></i> IGP1 </label>&nbsp;&nbsp;
                                            <label><input type="radio" value="IGP2" name="igp" <?php if($ejemplar->igp=='IGP2') echo "checked";?>> <i></i> IGP2 </label>&nbsp;&nbsp;
                                            <label><input type="radio" value="IGP3" name="igp" <?php if($ejemplar->igp=='IGP3') echo "checked";?>> <i></i> IGP3 </label>
                                        </div>
                                    </div>

                                    <label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Seleccionado </label>
                                    <div class="col-sm-2">
                                        <div class="i-checks">
                                            <input type="radio" value="NO" name="seleccion" <?php if($ejemplar->seleccion=='NO') echo "checked";?>> <i></i> NO </label>&nbsp;&nbsp;
                                            <input type="radio" value="SI" name="seleccion" <?php if($ejemplar->seleccion=='SI') echo "checked";?>> <i></i> Si </label>
                                        </div>
                                    </div> 
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Nacionalidad (*)</label>
                                    <div class="col-md-4">
                                        <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="idpais"> 
                                            <option value="0" >SELECCIONA PAIS...</option>
                                                <?php foreach($paises as $pais):?>
                                                    <option value="<?php echo $pais->idpais ?>" 
                                                        <?php if($ejemplar->idpais==$pais->idpais) echo "selected"; ?>>
                                                        <?php echo htmlspecialchars($pais->nombrepais) ?>
                                                    </option>
                                                <?php endforeach;?>
                                        </select>
                                    </div>
                                </div> 

                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Nombre del Criador</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="criador" value="<?php echo htmlspecialchars($ejemplar->criador) ?>">
                                    </div>

                                    <label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Nombre del Propietario</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="propietario" value="<?php echo htmlspecialchars($ejemplar->propietario) ?>" required>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Foto del Pedigree </label>
                                    <div class="col-md-10">
                                        <input type="file" name="picture" value="<?php echo $ejemplar->picture; ?>" >
                                        <?php if($ejemplar->picture!=""):?>
                                        <br> <br>
                                            <img class="img-thumbnail" src="<?php echo $ejemplar->picture;?>" width="400"> 
                                        <?php endif;?>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label font-bold"></label>
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <input name="id" type="hidden" class="form-control" value="<?php echo $ejemplar->idejemplar ?>">
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