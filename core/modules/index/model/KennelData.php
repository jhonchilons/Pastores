<?php

class KennelData {

	public static $tablename = "kennel";

	public function __construct(){

		$this->idkennel = ""; 
		$this->kennel = ""; 
		$this->idpais = ""; 
	}

	public function add(){

		$sql = "insert into ".self::$tablename." (
			kennel,
			idpais
		) ";

		$sql .= "value (
			\"$this->kennel\",
			\"$this->idpais\"
			)";
		Executor::doit($sql);
	}


	public static function delById($id){
		$sql = "delete from ".self::$tablename." where idkennel=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where idkennel=$this->idkennel";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto UserData previamente utilizamos el contexto

	public function update(){
		$sql = "update ".self::$tablename." 
		set 
		kennel=\"$this->kennel\",
		idpais=\"$this->idpais\"
		where idkennel=$this->idkennel";

		Executor::doit($sql);
	}

	public static function getById($id){

		$sql = "select * from ".self::$tablename." where idkennel=$id";

		$query = Executor::doit($sql);
		$found = null;
		$data = new KennelData();

		while($r = $query[0]->fetch_array()){

			$data->idkennel = $r['idkennel'];
			$data->kennel = $r['kennel']; 
			$data->idpais = $r['idpais']; 

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

			$array[$cnt] = new KennelData();

			$array[$cnt]->idkennel = $r['idkennel'];
			$array[$cnt]->kennel = $r['kennel']; 
			$array[$cnt]->idpais = $r['idpais']; 
			$cnt++;
		}

		return $array;

	} 

}

?>