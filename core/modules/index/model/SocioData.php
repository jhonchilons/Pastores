<?php

class SocioData {

	public static $tablename = "socios";

	public function __construct(){ 
        $this->idsocio   	= "";
		$this->apellidos 	= "";
        $this->nombres   	= "";
        $this->fechanac 	= "";
		$this->dni 	        = "";
        $this->direccion    = "";
        $this->idciudad   	= "";
        $this->idpais   	= "";
        $this->estadocivil 	= "";
        $this->conyugue 	= "";
        $this->profesion 	= "";
        $this->cargo     	= "";
		$this->lugartrabajo = "";
		$this->clubes 		= "";
        $this->estadosocio 	= "";
        $this->tiposocio 	= "";
        $this->idsocio1 	= "";
        $this->idsocio2 	= "";
        $this->fechaingreso	= "";
        $this->nrosocio 	= "";
        $this->correo 	    = "";
        $this->nrocelular 	= "";
		$this->picture 		= "";
	}

	public function add(){

		$sql = "insert into ".self::$tablename." (

			apellidos,
            nombres,
            fechanac,
			dni,
            direccion,
			idciudad,
			idpais,
            estadocivil,
            conyugue,
            profesion,
            cargo,
            lugartrabajo,
            clubes,
			estadosocio,
            tiposocio,
			idsocio1,
            idsocio2,
            fechaingreso,
            nrosocio,
            correo,
            nrocelular,
			picture

		) ";
		$sql .= "value (

			\"$this->apellidos\",
            \"$this->nombres\",
            \"$this->fechanac\",
			\"$this->dni\",
            \"$this->cireccion\",
            \"$this->idciudad\",
			\"$this->idpais\",
            \"$this->estadocivil\",
            \"$this->conyugue\",
			\"$this->profesion\",
            \"$this->cargo\",
            \"$this->lugartrabajo\",
            \"$this->clubes\",
			\"$this->estadosocio\",
            \"$this->tiposocio\",
            \"$this->idsocio1\",
            \"$this->idsocio2\",
            \"$this->fechaingreso\",
			\"$this->nrosocio\",
            \"$this->correo\",
            \"$this->nrocelular\",
            \"$this->picture\"
			)";

		Executor::doit($sql);

	}

	/* add para la foto */

	public function add_with_image(){

		$sql = "insert into ".self::$tablename." (

			apellidos,
            nombres,
            fechanac,
			dni,
            direccion,
			idciudad,
			idpais,
            estadocivil,
            conyugue,
            profesion,
            cargo,
            lugartrabajo,
            clubes,
			estadosocio,
            tiposocio,
			idsocio1,
            idsocio2,
            fechaingreso,
            nrosocio,
            correo,
            nrocelular,
			picture
		) ";
	
		$sql .= "value (
			\"$this->apellidos\",
            \"$this->nombres\",
            \"$this->fechanac\",
			\"$this->dni\",
            \"$this->cireccion\",
            \"$this->idciudad\",
			\"$this->idpais\",
            \"$this->estadocivil\",
            \"$this->conyugue\",
			\"$this->profesion\",
            \"$this->cargo\",
            \"$this->lugartrabajo\",
            \"$this->clubes\",
			\"$this->estadosocio\",
            \"$this->tiposocio\",
            \"$this->idsocio1\",
            \"$this->idsocio2\",
            \"$this->fechaingreso\",
			\"$this->nrosocio\",
            \"$this->correo\",
            \"$this->nrocelular\",
            \"$this->picture\"
		)";
	
		Executor::doit($sql);
	}
	
	/* fin */
	
	public static function delById($id){
		$sql = "delete from ".self::$tablename." where idsocio=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where idsocio=$this->idsocio";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." 
		set  
        apellidos   =\"$this->apellidos\",
        nombres     =\"$this->nombres\",
        fechanac    =\"$this->fechanac\",
        dni         =\"$this->dni\",
        direccion   =\"$this->direccion\",
        idciudad    =\"$this->idciudad\",
        idpais      =\"$this->idpais\",
        estadocivil =\"$this->estadocivil\",
        conyugue    =\"$this->conyugue\",
        profesion   =\"$this->profesion\",
        cargo       =\"$this->cargo\",
        lugartrabajo=\"$this->lugartrabajo\",
        clubes      =\"$this->clubes\",
        estadosocio =\"$this->estadosocio\",
        tiposocio   =\"$this->tiposocio\",
        idsocio1    =\"$this->idsocio1\",
        idsocio2    =\"$this->idsocio2\",
        fechaingreso=\"$this->fechaingreso\",
        nrosocio    =\"$this->nrosocio\",
        correo      =\"$this->correo\",
        nrocelular  =\"$this->nrocelular\",
        picture     =\"$this->picture\"

		where idsocio= $this->idsocio";
		Executor::doit($sql);
	}
	/* update para la foto */ 

	public function update_image(){
		$sql = "update ".self::$tablename." set picture=\"$this->picture\" where idsocio=$this->idsocio";
		Executor::doit($sql);
	}

	/* fin */

	public static function getById($id){

		$sql = "select * from ".self::$tablename." where idsocio=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new SocioData();
		
		while($r = $query[0]->fetch_array()){

			$data->idsocio      = $r['idsocio'];
			$data->apellidos    = $r['apellidos'];
            $data->nombres      = $r['nombres'];
            $data->fechanac     = $r['fechanac'];
			$data->dni	        = $r['dni'];
            $data->direccion    = $r['direccion'];
            $data->idciudad	  	= $r['idciudad'];
			$data->idpais       = $r['idpais'];
            $data->estadocivil  = $r['estadocivil'];
            $data->conyugue     = $r['conyugue'];
			$data->profesion    = $r['profesion'];
            $data->cargo        = $r['cargo'];
            $data->lugartrabajo = $r['lugartrabajo'];
            $data->clubes       = $r['clubes'];
			$data->estadosocio 	= $r['estadosocio'];
            $data->tiposocio    = $r['tiposocio'];
            $data->idsocio1     = $r['idsocio1'];
            $data->idsocio2     = $r['idsocio2'];
            $data->fechaingreso = $r['fechaingreso'];
            $data->nrosocio     = $r['nrosocio'];
            $data->correo  	    = $r['correo'];
            $data->nrocelular   = $r['nrocelular'];
			$data->picture 		= $r['picture'];

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
			$array[$cnt] = new SocioData(); 
			
			$array[$cnt]->idsocio      = $r['idsocio'];
			$array[$cnt]->apellidos    = $r['apellidos'];
            $array[$cnt]->nombres      = $r['nombres'];
            $array[$cnt]->fechanac     = $r['fechanac'];
			$array[$cnt]->dni	       = $r['dni'];
            $array[$cnt]->direccion    = $r['direccion'];
            $array[$cnt]->idciudad	   = $r['idciudad'];
			$array[$cnt]->idpais       = $r['idpais'];
            $array[$cnt]->estadocivil  = $r['estadocivil'];
            $array[$cnt]->conyugue     = $r['conyugue'];
			$array[$cnt]->profesion    = $r['profesion'];
            $array[$cnt]->cargo        = $r['cargo'];
            $array[$cnt]->lugatrabajo  = $r['lugartrabajo'];
            $array[$cnt]->clubes       = $r['clubes'];
			$array[$cnt]->estadosocio  = $r['estadosocio'];
            $array[$cnt]->tiposocio    = $r['tiposocio'];
            $array[$cnt]->idsocio1     = $r['idsocio1'];
            $array[$cnt]->idsocio2     = $r['idsocio2'];
            $array[$cnt]->fechaingreso = $r['fechaingreso'];
            $array[$cnt]->nrosocio	   = $r['nrosocio'];
            $array[$cnt]->correo  	   = $r['correo'];
            $array[$cnt]->nrocelular   = $r['nrocelular'];
			$array[$cnt]->picture 	   = $r['picture'];

			$cnt++;
		}
		return $array;
	} 

	public static function getActivos(){
		$sql = "select * from ".self::$tablename." where estadosocio='ACTIVO'";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;

		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new SocioData(); 
            
			$array[$cnt]->idsocio      = $r['idsocio'];
			$array[$cnt]->apellidos    = $r['apellidos'];
            $array[$cnt]->nombres      = $r['nombres'];
            $array[$cnt]->fechanac     = $r['fechanac'];
			$array[$cnt]->dni	       = $r['dni'];
            $array[$cnt]->direccion    = $r['direccion'];
            $array[$cnt]->idciudad	   = $r['idciudad'];
			$array[$cnt]->idpais       = $r['idpais'];
            $array[$cnt]->estadocivil  = $r['estadocivil'];
            $array[$cnt]->conyugue     = $r['conyugue'];
			$array[$cnt]->profesion    = $r['profesion'];
            $array[$cnt]->cargo        = $r['cargo'];
            $array[$cnt]->lugatrabajo  = $r['lugartrabajo'];
            $array[$cnt]->clubes       = $r['clubes'];
			$array[$cnt]->estadosocio  = $r['estadosocio'];
            $array[$cnt]->tiposocio    = $r['tiposocio'];
            $array[$cnt]->idsocio1     = $r['idsocio1'];
            $array[$cnt]->idsocio2     = $r['idsocio2'];
            $array[$cnt]->fechaingreso = $r['fechaingreso'];
            $array[$cnt]->nrosocio	   = $r['nrosocio'];
            $array[$cnt]->correo  	   = $r['correo'];
            $array[$cnt]->nrocelular   = $r['nrocelular'];
			$array[$cnt]->picture 	   = $r['picture'];

			$cnt++;
		}
		return $array;
	} 
 
}

?>