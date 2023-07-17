<?php

class PaisData {

	public static $tablename = "paises";

	public function __construct(){

		$this->idpais = ""; 
		$this->nombrepais = ""; 

	}

	public function add(){

		$sql = "insert into ".self::$tablename." (
			nombrepais
		) ";

		$sql .= "value (
			\"$this->nombrepais\"
			)";
		Executor::doit($sql);
	}


	public static function delById($id){
		$sql = "delete from ".self::$tablename." where idpais=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where idpais=$this->idpais";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto UserData previamente utilizamos el contexto

	public function update(){
		$sql = "update ".self::$tablename." 
		set 
		nombrepais=\"$this->nombrepais\"
		where idpais=$this->idpais";

		Executor::doit($sql);
	}

	public static function getById($id){

		$sql = "select * from ".self::$tablename." where idpais=$id";

		$query = Executor::doit($sql);
		$found = null;
		$data = new PaisData();

		while($r = $query[0]->fetch_array()){

			$data->idpais = $r['idpais'];
			$data->nombrepais = $r['nombrepais']; 

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

			$array[$cnt] = new PaisData();
			$array[$cnt]->idpais = $r['idpais'];
			$array[$cnt]->nombrepais = $r['nombrepais']; 

			$cnt++;
		}
		return $array;
	} 
}

?>