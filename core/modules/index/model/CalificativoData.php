<?php

class CalificativoData {

	public static $tablename = "calificativos";

	public function __construct(){

		$this->idcal = ""; 
		$this->calificativo = "";
        $this->estado = "";
	}


	public function add(){

		$sql = "insert into ".self::$tablename." (
			calificativo,
            estado
		) ";

		$sql .= "value (
			\"$this->calificativo\",
            \"$this->estado\"
			)";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where idcal=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where idcal=$this->idcal";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto UserData previamente utilizamos el contexto

	public function update(){
		$sql = "update ".self::$tablename." 
		set 
		calificativo=\"$this->calificativo\",
        estado=\"$this->estado\"
		where idcal=$this->idcal";

		Executor::doit($sql);
	}

	public static function getById($id){

		$sql = "select * from ".self::$tablename." where idcal=$id";

		$query = Executor::doit($sql);
		$found = null;
		$data = new CalificativoData();

		while($r = $query[0]->fetch_array()){

			$data->idcal        = $r['idcal'];
			$data->calificativo = $r['calificativo']; 
            $data->estado       = $r['estado']; 
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

			$array[$cnt] = new CalificativoData();
			$array[$cnt]->idcal 	    = $r['idcal'];
			$array[$cnt]->calificativo 	= $r['calificativo'];
            $array[$cnt]->estado 	    = $r['estado'];
			$cnt++;
		}

		return $array;

	} 

}

?>