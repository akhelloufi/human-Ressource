<?php 
$con=new PDO('mysql:host=localhost;dbname=mraarab1_per', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	
	$rs = $con->query("SELECT code ,formateur.nom as formateur ,groupe.codegroupe as groupe
		,filiere.nom as filiere,module.nom as module ,salle.nom  as salle 
		FROM `affectation`,formateur,groupe,module,filiere ,salle
		WHERE formateur.matricule=affectation.`matricule`
		AND affectation.codesalle=salle.codesalle
		AND filiere.codefiliere=affectation.`codefiliere` 
		AND groupe.codegroupe=affectation.`codegroupe`  AND module.codemodule=affectation.`codemodule`");
	
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
	 
	echo json_encode($employees);

?>