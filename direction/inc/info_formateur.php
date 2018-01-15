<?php
/*
connexion a la base donnee
recuperer matricule du formateur envoyer par la select formateur
creation de la requêtte
stocker les info dans la table $row
definire un style du table a afficher les info
parcourire les info et les afficher  dans la table
*/
	include('../../functions/login.php');
	$con=connect();
	define('span','color: #00F;font-size: 16px;font-weight: bold;font-style: italic;');
	define('headtd','font-size: 16px;font-weight: bold;text-align: center;');
	define('tr','background-color: #E0ECFF');
	if(isset($_POST['mat']))
	{
	$req=$con->query("SELECT  * FROM formateur where matricule={$_POST['mat']} and formateur.`codeetablissement`='{$_SESSION['codeetablissement']}'")or die(mysql_error());
	$row=$req->fetch()or die('erreur');
	echo "<table style='width: 297px;margin: auto;height: 163px'>";
	echo"<tr style='".tr."'><td><span style='".span."'>Matricule</span></td><td style='".headtd."'>".$row['matricule']."</td></tr>";
	echo"<tr style='".tr."'><td><span style='".span."'>Nom </span></td><td style='".headtd."'>".$row['nom']."</td></tr>";
	echo"<tr style='".tr."'><td><span style='".span."'>Profil Formateur </span></td><td style='".headtd."'>".$row['profilformateur']."</td></tr>";
	echo"<tr style='".tr."'><td><span style='".span."'>Statut </span> </td><td style='".headtd."'>".$row['statut']."</td></tr>";
	echo"<tr style='".tr."'><td><span style='".span."'>Bilan </span></td><td style='".headtd."'>".$row['Bilan_competence']."</td></tr>";
	echo "</table>";
	}
	else
	echo "matricule indefined !! <strong>THIS PAGE IS FORBIDDEN</strong>";
	?>