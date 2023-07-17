<?php 

//echo "errrorororoorororo";

class CodeaDB{    

    //echo "22222";

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
    public function buscar(){
        $resultado = $this->conexion->query("
        select * from inscripciones as i inner join ejemplar as e on i.idejemplar=e.idejemplar where i.idexposicion = 1") or die($this->conexion->error);
        if($resultado)
            return $resultado->fetch_all(MYSQLI_ASSOC);
        return false;
    } 
}


if(isset($_POST['id'])):

    
    echo "111111";
	//require "conexion.php";
	$user=new CodeaDB();
	$u=$user->buscar();    
	$html=[];
	foreach ($u as $value)
		$html[] =   ["id"=>$value['idejemplar'] ,"nombre"=>$value['nombredog'] ];
	die(json_encode($html));
endif;
*/
?>