<?php
include('../../functions/login.php');

$nbr=count(free_formateur());

echo json_encode(array("nbr"=>$nbr));

?>