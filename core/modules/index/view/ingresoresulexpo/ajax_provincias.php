<?php 

if(isset($_POST['idexposicion'])):
    require "conexion.php";
	$user=new CodeaDB();
	$u=$user->buscar("vista_inscripciones","idexposicion=".$_POST['idexposicion']);    
	$html=[];
	foreach ($u as $value)
		$html[] =   ["idejemplar"=>$value['idejemplar'] ,"nombredog"=>$value['nombredog'] ];
	die(json_encode($html));
endif;

