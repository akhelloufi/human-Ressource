<?php
include('../functions/login.php');
$id = intval($_REQUEST['code']);
$con=connect();
$sql = "DELETE FROM `affectation` WHERE `code`=$id";
$result = $con->query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>