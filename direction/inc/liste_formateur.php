<?php
include('../../functions/login.php');
	
	if(isset($_POST['code']))
	$code=$_POST['code'];
	else
	$code=0;
	$con=connect();
	//formateur
	$result=$con->query("SELECT * FROM `formateur` WHERE formateur.`codeetablissement`='{$_SESSION['codeetablissement']}'
	AND matricule NOT  IN(select matricule from affectation 
	WHERE affectation.`codeetablissment` like'".$_SESSION['codeetablissement']."%')");
	//salle
	$result_salles=$con->query("SELECT nom FROM `salle` WHERE salle.`codeetablissement`='{$_SESSION['codeetablissement']}'
	AND codesalle NOT  IN (select codesalle from affectation 
	WHERE affectation.`codeetablissment` like'".$_SESSION['codeetablissement']."%')");
	//module
	
	$qery="SELECT module.nom FROM groupe,module WHERE `groupe`.`codefiliere`=module.codefiliere and groupe.codegroupe='{$code}'
	and groupe.`codeetablissment`='{$_SESSION['codeetablissement']}' 
	and module.`codemodule` 
	NOT IN(SELECT `codemodule` from affectation 
	where affectation.`codeetablissment` like'{$_SESSION['codeetablissement']}%' 
	and affectation.codegroupe='{$code}')";
	//echo $qery;
	$result_modules=$con->query($qery);
	
	//echo json_encode(array("req"=>("SELECT module.nom FROM groupe,module WHERE `groupe`.`codefiliere`=module.codefiliere and groupe.codegroupe='{$code}'and groupe.`codeetablissment`='{$_SESSION['codeetablissement']}' and module.`codemodule` NOT IN(SELECT `codemodule` from affectation where affectation.`codeetablissment` like'{$_SESSION['codeetablissement']}%')")));
	
	$liste="<img id='cls' src='../images/close.gif' style='float: right;margin: 4px;cursor:pointer;'><p>Formateurs non Affecter</p>";
	$salles="<img id='cls' src='../images/close.gif' style='float: right;margin: 4px;cursor:pointer;'><p>Salle non Affecter</p>";
	
	$modules="<img id='cls' class='fff' src='../images/close.gif' style='position: fixed;float: right;margin: 4px;cursor:pointer;'><p>Modules non Affecter <br>pour le groupe {$code}</p>";
	$nbr=$result->rowCount();
	$nbrsalles=$result_salles->rowCount();
	$nbrmodules=$result_modules->rowCount();

	while($row=$result->fetch())
	{
		$liste.="<hr><p>".$row['nom']."</p>";
	}
	while($row=$result_salles->fetch())
	{
	$salles.="<hr><p>".$row['nom']."</p>";
	}
	while($row=$result_modules->fetch())
	{
	$modules.="<hr><p>".$row['nom']."</p>";
	}
 
 
echo json_encode(array(
		"liste_formateur"=> $liste,
		"nbr"=>$nbr,
		"nbrsalle"=>$nbrsalles,
		"salles"=>$salles,
		"nbrmodule"=>$nbrmodules,
		"modules"=>$modules
		));
?>