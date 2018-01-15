<?php
include('../functions/login.php');
if(session()==false || $_SESSION['role']=='directeur' or $_SESSION['role']=='directeurregionale')
{
//  echo "<script>window.location.assign('../index.php');</script>";
}else
{
require_once 'header.php';
?>
			<title id="title">Accueil</title>
			<link rel="shortcut icon" href="../images/ofppt.ico"/>	
			<link rel="stylesheet" type="text/css" href="../css/aff.css">	
			<link id="theme" rel="stylesheet" type="text/css" ;" media="screen" href="js/themes/redmond/jquery-ui.custom.css"></link>	
			<link rel="stylesheet" type="text/css" media="screen" href="js/jqgrid/css/ui.jqgrid.css"></link>	

			<script src="js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
			<script src="js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
			<script src="js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>

			<?php
require_once 'barre3.php';
require_once 'menu2.php';
?>	
<body>

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
						
			

		</div>
		<!-- end of styles article -->
		<div class="spacer"></div>
	</section>

<script>
$('document').ready(function(){
	
		//formateur
		$('#formateur').click(function(){
			//$("#main").fadeOut(3000);
			$.post("formateur.php",function(result){
			$("#main").empty();$('title').text('Gestion des Formateurs');
			$("#main").html(result);
			$('.current2').text('Gestion des Formateurs');
			});
			//$("#main").fadeIn(1000);
		});

	//salles
		$('#salle').click(function(){
			//$("#main").fadeOut(3000);
			$.post("salle.php",function(result){
			$("#main").empty();$('title').text('Gestion des Salles');
			$("#main").html(result);
			$('.current2').text('Gestion des Salles');
			});
			//$("#main").fadeIn(1000);
		});
	//filiere
		$('#filiere').click(function(){
			//$("#main").fadeOut(3000);
			$.post("filieres.php",function(result){
			$("#main").empty();$('title').text('Gestion des Filieres');
			$("#main").html(result);
			$('.current2').text('Gestion des Filieres');
			});
			//$("#main").fadeIn(1000);
		});

	//modules
	$('#module').click(function(){
			//$("#main").fadeOut(3000);
			$.post("modules.php",function(result){
			$("#main").empty();$('title').text('Gestion des Modules');
			$("#main").html(result);
			$('.current2').text('Gestion des Modules');
			});
			//$("#main").fadeIn(1000);
		});
		
	//etablisement
		$('#etablisement').click(function(){
			//$("#main").fadeOut(3000);
			$.post("etablisment.php",function(result){
			$("#main").empty();$('title').text('Gestion des Etablisements');
			$("#main").html(result);
			$('.current2').text('Gestion des Etablisements');
			});
			//$("#main").fadeIn(1000);
		});
	
		
	//groupe
		$('#groupe').click(function(){
			//$("#main").fadeOut(3000);
			$.post("groupe.php",function(result){
			$("#main").empty();$('title').text('Gestion des Groupes');
			$("#main").html(result);
			$('.current2').text('Gestion des Groupes');
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
		$('#main').animate({width: '100%',left: '-290px'},1000);
		$('#content').animate({width: '99%'},1000);
		});

		slide=false;
	}else
		{	
			
			$('#main').animate({width: '77%',left: '0px'},1000,function(){
			$('#main').css('position','');
			$('#sidebar').animate({left: '0px'},1000);
			$('#content').animate({width: '96%'},1000);
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