
<?php
include('../../functions/login.php');
$con=connect();
$res=$con->query("
SELECT  salle.nom as nomsalle ,SUM(`heureaffectertheorique`+`heureaffecterpratique`)*(100/2226)  as somme FROM `affectation`,salle
where affectation.`codesalle`=salle.codesalle
AND  codeetablissment='N520'
group by affectation.codesalle");
$ro=array();
$roo=array();
//echo"[";
while($row=$res->fetch())
{
$ro['nomsalle']=$row['nomsalle'];
$ro['somme']=$row['somme'];
$roo[]=$ro;
}

echo json_encode($roo);
//echo json_encode(array(array("sal"=>"salle1" ,"salle"=>30),array("sal"=>"salle2" ,"salle"=>30)));

/*
echo '[{"sal":"salle1","salle":30},{"sal":"salle1","salle":30},
{"sal":"salle2","salle":30},
{"sal":"salle3","salle":30},
{"sal":"salle4","salle":30}]';
*/
?>