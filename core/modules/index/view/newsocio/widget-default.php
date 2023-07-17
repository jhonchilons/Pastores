<?php

$GLOBALS["u"]= UserData::getById($_SESSION["user_id"]); 

if($GLOBALS["u"]->is_admin >= 0){ 
    $socios     = SocioData::getAll();
    $ciudades   = CiudadData::getAll();
    $paises     = PaisData::getAll();
?>

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>SOCIO APPPA</h2>

		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php?view=home"><i class="fa fa-desktop"></i> Inicio</a></li> 
			<li class="breadcrumb-item"><a href="index.php?view=figurantes">Socios</a></li>
			<li class="breadcrumb-item active"><strong>Nuevo Socio</strong></li>
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
                            
                            <form id="form" method="post" class="form-horizontal" action="index.php?view=addsocio" enctype="multipart/form-data"> 
                            
                            <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label for="nroexpo" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Apellidos del Nuevo Socio </label>
                                    <div class="col-md-4">
                                        <input  type="text" name="apellidos" required class="form-control" id="apellidos" placeholder="Apellidos" required onkeyup="mayus(this);">
                                    </div>                                   

                                    <label for="nroexpo" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Nombres del Nuevo Socio</label>
                                    <div class="col-md-4">
                                        <input  type="text" name="nombres" required class="form-control" id="nombres" placeholder="Nombres" required onkeyup="mayus(this);">
                                    </div>
                                </div>
                            
                            <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label for="fechaexpo" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Fecha de Nacimiento (*)</label>
                                    <div class="col-md-2">
                                        <input  type="date" name="fechanac" required class="form-control" id="fechanac" value="2023-04-01">
                                    </div>

                                    <label for="organiza" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Nro DNI/Cedula</label>
                                    <div class="col-md-2">
                                        <input  type="text" name="dni" required class="form-control" id="dni" placeholder="Ingrese DNI/Cedula">
                                    </div>

                                    <label for="lugar" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Nacionalidad (*)</label>
                                        <div class="col-md-2">
                                                <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="idpais"> 
                                                    <option value="0" >SELECCIONE PAIS...</option>
                                                    <?php foreach($paises as $pais):?>
                                                        <option value="<?php echo $pais->idpais ?>" >
                                                        <?php echo htmlspecialchars($pais->nombrepais) ?></option>
                                                    <?php endforeach;?>
                                                </select>
                                        </div>
                                </div> 

                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                        <label for="civil" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Estado Civil</label>
                                        <div class="col-md-4">
                                            <div class="i-checks">
                                                <label> <input type="radio" value="SOLTETO" name="estadocivil" checked>  SOLTERO </label>&nbsp; &nbsp; 
                                                <label> <input type="radio" value="CASADO" name="estadocivil">  CASADO </label>
                                            </div>
                                        </div>
                                        <label for="conyugue" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Conyugue</label>
                                        <div class="col-md-4">
                                            <input required type="text" name="titulo" class="form-control" id="titulo" placeholder="Nombre del Conyugue" onkeyup="mayus(this);">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group row">
                                        <label for="lugar" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Dirección</label>
                                        <div class="col-md-6">
                                            <input required type="text" name="titulo" required class="form-control" id="titulo" placeholder="Direccion en Perú" onkeyup="mayus(this);">
                                        </div>

                                        <label for="lugar" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Departamento (*)</label>
                                        <div class="col-md-2">
                                                <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="idciudad"> 
                                                    <option value="0" >SELECCIONE DEPART...</option>
                                                    <?php foreach($ciudades as $ciudad):?>
                                                        <option value="<?php echo $ciudad->idciudad ?>" >
                                                        <?php echo htmlspecialchars($ciudad->ciudad) ?></option>
                                                    <?php endforeach;?>
                                                </select>
                                        </div>
                                    </div> 

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group row">
                                        <label for="lugar" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Profesión</label>
                                        <div class="col-md-3">
                                            <input required type="text" name="profesion" required class="form-control" id="profesion" placeholder="Profesión" onkeyup="mayus(this);">
                                        </div>
                                        <label for="lugar" class="col-lg-1 control-label font-bold"><i class="fa fa-slack"></i> Cargo</label>
                                        <div class="col-md-2">
                                            <input required type="text" name="cargo" required class="form-control" id="cargo" placeholder="Cargo" onkeyup="mayus(this);">
                                        </div>
                                        <label for="lugar" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Lugar Trabajo</label>
                                        <div class="col-md-2">
                                            <input required type="text" name="lugartrabajo" required class="form-control" id="lugartrabajo" placeholder="Lugar de Trabajo" onkeyup="mayus(this);">
                                        </div>
                                    </div> 

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group row">
                                        <label for="lugar" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Instituciones o Clubes a las que pertenece</label>
                                        <div class="col-md-6">
                                            <input required type="text" name="clubes" class="form-control" id="clubes" placeholder="Socio en otras instituciones..." onkeyup="mayus(this);">
                                        </div>
                                    </div>                                     

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Estado de Socio</label>
                                        <div class="col-md-5">
                                            <div class="i-checks">
                                                <label> <input type="radio" value="ACTIVO" name="estadosocio" checked>  ACTIVO </label>&nbsp; &nbsp; 
                                                <label> <input type="radio" value="INACTIVO" name="estadosocio">  INACTIVO </label>
                                                <label> <input type="radio" value="RETIRADO" name="estadosocio">  RETIRADO </label>&nbsp; &nbsp; 
                                                <label> <input type="radio" value="SUSPENDIDO" name="estadosocio">  SUSPENDIDO </label>
                                            </div>
                                        </div>

                                        <label class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Tipo de Socio</label>
                                        <div class="col-md-3">
                                            <div class="i-checks">
                                                <label> <input type="radio" value="NORMAL" name="tiposocio" checked>  NORMAL </label>&nbsp; &nbsp; 
                                                <label> <input type="radio" value="VITALICIO" name="tiposocio">  VITALICIO </label>
                                            </div>
                                        </div>                                        
                                    </div> 

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group row">
                                        <label for="lugar" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Propuesto por Socio 1</label>
                                        <div class="col-md-3">
                                                <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="idsocio1"> 
                                                    <option value="0" >BUSCAR SOCIO...</option>
                                                    <?php foreach($socios as $socio):?>
                                                        <option value="<?php echo $socio->idsocio ?>" >
                                                        <?php echo htmlspecialchars($socio->apellidos." ".$socio->nombres) ?></option>
                                                    <?php endforeach;?>
                                                </select>
                                        </div>

                                        <label for="lugar" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Propuesto por Socio 2</label>
                                        <div class="col-md-3">
                                                <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="idsocio2"> 
                                                    <option value="0" >BUSCAR SOCIO...</option>
                                                    <?php foreach($socios as $socio):?>
                                                        <option value="<?php echo $socio->idsocio ?>" >
                                                        <?php echo htmlspecialchars($socio->apellidos." ".$socio->nombres) ?></option>
                                                    <?php endforeach;?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fechaexpo" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Fecha de Ingreso </label>
                                            <div class="col-md-3">
                                                <input  type="date" name="fechaingreso" required class="form-control" id="fechaingreso" value="2023-04-01">
                                            </div>

                                            <label for="organiza" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Nro Socio</label>
                                            <div class="col-md-3">
                                                <input  type="text" name="nrosocio" required class="form-control" id="nrosocio" placeholder="Nro Socio Asignado">
                                            </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="fechaexpo" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Correo Electronico </label>
                                            <div class="col-md-3">
                                            <input  type="email" name="correo" required class="form-control" id="correo" placeholder="Email">
                                            </div>

                                            <label for="organiza" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Nro Celular</label>
                                            <div class="col-md-3">
                                                <input  type="text" name="nrocelular" required class="form-control" id="nrocelular" placeholder="Nro Celular">
                                            </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Foto Socio (*)</label>
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