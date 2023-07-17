<?php

$GLOBALS["u"]= UserData::getById($_SESSION["user_id"]); 
include "conexion.php";
$user = new CodeaDB();

if($GLOBALS["u"]->is_admin > 0){ 
    $inscripciones   = InscripcionData::getAll();
    $ejemplares      = EjemplarData::getAll();
    $exposiciones    = ExposicionesData::getActivos();
    $calificativos   = CalificativoData::getAll();

   //$fechaActual = date('d-m-Y');
?>

<div class="row wrapper border-bottom blue-bg page-heading">
	<div class="col-lg-10">
		<h2>Inscripciones de Ejemplares en las Exposciones</h2>
		<ol class="breadcrumb blue-bg">
			<li class="breadcrumb-item"><a href="index.php?view=home"><i class="fa fa-desktop"></i> Inicio</a></li>  
			<li class="breadcrumb-item"><a href="index.php?view=inscripcion">Inscripción</a></li>
			<li class="breadcrumb-item active"><strong>Nuevo Registro de Inscripción</strong></li> 
		</ol>
    </div>
</div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <!-- FIN INICIO TITULO PARTE 1-->
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><i class="fa fa-plus-circle"></i> Registro de Inscripciones</h5>
                    </div>

                    <div class="table-responsive">

                        <!-- INICIO DE TABLA -->
                        <label class="col-lg-4 control-label font-bold"> Lista de Exposiciones Activas</label>
                        <table class="table table-striped table-bordered table-hover" id="dato_grid" cellspacing="0" data-toggle="bootgrid">
                            <thead>
                                <tr> 
                                    <th align="center" data-column-id="fechaexpo">Fecha Expo</th>
                                    <th align="center" data-column-id="nroexpo">Nro Expo</th>
                                    <th align="center" data-column-id="tipoexposicion">Exposición</th>
                                    <th align="center" data-column-id="organiza">Organiza</th>
                                    <th align="center" data-column-id="ciudad">Ciudad</th>
                                    <th align="center" data-column-id="juez">Nombre Juez</th> 

                                </tr>
                            </thead>
                        </table>  

                        <script type="text/javascript">
                            $( document ).ready(function() {
                                var grid = $("#dato_grid").bootgrid({
                                    ajax: true,
                                    rowSelect: true,
                                    post: function ()
                                    {
                                        /* To accumulate custom parameter with the request object */
                                        return {
                                            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
                                        };
                                    },		
                                    url: "index.php?action=searchexposiciones1",
                            })
                            });
                        </script>

                    </div>

                        <div class="ibox-content">
                            <form id="form" method="post" class="form-horizontal" action="index.php?view=updateinscripcion" enctype="multipart/form-data" >
                               
                                <div class="hr-line-dashed"></div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label font-bold"><i class="fa fa-slack"></i> Seleccionar Exposición</label> 
                                    <div class="col-sm-4">  
                                        <select name="exposiciones" id="exposiciones" class="form-control" data-placeholder="Buscar..."> 
                                            <option value="0" >Selecciona Exposciones</option>
                                            <?php $exposiciones1=$user->buscar("exposiciones","1");?>
                                            <?php foreach($exposiciones1 as $exposicion):?>
                                                <option value="<?php echo $exposicion['idexposicion'] ?>" >
                                                <?php echo htmlspecialchars($exposicion['nroexpo'].'-'.$exposicion['tipoexposicion'].'-'.$exposicion['idciudad']) ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="">EJEMPLARES</label>
                                        <select name="ejemplares" id="ejemplares" class="form-control"></select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="">DISTRITO</label>
                                        <select name="distritos" id="distritos" class="form-control"></select>
                                    </div>

                                    <!-- <label for="ejemplaresxexpo" class="col-sm-2 col-form-label font-bold"><i class="fa fa-search"></i> Buscar Ejemplar</label> 
                                    <div class="col-sm-4"> 
                                        <select data-placeholder="Buscar..." class="form-control"  tabindex="1" name="ejemplaresxexpo" id="ejemplaresxexpo"> 
                                        </select>
                                    </div> -->

                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-md-2 control-label font-bold"><i class="fa fa-slack"></i> Clasificación</label>
                                    <div class="col-md-1">
                                    <input required type="number" name="clasificacion" required class="form-control" id="clasificacion" placeholder="Puesto: 1,2,3" require minlength="0" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"type = "number"maxlength = "3"/>
                                    </div>

                                    <label class="col-sm-2 col-form-label font-bold"><i class="fa fa-slack"></i> Seleccionar Calificativo</label> 
                                    <div class="col-sm-2">  
                                        <select data-placeholder="Buscar..." class="chosen-select"  tabindex="1" name="idcal"> 
                                            <option value="0" >Selecciona Calificativo</option>
                                            <?php foreach($calificativos as $calificativo):?>
                                                <option value="<?php echo $calificativo->idcal ?>" >
                                                <?php echo htmlspecialchars($calificativo->calificativo) ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>

                                    <label for="inputEmail1" class="col-md-1 control-label font-bold"><i class="fa fa-slack"></i> Puntaje</label>
                                    <div class="col-md-2">
                                    <input required type="number" name="puntaje" required class="form-control" id="celular" placeholder="Ingrese Puntaje" require minlength="0" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"type = "number"maxlength = "3"/>
                                    </div>
                                </div> 

                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label font-bold"></label>
                                    <div class="col-sm-4 col-sm-offset-2"> 
                                        <button class="btn btn-primary btn-sm" type="submit"> Guardar Registro</button>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="hr-line-dashed"></div>
                                <div class="hr-line-dashed"></div>
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

<script>
    
    $("#exposiciones").change(function(){    	
        $.ajax({
            data:  "idexposicion="+$("#exposiciones").val(),
            url:   'ajax_provincias.php',
            type:  'post',
            dataType: 'json',
            beforeSend: function () {  },
            success:  function (response) {            
                var html = "";
                $.each(response, function(widget-defaul, value ) {
                    html+= '<option value="'+value.idejemplar+'">'+value.nombredog+"</option>";
                });     
                $("#ejemplares").html(html);
                $("#distritos").html("");
            },
            error:function(){
                alert("errorddd")
            }
        });
    })  
    $("#ejemplares").change(function(){    	
        $.ajax({
            data:  "idejemplar="+$("#ejemplares").val(),
            url:   'ajax_distritos.php',
            type:  'post',
            dataType: 'json',
            beforeSend: function () {  },
            success:  function (response) {            
                var html = "";
                $.each(response, function( index, value ) {
                    html+= '<option value="'+value.idejemplar+'">'+value.nombredog+"</option>";
                });  
                $("#distritos").html(html);
            },
            error:function(){
                alert("errorxxx")
            }
        });
    })

</script> 