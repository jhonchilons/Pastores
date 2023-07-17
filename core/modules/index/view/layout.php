<?php

if(!isset($_SESSION["user_id"])){
  if(isset($_GET["view"]) && $_GET["view"]!=""){
    Core::redir("./");
  }
}

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>:: SISTEMA DE EXPOSICIONES E INSCRIPCIONES APPPA - PERU::</title> 

    <link rel="shortcut icon" href="favicon.png" type="image/x-icon" />

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    
    <!-- Mainly scripts -->

    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script> 

    <!-- Custom and plugin javascript -->

    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script> 
  
    <!-- Clock picker - > horario inicio --> 
    <link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <!-- chosen -> seleccione trabajador --> 
    <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet"> 

    <!-- iCheck -->

    <script src="js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });

    </script>


    <!-- FooTable -->

    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <!--  bootgrid  -->

	<link href="jquery.bootgrid-1.3.1/jquery.bootgrid.css" rel="stylesheet" />
	<link href="jquery.bootgrid-1.3.1/jquery.bootgrid.min.css" rel="stylesheet" />
	<script src="jquery.bootgrid-1.3.1/jquery.bootgrid.fa.js"></script> 
	<script src="jquery.bootgrid-1.3.1/jquery.bootgrid.fa.min.js"></script>
	<script src="jquery.bootgrid-1.3.1/jquery.bootgrid.js"></script>
    <script src="jquery.bootgrid-1.3.1/jquery.bootgrid.min.js"></script> 

</head>

<body>

<?php 

    $u=null;

    if(isset($_SESSION["user_id"]) && $_SESSION["user_id"]!=""):
        $u = UserData::getById($_SESSION["user_id"]);
        if(isset($_GET["view"]))			
            $view = $_GET["view"];				
        else
        $view = "home";
        $activo = "class='active'";
        $icono  = "<i class='fa fa-caret-right'></i>";
?>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <img alt="image" class="rounded-circle" src="img/logop.jpg"/>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold">Usuario</span>
                            <span class="text-muted text-xs block"><?php echo $u->name ?> <b class="caret"></b></span>

                        </a>

                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="index.php?view=configuration"><i class="fa fa-fw fa-gear"></i> Configuraci&oacute;n</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fa fa-fw fa-power-off"></i> Salir</a></li> 
                        </ul>
                    </div>

                    <div class="logo-element">
                        APPPA
                    </div>
                </li>
 <?php 

    switch($view) {

        case "home":
            $menu = "Inicio";

        break;          

        case "socio":  
            case "newsocio":
            case "socios":
            $menu = "Socios";

        break;

        case "exposicionn":
            case "editexposicion":   
            case "newexposicion":    
            case "exposicion":
            $menu = "Exposiciones";

        break;

        case "inscripcion":

            case "newinscripcion":   
            case "exposicionact":  
            case "inscripcionv": 

            $menu = "Inscripciones";
            break;

        case "resultado":

            case "ingresoresulexpo":
            case "repexpoxejemplar": 

            $menu = "Resultados";
        break;            
    
        case "ejemplarr":

            case "ejemplar":   
            case "newejemplar":    
            $menu = "Ejemplares";

        break;          

        case "utilitarios":
            case "editusuario":
            case "newusuario": 
            case "newciudad": 
            case "newpais": 
            case "newjuez":
            case "newfigurante":                
            case "newcalificativo": 
            $menu = "Utilitarios"; 
        break;

        default:

            $menu = "";

    }						 

?>	<!-- MENU -->



<li <?php if($menu == "Inicio") echo 'class=special_link'; ?>>
	<a href="index.php?view=home"><i class="fa fa-desktop"></i> <span class="nav-label">Inicio</span></a>
</li>

<li <?php if($menu == "Socios") echo $activo; ?>>
	<a href="index.php?view=socios"><i class="fa fa-star"></i> <span class="nav-label">Socios</span></a>
    
    <ul class="nav nav-second-level">                        	   
	<li <?php if($view == "socio" || $view == "newsocio" || $view == "newsocio") echo $activo; ?>><a href="index.php?view=newsocio">
        <?php if($view == "socio" || $view == "newsocio" || $view == "newsocio") echo $icono; ?> Nuevo Socio</a></li>
                      	   
	<li <?php if($view == "socio" || $view == "socios" || $view == "socios") echo $activo; ?>><a href="index.php?view=socios">
        <?php if($view == "socio" || $view == "socios" || $view == "socios") echo $icono; ?> Listado Socios</a></li>
    </ul>

</li>

<li <?php if($menu == "Exposiciones") echo $activo; ?>>
	<a href="index.php?view=exposicion"><i class="fa fa-star"></i> <span class="nav-label">Exposiciones</span></a>
    
    <ul class="nav nav-second-level">                        	   
	<li <?php if($view == "exposicionn" || $view == "newexposicion" || $view == "newexposicion") echo $activo; ?>><a href="index.php?view=newexposicion">
        <?php if($view == "exposicionn" || $view == "newexposicion" || $view == "newexposicion") echo $icono; ?> Nueva Exposición</a></li>
                      	   
	<li <?php if($view == "exposicionn" || $view == "exposicion" || $view == "exposicion") echo $activo; ?>><a href="index.php?view=exposicion">
        <?php if($view == "exposicionn" || $view == "exposicion" || $view == "exposicion") echo $icono; ?> Listado Exposiciones</a></li>
    </ul>

</li>

<li <?php if($menu == "Inscripciones") echo $activo; ?>>
	<a href="index.php?view=inscripcion"><i class="fa fa-star"></i> <span class="nav-label">Inscripciones</span></a>
	
    <ul class="nav nav-second-level">                        	   
	<li <?php if($view == "inscripcion" || $view == "newinscripcion" || $view == "newinscripcion") echo $activo; ?>><a href="index.php?view=newinscripcion">
        <?php if($view == "inscripcion" || $view == "newinscripcion" || $view == "newinscripcion") echo $icono; ?> Nueva Inscripción</a></li>
                      	   
	<li <?php if($view == "inscripcion" || $view == "inscripcionv" || $view == "inscripcionv") echo $activo; ?>><a href="index.php?view=inscripcionv">
        <?php if($view == "inscripcion" || $view == "inscripcionv" || $view == "inscripcionv") echo $icono; ?> Listado General</a></li>

    <li <?php if($view == "inscripcion" || $view == "exposicionact" || $view == "exposicionact") echo $activo; ?>><a href="index.php?view=exposicionact">
        <?php if($view == "inscripcion" || $view == "exposicionact" || $view == "exposicionact") echo $icono; ?> Reporte por Expo</a></li>
        </ul> 
</li>

<li <?php if($menu == "Resultados") echo $activo; ?>>
	<a href="index.php?view=resultado"><i class="fa fa-star"></i> <span class="nav-label">Resultados</span></a>
    <ul class="nav nav-second-level">

    <li <?php if($view == "resultado" || $view == "ingresoresulexpo" || $view == "ingresoresulexpo") echo $activo; ?>><a href="index.php?view=ingresoresulexpo">
        <?php if($view == "resultado" || $view == "ingresoresulexpo" || $view == "ingresoresulexpo") echo $icono; ?> Ingreso Resultados</a></li>

    <li <?php if($view == "resultado" || $view == "repexpoxejemplar" || $view == "repexpoxejemplar") echo $activo; ?>><a href="index.php?view=repexpoxejemplar">
        <?php if($view == "resultado" || $view == "repexpoxejemplar" || $view == "repexpoxejemplar") echo $icono; ?> Expo x Ejemplar</a></li>
    </ul> 
</li>

<li <?php if($menu == "Ejemplares") echo $activo; ?>>
	<a href="index.php?view=ejemplar"><i class="fa fa-eyedropper"></i> <span class="nav-label">Ejemplares</span></a>

    <ul class="nav nav-second-level">                        	   
	<li <?php if($view == "ejemplarr" || $view == "newejemplar" || $view == "editejemplar") echo $activo; ?>><a href="index.php?view=newejemplar">
        <?php if($view == "ejemplarr" || $view == "newejemplar" || $view == "editejemplar") echo $icono; ?> Nuevo Ejemplar</a></li>

    <li <?php if($view == "ejemplarr" || $view == "ejemplar" || $view == "ejemplar") echo $activo; ?>><a href="index.php?view=ejemplar">
        <?php if($view == "ejemplarr" || $view == "ejemplar" || $view == "ejemplar") echo $icono; ?> Listado Ejemplares</a></li> 
    </ul> 
</li>

<li <?php if($menu == "Utilitarios") echo $activo; ?>>
<a href="#"><i class="fa fa-key"></i> <span class="nav-label">Utilitarios</span><span class="fa arrow"></span></a> 

	<ul class="nav nav-second-level">                        	   
	    <li <?php if($view == "utilitarios" || $view == "newusuario" || $view == "editusuario") echo $activo; ?>><a href="index.php?view=usuario">
            <?php if($view == "utilitarios" || $view == "newusuario" || $view == "editusuario") echo $icono; ?> Nuevo Usuario</a></li>

        <li <?php if($view == "utilitarios" || $view == "newciudad" || $view == "editciudad") echo $activo; ?>><a href="index.php?view=ciudades">
            <?php if($view == "utilitarios" || $view == "newciudad" || $view == "editciudad") echo $icono; ?> Nueva Ciudad</a></li>

        <li <?php if($view == "utilitarios" || $view == "newpais" || $view == "editpais") echo $activo; ?>><a href="index.php?view=paises">
            <?php if($view == "utilitarios" || $view == "newpais" || $view == "editpais") echo $icono; ?> Nuevo Pais</a></li>

        <li <?php if($view == "utilitarios" || $view == "newjuez" || $view == "editjuez") echo $activo; ?>><a href="index.php?view=jueces">
            <?php if($view == "utilitarios" || $view == "newjuez" || $view == "editjuez") echo $icono; ?> Nuevo Juez</a></li>

        <li <?php if($view == "utilitarios" || $view == "newfigurante" || $view == "editfigurante") echo $activo; ?>><a href="index.php?view=figurantes">
            <?php if($view == "utilitarios" || $view == "newfigurante" || $view == "editfigurante") echo $icono; ?> Nuevo Figurante</a></li>

        <li <?php if($view == "utilitarios" || $view == "newcalificativo" || $view == "editcalificativo") echo $activo; ?>><a href="index.php?view=calificativos">
            <?php if($view == "utilitarios" || $view == "newcalificativo" || $view == "editcalificativo") echo $icono; ?> Nuevo Calificativo</a></li>

    </ul> 

</li> 

<!-- FIN DE MENU -->

            </ul>
        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

            <!-- <form role="search" class="navbar-form-custom" action="search_results.html">

                <div class="form-group">

                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">

                </div>

            </form> -->

        </div>

            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Administrador de Contenidos Web</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-vcard-o"></i>  <span class="label label-warning">3</span>
                    </a>

                    <!-- <ul class="dropdown-menu dropdown-messages">

                        <li>

                            <div class="dropdown-messages-box">

                                <a class="dropdown-item float-left" href="profile.html">

                                    <img alt="image" class="rounded-circle" src="img/a1.jpg">

                                </a>

                                <div class="media-body">

                                    <small class="float-right">1h Dic</small>

                                    <strong>Ivan Avalos Espinoza</strong><br>

                                    Comisión de Servicios.<br>

                                    <small class="text-muted">Enviado: 30 Dic 10:58 am</small>

                                </div>

                            </div>

                        </li>

                        <li class="dropdown-divider"></li>

                        <li>

                            <div class="dropdown-messages-box">

                                <a class="dropdown-item float-left" href="profile.html">

                                    <img alt="image" class="rounded-circle" src="img/a4.jpg">

                                </a>

                                <div class="media-body">

                                    <small class="float-right">30min Dic</small>

                                    <strong>Neslson Chacha</strong><br>

                                    Comisión de Servicios.<br>

                                    <small class="text-muted">Enviado: 27 Dic 11:32 am</small>

                                </div>

                            </div>

                        </li>

                        <li class="dropdown-divider"></li>

                        <li>

                            <div class="dropdown-messages-box">

                                <a class="dropdown-item float-left" href="profile.html">

                                    <img alt="image" class="rounded-circle" src="img/a1.jpg">

                                </a>

                                <div class="media-body">

                                    <small class="float-right">2h Dic</small>

                                    <strong>Ivan Avalos Espinoza</strong><br>

                                    Comisión de Servicios.<br>

                                    <small class="text-muted">Enviado: 27 Dic 08:21 am</small>

                                </div>

                            </div>

                        </li>

                        <li class="dropdown-divider"></li>

                        <li>

                            <div class="text-center link-block">

                                <a href="" class="dropdown-item">

                                    <i class="fa fa-vcard-o"></i> <strong>Ver Todas las Justificaciones</strong>

                                </a>

                            </div>

                        </li>

                    </ul> -->

                </li>



                <li class="dropdown">

                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">

                        <i class="fa fa-bell"></i>  <span class="label label-primary">3</span>

                    </a>

                    <!-- <ul class="dropdown-menu dropdown-alerts">

                        <li>

                            <a href="" class="dropdown-item">

                                <div>

                                    <i class="fa fa-vcard-o fa-fw"></i> Tiene 3 Justificaciones

                                    <span class="float-right text-muted small">4 minutos dic</span>

                                </div>

                            </a>

                        </li>

                        <li class="dropdown-divider"></li>

                        <li>

                            <a href="profile.html" class="dropdown-item">

                                <div>

                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers

                                    <span class="float-right text-muted small">12 minutes ago</span>

                                </div>

                            </a>

                        </li>

                        <li class="dropdown-divider"></li>

                        <li>

                            <a href="grid_options.html" class="dropdown-item">

                                <div>

                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted

                                    <span class="float-right text-muted small">4 minutes ago</span>

                                </div>

                            </a>

                        </li>

                        <li class="dropdown-divider"></li>

                        <li>

                            <div class="text-center link-block">

                                <a href="" class="dropdown-item">

                                    <strong>Ver Todas las Alertas</strong>

                                    <i class="fa fa-angle-right"></i>

                                </a>

                            </div>

                        </li>

                    </ul> -->

                </li> 

                <li>

                    <a href="logout.php">

                        <i class="fa fa-sign-out"></i> Salir

                    </a>

                </li>

            </ul>



        </nav>

        </div> 

        <?php endif;?>



        <!-- CONTENIDO -->

        <?php 

		// carga la vista solicitada

			View::load("login");

		?>

        <!-- FIN DE CONTENIDO -->

        

        <?php 

		$u=null;

		if(isset($_SESSION["user_id"]) &&$_SESSION["user_id"]!=""): 

		?>

        <div class="footer">

            <div class="float-right">

            <strong>willjhon *</strong>

            </div>

            <div>

            <strong>CMS</strong> Sistema de Exposiciones del Pastor Alemán - APPPA &copy; <?php echo date("Y") ?>

            </div>

        </div> 

        <?php endif;?> 



        </div>

        </div> 

</body>



</html>

