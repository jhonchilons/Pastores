<?php
class StoriesData {
	public static $tablename = "stories";
	public static $tablename_p = "pages"; 

	public function __construct(){
		$this->page = "";
		$this->headline = "";
		$this->story_text = "";
		$this->tipo = ""; 
	} 

	public function getPages(){ return PaginaData::getById($this->pages_id);}

	public function add(){
		$sql = "insert into ".self::$tablename." (page,headline,story_text,tipo,published) ";
		$sql .= "value (\"$this->page\",\"$this->headline\",\"$this->story_text\",\"$this->tipo\",'NULL')";
		return Executor::doit($sql);
	}
	public function add_with_image(){
		$sql = "insert into ".self::$tablename." (page,picture,headline,story_text,tipo,published) ";
		$sql .= "value (\"$this->page\",\"$this->picture\",\"$this->headline\",\"$this->story_text\",\"$this->tipo\",'NULL')";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto StoriesData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set page=\"$this->page\",headline=\"$this->headline\",story_text=\"$this->story_text\",tipo=\"$this->tipo\" where id=$this->id";
		Executor::doit($sql);
	}

	public function del_stories(){
		$sql = "update ".self::$tablename." set stories=NULL where stories=\"$this->id\"";
		Executor::doit($sql);
	}

	public function update_image(){
		$sql = "update ".self::$tablename." set picture=\"$this->picture\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id='$id'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new StoriesData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." as s RIGHT JOIN ".self::$tablename_p." as p ON s.page = p.code where p.is_prensa = 1 and s.id > 0";		
		$query = Executor::doit($sql);
		return Model::many($query[0],new StoriesData());
	}

	public static function getAllByPage($start_from,$limit){
		$sql = "select * from ".self::$tablename." as s RIGHT JOIN ".self::$tablename_p." as p ON s.page = p.code where p.is_prensa = 1 and s.id > 0 and s.id >= $start_from limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new StoriesData());
	}

	public static function getLike($p){
		$sql = "select * from ".self::$tablename." where barcode like '%$p%' or name like '%$p%' or id like '%$p%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new StoriesData());
	}

	public static function getAllByUserId($user_id){
		$sql = "select * from ".self::$tablename." where user_id=$user_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new StoriesData());
	}

	public static function getAllByPaginaId($pagina_id){		
		$sql = "select * from ".self::$tablename." where page='$pagina_id'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new StoriesData());
	} 
	
	public function published(){ 
		$sql = "update ".self::$tablename." set published=$this->published where id=$this->id";
		Executor::doit($sql);
	}
	 
	public function unpublished(){
		$sql = "update ".self::$tablename." set published=\"$this->published\" where id=$this->id";
		Executor::doit($sql); 
	}  
}
?>