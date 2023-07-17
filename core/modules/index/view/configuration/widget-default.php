<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-lg-10">

		<h2>PEDIGREE Mapa de Sitio</h2>

		<ol class="breadcrumb">

			<li class="breadcrumb-item"><a href="index.php?view=home"><i class="fa fa-desktop"></i> Inicio</a></li>

			<li class="breadcrumb-item"><a>Utilitarios</a></li>

			<li class="breadcrumb-item active"><strong>Configuración</strong></li>

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

                            <h5><i class="fa fa-plus-circle"></i> Configuraci&oacute;n</h5>

                            <div class="ibox-tools">

								<a href="index.php?view=configuration"><i class="glyphicon glyphicon-repeat"></i></a> 

								<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                            </div>

                        </div>

                        <div class="ibox-content">

                        <div class="row">

                            <div class="col-sm-6 b-r">								

                                <form id="changepasswd" method="post" action="index.php?view=changepasswd" role="form">

                                    <div class="form-group"><label>Contrase&#241a actual</label>

                                    <input type="password" id="password" name="password" class="form-control">

                                    </div>

                                    <div class="form-group"><label>Nueva contrase&#241a</label>

                                    <input type="password" id="newpassword" name="newpassword" class="form-control">

                                    </div>

                                    <div class="form-group"><label>Confirmar nueva contrase&#241a</label> 

                                    <input type="password" id="confirmnewpassword" name="confirmnewpassword" class="form-control">

                                    </div>

                                    <div>

                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Guardar</strong></button>

                                    </div>

                                </form>

                            </div>

                            <div class="col-sm-6">

                                <p>&nbsp;</p>

                                <p class="text-center">

                                    <a href=""><i class="fa fa-sign-in big-icon"></i></a>

                                </p>

                            </div>

                        </div>

                    	</div>

                    </div>

                </div>

                <script>

					$("#changepasswd").submit(function(e){

						if($("#password").val()=="" || $("#newpassword").val()=="" || $("#confirmnewpassword").val()==""){

							e.preventDefault();

							alert("No debes dejar espacios vacios.");



						}else{

							if($("#newpassword").val() == $("#confirmnewpassword").val()){

					//			alert("Correcto");			

							}else{

								e.preventDefault();

								alert("Las nueva contraseña no coincide con la confirmacion.");

							}

						}

					});

				</script>

				

<!-- FIN INICIO TITULO PARTE 2-->  

</div>

</div>