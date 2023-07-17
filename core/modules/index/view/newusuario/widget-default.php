<?php

$GLOBALS["u"]= UserData::getById($_SESSION["user_id"]); 

if($GLOBALS["u"]->is_admin > 0){  

?>

<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-lg-10">

		<h2>Registro de Usuarios</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php?view=home"><i class="fa fa-desktop"></i> Inicio</a></li>
			<li class="breadcrumb-item"><a>Utilitarios</a></li>
			<li class="breadcrumb-item"><a href="index.php?view=usuario">Usuarios</a></li>
			<li class="breadcrumb-item active"><strong>Nuevo Usuario</strong></li>
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
                                <a href="index.php?view=usuario" data-toggle="tooltip" data-placement="top" title="Listar Usuarios"><i class="glyphicon glyphicon-th-list"></i></a>
								<a href="index.php?view=newusuario" data-toggle="tooltip" data-placement="top" title="Refrescar"><i class="glyphicon glyphicon-repeat"></i></a> 
								<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </div>

                        </div>

                        <div class="ibox-content">
                            <form  id="form" method="post" class="form-horizontal" action="index.php?view=addusuario"> 

                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Nombres (*)</label>
                                    <div class="col-md-6">
                                    <input required type="text" name="name" required class="form-control" id="name" placeholder="Nombres">
                                    </div>
                                </div>


                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Apellidos (*)</label>
                                    <div class="col-md-6">
                                    <input required type="text" name="lastname" required class="form-control" id="lastname" placeholder="Apellidos">
                                    </div>

                                </div>  


                                <div class="hr-line-dashed"></div> 
                                <div class="form-group row">
                                    <label for="inputEmail1" class="col-lg-2 control-label font-bold"><i class="fa fa-slack"></i> Email</label>
                                    <div class="col-md-6">
                                    <input required type="text" name="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                </div>  


								<div class="hr-line-dashed"></div>
								  <div class="form-group row"><label class="col-sm-2 control-label font-bold"><i class="fa fa-slack"></i> Usuario (*)</label>
								  <div class="col-sm-4"><input required type="text" class="form-control" name="username" required></div>
								</div>


                                <div class="hr-line-dashed"></div>
                                <div class="form-group row"><label class="col-sm-2 col-form-label font-bold"><i class="fa fa-slack"></i> Contrase&ntilde;a (*)</label>
                                    <div class="col-sm-4"><input type="password" class="form-control" name="password" required> 
                                    </div>
                                </div>  



                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">  

                                    <div class="col-sm-2">
                                        <div class="checkbox checkbox-danger"><input id="checkbox1" type="checkbox" checked="" name="is_active" value="1"><label for="checkbox1"><strong>Activo</strong></label></div> 
                                    </div>

                                    <div class="col-sm-2">                                         
                                        <div class="checkbox checkbox-success"><input id="checkbox2" type="checkbox" checked="" name="is_admin" value="1"><label for="checkbox2">Administrador</label></div>                                      
                                    </div>

                                    <div class="col-sm-2"> 
                                        <div class="checkbox checkbox-success"><input id="checkbox5" type="checkbox" checked="" name="is_management" value="1"><label for="checkbox5">Propietario</label></div> 
                                    </div> 

                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label font-bold"></label>
                                    <div class="col-sm-4 col-sm-offset-2"> 
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