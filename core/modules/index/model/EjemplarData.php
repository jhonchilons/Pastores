<?php

class EjemplarData {

	public static $tablename = "ejemplar";

	public function __construct(){ 
		$this->idejemplar = "";
		$this->nombredog = "";
		$this->sexo = "";
		$this->libro = "";
		$this->nroregistro = "";
		$this->fechanac = "";
		$this->padre = "";
		$this->madre = "";
		$this->codoeh = "";
		$this->caderahd = "";
		$this->tatuaje = "";
		$this->microchip = "";
		$this->dna = "";
		$this->picture = "";
		$this->bh = "";
		$this->cabda = "";
		$this->seleccion = "";
		$this->igp = "";
		$this->tipopelo = "";
		$this->iduser = "";
		$this->criador = "";
		$this->propietario = "";
		$this->idpais = "";
	}

	public function add(){

		$sql = "insert into ".self::$tablename." (

			nombredog,
			sexo,
			libro,
			nroregistro,
			fechanac,
			padre,
			madre,
			codoeh,
			caderahd,
			tatuaje,
			microchip,
			dna,
			bh,
			cabda,
			seleccion,
			igp,
			tipopelo,
			iduser,
			criador,
			propietario,
			idpais
		) ";
		$sql .= "value (  
			\"$this->nombredog\",
			\"$this->sexo\",
			\"$this->libro\",
			\"$this->nroregistro\",
			\"$this->fechanac\", 
			\"$this->padre\",
			\"$this->madre\",
			\"$this->codoeh\",
			\"$this->caderahd\",
			\"$this->tatuaje\",
			\"$this->microchip\",
			\"$this->dna\",
			\"$this->bh\",
			\"$this->cabda\",
			\"$this->seleccion\",
			\"$this->igp\",
			\"$this->tipopelo\",
			\"$this->iduser\",
			\"$this->criador\",
			\"$this->propietario\",
			\"$this->idpais\"
			)";

		Executor::doit($sql);

	}

	/* add para la foto */


	public function add_with_image(){

		$sql = "insert into ".self::$tablename." (
			nombredog,
			sexo,
			libro,
			nroregistro,
			fechanac,
			padre,
			madre,
			codoeh,
			caderahd,
			tatuaje,
			microchip,
			dna,
			picture,
			bh,
			cabda,
			seleccion,
			igp,
			tipopelo,
			iduser,
			criador,
			propietario,
			idpais
		) ";

		$sql .= "value (
			\"$this->nombredog\",
			\"$this->sexo\",
			\"$this->libro\",
			\"$this->nroregistro\",
			\"$this->fechanac\",
			\"$this->padre\",
			\"$this->madre\",
			\"$this->codoeh\",
			\"$this->caderahd\",
			\"$this->tatuaje\",
			\"$this->microchip\",
			\"$this->dna\",
			\"$this->picture\",
			\"$this->bh\",
			\"$this->cabda\",
			\"$this->seleccion\",
			\"$this->igp\",
			\"$this->tipopelo\",
			\"$this->iduser\",
			\"$this->criador\",
			\"$this->propietario\",
			\"$this->idpais\"
			)";

		Executor::doit($sql);

	}

	/* fin */

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where idejemplar=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where idejemplar=$this->idejemplar";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." 
		set  
		nombredog  = \"$this->nombredog\",
		sexo	   = \"$this->sexo\",
		libro	   = \"$this->libro\",		
		nroregistro= \"$this->nroregistro\",
		fechanac   = \"$this->fechanac\",
		padre	   = \"$this->padre\",
		madre      = \"$this->madre\",
		codoeh	   = \"$this->codoeh\",
		caderahd   = \"$this->caderahd\",
		tatuaje    = \"$this->tatuaje\",
		microchip  = \"$this->microchip\",
		dna		   = \"$this->dna\",
		bh	   	   = \"$this->bh\",
		cabda      = \"$this->cabda\",
		seleccion  = \"$this->seleccion\",
		igp  	   = \"$this->igp\",
		tipopelo   = \"$this->tipopelo\",
		iduser     = \"$this->iduser\",
		criador    = \"$this->criador\",
		propietario = \"$this->propietario\",
		idpais		= \"$this->idpais\"

		where idejemplar = $this->idejemplar";
		Executor::doit($sql);
	}

	/* update para la foto */ 

	public function update_image(){
		$sql = "update ".self::$tablename." set picture=\"$this->picture\" where idejemplar=$this->idejemplar";
		Executor::doit($sql);
	}

	/* fin */

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where idejemplar=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new EjemplarData();
		
		while($r = $query[0]->fetch_array()){

			$data->idejemplar = $r['idejemplar'];
			$data->nombredog  = $r['nombredog'];
			$data->sexo 	  = $r['sexo'];
			$data->libro	  = $r['libro'];
			$data->nroregistro= $r['nroregistro'];
			$data->fechanac   = $r['fechanac'];
			$data->padre 	  = $r['padre'];
			$data->madre 	  = $r['madre'];
			$data->codoeh     = $r['codoeh'];
			$data->caderahd   = $r['caderahd'];
			$data->tatuaje 	  = $r['tatuaje'];
			$data->microchip  = $r['microchip'];
			$data->dna 		  = $r['dna'];
			$data->picture	  = $r['picture']; 
			$data->bh         = $r['bh'];
			$data->cabda 	  = $r['cabda'];
			$data->seleccion  = $r['seleccion'];
			$data->igp 		  = $r['igp'];
			$data->tipopelo	  = $r['tipopelo'];
			$data->iduser	  = $r['iduser']; 
			$data->criador	  = $r['criador'];
			$data->propietario = $r['propietario'];
			$data->idpais	  = $r['idpais']; 

			$found = $data;
			break;
		}
		return $found;
	} 

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by nombredog asc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;

		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new EjemplarData(); 

			$array[$cnt]->idejemplar = $r['idejemplar'];
			$array[$cnt]->nombredog  = $r['nombredog'];
			$array[$cnt]->sexo 	     = $r['sexo'];
			$array[$cnt]->libro 	 = $r['libro'];
			$array[$cnt]->nroregistro= $r['nroregistro'];
			$array[$cnt]->fechanac   = $r['fechanac'];
			$array[$cnt]->padre 	 = $r['padre'];
			$array[$cnt]->madre      = $r['madre'];
			$array[$cnt]->codoeh	 = $r['codoeh'];
			$array[$cnt]->caderahd   = $r['caderahd'];
			$array[$cnt]->tatuaje 	 = $r['tatuaje'];
			$array[$cnt]->microchip  = $r['microchip'];
			$array[$cnt]->dna 		 = $r['dna'];
			$array[$cnt]->picture    = $r['picture'];	
			$array[$cnt]->bh         = $r['bh'];
			$array[$cnt]->cabda 	 = $r['cabda'];
			$array[$cnt]->seleccion  = $r['seleccion'];
			$array[$cnt]->igp 		 = $r['igp'];
			$array[$cnt]->tipopelo	 = $r['tipopelo'];
			$array[$cnt]->iduser	 = $r['iduser']; 
			$array[$cnt]->criador	 = $r['criador'];
			$array[$cnt]->propietario = $r['propietario'];
			$array[$cnt]->idpais	 = $r['idpais'];

			$cnt++;
		}
		return $array;
	} 

	public static function getAllMachos(){
		$sql = "select * from ".self::$tablename." where sexo = 'MACHO'";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;

		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new EjemplarData(); 

			$array[$cnt]->idejemplar = $r['idejemplar'];
			$array[$cnt]->nombredog  = $r['nombredog'];
			$array[$cnt]->sexo 	     = $r['sexo'];
			$array[$cnt]->libro 	 = $r['libro'];
			$array[$cnt]->nroregistro= $r['nroregistro'];
			$array[$cnt]->fechanac   = $r['fechanac'];
			$array[$cnt]->padre 	 = $r['padre'];
			$array[$cnt]->madre      = $r['madre'];
			$array[$cnt]->codoeh	 = $r['codoeh'];
			$array[$cnt]->caderahd   = $r['caderahd'];
			$array[$cnt]->tatuaje 	 = $r['tatuaje'];
			$array[$cnt]->microchip  = $r['microchip'];
			$array[$cnt]->dna 		 = $r['dna'];
			$array[$cnt]->picture    = $r['picture'];	
			$array[$cnt]->bh         = $r['bh'];
			$array[$cnt]->cabda 	 = $r['cabda'];
			$array[$cnt]->seleccion  = $r['seleccion'];
			$array[$cnt]->igp 		 = $r['igp'];
			$array[$cnt]->tipopelo	 = $r['tipopelo'];
			$array[$cnt]->iduser	 = $r['iduser']; 
			$array[$cnt]->criador	 = $r['criador']; 
			$array[$cnt]->propietario = $r['propietario']; 
			$array[$cnt]->idpais	 = $r['idpais'];

			$cnt++;
		}
		return $array;
	} 

	public static function getAllHembras(){
		$sql = "select * from ".self::$tablename." where sexo = 'HEMBRA'";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;

		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new EjemplarData(); 

			$array[$cnt]->idejemplar = $r['idejemplar'];
			$array[$cnt]->nombredog  = $r['nombredog'];
			$array[$cnt]->sexo 	     = $r['sexo'];
			$array[$cnt]->libro 	 = $r['libro'];
			$array[$cnt]->nroregistro= $r['nroregistro'];
			$array[$cnt]->fechanac   = $r['fechanac'];
			$array[$cnt]->padre 	 = $r['padre'];
			$array[$cnt]->madre      = $r['madre'];
			$array[$cnt]->codoeh	 = $r['codoeh'];
			$array[$cnt]->caderahd   = $r['caderahd'];
			$array[$cnt]->tatuaje 	 = $r['tatuaje'];
			$array[$cnt]->microchip  = $r['microchip'];
			$array[$cnt]->dna 		 = $r['dna'];
			$array[$cnt]->picture    = $r['picture'];	
			$array[$cnt]->bh         = $r['bh'];
			$array[$cnt]->cabda 	 = $r['cabda'];
			$array[$cnt]->seleccion  = $r['seleccion'];
			$array[$cnt]->igp 		 = $r['igp'];
			$array[$cnt]->tipopelo	 = $r['tipopelo'];
			$array[$cnt]->iduser	 = $r['iduser']; 
			$array[$cnt]->criador	 = $r['criador']; 
			$array[$cnt]->propietario = $r['propietario']; 
			$array[$cnt]->idpais	 = $r['idpais'];
			$cnt++;
		}
		return $array;
	} 
}

?>