<?php
include('../functions/login.php');
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	if(isset($_POST['codegroup']))
	$codegroup = $_POST['codegroup'];
	else $codegroup=0;
	
	$con=connect();	
	$result = array();
	
		if(isset($_POST['matricule']) and !empty($_POST['matricule']))
		{
		$mat=$_POST['matricule'];
		$rs = $con->query("SELECT code ,formateur.nom as formateur ,groupe.codegroupe as groupe
	,filiere.nom as filiere,module.nom as module ,`typesalle` as salle
			
			  FROM `affectation`,formateur,groupe,module,filiere 
			where formateur.matricule=affectation.`matricule` 
			and filiere.codefiliere=affectation.`codefiliere` 
			and groupe.codegroupe=affectation.`codegroupe` 
			and module.codemodule=affectation.`codemodule` 
			AND affectation.`codeetablissment` like'{$_SESSION['codeetablissement']}'

	AND formateur.nom LIKE '%$mat%' 
	 limit $offset,$rows");
		
		}else
		{
		
	$rs = $con->query("SELECT code ,formateur.nom as formateur ,groupe.codegroupe as groupe
	,filiere.nom as filiere,module.nom as module ,`typesalle` as salle
			
			  FROM `affectation`,formateur,groupe,module,filiere 
			where formateur.matricule=affectation.`matricule` 
			and filiere.codefiliere=affectation.`codefiliere` 
			and groupe.codegroupe=affectation.`codegroupe` 
			and module.codemodule=affectation.`codemodule` 
			AND affectation.`codeetablissment` like'{$_SESSION['codeetablissement']}'

	AND affectation.codegroupe='$codegroup' 
	 limit $offset,$rows");
		
		
		}
	
	

	
	
	
	$items = array();
	while($row = $rs->fetch()){
	
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>