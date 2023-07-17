<?php 
$user = UserData::getById($_POST["id"]); 
$user->del($user->id);
Core::redir("./index.php?view=usuario");
?>
