<?php
	include('../../functions/login.php');
	$con=connect();
	
	if(isset($_POST['code']))
	$code=$_POST['code'];
	$rs = $con->query("SELECT code ,formateur.nom as formateur ,groupe.codegroupe as groupe
		,filiere.nom as filiere,module.nom as module ,salle.nom  as salle 
		FROM `affectation`,formateur,groupe,module,filiere ,salle
		WHERE formateur.matricule=affectation.`matricule`
		AND affectation.codesalle=salle.codesalle
		AND filiere.codefiliere=affectation.`codefiliere` 
		AND groupe.codegroupe=affectation.`codegroupe`  AND module.codemodule=affectation.`codemodule` 
		AND affectation.`codeetablissment` like '{$_SESSION['codeetablissement']}' AND affectation.codegroupe='{$code}'");
	
	$employees=array();
	while ($row=$rs->fetch()) {
		$employees[] = array(
			'code' => $row['code'],
			'formateur' => $row['formateur'],
			'groupe' => $row['groupe'],
			'filiere' => $row['filiere'],
			'module' => $row['module'],
			'salle' => $row['salle']
		  );
	}
	
	$req=$con->query("SELECT  codemodule, nom FROM  module  WHERE codefiliere like'".$_POST['filiere']."%'")or die(mysql_error());
	$arr=array();
	$arr[]=array("value"=>0,"label"=>'-----Selectionner-----');

	while($row=$req->fetch())
	{
	$arr[]=array("value"=>$row['codemodule'],"label"=>$row['nom']);
	}
	
	
	
	
	
	
	echo json_encode(array("module"=>$arr,"data"=>$employees));
	?>