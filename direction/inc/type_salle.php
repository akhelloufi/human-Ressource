<?php
	include('../../functions/login.php');
	$con=connect();
$req_salle=$con->query("SELECT  type from  salle where codesalle=".$_POST['code'])or die(mysql_error());
$row=$req_salle->fetch();
echo ($row['type']);	
?>