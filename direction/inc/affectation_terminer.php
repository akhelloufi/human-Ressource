<?php
	include('../../functions/login.php');
	

	
	//recuperation
	$codefiliere=$_POST['filiere'];
	$codegroupe=$_POST['groupe'];
	$codemodule=$_POST['module'];
	$codesalle_pr=$_POST['salle_pr'];
	$codesalle_th=$_POST['salle_th'];
	$matricule=$_POST['formateur'];
	
	//recupere heur pratique et theorique diun lodule selectionner
	$con=connect();
	$req=$con->query("SELECT  heurepratique, heuretheorique FROM  module WHERE  codemodule='".$codemodule."'");
	$totaleheur=$req->fetch();
	$hheurepratique=$totaleheur['heurepratique'];
	$hheuretheorique=$totaleheur['heuretheorique'];
$con=connect();	

	$result=$con->query("SELECT * from affectation WHERE
	codemodule='{$codemodule}'
	AND codefiliere='{$codefiliere}' AND
	codegroupe='{$codegroupe}'
	AND `codeetablissment` 
	like'{$_SESSION['codeetablissement']}%'");
	$module=$result->rowCount();
	
if($module<2)
{
		if($codesalle_pr !=0 and $codesalle_th !=0)
		{
		
			$typesalle_th=gettypesalle($codesalle_th);
			$typesalle_pr=gettypesalle($codesalle_pr);

			$reqaff =$con->query("
								INSERT INTO `affectation`(`code`,`heureaffecterpratique`,
								`heureaffectertheorique`, `typesalle`, `codesalle`, 
					`matricule`, `codemodule`, `codefiliere`,
					`codegroupe`, `codeetablissment`)
					VALUES ('',{$hheurepratique},0,'{$typesalle_pr}',
					{$codesalle_pr},{$matricule},
					'{$codemodule}','{$codefiliere}','{$codegroupe}',
					'{$_SESSION['codeetablissement']}')
					,('',0,{$hheuretheorique},'{$typesalle_th}',
					{$codesalle_th},{$matricule},
					'{$codemodule}','{$codefiliere}','{$codegroupe}',
					'{$_SESSION['codeetablissement']}')");
					
						if($reqaff)
							echo "success     L'AFFECTATION   TERMINER AVEC SUCCES  <br>";
						else 
							echo "error       </br>ERREURE D'AFFECTATION <br><br>";
		
			}elseif($codesalle_pr !=0)
			{ 
				$typesalle_pr=gettypesalle($codesalle_pr);
				$reqaff =$con->query("
								INSERT INTO `affectation`(`code`,`heureaffecterpratique`,
								`heureaffectertheorique`, `typesalle`, `codesalle`, 
					`matricule`, `codemodule`, `codefiliere`,
					`codegroupe`, `codeetablissment`)
					VALUES('',{$hheurepratique},{$hheuretheorique},'{$typesalle_pr}',
					{$codesalle_pr},{$matricule},
					'{$codemodule}','{$codefiliere}','{$codegroupe}',
					'{$_SESSION['codeetablissement']}')");
					if($reqaff)
							echo json_encode(array("type"=>"success","msg"=>"L'AFFECTATION   TERMINER AVEC SUCCES  <br>"));
						else 
							echo json_encode(array("type"=>"error","msg"=>" <br>ERREURE D'AFFECTATION <br></br>"));
			
			}elseif($codesalle_th !=0)
			{
			
			$typesalle_th=gettypesalle($codesalle_th);
				$reqaff =$con->query("
								INSERT INTO `affectation`(`heureaffecterpratique`,
								`heureaffectertheorique`, `typesalle`, `codesalle`, 
					`matricule`, `codemodule`, `codefiliere`,
					`codegroupe`, `codeetablissment`)
					VALUES({$hheurepratique},{$hheuretheorique},'{$typesalle_th}',
					{$codesalle_th},{$matricule},
					'{$codemodule}','{$codefiliere}','{$codegroupe}',
					'{$_SESSION['codeetablissement']}')");
					if($reqaff)
							echo json_encode(array("type"=>"success","msg"=>"L'AFFECTATION   TERMINER AVEC SUCCES  <br>"));
						else 
							echo json_encode(array("type"=>"error","msg"=>" <br>ERREURE D'AFFECTATION <br><br>"));
		
			}
}else
				echo json_encode(array("type"=>"warning","msg"=>"<br><br> Cette affectation  et deja donner  <br><br>"));


?>