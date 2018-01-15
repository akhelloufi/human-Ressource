<?php include('functions/login.php');
	if(isset ($_SESSION ['role']))
		{
			if($_SESSION ['role']=='admin'||1==1)
			  echo "<script>window.location.assign('admin');</script>";
			  elseif($_SESSION ['role']=='directeur')
			  echo "<script>window.location.assign('direction');</script>";
			  else
			  echo "<script>window.location.assign('regionale');</script>";
			
		}else{	


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<![endif]-->
	<!--<script src="js/hideshow.js" type="text/javascript"></script>-->
	<title>Connexion</title>
	<link rel="shortcut icon" href="admin/images/ofppt.ico"/>	
</head>
<body>

	<header id="header">
		<hgroup>
		<img src="images/logo.jpg" style="width: 100%;height: 101px;"/>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><a href="index.php">Connexion</a></p>
		</div>
		
	</section><!-- end of secondary bar -->

	<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Recherche" >
		</form>
		<hr/>
	</aside>
	
<div id="sidebar2">
		
	</div>
	<section id="main" class="column">
		<h4 class="title_info">AUTHENTIFICATION</h4>
		<article class="module width_3_quarter connexion">
		
		<header><h3 class="tabbs_involved">Authentification</h3>
			
		</header>

	<div class="tabb_container">
			<div id="tab1" class="tabb_content">
			
		<table class="tablesorter" cellspacing="0"> 
			<tbody>
			  <form action="" method="post">
				<tr> 
   					<td><p>Nom d'utilisateur <span>*</span> :</p></td> 
    				<td><input type="text" id="username" required  name="username"></td>  
				</tr> 
				<tr> 
   					<td><p>Mot de Passe <span>*</span> :</p></td> 
    				<td><input type="password" required id="password"  name="password"></td> 
				</tr>
				<tr> 
   					<td><input type="submit" value="Connexion" name="submit"id="login" class="button" /></td>	
					<td><span style="color: #F00;font-size: 18px;font-weight: bold;text-shadow: 1px 2px #000;">
					<?php 
				if(isset($_POST['submit']))
				{
					$login=adminlogin();
					switch ($login)
					{	
						case false: 
						echo "mots de pass ou pseudo n'est pas correcte";
						break;
						
						case "admin":
						echo "<script>window.location.assign('admin');</script>";
						break;

						case "directeur": 
						echo "<script>window.location.assign('direction');</script>";
						break;
						
						case "directeurregionale": 
						echo "<script>window.location.assign('regionale');</script>";
						break;
						
						default:
						@header("location:index.php");
					}
					
				}	
				?>
	
		</span></td> 
	</form>										
				</tr>  																																			
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->

			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
		<!-- end of styles article -->
		<div class="spacer"></div>
		
	</section>

</body>

</html>
<?php }?>