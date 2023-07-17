<?php

class UserData {

	public static $tablename = "user";

	public function __construct(){

		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->image = "";
		$this->password = "";
		$this->created_at = "NOW()";

	}

	public function add(){

		$sql = "insert into user (name,lastname,username,email,is_active,is_admin,password,created_at,is_publicist,is_townhall,is_management,is_charge,area_are) ";
		$sql .= "value (\"$this->name\",\"$this->lastname\",\"$this->username\",\"$this->email\",\"$this->is_active\",\"$this->is_admin\",\"$this->password\",$this->created_at,\"$this->is_publicist\",\"$this->is_townhall\",\"$this->is_management\",\"$this->is_charge\",\"$this->area_are\")";
		Executor::doit($sql);

	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}


// partiendo de que ya tenemos creado un objecto UserData previamente utilizamos el contexto

	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",email=\"$this->email\",username=\"$this->username\",lastname=\"$this->lastname\",is_active=\"$this->is_active\",is_admin=\"$this->is_admin\",is_publicist=\"$this->is_publicist\",is_townhall=\"$this->is_townhall\",is_management=\"$this->is_management\",is_charge=\"$this->is_charge\",area_are=\"$this->area_are\" where id=$this->id";
		Executor::doit($sql);

	}

	public function update_passwd(){
		$sql = "update ".self::$tablename." set password=\"$this->password\" where id=$this->id";
		Executor::doit($sql);

	}

	public static function getById($id){

		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new UserData();

		while($r = $query[0]->fetch_array()){

			$data->id = $r['id'];
			$data->name = $r['name'];
			$data->lastname = $r['lastname'];
			$data->username = $r['username'];
			$data->is_admin = $r['is_admin'];
			$data->is_active = $r['is_active'];
			$data->email = $r['email'];
			$data->password = $r['password'];
			$data->created_at = $r['created_at'];
			$data->is_publicist = $r['is_publicist'];
			$data->is_townhall = $r['is_townhall'];
			$data->is_management = $r['is_management'];
			$data->is_charge = $r['is_charge'];
			$data->area_are = $r['area_are'];
			$found = $data;

			break;
		}
		return $found;

	}



	public static function getByMail($mail){

		$sql = "select * from ".self::$tablename." where email=\"$mail\"";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;

		while($r = $query[0]->fetch_array()){

			$array[$cnt] = new UserData();
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->name = $r['name'];
			$array[$cnt]->lastname = $r['lastname'];
			$array[$cnt]->email = $r['email'];
			$array[$cnt]->password = $r['password'];
			$array[$cnt]->created_at = $r['created_at'];
			$cnt++;

		}

		return $array;

	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;

		while($r = $query[0]->fetch_array()){

			$array[$cnt] = new UserData();

			$array[$cnt]->id = $r['id'];
			$array[$cnt]->name = $r['name'];
			$array[$cnt]->lastname = $r['lastname'];
			$array[$cnt]->email = $r['email'];
			$array[$cnt]->username = $r['username'];
			$array[$cnt]->is_active = $r['is_active'];
			$array[$cnt]->is_admin = $r['is_admin'];
			$array[$cnt]->password = $r['password'];
			$array[$cnt]->created_at = $r['created_at'];			
			$array[$cnt]->is_publicist = $r['is_publicist'];
			$array[$cnt]->is_townhall = $r['is_townhall'];
			$array[$cnt]->is_management = $r['is_management'];
			$array[$cnt]->is_charge = $r['is_charge'];
			$array[$cnt]->area_are = $r['area_are'];

			$cnt++;
		}

		return $array;

	}

	public static function getLike($q){

		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;

		while($r = $query[0]->fetch_array()){

			$array[$cnt] = new UserData();

			$array[$cnt]->id = $r['id'];
			$array[$cnt]->name = $r['name'];
			$array[$cnt]->mail = $r['mail'];
			$array[$cnt]->password = $r['password'];
			$array[$cnt]->created_at = $r['created_at'];

			$cnt++;
		}

		return $array;

	}

}

?>