<?php 

$GLOBALS["u"]= UserData::getById($_SESSION["user_id"]);

if($GLOBALS["u"]->is_admin > 0){
    
    $registro = InscripcionData::getByExpoEjem($_REQUEST['idExpo'], $_REQUEST['idEjem']);
    $registro->del($registro->idexposicion, $registro->idejemplar);

    //echo 'Registro => ' .print_r ($registro);

    Core::redir("./index.php?view=inscripcionv");
    ?>
    
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


