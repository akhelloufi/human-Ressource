<?php
include('../functions/login.php');
if(session()==false || $_SESSION['role']=='admin' or $_SESSION['role']=='directeurregionale')
{
  echo "<script>window.location.assign('../index.php');</script>";
}else
{
require_once 'header.php';
?>
			<title id="title">Accueil</title>
			<link rel="shortcut icon" href="../images/ofppt.ico"/>
			<link rel="stylesheet" type="text/css" href="../css/aff.css">
			<link rel="stylesheet" type="text/css" href="../css/easyui.css">
			<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
			<link type="text/css" href="../css/jquery.toastmessage-min.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/jquery.toastmessage-min.js"></script>

	<link rel="stylesheet" type="text/css" media="screen" href="js/themes/redmond/jquery-ui.custom.css"></link>
	<link rel="stylesheet" type="text/css" media="screen" href="js/jqgrid/css/ui.jqgrid.css"></link>
	<script src="js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
	<script src="js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
<?php
require_once 'barre3.php';
require_once 'menu2.php';
?>


	<section id="main" class="column">

		<h4 class="title_info">OFPPT 2013</h4>
		<div id="content">

						<table class="affectation" style="margin-top: 50px;">
						<tr>
						<th>Nom</th>
						<td><?php echo $_SESSION['nom'];?></td>
						</tr>
						<tr>
						<th>role</th>
						<td><?php echo $_SESSION['role'];?></td>
						</tr>
						</table>



		</div>
		<!-- end of styles article -->
		<div class="spacer"></div>
	</section>
		<img id="cls"src="../images/close.gif" style="float: right;margin: 4px;cursor:pointer;">
	</div>

<script>
$('document').ready(function(){

		//formateur
		$('#formateurs').click(function (){
		page="formateur";
			//$("#main").fadeOut(3000);
			$.post("formateur.php",function(result){
			$("#main").empty();$('title').text('Gestion des formateurs');
			$("#main").html(result);
			$('.current2').text('Gestion des Formateurs');
			});
			//$("#main").fadeIn(1000);
		});

		//salle
		$('#salles').click(function (){
		page="salle";
			//$("#main").fadeOut(3000);
			$.post("salle.php",function(result){
			$("#main").empty();$('title').text('Gestion des Salles');
			$("#main").html(result);
			$('.current2').text('Gestion des Salles');
			});
			//$("#main").fadeIn(1000);
		});

var slide=true;				
$('#menuslide').click(function(){
	if(slide==true)
	{
		$('#sidebar').animate({left: '-222px'},1000,function(){
		$('#menuslide').css('background-position','-33px');
		$('#main').css('position','absolute');
		$('#main').animate({width: '100%',left: '-290px'},1000)

		});

		slide=false;
	}else
		{	
			
			$('#main').animate({width: '77%',left: '0px'},1000,function(){
			$('#main').css('position','');
			$('#sidebar').animate({left: '0px'},1000);
			$('#menuslide').css('background-position','-6px');
			})
			
			
		slide=true;
	}
	});
				
				
				
				
				
				
				
				
				
});


</script>
</body>

</html>
<?php } ?>