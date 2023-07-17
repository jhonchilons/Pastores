<?php

class JuezData {

	public static $tablename = "jueces";

	public function __construct(){ 
        $this->idjuez    	= "";
		$this->nombrejuez 	= "";
		$this->dni 	        = "";
		$this->correo 	    = "";
		$this->idpais 		= "";
		$this->titulo       = "";
		$this->estado 		= "";
		$this->picture 		= "";
	}

	public function add(){

		$sql = "insert into ".self::$tablename." (

			nombrejuez,
			dni,
			fechanac,
			correo,
			idpais,
			titulo,
			estado,
			picture

		) ";
		$sql .= "value (

			\"$this->nombrejuez\",
			\"$this->dni\",
			\"$this->fechanac\",
			\"$this->correo\",
			\"$this->idpais\",
			\"$this->titulo\",
			\"$this->estado\",
			\"$this->picture\"
			)";

		Executor::doit($sql);

	}

	/* add para la foto */

	public function add_with_image(){

		$sql = "insert into ".self::$tablename." (
			nombrejuez,
			dni,
			fechanac,
			correo,
			idpais,
			titulo,
			estado,
			picture
		) ";
	
		$sql .= "value (
			\"$this->nombrejuez\",
			\"$this->dni\",
			\"$this->fechanac\",
			\"$this->correo\",
			\"$this->idpais\",
			\"$this->titulo\",
			\"$this->estado\",
			\"$this->picture\"
		)";
	
		Executor::doit($sql);
	}
	
	/* fin */
	
	public static function delById($id){
		$sql = "delete from ".self::$tablename." where idjuez=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where idjuez=$this->idjuez";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." 
		set  
		nombrejuez  = \"$this->nombrejuez\",
		dni         = \"$this->dni\",
		fechanac    = \"$this->fechanac\",
		correo      = \"$this->correo\",
		idpais	   	= \"$this->idpais\",
		titulo      = \"$this->titulo\",
		estado	   	= \"$this->estado\",
		picture   	= \"$this->picture\"

		where idjuez = $this->idjuez";
		Executor::doit($sql);
	}
	/* update para la foto */ 

	public function update_image(){
		$sql = "update ".self::$tablename." set picture=\"$this->picture\" where idjuez=$this->idjuez";
		Executor::doit($sql);
	}

	/* fin */

	public static function getById($id){

		$sql = "select * from ".self::$tablename." where idjuez=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new JuezData();
		
		while($r = $query[0]->fetch_array()){

			$data->idjuez	    = $r['idjuez'];
			$data->nombrejuez   = $r['nombrejuez'];
			$data->dni	        = $r['dni'];
			$data->fechanac     = $r['fechanac'];
			$data->correo  	    = $r['correo'];
			$data->idpais	  	= $r['idpais'];
			$data->titulo       = $r['titulo'];
			$data->estado 		= $r['estado'];
			$data->picture 		= $r['picture'];

			$found = $data;
			break;
		}
		return $found;
	} 

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;

		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new JuezData(); 
			
			$array[$cnt]->idjuez       	= $r['idjuez'];
			$array[$cnt]->nombrejuez 	= $r['nombrejuez'];
			$array[$cnt]->dni           = $r['dni'];
			$array[$cnt]->fechanac      = $r['fechanac'];
			$array[$cnt]->correo	    = $r['correo'];
			$array[$cnt]->idpais	 	= $r['idpais'];
			$array[$cnt]->titulo        = $r['titulo'];	
			$array[$cnt]->estado    	= $r['estado'];
			$array[$cnt]->picture		= $r['picture'];

			$cnt++;
		}
		return $array;
	} 

	public static function getActivos(){
		$sql = "select * from ".self::$tablename." where estado='ACTIVO'";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;

		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new JuezData(); 

			$array[$cnt]->idjuez    	= $r['idjuez'];
			$array[$cnt]->nombrejuez 	= $r['nombrejuez'];
			$array[$cnt]->dni           = $r['dni'];
			$array[$cnt]->fechanac      = $r['fechanac'];
			$array[$cnt]->correo	    = $r['correo'];
			$array[$cnt]->idpais	 	= $r['idpais'];
			$array[$cnt]->titulo        = $r['titulo'];	
			$array[$cnt]->estado    	= $r['estado'];
			$array[$cnt]->picture		= $r['picture'];

			$cnt++;
		}
		return $array;
	} 
 
}

?>