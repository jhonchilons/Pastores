<?php
		 
header('Content-type:application/xls');
header('Content-Disposition: attachment; filename=consolidado.xls');

include "../core/autoload.php";
include "../core/modules/index/model/TrabajadorData.php"; 
include "../core/modules/index/model/AsistenciaData.php"; 
include "../core/modules/index/model/AsistenciaJustificadaData.php"; 
include "../core/modules/index/model/MarcacionData.php"; 
include "../core/modules/index/model/DriverData.php"; 
 

if($_REQUEST["idtrabajador"]>0)
{
	$trab = TrabajadorData::getTrabajadorxIdtrabajador($_REQUEST["idtrabajador"]);
}
else
{
	$trab = TrabajadorData::getAllActivo(); 
}


$fecha1 = date("Y-m-d", strtotime($_REQUEST["desde"])); 
$fecha2 = date("Y-m-d", strtotime($_REQUEST["hasta"]));
   
echo '
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REPORTE</title>	
 
</head> 
<body>  
				 
<table>
<thead> 
</thead>
<tbody> 					
<tr> 
	<strong>REPORTE DE ASISTENCIAS</strong><br/>	
	<strong>Impreso:</strong> '. date("d/m/Y") .'
</tr>
</tbody>
</table> 
'; 

echo '
<table width="100%" border="1">
<thead>
<tr style="background:#F1F8E9">
<th>#</th>
<th>APELLIDOS Y NOMBRES</th>';

$f=0; 
for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d",strtotime($i."+ 1 days"))) {	
	echo '<th scope="col">'.date("d", strtotime($i)).'</th>';
}

echo '
</tr>
</thead>
<tbody>'; 

if( count($trab)==1 )
{  
	echo '<tr>
	<td>1</td>
	<td>'.$trab->ape_paterno.' '.$trab->ape_materno.' '.$trab->nombres.'</td>';

		$data_e = [];
		for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d",strtotime($i."+ 1 days")))
		{
			$fecha = date("Y-m-d", strtotime($i));

			echo '<td align="center">'; 

			$sql = "select * from asistencia where codigo_trabajador=$trab->dni and fecha='$fecha' ORDER BY fecha,marca_inicio ASC";

			$query = Executor::doit($sql); $array = array(); $array_asist = array(); $cnt = 0;
			while($r = $query[0]->fetch_array()){
				$array[$cnt] = new AsistenciaData();   
				
				$asist_justificada = AsistenciaJustificadaData::getByIdasistencia($r['idasistencia']);
					
				$array[$cnt] = $r['idasistencia'];

				if(count($asist_justificada)>0) 
						$array[$cnt]   = $r['idasistencia'];
				else    $array[$cnt]   = $r['condicion'];

				$cnt++;
			}
			if( isset($array['0']) && isset($array['1']) )
			{           
				if( $array['0']>0 )
				{
					$validado = MarcacionData::validaCondicion($array['0'],$array['1']);                                
					$color    = MarcacionData::validaColor_impresion($validado);
					echo "<span style=$color>$validado</span>"; 
				}
				else
				{
					if( $array['1']>0 )
					{
						$validado = MarcacionData::validaCondicion_final($array['0'],$array['1']);                                
						$color    = MarcacionData::validaColor_impresion($validado);
						echo "<span style=$color>$validado</span>"; 
					}
					else
					{
						$validado = MarcacionData::validaCondicion($array['0'],$array['1']);                                
						$color    = MarcacionData::validaColor_impresion($validado);

						echo "<span style=$color>$validado</span>"; 
					}
				}
			}  
			else
				echo "<span>-</span>"; 

			echo '</td>';
		}
	 
	echo '</tr>'; 
}
else
{ 
	$c=1;
	foreach($trab as $t)
	{ 
		echo '<tr>
		<td>'.$c++.'</td>
		<td>'.$t->ape_paterno.' '.$t->ape_materno.' '.$t->nombres.'</td>';

			$data_e = [];
			for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d",strtotime($i."+ 1 days")))
			{
				$fecha = date("Y-m-d", strtotime($i));
				echo '<td align="center">';
				$sql = "select * from asistencia where codigo_trabajador=$t->dni and fecha='$fecha' ORDER BY fecha,marca_inicio ASC";

				$query = Executor::doit($sql); $array = array(); $array_asist = array(); $cnt = 0;
				while($r = $query[0]->fetch_array()){
					$array[$cnt] = new AsistenciaData();
					$asist_justificada = AsistenciaJustificadaData::getByIdasistencia($r['idasistencia']);
					$array[$cnt] = $r['idasistencia'];
					if(count($asist_justificada)>0) 
							$array[$cnt]   = $r['idasistencia'];
					else    $array[$cnt]   = $r['condicion'];
					$cnt++;
				}
				if(isset($array['0']) && isset($array['1']))
				{           
					if( $array['0']>0 )
					{
						$validado = MarcacionData::validaCondicion($array['0'],$array['1']);                                
						$color    = MarcacionData::validaColor_impresion($validado);
						echo "<span style=$color>$validado</span>"; 
					}
					else
					{
						if( $array['1']>0 )
						{
							$validado = MarcacionData::validaCondicion_final($array['0'],$array['1']);                                
							$color    = MarcacionData::validaColor_impresion($validado);
							echo "<span style=$color>$validado</span>"; 
						}
						else
						{
							$validado = MarcacionData::validaCondicion($array['0'],$array['1']);                                
							$color    = MarcacionData::validaColor_impresion($validado);
							echo "<span style=$color>$validado</span>"; 
						}
					}
				}         
				else
					echo "<span>-</span>"; 

				echo '</td>';
			}
		
		echo '</tr>'; 
	}
} 


echo ' 
</tbody>
</table>
				
</body>
</html>'; 
?>