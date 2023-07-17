<?php
if(count($_POST)>0){
	$is_admin=0;
	if(isset($_POST["is_admin"])){$is_admin=1;} 
	
	$is_management=0;
	if(isset($_POST["is_management"])){$is_management=1;} 
	
	$is_active=0;
	if(isset($_POST["is_active"])){$is_active=1;}

	$user = UserData::getById($_POST["user_id"]);
	$user->name = addslashes($_POST["name"]);
	$user->lastname = addslashes($_POST["lastname"]);
	$user->username = addslashes($_POST["username"]);
	$user->email = addslashes($_POST["email"]);
	$user->is_admin=$is_admin;
	$user->is_active=$is_active; 
	$user->is_management=$is_management;
		
	$user->update();

	if($_POST["password"]!=""){
		$user->password = sha1(md5($_POST["password"]));
		$user->update_passwd();
		print "<script>alert('Se ha actualizado el password');</script>"; 
	} 
	print "<script>window.location='index.php?view=usuario';</script>"; 
} 
?>