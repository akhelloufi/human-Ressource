<?php
	include('../../functions/login.php');
	$con=connect();
	$req=$con->query("SELECT codegroupe,nomgroupe FROM groupe WHERE codefiliere='".$_POST['filiere']."' and codeetablissment='{$_SESSION['codeetablissement']}'")or die(mysql_error());
	
	$arr=array();
	$arr[]=array("value"=>0,"label"=>'-----Selectionner-----');

	while($row=$req->fetch())
	{
	$arr[]=array("value"=>$row['codegroupe'],"label"=>$row['codegroupe']);
	}
	echo json_encode($arr);

?>
