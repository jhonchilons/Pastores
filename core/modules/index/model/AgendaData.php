<?php
class AgendaData {
	public static $tablename = "agenda";

	public function __construct(){
		$this->age = "";
		$this->programmed = "";
		$this->time = "";
		$this->title = "";
		$this->venue = ""; 	
	} 

	public function add(){
		$sql = "insert into ".self::$tablename." (programmed,time,title,venue,published) ";
		$sql .= "value (\"$this->programmed\",\"$this->time\",\"$this->title\",\"$this->venue\",'NULL')";
		return Executor::doit($sql);
	} 

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where age=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where age=$this->age";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto AgendaData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set programmed=\"$this->programmed\",time=\"$this->time\",title=\"$this->title\",venue=\"$this->venue\" where age=$this->id";
		Executor::doit($sql);
	} 
	
	public static function getById($id){
		$sql = "select * from ".self::$tablename." where age='$id'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new AgendaData()); 
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new AgendaData());
	} 

	public static function getAllByPage($start_from,$limit){
		$sql = "select * from ".self::$tablename." where age>=$start_from limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AgendaData());
	}

	public static function getLike($p){
		$sql = "select * from ".self::$tablename." where barcode like '%$p%' or name like '%$p%' or id like '%$p%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AgendaData());
	}

	public static function getAllByUserId($user_id){
		$sql = "select * from ".self::$tablename." where user_id=$user_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AgendaData());
	}
	
	public function published(){ 
		$sql = "update ".self::$tablename." set published=$this->published where age=$this->id";
		Executor::doit($sql);
	}
	 
	public function unpublished(){
		$sql = "update ".self::$tablename." set published=\"$this->published\" where age=$this->id";
		Executor::doit($sql); 
	}
}

?>