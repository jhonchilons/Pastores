<?php 	

	$db = new Database();
	$connString =  $db->getCon(); 
	$params = $_REQUEST; 
	$datoCls = new Dato($connString);

	$datoCls->getDatos($params);	 
	
	class Dato {
	protected $conn;
	protected $data = array();

	function __construct($connString) {
		$this->conn = $connString;
	}

	public function getDatos($params) {
		$this->data = $this->getRecords($params);
		echo json_encode($this->data);
	}
	
	function getRecords($params) {
		$rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
		
		if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
		$sql = $sqlRec = $sqlTot = $where = '';

		if( !empty($params['searchPhrase']) ) {   
			$where .=" WHERE ";
			$where .=" ( nombredog LIKE '%".$params['searchPhrase']."%' ";  
			$where .=" OR sexo LIKE '%".$params['searchPhrase']."%' ";
			$where .=" OR padre LIKE '%".$params['searchPhrase']."%' ";
			$where .=" OR madre LIKE '%".$params['searchPhrase']."%' ";
			$where .=" OR razadog LIKE '%".$params['searchPhrase']."%' )";
	    }

	    if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}

	    // getting total number records without any search

		$sql = " SELECT * FROM vista_pedigree_raza ";
		$sqlTot .= $sql;
		$sqlRec .= $sql;

		//concatenate search sql if value exist

		if(isset($where) && $where != '') {
			$sqlTot .= $where;
			$sqlRec .= $where;
		}

		if ($rp!=-1)

		$sqlRec .= " LIMIT ". $start_from .",".$rp;		
		
		$qtot = mysqli_query($this->conn, $sqlTot) or die("error to fetch data");
		$queryRecords = mysqli_query($this->conn, $sqlRec) or die("error to fetch data");

		while( $row = mysqli_fetch_assoc($queryRecords) ) { 
			$data[] = $row;
		}

		$json_data = array(

			"current"            => intval($params['current']), 
			"rowCount"            => 10, 			
			"total"    => intval($qtot->num_rows),
			"rows"            => $data   // total data array
			);
		return $json_data;
	} 
}
?>