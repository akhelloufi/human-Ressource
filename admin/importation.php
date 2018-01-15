<?php
include('../functions/login.php');
if(session()==false || $_SESSION['role']=='directeur' or $_SESSION['role']=='directeurregionale')
{
  echo "<script>window.location.assign('../index.php');</script>";
}else
{
require_once 'header.php';
?>
			<title id="title">Imporatations</title>
			<link rel="shortcut icon" href="../images/ofppt.ico"/>	
			<link rel="stylesheet" type="text/css" href="../css/importer.css">	
			<link id="theme" rel="stylesheet" type="text/css" ;" media="screen" href="js/themes/redmond/jquery-ui.custom.css"></link>	
			<link rel="stylesheet" type="text/css" media="screen" href="js/jqgrid/css/ui.jqgrid.css"></link>	
		
			<script src="js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
			<script src="js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
			<script src="js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
			<link rel="stylesheet" type="text/css" href="../css/icon.css">

<?php
require_once 'barre3.php';
require_once 'menu2.php';
?>
<style>
.newcompte{
width: 168px;
height: 25px;
border: 1px solid #000;
border-radius: 4px;
padding-left: 4px;
font-size: 16px;
font-weight: bold;}
</style>

<body>

<section id="main" class="column">
	<div id="content" style="margin-top: -31px;">
			
			
			<div class="result">
					<?php	
					//importer formateur
						if(isset($_POST['Importer']))
						importer_formateurs();
					//importer salle
						if(isset($_POST['Importer1']))
						importer_salles();
					//importer filiere
						if(isset($_POST['Importer2']))
						importer_filieres();
						
					//importer module
						if(isset($_POST['Importer3']))
						importer_modules();
						
					//importer etablissement
						if(isset($_POST['Importer5']))
						importer_etablissements();
					
					//importer groupe
						if(isset($_POST['Importer4']))
						importer_groupes();
					
					
					?>
				</div>
			
		

		
				
<div style="width: 800px;margin: auto;margin-top: 81px;">			
	<div class="easyui-tabs" id="tt" style="width:800px;height:auto">
		<div title="Formateurs" style="padding:10px" data-options="iconCls:'icon-user',closable:true">
				<div class="frm">
					<form action="" method="post"   enctype="multipart/form-data">
						<center><label>Importer des  Formateurs</label></center>
						<div class="inputfile">
						<input type="file" name="fch"/>
						<center>
						<img src="../images/folder_upload.ico" style="width: 77px;height: 71px;"/>
						</center>
						</div>
						<input type="submit" name="Importer" value="Importer"/>
					</form>
					<div>
					<div style="line-height: 25px;">
					<p ><span style="color:red">NB :</span> 
					le ficher csv doivent contient les colonnes suivante :
					</br>(`matricule`, `nom`, `profilformateur`, `statut`, `Bilan_competence`, `codeetablissement`) 
					</p>
					</div>
					</div>
			</div>
		</div>
		<div title="Salles" style="padding:10px"   data-options="iconCls:'icon-salle'">
				<div class="frm">
					<form action="" method="post"   enctype="multipart/form-data">
						<center><label>Importer des  salles</label></center>
						<div class="inputfile">
						<input type="file" name="fch1"/>
						<center>
						<img src="../images/folder_upload.ico" style="width: 77px;height: 71px;"/>
						</center>
						</div>
						<input type="submit" name="Importer1" value="Importer"/>
					</form>
					<div>
					<div style="line-height: 25px;"> 
						<p ><span style="color:red">NB :</span> 
						le ficher csv doivent contient les colonnes suivante :
						</br>(`codesalle`, `nom`, `type`, `codeetablissement`, `codefiliere`) </p>
					</div>
					</div>
				</div>
		</div>
		<div title="Filieres" data-options="iconCls:'icon-filiere', closable:true" style="padding:10px">
					<div class="frm">
					<form action="" method="post"   enctype="multipart/form-data">
						<center><label>Importer des  filieres</label></center>
						<div class="inputfile">
						<input type="file" name="fch2"/>
						<center>
						<img src="../images/folder_upload.ico" style="width: 77px;height: 71px;"/>
						</center>
						</div>
						<input type="submit" name="Importer2" value="Importer"/>
					</form>
						<div> 
						<div style="line-height: 25px;"> 
						<p "><span style="color:red">NB :</span> 
								le ficher csv doivent contient les colonnes suivantes :
								</br>(`codefiliere`, `nom`, `niveau`, `dureeformation`,
								`dureeformationheure`, `dureepratique`, `dureetheorique`, `codesecteur`)
						</p>	
						</div>
						</div>
				</div>
		</div>
		<div title="Modules" data-options="iconCls:'icon-module'" style="padding:10px">
			<div class="frm">
					<form action="" method="post"   enctype="multipart/form-data">
						<center><label>Importer des  Modules</label></center>
						<div class="inputfile">
						<input type="file" name="fch3"/>
						<center>
						<img src="../images/folder_upload.ico" style="width: 77px;height: 71px;"/>
						</center>
						</div>
						<input type="submit" name="Importer3" value="Importer"/>
					</form>
					<div> 
						<div style="line-height: 25px;"> 
						<p "><span style="color:red">NB :</span> 
								le ficher csv doivent contient les colonnes suivantes:
							</br>(`codemodule`, `nom`, `codefiliere`, `totaleheure`, `heurepratique`, `heuretheorique`, `profil`)
						</p>	
						</div>
					</div>
			</div>
		</div>
		<div title="Groupes" data-options="iconCls:'icon-groupe', closable:true" style="padding:10px">
				<div class="frm">
					<form action="" method="post"   enctype="multipart/form-data">
						<center><label>Importer des  Groupes</label></center>
						<div class="inputfile">
						<input type="file" name="fch4"/>
						<center>
						<img src="../images/folder_upload.ico" style="width: 77px;height: 71px;"/>
						</center>
						</div>
						<input type="submit" name="Importer4" value="Importer"/>
					</form>
					<div> 
						<div style="line-height: 25px;"> 
						<p "><span style="color:red">NB :</span> 
								le ficher csv doivent contient les colonnes suivante:
						</br>(`codegroupe`, `nomgroupe`, `NIVEAU`, `codefiliere`, `codeetablissment`)								
						</p>	
						</div>
					</div>
			</div>
		</div>	
		<div title="Etablissements" data-options="iconCls:'icon-etabli', closable:true" style="padding:10px">
				<div class="frm">
					<form action="" method="post"   enctype="multipart/form-data">
						<center><label>Importer des  Etablissements</label></center>
						<div class="inputfile">
						<input type="file" name="fch5"/>
						<center>
						<img src="../images/folder_upload.ico" style="width: 77px;height: 71px;"/>
						</center>
						</div>
						<input type="submit" name="Importer5" value="Importer"/>
					</form>
					<div> 
						<div style="line-height: 25px;"> 
						<p "><span style="color:red">NB :</span> 
								le ficher csv doivent contient les colonnes suivante s:
								</br>(`codeetablissement`, `etablissementab`, `complex`, `ville`, `DR`) 
						</p>	
						</div>
					</div>
				</div>
		</div>
	</div>
	<div class="easyui-tabs" id="tt2" style="width:800px;height:auto">
			<div title="Liste des Comptes" style="padding:10px" data-options="iconCls:'icon-listecompte',closable:true">
				
				<table class="tablesorter1"  style="width: 100%;"cellspacing="0"> 
				<tbody> 
					<tr> 
						<td><p>Nom</p></td> 
						<td><p>Role</p></td> 
						<td><p>Code Etablissement</p></td> 
				  </tr>
				<?php getcompte();?>
				</tbody> 
				</table>
			</div>
			<div title="Nouveau Compte" style="padding:10px" data-options="iconCls:'icon-compteaj',closable:true">
	
			<form action="" method="post" id="ffff">
	
				<table class="tablesorter"  cellspacing="0"> 
				<tbody>
					<tr> 
						<td><p>Nom d'utilisateur <span>*</span> :</p></td> 
						<td><input type="text" id="username" required  name="username" class="newcompte"></td>  
					</tr>
					<tr> 
						<td><p>Mot de Passe  <span>*</span> :&nbsp; &nbsp; &nbsp;</p></td> 
						<td><input type="password" id="password" required  name="password" class="newcompte"></td>  
					</tr>
					<tr> 
						<td><p>Nom <span>*</span> :&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;</p></td> 
						<td><input type="text" id="nom" required  name="nom" class="newcompte"></td>  
					</tr>
					<tr> 
						<td><p>Role <span>*</span> :&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;</p></td> 
						<td><select name="role" id="role" class="newcompte">
						<option value="selectioner">-----Selectionner-----</option>
						<option value="directeur">directeur</option>
						<option value="Directeurregionale">Directeur régionale</option>
						</select></td> 
					</tr>
					<tr>
					<td><p>Code etablissement<span> *</span>:</p></td>
					<td>
					<select name="code" id="code"class="newcompte">
					<option value="">-----Selectionner-----</option>
						<?php getcodetablissement();?>
					</select> 
					</td>
					</tr>
					<tr> 
					<td><input type="submit" id="submit" required  value="Ajouter compte"name="submit" onclick="_role();"></td> <td><?php

						if(isset($_POST['submit']))
						{
						addcompte();
						}
						?>
					</td> 
					</tr>
					<tr>
														
				</tbody> 
				</table>
			</form>
		</div>
			
			
	  </div><!--end tab tt2-->
	</div> <!--end tab contener-->
</div><!--end content-->
		<div class="spacer"></div>
</section>
<script>
  $('document').ready(	function(){
	 var res=true ; 
	 
	$('#ffff').submit(function(){
	if($('#nom').val()=='' ||$('#username').val()==''||$('#password').val()==''||$('#role').val()=='selectioner')
	{
	$('#errole').show('slow');
	$('#errole').text('* Champs Obligatoire');
	$('#errole').slideDown('4000');
	res=false;
	}else
	{
	$('#errole').fadeOut('slow');
	res=true;
	}
	
	return res;
	});   
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

</script>
<script>
$('.current2').text('Importations');
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

		
		
});


</script>
</body>

</html>
<?php } ?>