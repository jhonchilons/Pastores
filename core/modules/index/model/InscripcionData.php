<?php

class InscripcionData {

	public static $tablename = "inscripciones";

	public static $view = "vista_inscripciones";

	public function __construct(){

		$this->idexposicion = ""; 
		$this->idejemplar = ""; 
		$this->iduser = "";
		$this->fechareg = "";
		$this->fotovoucher = "";
		$this->contacto = "";
		$this->correo = "";
		$this->celular = "";
		$this->tipoins = "";
	}

	public function add(){

		$sql = "insert into ".self::$tablename." (
			
			idexposicion,
			idejemplar,
			iduser,
			fechareg,
			contacto,
			correo,
			celular,
			tipoins

			) ";
			$sql .= "value (			

			\"$this->idexposicion\",
			\"$this->idejemplar\",
			\"$this->iduser\",
			\"$this->fechareg\",
			\"$this->contacto\",
			\"$this->correo\",
			\"$this->celular\",
			\"$this->tipoins\"
			)";			

		Executor::doit($sql);
	}

	/* add para la foto */

	public function add_with_image(){

		$sql = "insert into ".self::$tablename." (
			idexposicion,
			idejemplar,
			iduser,
			fechareg,
			fotovoucher,
			contacto,
			correo,
			celular,
			tipoins
		) ";
	
		$sql .= "value (
			\"$this->idexposicion\",
			\"$this->idejemplar\",
			\"$this->iduser\",
			\"$this->fechareg\",
			\"$this->fotovoucher\",
			\"$this->contacto\",
			\"$this->correo\",
			\"$this->celular\",
			\"$this->tipoins\"
		)";
		Executor::doit($sql);
	}

	/* fin */	

	public static function del($idExp, $idEjem){

		$sql = "delete from ".self::$tablename." where idexposicion=$idExp and idejemplar=$idEjem";
		Executor::doit($sql);

	}

/*	public function del($idexposicion){
		$sql = "delete from ".self::$tablename." where idexposicion=".self::$idexposicion." and idejemplar=".self::$idejemplar"";
		Executor::doit($sql);

	}*/


// partiendo de que ya tenemos creado un objecto UserData previamente utilizamos el contexto

	public function update(){

		$sql = "update ".self::$tablename." 

		set 
		idexposicion	=\"$this->idexposicion\",
		idejemplar		=\"$this->idejemplar\",
		iduser			=\"$this->iduser\",
		fechareg		=\"$this->fechareg\",
		contacto		=\"$this->contacto\",
		correo			=\"$this->correo\",
		celular			=\"$this->celular\",
		tipoins			=\"$this->tipoins\"

		where idexposicion=$this->idexposicion and idejemplar=$this->idejemplar";

		Executor::doit($sql);

	}

 	/* update para la foto */ 

	 public function update_image(){
		$sql = "update ".self::$tablename." set fotovoucher=\"$this->fotovoucher\" where idexposicion=$this->idexposicion and idejemplar=$this->idejemplar";
		Executor::doit($sql);
	}

	/* fin */

	public static function getByExpoEjem($idExp, $idEjem){

		$sql = "select * from ".self::$view." where idexposicion=$idExp and idejemplar=$idEjem";
		$query = Executor::doit($sql);
		$found = null;
		$data = new InscripcionData();

		while($r = $query[0]->fetch_array()){

			$data->idexposicion = $r['idexposicion'];
			$data->idejemplar 	= $r['idejemplar']; 
			$data->iduser 		= $r['iduser'];
			$data->fechareg 	= $r['fechareg']; 
			$data->fotovoucher 	= $r['fotovoucher'];
			$data->contacto 	= $r['contacto'];
			$data->correo 		= $r['correo']; 
			$data->celular 		= $r['celular'];
			$data->tipoins 		= $r['tipoins'];

			$found = $data;

			break;
		}

		return $found;

	} 

	public static function getByIncripcionExpo($id){

		$sql = "select * from inscripciones as i inner join ejemplar as e on i.idejemplar=e.idejemplar where i.idexposicion=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new InscripcionData();

		while($r = $query[0]->fetch_array()){
 
			$data->idejemplar 	= $r['idejemplar']; 
			$data->nombredog    = $r['nombredog']; 

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

			$array[$cnt] = new InscripcionData();

//			$array[$cnt]->idinscripcion	 = $r['idinscripcion'];
			$array[$cnt]->idexposicion	 = $r['idexposicion']; 
			$array[$cnt]->idejemplar	 = $r['idejemplar'];
			$array[$cnt]->iduser		 = $r['iduser'];
			$array[$cnt]->fechareg 		 = $r['fechareg']; 
			$array[$cnt]->fotovoucher 	 = $r['fotovoucher'];
			$array[$cnt]->contacto		 = $r['contacto'];
			$array[$cnt]->correo 		 = $r['correo']; 
			$array[$cnt]->celular 		 = $r['celular'];
			$array[$cnt]->tipoins 		 = $r['tipoins'];

			$cnt++;

		}

		return $array;

	} 

}

?>