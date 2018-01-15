SELECT `codegroupe`, `nomgroupe`, `NIVEAU`, `codefiliere`, `codeetablissment` FROM (SELECT * FROM groupe ) 
--------------------------------------------------------------------------------------------------------
SELECT code ,formateur.nom as formateur ,groupe.codegroupe as groupe
,filiere.nom as filiere,module.nom as module ,`typesalle` as salle
FROM `affectation`,formateur,groupe,module,filiere 
where formateur.matricule=affectation.`matricule` 
and filiere.codefiliere=affectation.`codefiliere` 
and groupe.codegroupe=affectation.`codegroupe` 
and module.codemodule=affectation.`codemodule` 
AND affectation.`codeetablissment` like'{$_SESSION['codeetablissement']}'
AND formateur.nom LIKE '%$mat%' 
limit $offset,$rows
-------------------------------------------------------------------
SELECT code ,formateur.nom as formateur ,groupe.codegroupe as groupe
,filiere.nom as filiere,module.nom as module ,`typesalle` as salle
FROM `affectation`,formateur,groupe,module,filiere 
where formateur.matricule=affectation.`matricule` 
and filiere.codefiliere=affectation.`codefiliere` 
and groupe.codegroupe=affectation.`codegroupe` 
and module.codemodule=affectation.`codemodule` 
AND affectation.`codeetablissment` like'{$_SESSION['codeetablissement']}'
AND affectation.codegroupe='$codegroup' 
limit $offset,$rows
-----------------------------------------------------------------------------
SELECT  type from  salle where codesalle=.$_POST['code']
----------------------------------------------------
SELECT * from affectation WHERE codemodule='{$codemodule}' AND codefiliere='{$codefiliere}' AND
codegroupe='{$codegroupe}' AND `codeetablissment` like'{$_SESSION['codeetablissement']}%'
---------------------------------------------------------------------------------------
SELECT  heurepratique, heuretheorique FROM  module WHERE  codemodule=.$codemodule.
--------------------------------------------------------------------------------------------
INSERT INTO `affectation`(`code`,`heureaffecterpratique`, `heureaffectertheorique`, `typesalle`, `codesalle`, 
`matricule`, `codemodule`, `codefiliere`, `codegroupe`, `codeetablissment`)
VALUES ('',{$hheurepratique},0,'{$typesalle_pr}',{$codesalle_pr},{$matricule},'{$codemodule}','{$codefiliere}','{$codegroupe}',
'{$_SESSION['codeetablissement']}'),('',0,{$hheuretheorique},'{$typesalle_th}',{$codesalle_th},{$matricule},
'{$codemodule}','{$codefiliere}','{$codegroupe}','{$_SESSION['codeetablissement']}')
----------------------------------------------------------------------------------------------------------------------
INSERT INTO `affectation`(`code`,`heureaffecterpratique`,`heureaffectertheorique`, `typesalle`, `codesalle`, 
`matricule`, `codemodule`, `codefiliere`,`codegroupe`, `codeetablissment`)
VALUES('',{$hheurepratique},{$hheuretheorique},'{$typesalle_pr}',
{$codesalle_pr},{$matricule},'{$codemodule}','{$codefiliere}','{$codegroupe}','{$_SESSION['codeetablissement']}')
-------------------------------------------------------------------------------------
INSERT INTO `affectation`(`heureaffecterpratique`,`heureaffectertheorique`, `typesalle`, `codesalle`, 
`matricule`, `codemodule`, `codefiliere`,`codegroupe`, `codeetablissment`)
VALUES({$hheurepratique},{$hheuretheorique},'{$typesalle_th}',{$codesalle_th},{$matricule},
'{$codemodule}','{$codefiliere}','{$codegroupe}','{$_SESSION['codeetablissement']}')
-------------------------------------------------------------------------------------
SELECT * FROM `formateur` WHERE formateur.`codeetablissement`='{$_SESSION['codeetablissement']}'
AND matricule NOT  IN(select matricule from affectation 
WHERE affectation.`codeetablissment` like'".$_SESSION['codeetablissement']."%')
-----------------------------------------------------------------------------------------------------------
SELECT nom FROM `salle` WHERE salle.`codeetablissement`='{$_SESSION['codeetablissement']}'
AND codesalle NOT  IN (select codesalle from affectation 
WHERE affectation.`codeetablissment` like'".$_SESSION['codeetablissement']."%')
-------------------------------------------------------------------------------------
SELECT module.nom FROM groupe,module WHERE `groupe`.`codefiliere`=module.codefiliere and groupe.codegroupe='{$code}'
and groupe.`codeetablissment`='{$_SESSION['codeetablissement']}' and module.`codemodule` 
NOT IN(SELECT `codemodule` from affectation where affectation.`codeetablissment` like'{$_SESSION['codeetablissement']}%' 
and affectation.codegroupe='{$code}')
------------------------------------------------------------------------------------------------------------------
SELECT  matricule ,nom FROM formateur WHERE codeetablissement like'{$_SESSION['codeetablissement']}%')
-------------------------------------------------------------------------------------------------------
SELECT  * FROM formateur where matricule={$_POST['mat']} 
and formateur.`codeetablissement`='{$_SESSION['codeetablissement']}'
--------------------------------------------------------------------------------
SELECT  filiere.codefiliere as code, nom  FROM  filiere,etablissment_filiere
WHERE filiere.codefiliere=etablissment_filiere.codefiliere
and etablissment_filiere.codeetablissement='{$_SESSION['codeetablissement']}'
--------------------------------------------------------------------------------------
SELECT  salle.nom as nomsalle ,SUM(`heureaffectertheorique`+`heureaffecterpratique`)*(100/2226)  as somme FROM `affectation`,salle
where affectation.`codesalle`=salle.codesalle
AND  codeetablissment='N520' group by affectation.codesalle
------------------------------------------------------------
SELECT  codemodule, nom FROM  module  WHERE codefiliere like'".$_POST['filiere']."%'
----------------------------------------------------------------------------------------------
SELECT * FROM `formateur` WHERE formateur.`codeetablissement`='{$_SESSION['codeetablissement']}'
AND matricule NOT  IN(select matricule from affectation 
WHERE affectation.`codeetablissment` like'".$_SESSION['codeetablissement']."%')
---------------------------------------------------------------------------------------------------
SELECT  filiere.codefiliere as code, nom  FROM  filiere,etablissment_filiere
WHERE filiere.codefiliere=etablissment_filiere.codefiliere
and etablissment_filiere.codeetablissement='{$_SESSION['codeetablissement']}'
------------------------------------------------------------------------------------------------
SELECT *  FROM compte WHERE username=? AND password=?
--------------------------------------------------------------------------------------------------
SELECT `typesalle` as salle,formateur.nom as formateur,
filiere.nom as filiere,groupe.nomgroupe as groupe,module.nom as module
FROM `affectation`,formateur,groupe,module,filiere 
where formateur.matricule=affectation.`matricule` 
and filiere.codefiliere=affectation.`codefiliere` 
and groupe.codegroupe=affectation.`codegroupe` 
and module.codemodule=affectation.`codemodule` 
AND affectation.`codeetablissment` like'{$_SESSION['codeetablissement']}%'
------------------------------------------------------------------------------------------------------
INSERT INTO `formateur`(`matricule`, `nom`, `profilformateur`, `statut`, `Bilan_competence`, `codeetablissement`) 
VALUES ({$et[matricule]},'{$et[nom]}','{$et[profile]}','{$et[statut]}','{$et[bilan]}','{$et[codeetablissement]}')
------------------------------------------------------------------------------------------------------
