<?php
class ArchivoData {
	public static $tablename = "conv_archivo"; 

	public function __construct(){
		$this->idarchivo = "";
		$this->descripcion = "";
		$this->archive = "";
		$this->idplaza = ""; 
	} 
 
	public function add(){
		$sql = "insert into ".self::$tablename." (descripcion,idplaza) ";
		$sql .= "value (\"$this->descripcion\",\"$this->idplaza\")";
		return Executor::doit($sql);
	}
	public function add_with_archive(){
		$sql = "insert into ".self::$tablename." (descripcion,archive,idplaza) ";
		$sql .= "value (\"$this->descripcion\",\"$this->archive\",\"$this->idplaza\")";
		return Executor::doit($sql);
	}
	
	public function del(){
		$sql = "delete from ".self::$tablename." where idarchivo=$this->idarchivo";
		Executor::doit($sql);
	}
 
	public function update(){
		$sql = "update ".self::$tablename." set descripcion=\"$this->descripcion\",idplaza=\"$this->idplaza\" where idarchivo=$this->idarchivo";
		Executor::doit($sql);
	} 
	
	public function update_archive(){
		$sql = "update ".self::$tablename." set archive=\"$this->archive\" where idarchivo=$this->idarchivo";
		Executor::doit($sql);
	}

	// 
	public static function getAllIdplaza($idplaza){
		$sql = "select * from ".self::$tablename." where idplaza='$idplaza' order by idarchivo asc";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ArchivoData(); 
			$array[$cnt]->idarchivo = $r['idarchivo']; 
			$array[$cnt]->descripcion = $r['descripcion']; 
			$array[$cnt]->archive = $r['archive']; 
			$array[$cnt]->idplaza = $r['idplaza'];  
			$cnt++;
		}
		return $array;
	}	  

	public static function getById($idarchivo){
		$sql = "select * from ".self::$tablename." where idarchivo='$idarchivo'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ArchivoData());
	}
}
?>