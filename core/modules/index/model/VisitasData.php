<?php
class VisitasData {
	public static $tablename = "visita";
	public static $tablename_p = "area";

	public function __construct(){
		$this->area = "";
		$this->fecha = "";
		$this->nombre = "";
		$this->dni = "";
		$this->institucion = "";
		$this->motivo = "";
		$this->nom_funcionario = "";
		$this->cargo = "";
		$this->hora_entrada = "";
		$this->hora_salida = "";
		$this->user_id = ""; 
	} 

	public function getPages(){ return AreaData::getById($this->area_id);}

	public function add(){
		$sql = "insert into ".self::$tablename." (area,fecha,nombre,dni,institucion,motivo,nom_funcionario,cargo,hora_entrada,hora_salida,user_id,published) ";
		$sql .= "value (\"$this->area\",\"$this->fecha\",\"$this->nombre\",\"$this->dni\",\"$this->institucion\",\"$this->motivo\",\"$this->nom_funcionario\",\"$this->cargo\",\"$this->hora_entrada\",\"$this->hora_salida\",\"$this->user_id\",'NULL')";
		return Executor::doit($sql);
	}
	
	public static function delById($id){
		$sql = "delete from ".self::$tablename." where area=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where idvisita=$this->idvisita";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto VisitasData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set area=\"$this->area\",fecha=\"$this->fecha\",nombre=\"$this->nombre\",dni=\"$this->dni\",institucion=\"$this->institucion\",motivo=\"$this->motivo\",nom_funcionario=\"$this->nom_funcionario\",cargo=\"$this->cargo\",hora_entrada=\"$this->hora_entrada\",hora_salida=\"$this->hora_salida\",user_id=\"$this->user_id\" where idvisita=\"$this->idvisita\""; 
		
		Executor::doit($sql);
	}

	public function del_visitas(){
		$sql = "update ".self::$tablename." set area=NULL where area=\"$this->id\"";
		Executor::doit($sql);
	} 

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where idvisita='$id'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new VisitasData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;		
		$query = Executor::doit($sql);
		return Model::many($query[0],new VisitasData());
	}
	
	public static function getAll_user($id){
		$sql = "select * from ".self::$tablename." where area = $id";		
		$query = Executor::doit($sql);
		return Model::many($query[0],new VisitasData());
	}


	public static function getAllByPage($start_from,$limit){
		$sql = "select * from ".self::$tablename." where idvisita >= $start_from limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new VisitasData());
	}
	public static function getAllByPage_user($id,$start_from,$limit){
		$sql = "select * from ".self::$tablename." where area = $id and idvisita >= $start_from limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new VisitasData());
	}

	public static function getLike($p){
		$sql = "select * from ".self::$tablename." where nombre like '%$p%' or institucion like '%$p%' or idvisita like '%$p%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new VisitasData());
	}

	public static function getAllByUserId($user_id){
		$sql = "select * from ".self::$tablename." where user_id=$user_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new VisitasData());
	}

	public static function getAllByPaginaId($pagina_id){		
		$sql = "select * from ".self::$tablename." where area='$pagina_id'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new VisitasData());
	} 
	
	public function published(){ 
		$sql = "update ".self::$tablename." set published=$this->published where idvisita=$this->idvisita";
		Executor::doit($sql);
	}
	 
	public function unpublished(){
		$sql = "update ".self::$tablename." set published=\"$this->published\" where idvisita=$this->idvisita";
		Executor::doit($sql); 
	}
}
?>