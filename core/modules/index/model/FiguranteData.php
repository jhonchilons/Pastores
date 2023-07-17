<?php

class FiguranteData {

	public static $tablename = "figurantes";

	public function __construct(){ 
        $this->idfigurante 	= "";
		$this->nombrefig 	= "";
		$this->dni 	        = "";
		$this->correo 	    = "";
		$this->idciudad		= "";
		$this->titulo       = "";
		$this->estado 		= "";
		$this->picture 		= "";
	}

	public function add(){

		$sql = "insert into ".self::$tablename." (

			nombrefig,
			dni,
			fechanac,
			correo,
			idciudad,
			titulo,
			estado,
			picture

		) ";
		$sql .= "value (

			\"$this->nombrefig\",
			\"$this->dni\",
			\"$this->fechanac\",
			\"$this->correo\",
			\"$this->idciudad\",
			\"$this->titulo\",
			\"$this->estado\",
			\"$this->picture\"
			)";

		Executor::doit($sql);

	}

	/* add para la foto */

	public function add_with_image(){

		$sql = "insert into ".self::$tablename." (
			nombrefig,
			dni,
			fechanac,
			correo,
			idciudad,
			titulo,
			estado,
			picture
		) ";
	
		$sql .= "value (
			\"$this->nombrefig\",
			\"$this->dni\",
			\"$this->fechanac\",
			\"$this->correo\",
			\"$this->idciudad\",
			\"$this->titulo\",
			\"$this->estado\",
			\"$this->picture\"
		)";
	
		Executor::doit($sql);
	}
	
	/* fin */
	
	public static function delById($id){
		$sql = "delete from ".self::$tablename." where idfigurante=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where idfigurante=$this->idfigurante";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." 
		set  
		nombrefig  = \"$this->nombrefig\",
		dni         = \"$this->dni\",
		fechanac    = \"$this->fechanac\",
		correo      = \"$this->correo\",
		idciudad   	= \"$this->idciudad\",
		titulo      = \"$this->titulo\",
		estado	   	= \"$this->estado\",
		picture   	= \"$this->picture\"

		where idfigurante= $this->idfigurante";
		Executor::doit($sql);
	}
	/* update para la foto */ 

	public function update_image(){
		$sql = "update ".self::$tablename." set picture=\"$this->picture\" where idfigurante=$this->idfigurante";
		Executor::doit($sql);
	}

	/* fin */

	public static function getById($id){

		$sql = "select * from ".self::$tablename." where idfigurante=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new FiguranteData();
		
		while($r = $query[0]->fetch_array()){

			$data->idfigurante  = $r['idfigurante'];
			$data->nombrefig    = $r['nombrefig'];
			$data->dni	        = $r['dni'];
			$data->fechanac     = $r['fechanac'];
			$data->correo  	    = $r['correo'];
			$data->idciudad	  	= $r['idciudad'];
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
			$array[$cnt] = new FiguranteData(); 
			
			$array[$cnt]->idfigurante  	= $r['idfigurante'];
			$array[$cnt]->nombrefig 	= $r['nombrefig'];
			$array[$cnt]->dni           = $r['dni'];
			$array[$cnt]->fechanac      = $r['fechanac'];
			$array[$cnt]->correo	    = $r['correo'];
			$array[$cnt]->idciudad	 	= $r['idciudad'];
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
			$array[$cnt] = new FiguranteData(); 

			$array[$cnt]->idfigurante  	= $r['idfigurante'];
			$array[$cnt]->nombrefig 	= $r['nombrefig'];
			$array[$cnt]->dni           = $r['dni'];
			$array[$cnt]->fechanac      = $r['fechanac'];
			$array[$cnt]->correo	    = $r['correo'];
			$array[$cnt]->idciudad	 	= $r['idciudad'];
			$array[$cnt]->titulo        = $r['titulo'];	
			$array[$cnt]->estado    	= $r['estado'];
			$array[$cnt]->picture		= $r['picture'];

			$cnt++;
		}
		return $array;
	} 
 
}

?>