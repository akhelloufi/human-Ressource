<?php //'%theorique%''%pratique%'
	include('../../functions/login.php');
	$con=connect();
	$reqq=$con->query("SELECT profil,heurepratique,heuretheorique 
	FROM module WHERE codemodule like'".$_POST['code']."%'")or die('erreure');
	$roww=$reqq->fetch()or die('erreur');
	$modulle=array();
	$modulle['profil']=$roww['profil'];
	$modulle['heurepratique']=$roww['heurepratique'];
	$modulle['heuretheorique']=$roww['heuretheorique'];
	
	$req=$con->query("SELECT * FROM `salle` WHERE  codeetablissement='{$_SESSION['codeetablissement']}'")or die('ereure');
	$pr=array();
	$th=array();
	$pr[]=array("value"=>0,"label"=>'-----Selectionner-----');
	$th[]=array("value"=>0,"label"=>'-----Selectionner-----');

	while($row=$req->fetch())
	{
	if($row['type']=='pratique')
		$pr[]=array("value"=>$row['codesalle'],"label"=>$row['nom']);
	else
	 $th[]=array("value"=>$row['codesalle'],"label"=>$row['nom']);
	}

	echo json_encode(array('salle_pr'=>$pr,"salle_th"=>$th,"module"=>$modulle));
	


?>