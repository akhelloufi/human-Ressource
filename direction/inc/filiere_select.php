<?php
	include('../../functions/login.php');
	$con=connect();
	$req=$con->query("SELECT  filiere.codefiliere as code, nom  FROM  filiere,etablissment_filiere
					WHERE
					filiere.codefiliere=etablissment_filiere.codefiliere
					and
					etablissment_filiere.codeetablissement='{$_SESSION['codeetablissement']}'");
	$arr=array();
	$arr[]=array("value"=>0,"label"=>'-----Selectionner-----');

	while($row=$req->fetch())
	{
	$arr[]=array("value"=>$row['code'],"label"=>$row['nom']);
	 
	}
//	echo json_encode(array('salle_pr'=>$arr,"salle_th"=>$arr));
	echo json_encode($arr);

?>
