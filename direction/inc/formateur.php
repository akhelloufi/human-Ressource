<?php
	include('../../functions/login.php');
	$con=connect();
	$req=$con->query("SELECT  matricule ,nom FROM formateur WHERE codeetablissement like'{$_SESSION['codeetablissement']}%'")or die(mysql_error());
$arr=array();
	$arr[]=array("value"=>0,"label"=>'-----Selectionner-----');

	while($row=$req->fetch())
	{
	$arr[]=array("value"=>$row['matricule'],"label"=>$row['nom']);
	}
	echo json_encode($arr);
	?>