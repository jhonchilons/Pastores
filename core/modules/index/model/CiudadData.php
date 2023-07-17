<?php

class CiudadData {

	public static $tablename = "ciudades";

	public function __construct(){

		$this->idciudad = ""; 
		$this->ciudad = "";
	}


	public function add(){

		$sql = "insert into ".self::$tablename." (
			ciudad
		) ";

		$sql .= "value (
			\"$this->ciudad\"
			)";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where idciudad=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where idciudad=$this->idciudad";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto UserData previamente utilizamos el contexto

	public function update(){
		$sql = "update ".self::$tablename." 
		set 
		ciudad=\"$this->ciudad\"
		where idciudad=$this->idciudad";

		Executor::doit($sql);
	}

	public static function getById($id){

		$sql = "select * from ".self::$tablename." where idciudad=$id";

		$query = Executor::doit($sql);
		$found = null;
		$data = new CiudadData();

		while($r = $query[0]->fetch_array()){

			$data->idciudad = $r['idciudad'];
			$data->ciudad = $r['ciudad']; 

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

			$array[$cnt] = new CiudadData();
			$array[$cnt]->idciudad 	= $r['idciudad'];
			$array[$cnt]->ciudad 	= $r['ciudad'];
			$cnt++;
		}

		return $array;

	} 

}

?>