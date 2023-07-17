<?php
// 08 de Marzo del 2017
// Lb.php
// @lucido el objeto legobox
// estoy inspirado : 08/mar/2017 - 05:15pm - viendo la remontada del barca (6) psg (1) UCL
class Lb {

	public function __construct(){
		$this->get = new Get();
		$this->post = new Post();
		$this->request = new Request();
		$this->cookie = new Cookie();
		$this->session = new Session();
	}

	public function loadModule($module){
			if(!isset($_GET['module'])){
				Module::setModule($module);
				include "core/modules/".$module."/autoload.php";
				include "core/modules/".$module."/superboot.php";
				include "core/modules/".$module."/init.php";
			}else{
				Module::setModule($_GET['module']);
				if(Module::isValid()){
					include "core/modules/".$_GET['module']."/init.php";
				}else {
					Module::Error();
				}
			}

	}
}
?>