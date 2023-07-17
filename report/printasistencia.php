<?php
		 
require_once '../dompdf/dompdf_config.inc.php';

include "../core/autoload.php";
include "../core/modules/index/model/TrabajadorData.php"; 
include "../core/modules/index/model/AsistenciaData.php"; 
include "../core/modules/index/model/AsistenciaJustificadaData.php"; 
include "../core/modules/index/model/MarcacionData.php"; 
include "../core/modules/index/model/DriverData.php"; 
 

$trabajador = TrabajadorData::getTrabajadorxIdtrabajador($_REQUEST["idtrabajador"]);   
$asistencias = AsistenciaData::getAllxTrabajador($trabajador->dni,$_REQUEST["desde"],$_REQUEST["hasta"]);   
$nombres     = $trabajador->nombres;
$ape_paterno = $trabajador->ape_paterno;
$ape_materno = $trabajador->ape_materno; 
$dni         = $trabajador->dni; 
   
$html='
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REPORTE</title>	
	
	<style>
	* { font-family:verdana;
	font-size: 12px;}
	
	#mytable th,#mytable td{
	font:13px Arial, Helvetica, sans-serif;
	color:#333333;
	border:none;
	padding:15px 15px;
	border-bottom:1px solid #e1e1e1; 
	} 
	
	#mygrid th{
	line-height: 12px; 
	border-top:0px solid #e1e1e1;
    border-right:1px solid #e1e1e1;
    border-bottom:1px solid #e1e1e1;
    border-left:0px solid #e1e1e1; 
	padding:5px 0px 5px 10px;
	font-weight:normal;
	font:12px Monotype Corsiva; 
	}
	
	#mygrid td{
	font:10px Arial, Helvetica, sans-serif;
	color:#333333;
	border:none;
	padding:2px 2px;
	border-bottom:1px solid #e1e1e1; 
	}
	</style>

</head> 
<body>  
				 
<table>
<thead> 
</thead>
<tbody>
							
<tr>
<td width="45" align="left">
	<img src="../img/logo-mdc.png" width="50" heigth="48" /> 
</td> 
<td width="90" align="left"> 
	<strong>REPORTE DE ASISTENCIAS</strong><br/>	
	<address>
	<strong>Impresión</strong><br>  
	<strong><abbr title="Fecha de Impresión">Fecha:</abbr></strong> '. date("d/m/Y") .'
	</address>
</td> 

<td width="340" align="right">  
	<strong style="font-size: 10px;">'.$trabajador->adescripcion.'</strong><br/>
	<cite title="" style="font-size: 10px;">'.$trabajador->cdescripcion.'</cite><br/>
	'.$trabajador->nombres.' '.$trabajador->ape_paterno.' '.$trabajador->ape_materno.'<br/>
	<small style="font-size: 10px;">DNI: '.$trabajador->dni.'</small><br/> 

</td>
</tr>
							
</tbody>
</table>
<br>
 
<br>
';
                         	
                      	
$html.='
				 
<table width="100%" id="mygrid">
<thead>
<tr>
	<th scope="col">NRO</th>
	<th scope="col">FECHA</th>
	<th scope="col">ENTRADA</th>
	<th scope="col">SALIDA</th>
	<th scope="col">ESTADO</th>
	<th scope="col">TARDANZA</th> 
</tr>
</thead>
<tbody>';
  
$c=1; $j=0;

foreach($asistencias as $r){ 
  $fecha             = DriverData::conversorSegundosHoras($r->tardanza); $dt = new DateTime($fecha);  
  $condicion_entrada = MarcacionData::validaColor($r->entrada); 
  $condicion_salida  = MarcacionData::validaColor($r->salida); 
  $condicion         = MarcacionData::validaCondicionColor($r->entrada,$r->salida);     
  $asist_justificada = AsistenciaJustificadaData::getByIdasistencia($r->idasistencia); 

  if(count($asist_justificada)>0)
  { 
	$j++; 

	$html.='	
	<tr>
	<td width="10%"  align="center" style="padding-right: 10px;">'.$c++.'</td>
	<td width="15%"  align="center">'.$r->fecha.'</td>   
	<td width="44%"  align="center" colspan="2">JUSTIFICADO X '.$asist_justificada->nombre.'</td> 
	<td width="16%"  align="center">'.$asist_justificada->abreviatura.'</td>
	<td width="15%" align="center"></td>  
	</tr>';  
  }
  else
  {
	$html.='	
	<tr>
	<td width="10%"  align="center" style="padding-right: 10px;">'.$c++.'</td>
	<td width="15%"  align="center">'.$r->fecha.'</td>   
	<td width="22%"  align="center">'.$r->marca_inicio.'<span class='.$condicion_entrada.'> '.$r->entrada. '</span></td>
	<td width="22%"  align="center">'.$r->marca_fin.'<span class='.$condicion_salida.'> '.$r->salida. '</span></td> 
	<td width="16%"  align="center"><span class='.$condicion_salida.'> '.$r->condicion. '</span></td>
	<td width="15%" align="center">'.$dt->format('H:i:s').'</td>  
	</tr>';  

  }


}

$html.='   
		 
</tbody>
</table>
				
</body>
</html>';
 
$dompdf=new DOMPDF();
$dompdf->set_paper("A4","portrait"); 
$dompdf->load_html(utf8_decode($html)); 

set_time_limit(0);
ini_set("memory_limit", "2048M");
ini_set("max_execution_time", "3600");	

$dompdf->render();


$canvas = $dompdf->get_canvas();
$font = Font_Metrics::get_font("helvetica", "bold");
$canvas->page_text(36, 810, "Página: {PAGE_NUM} de {PAGE_COUNT}", $font, 6, array(0,0,0));

$dompdf->stream("$trabajador->dni.pdf");
?>