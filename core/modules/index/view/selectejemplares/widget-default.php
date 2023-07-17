<?php 


class CodeaDB{    
    private $host   ="localhost";
    private $usuario="root";
    private $clave  ="";
    private $db     ="bdexposiciones";
    public $conexion;
    public function __construct(){
        $this->conexion = new mysqli($this->host, $this->usuario, $this->clave,$this->db) or die("error");
        $this->conexion->set_charset("utf8");
    }
    //BUSCAR
    public function buscar($tabla, $condicion){
        $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion") or die($this->conexion->error);
        if($resultado)
            return $resultado->fetch_all(MYSQLI_ASSOC);
        return false;
    } 
}


if(isset($_POST['idexposicion'])):
	//require "conexion.php";
    //echo "111111";
	$user=new CodeaDB();
	$u=$user->buscar("vista_inscripciones","idexposicion=".$_POST['idexposicion']);    
	$html=[];
	foreach ($u as $value)
		$html[] =   ["idejemplar"=>$value['idejemplar'] ,"nombredog"=>$value['nombredog'] ];
	die(json_encode($html));
endif;

