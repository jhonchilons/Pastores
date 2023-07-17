<?php 

$registro = KennelData::getById($_POST["id"]); 

$registro->del($registro->idkennel);

Core::redir("./index.php?view=kennel");

?>

