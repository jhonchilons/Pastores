<?php

class ExposicionesData {

	public static $tablename = "exposiciones";

	public function __construct(){ 
		$this->nroexpo 		= "";
		$this->fechaexpo 	= "";
		$this->idciudad 	= "";
		$this->lugar 		= "";
		$this->tipoexposicion = "";
		$this->picture 		= "";
		$this->idjuez 		= "";
		$this->ayudante		= "";
		$this->organiza 	= "";
		$this->estado 		= "";
		$this->idfig1	 	= "";
		$this->idfig2 		= "";


	}

	public function add(){

		$sql = "insert into ".self::$tablename." (

			nroexpo,
			fechaexpo,
			idciudad,
			lugar,
			tipoexposicion,
			idjuez,
			ayudante,
			organiza,
			estado,
			idfig1,
			idfig2

		) ";
		$sql .= "value (

			\"$this->nroexpo\",
			\"$this->fechaexpo\",
			\"$this->idciudad\",
			\"$this->lugar\",
			\"$this->tipoexposicion\",
			\"$this->idjuez\",
			\"$this->ayudante\",
			\"$this->organiza\",
			\"$this->estado\",
			\"$this->idfig1\",
			\"$this->idfig2\"
			)";

		Executor::doit($sql);

	}

	/* add para la foto */

	public function add_with_image(){

		$sql = "insert into ".self::$tablename." (
			nroexpo,
			fechaexpo,
			idciudad,
			lugar,
			tipoexposicion,
			picture,
			idjuez,
			ayudante,
			organiza,
			estado,
			idfig1,
			idfig2
		) ";
	
		$sql .= "value (
			\"$this->nroexpo\",
			\"$this->fechaexpo\",
			\"$this->idciudad\",
			\"$this->lugar\",
			\"$this->tipoexposicion\",
			\"$this->picture\",
			\"$this->idjuez\",
			\"$this->ayudante\",
			\"$this->organiza\",
			\"$this->estado\",
			\"$this->idfig1\",
			\"$this->idfig2\"
		)";
	
		Executor::doit($sql);
	}
	
	/* fin */
	
	public static function delById($id){
		$sql = "delete from ".self::$tablename." where idexposicion=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where idexposicion=$this->idexposicion";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." 
		set  
		nroexpo  	= \"$this->nroexpo\",
		fechaexpo   = \"$this->fechaexpo\",
		idciudad    = \"$this->idciudad\",
		lugar	   	= \"$this->lugar\",
		tipoexposicion = \"$this->tipoexposicion\",
		picture	   	= \"$this->picture\",
		idjuez	   	= \"$this->idjuez\",
		ayudante   	= \"$this->ayudante\",
		organiza   	= \"$this->organiza\",
		estado   	= \"$this->estado\",
		idfig1   	= \"$this->idfig1\",
		idfig2   	= \"$this->idfig2\"

		where idexposicion = $this->idexposicion";
		Executor::doit($sql);
	}
	/* update para la foto */ 

	public function update_image(){
		$sql = "update ".self::$tablename." set picture=\"$this->picture\" where idexposicion=$this->idexposicion";
		Executor::doit($sql);
	}

	/* fin */

	public static function getById($id){

		//$sql = "select * from ".self::$tablename." where idexposicion=$id";
		$sql = "select *, exposiciones.picture as picture, exposiciones.estado as estadoe from exposiciones
        JOIN jueces ON (exposiciones.idjuez = jueces.idjuez) where idexposicion=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new ExposicionesData();
		
		while($r = $query[0]->fetch_array()){

			$data->idexposicion	= $r['idexposicion'];
			$data->nroexpo 		= $r['nroexpo'];
			$data->fechaexpo	= $r['fechaexpo'];
			$data->idciudad  	= $r['idciudad'];
			$data->lugar	  	= $r['lugar'];
			$data->tipoexposicion = $r['tipoexposicion'];
			$data->picture 		= $r['picture'];
			$data->idjuez 		= $r['idjuez'];
			$data->ayudante		= $r['ayudante'];
			$data->organiza		= $r['organiza'];
			$data->estadoe		= $r['estadoe'];
			$data->nombrejuez	= $r['nombrejuez'];
			$data->idfig1		= $r['idfig1'];
			$data->idfig2		= $r['idfig2'];

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
			$array[$cnt] = new ExposicionesData(); 
			
			$array[$cnt]->nroexpo 	= $r['idexposicion'];
			$array[$cnt]->nroexpo 	= $r['nroexpo'];
			$array[$cnt]->fechaexpo = $r['fechaexpo'];
			$array[$cnt]->idciudad	= $r['idciudad'];
			$array[$cnt]->lugar	 	= $r['lugar'];
			$array[$cnt]->tipoexposicion = $r['tipoexposicion'];	
			$array[$cnt]->picture	= $r['picture'];
			$array[$cnt]->idjuez	= $r['idjuez'];
			$array[$cnt]->ayudante	= $r['ayudante'];
			$array[$cnt]->organiza	= $r['organiza'];
			$array[$cnt]->estado	= $r['estado'];
			$array[$cnt]->idfig1	= $r['idfig1'];
			$array[$cnt]->idfig2	= $r['idfig2'];

			$cnt++;
		}
		return $array;
	} 

	public static function getActivos(){
		$sql = "select * from exposiciones as e inner join ciudades as c on e.idciudad=c.idciudad  where estado='ACTIVO'";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;

		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ExposicionesData(); 

			$array[$cnt]->idexposicion 	= $r['idexposicion'];
			$array[$cnt]->nroexpo 	= $r['nroexpo'];
			$array[$cnt]->fechaexpo = $r['fechaexpo'];
			$array[$cnt]->idciudad	= $r['idciudad'];
			$array[$cnt]->lugar	 	= $r['lugar'];
			$array[$cnt]->tipoexposicion = $r['tipoexposicion'];	
			$array[$cnt]->picture	= $r['picture'];
			$array[$cnt]->idjuez	= $r['idjuez'];
			$array[$cnt]->ayudante	= $r['ayudante'];
			$array[$cnt]->organiza	= $r['organiza'];
			$array[$cnt]->ciudad	= $r['ciudad'];
			$array[$cnt]->idfig1	= $r['idfig1'];
			$array[$cnt]->idfig2	= $r['idfig2'];

			$cnt++;
		}
		return $array;
	} 
 
}

?>