<?php 

// autoload.php
// 08 Mayo del 2017
// esta funcion elimina el hecho de estar agregando los modelos manualmente 

function autoloader($modelname){

//unction   spl_autoload_register($modelname){

	if(Model::exists($modelname)){

		include Model::getFullPath($modelname);

	} 


	if(Form::exists($modelname)){

		include Form::getFullPath($modelname);

	}

}

spl_autoload_register('autoloader');

?>