<?php



if(!isset($_SESSION["user_id"])) {

$user = $_POST['username'];

$pass = sha1(md5($_POST['password']));
//$pass = $_POST['password'];

echo 'ddd'.$_POST['password'];

$base = new Database();

$con = $base->connect();

 $sql = "select * from user where username= \"".$user."\" and password= \"".$pass."\" and is_active=1";

//print $sql;

$query = $con->query($sql);

$found = false;

$userid = null;

while($r = $query->fetch_array()){

	$found = true ;

	$userid = $r['id'];

}



if($found==true) {

//	session_start();

//	print $userid;

	$_SESSION['user_id']=$userid ;

//	setcookie('userid',$userid);

//	print $_SESSION['userid'];

	print "Cargando ... $user";

	print "<script>window.location='./';</script>";

}else {

	print "<script>window.location='index.php?view=login';</script>";

}



}else{

	print "<script>window.location='./';</script>";

	

}

?>