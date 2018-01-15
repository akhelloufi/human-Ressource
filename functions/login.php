<?php
@session_start();
 /******************************  connect to the database    ************************************/

	function connect()// fonctions de connexion principale PDO
	{
		try
		{
		$con=new PDO('mysql:host=localhost;dbname=mraarab1_per', 'root', '', 
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		}
		catch(Exception $e)
		{
				exit("erreure de connexion");
		}
	return ($con);
	}

function connect2()// 2eme fonction de connexion pour les daragrids
{
		$conn = mysql_connect("localhost", "root", "")or die("");
		mysql_select_db("mraarab1_per")or die('');
}
/****************************************************************************************************/
/******************************  load filiere's select     ************************************/

function getCodeFiliere()
{

	$con=connect();

	$req=$con->query("SELECT  filiere.codefiliere as code, nom  FROM  filiere,etablissment_filiere
					WHERE
					filiere.codefiliere=etablissment_filiere.codefiliere
					and
					etablissment_filiere.codeetablissement='{$_SESSION['codeetablissement']}'");  
	//$req->execute(array($_SESSION['codeetablissement']))or die(mysql_error());
	while($row=$req->fetch())
	{
	echo"<option value=".$row['code'].">".$row['nom']."</option>";
	}

}
/******************************************************************************************************/
 /******************************   admin connection function    ************************************/

 function adminlogin()//fonction de connexion 
 {
 
 if(isset($_POST['submit']))
					{
					  $user=htmlspecialchars(trim($_POST['username']));
					 // $user=mysql_real_escape_string($user);

					  $pass=htmlspecialchars(trim($_POST['password']));
					 // $pass=mysql_real_escape_string($pass);
					 
					   $pass=md5($pass);//cryptage de mots pass en md5
					 $user=md5($user);//cryptage de mots user en md5
					 
					  $con=connect();// creer la connexion

					  $req=$con->prepare("SELECT *  FROM compte WHERE username=? AND password=?");
					  // preparer la requette  
					  $req->execute(array($user,$pass));//executer la requette

					  $number=$req->rowCount();// compter le nbr de ligne retourner par la requette
						 
						 
					$row=$req->fetch();// recuperer les donner dans la table $row
					$code=$row['codeetablissement'];
					$role=$row['role'];
					$nom=$row['nom'];
					  if($number==1)
						{
							  $_SESSION['codeetablissement']=$code;// session du code d'etablissement
							  $_SESSION['role']=$role;//session de l'administrateur
							  $_SESSION['nom']=$nom;// session le nom de utilisteur
							return (strTolower($role));
						}else{
						return false;
						
						
						}
					}
 
 }
 /**********************************************************************************************/
 
 /******************************  check session     ************************************/
 
 function session()// fontion de test si une session est active
 {
 if(isset($_SESSION['role']) && isset($_SESSION['codeetablissement']))
  return true;
  else
 return false;
 }
/******************************************************************************************/

 /******************************  getetablissement ************************************/

 function getetablissement()
 {
  
	$con=connect();// creer la connexion
	$req=$con->prepare("SELECT   etablissementab FROM  etablissement  WHERE codeetablissement=?");
	// preparer la requette  
	$req->execute(array($_SESSION['codeetablissement']));//executer la requette
	$row=$req->fetch();// recuperer les donner dans la table $row
	return($row['etablissementab']);
	
 }
 /******************************************************************************************/
 function getcodetablissement()
{
	$con=connect();
	$req=$con->query("SELECT codeetablissement,etablissementab FROM etablissement")or die(mysql_error());

	while($row=$req->fetch())
	{
	echo"<option value=".$row['codeetablissement'].">".$row['etablissementab']."</option>";
	}
}
 /******************************   add  new acount for new etablsm     ************************************/

  function addcompte()
 {
	$con=connect();// creer la connexion
	
	 
					  $user=htmlspecialchars(trim($_POST['username']));
					  //$user=mysql_real_escape_string($user);

					  $pass=htmlspecialchars(trim($_POST['password']));
					  //$pass=mysql_real_escape_string($pass);
					 
					  $pass=md5($pass);
					  $user=md5($user);
					 
					  $nom=htmlspecialchars(trim($_POST['nom']));
					 // $nom=mysql_real_escape_string($nom);
					  
					  $role=htmlspecialchars(trim($_POST['role']));
					  //$role=mysql_real_escape_string($role);
					  
					  $code=htmlspecialchars(trim($_POST['code']));
					  //$code=mysql_real_escape_string($code);
						  
					  $reqq="INSERT INTO compte(username,nom,password,role,codeetablissement)
						VALUES ('$user','$nom','$pass','$role','$code')";
						//echo $reqq;
					  $req=$con->query($reqq)or die(mysql_error());		
	
		
 }
 /******************************   load all etablissement's code   ************************************/

 function getFKey()
{
$con=connect();
$req=$con->query("SELECT codeetablissement,etablissementab FROM etablissement")or die(mysql_error());
$eta="";
while($row=$req->fetch())
{
$val=$row['codeetablissement'].':'.$row['etablissementab'];
$eta =$eta.$val.';';
}
return ($eta);

}
 /******************************   info acount   ************************************/

 function getcompte()
{
	$con=connect();
	$req=$con->query("SELECT nom,role,codeetablissement FROM compte")or die(mysql_error());

	while($row=$req->fetch())
	{
	echo"<tr>";
	echo"<td>".$row['nom']."</td>";
	echo"<td>".$row['role']."</td>";
	echo"<td>".$row['codeetablissement']."</td>";
	echo"</tr>";
	}
}

 /******************************   type salle     ************************************/

function gettypesalle($code)//recuperer le type de la salle
	{
	$con=connect();
	$req=$con->query("SELECT `type` FROM `salle` WHERE `codesalle`=".$code);
	$type=$req->fetch();
	$type=$type[0];
	return $type;
	}

 /******************************   ??????   ************************************/

 /******************************   return name of formateur   ************************************/

 function getformateur($matricule)
 {
	$con=connect();
	$result=$con->query("SELECT nom  FROM `formateur` WHERE `matricule`='".$matricule."'")or die('erreure');
	$module=$result->fetch();
	return ($module['nom']);
 }
 
 


 
 /******************************  Impotrtations     ************************************/
 function lire_csv($fichier)
{
	$lignes = array();
	foreach( file($fichier,FILE_IGNORE_NEW_LINES) as $ligne)
	{
		//$element = str_getcsv($ligne,";");
		$element = str_replace('"',"",explode(";",$ligne));
		if(!empty($element[0]))
		//print_r(convert_cyr_string($element[2],'m','i'));
		$lignes[] = $element;
			
	}
	return $lignes;
}
 /******************************  Impotrtations    formateurs     ************************************/

function importer_formateurs()
{
$con=connect();
			define("matricule",0);
			define("nom",1);
			define("profile",2);
			define("statut",3);
			define("bilan",4);
			define("codeetablissement",5);
			
$ext=end(explode(".",$_FILES['fch']['name']));
				if($_FILES['fch']['error']==0)
				{
					if($ext=="csv")
					{	$fichier = $_FILES['fch']['tmp_name'];
						$document = lire_csv($fichier);
						$req="";
						//$con->query("delete from formateur");
						$count=0;
						$validefichier=false;
						foreach($document as $et)
						{
						
						if(count($et)==6)
						{
						$validefichier=true;
						$req="INSERT INTO `formateur`
						(`matricule`, `nom`, `profilformateur`, `statut`, `Bilan_competence`, `codeetablissement`) 
						VALUES ({$et[matricule]},'{$et[nom]}','{$et[profile]}','{$et[statut]}','{$et[bilan]}',
						'{$et[codeetablissement]}')";
						$res=$con->query($req);
						if($res)
						$count++;
						}else
						$validefichier=false;
						}
						if($validefichier==false)
						echo "<script>$.messager.alert('Attention','les colonnes n\'est pas identique au table formateur!!','warning');</script>";
						echo "<script>$.messager.alert('Groupes','".$count." Formateurs ajouter');</script>";
					}else
					echo "<script>$.messager.alert('Attention','Le fichier est invalid !!','warning');</script>";
				}else
				echo "<script>$.messager.alert('Erreur de fichier','choisir un fichier  !!','info');</script>";
				

}
 /******************************  Impotrtations      salles   ************************************/

function importer_salles()
{
$con=connect();
			define("codesalle",0);
			define("nom",1);
			define("type",2);
			define("codeetablissement",3);
			define("codefiliere",4);
$ext=end(explode(".",$_FILES['fch1']['name']));
				if($_FILES['fch1']['error']==0)
				{
					if($ext=="csv")
					{	$fichier = $_FILES['fch1']['tmp_name'];
						$document = lire_csv($fichier);
						$req="";
						$count=0;
						$validefichier=false;
						foreach($document as $et)
						{
						
						if(count($et)==5)
						{
						$validefichier=true;
						$req="INSERT INTO `salle`(`codesalle`, `nom`, `type`, `codeetablissement`, `codefiliere`)
						VALUES ({$et[codesalle]},'{$et[nom]}','{$et[type]}','{$et[codeetablissement]}','{$et[codefiliere]}')";
						$res=$con->query($req);
						if($res)
						$count++;
						}else
						$validefichier=false;
						}
						if($validefichier==false)
						echo "<script>$.messager.alert('Attention','les colonnes n\'est pas identique au table salle!!','warning');</script>";
						
						echo "<script>$.messager.alert('Groupes','".$count." Salles ajouter');</script>";
					}else
					echo "<script>$.messager.alert('Attention','Le fichier est invalid !!','warning');</script>";
				}else
				echo "<script>$.messager.alert('Erreur de fichier','choisir un fichier  !!','info');</script>";
				
}
 /******************************  Impotrtations    filieres     ************************************/

function importer_filieres()
{
$con=connect();
			define("codefiliere",0);
			define("nom",1);
			define("niveau",2);
			define("dureeformation",3);
			define("dureeformationheure",4);
			define("dureepratique",5);
			define("dureetheorique",6);
			define("codesecteur",7);
$ext=end(explode(".",$_FILES['fch2']['name']));
				if($_FILES['fch2']['error']==0)
				{
					if($ext=="csv")
					{	$fichier = $_FILES['fch2']['tmp_name'];
						$document = lire_csv($fichier);
						$req="";
						$count=0;
						$validefichier=false;
						foreach($document as $et)
						{
						if(count($et)==8)
						{
						$validefichier=true;
						$req="INSERT INTO `filiere`
						(`codefiliere`, `nom`, `niveau`, `dureeformation`, 
						`dureeformationheure`, `dureepratique`, `dureetheorique`, `codesecteur`)
						VALUES 
						('{$et[codefiliere]}','{$et[nom]}','{$et[niveau]}','{$et[dureeformation]}',
						{$et[dureeformationheure]},{$et[dureepratique]},{$et[dureetheorique]},'{$et[codesecteur]}')";
						
						$res=$con->query($req);
						if($res)
						$count++;
						}else
						$validefichier=false;
						}
						if($validefichier==false)
						echo "<script>$.messager.alert('Attention','les colonnes n\'est pas identique au table filiere!!','warning');</script>";
						
						echo "<script>$.messager.alert('Groupes','".$count." Filieres ajouter');</script>";
					}else
					echo "<script>$.messager.alert('Attention','Le fichier est invalid !!','warning');</script>";
				}else
				echo "<script>$.messager.alert('Erreur de fichier','choisir un fichier  !!','info');</script>";
}
 /******************************  Impotrtations   modules      ************************************/

function importer_modules()
{
$con=connect();
			define("codemodule",0);
			define("nom",1);
			define("codefiliere",2);
			define("totaleheure",3);
			define("heurepratique",4);
			define("heuretheorique",5);
			define("profil",6);
$ext=end(explode(".",$_FILES['fch3']['name']));
				if($_FILES['fch3']['error']==0)
				{
					if($ext=="csv")
					{	$fichier = $_FILES['fch3']['tmp_name'];
						$document = lire_csv($fichier);
						$req="";
						$count=0;
						$validefichier=false;
						foreach($document as $et)
						{
						if(count($et)==7)
						{
						$validefichier=true;
						$req="INSERT INTO `module`
						(`codemodule`, `nom`, `codefiliere`, `totaleheure`,
						`heurepratique`, `heuretheorique`, `profil`) 
						VALUES 
						('{$et[codemodule]}','{$et[nom]}','{$et[codefiliere]}','{$et[totaleheure]}'
						,'{$et[heurepratique]}','{$et[heuretheorique]}','{$et[profil]}')";
						$res=$con->query($req);
						if($res)
						$count++;
						}else
						$validefichier=false;
						}
						if($validefichier==false)
						echo "<script>$.messager.alert('Attention','les colonnes n\'est pas identique au table module!!','warning');</script>";
						
						echo "<script>$.messager.alert('Groupes','".$count." Modules ajouter');</script>";
					}else
					echo "<script>$.messager.alert('Attention','Le fichier est invalid !!','warning');</script>";
				}else
				echo "<script>$.messager.alert('Erreur de fichier','choisir un fichier  !!','info');</script>";
}


 /******************************  Impotrtations  etablissements       ************************************/

function importer_etablissements()
{
$con=connect();
			define("codeetablissement",0);
			define("etablissementab",1);
			define("complex",2);
			define("ville",3);
			define("DR",4);
$ext=end(explode(".",$_FILES['fch5']['name']));
				if($_FILES['fch5']['error']==0)
				{
					if($ext=="csv")
					{	$fichier = $_FILES['fch5']['tmp_name'];
						$document = lire_csv($fichier);
						$req="";
						$count=0;
						$validefichier=false;
						foreach($document as $et)
						{
						if(count($et)==5)
						{
						$validefichier=true;
						$req="INSERT INTO `etablissement`(`codeetablissement`, `etablissementab`, `complex`, `ville`, `DR`) 
						VALUES 
						('{$et[codeetablissement]}','{$et[etablissementab]}','{$et[complex]}','{$et[ville]}'
						,'{$et[DR]}')";
						$res=$con->query($req);
						if($res)
						$count++;
						}else
						$validefichier=false;
						}
						if($validefichier==false)
						echo "<script>$.messager.alert('Attention','les colonnes n\'est pas identique au table etablissement!!','warning');</script>";
						
						echo "<script>$.messager.alert('Groupes','".$count." Etablissements ajouter');</script>";
					}else
						echo "<script>$.messager.alert('Attention','Le fichier est invalid !!','warning');</script>";
				}else
				echo "<script>$.messager.alert('Erreur de fichier','choisir un fichier  !!','info');</script>";
}
 /******************************  Impotrtation groupes ************************************/

function importer_groupes()
{
$con=connect();
			define("codegroupe",0);
			define("nomgroupe",1);
			define("NIVEAU",2);
			define("codefiliere",3);
			define("codeetablissment",4);
$ext=end(explode(".",$_FILES['fch4']['name']));
				if($_FILES['fch4']['error']==0)
				{
					if($ext=="csv")
					{	$fichier = $_FILES['fch4']['tmp_name'];
						$document = lire_csv($fichier);
						$req="";
						$count=0;
						$validefichier=false;
						foreach($document as $et)
						{
						if(count($et)==5)
						{
						$validefichier=true;
						$res=$con->query("INSERT INTO `groupe`(`codegroupe`, `nomgroupe`, `NIVEAU`, `codefiliere`, `codeetablissment`)
						VALUES('{$et[codegroupe]}','{$et[nomgroupe]}','{$et[NIVEAU]}','{$et[codefiliere]}','{$et[codeetablissment]}')");
						if($res)
						$count++;
						}else
						$validefichier=false;
						}
						if($validefichier==false)
						echo "<script>$.messager.alert('Attention','les colonnes n\'est pas identique au table groupe!!','warning');</script>";
						echo "<script>$.messager.alert('Groupes','".$count." Groupes ajouter');</script>";
					}else
					echo "<script>$.messager.alert('Attention','Le fichier est invalid !!','warning');</script>";
				}else
				echo "<script>$.messager.alert('Erreur de fichier','choisir un fichier  !!','info');</script>";
}

function resultat_salle()
{	$val=array();
	$con=connect();
	
	$salle_pr=$con->query("select count(*)*58*39 as nbr from salle where type like'%pratique%'
	and salle.`codeetablissement`='{$_SESSION['codeetablissement']}'");
	$nbrsalle_pr=$salle_pr->fetch();
	
	$salle_th=$con->query("select count(*)*58*39 as nbr from salle where type like'%theorique%'
	and salle.`codeetablissement`='{$_SESSION['codeetablissement']}'");
	$nbrsalle_th=$salle_th->fetch();
	
	$heur_affecter_pr=$con->query("SELECT sum(`heureaffecterpratique`) as hfpr
	FROM affectation  where affectation.`codeetablissment`='{$_SESSION['codeetablissement']}'");
	$hfpr=$heur_affecter_pr->fetch();
	
	$heur_affecter_th=$con->query("SELECT sum(`heureaffectertheorique`) as hfth
	FROM affectation  where affectation.`codeetablissment`='{$_SESSION['codeetablissement']}'");
	$hfth=$heur_affecter_th->fetch();
	
	
	$val['opr']=$nbrsalle_pr['nbr'];
	$val['oth']=$nbrsalle_th['nbr'];
	$val['hfpr']=$hfpr['hfpr'];
	$val['hfth']=$hfth['hfth'];
return ($val);
}
	

?>