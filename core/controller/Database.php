<?php
class Database {
	public static $db;
	public static $con;
	function __construct(){
				$this->user="root";$this->pass="";$this->host="localhost";$this->ddbb="bdexposiciones";$this->port="3306";
			//$this->user="zuqyjbfi_adminbd";$this->pass="Katver+++";$this->host="localhost";$this->ddbb="zuqyjbfi_bdexposiciones";$this->port="3306"; 
	}
	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb,$this->port); 
		return $con;
	}
	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}	
}
?>

