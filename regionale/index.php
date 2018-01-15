<?php
include('../functions/login.php');
if(session()==false || $_SESSION['role']=='admin' or $_SESSION['role']=='directeur')
{
  echo "<script>window.location.assign('../index.php');</script>";
}else
{
require_once 'header.php';
?>
			<title id="title">Accueil</title>
			<link rel="shortcut icon" href="../images/ofppt.ico"/>
			<link rel="stylesheet" type="text/css" href="../css/regional.css">
<?php
require_once 'barre3.php';
require_once 'menu2.php';
?>

</body>

</html>

<section id="main" class="column">
	<h4 class="title_info">OFPPT 2013</h4>
		<div id="content">

				<table class="affectation">
				<tr>
				<th>Nom</th>
				<td><?php echo $_SESSION['nom'];?></td>
				</tr>
				<tr>
				<th>role</th>
				<td><?php echo $_SESSION['role'];?></td>
				</tr>
				<tr>
				<th>Etablissement</th>
				<td><?php echo getetablissement();?></td>
				</tr>
				</table>
		<iframe src="chart.htm" style="border: none;width: 573px;height: 452px;"></iframe>
		</div>	<!-- end of content-->
	
		<div class="spacer"></div>
	</section>	<!-- end of section-->
</body>
<script>
$('').ready(function(){

alert('jjj');

});



</script>

</html>
<?php } ?>