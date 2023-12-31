<?php 
// 08 de Marzo del 2017
// Module.php
// @brief tareas que se realizan con modulos.

class Module {
	public static $module;
	public static $view;
	public static $message;

	public static function setModule($module){
		self::$module = $module;
	}

	public static function loadLayout(){
		include "core/modules/".Module::$module."/view/layout.php";
	}

	// validacion del modulo
	public static function isValid(){
		$valid = false;
		$folder = "core/modules/".Module::$module;
		
			if(is_dir($folder)){
				$valid=true;

			}else { self::$message= "<b>404 NOT FOUND</b> Module <b>".Module::$module."</b> folder !! - <a href='http://evilnapsis.com/legobox/help/' target='_blank'>Help</a>"; }
		
	
		return $valid;
	}

	public static function Error(){
		echo self::$message;
		die();
	} 
} 
?>
