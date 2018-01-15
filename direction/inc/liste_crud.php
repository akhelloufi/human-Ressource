<?php
include('../../functions/login.php');
$con=connect();
$session='N520';
$req_update="";
if(isset($_GET['update']))
{ 		
	foreach($_GET as $set=>$val)
	{
		if($set!='codeaffectation' and $set!='update') 
		$req_update="UPDATE `affectation` SET $set ='$val' WHERE code={$_GET['codeaffectation']} ";
	}
	$result=$con->query($req_update);
	if($result)
	echo json_encode(array("sql"=>"modification effectuer avec succès"));
	else
	echo json_encode(array("sql"=>"erreur de modification"));
}
else
{


$filieres=$con->query("SELECT  filiere.codefiliere as code, nom  FROM  filiere,etablissment_filiere
					WHERE  filiere.codefiliere=etablissment_filiere.codefiliere
					and etablissment_filiere.codeetablissement='{$session}'");
$formateurs=$con->query("SELECT matricule,nom FROM `formateur` WHERE formateur.`codeetablissement`='{$session}'");
$salles=$con->query("SELECT codesalle,nom FROM `salle` WHERE salle.`codeetablissement`='{$session}'");

$groupes=$con->query("SELECT codegroupe,nomgroupe FROM groupe WHERE codeetablissment='{$session}'");
// modulequery("SELECT  codemodule, nom FROM  module  WHERE codefiliere like'".$_POST['filiere']."%'")

$filiere=array();
$groupe=array();
$module=array();
$formateur=array();
$salle=array();



while($row=$filieres->fetch())
	{
	$filiere[]=array("value"=>$row['code'],"label"=>$row['nom']);
	}
while($row=$formateurs->fetch())
	{
	$formateur[]=array("value"=>$row['matricule'],"label"=>$row['nom']);
	}
while($row=$salles->fetch())
	{
$salle[]=array("value"=>$row['codesalle'],"label"=>$row['nom']);
	}
while($row=$groupes->fetch())
	{
$groupe[]=array("value"=>$row['codegroupe'],"label"=>$row['codegroupe']);
	}

echo json_encode(array("filiere"=>$filiere,"formateur"=>$formateur,"salle"=>$salle,"groupe"=>$groupe));
}
?>