<?php

$GLOBALS["u"]= UserData::getById($_SESSION["user_id"]);

if($GLOBALS["u"]->is_admin >= 0){

?>

<!-- INICIO TITULO  PARTE 1 -->

<div class="row wrapper border-bottom white-bg page-heading">

	<div class="col-lg-10">
		<h2>Registro de Jueces</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php?view=home"><i class="fa fa-desktop"></i> Inicio</a></li>
			<li  class="breadcrumb-item active"><strong>Jueces APPPA-COAPA-SV</strong></li>
		</ol>
    </div>

    <div class="col-lg-2">

    </div>

</div>


<!-- INICIO TITULO PARTE 2-->

<div class="wrapper wrapper-content animated fadeInRight">

<div class="row">

<div class="col-lg-12">

<div class="ibox float-e-margins">

	<div class="ibox-title">

		<h5><i class="fa fa-th-list"></i> Listado de registros</h5>

		<div class="ibox-tools tooltip-demo">

			<a href="index.php?view=newjuez" data-toggle="tooltip" data-placement="top" title="Nuevo Juez"><i class="glyphicon glyphicon-plus-sign"></i></a>
			<a href="index.php?view=jueces" data-toggle="tooltip" data-placement="top" title="Refrescar"><i class="glyphicon glyphicon-repeat"></i></a> 
			<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

		</div>

	</div>

	<div class="ibox-content"> 

	<div class="table-responsive">

		<!-- INICIO DE TABLA -->

		<table class="table table-striped table-bordered table-hover" id="dato_grid" cellspacing="0" data-toggle="bootgrid">
			<thead>
			<tr> 
				<th align="center" data-column-id="nombrejuez">Nombre Juez</th>
				<th align="center" data-column-id="dni">DNI/Cedula</th>
				<th align="center" data-column-id="correo">Correo</th>
				<th align="center" data-column-id="pais">Pais</th>
				<th align="center" data-column-id="titulo">Titulos</th>
				<th align="center" data-column-id="estado">Estado</th>
				
				<th data-column-id="commands" data-formatter="commands" data-sortable="true"></th>  

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

				url: "index.php?action=searchjueces",
				formatters: {
						"commands": function(column, row)
						{
							return "<button type=\"button\" class=\"btn btn-xs btn-warning command-edit\" data-row-id=\"" + row.idjuez + "\"><span class=\"glyphicon glyphicon-edit\"></span></button> " + 
								"<button data-toggle=\"modal\" data-target=\"#modal-form-delete\" type=\"button\" class=\"btn btn-xs btn-dark command-delete\" data-row-id=\"" + row.idjuez + "\"><span class=\"glyphicon glyphicon-trash\"></span></button> ";
						} 
					}

		   }).on("loaded.rs.jquery.bootgrid", function()

		{

			/* Executes after data is loaded and rendered */

			grid.find(".command-edit").on("click", function(e)
			{
				var conf = $(this).data("row-id");		 
				location.href="index.php?view=editjuez&id="+conf;

			}).end().find(".command-delete").on("click", function(e)
			{
				$($(this).attr("data-target")).modal("show");
				var id = $(this).data("row-id");
				document.getElementById('modal_delete_id').value = id;  
			});
		}); 
		});

		</script>

		<!-- FIN CONTENIDO DE TABLA -->

		

		<!-- Modal -->

		<div class="modal inmodal" id="modal-form-delete" tabindex="-1" role="dialog" aria-hidden="true">

			<div class="modal-dialog">

				<form method="post" role="form" action="index.php?view=deljuez">

				<div class="modal-content animated flipInY">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Borrar Juez</h4>
						<small class="font-bold">Esta seguro que quiere eliminar el registro</small>
					</div>

					<div class="modal-body">
						<p><strong>¡Confirme!</strong> Si realmente desea eliminar el registro.</p>
					</div>

					<div class="modal-footer">
						<input type="hidden" name="id" id="modal_delete_id" class="form-control">
						<button type="submit" class="btn btn-white" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success">Aceptar</button>
					</div>

				</div>  

				</form>

			</div>

		</div>

	</div>

	</div> 

</div>
</div>
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